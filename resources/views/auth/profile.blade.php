@section('dynamic-js')
    <script src="{{ asset('/assets/js/user.js')}}"></script>
@stop
@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="ml-2 col-md-4">
          <div class="card card-profile">
            <img src="{{ asset('/assets/img/theme/img-1-1000x600.jpg') }}" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#" data-toggle="modal" data-target="#profileImage">
                    <img src={{ asset("profiles/".Auth()->user()->image) }} class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body pt-7">
              <div class="text-left">
                <h5 class="h3 small-text">
                  Email
                </h5>
                <div class="h5 font-weight-300">
                    {{Auth()->user()->email}}
                </div>
                <h5 class="h3 small-text">
                  User Name
                </h5>
                <div class="h5 font-weight-300">
                    {{Auth()->user()->name}}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0 custom-color">Edit profile </h3>
                </div>
                <div class="col-4 text-right">
                    <a href="#" class="btn btn-sm btn-primary btn-bg btn-togleForm">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                        <span class="togleForm">Change password</span>
                    </a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form id="userInfo" enctype="multipart/form-data">
                @csrf
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Username</label>
                        <input name="name" value="{{Auth()->user()->name}}" type="text" id="input-username" class="form-control form-control-alternative" placeholder="Username">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input name="email" value="{{Auth()->user()->email}}" type="email" id="input-email" class="form-control form-control-alternative" placeholder="bryan@example.com">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Image</label>
                        <div class="custom-file pointer">
                            <input name="image" type="file" class="custom-file-input" id="customFileLang" lang="en">
                            <label class="custom-file-label form-control-alternative" for="customFileLang">Select file</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group" style="margin-top: 30px;">
                        <button type="submit" class="btn btn-md font-weight-light custom-btn info-btn"><i class="fa fa-save"></i> Save Changes</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <form id="changePassword" class="toggleForms">
                @csrf
                <h6 class="heading-small text-muted mb-4">User Password</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">New Password</label>
                        <input required type="password" id="password" class="form-control form-control-alternative" placeholder="********">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Confirm Password</label>
                        <input required type="password" name="password" id="confirmPassword" class="form-control form-control-alternative" placeholder="********">
                        <span class=" passwordError" style="color: red; font-size: 12px;"></span>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group" style="margin-top: 30px;">
                        <button type="submit" id="password-btn" class="btn btn-md font-weight-light custom-btn"><i class="fa fa-save"></i> Save Password</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
@endsection