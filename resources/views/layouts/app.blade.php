<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/modern-vertical/style.css') }}">
        <!-- End layout styles -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
        @yield('styles')
    </head>

    <body>
        <div class="container-scroller">

            <!-- partial:partials/_sidebar.html -->
            @auth
            @include('dashboard.partials.side-menu')

            @include('dashboard.partials.nav')
            <div class="container-fluid page-body-wrapper">
                <div class="main-panel">
                    <div class="content-wrapper">
                        @include('dashboard.partials.breadcrumbs')
                        <div class="row">
                           @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            @endauth

            @yield('body')

       
        </div>
        <!-- page-body-wrapper ends -->
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="{{ asset('/assets/vendors/js/vendor.bundle.base.js') }}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        @yield('scripts')
        <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
        <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
        <script src="{{ asset('assets/js/misc.js') }}"></script>
        <script src="{{ asset('assets/js/settings.js') }}"></script>
        <script src="{{ asset('assets/js/todolist.js') }}"></script>
        <!-- endinject -->
    </body>

</html>
