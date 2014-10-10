
	{{ Form::open(array('action' => array('UsersController@update', $user->id), 'method' => 'put')) }}

	<div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Personal Information</h4></div>
                    <div class="panel-body">
                        <div class="col-md-6">
                            {{ Form::label('first_name', 'First Name'); }}
                            {{ Form::text('first_name', $user->first_name, ['class' => 'form-control', 'placeholder' => 'First Name']); }}<br/>
                            {{ Form::label('email', 'Email'); }}
                            {{ Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Email']); }}<br/>
                            {{ Form::label('phone', 'Phone Number'); }}
                            {{ Form::text('phone', $user_details->phone, ['class' => 'form-control jb_checkbox', 'placeholder' => 'Phone']); }}<br/>
                            {{ Form::label('text', 'Text Message?'); }} &nbsp;
                            {{ Form::checkbox('text', 1, $user_details->text) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('last_name', 'Last Name'); }}
                            {{ Form::text('last_name', $user->last_name, ['class' => 'form-control', 'placeholder' => 'Last Name']); }}<br/>
                        </div>

                    </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Address</h4></div>
                    <div class="panel-body">
                        <div class="col-md-6">
                            {{ Form::label('street1', 'Street Address 1'); }}
                            {{ Form::text('street1', $user_details->street1, ['class' => 'form-control', 'placeholder' => 'Street Address 1']); }}<br/>
                            {{ Form::label('city', 'City'); }}
                            {{ Form::text('city', $user_details->city, ['class' => 'form-control', 'placeholder' => 'City']); }}<br/>
                            {{ Form::label('zip', 'Zip Code'); }}
                            {{ Form::text('zip', $user_details->zip, ['class' => 'form-control jb_checkbox', 'placeholder' => 'Zip']); }}<br/>
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('street2', 'Street Address 2'); }}
                            {{ Form::text('street2', $user_details->street2, ['class' => 'form-control', 'placeholder' => ' Street Address 2']); }}<br/>
                            {{ Form::label('state', 'State'); }}
                            {{ Form::text('state', $user_details->state, ['class' => 'form-control', 'placeholder' => 'State']); }}<br/>
                        </div>

                    </div>
            </div><!-- end panel -->
        </div><!-- end col -->
    </div><!-- end row -->

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Programs I Manage</h4>

                    <a class="btn btn-default btn-xs add_program">Add Program</a>
                    <a class="btn btn-default btn-xs delete_program">Delete Program</a>


                </div>
                <div class="panel-body">
                    @foreach($user->programs as $program)
                        <div class="col-md-6 program_dropdown">
                            {{ Form::select('programs[]', $all_programs, $program->id, ['class' => 'form-control ', 'placeholder' => 'Title']); }}
                        </div>
                    @endforeach

                </div>
            </div><!-- end panel -->
        </div><!-- end col -->
    </div><!-- end row -->

    <div class="row">
        <div class="col-md-12">
            {{ Form::submit('Save', ['class' => 'btn btn-md btn-primary']) }}
        </div>
    </div>

    {{ Form::close() }}
