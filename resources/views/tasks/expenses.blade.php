@extends('layouts.app')
@section('content')
    <div class="header">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-md-12">
                        <span class="custom-color font-weight-bold d-inline-block mb-0">Expenses</span>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item font-13"><a href="{{route('projects')}}"><i class="fa fa-product-hunt" aria-hidden="true"></i> Projects</a></li>
                                <li class="breadcrumb-item active font-13" aria-current="page">expenses</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-12">
                        <nav class="fluid nav-expenses">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" 
                                    id="nav-home-tab" data-toggle="tab" 
                                    href="#nav-home" 
                                    role="tab" aria-controls="nav-home" 
                                    aria-selected="true">
                                    Requested Expences
                                </a>
                                <a class="nav-item nav-link" 
                                    id="nav-profile-tab" data-toggle="tab" 
                                    href="#nav-profile" role="tab" 
                                    aria-controls="nav-profile" 
                                    aria-selected="false">
                                    Cancelled Expenses
                                </a>
                                <a class="nav-item nav-link" 
                                    id="nav-contact-tab" data-toggle="tab" 
                                    href="#nav-contact" role="tab" 
                                    aria-controls="nav-contact" 
                                    aria-selected="false">
                                    Approved Expenses
                                </a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                Requested Expenses Space
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                Cancelled Expenses Space
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                Approved Expenses Space
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection