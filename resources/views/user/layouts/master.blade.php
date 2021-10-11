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

<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            @include('user.layouts.master.header')
        </div>
        <div class="col py-3">
            @yield('content')
        </div>
    </div>
</div>

{{--@include('user.layouts.master.footer')--}}

<!-- Bootstrap Bundle with Popper -->
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>

@yield('script')

</body>
</html>
