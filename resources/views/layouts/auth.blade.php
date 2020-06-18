<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('/assets/img/favicon.png')}}" type="image/png">
    <title>EDMART SYSTEM</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/argon.css?v=1.2.0') }}"  type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets/css/custom.css') }}"  type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="{{ asset('/assets/font-awesome4.7.0/css/font-awesome.min.css')}}">
</head>

<body>
  <div class="main-content" style="min-height: 90vh;">
    <div class="header py-3 py-lg-5">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                <h2 class="login-color"> 
                    <img src="../assets/img/favicon.png" height="40px" class="navbar-brand-img" alt="EDMART Logo">
                    <span class="mt-4">MART SYSTEMS</span>
                </h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    @yield('content')
 </div>
    @include('layouts.footer')
  <script src="{{ asset('/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('/assets/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <script src="../assets/js/argon.js?v=1.2.0"></script>
</body>
</html>