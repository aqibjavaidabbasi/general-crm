<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-layout-mode="dark" data-body-image="img-1" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Home | FlexiCMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="stylesheet" href="{{ asset('galaxy-theme/assets/images/favicon.ico') }}">

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

</head>

<body>


    <!-- Begin page -->
<div id="layout-wrapper">

    @yield('content')


    <!-- JAVASCRIPT -->
    <script src="{{ asset('galaxy-theme/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
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
</body>

</html>
