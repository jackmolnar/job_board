@extends('templates.main')

@section('main_area')

    @include('../includes/main/success')

    @include('../includes/main/errors')

	<h1>User Main Screen</h1>

    @if($user->role->title == 'Administrator')
        @include('../includes/profile/admin_index')
    @elseif($user->role->title == 'Graduate')
        @include('../includes/profile/grad_index')
    @endif
@stop
