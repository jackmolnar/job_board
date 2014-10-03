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
                                <td>{{ $application->created_at }}</td>
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
            <div class="panel-heading"><h4>Resume</h4></div>
            <div class="panel-body">
                {{ link_to($user->details->resume, 'Download', ['class' => 'btn btn-primary']) }}
                {{ link_to_action('UsersController@getResume', 'Upload New', ['id' => $user->id], ['class' => 'btn btn-success']) }}
            </div>
        </div>
    </div>
</div>
