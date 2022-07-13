<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'soccertipstar') }}</title>

    <meta content="" name="keywords">
    <meta content="" name="description">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900"
        rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link rel="stylesheet" href="{{ asset('frontend/lib/bootstrap/css/bootstrap.min.css') }}">

    <!-- Libraries CSS Files -->
    <link href="{{ asset('frontend/lib/nivo-slider/css/nivo-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/owlcarousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/owlcarousel/owl.transitions.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/venobox/venobox.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/jquery-steps/jquery.steps.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/toastr/toastr.min599c.css?v4.0.2') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/country-picker-flags/css/countrySelect.min.css') }}" rel="stylesheet">
 
    <!-- Nivo Slider Theme -->
    <link href="{{ asset('frontend/css/nivo-slider-theme.css') }}" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">

    <!-- Responsive Stylesheet File -->
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    
    <!-- Custom Stylesheet File.  Not part of the template -->
    <link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet">

    <!-- Responsive tables File.  Not part of the template -->
    <link href="{{ asset('frontend/css/responsive-tables.css') }}" rel="stylesheet">
    

</head>
