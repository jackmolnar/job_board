@if($user->role->title == 'Administrator')
    <div class="panel panel-default">
        <div class="panel-heading">Applicant Info</div>
        <div class="panel-body">
            <div class="col-md-6">
                <h4>Name</h4>
                <p>{{ $application->user->first_name }} {{ $application->user->last_name }} </p>
                <h4>Email</h4>
                <p><a href="mailto:{{ $application->user->email }}">{{ $application->user->email }}</a></p>
            </div>
            <div class="col-md-6">
                <h4>Phone</h4>
                <p>{{ $application->user->phone }}</p>
            </div>
        </div>
    </div>
@endif
