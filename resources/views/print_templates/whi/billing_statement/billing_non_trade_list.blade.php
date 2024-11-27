@extends('layouts.header')
@section('css')
<link href="{{ asset('/inside/login_css/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
<link href="{{ asset('/inside/login_css/css/style.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection
@section('content')
<style>
</style>
<div class="wrapper wrapper-content ">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox ">
                                {{-- <div class="ibox-content">
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
                                                <h3 id="aging_date">Monthly Sales For:</h3> 
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="month-picker">Month:</label>
                                                        <select id="month-picker" name="month" class="form-control" required>
                                                            <option value="" disabled selected>Select a month</option>
                                                            @for ($m = 1; $m <= 12; $m++)
                                                                <option value="{{ sprintf('%02d', $m) }}" {{ Request::get('month') == sprintf('%02d', $m) ? 'selected' : '' }}>
                                                                    {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <label for="year-picker">Year:</label>
                                                            <input type="text" id="year-picker" name="year" value="{{ Request::get('year') }}" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <button class="btn btn-primary mt-4" type="submit" id='submit' style="margin-top: 14px;">Generate</button>
                                            </div>
                                        </div>
                                    </form>
                                </div> --}}
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
                            <h5>Invoices</h5>
                        </div>
                        <div class="ibox-content">
                            <form method="GET" action="{{ url('billing_statement_list') }}" class="form-inline" style="margin-bottom: 15px;">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search Invoices" value="{{ request('search') }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                            <div class="table-responsive">
                                <table id='table' class="table table-striped table-bordered table-hover whi_non_trade_billing" style="margin-bottom: 0px !important;">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>SOA</th>
                                            <th>BILLED TO</th>
                                            <th>DATE</th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                    @foreach ( $details as $detail)
                                        <tr>
                                            <td>
                                                @if ($detail->newNonTrade)
                                                    <button onclick="" type="button" class="btn btn-primary btn-outline" title="Edit Invoice" data-toggle="modal" data-target="#editNewNonTrade{{ $detail->newNonTrade->id }}" ><i class="fa fa fa-pencil"></i></button>
                                                    @include('print_templates.whi.billing_statement.non_trade_edit_new')
                                                    <a target='_blank' href="{{ url('billing_statement_non_trade_print', $detail->newNonTrade->id) }}" class="btn btn-warning btn-outline" > <i class="fa fa-sharp fa-print"></i></a>
                                                @else
                                                    <button onclick="" type="button" class="btn btn-primary btn-outline" title="Edit Invoice" data-toggle="modal" data-target="#editNonTrade{{ $detail->DocEntry }}" ><i class="fa fa fa-plus"></i></button>
                                                    @include('print_templates.whi.billing_statement.non_trade_edit')
                                                @endif
                                            </td>       
                                            <td>{{ $detail->U_invNo }}</td>
                                            <td>{{ $detail->CardName }}</td>
                                            <td>{{ $detail->DocDate }}</td>
                                        </tr>
                                    @endforeach
                                   </tbody>
                                </table>
                                <div class="pagination-wrapper">
                                    {{ $details->links() }}
                                </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> 
<script>

   

    //  $(document).ready(function(){

    //       $('.cat').chosen({width: "100%"});
    //      $('.whi_non_trade_billing').DataTable({
    //          pageLength: 15,
    //          fixedHeader: true,
    //          scrollX: true,
    //          scrollY: 700,   
    //          scrollCollapse: true,
    //          paging: true,
    //          paginate: false,
    //          responsive: true,
    //          dom: '<"html5buttons"B>lTfgitp',
    //          buttons: [
    //              {extend: 'csv', title: 'Aging Report'},
    //             //   {extend: 'excel', title: 'Aging Report'}
    //          ]

    //      });
    //  });
</script>
@endsection

