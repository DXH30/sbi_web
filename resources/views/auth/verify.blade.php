@extends('layouts.master')

@section('header')
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Actionable emails e.g. reset password</title>
<link href="{{asset('email_templates/styles.css')}}" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<table class="body-wrap">
    <tr>
        <td></td>
        <td class="container" width="600">
            <div class="content">
                <table class="main" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="content-wrap">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <img class="img-fluid" src="{{url('email_templates/img/header.jpg')}}" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        <h3>Selamat Datang di Octomoda</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-md-8">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            {{ __('Verifikasi Alamat Email mu') }}</div>

                                                        <div class="card-body">
                                                            @if (session('resent'))
                                                            <div class="alert alert-success" role="alert">
                                                                {{ __('A fresh verification link has been sent to your email address.') }}
                                                            </div>
                                                            @endif

                                                            {{ __('Sebelum melanjutkan, harap periksa email anda untuk verifikasi.') }}
                                                            {{ __('Jika belum menerima email') }},
                                                            <form class="d-inline" method="POST"
                                                                action="{{ route('verification.resend') }}">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-link p-0 m-0 align-baseline">
                                                                    {{ __('Klik disini untuk mengirim kembali') }}
                                                                </button>.
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block aligncenter">
                                        <a href="{{route('login')}}" class="btn-primary">Login</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div class="footer">
                    <table width="100%">
                        <tr>
                            <td class="aligncenter content-block">PRIMAKOM @ 2020</td>
                        </tr>
                    </table>
                </div>
            </div>
        </td>
        <td></td>
    </tr>
</table>
@endsection
