@extends('templates.main')

@section('main_area')

@include('../includes/main/back_button')

{{-- load the view based on role --}}
@if($user->role->title == 'Graduate')
    @include('../includes/applications/grad_show')
@elseif($user->role->title == 'Administrator')
    @include('../includes/applications/admin_show')
@endif

{{-- app comments --}}
@include('../includes/applications/app_comments')

{{-- add app comments --}}
@include('../includes/applications/add_app_comments')

@stop