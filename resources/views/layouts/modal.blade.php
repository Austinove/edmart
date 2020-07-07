
<!-- Expenses view -->
<div class="modal fade" id="expenseDetails" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="mb-0 custom-color">Expense Details</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pb-0 pt-0">
          <div class="card">
            <div class="card-body">
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
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td class="td-text custom-td">dfgfhs ykhmhg rtutuerhr vbncvndf fdshfgjjhss </td>
                                            <td class="td-text">20</td>
                                            <td class="td-text">Pc</td>
                                            <td class="td-text">500</td>
                                            <td class="td-text">10000</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td class="td-text custom-td">Mark pens for the white board Mark pens for the white board Mark pens for the white board</td>
                                            <td class="td-text">20</td>
                                            <td class="td-text">Pc</td>
                                            <td class="td-text">500</td>
                                            <td class="td-text">10000000</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">4</th>
                                            <td class="td-text custom-td">Mark pens for the white board Mark pens for the white board Mark pens for the white board Mark pens for the white board</td>
                                            <td class="td-text">20</td>
                                            <td class="td-text">Pc</td>
                                            <td class="td-text">500</td>
                                            <td class="td-text">10000</td>
                                        </tr>
                                        <tr class="total-row">
                                            <th scope="col" class="td-text custom-th">TOTAL</th>
                                            <th scope="col" class="td-text"></th>
                                            <th scope="col" class="td-text"></th>
                                            <th scope="col" class="td-text"></th>
                                            <th scope="col" class="td-text"></th>
                                            <th scope="col" class="td-text custom-th">65000000</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                {{-- data from jQuery --}}
                <div class="pl-lg-4 expenses-body"></div>
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