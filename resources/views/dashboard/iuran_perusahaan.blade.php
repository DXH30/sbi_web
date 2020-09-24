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
            <h2>Form isian Iuran</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/home">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Formulir</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Iuran</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Form isian Iuran</h5>
                        @if($errors->any())
                        <h4>{{ $errors->first() }}</h4>
                        @endif

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
                        <h1>Iuran</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Asosiasi</th>
                                    <th>Waktu </th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Bukti Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
@foreach($iuran as $i)
                      <tr>
                                    <td>{{$i->asos_id}}</td>
                                    <td>
                                        Mulai : {{$i->waktu_mulai}}<br />
                                        Selesai : {{$i->waktu_selesai}}
                                    </td>
                                    <td>
                                        {{$i->harga_per_bulan}}/Bulan<br />
                                        {{$i->harga_per_tahun}}/Tahun
                                    </td>
                                    <td>
<?php
$where = array(
    ['iuran_id', '=', $i->id],
    ['user_id' , '=', Auth::id()]
);
$data_iuran_t = $data_iuran->where('iuran_id', $i->id)->where('user_id', Auth::id());
$terkonfirmasi = $data_iuran_t->first()['terkonfirmasi'];
$jumlah_t = $data_iuran_t->count();
?>
                                                     @if($jumlah_t > 0 && $terkonfirmasi == true)
                                                     <button type="button" class="btn btn-info">Sudah</button>
                                                     @elseif($jumlah_t > 0 && $terkonfirmasi == false)
                                                     <button type="button" class="btn btn-danger">Belum</button>
                                                     <a href="{{url('img/bukti_pombayaran').'/'.$data_iuran_t->first()['bukti_pembayaran']}}">
                                                         Cek
                                                     </a>
                                                     @else
                                                     <button type="button" class="btn btn-default">Kosong</button>
                                                     @endif
                                                     <td>
                                                         <form method="post" enctype="multipart/form-data" action="{{url('iuran/input')}}">
                                                             @csrf
                                                             <input type="hidden" name="iuran_id" value="{{$i->id}}">
                                                             <div class="form-group row">
                                                                 <div class="custom-file col-md-10">
                                                                     <input id="bukti_pembayaran" type="file" class="custom-file-input" name="bukti_pembayaran" accept="image/*">
                                                                     <label for="bukti_pembayaran" class="custom-file-label">Bukti Pembayaran</label>
                                                                 </div>
                                                                 <div class="col-md-2">
                                                                     <input type="submit" value="Kirim" class="btn btn-success">
                                                                 </div>
                                                             </div>
                                                         </form>
                                                     </td>
                                </tr>
@endforeach
                                @foreach($daftar_asosiasi as $da)
                                @foreach($iuran as $i)
                                @if($i->asos_id == $da->asos_id)
                                <tr>
                                    <td>{{$da->asos_id}}</td>
                                    <td>
                                        Mulai : {{$i->waktu_mulai}}<br />
                                        Selesai : {{$i->waktu_selesai}}
                                    </td>
                                    <td>
                                        {{$i->harga_per_bulan}}/Bulan<br />
                                        {{$i->harga_per_tahun}}/Tahun
                                    </td>
                                    <td>
<?php
$where = array(
    ['iuran_id', '=', $i->id],
    ['user_id' , '=', Auth::id()]
);
$data_iuran_t = $data_iuran->where('iuran_id', $i->id)->where('user_id', Auth::id());
$terkonfirmasi = $data_iuran_t->first()['terkonfirmasi'];
$jumlah_t = $data_iuran_t->count();
?>
                                                     @if($jumlah_t > 0 && $terkonfirmasi == true)
                                                     <button type="button" class="btn btn-info">Sudah</button>
                                                     @elseif($jumlah_t > 0 && $terkonfirmasi == false)
                                                     <button type="button" class="btn btn-danger">Belum</button>
                                                     <a href="{{url('img/bukti_pombayaran').'/'.$data_iuran_t->first()['bukti_pembayaran']}}">
                                                         Cek
                                                     </a>
                                                     @else
                                                     <button type="button" class="btn btn-default">Kosong</button>
                                                     @endif
                                                     <td>
                                                         <form method="post" enctype="multipart/form-data" action="{{url('iuran/input')}}">
                                                             @csrf
                                                             <input type="hidden" name="iuran_id" value="{{$i->id}}">
                                                             <div class="form-group row">
                                                                 <div class="custom-file col-md-10">
                                                                     <input id="bukti_pembayaran" type="file" class="custom-file-input" name="bukti_pembayaran" accept="image/*">
                                                                     <label for="bukti_pembayaran" class="custom-file-label">Bukti Pembayaran</label>
                                                                 </div>
                                                                 <div class="col-md-2">
                                                                     <input type="submit" value="Kirim" class="btn btn-success">
                                                                 </div>
                                                             </div>
                                                         </form>
                                                     </td>
                                </tr>
                                @endif
                                @endforeach
                                @endforeach
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


<!-- Input Mask-->
<script src="{{asset('js/plugins/jasny/jasny-bootstrap.min.js')}}"></script>

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
});
</script>
@endsection
