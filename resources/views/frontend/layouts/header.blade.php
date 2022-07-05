<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
      @yield('title')
  </title>

    <!-- Styles  -->
        <link href="{{ asset('frontednd/css/style.css') }}" rel="stylesheet">

        <!-- bootstrap -->
        <link href="{{ asset('frontednd/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Styles owl.carousel -->
        <link href="{{ asset('frontednd/css/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('frontednd/css/owl.theme.default.min.css') }}" rel="stylesheet">
        <!-- google font-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
        <!--  Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Toaster library -->        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        
        <meta name="csrf-token" content="{{ csrf_token() }}" />


        <style>
            a{
                text-decoration: none;
            }
            .card-img-top {
                width: 100%;
                height: 15vw;
                object-fit: contain;
            }
            .footer {
              position: fixed;
              left: 0;
              bottom: 0;
              width: 100%;
            }
        </style>
</head>

<body>
