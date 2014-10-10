
		<div class="panel panel-default">
		    <div class="panel-heading">Details</div>
		    <div class="panel-body">

		        <div class="row">
		            <div class="col-md-6">
                        <h4>Description</h4>
                        <p>{{ $job['description'] }}</p>
                        <h4>Salary: {{ $job['salary'] }}</h4>
		            </div>
		            <div class="col-md-6 program_dropdown">
		                <h4>Qualifications</h4>
		                <p>{{ $job['qualifications'] }}</p>
						<h4>Experience Required: {{ $job['experience'] }}</h4>
                    </div>
		        </div>

		        @if(isset($job['compensation_extras']) && $job['compensation_extras'] != '')
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Compensation Extras</h4>
                            <p>{{ $job['compensation_extras'] }}</p>
                        </div>
                    </div>
                @endif

			</div>
		</div>

		<div class="panel panel-default">
		    <div class="panel-heading">Company Info</div>
		    <div class="panel-body">

		    	<div class="col-md-6">
                    <h4>{{ $job['company_name'] }}</h4>
                    <h4>{{ $job['company_address'] }}</h4>
				</div>

				<div class="col-md-6">
                    <h4>{{ $job['company_city'] }}</h4>
                    <h4>{{ $job['company_state'] }}</h4>
				</div>

		    </div>
		</div>