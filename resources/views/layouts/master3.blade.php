<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.head')
</head>

<body>
    @include('layouts.loader')

    @include('layouts.sidebar')



    @yield('content')

    @include('layouts.loader')















    @include('layouts.footer')
    @include('layouts.script')
</body>

</html>
