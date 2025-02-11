<div class="modal fade" id="pbiBirCommercialEdit{{ $detail->DocEntry }}" tabindex="-1" aria-labelledby="pbiBirCommercialEditLabel" aria-hidden="true">
    <form method="POST" id="pbiBirCommercial" action="{{ url('pbi_save_as_new_invoice') }}" autocomplete="off">
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
                <div class="col-md-12">
                    <label >Date:</label>
                    @foreach ( $detail->dln1 as $arDetail)
                    <input name="invoice_date" class="form-control" type="date" value="{{ \Carbon\Carbon::parse(optional($detail)->DocDueDate)->format('Y-m-d') }}">
                    @endforeach
                </div>
                {{-- <div class="col-md-12">
                    <label >Sold To:</label>
                    <input name="Client" class="form-control" type="text" value="{{ $detail->Billtoaddress }}">
                </div> --}}
                <div class="col-md-12">
                    <label >Sold To:</label>
                    <textarea name="Client" class="form-control" type="text">{{ $detail->Billtoaddress }}</textarea>
                </div>
                {{-- <div class="col-md-12">
                    <label>Address</label>
                    <input name="ClientAddress" class="form-control" type="text" value="{{ $detail->Billtoaddress }}">
                </div> --}}
                <div class="col-md-12">
                    <label>Ship To</label>
                    <textarea name="ShipTo" class="form-control"  rows="5" type="text">{{ $detail->Shiptoaddress }}</textarea>
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
                    <input name="BuyersPo" class="form-control" type="text" value="{{ $detail->U_BuyersPO }}">
                </div>
                <div class="col-md-4">
                    <label>Buyer's Ref No.</label>
                    <input name="BuyersRef" class="form-control" type="text" value="{{ $detail->NumAtCard }}">
                </div>
                <div class="col-md-4">
                    <label>Terms / Due Date</label>
                    @foreach ( $detail->dln1 as $arDetail)
                    <input name="InvoiceDueDate" class="form-control" type="text" value="{{ \Carbon\Carbon::parse(optional($arDetail->oinvPbi)->DocDueDate)->format('Y-m-d') }}">
                    @endforeach
                </div>
                <div class="col-md-4">
                    <label>Payment Terms</label>
                    <input name="TermsOfPayment" class="form-control" type="text" value="{{ $detail->octgModel->PymntGroup }}">
                </div>
                <div class="col-md-4">
                    <label>SO #</label>
                    @foreach ( $detail->dln1 as $item)
                    <input name="SoNo" class="form-control" type="text" value="{{ $item->ordrPbi->DocEntry}}">
                    @endforeach
                </div>
                <div class="col-md-2">
                    <label>Cur</label>
                    <input name="Currency" class="form-control" type="text" value="{{ $detail->DocCur }}">
                </div>
                <div class="col-md-2">
                    <label>UoM</label>
                    <input class="form-control" name="UnitOfM" type="text" value="{{ $detail->dln1->first()->U_printUOM }}">
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
            <div class="row" id="pbiProductContainer{{ $detail->DocEntry }}">
                @foreach ( $detail->dln1 as $product)
                <div class="col-md-12 row"><h3 style="font-weight:bold; text-decoration: underline;">Product</h3></div> 
                <div class="col-md-6">
                    <label>Product Code</label>
                    <select class="form-control" name="ProductCode[]" style="position: relative !important">
                        <option value="" selected>No Description</option>
                        @foreach ($sisCodes as $codes)
                            <option value="{{$codes->product_code }}">{{$codes->product_code  }}</option>
                        @endforeach
                    </select>
                    {{-- <input name="ProductCode[]" class="form-control" type="text" value=""> --}}
                </div>
                <div class="col-md-6">
                    <label>Description</label>
                    <input name="Description[]" style="white-space: pre;" class="form-control" type="text" value="{{ $product->U_Label_as }}">
                </div>
                {{-- <div class="col-md-6">
                    <label>Supplier Code</label>
                    <input name="SupplierCode[]" class="form-control" type="text" value="{{ $product->U_SupplierCode }}">
                </div> --}}
                {{-- <div class="col-md-2">
                    <label>Cur</label>
                    <input name="DocCur[]" class="form-control" type="text" value="{{ $detail->DocCur }}">
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
                {{-- <div class="col-md-1">
                    <label>UoM</label>
                    <input class="form-control" name="printUom[]" type="text" value="{{ $product->U_printUOM}}">
                </div> --}}
                <div class="col-md-4">
                    <label>Quantity</label>
                    <input class="form-control" name="Quantity[]" type="text" value="{{ $product->U_printUOM == 'lbs' ? number_format($product->Quantity * 2.2, 2) : number_format($product->Quantity, 2) }}" >
                </div>
                <div class="col-md-4">
                    <label>Unit Price</label>
                    {{-- <input class="form-control" name="UnitPrice[]" type="text" value="{{number_format($product->Price,2) }}" > --}}
                    <input class="form-control" name="UnitPrice[]" type="text" value="{{ $product->U_printUOM == 'lbs' ? number_format($product->Price / 2.2, 2) : number_format($product->Price, 2) }}" >

                    {{-- @if ($detail->DocCur == 'PHP')
                        <input class="form-control" type="text" value="{{ !empty($product->LineTotal) && !empty($product->Quantity) && $product->Quantity != 0 ? number_format($product->LineTotal / $product->Quantity, 2) : '' }}" readonly>
                    @else
                        <input class="form-control" type="text" value="{{ !empty($product->LineTotal) && !empty($product->Quantity) && $product->Quantity != 0 && !empty($product->Rate) && $product->Rate != 0 ? number_format(($product->LineTotal / $product->Rate) / $product->Quantity, 2) : '' }}"  readonly>
                    @endif --}}
                </div>
                <div class="col-md-4">
                    <label>Amount</label>
                    <input class="form-control" name="Amount[]" type="text" value="{{ number_format(($product->Quantity) * ($product->Price), 2) }}" >
                    {{-- @if ($detail->DocCur == 'PHP')
                        <input class="form-control" name="Amount[]" type="text" value="{{ number_format($product->LineTotal, 2) }}" readonly>
                    @else
                        <input class="form-control" name="Amount[]" type="text" value="{{ !empty($product->LineTotal) && !empty($product->Rate) && $product->Rate != 0 ? number_format($product->LineTotal / $product->Rate, 2) : '' }}" readonly>
                    @endif --}}
                </div>
                <div class="col-md-12">
                    <input class="form-control" name="PbiSiType[]" type="hidden" value="">
                </div>
                @endforeach
            </div>   
            <div class="col-md-12 mt-3" style="padding: 20px;">
                <button type="button" class="btn btn-primary" id="pbiAddRowButton{{ $detail->DocEntry }}" >Add Row</button>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="">Remarks</label>
                    <textarea name="Remarks" class="form-control" rows="10">
                    </textarea>
                </div>
                {{-- <div class="mt-4">
                    <table class="table table-bordered" id="customer_request{{ $detail->DocEntry }}">
                        </thead>
                        <tbody>
                          <tr>
                            <td><input type="text" name="ProductCode[]" class="form-control" value=""></td>
                            <td><input type="text" name="Description[]" class="form-control" style="white-space: pre;"></td>
                            <td><input type="text" name="Amount[]" class="form-control" value=""></td>
                            <input type="hidden" name="PbiSiType[]" class="form-control" value="PbiSi">
                            <input type="hidden" name="UnitPrice[]" class="form-control" value="">
                          </tr>
                        </tbody>
                    </table> 
                    <div class="row" style="margin-top: 20px">
                        <button type="button" class="btn btn-primary" id="addRowBtn{{ $detail->DocEntry }}">Add Row</button>            
                      </div>
                    </div>   --}}
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <label for="">Payment Instruction</label>
                    <textarea name="PaymentInstruction" class="form-control" rows="10">
                        @if($detail && $detail->U_T3)
                        <?php
                            // $intermediaryBankDetailsU_T1 = optional($details->first())->U_T1;
                            // $intermediaryBankDetailsU_T2 = optional($details->first())->U_T2;
                            // $intermediaryBankDetailsU_T3 = optional($details->first())->U_T3;
                            // $intermediaryBankDetailsU_T4 = optional($details->first())->U_T4;
                            // $intermediaryBankDetailsU_T5 = optional($details->first())->U_T5;
                            // $intermediaryBankDetailsU_T6 = optional($details->first())->U_T6;
                    
                            // $formattedText = trim(str_replace('/', "\n", $intermediaryBankDetailsU_T1));
                            // $formattedText = preg_replace('/^\s+/m', '', $formattedText);
                    
                            // $formattedText .= "\n" . str_replace('/', "\n", $intermediaryBankDetailsU_T2);
                            // $formattedText = preg_replace('/^\s+/m', '', $formattedText);
                    
                            // $formattedText .= "\n" . str_replace('/', "\n", $intermediaryBankDetailsU_T3);
                            // $formattedText = preg_replace('/^\s+/m', '', $formattedText);
                    
                            // $formattedText .= "\n" . str_replace('/', "\n", $intermediaryBankDetailsU_T4);
                            // $formattedText = preg_replace('/^\s+/m', '', $formattedText);
                    
                            // $formattedText .= "\n" . str_replace('/', "\n", $intermediaryBankDetailsU_T5);
                            // $formattedText = preg_replace('/^\s+/m', '', $formattedText);
                    
                            // $formattedText .= "\n" . str_replace('/', "\n", $intermediaryBankDetailsU_T6);
                            // $formattedText = preg_replace('/^\s+/m', '', $formattedText);
                            $intermediaryBankDetails = optional($details->first())->U_T2 . ' \ ' . optional($details->first())->U_T3 . ' \ ' . optional($details->first())->U_T4 . ' \ ' . optional($details->first())->U_T5 . ' \ ' . optional($details->first())->U_T6;
                            
                            $formattedDetails = preg_replace('/^\\\+|\\\+$/', '', $intermediaryBankDetails);
                            $lines = explode('\\', $formattedDetails);
                            $lines = array_map('trim', $lines);
                            
                            $lines = array_filter($lines);

                            $intermediaryBankDetailsU_T2 = optional($details->first())->U_T2;
                            $intermediaryBankDetailsU_T3 = optional($details->first())->U_T3;
                            $intermediaryBankDetailsU_T4 = optional($details->first())->U_T4;
                            $intermediaryBankDetailsU_T5 = optional($details->first())->U_T5;
                            $intermediaryBankDetailsU_T6 = optional($details->first())->U_T6;

                            $intermediaryBankDetailsU_T2 = preg_replace('/\\\\+/', ' ', $intermediaryBankDetailsU_T2);
                            $intermediaryBankDetailsU_T3 = preg_replace('/^\\\+|\\\+$/', '', $intermediaryBankDetailsU_T3);
                            $intermediaryBankDetailsU_T4 = preg_replace('/^\\\+|\\\+$/', '', $intermediaryBankDetailsU_T4);
                            $intermediaryBankDetailsU_T5 = preg_replace('/\\\\+/', ' ', $intermediaryBankDetailsU_T5);
                            $intermediaryBankDetailsU_T6 = preg_replace('/^\\\+|\\\+$/', '', $intermediaryBankDetailsU_T6);
                            $linesU_T6 = explode('\\', $intermediaryBankDetailsU_T6);
                            $linesU_T6 = array_filter(array_map('trim', $linesU_T6)); 
                        ?>
                            Philippine Bio Industries Inc
                            {{ $intermediaryBankDetailsU_T2 }} {{ $intermediaryBankDetailsU_T3 }}
                            {{ $intermediaryBankDetailsU_T4 }}
                            {{ $intermediaryBankDetailsU_T5 }}  
                            {{ $intermediaryBankDetailsU_T6 }}  
                            {{-- @foreach ($lines as $line)
                                {{ $line }}
                            @endforeach --}}
                    @endif</textarea>
                </div>
            </div>  
            <div class="row">
                <div class="col-md-10">
                    <label for="">PHREX</label>
                    <textarea name="Phrex" class="form-control" rows="7">
                        The Exporter PHREX2021P02A12FEB0000010538 of the products covered by this 
                        document declares that, except where otherwise clearly indicated, these products 
                        are of Philippine preferential origin according to the rules of origin of the 
                        Generalised System of Preferences of the European Union and that the origin 
                        criterion met is W".
                    </textarea>
                </div>
                <div class="col-md-2">
                    <input type="checkbox" name="ShowPhrex" class="form-check-input" value="1" checked>
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
        document.getElementById('addRowBtn{{ $detail->DocEntry }}').addEventListener('click', function() {
            const table = document.getElementById('customer_request{{ $detail->DocEntry }}').getElementsByTagName('tbody')[0];
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

        document.getElementById('pbiAddRowButton{{ $detail->DocEntry }}').addEventListener('click', function () {
            const pbiProductContainer = document.getElementById('pbiProductContainer{{ $detail->DocEntry }}');
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
                    <select class="form-control description-select" name="Description[]"  required>
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

        document.querySelectorAll('.delete-row').forEach((button) => {
            button.addEventListener('click', function () {
                button.closest('.product-row').remove();
            });
        });
        
    </script>