@extends('templates.main')

@section('main_area')

	<h1 class="page_headline">Import Graduates</h1>

	@include('includes.main.errors')
	@include('includes.main.success')

    {{ Form::open(['action' => 'UsersController@import_store', 'files' => true]) }}

    {{ Form::label('user_import', 'Browse for Excel File of Grads You Wish to Import') }}
    {{ Form::file('user_import') }}

    {{ Form::submit('Start Import', ['class' => 'btn btn-primary']) }}
@stop