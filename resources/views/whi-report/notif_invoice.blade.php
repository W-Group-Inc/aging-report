<style>
    .table-modal-responsive {
    position: relative;
    height: 30%; 
    overflow: auto;
    display: inline-block;
    width: 100%;
    }

</style>

<div class="modal fade" id="notificationModal{{ $notification->id }}" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 90%;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="notificationModalLabel">Invoice Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="table-modal-responsive">
            <table id='table' class="table table-striped table-bordered table-hover" style="margin-bottom: 0px !important;">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Invoice Number</th>
                        <th>Buyer's Mark</th>
                        <th>Original Invoice Amount</th>
                        <th>Invoice Date</th>
                        <th>Payment Term</th>
                        <th>Baseline Date</th>
                        <th>Invoice Due Date</th>
                        <th>Invoice Balance USD</th>
                        <th>Invoice Balance EUR</th>
                        <th>Invoice Balance PHP-T</th>
                        <th>Invoice balance PHP-NT</th>
                        <th>Days Late</th>
                        <th>Aging Status</th>
                        <th>Forex Rate</th>
                        <th>Invoice PHP Value</th>
                        <th>Location</th>
                        <th>Account Manager</th>
                        <th style="padding-right: 80px">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // $invoice = $invoices->firstWhere('DocNum', $notification->invoice_id)  ?? '';
                        $invoice = collect($invoices)->firstWhere('DocNum', $notification->invoice_id) ?? '';
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
                    @if($invoice)
                    <tr>
                        <td>{{$invoice->CardName}}</td>
                        <td>{{$invoice->U_invNo}}</td>
                        <td>{{$invoice->NumAtCard}}</td>
                        <td> <?php
                            $currencySymbol = '';
                            if ($invoice->DocCur === 'USD') {
                                $currencySymbol = '$';
                            } elseif ($invoice->DocCur === 'EUR') {
                                $currencySymbol = '€';
                            } elseif ($invoice->DocCur === 'PHP') {
                                $currencySymbol = '₱';
                            }
                            $totalFrgnTRIWhse = 0;

                            if ($company === 'WHI') {
                                foreach ($invoice->inv1 as $item) {
                                    if ($item->WhsCode === 'TRI Whse') {
                                        $totalFrgnTRIWhse += $item->TotalFrgn;
                                    }
                                }
                                $finalTotal = $invoice->DocTotalFC - $totalFrgnTRIWhse;
                            } else {
                                $finalTotal = $invoice->DocTotalFC;
                            }

                            echo $currencySymbol . '' . number_format($finalTotal, 2);
                            ?></td>
                        <td>{{date('m/d/Y', strtotime($invoice->DocDate))}}</td>
                        <td>{{ $invoice->terms ? $invoice->terms->PymntGroup : '' }}</td>
                        <td>@if($invoice->U_BaseDate != null){{date('m/d/Y', strtotime($invoice->U_BaseDate))}}@else NA @endif</td>
                        <td>
                            @if(!empty($invoice->U_DueDateAR))
                            {{ date('m/d/Y', strtotime($invoice->U_DueDateAR)) }}
                            @else
                            TBA
                            @endif
                    </td>
                        @php
                        $final_amount = $finalTotal - $invoice->PaidFC;
                        $usd = "";
                        $euro = "";
                        $php = "";
                        if ($invoice->DocCur == "USD") {
                                $total_usd += $final_amount;
                                $usd = number_format($final_amount, 2);
                            
                                $end_date = strtotime(Request::get('end_date'));
                                if (empty($end_date)) {
                                    $end_date = time(); 
                                }
                                if (empty($invoice->U_DueDateAR)) {
                                    $total_current_usd += $final_amount; 
                                } else {
                                    $dueDateTimestamp = strtotime($invoice->U_DueDateAR);
                                    if ($dueDateTimestamp === false) {
                                        $total_current_usd += $final_amount;
                                    } else {
                                        $daysLate = ceil(($end_date - $dueDateTimestamp) / (60 * 60 * 24));

                                        if ($daysLate <= 0) {
                                            $total_current_usd += $final_amount;
                                        } elseif ($daysLate >= 1 && $daysLate <= 30) {
                                            $total_month_usd += $final_amount;
                                        } elseif ($daysLate >= 31 && $daysLate <= 60) {
                                            $total_twomonth_usd += $final_amount;
                                        } elseif ($daysLate >= 61 && $daysLate <= 90) {
                                            $total_threemonth_usd += $final_amount;
                                        } else {
                                            $total_over_days_usd += $final_amount;
                                        }
                                    }
                                }
                            }
                            elseif($invoice->DocCur == "EUR") {
                                $total_euro +=$final_amount;
                                $euro = number_format($final_amount,2);

                                $end_date = strtotime(Request::get('end_date'));
                                if (empty($end_date)) {
                                    $end_date = time(); 
                                }
                                $dueDateTimestamp = strtotime($invoice->U_DueDateAR);
                                $daysLate = ceil(($end_date - $dueDateTimestamp) / (60 * 60 * 24));

                                if (empty($invoice->U_DueDateAR)) {
                                    $total_current_euro += $final_amount; 
                                } else {
                                    $dueDateTimestamp = strtotime($invoice->U_DueDateAR);
                                    if ($dueDateTimestamp === false) {
                                        $total_current_euro += $final_amount;
                                    } else {
                                        $daysLate = ceil(($end_date - $dueDateTimestamp) / (60 * 60 * 24));

                                        if ($daysLate <= 0) {
                                            $total_current_euro += $final_amount;
                                        } elseif ($daysLate >= 1 && $daysLate <= 30) {
                                            $total_month_euro += $final_amount;
                                        } elseif ($daysLate >= 31 && $daysLate <= 60) {
                                            $total_twomonth_euro += $final_amount;
                                        } elseif ($daysLate >= 61 && $daysLate <= 90) {
                                            $total_threemonth_euro += $final_amount;
                                        } else {
                                            $total_over_days_euro += $final_amount;
                                        }
                                    }
                                }
                            }
                            else {
                                $php = number_format($invoice->DocTotal - $invoice->PaidToDate,2);
                                $final_amount = $invoice->DocTotal - $invoice->PaidToDate;
                            }
                        @endphp
                        <td>@if($usd != null){{'$'."".$usd}} @else NA @endif</td>
                        <td>@if($euro != null){{'€'."".$euro}} @else NA @endif</td>
                        <td>@if($invoice->DocCur == 'PHP')
                                @if($invoice->DocType == "I")
                                    @php
                                        $php_t_amount = $invoice->DocTotal - $invoice->PaidToDate;
                                        $total_php_t += $php_t_amount;

                                        $end_date = strtotime(Request::get('end_date'));
                                        if (empty($end_date)) {
                                            $end_date = time(); 
                                        }
                                        $dueDateTimestamp = strtotime($invoice->U_DueDateAR);
                                        $daysLate = ($end_date - $dueDateTimestamp) / (60 * 60 * 24);

                                        if (empty($invoice->U_DueDateAR)) {
                                        $total_current_php_t += $php_t_amount; 
                                } else {
                                    $dueDateTimestamp = strtotime($invoice->U_DueDateAR);
                                    if ($dueDateTimestamp === false) {
                                        $total_current_php_t += $php_t_amount;
                                    } else {
                                        $daysLate = ceil(($end_date - $dueDateTimestamp) / (60 * 60 * 24));

                                        if ($daysLate <= 0) {
                                            $total_current_php_t += $php_t_amount;
                                        } elseif ($daysLate >= 1 && $daysLate <= 30) {
                                            $total_month_php_t += $php_t_amount;
                                        } elseif ($daysLate >= 31 && $daysLate <= 60) {
                                            $total_twomonth_php_t += $php_t_amount;
                                        } elseif ($daysLate >= 61 && $daysLate <= 90) {
                                            $total_threemonth_php_t += $php_t_amount;
                                        } else {
                                            $total_over_days_php_t += $php_t_amount;
                                        }
                                    }
                                }
                            
                                    @endphp {{'₱'."".$php}}
                                @else NA 
                                @endif
                            @else NA 
                            @endif
                        </td>
                        <td>@if($invoice->DocCur == 'PHP')
                                @if($invoice->DocType == "S") 
                                    @php
                                        $php_nt_amount = $invoice->DocTotal - $invoice->PaidToDate;
                                        $total_php_nt += $php_nt_amount;

                                        $end_date = strtotime(Request::get('end_date'));
                                        if (empty($end_date)) {
                                            $end_date = time(); 
                                        }
                                        $dueDateTimestamp = strtotime($invoice->U_DueDateAR);
                                        $daysLate = ($end_date - $dueDateTimestamp) / (60 * 60 * 24);

                                        if (empty($invoice->U_DueDateAR)) {
                                        $total_current_php_nt += $php_nt_amount; 
                                } else {
                                    $dueDateTimestamp = strtotime($invoice->U_DueDateAR);
                                    if ($dueDateTimestamp === false) {
                                        $total_current_php_nt += $php_nt_amount;
                                    } else {
                                        $daysLate = ceil(($end_date - $dueDateTimestamp) / (60 * 60 * 24));

                                        if ($daysLate <= 0) {
                                            $total_current_php_nt += $php_nt_amount;
                                        } elseif ($daysLate >= 1 && $daysLate <= 30) {
                                            $total_month_php_nt += $php_nt_amount;
                                        } elseif ($daysLate >= 31 && $daysLate <= 60) {
                                            $total_twomonth_php_nt += $php_nt_amount;
                                        } elseif ($daysLate >= 61 && $daysLate <= 90) {
                                            $total_threemonth_php_nt += $php_nt_amount;
                                        } else {
                                            $total_over_days_php_nt += $php_nt_amount;
                                        }
                                    }
                                }
                                    @endphp 
                                {{'₱'."".$php}}
                                @else NA 
                                @endif
                            @else NA 
                            @endif
                        </td>
                        @php
                            $end_date = strtotime(Request::get('end_date')); 
                            if (empty($end_date)) {
                                    $end_date = time(); 
                                }
                                $due_date = !empty($invoice->U_DueDateAR) ? strtotime(date('m/d/Y', strtotime($invoice->U_DueDateAR))) : null;

                            if ($due_date !== null) {
                                $datediff = $end_date - $due_date;
                            } else {
                                $datediff = null; 
                            } 
                        @endphp
                    <td>
                        @if($datediff !== null)
                            {{ ceil($datediff / (60 * 60 * 24)) }} {{ ceil($datediff / (60 * 60 * 24)) == 1 ? 'day' : 'days' }}
                        @else
                            {{ "0 days" }}
                        @endif
                    </td>
                        @php
                            if (ceil($datediff / (60 * 60 * 24)) <= 0) {
                                $total_current++;
                                $status = 'Current';
                                $total_current_php = $total_current_php + ($final_amount * $invoice->DocRate);
                            } elseif ((ceil($datediff / (60 * 60 * 24)) >= 1) && (ceil($datediff / (60 * 60 * 24)) <= 30)) {
                                $status = '1  to 30 days Late';
                                $total_month++;
                                $total_month_php = $total_month_php + ($final_amount * $invoice->DocRate);
                            } elseif ((ceil($datediff / (60 * 60 * 24)) >= 31) && (ceil($datediff / (60 * 60 * 24)) <= 60)) {
                                $status = '31  to 60 days Late';
                                $total_twomonth++;
                                $total_twomonth_php = $total_twomonth_php + ($final_amount * $invoice->DocRate);
                            } elseif ((ceil($datediff / (60 * 60 * 24)) >= 61) && (ceil($datediff / (60 * 60 * 24)) <= 90)) {
                                $status = '61  to 90 days Late';
                                $total_threemonth++;
                                $total_threemonth_php = $total_threemonth_php + ($final_amount * $invoice->DocRate);
                            } else {
                                $total_over_days++;
                                $status = 'Over 90 days Late';
                                $total_over_days_php = $total_over_days_php + ($final_amount * $invoice->DocRate);
                            }
                        @endphp
                        <td>{{ $status }}</td>
                        <td>{{$invoice->DocRate}}</td>
                        @php
                            $total_php = $final_amount*$invoice->DocRate + $total_php;
                            if($invoice->DocCur == "USD") {
                                $total_usd_in_ph += $final_amount * $invoice->DocRate;
                            }
                            if($invoice->DocCur == "EUR") {
                                $total_euro_in_ph += $final_amount * $invoice->DocRate;
                            }
                        @endphp
                        <td>{{number_format($final_amount*$invoice->DocRate,2)}}</td>
                        <td>{{ $invoice->location->ocrg->GroupName ?? 'N/A' }}</td> 
                        <td>{{ $invoice->manager ? $invoice->manager->SlpName : '' }}</td>
                        <td> 
                            @if($invoice->remark)
                                {{$invoice->remark->remarks}}
                                <br>
                                <span style="font-size: 10px">Date Created: <span class="label label-primary">{{ $invoice->remark->created_at->format('M. d, Y g:i A') }}</span>
                                <br>
                                <span style="font-size: 10px">Date Updated: <span class="label label-warning">{{ $invoice->remark->updated_at->format('M. d, Y g:i A') }}</span>
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    @endif
                    @php
                        // $last_invoice = $last_invoices->firstWhere('DocNum', $notification->invoice_id)  ?? '';
                        $last_invoice = isset($last_invoices) && is_array($last_invoices) 
                        ? collect($last_invoices)->firstWhere('DocNum', $notification->invoice_id) 
                        : null;
                    @endphp
                    @if($last_invoice)
                    <tr>
                        <td>{{$invoice->CardName}}</td>
                        <td>{{$invoice->U_invNo}}</td>
                        <td>{{$invoice->NumAtCard}}</td>
                        <td> <?php
                            $currencySymbol = '';
                            if ($invoice->DocCur === 'USD') {
                                $currencySymbol = '$';
                            } elseif ($invoice->DocCur === 'EUR') {
                                $currencySymbol = '€';
                            } elseif ($invoice->DocCur === 'PHP') {
                                $currencySymbol = '₱';
                            }
                            $totalFrgnTRIWhse = 0;
                            foreach ($invoice->inv1 as $item) {
                                if ($item->WhsCode === 'TRI Whse') {
                                    $totalFrgnTRIWhse += $item->TotalFrgn;
                                }
                                else {
                                    $totalFrgnTRIWhse = 0;
                                }
                            }

                            $finalTotal = $invoice->DocTotalFC - $totalFrgnTRIWhse;

                            echo $currencySymbol . '' . number_format($finalTotal, 2);
                            ?></td>
                        <td>{{date('m/d/Y', strtotime($invoice->DocDate))}}</td>
                        <td>{{$invoice->terms->PymntGroup}}</td>
                        <td>@if($invoice->U_BaseDate != null){{date('m/d/Y', strtotime($invoice->U_BaseDate))}}@else NA @endif</td>
                        <td>{{date('m/d/Y', strtotime($invoice->U_DueDateAR))}}</td>
                        @php
                        $final_amount = + 25000.00;
                        $usd = "";
                        $euro = "";
                        $php = "";
                        if ($invoice->DocCur == "USD") {
                                $total_usd += $final_amount;
                                $usd = number_format($final_amount, 2);
                            
                                $end_date = strtotime(Request::get('end_date'));
                                if (empty($end_date)) {
                                    $end_date = time(); 
                                }
                                if (empty($invoice->U_DueDateAR)) {
                                    $total_current_usd += $final_amount; 
                                } else {
                                    $dueDateTimestamp = strtotime($invoice->U_DueDateAR);
                                    if ($dueDateTimestamp === false) {
                                        $total_current_usd += $final_amount;
                                    } else {
                                        $daysLate = ceil(($end_date - $dueDateTimestamp) / (60 * 60 * 24));

                                        if ($daysLate <= 0) {
                                            $total_current_usd += $final_amount;
                                        } elseif ($daysLate >= 1 && $daysLate <= 30) {
                                            $total_month_usd += $final_amount;
                                        } elseif ($daysLate >= 31 && $daysLate <= 60) {
                                            $total_twomonth_usd += $final_amount;
                                        } elseif ($daysLate >= 61 && $daysLate <= 90) {
                                            $total_threemonth_usd += $final_amount;
                                        } else {
                                            $total_over_days_usd += $final_amount;
                                        }
                                    }
                                }
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
                            $end_date = strtotime(Request::get('end_date'));
                            if (empty($end_date)) {
                                    $end_date = time(); 
                                }
                            $your_date = strtotime(date('m/d/Y', strtotime($invoice->U_DueDateAR)));
                            $datediff = $end_date - $your_date
                        @endphp
                        <td>{{ceil($datediff / (60 * 60 * 24)). " days"}}</td>
                        @php
                            if (ceil($datediff / (60 * 60 * 24)) <= 0) {
                                $total_current++;
                                $status = 'Current';
                            }
                            elseif ((ceil($datediff / (60 * 60 * 24)) >= 1) && (ceil($datediff / (60 * 60 * 24)) <= 30))
                            {
                                $status = '1  to 30 days Late';
                                
                                $total_month++;
                            }
                            elseif ((ceil($datediff / (60 * 60 * 24)) >= 31) && (ceil($datediff / (60 * 60 * 24)) <= 60))
                            {
                                $status = '31  to 60 days Late';
                                $total_twomonth++;
                            }
                            elseif ((ceil($datediff / (60 * 60 * 24)) >= 61) && (ceil($datediff / (60 * 60 * 24)) <= 90))
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
                        <td>{{$invoice->location->ocrg->GroupName ?? 'N/A'}}</td> 
                        <td>{{$invoice->manager->SlpName}}</td>
                        <td>
                            @if($invoice->remark)
                                {{$invoice->remark->remarks}}
                                <br>
                                <span style="font-size: 10px">Date Created: <span class="label label-primary">{{ $invoice->remark->created_at->format('M. d, Y g:i A') }}</span>
                                <br>
                                <span style="font-size: 10px">Date Updated: <span class="label label-warning">{{ $invoice->remark->updated_at->format('M. d, Y g:i A') }}</span>
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  