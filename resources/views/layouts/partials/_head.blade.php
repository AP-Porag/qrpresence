<meta charset="utf-8">
<meta name="description" content="@yield('meta_description')">
<meta name="keywords" content="@yield('meta_keywords')">
<title>{{get_page_meta()}} {{ config('settings.site_title') ?? config('app.name') }}</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- App favicon -->
<!--Favicon-->
<link rel="icon" href="{{ asset('/storage/settings/favicon.ico') }}" />
<link rel="icon" href="{{ asset('/storage/logo-light.png') }}" type="image/svg+xml" />
{{--
<link rel="shortcut icon" href="{{ storagelink(config('settings.site_favicon')) }}">--}}

<!-- Select2 CSS -->
<link href="{{ asset('admin/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">

<!-- Bootstrap Css -->
<link href="{{ asset('admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
<!-- Icons Css -->
<link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css">
<!-- App Css-->
<link href="{{ asset('admin/css/app.css') }}" id="app-style" rel="stylesheet" type="text/css">

<link href="{{ asset('admin/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('admin/sweetalert/sweetalert.min.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('admin/css/custom-dev.css') }}" rel="stylesheet" type="text/css">

@stack('style')
