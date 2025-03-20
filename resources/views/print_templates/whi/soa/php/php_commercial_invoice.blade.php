
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
            border-bottom: 2px solid #000; 
            padding-bottom: 10px; 
            margin-bottom: 20px; 
        }
        .header-container .left .header span {
            font-size: 17px;
            font-weight: bold;
        }
        .header-container .left .header .line-two {
            font-size: 11px;
        }
        .header-container .left .header .line-three {
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
        }
        .header-container .left .header .date {
            margin-top: 10px;
            font-size: 9px;
        }
        .left, .middle, .right {
            display: table-cell;
            vertical-align: top;
        }
        .left {
            width: 40%;
        }
        .right {
            width: 60%;
            text-align: right; 
        }
        .right img {
            width: 120px;
            height: auto; 
            margin-left: 35px
        }
        
        .header-container .right .line-one {
            font-size: 15px;
            font-weight: bold;
        }
        .header-container .right .line-two {
            margin-top: 20px;
            line-height: 1;
        }
        .header-large-text{
            font-size: 26px;
            font: bold;
        }
        .header-medium-text{
            font-size: 10px;
            font: bold;
        }
        .header-small-text{
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
            width: 50%; 
            font-size: 12px;
            line-height:1;
        }
        .right-column {
            margin-left: 50px; 
        }
        .info-row {
            margin-bottom: 5px; /* Space between rows */
        }
        .info-row span {
            display: inline-block; /* Align label and value on the same line */
            vertical-align: top;   /* Ensure alignment between label and value */
        }
        .customer-container .left-column .info-label{
            width: 25%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;
        }
        .customer-container .right-column .info-label{
            width: 35%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;
        }
        .customer-container .left-column .info-value{
            width: 60%;
            display: inline-block;
            vertical-align: top;  
            font-size: 12px;
            word-wrap: break-word;
        }
        .customer-container .right-column .info-value{
            width: 40%;
            display: inline-block;
            vertical-align: top;  
            font-size: 12px;
            word-wrap: break-word;
        }
        .product-details table {
            margin-top: 10px;
            width: 100%;
            border-collapse: collapse; /* Collapses table borders */
            font-size: 12px;
        }
        .product-details th{
            border: 1px solid #000; /* Table cell borders */
            text-align: center; /* Align text to the left */
        }
        .product-details th:first-child, {
            border-left: none; /* Remove left border for the first <th> */
        }
        .product-details th:last-child {
            border-right: none; /* Remove left border for the first <th> */
        }
        .product-details td{
            text-align: center; /* Align text to the left */
            padding: 2px; /* Padding inside cells */
        }
        .product-total {
            width: 100%;
            margin-top: 30px;
            margin-left: 20%;
        }
        .product-total::after {
            content: "";
            display: table;
            clear: both;
        }
        .total-left-column, .total-right-column {
            float: left; 
            width: 50%; 
            font-size: 12px;
            line-height: 0.8;

        }
        .total-left-column, {
            margin-right:-60px
        }
        .total-left-column .info-name{
            width: 35%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;
        }
        .total-right-column .info-detail {
            width: 33%;
            display: inline-block;
            vertical-align: top;  
            font-size: 12px;
            word-wrap: break-word;
            text-align: right;
        }
        .total-left-column .info-detail {
            width: 33%;
            display: inline-block;
            vertical-align: top;  
            font-size: 12px;
            word-wrap: break-word;
            text-align: right;
        }
        .info-name {
            width: 40%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;
        }
        .info-colon {
            width: 3%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;   /* Align the label with the top of the value */
        }
        .info-detail {
            width: 35%;
            display: inline-block;
            vertical-align: top;  
            font-size: 12px;
            word-wrap: break-word;       
        }
        .column-container{
            margin-top: 10px
        }

        .total {
            padding: 10px;
            float: right;
            margin-left: 65%;
            width: 35%;
            display: table;
            font-family: Arial, sans-serif;
            font-size: 16px;
        }

        .label, .arrow, .total-value {
            display: table-cell;
            vertical-align: bottom;
        }

        .label {
            font-weight: bold;
            padding-right: 10px;
        }

        .total-value {
            padding-top:10px;
            font-weight: bold;
            text-align: center;
            position: relative;
            border-top: 1px solid #000; 
            border-bottom: 5px double;
            margin-right: 50%;
        }
        .remarks{
            font-size: 12px;
            float: left; 
            width: 50%;
        }
        /* New */
        .new-row {
            clear: both; 
            width: 100%; /* Ensures full width */
            display: block; /* Block display to break to a new line */
        }
        .new-col {
            display: table;                /* Set the outer div to behave like a table */
            width: 100%;                   /* Ensure it takes full width */
            margin: 10px 0;               /* Optional margin for spacing */
        }

        .shape,
        .payment-instruction {
            display: table-cell;           /* Set children to behave like table cells */
            vertical-align: middle;        /* Center content vertically within the cell */
        }
        .new-col-right {
            float: right; 
            width: 50%; 
            font-size: 12px;
        }
        .new-col-right .info-name {
            width: 35%;
            display: inline-block;
            vertical-align: top;  
            font-size: 12px;
            word-wrap: break-word;
        }
        .new-col-right .info-detail {
            width: 55%;
            display: inline-block;
            vertical-align: top;  
            font-size: 12px;
            word-wrap: break-word;
        }
        .new-col-left {
            float: left; 
            width: 50%; 
            font-size: 12px;
        }
        .new-col-left .info-detail {
            width: 60%;
            display: inline-block;
            vertical-align: top;  
            font-size: 12px;
            word-wrap: break-word;
        }
        .new-col-left .info-name{
            width: 30%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;
        }
        .right-box .new-col {
            font-size: 11px;
            border: solid black;
            padding: 10px;
            align-items: center;
        }
        .left-align {
            text-align: left;
        }
        .center-align {
            text-align: center;
        }
        .signature-space {
            border-bottom: 1px solid #000; /* Create a line for the signature */
            width: 200px; /* Set the width of the signature line */
            margin: 0 auto 0 auto;; /* Center horizontally and add vertical space */
            display: block; /* Ensure it's treated as a block-level element */
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
        }
    </style>
</head>
<body>
    
<div class="header-container">
    <div class="left">
        <div class="header">
            <span class="line-one">COMMERCIAL INVOICE</span>
            <div class="line-two">FR-ACC-16rev02</div>
            <div class="line-three">No.: <span style="color: red">{{ optional($details->first())->SoaNo }}</span></div>
            @if ($details->isNotEmpty())
            <div class="date">Dated: {{ \Carbon\Carbon::parse(optional($details->first())->InvoiceDate)->format('F j, Y') }}</div>
            @endif
            <div style="font-size: 9px;">VAT Reg. TIN 225-688-438-0000</div>
        </div>
    </div>
    {{-- <div class="middle">
        <span>
            <img src="{{ asset('/images/w-logo.png')}}" alt="Company Logo"> 
        </span>
    </div> --}}
    
    <div class="right">
        <div class="container">
            <span style="float: left">
                <img src="{{ asset('/images/w-logo.png')}}" alt="Company Logo" style="max-height: 50px;">
            </span>
            <div style="text-align: center">
                <div class="line-one">
                    <span class="header-large-text">W Hydrocolloids, Inc.</span>
                </div>
                <div style="font-size: 12px"><strong>A member of the W Group, Inc</strong></div>
            </div>
        </div>
        

        <div class="line-two">
            <span class="header-small-text"><strong>Plant Address:</strong> Block 10 Lot 1 Phase 4 Mountview 1 Industrial Complex, Bancal,  4116 Carmona, Cavite, Philippines</span>
            <span class="header-small-text"><strong>Admin Office:</strong> 26/F. W Fifth Ave. Bldg. 3051 5th Ave. cor. 32nd St., Bonifacio Global City, Taguig City, 1634 Philippines</span>
            <span class="header-small-text"><strong>Phone:</strong> (+632) 8856.3838 | Fax: (+632) 8856.1033 </span>
            <span class="header-small-text">sales@rico.com.ph | www.rico.com.ph </span>
        </div>
    </div>
</div>
<div class="customer-container">
    <div class="left-column">
        <div class="info-row">
            <span class="info-label">Sold To</span>
            <span class="info-colon">:</span>
            <span class="info-value"><strong>{{ optional($details->first())->SoldTo }}</strong></span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($details->first())->Address }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">TIN</span>
            <span class="info-colon">:</span>
            <span class="info-value">{{ optional($details->first())->Tin }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Business Style</span>
            <span class="info-colon">:</span>
            <span class="info-value">{{ optional($details->first())->BusinessStyle }}</span>
        </div>
    </div>
    <div class="right-column">
        <div class="info-row">
            <span class="info-label">Buyer's PO No.</span>
            <span class="info-colon">:</span>
            <span class="info-value">{{ optional($details->first())->BuyersPo }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Buyer's Ref. No.</span>
            <span class="info-colon">:</span>
            <span class="info-value">{{ optional($details->first())->BuyersRef }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Sales Contract No.</span>
            <span class="info-colon">:</span>
            <span class="info-value">{{ optional($details->first())->SalesContractNo }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">OSCA/PWD ID No.</span>
            <span class="info-colon">:</span>
            <span class="info-value">{{ optional($details->first())->OscaPwd }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">SC/PWD Signature</span>
            <span class="info-colon">:</span>
            <span class="info-value">{{ optional($details->first())->ScPwd }}</span>
        </div>
    </div>
</div>
<div class="product-details">
    <table>
        <thead>
            <tr>
                <th style="width: 24%; height: 16px;">Description</th>
                <th style="width: 13%;border-right: none;">Packing</th>
                <th style="width: 1%; border-left: none; border-right: none;"></th> 
                <th style="width: 12%;">Unit</th>
                <th style="width: 15%">Quantity</th>
                <th style="width: 17%">Unit Price</th>
                <th style="width: 19%">Amount</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
                $value_added_tax = 0;
                $total_amount_payable = 0;
            @endphp
            @foreach ($details as $detail)
            @foreach ($detail->soaProduct as $product)
                    @php
                            $total += $product->Amount;
                            $vatable_unit_price = 0;
                            $vatable_amount = 0;
                            // if (($detail)->DocCur == 'EUR') {
                                    // $vatable_amount = 0.21 * $product->Amount;
                                    // $vatable_unit_price = 0.21 * $product->UnitPrice;
                                    // $value_added_tax += $vatable_amount;
                                // } else {
                                    $vatable_amount = 0.12 * $product->Amount;
                                    $vatable_unit_price = 0.12 * $product->UnitPrice;
                                    $value_added_tax += $vatable_amount;
                                // }
                    @endphp
                    @php
                        $total_amount_payable = $total + $value_added_tax;
                        @endphp
                    <tr>
                        <td>{{ $product->Description }}</td>
                        <td>{{ $product->Packing }}
                            @if ($product->Packing > 1)
                                bags
                            @elseif ($product->Packing == 0)
                            
                            @else
                                bag
                            @endif
                            @if ($product->Packing != 0)
                            @endif
                        </td>
                        <td style="width: 0; text-align: center;">
                            @if ($product->Unit)x @endif
                        </td>
                        <td>
                            @if ($product->Unit)
                           {{ $product->Unit }}
                            @endif
                            @if ($product->Unit != '')
                                {{ optional($details->first())->Uom }}
                            @endif
                        </td>
                        <td>
                            @if ($product->Unit != '')
                            {{ number_format($product->Quantity, 2) }}
                            @endif
                            @if ($product->Unit != '')
                                {{ optional($details->first())->Uom }}
                            @endif
                        </td>
                        <td> 
                            @if ($product->Unit != '')
                            {{ optional($details->first())->Currency }} {{ ($product->UnitPrice)}} /
                            @if (optional($details->first())->Uom == 'lbs')
                                lb
                            @else
                                kg   
                            @endif
                            @endif
                        </td>
                        <td>{{ optional($details->first())->Currency }} {{ number_format($product->Amount, 2) }}</td>
                    </tr>
                    @if ($details->first()->Type == 'vatable')
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        {{-- @if ( $product->DocCur == 'EUR') --}}
                        {{-- <td>ADD:21% VAT</td> --}}
                        {{-- @else --}}
                        <td>ADD:12% VAT</td>
                        {{-- @endif --}}
                        <td></td>
                        {{-- <td >{{ optional($details->first())->Currency }} {{ number_format($vatable_unit_price,2) }}</td> --}}
                        <td>{{ optional($details->first())->Currency }} {{ number_format($vatable_amount,2) }}</td>
                    @endif
                    <tr>
                        <td>{{ $product->U_SupplierCode }}</td>
                    </tr>
                    
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>

@if ($details->first()->Type == 'zero_rated')
<div class="product-total">
    <div class="total-left-column">
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name">VATable Sales</span>
            <span class="info-colon">:</span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name">VAT-Exempt Sales</span>
            <span class="info-colon">:</span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name">Zero Rated Sales</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->Currency }} {{ number_format($total, 2) }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">VAT Amount</span>
            <span class="info-colon">:</span>
            <span class="info-detail"></span>
        </div>
    </div>

    <div class="total-right-column">
        <div class="info-row">
            <span class="info-name">Less: VAT</span>
            <span class="info-colon">:</span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name">Amount: Net of VAT</span>
            <span class="info-colon">:</span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name">Less: SC/PWD Discount</span>
            <span class="info-colon">:</span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name">Amount Due</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->Currency }} {{ number_format($total, 2) }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Add:VAT</span>
            <span class="info-colon">:</span>
            <span class="info-detail"></span>
        </div>
    </div>
</div>


<div class="column-container">
    <div class="column-right">
        <div class="total">
            <div class="label">TOTAL</div>
            <div class="arrow"> <a href=""><img  style='width: 30px; height:20px;' src="{{URL::asset('/images/arrow.png')}}" height='45px' alt="AVATAR"></a></div>
            <div class="total-value">{{ optional($details->first())->Currency }} {{ number_format($total, 2) }}</div>
        </div>
    </div>
    <div class="column-left">
        <div class="remarks">
            <div class="info-row">
                <span class="left-span">
                    @if (optional($details->first())->ShowPhrex == 1)
                       {{ optional($details->first())->Phrex }}
                     @endif
                </span>
             </div>
        </div>
    </div>
</div>
@elseif ($details->first()->Type == 'vatable')
<div class="product-total">
    <div class="total-left-column">
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name">VATable Sales</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->Currency }} {{ (number_format($total,2)) }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">VAT-Exempt Sales</span>
            <span class="info-colon">:</span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name">Zero Rated Sales</span>
            <span class="info-colon">:</span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name">VAT Amount</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->Currency }} {{ (number_format($value_added_tax,2)) }}</span>
        </div>
    </div>

    <div class="total-right-column">
        <div class="info-row">
            <span class="info-name">Less: VAT</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->Currency }} {{ (number_format($value_added_tax,2)) }}<</span>
        </div>
        <div class="info-row">
            <span class="info-name">Amount: Net of VAT</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->Currency }} {{ (number_format($total,2)) }}<</span>
        </div>
        <div class="info-row">
            <span class="info-name">Less: SC/PWD Discount</span>
            <span class="info-colon">:</span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name">Amount Due</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->Currency }} {{ number_format($total, 2) }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Add:VAT</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->Currency }} {{ (number_format($value_added_tax,2)) }}<</span>
        </div>
    </div>
</div>


<div class="column-container">
    <div class="column-right">
        <div class="total">
            <div class="label">TOTAL</div>
            <div class="arrow"> <a href=""><img  style='width: 30px; height:20px;' src="{{URL::asset('/images/arrow.png')}}" height='45px' alt="AVATAR"></a></div>
            <div class="total-value">{{ optional($details->first())->Currency }}  {{ number_format($total_amount_payable, 2) }}</div>
        </div>
    </div>
    <div class="column-left">
        <div class="remarks">
            <div class="info-row">
                <span class="left-span">
                    @if (optional($details->first())->ShowPhrex == 1)
                       {{ optional($details->first())->Phrex }}
                     @endif
                </span>
             </div>
        </div>
    </div>
</div>

@elseif ($details->first()->Type == 'exempt')
<div class="product-total">
    <div class="total-left-column">
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name">VATable Sales</span>
            <span class="info-colon">:</span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name">VAT-Exempt Sales</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->Currency }} {{ number_format($total, 2) }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Zero Rated Sales</span>
            <span class="info-colon">:</span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name">VAT Amount</span>
            <span class="info-colon">:</span>
            <span class="info-detail"></span>
        </div>
    </div>

    <div class="total-right-column">
        <div class="info-row">
            <span class="info-name">Less: VAT</span>
            <span class="info-colon">:</span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name">Amount: Net of VAT</span>
            <span class="info-colon">:</span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name">Less: SC/PWD Discount</span>
            <span class="info-colon">:</span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name">Amount Due</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->Currency }} {{ number_format($total, 2) }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Add:VAT</span>
            <span class="info-colon">:</span>
            <span class="info-detail"></span>
        </div>
    </div>
</div>


<div class="column-container">
    <div class="column-right">
        <div class="total">
            <div class="label">TOTAL</div>
            <div class="arrow"> <a href=""><img  style='width: 30px; height:20px;' src="{{URL::asset('/images/arrow.png')}}" height='45px' alt="AVATAR"></a></div>
            <div class="total-value">{{ optional($details->first())->Currency }}  {{ number_format($total, 2) }}</div>
        </div>
    </div>
    <div class="column-left">
        <div class="remarks">
            <div class="info-row">
                <span class="left-span">
                    @if (optional($details->first())->ShowPhrex == 1)
                       {{ optional($details->first())->Phrex }}
                     @endif
                </span>
             </div>
        </div>
    </div>
</div>
@endif

<div class="new-row">
    <div class="new-col-left" style="margin-top: 100px">
        <div class="info-row">
            <span class="info-name">Date of Shipment</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ \Carbon\Carbon::parse(optional($details->first())->DateOfShipment)->format('F j, Y') }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Port of Loading</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{optional($details->first())->PlaceOfLoading }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Port of Destination</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{!! nl2br(e(optional($details->first())->PlaceOfDelivery)) !!}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Mode of Shipment</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{optional($details->first())->ModeOfShipment }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Terms of Delivery</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{optional($details->first())->TermsOfDelivery }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Feeder Vessel</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{optional($details->first())->FeederVessel }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Ocean Vessel</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{optional($details->first())->OceanVessel }}</span>
        </div>
        @if (optional($details->first())->AirwayBillNo)
        <div class="info-row">
            <span class="info-name">Airway Bill No.</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->AirwayBillNo }}</span>
        </div>
        @else
        {{-- <div class="info-row">
            <span class="info-name">Bill of Lading</span>
            <span class="info-colon">:</span>
            <span class="info-detail"></span>
        </div> --}}
        @endif
        <div class="info-row">
            <span class="info-name">Container No.</span>
            <span class="info-colon">:</span>
            @if (optional($details->first())->ContainerNo === 'insert container no.')
            <span class="info-detail"></span>
            @else
            <span class="info-detail">{{optional($details->first())->OceanVessel }}</span>
            @endif
        </div>
        <div class="info-row">
            <span class="info-name">Seal No.</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{optional($details->first())->SealNo }}</span>
        </div>
    </div>
    <div class="new-col-right" style="margin-top: 30px;">
        <div class="info-row">
            <span class="info-name">Terms of Payment</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->TermsOfPayment }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Invoice Due Date</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->InvoiceDueDate ? \Carbon\Carbon::parse(optional($details->first())->InvoiceDueDate)->format('F j, Y') : '' }}</span>
        </div>
        <div class="right-box">
            <div class="new-col">
                <div class="shape">
                    <div> <a href=""><img  style='width: 30px; height:50%;' src="{{URL::asset('/images/arrow.png')}}" height='45px' alt="AVATAR"></a></div>
                </div>
                <div class="payment-instruction" style="font-size: 12px">
                    <div>Payment Instructions: </div>
                <div class="left-align">
                    <div class="info-row" style="margin: 10px 0px">
                        {!! nl2br(e(optional($details->first())->PaymentInstruction )) !!}
                    </div>
                   
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="new-row">
    <div class="new-col-left">
        <div class="info-row">
            {{-- <strong>ORIGINAL</strong> --}}
        </div>
    </div>
    <div class="new-col-right">
        <div class="center-align">
            <strong>W HYDROCOLLOIDS, INC.</strong>
            <div class="signatory">
                <div class="esign" style="margin-bottom: -15px;">
                    @if (auth()->user()->signature != "")
                        <img src="{{ asset(auth()->user()->signature) }}" 
                        style="width: 80px; height: auto;">
                    @endif
                </div>
                <div class="signature-space">
                    <span>{{ auth()->user()->name }}</span>
                </div>
            </div>
            <div class="text">
                <span style="display: block">Authorized Representative</span>
                <span style="display: block">Signature over Printed Name</span>
            </div>
            <br>
        </div>
    </div>
</div>


{{-- <div class="new-row">
    <div class="footer">
        <div class="footer-left">
            <p>WHI-TP-ACC-088</p>
            <p>Rev. 0 03/11/2024 </p>
        </div>
        <div class="footer-right">
            <p>Page {PAGE_NUM} of {PAGE_COUNT}</p>
        </div>
    </div>
</div> --}}


</body>
</html>
