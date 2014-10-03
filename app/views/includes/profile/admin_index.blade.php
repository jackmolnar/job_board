@if(!empty($job_apps))
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>New Applications</h4></div>
                <div class="panel-body">
                    <table>
                    <th>Title</th>
                    <th>Who Applied</th>
                    <th>Date Applied</th>
                        @foreach($job_apps as $application)
                            <tr>
                                <td>{{ link_to('jobs/'.$application->id, $application->title )    }}</td>
                                <td>{{ $application->first_name }} {{ $application->last_name }}</td>
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
