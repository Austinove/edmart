@section('dynamic-js')
    <script src="{{ asset('/assets/js/expenses.js')}}"></script>
@stop
@extends('layouts.app')
@section('content')
    <div class="header pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-md-12">
              <span class="custom-color font-weight-bold d-inline-block mb-0">Expences</span>
              <button class="btn btn-outline-secondary custom-btn btn-sm float-right mb-2 add-expence">
                    <i class="fa fa-plus"></i>
                    <span class="togglexpe">Add Expence</span>
                </button>
            </div>
          </div>
          <!-- Card stats -->
          <form class="form-expences toggleForms" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="small-text">Expence Description</label>
                        <textarea name="desc" class="desc form-control form-control-alternative" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleFormControlInput1" class="small-text">Amount</label>
                        <div class="bg-secondary">
                            <input name="amount" type="number" class="amount form-control form-control-alternative" placeholder="e.g 20000">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" style="margin-top: 30px;">
                        <button id="exp-btn" data="request" class="btn btn-outline-secondary mb-0 custom-btn btn-md">
                            <i class="fa fa-arrow-right"></i>
                            Request
                        </button>
                    </div>
                </div>
            </div>
        </form>
          <div class="row">
            <div class="col-md-12">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item mt-4">
                            <a class="nav-link custom-nav-link  active" id="pending-pill" data-toggle="pill" href="#pending-exp" role="tab" aria-controls="pending-exp" aria-selected="true">
                                Pending Expences Requests<span class="badge badge-pending custom-badge badge-default"></span>
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link custom-nav-link" id="cancel-pill" data-toggle="pill" href="#cancel-req" role="tab" aria-controls="cancel-req" aria-selected="false">
                                Cancelled Requests<span class="badge badge-cancelled custom-badge badge-default"></span>
                            </a>
                        </li>
                        @if (Auth::user())
                            @if((Auth()->user()->userType==="hr"))
                                <li class="nav-item mt-4">
                                    <a class="nav-link custom-nav-link" id="exp-requests-pill" data-toggle="pill" href="#exp-requests" role="tab" aria-controls="exp-requests" aria-selected="false">
                                        Expences Requests<span class="badge badge-hr badge-requests custom-badge badge-default"></span>
                                    </a>
                                </li>
                            @endif
                        @endif
                        @if (Auth::user())
                            @if((Auth()->user()->userType==="admin"))
                                <li class="nav-item mt-4">
                                    <a class="nav-link custom-nav-link" id="recommend-pill" data-toggle="pill" href="#recommend-req" role="tab" aria-controls="recommend-req" aria-selected="false">
                                        Recommended Expences<span class="badge badge-recommend badge-recommend custom-badge badge-default"></span>
                                    </a>
                                </li>
                            @endif
                        @endif
                        <li class="nav-item mt-4">
                            <a class="nav-link custom-nav-link" id="approved-pill" data-toggle="pill" href="#approved-req" role="tab" aria-controls="approved-req" aria-selected="false">
                                Approved Expences<span class="badge badge-approved custom-badge badge-default"></span>
                            </a>
                        </li>
                        @if (Auth::user())
                            @if((Auth()->user()->userType==="admin")||(Auth()->user()->userType==="hr"))
                                <li class="nav-item mt-4">
                                    <a class="nav-link custom-nav-link" id="all-pill" data-toggle="pill" href="#all-req" role="tab" aria-controls="all-req" aria-selected="false">
                                        All<span class="badge badge-all badge-all custom-badge badge-default"></span>
                                    </a>
                                </li>
                            @endif
                        @endif
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <hr/>
                        <div class="tab-pane fade show active" id="pending-exp" role="tabpanel" aria-labelledby="pending-pill">
                            <h5 class="mb-4 custom-color">Pending Requests</h5>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">Description</th>
                                        <th scope="col" class="sort" data-sort="budget">Budget</th>
                                        <th scope="col" class="sort" data-sort="status">Status</th>
                                        <th scope="col" class="sort" data-sort="completion">Date</th>
                                        <th scope="col" class="sort">Actions</th>
                                    </tr>
                                    </thead>
                                    {{-- Expences are from jQuery --}}
                                    <tbody class="list pending-expence"></tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="cancel-req" role="tabpanel" aria-labelledby="cancel-pill">
                            <h5 class="mb-4 custom-color">Cancelled Expense Requests</h5>
                            <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Description</th>
                                    <th scope="col" class="sort" data-sort="budget">Budget</th>
                                    <th scope="col" class="sort" data-sort="completion">Date</th>
                                </tr>
                                </thead>
                                {{-- Expences are from jQuery --}}
                                <tbody class="list cancelled-expence"></tbody>
                            </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="approved-req" role="tabpanel" aria-labelledby="approved-pill">
                            <div class="row">
                                <div class="col-md-4"><h5 class="mb-4 custom-color">Approved Expense Requests</h5></div>
                                <div class="col-md-3"></div>
                                <div class="form-group col-md-5">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6"><input class="form-control form-control-sm month" type="month" value="2018-11" id="example-month-input"></div>
                                        <button class="btn btn-sm custom-btn-default text-left ml-2 retrieve">Retrieve <i class="fa fa-check" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">Description</th>
                                        <th scope="col" class="sort" data-sort="budget">Budget</th>
                                        <th scope="col" class="sort" data-sort="status">User</th>
                                        <th scope="col" class="sort" data-sort="completion">Date</th>
                                    </tr>
                                    </thead>
                                    {{-- data is retrieven from jQuery --}}
                                    <tbody class="list approved-expenses"></tbody>
                                </table>
                            </div>
                        </div>

                        @if (Auth::user())
                            @if((Auth()->user()->userType==="admin"))
                                <div class="tab-pane fade" id="recommend-req" role="tabpanel" aria-labelledby="recommend-pill">
                                    <div class="row">
                                        <div class="col-md-4"><h5 class="mb-4 custom-color">Recommended Expense Requests</h5></div>
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name">Description</th>
                                                <th scope="col" class="sort" data-sort="budget">Budget</th>
                                                <th scope="col" class="sort" data-sort="status">User</th>
                                                <th scope="col" class="sort" data-sort="completion">Date</th>
                                                <th scope="col" class="sort">Actions</th>
                                            </tr>
                                            </thead>
                                            {{-- expences from jQuery --}}
                                            <tbody class="list admin-recommended"></tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @endif

                        @if (Auth::user())
                            @if((Auth()->user()->userType==="hr"))
                                <div class="tab-pane fade" id="exp-requests" role="tabpanel" aria-labelledby="exp-requests-pill">
                                    <h5 class="mb-4 custom-color">Expense Requests</h5>
                                    <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name">Description</th>
                                            <th scope="col" class="sort" data-sort="budget">Budget</th>
                                            <th scope="col" class="sort" data-sort="status">User</th>
                                            <th scope="col" class="sort" data-sort="completion">Date</th>
                                            <th scope="col" class="sort">Actions</th>
                                        </tr>
                                        </thead>
                                        {{-- Requests from jQuery --}}
                                        <tbody class="list hr-pending-requests"></tbody>
                                    </table>
                                </div>
                            @endif
                        @endif
                        @if (Auth::user())
                            @if ((Auth()->user()->userType==="hr")||(Auth()->user()->userType==="admin"))
                                <div class="tab-pane fade" id="all-req" role="tabpanel" aria-labelledby="all-pill">
                                    <div class="row">
                                        <div class="col-md-4"><h5 class="mb-4 custom-color">All Expences Approved</h5></div>
                                        <div class="col-md-3"></div>
                                        <div class="form-group col-md-5">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6"><input class="form-control form-control-sm month-all" type="month" value="2018-11" id="example-month-input"></div>
                                                <button class="btn btn-sm custom-btn-default text-left ml-2 retrieve-all">Retrieve <i class="fa fa-check" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name">Description</th>
                                                <th scope="col" class="sort" data-sort="budget">Budget</th>
                                                <th scope="col" class="sort" data-sort="status">User</th>
                                                <th scope="col" class="sort" data-sort="completion">Date</th>
                                            </tr>
                                            </thead>
                                            {{-- data is retrieven from jQuery --}}
                                            <tbody class="list all-expenses"></tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                            
                        @endif
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection