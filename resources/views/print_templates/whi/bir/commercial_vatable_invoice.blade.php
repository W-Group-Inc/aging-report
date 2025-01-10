
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Commercial Invoice</title>
    
    <style>
       @page{
        /* margin: 15px 25px; */
        margin: 70px 0 15 -20px;
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
            margin-top: 31.7px;
            margin-bottom: 19px;
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
            height: 90px;
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
            font-size: 13px;
            line-height: 1;
        }
        .right-column {
            margin-top: 12px;
            margin-left: 53px; 
        }
        .info-row {
            margin-bottom: 1px; /* Space between rows */
        }
        .info-row span {
            display: inline-block; /* Align label and value on the same line */
            vertical-align: top;   /* Ensure alignment between label and value */
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
            width: 35%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 13px;
        }
        .customer-container .right-column .info-row{
            margin-bottom: 1.5px
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
            margin-top: 10px;
            width: 100%;
            border-collapse: collapse; /* Collapses table borders */
        }
        .product-details th{
            text-align: center; /* Align text to the left */
            font-size: 12px;
        }
        .product-details thead tr{
            border-bottom: 10px ; /* Table cell borders */
            text-align: center; 
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
            text-align: center; /* Align text to the left */
            font-size: 12px;
        }
        .product-total {
            width: 100%;
            margin-top: 14px;
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
            margin-left:-40px
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
            width: 54%;
            display: inline-block;
            vertical-align: top;  
            font-size: 11px;
            word-wrap: break-word;
        }
        .new-col-right .info-row.multiline .info-detail {
            margin-top: -8px;
        }
        .new-col-right .container .info-name {
            width: 31%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0
        }
        .new-col-left .info-row {
            margin-bottom: 1.5px;
        }
        .new-col-left .info-detail {
            width: 50%;
            display: inline-block;
            vertical-align: top;  
            font-size: 11px;
            word-wrap: break-word;
            line-height: 17px;

        }
        .new-col-left .info-name{
            width: 31%; /* Fixed width for labels */
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 11px;
        }
        .column-container{
            margin-top: 3;
        }

        .total {
            width: 100%;
            font-family: Arial, sans-serif;
            /* font-size: 14px; */
            margin-bottom: 41px;

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
            font-size: 14px;
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
            width: 200px; /* Set the width of the signature line */
            /* margin: 17px auto;  */
            margin: 40px 128px 0 98px;
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
            {{-- <div class="line-three">No.: {{ $soa_no }}</div> --}}
            @if ($details->isNotEmpty())
            <div class="date"> {{ \Carbon\Carbon::parse(optional($details->first())->Dated)->format('F j, Y') }}</div>
            @endif
        </div>
    </div>
    
</div>
<div class="customer-container">
    <div class="left-column">
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value"><strong>{{ optional($details->first())->PayToCode }}</strong></span>
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
        {{-- <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value"></span>
        </div> --}}
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($details->first())->U_BuyersPO }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($details->first())->U_Buyersref }}</span>
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
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value"></span>
        </div>
    </div>
</div>
<div class="product-details" style="min-height: 255px; max-height:255px; margin-left:20px; margin-right:40px;">
    <table style="">
        <thead>
            <tr>
                <th style="width: 34%; height: 16px;"></th>
                <th style="width: 13%"></th>
                <th style="width: 13%"></th>
                <th style="width: 15%"></th>
                <th style="width: 15%"></th>
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
                $total_vatable_unit_price = 0;
                $total = 0;
                $vat_inclusive = 0;
                $total_vatable_amount = 0;
            @endphp
            @foreach ($details as $detail)
            @php
            // if (($detail)->DocCur == 'EUR') {
            //         $unit_price = ($detail->Linetotal) /  ($detail->Quantity) ;
            //         $vatable_unit_price = $unit_price * 0.21;
            //         $total_vatable_unit_price += $vatable_unit_price;
            //         $vatable_amount = ($detail->Linetotal) * 0.21;
            //         $total_vatable_amount += $vatable_amount;

            //         $total += $detail->Linetotal;
            //         $vat_inclusive = $total + $total_vatable_amount;
            //     } else {
                    $unit_price = ($detail->Linetotal) /  ($detail->Quantity) ;
                    $vatable_unit_price = $unit_price * 0.12;
                    $total_vatable_unit_price += $vatable_unit_price;
                    $vatable_amount = ($detail->Linetotal) * 0.12;
                    $total_vatable_amount += $vatable_amount;

                    $total += $detail->Linetotal;
                    $vat_inclusive = $total + $total_vatable_amount;
                // }
            @endphp
            <tr>
                <td style="font-weight: bold">{{ $detail->U_Label_as }}</td>
                <td>{{ $detail->U_Bagsperlot }} {{ $detail->U_packUOM }}
                    {{-- @if ($detail->U_Bagsperlot != 0)
                        <span style="float: right; text-align:end">x</span>
                    @endif --}}
                </td>
                <td>
                    @if ($detail->U_Netweight)
                    {{ number_format($detail->Quantity / $detail->U_Bagsperlot, 2) }}
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
                     {{-- @if ($detail->U_Netweight != '') --}}
                     {{ optional($details->first())->DocCur }} {{ number_format(($detail->Linetotal) /  ($detail->Quantity),2)}} /
                     @if ($detail->U_printUOM == 'lbs')
                        lb
                     @else
                        kg   
                     @endif
                    {{-- @endif --}}
                </td>
                <td>{{ optional($details->first())->DocCur }} {{ number_format($detail->Linetotal, 2) }}</td>
            </tr>
            <tr>
                <td>{{ ($detail->U_SupplierCode) }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold"></td>
                <td></td>
                <td></td>
                {{-- @if ( $detail->DocCur == 'EUR')
                    <td><strong>ADD:21% VAT</strong></td>
                @else --}}
                    <td><strong>ADD:12% VAT</strong></td>
                {{-- @endif --}}
                <td> 
                    {{-- {{ optional($details->first())->DocCur }} {{ $vatable_unit_price }} --}}
                </td>
                <td>{{ optional($details->first())->DocCur }} {{ number_format($vatable_amount, 2) }}</td>
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
    <div class="total-left-column" style="margin-top:4.5px">
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
        <div class="info-row" style="margin-top:3px;">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{ optional($details->first())->DocCur }} {{ number_format($vatable_amount,2) }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail"></span>
        </div>
    </div>

    <div class="total-right-column" >
        <div class="info-row" style="margin-bottom: 3px">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{ optional($details->first())->DocCur }} {{ number_format($vat_inclusive, 2) }}</span>
        </div>
        <div class="info-row" style="margin-bottom: 3px">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{ optional($details->first())->DocCur }} {{ number_format($total_vatable_amount,2) }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{ optional($details->first())->DocCur }} {{ number_format($total, 2) }}</span>
        </div>
        <div class="info-row" style="margin-bottom:2.5px;">
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
            <span class="info-detail">{{ optional($details->first())->DocCur }} {{ number_format($vatable_amount,2) }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail"></span>
        </div>
    </div>
</div>


<div class="column-container" style="min-height:15px; max-height:15.5px;">
    <div class="total">
        <div class="total-value">{{ optional($details->first())->DocCur }} {{ number_format($vat_inclusive, 2) }}</div>
    </div>
</div>

<div class="new-row">
    <div class="new-col-left" style="margin-top: 69px; font-size:16px; height:80px">
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{ \Carbon\Carbon::parse(optional($details->first())->DocDate)->format('F j, Y') }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->U_PortLoad }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->U_PortDestination }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->U_ModeShip }}</span>
        </div>
        <div class="info-row">
            <span class="info-name"></span>
            <span class="info-colon"></span>
            <span class="info-detail">{{optional($details->first())->DeliveryTerms }}</span>
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
        <div class="container" style="background:red; height:40px">
            <div class="info-row" style="margin-top:0px; margin-bottom:8px">
                <span class="info-name"></span>
                <span class="info-colon"></span>
                <span class="info-detail">{{ optional($details->first())->PymntGroup }}</span>
            </div>
            <div class="info-row {{ strlen(optional($details->first())->PymntGroup) > 35 ? 'multiline' : '' }}">
                <span class="info-name"></span>
                <span class="info-colon"></span>
                <span class="info-detail">{{ \Carbon\Carbon::parse(optional($details->first())->DocDueDate)->format('F j, Y') }}</span>
            </div>
        </div>
        <div class="right-box" style="min-height: 210px;max-height: 210px">
            <div class="new-col">
                <div class="shape" style="width: 30px">
                    {{-- <div> <a href=""><img  style='width: 30px; height:50%;' src="{{URL::asset('/images/arrow.png')}}" height='45px' alt="AVATAR"></a></div> --}}
                </div>
                <div class="payment-instruction">
                <div class="left-align">
                    <div class="info-row" style="margin: 8px 0px">
                        <span>{{ optional($details->first())->U_T1 }}</span>
                    </div>
                    <div class="info-row">
                        @if($details->first() && $details->first()->U_T3)
                            <?php
                                $intermediaryBankDetails = optional($details->first())->U_T2 . ' / ' . optional($details->first())->U_T3 . ' / ' . optional($details->first())->U_T4 . ' / ' . optional($details->first())->U_T5 . ' / ' . optional($details->first())->U_T6;

                                $formattedDetails = preg_replace('/^\/+|\/+$/', '', $intermediaryBankDetails);
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
                <div class="signature-space"><span>JOHN L. WEE</span></div>
            <br>
        </div>
    </div>
</div>
</body>
</html>
