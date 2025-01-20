
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Commercial Invoice</title>
    
    <style>
        @page{
        margin: 70px 50px 10px 0px;
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
            width: 100%;
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
                  <span class="info-value">{{ optional($details->first())->PayToCode }}
                    <br> {{ optional($details->first())->Billtoaddress }}
                  </span>
              </div>
              <div class="info-row" style="max-height: 45px; min-height:45px">
                  <span class="info-label"></span>
                  <span class="info-value"></span>
              </div>
              <div class="info-row" style="max-height: 50px; min-height:50px">
                <span class="info-label"></span>
                <span class="info-value">{{ optional($details->first())->Shiptoaddress }}</span>
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
                  <span class="info-value">{{ \Carbon\Carbon::parse(optional($details->first())->DocDueDate)->format('F j, Y') }}</span>
              </div>
              <div class="info-row" style="margin-bottom:15px">
                  <span class="info-label"></span>
                  <span class="info-value">{{ optional($details->first())->U_BuyersPO }}</span>
              </div>
              <div class="info-row">
                  <span class="info-label"></span>
                  <span class="info-value">{{ optional($details->first())->NumAtCard }}</span>
              </div>
              <div class="info-row">
                  <span class="info-label"></span>
                  <span class="info-value">{{ \Carbon\Carbon::parse(optional($details->first())->U_SOADueDate)->format('F j, Y') }}</span>
              </div>
              <div class="info-row" style="margin-bottom:10px">
                <span class="info-label"></span>
                <span class="info-value">{{ optional($details->first())->PymntGroup }}</span>
            </div>
              <div class="info-row">
                  <span class="info-label"></span>
                  <span class="info-value">{{ optional($details->first())->SoaDocEntry }}</span>
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
                    <th style="width: 305px;"></th>
                    <th style="width: 100px;"></th>
                    <th style="width: 74px;"></th>
                    <th style="width: 103px;;"></th>
                  </tr>
              </thead>
              @foreach ($details as $detail)
              <tbody>
                  <tr>
                      <td style="width: 103px;"></td>
                      <td style="width: 305px;"></td>
                      <td style="width: 100px; text-transform: uppercase;">{{ $detail->U_printUOM }}</td>
                      <td style="width: 74px;">{{ $detail->DocCur }}</td>
                      <td style="width: 103px;;">{{ $detail->DocCur }}</td>
                  </tr>
                  <tr>
                      <td style="width: 103px;"></td>
                      <td style="width: 305px; text-align:left">{{ $detail->U_label_as }}</td>
                      <td style="width: 100px;">
                        @if ($detail->U_printUOM == 'lbs')
                        {{ number_format($detail->Quantity * 2.2, 2) }}
                        @else
                        {{ number_format($detail->Quantity, 2) }}</td>
                        @endif
                      </td>
                      <td style="width: 74px;">
                        @if ($detail->U_printUOM == 'lbs')
                        {{ number_format($detail->Price/2.2, 2) }}</td>
                        @else
                        {{ number_format($detail->Price, 2) }}</td>
                        @endif
                      <td style="width: 103px;;">{{ number_format(($detail->Quantity) * ($detail->Price), 2) }}</td>
                  </tr>
              </tbody>
              @endforeach
          </table>
        </div>
          <div class="product-details-middle">
            <table class="middle-table"  style="margin-top:0; border-top:none; font-size:12px">
                <tbody >
                  @php
                      $total = 0;
                      foreach ($details as $detail){
                          $total += ($detail->Quantity) * ($detail->Price);
                      }
                  @endphp
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
                        <td class="value-column"> {{ $detail->DocCur }} {{ (number_format($total,2)) }}</td>
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
                      <td class="value-column">{{ $detail->DocCur }} {{ (number_format($total,2)) }}</td>
                  </tr>
                </tbody>
            </table>
          </div>
        <div class="product-details-bottom">
            <table class="bottom-table"  style="margin-top:5px; border-top:none;">
                <tbody >
                  @php
                      $total = 0;
                      foreach ($details as $detail){
                          $total += $detail->TotalFrgn;
                      }
                  @endphp
                    <tr style="">
                        <td class="label-column"></td>
                        <td class="value-column" style="font-size: 11px">@if($details->first() && $details->first()->U_T3)
                            <?php
                            $intermediaryBankDetails = optional($details->first())->U_T2 . ' \ ' . optional($details->first())->U_T3 . ' \ ' . optional($details->first())->U_T4 . ' \ ' . optional($details->first())->U_T5 . ' \ ' . optional($details->first())->U_T6;
                            
                            $formattedDetails = preg_replace('/^\\\+|\\\+$/', '', $intermediaryBankDetails);
                            $lines = explode('\\', $formattedDetails);
                            $lines = array_map('trim', $lines);
                            
                            $lines = array_filter($lines);

                            $intermediaryBankDetailsU_T2 = optional($details->first())->U_T2;
                            $intermediaryBankDetailsU_T3 = optional($details->first())->U_T3;
                            $intermediaryBankDetailsU_T4 = optional($details->first())->U_T4;
                            $intermediaryBankDetailsU_T5 = optional($details->first())->U_T5;
                            $intermediaryBankDetailsU_T6 = optional($details->first())->U_T6;

                            $formattedDetailsU_T2 = preg_replace('/\\\\+/', ' ', $intermediaryBankDetailsU_T2);
                            $formattedDetailsU_T3 = preg_replace('/^\\\+|\\\+$/', '', $intermediaryBankDetailsU_T3);
                            $formattedDetailsU_T4 = preg_replace('/^\\\+|\\\+$/', '', $intermediaryBankDetailsU_T4);
                            // $formattedDetailsU_T = preg_replace('/^\\\+|\\\+$/', '', $intermediaryBankDetailsU_T5);
                            $formattedDetailsU_T5 = preg_replace('/\\\\+/', ' ', $intermediaryBankDetailsU_T5);
                            $formattedDetailsU_T6 = preg_replace('/^\\\+|\\\+$/', '', $intermediaryBankDetailsU_T6);
                            $lines = explode('\\', $formattedDetailsU_T6); 
                            $lines = array_filter(array_map('trim', $lines)); 


                            ?>
                            <span>Philippine Bio Industries Inc</span> <br>
                            {{ $formattedDetailsU_T2 }} {{ $formattedDetailsU_T3 }} <br>
                            {{ $formattedDetailsU_T4 }} <br>
                            {{ $formattedDetailsU_T5 }} <br> 
                            @foreach ($lines as $line)
                                {{ $line }}<br>
                            @endforeach
                      @endif</td>
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
