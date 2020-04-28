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
            <h2>DASHBOARD</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item" class="active">
                    <a href="{{url('/')}}"><strong>Home</strong></a>
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
                        <h5>Dashboard</h5>
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
                        @section('tabel_asosiasi')
                        <h1>Asosiasi</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Telp Kantor</th>
                                    <th>Ketua Umum</th>
                                    <th>Logo Asosiasi</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($asosiasi as $ass)
                                <tr>
                                    <td>
                                        <a href="{{url('hapus/asosiasi/d?id=').$ass['id']}}" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <td>{{$ass['nama']}}</td>
                                    <td>{{$ass['telp_kantor']}}</td>
                                    <td>{{$ass['ketua_umum']}}</td>
                                    <td>{{$ass['logo_asosiasi']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endsection

                        @section('tabel_rayon')
                        <h1>Rayon</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Hapus</th>
                                    <th>Nama Rayon</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rayon as $ray)
                                <tr>
                                    <td>
                                        <a href="{{url('/rayon/d?id=').$ray['id']}}" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <td>{{$ray['nama']}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <form action="{{url('/rayon/c')}}" method="post">
                                        @csrf
                                        <td><button class="btn btn-info submit"><i class="fa fa-plus"></i></button></td>
                                        <td><input name="nama" class="form-control" placeholder="Nama Rayon"></td>
                                    </form>
                                </tr>
                            </tbody>
                        </table>
                        @endsection

                        @section('tabel_data_rayon')
                        <h1>Data Rayon</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Hapus</th>
                                    <th>Rayon</th>
                                    <th>Wilayah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_rayon as $dr)
                                <tr>
                                    <td>
                                        <a href="{{url('/data_rayon/d?id=').$dr['id']}}" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <td>{{$rayon->where('id', $dr['id_rayon'])->first()['nama']}}</td>
                                    <td>{{$dr['wilayah']}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <form action="{{url('/data_rayon/c')}}" method="post">
                                        @csrf
                                        <td><button class="btn btn-info submit"><i class="fa fa-plus"></i></button></td>
                                        <td>
                                            <select class="form-control" name="id_rayon" id="id_rayon">
                                                @foreach($rayon as $ray)
                                                <option value="{{$ray['id']}}">{{$ray['nama']}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="wilayah">
                                        </td>
                                    </form>
                                </tr>
                            </tbody>
                        </table>
                        @endsection

                        @section('tabel_lokasi')
                        <h1>Lokasi</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Hapus</th>
                                    <th>Lettercode</th>
                                    <th>Lokasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lokasi as $letter)
                                <tr>
                                    <td>
                                        <a href="{{url('/lokasi/d?id=').$letter['id']}}" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <td>{{$letter['lettercode']}}</td>
                                    <td>{{$letter['lokasi']}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <form action="{{url('/lokasi/c')}}" method="post">
                                        @csrf
                                        <td><button class="btn btn-info submit"><i class="fa fa-plus"></i></button></td>
                                        <td><input name="lettercode" class="form-control" placeholder="lettercode"></td>
                                        <td><input name="lokasi" class="form-control" placeholder="lokasi"></td>
                                    </form>
                                </tr>
                            </tbody>
                        </table>
                        @endsection

                        @section('tabel_perusahaan')
                        <h1>Perusahaan</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>provinsi</th>
                                    <th>kabupaten</th>
                                    <th>Telp</th>
                                    <th>Website</th>
                                    <th>No Akta Notaris</th>
                                    <th>NPWP</th>
                                    <th>No Kemenkumham</th>
                                    <th>NIK</th>
                                    <th>Nama Wakil</th>
                                    <th>Jabatan</th>
                                    <th>No Hp</th>
                                    <th>Logo Perusahaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($perusahaan as $usaha)
                                <tr>
                                    <td>{{$usaha['id']}}</td>
                                    <td>{{$usaha['nama']}}</td>
                                    <td>{{$usaha['email']}}</td>
                                    <td>{{$usaha['id_prov']}}</td>
                                    <td>{{$usaha['id_kab']}}</td>
                                    <td>{{$usaha['telp']}}</td>
                                    <td>{{$usaha['website']}}</td>
                                    <td>{{$usaha['no_akta_notaris']}}</td>
                                    <td>{{$usaha['npwp']}}</td>
                                    <td>{{$usaha['no_kemenkumham']}}</td>
                                    <td>{{$usaha['nik']}}</td>
                                    <td>{{$usaha['jabatan']}}</td>
                                    <td>{{$usaha['no_hp']}}</td>
                                    <td>{{$usaha['logo_perusahaan']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endsection

                        @section('tabel_professional')
                        <h1>Professional</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Keahlian</th>
                                    <th>Alamat</th>
                                    <th>NPWP</th>
                                    <th>Tempat/Tanggal Lahir</th>
                                    <th>NIK</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Email Perusahaan</th>
                                    <th>Foto</th>
                                    <th>Foto KTP</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($professional as $prof)
                                <tr>
                                    <td>{{$prof['id']}}</td>
                                    <td>{{$prof['nama']}}</td>
                                    <td>{{$prof['email']}}</td>
                                    <td>{{$prof['keahlian']}}</td>
                                    <table>
                                        <tr>
                                            <td>Kelurahan</td>
                                            <td>{{$prof['id_kel']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Kecamatan</td>
                                            <td>{{$prof['id_kec']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Kabupaten</td>
                                            <td>{{$prof['id_kab']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Provinsi</td>
                                            <td>{{$prof['id_prov']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Kode Pos</td>
                                            <td>{{$prof['kode_pos']}}</td>
                                        </tr>
                                    </table>
                                    <td>{{$prof['npwp']}}</td>
                                    <td>{{$prof['tempat_lahir']}}, {{$prof['tanggal_lahir']}}</td>
                                    <td>{{$prof['nik']}}</td>
                                    <td>{{$prof['nama_perusahaan']}}</td>
                                    <td>{{$prof['email_perusahaan']}}</td>
                                    <td>{{$prof['foto']}}</td>
                                    <td>{{$prof['foto_ktp']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endsection

                        @section('mode_transportasi')
                        <h1>Mode transportasi</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Hapus</th>
                                    <th>Mode Transportasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mode_transportasi as $mt)
                                <tr>
                                    <td>
                                        <a href="{{url('/mode_transportasi/d?id=').$mt['id']}}" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <td>{{$mt['mode']}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <form action="{{url('/mode_transportasi/c')}}" method="post">
                                        @csrf
                                        <td><button class="btn btn-info submit"><i class="fa fa-plus"></i></button></td>
                                        <td><input name="mode" class="form-control" placeholder="Mode Transportasi">
                                        </td>
                                    </form>
                                </tr>
                            </tbody>
                        </table>
                        @endsection

                        @section('tabel_jenis_kendaraan')
                        <h1>Jenis Kendaraan</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Hapus</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Mode transportasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jenis_kendaraan as $jk)
                                <tr>
                                    <td>
                                        <a href="{{url('/jenis_kendaraan/d?id=').$jk['id']}}" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <td>{{$jk['jenis']}}</td>
                                    <td>{{$mode_transportasi->where('id', $jk['mode_id'])->first()['mode']}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <form action="{{url('/jenis_kendaraan/c')}}" method="post">
                                        @csrf
                                        <td><button class="btn btn-info submit"><i class="fa fa-plus"></i></button></td>
                                        <td><input name="jenis" class="form-control" placeholder="Jenis Kendaraan"></td>
                                        <td>
                                            <select name="mode_id" id="mode_id" class="form-control">
                                                @foreach($mode_transportasi as $mt)
                                                <option value="{{$mt['id']}}">{{$mt['mode']}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </form>
                                </tr>
                            </tbody>
                        </table>
                        @endsection
                        @section('kendaraan')
                        <h1>Kendaraan</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Hapus</th>
                                    <th>Deskripsi</th>
                                    <th>Ukuran Karoseri</th>
                                    <th>Ukuran Mobil</th>
                                    <th>Berat</th>
                                    <th>Spesifikasi</th>
                                    <th>Gambar</th>
                                    <th>Jenis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kendaraan as $knd)
                                <tr>
                                    <td>
                                        <a href="{{url('/kendaraan/d?id=').$knd['id']}}" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
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
                                    <td>{{$knd['gambar']}}</td>
                                    <td>{{$jenis_kendaraan->where('id', $knd['id_jenis'])->first()['jenis']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endsection
                        @section('tabel_ketersediaan_kendaraan')
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kendaraan</th>
                                    <th>Rayon</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ketersediaan_kendaraan as $kknd)
                                <tr>
                                    <td>{{$kknd['id']}}</td>
                                    <td>
                                        {{$kendaraan->where('id', $kknd['id_kendaraan'])->first()['no']}}
                                    </td>
                                    <td>
                                        {{
                                            $rayon->where('id',$data_rayon->where('id', $kknd['id_rayon'])
                                            ->first()['id'])->first()['nama']
                                        }}:
                                        {{$data_rayon->where('id', $kknd['id_rayon'])->first()['wilayah']}}
                                    </td>
                                    <td>{{$kknd['jumlah']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endsection
                        @if(auth()->user()->group_id == 1)
                        @yield('tabel_asosiasi')
                        {{-- @yield('tabel_rayon') --}}
                        {{-- @yield('tabel_lokasi') --}}
                        @yield('tabel_perusahaan')
                        @yield('tabel_professional')
                        {{-- @yield('mode_transportasi') --}}
                        {{-- @yield('tabel_jenis_kendaraan') --}}
                        @yield('kendaraan')
                        @elseif(auth()->user()->group_id == 2)
                        {{-- @yield('tabel_rayon') --}}
                        {{-- @yield('tabel_lettercode') --}}
                        @yield('tabel_perusahaan')
                        @yield('tabel_professional')
                        @yield('tabel_data_rayon')
                        {{-- @yield('mode_transportasi') --}}
                        {{-- @yield('tabel_jenis_kendaraan') --}}
                        {{-- @yield('kendaraan') --}}
                        @elseif(auth()->user()->group_id == 3)
                        {{-- @yield('mode_transportasi') --}}
                        {{-- @yield('tabel_jenis_kendaraan') --}}
                        @yield('tabel_ketersediaan_kendaraan')
                        @elseif(auth()->user()->group_id == 4)
                        {{-- @yield('mode_transportasi') --}}
                        {{-- @yield('tabel_jenis_kendaraan') --}}
                        @yield('tabel_ketersediaan_kendaraan')
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

                }, 1300)
    });
</script>
@endsection
