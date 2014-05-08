@extends('admin.layouts.master')
@section('title', 'Create a Page')
@section('content')
<div class="row">
<div class="col-md-9">
{{Form::open(['method' => 'POST','action' => 'Brewski\Controllers\Admin\PagesController@store', 'role' => 'form','class' => 'form'])}}
{{Form::label('title','Page Title')}}
{{Form::text('title', null, ['class' => 'form-control'])}}
{{Form::label('content','Content')}}
{{Form::textarea('content', null, ['class' => 'form-control','rows' => '25'])}}
</div>
<div class="col-md-3">
    {{Form::button('Cancel',['class' => 'btn btn-default btn-block'])}}
    {{Form::submit('Save',['class' => 'btn btn-info btn-block'])}}
    <div class="checkbox" style="margin-left: 20px;">
        <label>
            <input type="checkbox" name="status" value="published">
            Publish
        </label>
    </div>
</div>
    {{Form::close()}}
</div>
@stop
