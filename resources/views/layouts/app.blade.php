<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PT. Inovasi Bioproduk Indonesia')</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body>
    @include('partials.header')
    <main>@yield('content')</main>
    @include('partials.footer')
</body>

</html>