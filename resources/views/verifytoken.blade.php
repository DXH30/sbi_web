@extends('layouts.master')

@section('header')
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Actionable emails e.g. reset password</title>
<link href="{{asset('email_templates/styles.css')}}" media="all" rel="stylesheet" type="text/css" />
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
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
                                        <a href="{{url('/')}}">
                                            <img class="img-fluid" src="{{url('email_templates/img/header.jpg')}}" />
                                        </a>
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
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            {{ __('Verifikasi Akunmu') }}</div>

                                                        <div class="card-body">
                                                            {{ __('Sebelum melanjutkan, harap hubungi octomoda atau asosiasi terkait untuk mendapatkan token.') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @if($errors->any())
                                <tr>
                                    <td>
                                        <h1>{{ $errors->first() }}</h1>
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="content-block aligncenter">
                                        <form action="{{url('vtoken/u')}}" method="POST">
                                            @csrf
                                            <div class="form-group row">
                                                <input type="text" class="form-control" name="token">
                                            </div>
                                            <div class="form-group row">
                                                <button class="btn btn-primary btn-block" type="submit">Kirim</button>
                                            </div>
                                        </form>
                                        <form action="{{url('/logout')}}" method="POST">
                                            @csrf
                                            <button class="btn btn-warning btn-block" type="submit">Logout</button>
                                        </form>
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
