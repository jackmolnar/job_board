@extends('templates.main')

@section('main_area')

<h1 class="page_headline">Application for {{ $job['title'] }} - {{ $job['company_name'] }}</h1>

<div class="sub_row row">
    <div class="col-lg-9">
        @include('../includes/main/back_button')
    </div>
    <div class="col-lg-3">
        <h4>Applied on {{ $application->created_at }}</h4>
        @if($user->role->title == 'Graduate')
            @include('../includes/applications/withdraw_button')
        @endif
    </div>
</div>

@include('../includes/main/success')

@include('../includes/main/errors')

<div class="panel panel-default">
    <div class="panel-heading">Details</div>
    <div class="panel-body">

        <div class="row">
            <div class="col-md-6">
                <h4>Description</h4>
                <p>{{ $job['description'] }}</p>
                @if($job['salary'] != '')
                    <h4>Salary: {{ $job['salary'] }}</h4>
                @endif
            </div>
            <div class="col-md-6">
                @if($job['qualifications'] != '')
                    <h4>Qualifications</h4>
                    <p>{{ $job['qualifications'] }}</p>
                @endif
                @if($job['experience'] != '')
                    <h4>Experience Required: {{ $job['experience'] }}</h4>
                @endif
            </div>
        </div>

        @if(isset($job['compensation_extras']) && $job['compensation_extras'] != '')
            <div class="row">
                <div class="col-md-6">
                    <h4>Compensation Extras</h4>
                    <p>{{ $job['compensation_extras'] }}</p>
                </div>
            </div>
        @endif

    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Company Info</div>
    <div class="panel-body">

        <div class="col-md-6">
            <h4>Company Name</h4>
            <p>{{ $job['company_name'] }}</p>
            <h4>Address</h4>
            <p>{{ $job['company_address'] }}</p>
        </div>
        <div class="col-md-6">
            <h4>City</h4>
            <p>{{ $job['company_city'] }}</p>
            <h4>State</h4>
            <p>{{ $job['company_state'] }}</p>
        </div>

    </div>
</div>


{{-- app comments --}}
@include('../includes/applications/app_comments')

{{-- add app comments --}}
@include('../includes/applications/add_app_comments')

@stop