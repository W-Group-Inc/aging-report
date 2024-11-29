
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CCC Billing Statement</title>
    
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }
        @page {
            margin-top: 200px ; 
            /* margin-right: 50px ; */
            margin-bottom: 100px ;
            /* margin-left: 50px; */
        }
        header {
            position: fixed;
            top: -80px; 
            left: 0;
            right: 0;
            height: 50px;
            text-align: center;
            line-height: 35px;
        }

        footer {
            position: fixed;
           
            left: 0;
            right: 0;
            height: 40px;
            text-align: center;
            line-height: 15px;
        }

        .content {
            margin-top: 50px;
            margin-bottom: 100px;
            display: block;
        }

        .header-container {
            display: table; 
            width: 100%; 
            padding-bottom: 10px; 
            margin-bottom: 20px; 
        }
        .left, .middle, .right {
            display: table-cell;
            vertical-align: top;
        }
        .left {
            width: 30%;
            margin:0;
            text-align: left;
        }
        .left-logo img {
            display: block;
            max-width: 130px; 
        }
        .middle {
            width: 40%;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .middle-header {
            display: block;
            font-size: 14px; 
            font-weight: bold;
            margin: 0; 
            padding: 0; 
            height: 20px;
        }
        .middle-sub-text {
            display: block;
            font-size: 13px; 
        }
        .middle .main-title{
            margin-top: 10px;
            font-size: 24px;
            font-weight: bold;
        }


        .right {
            width: 30%;
            text-align: right; 
        }
        .header-container .right .line-two {
            margin-top: 100px;
            line-height: 1;
        }
        .header-soaNo {
            border-bottom: solid #000;
            font-size: 16px;
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
        .top-header{
            width: 100%; 
            display: inline-block;
            vertical-align: top;  
            text-align: right;
            font-size: 13px;
        }
        .top-header .info-label{
            width: 15%; 
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            text-align: left;
        }
        .top-header .info-colon{
            width: 0; 
            display: inline-block;
            vertical-align: top; 
        }
        .top-header .info-value{
            width: 20%;
            display: inline-block;
            vertical-align: top;  
            line-height: 1.5;
            word-wrap: break-word;
            text-align: left;
        }
        .middle-title{
            width: 100%; 
            display: inline-block;
            vertical-align: top;  
            text-align: center;
            font-size: 13px;
        }
        .customer-container {
            width: 100%;
        }
        .customer-container::after {
            content: "";
            display: table;
            clear: both;
        }

        .customer-container .info-row {
            margin-bottom: 5px; 
        }
        .customer-container .info-row span {
            display: inline-block; 
            vertical-align: top;   
        }
        .customer-container .info-label {
            font-size: 13px;
            padding-left: 150px;
            width: 5%; 
            display: inline-block;
            margin-right: 30px;
            vertical-align: top;   
        }
        .customer-container .info-value {
            font-size: 13px;
            width: 55%; 
            word-wrap: break-word;
            vertical-align: top;  
        }
        
        .base-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        .table-header {
            border: 1px solid black;
            font-weight: bold;
        }

        .billing-details{
            border: 1px solid black;
            padding: 15px;
            vertical-align: top;
        }

        .amount-due {
            border: 1px solid black;
            padding: 15px;
            vertical-align: top;
            padding-top:40px;
        }
        .products {
            width: 100%;
            border-collapse: collapse;
        }

        .table-cell {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .delivery-details {
            margin-top: 10px;
        }

        .amount-item {
            margin-top: 10px;
            display: block;
        }

        .amount-due-header {
            width: 15%;
        }

        .total-label {
            border: 1px solid black;
            padding: 5px;
            text-align: right;
            font-weight: bold;
        }

        .total-amount {
            border: 1px solid black;
            padding: 5px;
            text-align: right;
            font-weight: bold;
        }

        .info-name {
            width: 20%; 
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;
        }
        .info-colon {
            width: 5%; 
            display: inline-block;
            vertical-align: top;   
        }
        .info-detail {
            width: 30%;
            display: inline-block;
            vertical-align: top;  
            font-size: 13px;
            
        }
        .new-row {
            clear: both; 
            width: 100%;
            display: block;
            margin-top: 20px
        }

        .new-col-right {
            float: right; 
            width: 50%; 
            font-size: 13px;
        }
        .new-col-left {
            float: left; 
            width: 100%; 
            font-size: 13px;
        }
        .bottom-layout {
            width: 100%;
            /* bottom: 0 */
        }
        .bottom-layout .info-name {
            width: 15%; 
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 12px;
        }
        .bottom-layout .info-detail {
            width: 80%;
            display: inline-block;
            vertical-align: top;  
            font-size: 13px;
            
        }
        .bolder {
            font-weight: bolder;
        }
        .signatures {
            float: left; 
            width: 100%; 
            font-size: 10px;
        }
        .signature {
            width: 100%;
            border-collapse: collapse;
            margin-top: 50px;
        }
        .signature th {
            text-align: left;
            padding-bottom: 30px;
        }
        .signature td {
            text-align: left;
            padding-top: 5px;
        }
        .signature .underline {
            display: inline-block;
            text-align: left;
            font-weight: bold;
        }
        .signature .position {
            font-size: 10px;
            text-align: left;
        }
        .next-line{
            display: block;
        }
    </style>
</head>
<body>
    
<header>
    <div class="header-container">
        <div class="left">
            <span class="left-logo">
                <img src="{{ asset('/images/ccc_logo.png')}}" alt="Company Logo">
            </span>
        </div>
        <div class="middle">
            <div class="group-text">
                <span class="middle-header">CEBU CARRAGEENAN CORPORATION</span>
                <span class="middle-sub-text">Brgy. Cantumog, Carmen, Cebu</span>
            </div>
            <div class="main-title">BILLING STATEMENT</div>
        </div>
        
        <div class="right">
        </div>
    </div>

</header>
<div class="content">
    
    <div class="top-header">
        <div class="info-row">
            <span class="info-label"><strong>NUMBER:</strong></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($details->first())->ArNumAtCard }}            </span>
        </div>
        <div class="info-row">
            <span class="info-label"><strong>DATE</strong></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ \Carbon\Carbon::parse(optional($details->first())->Date)->format('F j, Y') }}</span>
        </div>
     </div>
     <div class="middle-title">
        <div class=""><strong>-ATTENTION-</strong></div>
     </div>
    <div class="customer-container">
        <div class="left-column">
            <div class="info-row">
                <span class="info-label">Company:</span>
                <span class="info-value">{{ optional($details->first())->CardName }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Address:</span>
                <span class="info-value" style="font-weight: bold; font-size:14px">{{ optional($details->first())->Billtoaddress }}</span>
            </div>
            </div>
    </div>
    <div class="middle-title" style="margin-top: 30px">
        <div class="">This is to bill you for the following</div>
     </div>
     <div class="product-details">
        <table class="base-table">
            <thead>
                <tr>
                    <th class="table-header">Details of Billing</th>
                    <th class="table-header amount-due-header">Amount Due</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <!-- Details of Billing Column -->
                    <td class="billing-details">
                        <table class="products">
                            <thead>
                                <tr>
                                    <th class="table-header">ATD DATE</th>
                                    <th class="table-header">TENTATIVE <br> DUE DATE</th>
                                    <th class="table-header">REF#</th>
                                    <th class="table-header">DESCRIPTION</th>
                                    <th class="table-header">QUANTITY</th>
                                    <th class="table-header">UNIT PRICE</th>
                                    <th class="table-header">AMOUNT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $detail)
                                    <tr>
                                        <td class="table-cell">{{ \Carbon\Carbon::parse($detail->Date)->format('m/d/Y') }}</td>
                                        <td class="table-cell">{{ \Carbon\Carbon::parse($detail->ArDueDate)->format('m/d/Y') }}</td>
                                        <td class="table-cell">{{ $detail->RefNumber ?? 'N/A' }}</td>
                                        <td class="table-cell">{{ $detail->U_Label }} dddddd</td>
                                        <td class="table-cell text-right">{{ number_format($detail->Quantity, 2) }}</td>
                                        <td class="table-cell text-right">
                                            @if ($detail->DocCur == 'PHP')
                                                ₱
                                            @elseif ($detail->DocCur == 'USD')
                                                $
                                            @elseif ($detail->DocCur == 'EUR')
                                                €
                                            @endif {{ number_format($detail->Price, 2) }}</td>
                                        <td class="table-cell text-right">
                                            @if ($detail->DocCur == 'PHP')
                                                ₱
                                            @elseif ($detail->DocCur == 'USD')
                                                $
                                            @elseif ($detail->DocCur == 'EUR')
                                                €
                                            @endif {{ number_format($detail->Linetotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p class="delivery-details">
                            <strong>Delivered to:</strong> {{ optional($details->first())->NumAtCard }}<br />
                            <strong>{{ optional($details->first())->ArInvoiceNo }}</strong>
                        </p>
                    </td>
                    <td class="amount-due text-right">
                        @foreach ($details as $detail)
                            <div class="amount-item">
                                @if ($detail->DocCur == 'PHP')
                                    ₱
                                @elseif ($detail->DocCur == 'USD')
                                    $
                                @elseif ($detail->DocCur == 'EUR')
                                    €
                                @endif
                                {{ number_format($detail->Linetotal, 2) }}
                            </div>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="total-label">TOTAL</td>
                    <td class="total-amount">@if ($detail->DocCur == 'PHP')
                        ₱
                    @elseif ($detail->DocCur == 'USD')
                        $
                    @elseif ($detail->DocCur == 'EUR')
                        €
                    @endif {{ number_format($details->sum('Linetotal'), 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="bottom-layout">
        <div class="new-row">
            <div class="new-col-left" style="margin-top: 20px">
                <div class="info-row">
                    <span class="info-name"><strong>Terms:</strong></span>
                    <span class="info-detail">{{ optional($details->first())->PymntGroup}}</span>
                </div>
                <div class="info-row">
                    @php
                        $total = 0;  
                    @endphp
                    @foreach ($details as $detail)
                        @php
                            $total += $detail->Linetotal; 
                            $amountInWords = numberToWords($total);
                            if ($detail->DocCur == 'PHP') {
                                $Currency = 'Peso Only';
                            } elseif ($detail->DocCur == 'EUR') {
                                $Currency = 'Euro Only';
                            } elseif ($detail->DocCur == 'USD') {
                                $Currency = 'Dollars Only';
                            } else {
                                ' ';
                            }
                        @endphp
                    @endforeach
                    <span class="info-name"><strong>Amount in Words</strong></span>
                    <span class="info-detail bolder">{{ ($amountInWords) }} {{ $Currency }} </span>
                </div>
            </div>
        </div>
       
        <div class="new-row" style="">
            <div class="signatures">
                <div style="margin-top:20px">
                    <span>Please make check payable to <strong>Cebu Carrageenan Corporation</strong></span>
                </div>
                <table class="signature">
                    <tr>
                        <th style="width:100px">Prepared by:</th>
                        <th style="width:100px">Approved by:</th>
                        <th style="width:100px"></th>
                        <th style="width: 150px">Received by:</th>
                    </tr>
                    <tr>
                        <td><span class="underline">Jennifer Ramos</span></td>
                        <td><span class="underline">Josephine Galera</span></td>
                        <td><span class=""></span></td>
                        <td><span class="underline"></span></td>
                    </tr>
                    <tr>
                        <td class="position">Acctg. Supervisor</td>
                        <td class="position">Sr. Acctg. Manager</td>
                        <td class="position"></td>
                        <td class="position"><strong>Signature/Name/Date</strong><br>Received all the original attachments &
                            other supporting documents</td>
                    </tr>
                </table>
            
            </div>
        </div>
    </div>
</div>



</body>
</html>
