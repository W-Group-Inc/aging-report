@extends('layouts.header')
@section('css')
<link href="{{ asset('/inside/login_css/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
<link href="{{ asset('/inside/login_css/css/style.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection
@section('content')
<style>
    .table-modal-responsive {
    position: relative;
    height: 400px; 
    overflow: auto;
    display: inline-block;
    width: 100%;
    }

    .table-modal-responsive .invoiceTable thead th {
    position: sticky;
    top: 0;
    background-color: #fff; 
    z-index: 2;
    }

</style>
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
                                                <h3 id="aging_date">Monthly Sales:&nbsp;<span id="aging_span"></span></h3> 
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
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>AR Aging Report </h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table id='table' class="table table-striped table-bordered table-hover monthly_sales_table" style="margin-bottom: 0px !important;">
                                    <thead>
                                        <tr>
                                            <th>Invoice Date</th>
                                            <th>Invoice Number</th>
                                            <th>Buyer's Mark</th>
                                            <th>Customer Name</th>
                                            <th>Invoice USD VALUE (T)</th>
                                            <th>Invoice USD VALUE (NT)</th>
                                            <th>Invoice EUR VALUE (T)</th>
                                            <th>Invoice EUR VALUE (NT)</th>
                                            <th>Invoice PHP VALUE (T)</th>
                                            <th>Invoice PHP VALUE (NT)</th>
                                            <th>Total Peso Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $finalTotal = 0;
                                            $totalUsdTfinalTotal = 0;
                                            $totalUsdNTfinalTotal = 0;
                                            $totalEurTfinalTotal = 0;
                                            $totalEurNTfinalTotal = 0;
                                            $totalPhpTfinalTotal = 0;
                                            $totalPhpNTfinalTotal = 0;
                                            $totalPhpValue = 0;
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
                                        @php
                                            $containsTriWhse = false;
                                            $containsVat = false;
                                            if (is_iterable($invoice->inv1)) {
                                                foreach ($invoice->inv1 as $item) {
                                                    if (strcasecmp($item->WhsCode, 'TRI Whse') === 0) {
                                                        $containsTriWhse = true;
                                                    }

                                                    if (strcasecmp($item->WhsCode, 'VAT') === 0) {
                                                        $containsVat = true;
                                                    }

                                                    if ($containsTriWhse && $containsVat) {
                                                        break;
                                                    }
                                                }
                                            }
                                        @endphp
                                    @if (!$containsTriWhse || ($containsTriWhse && $containsVat))
                                        <tr>
                                            <td>{{date('m/d/Y', strtotime($invoice->DocDate))}}</td>
                                            <td>{{$invoice->U_invNo}}</td>
                                            <td>{{$invoice->NumAtCard}}</td>
                                            <td>{{$invoice->CardName}}</td>
                                            <td> <?php
                                                $currencySymbol = '';
                                                if ($invoice->DocCur === 'USD') {
                                                    $currencySymbol = '$';
                                                } else {
                                                    $currencySymbol = '';
                                                }
                                                $totalFrgnTRIWhse = 0;

                                                if ($invoice->DocType === "I") {
                                                    if ($invoice->DocCur === 'USD') {
                                                    if ($company === 'WHI') {
                                                    foreach ($invoice->inv1 as $item) {
                                                        if ($item->WhsCode === 'TRI Whse') {
                                                            $totalFrgnTRIWhse += $item->TotalFrgn;
                                                        }
                                                    }
                                                    // $finalTotal = $invoice->DocTotalFC + $invoice->DpmAmntFC - $totalFrgnTRIWhse;
                                                    if (!empty($invoice->WTSumFC) && $invoice->WTSumFC != 0) {
                                                        $finalTotal = $invoice->DocTotalFC + $invoice->DpmAmntFC - $totalFrgnTRIWhse + $invoice->WTSumFC;
                                                    } else {
                                                        $finalTotal = $invoice->DocTotalFC + $invoice->DpmAmntFC - $totalFrgnTRIWhse;
                                                    }
                                                } else {
                                                    $finalTotal = $invoice->DocTotalFC + $invoice->DpmAmntFC;
                                                }

                                                echo $currencySymbol . '' . number_format($finalTotal, 2);
                                                $totalUsdTfinalTotal += $finalTotal;

                                                } else{
                                                    '';
                                                }
                                                }
                                                ?>
                                            </td>
                                            <td> <?php
                                                $currencySymbol = '';
                                                if ($invoice->DocCur === 'USD') {
                                                    $currencySymbol = '$';
                                                } else {
                                                    $currencySymbol = '';
                                                }
                                                $totalFrgnTRIWhse = 0;
                                                if ($invoice->DocType === "S") {
                                                    if ($invoice->DocCur === 'USD') {
                                                    if ($company === 'WHI') {
                                                    foreach ($invoice->inv1 as $item) {
                                                        if ($item->WhsCode === 'TRI Whse') {
                                                            $totalFrgnTRIWhse += $item->TotalFrgn;
                                                        }
                                                    }
                                                        $finalTotal = $invoice->DocTotalFC + $invoice->DpmAmntFC - $totalFrgnTRIWhse;
                                                } else {
                                                        $finalTotal = $invoice->DocTotalFC + $invoice->DpmAmntFC;
                                                }
    
                                                    echo $currencySymbol . '' . number_format($finalTotal, 2);
                                                    $totalUsdNTfinalTotal += $finalTotal;
                                                } else{
                                                        '';
                                                    }
                                                    }
                                                    ?>
                                                </td>
                                            <td> <?php
                                                $currencySymbol = '';
                                                if ($invoice->DocCur === 'EUR') {
                                                    $currencySymbol = '€';
                                                } else {
                                                    $currencySymbol = '';
                                                }
                                                $totalFrgnTRIWhse = 0;
                                                if ($invoice->DocType === "I") {
                                                    if ($invoice->DocCur === 'EUR') {
                                                    if ($company === 'WHI') {
                                                    foreach ($invoice->inv1 as $item) {
                                                        if ($item->WhsCode === 'TRI Whse') {
                                                            $totalFrgnTRIWhse += $item->TotalFrgn;
                                                        }
                                                    }
                                                    $finalTotal = $invoice->DocTotalFC + $invoice->DpmAmntFC - $totalFrgnTRIWhse;
                                                } else {
                                                    $finalTotal = $invoice->DocTotalFC + $invoice->DpmAmntFC;
                                                }
                                                   echo $currencySymbol . '' . number_format($finalTotal, 2);
                                                   $totalEurTfinalTotal += $finalTotal;
                                                } else{
                                                    '';
                                                }
                                                }
                                                ?>
                                            </td>
                                            <td> <?php
                                                    $currencySymbol = '';
                                                    if ($invoice->DocCur === 'EUR') {
                                                    $currencySymbol = '€';
                                                    } else {
                                                        $currencySymbol = '';
                                                    }
                                                    $totalFrgnTRIWhse = 0;
                                                        if ($invoice->DocType === "S") {
                                                        if ($invoice->DocCur === 'EUR') {
                                                        if ($company === 'WHI') {
                                                        foreach ($invoice->inv1 as $item) {
                                                            if ($item->WhsCode === 'TRI Whse') {
                                                                $totalFrgnTRIWhse += $item->TotalFrgn;
                                                            }
                                                        }
                                                        $finalTotal = $invoice->DocTotalFC + $invoice->DpmAmntFC - $totalFrgnTRIWhse;
                                                            } else {
                                                                $finalTotal = $invoice->DocTotalFC + $invoice->DpmAmntFC;
                                                            }
            
                                                            echo $currencySymbol . '' . number_format($finalTotal, 2);
                                                            $totalEurNTfinalTotal += $finalTotal;

                                                            } else{
                                                                '';
                                                            }
                                                            }
                                                            ?>
                                            </td>
                                            <td>
                                                @php
                                                    if($invoice->DocCur == 'PHP'){
                                                        if($invoice->DocType == "I") {
                                                            $finalTotal = (float) $invoice->DocTotal;
                                                            $formattedTotal = number_format($finalTotal, 2); 
                                                            
                                                            echo '₱' . $formattedTotal;
                                                            $totalPhpTfinalTotal += $finalTotal; 
                                                        } else {
                                                            
                                                        }
                                                    }   
                                                @endphp
                                            </td>
                                            <td>
                                                @php
                                                    if($invoice->DocCur == 'PHP'){
                                                        if($invoice->DocType == "S") {
                                                            $finalTotal = (float) $invoice->DocTotal;
                                                            $formattedTotal = number_format($finalTotal, 2); 
                                                            
                                                            echo '₱' . $formattedTotal;
                                                            $totalPhpNTfinalTotal += $finalTotal; 
                                                        } else {
                                                            
                                                        }
                                                    }   
                                                @endphp
                                            </td>
                                            <td>
                                                {{-- @if ($invoice->DocCur == 'PHP')
                                                {{number_format($invoice->DocTotal*$invoice->DocRate,2)}}
                                                @else
                                                {{number_format($finalTotal*$invoice->DocRate,2)}}
                                                @endif --}}
                                                @php
                                                    if ($invoice->DocCur == 'PHP') {
                                                        $convertionValue = (float)$invoice->DocTotal * $invoice->DocRate;
                                                        $formattedValue = number_format($convertionValue, 2); 
                                                        echo '₱' . $formattedValue; 
                                                        $totalPhpValue += $convertionValue; 
                                                    } else {
                                                        $convertionValue = (float)$finalTotal * $invoice->DocRate;
                                                        $formattedValue = number_format($convertionValue, 2);
                                                        echo '₱' . $formattedValue; 
                                                        $totalPhpValue += $convertionValue; 
                                                    }
                                                @endphp
                                            </td>
                                        </tr>
                                        @endif
                                        {{-- @if ($invoice->warehouse->WhsCode == 'TRI Whse') --}}
                                        @if ($company == 'WHI')
                                        @foreach ($invoice->inv1 as $inv)
                                        @if ( ($inv->WhsCode == 'TRI Whse') )
                                            
                                        <tr>
                                            <td>{{date('m/d/Y', strtotime($invoice->DocDate))}}</td>
                                            <td>{{$invoice->U_invNo}}</td>
                                            <td>{{$invoice->NumAtCard}}</td>
                                            <td>{{$invoice->CardName}}</td>
                                            <td> <?php
                                                $currencySymbol = '';
                                                if ($invoice->DocCur === 'USD') {
                                                    $currencySymbol = '$';
                                                } else {
                                                    $currencySymbol = '';
                                                }
                                                $totalFrgnTRIWhse = 0;

                                                if ($invoice->DocType === "I") {
                                                    if ($invoice->DocCur === 'USD') {
                                                        if ($company === 'WHI') {
                                                            $finalTotal = $inv->TotalFrgn;
                                                            echo $currencySymbol . '' . number_format($finalTotal, 2);
                                                            $totalUsdTfinalTotal += $finalTotal;
                                                        } 
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td> <?php
                                                $currencySymbol = '';
                                                if ($invoice->DocCur === 'USD') {
                                                    $currencySymbol = '$';
                                                } else {
                                                    $currencySymbol = '';
                                                }
                                                $totalFrgnTRIWhse = 0;
                                                if ($invoice->DocType === "S") {
                                                    if ($invoice->DocCur === 'USD') {
                                                        if ($company === 'WHI') {
                                                            $finalTotal = $inv->TotalFrgn;
                                                            echo $currencySymbol . '' . number_format($finalTotal, 2);
                                                            $totalUsdNTfinalTotal += $finalTotal;
                                                        }
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td> <?php
                                                $currencySymbol = '';
                                                if ($invoice->DocCur === 'EUR') {
                                                    $currencySymbol = '€';
                                                } else {
                                                    $currencySymbol = '';
                                                }
                                                $totalFrgnTRIWhse = 0;
                                                if ($invoice->DocType === "I") {
                                                    if ($invoice->DocCur === 'EUR') {
                                                        if ($company === 'WHI') {
                                                            $finalTotal = $inv->TotalFrgn;
                                                            echo $currencySymbol . '' . number_format($finalTotal, 2);
                                                            $totalEurTfinalTotal += $finalTotal;
                                                        }
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td> <?php
                                                    $currencySymbol = '';
                                                    if ($invoice->DocCur === 'EUR') {
                                                    $currencySymbol = '€';
                                                    } else {
                                                        $currencySymbol = '';
                                                    }
                                                    $totalFrgnTRIWhse = 0;
                                                    if ($invoice->DocType === "S") {
                                                        if ($invoice->DocCur === 'EUR') {
                                                            if ($company === 'WHI') {
                                                                $finalTotal = $inv->TotalFrgn;
                                                                echo $currencySymbol . '' . number_format($finalTotal, 2);
                                                                $totalEurNTfinalTotal += $finalTotal;
                                                            }
                                                        }
                                                    }
                                                            ?>
                                            </td>
                                            <td>
                                                @php
                                                    if($invoice->DocCur == 'PHP'){
                                                        if($invoice->DocType == "I") {
                                                            $finalTotal = (float) $invoice->DocTotal;
                                                            $formattedTotal = number_format($finalTotal, 2); 
                                                            
                                                            echo '₱' . $formattedTotal;
                                                            $totalPhpTfinalTotal += $finalTotal; 
                                                        } else {
                                                            
                                                        }
                                                    }   
                                                @endphp
                                            </td>
                                            <td>
                                                @php
                                                    if($invoice->DocCur == 'PHP'){
                                                        if($invoice->DocType == "S") {
                                                            $finalTotal = (float) $invoice->DocTotal;
                                                            $formattedTotal = number_format($finalTotal, 2); 
                                                            
                                                            echo '₱' . $formattedTotal;
                                                            $totalPhpNTfinalTotal += $finalTotal; 
                                                        } else {
                                                            
                                                        }
                                                    }   
                                                @endphp
                                            </td>
                                            <td>
                                                @php
                                                    if ($invoice->DocCur == 'PHP') {
                                                        $convertionValue = (float)$invoice->DocTotal * $invoice->DocRate;
                                                        $formattedValue = number_format($convertionValue, 2); 
                                                        echo '₱' . $formattedValue; 
                                                        $totalPhpValue += $convertionValue; 
                                                    } else {
                                                        $convertionValue = (float)$finalTotal * $invoice->DocRate;
                                                        $formattedValue = number_format($convertionValue, 2);
                                                        echo '₱' . $formattedValue; 
                                                        $totalPhpValue += $convertionValue; 
                                                    }
                                                @endphp
                                            </td>
                                        </tr>
                                        @endif

                                       
                                        @endforeach
                                        @endif
                                        {{-- @endif --}}

                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class='text-right'>Total</td>
                                            <td>{{number_format($totalUsdTfinalTotal,2)}}</td>
                                            <td>{{number_format($totalUsdNTfinalTotal,2)}}</td>
                                            <td>{{number_format($totalEurTfinalTotal,2)}}</td>
                                            <td>{{number_format($totalEurNTfinalTotal,2)}}</td>
                                            <td>{{number_format($totalPhpTfinalTotal,2)}}</td>
                                            <td>{{number_format($totalPhpNTfinalTotal,2)}}</td>
                                            <td>{{number_format($totalPhpValue,2)}}</td>
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

@endsection
@section('footer')
<script src="{{ asset('/inside/login_css/js/plugins/dataTables/datatables.min.js')}}"></script>
<script src="{{ asset('/inside/login_css/js/plugins/chosen/chosen.jquery.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>

   

    $(document).ready(function(){

        // $('.cat').chosen({width: "100%"});
        $('.monthly_sales_table').DataTable({
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
                // {extend: 'excel', title: 'Aging Report'}
            ]

        });

        $('#year-picker').datepicker({
            format: "yyyy",
            startView: 2, 
            minViewMode: 2,
            autoclose: true
        });
    });
</script>

@endsection

