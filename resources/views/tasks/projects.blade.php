@section('dynamic-js')
    <script src="{{ asset('assets/js/tasks/main.js') }}"></script>
    <script src="{{ asset('assets/js/tasks/projects.js') }}"></script>
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
                            <button type="button" class="btn pending-proj-btn btn-sm btn-secondary active"><i class="fa fa-arrow-circle-left mr-2" aria-hidden="true"></i> Pending</button>
                            <button type="button" class="btn closed-proj-btn btn-sm btn-secondary">Closed<i class="fa fa-arrow-circle-right ml-2" aria-hidden="true"></i></button>
                        </div>
                        <button class="btn btn-neutral project-btn project-add-btn btn-sm float-right mb-2 add-project">
                            <i class="fa fa-plus"></i>
                            <span class="toggleproject">Create Project</span>
                        </button>
                    </div>
                </div>
                <div class="row project-inputs d-none">
                    <div class="col-md-12">
                        <form id="projectForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1" class="small-text">Client Name <span class="error">*</span></label>
                                                <div class="bg-secondary">
                                                    <input required name="client" type="text" class="projectClient form-control-sm form-control form-control-alternative" placeholder="Company name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1" class="small-text">Contract Fee <span class="error">*</span></label>
                                                <div class="bg-secondary">
                                                    <input required name="fee" min="1" type="number" class="projectFee form-control-sm form-control form-control-alternative" placeholder="e.g 20000">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1" class="small-text">Commencement Date <span class="error">*</span></label>
                                                <div class="bg-secondary">
                                                    <input required name="commencement" type="date" class="projectStart form-control-sm form-control form-control-alternative">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1" class="small-text">Completion Date <span class="error">*</span></label>
                                                <div class="bg-secondary">
                                                    <input required name="completion" type="date" class="projectEnd form-control-sm form-control form-control-alternative">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1" class="small-text">Assistant Project Manager <span class="error">*</span></label>
                                                <div class="bg-secondary">
                                                    {{-- data is from jQuery --}}
                                                    <select name="Assmanager" class="Assmanager form-control-sm form-control form-control-alternative">
                                                        <option disabled value="" selected>loading Users ...</option>
                                                    </select>
                                                    <span style="display: none" class="user-type small-text">{{Auth()->user()->userType}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <I class="text-danger font-12 checker-list"></I>
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1" class="small-text">Title <span class="error">*</span></label>
                                                <input required name="title" id="title" type="text" class="projectTitle form-control-sm form-control form-control-alternative">
                                            </div>
                                        </div> 
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1" class="small-text">Description <span class="error">*</span></label>
                                                <textarea required name="desc" class="projectDesc form-control-sm form-control form-control-alternative" id="exampleFormControlTextarea1" rows="6"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 ml-auto">
                                    <div class="form-group float-right">
                                        <button data-id="0" data-edit="no" id="submit-project-btn" type="submit"  class="btn-sm btn btn-outline-secondary mt-2 custom-btn btn-md">
                                            <i class="fa fa-arrow-right"></i>
                                            Submit Project
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="pending-proj-container">
                    <div class="row project-contents">
                        <div class="col-md-6 col-sm-6">
                            {{-- Content from jQuery --}}
                            <div class="card custom-card project-card-content"></div>
                        </div>
                    </div>
                </div>

                <div class="closed-proj-container d-none">
                    <div class="row project-contents">
                        <div class="col-md-6 col-sm-6">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <h5 class="card-title mb-0">Client</h5>
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
                                    <a href="#" class="btn btn-outline-secondary custom-btn-black btn-sm float-right" data-toggle="modal" data-target=".expenses-details">More...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
