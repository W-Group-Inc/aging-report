<div class="modal fade" id="soaCommercialEdit{{ $detail->DocEntry }}" tabindex="-1" aria-labelledby="soaCommercialEditLabel" aria-hidden="true">
    <form method="POST" id="pbiBirCommercial" action="{{ url('whi_soa_save_as_new') }}" autocomplete="off">
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
                <div class="col-md-12">
                    <input name="DocEntry" class="form-control" type="hidden" value="{{ $detail->DocEntry }}">
                </div>
                <div class="col-md-6">
                    <label >Date:</label>
                    <input name="invoice_date" class="form-control" type="date" value="{{ \Carbon\Carbon::parse(optional($detail)->DocDueDate)->format('Y-m-d') }}">
                </div>
                <div class="col-md-6">
                    <label >SOA No:</label>
                    <input name="SoaNo" class="form-control" type="text" value="" required>
                </div>
                <div class="col-md-6">
                    <label >Sold To:</label>
                    <textarea name="Client" rows="3" class="form-control" type="text">{{ $detail->PayToCode }}</textarea>
                </div>
                <div class="col-md-6">
                    <label >Address:</label>
                    <textarea name="Address" rows="3" class="form-control" type="text">{{ $detail->Billtoaddress }}</textarea>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="">SOA Type</label>
                    <select class="form-control" name="soa_type" id="" required>
                      <option value="zero_rated">Zero Rate</option>
                      <option value="vatable">Vatable</option>
                      <option value="exempt">Exempt</option>
                    </select>
                  </div>
                <div class="col-md-3">
                    <label>Buyer's PO No.</label>
                    <input name="BuyersPo" class="form-control" type="text" value="{{ $detail->U_BuyersPO }}">
                </div>
                <div class="col-md-3">
                    <label>Buyer's Ref No.</label>
                    <input name="BuyersRef" class="form-control" type="text" value="{{ $detail->NumAtCard }}">
                </div>
                <div class="col-md-3">
                    <label>Sales Contract No.</label>
                    <input name="SalesContractNo" class="form-control" type="text" value="{{ $detail->U_Salescontract }}">
                </div>
                <div class="col-md-3">
                    <label>Cur</label>
                    <input name="Currency" class="form-control" type="text" value="{{ $detail->rdr1->first()->Currency }}">
                </div>
                <div class="col-md-3">
                    <label>Packing UoM</label>
                    @php
                        $bagsPerLot = $detail->rdr1->first()->U_Bagsperlot ?? 0;
                        $unit = $bagsPerLot > 1 ? 'bags' : ($bagsPerLot == 0 ? '' : 'bag');
                    @endphp
                    <input class="form-control" name="PackingUom" type="text" value="{{ $unit }}">
                </div>
                <div class="col-md-3">
                    <label>Unit Price UoM </label>
                    <input class="form-control" name="UnitOfM" type="text" value="{{ $detail->rdr1->first()->U_printUOM }}">
                </div>
                <div class="col-md-3">
                    <label>Payment Terms</label>
                    <input name="TermsOfPayment" class="form-control" type="text" value="{{ optional($detail->whiOctgs)->PymntGroup }}">
                </div>
                <div class="col-md-3">
                    <label>Invoice Due Date</label>
                    <input name="InvoiceDueDate" class="form-control" type="date" value="{{ optional($detail)->U_SAODueDate ? \Carbon\Carbon::parse(optional($detail)->U_SAODueDate)->format('Y-m-d') : '' }}">
                </div>
                <div class="col-md-3">
                    <label>Pickup Date</label>
                    <input name="PickupDate" class="form-control" type="date" value="{{ \Carbon\Carbon::parse(optional($detail)->DocDueDate)->format('Y-m-d') }}">
                </div>
                <div class="col-md-3">
                    <label>Mode of Delivery</label>
                    <input name="ModeOfDelivery" class="form-control" type="text" value="{{ $detail->U_ModeShip }}">
                </div>
                <div class="col-md-3">
                    <label>Terms of Delivery</label>
                    <input name="TermsOfDelivery" class="form-control" type="text" value="{{ $detail->U_Delivery }}">
                </div>
                <div class="col-md-12">
                    <label >Delivery Address:</label>
                    <textarea name="DeliveryAddress" class="form-control" type="text">{{ $detail->ShipToCode }} {{ $detail->Shiptoaddress}}</textarea>
                </div>
                {{-- <div class="col-md-4">
                    <label>Sales Contract No.</label>
                    <input name="SalesContract" class="form-control" type="text" value="{{ $detail->U_Salescontract }}">
                </div>  --}}
            </div>  
            <div class="row">
                <div class="col-md-12 row"><h4 style="font-weight:bold; color:red;">Additional Fields For EUR</h4></div> 
                <div class="col-md-4">
                    <label >Vat Number</label>
                    <input name="VatNumber" class="form-control" type="text" value="{{ $detail->U_TaxID }}">
                </div>
                <div class="col-md-4">
                    <label>OSCA/PWD ID No.</label>
                    <input name="OscaPwd" class="form-control" type="text">
                </div>
                <div class="col-md-4">
                    <label>SC/PWD ID No.</label>
                    <input name="ScPwd" class="form-control" type="text">
                </div>
                <div class="col-md-6">
                    <label>Date Of Shipment</label>
                    <input name="DateOfShipment" class="form-control" type="date" value="{{ \Carbon\Carbon::parse(optional($detail)->DocDueDate)->format('Y-m-d') }}">
                </div>
                <div class="col-md-6">
                    <label >Place of Loading:</label>
                    <input name="PlaceOfLoading" class="form-control" type="text" value="{{ $detail->U_PortLoad }}">
                </div>
            </div>    
            <div class="row">
                <div class="col-md-12 row"><h4 style="font-weight:bold; color:red;">Additional Fields For PHP</h4></div> 
                <div class="col-md-4">
                    <label >TIN</label>
                    <input name="Tin" class="form-control" type="text" value="">
                </div>
                <div class="col-md-4">
                    <label>Business Style.</label>
                    <input name="BussinessStyle" class="form-control" type="text">
                </div>
                <div class="col-md-4">
                    <label>Feeder Vessel</label>
                    <input name="FeederVessel" class="form-control" type="text">
                </div>
                <div class="col-md-3">
                    <label>Ocean Vessel</label>
                    <input name="OceanVessel" class="form-control" type="text" value="">
                </div>
                <div class="col-md-3">
                    <label>Airway Bill No.</label>
                    <input name="AirwayBillNo" class="form-control" type="text" value="">
                </div>
                <div class="col-md-3">
                    <label>Container No.</label>
                    <input name="ContainerNo" class="form-control" type="text" value="">
                </div>
                <div class="col-md-3">
                    <label>Seal No</label>
                    <input name="SealNo" class="form-control" type="text" value="">
                </div>
            </div>    
                <div class="row" id="soaContainerWhi{{ $detail->DocEntry }}">
                @foreach ( $detail->rdr1 as $product)
                <div class="col-md-12 row"><h3 style="font-weight:bold; text-decoration: underline;">Product</h3></div> 
                
                <div class="col-md-6">
                    <label>Description</label>
                    <input name="Description[]" style="white-space: pre;" class="form-control" type="text" value="{{ $product->U_Label_as }}">
                </div>
                <div class="col-md-3">
                    <label>Packing</label>
                    <input name="Packing[]" style="white-space: pre;" class="form-control" type="text" value="{{ $product->U_Bagsperlot }}">
                </div>
                <div class="col-md-3">
                    <label>Unit</label>
                    <input name="Unit[]" style="white-space: pre;" class="form-control" type="text" value="{{ $product->U_Netweight }}">
                </div>
                <div class="col-md-4">
                    <label>Quantity</label>
                    <input class="form-control" name="Quantity[]" type="text" value="{{ $product->U_printUOM == 'lbs' ? number_format($product->Quantity * 2.2, 2) : number_format($product->Quantity, 2) }}" >
                </div>
                <div class="col-md-4">
                    <label>Unit Price</label>
                    <input class="form-control" name="UnitPrice[]" type="text" value="{{ $product->U_printUOM == 'lbs' ? number_format($product->Price / 2.2, 2) : number_format($product->Price, 2) }}" >
                </div>
                <div class="col-md-4">
                    <label>Amount</label>
                    <input class="form-control" name="Amount[]" type="text" value="{{ number_format(($product->Quantity) * ($product->Price), 2) }}" >
                </div>
                @endforeach
            </div>   
            <div class="col-md-12 mt-3" style="padding: 20px;">
                <button type="button" class="btn btn-primary" id="soaAddRow{{ $detail->DocEntry }}" >Add Row</button>
            </div>
            <div class="row">
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <label for="">Payment Instruction</label>
                    <textarea name="PaymentInstruction" class="form-control" rows="10">
                        <?php
                            // Collect intermediary bank details safely
                            $intermediaryBankDetails = [
                                optional($detail)->U_T1,
                                optional($detail)->U_T2,
                                optional($detail)->U_T3,
                                optional($detail)->U_T4,
                                optional($detail)->U_T5,
                                optional($detail)->U_T6
                            ];
                            
                            // Clean and format each part
                            $intermediaryBankDetails = array_map(function ($item) {
                                return trim($item);
                            }, array_filter($intermediaryBankDetails)); // Remove empty values
                            
                            // Convert all `/` into new lines
                            $formattedDetails = preg_replace('/\s*\/\s*/', "\n", implode(' / ', $intermediaryBankDetails));
                            ?>

                            {{ $formattedDetails }} 
                        </textarea>
                </div>
            </div>  
            <div class="row">
                <div class="col-md-10">
                    <label for="">PHREX</label>
                    <textarea name="Phrex" class="form-control" rows="7">
                        The Exporter PHREX2020P02A23JUN0000010257 of the products covered by this 
                        document declares that, except where otherwise clearly indicated, these products
                         are of  Philippine preferential origin according to the rules of origin of the 
                         Generalised System of Preferences of the European Union and that the origin 
                         criterion met is "W".
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

        document.getElementById('soaAddRow{{ $detail->DocEntry }}').addEventListener('click', function () {
            const soaContainerWhi = document.getElementById('soaContainerWhi{{ $detail->DocEntry }}');
            const newRow = `
            <div class="product-row">
                <div class="col-md-12 row"><h3 style="font-weight:bold; text-decoration: underline;">Product</h3></div> 
                <div class="col-md-6">
                    <label>Description</label>
                    <input name="Description[]" style="white-space: pre;" class="form-control" type="text" value="">
                </div>
                <div class="col-md-3">
                    <label>Packing</label>
                    <input name="Packing[]" style="white-space: pre;" class="form-control" type="text" value="">
                </div>
                <div class="col-md-3">
                    <label>Unit</label>
                    <input name="Unit[]" style="white-space: pre;" class="form-control" type="text" value="">
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
                <div class="col-md-12 text-end mt-2">
                    <button type="button" class="btn btn-danger delete-row">Delete</button>
                </div>
            </div>
            `;

            soaContainerWhi.insertAdjacentHTML('beforeend', newRow);
            const lastAddedRow = soaContainerWhi.lastElementChild;
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
            const deleteButtons = soaContainerWhi.querySelectorAll('.delete-row');
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