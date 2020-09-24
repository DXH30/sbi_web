<html>

<head>
    @yield('header')
    <title>SBI - @yield('title')</title>
</head>

<body>
    @section('sidebar')
    @show
    @yield('content')
    @yield('script')
</body>

</html>
