<div class="panel panel-default">
    <div class="panel-heading">Add a New Comment</div>
    <div class="panel-body">
        {{ Form::open(['action' => ['ApplicationCommentsController@store', $job->id, $application->id]]) }}

        {{ Form::textarea('application_comment', null, ['class' => 'form-control', 'rows' => 3]) }}

        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}

        {{ Form::close() }}
    </div>
</div>
