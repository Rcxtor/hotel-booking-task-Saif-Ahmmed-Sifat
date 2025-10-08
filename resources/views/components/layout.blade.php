<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="image/png" sizes="16x16" rel="icon" href="{{ asset('assets/image/favicon/favicon.png') }}">
    <!-- <title>Welcome | Hotel Go</title> -->
    <title>{{ $title ?? ''}} | Hotel Go</title>
    @vite('resources/css/layout.css')
</head>
<style>
    body {
        background-image: url("{{ asset('assets/image/background.jpg') }}");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
</style>
<body>
    <!-- nav bar -->
    <div>
        <x-navbar/>
    </div>

    <!-- Main content -->
    <div class="main-content">
        {{ $slot }}
    </div>

    <div>
        <x-footer/>
    </div>
</body>
</html>