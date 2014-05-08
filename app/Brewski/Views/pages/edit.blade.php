@extends('admin.layouts.master')
@section('title', 'Edit a Page')
@section('content')
<div class="row">
    <div class="col-md-9">
        {{Form::open(['method' => 'PUT','action' => ['Brewski\Controllers\Admin\PagesController@update', $page->id], 'role' => 'form','class' =>
        'form'])}}
        {{Form::label('title','Page Title')}}
        {{Form::text('title', $page->title, ['class' => 'form-control'])}}
        {{Form::label('content','Content')}}
        {{Form::textarea('content', $page->content, ['class' => 'form-control','rows' => '25'])}}
    </div>
    <div class="col-md-3">
        {{Form::button('Cancel',['class' => 'btn btn-default btn-block'])}}
        {{Form::button('Delete',['class' => 'btn btn-danger btn-block', 'data-toggle' => 'modal','data-target' =>
        '#delete-post'])}}
        {{Form::submit('Update',['class' => 'btn btn-primary btn-block'])}}
        <div class="checkbox" style="margin-left: 20px;">
            <label>
                <input type="checkbox" name="status" value="published" {{($page->status == 'published' ? 'checked="checked"' : null)}}>
                Publish
            </label>
        </div>
    </div>
    {{Form::close()}}
</div>

<div class="modal fade bs-example-modal-sm" id="delete-post" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete this post?</h4>
            </div>
            <div class="modal-body">
                If you choose 'Yes', this post will be deleted permanently.
            </div>
            <div class="modal-footer">
                {{Form::open(['method' => 'DELETE', 'action' => ['Brewski\Controllers\Admin\PagesController@destroy',$page->id],'role' =>
                'form','class' => 'form'])}}&nbsp
                {{Form::button('Cancel',['class' => 'btn btn-default','data-dismiss' => 'modal'])}}
                {{Form::submit('Yes',['class' => 'btn btn-primary'])}}
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>
@stop
