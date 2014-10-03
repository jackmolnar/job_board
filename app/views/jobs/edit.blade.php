@extends('templates.main')

@section('main_area')

<a href="{{ URL::previous() }}">< Back</a>

<h1>Edit Job</h1>
	
	@include('../includes/main/errors')

	{{ Form::model($job, array('action' => array('JobsController@update', $job['id']), 'method' => 'put') ) }}

		<div class="panel panel-default">
		    <div class="panel-heading">Details</div>
		    <div class="panel-body">

		        <div class="row">
                    <div class="col-md-6">
                        {{ Form::label('title', 'Title'); }}
                        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']); }}<br/>
		            </div>
		            @foreach($job->programs as $selected_program)
                        <div class="col-md-6">
                            {{ Form::label('programs', 'Program'); }}
                            {{ Form::select('programs[]', $programs, $selected_program->id, ['class' => 'form-control', 'placeholder' => 'Title']); }}<br/>
                        </div>
                    @endforeach
		        </div>

				<div class="row">
					<div class="col-md-6">
						{{ Form::label('description') }}<br/>
						{{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description', 'rows' => '8']); }}<br/>

						{{ Form::label('pay', 'Salary'); }}
						{{ Form::text('pay', null, ['class' => 'form-control', 'placeholder' => 'Salary']); }}<br/>

					</div><!-- end col 1 -->
					<div class="col-md-6">
						{{ Form::label('qualifications') }}<br/>
						{{ Form::textarea('qualifications', null, ['class' => 'form-control', 'placeholder' => 'Qualifications', 'rows' => '8']); }}<br/>

						{{ Form::label('experience', 'Years of Experience'); }}
						{{ Form::text('experience', null, ['class' => 'form-control', 'placeholder' => 'Experience']); }}<br/>
					</div><!-- end col 2 -->

				</div><!-- end row -->

				

				{{ Form::label('compensation_extras') }}<br/>
				{{ Form::textarea('compensation_extras', null, ['class' => 'form-control', 'placeholder' => 'Compensation Extras', 'rows' => '3']); }}<br/>

			</div>
		</div>

		<div class="panel panel-default">
		    <div class="panel-heading">Location</div>
		    <div class="panel-body">

		    	<div class="col-md-6">
				    {{ Form::label('company_name', 'Company Name'); }}
					{{ Form::text('company_name', null, ['class' => 'form-control', 'placeholder' => 'Company Name']); }}

				    {{ Form::label('address', 'Address'); }}
					{{ Form::text('company_address', null, ['class' => 'form-control', 'placeholder' => 'Address']); }}
				</div>

				<div class="col-md-6">
					{{ Form::label('city', 'City') }}
					{{ Form::text('company_city', null, ['class' => 'form-control', 'placeholder' => 'City']); }}

					{{ Form::label('state', 'State') }}
					{{ Form::text('company_state', null, ['class' => 'form-control', 'placeholder' => 'State']); }}
				</div>

		    </div>
		</div>

		{{ Form::submit('Save Job', ['class' => 'btn btn-md btn-primary btn-block']) }}
  
  	{{ Form::close() }}

@stop