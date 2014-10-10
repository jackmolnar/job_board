@extends('templates.main')

@section('main_area')

<h1 class="page_headline">Request Application for {{ $job->title }}</h1>

<div class="sub_row row">
    @include('../includes/main/back_button')
</div>

	{{ Form::open(array('action' => ['ApplicationsController@store', $job->id])) }}

        {{ Form::label('message', 'Send with Comments?') }}
	    {{ Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'message']) }}

	    {{ Form::submit('Send Application Request', ['class' => 'btn btn-primary']) }}

    {{ Form::close() }}

@stop