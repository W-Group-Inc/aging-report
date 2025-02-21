
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
        
        .header-container .left .header .line-one {
            font-size: 17px;
            font-weight: bold;
        }
        .header-container .left .header .line-two {
            font-size: 11px;
            margin-top: 5px;
            margin-bottom: 5px;
        }
        .header-container .left .header .line-three {
            font-size: 16px;
            font-weight: bold;
        }
        .header-container .left .header .date {
            font-size: 12px;
        }
        .left, .middle, .right {
            display: table-cell;
            vertical-align: top;
        }
        .left {
            width: 70%;
        }
        .middle {
            height: 30px;
            width: 50%;
            text-align: center; 
        }
        .middle img {
            width: 110px;
            height: auto; 
        }
        .right {
            width: 80%;
            text-align: right; 
        }
        .header-container .right .line-one {
            font-size: 26px;
            font-style: italic;
            font-weight: bold;
        }
        .header-container .right .line-two {
            margin-top: 30px;
            font-size: 12px;
            margin-left: -50px;
            font-weight: bold;
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
            width: 18%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;
        }
        .customer-container .right-column .info-label{
            width: 32%; /* Fixed width for labels */
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
            width: 60%;
            display: inline-block;
            vertical-align: top;  
            font-size: 12px;
            word-wrap: break-word;
        }
        .product-details table {
            margin-top: 10px;
            width: 100%;
            border-collapse: collapse; /* Collapses table borders */
        }
        .product-details th{
            border: 1px solid #000; /* Table cell borders */
            text-align: center; /* Align text to the left */
            font-size: 12px;
        }
        .product-details thead tr{
            border-bottom: 5px double; /* Table cell borders */
            text-align: center; /* Align text to the left */
        }
        .product-details th:first-child,
        td:first-child {
            border-left: none;
        }

        .product-details th:last-child,
        td:last-child {
            border-right: none;
        }
        .product-details td{
            padding: 2px; /* Padding inside cells */
            text-align: center; /* Align text to the left */
            font-size: 12px;
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
        }
        .total-left-column {
            margin-right:-60px
        }
        .total-left-column .info-name{
            width: 35%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;
        }
        .total-right-column .info-name{
            width: 40%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;
        }
        .info-name {
            width: 35%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0
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
        .new-col-right .info-name {
            width: 30%;
            display: inline-block;
            vertical-align: top;  
            font-size: 12px;
            word-wrap: break-word;
            margin: 0;
        }
        .new-col-right .info-detail {
            width: 65%;
            display: inline-block;
            vertical-align: top;  
            font-size: 12px;
            word-wrap: break-word;
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
        .column-container{
            margin-top: 20px
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
        .new-col-left {
            float: left; 
            width: 50%; 
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
            margin: 0 auto 0 auto;/* Center horizontally and add vertical space */
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
            <span class="line-one">USA COMMERCIAL INVOICE</span>
            {{-- <div class="line-two">FR-S&M-18rev00</div> --}}
            <div class="line-three">SOA No.: {{ optional($details->first())->SoaNo }}</div>
            @if ($details->isNotEmpty())
            <div class="date">Dated: {{ \Carbon\Carbon::parse(optional($details->first())->InvoiceDate)->format('F j, Y') }}</div>
            @endif
        </div>
    </div>
    <div class="middle">
        <span>
            <img src="{{ asset('/images/w-logo.png')}}" alt="Company Logo"> 
        </span>
    </div>
    <div class="right">
        <div class="line-one">W HYDROCOLLOIDS</div>
        <div class="line-two">Remit-To Address: P.O. Box 115, Wilton, CT 06897</div>
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
            <span class="info-label">Address</span>
            <span class="info-colon">:</span>
            <span class="info-value">{{ optional($details->first())->Address }}</span>
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
                        if ($details->first()->Type == 'vatable') {
                            // if (($detail)->DocCur == 'EUR') {
                                // $vatable_amount = 0.21 * $product->Amount;
                                // $vatable_unit_price = 0.21 * $product->UnitPrice;
                                // $value_added_tax += $vatable_amount;
                            // } else {
                                $vatable_amount = 0.12 * $product->Amount;
                                $vatable_unit_price = 0.12 * $product->UnitPrice;
                                $value_added_tax += $vatable_amount;
                            // }
                        }
                    @endphp
                    @php
                        $total_amount_payable = $total + $value_added_tax;
                    @endphp
                    <tr>
                        <td class="desc-max-col-width">{!! nl2br(e($product->Description )) !!}</td>
                        <td style="vertical-align: middle;">{{ $product->Packing }}
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
            <span class="info-detail">{{ optional($details->first())->Currency }} {{ (number_format($value_added_tax,2)) }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Amount: Net of VAT</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->Currency }} {{ number_format($total, 2) }}</span>
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
            <span class="info-detail">{{ optional($details->first())->Currency }} {{ (number_format($value_added_tax,2)) }}</span>
        </div>
    </div>
</div>
<div class="column-container">
    <div class="column-right">
        <div class="total">
            <div class="label">TOTAL</div>
            <div class="arrow"> <a href=""><img  style='width: 30px; height:20px;' src="{{URL::asset('/images/arrow.png')}}" height='45px' alt="AVATAR"></a></div>
            <div class="total-value">{{ optional($details->first())->Currency }} {{ (number_format($total_amount_payable,2)) }}</div>
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
@endif
<div class="new-row">
    <div class="new-col-left" style="margin-top: 30px">
        <div class="info-row">
            <span class="info-name">Pickup Date</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->PickupDate ? \Carbon\Carbon::parse(optional($details->first())->PickupDate)->format('F j, Y') : '' }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Delivery Address</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{!! nl2br(e(optional($details->first())->PlaceOfDelivery)) !!}</span>
        </div>
        <div style="margin-top: 30px">
            <div class="info-row">
                <span class="info-name">Mode of Delivery</span>
                <span class="info-colon">:</span>
                <span class="info-detail">{{ optional($details->first())->ModeOfShipment }}</span>
            </div>
            <div class="info-row">
                <span class="info-name">Terms of Delivery</span>
                <span class="info-colon">:</span>
                <span class="info-detail">{{optional($details->first())->TermsOfDelivery }}</span>
            </div>
        </div>
    </div>
    <div class="new-col-right">
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
                <div class="payment-instruction" style="font-size:15px !important">
                    <div style="margin-bottom:10px">Payment Instructions: </div>
                    <div class="info-row" style="MARGIN-BOTTOM:10PX">
                        <span class="">- For ACH/Direct Deposit to our Account: </span>
                    </div>
                    <div class="info-row">
                        <span class="">- Bank: BANK OF AMERICA</span>
                    </div>
                    <div class="info-row">
                        <span class="">- Account Name: W HYDROCOLLOIDS, LLC</span>
                    </div>
                    <div class="info-row">
                        <span class="">- Account Type: Checking</span>
                    </div>
                    <div class="info-row">
                        <span class="">- Account No.: 3830-2623-4250</span>
                    </div>
                    <div class="info-row">
                        <span class="">- Routing No.: ******084</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="new-row" style="margin-top: 10px">
    <div class="new-col-left">
        <div class="info-row">
            <strong>ORIGINAL</strong>
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

<div class="new-row">
    <div class="footer">
        <div class="footer-left">
            <p>WHI-TP-ACC-008</p>
            <p>Rev. 0 03/11/2024 </p>
        </div>
        {{-- <div class="footer-right">
            <p>Page {PAGE_NUM} of {PAGE_COUNT}</p>
        </div> --}}
    </div>
</div>

</body>
</html>
