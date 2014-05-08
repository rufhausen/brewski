@extends('Admin::layouts.master')
@section('title', 'Posts')
@section('content')
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Status</th>
                <th>Title</th>
                <th>Created At</th>
                <th>Creator</th>
            </tr>
            </thead>
            @foreach ($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td><span class="label label-{{($post->status == 'published' ? 'info' : 'default')}}">{{$post->status}}</span></td>
                <td>{{link_to_action('Brewski\Controllers\Admin\PostsController@edit', $post->title, $post->id)}}</td>
                <td>{{$post->created_at->diffForHumans()    }}</td>
                <td>{{$post->creator->first_name}} {{$post->creator->last_name}}</td>
            </tr>
            @endforeach
        </table>
        {{$posts->links()}}
    </div>
</div>

@stop
