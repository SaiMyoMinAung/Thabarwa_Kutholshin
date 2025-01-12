<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#61-title
    |
    */

    'title' => 'AdminLTE 3',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#62-favicon
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#63-logo
    |
    */

    'logo' => '<b>Thabarwa</b> Kutholshin',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Kutholshin',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#64-user-menu
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#65-layout
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#661-authentication-views-classes
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#662-admin-panel-classes
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#67-sidebar
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#68-control-sidebar-right-sidebar
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#69-urls
    |
    */

    'use_route_url' => false,

    'dashboard_url' => 'backend/dashboard',

    'logout_url' => 'logout',

    'login_url' => 'login',

    'register_url' => 'register',

    'password_reset_url' => 'password/reset',

    'password_email_url' => 'password/email',

    'profile_url' => 'backend/my-profile',

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#610-laravel-mix
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#611-menu
    |
    */

    'menu' => [
        // [
        //     'text' => 'search',
        //     'search' => true,
        //     'topnav' => true,
        // ],

        // [
        //     'text'        => 'Donation Records',
        //     'url'         => 'backend/donation_records',
        //     'active'      => ['backend/donation_records', 'backend/donation_records/*'],
        //     'icon'        => 'fas fa-tasks',
        //     'label_color' => 'success'
        // ],
        // [
        //     'text'        => 'Donated Items',
        //     'url'         => 'backend/donated_items',
        //     'active'      => ['backend/donated_items', 'backend/donated_items/*/manage', 'backend/donated_items/*'],
        //     'icon'        => 'fas fa-globe',
        //     'label_color' => 'success'
        // ],
        [
            'text'        => 'store',
            'url'         => 'backend/internal_donated_items',
            'active'      => ['backend/internal_donated_items', 'backend/internal_donated_items/*'],
            'icon'        => 'fas fa-store',
            'label_color' => 'success',
            'can' => 'read-internal-donated-items'
        ],
        [
            'text'        => 'share_stored_item',
            'url'         => 'backend/share_internal_donated_items',
            'active'      => ['backend/share_internal_donated_items', 'backend/share_internal_donated_items/*'],
            'icon'        => 'fas fa-hand-holding',
            'label_color' => 'success'
        ],
        // [
        //     'text'        => 'contribution_lists',
        //     'url'         => 'backend/contributions',
        //     'active'      => ['backend/contributions', 'backend/contributions/*'],
        //     'icon'        => 'fas fa-truck',
        //     'label_color' => 'success',
        //     'can' => 'can-do-internal-donated-item-record'
        // ],
        // [
        //     'text'        => 'received_contribution_lists',
        //     'url'         => 'backend/received-contributions',
        //     'active'      => ['backend/received-contributions', 'backend/received-contributions/*'],
        //     'icon'        => 'fas fa-truck',
        //     'label_color' => 'success',
        //     'can' => 'can-do-internal-donated-item-record'
        // ],
        ['header' => 'Settings', 'can' => 'can-see-setting'],
        [
            'text'        => 'Admins',
            'url'         => 'backend/admins',
            'icon'        => 'fas fa-user-tie',
            'active'      => ['backend/admins', 'backend/admins/*/edit', 'backend/admins/create'],
            'label_color' => 'success',
            'can' => 'read-admin'
        ],
        [
            'text'        => 'Roles',
            'url'         => 'backend/roles',
            'icon'        => 'fas fa-crown',
            'active'      => ['backend/roles', 'backend/roles/*/edit', 'backend/roles/create'],
            'label_color' => 'success',
            'can' => 'read-role'
        ],

        // [
        //     'text'        => 'Volunteers',
        //     'url'         => 'backend/volunteers',
        //     'icon'        => 'fas fa-people-carry',
        //     'active'      => ['backend/volunteers', 'backend/volunteers/*/edit', 'backend/volunteers/create'],
        //     'label_color' => 'success',
        // ],
        [
            'text'        => 'Teams',
            'url'         => 'backend/teams',
            'icon'        => 'fas fa-users',
            'active'      => ['backend/teams', 'backend/teams/*/edit', 'backend/teams/create'],
            'label_color' => 'success',
            'can' => 'read-team'
        ],
        [
            'text'        => 'Yogi',
            'url'         => 'backend/yogis',
            'icon'        => 'fas fa-dharmachakra',
            'active'      => ['backend/yogis', 'backend/yogis/*/edit', 'backend/yogis/create'],
            'label_color' => 'success',
            'can' => 'read-yogi'
        ],
        // [
        //     'text'        => 'Users',
        //     'url'         => 'backend/users',
        //     'icon'        => 'fas fa-user',
        //     'label_color' => 'success',
        // ],
        [
            'text'        => 'Settings',
            'url'         => 'backend/settings',
            'icon'        => 'fas fa-cogs',
            'label_color' => 'success',
            'can' => 'can-see-setting'
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#612-menu-filters
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#613-plugins
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/js/backend/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/js/backend/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '/css/backend/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'bs-stepper' => [
            'active' => true,
            'files' => [
                // [
                //     'type' => 'js',
                //     'asset' => true,
                //     'location' => '//cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js',
                // ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/js/backend/select2.full.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '/css/backend/select2.full.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '/css/backend/select2.bootstrap4.min.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],
];
