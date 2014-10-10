@if(count($job->applications))
    @foreach($job->applications as $application)
        @if($application->user_id != $user->id)
            {{ link_to_action('ApplicationsController@create', 'Apply', [$job['id']], ['class' => 'btn btn-primary btn-sm']) }}
        @else
            Applied! {{ link_to_action('ApplicationsController@show', 'View Application', [$job->id, $application->id], ['class' => 'btn btn-small btn-warning'] ) }}
        @endif
    @endforeach
@else
    {{ link_to_action('ApplicationsController@create', 'Apply', [$job['id']], ['class' => 'btn btn-primary btn-sm']) }}
@endif
