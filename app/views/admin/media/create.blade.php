@extends('admin.layouts.master')
@section('title', 'Create Media Object')
@section('content')
{{Form::open(['method' => 'POST','files' => true, 'action' => 'MediaController@postStore','class' => 'form','role' => 'form'])}}
<div class="row">
    <div class="form-group col-md-6">
        {{Form::label('name','Name (optional)')}}
        {{Form::text('name', null,['class' => 'form-control'])}}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-12">
        {{Form::label('file','File')}}
        {{Form::file('file')}}
    </div>
</div>
<br/>
{{Form::submit('Submit',['class' => 'btn btn-primary'])}}
{{Form::close()}}

@stop
