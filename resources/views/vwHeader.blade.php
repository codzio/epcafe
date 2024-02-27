<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="facebook-domain-verification" content="layzn4ks2zqdivl31x9n44t0hityh8" />
<meta name="csrf-token" content="{{ csrf_token() }}">  
<link rel="shortcut icon" href="{{ getImg(setting('favicon')); }}"/>
<title>{{ setting('website_name') }} | {{ $title }}</title>

<!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/rs-plugin/css/settings.css" media="screen" />

<!-- Bootstrap Core CSS -->
<link href="{{ asset('public/frontend') }}/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="{{ asset('public/frontend') }}/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="{{ asset('public/frontend') }}/css/ionicons.min.css" rel="stylesheet">
<link href="{{ asset('public/frontend') }}/css/main.css" rel="stylesheet">
<link href="{{ asset('public/frontend') }}/css/style.css" rel="stylesheet">
<link href="{{ asset('public/frontend') }}/css/responsive.css" rel="stylesheet">

<!-- JavaScripts -->
<script src="{{ asset('public/frontend') }}/js/modernizr.js"></script>

<!-- Online Fonts -->
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900' rel='stylesheet' type='text/css'>

<script src="{{ asset('public/frontend') }}/js/jquery-1.11.3.min.js"></script>

<style>

 div.ldr{
    border-right: 4px solid var(--primary-color-2);
 }
 div.ldr:before{
  border-left: 3px solid var(--primary-color-3);
 }
 div.ldr:after{
  border-right: 2px solid var(--primary-color-2);
 }
  .home-slider{
    height:80vh;
  }
  .testimonial .owl-dots{
    position:unset;
  }
  .small-about{
    border-top:0;
  }
  .testimonial p{
    width:100%;
    max-width:90%;
    text-align:center;
  }
  .testimonial .testi-in h5{
    text-align:center;
  }
  .testimonial .owl-dots{
    display:flex;
    justify-content:center;
    align-items:center;
  }
  .testimonial .testi-in i{
    display:block;
    text-align:center;
    position:unset;
  }
  .papular-block .item{
    margin-bottom:25px;
  }
</style>

{!! setting('header_scripts') !!}

</head>
<body>

  {!! setting('body_scripts') !!}

<!-- LOADER -->
<div id="loader">
  <div class="position-center-center">
    <div class="ldr"></div>
  </div>
</div>