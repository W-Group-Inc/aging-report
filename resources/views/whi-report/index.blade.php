@extends('layouts.header')
@section('css')
<link href="{{ asset('/inside/login_css/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
<link href="{{ asset('/inside/login_css/css/style.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="wrapper wrapper-content ">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox ">
                                <div class="ibox-content">
                                    <form method='GET' onsubmit='updateSessionStorage(); show();' enctype="multipart/form-data" >
                                        <div class="row align-items-end" style="display: flex;justify-content: center;align-items: center;">
                                            <div class="col-lg-3">
                                                <select name='company' class='form-control' required>
                                                    <option value=''>Company</option>
                                                    <option value='WHI' @if($company == "WHI") selected @endif>WHI</option>
                                                    <option value='PBI' @if($company == "PBI") selected @endif>PBI</option>
                                                    <option value='CCC' @if($company == "CCC") selected @endif>CCC</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2" style="display: flex;justify-content: center;align-items: center;">
                                                <h3 id="aging_date">AR Aging as of:&nbsp;<span id="aging_span"></span></h3> 
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="end_date" style="display: block;">End Date:</label>
                                                        <input type="date" id="end_date" name="end_date" value="{{ Request::get('end_date') }}" class="form-control" >
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
                <div class="col-lg-3">
                    
                    <div class="row" style="display:none">
                        <div class="col-md-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <a href="#table"><h3 class="no-margins bg-primary p-xs b-r-sm "   onclick='current("current");' >Current : <span id='total_current'>0</span>   <div class="stat-percent font-bold text-white" style='font-size:11px;' >&#8369; <span id='total_current_php'>0.00</span></div></h3><br>
                                      </a>
                                    <a href="#table"><h3 class="no-margins bg-info p-xs b-r-sm" href="#table" onclick='current("1 to 30 days late");'>1 to 30 days late : <span id='total_month'>0</span> <div class="stat-percent font-bold text-white" style='font-size:11px;' >&#8369; <span id='total_month_php'>0.00</span></div></h3></a>  <br>
                                    <a href="#table"><h3 class="no-margins bg-warning p-xs b-r-sm" href="#table" onclick='current("31 to 60 days late");'>31 to 60 days late : <span id='total_twomonth'>0</span><div class="stat-percent font-bold text-white" style='font-size:11px;' >&#8369; <span id='total_twomonth_php'>0.00</span></div></h3></a>  <br>
                                    <a href="#table"><h3 class="no-margins bg-warning p-xs b-r-sm" href="#table" onclick='current("61 to 90 days late");'>61 to 90 days late : <span id='total_threemonth'>0</span><div class="stat-percent font-bold text-white" style='font-size:11px;' >&#8369; <span id='total_threemonth_php'>0.00</span></div></h3></a>  <br>
                                    <a href="#table"><h3 class="no-margins bg-danger p-xs b-r-sm" href="#table" onclick='current("Over 90 days late");'>Over 90 days late : <span id='total_over_days'>0</span><div class="stat-percent font-bold text-white" style='font-size:11px;' >&#8369; <span id='total_over_days_php'>0.00</span></div></h3></a> 
                                    {{-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> --}}
                                    <small>&nbsp;</small>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                </div>
                <div class="col-lg-9" style="display:none">
                    <div class="row">
                        <div class='col-md-4'>
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-info pull-right">as of {{date('M. d, Y')}}</span>
                                    <h5>PHP</h5>
                                </div>
                                <div class="ibox-content">
                                    <h3 class="no-margins">&#8369; <span id='total'>0.00</span> </h3>
                                    <small>&nbsp;</small>
                                </div>
                            </div>
                        </div>
                        {{-- <div class='col-md-4'>
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-info pull-right">as of {{date('M. d, Y')}}</span>
                                    <h5>USD</h5>
                                </div>
                                <div class="ibox-content">
                                    <h3 class="no-margins">&#36; <span id='total_usd'>0.00</span> </h3>
                                    <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                                    <small>&nbsp;</small>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class='col-md-4'>
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-info pull-right">as of {{date('M. d, Y')}}</span>
                                    <h5>EURO</h5>
                                </div>
                                <div class="ibox-content">
                                    <h3 class="no-margins">&#8364; <span id='total_euro'>0.00</span></h3>
                                    <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                                    <small>&nbsp;</small>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class='col-md-4'>
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-info pull-right">as of {{date('M. d, Y')}}</span>
                                    <h5>PHP-T</h5>
                                </div>
                                <div class="ibox-content">
                                    <h3 class="no-margins">&#8369; <span id='total_php_t'>0.00</span> </h3>
                                    <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                                    <small>&nbsp;</small>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class='col-md-4'>
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-info pull-right">as of {{date('M. d, Y')}}</span>
                                    <h5>PHP-NT</h5>
                                </div>
                                <div class="ibox-content">
                                    <h3 class="no-margins">&#8369; <span id='total_php_nt'>0.00</span> </h3>
                                    <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                                    <small>&nbsp;</small>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class='col-md-4'>
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-info pull-right">@if($aging) {{date('M. d, Y',strtotime($aging->date))}} @else {{date('M. t, Y',strtotime($previous_month))}}  @endif</span>
                                    <h5>Last Aging Balance - {{$company}}</h5>
                                </div>
                                <div class="ibox-content">
                                    <h3 class="no-margins">&#8369; @if($aging) {{number_format($aging->amount,2)}} @else 0.00  @endif</span> </h3>
                                    <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                                    <small>&nbsp;</small>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <table id="newSummaryTable" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Accounts</th>
                                <th scope="col" onclick="openModal('current')">Current</th>
                                <th scope="col" onclick="openModal('1 to 30 days Late')">1 to 30 Days Late</th>
                                <th scope="col" onclick="openModal('31 to 60 days Late')">31 to 60 Days Late</th>
                                <th scope="col" onclick="openModal('61 to 90 days Late')">61 to 90 Days Late</th>
                                <th scope="col" onclick="openModal('Over 90 days Late')">Over 90 Days Late</th>
                                <th scope="col" onclick="openModal('total ar aging')">Total AR Aging</th>
                                <th scope="col">PHP Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="USD">
                                <td >USD</td>
                                <td  onclick="openModalByStatusAndCurrency('current', 'USD')"> <span class="summaryRow"><span class="currency">$</span><span id="total_current_usd"0.00></span></span></td>
                                <td  onclick="openModalByStatusAndCurrency('1 to 30 days Late', 'USD')"><span class="summaryRow"><span class="currency">$</span><span id="total_month_usd"0.00></span></span></td>
                                <td  onclick="openModalByStatusAndCurrency('31 to 60 days Late', 'USD')"><span class="summaryRow"><span class="currency">$</span><span id="total_twomonth_usd"0.00></span></span></td>
                                <td  onclick="openModalByStatusAndCurrency('61 to 90 days Late', 'USD')"><span class="summaryRow"><span class="currency">$</span><span id="total_threemonth_usd"0.00></span></span></td>
                                <td  onclick="openModalByStatusAndCurrency('Over 90 days Late', 'USD')"><span class="summaryRow"><span class="currency">$</span><span id="total_over_days_usd"0.00></span></span></td>
                                <td  onclick="openModalByStatusAndCurrency('total ar aging', 'USD')"><span class="summaryRow"><span class="currency">$</span><span id="total_usd"0.00></span></span></td>
                                <td><span class="summaryRow"><span class="currency">₱</span><span id="total_usd_in_ph"0.00></span></span></td>
                            </tr>
                            <tr>
                                <td >EUR</td>
                                <td id="" onclick="openModalByStatusAndCurrency('current', 'EUR')"><span class="summaryRow"><span class="currency">€</span><span id="total_current_euro"0.00></span></span></td>
                                <td id="" onclick="openModalByStatusAndCurrency('1 to 30 days Late', 'EUR')"><span class="summaryRow"><span class="currency">€</span><span id="total_month_euro"0.00></span></span></td>
                                <td id="" onclick="openModalByStatusAndCurrency('31 to 60 days Late', 'EUR')"><span class="summaryRow"><span class="currency">€</span><span id="total_twomonth_euro"0.00></span></span></td>
                                <td id="" onclick="openModalByStatusAndCurrency('61 to 90 days Late', 'EUR')"><span class="summaryRow"><span class="currency">€</span><span id="total_threemonth_euro"0.00></span></span></td>
                                <td id="" onclick="openModalByStatusAndCurrency('Over 90 days Late', 'EUR')"><span class="summaryRow"><span class="currency">€</span><span id="total_over_days_euro"0.00></span></span></td>
                                <td id="" onclick="openModalByStatusAndCurrency('total ar aging', 'EUR')"><span class="summaryRow"><span class="currency">€</span><span id="total_euro"0.00></span></span></td>
                                <td><span class="summaryRow"><span class="currency">₱</span><span id="total_euro_in_ph"0.00></span></span></td>
                            </tr>
                            <tr>
                                <td>PHP Trade</td>
                                <td  onclick="openModalByStatusAndCurrencyAndType('current', 'PHP', 'I')"><span class="summaryRow"><span class="currency">₱</span><span id="total_current_php_t"0.00></span></span></td>
                                <td  onclick="openModalByStatusAndCurrencyAndType('1 to 30 days Late', 'PHP', 'I')"><span class="summaryRow"><span class="currency">₱</span><span id="total_month_php_t"0.00></span></span></td>
                                <td  onclick="openModalByStatusAndCurrencyAndType('31 to 60 days Late', 'PHP', 'I')"><span class="summaryRow"><span class="currency">₱</span><span id="total_twomonth_php_t"0.00></span></span></td>
                                <td  onclick="openModalByStatusAndCurrencyAndType('61 to 90 days Late', 'PHP', 'I')"><span class="summaryRow"><span class="currency">₱</span><span id="total_threemonth_php_t"0.00></span></span></td>
                                <td  onclick="openModalByStatusAndCurrencyAndType('Over 90 days Late', 'PHP', 'I')"><span class="summaryRow"><span class="currency">₱</span><span id="total_over_days_php_t"0.00></span></span></td>
                                <td  onclick="openModalByStatusAndCurrencyAndType('total ar aging', 'PHP', 'I')"><span class="summaryRow"><span class="currency">₱</span><span id="total_php_t"0.00></span></span></td>
                            </tr>
                            <tr>
                                <td>PHP Non-Trade</td>
                                <td  onclick="openModalByStatusAndCurrencyAndType('current', 'PHP', 'S')"><span class="summaryRow"><span class="currency">₱</span><span id="total_current_php_nt"0.00></span></span></td>
                                <td  onclick="openModalByStatusAndCurrencyAndType('1 to 30 days Late', 'PHP', 'S')"><span class="summaryRow"><span class="currency">₱</span><span id="total_month_php_nt"0.00></span></span></td>
                                <td  onclick="openModalByStatusAndCurrencyAndType('31 to 60 days Late', 'PHP', 'S')"><span class="summaryRow"><span class="currency">₱</span><span id="total_twomonth_php_nt"0.00></span></span></td>
                                <td  onclick="openModalByStatusAndCurrencyAndType('61 to 90 days Late', 'PHP', 'S')"><span class="summaryRow"><span class="currency">₱</span><span id="total_threemonth_php_nt"0.00></span></span></td>
                                <td  onclick="openModalByStatusAndCurrencyAndType('Over 90 days Late', 'PHP', 'S')"><span class="summaryRow"><span class="currency">₱</span><span id="total_over_days_php_nt"0.00></span></span></td>
                                <td  onclick="openModalByStatusAndCurrencyAndType('total ar aging', 'PHP', 'S')"><span class="summaryRow"><span class="currency">₱</span><span id="total_php_nt"0.00></span></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    

    <div class="modal fade" id="myModal">
        <div class="modal-dialog"  style="width: 90%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="modalTitle">Table Modal</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                    <table id='invoiceTable' class="table table-striped table-bordered table-hover tables invoiceTable" style="margin-bottom: 0px !important;">
                        <thead>
                            
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                            <h5>AR Aging Report </h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table id='table' class="table table-striped table-bordered table-hover fullSummaryTable" style="margin-bottom: 0px !important;">
                                    <thead>
                                        <tr>
                                            <th>Actions</th>
                                            <th>Customer Name</th>
                                            <th>Invoice Number</th>
                                            <th>Buyer's Mark</th>
                                            <th>Original Invoice Amount</th>
                                            <th>Invoice Date</th>
                                            <th>Payment Term</th>
                                            <th>Baseline Date</th>
                                            <th>Invoice Due Date</th>
                                            <th>Invoice Balance USD</th>
                                            <th>Invoice Balance EUR</th>
                                            <th>Invoice Balance PHP-T</th>
                                            <th>Invoice balance PHP-NT</th>
                                            <th>Days Late</th>
                                            <th>Aging Status</th>
                                            <th>Forex Rate</th>
                                            <th>Invoice PHP Value</th>
                                            <th>Location</th>
                                            <th>Account Manager</th>
                                            <th style="padding-right: 80px">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_usd = 0;
                                            $total_usd_in_ph = 0;
                                            $total_euro = 0;
                                            $total_euro_in_ph = 0;
                                            $total_php_t = 0;
                                            $total_php_nt = 0;
                                            $total_php = 0;
                                            $total_current = 0;
                                            $total_month = 0;
                                            $total_twomonth = 0;
                                            $total_threemonth = 0;
                                            $total_over_days = 0;
                                            $total_current_php = 0;
                                            $total_current_usd = 0;
                                            $total_month_usd = 0;
                                            $total_twomonth_usd = 0;
                                            $total_threemonth_usd = 0;
                                            $total_over_days_usd = 0;
                                            $total_current_euro = 0;
                                            $total_month_euro = 0;
                                            $total_twomonth_euro = 0;
                                            $total_threemonth_euro = 0;
                                            $total_over_days_euro = 0;
                                            $total_current_php_t = 0;
                                            $total_month_php_t = 0;
                                            $total_twomonth_php_t = 0;
                                            $total_threemonth_php_t = 0;
                                            $total_over_days_php_t = 0;
                                            $total_current_php_nt = 0;
                                            $total_month_php_nt = 0;
                                            $total_twomonth_php_nt = 0;
                                            $total_threemonth_php_nt = 0;
                                            $total_over_days_php_nt = 0;
                                            $total_month_php = 0;
                                            $total_twomonth_php = 0;
                                            $total_threemonth_php = 0;
                                            $total_over_days_php = 0;
                                        @endphp
                                        @foreach ($invoices as $invoice)
                                        <tr>
                                            <td align="center">
                                                @if($invoice->remark)
                                                    <button type="button" class="btn btn-success btn-outline" title="Edit Remarks" data-toggle="modal" data-target="#edit_remarks{{$invoice->remark->id}}" id="editRemarksBtn"><i class="fa fa fa-pencil"></i></button>
                                                @else
                                                    <button onclick="getDocEntry({{$invoice}});" type="button" class="btn btn-primary btn-outline" title="Add Remarks" data-toggle="modal" data-target="#add_remarks" id="addRemarksBtn"><i class="fa fa fa-plus"></i></button>
                                                @endif
                                            </td>
                                            <td>{{$invoice->CardName}}</td>
                                            <td>{{$invoice->U_invNo}}</td>
                                            <td>{{$invoice->NumAtCard}}</td>
                                            {{-- <td>{{ "$invoice->DocCur" .' '. number_format($invoice->DocTotalFC, 2) }}</td> --}}
                                            <td> <?php
                                                $currencySymbol = '';
                                                if ($invoice->DocCur === 'USD') {
                                                    $currencySymbol = '$';
                                                } elseif ($invoice->DocCur === 'EUR') {
                                                    $currencySymbol = '€';
                                                } elseif ($invoice->DocCur === 'PHP') {
                                                    $currencySymbol = '₱';
                                                }
                                                $totalFrgnTRIWhse = 0;
                                                foreach ($invoice->inv1 as $item) {
                                                    if ($item->WhsCode === 'TRI Whse') {
                                                        $totalFrgnTRIWhse += $item->TotalFrgn;
                                                    }
                                                }

                                                $finalTotal = $invoice->DocTotalFC - $totalFrgnTRIWhse;

                                                echo $currencySymbol . '' . number_format($finalTotal, 2);
                                                ?></td>
                                            <td>{{date('m/d/Y', strtotime($invoice->DocDate))}}</td>
                                            <td>{{$invoice->terms->PymntGroup}}</td>
                                            <td>@if($invoice->U_BaseDate != null){{date('m/d/Y', strtotime($invoice->U_BaseDate))}}@else NA @endif</td>
                                            <td>{{date('m/d/Y', strtotime($invoice->U_DueDateAR))}}</td>
                                            @php
                                            $final_amount = $finalTotal - $invoice->PaidFC;
                                            $usd = "";
                                            $euro = "";
                                            $php = "";
                                            if ($invoice->DocCur == "USD") {
                                                    $total_usd += $final_amount;
                                                    $usd = number_format($final_amount, 2);
                                                
                                                    $end_date = strtotime(Request::get('end_date'));
                                                    if (empty($end_date)) {
                                                        $end_date = time(); 
                                                    }
                                                    if (empty($invoice->U_DueDateAR)) {
                                                        $total_current_usd += $final_amount; 
                                                    } else {
                                                        $dueDateTimestamp = strtotime($invoice->U_DueDateAR);
                                                        if ($dueDateTimestamp === false) {
                                                            $total_current_usd += $final_amount;
                                                        } else {
                                                            $daysLate = ceil(($end_date - $dueDateTimestamp) / (60 * 60 * 24));

                                                            if ($daysLate <= 0) {
                                                                $total_current_usd += $final_amount;
                                                            } elseif ($daysLate >= 1 && $daysLate <= 30) {
                                                                $total_month_usd += $final_amount;
                                                            } elseif ($daysLate >= 31 && $daysLate <= 60) {
                                                                $total_twomonth_usd += $final_amount;
                                                            } elseif ($daysLate >= 61 && $daysLate <= 90) {
                                                                $total_threemonth_usd += $final_amount;
                                                            } else {
                                                                $total_over_days_usd += $final_amount;
                                                            }
                                                        }
                                                    }
                                                }
                                                elseif($invoice->DocCur == "EUR") {
                                                    $total_euro +=$final_amount;
                                                    $euro = number_format($final_amount,2);

                                                    $end_date = strtotime(Request::get('end_date'));
                                                    if (empty($end_date)) {
                                                        $end_date = time(); 
                                                    }
                                                    $dueDateTimestamp = strtotime($invoice->U_DueDateAR);
                                                    $daysLate = ceil(($end_date - $dueDateTimestamp) / (60 * 60 * 24));

                                                    if ($daysLate <= 0) {
                                                        $total_current_euro += $final_amount;
                                                    } elseif ($daysLate >= 1 && $daysLate <= 30) {
                                                        $total_month_euro += $final_amount;
                                                    } elseif ($daysLate >= 31 && $daysLate <= 60) {
                                                        $total_twomonth_euro += $final_amount;
                                                    } elseif ($daysLate >= 61 && $daysLate <= 90) {
                                                        $total_threemonth_euro += $final_amount;
                                                    } else {
                                                        $total_over_days_euro += $final_amount;
                                                    }
                                                }
                                                else {
                                                    $php = number_format($invoice->DocTotal - $invoice->PaidToDate,2);
                                                    $final_amount = $invoice->DocTotal - $invoice->PaidToDate;
                                                }
                                            @endphp
                                            <td>@if($usd != null){{'$'."".$usd}} @else NA @endif</td>
                                            <td>@if($euro != null){{'€'."".$euro}} @else NA @endif</td>
                                            <td>@if($invoice->DocCur == 'PHP')
                                                    @if($invoice->DocType == "I")
                                                        @php
                                                            $php_t_amount = $invoice->DocTotal - $invoice->PaidToDate;
                                                            $total_php_t += $php_t_amount;

                                                            $end_date = strtotime(Request::get('end_date'));
                                                            if (empty($end_date)) {
                                                                $end_date = time(); 
                                                            }
                                                            $dueDateTimestamp = strtotime($invoice->U_DueDateAR);
                                                            $daysLate = ($end_date - $dueDateTimestamp) / (60 * 60 * 24);

                                                            if ($daysLate <= 0) {
                                                                $total_current_php_t += $php_t_amount;
                                                            } elseif ($daysLate >= 1 && $daysLate <= 30) {
                                                                $total_month_php_t += $php_t_amount;
                                                            } elseif ($daysLate <= 31 && $daysLate <= 60) {
                                                                $total_twomonth_php_t += $php_t_amount;
                                                            } elseif ($daysLate <= 61 && $daysLate <= 90) {
                                                                $total_threemonth_php_t += $php_t_amount;
                                                            } else {
                                                                $total_over_days_php_t += $php_t_amount;
                                                            }
                                                        @endphp {{'₱'."".$php}}
                                                    @else NA 
                                                    @endif
                                                @else NA 
                                                @endif
                                            </td>
                                            <td>@if($invoice->DocCur == 'PHP')
                                                    @if($invoice->DocType == "S") 
                                                        @php
                                                            $php_nt_amount = $invoice->DocTotal - $invoice->PaidToDate;
                                                            $total_php_nt += $php_nt_amount;

                                                            $end_date = strtotime(Request::get('end_date'));
                                                            if (empty($end_date)) {
                                                                $end_date = time(); 
                                                            }
                                                            $dueDateTimestamp = strtotime($invoice->U_DueDateAR);
                                                            $daysLate = ($end_date - $dueDateTimestamp) / (60 * 60 * 24);

                                                            if ($daysLate <= 0) {
                                                                $total_current_php_nt += $php_nt_amount;
                                                            } elseif ($daysLate >= 1 && $daysLate <= 30) {
                                                                $total_month_php_nt += $php_nt_amount;
                                                            } elseif ($daysLate >= 31 && $daysLate <= 60) {
                                                                $total_twomonth_php_nt += $php_nt_amount;
                                                            } elseif ($daysLate >= 61 && $daysLate <= 90) {
                                                                $total_threemonth_php_nt += $php_nt_amount;
                                                            } else {
                                                                $total_over_days_php_nt += $php_nt_amount;
                                                            }
                                                        @endphp 
                                                    {{'₱'."".$php}}
                                                    @else NA 
                                                    @endif
                                                @else NA 
                                                @endif
                                            </td>
                                            @php
                                                $end_date = strtotime(Request::get('end_date')); 
                                                if (empty($end_date)) {
                                                        $end_date = time(); 
                                                    }
                                                $datediff = $end_date - strtotime(date('m/d/Y', strtotime($invoice->U_DueDateAR))); 
                                            @endphp
                                            <td>{{ ceil($datediff / (60 * 60 * 24))}} {{ ceil($datediff / (60 * 60 * 24)) == 1 ? 'day' : 'days' }}</td>
                                            @php
                                                if (ceil($datediff / (60 * 60 * 24)) <= 0) {
                                                    $total_current++;
                                                    $status = 'Current';
                                                    $total_current_php = $total_current_php + ($final_amount * $invoice->DocRate);
                                                } elseif ((ceil($datediff / (60 * 60 * 24)) >= 1) && (ceil($datediff / (60 * 60 * 24)) <= 30)) {
                                                    $status = '1  to 30 days Late';
                                                    $total_month++;
                                                    $total_month_php = $total_month_php + ($final_amount * $invoice->DocRate);
                                                } elseif ((ceil($datediff / (60 * 60 * 24)) >= 31) && (ceil($datediff / (60 * 60 * 24)) <= 60)) {
                                                    $status = '31  to 60 days Late';
                                                    $total_twomonth++;
                                                    $total_twomonth_php = $total_twomonth_php + ($final_amount * $invoice->DocRate);
                                                } elseif ((ceil($datediff / (60 * 60 * 24)) >= 61) && (ceil($datediff / (60 * 60 * 24)) <= 90)) {
                                                    $status = '61  to 90 days Late';
                                                    $total_threemonth++;
                                                    $total_threemonth_php = $total_threemonth_php + ($final_amount * $invoice->DocRate);
                                                } else {
                                                    $total_over_days++;
                                                    $status = 'Over 90 days Late';
                                                    $total_over_days_php = $total_over_days_php + ($final_amount * $invoice->DocRate);
                                                }
                                            @endphp
                                            <td>{{ $status }}</td>
                                            <td>{{$invoice->DocRate}}</td>
                                            @php
                                                $total_php = $final_amount*$invoice->DocRate + $total_php;
                                                if($invoice->DocCur == "USD") {
                                                    $total_usd_in_ph += $final_amount * $invoice->DocRate;
                                                }
                                                if($invoice->DocCur == "EUR") {
                                                    $total_euro_in_ph += $final_amount * $invoice->DocRate;
                                                }
                                            @endphp
                                            <td>{{number_format($final_amount*$invoice->DocRate,2)}}</td>
                                            <td>{{ $invoice->location->ocrg->GroupName ?? 'N/A' }}</td> 
                                            <td>{{$invoice->manager->SlpName}}</td>
                                            <td> 
                                                @if($invoice->remark)
                                                    {{$invoice->remark->remarks}}
                                                    <br>
                                                    <span style="font-size: 10px">Date Created: <span class="label label-primary">{{ $invoice->remark->created_at->format('M. d, Y g:i A') }}</span>
                                                    <br>
                                                    <span style="font-size: 10px">Date Updated: <span class="label label-warning">{{ $invoice->remark->updated_at->format('M. d, Y g:i A') }}</span>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        @foreach ($last_invoices as $invoiceinvoice)
                                        <tr>
                                            <td align="center">
                                                @if($invoiceinvoice->remark)
                                                    <button type="button" class="btn btn-success btn-outline" title="Edit Remarks" data-toggle="modal" data-target="#edit_remarks{{$invoiceinvoice->remark->id}}" id="editRemarksBtn"><i class="fa fa fa-pencil"></i></button>
                                                @else
                                                    <button onclick="getDocEntry({{$invoiceinvoice}});" type="button" class="btn btn-primary btn-outline" title="Add Remarks" data-toggle="modal" data-target="#add_remarks" id="addRemarksBtn"><i class="fa fa fa-plus"></i></button>
                                                @endif
                                            </td>
                                            <td>{{$invoiceinvoice->CardName}}</td>
                                            <td>{{$invoiceinvoice->U_invNo}}</td>
                                            <td>{{$invoiceinvoice->NumAtCard}}</td>
                                            {{-- <td>{{ $invoice->DocCur .' '. number_format($invoice->DocTotalFC, 2) }}</td> --}}
                                            <td> <?php
                                                $currencySymbol = '';
                                                if ($invoiceinvoice->DocCur === 'USD') {
                                                    $currencySymbol = '$';
                                                } elseif ($invoiceinvoice->DocCur === 'EUR') {
                                                    $currencySymbol = '€';
                                                } elseif ($invoiceinvoice->DocCur === 'PHP') {
                                                    $currencySymbol = '₱';
                                                }
                                                $totalFrgnTRIWhse = 0;
                                                foreach ($invoiceinvoice->inv1 as $item) {
                                                    if ($item->WhsCode === 'TRI Whse') {
                                                        $totalFrgnTRIWhse += $item->TotalFrgn;
                                                    }
                                                    else {
                                                        $totalFrgnTRIWhse = 0;
                                                    }
                                                }

                                                $finalTotal = $invoiceinvoice->DocTotalFC - $totalFrgnTRIWhse;

                                                echo $currencySymbol . '' . number_format($finalTotal, 2);
                                                ?></td>
                                            <td>{{date('m/d/Y', strtotime($invoiceinvoice->DocDate))}}</td>
                                            <td>{{$invoiceinvoice->terms->PymntGroup}}</td>
                                            <td>@if($invoiceinvoice->U_BaseDate != null){{date('m/d/Y', strtotime($invoiceinvoice->U_BaseDate))}}@else NA @endif</td>
                                            <td>{{date('m/d/Y', strtotime($invoiceinvoice->U_DueDateAR))}}</td>
                                            @php
                                            $final_amount = + 25000.00;
                                            $usd = "";
                                            $euro = "";
                                            $php = "";
                                            if ($invoice->DocCur == "USD") {
                                                    $total_usd += $final_amount;
                                                    $usd = number_format($final_amount, 2);
                                                
                                                    $end_date = strtotime(Request::get('end_date'));
                                                    if (empty($end_date)) {
                                                        $end_date = time(); 
                                                    }
                                                    if (empty($invoice->U_DueDateAR)) {
                                                        $total_current_usd += $final_amount; 
                                                    } else {
                                                        $dueDateTimestamp = strtotime($invoice->U_DueDateAR);
                                                        if ($dueDateTimestamp === false) {
                                                            $total_current_usd += $final_amount;
                                                        } else {
                                                            $daysLate = ceil(($end_date - $dueDateTimestamp) / (60 * 60 * 24));

                                                            if ($daysLate <= 0) {
                                                                $total_current_usd += $final_amount;
                                                            } elseif ($daysLate >= 1 && $daysLate <= 30) {
                                                                $total_month_usd += $final_amount;
                                                            } elseif ($daysLate >= 31 && $daysLate <= 60) {
                                                                $total_twomonth_usd += $final_amount;
                                                            } elseif ($daysLate >= 61 && $daysLate <= 90) {
                                                                $total_threemonth_usd += $final_amount;
                                                            } else {
                                                                $total_over_days_usd += $final_amount;
                                                            }
                                                        }
                                                    }
                                                }
                                                // if($invoice->DocCur == "USD")
                                                // {
                                                //     $total_usd = $total_usd + 25000.00;
                                                //     $usd = number_format(25000.00,2);
                                                // }
                                                elseif($invoiceinvoice->DocCur == "EUR") {
                                                    $total_euro = $total_euro+$final_amount;
                                                    $euro = number_format($final_amount,2);
                                                }
                                                else {
                                                    $php = number_format($invoiceinvoice->DocTotal - $invoiceinvoice->PaidToDate,2);
                                                    $final_amount = $invoiceinvoice->DocTotal - $invoiceinvoice->PaidToDate;
                                                }
                                            @endphp
                                            <td>@if($usd != null){{$usd}} @else NA @endif</td>
                                            <td>@if($euro != null){{$euro}} @else NA @endif</td>
                                            <td>@if($invoiceinvoice->DocCur == 'PHP')
                                                    @if($invoice->DocType == "I")
                                                        @php
                                                            $total_php_t = $total_php_t + $invoiceinvoice->DocTotal - $invoiceinvoice->PaidToDate; 
                                                        @endphp {{$php}}
                                                    @else NA 
                                                    @endif
                                                @else NA 
                                                @endif
                                            </td>
                                            <td>@if($invoiceinvoice->DocCur == 'PHP')
                                                    @if($invoiceinvoice->DocType == "S") 
                                                        @php
                                                            $total_php_nt = $total_php_nt + $invoiceinvoice->DocTotal - $invoiceinvoice->PaidToDate; 
                                                        @endphp 
                                                    {{$php}}
                                                    @else NA 
                                                    @endif
                                                @else NA 
                                                @endif
                                            </td>
                                            @php
                                                $end_date = strtotime(Request::get('end_date'));
                                                if (empty($end_date)) {
                                                        $end_date = time(); 
                                                    }
                                                $your_date = strtotime(date('m/d/Y', strtotime($invoiceinvoice->U_DueDateAR)));
                                                $datediff = $end_date - $your_date
                                            @endphp
                                            <td>{{ceil($datediff / (60 * 60 * 24)). " days"}}</td>
                                            @php
                                                if (ceil($datediff / (60 * 60 * 24)) <= 0) {
                                                    $total_current++;
                                                    $status = 'Current';
                                                }
                                                elseif ((ceil($datediff / (60 * 60 * 24)) >= 1) && (ceil($datediff / (60 * 60 * 24)) <= 30))
                                                {
                                                    $status = '1  to 30 days Late';
                                                    
                                                    $total_month++;
                                                }
                                                elseif ((ceil($datediff / (60 * 60 * 24)) >= 31) && (ceil($datediff / (60 * 60 * 24)) <= 60))
                                                {
                                                    $status = '31  to 60 days Late';
                                                    $total_twomonth++;
                                                }
                                                elseif ((ceil($datediff / (60 * 60 * 24)) >= 61) && (ceil($datediff / (60 * 60 * 24)) <= 90))
                                                {
                                                    $status = '61  to 90 days Late';
                                                    
                                                    $total_threemonth++;
                                                }
                                                else
                                                {
                                                    $total_over_days++;
                                                    $status = 'Over 90 days Late';
                                                }
                                            @endphp
                                            <td>{{$status}}</td>
                                            <td>{{$invoiceinvoice->DocRate}}</td>
                                            @php
                                                $total_php = $final_amount*$invoiceinvoice->DocRate + $total_php;
                                            @endphp
                                            <td>{{number_format($final_amount*$invoiceinvoice->DocRate,2)}}</td>
                                            <td>{{$invoiceinvoice->location->ocrg->GroupName ?? 'N/A'}}</td> 
                                            <td>{{$invoiceinvoice->manager->SlpName}}</td>
                                            <td>
                                                @if($invoiceinvoice->remark)
                                                    {{$invoiceinvoice->remark->remarks}}
                                                    <br>
                                                    <span style="font-size: 10px">Date Created: <span class="label label-primary">{{ $invoiceinvoice->remark->created_at->format('M. d, Y g:i A') }}</span>
                                                    <br>
                                                    <span style="font-size: 10px">Date Updated: <span class="label label-warning">{{ $invoiceinvoice->remark->updated_at->format('M. d, Y g:i A') }}</span>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan='10' class='text-right'>Total Account Receivables</td>
                                            <td>{{number_format($total_usd,2)}}</td>
                                            <td>{{number_format($total_euro,2)}}</td>
                                            <td>{{number_format($total_php_t,2)}}</td>
                                            <td>{{number_format($total_php_nt,2)}}</td>
                                            <td></td>
                                            <td>{{number_format($total_php,2)}}</td>
                                            <td></td>
                                            <td></td>
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
    <div class="modal fade" id="add_remarks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form method="POST" action="{{url('new_remarks')}}" autocomplete="off">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Add Remarks</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input name="docentry" id="docentry" type="hidden">
                        <input name="user_id" id="user_id" type="hidden" value="{{ auth()->user()->id }}">
                        <div class="row">
                            <div class="col-12 mb-10">
                                <input name="remarks" id="remarks" class="form-control" type="text" placeholder="Enter Remarks" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @foreach($invoices as $invoice)
        @if ($invoice->remark)
            <div class="modal fade" id="edit_remarks{{ $invoice->remark->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form action="{{ url('update_remarks/'.$invoice->remark->id) }}" method="POST">
                    @csrf
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel">Edit Remarks</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12 mb-10">
                                        <label>Remarks</label>
                                        <input name="remarks" id="remarks{{ $invoice->id }}" class="form-control" type="text" value="{{ $invoice->remark['remarks'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endif
    @endforeach
</div>

@php
    $total_php = number_format($total_php,2);
    $total_usd = number_format($total_usd,2);
    $total_euro = number_format($total_euro,2);
    $total_php_t = number_format($total_php_t,2);
    $total_php_nt = number_format($total_php_nt,2);
@endphp
@endsection
@section('footer')
<script src="{{ asset('/inside/login_css/js/plugins/dataTables/datatables.min.js')}}"></script>
<script src="{{ asset('/inside/login_css/js/plugins/chosen/chosen.jquery.js') }}"></script>
<script>

    function getDocEntry(data)
    {
        document.getElementById("docentry").value = data.DocNum;
    }

    var total_current = {!! json_encode($total_current) !!};
    var total_month = {!! json_encode($total_month) !!};
    var total_twomonth = {!! json_encode($total_twomonth) !!};
    var total_threemonth = {!! json_encode($total_threemonth) !!};
    var total_over_days = {!! json_encode($total_over_days) !!};
    var total_current_php = {!! json_encode(number_format($total_current_php,2)) !!};
    var total_current_usd = {!! json_encode(number_format($total_current_usd,2)) !!};
    var total_month_usd = {!! json_encode(number_format($total_month_usd,2)) !!};
    var total_twomonth_usd = {!! json_encode(number_format($total_twomonth_usd,2)) !!};
    var total_threemonth_usd = {!! json_encode(number_format($total_threemonth_usd,2)) !!};
    var total_over_days_usd = {!! json_encode(number_format($total_over_days_usd,2)) !!};
    var total_current_euro = {!! json_encode(number_format($total_current_euro,2)) !!};
    var total_month_euro = {!! json_encode(number_format($total_month_euro,2)) !!};
    var total_twomonth_euro = {!! json_encode(number_format($total_twomonth_euro,2)) !!};
    var total_threemonth_euro = {!! json_encode(number_format($total_threemonth_euro,2)) !!};
    var total_over_days_euro = {!! json_encode(number_format($total_over_days_euro,2)) !!};
    var total_month_php = {!! json_encode(number_format($total_month_php,2)) !!};
    var total_twomonth_php = {!! json_encode(number_format($total_twomonth_php,2)) !!};
    var total_threemonth_php = {!! json_encode(number_format($total_threemonth_php,2)) !!};
    var total_over_days_php = {!! json_encode(number_format($total_over_days_php,2)) !!};
    var total = {!! json_encode($total_php) !!};
    var total_usd = {!! json_encode($total_usd) !!};
    var total_usd_in_ph = {!! json_encode(number_format($total_usd_in_ph,2)) !!};
    var total_euro = {!! json_encode($total_euro) !!};
    var total_euro_in_ph = {!! json_encode(number_format($total_euro_in_ph,2)) !!};
    var total_php_t = {!! json_encode($total_php_t) !!};
    var total_current_php_t = {!! json_encode(number_format($total_current_php_t,2)) !!};
    var total_month_php_t = {!! json_encode(number_format($total_month_php_t,2)) !!};
    var total_twomonth_php_t = {!! json_encode(number_format($total_twomonth_php_t,2)) !!};
    var total_threemonth_php_t = {!! json_encode(number_format($total_threemonth_php_t,2)) !!};
    var total_over_days_php_t = {!! json_encode(number_format($total_over_days_php_t,2)) !!};
    var total_php_nt = {!! json_encode($total_php_nt) !!};
    var total_current_php_nt = {!! json_encode(number_format($total_current_php_nt,2)) !!};
    var total_month_php_nt = {!! json_encode(number_format($total_month_php_nt,2)) !!};
    var total_twomonth_php_nt = {!! json_encode(number_format($total_twomonth_php_nt,2)) !!};
    var total_threemonth_php_nt = {!! json_encode(number_format($total_threemonth_php_nt,2)) !!};
    var total_over_days_php_nt = {!! json_encode(number_format($total_over_days_php_nt,2)) !!};
    document.getElementById("total_current").innerHTML = total_current;
    document.getElementById("total_month").innerHTML = total_month;
    document.getElementById("total_twomonth").innerHTML = total_twomonth;
    document.getElementById("total_threemonth").innerHTML = total_threemonth;
    document.getElementById("total_over_days").innerHTML = total_over_days;
    document.getElementById("total_current_php").innerHTML = total_current_php;
    document.getElementById("total_current_usd").innerHTML = total_current_usd;
    document.getElementById("total_month_usd").innerHTML = total_month_usd;
    document.getElementById("total_twomonth_usd").innerHTML = total_twomonth_usd;
    document.getElementById("total_threemonth_usd").innerHTML = total_threemonth_usd;
    document.getElementById("total_over_days_usd").innerHTML = total_over_days_usd;
    document.getElementById("total_current_euro").innerHTML = total_current_euro;
    document.getElementById("total_month_euro").innerHTML = total_month_euro;
    document.getElementById("total_twomonth_euro").innerHTML = total_twomonth_euro;
    document.getElementById("total_threemonth_euro").innerHTML = total_threemonth_euro;
    document.getElementById("total_over_days_euro").innerHTML = total_over_days_euro;
    document.getElementById("total_month_php").innerHTML = total_month_php;
    document.getElementById("total_twomonth_php").innerHTML = total_twomonth_php;
    document.getElementById("total_threemonth_php").innerHTML = total_threemonth_php;
    document.getElementById("total_over_days_php").innerHTML = total_over_days_php;
    document.getElementById("total").innerHTML = total;
    document.getElementById("total_usd").innerHTML = total_usd;
    document.getElementById("total_usd_in_ph").innerHTML = total_usd_in_ph;
    document.getElementById("total_euro").innerHTML = total_euro;
    document.getElementById("total_euro_in_ph").innerHTML = total_euro_in_ph;
    document.getElementById("total_php_t").innerHTML = total_php_t;
    document.getElementById("total_current_php_t").innerHTML = total_current_php_t;
    document.getElementById("total_month_php_t").innerHTML = total_month_php_t;
    document.getElementById("total_twomonth_php_t").innerHTML = total_twomonth_php_t;
    document.getElementById("total_threemonth_php_t").innerHTML = total_threemonth_php_t;
    document.getElementById("total_over_days_php_t").innerHTML = total_over_days_php_t;
    document.getElementById("total_php_nt").innerHTML = total_php_nt;
    document.getElementById("total_current_php_nt").innerHTML = total_current_php_nt;
    document.getElementById("total_month_php_nt").innerHTML = total_month_php_nt;
    document.getElementById("total_twomonth_php_nt").innerHTML = total_twomonth_php_nt;
    document.getElementById("total_threemonth_php_nt").innerHTML = total_threemonth_php_nt;
    document.getElementById("total_over_days_php_nt").innerHTML = total_over_days_php_nt;
    
   
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
//    function current(value)
//    {
   
//    }
var end_date_param = '<?php echo Request::get("end_date"); ?>';
var end_date;

if (end_date_param !== '') {
    end_date = Date.parse(end_date_param);
} else {
    end_date = Date.now(); 
}
   var invoicesData = <?php echo json_encode($invoices); ?> ;
   var last_invoices = <?php echo json_encode($last_invoices); ?>;

   var combinedData = invoicesData.concat(last_invoices);
   console.log(combinedData);
function openModal(filterColumn) {
    console.log(filterColumn);
    var filteredData = combinedData.filter(function (item) {
        var currentDate = new Date();
        // var dueDate = new Date(item.U_DueDateAR);
        var dueDate = item.U_DueDateAR ? new Date(item.U_DueDateAR) : null;
        var currentDateUTC = Date.UTC(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate());
        // var dueDateUTC = Date.UTC(dueDate.getFullYear(), dueDate.getMonth(), dueDate.getDate());
        var dueDateUTC = dueDate ? Date.UTC(dueDate.getFullYear(), dueDate.getMonth(), dueDate.getDate()) : null;
        // var datediff = Math.ceil((end_date - dueDateUTC) / (1000 * 60 * 60 * 24));
        var datediff = dueDate ? Math.ceil((currentDateUTC - dueDateUTC) / (1000 * 60 * 60 * 24)) : null;
        var status = '';

        if ( !dueDate || datediff <= 0) {
            status = 'current';
        } else if (datediff >= 1 && datediff <= 30) {
            status = '1 to 30 days Late';
        } else if (datediff >= 31 && datediff <= 60) {
            status = '31 to 60 days Late';
        } else if (datediff >= 61 && datediff <= 90) {
            status = '61 to 90 days Late';
        } else {
            status = 'Over 90 days Late';
        }
        if (filterColumn.toLowerCase() === 'total ar aging') {
            return true; 
        } else {
            return status.toLowerCase() === filterColumn.toLowerCase();
        }
    });
    renderModalContent(filteredData, filterColumn);

    $('#myModal').modal('show');
}


function openModalByStatusAndCurrency(status, currency) {
    var filteredData = combinedData.filter(function(item) {
       
        var currentDate = new Date();
        // var dueDate = new Date(item.U_DueDateAR);
        var dueDate = item.U_DueDateAR ? new Date(item.U_DueDateAR) : null;
        
        var currentDateUTC = Date.UTC(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate());
        // var dueDateUTC = Date.UTC(dueDate.getFullYear(), dueDate.getMonth(), dueDate.getDate());
        var dueDateUTC = dueDate ? Date.UTC(dueDate.getFullYear(), dueDate.getMonth(), dueDate.getDate()) : null;
        // var datediff = Math.ceil((end_date - dueDateUTC) / (1000 * 60 * 60 * 24));
        var datediff = dueDate ? Math.ceil((currentDateUTC - dueDateUTC) / (1000 * 60 * 60 * 24)) : null;
        var currentStatus = '';

        if (!dueDate || datediff <= 0) {
            currentStatus = 'current';
        } else if (datediff >= 1 && datediff <= 30) {
            currentStatus = '1 to 30 days Late';
        } else if (datediff >= 31 && datediff <= 60) {
            currentStatus = '31 to 60 days Late';
        } else if (datediff >= 61 && datediff <= 90) {
            currentStatus = '61 to 90 days Late';
        } else {
            currentStatus = 'Over 90 days Late';
        }

        if (status.toLowerCase() === 'total ar aging') {
            return item.DocCur === currency.toUpperCase(); 
        } else {
            return currentStatus.toLowerCase() === status.toLowerCase() && item.DocCur === currency.toUpperCase();
        }
    });

    renderModalContent(filteredData, status, currency);

    $('#myModal').modal('show');
}

function openModalByStatusAndCurrencyAndType(status, currency, type) {
    var filteredData = combinedData.filter(function(item) {
        var currentDate = new Date();
        var dueDate = new Date(item.U_DueDateAR);

        var currentDateUTC = Date.UTC(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate());
        var dueDateUTC = Date.UTC(dueDate.getFullYear(), dueDate.getMonth(), dueDate.getDate());

        var datediff = Math.ceil((end_date - dueDateUTC) / (1000 * 60 * 60 * 24));
        var currentStatus = '';

        if (datediff <= 0) {
            currentStatus = 'current';
        } else if (datediff >= 1 && datediff <= 30) {
            currentStatus = '1 to 30 days Late';
        } else if (datediff >= 31 && datediff <= 60) {
            currentStatus = '31 to 60 days Late';
        } else if (datediff >= 61 && datediff <= 90) {
            currentStatus = '61 to 90 days Late';
        } else {
            currentStatus = 'Over 90 days Late';
        }

        if (status.toLowerCase() === 'total ar aging') {
            return item.DocCur === currency.toUpperCase() && item.DocType === type.toUpperCase(); 
        } else {
            return currentStatus.toLowerCase() === status.toLowerCase() && item.DocCur === currency.toUpperCase() && item.DocType === type.toUpperCase();
        }
    });

    renderModalContent(filteredData, status, currency, type);

    $('#myModal').modal('show');
}

function renderModalContent(data, filterColumn, status, currency, type) {
    var modalBody = $('#myModal .modal-body');
    var tableBody = modalBody.find('.invoiceTable tbody');
    var tableHeader = modalBody.find('.invoiceTable thead');

    tableBody.empty();
    tableHeader.empty();
    var headerRow = '<tr>' +
        '<th>Action</th>' +
        '<th>Customer Name</th>' +
        '<th>Invoice Number</th>' +
        '<th>Buyers Mark</th>' +
        '<th>Original Invoice Amount</th>' +
        '<th>Invoice Date</th>' +
        '<th>Payment Term</th>' +
        '<th>Baseline Date</th>' +
        '<th>Invoice Due Date</th>' +
        '<th>Invoice Balance USD</th>' +
        '<th>Invoice Balance EUR</th>' +
        '<th>Invoice Balance PHP-T</th>' +
        '<th>Invoice balance PHP-NT</th>' +
        '<th>Days Late</th>' +
        '<th>Aging Status</th>' +
        '<th>Forex Rate</th>' +
        '<th>Invoice PHP Value</th>' +
        '<th>Location</th>' +
        '<th>Account Manager</th>' +
        '<th>Remarks</th>' +
        '</tr>';
        tableHeader.html(headerRow);
    data.forEach(function (item) {

        var currencySymbol;
if (item.DocCur === "USD") {
    currencySymbol = "$";
} else if (item.DocCur === "EUR") {
    currencySymbol = "€";
} else if (item.DocCur === "PHP") {
    currencySymbol = "₱";
} else {
    currencySymbol = ""; 
}

var totalFrgnTRIWhse = 0;
        if (item.inv1 && Array.isArray(item.inv1)) {
            item.inv1.forEach(function (subItem) {
                if (subItem.WhsCode === 'TRI Whse') {
                    totalFrgnTRIWhse += subItem.TotalFrgn;
                }
            });
        } else {
            totalFrgnTRIWhse = 25000;
        }

var finalTotal = item.DocTotalFC - totalFrgnTRIWhse;
var formattedFinalTotal = currencySymbol + '' + finalTotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    
var finalAmount = finalTotal - item.PaidFC;

    var usd = "";
    var euro = "";
    var php_t = "";
    var php_nt = "";

    var remarksButtonHtml = '';
    if (item.remark) {
        remarksButtonHtml = '<button type="button" class="btn btn-success btn-outline" title="Edit Remarks" data-toggle="modal" data-target="#edit_remarks' + item.remark.id + '" id="editRemarksBtn"><i class="fa fa fa-pencil"></i></button>';
    } else {
        remarksButtonHtml = '<button onclick="getDocEntry(' + JSON.stringify(item) + ');" type="button" class="btn btn-primary btn-outline" title="Add Remarks" data-toggle="modal" data-target="#add_remarks" id="addRemarksBtn"><i class="fa fa fa-plus"></i></button>';
    }

    if (item.DocCur === "USD") {
        // total_usd += finalAmount;
        // usd = finalAmount.toFixed(2);
        if (item.DocNum === '10338') {
                usd = 25000.00;
            } else {
                usd = finalAmount.toFixed(2);
            }
            total_usd += parseFloat(usd);
    } else if (item.DocCur === "EUR") {
        total_euro += finalAmount;
        euro = finalAmount.toFixed(2);
    } else if (item.DocCur === "PHP") {
        if (item.DocType === "I") {
            php_t = (item.DocTotal - item.PaidToDate).toFixed(2);
            total_php_t += parseFloat(php_t);
        } else if (item.DocType === "S") {
            php_nt = (item.DocTotal - item.PaidToDate).toFixed(2);
            total_php_nt += parseFloat(php_nt);
        }
    }

    var now = new Date();
    var your_date = new Date(item.U_DueDateAR);

    var currentDateUTC = Date.UTC(now.getFullYear(), now.getMonth(), now.getDate());
    var dueDateUTC = Date.UTC(your_date.getFullYear(), your_date.getMonth(), your_date.getDate());
    var daysDifference = Math.ceil((end_date - dueDateUTC) / (1000 * 60 * 60 * 24));
    var daysText = daysDifference + ' ' + (daysDifference === 1 ? 'day' : 'days');

    var status;
    if (daysDifference <= 0) {
        status = 'Current';
        total_current++;
    } else if (daysDifference >= 1 && daysDifference <= 30) {
        status = '1 to 30 days Late';
        total_month++;
    } else if (daysDifference >= 31 && daysDifference <= 60) {
        status = '31 to 60 days Late';
        total_twomonth++;
    } else if (daysDifference >= 61 && daysDifference <= 90) {
        status = '61 to 90 days Late';
        total_threemonth++;
    } else {
        status = 'Over 90 days Late';
        total_over_days++;
    }

    var remarksHtml = '';
    if (item.remark) {
        remarksHtml += item.remark.remarks + '<br>';
        remarksHtml += '<span style="font-size: 10px">Date Created: <span class="label label-primary">' + (item.remark.created_at) + '</span><br>';
        remarksHtml += '<span style="font-size: 10px">Date Updated: <span class="label label-warning">' + (item.remark.updated_at) + '</span>';
    } else {
        remarksHtml = 'N/A';
    }
   
    var row = '<tr>' +
        '<td align="center">' + remarksButtonHtml + '</td>' +
        '<td>' + item.CardName + '</td>' +
        '<td>' + item.U_invNo + '</td>' +
        '<td>' + item.NumAtCard + '</td>' +
        '<td>' + formattedFinalTotal + '</td>' +
        '<td>' + formatDate(item.DocDate) + '</td>' +
        '<td>' + item.terms.PymntGroup + '</td>' +
        '<td>' + (item.U_BaseDate ? formatDate(item.U_BaseDate) : "NA") + '</td>' +
        '<td>' + formatDate(item.U_DueDateAR) + '</td>' +
        '<td>' + (usd !== "" ? '$' + '' +parseFloat(usd).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}) : "NA") + '</td>' +
        '<td>' + (euro !== "" ? '€' + '' +parseFloat(euro).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}) : "NA") + '</td>' +
        '<td>' + (php_t !== "" ? '₱' + '' +parseFloat(php_t).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}) : "NA") + '</td>' +
        '<td>' + (php_nt !== "" ? '₱' + '' +parseFloat(php_nt).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}) : "NA") + '</td>' +
        '<td>' + daysText + '</td>' + 
        '<td>' + status + '</td>' + 
        '<td>' + item.DocRate + '</td>' +
        '<td>' + (finalAmount * item.DocRate).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}) + '</td>' +
        '<td>' + ((item.location && item.location.ocrg && item.location.ocrg.GroupName !== "") ? item.location.ocrg.GroupName : "NA") + '</td>' +
        '<td>' + item.manager.SlpName + '</td>' +
        '<td>' + remarksHtml + '</td>' +
        '</tr>';

    
    tableBody.append(row);
     $(window).trigger('resize');
});

function formatDate(dateString) {
    var date = new Date(dateString);
    var month = '' + (date.getMonth() + 1);
    var day = '' + date.getDate();
    var year = date.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [month, day, year].join('/');
}

var modalTitle = document.getElementById("modalTitle");
    var title = filterColumn;
    if (status) {
        title += " - " + status;
    }
    if (currency) {
        title += " - " + currency;
    }
    if (type) {
        title += " - " + (type === "S" ? "Non-Trade" : "Trade");
    }
    modalTitle.textContent = title;

}
function updateSessionStorage() {
        var endDate = document.getElementById('end_date').value;
        
        if (endDate) {
            sessionStorage.setItem('endDate', endDate);
        } else {
            sessionStorage.removeItem('endDate');
        }
    }

    function updateAgingDateFromSessionStorage() {
        var endDate = sessionStorage.getItem('endDate');

        if (endDate) {
            var endDateFormat = new Date(endDate);
            
            var formattedEndDate = endDateFormat.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });

            document.getElementById('aging_span').innerText = formattedEndDate;
        } 
        else {
            var currentDate = new Date();
        var formattedCurrentDate = currentDate.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
        document.getElementById('aging_span').innerText = formattedCurrentDate;
        }
    }

    updateAgingDateFromSessionStorage();


</script>

@endsection

