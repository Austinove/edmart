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
                        <span class="custom-color font-weight-bold d-inline-block mb-0">Expenses</span>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item font-13"><a href="{{route('projects')}}"><i class="fa fa-product-hunt" aria-hidden="true"></i> Projects</a></li>
                                <li class="breadcrumb-item active font-13" aria-current="page">expenses</li>
                            </ol>
                        </nav>
                        <button class="btn btn-neutral project-expense project-btn btn-sm float-right mb-2 add-expence">
                            <i class="fa fa-plus"></i>
                            <span class="togglexpe">Add Expense</span>
                        </button>
                    </div>

                    <div class="row expense-inputs d-none">
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
                                                    <br>
                                                    <a href="#" class="return-selection mb-3 d-none">
                                                        <U><I class="font-12">Select again</I></U>
                                                    </a>
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

                    @auth
                        <div class="col-md-12 expenses-contents">
                            <nav class="fluid nav-expenses">
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @if (Auth()->user()->userType !== "admin")
                                        <a class="nav-item nav-link active" 
                                            id="nav-myRequests-tab" data-toggle="tab" 
                                            href="#nav-myRequests" 
                                            role="tab" aria-controls="nav-myRequests" 
                                            aria-selected="true">
                                            My Request
                                        </a>
                                        <a class="nav-item nav-link" 
                                            id="nav-declined-tab" data-toggle="tab" 
                                            href="#nav-declined" role="tab" 
                                            aria-controls="nav-declined" 
                                            aria-selected="false">
                                            Declined
                                        </a>
                                        <a class="nav-item nav-link" 
                                            id="nav-approved-tab" data-toggle="tab" 
                                            href="#nav-approved" role="tab" 
                                            aria-controls="nav-approved" 
                                            aria-selected="false">
                                            Approved
                                        </a>
                                    @endif
                                    @if (Auth()->user()->userType === "hr")
                                        <a class="nav-item nav-link" 
                                            id="nav-submitted-tab" data-toggle="tab" 
                                            href="#nav-submitted" role="tab" 
                                            aria-controls="nav-submitted" 
                                            aria-selected="false">
                                            Submitted
                                        </a>
                                    @endif
                                    @if (Auth()->user()->userType === "admin" || Auth()->user()->userType === "hr")
                                        <a class="nav-item nav-link" 
                                            id="nav-revised-tab" data-toggle="tab" 
                                            href="#nav-revised" role="tab" 
                                            aria-controls="nav-revised" 
                                            aria-selected="false">
                                            Revised
                                        </a>
                                    @endif
                                    @if (Auth()->user()->userType === "admin")
                                        <a class="nav-item nav-link" 
                                            id="nav-recommended-tab" data-toggle="tab" 
                                            href="#nav-recommended" role="tab" 
                                            aria-controls="nav-recommended" 
                                            aria-selected="false">
                                            Recommended
                                        </a>
                                    @endif
                                    @if (Auth()->user()->userType === "hr" || Auth()->user()->position === "Assistant Project Manage")
                                        <a class="nav-item nav-link" 
                                            id="nav-clarify-tab" data-toggle="tab" 
                                            href="#nav-clarify" role="tab" 
                                            aria-controls="nav-clarify" 
                                            aria-selected="false">
                                            Clarify
                                        </a>
                                    @endif
                                    @if (Auth()->user()->userType === "hr")
                                        <a class="nav-item nav-link" 
                                            id="nav-accepted-tab" data-toggle="tab" 
                                            href="#nav-accepted" role="tab" 
                                            aria-controls="nav-accepted" 
                                            aria-selected="false">
                                            Accepted
                                        </a>
                                    @endif
                                    @if (Auth()->user()->userType === "hr" || Auth()->user()->userType === "admin")
                                        <a class="nav-item nav-link" 
                                            id="nav-cashOut-tab" data-toggle="tab" 
                                            href="#nav-cashOut" role="tab" 
                                            aria-controls="nav-cashOut" 
                                            aria-selected="false">
                                            Cash Out
                                        </a>
                                    @endif
                                </div>
                            </nav>

                            <div class="row">
                                <div class="col-md-11 ml-auto mx-auto">
                                    <div class="tab-content" id="nav-tabContent">

                                        @if (Auth()->user()->userType !== "admin")
                                            {{-- My requests content --}}
                                            <div class="tab-pane fade show active" id="nav-myRequests" role="tabpanel" aria-labelledby="nav-myRequests-tab">
                                                <h5 class="mb-3 mt-3 custom-color">Your Expense Requests</h5>
                                                <div class="accordion accordion-expense" id="accordionExample">
                                                    <div class="card mb-2">
                                                        <div class="card-header p-2" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            <h2 class="mb-1 font-13">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                                            </h2>
                                                            <span class="mt-2 font-13">Total: <Strong><span class="badge badge-warning">3,000,000 UGX</span></Strong></span>
                                                            <span class="mt-2 ml-4 font-12 text-mute">Date: 11/09/2020</span>
                                                            <br/>
                                                            <div class="mt-2 float-right">
                                                                <button class="btn btn-outline-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Decline Expense"><i class="fa fa-thumbs-down"></i></button>
                                                                <button class="btn btn-outline-success btn-sm" data-toggle="tooltip" data-placement="top" title="Accept Expense"><i class="fa fa-check"></i></button>
                                                                <button class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Recommend Expense"><i class="fa fa-thumbs-up"></i></button>
                                                                <button class="btn btn-outline-info btn-sm"  data-toggle="tooltip" data-placement="top" title="Recommend Again"><i class="fa fa-check-square-o" aria-hidden="true"></i></button>
                                                                <button class="btn btn-outline-danger btn-sm"  data-toggle="tooltip" data-placement="top" title="Withdraw Expense"><i class="fa fa-times"></i></button>
                                                            </div>
                                                        </div>
                                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table align-items-center table-flush">
                                                                        <thead class="thead-light">
                                                                            <tr>
                                                                            <th scope="col">S/N</th>
                                                                            <th scope="col">ITEM</th>
                                                                            <th scope="col">QTY</th>
                                                                            <th scope="col">UNIT</th>
                                                                            <th scope="col">RATE</th>
                                                                            <th scope="col">AMOUNT</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row" class="text-wrap">1</th>
                                                                                <td class="text-wrap">Routers</td>
                                                                                <td>2</td>
                                                                                <td>Pcs</td>
                                                                                <td>400,000</td>
                                                                                <td>800,000</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" class="text-wrap">1</th>
                                                                                <td class="text-wrap">Routers</td>
                                                                                <td>2</td>
                                                                                <td>Pcs</td>
                                                                                <td>400,000</td>
                                                                                <td>800,000</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Dclined requests content --}}
                                            <div class="tab-pane fade" id="nav-declined" role="tabpanel" aria-labelledby="nav-declined-tab">
                                                <h5 class="mb-3 mt-3 custom-color">Declined Expense Requests</h5>
                                                <div class="accordion accordion-expense" id="accordionExample">
                                                    <div class="card mb-2">
                                                        <div class="card-header p-2" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            <h2 class="mb-1 font-13">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                                            </h2>
                                                            <span class="mt-2 font-13">Total: <Strong><span class="badge badge-warning">3,000,000 UGX</span></Strong></span>
                                                        </div>
                                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table align-items-center table-flush">
                                                                        <thead class="thead-light">
                                                                            <tr>
                                                                            <th scope="col">S/N</th>
                                                                            <th scope="col">ITEM</th>
                                                                            <th scope="col">QTY</th>
                                                                            <th scope="col">UNIT</th>
                                                                            <th scope="col">RATE</th>
                                                                            <th scope="col">AMOUNT</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row" class="text-wrap">1</th>
                                                                                <td class="text-wrap">Routers</td>
                                                                                <td>2</td>
                                                                                <td>Pcs</td>
                                                                                <td>400,000</td>
                                                                                <td>800,000</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" class="text-wrap">1</th>
                                                                                <td class="text-wrap">Routers</td>
                                                                                <td>2</td>
                                                                                <td>Pcs</td>
                                                                                <td>400,000</td>
                                                                                <td>800,000</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card mb-2">
                                                        <div class="card-header p-2" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            <h2 class="mb-1 font-13">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                                            </h2>
                                                            <span class="mt-2 font-13">Total: <Strong><span class="badge badge-warning">3,000,000 UGX</span></Strong></span>
                                                        </div>
                                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table align-items-center table-flush">
                                                                        <thead class="thead-light">
                                                                            <tr>
                                                                            <th scope="col">S/N</th>
                                                                            <th scope="col">ITEM</th>
                                                                            <th scope="col">QTY</th>
                                                                            <th scope="col">UNIT</th>
                                                                            <th scope="col">RATE</th>
                                                                            <th scope="col">AMOUNT</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row" class="text-wrap">1</th>
                                                                                <td class="text-wrap">Routers</td>
                                                                                <td>2</td>
                                                                                <td>Pcs</td>
                                                                                <td>400,000</td>
                                                                                <td>800,000</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" class="text-wrap">1</th>
                                                                                <td class="text-wrap">Routers</td>
                                                                                <td>2</td>
                                                                                <td>Pcs</td>
                                                                                <td>400,000</td>
                                                                                <td>800,000</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Approved requests content --}}
                                            <div class="tab-pane fade" id="nav-approved" role="tabpanel" aria-labelledby="nav-approved-tab">
                                                <h5 class="mb-3 mt-3 custom-color">Approved Expense Requests</h5>
                                                <div class="accordion accordion-expense" id="accordionExample">
                                                    <div class="card mb-2">
                                                        <div class="card-header p-2" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            <h2 class="mb-1 font-13">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                                            </h2>
                                                            <span class="mt-2 font-13">Total: <Strong><span class="badge badge-warning">3,000,000 UGX</span></Strong></span>
                                                        </div>
                                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table align-items-center table-flush">
                                                                        <thead class="thead-light">
                                                                            <tr>
                                                                            <th scope="col">S/N</th>
                                                                            <th scope="col">ITEM</th>
                                                                            <th scope="col">QTY</th>
                                                                            <th scope="col">UNIT</th>
                                                                            <th scope="col">RATE</th>
                                                                            <th scope="col">AMOUNT</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row" class="text-wrap">1</th>
                                                                                <td class="text-wrap">Routers</td>
                                                                                <td>2</td>
                                                                                <td>Pcs</td>
                                                                                <td>400,000</td>
                                                                                <td>800,000</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" class="text-wrap">1</th>
                                                                                <td class="text-wrap">Routers</td>
                                                                                <td>2</td>
                                                                                <td>Pcs</td>
                                                                                <td>400,000</td>
                                                                                <td>800,000</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if (Auth()->user()->userType === "hr")
                                            {{-- Submitted requests content --}}
                                            <div class="tab-pane fade" id="nav-submitted" role="tabpanel" aria-labelledby="nav-submitted-tab">
                                                <h5 class="mb-3 mt-3 custom-color">Submitted Expense Requests</h5>
                                                <div class="accordion accordion-expense" id="accordionExample">
                                                    <div class="card mb-2">
                                                        <div class="card-header p-2" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            <h2 class="mb-1 font-13">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                                            </h2>
                                                            <span class="mt-2 font-13">Total: <Strong><span class="badge badge-warning">3,000,000 UGX</span></Strong></span>
                                                        </div>
                                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table align-items-center table-flush">
                                                                        <thead class="thead-light">
                                                                            <tr>
                                                                            <th scope="col">S/N</th>
                                                                            <th scope="col">ITEM</th>
                                                                            <th scope="col">QTY</th>
                                                                            <th scope="col">UNIT</th>
                                                                            <th scope="col">RATE</th>
                                                                            <th scope="col">AMOUNT</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row" class="text-wrap">1</th>
                                                                                <td class="text-wrap">Routers</td>
                                                                                <td>2</td>
                                                                                <td>Pcs</td>
                                                                                <td>400,000</td>
                                                                                <td>800,000</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" class="text-wrap">1</th>
                                                                                <td class="text-wrap">Routers</td>
                                                                                <td>2</td>
                                                                                <td>Pcs</td>
                                                                                <td>400,000</td>
                                                                                <td>800,000</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if (Auth()->user()->userType === "admin")
                                            {{-- Recommended requests content --}}
                                            <div class="tab-pane fade" id="nav-recommended" role="tabpanel" aria-labelledby="nav-recommended-tab">
                                                <h5 class="mb-3 mt-3 custom-color">Recommended Expense Requests</h5>
                                                <div class="accordion accordion-expense" id="accordionExample">
                                                    <div class="card mb-2">
                                                        <div class="card-header p-2" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            <h2 class="mb-1 font-13">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                                            </h2>
                                                            <span class="mt-2 font-13">Total: <Strong><span class="badge badge-warning">3,000,000 UGX</span></Strong></span>
                                                        </div>
                                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table align-items-center table-flush">
                                                                        <thead class="thead-light">
                                                                            <tr>
                                                                            <th scope="col">S/N</th>
                                                                            <th scope="col">ITEM</th>
                                                                            <th scope="col">QTY</th>
                                                                            <th scope="col">UNIT</th>
                                                                            <th scope="col">RATE</th>
                                                                            <th scope="col">AMOUNT</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row" class="text-wrap">1</th>
                                                                                <td class="text-wrap">Routers</td>
                                                                                <td>2</td>
                                                                                <td>Pcs</td>
                                                                                <td>400,000</td>
                                                                                <td>800,000</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" class="text-wrap">1</th>
                                                                                <td class="text-wrap">Routers</td>
                                                                                <td>2</td>
                                                                                <td>Pcs</td>
                                                                                <td>400,000</td>
                                                                                <td>800,000</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if (Auth()->user()->userType === "hr" || Auth()->user()->position === "Assistant Project Manager")
                                            {{-- Clarify requests content --}}
                                            <div class="tab-pane fade" id="nav-clarify" role="tabpanel" aria-labelledby="nav-clarify-tab">
                                                <h5 class="mb-3 mt-3 custom-color">Clarify Expense Requests</h5>
                                                <div class="accordion accordion-expense" id="accordionExample">
                                                    <div class="card mb-2">
                                                        <div class="card-header p-2" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            <h2 class="mb-1 font-13">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                                            </h2>
                                                            <span class="mt-2 font-13">Total: <Strong><span class="badge badge-warning">3,000,000 UGX</span></Strong></span>
                                                        </div>
                                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table align-items-center table-flush">
                                                                        <thead class="thead-light">
                                                                            <tr>
                                                                            <th scope="col">S/N</th>
                                                                            <th scope="col">ITEM</th>
                                                                            <th scope="col">QTY</th>
                                                                            <th scope="col">UNIT</th>
                                                                            <th scope="col">RATE</th>
                                                                            <th scope="col">AMOUNT</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row" class="text-wrap">1</th>
                                                                                <td class="text-wrap">Routers</td>
                                                                                <td>2</td>
                                                                                <td>Pcs</td>
                                                                                <td>400,000</td>
                                                                                <td>800,000</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" class="text-wrap">1</th>
                                                                                <td class="text-wrap">Routers</td>
                                                                                <td>2</td>
                                                                                <td>Pcs</td>
                                                                                <td>400,000</td>
                                                                                <td>800,000</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if (Auth()->user()->userType === "admin" || Auth()->user()->userType === "hr")
                                            {{-- Revised requests content --}}
                                            <div class="tab-pane fade" id="nav-revised" role="tabpanel" aria-labelledby="nav-revised-tab">
                                                <h5 class="mb-3 mt-3 custom-color">Revised Expense Requests</h5>
                                                <div class="accordion accordion-expense" id="accordionExample">
                                                    <div class="card mb-2">
                                                        <div class="card-header p-2" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            <h2 class="mb-1 font-13">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                                            </h2>
                                                            <span class="mt-2 font-13">Total: <Strong><span class="badge badge-warning">3,000,000 UGX</span></Strong></span>
                                                        </div>
                                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table align-items-center table-flush">
                                                                        <thead class="thead-light">
                                                                            <tr>
                                                                            <th scope="col">S/N</th>
                                                                            <th scope="col">ITEM</th>
                                                                            <th scope="col">QTY</th>
                                                                            <th scope="col">UNIT</th>
                                                                            <th scope="col">RATE</th>
                                                                            <th scope="col">AMOUNT</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row" class="text-wrap">1</th>
                                                                                <td class="text-wrap">Routers</td>
                                                                                <td>2</td>
                                                                                <td>Pcs</td>
                                                                                <td>400,000</td>
                                                                                <td>800,000</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" class="text-wrap">1</th>
                                                                                <td class="text-wrap">Routers</td>
                                                                                <td>2</td>
                                                                                <td>Pcs</td>
                                                                                <td>400,000</td>
                                                                                <td>800,000</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Accepted requests content --}}
                                            <div class="tab-pane fade" id="nav-accepted" role="tabpanel" aria-labelledby="nav-accepted-tab">
                                                <h5 class="mb-3 mt-3 custom-color">Accepted Expense Requests</h5>
                                                <div class="accordion accordion-expense" id="accordionExample">
                                                    <div class="card mb-2">
                                                        <div class="card-header p-2" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            <h2 class="mb-1 font-13">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                                            </h2>
                                                            <span class="mt-2 font-13">Total: <Strong><span class="badge badge-warning">3,000,000 UGX</span></Strong></span>
                                                        </div>
                                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table align-items-center table-flush">
                                                                        <thead class="thead-light">
                                                                            <tr>
                                                                            <th scope="col">S/N</th>
                                                                            <th scope="col">ITEM</th>
                                                                            <th scope="col">QTY</th>
                                                                            <th scope="col">UNIT</th>
                                                                            <th scope="col">RATE</th>
                                                                            <th scope="col">AMOUNT</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row" class="text-wrap">1</th>
                                                                                <td class="text-wrap">Routers</td>
                                                                                <td>2</td>
                                                                                <td>Pcs</td>
                                                                                <td>400,000</td>
                                                                                <td>800,000</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" class="text-wrap">1</th>
                                                                                <td class="text-wrap">Routers</td>
                                                                                <td>2</td>
                                                                                <td>Pcs</td>
                                                                                <td>400,000</td>
                                                                                <td>800,000</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Cash Out requests content --}}
                                            <div class="tab-pane fade" id="nav-cashOut" role="tabpanel" aria-labelledby="nav-cashOut-tab">
                                                <h5 class="mb-3 mt-3 custom-color">Cash Out Expense Requests</h5>
                                                <div class="accordion accordion-expense" id="accordionExample">
                                                    <div class="card mb-2">
                                                        <div class="card-header p-2" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            <h2 class="mb-1 font-13">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                                            </h2>
                                                            <span class="mt-2 font-13">Total: <Strong><span class="badge badge-warning">3,000,000 UGX</span></Strong></span>
                                                        </div>
                                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table align-items-center table-flush">
                                                                        <thead class="thead-light">
                                                                            <tr>
                                                                            <th scope="col">S/N</th>
                                                                            <th scope="col">ITEM</th>
                                                                            <th scope="col">QTY</th>
                                                                            <th scope="col">UNIT</th>
                                                                            <th scope="col">RATE</th>
                                                                            <th scope="col">AMOUNT</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row" class="text-wrap">1</th>
                                                                                <td class="text-wrap">Routers</td>
                                                                                <td>2</td>
                                                                                <td>Pcs</td>
                                                                                <td>400,000</td>
                                                                                <td>800,000</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" class="text-wrap">1</th>
                                                                                <td class="text-wrap">Routers</td>
                                                                                <td>2</td>
                                                                                <td>Pcs</td>
                                                                                <td>400,000</td>
                                                                                <td>800,000</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection