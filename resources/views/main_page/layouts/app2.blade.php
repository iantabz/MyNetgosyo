<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="robots" content="noindex" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="auth-user" content="{{ auth()->user() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin</title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href="{{ asset('assets/fonts/openSans.css') }}" rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('assets/css/nifty.min.css') }}" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="{{ asset('assets/css/demo/nifty-demo-icons.min.css') }}" rel="stylesheet">

    <!--=================================================-->

    <!--FooTable [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/fooTable/css/footable.core.css') }}" rel="stylesheet">

    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="{{ asset('assets/plugins/pace/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/plugins/pace/pace.min.js') }}"></script>


    <!--Demo [ DEMONSTRATION ]-->
    {{-- <link href="{{ asset('assets/demo/nifty-demo.min.css') }}" rel="stylesheet"> --}}
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" />

    <!--DataTables [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/datatables/media/css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css') }}"
        rel="stylesheet">

    <!--Font Awesome [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!--Bootstrap Validator [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/bootstrap-validator/bootstrapValidator.min.css') }}" rel="stylesheet">

    <!--Switchery [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/switchery/switchery.min.css') }}" rel="stylesheet">


    <!--Bootstrap Select [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet">


    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css') }}" rel="stylesheet">


    <!--Chosen [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/chosen/chosen.min.css') }}" rel="stylesheet">


    <!--noUiSlider [ OPTIONAL ]-->
    {{-- <link href="{{ asset('assets/plugins/noUiSlider/nouislider.min.css') }}" rel="stylesheet"> --}}


    <!--Select2 [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/basic.css') }}" rel="stylesheet">

    <!--Bootstrap Timepicker [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">


    <!--Bootstrap Datepicker [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    <!--Dropzone [ OPTIONAL ]-->
    <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}" defer></script>

    <style type="text/css">
        #images {
            background: #eeeeee;
            padding: 20px 0;
        }
    </style>
</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body>
    <div id="app">

        <div id="container" class="effect aside-bright aside-fixed mainnav-fixed mainnav-lg print-content">

            <!--NAVBAR-->
            <!--===================================================-->
            <header id="navbar">
                <div id="navbar-container" class="boxed">

                    <!--Brand logo & name-->
                    <!--================================-->
                    <div class="navbar-header">
                        <a href="#" class="navbar-brand">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="') }}Nifty Logo" class="brand-icon">
                            <div class="brand-title" style="background-color: #ff5722;">
                                <span class="brand-text">LDI Apps</span>
                            </div>
                        </a>
                    </div>
                    <!--================================-->
                    <!--End brand logo & name-->


                    <!--Navbar Dropdown-->
                    <!--================================-->
                    <div class="navbar-content">
                        <ul class="nav navbar-top-links">

                            <!--Navigation toogle button-->
                            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                            <li class="tgl-menu-btn">
                                <a class="mainnav-toggle" href="#">
                                    <i class="demo-pli-list-view"></i>
                                </a>
                            </li>
                            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                            <!--End Navigation toogle button-->



                            <!--Search-->
                            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                            <li>
                                <div class="custom-search-form">
                                    <label class="btn btn-trans" for="search-input" data-toggle="collapse"
                                        data-target="#nav-searchbox">
                                        <i class="demo-pli-magnifi-glass"></i>
                                    </label>
                                    <form>
                                        <div class="search-container collapse" id="nav-searchbox">
                                            <input id="search-input" type="text" class="form-control"
                                                placeholder="Type for search...">
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                            <!--End Search-->

                        </ul>
                        <ul class="nav navbar-top-links">

                            <!--User dropdown-->
                            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                            <li id="dropdown-user" class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                                    <span class="ic-user pull-right">
                                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                        <!--You can use an image instead of an icon.-->
                                        <!--<img class="img-circle img-user media-object" src="{{ asset('assets/img/profile-photos/1.png') }}" alt="Profile Picture">-->
                                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                        <i class="demo-pli-male"></i>
                                    </span>

                                </a>


                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right panel-default">
                                    <ul class="head-list">
                                        <li>
                                            <a href="#"><i class="demo-pli-male icon-lg icon-fw"></i> Profile</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"><i
                                                    class="demo-pli-unlock icon-lg icon-fw"></i>
                                                {{ __('Logout') }} </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                            <!--End user dropdown-->


                            <li>
                                <a href="#" class="aside-toggle">
                                    <i class="demo-pli-dot-vertical"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--================================-->
                    <!--End Navbar Dropdown-->

                </div>
            </header>
            <!--===================================================-->
            <!--END NAVBAR-->

            <div class="boxed">

                <!--CONTENT CONTAINER-->
                <!--===================================================-->

                <div id="content-container">

                    <breadcrumb></breadcrumb>

                    <!--Page content-->
                    <!--===================================================-->
                    <div id="page-content">
                        <router-view></router-view>
                    </div>


                </div>
                <!--MAIN NAVIGATION-->
                <!--===================================================-->
                <nav id="mainnav-container">
                    <div id="mainnav">
                        <!--Menu-->
                        <!--================================-->
                        <div id="mainnav-menu-wrap" class="mainnav-fixed">
                            <div class="nano has-scrollbar">
                                <div class="nano-content">

                                    <!--Profile Widget-->
                                    <!--================================-->
                                    <div id="mainnav-profile" class="mainnav-profile">
                                        <div class="profile-wrap text-center">
                                            <div class="pad-btm">
                                                <img class="img-circle img-md"
                                                    src="{{ asset('assets/img/profile-photos/1.png') }}"
                                                    alt="Profile Picture">
                                            </div>
                                            <a href="#profile-nav" class="box-block" data-toggle="collapse"
                                                aria-expanded="false">
                                                <span class="pull-right dropdown-toggle">
                                                    <i class="dropdown-caret"></i>
                                                </span>
                                                <p class="mnp-name">{{ Auth::user()->name }}</p>
                                                <span class="mnp-desc">{{ Auth::user()->email }}</span>
                                            </a>
                                        </div>
                                        <div id="profile-nav" class="collapse list-group bg-trans">
                                            <a href="#" class="list-group-item">
                                                <i class="demo-pli-male icon-lg icon-fw"></i> View Profile
                                            </a>
                                            <router-link to="/about">
                                                <a href="#" class="list-group-item">
                                                    <i class="demo-pli-male icon-lg icon-fw"></i> About
                                                </a>
                                            </router-link>

                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form1').submit();" class="list-group-item">
                                                <i class="demo-pli-unlock icon-lg icon-fw"></i> {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form1" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>

                                        </div>
                                    </div>

                                    <ul id="mainnav-menu" class="list-group">

                                        <!--Category name-->
                                        <li class="list-header">Homepage</li>
                                        @if(auth()->user()->type == 'Admin')
                                        <li>
                                            <router-link tag="li" class="nav-item" to="dashboard"><a href="#">
                                                    <i class="fa fa-home"></i>
                                                    <span class="menu-title">Dashboard</span>
                                                </a></router-link>
                                        </li>

                                        @elseif(auth()->user()->type == 'MIS')
                                        <li>
                                            <router-link tag="li" class="nav-item" to="dashboard"><a href="#">
                                                    <i class="fa fa-home"></i>
                                                    <span class="menu-title">Dashboard</span>
                                                </a></router-link>
                                        </li>

                                        @elseif(auth()->user()->type == 'Supervisor')
                                        <li>
                                            <router-link tag="li" class="nav-item" to="dashboard1">
                                                <a href="#">
                                                    <i class="fa fa-home"></i>
                                                    <span class="menu-title">Dashboard</span>
                                                </a>
                                            </router-link>
                                        </li>

                                        @elseif(auth()->user()->type == 'Manager')
                                        <li>
                                            <router-link tag="li" class="nav-item" to="dashboard1">
                                                <a href="#">
                                                    <i class="fa fa-home"></i>
                                                    <span class="menu-title">Dashboard</span>
                                                </a>
                                            </router-link>
                                        </li>

                                        @elseif(auth()->user()->type == 'Customer Service')
                                        <li>
                                            <router-link tag="li" class="nav-item" to="dashboard2">
                                                <a href="#">
                                                    <i class="fa fa-home"></i>
                                                    <span class="menu-title">Dashboard</span>
                                                </a>
                                            </router-link>
                                        </li>

                                        @elseif(auth()->user()->type == 'Accounting')
                                        <li>
                                            <router-link tag="li" class="nav-item" to="dashboard2">
                                                <a href="#">
                                                    <i class="fa fa-home"></i>
                                                    <span class="menu-title">Dashboard</span>
                                                </a>
                                            </router-link>
                                        </li>
                                        @elseif(auth()->user()->type == 'Internal Audit')
                                        <li>
                                            <router-link tag="li" class="nav-item" to="dashboard2">
                                                <a href="#">
                                                    <i class="fa fa-home"></i>
                                                    <span class="menu-title">Dashboard</span>
                                                </a>
                                            </router-link>
                                        </li>

                                        @endif

                                        <li class="list-divider"></li>

                                        <!--Category name-->
                                        <li class="list-header">Transactions</li>
                                        <li>
                                            <router-link tag="li" class="nav-item" to="transactions"><a href="#">
                                                    <i class="fa fa-file-text-o"></i>
                                                    <span class="menu-title">Orders Transaction</span>
                                                </a></router-link>
                                        </li>

                                        <li>
                                            <router-link tag="li" class="nav-item" to="export"><a href="#">
                                                    <i class="fa fa-server"></i>
                                                    <span class="menu-title">Export Transaction</span>
                                                </a></router-link>
                                        </li>

                                        <li>
                                            <router-link tag="li" class="nav-item" to="export_aris"><a href="#">
                                                    <i class="fa fa-server"></i>
                                                    <span class="menu-title">Export Aris</span>
                                                </a></router-link>
                                        </li>

                                        <li>
                                            <router-link tag="li" class="nav-item" to="upload"><a href="#">
                                                    <i class="fa fa-upload"></i>
                                                    <span class="menu-title">Import Sales Invoice</span>
                                                </a></router-link>
                                        </li>

                                        <li class="list-header">Customer</li>
                                        <li>
                                            <router-link tag="li" class="nav-item" to="import_customer">
                                                <a href="#">
                                                    <i class="fa fa-cloud-upload"></i>
                                                    <span class="menu-title">
                                                        Import Customer
                                                    </span>
                                                </a>
                                            </router-link>
                                        </li>

                                        <li>
                                            <router-link tag="li" class="nav-item" to="/customer_masterfile"><a
                                                    href="#">
                                                    <i class="fa fa-group"></i>
                                                    <span class="menu-title">Customer Masterfile</span>
                                                </a></router-link>
                                        </li>

                                        <li>
                                            <router-link tag="li" class="nav-item" to="/customer_request">
                                                <a href="#">
                                                    <i class="fa fa-user-plus"></i>
                                                    <span class="menu-title">New Requests
                                                        <span v-if="$root.newRequest == null"
                                                            class="pull-right badge badge-warning"
                                                            style="display: hidden" id="new_requests">
                                                            {{ $new_requests }}
                                                        </span>
                                                        <span v-else-if="$root.newRequest == 0"
                                                            class="pull-right badge badge-warning"
                                                            style="display: hidden" id="new_requests">
                                                            0
                                                        </span>
                                                        <request-count v-else></request-count>
                                                    </span>
                                                </a>
                                            </router-link>
                                            <!--<li>-->
                                            <!--    <a href="#">-->
                                            <!--        <i class="fa fa-folder-open-o"></i>-->
                                            <!--        <span class="menu-title">Files</span>-->
                                            <!--        <i class="arrow"></i>-->
                                            <!--    </a>-->

                                            <!--Submenu-->
                                            <!--    <ul class="nav flex-column sub-menu">-->
                                            <!--        {{-- <router-link tag="li" class="nav-item" to="/usertype"><a class="nav-link"-->
                                            <!--    href="javascript:;">Usertype</a></router-link> --}}-->
                                            <!--        <router-link tag="li" class="nav-item" to="/account_group_code"><a-->
                                            <!--                class="nav-link" href="javascript:;">Account Group Codes</a>-->
                                            <!--        </router-link>-->
                                            <!--        <router-link tag="li" class="nav-item" to="/viewing_user"><a-->
                                            <!--                class="nav-link" href="javascript:;">Viewing User Setup</a>-->
                                            <!--        </router-link>-->
                                            <!--    </ul>-->
                                            <!--</li>-->


                                            @if(auth()->user()->type === 'Admin')
                                        <li class="list-divider"></li>


                                        <li class="list-header">Masterfiles</li>
                                        <li>
                                            @if(auth()->user()->type === 'Admin')
                                            <router-link tag="li" class="nav-item" to="item"><a href="#">
                                                    <i class="fa fa-list"></i>
                                                    <span class="menu-title">Items</span>
                                                </a></router-link>
                                            @elseif(auth()->user()->type === 'Supervisor')
                                            <router-link tag="li" class="nav-item" to="item1"><a href="#">
                                                    <i class="fa fa-list"></i>
                                                    <span class="menu-title">Items</span>
                                                </a></router-link>
                                            @endif

                                        </li>

                                        <li>
                                            <router-link tag="li" class="nav-item" to="upload_image"><a href="#">
                                                    <i class="fa fa-server"></i>
                                                    <span class="menu-title">Upload Item Images</span>
                                                </a></router-link>
                                        </li>

                                        <li>
                                            <router-link tag="li" class="nav-item" to="promo"><a href="#">
                                                    <i class="demo-pli-photo-2"></i>
                                                    <span class="menu-title">Promo</span>
                                                </a></router-link>
                                        </li>

                                        <li>
                                            <router-link tag="li" class="nav-item" to="/salesman">
                                                <a href="#">
                                                    <i class="fa fa-ambulance"></i>
                                                    <span class="menu-title">Salesman list</span>
                                                </a>
                                            </router-link>
                                        </li>

                                        <li>
                                            <router-link tag="li" class="nav-item" to="/salesman_routes">
                                                <a href="#">
                                                    <i class="fa fa-leanpub"></i>
                                                    <span class="menu-title">Salesman Route</span>
                                                </a>
                                            </router-link>
                                        </li>

                                        <li>
                                            <router-link tag="li" class="nav-item" to="/hepe_de_viaje">
                                                <a href="#">
                                                    <i class="fa fa-user-secret"></i>
                                                    <span class="menu-title">Jepe de Viaje</span>
                                                </a>
                                            </router-link>
                                        </li>

                                        <li>
                                            <router-link tag="li" class="nav-item" to="/suppliers">
                                                <a href="#">
                                                    <i class="fa fa-address-book"></i>
                                                    <span class="menu-title">Principal</span>
                                                </a>
                                            </router-link>
                                        </li>

                                        <li>
                                            <router-link tag="li" class="nav-item" to="/item_discount">
                                                <a href="#">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    <span class="menu-title">Item Discounts</span>
                                                </a>
                                            </router-link>
                                        </li>

                                        <li>
                                            <router-link tag="li" class="nav-item" to="/setup_user"><a href="#">
                                                    <i class="fa fa-user-circle"></i>
                                                    <span class="menu-title">Setup Backend User</span>
                                                </a></router-link>
                                        </li>

                                        <li>
                                            <router-link tag="li" class="nav-item" to="/account_group_code"><a href="#">
                                                    <i class="fa fa-group"></i>
                                                    <span class="menu-title">Account Group Code</span>
                                                </a>
                                            </router-link>
                                        </li>

                                        <li>
                                            <router-link tag="li" class="nav-item" to="/viewing_user"><a href="#">
                                                    <i class="fa fa-group"></i>
                                                    <span class="menu-title">Viewing User Setup</span>
                                                </a>
                                            </router-link>
                                        </li>

                                        @endif

                                        <li class="list-divider"></li>
                                        <li class="list-header">Reports</li>

                                        <li>
                                            <router-link tag="li" class="nav-item" to="report">
                                                <a href="#">
                                                    <i class="fa fa-print"></i>
                                                    <span class="menu-title">Variance Tracking Report</span>
                                                </a></router-link>
                                        </li>

                                        <li>
                                            <router-link tag="li" class="nav-item" to="/sales_report"><a href="#">
                                                    <i class="fa fa-print"></i>
                                                    <span class="menu-title">Sales Report</span>
                                                </a></router-link>
                                        </li>


                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--================================-->
                        <!--End menu-->
                    </div>
                </nav>
                <!--===================================================-->
                <!--END MAIN NAVIGATION-->
            </div>
            <!-- FOOTER -->
            <!--===================================================-->
            <footer id="footer">

                <!-- Visible when footer positions are fixed -->
                <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
                <div class="show-fixed pad-rgt pull-right">
                    You have <a href="#" class="text-main"><span class="badge badge-danger">3</span> pending action.</a>
                </div>



                <!-- Visible when footer positions are static -->
                <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
                <div class="hide-fixed pull-right pad-rgt">
                    {{-- 14GB of <strong>512GB</strong> Free. --}}
                </div>



                <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
                <!-- Remove the class "show-fixed" and "hide-fixed" to make the content always appears. -->
                <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

                <p class="pad-lft">&#0169; 2020 AGC Retail</p>



            </footer>
            <!--===================================================-->
            <!-- END FOOTER -->


            <!-- SCROLL PAGE BUTTON -->
            <!--===================================================-->
            <button class="scroll-top btn">
                <i class="pci-chevron chevron-up"></i>
            </button>
            <!--===================================================-->
        </div>
    </div>


    <!--===================================================-->
    <!-- END OF CONTAINER -->





    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--jQuery [ REQUIRED ]-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="{{ asset('assets/js/nifty.min.js') }}"></script>

    <!--=================================================-->

    <!--Demo script [ DEMONSTRATION ]-->
    {{-- <script src="{{ asset('assets/js/demo/nifty-demo.min.js') }}"></script> --}}

    <!--DataTables [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/datatables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/media/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js') }}">
    </script>

    <!--Flot Chart [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.categories.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.orderBars.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.resize.min.js') }}"></script>

    <!--Dropzone [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>

    <!--Bootbox Modals [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/bootbox/bootbox.min.js') }}"></script>

    <!--Bootstrap Wizard [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>

    <!--Bootstrap Validator [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/bootstrap-validator/bootstrapValidator.min.js') }}"></script>

    <!--Masked Input [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/masked-input/jquery.maskedinput.min.js') }}"></script>

    <!--Form Wizard [ SAMPLE ]-->
    {{-- <script src="{{ asset('assets/js/demo/form-wizard.js') }}"></script> --}}

    <!--Switchery [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/switchery/switchery.min.js') }}"></script>


    <!--Bootstrap Select [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>


    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>


    <!--Chosen [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/chosen/chosen.jquery.min.js') }}"></script>


    <!--noUiSlider [ OPTIONAL ]-->
    {{-- <script src="{{ asset('assets/plugins/noUiSlider/nouislider.min.js') }}"></script> --}}


    <!--Select2 [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>


    <!--Bootstrap Timepicker [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>


    <!--Bootstrap Datepicker [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <!--Form File Upload [ SAMPLE ]-->
    {{-- <script src="{{ asset('assets/js/demo/form-file-upload.js') }}"></script> --}}

    <!--FooTable [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/fooTable/dist/footable.all.min.js') }}"></script>


    <!--FooTable Example [ SAMPLE ]-->
    <script src="{{ asset('assets/js/demo/tables-footable.js') }}"></script>



    <!--Form Component [ SAMPLE ]-->
    {{-- <script src="{{ asset('assets/js/demo/form-component.js') }}"></script> --}}







</body>

<!-- Mirrored from www.themeon.net/nifty/v2.9.1/pages-blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Oct 2019 07:37:26 GMT -->

</html>