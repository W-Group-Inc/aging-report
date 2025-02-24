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
                            <h5>SOA</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="d-flex align-items-center flex-wrap">
                                <form method="GET" action="{{ url('pbi_soa_list') }}" class="form-inline d-flex align-items-center me-3">
                                    <div class="form-group me-2">
                                        <input type="text" name="search" class="form-control" placeholder="Search Invoices" value="{{ request('search') }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </form>
                                <div style="display: flex; align-items: center; flex-wrap: nowrap; margin: 10px;">
                                    <div style="margin-right: 10px; font-weight: bold;">Legend:</div>
                                    <div style="display: flex; align-items: center; margin-right: 10px;">
                                        <span class="btn btn-danger btn-outline px-2 py-1" style="padding: 2px 6px; border-radius: 4px; margin-right: 5px;">
                                            <i class="fa fa-solid fa-print"></i>
                                        </span> Zero Rated
                                    </div>
                                    <div style="display: flex; align-items: center; margin-right: 10px;">
                                        <span class="btn btn-success btn-outline px-2 py-1" style="padding: 2px 6px; border-radius: 4px; margin-right: 5px;">
                                            <i class="fa fa-solid fa-print"></i>
                                        </span> Vatable
                                    </div>
                                    <div style="display: flex; align-items: center;">
                                        <span class="btn btn-info btn-outline px-2 py-1" style="padding: 2px 6px; border-radius: 4px; margin-right: 5px;">
                                            <i class="fa fa-solid fa-print"></i>
                                        </span> Exempt
                                    </div>
                                </div>                                                            
                            </div>
                            <div class="table-responsive">
                                <table id='table' class="table table-striped table-bordered table-hover bir_invoices_whi" style="margin-bottom: 0px !important;">
                                    <thead>
                                        <tr>
                                            <th>PHP</th>
                                            <th>EUR</th>
                                            {{-- <th>Invoice Number</th> --}}
                                            <th>Date</th>
                                            <th>Buyer's Ref No.</th>
                                            <th>Buyer's PO No.</th>
                                            <th>History Logs</th>
                                           
                                        </tr>
                                    </thead>
                                   <tbody>
                                    @foreach ( $details as $detail)
                                        <tr>
                                            <td>
                                                @if ($detail->asNew)
                                                    <button onclick="" type="button" class="btn btn-primary btn-outline" title="Edit Invoice" data-toggle="modal" data-target="#soaCommercialEditedPbi{{ $detail->asNew->id }}" ><i class="fa fa fa-pencil"></i></button>
                                                    @if ($detail->asNew->Type == 'zero_rated')
                                                        <a target='_blank' href="{{ url('pbi_php_soa', $detail->asNew->id) }}" class="btn btn-danger btn-outline" > <i class="fa fa-sharp fa-print"></i></a>
                                                    @elseif ($detail->asNew->Type == 'vatable')
                                                        <a target='_blank' href="{{ url('pbi_php_soa', $detail->asNew->id) }}" class="btn btn-success btn-outline" > <i class="fa fa-sharp fa-print"></i></a>
                                                    @else
                                                        <a target='_blank' href="{{ url('pbi_php_soa', $detail->asNew->id) }}" class="btn btn-info btn-outline" > <i class="fa fa-sharp fa-print"></i></a>
                                                    @endif
                                                @else
                                                    <button onclick="" type="button" class="btn btn-primary btn-outline" title="Edit Invoice" data-toggle="modal" data-target="#soaCommercialEditPbi{{ $detail->DocEntry }}" ><i class="fa fa fa-plus"></i></button>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($detail->asNew)
                                                    @if ($detail->asNew->Type == 'zero_rated')
                                                        <a target='_blank' href="{{ url('pbi_eur_soa', $detail->asNew->id) }}" class="btn btn-danger btn-outline" > <i class="fa fa-sharp fa-print"></i></a>
                                                    @elseif ($detail->asNew->Type == 'vatable')
                                                        <a target='_blank' href="{{ url('pbi_eur_soa', $detail->asNew->id) }}" class="btn btn-success btn-outline" > <i class="fa fa-sharp fa-print"></i></a>
                                                    @else
                                                        <a target='_blank' href="{{ url('pbi_eur_soa', $detail->asNew->id) }}" class="btn btn-info btn-outline" > <i class="fa fa-sharp fa-print"></i></a>
                                                    @endif
                                                @endif
                                            </td>          
                                            <td>{{ $detail->DocDueDate }}</td>
                                            <td>{{ $detail->NumAtCard }}</td>
                                            <td>{{ $detail->U_BuyersPO }}</td>
                                            <td>
                                                @if ($detail->asNew)
                                                    <button type="button" class="btn btn-info btn-outline" data-toggle="modal" data-target="#historyModal{{ $detail->asNew->id }}">
                                                        <i class="fa fa-history"></i> View Logs
                                                   </button>
                                
                                                    <div class="modal fade" id="historyModal{{ $detail->asNew->id }}" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">History Logs for Invoice</h5>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table class="table table-bordered">
                                                                        <tr>
                                                                            <th>User</th>
                                                                            <th>Action</th>
                                                                            {{-- <th>Old Values</th> --}}
                                                                            {{-- <th>Values</th> --}}
                                                                            <th>Date</th>
                                                                        </tr>
                                                                        @foreach ($detail->asNew->auditHistory as $audit)
                                                                            <tr>
                                                                                <td>{{ $audit->user->name }}</td>
                                                                                <td>{{ $audit->event }}</td>
                                                                                {{-- <td>
                                                                                    @if(!empty($audit->new_values))
                                                                                        
                                                                                    @endif
                                                                                </td> --}}
                                                                                <td>{{ $audit->created_at }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
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

@foreach ( $details as $detail)
@include('print_templates.pbi.soa.soa_commercial_invoice_edit')
@include('print_templates.pbi.soa.soa_commercial_invoice_edited')
@endforeach
@endsection

