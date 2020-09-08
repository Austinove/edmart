@section('dynamic-js')
    <script src="{{ asset('assets/js/tasks/main.js') }}"></script>
    <script src="{{ asset('assets/js/tasks/tasks.js') }}"></script>
@stop
@extends('layouts.app')
@section('content')
    <div class="header">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="card custom-card">
                            {{-- <img class="card-img-top" src="{{asset('assets/img/edmart_logo.jpg')}}" alt="edmart logo" /> --}}
                            <div class="card-body">
                                <h5 class="card-title">Project Title</h5>
                                <p class="card-text">description of project</p>
                                <a href="#" class="btn btn-outline-secondary custom-btn-black btn-sm">More...</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="card custom-card">
                            {{-- <img class="card-img-top" src="{{asset('assets/img/edmart_logo.jpg')}}" alt="edmart logo" /> --}}
                            <div class="card-body">
                                <h5 class="card-title">Project Title</h5>
                                <p class="card-text">description of project</p>
                                <a href="#" class="btn btn-outline-secondary custom-btn-black btn-sm">More...</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="card custom-card">
                            {{-- <img class="card-img-top" src="{{asset('assets/img/edmart_logo.jpg')}}" alt="edmart logo" /> --}}
                            <div class="card-body">
                                <h5 class="card-title">Project Title</h5>
                                <p class="card-text">description of project</p>
                                <a href="#" class="btn btn-outline-secondary custom-btn-black btn-sm">More...</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="card custom-card">
                            {{-- <img class="card-img-top" src="{{asset('assets/img/edmart_logo.jpg')}}" alt="edmart logo" /> --}}
                            <div class="card-body">
                                <h5 class="card-title">Project Title</h5>
                                <p class="card-text">description of project</p>
                                <a href="#" class="btn btn-outline-secondary custom-btn-black btn-sm">More...</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
