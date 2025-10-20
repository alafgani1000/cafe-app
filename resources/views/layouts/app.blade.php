<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Caffe Management') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
        </style>

        <!-- Custom styles for this template -->
        <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
        <!-- Custom styles for this template -->
         <!-- Styles -->
         <script src="{{ mix('js/app.js') }}"></script>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
        <link rel="stylesheet" href="{{ asset('css/headers.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navbar-top-fixed.css') }}">
        <link res="stylesheet" href="{{ asset('fa/css/all.min.css') }}">
        <link res="stylesheet" href="{{ asset('DataTables/datatables.css') }}">
        <style>
            .header-color {
                background-color: #FB743E;
            }
            .header-border {
                border-bottom: 5px solid #383E56;
            }
            #header {
                font-size:18px;
            }
            a:hover {
                background-color: #383E56;
            }
            .card-header-color {
                background-color: #383E56;
            }

            body {
                font-family: 'Open Sans', sans-serif;
            }

            .help-validate {
                color: red;
                font-size: 14px;
            }

            .header-data {
                font-size: 16px;
            }

            .isi {
                font-size:14px !important;
            }

            .padding-menu {
                margin-top: 20px;
            }
        </style>
        @stack('scripts')
    </head>
    <body class="body-bg-color">
        <nav class="container">
            <header>
                <div id="header" class="px-3 py-2 text-white fixed-top header-color header-border">
                    <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                        <a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                            {{-- <img src="{{ asset('assets/logo1.png') }}" /> --}}
                            Caffe App
                        </a>
                        <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                            @role('pramusaji|pramuniaga')

                                <li>
                                    <a href="{{ route('list-menu') }}" class="nav-link text-white">
                                        Home
                                    </a>
                                </li>
                                @foreach ($categories as $category )
                                     <a href="{{ route('menus', [$category->id, $category->name]) }}" class="nav-link text-white">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            @endrole

                            @role('payment')
                                <li>
                                    <a href="{{ route('payment.index') }}" class="nav-link text-white">
                                    <i class="fas fa-money-bill bi d-block mx-auto mb-1"></i>
                                    Payments
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('order.index') }}" class="nav-link text-white">
                                    <i class="fas fa-shopping-basket bi d-block mx-auto mb-1"></i>
                                    Orders
                                    </a>
                                </li>
                            @endrole

                            @role('admin')
                                <li>
                                    <a href="#" class="nav-link text-white">
                                    Dashboard
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <a href="#" class="nav-link text-white dropdown-toggle" id="dropdownNavLink" data-bs-toggle="dropdown" aria-expanded="false">
                                            Reports
                                        </a>
                                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownNavLink">
                                        <li><a class="dropdown-item" href="{{ route('report.view.monthly') }}" aria-current="page">Sale</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="{{ route('payment.index') }}" class="nav-link text-white">
                                        Payments
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('order.index') }}" class="nav-link text-white">
                                        Orders
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('employee.index') }}" class="nav-link text-white">
                                        Employees
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <a href="#" class="nav-link text-white dropdown-toggle" id="dropdownNavLink" data-bs-toggle="dropdown" aria-expanded="false">
                                            Master Data
                                        </a>
                                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownNavLink">
                                        <li><a class="dropdown-item" href="{{ route('category.index') }}" aria-current="page">Categories</a></li>
                                        <li><a class="dropdown-item" href="{{ route('menu.index') }}">Menu</a></li>
                                        <li><a class="dropdown-item" href="{{ route('table.index') }}">Room or Table</a></li>
                                        <li><a class="dropdown-item" href="{{ route('cafe.index') }}">Profile Cafe</a></li>
                                        <li><a class="dropdown-item" href="{{ route('user.index') }}">User Config</a></li>
                                        </ul>
                                    </div>
                                </li>
                            @endrole
                            <li>
                                <div class="dropdown">
                                    <a href="#" class="nav-link text-white dropdown-toggle" id="dropdownNavLink" data-bs-toggle="dropdown" aria-expanded="false">

                                        {{ Str::ucfirst(Auth::user()->name) }}
                                    </a>
                                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownNavLink">
                                        <li><a class="dropdown-item active" href="#" aria-current="page">Profile</a></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout-process') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item" id="logout">Logout</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
            </header>
        </nav>

        <main class="container">
          @yield('content')
        </main>


        <footer class="container" style="margin-top:10px">
            <p>Created by <a href="https://selaicoding.com">selaicoding.com</a> Template by <a href="https://twitter.com/mdo">@mdo</a> Bootstrap.</p>
        </footer>
        <script>

        </script>
        <script src="{{ asset('fa/js/all.min.js') }}"></script>
        <script src="{{ asset('DataTables/datatables.js') }}"></script>
        <script src="{{ asset('bootbox/bootbox.all.min.js') }}"></script>
    </body>

</html>
