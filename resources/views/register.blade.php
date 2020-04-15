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

        <a href="{{url('/')}}"><h1 class="logo-name">SBI</h1></a>

        </div>
        <h3>Registrasi SBI</h3>
        @if(isset($group_id))
        <p>Buat akun {{$group_list[$group_id-1]['name']}} SBI</p>
        @else
        <p>Buat akun SBI</p>
        @endif
        <form class="m-t" role="form" action="{{ url('register') }}" method="post">
            @csrf
            <div class="form-group">
                <select class="form-control" name="group_id">
                @foreach($group_list as $group)
                    @if($group['id'] == $group_id)
                    <option value="{{ $group['id'] }}" selected>{{ $group['name'] }}</option>
                    @else
                    <option value="{{ $group['id'] }}">{{ $group['name'] }}</option>
                    @endif
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Nama User" name="name" required="">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" name="email" required="">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Kata sandi" name="password" required="">
            </div>
            <div class="form-group">
                <div class="checkbox i-checks"><label>
                        <div class="icheckbox_square-green" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div><i></i> Setujui persyaratan dan kebijakan
                    </label></div>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Daftar</button>

            <p class="text-muted text-center"><small>Sudah punya akun ?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="login">Login</a>
        </form>
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