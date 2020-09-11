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

                    <div class="col-md-12 expenses-contents">
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
                        <div class="row">
                            <div class="col-md-11 ml-auto mx-auto">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <h5 class="mb-3 mt-3 custom-color">Pending Expenses Requests</h5>
                                        <div class="accordion accordion-expense" id="accordionExample">
                                            <div class="card mb-2">
                                                <div class="card-header p-2" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <h2 class="mb-1 font-13">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                                    </h2>
                                                    <span class="mt-2 font-13">Total: <Strong><span class="badge badge-warning">3,000,000 UGX</span></Strong></span>
                                                    <span class="mt-2 ml-4 font-12 text-mute">Date: 11/09/2020</span>
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
                                                    <span class="mt-2 ml-4 font-12 text-mute">Date: 11/09/2020</span>
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

                                            <div class="card mb-2">
                                                <div class="card-header p-2" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    <h2 class="mb-1 font-13">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                                    </h2>
                                                    <span class="mt-2 font-13">Total: <Strong><span class="badge badge-warning">3,000,000 UGX</span></Strong></span>
                                                    <span class="mt-2 ml-4 font-12 text-mute">Date: 11/09/2020</span>
                                                </div>
                                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
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
                                                <div class="card-header p-2" id="headingFour" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                    <h2 class="mb-1 font-13">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                                    </h2>
                                                    <span class="mt-2 font-13">Total: <Strong><span class="badge badge-warning">3,000,000 UGX</span></Strong></span>
                                                    <span class="mt-2 ml-4 font-12 text-mute">Date: 11/09/2020</span>
                                                </div>
                                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
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
                                                <div class="card-header p-2" id="headingFive" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                    <h2 class="mb-1 font-13">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                                    </h2>
                                                    <span class="mt-2 font-13">Total: <Strong><span class="badge badge-warning">3,000,000 UGX</span></Strong></span>
                                                    <span class="mt-2 ml-4 font-12 text-mute">Date: 11/09/2020</span>
                                                </div>
                                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
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
                                                <div class="card-header p-2" id="headingSix" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                    <h2 class="mb-1 font-13">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                                    </h2>
                                                    <span class="mt-2 font-13">Total: <Strong><span class="badge badge-warning">3,000,000 UGX</span></Strong></span>
                                                    <span class="mt-2 ml-4 font-12 text-mute">Date: 11/09/2020</span>
                                                </div>
                                                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
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
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <h5 class="mb-3 mt-3 custom-color">Pending Expenses Requests</h5>
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

                                            <div class="card mb-2">
                                                <div class="card-header p-2" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    <h2 class="mb-1 font-13">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                                    </h2>
                                                    <span class="mt-2 font-13">Total: <Strong><span class="badge badge-warning">3,000,000 UGX</span></Strong></span>
                                                </div>
                                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
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
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                        <h5 class="mb-3 mt-3 custom-color">Pending Expenses Requests</h5>
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

                                            <div class="card mb-2">
                                                <div class="card-header p-2" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    <h2 class="mb-1 font-13">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                                    </h2>
                                                    <span class="mt-2 font-13">Total: <Strong><span class="badge badge-warning">3,000,000 UGX</span></Strong></span>
                                                </div>
                                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection