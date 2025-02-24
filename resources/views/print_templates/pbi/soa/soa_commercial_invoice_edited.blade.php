@if ( $detail->asNew)
<div class="modal fade" id="soaCommercialEditedPbi{{ $detail->asNew->id }}" tabindex="-1" aria-labelledby="soaCommercialEditLabel" aria-hidden="true">
    <form method="POST" id="pbiBirCommercial" action="{{ url('whi_soa_new_edit/'. $detail->asNew->id) }}" autocomplete="off">
      @csrf
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="SOACommercialEditLabel">SOA Commercial Invoice</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <label >Date:</label>
                    <input name="invoice_date" class="form-control" type="date" value="{{ \Carbon\Carbon::parse(optional($detail->asNew)->InvoiceDate)->format('Y-m-d') }}">
                </div>
                <div class="col-md-6">
                    <label >SOA No:</label>
                    <input name="SoaNo" class="form-control" type="text" value="{{$detail->asNew->SoaNo }}">
                </div>
                <div class="col-md-4">
                    <label >Sold To:</label>
                    <input name="Client" class="form-control" type="text" value="{{ $detail->asNew->SoldTo }}">
                </div>
                <div class="col-md-4">
                    <label >TIN</label>
                    <input name="Tin" class="form-control" type="text" value="{{$detail->asNew->Tin }}">
                </div>
                <div class="col-md-4">
                    <label>Business Style.</label>
                    <input name="BussinessStyle" class="form-control" type="text" value="{{$detail->asNew->BusinessStyle }}">
                </div>
                <div class="col-md-6">
                    <label >Address:</label>
                    <textarea name="Address" rows="3" class="form-control" type="text">{{ $detail->asNew->Address }}</textarea>
                </div>
                <div class="col-md-6">
                    <label >Ship To:</label>
                    <textarea name="DeliveryAddress" rows="3" class="form-control" type="text">{{ $detail->asNew->PlaceOfDelivery }}</textarea>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="">SOA Type</label>
                    <select class="form-control" name="soa_type" id="" required>
                      <option value="zero_rated" @if ( $detail->asNew->Type == 'zero_rated') selected @endif>Zero Rate</option>
                      <option value="vatable" @if ( $detail->asNew->Type == 'vatable') selected @endif>Vatable</option>
                      <option value="exempt" @if ( $detail->asNew->Type == 'exempt') selected @endif>Exempt</option>
                    </select>
                  </div>
                <div class="col-md-3">
                    <label>Customer's PO No.</label>
                    <input name="BuyersPo" class="form-control" type="text" value="{{ $detail->asNew->BuyersPo }}">
                </div>
                <div class="col-md-3">
                    <label>Buyer's Ref No.</label>
                    <input name="BuyersRef" class="form-control" type="text" value="{{ $detail->asNew->BuyersRef }}">
                </div>
                <div class="col-md-3">
                    <label>Terms / Due Date</label>
                    <input name="InvoiceDueDate" class="form-control" type="date" value="{{ optional($detail->asNew)->InvoiceDueDate ? \Carbon\Carbon::parse(optional($detail->asNew)->InvoiceDueDate)->format('Y-m-d') : '' }}">
                </div>
                <div class="col-md-4">
                    <label>Payment Terms</label>
                    <input name="TermsOfPayment" class="form-control" type="text" value="{{ $detail->asNew->TermsOfPayment }}">
                </div>
                <div class="col-md-4">
                    <label>SO #</label>
                    <input name="SoNo" class="form-control" type="text" value="{{ $detail->asNew->SoNo }}">
                </div>
                <div class="col-md-4">
                    <label>DR #</label>
                    <input name="DrNo" class="form-control" type="text" value="{{ $detail->asNew->DrNo }}">
                </div>
                <div class="col-md-3">
                    <label>Container No.</label>
                    <input name="ContainerNo" class="form-control" type="text" value="{{ $detail->asNew->ContainerNo }}">
                </div>
                <div class="col-md-3">
                    <label>Seal No</label>
                    <input name="SealNo" class="form-control" type="text" value="{{ $detail->asNew->SealNo }}">
                </div>
                <div class="col-md-3">
                    <label>Cur</label>
                    <input name="Currency" class="form-control" type="text" value="{{ $detail->asNew->Currency }}">
                </div>
                <div class="col-md-3">
                    <label>Unit Price UoM </label>
                    <input class="form-control" name="UnitOfM" type="text" value="{{ $detail->asNew->Uom }}">
                </div>
            </div>  
            <div class="row">
                <div class="col-md-12 row"><h4 style="font-weight:bold; color:red;">Additional Fields For EUR</h4></div> 
                <div class="col-md-3">
                    <label >Vat Number</label>
                    <input name="VatNumber" class="form-control" type="text" value="{{ $detail->asNew->VatNumber }}">
                </div>
                <div class="col-md-3">
                    <label>Sales Contract No.</label>
                    <input name="SalesContractNo" class="form-control" type="text" value="{{ $detail->asNew->SalesContractNo }}">
                </div> 
                <div class="col-md-3">
                    <label>OSCA/PWD ID No.</label>
                    <input name="OscaPwd" class="form-control" type="text" value="{{ $detail->asNew->OscaPwd }}">
                </div>
                <div class="col-md-3">
                    <label>SC/PWD ID No.</label>
                    <input name="ScPwd" class="form-control" type="text" value="{{ $detail->asNew->ScPwd }}">
                </div>
                <div class="col-md-3">
                    <label>Date Of Shipment</label>
                    <input name="DateOfShipment" class="form-control" type="date" value="{{ \Carbon\Carbon::parse(optional($detail->asNew)->DateOfShipment)->format('Y-m-d') }}">
                </div>
                <div class="col-md-3">
                    <label >Place of Loading:</label>
                    <input name="PlaceOfLoading" class="form-control" type="text" value="{{ $detail->asNew->PlaceOfLoading }}">
                </div>
                <div class="col-md-3">
                    <label>Mode of Delivery</label>
                    <input name="ModeOfDelivery" class="form-control" type="text" value="{{ $detail->asNew->ModeOfShipment }}">
                </div>
                <div class="col-md-3">
                    <label>Terms of Delivery</label>
                    <input name="TermsOfDelivery" class="form-control" type="text" value="{{ $detail->asNew->TermsOfDelivery }}">
                </div>
            </div>      
            <div class="row" id="soaWhiContainerEdit{{ $detail->asNew->id }}">
                @foreach ( $detail->asNew->soaProduct as $product)
                <div class="col-md-12 row"><h3 style="font-weight:bold; text-decoration: underline;">Product</h3></div> 
                <div class="col-md-12">
                    <input name="product_id[]" class="form-control" type="hidden" value="{{  $product->id }}">
                </div>
                <div class="col-md-4">
                    <label>Product Code</label>
                    <input name="ProductCode[]" style="white-space: pre;" class="form-control" type="text" value="">
                </div>
                <div class="col-md-4">
                    <label>Description</label>
                    <input name="Description[]" style="white-space: pre;" class="form-control" type="text" value="{{ $product->Description }}">
                </div>
                <div class="col-md-4">
                    <label>Packing</label>
                    <input name="Packing[]" style="white-space: pre;" class="form-control" type="text" value="{{ $product->Packing }}">
                </div>
                <div class="col-md-3">
                    <label>Unit</label>
                    <input name="Unit[]" style="white-space: pre;" class="form-control" type="text" value="{{ $product->Unit }}">
                </div>
                <div class="col-md-3">
                    <label>Quantity</label>
                    <input class="form-control" name="Quantity[]" type="text" value="{{ number_format($product->Quantity, 2) }}" >
                </div>
                <div class="col-md-3">
                    <label>Unit Price</label>
                    <input class="form-control" name="UnitPrice[]" type="text" value="{{ number_format($product->UnitPrice, 2) }}" >
                </div>
                <div class="col-md-3">
                    <label>Amount</label>
                    <input class="form-control" name="Amount[]" type="text" value="{{ number_format($product->Amount, 2) }}" >
                </div>
                @endforeach
            </div>   
            <div class="col-md-12 mt-3" style="padding: 20px;">
                <button type="button" class="btn btn-primary" id="soaEditAddRow{{ $detail->asNew->id }}" >Add Row</button>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="">Remarks</label>
                    <textarea name="Remarks" class="form-control" rows="10">
                        {{ $detail->asNew->Remarks }}
                    </textarea>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <label for="">Payment Instruction</label>
                    <textarea name="PaymentInstruction" class="form-control" rows="10">
                        {{ $detail->asNew->PaymentInstruction }}
                    </textarea>
                </div>
            </div>  
            <div class="row">
                <div class="col-md-10">
                    <label for="">PHREX</label>
                    <textarea name="Phrex" class="form-control" rows="7">
                        {{ $detail->asNew->Phrex }}
                    </textarea>
                </div>
                <div class="col-md-2">
                    <input type="checkbox" name="ShowPhrex" class="form-check-input" value="{{ $detail->asNew->ShowPhrex }}" 
                    {{ $detail->asNew->ShowPhrex == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="ShowPhrex">
                        Show
                    </label>
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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('addRowBtn{{ $detail->asNew->id }}').addEventListener('click', function() {
            const table = document.getElementById('customer_request{{ $detail->asNew->id }}').getElementsByTagName('tbody')[0];
            const newRow = table.rows[0].cloneNode(true);
    
            const inputs = newRow.getElementsByTagName('input');
            for (let input of inputs) {
                if (input.name === "PbiSiType[]") {
                    input.value = 'PbiSi';  
                } else {
                    input.value = '';  
                }
            }
    
            table.appendChild(newRow);
        });
    });

        document.getElementById('soaEditAddRow{{ $detail->asNew->id }}').addEventListener('click', function () {
            const soaWhiContainerEdit = document.getElementById('soaWhiContainerEdit{{ $detail->asNew->id }}');
            const newRow = `
            <div class="product-row">
                <div class="col-md-12 row"><h3 style="font-weight:bold; text-decoration: underline;">Product</h3></div> 
                 <div class="col-md-12">
                    <input name="product_id[]" class="form-control" type="hidden" value="">
                </div>
                <div class="col-md-4">
                    <label>Product Code</label>
                    <input name="ProductCode[]" style="white-space: pre;" class="form-control" type="text" value="">
                </div>
                <div class="col-md-4">
                    <label>Description</label>
                    <input name="Description[]" style="white-space: pre;" class="form-control" type="text" value="">
                </div>
                <div class="col-md-4">
                    <label>Packing</label>
                    <input name="Packing[]" style="white-space: pre;" class="form-control" type="text" value="">
                </div>
                <div class="col-md-3">
                    <label>Unit</label>
                    <input name="Unit[]" style="white-space: pre;" class="form-control" type="text" value="">
                </div>
                <div class="col-md-3">
                    <label>Quantity</label>
                    <input class="form-control" name="Quantity[]" type="text" value="" >
                </div>
                <div class="col-md-3">
                    <label>Unit Price</label>
                    <input class="form-control" name="UnitPrice[]" type="text" value="" >
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

            soaWhiContainerEdit.insertAdjacentHTML('beforeend', newRow);
            const lastAddedRow = soaWhiContainerEdit.lastElementChild;
            const descriptionSelect = $(lastAddedRow).find('.description-select'); 
            const productCodeInput = lastAddedRow.querySelector('.product-code');

            $(descriptionSelect).select2({
                tags: true, 
                placeholder: "Select or type a product",
                allowClear: true,
                width: '100%', 
                dropdownParent: $(lastAddedRow) 
            });

            descriptionSelect.on('change', function () {
                const selectedProduct = $(this).val();
                const matchingCode = sis_codes.find(code => code.product === selectedProduct);

                if (matchingCode) {
                    productCodeInput.value = matchingCode.product_code; 
                } else {
                    productCodeInput.value = ""; 
                }
            });
            const deleteButtons = soaWhiContainerEdit.querySelectorAll('.delete-row');
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