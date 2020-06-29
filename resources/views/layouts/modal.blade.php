
<!-- Expenses view -->
<div class="modal fade" id="expenseDetails" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
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
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
      <img alt="Image placeholder" src={{ asset("profiles/".Auth()->user()->image) }}>
    </div>
  </div>
</div>