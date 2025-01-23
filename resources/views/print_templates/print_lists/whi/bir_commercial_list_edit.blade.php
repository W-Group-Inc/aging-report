<div class="modal fade" id="birCommercialEdit{{ $detail->DocEntry }}" tabindex="-1" aria-labelledby="birCommercialEditLabel" aria-hidden="true">
    <form method="POST" id="birCommercial" action="{{ url('save_as_new_invoice') }}" autocomplete="off">
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
                    {{-- @foreach ( $detail->dln1 as $arDetail) --}}
                    <label >Date:</label>
                    <input name="invoice_date" class="form-control" type="date" value="{{ \Carbon\Carbon::parse(optional($detail)->DocDueDate)->format('Y-m-d') }}">
                    {{-- @endforeach --}}
                </div>
                <div class="col-md-12">
                    <label >Sold To:</label>
                    <input name="Client" class="form-control" type="text" value="{{ $detail->PayToCode }}">
                </div>
                <div class="col-md-12">
                    <label>Address</label>
                    <input name="ClientAddress" class="form-control" type="text" value="{{ str_replace("\r", ' ', $detail->Address) }}">
                </div>
                {{-- <div class="col-md-6">
                    <label>TIN</label>
                    <input name="Tin" class="form-control" type="text">
                </div>
                <div class="col-md-6">
                    <label>Business Style</label>
                    <input name="BusinessStyle" class="form-control" type="text">
                </div> --}}
                <div class="col-md-4">
                    <label>Buyer's PO No.</label>
                    <input name="BuyersPo" class="form-control" type="text" value="{{ implode(', ', $detail->PoNumbers->pluck('U_BuyersPO')->toArray()) }}">
                </div>
                <div class="col-md-4">
                    <label>Buyer's Ref No.</label>
                    <input name="BuyersRef" class="form-control" type="text" value="{{ $detail->NumAtCard }}">
                </div>
                <div class="col-md-4">
                    <label>Sales Contract No.</label>
                    <input name="SalesContract" class="form-control" type="text" value="{{ $detail->U_Salescontract }}">
                </div>
                {{-- <div class="col-md-6">
                    <label>OSCA/PWD ID No.</label>
                    <input name="OscaPwd" class="form-control" type="text">
                </div>
                <div class="col-md-6">
                    <label>SC/PWD ID No.</label>
                    <input name="ScPwd" class="form-control" type="text">
                </div> --}}
            </div>      
            <div class="row" id="productContainer{{ $detail->DocEntry }}">
                @foreach ( $detail->dln1 as $product)
                    <div class="col-md-12 row"><h3 style="font-weight:bold; text-decoration: underline;">Product</h5></div> 
                    <div class="col-md-4">
                        <label>Description</label>
                        <input name="Description[]" class="form-control" type="text" value="{{ $product->U_Label_as }}">
                    </div>
                    <div class="col-md-4">
                        <label>Supplier Code</label>
                        <input name="SupplierCode[]" class="form-control" type="text" value="{{ $product->U_SupplierCode }}">
                    </div>
                    <div class="col-md-1">
                        <label>Cur</label>
                        <input name="DocCur[]" class="form-control" type="text" value="{{ $detail->DocCur }}">
                    </div>
                    <div class="col-md-2">
                        <label>Pkg</label>
                        <input name="Packing[]" class="form-control" type="text" value="{{ $product->U_Bagsperlot }}">
                    </div>
                    <div class="col-md-1">
                        <label>UoM</label>
                        <input name="Uom[]" class="form-control" type="text" value="{{ $product->U_packUOM }}">
                    </div>
                    <div class="col-md-2">
                        <label>Unit</label>
                        {{-- <input class="form-control" type="text" value="{{ !empty($product->Quantity) && !empty($product->U_Bagsperlot) && $product->U_Bagsperlot != 0 ? number_format($product->Quantity / $product->U_Bagsperlot, 2) : '' }}"> --}}
                        <input class="form-control" type="text" value="{{ number_format($product->U_Netweight) }}">
                    </div>
                    <div class="col-md-1">
                        <label>UoM</label>
                        <input class="form-control" name="printUom[]" type="text" value="{{ $product->U_printUOM}}">
                    </div>
                    <div class="col-md-3">
                        <label>Quantity</label>
                        <input class="form-control" name="Quantity[]" type="text" 
                        value="{{ $product->U_printUOM == 'lbs' 
                        ? number_format(2.2 * $product->Quantity, 2) 
                        : ($product->Quantity ? number_format($product->Quantity, 2) . (!empty($product->U_Netweight) ? ' ' . $product->U_printUOM : '') : '') }}">
                    </div>
                    <div class="col-md-2">
                        <label>Unit Price</label>
                        @if ($detail->DocCur == 'PHP')
                            <input class="form-control" type="text" name="UnitPrice[]" value="{{ !empty($product->LineTotal) && !empty($product->Quantity) && $product->Quantity != 0 ? ($product->LineTotal / $product->Quantity) : '' }}">
                        @else
                            <input class="form-control" type="text" name="UnitPrice[]"
                            value="{{ $product->U_printUOM == 'lbs' 
                            ? (($product->LineTotal / $product->Rate) / $product->Quantity / 2.2) 
                            : (!empty($product->LineTotal) && !empty($product->Quantity) && $product->Quantity != 0 && !empty($product->Rate) && $product->Rate != 0
                                ? (($product->LineTotal / $product->Rate) / $product->Quantity)
                                : '') }}" >
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label>Amount</label>
                        @if ($detail->DocCur == 'PHP')
                            <input class="form-control" name="Amount[]" type="text" value="{{ number_format($product->LineTotal, 2) }}" >
                        @else
                            <input class="form-control" name="Amount[]" type="text" value="{{ !empty($product->LineTotal) && !empty($product->Rate) && $product->Rate != 0 ? number_format($product->LineTotal / $product->Rate, 2) : '' }}" >
                        @endif
                    </div>
                @endforeach
        </div> 
            <div class="col-md-12 mt-3" style="padding: 20px;">
                <button type="button" class="btn btn-primary" id="addRowButton{{ $detail->DocEntry }}" >Add Row</button>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Remarks</label>
                    <textarea name="Remarks" class="form-control" rows="10">
                    </textarea>
                </div>
                <div class="col-md-6">
                    <label for="">Remark 2</label>
                    <textarea name="RemarksTwo" class="form-control" rows="10">
                    </textarea>
                </div>
                <div class="col-md-12">
                    <label for="">Payment Instruction</label>
                    <textarea name="PaymentInstruction" class="form-control" rows="10">
                        @if($detail && $detail->U_T3)
                        <?php
                            $intermediaryBankDetailsU_T1 = optional($detail)->U_T1;
                            $intermediaryBankDetailsU_T2 = optional($detail)->U_T2;
                            $intermediaryBankDetailsU_T3 = optional($detail)->U_T3;
                            $intermediaryBankDetailsU_T4 = optional($detail)->U_T4;
                            $intermediaryBankDetailsU_T5 = optional($detail)->U_T5;
                            $intermediaryBankDetailsU_T6 = optional($detail)->U_T6;
                    
                            $formattedText = trim(str_replace('/', "\n", $intermediaryBankDetailsU_T1));
                            $formattedText = preg_replace('/^\s+/m', '', $formattedText);
                    
                            $formattedText .= "\n" . str_replace('/', "\n", $intermediaryBankDetailsU_T2);
                            $formattedText = preg_replace('/^\s+/m', '', $formattedText);
                    
                            $formattedText .= "\n" . str_replace('/', "\n", $intermediaryBankDetailsU_T3);
                            $formattedText = preg_replace('/^\s+/m', '', $formattedText);
                    
                            $formattedText .= "\n" . str_replace('/', "\n", $intermediaryBankDetailsU_T4);
                            $formattedText = preg_replace('/^\s+/m', '', $formattedText);
                    
                            $formattedText .= "\n" . str_replace('/', "\n", $intermediaryBankDetailsU_T5);
                            $formattedText = preg_replace('/^\s+/m', '', $formattedText);
                    
                            $formattedText .= "\n" . str_replace('/', "\n", $intermediaryBankDetailsU_T6);
                            $formattedText = preg_replace('/^\s+/m', '', $formattedText);
                        ?>
                        {{ $formattedText }}
                    @endif</textarea>
                </div>
            </div>    
            <div class="col-md-6">
                @foreach ( $detail->dln1 as $arDetail)
                    <label>Date of Shipment</label>
                    <input name="DateOfShipment" class="form-control" type="date" value="{{ \Carbon\Carbon::parse(optional($detail)->U_BaseDate)->format('Y-m-d') }}">          
                @endforeach
            </div>
            <div class="col-md-6">
                <label>Port of Loading</label>
                <input name="PortOfLoading" class="form-control" type="text" value="{{ $detail->U_PortLoad }}">
            </div>
            <div class="col-md-6">
                <label>Port of Destination</label>
                <input name="PortOfDestination" class="form-control" type="text" value="{{ $detail->U_PortDestination }}">
            </div>
            <div class="col-md-6">
                <label>Mode of Shipment</label>
                <input name="ModeOfShipment" class="form-control" type="text" value="{{ $detail->U_ModeShip }}">
            </div>
            <div class="col-md-6">
                <label>Terms of Delivery</label>
                <input name="TermsOfDelivery" class="form-control" type="text" value="{{ $detail->U_Delivery }}">
            </div>
            <div class="col-md-6">
                <label>Fedder Vessel</label>
                <input name="FedderVessel" class="form-control" type="text" value="{{ $detail->U_FeedVessel }}">
            </div>
            <div class="col-md-6">
                <label>Ocean Vessel</label>
                <input name="OceanVessel" class="form-control" type="text" value="{{ $detail->U_OceanVessel }}">
            </div>
            <div class="col-md-6">
                <label>Bill of Lading No.</label>
                <input name="BillOfLading" class="form-control" type="text" value="{{ $detail->U_BillLading }}">
            </div>
            <div class="col-md-6">
                <label>Container No.</label>
                <input name="ContainerNo" class="form-control" type="text" value="{{ $detail->U_ContainerNo }}">
            </div>
            <div class="col-md-6">
                <label>Seal No.</label>
                <input name="SealNo" class="form-control" type="text" value="{{ $detail->U_Seal }}">
            </div>
            <div class="col-md-6">
                <label>Terms of Payment</label>
                <input name="TermsOfPayment" class="form-control" type="text" value="{{ $detail->whiOctg->PymntGroup }}">
            </div>
            <div class="col-md-6">
                @foreach ( $detail->dln1 as $arDetail)
                    <label>Invoice Due Date</label>
                    <input name="InvoiceDueDate" class="form-control" type="date" value="{{ \Carbon\Carbon::parse(optional($arDetail->oinvWhi)->DocDueDate)->format('Y-m-d')}}">
                @endforeach
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
        document.getElementById('addRowButton{{ $detail->DocEntry }}').addEventListener('click', function () {
            const productContainer = document.getElementById('productContainer{{ $detail->DocEntry }}');
            
            const newRow = `
            <div class="product-row">
                <div class="col-md-12 row"><h3 style="font-weight:bold; text-decoration: underline;">Product</h5></div> 
                <div class="col-md-4">
                    <label>Description</label>
                    <input name="Description[]" class="form-control" type="text" value="">
                </div>
                <div class="col-md-4">
                    <label>Supplier Code</label>
                    <input name="SupplierCode[]" class="form-control" type="text" value="">
                </div>
                <div class="col-md-1">
                    <label>Cur</label>
                    <input name="DocCur[]" class="form-control" type="text" value="">
                </div>
                <div class="col-md-2">
                    <label>Pkg</label>
                    <input name="Packing[]" class="form-control" type="text" value="">
                </div>
                <div class="col-md-1">
                    <label>UoM</label>
                    <input name="Uom[]" class="form-control" type="text" value="">
                </div>
                <div class="col-md-2">
                    <label>Unit</label>
                    <input class="form-control" type="text" value="">
                </div>
                <div class="col-md-1">
                    <label>Uom</label>
                    <input class="form-control" name="printUom[]" type="text" value="">
                </div>
                <div class="col-md-3">
                    <label>Quantity</label>
                    <input class="form-control" name="Quantity[]" type="text" value="">
                </div>
                <div class="col-md-2">
                    <label>Unit Price</label>
                    <input class="form-control" type="text" name="UnitPrice[]" value="">
                </div>
                <div class="col-md-4">
                    <label>Amount</label>
                    <input class="form-control" name="Amount[]" type="text" value="">
                </div>
                <div class="col-md-12 text-end mt-2">
                    <button type="button" class="btn btn-danger delete-row">Delete</button>
                </div>
            </div>
            `;

            productContainer.insertAdjacentHTML('beforeend', newRow);
            const deleteButtons = productContainer.querySelectorAll('.delete-row');
            deleteButtons.forEach((button) => {
                button.addEventListener('click', function () {
                    button.closest('.product-row').remove();
                });
            });
        });

        // Attach delete functionality to existing rows
        document.querySelectorAll('.delete-row').forEach((button) => {
            button.addEventListener('click', function () {
                button.closest('.product-row').remove();
            });
        });

    </script>