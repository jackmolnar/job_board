@include('includes/applications/new_apps')

@include('includes/applications/pending_apps')

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
