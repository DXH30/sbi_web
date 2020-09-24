@extends('layouts.logreg')
@section('title', 'Login')
@section('header')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

<link href="{{ asset('css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <a href="{{url('/')}}">
                <h1 class="logo-name">SBI</h1>
            </a>
        </div>
        <h3>Selamat datang di SBI</h3>
        <p>Login untuk melanjutkan</p>
        @if($errors->any())
        <h4>{{ $errors->first() }}</h4>
        @endif
        <form class="m-t" role="form" action="{{route('login')}}" method="post">
            @csrf
            <div class="form-group">
                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required placeholder="Username / Email" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required="">
                <div class="col-md-6">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary block full-width m-b">{{ __('Login') }}</button>
            <div class="form-group row">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <a href="{{route('password.request')}}"><small>{{ __('Lupa Password ?') }}</small></a>
            <p class="text-muted text-center"><small>Belum punya akun ?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="register">Buat akun</a>
        </form>
        <p class="m-t"> <small>PRIMAKOM © 2020</small> </p>
    </div>
</div>
@endsection

@section('script')
<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
@endsection
