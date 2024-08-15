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
                                <table id='table' class="table table-striped table-bordered table-hover fullSummaryTable" style="margin-bottom: 0px !important;">
                                    <thead>
                                        <tr>
                                            <th>Date of Invoice</th>
                                            <th>Accounts</th>
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
                                            <th>Freight/   Trucking/    Handling/Arrastre/      Insurance</th>
                                            <th>Commissions </th>
                                            <th>Gross Profit - RM </th>
                                            <th>GP%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($invoices as $invoice)
                                        @if(str_contains($invoice->PRODUCT_EXPORTED,"Delivery"))
                                        @else
                                        @php
                                            $dollar = 0;
                                            $euro = 0;
                                            if($invoice->CurrencyType == "_SYS00000000168")
                                            {
                                                $dollar = $invoice->Dollar_Value;
                                            }
                                            elseif($invoice->CurrencyType = "_SYS00000000171") {
                                                
                                                $euro = $invoice->Dollar_Value;
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{date('Y-m-d',strtotime($invoice->Date_of_Invoice))}}</td>
                                            <td>{{$invoice->WhsCode}}</td>
                                            <td>
                                                {{-- {{$invoice->DocNum}}  --}}
                                                {{$invoice->U_InvoiceNo}}</td>
                                            <td>{{$invoice->Export_Invoice_No}} </td>
                                            <td>{{$invoice->Client}}</td>
                                            <td>{{$invoice->PRODUCT_EXPORTED}}</td>
                                            <td>{{number_format($invoice->VOLUME,2)}}</td>
                                            <td>{{number_format($invoice->UNIT_PRICE,2)}}</td>
                                            <td>{{number_format($dollar,2)}}</td>
                                            <td>{{number_format($euro,2)}}</td>
                                            <td>{{number_format($invoice->Php_Value,2)}}</td>
                                            <td>{{number_format($invoice->COS_RM,2)}}</td>
                                            @php
                                                $freight = 0;
                                                $commission = 0;
                                                $gp=0;
                                            @endphp
                                            @if($company == "WHI")
                                            <td>
                                                {{-- @foreach(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620400','620300']) as $inv)
                                               {{$inv->LineTotal}} <br>
                                            @endforeach --}}
                                            {{-- {{number_format(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620400','620300'])->sum('LineTotal'),2)}} --}}
                                            {{-- <br> --}}
                                            @if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620400','620300'])->sum('LineTotal') > 0)
                                            @php
                                                $frieght = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620400','620300'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                            @endphp
                                            {{number_format(((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620400','620300'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME),2)}}
                                            
                                            @else
                                            0.00
                                            @php
                                                $frieght = 0;
                                            @endphp
                                            @endif
                                            </td>
                                            <td>
                                                {{-- @foreach(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620200']) as $inv)
                                                {{$inv->LineTotal}} <br>
                                             @endforeach --}}
                                             @php
                                                 $commission = ($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620200'])->sum('LineTotal');
                                                 $gross_profit = $invoice->Php_Value-$frieght-$commission-$invoice->COS_RM;
                                                 if(str_contains($invoice->WhsCode,"TRI"))                                                 
                                                    {
                                                        $frieght = 0;
                                                        $commission = 0;
                                                        $gross_profit = 0;

                                                    }
                                                 if($gross_profit != 0)
                                                 {
                                                    $gp = $invoice->Php_Value/$gross_profit;
                                                 }
                                               
                                             @endphp
                                             {{number_format(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620200'])->sum('LineTotal'),2)}}

                                            </td>
                                            <td>

                                                {{number_format($gross_profit ,2)}}
                                            </td>
                                            <td>{{number_format($gp ,2)}} %</td>
                                            @elseif($company == "PBI")
                                            <td>
                                                {{-- @foreach(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620400','620300']) as $inv)
                                               {{$inv->LineTotal}} <br>
                                            @endforeach --}}
                                            {{-- {{number_format(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620400','620300'])->sum('LineTotal'),2)}} --}}
                                            {{-- <br> --}}
                                            @if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710400','710701'])->sum('LineTotal') > 0)
                                            @php
                                                $frieght = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710400','710701'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                            @endphp
                                            {{number_format(((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710400','710701'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME),2)}}
                                            
                                            @else
                                            0.00
                                            @php
                                                $frieght = 0;
                                            @endphp
                                            @endif
                                            </td>
                                            <td>
                                                {{-- @foreach(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620200']) as $inv)
                                                {{$inv->LineTotal}} <br>
                                             @endforeach --}}
                                             @php
                                                 $commission = ($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710600'])->sum('LineTotal');
                                                 $gross_profit = $invoice->Php_Value-$frieght-$commission-$invoice->COS_RM;
                                                 if(str_contains($invoice->WhsCode,"TRI"))                                                 
                                                    {
                                                        $frieght = 0;
                                                        $commission = 0;
                                                        $gross_profit = 0;

                                                    }
                                                 if($gross_profit != 0)
                                                 {
                                                    $gp = $invoice->Php_Value/$gross_profit;
                                                 }
                                               
                                             @endphp
                                             {{number_format(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['710600'])->sum('LineTotal'),2)}}

                                            </td>
                                            <td>

                                                {{number_format($gross_profit ,2)}}
                                            </td>
                                            <td>{{number_format($gp ,2)}} %</td>
                                            @elseif($company == "CCC")
                                            <td>
                                                {{-- @foreach(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620400','620300']) as $inv)
                                               {{$inv->LineTotal}} <br>
                                            @endforeach --}}
                                            {{-- {{number_format(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620400','620300'])->sum('LineTotal'),2)}} --}}
                                            {{-- <br> --}}
                                            @if(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['610131'])->sum('LineTotal') > 0)
                                            @php
                                                $frieght = ((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['610131'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME);
                                            @endphp
                                            {{number_format(((($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['610131'])->sum('LineTotal') / $invoices->where('U_InvoiceNo',$invoice->U_InvoiceNo)->sum('VOLUME')) * $invoice->VOLUME),2)}}
                                            
                                            @else
                                            0.00
                                            @php
                                                $frieght = 0;
                                            @endphp
                                            @endif
                                            </td>
                                            <td>
                                                {{-- @foreach(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620200']) as $inv)
                                                {{$inv->LineTotal}} <br>
                                             @endforeach --}}
                                             @php
                                                 $commission = ($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620000'])->sum('LineTotal');
                                                 $gross_profit = $invoice->Php_Value-$frieght-$commission-$invoice->COS_RM;
                                                 if(str_contains($invoice->WhsCode,"TRI"))                                                 
                                                    {
                                                        $frieght = 0;
                                                        $commission = 0;
                                                        $gross_profit = 0;

                                                    }
                                                 if($gross_profit != 0)
                                                 {
                                                    $gp = $invoice->Php_Value/$gross_profit;
                                                 }
                                               
                                             @endphp
                                             {{number_format(($invoice->ap_whi)->whereIn('chart_of_account.FatherNum',['620000'])->sum('LineTotal'),2)}}

                                            </td>
                                            <td>

                                                {{number_format($gross_profit ,2)}}
                                            </td>
                                            <td>{{number_format($gp ,2)}} %</td>
                                            @endif
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
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
       $(document).ready(function(){

// $('.cat').chosen({width: "100%"});
$('.fullSummaryTable').DataTable({
    pageLength: -1,
    fixedHeader: true,
    scrollX: true,
    scrollY: 700,   
    scrollCollapse: true,
    paging: false,
    paginate: false,
    responsive: true,
    dom: '<"html5buttons"B>lTfgitp',
    buttons: [
        {extend: 'csv', title: 'Aging Report'},
        {extend: 'excel', title: 'Aging Report'}
    ]

});

});
</script>
@endsection

