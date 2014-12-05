@extends('templates.login')

@section('content')

{{ Form::open(['action' => 'RemindersController@postReset']) }}

    {{ Form::hidden('token', $token) }}

    {{ Form::label('email', 'E-Mail'); }}
    {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']); }}

    {{ Form::label('password') }}
    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']); }}

    {{ Form::label('password') }}
    {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Password Confirmation']); }}

    {{ Form::submit('Reset Password', ['class' => 'btn btn-md btn-primary btn-block']) }}

{{ Form::close() }}
@stop