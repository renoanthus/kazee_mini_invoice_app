<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
<meta content="Coderthemes" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('adminto/dist/assets/images/favicon.ico') }}">
<!-- Bootstrap Css -->
<link href="{{asset('adminto/dist/assets/css/bootstrap.min.css')}}" id="bootstrap-stylesheet" rel="stylesheet"
  type="text/css" />
<!-- Icons Css -->
<link href="{{asset('adminto/dist/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{asset('adminto/dist/assets/css/app.min.css')}}" id="app-stylesheet" rel="stylesheet"
  type="text/css" />
<!-- Sweet Alert-->
<link href="{{asset('adminto/dist/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"
  type="text/css">
<link href="{{asset('adminto/dist/assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
@yield('css')