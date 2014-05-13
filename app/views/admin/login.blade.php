@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12">
<div class="row">
    <div class="col-md-4 col-md-offset-4" style="margin-top:30px">
        <p class="text-center lead">{{Cache::get('options')->site_name}}</p>
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title"><strong>Sign in </strong></h3></div>
            <div class="panel-body">
                {{Form::open(['method' => 'post', 'url' => 'admin/login', 'role' => 'form'])}}
                <div class="form-group">
                    <label for="exampleInputEmail1">Email Address</label>
                    <input name="email" type="email" class="form-control" style="border-radius:0px"
                           id="exampleInputEmail1"
                           placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password <a href="/password/remind">(forgot
                            password)</a></label>
                    <input name="password" type="password" class="form-control" style="border-radius:0px"
                           id="exampleInputPassword1" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-sm btn-default">Sign in</button>
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>
@stop
