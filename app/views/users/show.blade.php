@extends('templates.main')

@section('main_area')

<h1 class="page_headline">Profile for {{ $user->first_name }} {{ $user->last_name }}</h1>

<div class="sub_row row">
    <div class="col-md-9">
        @include('includes.main.back_button')
    </div>
    <div class="col-md-3">
        {{ link_to_action('UsersController@getUpdateGrad', 'Edit', $user->id, ['class' => 'btn btn-success btn-xs']); }}
    </div>
</div>

@include('includes.main.success')
@include('includes.main.errors')

@if(count($user->applications))
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>My Applications</h4></div>
                <div class="panel-body">
                    <table>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Date Applied</th>
                        @foreach($user->applications as $application)
                            <tr>
                                <td>{{ link_to('jobs/'.$application->job->id.'/applications/'.$application->id, $application->job->title )    }}</td>
                                <td>{{ $application->status->title }}</td>
                                <td>{{ $application->created_at->format('m/d/y - g:i A') }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Personal Information</h4></div>
            <div class="panel-body">
                <p>Name: {{ $user->first_name }} {{ $user->last_name }}</p>
                <p>Phone: {{ $user->details->phone }}</p>
                <p>Email: {{$user->email }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Current Employer</h4></div>
            <div class="panel-body">
                <div class="col-md-6">
                    <p>Position Title: {{ $user->details->position_title ?: "None Listed" }}</p>
                    <p>Company: {{ $user->details->position_title ?: "None Listed" }}</p>
                </div>
            </div>
        </div><!-- end panel -->
    </div>
</div>


@if($user->role->title == 'Graduate')
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Resume</h4></div>
            <div class="panel-body">
                @if($user->details->resume != '')
                    {{ link_to($user->details->resume, 'Download', ['class' => 'btn btn-primary']) }}
                @endif
                {{ link_to_action('UsersController@getResume', 'Upload New', ['id' => $user->id], ['class' => 'btn btn-success']) }}
            </div>
        </div>
    </div>
</div>
@endif
@stop