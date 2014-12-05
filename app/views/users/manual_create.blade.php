@extends('templates.main')

@section('main_area')

	<h1 class="page_headline">Add New Grad</h1>

	@include('includes.main.errors')

	<div class="col-md-6">
	{{ Form::open(array('action' => 'UsersController@store')) }}

		{{ Form::label('email', 'E-Mail'); }}
		{{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']); }}

		{{ Form::label('First Name'); }}
		{{ Form::text('first_name' , null, ['class' => 'form-control', 'placeholder' => 'First Name']); }}

		{{ Form::label('Last Name'); }}
		{{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name']); }}

        {{ Form::label('Program'); }}
        {{ Form::select('program_id', $programs, null, ['class' => 'form-control', 'placeholder' => 'Email']); }}

        {{ Form::label('Send Invite Email'); }}
        {{ Form::checkbox('invite', 1, true); }}

        {{ Form::hidden('role_id', 3) }}

		{{ Form::submit('Create User', ['class' => 'btn btn-md btn-primary btn-block']) }}

  	{{ Form::close() }}

  		</div>

@stop
