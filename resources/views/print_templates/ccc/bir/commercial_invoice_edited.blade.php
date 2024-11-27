
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Commercial Invoice</title>
    
    <style>
       @page{
        /* margin: 15px 25px; */
        margin: 160px 40px 15px -12px;
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
            max-height: 90px;
            min-height: 90px;
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
            line-height: 1;
        }
        .right-column {
            margin-left: 10px; 
            line-height:1.14;
        }
        .left-column {
            margin-left:15px; 
            margin-top:4px;
        }
        .info-row {
            margin-bottom: 1px; 
        }
        .info-row span {
            display: inline-block; 
            vertical-align: top;   
        }
        .customer-container .left-column .info-label{
            width: 20%; 
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 13px;
            padding: 0;
        }
        .customer-container .right-column .info-label{
            width: 35%; 
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 13px;
        }
        .customer-container .right-column .info-row{
            margin-bottom: 1.5px
        }
        .customer-container .right-column .info-label{
            width: 35%; 
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
            margin-top: 23px;
            width: 100%;
            border-collapse: collapse; 
        }
        .product-details th{
            /* border-left: 1px solid black;
            border-right: 1px solid black; */
            text-align: center;
            font-size: 12px;
        }
        .product-details thead tr{
            border-bottom: 10px ; 
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
            text-align: center; 
            font-size: 12px;
        }
        .product-total {
            width: 100%;
            margin-top: 25px;
            margin-left: 100px;
            
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
            line-height: 1;
            margin-left:80px;
            min-height: 84px;
            max-height: 84px;

        }
        .total-right-column, {
            float: left; 
            width: 40%; 
            font-size: 13px;
            line-height: 1;
            margin-left:-20px
        }
        .total-left-column .info-name{
            width: 35%;
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;
        }
        .total-right-column .info-name{
            width: 35%;
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;
        }
        .total-left-column .info-detail{
            width: 30%;
            display: inline-block;
            vertical-align: top;  
            font-size: 12px;
            word-wrap: break-word;
        }
        .total-right-column .info-detail{
            width: 30%;
            display: inline-block;
            vertical-align: top;  
            font-size: 12px;
            word-wrap: break-word;
        }
        .info-name {
            width: 35%; 
            display: inline-block;
            vertical-align: top;  
            margin: 0
        }
        .info-colon {
            width: 5%; 
            display: inline-block;
            vertical-align: top;   
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
            width: 28%; 
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 11px;
        }
        .column-container{
            margin-top: 2px;
        }

        .total {
            width: 100%;
            font-family: Arial, sans-serif;
            /* font-size: 14px; */
            margin-bottom: 32px;

        }

        .total-value {
            font-weight: bold;
            position: relative;
            margin-left: 75%;
            font-size: 18px
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
        .new-col {
            display: table;                
            width: 100%;                  
            margin: 10px 0;              
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
            /* margin: 17px auto;  */
            margin: 22px 130px 0 83px;
            display: block; 
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
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value"><strong>{{ optional($details->first())->SoldTo }}</strong></span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($details->first())->Address }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value"></span>
        </div>
    </div>
    <div class="right-column">
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ \Carbon\Carbon::parse(optional($details->first())->invoice_date)->format('F j, Y') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value"></span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($details->first())->BuyersPo }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($details->first())->BuyersRef }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($details->first())->SalesContract }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value"></span>
        </div>
    </div>
</div>
<div class="product-details" style="min-height: 180px; max-height:180px; margin-left:20px; margin-right:40px;">
    <table style="">
        <thead>
            <tr>
                <th style="width: 42%; height: 16px;"></th>
                <th style="width: 19%"></th>
                <th style="width: 18%"></th>
                <th style="width: 26%"></th>
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
                $total = 0
            @endphp
            @foreach ($details as $detail)
                @foreach ($detail->products as $product)
                @php
                    $total += $product->Amount;
                @endphp
                <tr>
                    <td style="font-weight: bold">{{ $product->Description }}</td>
                    <td>{{ number_format($product->Quantity,2) }} {{ $product->printUom }}
                    </td>
                    <td> 
                        {{ optional($product->first())->DocCur }} {{ number_format($product->UnitPrice,2) }} 
                    </td>
                    <td>{{ optional($product->first())->DocCur }} {{ number_format($product->Amount, 2) }}</td>
                </tr>
                <tr>
                </tr>
                @endforeach
            @endforeach
            <tr>
                <td style=" padding:10px; text-align: center">{!! nl2br(e(optional($details->first())->Remarks )) !!}</td>
                <td></td>
                <td></td>
                <td></td>
                <td ></td>
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
    </div>

    <div class="total-right-column">
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
        <div class="info-row" style="margin-bottom:11px;">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail"></span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{ optional($product)->DocCur }} {{ number_format($total, 2) }}</span>
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
    </div>
</div>


<div class="column-container" style="min-height:15px; max-height:15px;">
    <div class="total">
        <div class="total-value">{{ optional($product)->DocCur }} {{ number_format($total, 2) }}</div>
    </div>
</div>

<div class="new-row">
    <div class="new-col-left" style="margin-top: 58px">
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{ \Carbon\Carbon::parse(optional($details->first())->DateOfShipment)->format('F j, Y') }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->PortOfLoading }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->PortOfDestination }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->ModeOfShipment }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->TermsOfDelivery }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->FedderVessel }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->OceanVessel }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->BillOfLading }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->ContainerNo }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->SealNo }}</span>
        </div>
    </div>
    <div class="new-col-right">
        <div class="terms-payment" style="max-height: 34.5px; min-height: 34.5px;">
            <div class="info-row" style="margin-bottom: 3px">
                <span class="info-name"></span>
                <span class="info-colon"></span>
                <span class="info-detail">{{ optional($details->first())->TermsOfPayment }}</span>
            </div>
            <div class="info-row">
                <span class="info-name"></span>
                <span class="info-colon"></span>
                <span class="info-detail">{{ \Carbon\Carbon::parse(optional($details->first())->InvoiceDueDate)->format('F j, Y') }}</span>
            </div>
        </div>
        <div class="right-box" style="min-height: 210px;max-height: 210px; width: 340px; margin-top:27px">
            <div class="new-col">
                <div class="shape" style="width: 30px">
                    {{-- <div> <a href=""><img  style='width: 30px; height:50%;' src="{{URL::asset('/images/arrow.png')}}" height='45px' alt="AVATAR"></a></div> --}}
                </div>
                <div class="payment-instruction">
                <div class="left-align">
                    <div class="info-row">
                            {!! nl2br(e(optional($details->first())->PaymentInstruction )) !!}
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
                <div class="signature-space"><span>JOHN L. WEE</span></div>
            <br>
        </div>
    </div>
</div>
</body>
</html>
