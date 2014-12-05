@extends('templates.login')

@section('content')

{{ Form::open(['action' => 'RemindersController@postRemind']) }}

        {{ Form::label('email', 'E-Mail'); }}
        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']); }}

        {{ Form::submit('Send Reminder', ['class' => 'btn btn-md btn-primary btn-block']) }}

{{ Form::close() }}
@stop