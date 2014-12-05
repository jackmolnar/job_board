@if(count($job_apps))
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>New Applications</h4></div>
            <div class="panel-body">
                <table class="table table-striped">
                <th>Title</th>
                <th>Who Applied</th>
                <th>Status</th>
                <th>Date Applied</th>
                    @foreach($job_apps as $application)
                        @if($application->status_title == 'Sent')
                            <tr>
                                <td>{{ link_to('jobs/'.$application->job_id.'/applications/'.$application->app_id, $application->job_title, ['class' => 'table_link'] )    }}</td>
                                <td>{{ $application->first_name }} {{ $application->last_name }}</td>
                                <td>{{ $application->status_title }} </td>
                                <td>{{ date('m/d/y - g:i A', strtotime($application->applied_date)) }}</td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endif