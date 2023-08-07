<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>@yield('title', 'Catalog - Admin')</title>
<link rel="icon" href="{{ asset('/public/images/logo/admin_favicon.png') }}" type="image/x-icon">
<link rel="stylesheet" href="{{ asset('/public/css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('/public/css/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('/public/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/public/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('/public/css/intlTelInput.css') }}">
<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<link href="{{ asset('/public/scss/style.css') }}?<?php echo time(); ?> " rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->