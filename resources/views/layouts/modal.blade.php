
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
<div class="modal fade" id="expenseCancel" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <form id="cancel-reason">
          <div class="modal-header">
            <h3 class="mb-0 custom-color font-12">Reason for cancelling expense</h3>
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
                            <textarea required name="reason" rows="2" type="text" class="reason form-control-sm form-control form-control-alternative" placeholder="Enter reason for cancelling the expense"></textarea>
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