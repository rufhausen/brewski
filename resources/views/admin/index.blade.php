@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title">Latest Posts</h3>
          </div>
          <div class="panel-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Last Name</th>
                  <th>Created</th>
              </tr>
          </thead>
          <tbody>
              @foreach($posts as $post)
              <tr>
                  <th scope="row">{{ $post->id }}</th>
                  <td>{!! link_to_route('admin.posts.edit', $post->title, $post->id) !!}</td>
                  <td>{{ $post->creator->full_name }}</td>
                  <td>{{ $post->created_at->diffForHumans() }}</td>
              </tr>
              @endforeach
          </tbody>
      </table>
  </div>
</div>
</div>
<div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Panel title</h3>
    </div>
    <div class="panel-body">
        Panel content
    </div>
</div>
</div>
</div>
@endsection
