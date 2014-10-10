@extends('templates.main')

@section('main_area')

<h1 class="page_headline">
    {{ $job['title'] }} - {{ $job['company_name'] }}
</h1>

<div class="sub_row row">
    <div class="col-md-9">@include('../includes/main/back_button')</div>
    <div class="col-md-3">
        @if($user->role->title == 'Administrator')
            @include('../includes/jobs/edit_button')
            @include('../includes/jobs/delete_button')
        @elseif($user->role->title == 'Graduate')
            @include('../includes/jobs/apply_button')
        @endif
    </div>
</div>


@include('../includes/main/success')

		<div class="panel panel-default">
		    <div class="panel-heading"><h4>Details</h4></div>
		    <div class="panel-body">

		        <div class="row">
		            <div class="col-md-6">
                        <h4>Description</h4>
                        <p>{{ $job['description'] }}</p>
		                @if($job['salary'] != '' && $job['salary'] != null)
                            <h4>Salary: {{ $job['salary'] }}</h4>
                        @endif
		            </div>
		            <div class="col-md-6">
		                @if($job['qualifications'] != '')
                            <h4>Qualifications</h4>
                            <p>{{ $job['qualifications'] }}</p>
                        @endif
		                @if($job['experience'] != '' && $job['experience'] != null)
                            <h4>Experience Required: {{ $job['experience'] }}</h4>
                        @endif
                    </div>
		        </div><!-- end row -->

                    <div class="row">
                        @if(isset($job['compensation_extras']) && $job['compensation_extras'] != '')
                            <div class="col-md-6">
                                <h4>Compensation Extras</h4>
                                <p>{{ $job['compensation_extras'] }}</p>
                            </div>
                        @endif

                        @if($job['confidential'] == false || $user->role->title == 'Administrator')
                            <div class="col-md-6">
                                @if($job['contact_link'] != '')
                                    <h4>Link to Apply</h4>
                                    <p><a target="_blank" href="{{$job['contact_link']}}">{{$job['contact_link']}}</a> </p>
                                @endif
                                @if($job['contact_email'] != '')
                                    <h4>Email Contact</h4>
                                    <p><a href="mailto:{{$job['contact_email']}}">{{$job['contact_email']}}</a> </p>
                                @endif
                            </div>
                        @endif
                    </div><!-- end row -->

			</div><!-- end panel body -->
		</div><!-- end panel -->

		<div class="panel panel-default">
		    <div class="panel-heading"><h4>Company Info</h4></div>
		    <div class="panel-body">

		    	<div class="col-md-6">
                    <h4>Name</h4>
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


@stop