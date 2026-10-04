<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PT. Inovasi Bioproduk Indonesia')</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}?v={{ file_exists(public_path('style.css')) ? filemtime(public_path('style.css')) : time() }}">
</head>

<body>
    @include('partials.header')
    <main>@yield('content')</main>
    @include('partials.footer')
    <script src="{{ asset('js/main.js') }}?v={{ file_exists(public_path('js/main.js')) ? filemtime(public_path('js/main.js')) : time() }}" defer></script>
</body>

</html>