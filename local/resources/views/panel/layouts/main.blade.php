<!DOCTYPE html>
<html dir="rtl" lang="fa">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="ARYA Creative Agency">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') | پنل مدیریت</title>

        <link href="{{ asset('admin/assets/libs/morris.js/morris.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/sweetalert2.min.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/dist/css/style.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="{{ asset('admin/assets/libs/datatables/datatables.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
        <style>.select2-container{display: block; width: 100%;}
        .note-popover .popover-content, .card-header.note-toolbar {z-index: 1}
        .select2-container--default .select2-selection--single {height: calc(2.25rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: .25rem;} .select2-container--default[dir="rtl"] .select2-selection--single .select2-selection__arrow {top: 6px;left: 5px;}</style>

        <script>
            window.Laravel = { csrfToken: '{{ csrf_token() }}' }
        </script>
    </head>

    <body data-theme="light">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div id="main-wrapper" data-theme="dark" data-layout="vertical" data-navbarbg="skin1" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
            @include('panel.layouts.topbar')
            @include('panel.layouts.sidebar')
            <div class="page-wrapper">
                <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-md-7 align-self-center">
                            <h4 class="page-title">@yield('title')</h4>
                        </div>
                        <div class="col-md-5 text-right">
                            @yield('items')
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    @yield('main')
                </div>
            </div>
        </div>
        <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>

        <script src="{{ asset('admin/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        
        <script src="{{ asset('admin/dist/js/app.min.js') }}"></script>
        <script src="{{ asset('admin/dist/js/app.init.js') }}"></script>
        
        <script src="{{ asset('admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
        <script src="{{ asset('admin/assets/extra-libs/sparkline/sparkline.js') }}"></script>
        
        <script src="{{ asset('admin/dist/js/waves.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/datatables/datatables.js') }}"></script>
        
        <script src="{{ asset('admin/dist/js/custom.min.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script src="{{ asset('admin/assets/libs/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/morris.js/morris.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
        <script>
            $("select").select2({
                dir: "rtl",
            });
        </script>
        @yield('scripts')
    </body>
</html>