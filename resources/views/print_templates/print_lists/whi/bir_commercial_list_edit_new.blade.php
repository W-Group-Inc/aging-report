@if ( $detail->asNew)
<div class="modal fade" id="birCommercialEditNew{{  $detail->asNew->id }}" tabindex="-1" aria-labelledby="birCommercialEditLabel" aria-hidden="true">
    <form method="POST" id="birCommercial" action="{{ url('edit_new_invoice/' . $detail->asNew->id) }}" autocomplete="off">
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
                    @foreach ( $detail->dln1 as $arDetail)
                    <label >Date:</label>
                    <input name="invoice_date" class="form-control" type="date" value="{{ \Carbon\Carbon::parse(optional($arDetail->oinvWhi)->DocDate)->format('Y-m-d') }}">
                    @endforeach
                </div>
                <div class="col-md-12">
                    <label >Sold To:</label>
                    <input name="SoldTo" class="form-control" type="text" value="{{  $detail->asNew->SoldTo }}">
                </div>
                <div class="col-md-12">
                    <label>Address</label>
                    <input name="Address" class="form-control" type="text" value="{{  $detail->asNew->Address }}">
                </div>
                {{-- <div class="col-md-6">
                    <label>TIN</label>
                    <input name="Tin" class="form-control" type="text" value="{{  $detail->asNew->Tin }}">
                </div>
                <div class="col-md-6">
                    <label>Business Style</label>
                    <input name="BusinessStyle" class="form-control" type="text" value="{{  $detail->asNew->BusinessStyle }}">
                </div> --}}
                <div class="col-md-4">
                    <label>Buyer's PO No.</label>
                    <input name="BuyersPo" class="form-control" type="text" value="{{  $detail->asNew->BuyersPo }}">
                </div>
                <div class="col-md-4">
                    <label>Buyer's Ref No.</label>
                    <input name="BuyersRef" class="form-control" type="text" value="{{  $detail->asNew->BuyersRef }}">
                </div>
                <div class="col-md-4">
                    <label>Sales Contract No.</label>
                    <input name="SalesContract" class="form-control" type="text" value="{{  $detail->asNew->SalesContract }}">
                </div>
                {{-- <div class="col-md-6">
                    <label>OSCA/PWD ID No.</label>
                    <input name="OscaPwd" class="form-control" type="text" value="{{  $detail->asNew->OscaPwd }}">
                </div>
                <div class="col-md-6">
                    <label>SC/PWD ID No.</label>
                    <input name="ScPwd" class="form-control" type="text" value="{{  $detail->asNew->ScPwd }}">
                </div> --}}
            </div>      
            <div class="col-md-12 row"><h3>Product</h5></div> 
            <div class="row">
            @foreach (  $detail->asNew->products as $product)
            <div class="col-md-12">
                <input name="product_id[]" class="form-control" type="hidden" value="{{  $product->id }}">
            </div>
            <div class="col-md-12">
                <label>Description</label>
                <input name="Description[]" class="form-control" type="text" value="{{ $product->Description }}">
            </div>
            <div class="col-md-3">
                <label>Packing</label>
                <input name="Packing[]" class="form-control" type="text" value="{{ $product->Packing }}">
            </div>
            <div class="col-md-3">
                <label>Unit of Measurement</label>
                <input name="Uom[]" class="form-control" type="text" value="{{ $product->Uom }}">
            </div>
            <div class="col-md-3">
                <label>Unit</label>
                <input class="form-control" type="text" value="{{ !empty($product->Quantity) && !empty($product->Packing) && $product->Packing != 0 ? number_format($product->Quantity / $product->Packing, 2) : '' }}" readonly>
            </div>
            <div class="col-md-3">
                <label>Unit of Measurement</label>
                <input class="form-control" name="printUom[]" type="text" value="{{ $product->printUom}}">
            </div>
            <div class="col-md-4">
                <label>Quantity</label>
                <input class="form-control" name="Quantity[]" type="text" value="{{ number_format($product->Quantity,2) }}" readonly>
            </div>
            <div class="col-md-4">
                <label>Unit Price</label>
                <input class="form-control" type="text" value="{{ !empty($product->Amount) && !empty($product->Quantity) && $product->Quantity != 0 ? number_format($product->Amount / $product->Quantity, 2) : '' }}" readonly>
            </div>
            <div class="col-md-4">
                <label>Amount</label>
                <input class="form-control" name="Amount[]" type="text" value="{{ number_format($product->Amount, 2) }}" >
            </div>
            @endforeach
            <div class="row">
                <div class="col-md-6">
                    <label for="">Remarks</label>
                    <textarea name="Remarks" class="form-control" rows="10">
                        {{ $detail->asNew->Remarks }}
                    </textarea>
                </div>
                <div class="col-md-6">
                    <label for="">Remark 2</label>
                    <textarea name="RemarksTwo" class="form-control" rows="10">
                        {{ $detail->asNew->RemarksTwo }}
                    </textarea>
                </div>
                <div class="col-md-12">
                    <label for="">Payment Instruction</label>
                    <textarea name="PaymentInstruction" class="form-control" rows="10">
                        {{ $detail->asNew->PaymentInstruction }}
                    </textarea>
                </div>
            </div> 
            <div class="col-md-6">
                <label>Date of Shipment</label>
                <input name="DateOfShipment" class="form-control" type="date" value="{{ \Carbon\Carbon::parse(optional($detail->asNew)->DateOfShipment)->format('Y-m-d') }}">
            </div>
            <div class="col-md-6">
                <label>Port of Loading</label>
                <input name="PortOfLoading" class="form-control" type="text" value="{{ $detail->asNew->PortOfLoading }}">
            </div>
            <div class="col-md-6">
                <label>Port of Destination</label>
                <input name="PortOfDestination" class="form-control" type="text" value="{{ $detail->asNew->PortOfDestination }}">
            </div>
            <div class="col-md-6">
                <label>Mode of Shipment</label>
                <input name="ModeOfShipment" class="form-control" type="text" value="{{ $detail->asNew->ModeOfShipment }}">
            </div>
            <div class="col-md-6">
                <label>Terms of Delivery</label>
                <input name="TermsOfDelivery" class="form-control" type="text" value="{{ $detail->asNew->TermsOfDelivery }}">
            </div>
            <div class="col-md-6">
                <label>Fedder Vessel</label>
                <input name="FedderVessel" class="form-control" type="text" value="{{ $detail->asNew->FedderVessel }}">
            </div>
            <div class="col-md-6">
                <label>Ocean Vessel</label>
                <input name="OceanVessel" class="form-control" type="text" value="{{ $detail->asNew->OceanVessel }}">
            </div>
            <div class="col-md-6">
                <label>Bill of Lading No.</label>
                <input name="BillOfLading" class="form-control" type="text" value="{{ $detail->asNew->BillOfLading }}">
            </div>
            <div class="col-md-6">
                <label>Container No.</label>
                <input name="ContainerNo" class="form-control" type="text" value="{{ $detail->asNew->ContainerNo }}">
            </div>
            <div class="col-md-6">
                <label>Seal No.</label>
                <input name="SealNo" class="form-control" type="text" value="{{ $detail->asNew->SealNo }}">
            </div>
            <div class="col-md-6">
                <label>Terms of Payment</label>
                <input name="TermsOfPayment" class="form-control" type="text" value="{{ $detail->asNew->TermsOfPayment }}">
            </div>
            <div class="col-md-6">
                <label>Invoice Due Date</label>
                <input name="InvoiceDueDate" class="form-control" type="date" value="{{ \Carbon\Carbon::parse(optional($detail->asNew)->InvoiceDueDate)->format('Y-m-d')}}">
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
@endif