@extends('layouts.header')
@section('css')
<link href="{{ asset('/inside/login_css/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="wrapper wrapper-content ">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">
                    <form  method='GET' onsubmit='show();'  enctype="multipart/form-data" >
                        <div class="row">
                            <div class="col-lg-3">
                                <select name='company' class='form-control' required>
                                    <option value=''>Company</option>
                                    <option value='WHI' @if($company == "WHI") selected @endif>WHI</option>
                                    <option value='PBI' @if($company == "PBI") selected @endif>PBI</option>
                                    <option value='CCC' @if($company == "CCC") selected @endif>CCC</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <button class="btn btn-primary mt-4" type="submit" id='submit'><i class="fa fa-check"></i>&nbsp;Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-success pull-right">as of Today</span>
                                    <h5>AR Aging</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins text-success">Current : <span id='total_current'>0</span></h1>
                                    <h1 class="no-margins text-info">1 to 30 days late : <span id='total_month'>0</span></h1>
                                    <h1 class="no-margins text-warning">31 to 60 days late : <span id='total_twomonth'>0</span></h1>
                                    <h1 class="no-margins text-warning">61 to 90 days late : <span id='total_threemonth'>0</span></h1>
                                    <h1 class="no-margins text-danger">Over 90 days late : <span id='total_over_days'>0</span></h1>
                                    {{-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> --}}
                                    <small>&nbsp;</small>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class='col-md-4'>
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-info pull-right">as of Today</span>
                                    <h5>Accounts Receivable</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins">Total PHP : <span id='total'>0.00</span> </h1>
                                    {{-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> --}}
                                    <small>&nbsp;</small>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-4'>
                            
                            <h4 class="no-margins">Total USD : <span id='total_usd'>0.00</span> </h4>
                            <h4 class="no-margins">Total EURO : <span id='total_euro'>0.00</span> </h4>
                            <h4 class="no-margins">Total PHP-T : <span id='total_php_t'>0.00</span> </h4>
                            <h4 class="no-margins">Total PHP-NT : <span id='total_php_nt'>0.00</span> </h4>
                        </div>
                        <div class='col-md-4'>
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
                            <h5>AR Aging Report </h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover tables">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Invoice Number</th>
                                            <th>Buyer's Mark</th>
                                            <th>Invoice Date</th>
                                            <th>Payment Term</th>
                                            <th>Baseline Date</th>
                                            <th>Invoice Due Date</th>
                                            <th>Invoice Amount in USD</th>
                                            <th>Invoice Amount in EUR</th>
                                            <th>Invoice Amount in PHP-T</th>
                                            <th>Invoice Amount in PHP-NT</th>
                                            <th>Days Late</th>
                                            <th>Aging Status</th>
                                            <th>Forex Rate</th>
                                            <th>Invoice PHP Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_usd = 0;
                                            $total_euro = 0;
                                            $total_php_t = 0;
                                            $total_php_nt = 0;
                                            $total_php = 0;
                                            $total_current = 0;
                                            $total_month = 0;
                                            $total_twomonth = 0;
                                            $total_threemonth = 0;
                                            $total_over_days = 0;
                                        @endphp
                                        @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>{{$invoice->CardName}}</td>
                                            <td>{{$invoice->NumAtCard}}</td>
                                            <td>{{$invoice->U_BuyerMark}}</td>
                                            <td>{{date('Y-m-d', strtotime($invoice->DocDate))}}</td>
                                            <td>{{$invoice->terms->PymntGroup}}</td>
                                            <td>@if($invoice->U_BaseDate != null){{date('Y-m-d', strtotime($invoice->U_BaseDate))}}@else NA @endif</td>
                                            <td>{{date('Y-m-d', strtotime($invoice->DocDueDate))}}</td>
                                            @php
                                            $final_amount = $invoice->DocTotalFC-$invoice->PaidFC;
                                            $usd = "";
                                            $euro = "";
                                            $php = "";
                                                if($invoice->DocCur == "USD")
                                                {
                                                    $total_usd = $total_usd + $final_amount;
                                                    $usd = number_format($final_amount,2);
                                                }
                                                elseif($invoice->DocCur == "EUR") {
                                                    $total_euro = $total_euro+$final_amount;
                                                    $euro = number_format($final_amount,2);
                                                }
                                                else {
                                                    $php = number_format($invoice->DocTotal - $invoice->PaidToDate,2);
                                                    $final_amount = $invoice->DocTotal - $invoice->PaidToDate;
                                                }
                                            @endphp
                                            <td>@if($usd != null){{$usd}} @else NA @endif</td>
                                            <td>@if($euro != null){{$euro}} @else NA @endif</td>
                                            <td>@if($invoice->DocCur == 'PHP')
                                                    @if($invoice->DocType == "I")
                                                        @php
                                                            $total_php_t = $total_php_t + $invoice->DocTotal - $invoice->PaidToDate; 
                                                        @endphp {{$php}}
                                                    @else NA 
                                                    @endif
                                                @else NA 
                                                @endif
                                            </td>
                                            <td>@if($invoice->DocCur == 'PHP')
                                                    @if($invoice->DocType == "S") 
                                                        @php
                                                            $total_php_nt = $total_php_nt + $invoice->DocTotal - $invoice->PaidToDate; 
                                                        @endphp 
                                                    {{$php}}
                                                    @else NA 
                                                    @endif
                                                @else NA 
                                                @endif
                                            </td>
                                            @php
                                                $now = time(); // or your date as well
                                                $your_date = strtotime(date('Y-m-d', strtotime($invoice->DocDueDate)));
                                                $datediff = $now - $your_date
                                            @endphp
                                            <td>{{round($datediff / (60 * 60 * 24)). " days"}}</td>
                                            @php
                                                if (round($datediff / (60 * 60 * 24)) <= 0) {
                                                    $total_current++;
                                                    $status = 'Current';
                                                }
                                                elseif ((round($datediff / (60 * 60 * 24)) >= 1) && (round($datediff / (60 * 60 * 24)) <= 30))
                                                {
                                                    $status = '1  to 30 days Late';
                                                    
                                                    $total_month++;
                                                }
                                                elseif ((round($datediff / (60 * 60 * 24)) >= 31) && (round($datediff / (60 * 60 * 24)) <= 60))
                                                {
                                                    $status = '31  to 60 days Late';
                                                    $total_twomonth++;
                                                }
                                                elseif ((round($datediff / (60 * 60 * 24)) >= 61) && (round($datediff / (60 * 60 * 24)) <= 90))
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
                                            <td>{{$invoice->DocRate}}</td>
                                            @php
                                                $total_php = $final_amount*$invoice->DocRate + $total_php;
                                            @endphp
                                            <td>{{number_format($final_amount*$invoice->DocRate,2)}}</td> 
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        
                                            <td colspan='7' class='text-right'>Total Account Receivables</td>
                                            <td>{{number_format($total_usd,2)}}</td>
                                            <td>{{number_format($total_euro,2)}}</td>
                                            <td>{{number_format($total_php_t,2)}}</td>
                                            <td>{{number_format($total_php_nt,2)}}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>{{number_format($total_php,2)}}</td>
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
    var total_current = {!! json_encode($total_current) !!};
    var total_month = {!! json_encode($total_month) !!};
    var total_twomonth = {!! json_encode($total_twomonth) !!};
    var total_threemonth = {!! json_encode($total_threemonth) !!};
    var total_over_days = {!! json_encode($total_over_days) !!};
    var total = {!! json_encode($total_php) !!};
    var total_usd = {!! json_encode($total_usd) !!};
    var total_euro = {!! json_encode($total_euro) !!};
    var total_php_t = {!! json_encode($total_php_t) !!};
    var total_php_nt = {!! json_encode($total_php_nt) !!};
    document.getElementById("total_current").innerHTML = total_current;
    document.getElementById("total_month").innerHTML = total_month;
    document.getElementById("total_twomonth").innerHTML = total_twomonth;
    document.getElementById("total_threemonth").innerHTML = total_threemonth;
    document.getElementById("total_over_days").innerHTML = total_over_days;
    document.getElementById("total").innerHTML = total;
    document.getElementById("total_usd").innerHTML = total_usd;
    document.getElementById("total_euro").innerHTML = total_euro;
    document.getElementById("total_php_t").innerHTML = total_php_t;
    document.getElementById("total_php_nt").innerHTML = total_php_nt;
    $(document).ready(function(){
        

        $('.cat').chosen({width: "100%"});
        $('.tables').DataTable({
            pageLength: -1,
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

