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
                <div class="col-md-12">
                    <label >Sold To:</label>
                    <input name="Client" class="form-control" type="text" value="{{ $detail->asNew->Address }}">
                </div>
                {{-- <div class="col-md-12">
                    <label>Address</label>
                    <input name="Address" class="form-control" type="text" value="{{ $detail->asNew->Address }}">
                </div> --}}
                <div class="col-md-12">
                    <label>Ship To</label>
                    <input name="ShipTo" class="form-control" type="text" value="{{ $detail->asNew->ShipTo }}">
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
                    <input name="TermsOfPayement" class="form-control" type="text" value="{{ $detail->asNew->TermsOfPayment }}">
                </div>
                <div class="col-md-4">
                    <label>SO #</label>
                    @foreach ( $detail->dln1 as $item)
                    <input name="SoNo" class="form-control" type="text" value="{{ $detail->asNew->SoNo}}">
                    @endforeach
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
            <div class="col-md-12 row"><h3>Product</h5></div> 
            <div class="row">
            @foreach ( $detail->asNew->products as $product)
            <div class="col-md-12">
                <input name="product_id[]" class="form-control" type="hidden" value="{{  $product->id }}">
            </div>
            <div class="col-md-12">
                <label>Product Code</label>
                <input name="ProductCode[]" class="form-control" type="text" value="{{  $product->ProductCode }}">
            </div>
            <div class="col-md-12">
                <label>Description</label>
                <input name="Description[]" class="form-control" type="text" value="{{ $product->Description }}">
            </div>
            {{-- <div class="col-md-6">
                <label>Supplier Code</label>
                <input name="SupplierCode[]" class="form-control" type="text" value="{{ $product->U_SupplierCode }}">
            </div> --}}
            <div class="col-md-6">
                <label>Currency</label>
                <input name="DocCur[]" class="form-control" type="text" value="{{ $product->DocCur }}">
            </div>
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
            <div class="col-md-6">
                <label>Unit of Measurement</label>
                <input class="form-control" name="printUom[]" type="text" value="{{ $product->printUom}}">
            </div>
            <div class="col-md-4">
                <label>Quantity</label>
                <input class="form-control" name="Quantity[]" type="text" value="{{ number_format($product->Quantity,2) }}">
            </div>
            <div class="col-md-4">
                <label>Unit Price</label>
                    {{-- <input class="form-control" type="text" value="{{ !empty($product->Amount) && !empty($product->Quantity) && $product->Quantity != 0 ? number_format($product->Amount / $product->Quantity, 2) : '' }}" readonly> --}}
                    <input class="form-control" type="text" value="{{ $product->UnitPrice}}">
            </div>
            <div class="col-md-4">
                <label>Amount</label>
                    <input class="form-control" name="Amount[]" type="text" value="{{ number_format($product->Amount, 2) }}">
            </div>
            <div class="col-md-4">
                <input class="form-control" name="PbiSiType[]" type="hidden" value="">
            </div>
            <div class="col-md-12">
                <label for="">Payment Instruction</label>
                <textarea name="PaymentInstruction" class="form-control" rows="10">
                    {{ $detail->asNew->PaymentInstruction }}
                </textarea>
            </div>
            @endforeach
            </div>  
            <div class="col-md-12 row"><h3>Breakdown</h5></div> 
                <div class="row" style="margin: 0;">
                    <div class="col-md-12" style="margin: 0; padding: 0;">
                        <div class="mt-4">
                            @foreach ($detail->asNew->clientRequest as $cRequest) 
                                <table class="table table-bordered" id="customer_request{{ $cRequest->id }}" style="margin: 0; padding: 0;">
                                    <tbody>
                                        <tr>
                                            <input name="product_id[]" class="form-control" type="hidden" value="{{  $cRequest->id }}">
                                            <td><input type="text" name="ProductCode[]" class="form-control" value="{{ $cRequest->ProductCode }}"></td>
                                            <td><input type="text" name="Description[]" class="form-control" value="{{ $cRequest->Description }}"></td>
                                            <td><input type="text" name="Amount[]" class="form-control" value="{{ $cRequest->Amount }}"></td>
                                            <td><input type="hidden" name="PbiSiType[]" class="form-control" value="PbiSi"></td>
                                            <td><input type="hidden" name="UnitPrice[]" class="form-control" value="0"></td>
                                        </tr>
                                    </tbody>
                                </table> 
                            @endforeach    
                            <div class="row" style="margin-top: 20px; padding: 0;">
                                <button type="button" class="btn btn-primary" id="addRowBtn{{ $detail->id }}" style="margin-top: 0;">Add Row</button>            
                            </div>
                        </div>  
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
        @foreach ($detail->asNew->clientRequest as $cRequest)
            document.getElementById('addRowBtn{{ $detail->id }}').addEventListener('click', function() {
                const table = document.getElementById('customer_request{{ $cRequest->id }}').getElementsByTagName('tbody')[0];
                const newRow = table.rows[0].cloneNode(true);
                
                const inputs = newRow.getElementsByTagName('input');
                for (let input of inputs) {
                    if (input.name !== 'PbiSiType[]') {
                        input.value = ''; 
                    }
                }
                table.appendChild(newRow);
            });
        @endforeach
    </script>
    