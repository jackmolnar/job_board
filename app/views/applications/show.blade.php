@extends('templates.main')

@section('main_area')

<h1 class="page_headline">Application for {{ link_to_action('JobsController@show', $job['title'].' - '.$job['company_name'], $job['id'], null) }}</h1>

<div class="sub_row row">
    <div class="col-lg-9">
        @include('../includes/main/back_button')
    </div>
    <div class="col-lg-3">
        <h4>Applied on {{ $application->created_at->format('m-d-Y'); }}</h4>
        @if($user->role->title == 'Graduate')
            @include('../includes/applications/withdraw_button')
        @endif
        @if($user->role->title == 'Administrator')
        {{ Form::open(['action' => ['ApplicationStatusController@store', $job->id, $application->id]]) }}
            {{ Form::select('status', $status_dropdown, $application->status_id, ['class' => 'form-control', 'style' => 'max-width:175px; display:inline']) }}
            {{ Form::submit('Save', ['class' => 'btn btn-primary btn-sm', 'style' => 'margin-top: -8px; margin-left: 15px;']) }}
        {{ Form::close() }}
        @endif
    </div>
</div>

@include('../includes/main/success')

@include('../includes/main/errors')

@include('../includes/jobs/job_details')

{{-- company info --}}
@include('../includes/jobs/company_info')

{{-- applicants info --}}
@include('../includes/applications/applicant_info')

{{-- app comments --}}
@include('../includes/applications/app_comments')

{{-- add app comments --}}
@include('../includes/applications/add_app_comments')

@stop