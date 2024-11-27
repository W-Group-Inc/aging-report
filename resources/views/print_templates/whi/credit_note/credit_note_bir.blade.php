
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Credit Note</title>
    
    <style>
        @page{
        margin: 70px 30px 15px 90px;
       }

        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }
        .header-container {
            min-height: 105px;
            display: table; 
            width: 100%; 
            padding-bottom: 10px; 
            margin-top: 52px; 
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
            width: 100%;
        }
        .customer-container::after {
            content: "";
            display: table;
            clear: both;
        }
        .left-column, .right-column {
            float: left; 
            font-size: 12px;
        }
        .left-column {
            width: 60%; 
        }
        .right-column {
            width: 40%; 
        }
        .info-row {
            margin-bottom: 5px; /* Space between rows */
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
        }
        .customer-container .left-column .info-colon{
            width: 0; 
            display: inline-block;
            vertical-align: top; 
        }
        .customer-container .right-column .info-label{
            width: 25%; 
            display: inline-block;
            vertical-align: top;  
            margin: 0;
            font-size: 13px;
        }
        .customer-container .left-column .info-value{
            width: 73%;
            display: inline-block;
            vertical-align: top;  
            font-size: 12px;
            word-wrap: break-word;
        }
        .customer-container .right-column .info-value{
            margin-left:5px;
            width: 40%;
            display: inline-block;
            vertical-align: top;  
            font-size: 12px;
            word-wrap: break-word;
        }
        .product-details table {
            width: 100%;
            border-collapse: collapse; 
        }
        .product-details th{
            text-align: center; 
        }
        .product-details thead tr{
            border-bottom: 10px; 
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
            text-align: center;
        }
        .product_head{
            max-height: 220px;
            min-height: 220px;
            font-size: 13px;
        }
        .product_head table {
            margin-top: 10px;
            width: 100%;
            border-collapse: collapse; 
            font-size: 12px;
        }
        .product_head td{
            text-align: center; 
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
            margin-top: 43px;
        }

        .total {
            margin-left: 68%;
            font-size: 13px;
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
        .new-col {
            margin-left: 10px;
            width: 100%;     
            margin-top: 65px ;  
            font-size: 13px;    
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
        .signature-space {
            width: 200px; /* Set the width of the signature line */
            display: block; /* Ensure it's treated as a block-level element */
            text-align: left;
            margin-bottom: 20px
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
    {{-- <div class="left">
        <div class="header">
            <span class="line-one">CREDIT NOTE</span>
            <div class="line-two">FR-ACC-20rev00</div>
            <div class="line-three">No.: <span>{{ optional($details->first())->CreditNoteNumber }}</span></div>
        </div>
    </div> --}}
    
    {{-- <div class="right">
        <div class="container">
            <div style="text-align: center">
                <div class="line-one">
                    <span class="header-large-text">W Hydrocolloids, Inc</span>
                </div>
                <div style="font-size: 12px"><strong>A member of the W Group, Inc</strong></div>
            </div>
        </div>
        

        <div class="line-two">
            <span class="header-small-text"><strong>Plant Address:</strong> Block 10 Lot 1 Phase 4 Mountview 1 Industrial Complex, Bancal, 4116 Carmona, Cavite, Philippines</span>
            <span class="header-small-text">VAT Reg. TIN 225-688-438-000</span>
            <span class="header-small-text"><strong>Admin Office:</strong> : 26/F, W Fifth Ave. Bldg. 3051 5th Ave. cor. 32nd St., Bonifacio Global City, Taguig City 1634 Philippines</span>
            <span class="header-small-text"><strong>Phone:</strong> : (+632) 8856.3838  | <strong>Fax:</strong> (+632) 8856.1033 </span>
            <span class="header-small-text">sales@rico.com.ph | www.rico </span>
        </div>
    </div> --}}
</div>
@foreach ($details as $detail)
    

<div class="customer-container">
    <div class="left-column">
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value"><strong>{{ optional($detail)->Client }}</strong></span>
        </div>
        <div class="info-row" style="margin-top: 15px">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value" style="line-height:1;">{{ optional($detail)->ClientAddress }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($detail)->Tin }}</span>
        </div>
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($detail)->BusinessStyle }}</span>
        </div>
    </div>
    <div class="right-column">
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ \Carbon\Carbon::parse(optional($detail)->Date)->format('m/d/Y') }}</span>
        </div>
        <div class="info-row" style="margin-top: 15px">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($detail)->Reference }}</span>
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
        <div class="info-row">
            <span class="info-label"></span>
            <span class="info-colon"></span>
            <span class="info-value"></span>
        </div>
    </div>
</div>

<div class="product-details">
    {{-- <table>
        <thead>
            <tr>
                <th style="width:50%; height: 16px;"></th>
                <th style="width:20%"></th>
                <th style="width:10%"></th>
                <th style="width:10%"></th>
            </tr>
        </thead>
    </table> --}}
</div>
<div class="product_head">
    @php
        $firstRow = $detail->CreditNoteBody->first();
        $bodyColumnCount = collect([$firstRow->Label1, $firstRow->Label2, $firstRow->Label3, $firstRow->Label4, $firstRow->Label5, $firstRow->Label6, $firstRow->Label7, $firstRow->Label8, $firstRow->Label9, $firstRow->Label10])
            ->filter()
            ->count();

        $firstColumnWidth = $bodyColumnCount == 1 ? '0' :  
                    ($bodyColumnCount == 2 ? '60%' : 
                    ($bodyColumnCount == 3 ? '90%' : 
                    ($bodyColumnCount == 4 ? '70%' : 'auto')));
                    
        $firstColumnAlignment = $bodyColumnCount == 1 ? 'center' :  
                    ($bodyColumnCount == 2 ? 'center' : 
                    ($bodyColumnCount == 3 ? 'center' : 
                    ($bodyColumnCount == 4 ? 'center' : 'auto')));
                    

    @endphp
    @if ($detail->Label2)
        <span style=""><strong>{{$detail->Label2}}</strong></th>
    @endif
    <table>
        <thead>
            <tr>
                <th style="width: {{ $firstColumnWidth }}; text-align: {{ $firstColumnAlignment }}">{{ $detail->CreditNoteHeader->Header1 }}</th>
                @for ($i = 2; $i <= 10; $i++)
                    <th>{{ $detail->CreditNoteHeader->{'Header' . $i} }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($detail->CreditNoteBody as $detailBody)
                @php
                    $lastNonEmptyIndex = null;
                    for ($i = 10; $i >= 1; $i--) {
                        if (!empty($detailBody->{'Label' . $i})) {
                            $lastNonEmptyIndex = $i;
                            break;
                        }
                    }
                @endphp
                <tr>
                <td style="width: {{ $firstColumnWidth }}; text-align: {{ $firstColumnAlignment }}">{{ $detailBody->Label1 }}</th>
                    @for ($i = 2; $i <= 10; $i++)
                        <td style="{{ $i == $lastNonEmptyIndex && in_array($bodyColumnCount, [1, 2, 3, 4]) ? 'width:100px;' : '' }}
                            {{ $i == $lastNonEmptyIndex ? 'text-align:right;' : '' }}
                             {{ $i == $lastNonEmptyIndex && $bodyColumnCount == 2 ? 'width: 40%;' : '' }}">
                            {{ $detailBody->{'Label' . $i} }}
                        </td>
                    @endfor
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
        <div class="total-label"></div>
        <div class="total-value" >{{ optional($detail)->Total }}</div>
    </div>
</div>

<div class="new-col">
    <div class="signatory">
        <div class="signature-space"><span>{{ auth()->user()->name }}</span></div>
    </div>
    <div class="signatory">
        <div style="margin-bottom: 50px"></div>
        <div class="signature-space"><span>Camille Bueza / Josephine Galera</span></div>
    </div>
</div>
@endforeach

</body>
</html>
