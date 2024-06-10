<!DOCTYPE html>
<html dir="rtl" lang="fa">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="ARYA Creative Agency">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') | پنل مدیریت</title>

        <link href="{{ asset('admin/dist/css/style.min.css') }}" rel="stylesheet">
    </head>

    <body>
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div id="main-wrapper">
            @yield('main')
        </div>
        <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>

        <script src="{{ asset('admin/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        @yield('scripts')
    </body>
</html>