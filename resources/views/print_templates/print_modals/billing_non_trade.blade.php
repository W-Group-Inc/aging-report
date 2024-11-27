 <!-- Modal Structure -->
 <div class="modal fade" id="nonTradeBilling" tabindex="-1" aria-labelledby="soaModalLabel" aria-hidden="true">
    <form method="POST" id="remarksForm" action="{{ url('billing_statement_non_trade') }}" target="_blank" autocomplete="off">
      @csrf
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="soaModalLabel">Billing Statement (Non-Trade)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12 mb-10">
                <label for="">Enter SOA No.</label>
                  <input name="soa_no" class="form-control" type="text" placeholder="Enter SOA No.">
              </div>
              <div class="col-12 mb-10">
                <label for="">Enter Customer Ref.</label>
                  <input name="customer_ref" class="form-control" type="text" placeholder="Enter Customer Ref.">
              </div>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Ok</button>
          </div>
        </div>
      </div>
    </form>
    </div>