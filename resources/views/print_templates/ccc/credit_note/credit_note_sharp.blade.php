
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Credit Note</title>
    
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }
        .header-container {
            min-height: 105px;
            display: table; 
            width: 100%; 
            margin-top: 80px; 
            text-align: right;
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
        .top-header{
            width: 100%; 
            display: inline-block;
            vertical-align: top;  
            text-align: right;
        }
        .top-header .info-label{
            width: 15%; 
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 13px;
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
            font-size: 13px;
            line-height: 1.5;
            word-wrap: break-word;
            text-align: left;
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
            width: 20%; /* Fixed width for labels */
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
            width: 60%;
            display: inline-block;
            vertical-align: top;  
            font-size: 13px;
            line-height: 1.5;
            word-wrap: break-word;
        }
        .customer-container .right-column .info-value{
            width: 40%;
            display: inline-block;
            vertical-align: top;  
            font-size: 13px;
            word-wrap: break-word;
        }
        .product_head{
            font-size: 13px;

        }
        .product_head table {
            margin-top: 10px;
            width: 100%;
            border-collapse: collapse; /* Collapses table borders */
            font-size: 13px;
        }
        .product_head th{
            padding: 5px;
           border: 2px solid black;
        }
        .product_head td{
            padding: 5px;
            text-align: center; 
            border: 1px solid black;
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
            width: 35%; /* Fixed width for labels */
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
            margin-left: 20px;
        }

        .total-value {
            display: table-cell;
            font-weight: bold;
            word-wrap: break-word;
            width: 100%;
            text-align:right;
            border-bottom: 4px double black;
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
            /* display: table; */
            width: 100%;     
            margin: 30px 0;  
            font-size: 13px;    
        }
        .new-con {
            /* display: table; */
            width: 100%;     
            font-size: 18px;    
            text-align: center;
            margin-bottom: 30px;
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
            width: 35%; /* Fixed width for labels */
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
        .signatory-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .signatory-cell {
            text-align: left;
            padding: 10px;

        }

        .signature-space {
            margin-top: 30px;
            width: 40%;
        }
         .border-bottom {
            border-bottom: 1px solid black;
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
    <div class="top-header">
        <div class="info-row">
            <span class="info-label">Date:</span>
            <span class="info-colon"></span>
            <span class="info-value">{{ \Carbon\Carbon::parse($details->first()->Date)->format('F j, Y') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Credit Note No.:</span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($details->first())->CreditNoteNumber }}</span>
        </div>
     </div>
</div>

<div class="new-con">
    <strong>DEBIT MEMORANDUM</strong>
</div>

@foreach ($details as $detail)
<div class="customer-container">
    <div class="left-column">
        <div class="info-row">
            <span class="info-label">To:</span>
            <span class="info-colon"></span>
            <span class="info-value"><strong>{{ optional($detail)->Client }}</strong></span>
        </div>
        <div class="info-row">
            <span class="info-label">Reason:</span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($detail)->Label2 }}</span>
        </div>
    </div>
</div>


<div class="product_head">
    <table>
        <thead>
            <tr>
                <th>SI Date</th>
                <th>SI#</th>
                <th>DR #</th>
                <th>PO#</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail->CreditNoteBody as $detailBody)
                <tr>
                    <td>{{ $detailBody->Label1 }}</td>
                    <td>{{ $detailBody->Label2 }}</td>
                    <td>{{ $detailBody->Label3 }}</td>
                    <td>{{ $detailBody->Label4 }}</td>
                    <td>{{ $detailBody->Label5 }}</td>
                    <td>{{ $detailBody->Label6 }}</td>
                    <td>{{ $detailBody->Label7 }}</td>
                    <td>{{ $detailBody->Label8 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($detail->Label1)
        <div style="margin-top: 10px">{!! nl2br(e($detail->Label1)) !!}</div>
    @endif
</div>

<div class="column-container">
    <div class="total" >
        <div class="total-label">TOTAL</div>
        <div class="total-value" >{{ optional($detail)->Total }}</div>
    </div>
</div>

<div class="new-col">
    <table class="signatory-table">
        <tr>
            <td class="signatory-cell">
                <div>Prepared by:</div>
                <div class="signature-space">
                    <span class="border-bottom">{{ auth()->user()->name }}</span>
                </div>
            </td>
            <td class="signatory-cell">
                <div>Approved by:</div>
                <div class="signature-space">
                    <span class="border-bottom">Josephine Galera</span>
                </div>
            </td>
        </tr>
    </table>    
</div>

@endforeach


</body>
</html>
