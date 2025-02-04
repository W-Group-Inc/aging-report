@extends('layouts.header')
@section('css')
<link href="{{ asset('/inside/login_css/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
<link href="{{ asset('/inside/login_css/css/style.css') }}" rel="stylesheet">
@endsection
@section('content')
<style>
    .table-modal-responsive {
    position: relative;
    height: 400px; 
    overflow: auto;
    display: inline-block;
    width: 100%;
    }

    .table-modal-responsive .invoiceTable thead th {
    position: sticky;
    top: 0;
    background-color: #fff; 
    z-index: 2;
    }

</style>
<div class="wrapper wrapper-content ">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox ">
                                <div class="ibox-content">
                                    <form method='GET' onsubmit='show();' enctype="multipart/form-data" >
                                        <div class="row align-items-end" style="display: flex;justify-content: center;align-items: center;">
                                            <div class="col-lg-3">
                                                <label for="company" style="display: block;">Company:</label>
                                                <select name='company' class='form-control' required>
                                                    <option value=''>Company</option>
                                                    <option value='WHI' @if($company == "WHI") selected @endif>WHI</option>
                                                    <option value='PBI' @if($company == "PBI") selected @endif>PBI</option>
                                                    <option value='CCC' @if($company == "CCC") selected @endif>CCC</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="from" style="display: block;">From:</label>
                                                        <input type="date" id="from" name="from" value="{{ Request::get('from') }}" class="form-control" required>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="to" style="display: block;">To:</label>
                                                        <input type="date" id="to" name="to" value="{{ Request::get('to') }}" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <button class="btn btn-primary mt-4" type="submit" id='submit' style="margin-top: 14px;">Generate</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>GP Report</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table id='gptable' class="table table-striped table-bordered table-hover fullSummaryTable" style="margin-bottom: 0px !important;">
                                    <thead>
                                        <tr>
                                            <th>Date of Invoice</th>
                                            <th>Accounts</th>
                                            <th>Incoterm</th>
                                            <th>Mode of Shipment</th>
                                            <th>Export Invoice No.</th>
                                            <th>Buyer's Code</th>
                                            <th>Client</th>
                                            <th>PRODUCT EXPORTED</th>
                                            <th>VOLUME</th>
                                            <th>UNIT PRICE</th>
                                            <th>Dollar Value</th>
                                            <th>Euro Value </th>
                                            <th>Php Value</th>
                                            <th>COS - RM</th>
                                            @if($company == "WHI")
                                            <th>620300 - Freight and Handling</th>
                                            <th>620400 - Delivery and Trucking</th>
                                            <th>621400 - Insurance & Bonds</th>
                                            <th>620500 - Brokerage Charges</th>
                                            <th>620700 - Export Processing Fees</th>
                                            <th>620200 - Commission Expenses</th>
                                            <th>Total Expenses</th>
                                            @elseif($company == "PBI")
                                            <th>710400 - Freight & Handling</th>
                                            <th>710500 - Export Processing Fees</th>
                                            <th>710700 - Delivery & Trucking</th>
                                            <th>711000 - Brokerage</th>
                                            <th>710800 - Insurance & Bonds</th>
                                            <th>710600 - Commission Expenses</th>
                                            <th>Total Expenses</th>
                                            @elseif($company == "CCC")
                                            <th>610127-GEN - Delivery Expenses (GEN)</th>
                                            <th>610128-GEN - Insurance Expense (GEN)</th>
                                            <th>610131-GEN - Freight & Handling - Export (GEN)</th>
                                            <th>630000 - Processing Fees (GEN)</th>
                                            <th>610145-GEN - Delivery and Trucking - Export (GEN)</th>
                                            <th>620000 - Commission</th>
                                            <th>Total Expenses</th>
                                            @endif
                                            <th>Gross Profit - RM </th>
                                            <th>GP%</th>
                                            <th>Product Classification</th>
                                            <th>Account Manager</th>
                                        </tr>
                                        <tr>
                                            <th><input type="text" placeholder="Search Date of Invoice" class="column_filter" data-column="0"></th>
                                            <th><input type="text" placeholder="Search Accounts" class="column_filter" data-column="1"></th>
                                            <th><input type="text" placeholder="Search Incoterm" class="column_filter" data-column="2"></th>
                                            <th><input type="text" placeholder="Search Mode of Shipment" class="column_filter" data-column="3"></th>
                                            <th><input type="text" placeholder="Search Export Invoice No." class="column_filter" data-column="4"></th>
                                            <th><input type="text" placeholder="Search Buyer's Code" class="column_filter" data-column="5"></th>
                                            <th><input type="text" placeholder="Search Client" class="column_filter" data-column="6"></th>
                                            <th><input type="text" placeholder="Search Product Exported" class="column_filter" data-column="7"></th>
                                            <th><input type="text" placeholder="Search Volume" class="column_filter" data-column="8"></th>
                                            <th><input type="text" placeholder="Search Unit Price" class="column_filter" data-column="9"></th>
                                            <th><input type="text" placeholder="Search Dollar Value" class="column_filter" data-column="10"></th>
                                            <th><input type="text" placeholder="Search Euro Value" class="column_filter" data-column="11"></th>
                                            <th><input type="text" placeholder="Search Php Value" class="column_filter" data-column="12"></th>
                                            <th><input type="text" placeholder="Search COS - RM" class="column_filter" data-column="13"></th>
                                            @if($company == "WHI")
                                            <th><input type="text" placeholder="Search Freight and Handling" class="column_filter" data-column="14"></th>
                                            <th><input type="text" placeholder="Search Delivery and Trucking" class="column_filter" data-column="15"></th>
                                            <th><input type="text" placeholder="Search Insurance & Bonds" class="column_filter" data-column="16"></th>
                                            <th><input type="text" placeholder="Search Brokerage Charges" class="column_filter" data-column="17"></th>
                                            <th><input type="text" placeholder="Search Export Processing Fees" class="column_filter" data-column="18"></th>
                                            <th><input type="text" placeholder="Search Commission Expenses" class="column_filter" data-column="19"></th>
                                            <th><input type="text" placeholder="Search Total Expenses" class="column_filter" data-column="24"></th>
                                            @elseif($company == "PBI")
                                            <th><input type="text" placeholder="Search Freight & Handling" class="column_filter" data-column="14"></th>
                                            <th><input type="text" placeholder="Search Export Processing Fees" class="column_filter" data-column="15"></th>
                                            <th><input type="text" placeholder="Search Delivery & Trucking" class="column_filter" data-column="16"></th>
                                            <th><input type="text" placeholder="Search Brokerage" class="column_filter" data-column="17"></th>
                                            <th><input type="text" placeholder="Search Insurance & Bonds" class="column_filter" data-column="18"></th>
                                            <th><input type="text" placeholder="Search Commission Expenses" class="column_filter" data-column="19"></th>
                                            <th><input type="text" placeholder="Search Total Expenses" class="column_filter" data-column="24"></th>
                                            @elseif($company == "CCC")
                                            <th><input type="text" placeholder="Search Delivery Expenses" class="column_filter" data-column="14"></th>
                                            <th><input type="text" placeholder="Search Insurance Expense" class="column_filter" data-column="15"></th>
                                            <th><input type="text" placeholder="Search Freight & Handling" class="column_filter" data-column="16"></th>
                                            <th><input type="text" placeholder="Search Processing Fees" class="column_filter" data-column="17"></th>
                                            <th><input type="text" placeholder="Search Delivery and Trucking" class="column_filter" data-column="18"></th>
                                            <th><input type="text" placeholder="Search Commission" class="column_filter" data-column="19"></th>
                                            <th><input type="text" placeholder="Search Total Expenses" class="column_filter" data-column="24"></th>
                                            @endif
                                            <th><input type="text" placeholder="Search Gross Profit - RM" class="column_filter" data-column="20"></th>
                                            <th><input type="text" placeholder="Search GP%" class="column_filter" data-column="21"></th>
                                            <th><input type="text" placeholder="Search Product Classification" class="column_filter" data-column="22"></th>
                                            <th><input type="text" placeholder="Search Account Manager" class="column_filter" data-column="23"></th>
                                        </tr>                        
                                    </thead>
                                    <tbody>
                                        @foreach($invoices as $invoice)
                                        @if(str_contains($invoice->PRODUCT_EXPORTED,"Delivery"))
                                        @else
                                        @php
                                            $dollar = 0;
                                            $euro = 0;
                                            if ($company == "WHI") {
                                                if (($invoice->CurrencyType == "_SYS00000000168") || ($invoice->CurrencyType == "_SYS00000001680")) {
                                                    $dollar = $invoice->Dollar_Value;
                                                } else {
                                                    $euro = $invoice->Dollar_Value;
                                                }
                                                // elseif ($invoice->CurrencyType == "_SYS00000000171") {
                                                //     $euro = $invoice->Dollar_Value;
                                                // }
                                            } elseif ($company == "CCC") {
                                                if ($invoice->CurrencyType == "_SYS00000000674") {
                                                    $dollar = $invoice->Dollar_Value;
                                                }  else {
                                                    $euro = $invoice->Dollar_Value;
                                                }
                                                // elseif ($invoice->CurrencyType == "_SYS00000000401") {
                                                //     $euro = $invoice->Dollar_Value;
                                                // }
                                            } elseif ($company == "PBI") {
                                                if ($invoice->CurrencyType == "_SYS00000000372") {
                                                    $dollar = $invoice->Dollar_Value;
                                                } else {
                                                    $euro = $invoice->Dollar_Value;
                                                }
                                                // elseif ($invoice->CurrencyType == "_SYS00000000548") {
                                                //     $euro = $invoice->Dollar_Value;
                                                // }
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{date('Y-m-d',strtotime($invoice->Date_of_Invoice))}}</td>
                                            <td>{{$invoice->WhsCode}}</td>
                                            <td>{{ $invoice->U_Inco }}</td>
                                            <td>{{ $invoice->U_ModeShip }}</td>
                                            <td>
                                                {{-- {{$invoice->DocNum}}  --}}
                                                {{$invoice->U_InvoiceNo}}</td>
                                            <td>{{$invoice->NumAtCard}} </td>
                                            <td>{{$invoice->Client}}</td>
                                            <td>{{$invoice->PRODUCT_EXPORTED}}</td>
                                            <td>{{number_format($invoice->VOLUME,2)}}</td>
                                            <td>{{number_format($invoice->UNIT_PRICE,2)}}</td>
                                            <td>{{number_format($dollar,2)}}</td>
                                            <td>{{number_format($euro,2)}}</td>
                                            <td>{{number_format($invoice->Php_Value,2)}}</td>
                                            <td>{{number_format($invoice->COS_RM,2)}}</td>
                                            @php
                                                $frieght = 0;
                                                $delivery = 0;
                                                $insurance = 0;
                                                $export = 0;
                                                $commission = 0;
                                                $brokerage = 0;
                                                $totalExpense = 0;
                                                $gp=0;
                                            @endphp
                                            @if($company == "WHI")
                                            @if(count($invoice->ap_whi) >0)
                                                @endif
                                            <td>
                                                
                                                @if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620300'])->sum('LineTotal') > 0)
                                            @php
                                                $frieght = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620300'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                            @endphp
                                            @endif
                                            {{number_format($frieght,2)}}
                                            </td> {{--620300--}}
                                            <td>
                                                @if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620400'])->sum('LineTotal') > 0)
                                            @php
                                                $delivery = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620400'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                            @endphp
                                            @endif
                                            {{number_format($delivery,2)}}
                                            </td> {{--620400 --}}
                                            <td>
                                                @if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['621400'])->sum('LineTotal') > 0)
                                            @php
                                                $insurance = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['621400'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                            @endphp
                                            @endif
                                            {{number_format($insurance,2)}}
                                            </td> {{--621400--}}
                                            <td>
                                                @if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620500'])->sum('LineTotal') > 0)
                                            @php
                                                $brokerage = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620500'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                            @endphp
                                            @endif
                                            {{number_format($brokerage,2)}}
                                            </td> {{--620500--}}
                                            <td>
                                                @if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620700'])->sum('LineTotal') > 0)
                                            @php
                                                $export = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620700'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                            @endphp
                                            @endif
                                            {{number_format($export,2)}}
                                            </td> {{--620700--}}
                                            <td>
                                                {{-- @foreach(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620200']) as $inv)
                                                {{$inv->LineTotal}} <br>
                                             @endforeach --}}
                                             @php
                                                 $commission =  (($invoice->ap_has_commision)->sum('TotalFrgn') * ($invoice->ap_has_commision)->sum('Rate'));
                                                 $gross_profit = $invoice->Php_Value-$frieght-$commission-$invoice->COS_RM-$delivery-$insurance-$export-$brokerage;
                                                 $totalExpense = $frieght+$commission+$invoice->COS_RM+$delivery+$insurance+$export+$brokerage;
                                                 if(str_contains($invoice->WhsCode,"TRI"))                                                 
                                                    {
                                                        $freight = 0;
                                                        $delivery = 0;
                                                        $insurance = 0;
                                                        $export = 0;
                                                        $commission = 0;

                                                    }
                                                 if($gross_profit != 0)
                                                 {
                                                    $gp = $gross_profit/$invoice->Php_Value;
                                                 }
                                               
                                             @endphp
                                             {{ $commission }}

                                             {{-- {{ number_format(optional($invoice->ap_has_commision)->OpenSumFC, 2) }} --}}
                                            </td>
                                            <td>
                                                {{number_format($totalExpense,2)}}
                                            </td>
                                            <td>

                                                {{number_format($gross_profit ,2)}}
                                            </td>
                                            <td>{{number_format($gp*100,2)}} %</td>
                                            @elseif($company == "PBI")
                                            <td>
                                                @if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710400'])->sum('LineTotal') > 0)
                                            @php
                                                $frieght = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710400'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                            @endphp
                                            @endif
                                            {{number_format($frieght,2)}}
                                            </td> {{--710400--}}
                                            <td>
                                                @if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710500'])->sum('LineTotal') > 0)
                                            @php
                                                $delivery = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710500'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                            @endphp
                                            @endif
                                            {{number_format($delivery,2)}}
                                            </td> {{--710500 --}}
                                            <td>
                                                @if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710700'])->sum('LineTotal') > 0)
                                            @php
                                                $insurance = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710700'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                            @endphp
                                            @endif
                                            {{number_format($insurance,2)}}
                                            </td> {{--710700--}}
                                            <td>
                                                @if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['711000'])->sum('LineTotal') > 0)
                                            @php
                                                $brokerage = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['711000'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                            @endphp
                                            @endif
                                            {{number_format($brokerage,2)}}
                                            </td> {{--711000--}}
                                            <td>
                                                @if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710800'])->sum('LineTotal') > 0)
                                            @php
                                                $export = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710800'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                            @endphp
                                            @endif
                                            {{number_format($export,2)}}
                                            </td> {{--710800--}}
                                            <td>
                                                {{-- @foreach(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620200']) as $inv)
                                                {{$inv->LineTotal}} <br>
                                             @endforeach --}}
                                             @php
                                                 $commission = (($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710600'])->sum('LineTotal') * ($invoice->ap_has_commision)->sum('Rate'));
                                                 $gross_profit = $invoice->Php_Value-$frieght-$commission-$invoice->COS_RM-$delivery-$insurance-$export-$brokerage;
                                                 $totalExpense = $frieght+$commission+$invoice->COS_RM+$delivery+$insurance+$export+$brokerage;
                                                 if(str_contains($invoice->WhsCode,"TRI"))                                                 
                                                    {
                                                        $freight = 0;
                                                        $delivery = 0;
                                                        $insurance = 0;
                                                        $export = 0;
                                                        $commission = 0;

                                                    }
                                                 if($gross_profit != 0)
                                                 {
                                                    $gp = $gross_profit/$invoice->Php_Value;
                                                 }
                                               
                                             @endphp
                                                {{ $commission }}

                                             {{-- {{number_format(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710600'])->sum('LineTotal'),2)}} --}}
                                            </td>
                                            <td>
                                                {{number_format($totalExpense,2)}}
                                            </td>
                                            <td>

                                                {{number_format($gross_profit ,2)}}
                                            </td>
                                            <td>{{number_format($gp*100,2)}} %</td>
                                            @elseif($company == "CCC")
                                            <td>
                                                @if(($invoice->ap_whi)->whereIn('chart_of_account.Segment_0',['610127'])->sum('LineTotal') > 0)
                                            @php
                                                $frieght = ((($invoice->ap_whi)->whereIn('chart_of_account.Segment_0',['610127'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                            @endphp
                                            @endif
                                            {{number_format($frieght,2)}}
                                            </td> {{--610127--}}
                                            <td>
                                                @if(($invoice->ap_whi)->whereIn('chart_of_account.Segment_0',['610128'])->sum('LineTotal') > 0)
                                            @php
                                                $delivery = ((($invoice->ap_whi)->whereIn('chart_of_account.Segment_0',['610128'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                            @endphp
                                            @endif
                                            {{number_format($delivery,2)}}
                                            </td> {{--610128 --}}
                                            <td>
                                                @if(($invoice->ap_whi)->whereIn('chart_of_account.Segment_0',['610131'])->sum('LineTotal') > 0)
                                            @php
                                                $insurance = ((($invoice->ap_whi)->whereIn('chart_of_account.Segment_0',['610131'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                            @endphp
                                            @endif
                                            {{number_format($insurance,2)}}
                                            </td> {{--610131--}}
                                            <td>
                                                @if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['630000'])->sum('LineTotal') > 0)
                                            @php
                                                $brokerage = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['630000'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                            @endphp
                                            @endif
                                            {{number_format($brokerage,2)}}
                                            </td> {{--630000--}}
                                            <td>
                                                @if(($invoice->ap_whi)->whereIn('chart_of_account.Segment_0',['610145'])->sum('LineTotal') > 0)
                                            @php
                                                $export = ((($invoice->ap_whi)->whereIn('chart_of_account.Segment_0',['610145'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                            @endphp
                                            @endif
                                            {{number_format($export,2)}}
                                            </td> {{--610145--}}
                                            <td>
                                                {{-- @foreach(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620200']) as $inv)
                                                {{$inv->LineTotal}} <br>
                                             @endforeach --}}
                                             @php
                                                 $commission = (($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620000'])->sum('LineTotal') * ($invoice->ap_has_commision)->sum('Rate')) ;
                                                 $gross_profit = $invoice->Php_Value-$frieght-$commission-$invoice->COS_RM-$delivery-$insurance-$export-$brokerage;
                                                 $totalExpense = $frieght+$commission+$invoice->COS_RM+$delivery+$insurance+$export+$brokerage;
                                                 if(str_contains($invoice->WhsCode,"TRI"))                                                 
                                                    {
                                                        $freight = 0;
                                                        $delivery = 0;
                                                        $insurance = 0;
                                                        $export = 0;
                                                        $commission = 0;

                                                    }
                                                 if($gross_profit != 0)
                                                 {
                                                    $gp = $gross_profit/$invoice->Php_Value;
                                                 }
                                               
                                             @endphp
                                                {{ $commission }}
                                             {{-- {{number_format(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620000'])->sum('LineTotal'),2)}} --}}
                                            </td>
                                            <td>
                                                {{number_format($totalExpense,2)}}
                                            </td>
                                            <td>

                                                {{number_format($gross_profit ,2)}}
                                            </td>
                                            <td>{{number_format($gp*100,2)}} %</td>
                                            @endif
                                            <td>{{ $invoice->Product_Classification }}</td>
                                            <td>{{ $invoice->SlpName }}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        @php
                                            $total_volume = 0;
                                            $ave_unit_price = 0;
                                            $total_dollar = 0;
                                            $total_euro = 0;
                                            $total_php = 0;
                                            $total_cos_rm = 0;
                                            $total_freight = 0;
                                            $total_delivery = 0;
                                            $total_insurance = 0;
                                            $total_export = 0;
                                            $total_commission = 0;
                                            $total_brokerage = 0;
                                            $total_expenses = 0;
                                            $ave_gp=0;
                                            $total_gross_profit=0;
                                        @endphp
                                        
                                        @foreach($invoices as $invoice)
                                            @if(!str_contains($invoice->PRODUCT_EXPORTED, "Delivery"))
                                                @php
                                                $freight_per_invoice = 0;
                                                $delivery_per_invoice = 0;
                                                $insurance_per_invoice = 0;
                                                $export_per_invoice = 0; 
                                                $brokerage_per_invoice = 0;
                                                $commission_per_invoice = 0;
                                                $expenses_per_invoice=0;
                                                    if ($company == "WHI") {
                                                        if (($invoice->CurrencyType == "_SYS00000000168") || ($invoice->CurrencyType == "_SYS00000001680")) {
                                                            $total_dollar += $invoice->Dollar_Value;
                                                        } else {
                                                            $total_euro += $invoice->Dollar_Value;
                                                        }
                                                        // elseif ($invoice->CurrencyType == "_SYS00000000171") {
                                                        //     $total_euro += $invoice->Dollar_Value;
                                                        // }
                                                    } elseif ($company == "CCC") {
                                                        if ($invoice->CurrencyType == "_SYS00000000674") {
                                                            $total_dollar += $invoice->Dollar_Value;
                                                        }  else {
                                                            $total_euro += $invoice->Dollar_Value;
                                                        }
                                                        //  elseif ($invoice->CurrencyType == "_SYS00000000401") {
                                                        //     $total_euro += $invoice->Dollar_Value;
                                                        // }
                                                    } elseif ($company == "PBI") {
                                                        if ($invoice->CurrencyType == "_SYS00000000372") {
                                                            $total_dollar += $invoice->Dollar_Value;
                                                        } else {
                                                            $total_euro += $invoice->Dollar_Value;
                                                        }
                                                        // elseif ($invoice->CurrencyType == "_SYS00000000548") {
                                                        //     $total_euro += $invoice->Dollar_Value;
                                                        // }
                                                    }

                                                    if($company == "WHI") {
                                                        if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620300'])->sum('LineTotal') > 0) {
                                                            $freight_per_invoice = ($invoice->ap_whi->whereIn('chart_of_account.FatherNum', ['620300'])->sum('LineTotal') / $invoices->where('U_InvoiceNo', $invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME;
                                                            $formatted_freight = number_format($freight_per_invoice, 2, '.', '');
                                                            $total_freight += (float) $formatted_freight;

                                                        }
                                                        if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620400'])->sum('LineTotal') > 0) {
                                                            $delivery_per_invoice = ($invoice->ap_whi->whereIn('chart_of_account.FatherNum', ['620400'])->sum('LineTotal') / $invoices->where('U_InvoiceNo', $invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME;
                                                            $formatted_delivery = number_format($delivery_per_invoice, 2, '.', '');
                                                            $total_delivery += (float) $formatted_delivery;
                                                        }
                                                        if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['621400'])->sum('LineTotal') > 0) {
                                                            $insurance_per_invoice = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['621400'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                                            $formatted_insurance = number_format($insurance_per_invoice, 2, '.', '');
                                                            $total_insurance += (float) $formatted_insurance;
                                                        }
                                                        if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620500'])->sum('LineTotal') > 0) {
                                                            $brokerage_per_invoice = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620500'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                                            $formatted_brokerage = number_format($brokerage_per_invoice, 2, '.', '');
                                                            $total_brokerage += (float) $formatted_brokerage;
                                                        }
                                                        if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620700'])->sum('LineTotal') > 0) {
                                                            $export_per_invoice = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620700'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                                            $formatted_export = number_format($export_per_invoice, 2, '.', '');
                                                            $total_export += (float) $formatted_export;
                                                        }
                                                        
                                                        $commission_per_invoice = (($invoice->ap_has_commision)->sum('TotalFrgn') * ($invoice->ap_has_commision)->sum('Rate'));
                                                        $total_commission += $commission_per_invoice;

                                                        $expenses_per_invoice = $freight_per_invoice+$commission_per_invoice+$invoice->COS_RM+$delivery_per_invoice+$insurance_per_invoice+$export_per_invoice+$brokerage_per_invoice;
                                                        $formatted_expenses_per_invoice = number_format($expenses_per_invoice, 2, '.', '');
                                                        $gross_profit = $invoice->Php_Value-$freight_per_invoice-$commission_per_invoice-$invoice->COS_RM-$delivery_per_invoice-$insurance_per_invoice-$export_per_invoice-$brokerage_per_invoice;
                                                        $formatted_gross_profit = number_format($gross_profit, 2, '.', '');
                                                        
                                                        if(str_contains($invoice->WhsCode,"TRI"))                                                 
                                                            {
                                                                $freight_per_invoice = 0;
                                                                $delivery_per_invoice = 0;
                                                                $insurance_per_invoice = 0;
                                                                $export_per_invoice = 0;
                                                                $commission_per_invoice = 0;

                                                            }
                                                            if($gross_profit != 0)
                                                            {
                                                                $total_gross_profit += (float) $formatted_gross_profit;

                                                            }
                                                            $total_expenses += (float ) $formatted_expenses_per_invoice;
                                                    } elseif($company == "PBI") {
                                                        if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710400'])->sum('LineTotal') > 0) {
                                                            $freight_per_invoice = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710400'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                                            $formatted_freight = number_format($freight_per_invoice, 2, '.', '');
                                                            $total_freight += (float) $formatted_freight;
                                                        }
                                                        if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710500'])->sum('LineTotal') > 0) {
                                                            $delivery_per_invoice = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710500'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                                            $formatted_delivery = number_format($delivery_per_invoice, 2, '.', '');
                                                            $total_delivery += (float) $formatted_delivery;
                                                        }
                                                        if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710700'])->sum('LineTotal') > 0) {
                                                            $insurance_per_invoice = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710700'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                                            $formatted_insurance = number_format($insurance_per_invoice, 2, '.', '');
                                                            $total_insurance += (float) $formatted_insurance;
                                                        }
                                                        if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['711000'])->sum('LineTotal') > 0) {
                                                            $brokerage_per_invoice = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['711000'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                                            $formatted_brokerage = number_format($brokerage_per_invoice, 2, '.', '');
                                                            $total_brokerage += (float) $formatted_brokerage;
                                                        }
                                                        if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710800'])->sum('LineTotal') > 0) {
                                                            $export_per_invoice = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710800'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                                            $formatted_export = number_format($export_per_invoice, 2, '.', '');
                                                            $total_export += (float) $formatted_export;
                                                        }
                                                        
                                                        $commission_per_invoice = ($invoice->ap_has_commision)->sum('TotalFrgn') * ($invoice->ap_has_commision)->sum('Rate');
                                                        $total_commission += $commission_per_invoice;

                                                        $expenses_per_invoice = $freight_per_invoice+$commission_per_invoice+$invoice->COS_RM+$delivery_per_invoice+$insurance_per_invoice+$export_per_invoice+$brokerage_per_invoice;
                                                        $formatted_expenses_per_invoice = number_format($expenses_per_invoice, 2, '.', '');
                                                        $gross_profit = $invoice->Php_Value-$freight_per_invoice-$commission_per_invoice-$invoice->COS_RM-$delivery_per_invoice-$insurance_per_invoice-$export_per_invoice-$brokerage_per_invoice;
                                                        $formatted_gross_profit = number_format($gross_profit, 2, '.', '');
                                                        if(str_contains($invoice->WhsCode,"TRI"))                                                 
                                                            {
                                                                $freight_per_invoice = 0;
                                                                $delivery_per_invoice = 0;
                                                                $insurance_per_invoice = 0;
                                                                $export_per_invoice = 0;
                                                                $commission_per_invoice = 0;

                                                            }
                                                            if($gross_profit != 0)
                                                            {
                                                                $total_gross_profit += (float) $formatted_gross_profit;

                                                            }
                                                            $total_expenses += (float ) $formatted_expenses_per_invoice;
                                                    } elseif($company == "CCC") {
                                                        if(($invoice->ap_whi)->whereIn('chart_of_account.Segment_0',['610127'])->sum('LineTotal') > 0) {
                                                            $freight_per_invoice = ((($invoice->ap_whi)->whereIn('chart_of_account.Segment_0',['610127'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                                            $formatted_freight = number_format($freight_per_invoice, 2, '.', '');
                                                            $total_freight += (float) $formatted_freight;
                                                        }
                                                        if(($invoice->ap_whi)->whereIn('chart_of_account.Segment_0',['610128'])->sum('LineTotal') > 0) {
                                                            $delivery_per_invoice = ((($invoice->ap_whi)->whereIn('chart_of_account.Segment_0',['610128'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                                            $formatted_delivery = number_format($delivery_per_invoice, 2, '.', '');
                                                            $total_delivery += (float) $formatted_delivery;
                                                        }
                                                        if(($invoice->ap_whi)->whereIn('chart_of_account.Segment_0',['610131'])->sum('LineTotal') > 0) {
                                                            $insurance_per_invoice = ((($invoice->ap_whi)->whereIn('chart_of_account.Segment_0',['610131'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                                            $formatted_insurance = number_format($insurance_per_invoice, 2, '.', '');
                                                            $total_insurance += (float) $formatted_insurance;
                                                        }
                                                        if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['630000'])->sum('LineTotal') > 0) {
                                                            $brokerage_per_invoice = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['630000'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                                            $formatted_brokerage = number_format($brokerage_per_invoice, 2, '.', '');
                                                            $total_brokerage += (float) $formatted_brokerage;
                                                        }
                                                        if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['610145'])->sum('LineTotal') > 0) {
                                                            $export_per_invoice = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['610145'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                                            $formatted_export = number_format($export_per_invoice, 2, '.', '');
                                                            $total_export += (float) $formatted_export;
                                                        }
                                                        
                                                        $commission_per_invoice = (($invoice->ap_has_commision)->sum('TotalFrgn') * ($invoice->ap_has_commision)->sum('Rate'));
                                                        $total_commission += $commission_per_invoice;

                                                        $expenses_per_invoice = $freight_per_invoice+$commission_per_invoice+$invoice->COS_RM+$delivery_per_invoice+$insurance_per_invoice+$export_per_invoice+$brokerage_per_invoice;
                                                        $formatted_expenses_per_invoice = number_format($expenses_per_invoice, 2, '.', '');
                                                        $gross_profit = $invoice->Php_Value-$freight_per_invoice-$commission_per_invoice-$invoice->COS_RM-$delivery_per_invoice-$insurance_per_invoice-$export_per_invoice-$brokerage_per_invoice;
                                                        $formatted_gross_profit = number_format($gross_profit, 2, '.', '');
                                                        if(str_contains($invoice->WhsCode,"TRI"))                                                 
                                                            {
                                                                $freight_per_invoice = 0;
                                                                $delivery_per_invoice = 0;
                                                                $insurance_per_invoice = 0;
                                                                $export_per_invoice = 0;
                                                                $commission_per_invoice = 0;

                                                            }
                                                            if($gross_profit != 0)
                                                            {
                                                                $total_gross_profit += (float) $formatted_gross_profit;

                                                            }
                                                            $total_expenses += (float ) $formatted_expenses_per_invoice;
                                                    }

                                        
                                                    $formatted_volume = number_format($invoice->VOLUME, 2, '.', '');
                                                    $total_volume += (float) $formatted_volume;
                                                    $total_php += $invoice->Php_Value;
                                                    $total_cos_rm += $invoice->COS_RM;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @php
                                            if ($total_php != 0) {
                                                $ave_gp = ($total_gross_profit / $total_php) * 100;
                                            }

                                            $total_foreign_value = $total_dollar + $total_euro;
                                            if ($total_volume != 0) {
                                                $ave_unit_price = $total_foreign_value / $total_volume;
                                            }
                                        @endphp
                                        <tr style="padding:15px">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td><td></td><td></td><td></td>
                                            <td id="subtotal"></td>
                                            <td id="totalVolume"></td>
                                            <td id="averageUnitPrice"></td>
                                            <td id="totalDollar"></td>
                                            <td id="totalEuro"></td>
                                            <td id="totalPhp"></td>
                                            <td id="totalCosRm"></td>
                                            <td id="totalFreight"></td>
                                            <td id="totalDelivery"></td>
                                            <td id="totalInsurance"></td>
                                            <td id="totalBrokerage"></td>
                                            <td id="totalExport"></td>
                                            <td id="totalCommission"></td>
                                            <td id="totalExpenses"></td>
                                            <td id="totalGrossProfit"></td>
                                            <td id="aveGp"></td>
                                            <td></td><td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td><td></td><td></td><td></td><td></td>
                                            <td>{{ number_format($total_volume, 2) }}</td>
                                            <td>{{ number_format($ave_unit_price, 2) }}</td>
                                            <td>{{ number_format($total_dollar, 2) }}</td>
                                            <td>{{ number_format($total_euro, 2) }}</td>
                                            <td>{{ number_format($total_php, 2) }}</td>
                                            <td>{{ number_format($total_cos_rm, 2) }}</td>
                                            {{-- @if ($company=='WHI') --}}
                                            <td>{{ number_format($total_freight, 2) }}</td>
                                            <td>{{ number_format($total_delivery, 2) }}</td>
                                            <td>{{ number_format($total_insurance, 2) }}</td>
                                            <td>{{ number_format($total_brokerage, 2) }}</td>
                                            <td>{{ number_format($total_export, 2) }}</td>
                                            <td>{{ number_format($total_commission, 2) }}</td>
                                            <td>{{ number_format($total_expenses, 2) }}</td>
                                            <td>{{ number_format($total_gross_profit, 2) }}</td>
                                            <td>{{number_format(($ave_gp),2)}} %</td>
                                            {{-- @endif --}}
                                            <td></td><td></td>
                                        </tr>
                                    </tfoot>
                                    
                                    
                                                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
@endsection
@section('footer')
<script src="{{ asset('/inside/login_css/js/plugins/dataTables/datatables.min.js')}}"></script>
<script src="{{ asset('/inside/login_css/js/plugins/chosen/chosen.jquery.js') }}"></script>
<script>
    $(document).ready(function() {
    var table = $('#gptable').DataTable({
        pageLength: -1,
        fixedHeader: true,
        scrollX: true,
        scrollY: 700,
        scrollCollapse: true,
        paging: false,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'csv', title: 'Aging Report'},
            {extend: 'excel', title: 'Aging Report'}
        ]
    });

    $(".column_filter").on('keyup change', function() {
        var column = $(this).data('column');
        table.column(column).search(this.value).draw();
        updateFooter();  
    });

    function updateFooter() {
        var totalVolume = 0, aveUnitPrice = 0, totalDollar = 0, totalEuro = 0, totalPhp = 0,
            totalCosRm = 0, totalFreight = 0, totalDelivery = 0, totalInsurance = 0, totalBrokerage = 0,
            totalExport = 0, totalCommission = 0, totalGrossProfit = 0, aveGp = 0, totalTotalExpense = 0;

        table.rows({ search: 'applied' }).every(function() {
            var data = this.data();
            
            totalVolume += parseFloat(parseFloat(data[8].replace(/,/g, '') || 0).toFixed(2));
            totalDollar += parseFloat(parseFloat(data[10].replace(/,/g, '') || 0).toFixed(2));
            totalEuro += parseFloat(parseFloat(data[11].replace(/,/g, '') || 0).toFixed(2));
            totalPhp += parseFloat(parseFloat(data[12].replace(/,/g, '') || 0).toFixed(2));
            totalCosRm += parseFloat(parseFloat(data[13].replace(/,/g, '') || 0).toFixed(2));
            totalFreight += parseFloat(parseFloat(data[14].replace(/,/g, '') || 0).toFixed(2));
            totalDelivery += parseFloat(parseFloat(data[15].replace(/,/g, '') || 0).toFixed(2));
            totalInsurance += parseFloat(parseFloat(data[16].replace(/,/g, '') || 0).toFixed(2));
            totalBrokerage += parseFloat(parseFloat(data[17].replace(/,/g, '') || 0).toFixed(2));
            totalExport += parseFloat(parseFloat(data[18].replace(/,/g, '') || 0).toFixed(2));
            totalCommission += (parseFloat(data[19].replace(/,/g, '') || 0));
            totalTotalExpense += (parseFloat(data[20].replace(/,/g, '') || 0));
            totalGrossProfit += parseFloat(parseFloat(data[21].replace(/,/g, '') || 0).toFixed(2));
        });

        $totalForeignValue = totalDollar + totalEuro;
        if (totalVolume !== 0) {
            aveUnitPrice = $totalForeignValue / totalVolume;
        }
        if (totalPhp !== 0) {
            aveGp = (totalGrossProfit / totalPhp) * 100;
        }

        $('#totalVolume').text(totalVolume.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $('#averageUnitPrice').text(aveUnitPrice.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $('#totalDollar').text(totalDollar.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $('#totalEuro').text(totalEuro.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $('#totalPhp').text(totalPhp.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $('#totalCosRm').text(totalCosRm.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $('#totalFreight').text(totalFreight.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $('#totalDelivery').text(totalDelivery.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $('#totalInsurance').text(totalInsurance.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $('#totalBrokerage').text(totalBrokerage.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $('#totalExport').text(totalExport.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $('#totalCommission').text(totalCommission.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $('#totalExpenses').text(totalTotalExpense.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $('#totalGrossProfit').text(totalGrossProfit.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        $('#aveGp').text(aveGp.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' %');
        $('#subtotal').text('SUBTOTAL');
    }

    updateFooter();
});
    
</script>
@endsection

