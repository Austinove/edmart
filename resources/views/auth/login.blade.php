@extends('layouts.auth')
@section('content')
    <div class="container mt--8 pb-1">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card login-card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <h2 class="custom-color">Login</h2>
              </div>
              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1" class="small-text custom-color">Email</label>
                    <input required class="form-control form-control-alternative @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email" type="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1" class="small-text custom-color">Password</label>
                    <input required class="form-control form-control-alternative @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" type="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} type="checkbox">
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="custom-color">Remember me</span>
                  </label>
                </div>
                <div class="text-left">
                  <button type="submit" class="btn btn-outline-primary my-4 btn-md custom-btn">Sign in</button>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="small-text" style="color: #805624;">
                                <span>Forgot password?</span>
                            </a>
                        @endif
                    </div>
                </div>
              </form>
            </div>
          </div>
          
        </div>
      </div>
    </div>
@endsection


