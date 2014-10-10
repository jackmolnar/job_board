@extends('templates.main')

@section('main_area')

<h1>All Grads</h1>

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
