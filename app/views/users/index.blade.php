@extends('templates.main')

@section('main_area')

	<h1 class="page_headline">Welcome back {{ $user->first_name }}</h1>

    @include('../includes/main/success')

    @include('../includes/main/errors')

    @if($user->role->title == 'Administrator')
        @include('../includes/profile/admin_index')
    @elseif($user->role->title == 'Employment Specialist')
        @include('../includes/profile/emp_specialist_index')
    @elseif($user->role->title == 'Graduate')
        @include('../includes/profile/grad_index')
    @endif
@stop
