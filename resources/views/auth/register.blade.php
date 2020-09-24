@section('dynamic-js')
    <script src="{{ asset('/assets/js/user.js?v=1.0')}}"></script>
@stop
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header font-weight-bold custom-color">Register New Users</div>
                <div class="row">
                    <div class="card-body col-md-8 ml-auto mr-auto">
                        <form id="registration-form">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="exampleFormControlInput1" class="small-text custom-color">User Name</label>
                                <input class="name form-control form-control-alternative @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="false" autofocus placeholder="User Name" type="text">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleFormControlInput1" class="small-text custom-color">Email</label>
                                <input class="email form-control form-control-alternative @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email" type="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleFormControlInput1" class="small-text custom-color">Image (<span class="font-italic"> Optional </span>)</label>
                                <div class="custom-file pointer">
                                    <input type="file" name="image" class="image custom-file-input" id="customFileLang" lang="en">
                                    <label class="custom-file-label form-control-alternative" for="customFileLang">Select Image</label>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleFormControlInput1" class="small-text">
                                    User Type
                                    <span class="error">*</span>
                                </label><br>
                                <a href="#" class="return-selection d-none">
                                    <U><I class="font-12">Select again</I></U>
                                </a>
                                <div class="bg-secondary selectInput">
                                    <select name="userType" class="userType form-control form-control form-control-alternative" required>
                                        <option value="">Select user type</option>
                                        <option value="worker">Worker</option>
                                        <option value="hr">Human Resource</option>
                                        <option value="admin">Administrator</option>
                                    </select>
                                </div>
                                <div class="bg-secondary d-none positionInput">
                                    <span class="error error-user"></span>
                                    <input name="position" class="position form-control form-control form-control-alternative" placeholder="Enter worker's position">
                                </div>
                            </div>
                            <div class="alert alert-default custom-bg" role="alert">
                                <strong class="font-13">Cation!! </strong>
                                <div class="font-13">
                                    By default password will be <strong> "password" </strong> without spaces
                                </div>
                            </div>

                            <div class="text-left">
                            <button type="submit" id="register-btn" class="btn btn-outline-primary my-4 btn-md custom-btn">Register User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header font-weight-bold custom-color">Current Users <span class="badge badge-users custom-badge badge-default font-weight-bold"></span></div>
                {{-- Users are fro jQuery --}}
                <div class="row users-container"></div>
            </div>
        </div>
    </div>
</div>
@endsection
