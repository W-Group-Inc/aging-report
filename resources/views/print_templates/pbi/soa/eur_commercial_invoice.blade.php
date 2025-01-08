
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
            border-bottom: 1px solid #000; 
            padding-bottom: 10px; 
            margin-bottom: 20px; 
        }
        .header-container .left .header span {
            font-size: 16px;
            font-weight: bold;
        }
        .header-container .left .header .line-one {
            font-size:10px;
        }
        .header-container .left .header .line-two {
            font-size:10px;
            font-style: italic;
        }
        .header-container .left .header .line-three {
            font-size:10px;
        }
        .header-container .left .header .date {
            margin-top: 10px;
            font-size:10px;
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
        .header-container .right .line-one {
            font-size: 15px;
            font-style: italic;
            font-weight: bold;
            margin-top: 20px;
        }
        .header-container .right .line-two {
            font-style: italic;
            line-height: 1;
            font-size:10px;
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
            width: 55%; 
            font-size: 12px;
            line-height: 1;
        }
        .right-column {
            margin-left: 50px; 
        }
        .info-row {
            margin-bottom: 5px; 
        }
        .info-row span {
            display: inline-block;
            vertical-align: top;  
        }
        .customer-container .left-column .info-label{
            width: 18%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;
        }
        .customer-container .right-column .info-label{
            width: 29%; /* Fixed width for labels */
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
            width: 50%;
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
        } .product-details th{
            border: 1px solid #000; 
            border-bottom: 2px solid #000; 
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
        }
        .product-total {
            width: 100%;
            margin-top: 30px;
            margin-left: 130px;
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
            line-height: 1;

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
        .total-right-column .info-name{
            width: 40%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;
        }
        .total-left-column .info-detail{
            width: 35%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;
        }
        .total-right-column .info-detail{
            width: 40%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;
        }
        .info-name {
            width: 40%; /* Fixed width for labels */
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
            width: 45%;
            display: inline-block;
            vertical-align: top;  
            
        }
        .new-col-right .info-detail {
            width: 65%;
            display: inline-block;
            vertical-align: top;  
            font-size: 12px;
            word-wrap: break-word;
        }
        .new-col-right .info-name {
            width: 30%; 
            display: inline-block;
            vertical-align: top;  
            margin: 0
        }
        .new-col-left .info-detail {
            width: 63%;
            display: inline-block;
            vertical-align: top;  
            font-size: 12px;
            word-wrap: break-word;
        }
        .new-col-left .info-name{
            width: 32%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;
        }
        .column-container{
            margin-top: 10px;
        }

        .total {
            padding: 10px;
            float: right;
            margin-left: 65%;
            width: 35%;
            display: table;
            font-family: Arial, sans-serif;
            font-size: 15px;
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
            font-size:10px;
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
            margin: 0 auto 0 auto; /* Center horizontally and add vertical space */
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
            <div class="line-three">FR-ACC-16</div>
            <div class="line-three">No.: <strong>{{ $soa_no }}</strong></div>
            @if ($details->isNotEmpty())
            <div class="date">Dated: {{ \Carbon\Carbon::parse(optional($details->first())->DocDueDate)->format('F j, Y') }}</div>
            @endif
            <div style="font-size:10px;">VAT Reg. TIN 000-316-923-000</div>
        </div>
    </div>
    <div class="middle">
       
    </div>
    
    <div class="right">
        <div class="container">
            <div class="line-two">
                <span class="header-medium-text">Neele-VAT Logistics Customs Broker 1 BV</span>
                <span class="header-small-text">Marco Plostraat 2-14, 3165 AL Rotterdam, The Netherlands</span>
                <span class="header-small-text">NL007106774B02, acting as Fiscal Representative</span>
                <span class="header-small-text">in the European Union for:</span>
            </div>
        </div>

        <div class="line-one">
            <strong>PHILIPPINE BIO INDUSTRIES, INC.</strong> 
        </div>
        <div class="line-two">
            <span class="header-small-text"><strong>Plant Address:</strong> 103 Integrity Avenue, Carmelray Industrial Park 1, Canlubang, Calamba City, Laguna 4028</span>
            <span class="header-small-text"><strong>Admin Office:</strong> 26F W Building, Fifth Avenue, Bonifacio Global City 1634 Taguig City, Philippines</span>
            <span class="header-small-text">Phone: +632 8856 3838 | Fax: +632 8856 1033</span>
            <span class="header-small-text">vat@rico.com.ph | www.rico.com.ph</span>
            <span class="header-small-text">VAT No.: NL826469425B01</span>
        </div>
    </div>
</div>
<div class="customer-container">
    <div class="left-column">
        <div class="info-row">
            <span class="info-label">Sold To</span>
            <span class="info-colon">:</span>
            <span class="info-value"><strong>{{ optional($details->first())->PayToCode }}</strong></span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($details->first())->Billtoaddress }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">VAT Number</span>
            <span class="info-colon">:</span>
            <span class="info-value">{{ optional($details->first())->U_TaxID }}</span>
        </div>
    </div>
    <div class="right-column">
        <div class="info-row">
            <span class="info-label">Buyer's PO No.</span>
            <span class="info-colon">:</span>
            <span class="info-value">{{ optional($details->first())->U_BuyersPO }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Buyer's Ref. No.</span>
            <span class="info-colon">:</span>
            <span class="info-value">{{ optional($details->first())->NumAtCard }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Sales Contract No.</span>
            <span class="info-colon">:</span>
            <span class="info-value">{{ optional($details->first())->U_Salescontract }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">OSCA/PWD ID No.</span>
            <span class="info-colon">:</span>
            <span class="info-value"></span>
        </div>
        <div class="info-row">
            <span class="info-label">SC/PWD Signature</span>
            <span class="info-colon">:</span>
            <span class="info-value"></span>
        </div>
    </div>
</div>
<div class="product-details">
    <table>
        <thead>
            <tr>
                <th style="width: 28%; height: 16px;">Description</th>
                <th style="width: 12%;border-right: none;">Packing</th>
                <th style="width: 1%; border-left: none; border-right: none;"></th> 
                <th style="width: 11%;">Unit</th>
                <th style="width: 14%">Quantity</th>
                <th style="width: 16%">Unit Price</th>
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
            @php
                    $total += $detail->TotalFrgn;
                    $vatable_unit_price = 0;
                    $vatable_amount = 0;
                    if ($soa_type == 'vatable') {
                        // if (($detail)->DocCur == 'EUR') {
                        //     $vatable_amount = 0.21 * $detail->TotalFrgn;
                        //     $vatable_unit_price = 0.21 * $detail->Price;
                        //     $value_added_tax += $vatable_amount;
                        // } else {
                            $vatable_amount = 0.21 * $detail->TotalFrgn;
                            $vatable_unit_price = 0.21 * $detail->Price;
                            $value_added_tax += $vatable_amount;
                        // }
                    }
              @endphp
              @php
                $total_amount_payable = $total + $value_added_tax;
              @endphp
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2"  style="font-weight: bold; padding:0; text-align: center">{{ $details->first()->U_Delivery }}</td>
            </tr>
            <tr>
                <td><strong>{{ $detail->U_label_as }}</strong></td>
                <td>{{ $detail->U_Bagsperlot }}
                    @if ($detail->U_Bagsperlot > 1)
                        bags
                    @elseif ($detail->U_Bagsperlot == 0)
                    
                    @else
                        bag
                    @endif
                    @if ($detail->U_Bagsperlot != 0)
                    @endif
                </td>
                <td style="width: 0; text-align: center;">
                    @if ($detail->U_Netweight)x @endif
                </td>
                <td>
                    @if ($detail->U_Netweight)
                    {{ number_format($detail->U_Netweight, 2) }} 
                    @endif
                    @if ($detail->U_Netweight != '')
                        {{ $detail->U_printUOM }}
                    @endif
                </td>
                <td>
                    @if ($detail->Quantity)
                    {{ number_format($detail->Quantity, 2) }}
                    @endif
                    @if ($detail->U_Netweight != '')
                        {{ $detail->U_printUOM }}
                    @endif
                </td>
                <td> 
                     @if ($detail->U_Netweight != '')
                     {{ $detail->DocCur }} {{ number_format($detail->Price, 2) }} /
                     @if ($detail->U_printUOM == 'lbs')
                        lb
                     @else
                        kg   
                     @endif
                    @endif
                </td>
                <td>{{ $detail->DocCur }} {{ number_format($detail->TotalFrgn, 2) }}</td>
            </tr>
            @if ($soa_type == 'vatable')
            <td></td>
            <td></td>
            <td></td>
            <td></td>
                {{-- @if ( $detail->DocCur == 'EUR')
                <td>ADD:21% VAT</td>
                @else --}}
                <td>ADD:21% VAT</td>
                {{-- @endif --}}
            <td></td>
            {{-- <td >{{ $detail->DocCur }} {{ number_format($vatable_unit_price,2) }}</td> --}}
            <td>{{ $detail->DocCur }} {{ number_format($vatable_amount,2) }}</td>
            @endif
            @endforeach
        </tbody>
    </table>
</div>

@if ($soa_type == 'zero_rated')
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
            <span class="info-detail">{{ optional($details->first())->DocCur }} {{ number_format($total, 2) }}</span>
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
            <span class="info-detail">{{ optional($details->first())->DocCur }} {{ number_format($total, 2) }}</span>
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
            <div class="total-value">{{ optional($details->first())->DocCur }} {{ number_format($total, 2) }}</div>
        </div>
    </div>
    <div class="column-left">
        <div class="remarks">
            <div class="info-row">
                <span class="left-span">
                 The Exporter PHREX2021P02A12FEB0000010538 of the products 
                 covered by this document declares that, except where otherwise clearly 
                 indicated, these products are of  Philippine preferential origin according 
                 to the rules of origin of the Generalised System of Preferences of the 
                 European Union and that the origin criterion met is "W".
                </span>
             </div>
        </div>
    </div>
</div>
@elseif ($soa_type == 'vatable')
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
            <span class="info-detail">{{ optional($details->first())->DocCur }} {{ number_format($total, 2) }}</span>
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
            <span class="info-detail">{{ optional($details->first())->DocCur }} {{ number_format($vatable_amount, 2) }}</span>
        </div>
    </div>

    <div class="total-right-column">
        <div class="info-row">
            <span class="info-name">Less: VAT</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->DocCur }} {{ number_format($vatable_amount, 2) }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Amount: Net of VAT</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->DocCur }} {{ number_format($total, 2) }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Less: SC/PWD Discount</span>
            <span class="info-colon">:</span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name">Amount Due</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->DocCur }} {{ number_format($total, 2) }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Add:VAT</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->DocCur }} {{ number_format($vatable_amount, 2) }}</span>
        </div>
    </div>
</div>
<div class="column-container">
    <div class="column-right">
        <div class="total">
            <div class="label">TOTAL</div>
            <div class="arrow"> <a href=""><img  style='width: 30px; height:20px;' src="{{URL::asset('/images/arrow.png')}}" height='45px' alt="AVATAR"></a></div>
            <div class="total-value">{{ optional($details->first())->DocCur }} {{ number_format($total_amount_payable, 2) }}</div>
        </div>
    </div>
    <div class="column-left">
        <div class="remarks">
            <div class="info-row">
                <span class="left-span">
                 The Exporter PHREX2021P02A12FEB0000010538 of the products 
                 covered by this document declares that, except where otherwise clearly 
                 indicated, these products are of  Philippine preferential origin according 
                 to the rules of origin of the Generalised System of Preferences of the 
                 European Union and that the origin criterion met is "W".
                </span>
             </div>
        </div>
    </div>
</div>
@elseif ($soa_type == 'exempt')
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
            <span class="info-detail">{{ optional($details->first())->DocCur }} {{ number_format($total, 2) }}</span>
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
            <span class="info-detail">{{ optional($details->first())->DocCur }} {{ number_format($total, 2) }}</span>
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
            <div class="total-value">{{ optional($details->first())->DocCur }} {{ number_format($total, 2) }}</div>
        </div>
    </div>
    <div class="column-left">
        <div class="remarks">
            <div class="info-row">
                <span class="left-span">
                 The Exporter PHREX2021P02A12FEB0000010538 of the products 
                 covered by this document declares that, except where otherwise clearly 
                 indicated, these products are of  Philippine preferential origin according 
                 to the rules of origin of the Generalised System of Preferences of the 
                 European Union and that the origin criterion met is "W".
                </span>
             </div>
        </div>
    </div>
</div>
@endif

<div class="new-row" style="margin-top: 120px">
    <div class="new-col-left">
        <div class="info-row">
            <span class="info-name">Date of Shipment</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ \Carbon\Carbon::parse(optional($details->first())->DocDueDate)->format('F j, Y') }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Place of Loading</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{optional($details->first())->U_PlaceLoading }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Place of Destination</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{optional($details->first())->Shiptoaddress }}</span>
        </div>
        {{-- <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->Address2 }}</span>
        </div> --}}

        <div style="margin-top: 30px">
            <div class="info-row">
                <span class="info-name">Mode of Shipment</span>
                <span class="info-colon">:</span>
                <span class="info-detail">{{ optional($details->first())->U_ModeShip }}</span>
            </div>
            <div class="info-row">
                <span class="info-name">Terms of Delivery</span>
                <span class="info-colon">:</span>
                <span class="info-detail">{{optional($details->first())->U_Delivery }}</span>
            </div>
        </div>
    </div>
    <div class="new-col-right" >
        <div class="info-row">
            <span class="info-name">Terms of Payment</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->PymntGroup }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Invoice Due Date</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->U_SOADueDate ? \Carbon\Carbon::parse(optional($details->first())->U_SOADueDate)->format('F j, Y') : '' }}</span>
        </div>
        <div class="right-box">
            <div class="new-col">
                <div class="shape">
                    <div> <a href=""><img  style='width: 30px; height:50%;' src="{{URL::asset('/images/arrow.png')}}" height='45px' alt="AVATAR"></a></div>
                </div>
                <div class="payment-instruction" style="font-size: 13px">
                    <div>Payment Instructions: </div>
                <div class="left-align">
                    <div class="info-row" style="margin: 10px 0px 0px 0; font-size: 13px">
                        <span>{{ optional($details->first())->U_T1 }}</span>
                    </div>
                    <div class="info-row" style="font-size: 13px">
                        @if($details->first() && $details->first()->U_T3)
                            <?php
                                $intermediaryBankDetails = optional($details->first())->U_T2 . ' / ' . optional($details->first())->U_T3 . ' / ' . optional($details->first())->U_T4 . ' / ' . optional($details->first())->U_T5 . ' / ' . optional($details->first())->U_T6;
                                $formattedDetails = str_replace('\\', '/', $intermediaryBankDetails); 
                                $lines = explode('/', $formattedDetails);
                                $lines = array_map('trim', $lines);
                            ?>
                            @foreach ($lines as $line)
                                {{ $line }} <br>
                            @endforeach
                        @endif
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="new-row">
    <div class="new-col-right">
        <div class="center-align">
            <div class="signatory">
                <div class="esign" style="margin-bottom: -15px;">
                    <img src="{{ asset(auth()->user()->signature) }}" 
                         style="width: 80px; height: auto;">
                </div>
                <div class="signature-space"><span>{{ $prepared_by }}</span></div>
            </div>
            <div class="text">
                <span style="display: block">Authorized Representative</span>
                <span style="display: block">Signature over Printed Name</span>
            </div>
            <br>
        </div>
    </div>
</div>
</body>
</html>
