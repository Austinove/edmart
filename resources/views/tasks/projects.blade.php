@section('dynamic-js')
    <script src="{{ asset('assets/js/tasks/main.js') }}"></script>
    <script src="{{ asset('assets/js/tasks/tasks.js') }}"></script>
@stop
@extends('layouts.app')
@section('content')
    <div class="header">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-md-12">
                        <span class="custom-color font-weight-bold d-inline-block mb-0">Projects</span>
                        <div class="btn-group ml-4" role="group" aria-label="Basic example">
                            <button type="button" class="active btn btn-sm btn-secondary"><i class="fa fa-arrow-circle-left mr-2" aria-hidden="true"></i> Pending ones</button>
                            <button type="button" class="btn btn-sm btn-secondary">Closed ones <i class="fa fa-arrow-circle-right ml-2" aria-hidden="true"></i></button>
                        </div>
                        <button class="btn btn-outline-secondary custom-btn btn-sm float-right mb-2 add-expence">
                            <i class="fa fa-plus"></i>
                            <span class="togglexpe">Create Project</span>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="card custom-card">
                            <div class="card-body">
                                <h5 class="custom-color ">#48YAA78</h5>
                                <a href="{{route('project-expenses')}}" class="project-add-exp btn-light btn-sm float-left"><i class="fa fa-plus-circle" aria-hidden="true"></i> expense</a>
                                <div class="mb-2">
                                    <h5 class="card-title mb-0">Customer</h5>
                                    <p class="card-text font-13 custom-color">Post Bank (U) LTD</p>
                                </div>
                                <div class="mb-2">
                                    <h5 class="card-title mb-0">Assistant Project Manager</h5>
                                    <p class="card-text font-13">Mr: Pinyi Othieno Eria</p>
                                </div>
                                <div class="mb-2">
                                    <h5 class="card-title mb-0">Project Title</h5>
                                    <p class="card-text font-13">Tables are slightly adjusted to style, collapse borders, and ensure consistent...</p>
                                </div>
                                <div class="mb-2">
                                    <h5 class="card-title mb-0">Commencement Date</h5>
                                    <p class="card-text font-13">08/09/2020, 9:30 am</p>
                                </div>
                                <div class="mb-2">
                                    <h5 class="card-title mb-0">Completion Date</h5>
                                    <p class="card-text font-13">08/10/2020, 9:30 am</p>
                                </div>
                                <hr class="mb-1 mt-3"/>
                                <div class="row mb-2">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h5 class="card-title mb-0">Current Expenses</h5>
                                        <p class="card-text"><span class="badge badge-warning">3,000,000 UGX</span></p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h5 class="card-title mb-0">Expected Amount</h5>
                                        <p class="card-text"><span class="badge badge-success">3,000,000 UGX</span></p>
                                    </div>
                                </div>
                                <hr class="mb-1 mt-1"/>
                                <div class="progress-wrapper">
                                    <div class="progress-info">
                                        <div class="progress-label">
                                            <span>days used</span>
                                        </div>
                                        <div class="progress-percentage">
                                            <span class="font-13">60%</span>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"></div>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-outline-secondary custom-btn-black btn-sm float-right">More...</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
