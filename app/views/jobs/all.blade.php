@extends('templates.main')

@section('main_area')

@include('../includes/main/success')

<h1>All Jobs</h1>

<table class="table">
	<thead>
		<tr>
			<th>Position</th>
			<th>Location</th>
			<th>Company</th>
			<th>Date Posted</th>
		</tr>

	</thead>

@foreach($jobs[0] as $job)
	<tr>
		<td><h4>{{ link_to_action('JobsController@show', $job['title'], ['id' => $job['id']]) }}</h4></td>
		<td>{{ $job['company_city'] }}, {{ $job['company_state'] }}</td>
		<td>{{ $job['company_name'] }} </td>
		<td>{{ $job['created_at'] }} </td>
		<td>{{ link_to_action('JobsController@show', 'View', $job['id'], ['class' => 'btn btn-success']); }}</td>
	</tr>
@endforeach

</table>

@stop