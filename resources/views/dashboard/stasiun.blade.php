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
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
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
<div id="page-wrapper" class="gray-bg dashbard-1" style="min-height: 689px;">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i></a>
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
        <div class="col-lg-10">
            <h2>Form isian Stasiun</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/home">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Formulir</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Stasiun</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Form isian Stasiun</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <h1>Stasiun</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Hapus</th>
                                    <th>Kode Stasiun</th>
                                    <th>Nama Stasiun</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stasiun as $b)
                                <tr>
                                    <td>
                                        <a href="{{url('/stasiun/d?id=').$b['id']}}" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <td>{{$b['kode']}}</td>
                                    <td>{{$b['nama']}}</td>
                                    <td>{{$provinsi->where('id_prov', $b['id_prov'])->first()['nama']}}</td>
                                    <td>{{$kabupaten->where('id_kab', $b['id_kab'])->first()['nama']}}</td>
                                    <td>{{$b['status']}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <form action="{{url('/stasiun/c')}}" method="post">
                                        @csrf
                                        <td><button class="btn btn-info submit"><i class="fa fa-plus"></i></button></td>
                                        <td><input name="kode" class="form-control" placeholder="kode" required></td>
                                        <td><input name="nama" class="form-control" placeholder="nama" required></td>
                                        <td>
                                        <select class="form-control m-b" name="id_prov" id="provinsi" required>
                                        </select>
                                        </td>
                                        <td>
                                        <select class="form-control m-b" name="id_kab" id="kabupaten" required>
                                        </select>
                                        </td>
                                        <td><input name="status" class="form-control" placeholder="status" required></td>
                                    </form>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div>
            <strong>Copyright</strong> Primakom © 2020
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

                }, 1300);

                $.ajax({
                    url: "{{url('/getProvinsi')}}",
                    type: "GET",
                    success: function(result) {
                        provinsi_list = result;
                        var provinsi = $('#provinsi');
                        // provinsi.empty();
                        // provinsi.append('<option></option>');
                        for (var i = 0; i < provinsi_list.length; i++) {
                            provinsi.append('<option value='+provinsi_list[i]['id_prov']+'>'+provinsi_list[i]['nama']+'</option>');
                        }
                    }
                });

                $.ajax({
                    url: "{{url('/getKabupaten/11')}}",
                    type: "GET",
                    success: function(result) {
                        kabupaten_list = result;
                        var kabupaten = $('#kabupaten');
                        // provinsi.empty();
                        // provinsi.append('<option></option>');
                        for (var i = 0; i < kabupaten_list.length; i++) {
                            kabupaten.append('<option value='+kabupaten_list[i]['id_prov']+'>'+kabupaten_list[i]['nama']+'</option>');
                        }
                    }
                });


                $('#provinsi').change(function() {
                    var id_prov = $(this).find(':selected')[0].value;
                    var kabupaten_list = [];
                    $.ajax({
                        url: "{{url('/getKabupaten')}}"+'/'+id_prov,
                        type: "GET",
                        success: function(result) {
                            kabupaten_list = result;
                            var kabupaten = $('#kabupaten');
                            var kecamatan = $('#kecamatan');
                            var kelurahan = $('#kelurahan');
                            kabupaten.empty();
                            kecamatan.empty();
                            kelurahan.empty();
                            for (var i = 0; i < kabupaten_list.length; i++) {
                                kabupaten.append('<option value='+kabupaten_list[i]['id_kab']+'>'+kabupaten_list[i]['nama']+'</option>');
                            }
                        }
                    });
                });

    });
</script>
@endsection