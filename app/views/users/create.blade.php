@extends('templates.login')

@section('content')

<div class="container">

	<h1>Create New User</h1>

		<h4>{{$errors->first()}}</h4>

		{{ $errors->first() }}

	{{ Form::open(array('action' => 'UsersController@store')) }}

		{{ Form::label('email', 'E-Mail'); }}
		{{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']); }}

		{{ Form::label('password') }}
		{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']); }}

		{{ Form::label('First Name'); }}
		{{ Form::text('first_name' , null, ['class' => 'form-control', 'placeholder' => 'First Name']); }}

		{{ Form::label('Last Name'); }}
		{{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name']); }}

		{{ Form::label('Role'); }}
		{{ Form::select('role_id', $roles, ['class' => 'form-control', 'placeholder' => 'Email']); }}

        {{ Form::label('Programs'); }}
        {{ Form::select('program_id', $programs, ['class' => 'form-control', 'placeholder' => 'Email']); }}


		{{ Form::submit('Create User', ['class' => 'btn btn-md btn-primary btn-block']) }}


	
  	{{ Form::close() }}  	

</div>

@stop
