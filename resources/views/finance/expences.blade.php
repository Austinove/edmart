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
          <form class="form-expences toggleForms">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="small-text">Expence Description</label>
                        <textarea class="form-control form-control-alternative" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleFormControlInput1" class="small-text">Amount</label>
                        <div class="bg-secondary">
                            <input type="number" class="form-control form-control-alternative" placeholder="e.g 20000">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" style="margin-top: 30px;">
                        <button class="btn btn-outline-secondary mb-0 custom-btn btn-md">
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
                                Pending Expences Requests
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link custom-nav-link" id="accepted-pill" data-toggle="pill" href="#accepted-req" role="tab" aria-controls="accepted-req" aria-selected="false">
                                Accepted Requests
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link custom-nav-link" id="cancel-pill" data-toggle="pill" href="#cancel-req" role="tab" aria-controls="cancel-req" aria-selected="false">
                                Cancelled Requests
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link custom-nav-link" id="exp-requests-pill" data-toggle="pill" href="#exp-requests" role="tab" aria-controls="exp-requests" aria-selected="false">
                                Expences Requests
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link custom-nav-link" id="recommend-pill" data-toggle="pill" href="#recommend-req" role="tab" aria-controls="recommend-req" aria-selected="false">
                                Recommended Expences
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link custom-nav-link" id="approved-pill" data-toggle="pill" href="#approved-req" role="tab" aria-controls="approved-req" aria-selected="false">
                                Approved Expences
                            </a>
                        </li>
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
                                <tbody class="list">
                                <tr>
                                    <td>
                                        TransportTransport
                                    </td>
                                    <td class="budget"> 5000 Ush </td>
                                    <td>
                                    <span class="badge badge-dot mr-4">
                                        <i class="bg-warning"></i>
                                        <span class="status">pending</span>
                                    </span>
                                    </td>
                                    <td> 6/17/2020 </td>
                                    <td class="text-left">
                                    <div class="dropdown-lg">
                                        <a style="font-size: 18px" class="btn btn-sm btn-icon-only text-black" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="#">Resend</a>
                                        <a class="dropdown-item" href="#">Withdraw</a>
                                        <a class="dropdown-item" href="#">Remove</a>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>




                        <div class="tab-pane fade" id="accepted-req" role="tabpanel" aria-labelledby="accepted-pill">
                            <h5 class="mb-4 custom-color">Accepted Requests</h5>
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
                                <tbody class="list">
                                <tr>
                                    <td>
                                        TransportTransport
                                    </td>
                                    <td class="budget"> 5000 Ush </td>
                                    <td>
                                    <span class="badge badge-dot mr-4">
                                        <i class="bg-warning"></i>
                                        <span class="status">pending</span>
                                    </span>
                                    </td>
                                    <td> 6/17/2020 </td>
                                    <td class="text-left">
                                    <div class="dropdown-lg">
                                        <a style="font-size: 18px" class="btn btn-sm btn-icon-only text-black" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="#">Resend</a>
                                        <a class="dropdown-item" href="#">Withdraw</a>
                                        <a class="dropdown-item" href="#">Remove</a>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>




                        <div class="tab-pane fade" id="cancel-req" role="tabpanel" aria-labelledby="cancel-pill">
                            <h5 class="mb-4 custom-color">Cancelled Expence Requests</h5>
                            <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Description</th>
                                    <th scope="col" class="sort" data-sort="budget">Budget</th>
                                    <th scope="col" class="sort" data-sort="completion">Date</th>
                                    <th scope="col" class="sort">Actions</th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                <tr>
                                    <td>
                                        TransportTransport
                                    </td>
                                    <td class="budget"> 5000 Ush </td>
                                    <td> 6/17/2020 </td>
                                    <td class="text-left">
                                    <div class="dropdown-lg">
                                        <a style="font-size: 18px" class="btn btn-sm btn-icon-only text-black" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="#">Resend</a>
                                        <a class="dropdown-item" href="#">Withdraw</a>
                                        <a class="dropdown-item" href="#">Remove</a>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>




                        <div class="tab-pane fade" id="approved-req" role="tabpanel" aria-labelledby="approved-pill">
                            <div class="row">
                                <div class="col-md-4"><h5 class="mb-4 custom-color">Approved Expence Requests</h5></div>
                                <div class="col-md-3"></div>
                                <div class="form-group col-md-5">
                                    <div class="row">
                                        {{-- <div class="col-md-3"><label for="example-month-input" class="form-control-label custom-color mt-2 small-text">Month</label></div> --}}
                                        <div class="col-md-6 col-sm-6"><input class="form-control form-control-sm" type="month" value="2018-11" id="example-month-input"></div>
                                        <button class="btn btn-sm custom-btn-default text-left ml-2">Retrieve <i class="fa fa-check" aria-hidden="true"></i></button>
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
                                        <th scope="col" class="sort">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list">
                                    <tr>
                                        <td>
                                            Transport to NSSF
                                        </td>
                                        <td class="budget"> 5000 Ush </td>
                                        <td>
                                            <span class="status">Bryan Austin</span>
                                        </td>
                                        <td> 6/17/2020 </td>
                                        <td class="text-left">
                                        <div class="dropdown-lg">
                                            <a style="font-size: 18px" class="btn btn-sm btn-icon-only text-black" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="#">Cashout</a>
                                            <a class="dropdown-item" href="#">Remove</a>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="recommend-req" role="tabpanel" aria-labelledby="recommend-pill">
                            <div class="row">
                                <div class="col-md-4"><h5 class="mb-4 custom-color">Recommended Expence Requests</h5></div>
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
                                    <tbody class="list">
                                    <tr>
                                        <td>
                                            Transport to NSSF
                                        </td>
                                        <td class="budget"> 5000 Ush </td>
                                        <td>
                                            <span class="status">Bryan Austin</span>
                                        </td>
                                        <td> 6/17/2020 </td>
                                        <td class="text-left">
                                        <div class="dropdown-lg">
                                            <a style="font-size: 18px" class="btn btn-sm btn-icon-only text-black" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="#">Cashout</a>
                                            <a class="dropdown-item" href="#">Remove</a>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>




                        <div class="tab-pane fade" id="exp-requests" role="tabpanel" aria-labelledby="exp-requests-pill">
                            <h5 class="mb-4 custom-color">Expence Requests</h5>
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
                                <tbody class="list">
                                <tr>
                                    <td>
                                        Transport
                                    </td>
                                    <td class="budget"> 5000 Ush </td>
                                    <td>
                                        <span class="status">Bryan Austin</span>
                                    </td>
                                    <td> 6/17/2020 </td>
                                    <td class="text-left">
                                        <div class="dropdown-lg">
                                            <a style="font-size: 18px" class="btn btn-sm btn-icon-only text-black" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="#">Cashout</a>
                                            <a class="dropdown-item" href="#">Remove</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection