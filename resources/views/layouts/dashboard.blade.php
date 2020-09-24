<!DOCTYPE html>
<html>

<head>
    @yield('header')
    <title>SBI - @yield('title')</title>
</head>

<body>
    <div id="wrapper">
        @section('sidebar')
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <?php
                            if(auth()->user()->group_id == 1):
                            $logo = 'img/profile_small.jpg';
                            elseif(auth()->user()->group_id == 2):
                                if($asosiasi->where('user_id', Auth::id())->first() !== NULL) {
                                    $logo = asset('img/profile').'/'.$asosiasi->where('user_id', Auth::id())->first()['logo_asosiasi'];
                                } else {
                                    $logo = "";
                                }
                            elseif(auth()->user()->group_id == 3):
                                if($perusahaan->where('user_id', Auth::id())->first() !== NULL) {
                                    $logo = asset('img/profile').'/'.$perusahaan->where('user_id', Auth::id())->first()['logo_perusahaan'];
                                } else {
                                    $logo = "";
                                }
                            elseif(auth()->user()->group_id == 4):
                                if ($professional->where('user_id', Auth::id())->first() !== NULL) {
                                    $logo = asset('img/profile').'/'.$professional->where('user_id', Auth::id())->first()['logo_professional'];
                                } else {
                                    $logo = "";
                                }
                            elseif(auth()->user()->group_id == 6):
                                if ($asosiasi->where('user_id', Auth::id())->first() !== NULL) {
                                    $logo = asset('img/profile').'/'.$asosiasi->where('user_id', Auth::id())->first()['logo_asosiasi'];
                                } else {
                                    $logo = "";
                                }
                            endif
                            ?>
                            <img alt="image" width="50px" height="50px" class="rounded-circle" src="{{$logo ?? 'img/profile_small.jpg'}}">
                            <span class="block m-t-xs font-bold">{{ Auth::user()->name }}</span>
                            <span class="text-muted text-xs block">{{ Auth::user()->email }}</span>
                        </div>
                        <div class="logo-element">
                            SBI
                        </div>
                    </li>
                    @if(Route::current()->getName() == 'dashboard')
                    <li class="active">
                        @else
                    <li>
                        @endif
                        <a href="{{url('dashboard')}}"><i class="fa fa-picture-o"></i> <span
                                class="nav-label">Dashboard</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap"></i>
                            <span class="nav-label">
                                Formulir
                            </span>
                            <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" aria-expanded="false">
                            @if(auth()->user()->group_id == 1)
                            <li><a href="{{url('kategori')}}">Kategori</a></li>
                            <li><a href="{{url('rayon')}}">Rayon</a></li>
                            <li><a href="{{url('mode_transportasi')}}">Mode Transportasi</a></li>
                            <li><a href="{{url('jenis_kendaraan')}}">Jenis Kendaraan</a></li>
                            <li><a href="{{url('kendaraan')}}">Kendaraan</a></li>
                            <li>
                            <a href="#">Lokasi <span class="fa arrow"></span></a>
                              <ul class="nav nav-third-level">
                                <li><a href="{{url('lettercode')}}">Lettercode</a></li>
                                <li><a href="{{url('kode_pos')}}">Kode Pos</a></li>
                                <li><a href="{{url('bandara')}}">Bandara</a></li>
                                <li><a href="{{url('pelabuhan')}}">Pelabuhan</a></li>
                                <li><a href="{{url('stasiun')}}">Stasiun</a></li>
                                <li><a href="{{url('terminal')}}">Terminal</a></li>
                              </ul>
                            </li>
                            <li><a href="{{url('keanggotaan')}}">Keanggotaan</a></li>
                            @elseif(auth()->user()->group_id == 2)
                            <li><a href="{{url('keanggotaan')}}">Keanggotaan</a></li>
                            <li><a href="{{url('iuran')}}">Iuran</a></li>
                            <li><a href="{{url('data_rayon')}}">Data Rayon</a></li>
                            <li><a href="{{url('agenda')}}">Agenda</a></li>
                            @elseif(auth()->user()->group_id == 3 || auth()->user()->group_id == 4)
                            <li><a href="{{url('daftar_asosiasi')}}">Daftar Asosiasi</a></li>
                            <li><a href="{{url('iuran')}}">Iuran</a></li>
                            <li><a href="{{url('kendaraan')}}">+ Kendaraan</a></li>
                            @elseif(auth()->user()->group_id == 6)
                            <li><a href="{{url('keanggotaan')}}">Keanggotaan</a></li>
                            @endif
                        </ul>
                    </li>
                    @if(Route::current()->getName() == 'profile')
                    <li class="active">
                        @else
                    <li>
                        @endif
                        <a href="{{url('profile')}}"><i class="fa fa-wrench"></i> <span
                                class="nav-label">Profile</span></a>
                    </li>
                </ul>
            </div>
        </nav>
        @show

        @yield('content')

        @yield('script')
    </div>
</body>

</html>
