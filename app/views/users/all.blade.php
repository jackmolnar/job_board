@extends('templates.main')

@section('main_area')

<h1 class="page_headline">All Grads</h1>

@include('includes.main.success')

{{ link_to_action('UsersController@manual_create', 'Add A Graduate', null, ['class' => 'btn btn-success btn-small']) }}
{{ link_to_action('UsersController@import_create', 'Import Graduates', null, ['class' => 'btn btn-success btn-small']) }}

<table class="table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Program</th>
			<th>Employed</th>
		</tr>
	</thead>
    @foreach($grads as $grad)
        <tr>
            <td><h4>{{ link_to_action('UsersController@show', $grad->first_name.' '.$grad->last_name, ['id' => $grad->id]) }}</h4></td>
            <td>{{ $grad->programs->first()->title }}</td>
            <td></td>
        </tr>
    @endforeach

    </table>

@stop
