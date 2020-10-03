
<!-- Expenses view -->
<div class="modal fade" id="expenseDetails" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="mb-0 custom-color expModal-title"></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pb-0 pt-0">
          <div class="card">
            <div class="card-body">
                {{-- data from jQuery --}}
                <div class="pl-lg-4">
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
                                  </tr>
                              </thead>
                              {{-- data is from jQuery --}}
                              <tbody class="expenses-body"></tbody>
                          </table>
                      </div>
                  </div>
                  <div style="width: 95%; margin-top: 20px;">
                      <h5 class="mb-0 custom-color float-right modal-total"></h5>
                  </div>
                  {{-- data from jQuery --}}
                  <div class="reason-content"></div>
                </div>
            </div>
          </div>
      </div>
      <div class="modal-footer pt-0">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- profile image view -->
<div class="modal fade" id="profileImage" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content" style="background-color: transparent;">
      <div class="modal-header" style="background-color: transparent;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
      <img alt="Image placeholder" src={{ asset("profiles/".Auth()->user()->image) }}>
    </div>
  </div>
</div>

<!-- Expenses Cancelling Reason -->
<div class="modal fade" id="expenseCancel" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <form id="cancel-reason">
          <div class="modal-header">
            <h3 class="mb-0 custom-color font-14 cancel-title">Reason for cancelling expense</h3>
            <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pb-0 pt-0">
              <div class="card">
                <div class="card-body">
                    @csrf
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="cancellingReason" class="small-text">Reason <span class="error">*</span></label>
                          <div class="bg-secondary">
                            <textarea required name="reason" rows="2" type="text" class="reason form-control-sm form-control form-control-alternative" placeholder="Enter reason please..."></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
          </div>
          <div class="modal-footer pt-0">
            <button type="button" class="btn btn-outline-warning btn-sm modal-close" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            <button type="submit" user-data="" id-data="" class="cancel-btn btn btn-outline-secondary btn-sm custom-btn"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i> Submit</button>
          </div>
        </form>
      </div>
  </div>
</div>

<!-- Expenses Add Employee -->
<div class="modal" id="projectEmployee" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <form id="assign-emp" enctype="multipart/form-data">
          <div class="modal-header">
            <h3 class="mb-0 custom-color font-14">Assign Employees to project</h3>
            <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pb-0 pt-0">
              <div class="card">
                <div class="card-body">
                    @csrf
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="cancellingReason" class="small-text">Check form Employees List below: <span class="error">*</span></label>
                          <div class="bg-secondary custom-control custom-checkbox">
                            <input type="checkbox" name="customCheck1" class="custom-control-input emp-checkbox" value="Bryan" id="customCheck1">
                            <label class="custom-control-label" name="customCheck4" for="customCheck1">Bryan Austin</label>
                          </div>
                          <div class="bg-secondary custom-control custom-checkbox">
                            <input type="checkbox" name="customCheck2" class="custom-control-input emp-checkbox" value="Hussein" id="customCheck2">
                            <label class="custom-control-label" name="customCheck4" for="customCheck2">Muwaya Hussein</label>
                          </div>
                          <div class="bg-secondary custom-control custom-checkbox">
                            <input type="checkbox" name="customCheck3" class="custom-control-input emp-checkbox" value="Pinyi" id="customCheck3">
                            <label class="custom-control-label" name="customCheck4" for="customCheck3">Pinyi Eria</label>
                          </div>
                          <div class="bg-secondary custom-control custom-checkbox">
                            <input type="checkbox" name="customCheck4" class="custom-control-input emp-checkbox" value="Gideon" id="customCheck4">
                            <label class="custom-control-label" name="customCheck4" for="customCheck4">Ocho Gideon</label>
                          </div>
                          <input required value="1" name="projectId-holder" class="projectId-holder d-none">
                        </div>
                      </div>
                    </div>
                </div>
              </div>
          </div>
          <div class="modal-footer pt-0">
            <button type="button" class="btn btn-outline-warning btn-sm closer modal-close" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            <button type="submit" user-data="" id-data="" class="assign-btn btn btn-outline-success btn-sm custom-btn"><i class="fa fa-check" aria-hidden="true"></i> Assign</button>
          </div>
        </form>
      </div>
  </div>
</div>

{{-- project details --}}
<div class="modal fade expenses-details" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h3 class="mb-0 custom-color font-14 cancel-title">#48YA-TYY</h3>
          <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <div class="modal-body pb-0 pt-0">
        <div class="card mx-2 mt-2 mb-2">
          <div class="card-body">
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
                  <p class="card-text font-13">
                    Tables are slightly adjusted to style, collapse borders, and ensure consistent.
                  </p>
              </div>
              <div class="mb-2">
                  <h5 class="card-title mb-0">Project Summary Description</h5>
                  <p class="card-text font-13">
                    Tables are slightly adjusted to style, collapse borders, and ensure consistent.
                    Tables are slightly adjusted to style, collapse borders, and ensure consistent.
                    Tables are slightly adjusted to style, collapse borders, and ensure consistent.
                    Tables are slightly adjusted to style, collapse borders, and ensure consistent.
                  </p>
              </div>
              <div class="row mt-4 mb-2">
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <h5 class="card-title mb-0">Commencement Date</>
                  <p class="card-text font-13">08/09/2020, 9:30 am</p>
                </div>
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <h5 class="card-title mb-0">Completion Date</h5>
                  <p class="card-text font-13">08/10/2020, 9:30 am</p>
                  </div>
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
              <div class="row mt-4">
                <div class="col-md-8">
                  <h5 class="card-title mb-0">Days elapsed</h5>
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
                </div>
              </div>
          </div>
        </div>
        <div class="modal-footer pt-0">
          <button type="button" class="btn btn-outline-warning btn-sm modal-close" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        </div>
      </div>
    </div>
  </div>
</div>