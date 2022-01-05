<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Custom Meta Tags --}}
    @yield('meta_tags')

    {{-- Title --}}
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 3'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>

    {{-- Custom stylesheets (pre AdminLTE) --}}
    @yield('adminlte_css_pre')

    {{-- Base Stylesheets --}}
    @if(!config('adminlte.enabled_laravel_mix'))
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    {{-- Configured Stylesheets --}}
    @include('adminlte::plugins', ['type' => 'css'])

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @else
    <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
    @endif

    {{-- Custom Stylesheets (post AdminLTE) --}}
    @yield('adminlte_css')
    <style>
        .custom-select.is-invalid+.select2 .select2-selection {
            border-color: #dc3545 !important;
        }

        .custom-select.is-valid+.select2 .select2-selection {
            border-color: #28a745 !important;
        }


        *:focus {
            outline: 0px;
        }

        .form-control.flatpickr-custom-style[readonly] {
            background-color: white;
            border-left: 2px solid blue;
            border-radius: 5px;
            opacity: 1;
        }
    </style>

    {{-- Favicon --}}
    @if(config('adminlte.use_ico_only'))
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    @elseif(config('adminlte.use_full_favicon'))
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-icon-192x192.png') }}">
    <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    @endif

</head>

<body class="@yield('classes_body')" @yield('body_data')>
    <form id="delete-form" action="" method="post">
        @csrf
        @method('DELETE')
    </form>
    {{-- Body Content --}}
    @yield('body')


    <script>
        window.default_locale = "{{ config('app.locale') }}";
        window.fallback_locale = "{{ config('app.fallback_locale') }}";
        window.messages = @json($messages);

    </script>

    <script>
        window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
                'baseUrl' => url('/'),
                'routes' => collect(\Route::getRoutes())->mapWithKeys(function($route) {
                    return [$route->getName()=>$route->uri()];
                })
            ]) !!};
    </script>
    <script src="{{asset('js/dashboard_app.js')}}"></script>

    {{-- Base Scripts --}}
    @if(!config('adminlte.enabled_laravel_mix'))
    <!-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script> -->
    <!-- <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> -->
    <!-- <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> -->

    {{-- Configured Scripts --}}
    @include('adminlte::plugins', ['type' => 'js'])

    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @else
    <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
    @endif

    {{-- Custom Scripts --}}
    @yield('adminlte_js')

    <script>
        $(".only-number").keydown(function(event) {
            // Allow only backspace and delete
            if ($(this).val().length <= 12 || event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9) {
                if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9) {
                    // let it happen, don't do anything
                } else {
                    // Ensure that it is a number and stop the keypress
                    if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
                        event.preventDefault();
                    }
                }
            } else {
                event.preventDefault();
            }

        });

        window.Echo.channel('donated-item-' + '{{auth()->user()->uuid}}')
            .listen('.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
                console.log(data);
                var name = data.name.substr(0, 10)
                var about_item = data.about_item.substr(0, 10)
                var noti_route = route("notifications.click", data.id)
                var noti =
                    `<a href="${noti_route}" class="dropdown-item bg-danger">
                <i class="fas fa-envelope mr-2"></i> ${name} donated ${about_item}
                </a>
                <div class="dropdown-divider"></div>`;

                $("#no-new-noti").remove()
                $('#noti-menu').prepend(noti)
                var count = $("#noti-badge").data("num") + 1;
                $("#noti-badge").removeClass("d-none").data('num', count).html(count);

                var notiTableData =
                    `
                <tr class="clickable-row bg-gradient-success" data-href="${noti_route}">
                    <td><i class="fas fa-envelope mr-2"></i></td>
                    <td class="mailbox-name">${name}</td>
                    <td class="mailbox-subject">
                        ${data.phone}
                    </td>
                    <td class="mailbox-subject">${data.about_item}</td>
                    <td class="mailbox-date">${data.created_at}</td>
                </tr>
                `;
                $('#noti-table').prepend(notiTableData)

                $(".clickable-row").click(function() {
                    window.location = $(this).data("href");
                });

            });
    </script>
</body>

</html>