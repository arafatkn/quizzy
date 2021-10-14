<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">

    <title>@yield('title')</title>
</head>
<body>

@include('public.layouts.master.header')

<div class="container mt-3 mt-lg-5">
    @yield('content')
</div>

@include('public.layouts.master.footer')

<!-- Bootstrap Bundle with Popper -->
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>

@yield('script')

</body>
</html>
