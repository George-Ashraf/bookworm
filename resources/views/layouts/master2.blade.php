<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.head')
</head>

<body>

    @include('layouts.loader')


    @yield('content')
















    @include('layouts.footer')
    @include('layouts.script')
</body>

</html>
