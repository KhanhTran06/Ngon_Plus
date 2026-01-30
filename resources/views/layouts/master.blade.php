<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGON+ | @yield('title')</title>
    <link rel="icon" href="{{ asset('frontend/img/ngonPlus_favicon.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/navCustom.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    @stack('styles')
</head>
<body>

    @include('layouts.header') <div style="min-height: 80vh; padding-top: 80px;">
        @yield('content')
    </div>

    @include('layouts.footer') <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/js/nav.js') }}"></script>
    @stack('scripts')
</body>
</html>
