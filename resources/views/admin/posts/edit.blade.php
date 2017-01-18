@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-md-9">
        @if ($post->status == 'published')
        <div style="margin-bottom: 10px;">
            <strong>Live URL: </strong>{!!link_to($post->url)!!}
        </div>
        @endif
        {!! Form::open(['method' => 'PUT','route' => ['posts.update', $post->id],'role' => 'form','class' =>'form'])!!}
        <div class="form-group">
            {!! Form::label('title','Post Title')!!}
            {!! Form::text('title', $post->title, ['class' => 'form-control'])!!}
        </div>
        {!! Form::label('content','Content')!!}
        {!!Form::textarea('content', $post->content, ['class' => 'form-control','rows' => '25'])!!}
    </div>
    <div class="col-md-3">
        {!! Form::button('Cancel',['class' => 'btn btn-default btn-block', 'data-toggle' => 'modal','data-target' => '#cancel-post']) !!}
        {!! Form::button('Delete',['class' => 'btn btn-danger btn-block', 'data-toggle' => 'modal','data-target' => '#delete-post']) !!}
        {!! Form::submit('Update',['class' => 'btn btn-primary btn-block'])!!}
        <div class="checkbox" style="margin-left: 20px;">
            <label>
                <input type="checkbox" name="allow_comments" value="1" {{($post->allow_comments == 1 ?
                'checked="checked"' : null)}}>
                Allow Comments
            </label>
        </div>
        <div class="checkbox" style="margin-left: 20px;">
            <label>
                <input type="checkbox" name="status" value="published" {{($post->status == 'published' ?
                'checked="checked"' : null)}}>
                Publish
            </label>
        </div>
        <div class="form-group">
            {!! Form::label('published_at','Publish Date')!!}
            <div class='input-group date' id='datetimepicker1'>
                {!! Form::text(
                    'published_at',
                    ($post->published_at !== null ? $post->published_at->format('m/d/Y h:i A') : date('m/d/Y h:i A')),
                    ['class' => 'form-control']
                    )!!}
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
                        <input type="checkbox" name="category_id[]" value="{{$cat->id}}" {{(in_array($cat->id,
                        $post->categories->pluck('id')->toArray()) ? 'checked="checked"' : null)}}>
                        {{$cat->name}}
                    </label>
                </div>
                @endforeach
                {!! Form::text('new_category', null, ['placeholder' => 'New Category', 'class' => 'form-control','style' => 'margin-left: -20px'])!!}
            </div>
        </div>
        <div class="panel panel-primary" style="margin-top: 5px;">
            <div class="panel-heading">
                <h3 class="panel-title">Tags</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <input type="select" id="post-tags" multiple="multiple" name="tags" value="{{arrayToCommaList($post->tags->pluck('name')->toArray())}}">
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close()!!}

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
            {!! Form::open(['method' => 'DELETE', 'route' =>
                ['posts.destroy',$post->id],'role' =>
                'form','class' => 'form'])!!}&nbsp
                {!! Form::button('Cancel',['class' => 'btn btn-default','data-dismiss' => 'modal'])!!}
                {!! Form::submit('Yes',['class' => 'btn btn-primary'])!!}
                {!! Form::close()!!}
            </div>
        </div>
    </div>
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
            {!! Form::button('Cancel',['class' => 'btn btn-default','data-dismiss' => 'modal'])!!}
            {!! link_to('admin/posts','Yes',['class' => 'btn btn-primary'])!!}
        </div>
    </div>
</div>
</div>
<script>
    CKEDITOR.replace( 'content' );
    $('#datetimepicker1').datetimepicker();
</script>
@endsection
