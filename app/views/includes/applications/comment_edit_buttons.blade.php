@if($comment->user_id == $user->id)
    {{ link_to_action('ApplicationCommentsController@destroy', 'Delete', [$job->id, $application->id, $comment->id], ['class' => 'btn btn-xs btn-danger', 'data-method' => 'delete']) }}
@endif