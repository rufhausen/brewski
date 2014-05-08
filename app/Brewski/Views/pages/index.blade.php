@extends('admin.layouts.master')
@section('title','Pages <span class="pull-right"><small><a href="' . action('Brewski\Controllers\Admin\PagesController@create') . '" class="btn btn-primary">Create</a></small></span>')
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
            @if ($pages->count())
            @foreach ($pages as $page)
            <tr>
                <td>{{$page->id}}</td>
                <td><span class="label label-{{($page->status == 'published' ? 'info' : 'default')}}">{{$page->status}}</span></td>
                <td>{{link_to_action('Brewski\Controllers\Admin\PagesController@edit', $page->title, $page->id)}}</td>
                <td>{{$page->created_at->diffForHumans()    }}</td>
                <td>{{$page->creator->first_name}} {{$page->creator->last_name}}</td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="5">
                    <div class="alert alert-info">No Records Found.</div>
                </td>
            </tr>
            @endif
        </table>
        {{$pages->links()}}
    </div>
</div>

@stop
