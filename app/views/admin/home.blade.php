@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <p class="lead">Recent Posts
            <small>({{link_to_action('PostsController@index', 'View All')}})</small>
        </p>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Created At</th>
                <th>Creator</th>
            </tr>
            </thead>
            @foreach ($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{link_to_action('PostsController@edit', $post->title, $post->id)}}</td>
                <td>{{$post->created_at->subDays(5)->diffForHumans()}}</td>
                <td>{{$post->creator->first_name}} {{$post->creator->last_name}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

@stop
