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
                            <form method="GET" action="{{ url('ccc_bir_sales_invoice') }}" class="form-inline" style="margin-bottom: 15px;">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search Invoices" value="{{ request('search') }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                            <div class="table-responsive">
                                <table id='table' class="table table-striped table-bordered table-hover bir_invoices_whi" style="margin-bottom: 0px !important;">
                                    <thead>
                                        <tr>
                                            <th>Zero Rate</th>
                                            <th>Vatable Sales</th>
                                            <th>Dated</th>
                                            <th>Sold To</th>
                                            <th>Address</th>
                                            <th>Buyer's PO No.</th>
                                            <th>Buyer's Ref. No.</th>
                                           
                                        </tr>
                                    </thead>
                                   <tbody>
                                    @foreach ( $details as $detail)
                                        <tr>
                                            <td>
                                                <a target='_blank' href="{{ url('ccc_bir_original_sales_invoice_zero_rate', $detail->DocEntry) }}" class="btn btn-danger btn-outline" > <i class="fa fa-solid fa-print"></i></a>
                                            </td>
                                            <td>
                                                <a target='_blank' href="{{ url('ccc_bir_original_sales_invoice_vatable', $detail->DocEntry) }}" class="btn btn-danger btn-outline" > <i class="fa fa-solid fa-print"></i></a>
                                            </td>        
                                            <td>{{ $detail->DocDate }}</td>
                                            <td>{{ $detail->PayToCode }}</td>
                                            <td>{{ $detail->Address }}</td>
                                            <td>{{ $detail->U_BuyersPO }}</td>
                                            <td>{{ $detail->NumAtCard }}</td>
                                            {{-- <td>{{ $detail->U_Salescontract }}</td> --}}
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

   

    // $(document).ready(function(){

    //     // $('.cat').chosen({width: "100%"});
    //     $('.bir_invoices_whi').DataTable({
    //         pageLength: 15,
    //         fixedHeader: true,
    //         scrollX: true,
    //         scrollY: 700,   
    //         scrollCollapse: true,
    //         paging: true,
    //         paginate: false,
    //         responsive: true,
    //         dom: '<"html5buttons"B>lTfgitp',
    //         buttons: [
    //             {extend: 'csv', title: 'Aging Report'},
    //             // {extend: 'excel', title: 'Aging Report'}
    //         ]

    //     });
    // });
</script>
@foreach ( $details as $detail)
{{-- @include('print_templates.print_lists.ccc.bir_commercial_list_edit')
@include('print_templates.print_lists.ccc.bir_commercial_list_edit_new') --}}
@endforeach
@endsection

