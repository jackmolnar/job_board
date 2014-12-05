<div class="panel panel-default">
    <div class="panel-heading"><h4>Details</h4></div>
    <div class="panel-body">

        <div class="row">
            <div class="col-md-6">
                <h4>Description</h4>
                <p>{{ $job['description'] }}</p>
                @if($job['salary'])
                    <h4>Salary: {{ $job['salary'] }}</h4>
                @endif
            </div>
            <div class="col-md-6">
                @if($job['qualifications'])
                    <h4>Qualifications</h4>
                    <p>{{ $job['qualifications'] }}</p>
                @endif
                @if($job['experience'])
                    <h4>Experience Required: {{ $job['experience'] }}</h4>
                @endif
            </div>
        </div><!-- end row -->

            <div class="row">
                @if($job['compensation_extras'])
                    <div class="col-md-6">
                        <h4>Compensation Extras</h4>
                        <p>{{ $job['compensation_extras'] }}</p>
                    </div>
                @endif

                @if($job['confidential'] == false || $user->role->title == 'Administrator')
                    <div class="col-md-6">
                        @if($job['contact_link'])
                            <h4>Link to Apply</h4>
                            <p><a target="_blank" href="{{$job['contact_link']}}">{{$job['contact_link']}}</a> </p>
                        @endif
                        @if($job['contact_email'])
                            <h4>Email Contact</h4>
                            <p><a href="mailto:{{$job['contact_email']}}">{{$job['contact_email']}}</a> </p>
                        @endif
                    </div>
                @endif
            </div><!-- end row -->

    </div><!-- end panel body -->
</div><!-- end panel -->