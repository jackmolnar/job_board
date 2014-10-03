@extends('templates.login')

@section('content')

<div class="container">

	<h1>Please Log In</h1>

	@include('includes/main/errors')


	{{ Form::open(array('action' => 'AuthController@postLogin')) }}

		{{ Form::label('email', 'E-Mail'); }}
		{{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']); }}

		{{ Form::label('password') }}
		{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']); }}

		{{ Form::submit('Login', ['class' => 'btn btn-md btn-primary btn-block']) }}
  
  	{{ Form::close() }}


  	{{ link_to_action('UsersController@create', 'Create New User') }}
  	

</div>

@stop