<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>Job Board</title>

	{{ HTML::style('assets/css/bootstrap.min.css') }}

	{{ HTML::style('assets/css/bootstrap_template.css') }}

	{{ HTML::style('assets/css/site_styles.css') }}


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

<body>

	@include('../includes/main/top_nav')

	<div class="container-fluid">
		<div class="row">

			@include("../includes/main/side_nav")

			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

				@yield('main_area')

			</div><!-- end main -->
		</div><!-- end row -->
	</div><!-- end container -->

</body>
	 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	{{ HTML::script('assets/js/bootstrap.min.js') }}
    {{ HTML::script('assets/js/deleteFix.js') }}



</html>