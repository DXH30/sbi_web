@extends('layouts.logreg')
@section('title', 'Register')
@section('header')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>INSPINIA | Register</title>

<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
<link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
<link href="{{ asset('css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div>

            <a href="{{url('/')}}">
                <h1 class="logo-name">SBI</h1>
            </a>

        </div>
        <h3>Registrasi SBI</h3>
        @if(isset($group_id))
        <p>Buat akun {{$group_list[$group_id-1]['name']}} SBI</p>
        @else
        <p>Buat akun SBI</p>
        @endif
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <form class="m-t" role="form" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <select class="form-control" name="group_id">
                        <option value="2">Asosiasi</option>
                        <option value="3">Perusahaan</option>
                        <option value="4">Professional</option>
                        <option value="5">User</option>
                    </select>
                </div>
                <div class="form-group">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" placeholder="{{ __('Name') }}" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required placeholder="{{ __('E-Mail Address') }}"
                        autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary block full-width m-b">
                        {{ __('Daftar') }}
                    </button>
                </div>
            </form>
        </div>
        <p class="m-t"> <small>Primakom © 2020</small> </p>
    </div>
</div>
@endsection
@section('script')
<!-- Mainly scripts -->
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
@endsection
