@extends('admin.layouts.master')
@section('title', 'Users')
@section('content')
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            </thead>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->full_name}}</td>
                <td>{{$user->email}}</td>
            </tr>
            <tr>
                <td colspan="3">
                    @foreach ($user->posts as $post)
                    {{$post->title}}<br />
                    @endforeach
                </td>
            </tr>
            @endforeach
            </table>
        </div>
 </div>
@stop
