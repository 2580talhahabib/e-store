<!doctype html>
<html lang="en">
  <head>
  	<title>Sidebar 04</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
		<link rel="stylesheet" href="{{ url('admin/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
		@include('layout.admin.sidebar')

     @yield('admin-content')

    <script src="{{ url('admin/js/jquery.min.js') }}"></script>
    
    <script src="{{ url('admin/js/main.js') }}"></script>
      <!-- Other meta tags -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
@yield('admin-script')
  </body>
</html>