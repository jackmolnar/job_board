@if(count($application->comments))
    <div class="panel panel-default">
        <div class="panel-heading">Application Comments</div>
        <div class="panel-body">
            @foreach($application->comments as $comment)
            <div class="row comment">
                <div class="col-md-2">
                    {{ $comment->author->first_name }} {{ $comment->author->last_name }} said at <br/>
                    {{ $comment->created_at }}
                </div>
                <div class="col-lg-10">
                    {{ $comment->body }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endif
