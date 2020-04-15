<html>

<head>
    @yield('header')
    <title>SBI - @yield('title')</title>
</head>

<body>
    <div id="wrapper">
        @section('sidebar')

        @show
        @yield('content')
    </div>

    @yield('script')
</body>

</html>