<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark"
    data-sidebar-size="lg" data-sidebar-image="none" data-layout-mode="dark" data-body-image="img-1"
    data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title> @yield('page-title') | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('galaxy-theme/assets/images/favicon.ico') }}">

    <!-- jsvectormap css -->
    <link rel="stylesheet" href="{{ asset('galaxy-theme/assets/libs/jsvectormap/css/jsvectormap.min.css') }}">

    <!--Swiper slider css-->
    <link rel="stylesheet" href="{{ asset('galaxy-theme/assets/libs/swiper/swiper-bundle.min.css') }}">

    <!-- Layout config Js -->
    <script src="{{ asset('galaxy-theme/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="{{ asset('galaxy-theme/assets/css/bootstrap.min.css') }}">
    <!-- Icons Css -->
    <link rel="stylesheet" href="{{ asset('galaxy-theme/assets/css/icons.min.css') }}">
    <!-- App Css-->
    <link rel="stylesheet" href="{{ asset('galaxy-theme/assets/css/app.min.css') }}">
    <!-- custom Css-->
    <link rel="stylesheet" href="{{ asset('galaxy-theme/assets/css/custom.min.css') }}">
    <!-- dropzone css -->
    <link rel="stylesheet" href="{{ asset('galaxy-theme/assets/libs/dropzone/dropzone.css') }}" type="text/css" />

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    {{-- Summernote links --}}


    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4-dark.css" rel="stylesheet"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> --}}

    @stack('styles')

</head>

<body>


    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('layouts.header')
        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu border-end">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="{{ route('home') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('galaxy-theme/assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('galaxy-theme/assets/images/logo-dark.png') }}" alt=""
                            height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="{{ route('home') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('galaxy-theme/assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('galaxy-theme/assets/images/logo-light.png') }}" alt=""
                            height="17">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            @include('layouts.sidebar')

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <!-- End Page-content -->
            <div class="page-content">
                <div class="container-fluid">
                    @include('layouts.main-content-nav')
                    @include('sweetalert::alert')
                    @yield('content')
                </div>
            </div>


        </div>
        @include('layouts.footer')
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-primary btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    {{-- <div class="customizer-setting d-none d-md-block">
        <div class="btn-primary btn-rounded shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas"
            data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div> --}}

    <!-- Theme Settings -->
    @include('layouts.theme-settings')

    <!-- JAVASCRIPT -->
    {{-- <script src="{{ asset('galaxy-theme/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('galaxy-theme/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('galaxy-theme/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('galaxy-theme/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('galaxy-theme/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('galaxy-theme/assets/js/plugins.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('galaxy-theme/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset('galaxy-theme/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('galaxy-theme/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('galaxy-theme/assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('galaxy-theme/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('galaxy-theme/assets/js/app.js') }}"></script>

    <!-- dropzone min -->
    <script src="{{ asset('galaxy-theme/assets/libs/dropzone/dropzone-min.js') }}"></script> --}}

    <script src="{{ asset('galaxy-theme/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('galaxy-theme/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('galaxy-theme/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('galaxy-theme/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('galaxy-theme/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('galaxy-theme/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('galaxy-theme/assets/js/app.js') }}"></script>
    <script src="{{ asset('galaxy-theme/assets/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ asset('galaxy-theme/assets/js/pages/form-editor.init.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                document.querySelectorAll('.invalid-feedback').forEach(function(element) {
                    element.remove();
                });
            }, 3000);
        });
    </script>



    {{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    @stack('scripts')
</body>

</html>
