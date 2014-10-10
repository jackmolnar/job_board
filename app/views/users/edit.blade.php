@extends('templates.main')

@section('main_area')

    <h1 class="page_headline">Edit Profile</h1>

    <div class="sub_row row">
        @include('../includes/main/back_button')
    </div>

    @include('../includes/main/errors')

    @if($user->role->title == 'Administrator')
        @include('../includes/profile/admin_edit')
    @elseif($user->role->title == 'Graduate')
        @include('../includes/profile/grad_edit')
    @endif


@stop
