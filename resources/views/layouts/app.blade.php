<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Thabarwa Kutholshin</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    @yield('css')
</head>

<body class="antilaliased font-sans bg-gray-200">
    <!-- Start Navbar -->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" v-if="$route.name.includes('frontend')">
            <a class="navbar-brand" href="#">Navbar </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="mr-auto"></div>
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <router-link class="nav-link" :to="{ name: 'frontend-home' }">Home</router-link>
                    </li>

                    <li class="nav-item">
                        <router-link class="nav-link" :to="{ name: 'frontend-about' }">About</router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </div>
    <!-- End Navbar -->
    <div id="app" class="container">
        @yield('content')
    </div>

    <script src="{{asset('js/app.js')}}"></script>
    @yield('js')
</body>

</html>