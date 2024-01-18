<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo!empty($metaDescription) ? $metaDescription : 'frontend/'; ?>">
    <meta name="keyword" content="<?php echo!empty($metaKeyword) ? $metaKeyword : 'frontend/'; ?>">
    <title>{{ config('app.name') . ' | ' }} @yield('page_title')</title>

    <link rel="icon" type="image/png" href="{{ asset('uploads/site_logo/favicon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.fancybox.min.css') }}">

</head>

<body>
    @include('layouts.frontend_components.header')
    @yield('content')
    @include('layouts.frontend_components.footer')
    <script src="{{ asset('frontend/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('frontend/js/mdb.min.js') }}"></script>
    <script src="{{ asset('frontend/js/common.js') }}" type="text/javascript"></script>
    {{-- @yield('script') --}}
</body>

</html>
