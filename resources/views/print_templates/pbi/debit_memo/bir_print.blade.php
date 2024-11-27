
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Debit Memorandum</title>
    
    <style>
        @page{
        margin: 34px 135px 15px 11px;
       }

        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }
        .header-container {
            min-height: 50px;
            display: table; 
            width: 100%; 
            padding-bottom: 10px; 
            margin-bottom: 15px; 
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
            height: 40px; 
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
            min-height: 100px;
            width: 100%;
        }
        .customer-container::after {
            content: "";
            display: table;
            clear: both;
        }
        .left-column, .right-column {
            float: left; 
            font-size: 13px;
            line-height: 0.8;
        }
        .left-column {
            width: 70%; 
        }
        .right-column {
            width: 30%; 
        }
        .info-row {
            margin-bottom: 5px; /* Space between rows */
        }
        .info-row span {
            display: inline-block; /* Align label and value on the same line */
            vertical-align: top;   /* Ensure alignment between label and value */
        }
        .customer-container .left-column .info-label{
            width: 10%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 13px;
        }
        .customer-container .left-column .info-colon{
            width: 0; 
            display: inline-block;
            vertical-align: top; 
        }
        .customer-container .right-column .info-label{
            width: 40%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 13px;
        }
        .customer-container .left-column .info-value{
            width: 70%;
            display: inline-block;
            vertical-align: top;  
            font-size: 13px;
            line-height: 1.8;
            word-wrap: break-word;
        }
        .customer-container .right-column .info-value{
            width: 40%;
            display: inline-block;
            vertical-align: top;  
            font-size: 13px;
            word-wrap: break-word;
        }
        .product-details table {
            /* padding-left: 10px; */
            margin-top: 18px;
            width: 100%;
            border-collapse: collapse; /* Collapses table borders */
            font-size: 13px;
            table-layout: fixed;
        }
        .product-details th{
            /* border-left: 1px solid #000; 
            border-right: 1px solid #000;  */
            text-align: center; /* Align text to the left */
            height: 18.3px;
        }
        .product-details thead tr{
            /* border-bottom: 5px double;  */
            text-align: center; /* Align text to the left */
        }
        .product-details th:first-child,
        td:first-child {
            border-left: none;
        }
        .product-details th:last-child,
        td:last-child {
            /* border-right: none; */
        }
        .product-details td{
            text-align: center; /* Align text to the left */
            /* border: 1px solid black; */
            padding: 0;
            height: 20px;
            overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
        }
        .product_head{
            max-height: 200px;
            min-height: 200px;
            font-size: 13px;

        }
        .product_head table {
            margin-top: 10px;
            width: 100%;
            border-collapse: collapse; /* Collapses table borders */
            font-size: 13px;
        }
        .product_head td{
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
            font-size: 13px;
            line-height: 0.8;

        }
        .total-left-column, {
            margin-right:-60px
        }
        .total-left-column .info-name{
            width: 35%; 
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;
        }
        .info-name {
            width: 40%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;
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
        .column-container{
            margin-top: 30px;
            border-top: 1px solid black;
            border-bottom: 4px double black;
        }

        .total {
            margin-left: 70%;
            font-size: 14px;
            width: 30%;
            display: table;
        }
        
        .total-label {
            display: table-cell;
            font-weight: bold;
        }

        .total-value {
            display: table-cell;
            font-weight: bold;
            word-wrap: break-word;width: :50px;
            width: 100%;
            text-align:right;
        }
        .remarks{
            font-size: 12px;
            float: left; 
            width: 50%;
        }
        /* New */
        .new-row {
            clear: both; 
            width: 100%;
            display: block; 
        }
        .signatories {
            /* display: table; */
            width: 100%;     
            margin: 4px 0;  
            font-size: 13px;    
            margin-left: 520px;
        }

        .shape,
        .payment-instruction {
            display: table-cell;         
            vertical-align: middle;       
        }
        .new-col-right {
            float: right; 
            width: 50%; 
            font-size: 13px;
        }
        .new-col-right .info-name {
            width: 35%;
            display: inline-block;
            vertical-align: top;  
            font-size: 13px;
            word-wrap: break-word;
        }
        .new-col-right .info-detail {
            width: 55%;
            display: inline-block;
            vertical-align: top;  
            font-size: 13px;
            word-wrap: break-word;
        }
        .new-col-left {
            float: left; 
            width: 50%; 
            font-size: 13px;
        }
        .new-col-left .info-detail {
            width: 50%;
            display: inline-block;
            vertical-align: top;  
            font-size: 13px;
            word-wrap: break-word;
        }
        .new-col-left .info-name{
            width: 35%; 
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 13px;
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
            /* border-bottom: 1px solid #000; */
            width: 200px; 
            display: block; 
            text-align: left;
            margin-bottom: 7px
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
            <span class="line-one"></span>
            <div class="line-two"></div>
            <div class="line-three"></span></div>
        </div>
    </div>
    
</div>
@foreach ($details as $detail)
    

<div class="customer-container">
    <div class="left-column">
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value"><strong>{{ optional($detail)->client }}</strong></span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{!! nl2br(e(optional($detail)->client_address)) !!}</span>
        </div>
    </div>
    <div class="right-column">
        
    </div>
</div>

<div class="product-details">
    <table>
        <thead>
            <tr>
                <th style="width: 7.5%;"></th>
                <th style="width: 10%;"></th>
                <th style="width: 7%;"></th>
                <th style="width: 49.5%;"></th>
                <th style="width: 11%;"></th>
                <th style="width: 15%;"></th>
            </tr>
        </thead>
        <tbody>
            @php
                $grandTotal = 0;
            @endphp
            @foreach ($detail->DebitMemoBody as $item)
                <tr>
                    <td style="width: 7.5%;">{{ $item->ListNo }}</td>
                    <td style="width: 10%;">{{ $item->Quantity }}</td>
                    <td style="width: 7%;">{{ $item->Unit }}</td>
                    <td style="width: 49.5%;">{{ $item->description }}</td>
                    <td style="width: 11%;">{{ $item->UnitPrice }}</td>
                    <td style="width: 15%;">{{ $item->Currency }} {{ number_format($item->total, 2) }}</td>
                </tr>
                @php
                    $grandTotal += $item->total;
                @endphp
            @endforeach
        
            @for ($i = count($detail->DebitMemoBody); $i < 10; $i++)
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            @endfor
        
            <tr >
                <td></td>
                <td></td>
                <td></td>
                <td><strong></strong></td>
                <td></td>
                <td style="padding-top: 3px !important;"><strong>{{ number_format($grandTotal, 2) }}</strong></td>
            </tr>
        </tbody>              
    </table>
</div>

    
   
<div class="signatories">
    <div class="signatory">
        <div class="signature-space"><span>{{ auth()->user()->name }}</span></div>
    </div>
    <div class="signatory">
        <div class="signature-space"><span>Camille Bueza</span></div>
    </div>
    <div class="signatory">
        <div class="signature-space"><span>{{ \Carbon\Carbon::parse($detail->date)->format('F d, Y') }}
        </span></div>
    </div>
</div>
@endforeach

</body>
</html>
