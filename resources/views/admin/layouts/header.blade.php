<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashbord</title>

    <!-- Styles -->
        <link href="{{ asset('frontednd/css/bootstrap.min.css') }}" rel="stylesheet">
        <!--  Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--Switchery Toggle Buttons library-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
        <!-- Toaster library -->        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <style type="text/css">
          a{
                text-decoration: none;
            }
        </style>

</head>

<body>