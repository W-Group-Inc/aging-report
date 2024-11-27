
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
        @page {
            margin-top: 100px ; 
            /* margin-right: 50px ; */
            margin-bottom: 100px ;
            /* margin-left: 50px; */
        }
        header {
            position: fixed;
            top: -80px; /* Distance from the top of the page */
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
        }
        .middle {
            width: 40%;
            text-align: center;
            vertical-align: middle;
            margin: 0;
            padding: 0;
        }
        .middle-logo img {
            display: block;
            max-width: 130px; 
            height: auto; 
            margin: 0; /* Remove margins */
            padding: 0; /* Remove padding */
        }

        .middle-header {
            display: block;
            font-size: 22px; 
            font-weight: bold;
            line-height: 1; /* Adjust line height to reduce space */
            margin: 0; /* Remove margin */
            padding: 0; /* Remove padding */
        }
        .group-text{
            margin-top: -40px;
        }
        .middle-sub-text {
            display: block;
            font-size: 13px; 
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
        .customer-container {
            width: 100%;
        }
        .customer-container::after {
            content: "";
            display: table;
            clear: both;
        }
        .left-column, {
            float: left; 
            width: 70%; 
            font-size: 13px;
            line-height: 1.5;
        }
        .right-column, {
            float: right; 
            width: 30%; 
            font-size: 13px;
            line-height: 1.5;
        }

        .info-row {
            margin-bottom: 5px; /* Space between rows */
        }
        .info-row span {
            display: inline-block; /* Align label and value on the same line */
            vertical-align: top;   /* Ensure alignment between label and value */
        }
        .info-label {
            font-size: 13px;
            font-style: italic;
            width: 15%; /* Fixed width for labels */
            display: inline-block;
            margin-right: 20px;
            vertical-align: top;   /* Align the label with the top of the value */
        }
        .info-value {
            font-size: 13px;
            width: 55%; /* Width for values */
            word-wrap: break-word; /* Allow long values to break to the next line */
            vertical-align: top;   /* Align the value with the top */
        }
        .product-details table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        .base-table {
            border: 1px solid black;
        }

        .nested-table table {
            width: 100%;
            border-collapse: collapse;
            padding: 20px;
        }

        .nested-table th, .nested-table td {
            padding: 5px;
            text-align: center; 
        }


        .amount{
            width: 100%;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 5px;
            padding-right: 5px;
        }
        .amount-two{
            /* text-align: center;  */
            /* text-align: right; */
            padding-top: 10px;
            padding-left: 0;
            padding-right: 0;
        }

        .total-row {
            padding: 10px;
            text-align: right;
            font-weight: bold;
        }

        .subject {
            margin-bottom: 15px;
            font-size: 14px;
            font-weight: bold;
        }

        .info-name {
            width: 20%; /* Fixed width for labels */
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
            width: 30%;
            display: inline-block;
            vertical-align: top;  
            font-size: 13px;
            
        }
        .new-row {
            clear: both; 
            width: 100%;
            display: block; /* Block display to break to a new line */
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
        .signature {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .signature th {
            text-align: left;
            padding-bottom: 30px;
        }
        .signature td {
            text-align: center;
            padding-top: 5px;
        }
        .signature .underline {
            display: inline-block;
            border-bottom: 1px solid black;
            padding: 0 40px;
        }
        .signature .position {
            font-size: 10px;
            font-style: italic;
        }
        .new-signature th {
            text-align: left;
            padding-bottom: 30px;
        }
        .new-signature td {
            text-align: center;
            padding-top: 5px;
        }
        .new-signature .underline {
            display: inline-block;
            border-bottom: 1px solid black;
            padding: 0 40px;
        }
        .new-signature .position {
            font-size: 10px;
            font-style: italic;
        }
        .footer {
            width: 100%;
            position: fixed; 
            bottom: 0;
            font-size: 12px;
            border-top: 1px solid black;
        }

        .footer-center {
            text-align: center;
        }
        .next-line{
            display: block;
        }
    </style>
</head>
<body>
 
@foreach ($details as $detail)
    
   
<header>
    <div class="header-container">
    </div>
</header>
<footer>
    <div class="new-row">
        <div class="footer">
            <div class="footer-center">
                <span class="next-line">W HYDROCOLLOIDS, INC.</span>
                <span class="next-line">Office: 26th Floor. W building. Fifth Avenue. Bonifacio Global City. Taguig City. 1634. Philippines</span>
                <span class="next-line">Plant: Block 10 Lot 1 PH4 Mountview I Industrial Complex Bancal, Carmona, Cavite 4116, Philippines</span>
                <span class="next-line">TIN: 225-688-438-000 TelNo.: +632 8856 3838 Fax No.: +632 8856 1033</span>
                <span class="next-line">Email: sales@rico.com.ph Website:www.rico.com.ph</span>
            </div>
        </div>
    </div>
</footer>
<div class="content">
    <div class="customer-container">
        <div class="left-column">
            <div class="info-row">
                <span class="info-label">Billed To:</span>
                <span class="info-value" style="font-weight: bold; font-size:14px">{{ optional($detail)->BilledTo }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Attention:</span>
                <span class="info-value">Accounting Department</span>
            </div>
        </div>
        <div class="right-column">
            <div class="info-row">
                <span class="info-label">SOA:</span>
                <span class="info-value" style="font-weight: bold; font-size:14px">{{ optional($detail)->Soa }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Date:</span>
                <span class="info-value" style="font-weight: bold; font-size:14px">{{\Carbon\Carbon::parse(optional($detail)->DocDueDate)->format('F j, Y') }}</span>
            </div>
        </div>
        
    </div>
    <div class="product-details">
       <table class="base-table">
        <thead>
            <tr>
                <th></th>
                <th style="border:1px solid black">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="subject">
                        <p><strong>SUBJECT</strong>: Reimbursement of OCF for Export shipments paid by WHI.</p>
                    </div>
                    <table>
                        <tr>
                            <td class="nested-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Particulars</th>
                                            <th>Date/Period</th>
                                            <th>Doc. Ref#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detail->billingProducts as $item)
                                        <tr>
                                            <td>{{ $item->Particulars }}</td>
                                            <td>{{ $item->DatePeriod }}</td>
                                            <td>{{ $item->DocRef }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="total-row">
                                <strong>Total Amount Due:</strong>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="border:1px solid black">
                    <table>
                        <tr>
                            <td class="nested-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="padding-top: 30px; padding-bottom: 30px"></th>
                                            <th style="padding-top: 30px; padding-bottom: 30px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($detail->billingProducts as $item)
                                        @php
                                            $total += $item->Amount;
                                        @endphp
                                            <tr>
                                                <td class="amount">{{ $detail->Currency }}</td>
                                                <td class="amount">{{ number_format($item->Amount, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="amount-two">{{ $detail->Currency }}</td>
                            <td class="amount-two">{{ $total }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
       </table>
    </div>
    
    <div class="bottom-layout">
        <div class="new-row">
            <div class="new-col-left" style="margin-top: 30px">
                <div class="info-row">
                    <span class="info-name">Terms</span>
                    <span class="info-colon">:</span>
                    <span class="info-detail">{{ optional($detail)->TermsOfPayment}}</span>
                </div>
                <div class="info-row">
                    <span class="info-name">Due Date</span>
                    <span class="info-colon">:</span>
                    <span class="info-detail">{{\Carbon\Carbon::parse(optional($detail)->DueDate)->format('F j, Y') }}</span>
                </div>
            </div>
        </div>
        <div class="new-row">
            <div class="new-col-left" style="margin-top: 10px">
                <span>In case of online payment please pay to:</span>
                <div class="info-row">
                    <span class="info-name">Account Name</span>
                    <span class="info-colon">:</span>
                    <span class="info-detail">{{ optional($detail)->AccountName}}</span>
                </div>
                <div class="info-row">
                    <span class="info-name">Account Number</span>
                    <span class="info-colon">:</span>
                    <span class="info-detail">{{ optional($detail)->AccountNumber}}</span>
                </div>
                <div class="info-row">
                    <span class="info-name">Bank</span>
                    <span class="info-colon">:</span>
                    <span class="info-detail">{{ optional($detail)->Bank}}</span>
                </div>
            </div>
        </div>
        <div class="new-row">
        </div>
        <div class="new-row" style="">
            <div class="new-col-left">
                <table class="signature">
                    <tr>
                        <th>Prepared by:</th>
                        <th>Checked by:</th>
                        <th>Approved by:</th>
                    </tr>
                    <tr>
                        <td><span class="underline">Archie Valdejueza</span></td>
                        <td><span class="underline">Camille Bueza</span></td>
                        <td><span class="underline">Josephine Galera</span></td>
                        <td><span class="underline">Gilbert Chua</span></td>
                    </tr>
                    <tr>
                        <td class="position">AR Accountant</td>
                        <td class="position">AR Supervisor</td>
                        <td class="position">Sr. Accounting Manager</td>
                        <td class="position">Comptroller</td>
                    </tr>
                </table>
            
            </div>
        </div>
        <div class="new-row" style="">
            <div class="new-col-left">
                <table class="new-signature" >
                    <tr>
                        <th>Received by / Date:</th>
                    </tr>
                    <tr>
                        <td><span class="underline"></span></td>
                    </tr>
                    <tr>
                        <td>Signature over Printed Name</td>
                    </tr>
                </table>
            
            </div>
        </div>
    </div>
</div>


@endforeach 
</body>
</html>
