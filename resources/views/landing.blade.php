@extends('layouts.landing')
@section('title', 'Selamat datang')
@section('header')
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<!-- Bootstrap core CSS -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

<!-- Animation CSS -->
<link href="{{ asset('css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection
@section('navbar')
<div class="navbar-wrapper">
    <nav class="navbar navbar-default navbar-fixed-top navbar-expand-md" role="navigation">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">SBI</a>
            <div class="navbar-header page-scroll">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <form name="logout" method="post" action="{{ url('/logout') }}">
                @csrf
            <form>
            <div class="collapse navbar-collapse justify-content-end" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="nav-link page-scroll" href="#page-top">Home</a></li>
                    <li><a class="nav-link page-scroll" href="#terms">Terms</a></li>
                    <li><a class="nav-link page-scroll" href="#contact">Kontak</a></li>
                    @guest
                    <li><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                    <li><a class="nav-link" href="{{ url('/register') }}">Register</a></li>
                    @endguest
                    @auth
                    <li><a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li><a class="nav-link" href="#" onclick="document.forms['logout'].submit(); return false;">Logout</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</div>
@endsection
@section('content')
<div id="inSlider" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#inSlider" data-slide-to="0" class="active"></li>
        <li data-target="#inSlider" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Octomoda<br />
                        SBI</h1>
                    <p>
                        <a class="btn btn-lg btn-primary" href="#" role="button">READ MORE</a>
                    </p>
                </div>
                <div class="carousel-image wow zoomIn">
                    <img src="img/landing/laptop.png" width="450px" alt="laptop" />
                </div>
            </div>
            <!-- Set background for slide in css -->
            <div class="header-back one"></div>

        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="carousel-caption blank">
                    <h1>Octomoda <br /> SBI.</h1>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                </div>
            </div>
            <!-- Set background for slide in css -->
            <div class="header-back two"></div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#inSlider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#inSlider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<section id="terms" class="white-section text-color terms">
<div class="container">
                <h1>Terms and Conditions</h1>
                <p class="text-color">Octomoda merupakan aplikasi mobile apps yang dapat diakses oleh seluruh anggota organsasi,  yang terhimpun di dalam Perusahaan maupun kalangan pebisnis profesional,  sebagai jembatan peningkatan hubungan kerjasama antar perusahaan dan/atau profesional, terpercaya, aman dan saling menguntungkan.</p>
                <p class="text-color"><strong>BACALAH DOKUMEN INI SECARA LENGKAP DAN BENAR TENTANG SYARAT DAN KETENTUAN YANG BERLAKU</strong>. Mulai saat ini OCTOMODA MOBILE APPS, menawarkan sebuah web platform untuk membangun dan menerbitkan sebuah aplikasi mobile yang terdapat pada OCTOMODA.tech dan juga pada domain yang terkait dengannya.</p>
                <p class="text-color">Dengan mendaftar sebagai pengguna OCTOMODA Mobile Apps, berarti Pengguna telah menyetujui semua Syarat dan Ketentuan layanan yang berlaku di OCTOMODA Mobile Apps. Dalam menetapkan hubungan antara pengguna dan pihak penyedia layanan, maka apabila pengguna tidak bersedia mengikuti setiap persyaratan dan ketentuan yang berlaku, dengan ini pengguna tidak dapat menggunakan web platform OCTOMODA Mobile Apps.</p>
                <p class="text-color">Syarat dan Ketentuan dalam perjanjian ini dapat berubah sesuai dengan berjalannya waktu. Pengguna wajib dan tanggung jawab untuk memperhatikan setiap perubahan yang akan terjadi :</p>
                <p class="text-color">1. Pengguna di OCTOMODA Mobile Apps</p>

<p class="text-color">1.1.  Untuk dapat mengakses layanan di OCTOMODA Mobile Apps, harus membuka account pengguna baru di OCTOMODA Mobile Apps, dengan memasukan username, e-mail dan password.</p>
<p class="text-color">1.2.  Setiap calon pengguna yang sudah memiliki usia yang cukup sesuai dengan Hukum yang berlaku di negara Indonesia, dan/atau negara negara di mana App akan dipublikasikan, berhak mendaftarkan diri di OCTOMODA Mobile Apps. Untuk calon pengguna yang masih di bawah usia, memerlukan izin dari orang tua atau orang yang secara hukum memiliki kewenangan untuk memberi izin. Setiap orang tua atau setiap orang yang secara hukum dapat memberikan izin tersebut, harus membaca perjanjian ini.</p>
<p class="text-color"></p>
<p class="text-color">2. Lisensi untuk menggunakan layanan OCTOMODA Mobile Apps</p>
<p class="text-color">Lisensi: OCTOMODA Mobile Apps menawarkan lisensi eksklusif terbatas dan tidak terbatas untuk menggunakan layanan OCTOMODA Mobile Apps. Dengan tujuan penggunaan bersifat pribadi atau komersial. Lisensi ini memungkinkan Anda untuk menggunakan platform OCTOMODA Mobile Apps untuk dapat dipergunakan, mengedit atau mempublikasikan aplikasi mobile yang telah disetujukan. Lisensi ini tidak dapat dipindahtangankan dan tidak dapat disublisensikan kepada pihak lain.</p>
<p class="text-color">Penggunaan komersial: lisensi untuk penggunaan aplikasi OCOTOMODA Mobile Apps memiliki hak untuk mencipta, membangun, mengedit dan mempublikasikan aplikasi mobile dengan tujuan komersial.</p>
<p class="text-color">Pembatasan: Kecuali penyedia layanan OCTOMODA Mobile Apps, Anda tidak dapat mereproduksi, mendistribusikan atau menjual bagian dari source code web OCTOMODA Mobile Apps. Anda juga tidak diperkenankan membuat suatu rekayasa atasnya.</p>
<p class="text-color">3. Menggunakan layanan OCTOMODA Mobile Apps.</p>
<p class="text-color">3.1.OCTOMODA Mobile Apps memungkinkan suatu pembangunan, pengeditan dan publikasi aplikasi mobile benar-benar berjalan secara fungsional dan bebas, untuk menggunakan layanan lainnya.</p>
<p class="text-color">3.2.OCTOMODA Mobile Apps berhak untuk menambahkan konten tambahan untuk layanan  tersebut, seperti memasukkan iklan dengan informasi dari perusahaan lain atau informasi komersial tentang OCTOMODA Mobile Apps. Ketika terdapat iklan di Apps  yang dibangun oleh pengguna, OCTOMODA Mobile Apps tidak bertanggung jawab atas isi dari iklan tersebut, karena mereka disediakan oleh pemasok iklan eksternal.</p>
<p class="text-color">4. Pendapatan Generasi Oleh Pengguna</p>
<p class="text-color">OCTOMODA Mobile Apps mungkin akan menawarkan beberapa layanan yang memungkinkan pengguna untuk mendapatkan pendapatan, seperti dengan menjual Apps yang dibangun dengan OCTOMODA Mobile Apps, menampilkan sebuah banner iklan pihak ketiga pada Apps atau layanan lain yang dibuat dari OCTOMODA Mobile Apps.</p>
<p class="text-color">Untuk menerima pendapatan itu, pengguna harus memberikan OCTOMODA Mobile Apps biaya yang sebenarnya, identifikasi rincian untuk memastikan legalisasi atas hukum yang berlaku sesuai dengan negara domisili dalam penerimaan pendapatan.</p>
<p class="text-color">Jika salah satu dari layanan yang disebutkan dikelola oleh pihak eksternal dari OCTOMODA Mobile Apps, pengguna bertanggungjawab untuk mengatur perjanjian dan pembayaran serta memberikan informasi kepada pihak penyedia layanan OCTOMODA Mobile Apps untuk mengaktifkan layanan dan koneksi antara pengguna dan pihak pengelola dari eksternal.</p>
<p class="text-color">5. Premi layanan.</p>
<p class="text-color">OCTOMODA Mobile Apps menawarkan suatu layanan untuk pengguna yang ingin memanfaatkan profesional dari aplikasi dan atau jasa yang ditawarkan oleh OCTOMODA Mobile Apps ( “Premium”). Layanan ini memiliki biaya tambahan, yang harus dibayar kepada OCTOMODA Mobile Apps sebelum Apps diaktifkan.</p>
<p class="text-color">Perpanjangan: semua status pelangganan untuk layanan premium akan otomatis diperpanjang secara default, untuk periode yang sama dan jenis layanan yang sama sebelum batas waktu yang ditetapkan untuk layanan tersebut berakhir. Anda dapat menolak perpanjangan layanan ini kapan saja sebelum dilakukan perpanjangan otomatis. OCTOMODA Mobile Apps berhak untuk menolak langganan, perpanjangan atau jenis lain dari pembelian untuk alasan apapun.</p>
<p class="text-color">Pembelian lainnya: mungkin pihak penyedia layanan OCTOMODA Mobile Apps akan menawarkan produk baru dengan layanan pembayaran dalam waktu yang akan datang. Produk dan layanan tersebut akan disesuaikan dengan syarat dan ketentuan tambahan yang terjadi pada saat pembelian.</p>
<p class="text-color">6. Pembatasan Konten</p>
<p class="text-color">Para pengguna maupun calon pengguna dilarang keras menggunakan layanan OCTOMODA Mobile Apps untuk membuat, mengedit dan mempublikasikan suatu aplikasi yang berisi:</p>
<p class="text-color">-Konten yang melanggar hak cipta atau hak-hak lain (merek dagang, hak privasi, hak gambar, dll)</p>
<p class="text-color">-Konten dengan konotasi rasis, kekerasan, memfitnah atau diskriminatif terhadap kelompok individu maupun kolektif.</p>
<p class="text-color">-Konten berbahaya atau mengeksploitasi anak di bawah umur.</p>
<p class="text-color">-Konten yang menampilkan tindakan ilegal atau kekerasan ekstrem.</p>
<p class="text-color">-Konten yang menampilkan kekerasan atau penyiksaan terhadap hewan</p>
<p class="text-color">-Konten yang berisi kumpulan informasi pribadi orang lain.</p>
<p class="text-color">-Konten yang mempromosikan tindakan atau modus penipuan.</p>
<p class="text-color">-Berdasarkan hukum dari Negara Indonesia dan negara-negara di mana App akan dipublikasikan.</p>
<p class="text-color">Jika OCTOMODA Mobile Apps tidak mendeteksi setiap pelanggaran ini tetapi pelanggaran itu ada, OCTOMODA Mobile Apps akan dibebaskan dari tanggung jawab apapun itu, tentang isi konten yang melanggar hukum tersebut; dan sebaliknya. Pengguna yang terkait bertanggungjawab atas pelanggarannya.</p>
<p class="text-color">7. Penghentian dan pembatalan</p>
<p class="text-color">Periode: Perjanjian ini dimulai ketika Anda mendaftar sebagai pengguna OCTOMODA Mobile Apps dan berlaku saat memiliki akun pengguna OCTOMODA Mobile Apps.</p>
<p class="text-color">Membatalkan akun pengguna : Pengguna bisa membatalkan account kapan saja dengan memberitahukan OCTOMODA Mobile Apps melalui kontak email.</p>
<p class="text-color">Pengaruh pembatalan akun pengguna : Setelah membatalkan akun, Pengguna tidak bisa lagi mengakses dengan username dan password yang telah didaftarkan, dan Apps yang telah dipublikasikan akan secara otomatis hilang dari publikasi. Setelah akun pengguna dibatalkan, OCTOMODA Mobile Apps berhak untuk terus menyimpan semua informasi dalam sistem untuk keperluan menyimpan setiap informasi dari akun atas aktivitas yang di memiliki izin dari pihak pemilik. Jika tidak, pengguna terdaftar OCTOMODA MOBILE APPS akan bertanggung jawab untuk setiap sengketa hak intelektual yang mungkin terjadi dengan pemegang nyata konten. Ketika pengguna OCTOMODA Mobile Apps yang menempatkan hak untuk menggunakan konten tersebut di Apps, pada waktu proses pembangunan selesai, dapat diterbitkan dengan layanan OCTOMODA Mobile Apps, tetapi tidak mendapatkan property fisik atau app yang telah dipisahkan dari OCTOMODA Mobile Apps.</p>
<p class="text-color">9. Layanan OCTOMODA Mobile Apps</p>
<p class="text-color">9.1.Semua informasi di OCTOMODA Mobile Apps yang terkait dengan pengguna, dan Apps yang disimpan dalam server dapat diakses dari komputer dimanapun dengan koneksi internet, menggunakan sebuah perangkat lunak navigasi yang kompatibel. Server di mana informasi tersebut disimpan dipekerjakan untuk memasok info eksternal OCTOMODA Mobile Apps, yang mengatur ketersediaan dan waktu untuk menyelesaikan masalah jika terjadi suatu insiden.</p>
<p class="text-color">9.2.Jika layanan OCTOMODA Mobile Apps terganggu karena berbagai alasan, seperti alasan kegagalan perangkat  lunak, OCTOMODA Mobile Apps akan mencoba untuk mengaktifkan layanan tersebut dalam waktu minimal dua puluh empat (24) jam, tetapi OCTOMODA Mobile Apps tidak bertanggung jawab dalam kasus permasalahan hosting.</p>
<p class="text-color">10 . Kebijakan Privasi</p>
<p class="text-color">Perjanjian ini menjelaskan privasi dan perlindungan atas komitmen informasi pribadi atas lampiran pengguna terdaftar di OCTOMODA Mobile Apps.</p>
<p class="text-color">OCTOMODA Mobile Apps tidak memerlukan informasi yang bersifat pribadi untuk memberikan lisensi penggunaan layanan OCTOMODA Mobile Apps untuk calon pengguna. Untuk menjadi pengguna terdaftar OCTOMODA Mobile Apps, membutuhkan prosedur pengisian data pengguna sesuai dokumen yang berlaku. </p>
<p class="text-color">Sistem OCTOMODA Mobile Apps juga akan menggunakan IP searah dengan perangkat dari mana pengguna melakukan pendaftaran berdasarkan negara asalnya. </p>
<p class="text-color">Setiap informasi pribadi pengguna OCTOMODA Mobile Apps diberikan kepada OCTOMODA Mobile Apps, akan didaftarkan dalam database yang tersimpan dalam layanan disewa oleh OCTOMODA Mobile Apps untuk pemasok eksternal. Database tersebut terdaftar sesuai Kebijakan Privasi  dengan Hukum Indonesia.</p>
<p class="text-color">OCTOMODA Mobile Apps akan mengambil langkah-langkah yang tepat untuk mengelola segala jenis informasi pengguna, dengan cara yang aman dan tanpa membiarkannya diakses oleh pihak lain. OCTOMODA Mobile Apps tidak akan berkompromi untuk menerbitkan atau memberikan informasi pengguna kepada siapa pun, untuk tidak disalahgunakan.</p>
<p class="text-color">Pengguna terdaftar pada OCTOMODA Mobile Apps, memiliki hak untuk mengakseskan informasi pribadi untuk mengedit atau menghapus, sesuai dengan Kebijakan Hukum Privasi Indonesia.</p>
<p class="text-color">11. Penyalahgunaan.</p>
<p class="text-color">11.1. Jika pengguna terdaftar menghapus aplikasi yang sebelumnya dibangun dengan akun OCTOMODA Mobile Apps, baik secara sengaja atau tidak sengaja. OCTOMODA Mobile Apps tidak bertanggung jawab untuk hal ters</p>

</div>
</section>
<section id="contact" class="gray-section contact">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Contact Us</h1>
            </div>
        </div>
        <div class="row m-b-lg justify-content-center">
            <div class="col-lg-3 ">
                <address>
                    <strong><span class="navy">Octomoda, Inc.</span></strong><br />
<!--                    795 Folsom Ave, Suite 600<br />
                    San Francisco, CA 94107<br />
                    <abbr title="Phone">P:</abbr> (123) 456-7890
-->
                </address>
            </div>
            <div class="col-lg-4">
                
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <a href="mailto:sbi@primakom.co.id" class="btn btn-primary">Send us mail</a>
                <p class="m-t-sm">
                    Or follow us on social platform
                </p>
                <ul class="list-inline social-icon">
                    <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center m-t-lg m-b-lg">
                <p><strong>&copy; 2020 Octomoda</strong></p>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<!-- Mainly scripts -->
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('js/inspinia.js') }} "></script>
<script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('js/plugins/wow/wow.min.js') }}"></script>
<script>
    $(document).ready(function() {

        $('body').scrollspy({
            target: '#navbar',
            offset: 80
        });

        // Page scrolling feature
        $('a.page-scroll').bind('click', function(event) {
            var link = $(this);
            $('html, body').stop().animate({
                scrollTop: $(link.attr('href')).offset().top - 50
            }, 500);
            event.preventDefault();
            $("#navbar").collapse('hide');
        });
    });

    var cbpAnimatedHeader = (function() {
        var docElem = document.documentElement,
            header = document.querySelector('.navbar-default'),
            didScroll = false,
            changeHeaderOn = 200;

        function init() {
            window.addEventListener('scroll', function(event) {
                if (!didScroll) {
                    didScroll = true;
                    setTimeout(scrollPage, 250);
                }
            }, false);
        }

        function scrollPage() {
            var sy = scrollY();
            if (sy >= changeHeaderOn) {
                $(header).addClass('navbar-scroll')
            } else {
                $(header).removeClass('navbar-scroll')
            }
            didScroll = false;
        }

        function scrollY() {
            return window.pageYOffset || docElem.scrollTop;
        }
        init();

    })();

    // Activate WOW.js plugin for animation on scrol
    new WOW().init();
</script>
@endsection
