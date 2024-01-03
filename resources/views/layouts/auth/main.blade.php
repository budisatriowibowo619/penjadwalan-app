<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Penjadwalan App | {{ isset($page) ? $page : "Page"; }}</title>

    <link rel="icon" type="image/png" href="">

    <!-- Start CSS -->
    <link rel="stylesheet"  href="{{ asset('/dashlite/css/dashlite.css?ver=3.1.0') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('/dashlite/css/theme.css?ver=3.1.0') }}">
    <link rel="stylesheet" href="{{ asset('custom/style.css') }}">
    <!-- End CSS -->
    
</head>

<body class="nk-body npc-invest bg-lighter ">

    <div class="nk-app-root">

        @include('partials.auth.navbar')

        @yield('container')

        <!-- footer @s -->
        <div class="nk-footer nk-footer-fluid bg-lighter">
            <div class="container-xl">
                <div class="nk-footer-wrap">
                    <div class="nk-footer-copyright"> &copy; {{ date('Y'); }} Aplikasi Penjadwalan
                    </div>
                    <div class="nk-footer-links">
                    </div>
                </div>
            </div>
        </div>
        <!-- footer @e -->

    </div>
    
</body>

    <!-- Start JS -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}}
    <script src="{{ asset('/dashlite/js/bundle.js?ver=3.1.0') }}"></script>
    <script src="{{ asset('/dashlite/js/libs/fullcalendar.js?ver=3.1.0') }}"></script>
    <?= isset($js_script) ? '<script type="text/javascript" src="'.asset($js_script).'"></script>' : ""; ?>
    {{-- <script src="{{ asset('/dashlite/js/apps/calendar.js?ver=3.1.0') }}"></script> --}}
    <!-- End JS -->
</html>