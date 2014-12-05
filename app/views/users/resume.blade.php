@extends('templates.main')

@section('main_area')

	<h1 class="page_headline">Upload Resume</h1>

	<div class="sub_row row">
	    @include('../includes/main/back_button')
	</div>

    @include('../includes/main/success')
    @include('../includes/main/errors')

	<div class="row">
	    <div class="col-md-4">
	    	{{ Form::open(array('action' => array('UsersController@postResume', $id), 'files' =>true )) }}

            {{ Form::label('resume', 'Browse For File') }}

            {{ Form::file('resume', ['class' => 'form-control']) }}

            {{ Form::submit('Upload', ['class' => 'btn btn-md btn-primary btn-block']) }}
	    </div>
	</div>

@stop
