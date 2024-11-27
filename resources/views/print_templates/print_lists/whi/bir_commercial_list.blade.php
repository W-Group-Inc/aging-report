@php
    use Illuminate\Support\Str;
@endphp
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
                            <form method="GET" action="{{ url('whi_bir_invoice') }}" class="form-inline" style="margin-bottom: 15px;">
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
                                            <th>VAT Exempt</th>
                                            {{-- <th>Invoice Number</th> --}}
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
                                            @if (Str::contains($detail->NumAtCard, 'FMI'))
                                            <td>
                                                @if ($detail->asNew)
                                                    <button onclick="" type="button" class="btn btn-primary btn-outline" title="Edit Invoice" data-toggle="modal" data-target="#birCommercialEditNew{{ $detail->asNew->id }}" ><i class="fa fa fa-pencil"></i></button>
                                                    <a target='_blank' href="{{ url('whi_bir_edited_commercial_invoice', $detail->asNew->id) }}" class="btn btn-warning btn-outline" > <i class="fa fa-sharp fa-print"></i></a>
                                                @else
                                                    <button onclick="" type="button" class="btn btn-primary btn-outline" title="Edit Invoice" data-toggle="modal" data-target="#birCommercialEdit{{ $detail->DocEntry }}" ><i class="fa fa fa-plus"></i></button>
                                                @endif
                                                <a target='_blank' href="{{ url('bir_original_unique_commercial_invoice', $detail->DocEntry) }}" class="btn btn-danger btn-outline" > <i class="fa fa-solid fa-print"></i></a>
                                            </td>
                                            <td>
                                                @if ($detail->asNew)
                                                <a target='_blank' href="{{ url('whi_bir_edited_commercial_vatable_invoice', $detail->asNew->id) }}" class="btn btn-warning btn-outline" > <i class="fa fa-sharp fa-print"></i></a>
                                                @endif
                                                <a target='_blank' href="{{ url('bir_original_unique_commercial_vatable_invoice', $detail->DocEntry) }}" class="btn btn-danger btn-outline" > <i class="fa fa-solid fa-print"></i></a>
                                            </td>
                                            <td>
                                                @if ($detail->asNew)
                                                <a target='_blank' href="{{ url('whi_bir_edited_commercial_exempt_invoice', $detail->asNew->id) }}" class="btn btn-warning btn-outline" > <i class="fa fa-sharp fa-print"></i></a>
                                                @endif
                                                <a target='_blank' href="{{ url('bir_original_unique_commercial_exempt_invoice', $detail->DocEntry) }}" class="btn btn-danger btn-outline" > <i class="fa fa-solid fa-print"></i></a>
                                            </td> 
                                            @else 
                                            <td>
                                                @if ($detail->asNew)
                                                    <button onclick="" type="button" class="btn btn-primary btn-outline" title="Edit Invoice" data-toggle="modal" data-target="#birCommercialEditNew{{ $detail->asNew->id }}" ><i class="fa fa fa-pencil"></i></button>
                                                    <a target='_blank' href="{{ url('whi_bir_edited_commercial_invoice', $detail->asNew->id) }}" class="btn btn-warning btn-outline" > <i class="fa fa-sharp fa-print"></i></a>
                                                @else
                                                    <button onclick="" type="button" class="btn btn-primary btn-outline" title="Edit Invoice" data-toggle="modal" data-target="#birCommercialEdit{{ $detail->DocEntry }}" ><i class="fa fa fa-plus"></i></button>
                                                @endif
                                                <a target='_blank' href="{{ url('bir_original_commercial_invoice', $detail->DocEntry) }}" class="btn btn-danger btn-outline" > <i class="fa fa-solid fa-print"></i></a>
                                            </td>
                                            <td>
                                                @if ($detail->asNew)
                                                <a target='_blank' href="{{ url('whi_bir_edited_commercial_vatable_invoice', $detail->asNew->id) }}" class="btn btn-warning btn-outline" > <i class="fa fa-sharp fa-print"></i></a>
                                                @endif
                                                <a target='_blank' href="{{ url('bir_original_commercial_vatable_invoice', $detail->DocEntry) }}" class="btn btn-danger btn-outline" > <i class="fa fa-solid fa-print"></i></a>
                                            </td>
                                            <td>
                                                @if ($detail->asNew)
                                                <a target='_blank' href="{{ url('whi_bir_edited_commercial_exempt_invoice', $detail->asNew->id) }}" class="btn btn-warning btn-outline" > <i class="fa fa-sharp fa-print"></i></a>
                                                @endif
                                                <a target='_blank' href="{{ url('bir_original_commercial_exempt_invoice', $detail->DocEntry) }}" class="btn btn-danger btn-outline" > <i class="fa fa-solid fa-print"></i></a>
                                            </td> 
                                            @endif           
                                            {{-- <td>{{ $detail->U_invNo }}</td> --}}
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
@include('print_templates.print_lists.whi.bir_commercial_list_edit')
@include('print_templates.print_lists.whi.bir_commercial_list_edit_new')
@endforeach
@endsection

