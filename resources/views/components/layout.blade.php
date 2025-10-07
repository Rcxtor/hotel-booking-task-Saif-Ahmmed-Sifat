<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="image/png" sizes="16x16" rel="icon" href="{{ asset('assets/image/favicon/favicon.png') }}">
    <!-- <title>Welcome | Hotel Go</title> -->
    <title>{{ $title ?? 'Hotel Go' }}</title>
    @vite('resources/css/layout.css')
</head>
<body>
    <!-- nav bar -->
     <div>
       <x-navbar/>
     </div>


   {{ $slot }} 
</body>
</html>