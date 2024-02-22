<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Spot</title>

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

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
	
	<!-- Add SweetAlert2 from the SweetAlert2 CDN -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
	<div class="wrapper">

    @include('layouts.sidebar')

		<div class="main">
			
            @include('layouts.navbar')

			@yield('content')
			
		</div>
	</div>

	@yield('scripts')
    <script src="https://kit.fontawesome.com/8297c50d72.js" crossorigin="anonymous"></script>
	
	<script src="{{asset ('/js/app.js')}}"></script> 

</body>

</html>