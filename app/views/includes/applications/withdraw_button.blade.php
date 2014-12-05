{{ $application->id }}
{{ Form::open(['action' => ['ApplicationsController@destroy', $job->id, $application->id], 'method' => 'delete' ]) }}
{{ Form::submit('Withdraw Application', ['class' => 'btn btn-small btn-warning']) }}
{{--{{ link_to_action('ApplicationsController@destroy', 'Withdraw Application', [$job->id, $application->id], ['class' => 'btn btn-small btn-warning', 'data-method' => 'delete']) }}--}}
{{ Form::close() }}



