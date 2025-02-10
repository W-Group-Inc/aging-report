
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Commercial Invoice</title>
    
    <style>
        @page{
        margin: 70px 58px 10px 0px;
       }
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }
        .header-container {
            display: table; 
            width: 100%; 
            margin-top: 52px; 
            padding-bottom: 10px; 
            margin-bottom: 80px; 
        }
        .header-container .left .header .line-two {
            font-size: 11px;
        }
        .header-container .left .header .line-three {
            margin-top: 30px;
            font-size: 16px;
            font-weight: bold;
        }
        .header-container .left .header .date {
            margin-top: 30px;
            font-size: 9px;
        }
        .header-small-text{
            font-size: 12px;
            display: block;
        }
        .left, .right {
            display: table-cell;
            vertical-align: top;
        }
        .left {
            width: 50%;
        }
        .right {
            width: 50%;
        }
        .header-large-text{
            font-size: 26px;
            font: bold;
        }
        .header-medium-text{
          font-size: 8px;
          display: block;
        }
        
        .customer-container {
            width: 100%;
            min-height: 302px;
            max-height: 302px;
            margin-bottom: -7px;
        }
        .customer-container::after {
            content: "";
            display: table;
            clear: both;
        }
        .left-column, .right-column {
            float: left; 
            width: 55%; 
            font-size: 12px;
            line-height: 1.8;
        }
        .customer-container .left-column .info-row {
            margin-bottom: 5px; 
        }
        .customer-container .left-column .info-label {
            width: 20%; 
            display: inline-block;
            margin-right: 30px;
            vertical-align: top;   
        }
        .customer-container .left-column .info-value {
            width: 70%; 
            word-wrap: break-word; 
            vertical-align: top;   
        }
        .customer-container .right-column .info-row{
            margin-bottom: 10px; 
        }
        .customer-container .right-column .info-label {
            width: 30%; 
            display: inline-block;
            margin-right: 10px;
            vertical-align: top; 
        }
        .customer-container .right-column .info-value {
            width: 45%; 
            word-wrap: break-word; 
            vertical-align: top;   
        }
        
        .info-row span {
            display: inline-block; 
            vertical-align: top;  
        }
        .product-details {
            max-height: 300px;
            min-height: 300px;
        }
        .product-details .top-table {
            width: 100%;
            border-collapse: collapse; 
            font-size: 13px;
        }
        .product-details .top-table th{
            height: 15px;
            /* border: 1px solid #000;  */
            text-align: center;
            width: 100%;
        }
        .product-details .top-table td{
            padding: 2px; 
            /* border-left: 1px solid #000; */
            text-align: center; 
            /* border-right: 1px solid #000; */

        }
        
        .product-details-middle .middle-table{
            width: 50%;
            border-collapse: collapse; 
            font-size: 13px;
        }
        .product-details-middle .middle-table tr:last-child td {
            /* border-bottom: 1px solid black; */
            
        }
        .product-details-middle .middle-table tr{
            /* border-right: 1px solid black;
            border-left: 1px solid black; */
            
        }
        .product-details-middle .middle-table .label-column{
            text-align: left;
            width: 10%;
            height: 14.6px;
        }
        .product-details-middle .middle-table .value-column {
            width: 30%;
            padding-right: 20px;
            text-align: right;

        }
        .product-details-bottom{
            max-height: 100px;
            min-height: 100px;
        }
        .product-details-bottom .bottom-table{
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        .product-details-bottom .bottom-table tr:last-child td {
            /* border-bottom: 1px solid black; */
            
        }
        .product-details-bottom .bottom-table tr{
            /* border-right: 1px solid black;
            border-left: 1px solid black; */
            padding: 10px;
            vertical-align: top
            
        }
        .product-details-bottom .bottom-table .label-column{
            text-align: left;
            width: 15%;
        }

        .product-details-bottom .bottom-table .value-column{
            text-align: left;
            width: 40%;
            padding-left: 10px
        }
        .new-row {
            clear: both; 
            width: 100%; 
            display: block; 
        }
        .right-column .info-row.multiline .info-value{
            /* margin-top: -20px; */
            line-height: 1;

        }
    </style>
</head>
<body>
    
<div class="header-container">
    {{-- <div class="left">
        <div class="header">
            <div class="line-two">FR-ACC-16rev02</div>
            <div class="new-row">
              <div class="group">
                <div class="image" style="float: left">
                  <img src="{{ asset('/images/pbi_logo.webp')}}" alt="Company Logo" style="width: 100px; width:100px"> 
            </div>
            <div class="text" style="float: right">
              <span class="header-small-text">PHILIPPINE BIO INDUSTRIES, INC</span>
              <span class="header-small-text">103 Integrity Avenue, Carmelray Industrial</span>
              <span class="header-small-text">Park 1, Canlubang, Calamba City,</span>
              <span class="header-small-text">Laguna 4028, Philippines</span>
              <span class="header-small-text">Tel: (02) 8856-3838 / Fax (02) 8856-1033</span>
            </div>
              </div>
            </div>
        </div>
    </div>
    <div class="right">
        <div style="bottom: 0; margin-left: 25;  text-align: left; background-color:rebeccapurple">
          <span class="header-small-text">VAT REG. TIN: 000-316-923-000</span>
        </div>
    </div> --}}
</div>

<div class="content">
      <div class="customer-container">
          <div class="left-column">
              <div class="info-row" style="max-height: 44px; min-height:44px">
                  <span class="info-label"></span>
                  <span class="info-value">{!! nl2br(optional($details->first())->SoldTo)!!}
                  </span>
              </div>
              <div class="info-row" style="max-height: 45px; min-height:45px">
                  <span class="info-label"></span>
                  <span class="info-value"></span>
              </div>
              <div class="info-row" style="max-height: 50px; min-height:50px">
                <span class="info-label"></span>
                <span class="info-value"> {!! nl2br(optional($details->first())->ShipTo) !!}</span>
            </div>
              <div class="info-row" style="max-height: 60px; min-height:60px">
                  <span class="info-label"></span>
                  <span class="info-value"></span>
              </div>
              <div class="info-row">
                  <span class="info-label"></span>
                  <span class="info-value"></span>
              </div>
          </div>
          <div class="right-column">
              <div class="info-row">
                  <span class="info-label"></span>
                  <span class="info-value">{{ \Carbon\Carbon::parse(optional($details->first())->invoice_date)->format('F j, Y') }}</span>
              </div>
              <div class="info-row" style="margin-bottom:15px">
                  <span class="info-label"></span>
                  <span class="info-value">{{ optional($details->first())->BuyersPo }}</span>
              </div>
              <div class="info-row">
                  <span class="info-label"></span>
                  <span class="info-value">{{ optional($details->first())->BuyersRef }}</span>
              </div>
              <div class="info-row">
                  <span class="info-label"></span>
                  <span class="info-value">{{ \Carbon\Carbon::parse(optional($details->first())->InvoiceDueDate)->format('F j, Y') }}</span>
              </div>
              <div class="info-row {{ strlen(optional($details->first())->TermsOfPayment) > 35 ? 'multiline' : '' }}" style="margin-bottom:10px">
                <span class="info-label"></span>
                <span class="info-value">{{ optional($details->first())->TermsOfPayment }}</span>
            </div>
              <div class="info-row">
                  <span class="info-label"></span>
                  <span class="info-value">{{ optional($details->first())->SoNo }}</span>
              </div>
              <div class="info-row">
                <span class="info-label"></span>
                <span class="info-value"></span>
            </div>
            <div class="info-row">
              <span class="info-label"></span>
              <span class="info-value"></span>
          </div>
          <div class="info-row">
            <span class="info-label"></span>
            <span class="info-value"></span>
        </div>
          </div>
      </div>
      <div class="product-details">
          <table class="top-table">
              <thead>
                  <tr>
                    <th style="width: 103px;"></th>
                    <th style="width: 289px;"></th>
                    <th style="width: 100px;"></th>
                    <th style="width: 74px;"></th>
                    <th style="width: 103px;;"></th>
                  </tr>
              </thead>
              @php
                  $total = 0
              @endphp
              @foreach ($details as $detail)
              <tr>
                <td style="width: 103px;"></td>
                <td style="width: 289px;"></td>
                <td style="width: 100px; text-transform: uppercase;">{{ $detail->Uom }}</td>
                <td style="width: 74px;">{{ $detail->Currency }}</td>
                <td style="width: 103px;;">{{ $detail->Currency }}</td>
            </tr>
              <tbody>
                @foreach ($detail->products as $product)
                @php
                    $total += $product->Amount;
                @endphp
                  <tr>
                      <td style="width: 103px;">{{ $product->ProductCode }}</td>
                      <td style="width: 289px; text-align:left; padding-left: 10px; box-sizing: border-box;">{{ $product->Description }}</td>
                      <td style="width: 100px;">{{ $product->Quantity !== null ? number_format($product->Quantity, 2) : '' }}</td>
                      <td style="width: 74px;">{{ $product->UnitPrice !== null ? number_format($product->UnitPrice, 2) : '' }}</td>
                      <td style="width: 103px;;">{{ $product->Amount !== null ? number_format($product->Amount, 2) : '' }}</td>
                  </tr>
                  @endforeach
                  @endforeach
                  <tr>
                    <td style="width: 103px;"></td>
                    <td style="width: 289px; text-align:left; padding-left: 10px; box-sizing: border-box;"></td>
                    <td style="width: 100px;"></td>
                    <td style="width: 74px;"></td>
                    <td style="width: 103px; padding:0;border-bottom: 1px double black; border-top:1 px solid black">{{ number_format($total,2) }}</td>
                  </tr>
                  {{-- @foreach ($detail->clientRequest as $clientreq)
                  <tr>
                    <td style="width: 103px;">{{ $clientreq->ProductCode }}</td>
                    <td style="width: 305px; text-align:left">{{ $clientreq->Description }}</td>
                    <td style="width: 100px;"></td>
                    <td style="width: 74px;"></td>
                    <td style="width: 103px;;">{{ $clientreq->Amount == 0 || is_null($clientreq->Amount) ? '' : number_format($clientreq->Amount, 2) }}</td>
                </tr>
                  @endforeach --}}
              </tbody>
              
          </table>
        </div>
          <div class="product-details-middle">
            <table class="middle-table"  style="margin-top:0; border-top:none; font-size:12px;  width: 100%;">
                <tbody >
                    <tr>
                        <td style="width: 50%;">
                            <p style="margin: 0; text-align: justify;">
                                @if (optional($details->first())->ShowPhrex == 1)
                                   {{ optional($details->first())->Phrex }}
                                @endif
                            </p>
                        </td>
                        <td style="width: 50%; vertical-align: top;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="label-column"></td>
                                        <td class="value-column"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="label-column"></td>
                                        <td class="value-column">{{ $detail->Currency }} {{ (number_format($total,2)) }}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="label-column"></td>
                                        <td class="value-column"> </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="label-column"></td>
                                        <td class="value-column"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="label-column"></td>
                                        <td class="value-column"></td>
                                    </tr>
                                    <tr>
                                      <td></td>
                                      <td></td>
                                      <td class="label-column"></td>
                                      <td class="value-column">{{ $detail->Currency }} {{ (number_format($total,2)) }}</td>
                                  </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
          </div>
        <div class="product-details-bottom">
            <table class="bottom-table"  style="margin-top:5px; border-top:none;">
                <tbody >
                  {{-- @php
                      $total = 0;
                      foreach ($details as $detail){
                          $total += $detail->LineTotal;
                      }
                  @endphp --}}
                    <tr style="">
                        <td class="label-column"></td>
                        <td class="value-column" style="font-size: 11px">@if($details->first() && $details->first()->U_T3)
                            <?php
                            // $intermediaryBankDetails = optional($details->first())->U_T2 . ' \ ' . optional($details->first())->U_T3 . ' \ ' . optional($details->first())->U_T4 . ' \ ' . optional($details->first())->U_T5 . ' \ ' . optional($details->first())->U_T6;
                            
                            // $formattedDetails = preg_replace('/^\\\+|\\\+$/', '', $intermediaryBankDetails);
                            // $lines = explode('\\', $formattedDetails);
                            // $lines = array_map('trim', $lines);
                            
                            // $lines = array_filter($lines);

                            // $intermediaryBankDetailsU_T2 = optional($details->first())->U_T2;
                            // $intermediaryBankDetailsU_T3 = optional($details->first())->U_T3;
                            // $intermediaryBankDetailsU_T4 = optional($details->first())->U_T4;
                            // $intermediaryBankDetailsU_T5 = optional($details->first())->U_T5;
                            // $intermediaryBankDetailsU_T6 = optional($details->first())->U_T6;

                            // $formattedDetailsU_T2 = preg_replace('/\\\\+/', ' ', $intermediaryBankDetailsU_T2);
                            // $formattedDetailsU_T3 = preg_replace('/^\\\+|\\\+$/', '', $intermediaryBankDetailsU_T3);
                            // $formattedDetailsU_T4 = preg_replace('/^\\\+|\\\+$/', '', $intermediaryBankDetailsU_T4);
                            // // $formattedDetailsU_T = preg_replace('/^\\\+|\\\+$/', '', $intermediaryBankDetailsU_T5);
                            // $formattedDetailsU_T5 = preg_replace('/\\\\+/', ' ', $intermediaryBankDetailsU_T5);
                            // $formattedDetailsU_T6 = preg_replace('/^\\\+|\\\+$/', '', $intermediaryBankDetailsU_T6);
                            // $lines = explode('\\', $formattedDetailsU_T6); 
                            // $lines = array_filter(array_map('trim', $lines)); 


                            ?>
                            {{-- // <span>Philippine Bio Industries Inc</span> <br>
                            // {{ $formattedDetailsU_T2 }} {{ $formattedDetailsU_T3 }} <br>
                            // {{ $formattedDetailsU_T4 }} <br>
                            // {{ $formattedDetailsU_T5 }} <br> 
                            // @foreach ($lines as $line)
                            //     {{ $line }}<br>
                            // @endforeach --}}
                        @endif
                         {!! nl2br(e(optional($details->first())->PaymentInstruction)) !!}
                        </td>
                        <td class="" style="padding-left: 13px; padding-top:35px;">
                            {{ substr(auth()->user()->name, 0, 1) }}. {{ last(explode(' ', auth()->user()->name)) }} <br> <br>
                        </td>
                        <td class=""></td>
                        <td style="padding-top:40px;">J. Galera</td>
                        <td class=""></td>
                    </tr>
                </tbody>
            </table>
        </div>
</body>
</html>
