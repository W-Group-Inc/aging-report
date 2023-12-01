@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">AR Aging Report</div>
                <div class="card-body">
                    <div class="col-6">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-responsive">
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
                            @foreach ($invoices as $invoice)
                                {{-- {{dd($invoice)}} --}}
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
                                            $usd = number_format($final_amount,2);
                                        }
                                        elseif($invoice->DocCur == "EUR") {
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
                                            @if($invoice->DocType == "I") {{$php}}
                                            @else NA 
                                            @endif
                                        @else NA 
                                        @endif
                                    </td>
                                    <td>@if($invoice->DocCur == 'PHP')
                                            @if($invoice->DocType == "S") {{$php}} 
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
                                    <td>{{number_format($final_amount*$invoice->DocRate,2)}}</td> 
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="add_catalog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="{{url('new-catalog')}}">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Catalog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label>Name</label>
                        <input name="name" class="form-control" type="text" placeholder="Name" required>
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
@endsection
