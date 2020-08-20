@section('dynamic-js')
    <script src="{{ asset('/assets/js/expenses.js')}}"></script>
@stop
@extends('layouts.app')
@section('content')
    <div class="header">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-md-12">
              <span class="custom-color font-weight-bold d-inline-block mb-0">Expenses</span>
              <button class="btn btn-outline-secondary custom-btn btn-sm float-right mb-2 add-expence">
                    <i class="fa fa-plus"></i>
                    <span class="togglexpe">Add Expense</span>
                </button>
            </div>
          </div>
          <!-- Card stats -->
          <div class="row expense-inputs toggleForms">
                <div class="col-md-4">
                    <form id="exp-formList" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <I class="text-danger font-12 checker-list"></I>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1" class="small-text">Title <span class="error">*</span></label>
                                    <input required name="title" id="title" type="text" class="title form-control-sm form-control form-control-alternative">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1" class="small-text">Description <span class="error">*</span></label>
                                    <textarea required name="desc" class="desc form-control-sm form-control form-control-alternative" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5 col-sm-5">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1" class="small-text">Quantity <span class="error">*</span></label>
                                            <div class="bg-secondary">
                                                <input required name="quantity" min="1" type="number" class="quantity form-control-sm form-control form-control-alternative" placeholder="e.g 2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-5">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1" class="small-text">Units <span class="error">*</span></label>
                                            <div class="bg-secondary selectInput">
                                                <select name="units" class="units form-control-sm form-control form-control-alternative" required>
                                                    <option value="pc">Pcs</option>
                                                    <option value="roll">Rolls</option>
                                                    <option value="doz">Doz</option>
                                                    <option value="pkt">Pkt</option>
                                                    <option value="Kg">Kg</option>
                                                    <option value="rims">Rims</option>
                                                    <option value="specify"> Others </option>
                                                </select>
                                            </div>
                                            <div class="bg-secondary d-none specifyInput">
                                                <input required name="specify" class="specify form-control-sm form-control form-control-alternative" placeholder="specify">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5 col-sm-5">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1" class="small-text">Rate <span class="error">*</span></label>
                                            <div class="bg-secondary">
                                                <input required name="rate" min="1" type="number" class="rate form-control-sm form-control form-control-alternative" placeholder="e.g 20000">
                                                <span style="display: none" class="user-type small-text">{{Auth()->user()->userType}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-5">
                                        <div class="form-group" style="margin-top: 30px;">
                                            <button data-id="0" data-edit="no" id="add-list"  class="btn-sm btn btn-outline-secondary mt-2 custom-btn btn-md">
                                                <i class="fa fa-plus"></i>
                                                Add to List
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-7 mt-3">
                        <span class="small-text custom-color mb-0 title">
                            <strong>Title:</strong>
                            <span class="title-text td-text"></span>
                        </span>
                    </div>
                    <div class="col-md-5 mt-3">
                        <span class="float-left small-text mr-4">Total Amount: 
                            <strong class="total custom-color">0</strong>
                        </span>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="tableFixHead">
                        <div class="scrollbar-inner">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="custom-color custom-th">S/N</th>
                                        <th scope="col" class="custom-color custom-th">Item</th>
                                        <th scope="col" class="custom-color custom-th">Qty</th>
                                        <th scope="col" class="custom-color custom-th">Unit</th>
                                        <th scope="col" class="custom-color custom-th">Rate</th>
                                        <th scope="col" class="custom-color custom-th">Amount</th>
                                        <th scope="col" class="custom-color custom-th"></th>
                                    </tr>
                                </thead>
                                <tbody class="expences-list"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <button id="exp-btn" data="request" user-type={{Auth()->user()->userType}} class="float-right btn-sm btn btn-outline-secondary mt-3 mb-3 custom-btn">
                            <i class="fa fa-arrow-right"></i>
                            Request
                        </button>
                    </div>
                </div>
            </div>
          </div>

          <div class="row expenses-contents">
            <div class="col-md-12">
                <I class="text-danger font-12 checker"></I>
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item mt-4">
                            <a class="nav-link custom-nav-link  active" id="pending-pill" data-toggle="pill" href="#pending-exp" role="tab" aria-controls="pending-exp" aria-selected="true">
                                Pending Requests<span class="badge badge-pending custom-badge badge-default"></span>
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link custom-nav-link" id="cancel-pill" data-toggle="pill" href="#cancel-req" role="tab" aria-controls="cancel-req" aria-selected="false">
                                Cancelled<span class="badge badge-cancelled custom-badge badge-default"></span>
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link custom-nav-link" id="approved-pill" data-toggle="pill" href="#approved-req" role="tab" aria-controls="approved-req" aria-selected="false">
                                Approved<span class="badge badge-approved custom-badge badge-default"></span>
                            </a>
                        </li>
                        @if (Auth::user())
                            @if((Auth()->user()->userType==="hr"))
                                <li class="nav-item mt-4">
                                    <a class="nav-link custom-nav-link" id="exp-requests-pill" data-toggle="pill" href="#exp-requests" role="tab" aria-controls="exp-requests" aria-selected="false">
                                        Expenses Requests<span class="badge badge-hr badge-requests custom-badge badge-default"></span>
                                    </a>
                                </li>
                                <li class="nav-item mt-4">
                                    <a class="nav-link custom-nav-link" id="accepted-pill" data-toggle="pill" href="#accepted-req" role="tab" aria-controls="accepted-req" aria-selected="false">
                                        Accepted<span class="badge badge-accepted custom-badge badge-default"></span>
                                    </a>
                                </li>
                            @endif
                        @endif
                        @if (Auth::user())
                            @if((Auth()->user()->userType==="admin"))
                                <li class="nav-item mt-4">
                                    <a class="nav-link custom-nav-link" id="recommend-pill" data-toggle="pill" href="#recommend-req" role="tab" aria-controls="recommend-req" aria-selected="false">
                                        Recommended<span class="badge badge-recommend badge-recommend custom-badge badge-default"></span>
                                    </a>
                                </li>
                            @endif
                        @endif
                        @if (Auth::user())
                            @if((Auth()->user()->userType==="admin")||(Auth()->user()->userType==="hr"))
                                <li class="nav-item mt-4">
                                    <a class="nav-link custom-nav-link" id="all-pill" data-toggle="pill" href="#all-req" role="tab" aria-controls="all-req" aria-selected="false">
                                        Expenses<span class="badge badge-all custom-badge badge-default"></span>
                                    </a>
                                </li>
                            @endif
                        @endif
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <hr/>
                        <div class="tab-pane fade show active" id="pending-exp" role="tabpanel" aria-labelledby="pending-pill">
                            <h5 class="mb-4 custom-color">Pending Expenses Requests</h5>
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
                                    {{-- Expenses are from jQuery --}}
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
                                {{-- Expenses are from jQuery --}}
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
                                            {{-- expenses from jQuery --}}
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
                                </div>
                                <div class="tab-pane fade" id="accepted-req" role="tabpanel" aria-labelledby="accepted-pill">
                                    <div class="row">
                                        <div class="col-md-4"><h5 class="mb-4 custom-color">accepted Expense Requests</h5></div>
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
                                            {{-- expenses from jQuery --}}
                                            <tbody class="list admin-accepted"></tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @endif
                        @if (Auth::user())
                            @if ((Auth()->user()->userType==="hr")||(Auth()->user()->userType==="admin"))
                                <div class="tab-pane fade" id="all-req" role="tabpanel" aria-labelledby="all-pill">
                                    <a href="" style="margin-top: -30px;" class="print-btn btn btn-sm custom-btn float-right mr-0"><i class="fa fa-print" aria-hidden="true"></i></a>
                                    <div class="row">
                                        <div class="col-md-4"><h5 class="mb-4 custom-color">Total Amount Approved: <strong class="total-amount"> 0</strong> UGX</h5></div>
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