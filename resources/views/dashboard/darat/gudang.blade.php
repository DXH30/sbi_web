@extends('layouts.dashboard')
@section('title', 'Gudang')
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
            <h2>Form isian Gudang</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/home">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Formulir</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Gudang</strong>
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
                        <h5>Form isian Gudang</h5>
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
                        <h1>Gudang</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Hapus</th>
                                    <th>Gudang</th>
                                    <th>Alamat</th>
                                    <th>Dekripsi</th>
                                    <th>Jenis</th>
                                    <th>Size Pallet</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gudang as $gd)
                                <tr>
                                    <td>
                                        <form action="{{url('gudang/d')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$gd->id}}">
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>

                                    </td>
                                    <td><img src="img/{{$gd->foto_gudang}}" alt="Foto Gudang" width="50px"></td>
                                    <td>{{$gd->alamat}}</td>
                                    <td>{{$gd->deskripsi}}</td>
                                    <td>{{$gd->jenis}}</td>
                                    <td>{{$gd->size_pallet}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>
                            Form Isian Gudang
                        </h5>
                        @if($errors->any())
                        <h4>{{ $errors->first() }}</h4>
                        @endif

                    </div>
                    <div class="ibox-content">
                        <form method="post" enctype="multipart/form-data" action="{{url('gudang/c')}}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="alamat">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Kota / Kabupaten</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="kab_id" id="kabupaten">
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kecamatan</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="kec_id" id="kecamatan">
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Kelurahan / Desa</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="kel_id" id="kelurahan">
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="kode_pos">Kode Pos</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="kode_pos">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="bandara">Jenis</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="jenis">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="deskripsi">Deskripsi</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="deskripsi">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="kapasitas">Kapasitas</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="kap_cbm_max" placeholder="Max CBM">
                                    <input class="form-control" type="text" name="kap_pal_max" placeholder="Max Pallet">
                                    <input class="form-control" type="text" name="kap_cbm_sisa" placeholder="Sisa CBM">
                                    <input class="form-control" type="text" name="kap_pal_sisa" placeholder="Sisa Pallet">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="fasilitas">Fasilitas</label>
                                <div class="col-sm-10">
                                    <input class="i-checks" type="checkbox" name="fasilitas[]" value="Security management gudang">
                                    Security management gudang<br/>
                                    <input class="i-checks" type="checkbox" name="fasilitas[]" value="Security 24 jam">
                                    Security 24 jam<br/>


                                    <input class="i-checks" type="checkbox" name="fasilitas[]" value="CCTV">
                                    CCTV<br/>


                                    <input class="i-checks" type="checkbox" name="fasilitas[]" value="Dock Level">
                                    Dock Level<br/>


                                    <input class="i-checks" type="checkbox" name="fasilitas[]" value="Cross Docking">
                                    Cross Docking<br/>


                                    <input class="i-checks" type="checkbox" name="fasilitas[]" value="Porter loading unloading">
                                    Porter loading Unloading<br/>


                                    <input class="i-checks" type="checkbox" name="fasilitas[]" value="Forklip">
                                    Forklip<br/>

                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="sewa">Sewa Rp.</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="sewa_cbm_h" Placeholder="CBM/hari">
                                        <input class="form-control" type="text" name="sewa_pal_h" placeholder="Pallet/hari">
                                        <input class="form-control" type="text" name="sewa_cbm_b" Placeholder="CBM/bulan">
                                        <input class="form-control" type="text" name="sewa_pal_b" placeholder="Pallet/bulan">
                                        <input class="form-control" type="text" name="sewa_cbm_t" Placeholder="CBM/tahun">
                                        <input class="form-control" type="text" name="sewa_pal_t" placeholder="Pallet/tahun">
                                    </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="size_pallet">Size Pallet</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="number" name="size_pallet">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="custom-file">
                                    <input id="logo" type="file" class="custom-file-input" name="foto_gudang">
                                    <label for="logo" class="custom-file-label">Foto Gudang</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-white btn-sm" type="submit">Hapus</button>
                                    <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                                </div>
                            </div>
                        </form>

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
            url: "{{url('/getKabupaten')}}",
            type: "GET",
            success: function(result) {
                kabupaten_list = result;
                var kabupaten = $('#kabupaten');
                for (var i = 0; i < kabupaten_list.length; i++) {
                    kabupaten.append('<option value='+kabupaten_list[i]['id_kab']+'>'+kabupaten_list[i]['nama']+'</option>');
                }
            }
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
