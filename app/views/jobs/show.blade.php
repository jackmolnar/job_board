@extends('templates.main')

@section('main_area')

<h1 class="page_headline">
    {{ $job['title'] }} - {{ $job['company_name'] }}
    <span class="job_date">Created<br/>{{ $job['created_at']->format('m/d/y - g:i A') }}</span>
</h1>

<div class="sub_row row">
    <div class="col-md-9">@include('../includes/main/back_button')</div>
    <div class="col-md-3">
        @include('../includes/jobs/control_buttons')
    </div>
</div>

@include('../includes/main/success')

{{--job details--}}
@include('../includes/jobs/job_details')

{{-- company info --}}
@include('../includes/jobs/company_info')


@stop