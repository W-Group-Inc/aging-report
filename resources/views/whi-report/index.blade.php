@extends('layouts.header')
@section('css')
<link href="{{ asset('/inside/login_css/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="wrapper wrapper-content ">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">as of Today</span>
                            <h5>Current</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{count($invoices->where('DocDueDate','<=',date('Y-m-d')))}}</h1>
                            {{-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> --}}
                            <small>&nbsp;</small>
                        </div>
                    </div>
                </div>
                @php
                    $day_after = date('Y-m-d',strtotime('+1 days',strtotime(date('Y-m-d'))));
                    $month = date('Y-m-d',strtotime('+30 days',strtotime(date('Y-m-d'))));
                    $monthday = date('Y-m-d',strtotime('+31 days',strtotime(date('Y-m-d'))));
                    $twomonths = date('Y-m-d',strtotime('+60 days',strtotime(date('Y-m-d'))));
                    $twomonthsday = date('Y-m-d',strtotime('+61 days',strtotime(date('Y-m-d'))));
                    $threemonths = date('Y-m-d',strtotime('+90 days',strtotime(date('Y-m-d'))));
                    $threemonthsday = date('Y-m-d',strtotime('+91 days',strtotime(date('Y-m-d'))));
                @endphp
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-warning pull-right">as of Today</span>
                            <h5>1 to 30 days late</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{count($invoices->whereBetween('DocDueDate',[$day_after,$month]))}}</h1>
                            {{-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> --}}
                            <small>&nbsp;</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-info pull-right">as of Today</span>
                            <h5>31 to 60 days late</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{count($invoices->whereBetween('DocDueDate',[$monthday,$twomonths]))}}</h1>
                            {{-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> --}}
                            <small>&nbsp;</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-info pull-right">as of Today</span>
                            <h5>61 to 90 days late</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{count($invoices->whereBetween('DocDueDate',[$twomonthsday,$threemonths]))}}</h1>
                            {{-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> --}}
                            <small>&nbsp;</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-danger pull-right">as of Today</span>
                            <h5>Over 90 days late</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{count($invoices->where('DocDueDate','>',$threemonthsday))}}</h1>
                            {{-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> --}}
                            <small>&nbsp;</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-info pull-right">as of Today</span>
                            <h5>Accounts Receivable</h5>
                        </div>
                        <div class="ibox-content">
                            <h4 class="no-margins">PHP : <span id='total'>0.00</span> </h4>
                            {{-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> --}}
                            <small>&nbsp;</small>
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
                                                    $status = 'Current';
                                                }
                                                elseif ((round($datediff / (60 * 60 * 24)) >= 1) && (round($datediff / (60 * 60 * 24)) <= 30))
                                                {
                                                    $status = '1  to 30 days Late';
                                                }
                                                elseif ((round($datediff / (60 * 60 * 24)) >= 31) && (round($datediff / (60 * 60 * 24)) <= 60))
                                                {
                                                    $status = '31  to 60 days Late';
                                                }
                                                elseif ((round($datediff / (60 * 60 * 24)) >= 61) && (round($datediff / (60 * 60 * 24)) <= 90))
                                                {
                                                    $status = '61  to 90 days Late';
                                                }
                                                else
                                                {
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

