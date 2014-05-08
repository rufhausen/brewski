@extends('Admin::layouts.master')
@section('title', 'Media')
@section('content')

<script>
    $(document).on("click", ".delete-button", function () {
    var mediaId = $(this).data('id');
    var mediaName = $(this).data('name');
    $("input[name='id']").val(mediaId);
    $(".modal-body #media-name").html(mediaName);
    });
</script>
<div class="row">
    <div class="col-md-12">
        {{$media->links()}}
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Thumbnail</th>
                <th>Name</th>
                <th>Size</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            </thead>
            @if($media->count())
            @foreach ($media as $m)
            <tr>
                <td>{{$m->id}}</td>
                <td><img class="thumbnail" src="/media/thumb_{{$m->filename}}" width="120"/></td>
                <td>{{$m->name}}</td>
                <td>{{$m->file_size}}</td>
                <td>{{$m->created_at->format('m/d/Y')}}</td>
                <td>
                    <button class="btn btn-danger btn-sm delete-button" data-toggle="modal" data-id="{{$m->id}}"
                            data-name="{{$m->name}}" data-target="#deleteModal">Delete
                    </button>
            </tr>
            <tr>
                <td colspan="6">
                    <span class="label label-primary">/media/{{$m->filename}}</span>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6">
                    <div class="alert alert-info">No Media Entries.</div>
                </td>
            </tr>
            @endif
        </table>
        {{$media->links()}}
    </div>
</div>


<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Media Object</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to delete "<span id="media-name"></span>"?
            </div>
            <div class="modal-footer">
                {{Form::open(['method' => 'DELETE','action' => 'Brewski\Controllers\Admin\MediaController@deleteDestroy'])}}
                {{Form::hidden('id')}}
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>
@stop
