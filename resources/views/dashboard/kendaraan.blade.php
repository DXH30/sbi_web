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

{{-- Datatable --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/>

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
            <h2>Basic Form</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/home">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Formulir</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Kendaraan</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        @section('ketersediaan_kendaraan')
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Kendaraan</h5>
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
                        <h1>Ketersediaan kendaraan</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Hapus</th>
                                    <th>Kendaraan</th>
                                    <th>Lettercode</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ketersediaan_kendaraan as $kknd)
                                <tr>
                                    <td>
                                        <a href="{{url('/kendaraan/d?id=').$kknd['id']}}" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <?php
					$dkendaraan = $kendaraanl->where('id', $kknd['id_kendaraan'])->first()['deskripsi'] ?? '';
					if(isset($dkendaraaan)):
                                        $deskripsi = json_decode($dkendaraan, true);
                                        $deskripsi_key = array_keys($deskripsi);
                                        ?>
                                        <table>
                                            @foreach($deskripsi_key as $key)
                                            <tr>
                                                <td><strong>{{$key}}</strong></td>
                                                <td>{{$deskripsi[$key]}}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        {{$lokasi->where('id', $kknd['id_letter'])->first()['lettercode']}}
                                    </td>
                                    <td>{{$kknd['jumlah']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @section('kendaraan')
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Kendaraan</h5>
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
                        <h1>Kendaraan</h1>
                        <table id="tabel_kendaraan" class="table" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Deskripsi</th>
                                    <th>Ukuran Karoseri</th>
                                    <th>Ukuran Mobil</th>
                                    <th>Berat</th>
                                    <th>Spesifikasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kendaraanl as $knd)
                                <tr>
                                    <td>
                                        <img width="120px" src='{{asset('img/kendaraan/').'/'.$knd['gambar']}}'>
                                        <a href="{{url('/kendaraan/d?id=').$knd['id']}}" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <a href="{{url('/edit/kendaraan?id=').$knd['id']}}" class="btn btn-success">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                        $deskripsi = json_decode($knd['deskripsi'], true);
                                        $deskripsi_key = array_keys($deskripsi);
                                        ?>
                                        <table>
                                            <tr>
                                                <th>Jenis</th>
                                                <td>
                                                    {{$jenis_kendaraan->where('id', $knd['id_jenis'])->first()['jenis']}}
                                                </td>
                                            </tr>
                                            @foreach($deskripsi_key as $key)
                                            <tr>
                                                <td><strong>{{$key}}</strong></td>
                                                <td>{{$deskripsi[$key]}}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                    <td>
                                        <?php
                                        $ukuran = json_decode($knd['ukuran'], true);
                                        $ukuran_k_key = array_keys($ukuran['ukuran_karoseri']);
                                        $ukuran_m_key = array_keys($ukuran['ukuran_mobil']);
                                        ?>
                                        <table>
                                            @foreach($ukuran_k_key as $key)
                                            <tr>
                                                <td><strong>{{$key}}</strong></td>
                                                <td>{{$ukuran['ukuran_karoseri'][$key]}}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            @foreach($ukuran_m_key as $key)
                                            <tr>
                                                <td><strong>{{$key}}</strong></td>
                                                <td>{{$ukuran['ukuran_mobil'][$key]}}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                    <td>
                                        <?php
                                        $berat = json_decode($knd['berat'], true);
                                        $berat_key = array_keys($berat);
                                        ?>
                                        <table>
                                            @foreach($berat_key as $key)
                                            <tr>
                                                <td><strong>{{$key}}</strong></td>
                                                <td>{{$berat[$key]}}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                    <td>
                                        <?php
                                        $spesifikasi = json_decode($knd['spesifikasi'], true);
                                        $spesifikasi_key = array_keys($spesifikasi);
                                        ?>
                                        <table>
                                            @foreach($spesifikasi_key as $key)
                                            <tr>
                                                <td><strong>{{$key}}</strong></td>
                                                <td>{{$spesifikasi[$key]}}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Formulir Kendaraan</h5>
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
                        {{-- Cek grup Admin atau yang lainnya --}}
                        @if(auth()->user()->group_id == 1)
                        <form method="post" action="{{ url('kendaraan/c')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10"><input type="text" name="deskripsi" class="form-control"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">No Kendaraan</label>
                                <div class="col-sm-10"><input type="text" name="no" class="form-control"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Merk</label>
                                <div class="col-sm-10"><input type="text" name="merk" class="form-control"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ukuran Karoseri</label>
                                <div class="col-sm-2">
                                    <input type="text" name="ukuran_karoseri_tp" class="form-control"
                                        placeholder="Tipe">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="ukuran_karoseri_p" class="form-control"
                                        placeholder="Panjang">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="ukuran_karoseri_l" class="form-control"
                                        placeholder="Lebar">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="ukuran_karoseri_t" class="form-control"
                                        placeholder="Tinggi">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="ukuran_karoseri_d" class="form-control"
                                        placeholder="Dalam">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ukuran mobil</label>
                                <div class="col-sm-3">
                                    <input type="text" name="ukuran_mobil_p" class="form-control" placeholder="Panjang">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" name="ukuran_mobil_l" class="form-control" placeholder="Lebar">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" name="ukuran_mobil_t" class="form-control" placeholder="Tinggi">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row"><label class="col-sm-2 col-form-label">Berat</label>
                                <div class="col-sm-5"><input type="text" name="berat_kosong" class="form-control"
                                        placeholder="Kosong">
                                </div>
                                <div class="col-sm-5"><input type="text" name="berat_max" class="form-control"
                                        placeholder="Max"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Model Mesin</label>
                                <div class="col-sm-10"><input type="text" name="model_mesin" class="form-control"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Kap Silinder</label>
                                <div class="col-sm-10"><input type="text" name="kap_silinder" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Kecepatan Max</label>
                                <div class="col-sm-10"><input type="text" name="kecepatan_max" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Tenaga Max</label>
                                <div class="col-sm-10"><input type="text" name="tenaga_max" class="form-control"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="custom-file">
                                    <input id="gambar" type="file" class="custom-file-input" name="gambar">
                                    <label for="gambar" class="custom-file-label">Gambar</label>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row"><label class="col-sm-2 col-form-label">Jenis</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="id_jenis">
                                        @foreach($jenis_kendaraan as $jk)
                                        @if(isset($jenis_kendaraan->first()->id) && $jk['id'] ==
                                        $jenis_kendaraan->first()->id)
                                        <option value="{{$jk['id']}}" selected>{{$jk['jenis']}}</option>
                                        @else
                                        <option value="{{$jk['id']}}">{{$jk['jenis']}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                                </div>
                            </div>
                        </form>
                        <script>
                            document.querySelector('.custom-file-input').addEventListener('change',function(e){
                                var fileName = document.getElementById("gambarm").files[0].name;
                                var nextSibling = e.target.nextElementSibling
                                nextSibling.innerText = fileName
                                });
                        </script>
                        @elseif(auth()->user()->group_id == 3 || auth()->user()->group_id == 4)
                        @foreach($jenis_kendaraan as $jk)
                        <a href="{{url('kendaraan?&mt=').$mt.'&jn='.$jk['id']}}"
                            class="btn btn-info">{{$jk['jenis']}}</a>
                        @endforeach
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Deskripsi</th>
                                    <th>Ketersediaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kendaraan as $knd)
                                <form method="post" action="{{url('kendaraan/c')}}">
                                    @csrf
                                    <tr>
                                        <td>
                                            <img width="100px" src='{{asset('img/kendaraan/').'/'.$knd['gambar']}}'>
                                        </td>
                                        <td>
                                            <input type="hidden" name="id" value="{{$knd['id']}}">
                                            <?php
                                            $deskripsi = json_decode($knd['deskripsi'], true);
                                            $deskripsi_key = array_keys($deskripsi);
                                            ?>
                                            <table>
                                                @foreach($deskripsi_key as $key)
                                                <tr>
                                                    <td><strong>{{$key}}</strong></td>
                                                    <td>{{$deskripsi[$key]}}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                        <td>
                                            <div class="row col-sm-12">
                                                <label class="col-form-label col-sm-2" for="jumlah">Jumlah</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="jumlah" class="form-control">
                                                </div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="row col-sm-12">
                                                @if($_GET['mt'] == 1)
                                                <label class="col-form-label col-sm-2" for="id_terminal">Terminal</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control m-b" id="id_terminal" name="id_terminal">
                                                        @foreach($terminal as $lk)
                                                        <option value="{{$lk['id']}}">
                                                            {{$lk['kode']}} :
                                                            {{$lk['nama']}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @elseif($_GET['mt'] == 2)
                                                <label class="col-form-label col-sm-2" for="id_pelabuhan">Pelabuhan</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control m-b" id="id_pelabuhan" name="id_pelabuhan">
                                                        @foreach($pelabuhan as $lk)
                                                        <option value="{{$lk['id']}}">
                                                            {{$lk['kode']}} :
                                                            {{$lk['nama']}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @elseif($_GET['mt'] == 4)
                                                <label class="col-form-label col-sm-2" for="id_stasiun">Stasiun</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control m-b" id="id_stasiun" name="id_stasiun">
                                                        @foreach($stasiun as $lk)
                                                        <option value="{{$lk['id']}}">
                                                            {{$lk['kode']}} :
                                                            {{$lk['nama']}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @elseif($_GET['mt'] == 3)
                                                <label class="col-form-label col-sm-2" for="id_bandara">Bandara</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control m-b" id="id_bandara" name="id_bandara">
                                                        @foreach($bandara as $lk)
                                                        <option value="{{$lk['id']}}">
                                                            {{$lk['kode']}} :
                                                            {{$lk['nama']}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="row col-sm-12">
                                                <label class="col-form-label col-sm-2" for="id_letter">Kode Pos</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control m-b" name="id_letter">
                                                        @foreach($kode_pos as $lk)
                                                        <option value="{{$lk['id']}}">
                                                            {{$lk['kode']}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="hr-line-dashed"></div>
                                            <div class="row col-sm-12">
                                                <label class="col-form-label col-sm-2" for="id_status">Status
                                                    Unit</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control m-b" name="id_status">
                                                        @foreach($status_kendaraan as $st)
                                                        <option value="{{$st['id']}}">
                                                            {{$st['status']}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="row">
                                                <button class="btn btn-primary btn-block" type="submit">Simpan</button>
                                            </div>
                                        </td>
                                    </tr>
                                </form>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if(auth()->user()->group_id == 1)
        @yield('kendaraan')
        @elseif(auth()->user()->group_id == 3 || auth()->user()->group_id == 4)
        @yield('ketersediaan_kendaraan')
        @endif
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
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>
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
