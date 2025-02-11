<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @php
  ini_set('upload_max_filesize', '1000M');
  ini_set('post_max_size', '100M');
  ini_set('max_input_time', '1000');
  ini_set('max_execution_time', '1000');
  ini_set('memory_limit', '-1');
  @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SAP Business One</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <!-- endinject -->
 
    <link rel="icon" type="image/png" href="{{ asset('/img/sap-icon.png')}}" />
    <link href="{{ asset('/inside/login_css/css/bootstrap.min.css')}}" rel="stylesheet">
    
    <link href="{{ asset('/inside/login_css/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    @yield('css')
    <link href="{{ asset('/inside/login_css/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('/inside/login_css/css/style.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    {{-- <link href="{{ asset('/inside/login_css/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/inside/login_css/css/select2-bootstrap.min.css') }}" rel="stylesheet"> --}}
  <!-- End plugin css for this page -->
    <style>
      .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
      }
      /* width */
      ::-webkit-scrollbar {
        width: 5px;
      }
      
      /* Track */
      ::-webkit-scrollbar-track {
        background: #f1f1f1; 
      }
       
      /* Handle */
      ::-webkit-scrollbar-thumb {
        background: #aee1f5; 
      }
      
      /* Handle on hover */
      ::-webkit-scrollbar-thumb:hover {
        background: #2596be; 
      }
      .loader {
          position: fixed;
          left: 0px;
          top: 0px;
          width: 100%;
          height: 100%;
          z-index: 9999;
          background: url("{{ asset('/images/3.gif')}}") 50% 50% no-repeat white ;
          opacity: .8;
          background-size:120px 120px;
      }
      
      .dataTables_filter {
        float: right;
        text-align: right;
        }
        .dataTables_info {
        float: left;
        text-align: left;
        }
        /* Ensure submenus stay hidden until hovered */
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu .dropdown-menu {
            display: none;
            position: absolute;
            left: 100%;
            top: 0;
        }
                                                           
        .dropdown-submenu:hover > .dropdown-menu {
            display: block;
        }
        .dropdown-submenu .dropdown-submenu:hover > .dropdown-menu {
            display: block;
            top: 0;
            left: 100%;
        }

    </style>
</head>
<body class="top-navigation">
    <div id = "loader" style="display:none;" class="loader">
    </div>
    <div id="wrapper">
      <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom white-bg ">
          <nav class="navbar navbar-static-top container" role="navigation">
              <div class="navbar-header ">
                  <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                      <i class="fa fa-reorder"></i>
                  </button>
                  <a href="{{url('/report')}}" onclick='show();' class="align-middle" > <img  style='margin-top:10px;margin-left:25px;margin-bottom:5px;' src="{{URL::asset('/img/sap-logo.png')}}" height='45px' alt="AVATAR"></a>
              </div>
              <div class="navbar-collapse collapse justify-content-center" id="navbar">
                <ul class="nav navbar-nav">
                  <li class="">
                      <a aria-expanded="false" role="button" href="{{url('/')}}"> AR Aging Report</a>
                  </li>
                  <li class="">
                    <a aria-expanded="false" role="button" href="{{url('/monthly_sales')}}"> Monthly Sales</a>
                </li>
                  @if(auth()->user()->gp_report == 1)
                  <li class="">
                      <a aria-expanded="false" role="button" href="{{url('/gp-report')}}"> GP Report</a>
                  </li>
                  @endif
                  @if(auth()->user()->print == 1)
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        Print
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="#">WHI</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">SOA</a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{url('/whi_soa_list')}}">
                                                SOA List
                                            </a>
                                        </li>     
                                        <li>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#soaUsaModal">
                                                SOA USA Commercial Invoice
                                            </a>
                                        </li>       
                                        <li>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#soaEurModal">
                                                SOA EUR Commercial Invoice
                                            </a>
                                        </li>     
                                        <li>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#soaPhpModal">
                                                SOA PHP Commercial Invoice
                                            </a>
                                        </li>                                        
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Billing Statement</a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#tradeBilling">
                                                Trade
                                            </a>
                                        </li>       
                                        <li>
                                            {{-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#nonTradeBilling">
                                                Non Trade
                                            </a> --}}
                                            <a class="dropdown-item" href="{{url('/billing_statement_list')}}">
                                                Non Trade
                                            </a>
                                        </li>                                   
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Credit Note</a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{url('/credit_note')}}">
                                                Credit Note
                                            </a>
                                        </li>                                         
                                    </ul>
                                </li>
                                {{-- <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#birWhiCommercialInvoice">
                                        BIR Template Commercial Invoice
                                    </a>
                                </li> --}}
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="{{url('/whi_bir_invoice')}}">
                                        BIR Template Commercial Invoice List
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="#">PBI</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">SOA</a>
                                    <ul class="dropdown-menu">    
                                        <li>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#soaPbiEurModal">
                                                SOA EUR Commercial Invoice
                                            </a>
                                        </li>     
                                        <li>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#soaPbiPhpModal">
                                                SOA PHP Commercial Invoice
                                            </a>
                                        </li>                                        
                                    </ul>
                                </li>
                                {{-- <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Billing Statement</a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#tradeBilling">
                                                Trade
                                            </a>
                                        </li>       
                                        <li>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#soaEurModal">
                                                Non Trade
                                            </a>
                                        </li>                                   
                                    </ul>
                                </li> --}}
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">BIR Template Sales Invoice</a>
                                    <ul class="dropdown-menu">    
                                        <li>
                                            <a class="dropdown-item" href="{{url('/pbi_bir_invoice')}}">
                                                BIR Template Sales Invoice List
                                            </a>
                                        </li>     
                                        <li>
                                            <a class="dropdown-item" href="{{url('/pbi_bir_invoice_special')}}">
                                                BIR Special Template Sales Invoice List
                                            </a>
                                        </li>                                        
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="{{url('/pbi_debit_memo')}}">
                                        Debit Memo
                                    </a>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="{{url('/pbi_credit_note')}}">
                                        Credit Note
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="#">CCC</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Credit Note</a>
                                    <ul class="dropdown-menu">    
                                        <li>
                                            <a class="dropdown-item" href="{{url('/credit_note_ccc')}}">
                                                Credit Note
                                            </a>
                                        </li>                                        
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="{{url('/ccc_bir_invoice')}}">
                                        BIR Template Commercial Invoice List
                                    </a>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item" href="{{url('/ccc_bir_sales_invoice')}}">
                                        BIR Template Sales Invoice List
                                    </a>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#" data-toggle="modal" data-target="#cccBillingStatement">Billing Statement</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @endif                                                                               
              </ul>
                  <ul class="nav navbar-top-links navbar-right">
                      <li>
                          <a href="{{ route('logout') }}" onclick="logout(); show();">
                              <i class="fa fa-sign-out"></i> Log out
                          </a>
                      </li>
                      <li class="notification-bell dropdown">
                        <a class="nav-link" href="#" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="badge" id="notificationCount">{{ App\Notification::where('is_read', '0')->where('invoice_company', request('company'))->whereNotNull('invoice_company')
                                    ->where('invoice_company', '!=', '')->get()->count() }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" style="width: 450px; height: 400px; overflow-y: scroll;" aria-labelledby="notificationDropdown">
                            @php
                                $notifications = App\Notification::where('invoice_company', request('company'))
                                    ->whereNotNull('invoice_company')
                                    ->where('invoice_company', '!=', '')
                                    ->orderBy('id', 'desc')
                                    ->get();
                            @endphp
                            @forelse($notifications as $notification)
                                <a class="dropdown-item d-flex {{ $notification->is_read == 1 ? 'bg-read' : 'bg-unread' }}" href="#" data-id="{{ $notification->id }}" data-read="{{ $notification->is_read }}"
                                  data-toggle="modal" data-target="#notificationModal{{ $notification->id }}">
                                    <div class="mr-3">
                                        <img src="{{ asset('/images/profile.png') }}" alt="User Icon" width="50" height="50">
                                    </div>
                                    <div class="notification-content">
                                        <div>
                                            <span class="small text-muted">{{ $notification->userInfo->email }}</span>
                                            <span class="small text-muted">
                                                @if ($notification->action == "Add")
                                                    Added Remarks For
                                                @else
                                                    Updated Remarks For
                                                @endif
                                            </span>
                                            <span>
                                                @if ($notification->invoice_company == "WHI")
                                                    {{ $notification->notifInvoice->NumAtCard }} 
                                                @elseif ($notification->invoice_company == "PBI")
                                                    {{ $notification->notifInvoicePBI->NumAtCard }} 
                                                @elseif ($notification->invoice_company == "CCC")
                                                    {{ $notification->notifInvoiceCCC->NumAtCard }} 
                                                @endif
                                            </span>
                                            <span class="small text-muted">
                                               for
                                            </span>
                                            <span class="small text-muted">{{ $notification->invoice_company }} SAP</span>
                                            <span class="small text-muted">-{{ $notification->remarks }}</span>
                                        </div>
                                        <div class="small text-muted">
                                            on
                                            @if ($notification->action == "Add")
                                                {{ $notification->created_at->format('M d, H:i') }}
                                            @else
                                                {{ $notification->updated_at->format('M d, H:i') }}
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @empty
                                No notifications
                            @endforelse
                        </div>                                                            
                    </li>                    
                  </ul>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </div>
          </nav>
        </div>
          @yield('content')
      
        <div class="footer">
          <div class="pull-right">
            <strong>WGROUP</strong> DEVELOPER &copy; {{date('Y')}}
          </div>
        </div>
    </div>
@if(isset($invoices))
    @foreach(App\Notification::all() as $notification)
        @include('whi-report.notif_invoice')
    @endforeach
@endif

@include('print_templates.print_modals.soa_usa_commercial_invoice')
@include('print_templates.print_modals.soa_eur_commercial_invoice')
@include('print_templates.print_modals.soa_php_commercial_invoice')
@include('print_templates.print_modals.billing_trade')
@include('print_templates.print_modals.billing_non_trade')
@include('print_templates.print_modals.pbi_modals.soa_eur_commercial_invoice')
@include('print_templates.print_modals.pbi_modals.php_commercial_invoice')
@include('print_templates.print_modals.bir.whi_commercial_invoice')
@include('print_templates.ccc.billing_statement.ccc_billing')

<script>
    function show() {
                document.getElementById("loader").style.display="block";
    }
    function logout() {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        }
</script>
<!-- Mainly scripts -->
<script src="{{ asset('inside/login_css/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{ asset('inside/login_css/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('inside/login_css/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{ asset('inside/login_css/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('inside/login_css/js/select2.min.js') }}"></script>
        <script src="{{ asset('inside/login_css/js/select2.js') }}"></script>
<!-- Custom and plugin javascript -->
<script src="{{ asset('inside/login_css/js/inspinia.js')}}"></script>
<script src="{{ asset('inside/login_css/js/plugins/pace/pace.min.js')}}"></script>
@include('sweetalert::alert')
@yield('footer')
<script>
   function myFunction() {

        var input = document.getElementById("Search");
        var filter = input.value.toLowerCase();
        var nodes = document.getElementsByClassName('target');

        for (i = 0; i < nodes.length; i++) {
            if (nodes[i].innerText.toLowerCase().includes(filter)) {
                nodes[i].style.display = "";
            } else {
                nodes[i].style.display = "none";
            }
        }
    }
    function myFunction1() {

    var input = document.getElementById("Search1");
    var filter = input.value.toLowerCase();
    var nodes = document.getElementsByClassName('target1');

    for (i = 0; i < nodes.length; i++) {
        if (nodes[i].innerText.toLowerCase().includes(filter)) {
            nodes[i].style.display = "";
        } else {
            nodes[i].style.display = "none";
        }
    }
    }

    $('.dropdown-item').on('click', function() {
    var notificationId = $(this).data('id');
    console.log(notificationId);
    var clickedItem = $(this); 
    var isRead = $(this).data('read');
    if (isRead) {
        return;
    }
    $.ajax({
        url: '{{ url('/notifications/mark-as-read') }}/' + notificationId,
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            notification_id: notificationId
        },
        success: function(response) {
            if (response.success) {
                clickedItem.removeClass('bg-unread').addClass('bg-read');
                clickedItem.data('read', true);

                var currentCount = $('#notificationCount').text();
                // $('#notificationCount').text(currentCount - 1);
                if (currentCount > 0) {
                    $('#notificationCount').text(currentCount - 1);
                }
            }
        }
    });
});
</script>
</body>
</html>
