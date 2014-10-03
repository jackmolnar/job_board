<html>
<head>
	<title></title>
	
	{{ HTML::style('assets/css/bootstrap.min.css') }}

</head>
<body>

	@yield('content')

</body>
	 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	{{ HTML::script('assets/js/bootstrap.min.js') }}


</html>