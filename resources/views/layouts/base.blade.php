<!doctype html>

<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ config('env.APP_NAME') }}</title>

    <link rel="stylesheet" id="sweetalert-dark-theme" href="{{ asset('theme/empty.css') }}"/>
    <link rel="stylesheet" id="sweetalert-toast-dark-theme-patch" href="{{ asset('theme/empty.css') }}"/>

    <script>
        const theme = localStorage.getItem('theme');

        if (theme) {

            const sweetAlertDarkThemeAssetUrl = theme === 'dark' ? 'https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css' : '{{ asset('theme/empty.css') }}';
            const sweetalertDarkThemeElement = document.head.querySelector('#sweetalert-dark-theme');
            sweetalertDarkThemeElement.setAttribute('href', sweetAlertDarkThemeAssetUrl);

            const sweetAlertToastPatchAssetUrl = theme === 'dark' ? '{{ asset('theme/sweet-alert-toast-dark-theme-patch.css') }}' : '{{ asset('theme/empty.css') }}';
            const sweetalertToastPathDarkThemeElement = document.head.querySelector('#sweetalert-toast-dark-theme-patch');
            sweetalertToastPathDarkThemeElement.setAttribute('href', sweetAlertToastPatchAssetUrl);

            document.documentElement.setAttribute("data-bs-theme", theme)
        }
    </script>

    <!-- CSS files -->
    <link href="{{ asset('theme/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('theme/css/tabler-flags.css') }}" rel="stylesheet"/>
    <link href="{{ asset('theme/css/tabler-payments.css') }}" rel="stylesheet"/>
    <link href="{{ asset('theme/css/tabler-vendors.min.css') }}" rel="stylesheet"/>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }


        @media (min-width: 768px) {
            .table-responsive {
                overflow: visible;
            }
        }
    </style>
</head>
<body>

<div class="page">
    <!-- Navbar -->
    <header class="navbar navbar-expand-md d-print-none">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                    aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <a href="{{ route('home') }}">
                    <img src="{{ asset(config('env.LOGO_ASSET_PATH')) }}" width="110" height="32" alt="IMS Logo"
                         class="navbar-brand-image">
                    <span>{{ config('env.APP_NAME') }}</span>
                </a>
            </h1>
            <div class="navbar-nav flex-row order-md-last">
                <div class="nav-item d-none d-md-flex me-3">
                    <div class="btn-list">


                        <a href="https://fb.com/yad.hoshyar" class="btn" target="_blank" rel="noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-facebook"
                                 width="44" height="44" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"
                                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3"/>
                            </svg>

                            Developer
                        </a>

                        <a href="tel:{{ config('env.SUPPORT_PHONE_NUMBER') }}" class="btn" rel="noreferrer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone-call"
                                 width="44" height="44" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"
                                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path
                                    d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"/>
                                <path d="M15 7a2 2 0 0 1 2 2"/>
                                <path d="M15 3a6 6 0 0 1 6 6"/>
                            </svg>

                            {{ config('env.SUPPORT_PHONE_NUMBER') }}
                        </a>

                    </div>
                </div>
                <div class="d-none d-md-flex">
                    <a href="#" id="bd-theme" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                       data-bs-toggle="tooltip"
                       data-bs-placement="bottom">
                        <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"/>
                        </svg>
                    </a>
                    <div class="nav-item dropdown d-none d-md-flex me-3">
                        <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                           aria-label="Show notifications">
                            <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path
                                    d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"/>
                                <path d="M9 17v1a3 3 0 0 0 6 0v-1"/>
                            </svg>
                            {{--                            <span class="badge bg-red"></span>--}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Last updates</h3>
                                </div>
                                <div class="list-group list-group-flush list-group-hoverable">
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto"><span
                                                    class="status-dot status-dot-animated bg-success d-block"></span>
                                            </div>
                                            <div class="col text-truncate">
                                                <a href="#" class="text-body d-block">Notification</a>
                                                <div class="d-block text-muted text-truncate mt-n1">
                                                    No current notifications.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                       aria-label="Open user menu">
                        <span class="avatar avatar-sm"
                              style="background-image: url('{{ asset('images/user.png') }}'); box-shadow: unset;"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ auth()->user()->name }}</div>
                            <div class="mt-1 small text-muted">My Account</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <header class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar">
                <div class="container-xl">
                    <ul class="navbar-nav">
                        <li class="nav-item @if(request()->is('/')) active @endif">
                            <a class="nav-link" href="{{ route('home') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                       viewBox="0 0 24 24"
                                       stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                       stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path
                                          d="M5 12l-2 0l9 -9l9 9l-2 0"/><path
                                          d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"/><path
                                          d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"/></svg>
                                </span>
                                <span class="nav-link-title">
                                    Home
                                </span>
                            </a>
                        </li>

                        <li class="nav-item @if(request()->is('customers*')) active @endif">
                            <a class="nav-link" href="{{ route('customers.index') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-user-bolt" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round"><path stroke="none"
                                                                                             d="M0 0h24v24H0z"
                                                                                             fill="none"/><path
                                            d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/><path
                                            d="M6 21v-2a4 4 0 0 1 4 -4h4c.267 0 .529 .026 .781 .076"/><path
                                            d="M19 16l-2 3h4l-2 3"/></svg></span>
                                <span class="nav-link-title">
                                    Customers
                                </span>
                            </a>
                        </li>

                        <li class="nav-item @if(request()->is('products*')) active @endif">
                            <a class="nav-link" href="{{ route('products.index') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><svg
                                        xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-box-seam"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M12 3l8 4.5v9l-8 4.5l-8 -4.5v-9l8 -4.5"/>
  <path d="M12 12l8 -4.5"/>
  <path d="M8.2 9.8l7.6 -4.6"/>
  <path d="M12 12v9"/>
  <path d="M12 12l-8 -4.5"/>
</svg></span>
                                <span class="nav-link-title">
                                    Products
                                </span>
                            </a>
                        </li>

                        <li class="nav-item @if(request()->is('orders*')) active @endif">
                            <a class="nav-link" href="{{ route('orders.index') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-truck-delivery" width="24" height="24"
     viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/>
  <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/>
  <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5"/>
  <path d="M3 9l4 0"/>
</svg>                                </span>
                                <span class="nav-link-title">
                                    Orders
                                </span>
                            </a>
                        </li>

                                                <li class="nav-item @if(request()->is('reports*')) active @endif">
                                                    <a class="nav-link" href="{{ route('reports.index') }}">
                                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-pie" width="24" height="24"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M10 3.2a9 9 0 1 0 10.8 10.8a1 1 0 0 0 -1 -1h-6.8a2 2 0 0 1 -2 -2v-7a.9 .9 0 0 0 -1 -.8"/>
                          <path d="M15 3.5a9 9 0 0 1 5.5 5.5h-4.5a1 1 0 0 1 -1 -1v-4.5"/>
                        </svg>                            </span>
                                                        <span class="nav-link-title">
                                                            Reports
                                                        </span>
                                                    </a>
                                                </li>


                    </ul>
                    <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                        <div>
                            <span class="badge bg-success-lt">{{ config('env.APP_EXPIRY_DATE') }}</span>
                            &nbsp;/&nbsp;
                            <span class="badge bg-secondary-lt">
                                 App Ver.: {{ config('env.APP_VERSION') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            @yield('content')
        </div>
        <footer class="footer footer-transparent d-print-none">
            <div class="container-xl">
                <div class="row text-center align-items-center flex-row-reverse">
                    <div class="col-lg-auto ms-lg-auto">
                        <ul class="list-inline list-inline-dots mb-0">

                            <li class="list-inline-item">
                                <a href="https://github.com/ravensborn" target="_blank" class="link-secondary"
                                   rel="noopener">
                                    Developer Website
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                Copyright &copy; {{ date('Y') }}
                                <a href="." class="link-secondary">{{ config('env.APP_NAME') }}</a>.
                                All rights reserved.
                            </li>
                            <li class="list-inline-item">
                                {{ config('env.APP_VERSION') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<script src="{{ asset('theme/js/tabler.min.js') }}" defer></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const themeSwitch = document.getElementById('bd-theme');
        themeSwitch.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            document.documentElement.setAttribute('data-bs-theme', newTheme);

            const darkThemeAssetUrl = newTheme === 'dark' ? 'https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5.0.15/dark.min.css' : '{{ asset('theme/empty.css') }}';
            const sweetalertDarkThemeElement = document.head.querySelector('#sweetalert-dark-theme');
            sweetalertDarkThemeElement.setAttribute('href', darkThemeAssetUrl);

            const sweetAlertToastPatchAssetUrl = newTheme === 'dark' ? '{{ asset('theme/sweet-alert-toast-dark-theme-patch.css') }}' : '{{ asset('theme/empty.css') }}';
            console.log(sweetAlertToastPatchAssetUrl);
            const sweetalertToastPathDarkThemeElement = document.head.querySelector('#sweetalert-toast-dark-theme-patch');
            sweetalertToastPathDarkThemeElement.setAttribute('href', sweetAlertToastPatchAssetUrl);

            localStorage.setItem('theme', newTheme);
        });
    });
</script>

<script>


</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<x-livewire-alert::scripts/>

</body>
</html>
