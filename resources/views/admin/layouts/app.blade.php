<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Admin | Spot</title>

	<!-- bootstrap css -->
	<link href="{{ asset('bootstrap5/bootstrap.min.css') }}" rel="stylesheet" />
	
	<!-- custom fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

	<!-- css -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/custom.css') }}" rel="stylesheet">

	<!-- Add jQuery from the jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
	<div class="wrapper">

    @include('admin/layouts.sidebar')

		<div class="main">
			
            @include('admin/layouts.navbar')

			@yield('content')
			
		</div>
	</div>

	@yield('scripts')
    <script src="https://kit.fontawesome.com/8297c50d72.js" crossorigin="anonymous"></script>
	
	<script src="{{asset ('/js/app.js')}}"></script> 

</body>

</html>