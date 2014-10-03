@extends('templates.main')

@section('main_area')

@include('../includes/main/success')

<h1>Request Application for {{ $job->title }}</h1>

	{{ Form::open(array('action' => ['ApplicationsController@store', $job->id])) }}

        {{ Form::label('message', 'Send with Comments?') }}
	    {{ Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'message']) }}

	    {{ Form::submit('Send Application Request', ['class' => 'btn btn-primary']) }}

    {{ Form::close() }}

@stop