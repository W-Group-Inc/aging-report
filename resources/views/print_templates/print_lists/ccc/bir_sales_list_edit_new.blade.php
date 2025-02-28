@if ( $detail->newEntry)
<div class="modal fade" id="CccBirSalesEditNew{{ $detail->newEntry->id }}" tabindex="-1" aria-labelledby="birSalesEditLabel" aria-hidden="true">
    <form method="POST" id="birSales" action="{{ url('edit_new_sales_invoice_ccc/' . $detail->newEntry->id) }}" autocomplete="off">
      @csrf
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="birSalesEditLabel">BIR Sales Invoice</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <label >Date:</label>
                    <input name="InvoiceDate" class="form-control" type="date" value="{{ \Carbon\Carbon::parse($detail->newEntry->InvoiceDate)->format('Y-m-d') }}">
                </div>
                <div class="col-md-6">
                    <label>Remarks</label>
                    <input name="Remarks" class="form-control" type="text" value="{{  $detail->newEntry->Remarks }}">
                </div>
                <div class="col-md-12">
                    <label >Sold To:</label>
                    <textarea name="Client" class="form-control"  rows="5" type="text">{{ $detail->newEntry->SoldTo }}</textarea>
                </div>
                <div class="col-md-12">
                    <label>Address</label>
                    <textarea name="Address" class="form-control"  rows="5" type="text">{{ $detail->newEntry->Address }}</textarea>
                </div>
                <div class="col-md-3">
                    <label>TIN</label>
                    <input name="Tin" class="form-control" type="text" value="{{  $detail->newEntry->Tin }}">
                </div>
                <div class="col-md-3">
                    <label>Business Style</label>
                    <input name="BusinessStyle" class="form-control" type="text" value="{{  $detail->newEntry->BusinessStyle }}">
                </div>
                <div class="col-md-3">
                    <label>Buyer's PO No.</label>
                    <input name="BuyersPo" class="form-control" type="text" value="{{  $detail->newEntry->BuyersPo }}">
                </div>
                <div class="col-md-3">
                    <label>Sales Contract No.</label>
                    <input name="SalesContractNo" class="form-control" type="text" value="{{  $detail->newEntry->SalesContractNo }}">
                </div>
                <div class="col-md-6">
                    <label>Terms of Payment</label>
                    <input name="TermOfPayment" class="form-control" type="text" value="{{ $detail->newEntry->TermsOfPayment }}">
                </div>
                <div class="col-md-6">
                    <label>Invoice Due Date</label>
                    <input name="InvoiceDueDate" class="form-control" type="date" value="{{ \Carbon\Carbon::parse(optional($detail->newEntry)->InvoiceDueDate)->format('Y-m-d')}}">
                </div>
                <div class="col-md-3">
                    <label>OSCA/PWD ID No.</label>
                    <input name="OscaPwd" class="form-control" type="text" value="{{  $detail->newEntry->OscaPwd }}">
                </div>
                <div class="col-md-3">
                    <label>SC/PWD Signature</label>
                    <input name="ScPwd" class="form-control" type="text" value="{{  $detail->newEntry->ScPwd }}">
                </div>
                <div class="col-md-3">
                    <label>Cur</label>
                    <input name="Currency" class="form-control" type="text" value="{{ $detail->newEntry->Currency }}">
                </div>
                <div class="col-md-3">
                    <label>UoM</label>
                    <input class="form-control" name="UnitOfM" type="text" value="{{ $detail->newEntry->Uom }}">
                </div>
            </div>      
                <div class="row" id="cccProductContainerEdit{{ $detail->newEntry->id }}">
                @foreach (  $detail->newEntry->salesProduct as $product) 
                <div class="col-md-12 row"><h3 style="font-weight:bold; text-decoration: underline;">Product</h3></div>    
                    <div class="col-md-12">
                        <input name="product_id[]" class="form-control" type="hidden" value="{{  $product->id }}">
                    </div>
                    <div class="col-md-3">
                        <label>Description</label>
                        <input name="Description[]" class="form-control" type="text" value="{{ $product->Description }}">
                    </div>
                    <div class="col-md-3">
                        <label>Quantity</label>
                        <input class="form-control" name="Quantity[]" type="text" value="{{ ($product->Quantity) }}">
                    </div>
                    <div class="col-md-3">
                        <label>Unit Price</label>
                        <input class="form-control" name="UnitPrice[]" type="text" value="{{ number_format($product->UnitPrice, 2) }}">
                    </div>
                    <div class="col-md-3">
                        <label>Amount</label>
                        <input class="form-control" name="Amount[]" type="text" value="{{ number_format($product->Amount, 2) }}" >
                    </div>
                @endforeach
            </div>  
            <div class="row">
                <div class="col-md-12 mt-3" style="margin-top:10px">
                    <button type="button" class="btn btn-primary" id="cccEditAddRowButton{{ $detail->newEntry->id }}" >Add Row</button>
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
        document.getElementById('cccEditAddRowButton{{ $detail->newEntry->id }}').addEventListener('click', function () {
            const cccProductContainerEdit = document.getElementById('cccProductContainerEdit{{ $detail->newEntry->id }}');
            const newRow = `
            <div class="product-row">
                    <div class="col-md-12 row"><h3 style="font-weight:bold; text-decoration: underline;">Product</h3></div> 
                    <div class="col-md-12">
                        <input name="product_id[]" class="form-control" type="hidden" value="">
                    </div>
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
    
            cccProductContainerEdit.insertAdjacentHTML('beforeend', newRow);
            const lastAddedRow = cccProductContainerEdit.lastElementChild;
            const descriptionSelect = $(lastAddedRow).find('.description-select'); 
            const productCodeInput = lastAddedRow.querySelector('.product-code');
    
            
    
            const deleteButtons = cccProductContainerEdit.querySelectorAll('.delete-row');
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
@endif

