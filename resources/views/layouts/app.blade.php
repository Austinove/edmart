<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('/assets/img/favicon.png')}}" type="image/png">
    <title>EDMART SYSTEM</title>

    <!-- Scripts -->
    
    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('/assets/css/argon.css?v=1.2.0') }}"  type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets/css/custom.css') }}"  type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    {{-- <link rel="stylesheet" href="{{ asset('/assets/vendor/nucleo/css/nucleo.css" type="text/css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('/assets/font-awesome4.7.0/css/font-awesome.min.css')}}">
    {{-- <link rel="stylesheet" href="{{ asset('/assets/vendor/fortawesome/fontawesome-free/css/all.min.css" type="text/css') }}"> --}}
    <!-- Page plugins -->
    <!-- Argon CSS -->
    

    
</head>
<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    EDMART SYSTEM
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

        <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
            <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header  align-items-center">
                <a class="navbar-brand" href="javascript:void(0)">
                <img src="../assets/img/favicon.png" class="navbar-brand-img" alt="EDMART Logo">
                    <span class="small-text">MART SYSTEMS</span>
                </a>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" href="/dashboard">
                        <i class="fa fa-align-center" aria-hidden="true"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                    </li>
                    
                </ul>
                    
                <hr class="my-3">
                <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Company Tasks</span>
                </h6>
                <!-- Navigation -->
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                    <a class="nav-link" href="profile.html">
                        <i class="fa fa-product-hunt" aria-hidden="true"></i>
                        <span class="nav-link-text">Projects</span>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="tables.html">
                        <i class="fa fa-edit"></i>
                        <span class="nav-link-text">Contracts</span>
                    </a>
                    </li>
                </ul>

                <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">Finance</span>
                    </h6>
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                        <a class="nav-link" href="/expences">
                            <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
                            <span class="nav-link-text">Expences</span>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="tables.html">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            <span class="nav-link-text">Quatation</span>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="profile.html">
                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                            <span class="nav-link-text">Payments</span>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="tables.html">
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                            <span class="nav-link-text">LPO</span>
                        </a>
                        </li>
                        
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
                    <a class="nav-link" href="/profile">
                        <i class="fa fa-user-md" aria-hidden="true"></i>
                        <span class="nav-link-text">Profile</span>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="/register">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                        <span class="nav-link-text">Accounts Settings</span>
                    </a>
                    </li>
                </ul>

                <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">Others</span>
                    </h6>
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                    <a class="nav-link" href="icons.html">
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
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
    </div>

  <script src="{{ asset('/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script>
    $(document).ready(function(){
        // $('.form-expences').addClass('toggleForms');
        $(".add-expence").click(function(e){
            e.preventDefault()
            var toggleText = $('.togglexpe').text();
            if(toggleText === "Add Expence") {
                $('.form-expences').removeClass('toggleForms');
                $(this).html(`
                    <i class="fa fa-arrow-circle-o-left"></i>
                    <span class="togglexpe">Return</span>
                    `);
            }else {
                $(this).html(`
                    <i class="fa fa-plus"></i>
                    <span class="togglexpe">Add Expence</span>
                    `);
                $('.form-expences').addClass('toggleForms');
            }
        });

        // $('#changePassword').addClass('toggleForms');
        $('.btn-togleForm').click(function(e){
            e.preventDefault()
            var toggleText = $('.togleForm').text();
            if(toggleText === "Change password") {
                $('.togleForm').text('User Info')
                $('#userInfo').addClass('toggleForms');
                $('#changePassword').removeClass('toggleForms');
            }else {
                $('.togleForm').text('Change password');
                $('#changePassword').addClass('toggleForms');
                $('#userInfo').removeClass('toggleForms');
            }
        });
    });
  </script>
  {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script> --}}
  <script src="{{ asset('js/app.js') }}"></script>
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
