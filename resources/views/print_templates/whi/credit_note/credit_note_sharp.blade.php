
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
            padding-bottom: 10px; 
            margin-top: 40px; 
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
        .product-details table {
            margin-top: 10px;
            width: 100%;
            border-collapse: collapse; /* Collapses table borders */
            font-size: 13px;
        }
        .product-details th{
            border: 1px solid #000; /* Table cell borders */
            text-align: center; /* Align text to the left */
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
            text-align: center; /* Align text to the left */
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
        .new-col {
            /* display: table; */
            width: 100%;     
            margin: 30px 0;  
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
            border-bottom: 1px solid #000; /* Create a line for the signature */
            width: 200px; /* Set the width of the signature line */
            display: block; /* Ensure it's treated as a block-level element */
            text-align: center;
            margin-bottom: 30px
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
            <span class="line-one">CREDIT NOTE</span>
            <div class="line-two">FR-ACC-20rev00</div>
            <div class="line-three">No.: <span>{{ optional($details->first())->CreditNoteNumber }}</span></div>
        </div>
    </div>
    
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
            <span class="info-label">To:</span>
            <span class="info-colon"></span>
            <span class="info-value"><strong>{{ optional($detail)->Client }}</strong></span>
        </div>
        <div class="info-row">
            <span class="info-label">Address:</span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($detail)->ClientAddress }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">TIN:</span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($detail)->Tin }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Business Style:</span>
            <span class="info-colon"></span>
            <span class="info-value">{{ optional($detail)->BusinessStyle }}</span>
        </div>
    </div>
    <div class="right-column">
        <div class="info-row">
            <span class="info-label">Date:</span>
            <span class="info-colon"></span>
            <span class="info-value">{{ \Carbon\Carbon::parse(optional($detail)->Date)->format('m/d/Y') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Reference:</span>
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
    <table>
        <thead>
            <tr>
                <th style="width:50%">Description</th>
                <th style="width:20%">Quantity</th>
                <th style="width:10%">Unit Price </th>
                <th style="width:10%">Amount</th>
            </tr>
        </thead>
    </table>
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
        <div class="total-label">TOTAL</div>
        <div class="total-value" >{{ optional($detail)->Total }}</div>
    </div>
</div>

<div class="new-col">
    <div class="signatory">
        <div style="margin-bottom: 20px">Prepared by:</div>
        <div class="signature-space"><span>{{ auth()->user()->name }}</span></div>
    </div>
    <div class="signatory">
        <div style="margin-bottom: 20px">Approved by:</div>
        <div class="signature-space"><span>Camille Bueza / Josephine Galera</span></div>
    </div>
</div>
{{-- <div class="product-details">
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Packing</th>
                <th>Unit</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $detail)
            <tr>
                <td>{{ $detail->U_label_as }}</td>
                <td>{{ $detail->U_Bagsperlot }}
                    @if ($detail->U_Bagsperlot > 1)
                        bags
                    @elseif ($detail->U_Bagsperlot == 0)
                    
                    @else
                        bag
                    @endif
                    @if ($detail->U_Bagsperlot != 0)
                    <span style="float: right; text-align:end">x</span>
                    @endif
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
            <tr>
                <td>{{ $detail->U_SupplierCode }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div> --}}

{{-- <div class="product-total">
    @php
        $total = 0;
        foreach ($details as $detail){
            $total += $detail->TotalFrgn;
        }
    @endphp
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
</div> --}}


{{-- <div class="column-container">
    <div class="column-right">
        <div class="total">
            <div class="label">TOTAL</div>
            <div class="arrow"> <a href=""><img  style='width: 30px; height:20px;' src="{{URL::asset('/images/arrow.png')}}" height='45px' alt="AVATAR"></a></div>
            <div class="total-value">{{ optional($details->first())->DocCur }} {{ number_format($total, 2) }}</div>
        </div>
    </div>
</div> --}}

{{-- <div class="new-row">
    <div class="new-col-left" style="margin-top: 100px">
        <div class="info-row">
            <span class="info-name">Date of Shipment</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ \Carbon\Carbon::parse(optional($details->first())->DocDueDate)->format('F j, Y') }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Port of Loading</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{optional($details->first())->U_PortLoad }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Port of Destination</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{optional($details->first())->U_PortDestination }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Mode of Shipment</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{optional($details->first())->U_ModeShip }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Terms of Delivery</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{optional($details->first())->U_Delivery }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Feeder Vessel</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{optional($details->first())->U_FeedVessel }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Ocean Vessel</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{optional($details->first())->U_OceanVessel }}</span>
        </div>
        @if (optional($details->first())->U_ABILL)
            <span class="info-name">Airway Bill No.</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->U_ABILL }}</span>
        @else
            <span class="info-name">Bill of Lading</span>
            <span class="info-colon">:</span>
            <span class="info-detail"></span>
        @endif
        <div class="info-row">
            <span class="info-name">Container No.</span>
            <span class="info-colon">:</span>
            @if (optional($details->first())->U_ContainerNo === 'insert container no.')
            <span class="info-detail"></span>
            @else
            <span class="info-detail">{{optional($details->first())->U_OceanVessel }}</span>
            @endif
        </div>
        <div class="info-row">
            <span class="info-name">Seal No.</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{optional($details->first())->U_Seal }}</span>
        </div>
    </div>
    <div class="new-col-right" style="margin-top: 30px;">
        <div class="info-row">
            <span class="info-name">Terms of Payment</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ optional($details->first())->PymntGroup }}</span>
        </div>
        <div class="info-row">
            <span class="info-name">Invoice Due Date</span>
            <span class="info-colon">:</span>
            <span class="info-detail">{{ \Carbon\Carbon::parse(optional($details->first())->U_SAODueDate)->format('F j, Y') }}</span>
        </div>
        <div class="right-box">
            <div class="new-col">
                <div class="shape">
                    <div> <a href=""><img  style='width: 30px; height:50%;' src="{{URL::asset('/images/arrow.png')}}" height='45px' alt="AVATAR"></a></div>
                </div>
                <div class="payment-instruction">
                    <div>Payment Instructions: </div>
                <div class="left-align">
                    <div class="info-row" style="margin: 10px 0px">
                        <span>{{ optional($details->first())->U_T1 }}</span>
                    </div>
                    
                </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
{{-- <div class="new-row">
    <div class="new-col-left">
        <div class="info-row">
            <strong>ORIGINAL</strong>
        </div>
    </div>
    <div class="new-col-right">
        <div class="center-align">
            <strong>W HYDROCOLLOIDS INC.</strong>
            <div class="signatory">
                <div class="signature-space"><span>{{ $prepared_by }}</span></div>
                
            </div>
            <div class="text">
                <span style="display: block">Authorized Representative</span>
                <span style="display: block">Signatureover Printed Name</span>
            </div>
            <br>
        </div>
    </div>
</div> --}}
@endforeach

{{-- <div class="new-row">
    <div class="footer">
        <div class="footer-left">
            <p>WHI-TP-ACC-088</p>
            <p>Rev. 0 03/11/2024 </p>
        </div>
        <div class="footer-right">
            <p>Page {PAGE_NUM} of {PAGE_COUNT}</p>
        </div>
    </div>
</div> --}}


</body>
</html>
