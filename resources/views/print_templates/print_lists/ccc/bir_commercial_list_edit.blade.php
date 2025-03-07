<div class="modal fade" id="CccBirCommercialEdit{{ $detail->DocEntry }}" tabindex="-1" aria-labelledby="birCommercialEditLabel" aria-hidden="true">
    <form method="POST" id="birCommercial" action="{{ url('save_as_new_invoice_ccc') }}" autocomplete="off">
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
                    <input name="DocEntry" class="form-control" type="text" value="{{ $detail->DocEntry }}">
                </div>
                <div class="col-md-12">
                    <label >Date:</label>
                    <input name="invoice_date" class="form-control" type="date" value="{{ \Carbon\Carbon::parse($detail->DocDueDate)->format('Y-m-d') }}">
                </div>
                <div class="col-md-12">
                    <label >Sold To:</label>
                    <input name="Client" class="form-control" type="text" value="{{ $detail->PayToCode }}">
                </div>
                <div class="col-md-12">
                    <label>Address</label>
                    <input name="ClientAddress" class="form-control" type="text" value="{{ $detail->Address }}">
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
                </div>
            </div>      
            <div class="col-md-12 row"><h3>Product</h5></div> 
            <div class="row">
            @foreach ( $detail->ccc_products as $product)
                <div class="col-md-12">
                    <label>Description</label>
                    <input name="Description[]" class="form-control" type="text" value="{{ $product->U_Label_as}}">
                </div>
                <div class="col-md-6">
                    <label>Currency</label>
                    <input name="DocCur[]" class="form-control" type="text" value="{{ $detail->DocCur }}">
                </div>
                <div class="col-md-6">
                    <label>Quantity</label>
                    <input class="form-control" name="Quantity[]" type="text" value="{{ ($product->Quantity) }}" readonly>
                </div>
                <div class="col-md-6">
                    <label>Unit of Measurement</label>
                    <input class="form-control" name="printUom[]" type="text" value="{{ $product->U_printUOM}}">
                </div>
                <div class="col-md-6">
                    <label>Unit Price</label>
                    <input class="form-control" name="UnitPrice[]" type="text" value="{{ !empty($product->Price) ? number_format($product->Price, 2) : '' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label>Amount</label>
                    @if ($detail->DocCur == 'PHP')
                        <input class="form-control" name="Amount[]" type="text" value="{{ ($product->LineTotal) }}" >
                    @else
                        <input class="form-control" name="Amount[]" type="text" value="{{ !empty($product->LineTotal) && !empty($product->Rate) && $product->Rate != 0 ? ($product->LineTotal / $product->Rate) : '' }}" >
                    @endif
                </div>
            @endforeach
            </div>   
            <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                    <label for="">Remarks</label>
                    <textarea name="Remarks" class="form-control" rows="10">
                    </textarea>
                </div>
                <div class="col-md-6">
                    <label for="">Payment Instruction</label>
                    <textarea name="PaymentInstruction" class="form-control" rows="10">
                        @if($detail && $detail->U_T3)
                        <?php
                            $intermediaryBankDetailsU_T1 = optional($details->first())->U_T1;
                            $intermediaryBankDetailsU_T2 = optional($details->first())->U_T2;
                            $intermediaryBankDetailsU_T3 = optional($details->first())->U_T3;
                            $intermediaryBankDetailsU_T4 = optional($details->first())->U_T4;
                            $intermediaryBankDetailsU_T5 = optional($details->first())->U_T5;
                            $intermediaryBankDetailsU_T6 = optional($details->first())->U_T6;
                    
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
                        @endif
                    </textarea>                    
                </div>
                <div class="col-md-6">
                    <label>Date of Shipment</label>
                    <input name="DateOfShipment" class="form-control" type="date" value="{{ \Carbon\Carbon::parse($detail->DocDueDate)->format('Y-m-d') }}">
                </div>
                <div class="col-md-6">
                    <label>Port of Loading</label>
                    <input name="PortOfLoading" class="form-control" type="text" value="{{ $detail->U_PlaceLoading }}">
                </div>
                <div class="col-md-6">
                    <label>Port of Destination</label>
                    <input name="PortOfDestination" class="form-control" type="text" value="{{ $detail->U_Destinationport }}">
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
                    <input name="FedderVesssel" class="form-control" type="text" value="{{ $detail->U_Feeder }}">
                </div>
                <div class="col-md-6">
                    <label>Ocean Vessel</label>
                    <input name="OceanVessel" class="form-control" type="text" value="{{ $detail->U_Ocean }}">
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
                    <input name="TermOfPayment" class="form-control" type="text" value="{{ $detail->cccOctg->PymntGroup }}">
                </div>
                <div class="col-md-6">
                    <label>Invoice Due Date</label>
                    <input name="InvoiceDueDate" class="form-control" type="date" value="{{ \Carbon\Carbon::parse($detail->U_SAODueDate)->format('Y-m-d')}}">
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