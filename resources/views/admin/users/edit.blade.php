@extends('admin.layouts.master')
@section('title', 'Edit User')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        {!!Form::open(['route' => ['admin.users.update', $user->id], 'method' => 'put'])!!}
        <div class="form-group">
            {!!Form::label('first_name','First Name')!!}
            {!!Form::text('first_name',$user->first_name,['class' => 'form-control'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('last_name','Last Name')!!}
            {!!Form::text('last_name',$user->last_name,['class' => 'form-control'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('email','Email')!!}
            {!!Form::text('email',$user->email,['class' => 'form-control'])!!}
        </div>
        {!!Form::submit('Submit',['class' => 'btn btn-primary'])!!}
        {!!Form::close()!!}
    </div>
</div>
@stop
