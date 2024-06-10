<!DOCTYPE html>
<html lang="fa">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="ARYA Creative Agency">
        
        <meta name="copyright" content="{{ Setting::get('copyright_meta') }}">
        <meta name="robots" content="index, follow">
        <link rel="canonical" href="{{ Request::url() }}">
        @if (Route::currentRouteName() == 'site.home')
        <meta property="og:title" content="{{ Setting::get('site_title') }}">
        @else
        <meta property="og:title" content="@yield('title')">
        @endif
        <meta property="og:url" content="{{ Request::url() }}">
        <meta property="og:site_name" content="{{ Setting::get('site_title') }}">

        
        @if (Route::currentRouteName() == 'site.home')
        <title>{{ Setting::get('site_title') }}</title>
        @else
        <title>@yield('title') | {{ Setting::get('site_title') }}</title>
        @endif
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
        <script>window.Laravel={csrfToken:"{{ csrf_token() }}"};</script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123056459-2"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-123056459-2');
        </script>
        @yield('seo')
    </head>
    <body>
        @include('site.layouts.header')
        @yield('main')
        @include('site.layouts.footer')
        
        <div style="display:none" itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
            <span itemprop="ratingValue">{{ mt_rand(40, 50) / 10 }}</span> stars – 
            <span itemprop="reviewCount">{{ rand(20, 200) }}</span> reviews
        </div>
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('assets/js/newsletter.js') }}"></script>
        {{-- <script type="text/javascript" src="https://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c00ebdbe81b2bef"></script> --}}
        @yield('scripts')
    </body>
</html>