<div class="modal fade" id="editNonTrade{{ $detail->DocEntry }}" tabindex="-1" aria-labelledby="nonTradeEditLabel" aria-hidden="true">
    <form method="POST" id="" action="{{ url('save_as_new_non_trade') }}" autocomplete="off">
      @csrf
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="EditLabel">Billing Statement Non Trade</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <input name="DocEntry" class="form-control" type="text" value="{{ $detail->DocEntry }}">
                </div>
                <div class="col-md-12">
                    <label >Billed To:</label>
                    <input name="BilledTo" class="form-control" type="text" value="{{ $detail->CardName }}">
                </div>
                <div class="col-md-12">
                    <label >SOA:</label>
                    <input name="Soa" class="form-control" type="text" value="{{ $detail->U_invNo }}">
                </div>
                <div class="col-md-12">
                    <label >Date:</label>
                    <input name="InvoiceDate" class="form-control" type="date" value="{{ $detail->DocDate }}">
                </div>
                <div class="col-md-12">
                    <label >Subject:</label>
                    <input name="Subject" class="form-control" type="text" value="">
                </div>
            </div>      
            <div class="col-md-12 row"><h3>Product</h5></div> 
            <div class="row">
            @foreach ( $detail->inv1 as $product)
                <div class="col-md-3">
                    <label>Particulars</label>
                    <input name="Particulars[]" class="form-control" type="text" value="">
                </div>
                <div class="col-md-3">
                    <label>Date/Period</label>
                    <input name="DatePeriod[]" class="form-control" type="text" value="">
                </div>
                <div class="col-md-3">
                    <label>Doc. Ref#</label>
                    <input name="DocRef[]" class="form-control" type="text" value="">
                </div>
                <div class="col-md-3">
                    <label>Amount</label>
                    <input name="Amount[]" class="form-control" type="text" value="{{ number_format($product->Price) }}">
                </div>
            @endforeach
            </div>   
            <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                    <label>Currency</label>
                    <input name="Currency" class="form-control" type="text" value="{{ $detail->DocCur }}">
                </div>
                <div class="col-md-6">
                    <label>Terms of Payment</label>
                    <input name="TermsOfPayment" class="form-control" type="text" value="{{ $detail->terms->PymntGroup }}">
                </div>
                <div class="col-md-6">
                    <label>Due Date</label>
                    <input name="DueDate" class="form-control" type="date" value="{{ \Carbon\Carbon::parse($detail->DocDueDate)->format('Y-m-d') }}">
                </div>
                <div class="col-md-6">
                    <label>Account Name</label>
                    <input name="AccountName" class="form-control" type="text" value="{{  $detail->U_T4 }}">
                </div>
                <div class="col-md-6">
                    <label>Account Number</label>
                    <input name="AccountNumber" class="form-control" type="text" value="">
                </div>
                <div class="col-md-6">
                    <label>Bank</label>
                    <input name="Bank" class="form-control" type="text" value="">
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