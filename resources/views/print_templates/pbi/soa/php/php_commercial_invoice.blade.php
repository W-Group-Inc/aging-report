
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Commercial Invoice</title>
    
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }
        .header-container {
            display: table; 
            width: 100%; 
            padding-bottom: 10px; 
            margin-bottom: 20px; 
        }
        .header-container .left .header .line-two {
            font-size: 11px;
        }
        .header-container .left .header .line-three {
            margin-top: 30px;
            font-size: 16px;
            font-weight: bold;
        }
        .header-container .left .header .date {
            margin-top: 30px;
            font-size: 9px;
        }
        .header-small-text{
            font-size: 12px;
            display: block;
            margin-left: 110px
        }
        .left, .right {
            display: table-cell;
            vertical-align: top;
        }
        .left {
            width: 50%;
        }
        .right {
            width: 50%;
        }
        .header-large-text{
            font-size: 26px;
            font: bold;
        }
        .header-medium-text{
          font-size: 8px;
          display: block;
        }
        
        .customer-container {
            width: 100%;
        }
        .customer-container::after {
            content: "";
            display: table;
            clear: both;
        }
        .left-column, .right-column {
            float: left; 
            width: 55%; 
            font-size: 12px;
            line-height: 1.5;
        }
        /* .right-column {
            margin-left: 50px; 
        } */
        .info-row {
            margin-bottom: 5px; /* Space between rows */
        }
        .info-row span {
            display: inline-block; /* Align label and value on the same line */
            vertical-align: top;   /* Ensure alignment between label and value */
        }
        .info-label {
            width: 30%; /* Fixed width for labels */
            display: inline-block;
            margin-right: 0;
            vertical-align: top;   /* Align the label with the top of the value */
        }
        .info-value {
            width: 43%; /* Width for values */
            word-wrap: break-word; /* Allow long values to break to the next line */
            vertical-align: top;   /* Align the value with the top */
        }
        .product-details .top-table {
            margin-top: 10px;
            width: 100%;
            border-collapse: collapse; /* Collapses table borders */
            font-size: 12px;
        }
        .product-details .top-table th{
            border: 1px solid #000; /* Table cell borders */
            text-align: center; /* Align text to the left */
        }
        .product-details .top-table td{
            padding: 8px; /* Padding inside cells */
            border-left: 1px solid #000;
            text-align: center; /* Align text to the left */

            border-right: 1px solid #000;
        }
        .product-details .top-table tbody tr:last-child td {
            border-bottom: 1px solid #000;
        }
        .middle-table{
            width: 100%;
            border-collapse: collapse; /* Collapses table borders */
            font-size: 12px;
        }
        .middle-table tr:last-child td {
            border-bottom: 1px solid black;
            
        }
        .middle-table tr{
            border-right: 1px solid black;
            border-left: 1px solid black;
            padding: 10px;
            
        }
        .middle-table .label-column{
            text-align: left;
            width: 30%;
        }
        .middle-table .value-column {
            width: 10%;

        }
        .bottom-table{
            width: 100%;
            border-collapse: collapse; /* Collapses table borders */
            font-size: 12px;
        }
        .bottom-table tr:last-child td {
            border-bottom: 1px solid black;
            
        }
        .bottom-table tr{
            border-right: 1px solid black;
            border-left: 1px solid black;
            padding: 10px;
            vertical-align: top
            
        }
        .bottom-table .label-column{
            text-align: left;
            width: 12%;
            padding-left: 0px;
        }

        .bottom-table .value-column{
            text-align: left;
            width: 44%;
            /* padding-left: 10px */
        }
        /* New */
        .new-row {
            clear: both; 
            width: 100%; /* Ensures full width */
            display: block; /* Block display to break to a new line */
        }
        .footer {
            width: 100%;
            position: fixed; 
            bottom: 0;
            font-size: 12px;
        }
        .footer-left {
            float: left; 
            line-height: 0;
        }

        .footer-right {
            float: right; 
            line-height: 0;

        }
    </style>
</head>
<body>
    
<div class="header-container">
    <div class="left">
        <div class="header">
            <div class="line-two">WS-L3-FM-23</div>
            <div class="new-row">
              <div class="group">
                <div class="image" style="float: left">
                  <img src="{{ asset('/images/pbi_logo.webp')}}" alt="Company Logo" style="width: 100px; width:100px"> 
            </div>
            <div class="text">
              <span class="header-small-text">PHILIPPINE BIO INDUSTRIES, INC.</span>
              <span class="header-small-text">103 Integrity Avenue, Carmelray Industrial</span>
              <span class="header-small-text">Park 1, Canlubang, Calamba City,</span>
              <span class="header-small-text">Laguna 4028, Philippines</span>
              <span class="header-small-text">Tel: (02) 8856-3838 / Fax (02) 8856-1033</span>
            </div>
              </div>
            </div>
        </div>
    </div>
    <div class="right">
        <div style="margin:10px 0 0 30px;text-align: left; font-size: 12px;">
            <span class=""> VAT REG. TIN: 000-316-923-000</span>
        </div>
    </div>
</div>

<div class="content">
    <div class="customer-container" style="margin-bottom: 15px">
        <div class="left-column">
      
        </div>
        <div class="right-column">
            <div class="info-row">
                <span style="font-size: 17px;"><strong>SALES INVOICE</strong></span>
            </div>
            <div class="info-row">
              <span style="font-size: 17px;color:red"><strong>NO. {{ optional($details->first())->SoaNo }}</strong></span>
          </div>
        </div>
      </div>
      <div class="customer-container">
          <div class="left-column">
              <div class="info-row">
                  <span class="info-label">Sold To:</span>
                  <span class="info-value">{{ optional($details->first())->SoldTo }}</span>
              </div>
              <div class="info-row">
                  <span class="info-label">Address:</span>
                  <span class="info-value">{!! nl2br(e(optional($details->first())->Address)) !!}</span>
              </div>
              <div class="info-row">
                <span class="info-label">Ship To:</span>
                <span class="info-value">{!! nl2br(e(optional($details->first())->PlaceOfDelivery)) !!}</span>
            </div>
              <div class="info-row">
                  <span class="info-label">TIN:</span>
                  <span class="info-value">{{ optional($details->first())->Tin }}</span>
              </div>
              <div class="info-row">
                  <span class="info-label">Business Style:</span>
                  <span class="info-value">{{ optional($details->first())->BusinessStyle }}</span>
              </div>
          </div>
          <div class="right-column">
              <div class="info-row">
                  <span class="info-label">Date:</span>
                  <span class="info-value">{{ optional($details->first())->InvoiceDate ? \Carbon\Carbon::parse(optional($details->first())->InvoiceDate)->format('F j, Y') : '' }}</span>
              </div>
              <div class="info-row">
                  <span class="info-label">Customers PO. #:</span>
                  <span class="info-value">{{ optional($details->first())->BuyersPo }}</span>
              </div>
              <div class="info-row">
                  <span class="info-label">Buyers Ref. No.:</span>
                  <span class="info-value">{{ optional($details->first())->BuyersRef }}</span>
              </div>
              <div class="info-row">
                <span class="info-label">Terms / Due Date:</span>
                <span class="info-value">{{ optional($details->first())->InvoiceDueDate ? \Carbon\Carbon::parse(optional($details->first())->InvoiceDueDate)->format('F j, Y') : '' }}</span>
            </div>
              <div class="info-row">
                  <span class="info-label">Payment Terms:</span>
                  <span class="info-value">{{ optional($details->first())->TermsOfPayment }}</span>
              </div>
              <div class="info-row">
                  <span class="info-label">SO #:</span>
                  <span class="info-value">{{ optional($details->first())->SoNo }}</span>
              </div>
              <div class="info-row">
                <span class="info-label">DR #:</span>
                <span class="info-value">{{ optional($details->first())->DrNo }}</span>
            </div>
            <div class="info-row">
              <span class="info-label">Container #:</span>
              <span class="info-value">{{ optional($details->first())->ContainerNo }}</span>
          </div>
          <div class="info-row">
            <span class="info-label">Seal #:</span>
            <span class="info-value">{{ optional($details->first())->SealNo }}</span>
        </div>
          </div>
      </div>
      <div class="product-details">
          <table class="top-table">
              <thead>
                  <tr>
                      <th>PRODUCT CODE</th>
                      <th>PRODUCT DESCRIPTION</th>
                      <th>QUANTITY</th>
                      <th>UNIT PRICE</th>
                      <th>AMOUNT</th>
                  </tr>
              </thead>
              @php
                  $total = 0;
                  $value_added_tax = 0;
                  $total_amount_payable = 0;
              @endphp
              @foreach ($details as $detail)
              
                <td></td>
                <td></td>
                <td>{{ $detail->Uom }}</td>
                <td>{{ $detail->Currency }}</td>
                <td>{{ $detail->Currency }}</td>
              <tbody>
                @foreach ($detail->soaProduct as $product)
                    @php
                    $total += $product->Amount;
                    $vatable_amount = 0;
                    // if (($detail)->DocCur == 'EUR') {
                    //         $vatable_amount = 0.21 * $product->TotalFrgn;
                    //         $value_added_tax += $vatable_amount;
                    //     } else {
                            $vatable_amount = 0.12 * $product->Amount;
                            $value_added_tax += $vatable_amount;
                        // }
                @endphp
                @php
                    $total_amount_payable = $total + $value_added_tax;
                @endphp
            
                <tr>
                    <td style="text-align: left;">{{ $product->ProductCode }}</td>
                    <td style="text-align: left;">{{ $product->Description }}</td>
                    <td>{{ ($product->Quantity) }}</td>
                    <td>{{ ($product->UnitPrice) }}</td>
                    <td>{{ ($product->Amount) }}</td>
                </tr>
                @if ($details->first()->Type == 'vatable')

                    <tr>
                        <td></td>
                        <td style="text-align: left">Add 12% Vat</td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format($vatable_amount,2) }}</td>
                    </tr>
                @endif
                <tr >
                    <td></td>
                    <td style="text-align: left">{!! nl2br(e(optional($details->first())->Remarks)) !!}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
              
              </tbody>
              @endforeach
          </table>
          <table class="middle-table"  style="margin-top:0; border-top:none;">
            <tbody >
                @if ($details->first()->Type == 'zero_rated')
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="label-column">Vatable Sales</td>
                        <td class="value-column"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="label-column">VAT Exempt Sale</td>
                        <td class="value-column"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="label-column">VAT Zero Rated Sales</td>
                        <td class="value-column">{{ (number_format($total,2)) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="label-column">Total Sales</td>
                        <td class="value-column"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="label-column">Value Added Tax</td>
                        <td class="value-column"></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                    <td class="label-column">Total Amount Payable</td>
                    <td class="value-column">{{ (number_format($total,2)) }}</td>
                </tr>
                @elseif ($details->first()->Type == 'vatable')
                <tr>
                    <td></td>
                    <td></td>
                    <td class="label-column">Vatable Sales</td>
                    <td class="value-column">{{ (number_format($total,2)) }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="label-column">VAT Exempt Sale</td>
                    <td class="value-column"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="label-column">VAT Zero Rated Sales</td>
                    <td class="value-column"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="label-column">Total Sales</td>
                    <td class="value-column"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="label-column">Value Added Tax</td>
                    <td class="value-column">{{ (number_format($value_added_tax,2)) }}</td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td class="label-column">Total Amount Payable</td>
                  <td class="value-column">{{ (number_format($total_amount_payable,2)) }}</td>
              </tr>
              @elseif ($details->first()->Type == 'exempt')
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="label-column">Vatable Sales</td>
                        <td class="value-column"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="label-column">VAT Exempt Sale</td>
                        <td class="value-column">{{ (number_format($total,2)) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="label-column">VAT Zero Rated Sales</td>
                        <td class="value-column"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="label-column">Total Sales</td>
                        <td class="value-column"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="label-column">Value Added Tax</td>
                        <td class="value-column"></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                    <td class="label-column">Total Amount Payable</td>
                    <td class="value-column">{{ (number_format($total,2)) }}</td>
                </tr>
                @endif
            </tbody>
        </table>
        <table class="bottom-table"  style="margin-top:0; border-top:none;">
          <tbody >
              <tr style="">
                  <td class="label-column">Please Remit Payment To</td>
                  <td class="value-column">
                    <span>{!! nl2br(e(optional($details->first())->PaymentInstruction)) !!}</span>
                    </td>
                @php
                    $name = auth()->user()->name;
                    $parts = explode(' ', $name);
                    $initial = strtoupper(substr($parts[0], 0, 1)) . '.';
                    if (count($parts) > 2) {
                        $lastName = $parts[count($parts) - 1];
                    } else {
                        $lastName = isset($parts[1]) ? $parts[1] : '';
                    }
                @endphp
                  <td class="">
                    Prepared by <br> <br>
                    <span>{{ $initial }} {{ $lastName }}</span> <br> <br>
                    Checked by <br> <br>
                    <span></span> <br> <br></td>
                  <td class=""></td>
                  <td class="">Approved by <br> <br>
                    <span>J. Galera</span> <br> <br>
                </td>
                  <td class=""></td>
              </tr>
          </tbody>
      </table>
      </div>
      
</div>
<div class="new-row">
    <div class="footer">
        <div class="footer-left">
            <p>Document No. WS-L3-FM-23</p>
            <p>Effectivity Date: June 1, 2022 </p>
        </div>
        <div class="footer-right">
            <p>Rev.01</p>
            {{-- <p>Page {PAGE_NUM} of {PAGE_COUNT}</p> --}}
        </div>
    </div>
</div>


</body>
</html>
