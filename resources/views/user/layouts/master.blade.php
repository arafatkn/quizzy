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
            @include('partial.breadcrumbs')
            @include('partial.alert')
            @yield('content')
        </div>
    </div>
</div>

{{--@include('user.layouts.master.footer')--}}

<div class="modal fade" id="GDModal" tabindex="-1" role="dialog" aria-labelledby="GDModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-danger" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Are you sure?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p>Do you really want to delete this?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="" method="POST" id="gdForm">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Bootstrap Bundle with Popper -->
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    function gdConfirm(url) {
        console.log(url);
        document.getElementById("gdForm").action = url;
    }
    function formFill(dom, data) {
        dom.querySelectorAll('input,select,textarea').forEach(function(el){
            console.log(el.name)
            if(el.name.includes('[')) {
                let [ first, second ] = el.name.split('[');
                second = second.slice(0, -1);
                if(first in data && second in data[first]) {
                    el.value = data[ first ] [ second ];
                }
            } else if( el.name in data ) {
                el.value = data[ el.name ];
            }
        });
    }
</script>

@yield('script')

</body>
</html>
