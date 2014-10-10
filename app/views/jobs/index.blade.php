@extends('templates.main')

@section('main_area')

<h1 class="page_headline">Manage Jobs</h1>


<div class="sub_row row">
    {{ link_to_action('JobsController@create', 'Post New Job', null, ['class' => 'btn btn-primary btn-sm']); }}
</div>

@include('../includes/main/success')

        <div class="panel panel-default">
            <div class="panel-heading"><h4>Jobs I've Posted</h4></div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Company</th>
                                <th>Program</th>
                                <th>Date Posted</th>
                            </tr>
                        </thead>

                    @foreach($jobs as $job)
                        <tr>
                            <td>{{ link_to('jobs/'.$job['id'], $job['title'], ['class' => 'table_link'] )    }}</td>
                            <td>{{ $job['company_name'] }} </td>
                            <td>
                                @foreach($job['programs'] as $program)
                                    {{ $program->title }}<br/>
                                @endforeach
                            </td>
                            <td>{{ $job['created_at'] }} </td>
                            <td>@include('../includes/jobs/edit_button')</td>
                            <td>@include('../includes/jobs/delete_button')</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>



@stop