<div class="modal fade" id="CccBirSalesEdit{{ $detail->DocEntry }}" tabindex="-1" aria-labelledby="birCommercialEditLabel" aria-hidden="true">
    <form method="POST" id="birCommercial" action="{{ url('save_as_new_sales_invoice_ccc') }}" autocomplete="off">
      @csrf
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="birCommercialEditLabel">BIR Commercial Invoice</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <input name="DocEntry" class="form-control" type="hidden" value="{{ $detail->DocEntry }}">
                </div>
                <div class="col-md-6">
                    <label >Date:</label>
                    <input name="InvoiceDate" class="form-control" type="date" value="{{ \Carbon\Carbon::parse($detail->DocDueDate)->format('Y-m-d') }}">
                </div>
                <div class="col-md-6">
                    <label>Remarks</label>
                    <input name="Remarks" class="form-control" type="text" value="">
                </div>
                <div class="col-md-12">
                    <label >Sold To:</label>
                    <textarea name="Client" class="form-control" type="text">{{ $detail->PayToCode }}</textarea>
                </div>
                <div class="col-md-12">
                    <label>Address</label>
                    <textarea name="ClientAddress" class="form-control"  rows="5" type="text">{{ $detail->Address }}</textarea>
                </div>
                <div class="col-md-3">
                    <label>TIN</label>
                    <input name="Tin" class="form-control" type="text" value="{{ optional($detail)->LicTradNum }}">
                </div>
                <div class="col-md-3">
                    <label>Business Style</label>
                    <input name="BusinessStyle" class="form-control" type="text" value="{{ $detail->PayToCode }}">
                </div>
                <div class="col-md-3">
                    <label>Buyer's PO No.</label>
                    <input name="BuyersPo" class="form-control" type="text" value="{{ $detail->U_BuyersPO }}">
                </div>
                <div class="col-md-3">
                    <label>Sales Contract No.</label>
                    <input name="SalesContract" class="form-control" type="text" value="{{ $detail->U_Salescontract }}/{{ $detail->NumAtCard }}">
                </div>
                <div class="col-md-6">
                    <label>Terms of Payment</label>
                    <input name="TermOfPayment" class="form-control" type="text" value="{{ $detail->cccOctg->PymntGroup }}">
                </div>
                <div class="col-md-6">
                    <label>Invoice Due Date</label>
                    <input name="InvoiceDueDate" class="form-control" type="date" value="{{ \Carbon\Carbon::parse(optional($detail->cccDln1->first()->oinvCCC)->DocDueDate)->format('Y-m-d')}}">
                </div>
                <div class="col-md-3">
                    <label>OSCA/PWD ID No.</label>
                    <input name="OscaPwd" class="form-control" type="text">
                </div>
                <div class="col-md-3">
                    <label>SC/PWD ID No.</label>
                    <input name="ScPwd" class="form-control" type="text">
                </div>
                <div class="col-md-3">
                    <label>Cur</label>
                    <input name="Currency" class="form-control" type="text" value="{{ $detail->DocCur }}">
                </div>
                <div class="col-md-3">
                    <label>UoM</label>
                    <input class="form-control" name="UnitOfM" type="text" value="{{ $detail->cccDln1->first()->U_printUOM }}">
                </div>
            </div>      
            <div class="row" id="cccProductContainer{{ $detail->DocEntry }}">
                @foreach ( $detail->ccc_products as $product)
                    <div class="col-md-12 row"><h3 style="font-weight:bold; text-decoration: underline;">Product</h3></div> 
                    <div class="col-md-3">
                        <label>Description</label>
                        <input name="Description[]" class="form-control" type="text" value="{{ $product->U_Label_as}}">
                    </div>
                    <div class="col-md-3">
                        <label>Quantity</label>
                        <input class="form-control" name="Quantity[]" type="text" value="{{ ($product->Quantity) }}">
                    </div>
                    <div class="col-md-3">
                        <label>Unit Price</label>
                        <input class="form-control" name="UnitPrice[]" type="text" value="{{ !empty($product->Price) ? number_format($product->Price, 2) : '' }}">
                    </div>
                    <div class="col-md-3">
                        <label>Amount</label>
                        @if ($detail->DocCur == 'PHP')
                            <input class="form-control" name="Amount[]" type="text" value="{{ ($product->LineTotal) }}" >
                        @else
                            <input class="form-control" name="Amount[]" type="text" value="{{ !empty($product->LineTotal) && !empty($product->Rate) && $product->Rate != 0 ? ($product->LineTotal / $product->Rate) : '' }}" >
                        @endif
                    </div>
                @endforeach
            </div>  
            <div class="row">
                <div class="col-md-12 mt-3" style="margin-top:10px">
                    <button type="button" class="btn btn-primary" id="cccAddRowButton{{ $detail->DocEntry }}" >Add Row</button>
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

    <script>
        document.getElementById('cccAddRowButton{{ $detail->DocEntry }}').addEventListener('click', function () {
            const cccProductContainer = document.getElementById('cccProductContainer{{ $detail->DocEntry }}');
            const newRow = `
            <div class="product-row">
                <div class="col-md-12 row"><h3 style="font-weight:bold; text-decoration: underline;">Product</h3></div> 
                <div class="col-md-3">
                        <label>Description</label>
                        <input name="Description[]" class="form-control" type="text" value="">
                    </div>
                    <div class="col-md-3">
                        <label>Quantity</label>
                        <input class="form-control" name="Quantity[]" type="text" value="">
                    </div>
                    <div class="col-md-3">
                        <label>Unit Price</label>
                        <input class="form-control" name="UnitPrice[]" type="text" value="">
                    </div>
                    <div class="col-md-3">
                        <label>Amount</label>
                        <input class="form-control" name="Amount[]" type="text" value="" >
                    </div>
                <div class="col-md-12 text-end mt-2">
                    <button type="button" class="btn btn-danger delete-row">Delete</button>
                </div>
            </div>
            `;

            cccProductContainer.insertAdjacentHTML('beforeend', newRow);
            const lastAddedRow = cccProductContainer.lastElementChild;
            const descriptionSelect = $(lastAddedRow).find('.description-select'); 
            const productCodeInput = lastAddedRow.querySelector('.product-code');

            

            const deleteButtons = cccProductContainer.querySelectorAll('.delete-row');
            deleteButtons.forEach((button) => {
                button.addEventListener('click', function () {
                    button.closest('.product-row').remove();
                });
            });
        });

        document.querySelectorAll('.delete-row').forEach((button) => {
            button.addEventListener('click', function () {
                button.closest('.product-row').remove();
            });
        });
    </script>