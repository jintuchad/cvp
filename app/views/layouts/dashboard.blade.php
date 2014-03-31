<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en"><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		@include('layouts._partials.icons')
		
		<title>
			@section('title')
			Dashboard
			@show
		</title>
		<meta name="description" content="{{ Lang::get('company.description') }}">

		<link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
		@include('layouts._partials.styles')

		<script src="{{ asset('js/modernizr.min.js') }}"></script>
		<script src="{{ asset('js/jquery.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/vendor.min.js') }}"></script>
		<script src="{{ asset('js/app.min.js') }}"></script>
		<script src="{{ asset('js/dashboard.min.js') }}"></script>

	</head>
	<body class="dashboard">

		@include('layouts._partials.navbar-dashboard')
		@include('layouts._partials.notifications-dashboard')

		@yield('content')

		@include('layouts._partials.analytics')
		
	</body>
</html>