@extends('templates.main')

@section('main_area')

@include('../includes/main/success')

<h1>Manage Jobs</h1>

{{ link_to_action('JobsController@create', 'Post New Job', null, ['class' => 'btn btn-primary']); }}

<h2>Jobs I've Posted</h2>

<table class="table">
	<thead>
		<tr>
			<th>Title</th>
			<th>Company</th>
			<th>Date Posted</th>
		</tr>

	</thead>

@foreach($jobs as $job)

	<tr>
		<td><h4>{{ $job['title'] }} </h4></td>
		<td>{{ $job['company_name'] }} </td>
		<td>{{ $job['created_at'] }} </td>
		<td>{{ link_to_action('JobsController@edit', 'Edit', $job['id'], ['class' => 'btn btn-success']); }}</td>
		<td>{{ link_to_action('JobsController@destroy', 'Delete', $job['id'], ['class' => 'btn btn-danger', 'data-method' => 'delete']); }}</td>
	</tr>

	

@endforeach

</table>

@stop