@extends('layouts.dashboard')
@section('title', 'Home')
@section('header')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">

<!-- Toastr style -->
<link href="{{asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

<!-- Gritter -->
<link href="{{asset('js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">

<link href="{{asset('css/animate.css')}}" rel="stylesheet">
<link href="{{asset('css/style.css')}}" rel="stylesheet">

<style type="text/css">
.jqstooltip {
    position: absolute;
    left: 0px;
    top: 0px;
    visibility: hidden;
    background: rgb(0, 0, 0) transparent;
    background-color: rgba(0, 0, 0, 0.6);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#98999999, endColorstr=#99000000);
    -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
    color: white;
    font: 10px arial, san serif;
    text-align: left;
    white-space: nowrap;
    padding: 5px;
    border: 1px solid white;
    z-index: 10000;
}

    .jqsfield {
        color: white;
        font: 10px arial, san serif;
        text-align: left;
    }
</style>
@endsection

@section('content')
<div id="page-wrapper" class="gray-bg" style="min-height: 689px;">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li style="padding: 20px">
                    <span class="m-r-sm text-muted welcome-message">Selamat datang di SBI</span>
                </li>
                <li>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit"><i class="fa fa-sign-out"></i> Logout</button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>Pilih Mode Transportasi Udara</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Mode Transportasi</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <a href="{{url('kendaraan?mt=3')}}">
                    <div class="widget navy-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-plane fa-5x"></i>
                            <h1 class="font-bold no-margins">
                                Ketersediaan Pesawat
                            </h1>
                        </div>
                    </div>
                </a>
                <a href="{{url('regulated_agent')}}">
                    <div class="widget blue-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-user fa-5x"></i>
                            <h1 class="font-bold no-margins">
                                Regulated Agent
                            </h1>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-5">
                <a href="{{url('airport_warehouse')}}">
                    <div class="widget yellow-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-home fa-5x"></i>
                            <h1 class="font-bold no-margins">
                                Airport Warehouse
                            </h1>
                        </div>
                    </div>
                </a>
                <a href="{{url('packing')}}">
                    <div class="widget lazur-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-cube fa-5x"></i>
                            <h1 class="font-bold no-margins">
                                Packing
                            </h1>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-5">
                <a href="{{url('agent_cargo')}}">
                    <div class="widget yellow-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-opencart fa-5x"></i>
                            <h1 class="font-bold no-margins">
                                Agent Cargo
                            </h1>
                        </div>
                    </div>
                </a>
                <a href="{{url('port_to_port')}}">
                    <div class="widget lazur-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-crosshairs fa-5x"></i>
                            <h1 class="font-bold no-margins">
                                Port to Port
                            </h1>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-5">
                <a href="{{url('door_to_door')}}">
                    <div class="widget red-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-home fa-5x"></i>
                            <h1 class="font-bold no-margins">
                               Door to Door 
                            </h1>
                        </div>
                    </div>
                </a>
                <a href="{{url('order_truck_services')}}">
                    <div class="widget blue-bg p-lg text-center">
                        <div class="m-b-md">
                            <i class="fa fa-truck fa-5x"></i>
                            <h1 class="font-bold no-margins">
                                Order Truck Services
                            </h1>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    @endsection

    @section('script')

    <!-- Mainly scripts -->
    <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!-- Flot -->
    <script src="{{asset('js/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{asset('js/plugins/flot/jquery.flot.spline.js')}}"></script>
    <script src="{{asset('js/plugins/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('js/plugins/flot/jquery.flot.pie.js')}}"></script>

    <!-- Peity -->
    <script src="{{asset('js/plugins/peity/jquery.peity.min.js')}}"></script>
    <script src="{{asset('js/demo/peity-demo.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{asset('js/inspinia.js')}}"></script>
    <script src="{{asset('js/plugins/pace/pace.min.js')}}"></script>

    <!-- jQuery UI -->
    <script src="{{asset('js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

    <!-- GITTER -->
    <script src="{{asset('js/plugins/gritter/jquery.gritter.min.js')}}"></script>

    <!-- Sparkline -->
    <script src="{{asset('js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Sparkline demo data  -->
    <script src="{{asset('js/demo/sparkline-demo.js')}}"></script>

    <!-- ChartJS-->
    <script src="{{asset('js/plugins/chartJs/Chart.min.js')}}"></script>

    <!-- Toastr -->
    <script src="{{asset('js/plugins/toastr/toastr.min.js')}}"></script>


    <script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Sistem Informasi Ekspedisi', 'Selamat datang di Octomoda');

            },
                1300);
        });
    </script>
    @endsection