@extends('layouts.dashboard')
@section('title', 'Profile')
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
            <h2>Basic Form</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/home">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Setup</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Profile</strong>
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
                        <h5>Sebelum melanjutkan <small>Mohon lengkapi profil anda terlebih dahulu</small></h5>
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
                        {{-- Cek grup Admin atau yang lainnya --}}
                        @if(auth()->user()->group_id == 1)
                        <form method="post" enctype="multipart/form-data" action="{{url('profile/c')}}">
                            @csrf
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama Admin</label>
                                <div class="col-sm-10"><input type="text" name="nama" class="form-control"
                                        value="{{$admin->first()->nama ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">No. Telp Kantor</label>
                                <div class="col-sm-10"><input type="text" name="no_telp" class="form-control"
                                        value="{{$admin->first()->no_telp ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-white btn-sm" type="submit">Hapus</button>
                                    <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                                </div>
                            </div>
                        </form>
                        @elseif(auth()->user()->group_id == 2)
                        <form method="post" enctype="multipart/form-data" action="{{url('profile/c')}}">
                            @csrf
                            <div class="form-group row"><label class="col-sm-2 col-form-label">Nama Asosiasi</label>
                                <div class="col-sm-10"><input type="text" name="nama" class="form-control"
                                        value="{{$asosiasi->first()->nama ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">No. Telp Kantor</label>
                                <div class="col-sm-10"><input type="text" name="telp_kantor" class="form-control"
                                        value="{{$asosiasi->first()->telp_kantor ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">NPWP</label>
                                <div class="col-sm-10"><input type="text" name="npwp" class="form-control"
                                        value="{{$asosiasi->first()->npwp ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Ketua Umum</label>
                                <div class="col-sm-10"><input type="text" name="ketua_umum" class="form-control"
                                        value="{{$asosiasi->first()->ketua_umum ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm-10"><input type="number" name="nik_ketum" class="form-control"
                                        value="{{$asosiasi->first()->nik_ketum ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">No. HP</label>
                                <div class="col-sm-10"><input type="text" name="no_hp" class="form-control"
                                        value="{{$asosiasi->first()->no_hp ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="custom-file">
                                    <input id="logo" type="file" class="custom-file-input" name="logo_asosiasi">
                                    <label for="logo" class="custom-file-label">Logo Asosiasi</label>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-white btn-sm" type="submit">Hapus</button>
                                    <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                                </div>
                            </div>
                        </form>
                        @elseif(auth()->user()->group_id == 3)
                        <form method="post" enctype="multipart/form-data" action="{{url('profile/c')}}">
                            @csrf
                            <div class="form-group row"><label for="" class="col-sm-2 col-form-label">Asosiasi</label>
                                <div class="col-sm-10">
                                    <select name="asos_id" id="" class="form-control">
                                        @foreach($asosiasi_list as $asos)
                                        <option value="{{$asos['id']}}">{{$asos['nama']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama Perusahaan</label>
                                <div class="col-sm-10"><input type="text" name="nama" class="form-control"
                                        value="{{$perusahaan->first()->nama ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10"><input type="email" name="email" class="form-control"
                                        value="{{$perusahaan->first()->email ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10"><input type="text" name="alamat" class="form-control"
                                        value="{{$perusahaan->first()->alamat ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Provinsi</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="id_prov">
                                        @foreach($provinsi as $prov)
                                        @if(isset($perusahaan->first()->id_prov) && $prov['id_prov'] ==
                                        $perusahaan->first()->id_prov)
                                        <option value="{{$prov['id_prov']}}" selected>{{$prov['nama']}}</option>
                                        @else
                                        <option value="{{$prov['id_prov']}}">{{$prov['nama']}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Kabupaten</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="id_kab">
                                        @foreach($kabupaten as $kab)
                                        @if(isset($perusahaan->first()->id_kab) && $prov['id_kab'] ==
                                        $perusahaan->first()->id_kab)
                                        <option value="{{$kab['id_kab']}}" selected>{{$kab['nama']}}</option>
                                        @else
                                        <option value="{{$kab['id_kab']}}">{{$kab['nama']}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Telp</label>
                                <div class="col-sm-10"><input type="text" name="telp" class="form-control"
                                        value="{{$perusahaan->first()->telp ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Website</label>
                                <div class="col-sm-10"><input type="text" name="website" class="form-control"
                                        value="{{$perusahaan->first()->website ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">No Akta Notaris</label>
                                <div class="col-sm-10"><input type="text" name="no_akta_notaris" class="form-control"
                                        value="{{$perusahaan->first()->no_akta_notaris ?? ''}}">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">NPWP</label>
                                <div class="col-sm-10"><input type="text" name="npwp" class="form-control"
                                        value="{{$perusahaan->first()->npwp ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">No Kemenkumham</label>
                                <div class="col-sm-10"><input type="text" name="no_kemenkumham" class="form-control"
                                        value="{{$perusahaan->first()->no_kemenkumham ?? ''}}">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm-10"><input type="text" name="nik" class="form-control"
                                        value="{{$perusahaan->first()->nik ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama Wakil</label>
                                <div class="col-sm-10"><input type="text" name="nama_wakil" class="form-control"
                                        value="{{$perusahaan->first()->nama_wakil ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10"><input type="text" name="jabatan" class="form-control"
                                        value="{{$perusahaan->first()->jabatan ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">No HP</label>
                                <div class="col-sm-10"><input type="text" name="no_hp" class="form-control"
                                        value="{{$perusahaan->first()->no_hp ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="custom-file">
                                    <input id="logo" type="file" class="custom-file-input" name="logo_perusahaan">
                                    <label for="logo" class="custom-file-label">Logo Perusahaan</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-white btn-sm" type="submit">Cancel</button>
                                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                </div>
                            </div>
                        </form>
                        @elseif(auth()->user()->group_id == 4)
                        <form method="post" enctype="multipart/form-data" action="{{url('profile/c')}}">
                            @csrf
                            <div class="form-group row"><label for="" class="col-sm-2 col-form-label">Asosiasi</label>
                                <div class="col-sm-10">
                                    <select name="asos_id" id="" class="form-control">
                                        @foreach($asosiasi_list as $asos)
                                        <option value="{{$asos['id']}}">{{$asos['nama']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Rayon</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="rayon_id" id="rayon_id">
                                        @foreach($data_rayon as $dr)
                                        <option value="{{$dr['id']}}">
                                            {{$rayon->where('id', $dr['id_rayon'])->first()['nama']}} :
                                            {{$dr['wilayah']}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10"><input type="text" name="nama" class="form-control"
                                        value="{{$professional->first()->nama ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10"><input type="email" name="email" class="form-control"
                                        value="{{$professional->first()->email ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Keahlian</label>
                                <div class="col-sm-10"><input type="text" name="keahlian" class="form-control"
                                        value="{{$professional->first()->keahlian ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10"><input type="text" name="alamat" class="form-control"
                                        value="{{$professional->first()->alamat ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">RTRW</label>
                                <div class="col-sm-10"><input type="text" name="rtrw" class="form-control"
                                        value="{{$professional->first()->rtrw ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Provinsi</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="id_prov" id="provinsi">
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Kabupaten</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="id_kab" id="kabupaten">
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Kecamatan</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="id_kec" id="kecamatan">
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Kelurahan</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="id_kel" id="kelurahan">
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Kode Pos</label>
                                <div class="col-sm-10"><input type="text" name="kode_pos" class="form-control"
                                        value="{{$professional->first()->kode_pos ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">NPWP</label>
                                <div class="col-sm-10"><input type="text" name="npwp" class="form-control"
                                        value="{{$professional->first()->npwp ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-10"><input type="text" name="tempat_lahir" class="form-control"
                                        value="{{$professional->first()->tempat_lahir ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10"><input type="date" name="tanggal_lahir" class="form-control"
                                        value="{{$professional->first()->tanggal_lahir ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm-10"><input type="text" name="nik" class="form-control"
                                        value="{{$professional->first()->nik ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Nama Perusahaan</label>
                                <div class="col-sm-10"><input type="text" name="nama_perusahaan" class="form-control"
                                        value="{{$professional->first()->nama_perusahaan ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Email Perusahaan</label>
                                <div class="col-sm-10"><input type="text" name="email_perusahaan" class="form-control"
                                        value="{{$professional->first()->email_perusahaan ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Foto</label>
                                <div class="col-sm-10"><input type="text" name="foto" class="form-control"
                                        value="{{$professional->first()->foto ?? ''}}"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Foto KTP</label>
                                <div class="col-sm-10"><input type="text" name="foto_ktp" class="form-control"
                                        value="{{$professional->first()->foto_ktp ?? ''}}"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-white btn-sm" type="submit">Cancel</button>
                                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                </div>
                            </div>
                        </form>
                        @endif
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

                @if(auth()->user()->group_id == 4)
                    var provinsi = $('#provinsi');
                    var kabupaten = $('#kabupaten');
                    var kecamatan = $('#kecamatan');
                    var kelurahan = $('#kelurahan');
                    @if(isset($professional->first()->id_prov))
                        $.ajax({
                            url: "{{url('/getProvinsi')}}/{{ $professional->first()->id_prov }}",
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
                            @if(isset($professional->first()->id_kab))
                            $.ajax({
                                url: "{{url('/getKabupaten')}}/{{$professional->first()->id_prov}}/{{ $professional->first()->id_kab }}",
                                type: "GET",
                                success: function(result) {
                                    kabupaten_list = result;
                                    var kabupaten = $('#kabupaten');
                                    // provinsi.empty();
                                    // provinsi.append('<option></option>');
                                    for (var i = 0; i < kabupaten_list.length; i++) {
                                        kabupaten.append('<option value='+kabupaten_list[i]['id_kab']+'>'+kabupaten_list[i]['nama']+'</option>');
                                    }
                                }
                            });
                                @if(isset($professional->first()->id_kec))
                                $.ajax({
                                    url: "{{url('/getKecamatan')}}/{{$professional->first()->id_kab}}/{{ $professional->first()->id_kec }}",
                                    type: "GET",
                                    success: function(result) {
                                        kecamatan_list = result;
                                        var kecamatan = $('#kecamatan');
                                        // provinsi.empty();
                                        // provinsi.append('<option></option>');
                                        for (var i = 0; i < kecamatan_list.length; i++) {
                                            kecamatan.append('<option value='+kecamatan_list[i]['id_kec']+'>'+kecamatan_list[i]['nama']+'</option>');
                                        }
                                    }
                                });
                                    @if(isset($professional->first()->id_kel))
                                    $.ajax({
                                        url: "{{url('/getKelurahan')}}/{{$professional->first()->id_kec}}/{{ $professional->first()->id_kel }}",
                                        type: "GET",
                                        success: function(result) {
                                            kelurahan_list = result;
                                            var kelurahan = $('#kelurahan');
                                            // provinsi.empty();
                                            // provinsi.append('<option></option>');
                                            for (var i = 0; i < kelurahan_list.length; i++) {
                                                kelurahan.append('<option value='+kelurahan_list[i]['id_kel']+'>'+kelurahan_list[i]['nama']+'</option>');
                                            }
                                        }
                                    });
                                    @else
                                        kecamatan.append('<option></option>');
                                    @endif
                                @else
                                    kecamatan.append('<option></option>');
                                @endif
                            @else
                                kabupaten.append('<option></option>');
                            @endif
                    @else
                        provinsi.append('<option></option>');
                    @endif
                @endif

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

                $('#kabupaten').change(function() {
                    var id_kab = $(this).find(':selected')[0].value;
                    var kecamatan_list = [];
                    $.ajax({
                        url: "{{url('/getKecamatan')}}"+'/'+id_kab,
                        type: "GET",
                        success: function(result) {
                            kecamatan_list = result;
                            var kecamatan = $('#kecamatan');
                            var kelurahan = $('#kelurahan');
                            kecamatan.empty();
                            kelurahan.empty();
                            for (var i = 0; i < kecamatan_list.length; i++) {
                                kecamatan.append('<option value='+kecamatan_list[i]['id_kec']+'>'+kecamatan_list[i]['nama']+'</option>');
                            }
                        }
                    });
                });

                $('#kecamatan').change(function() {
                    var id_kec = $(this).find(':selected')[0].value;
                    var kelurahan_list = [];
                    $.ajax({
                        url: "{{url('/getKelurahan')}}"+'/'+id_kec,
                        type: "GET",
                        success: function(result) {
                            kelurahan_list = result;
                            var kelurahan = $('#kelurahan');
                            kelurahan.empty();
                            for (var i = 0; i < kelurahan_list.length; i++) {
                                kelurahan.append('<option value='+kelurahan_list[i]['id_kel']+'>'+kelurahan_list[i]['nama']+'</option>');
                            }
                        }
                    });
                });
    });
</script>
@endsection
