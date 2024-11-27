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
                            <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#new_pbi_credit_note">New</button>
                            @include('print_templates.pbi.credit_note.create')
                            <div class="table-responsive">
                                <table id='table' class="table table-striped table-bordered table-hover pbi_pbi_credit_note" style="margin-bottom: 0px !important; width:100%;">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Date</th>
                                            <th>Invoice Number</th>
                                            <th>Customer</th>       
                                        </tr>
                                    </thead>
                                   <tbody>
                                    @foreach ($details as $detail)
                                        <tr>
                                            <td>
                                                @if ($detail->id)
                                                <button onclick="" type="button" class="btn btn-primary btn-outline" title="Edit Invoice" data-toggle="modal" data-target="#EditCreditNote{{ $detail->id }}" ><i class="fa fa fa-pencil"></i></button>
                                                @endif
                                                <a target='_blank' href="{{ url('pbi_print_credit_note', $detail->id) }}" class="btn btn-danger btn-outline" > <i class="fa fa-solid fa-print"></i></a></td>
                                            <td>{{ $detail->date }}</td>
                                            <td>{{ $detail->credit_note_no }}</td>
                                            <td>{{ $detail->client }}</td>
                                        </tr>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>

   

    $(document).ready(function(){

        // $('.cat').chosen({width: "100%"});
        $('.pbi_pbi_credit_note').DataTable({
            pageLength: 15,
            fixedHeader: true,
            scrollX: true,
            scrollY: 700,   
            scrollCollapse: true,
            paging: true,
            paginate: false,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'csv', title: 'PBI Debit Memo'},
                // {extend: 'excel', title: 'Aging Report'}
            ]

        });
    });
</script>

@foreach ($details as $detail)
@include('print_templates.pbi.credit_note.edit')
@endforeach
@endsection

