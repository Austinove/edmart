<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('/assets/img/favicon.png')}}" type="image/png">
    <title>EDMART SYSTEM</title>
    
    <link rel="stylesheet" href="{{ asset('/assets/css/argon.css?v=1.2.0') }}"  type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets/css/custom.css') }}"  type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="{{ asset('/assets/font-awesome4.7.0/css/font-awesome.min.css')}}">
    
</head>
<body>
    <div id="app">
        <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
            <div class="scrollbar-inner">
                <button type="button" class="d-xl-none pr-3 mt-2 sidenav-toggler sidenav-toggler-dark close" data-action="sidenav-pin" data-target="#sidenav-main" aria-label="Close">
                    <span aria-hidden="true" class="custom-close">&times;</span>
                </button>
                <!-- Brand -->
                <div class="sidenav-header  align-items-center">
                    <a class="navbar-brand" href="javascript:void(0)">
                    <img src="{{ asset('/assets/img/edmart_logo.jpg') }}" class="navbar-brand-img" alt="EDMART Logo">
                        {{-- <span class="small-text">MART SYSTEMS</span> --}}
                    </a>
                </div>
                <div class="navbar-inner">
                    <!-- Collapse -->
                    <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                        <!-- Nav items -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                            <a {!! Request::is('dashboard') ? 'class="nav-link active"' : 'class="nav-link"' !!} href="dashboard">
                                <i class="fa fa-align-center" aria-hidden="true"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                            </li>
                            
                        </ul>
                        @if((Auth()->user()->userType==="admin")||(Auth()->user()->userType==="hr"))
                            <hr class="my-3">
                            <!-- Heading -->
                            <h6 class="navbar-heading p-0 text-muted">
                                <span class="docs-normal">Company Tasks</span>
                            </h6>
                            <!-- Navigation -->
                            <ul class="navbar-nav mb-md-3">
                                <li class="nav-item">
                                <a {!! Request::is('projects') ? 'class="nav-link active"' : 'class="nav-link"' !!} href="projects.html">
                                    <i class="fa fa-product-hunt" aria-hidden="true"></i>
                                    <span class="nav-link-text">Projects</span>
                                </a>
                                </li>
                                <li class="nav-item">
                                <a {!! Request::is('table') ? 'class="nav-link active"' : 'class="nav-link"' !!} href="tables.html">
                                    <i class="fa fa-edit"></i>
                                    <span class="nav-link-text">Contracts</span>
                                </a>
                                </li>
                            </ul>
                        @endif

                        <hr class="my-3">
                        <!-- Heading -->
                        <h6 class="navbar-heading p-0 text-muted">
                            <span class="docs-normal">Finance</span>
                        </h6>
                        <!-- Navigation -->
                        <ul class="navbar-nav mb-md-3">
                            <li class="nav-item">
                                <a {!! Request::is('expenses') ? 'class="nav-link active"' : 'class="nav-link"' !!} href="expenses">
                                    <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
                                    <span class="nav-link-text">Expenses</span>
                                </a>
                            </li>
                            @if((Auth()->user()->userType==="admin")||(Auth()->user()->userType==="hr"))
                                <li class="nav-item">
                                    <a {!! Request::is('quatations') ? 'class="nav-link active"' : 'class="nav-link"' !!} href="quatations.html">
                                        <i class="fa fa-book" aria-hidden="true"></i>
                                        <span class="nav-link-text">Quotation</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a {!! Request::is('payments') ? 'class="nav-link active"' : 'class="nav-link"' !!} href="payments.html">
                                        <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                        <span class="nav-link-text">Payments</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a {!! Request::is('lpo') ? 'class="nav-link active"' : 'class="nav-link"' !!} href="lpo.html">
                                        <i class="fa fa-tasks" aria-hidden="true"></i>
                                        <span class="nav-link-text">LPO</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    
                        <!-- Divider -->
                        <hr class="my-3">
                        <!-- Heading -->
                        <h6 class="navbar-heading p-0 text-muted">
                            <span class="docs-normal">Managment Accounts</span>
                        </h6>
                        <!-- Navigation -->
                        <ul class="navbar-nav mb-md-3">
                            <li class="nav-item">
                                <a {!! Request::is('profile') ? 'class="nav-link active"' : 'class="nav-link"' !!} href="profile">
                                    <i class="fa fa-user-md" aria-hidden="true"></i>
                                    <span class="nav-link-text">Profile</span>
                                </a>
                            </li>
                            @if((Auth()->user()->userType==="admin")||(Auth()->user()->userType==="hr"))
                                <li class="nav-item">
                                    <a {!! Request::is('register') ? 'class="nav-link active"' : 'class="nav-link"' !!} href="register">
                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                        <span class="nav-link-text">Accounts Settings</span>
                                    </a>
                                </li>
                            @endif
                        </ul>

                        <hr class="my-3">
                        <!-- Heading -->
                        <h6 class="navbar-heading p-0 text-muted">
                            <span class="docs-normal">Others</span>
                        </h6>
                        <!-- Navigation -->
                        <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                        <a {!! Request::is('attendance') ? 'class="nav-link active"' : 'class="nav-link"' !!} href="attendance">
                            <i class="fa fa-sliders" aria-hidden="true"></i>
                            <span class="nav-link-text">Attendance</span>
                        </a>
                        </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    <div class="main-content" id="panel">
        @include('layouts.navBar')
        <main class="py-2">
            @include('layouts.modal')
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
    </div>

  <script src="{{ asset('/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('/assets/js/notify.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
  {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script> --}}
  {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
 @yield('dynamic-js')
  <script src="{{ asset('/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('/assets/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <!-- Optional JS -->
  <script src="{{ asset('/assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ asset('/assets/vendor/chart.js/dist/Chart.extension.js') }}"></script>
  <!-- Argon JS -->
  <script src="{{ asset('/assets/js/argon.js?v=1.2.0') }}"></script>
</body>
</html>