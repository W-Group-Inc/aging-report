
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>sales Invoice</title>
    
    <style>
       @page{
        /* margin: 15px 25px; */
        margin: 167px 40px 15px -12px;
       }
        
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }
        .header-container {
            display: table; 
            width: 100%; 
            margin-bottom: 8px; 
        }
        .header-container .left .header span {
            font-size: 17px;
            font-weight: bold;
        }
        .header-container .left .header .line-two {
            font-size: 11px;
            font-style: italic;
        }
        .header-container .left .header .line-three {
            margin-top: 30px;
            font-size: 16px;
            font-weight: bold;
        }
        .header-container .left .header .date {
            margin-top: 37.7px;
            margin-bottom: 15px;
            margin-left: 37px;
            font-size: 12px;
        }
        .left, .right {
            display: table-cell;
            vertical-align: top;
        }
        .left {
            width: 50%;
        }
        .right {
            width: 80%;
            text-align: right; 
        }
        .header-container .right .line-one {
            font-size: 15px;
            font-style: italic;
            font-weight: bold;
            margin-top: 30px;
        }
        .header-container .right .line-two {
            font-style: italic;
            line-height: 1;
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
            max-height: 110px;
            min-height: 110px;
        }
        .customer-container::after {
            content: "";
            display: table;
            clear: both;
        }
        .left-column, .right-column {
            float: left; 
            width: 50%; 
            font-size: 13px;
            line-height: 1.1;
        }
        .right-column {
            margin-left: 10px; 
            margin-top: 3px;
        }
        .left-column {
            margin-left:10px; 
        }
        .info-row span {
            display: inline-block; /* Align label and value on the same line */
            vertical-align: top;   /* Ensure alignment between label and value */
        }
        .customer-container .left-column .info-row{
            margin-bottom: 1px;
        }
        .customer-container .left-column .info-label{
            width: 20%; 
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 13px;
            padding: 0;
        }
        .customer-container .right-column .info-row{
            margin-bottom: 6px;
        }
        .customer-container .right-column .info-label{
            width: 35%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 13px;
        }
        .customer-container .left-column .info-value{
            width:73%;
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
            margin-top: 60px;
            width: 100%;
            border-collapse: collapse; 
        }
        .product-details th{
            /* border-left: 1px solid black;
            border-right: 1px solid black; */
            text-align: center; /* Align text to the left */
            font-size: 12px;
        }
        .product-details thead tr{
            border-bottom: 10px ; /* Table cell borders */
            text-align: center; 
        }
        .product-details th:first-child {
            /* border-right: 1px solid black; */
        }
        .product-details td:last-child {
            /* border-right: 1px solid black; */
        }
        .product-details th:last-child {
            /* border-left: 1px solid black; */
        }
        .product-details td{
            text-align: center; /* Align text to the left */
            font-size: 12px;
        }
        .product-total {
            width: 100%;
            /* margin-top: 25px; */
            margin-left: 120px;
            line-height: 1.2;
            
        }
        .product-total::after {
            content: "";
            display: table;
            clear: both;
        }
        .total-left-column {
            float: left; 
            width: 40%; 
            font-size: 13px;
            margin-top: 5px;
            min-height: 84px;
            max-height: 84px;

        }
        .total-right-column, {
            /* margin-top:3px; */
            float: left; 
            width: 40%; 
            font-size: 13px;
            margin-left:-20px;
        }
        .total-left-column .info-name{
            width: 33%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;
        }
        .total-right-column .info-name{
            width: 35%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;

        }
        .total-left-column .info-detail{
            width: 35%;
            display: inline-block;
            vertical-align: top;  
            font-size: 12px;
            word-wrap: break-word;
        }
        .total-right-column .info-detail{
            width: 35%;
            display: inline-block;
            vertical-align: top;  
            font-size: 12px;
            word-wrap: break-word;

        }
        .info-name {
            width: 35%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0
        }
        .info-colon {
            width: 5%; /* Fixed width for labels */
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
        .new-col-right .info-detail {
            margin-left: 12.5px;
            width: 55%;
            display: inline-block;
            vertical-align: top;  
            font-size: 11px;
            word-wrap: break-word;
        }
        .new-col-left .info-row {
            margin-bottom: 3.8px;
        }
        .new-col-left .info-detail {
            width: 50%;
            display: inline-block;
            vertical-align: top;  
            font-size: 11px;
            word-wrap: break-word;
        }
        .new-col-left .info-name{
            width: 28%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 11px;
        }
        .column-container{
            margin-top: 10px;
        }

        .total {
            width: 100%;
            font-family: Arial, sans-serif;
            /* font-size: 14px; */
            margin-bottom: 29px;

        }

        .total-value {
            font-weight: bold;
            position: relative;
            margin-left: 65%;
            font-size: 18px;
            margin-top:5px;
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
            font-size: 13px;
        }
        .new-col-left {
            float: left; 
            width: 50%; 
            font-size: 13px;
        }

        .right-box .new-col {
            font-size: 12px;
            align-items: center;
        }
        .left-align {
            text-align: left;
        }
        .center-align {
            text-align: center;
        }
        .signature-space {
            width: 200px; 
            margin: 18px 130px 8px 75px;
            display: block; /* Ensure it's treated as a block-level element */
            font-weight: bold;
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
            <span style="font-size: 17px"></span>
        </div>
    </div>
    
</div>
<div class="customer-container">
    <div class="left-column" >
        <div class="info-row" style="max-height: 60px; min-height:60px">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value"><strong>{{ optional($details->first())->PayToCode }}</strong></span>
        </div>
        <div class="info-row" style="margin-bottom: 5px">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($details->first())->LicTradNum }}</span>
        </div>
        <div class="info-row" style="max-height:42px; min-height:42px;">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($details->first())->Billtoaddress }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($details->first())->PayToCode }}</span>
        </div>
    </div>
    <div class="right-column">
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ \Carbon\Carbon::parse(optional($details->first())->DocDueDate)->format('F j, Y') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($details->first())->U_BuyersPO }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($details->first())->U_Salescontract }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($details->first())->PymntGroup }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ \Carbon\Carbon::parse(optional($details->first())->ArDueDate)->format('F j, Y') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value"></span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">sdsds</span>
        </div>
    </div>
</div>
<div class="product-details" style="min-height: 280px; max-height:280px; margin-left:20px; margin-right:40px;">
    <table style="">
        <thead>
            <tr>
                <th style="width: 26%; height: 16px;"></th>
                <th style="width: 19%"></th>
                <th style="width: 18%"></th>
                <th style="width: 42%"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2"  style="font-weight: bold; padding:10px; text-align: center">{{ optional($details->first())->U_Remark3 }}</td>
            </tr>
            @php
                $total = 0;
            @endphp
            @foreach ($details as $detail)
                @php
                    $total += $detail->Linetotal;
                @endphp
            <tr>
                <td style="font-weight: bold">{{ $detail->U_Label_as }}</td>
                <td>
                    @if ($detail->Quantity)
                    {{ number_format($detail->Quantity, 2) }}
                    @endif
                    @if ($detail->U_Netweight != '')
                        {{ $detail->U_printUOM }}
                    @endif
                </td>
                <td> 
                     {{-- @if ($detail->U_Netweight != '') --}}
                     {{ optional($details->first())->DocCur }} {{ number_format($detail->Price,2) }} 
                    {{-- @endif --}}
                </td>
                <td>{{ optional($details->first())->DocCur }} {{ number_format($detail->Linetotal, 2) }}</td>
            </tr>
            @endforeach
            <tr>
                <td style=" padding:10px; text-align: center">{{ optional($details->first())->U_Remark1 }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="product-total">
    <div class="total-left-column">
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row" style="margin-bottom: 1px">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row" style="margin-bottom: 3px">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{ optional($details->first())->DocCur }} {{ number_format($total, 2) }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail"></span>
        </div>
    </div>

    <div class="total-right-column">
        <div class="info-row" style="margin-bottom:5px;">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{ optional($details->first())->DocCur }} {{ number_format($total, 2) }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{ optional($details->first())->DocCur }} {{ number_format($total, 2) }}</span>
        </div>
        <div class="info-row" style="margin-bottom:3px;">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{ optional($details->first())->DocCur }} {{ number_format($total, 2) }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail"></span>
        </div>
    </div>
</div>


<div class="column-container" style="min-height:15px; max-height:15px;">
    <div class="total">
        <div class="total-value">{{ optional($details->first())->DocCur }} {{ number_format($total, 2) }}</div>
    </div>
</div>

<div class="new-row">
    <div class="new-col-left">
        <div class="center-align">
                <div class="signature-space"><span>{{ auth()->user()->name }}</span></div>
            <br>
        </div>
        <div class="center-align">
            <div class="signature-space"><span>Camille Bueza</span></div>
        <br>
    </div>
    </div>
</div>
</body>
</html>
