@extends('layouts.dashboard')
@section('title', 'Home')
@section('header')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">

<!-- Toastr style -->
<link href="{{asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

<!-- Gritter -->
<link href="{{asset('js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">

<link href="{{asset('css/animate.css')}}" rel="stylesheet">
<link href="{{asset('css/style.css')}}" rel="stylesheet">

<!-- Sweetalert -->
<link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">

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
            <h2>Form verifikasi Keanggotaan</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/home">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Formulir</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Verifikasi Anggota</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                @section('tabel_asosiasi')
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Asosiasi</h5>
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Terverifikasi</th>
                                    <th>Token</th>
                                    <th>Nama Asosiasi</th>
                                    <th>Edit/Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($asosiasi as $ass)
                                <tr>
                                    <td>
                                        @if($user->where('id', $ass['user_id'])->first()['verified'])
                                        <button class='btn btn-success'><i class="fa fa-check"></i></button>
                                        @else
                                        <button class='btn btn-danger'><i class="fa fa-times"></i></button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->where('id', $ass['user_id'])->first()['verified'])
                                        <button class='btn btn-success'>TERVERIFIKASI</button>
                                        @else
                                        <input type="checkbox" data-toggle="toggle"
                                            data-on="{{$user->where('id', $ass['user_id'])->first()['token']}}"
                                            data-off="cek Token" data-onstyle="success" data-offstyle="danger">
                                        @endif
                                    </td>
                                    <td>{{$ass['nama']}}</td>
                                    <td>
                                      <a class="btn btn-info" href="{{url('edit/asosiasi/').'?id='.$ass['id']}}"><i class="fa fa-pencil"></i></a>
                                      <a class="btn btn-danger" href="{{url('keanggotaan/d').'?id='.$ass['user_id']}}"><i class="fa fa-trash"></i></a>
                                   </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endsection

                @section('tabel_perusahaan')
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Perusahaan</h5>
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Terverifikasi</th>
                                    <th>Token</th>
                                    <th>Nama</th>
                                    <th>Edit/Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($perusahaan as $usaha)
                                <tr>
                                    <td>
                                        @if($user->where('id', $usaha['user_id'])->first()['verified'] == 1)
                                        <button class='btn btn-success'><i class="fa fa-check"></i></button>
                                        @else
                                        <button class='btn btn-danger'><i class="fa fa-times"></i></button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->where('id', $usaha['user_id'])->first()['verified'] == 1)
                                        <button class='btn btn-success'>TERVERIFIKASI</button>
                                        @else
                                        <input type="checkbox" data-toggle="toggle"
                                            data-on="{{$user->where('id', $usaha['user_id'])->first()['token']}}"
                                            data-off="cek Token" data-onstyle="success" data-offstyle="danger">
                                        @endif
                                    </td>
                                    <td>{{$usaha['nama']}}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{url('edit/perusahaan/').'?id='.$usaha['id']}}"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger" href="{{url('keanggotaan/d').'?id='.$usaha['user_id']}}"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr> @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> @endsection
                @section('tabel_professional') <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Professional</h5>
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Terverifikasi</th>
                                    <th>Token</th>
                                    <th>Nama</th>
                                    <th>Edit/Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($professional as $prof)
                                <tr>
                                    <td>
                                        @if($user->where('id', $prof['user_id'])->first()['verified'])
                                        <button class='btn btn-success'><i class="fa fa-check"></i></button>
                                        @else
                                        <button class='btn btn-danger'><i class="fa fa-times"></i></button>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="checkbox" data-toggle="toggle"
                                            data-on="{{$user->where('id', $prof['user_id'])->first()['token']}}"
                                            data-off="cek Token" data-onstyle="success" data-offstyle="danger">
                                    </td>
                                    <td>{{$prof['nama']}}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{url('edit/professional/').'?id='.$prof['id']}}"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger" href="{{url('keanggotaan/d').'?id='.$prof['user_id']}}"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endsection
                @section('tabel_noanggota') <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Professional</h5>
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No Anggota</th>
                                    <th>Terpakai</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($noanggota as $na)
                                <tr>
																	<td>{{$na->nomor}}</td>
																	<td><button class="btn btn-warning">Belum</button></td>
                                  <td><a class="btn btn-danger" href="{{url('generate_nomor_anggota/d?id=').$na->id}}"><i class="fa fa-times"></i></td>
                                </tr>
                                @endforeach
																<tr>
																<td colspan="2">
																<a class="btn btn-info" href="{{url('generate_nomor_anggota')}}">Generate</a>
																</td>
																</tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endsection

                @if(auth()->user()->group_id == 1)
				@yield('tabel_noanggota')
                @yield('tabel_asosiasi')
                @yield('tabel_perusahaan')
                @yield('tabel_professional')
                @elseif(auth()->user()->group_id == 2)
                @yield('tabel_perusahaan')
                @yield('tabel_professional')
                @elseif(auth()->user()->group_id == 6)
                @yield('tabel_perusahaan')
                @yield('tabel_professional')
                @endif
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

<!-- Sweetalert -->
<script src="{{asset('js/plugins/sweetalert/sweetalert.min.js')}}"></script>

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

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

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
    @if (\Session::has('message'))
        swal({
            type: "warning",
            title: "Gagal hapus user",
            text: "{!! \Session::get('message') !!}"
        });
    @endif

    $('.btn-danger').on('click', function(e) {
        e.preventDefault();
        var link = $(this).attr('href');
        swal({
            title: "Apakah anda yakin ?",
            text: "Menghapus user ini",
            showCancelButton: true,
            closeOnConfirm: false,
        }, function() {
            window.location.href = link;
        });
    });
</script>
@endsection
