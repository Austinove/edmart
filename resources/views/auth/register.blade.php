@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                                <label for="exampleFormControlInput1" class="small-text custom-color">Image(<span class="font-italic">Optional</span>)</label>
                                <div class="custom-file pointer">
                                    <input type="file" name="image" class="image custom-file-input" id="customFileLang" lang="en">
                                    <label class="custom-file-label form-control-alternative" for="customFileLang">Select Image</label>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleFormControlInput1" class="small-text custom-color">User Type</label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="worker" name="userType" required value="worker" class="custom-control-input">
                                    <label class="custom-control-label custom-color font-italic font-weight-light" for="worker">Worker</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="hr" name="userType" required value="hr" class="custom-control-input">
                                    <label class="custom-control-label custom-color font-italic font-weight-light" for="hr">Human Resource</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="admin" name="userType" required value="admin" class="custom-control-input">
                                    <label class="custom-control-label custom-color font-italic font-weight-light" for="admin">Admin</label>
                                </div>
                            </div>
                            <div class="alert alert-default custom-bg" role="alert">
                                <strong>Cation!! </strong>
                                <div>
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
    </div>
</div>
@endsection
