@extends('admin.layouts.master')
@section('title', 'Create a Post')
@section('content')
<div class="row">
    <div class="col-md-9">
        {!!Form::open(['method' => 'POST','route' => 'admin.posts.store', 'role' => 'form','class' => 'form'])!!}
        {!!Form::label('title','Post Title')!!}
        {!!Form::text('title', null, ['class' => 'form-control'])!!}
        {!!Form::label('content','Content')!!}
        {!!Form::textarea('content', null, ['class' => 'form-control','rows' => '25'])!!}
    </div>
    <div class="col-md-3">
        {!!Form::button('Cancel',['class' => 'btn btn-default btn-block', 'data-toggle' => 'modal','data-target' =>
        '#cancel-post'])!!}
        {!!Form::submit('Save',['class' => 'btn btn-info btn-block'])!!}
        <div class="checkbox" style="margin-left: 20px;">
            <label>
                <input type="checkbox" name="allow_comments" value="1" checked="checked">
                Allow Comments
            </label>
        </div>
        <div class="checkbox" style="margin-left: 20px;">
            <label>
                <input type="checkbox" name="status" value="published">
                Publish
            </label>
        </div>
        <div class="form-group">
            {!!Form::label('published_at','Publish Date')!!}
            <div class='input-group date' id='datetimepicker1'>
                {!!Form::text('published_at', date('m/d/Y h:i A'), ['class' => 'form-control'])!!}
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <div class="panel panel-default" style="margin-top: 5px;">
        <div class="panel-heading">
            <h3 class="panel-title">Categories</h3>
        </div>
        <div class="panel-body" style="margin-left: 10px">
            @foreach ($categories as $cat)

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="category_id[]" value="{{$cat->id}}">
                    {{$cat->name}}
                </label>
            </div>
            @endforeach
            {!!Form::text('new_category', null, ['placeholder' => 'New Category', 'class' => 'form-control','style'
            => 'margin-left: -20px'])!!}
        </div>
    </div>
    <div class="panel panel-primary" style="margin-top: 5px;">
        <div class="panel-heading">
            <h3 class="panel-title">Tags</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <select id="post-tags" name="tags[]" multiple="multiple" placeholder="Select some tags..."></select>
            </div>
        </div>
    </div>
</div>
{!!Form::close()!!}
</div>

<div class="modal fade bs-example-modal-sm" id="cancel-post" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Are you sure you want to leave this page?</h4>
        </div>
        <div class="modal-body">
            If you choose 'Yes', any changes you've made will not be saved.
        </div>
        <div class="modal-footer">
            {!!Form::button('Cancel',['class' => 'btn btn-default','data-dismiss' => 'modal'])!!}
            {!!link_to('admin/posts','Yes',['class' => 'btn btn-primary'])!!}
        </div>
    </div>
</div>
</div>
<script>
    CKEDITOR.replace( 'content' );
    $('#datetimepicker1').datetimepicker();
</script>
@stop
