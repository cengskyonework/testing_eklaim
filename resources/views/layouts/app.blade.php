<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ get_option('site_title', 'E-CLAIM') }}</title>
    <link rel="stylesheet" href="{{ asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.addons.css') }}">
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fullcalendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/summernote.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" href="{{ get_favicon() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript">
        var direction = "{{ get_option('backend_direction') }}";
        var _url = "{{ asset('/') }}";
        var u_s = "{{ get_option('max_upload_size') }}";
    </script>


</head>

<body>
    <!-- Main Modal -->
    <div id="main_modal" class="modal animated bounceInDown" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>

                    <!--<button type="button" id="modal-fullscreen" class="modal-btn btn btn-primary btn-sm float-right"><i class="glyphicon glyphicon-fullscreen"></i> {{ _lang('Full Screen') }}</button>-->

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="alert alert-danger" style="display:none; margin: 15px;"></div>
                <div class="alert alert-success" style="display:none; margin: 15px;"></div>
                <div class="modal-body" style="overflow:hidden;"></div>

            </div>
        </div>
    </div>
    <div class="container-scroller">
        {{-- navbar --}}
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
                <a class="navbar-brand brand-logo" href="{{ url('dashboard') }}">
                    {{ get_option('company_name', 'AppsVan') }}
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
                <p class="page-title"></p>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown d-none d-xl-inline-block">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false">
                            <span class="profile-text">{{ _lang('Hello') . ', ' . Auth::user()->name }}</span>
                            <img class="img-xs rounded-circle"
                                src="{{ Auth::user()->profile_picture != '' ? asset('uploads/profile/' . Auth::user()->profile_picture) : asset('images/avatar.png') }}"
                                alt="Profile image">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <a href="{{ url('profile/edit') }}" class="dropdown-item mt-2">
                                Manage Profile
                            </a>
                            <a href="{{ url('profile/change_password') }}" class="dropdown-item">
                                Change Password
                            </a>
                            <a href="{{ url('logout') }}" class="dropdown-item">
                                Sign Out
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        {{-- navbar --}}
        {{-- sidebar --}}
        <div class="container-fluid page-body-wrapper">

            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <div class="nav-link">
                            <div class="user-wrapper">
                                <div class="profile-image">
                                    <img src="{{ Auth::user()->profile_picture != '' ? asset('uploads/profile/' . Auth::user()->profile_picture) : asset('images/avatar.png') }}"
                                        alt="profile image">
                                </div>
                                <div class="text-wrapper">
                                    <p class="profile-name">{{ Auth::user()->name }}</p>
                                    <div>
                                        <small
                                            class="designation text-muted">{{ ucwords(Auth::user()->user_type) }}</small>
                                        <span class="status-indicator online"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('dashboard') }}">
                            <i class="menu-icon mdi mdi-television"></i>
                            <span class="menu-title">{{ _lang('Dashboard') }}</span>
                        </a>
                    </li>

                    @if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'administrator')
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#costcenter" aria-expanded="false"
                                aria-controls="ui-basic">
                                <i class="menu-icon mdi mdi-currency-usd"></i>
                                <span class="menu-title">{{ _lang('Cost Center') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="costcenter">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ url('costcenter') }}">{{ _lang('Cost Center') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ url('channel') }}">{{ _lang('Deskripsi Cost Center') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#property-management"
                                aria-expanded="false" aria-controls="ui-basic">
                                <i class="menu-icon mdi mdi-city"></i>
                                <span class="menu-title">{{ _lang('Master Data') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="property-management">
                                <ul class="nav flex-column sub-menu">

                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ url('category') }}">{{ _lang('Jenis Klaim') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ url('distributor') }}">{{ _lang('Distributor') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('dokumen') }}">{{ _lang('Dokumen') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('produk') }}">{{ _lang('Produk') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('promo') }}">{{ _lang('Program') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('region') }}">{{ _lang('Region') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#agent-management" aria-expanded="false"
                            aria-controls="ui-basic">
                            <i class="menu-icon mdi mdi-account-outline"></i>
                            <span class="menu-title">{{ _lang('Claim Management') }}</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="agent-management">
                            <ul class="nav flex-column sub-menu">
                                @if (Auth::user()->user_type == 'user')
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ url('createx') }}">{{ _lang('Form Klaim') }}</a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('claim') }}">{{ _lang('Data Klaim') }}</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    @if (Auth::user()->user_type == 'user' || Auth::user()->user_type == 'administrator')
                    @else
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#blog-management" aria-expanded="false"
                                aria-controls="ui-basic">
                                <i class="menu-icon mdi mdi-approval"></i>
                                <span class="menu-title">{{ _lang('Approval') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="blog-management">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        @if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'manager')
                                            <a class="nav-link"
                                                href="{{ url('approval') }}">{{ _lang('Approval') }}</a>
                                        @endif
                                        @if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'accounting')
                                            <a class="nav-link"
                                                href="{{ url('finance_approval') }}">{{ _lang('Accounting Approval') }}</a>
                                        @endif
                                        @if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'finance')
                                            <a class="nav-link"
                                                href="{{ url('acc_approval') }}">{{ _lang('Finance Approval') }}</a>
                                            <a class="nav-link"
                                                href="{{ url('bulkpembayaran') }}">{{ _lang('Bulk Pembayaran') }}</a>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif

                    @if (Auth::user()->user_type == 'admin' ||
                            Auth::user()->user_type == 'administrator' ||
                            Auth::user()->user_type == 'accounting' ||
                            Auth::user()->user_type == 'finance')
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#report-management"
                                aria-expanded="false" aria-controls="ui-basic">
                                <i class="menu-icon mdi mdi-chart-areaspline"></i>
                                <span class="menu-title">{{ _lang('Reports') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="report-management">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ url('reports') }}">{{ _lang('Claim Reports') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('faqs') }}">
                            <i class="menu-icon mdi mdi-message-text-outline"></i>
                            <span class="menu-title">{{ _lang('FAQ') }}</span>
                        </a>
                    </li>

                    @if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'administrator')
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#user-management" aria-expanded="false"
                                aria-controls="ui-basic">
                                <i class="menu-icon mdi mdi-account-multiple"></i>
                                <span class="menu-title">{{ _lang('User Management') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="user-management">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ url('users') }}">{{ _lang('User Management') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false"
                                aria-controls="auth">
                                <i class="menu-icon mdi mdi-memory"></i>
                                <span class="menu-title">{{ _lang('Administration') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="auth">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('administration/general_settings') }}">
                                            {{ _lang('General Settings') }} </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('administration/backup_database') }}">
                                            {{ _lang('Database Backup') }} </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('profile/edit') }}">
                            <i class="menu-icon mdi mdi-face-profile"></i>
                            <span class="menu-title">{{ _lang('Ubah Profile') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('logout') }}">
                            <i class="menu-icon mdi mdi-logout"></i>
                            <span class="menu-title">{{ _lang('Keluar') }}</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">

                <!--Start Content -->
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- End Content -->

                <footer class="footer">
                    <div class="container-fluid clearfix">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2022
                            <a href="http://www.inacofood.com" target="_blank">Inaco</a>. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> PT. NIRAMAS UTAMA
                            <i class="mdi mdi-copyright text-danger"></i>
                        </span>
                    </div>
                </footer>
            </div>
            <!-- main-panel ends -->
        </div>
        {{-- sidebar --}}
    </div>

    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('vendors/js/vendor.bundle.addons.js') }}"></script>
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/misc.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/dropify.min.js') }}"></script>
    <script src="{{ asset('js/toastr.js') }}"></script>
    <script src="{{ asset('js/summernote.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/print.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @if (Request::is('dashboard'))
        <!-- Custom js for this page-->
        <script src="{{ asset('js/dashboard.js') }}"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
        <script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
        <!-- End custom js for this page-->
    @endif

    @yield('js-script')

    <script type="text/javascript">
        $(document).ready(function() {

            @if (!Request::is('dashboard'))
                $(".page-title").html($(".panel-title").html());
            @else
                $(".page-title").html('{{ _lang('Dashboard') }}');
            @endif

            $(".data-table").DataTable({
                responsive: true,
                "bAutoWidth": false,
                "ordering": false,
                "language": {
                    "decimal": "",
                    "emptyTable": "{{ _lang('No Data Found') }}",
                    "info": "{{ _lang('Showing') }} _START_ {{ _lang('to') }} _END_ {{ _lang('of') }} _TOTAL_ {{ _lang('Entries') }}",
                    "infoEmpty": "{{ _lang('Showing 0 To 0 Of 0 Entries') }}",
                    "infoFiltered": "(filtered from _MAX_ total entries)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "{{ _lang('Show') }} _MENU_ {{ _lang('Entries') }}",
                    "loadingRecords": "{{ _lang('Loading...') }}",
                    "processing": "{{ _lang('Processing...') }}",
                    "search": "{{ _lang('Search') }}",
                    "zeroRecords": "{{ _lang('No matching records found') }}",
                    "paginate": {
                        "first": "{{ _lang('First') }}",
                        "last": "{{ _lang('Last') }}",
                        "next": "{{ _lang('Next') }}",
                        "previous": "{{ _lang('Previous') }}"
                    },
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    }
                },
            });


            $(".report-table").DataTable({
                responsive: true,
                "bAutoWidth": false,
                lengthChange: false,
                "ordering": false,
                "language": {
                    "decimal": "",
                    "emptyTable": "{{ _lang('No Data Found') }}",
                    "info": "{{ _lang('Showing') }} _START_ {{ _lang('to') }} _END_ {{ _lang('of') }} _TOTAL_ {{ _lang('Entries') }}",
                    "infoEmpty": "{{ _lang('Showing 0 To 0 Of 0 Entries') }}",
                    "infoFiltered": "(filtered from _MAX_ total entries)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "{{ _lang('Show') }} _MENU_ {{ _lang('Entries') }}",
                    "loadingRecords": "{{ _lang('Loading...') }}",
                    "processing": "{{ _lang('Processing...') }}",
                    "search": "{{ _lang('Search') }}",
                    "zeroRecords": "{{ _lang('No matching records found') }}",
                    "paginate": {
                        "first": "{{ _lang('First') }}",
                        "last": "{{ _lang('Last') }}",
                        "next": "{{ _lang('Next') }}",
                        "previous": "{{ _lang('Previous') }}"
                    },
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    }
                },
                dom: 'Blfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
            });


            //Show Success Message
            @if (Session::has('success'))
                Command: toastr["success"]("{{ session('success') }}")
            @endif

            //Show Single Error Message
            @if (Session::has('error'))
                Command: toastr["error"]("{{ session('error') }}")
            @endif


            @php $i =0; @endphp

            @foreach ($errors->all() as $error)
                Command: toastr["error"]("{{ $error }}");

                var name = "{{ $errors->keys()[$i] }}";

                $("input[name='" + name + "']").addClass('error');
                $("select[name='" + name + "'] + span").addClass('error');

                $("input[name='" + name + "'], select[name='" + name + "']").parent().append(
                    "<span class='v-error'>{{ $error }}</span>");

                @php $i++; @endphp
            @endforeach

        });
    </script>

</body>

</html>
