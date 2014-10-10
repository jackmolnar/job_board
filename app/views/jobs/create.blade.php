@extends('templates.main')

@section('main_area')

<h1 class="page_headline">Post New Job</h1>

<div class="sub_row row">
    @include('../includes/main/back_button')
</div>
	
	@include('../includes/main/errors')

	{{ Form::open(array('action' => 'JobsController@store')) }}

		<div class="panel panel-default">
		    <div class="panel-heading">Details</div>
		    <div class="panel-body">

		        <div class="row">

		            <div class="col-md-6">
                        {{ Form::label('title', 'Title'); }} <span class="glyphicon glyphicon-asterisk" style="color: red"></span>
                        {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']); }}<br/>
		            </div>
		            <div class="col-md-6" style="margin-bottom: 20px">
                            {{ Form::label('programs', 'Associated Programs'); }}
                            <a class="btn btn-default btn-xs add_program" style="margin-left: 25px">Add Program</a>
                            <a class="btn btn-default btn-xs delete_program">Delete Program</a>
                            <div class="col-md-6 program_dropdown">
                                {{ Form::select('programs[]', $programs, null, ['class' => 'form-control', 'placeholder' => 'Title']); }}<br/>
                            </div>
		            </div>
		        </div>

				<div class="row">
					<div class="col-md-6">
						{{ Form::label('description') }} <span class="glyphicon glyphicon-asterisk" style="color: red"></span> <br/>
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
				<div class="row">
                    <div class="col-md-6">
                        {{ Form::label('compensation_extras', 'Compensation Extras') }}<br/>
                        {{ Form::textarea('compensation_extras', null, ['class' => 'form-control', 'placeholder' => 'Compensation Extras', 'rows' => '4']); }}<br/>
                    </div><!-- end col 1 -->
                    <div class="col-md-6">
                        <div class="col-md-6 col_padding_fix">
                            {{ Form::label('contact_link', 'Contact Link or Email Address') }}<br/>
                            {{ Form::url('contact_link', null, ['class' => 'form-control', 'placeholder' => 'Contact Link']); }}<br/>
                            {{ Form::url('contact_email', null, ['class' => 'form-control', 'placeholder' => 'Contact Email']); }}<br/>
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('confidential', 'Confidential?') }}<br/>
                            {{ Form::checkbox('confidential', 1, null); }}<br/>
                        </div>
                    </div><!-- end col 2 -->
				</div><!-- end row -->

			</div>
		</div>

		<div class="panel panel-default">
		    <div class="panel-heading">Location</div>
		    <div class="panel-body">

		    	<div class="col-md-6">
				    {{ Form::label('company_name', 'Company Name'); }} <span class="glyphicon glyphicon-asterisk" style="color: red"></span>
					{{ Form::text('company_name', null, ['class' => 'form-control', 'placeholder' => 'Company Name']); }}

				    {{ Form::label('address', 'Address'); }}
					{{ Form::text('company_address', null, ['class' => 'form-control', 'placeholder' => 'Address']); }}
				</div>

				<div class="col-md-6">
					{{ Form::label('city', 'City') }} <span class="glyphicon glyphicon-asterisk" style="color: red"></span>
					{{ Form::text('company_city', null, ['class' => 'form-control', 'placeholder' => 'City']); }}

					{{ Form::label('state', 'State') }} <span class="glyphicon glyphicon-asterisk" style="color: red"></span>
					{{ Form::text('company_state', null, ['class' => 'form-control', 'placeholder' => 'State']); }}
				</div>

		    </div>
		</div>

		{{ Form::submit('Post Job', ['class' => 'btn btn-md btn-primary btn-block']) }}
  
  	{{ Form::close() }}

@stop