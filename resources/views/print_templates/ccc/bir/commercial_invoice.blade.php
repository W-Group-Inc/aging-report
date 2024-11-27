
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
            text-align: center; /* Align text to the left */
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
            margin-left:-20px;

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
            width: 35%;
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
            <span class="info-value"><strong>{{ optional($details->first())->PayToCode }}</strong></span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($details->first())->Billtoaddress }}</span>
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
            <span class="info-value">{{ \Carbon\Carbon::parse(optional($details->first())->DocDueDate)->format('F j, Y') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value"></span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($details->first())->U_BuyersPO }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($details->first())->NumAtCard }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($details->first())->U_Salescontract }}</span>
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
            @foreach ($details as $detail)
            
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
            <tr>
                <td>{{ ($detail->U_SupplierCode) }}</td>
            </tr>
            @endforeach
            <tr>
                <td style=" padding:10px; text-align: center">{{ optional($details->first())->U_Remark1 }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td ></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="product-total">
    @php
        $total = 0;
        foreach ($details as $detail){
            $total += $detail->Linetotal;
        }
    @endphp
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
    <div class="new-col-left" style="margin-top: 58px">
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{ \Carbon\Carbon::parse(optional($details->first())->DocDueDate)->format('F j, Y') }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->U_PlaceLoading }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->U_Destinationport }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->U_ModeShip }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->U_Delivery }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->U_FeedVessel }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->U_OceanVessel }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->U_BillLading }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->U_ContainerNo }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->U_Seal }}</span>
        </div>
    </div>
    <div class="new-col-right">
        <div class="terms-payment" style="max-height: 34.5px; min-height: 34.5px;">
            <div class="info-row" style="margin-bottom: 3px">
                <span class="info-name"></span>
                <span class="info-colon"></span>
                <span class="info-detail">{{ optional($details->first())->PymntGroup }}</span>
            </div>
            <div class="info-row">
                <span class="info-name"></span>
                <span class="info-colon"></span>
                <span class="info-detail">{{ \Carbon\Carbon::parse(optional($details->first())->U_SAODueDate)->format('F j, Y') }}</span>
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
                        @if($details->first() && $details->first()->U_T3)
                            <?php
                            $intermediaryBankDetails = optional($details->first())->U_T2 . ' \\ ' . optional($details->first())->U_T3 . ' \\ ' . optional($details->first())->U_T4 . ' \\ ' . optional($details->first())->U_T5 . ' \\ ' . optional($details->first())->U_T6;

                            $formattedDetails = preg_replace('/^\\\\+|\\\\+$/', '', $intermediaryBankDetails);
                            $lines = array_map('trim', explode('\\', $formattedDetails));
                            $lines = array_filter($lines);

                            $intermediaryBankDetailsU_T1 = optional($details->first())->U_T1;
                            $intermediaryBankDetailsU_T2 = optional($details->first())->U_T2;
                            $intermediaryBankDetailsU_T3 = optional($details->first())->U_T3;
                            $intermediaryBankDetailsU_T4 = optional($details->first())->U_T4;
                            $intermediaryBankDetailsU_T5 = optional($details->first())->U_T5;
                            $intermediaryBankDetailsU_T6 = optional($details->first())->U_T6;

                            $formattedDetailsU_T1 = preg_replace('/\s?\/\s?/', "\n", $intermediaryBankDetailsU_T1);
                            $formattedDetailsU_T2 = preg_replace('/\s?\/\s?/', "\n", $intermediaryBankDetailsU_T2);
                            $formattedDetailsU_T3 = preg_replace('/\s?\/\s?/', "\n", $intermediaryBankDetailsU_T3);
                            $formattedDetailsU_T4 = preg_replace('/\s?\/\s?/', "\n", $intermediaryBankDetailsU_T4);
                            $formattedDetailsU_T5 = preg_replace('/\s?\/\s?/', "\n", $intermediaryBankDetailsU_T5);
                            $formattedDetailsU_T6 = preg_replace('/\s?\/\s?/', "\n", $intermediaryBankDetailsU_T6);
                            ?>
                            
                            {!! nl2br(e($formattedDetailsU_T1)) !!}
                            {!! nl2br(e($formattedDetailsU_T2)) !!} 
                            {!! nl2br(e($formattedDetailsU_T3)) !!} <br>
                            {!! nl2br(e($formattedDetailsU_T4)) !!} 
                            {!! nl2br(e($formattedDetailsU_T5)) !!} 
                            {!! nl2br(e($formattedDetailsU_T6)) !!} 
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
                <div class="signature-space"><span>JOHN L. WEE</span></div>
            <br>
        </div>
    </div>
</div>
</body>
</html>
