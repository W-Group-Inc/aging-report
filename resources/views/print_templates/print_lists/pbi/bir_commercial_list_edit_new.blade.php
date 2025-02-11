<div class="modal fade" id="pbiBirCommercialEditNew{{ $detail->asNew->id }}" tabindex="-1" aria-labelledby="pbiBirCommercialEditLabel" aria-hidden="true">
    <form method="POST" id="pbiBirCommercial" action="{{ url('pbi_edit_new_invoice/'. $detail->asNew->id) }}" autocomplete="off">
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
                {{-- <div class="col-md-12">
                    <input name="DocEntry" class="form-control" type="text" value="{{ $detail->asNew->DocEntry }}">
                </div> --}}
                <div class="col-md-12">
                    <label >Date:</label>
                    <input name="invoice_date" class="form-control" type="date" value="{{ \Carbon\Carbon::parse($detail->asNew->invoice_date)->format('Y-m-d') }}">
                </div>
                {{-- <div class="col-md-12">
                    <label >Sold To:</label>
                    <input name="Client" class="form-control" type="text" value="{{ $detail->asNew->SoldTo }}">
                </div> --}}
                <div class="col-md-12">
                    <label >Sold To:</label>
                    <textarea name="Client" class="form-control"  rows="5" type="text">{{ $detail->asNew->SoldTo }}</textarea>
                </div>
                {{-- <div class="col-md-12">
                    <label>Address</label>
                    <input name="Address" class="form-control" type="text" value="{{ $detail->asNew->Address }}">
                </div> --}}
                <div class="col-md-12">
                    <label>Ship To</label>
                    <textarea name="ShipTo" class="form-control"  rows="5" type="text">{{ $detail->asNew->ShipTo }}</textarea>
                </div>
                <div class="col-md-6">
                    <label>TIN</label>
                    <input name="Tin" class="form-control" type="text">
                </div>
                <div class="col-md-6">
                    <label>Business Style</label>
                    <input name="BusinessStyle" class="form-control" type="text">
                </div>
                <div class="col-md-4">
                    <label>Buyer's PO No.</label>
                    <input name="BuyersPo" class="form-control" type="text" value="{{ $detail->asNew->BuyersPo }}">
                </div>
                <div class="col-md-4">
                    <label>Buyer's Ref No.</label>
                    <input name="BuyersRef" class="form-control" type="text" value="{{ $detail->asNew->BuyersRef }}">
                </div>
                <div class="col-md-4">
                    <label>Terms / Due Date</label>
                    <input name="InvoiceDueDate" class="form-control" type="text" value="{{ \Carbon\Carbon::parse($detail->asNew->InvoiceDueDate)->format('Y-m-d') }}">
                </div>
                <div class="col-md-4">
                    <label>Payment Terms</label>
                    <input name="TermsOfPayment" class="form-control" type="text" value="{{ $detail->asNew->TermsOfPayment }}">
                </div>
                <div class="col-md-4">
                    <label>SO #</label>
                    @foreach ( $detail->dln1 as $item)
                    <input name="SoNo" class="form-control" type="text" value="{{ $detail->asNew->SoNo}}">
                    @endforeach
                </div>
                <div class="col-md-2">
                    <label>Cur</label>
                    <input name="Currency" class="form-control" type="text" value="{{ $detail->asNew->Currency }}">
                </div>
                <div class="col-md-2">
                    <label>UoM</label>
                    <input class="form-control" name="UnitOfM" type="text" value="{{ $detail->asNew->Uom }}">
                </div>
                {{-- <div class="col-md-4">
                    <label>Sales Contract No.</label>
                    <input name="SalesContract" class="form-control" type="text" value="{{ $detail->U_Salescontract }}">
                </div>
                <div class="col-md-6">
                    <label>OSCA/PWD ID No.</label>
                    <input name="OscaPwd" class="form-control" type="text">
                </div>
                <div class="col-md-6">
                    <label>SC/PWD ID No.</label>
                    <input name="ScPwd" class="form-control" type="text">
                </div> --}}
            </div>      
            <div class="row" id="pbiEditProductContainer{{ $detail->asNew->id }}">
            @foreach ( $detail->asNew->products as $product)
            <div class="col-md-12 row"><h3 style="font-weight:bold; text-decoration: underline;">Product</h3></div> 

            <div class="col-md-12">
                <input name="product_id[]" class="form-control" type="hidden" value="{{  $product->id }}">
            </div>
            <div class="col-md-6">
                <label>Product Code</label>
                <input name="ProductCode[]" class="form-control product-code" type="text" value="{{  $product->ProductCode }}">
            </div>
            <div class="col-md-6">
                <label>Description</label>
                <select class="form-control description-select" id="description-select-{{  $product->id }}" name="Description[]" style="position: relative !important">
                    <option value="" selected>No Description</option>
                    @php
                        $found = false;
                    @endphp
                    @foreach ($sisCodes as $codes)
                        <option value="{{ $codes->product }}" data-code="{{ $codes->product_code }}" 
                            @if ($codes->product == $product->Description) 
                                selected 
                                @php $found = true; @endphp
                            @endif>
                            {{ $codes->product }}
                        </option>
                    @endforeach
                    @if (!$found && !empty($product->Description))
                        <option value="{{ $product->Description }}" selected>{{ $product->Description }} (Not in list)</option>
                    @endif
                </select>
            </div>
            {{-- <div class="col-md-6">
                <label>Supplier Code</label>
                <input name="SupplierCode[]" class="form-control" type="text" value="{{ $product->U_SupplierCode }}">
            </div> --}}
            {{-- <div class="col-md-6">
                <label>Currency</label>
                <input name="DocCur[]" class="form-control" type="text" value="{{ $product->DocCur }}">
            </div> --}}
            {{-- <div class="col-md-3">
                <label>Packing</label>
                <input name="Packing[]" class="form-control" type="text" value="{{ $product->U_Bagsperlot }}">
            </div> --}}
            {{-- <div class="col-md-3">
                <label>Unit of Measurement</label>
                <input name="Uom[]" class="form-control" type="text" value="{{ $product->U_packUOM }}">
            </div> --}}
            {{-- <div class="col-md-3">
                <label>Unit</label>
                <input class="form-control" type="text" value="{{ !empty($product->Quantity) && !empty($product->U_Bagsperlot) && $product->U_Bagsperlot != 0 ? number_format($product->Quantity / $product->U_Bagsperlot, 2) : '' }}" readonly>
            </div> --}}
            {{-- <div class="col-md-6">
                <label>Unit of Measurement</label>
                <input class="form-control" name="printUom[]" type="text" value="{{ $product->printUom}}">
            </div> --}}
            <div class="col-md-4">
                <label>Quantity</label>
                <input class="form-control" name="Quantity[]" type="text" value="{{ number_format($product->Quantity,2) }}">
            </div>
            <div class="col-md-4">
                <label>Unit Price</label>
                    {{-- <input class="form-control" type="text" value="{{ !empty($product->Amount) && !empty($product->Quantity) && $product->Quantity != 0 ? number_format($product->Amount / $product->Quantity, 2) : '' }}" readonly> --}}
                    <input class="form-control" name="UnitPrice[]" type="text" value="{{ $detail->asNew->Uom == 'lbs' ? number_format($product->UnitPrice / 2.2, 2) : number_format($product->UnitPrice, 2) }}" >
                    {{-- <input class="form-control" name="UnitPrice[]" type="text" value="{{ $product->UnitPrice}}"> --}}
            </div>
            <div class="col-md-4">
                <label>Amount</label>
                    <input class="form-control" name="Amount[]" type="text" value="{{ number_format($product->Amount, 2) }}">
                    {{-- <input class="form-control" name="Amount[]" type="text" value="{{ number_format(($product->Quantity) * ($product->UnitPrice), 2) }}" > --}}
            </div>
            <div class="col-md-4">
                <input class="form-control" name="PbiSiType[]" type="hidden" value="">
            </div>
            @endforeach
            </div>  
            <div class="col-md-12 mt-3" style="padding: 20px;">
                <button type="button" class="btn btn-primary" id="pbiEditAddRowButton{{ $detail->asNew->id }}" >Add Row</button>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="">Remarks</label>
                    <textarea name="Remarks" class="form-control" rows="10">
                        {{ $detail->asNew->Remarks }}
                    </textarea>
                </div>
            </div>
                {{-- <div class="row" style="margin: 0;">
                    <div class="col-md-12" style="margin: 0; padding: 0;">
                        <div class="mt-4">
                            <table class="table table-bordered customer_request-{{ $detail->asNew->id }}" style="margin: 0; padding: 0;">
                                <tbody>
                                    @foreach ($detail->asNew->clientRequest as $cRequest)
                                    <tr>
                                        <input name="product_id[]" class="form-control" type="hidden" value="{{  $cRequest->id }}">
                                        <td><input type="text" name="ProductCode[]" class="form-control" value="{{ $cRequest->ProductCode }}"></td>
                                        <td><input type="text" name="Description[]" class="form-control" value="{{ $cRequest->Description }}"></td>
                                        <td><input type="text" name="Amount[]" class="form-control" value="{{ $cRequest->Amount }}"></td>
                                        <td><input type="hidden" name="PbiSiType[]" class="form-control" value="PbiSi"></td>
                                        <td><input type="hidden" name="UnitPrice[]" class="form-control" value="0"></td>
                                        <td><button type="button" class="btn btn-danger btn-sm deleteRowBtn">Delete</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row" style="margin-top: 20px; padding: 0;">
                                <button type="button" class="btn btn-primary addRowBtn" style="margin-top: 0;">Add Row</button>
                            </div>
                        </div>
                    </div>
                </div>    --}}
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        function initializeSelect2() {
            $('.description-select').each(function() {
                $(this).select2({
                    tags: true,
                    placeholder: "Select or type a product",
                    allowClear: true,
                    width: '100%',
                    dropdownParent: $(this).closest('.modal') // Ensure correct modal parent
                });
            });
        }

        $('.modal').on('shown.bs.modal', function () {
            initializeSelect2();
        });

        initializeSelect2();function initializeSelect2() {
            $('.description-select').each(function() {
                $(this).select2({
                    tags: true,
                    placeholder: "Select or type a product",
                    allowClear: true,
                    width: '100%',
                    dropdownParent: $(this).closest('.modal') // Ensure correct modal parent
                });
            });
        }

        $('.modal').on('shown.bs.modal', function () {
            initializeSelect2();
        });

        initializeSelect2();

        document.querySelectorAll('.addRowBtn').forEach(function(button) {
            button.addEventListener('click', function() {
                var table = button.closest('.mt-4').querySelector('table');

                var newRow = document.createElement('tr');

                newRow.innerHTML = `
                    <input name="product_id[]" class="form-control" type="hidden" value="">
                    <td><input type="text" name="ProductCode[]" class="form-control"></td>
                    <td><input type="text" name="Description[]" class="form-control"></td>
                    <td><input type="text" name="Amount[]" class="form-control"></td>
                    <td><input type="hidden" name="PbiSiType[]" class="form-control" value="PbiSi"></td>
                    <td><input type="hidden" name="UnitPrice[]" class="form-control" value="0"></td>
                    <td><button type="button" class="btn btn-danger btn-sm deleteRowBtn">Delete</button></td>
                `;
                
                table.querySelector('tbody').appendChild(newRow);
            });
        });

        document.getElementById('pbiEditAddRowButton{{ $detail->asNew->id }}').addEventListener('click', function () {
            const pbiProductContainer = document.getElementById('pbiEditProductContainer{{ $detail->asNew->id }}');
            const sis_codes = @json($sisCodes);
            const selectOptions = sis_codes.map(code => `<option value="${code.product}">${code.product}</option>`).join('');
            const newRow = `
            <div class="product-row">
                <div class="col-md-12 row"><h3 style="font-weight:bold; text-decoration: underline;">Product</h3></div> 
                <div class="col-md-6">
                    <label>Product Code</label>
                    <input name="ProductCode[]" class="form-control product-code" type="text" value="">
                </div>
                <div class="col-md-6">
                    <label>Description</label>
                    <select class="form-control description-select" name="Description[]" style="position: relative !important" required>
                        <option value="" selected>No Description</option>
                        ${selectOptions}
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Quantity</label>
                    <input class="form-control" name="Quantity[]" type="text" value="" >
                </div>
                <div class="col-md-4">
                    <label>Unit Price</label>
                    <input class="form-control" name="UnitPrice[]" type="text" value="" >
                </div>
                <div class="col-md-4">
                    <label>Amount</label>
                    <input class="form-control" name="Amount[]" type="text" value="" >
                </div>
                <div class="col-md-12">
                    <input class="form-control" name="PbiSiType[]" type="hidden" value="">
                </div>
                <div class="col-md-12 text-end mt-2">
                    <button type="button" class="btn btn-danger delete-row">Delete</button>
                </div>
            </div>
            `;

            pbiProductContainer.insertAdjacentHTML('beforeend', newRow);
            const lastAddedRow = pbiProductContainer.lastElementChild;
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

            const deleteButtons = pbiProductContainer.querySelectorAll('.delete-row');
            deleteButtons.forEach((button) => {
                button.addEventListener('click', function () {
                    button.closest('.product-row').remove();
                });
            });
        });

        document.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('deleteRowBtn')) {
            var row = event.target.closest('tr');
            var productId = row.querySelector('input[name="product_id[]"]').value; 

            if (productId) {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, this action cannot be undone.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: `delete-product/${productId}`,
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                if (data.success) {
                                    row.querySelectorAll('input').forEach(function(input) {
                                        input.value = ''; 
                                    });
                                    row.parentNode.removeChild(row);
                                    swal("Deleted!", "The product has been deleted.", "success");
                                } else {
                                    swal("Error!", "Failed to delete the product.", "error");
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                                swal("Error!", "There was an error deleting the record.", "error");
                            }
                        });
                    } else {
                        swal("Cancelled", "Your product is safe.", "info");
                    }
                });
            } else {
                row.parentNode.removeChild(row);
            }
        }
    });

});

    $(document).ready(function() {
        $('.description-select').on('change', function() {
            var productCode = $(this).find(':selected').data('code'); 
            $(this).closest('.col-md-6').prev('.col-md-6').find('.product-code').val(productCode);
        });
    });
</script>