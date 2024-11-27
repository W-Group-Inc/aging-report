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
                            <h5>Credit Notes</h5>
                        </div>
                        <div class="ibox-content">
                            <form method="GET" action="{{ url('credit_note_ccc') }}" class="form-inline" style="margin-bottom: 15px;">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search Invoices" value="{{ request('search') }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                            <div class="table-responsive" style="width: 100%">
                                <table id='' class="table table-striped table-bordered table-hover credit_note_whi" style="margin-bottom: 0px !important;">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Invoice Number</th>
                                            <th>Sold To</th>
                                            <th>Address</th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                    @foreach ( $details as $detail)
                                        <tr>
                                            <td>
                                                @if ($detail->NewCreditNote)
                                                    <button onclick="" type="button" class="btn btn-primary btn-outline" title="Edit Invoice" data-toggle="modal" data-target="#NewCreditNoteEdit{{ $detail->NewCreditNote->id }}" ><i class="fa fa fa-pencil"></i></button>
                                                    @include('print_templates.ccc.credit_note.new_credit_note_edit')
                                                    <a target='_blank' href="{{ url('credit_note_internal_ccc', $detail->NewCreditNote->id) }}" class="btn btn-warning btn-outline" > <i class="fa fa-sharp fa-print"></i></a>
                                                @else
                                                    <button  type="button" class="btn btn-primary btn-outline" title="Edit Invoice" data-toggle="modal" data-target="#NewCreditNote{{ $detail->DocEntry }}" ><i class="fa fa fa-plus"></i></button>
                                                    @include('print_templates.ccc.credit_note.new_credit_note')
                                                @endif
                                                {{-- <a target='_blank' href="{{ url('bir_original_commercial_invoice', $detail->U_invNo) }}" class="btn btn-danger btn-outline" > <i class="fa fa-solid fa-print"></i></a> --}}
                                            </td>    
                                            <td>{{ $detail->NumAtCard }}</td>
                                            <td>{{ $detail->PayToCode }}</td>
                                            <td>{{ $detail->Address }}</td>
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

   

    $(document).ready(function(){

        // $('.cat').chosen({width: "100%"});
        // $('.credit_note_whi').DataTable({
        //     pageLength: 15,
        //     fixedHeader: true,
        //     scrollX: true,
        //     scrollY: 700,   
        //     scrollCollapse: true,
        //     paging: true,
        //     paginate: false,
        //     responsive: true,
        //     dom: '<"html5buttons"B>lTfgitp',
        //     buttons: [
        //         {extend: 'csv', title: 'Aging Report'},
        //         // {extend: 'excel', title: 'Aging Report'}
        //     ]

        // });
    });
</script>
@foreach ( $details as $detail)

@endforeach
@endsection

