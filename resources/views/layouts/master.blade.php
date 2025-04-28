<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.partials._head')
</head>

<body data-sidebar="dark">

<div id="app">
    <!-- Begin page -->
    <div id="layout-wrapper">

        @if(!request()->is('/') && !request()->is('login') && !request()->is('register'))
            @include('layouts.partials._header')
        @endif

        <!-- ========== Left Sidebar Start ========== -->
        @if(!request()->is('/') && !request()->is('login') && !request()->is('register'))
            @include('layouts.partials.sidebars._sidebar-'.auth()->user()->user_type)
        @endif
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="{{request()->is('login') || request()->is('register') ? '':'page-content'}}">
                <div class="container-fluid">

                    <!-- start page title -->
                    @if(!request()->is('/') && !request()->is('login') && !request()->is('register'))
                        @include('layouts.partials._breadcrumb')
                    @endif
                    <!-- end page title -->


                    <!-- Start Your Main Content Here-->
                    @yield('content')

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @if(!request()->is('/') && !request()->is('login') && !request()->is('register'))
                @include('layouts.partials._footer')
            @endif

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
</div>

<!-- JAVASCRIPT -->
@include('layouts.partials._footer-script')

</body>
</html>
