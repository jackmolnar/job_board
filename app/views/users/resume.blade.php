@extends('templates.main')

@section('main_area')

    @include('../includes/main/back_button')

    @include('../includes/main/success')

    @include('../includes/main/errors')

	<h1>Upload Resume</h1>

	<div class="row">
	    <div class="col-md-4">


	    	{{ Form::open(array('action' => array('UsersController@postResume', $id), 'files' =>true )) }}

            {{ Form::label('resume', 'Browse For File') }}

            {{ Form::file('resume', ['class' => 'form-control']) }}

            {{ Form::submit('Upload', ['class' => 'btn btn-md btn-primary btn-block']) }}
	    </div>
	</div>


@stop
