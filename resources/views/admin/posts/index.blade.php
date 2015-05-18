@extends('admin.layouts.master')

@section('content')
{!! $posts->render() !!}
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Title</th>
      <th>Created At</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach($posts as $post)
    <tr>
      <th scope="row">{{ $post->id }}</th>
      <td>{!! link_to_route('admin.posts.edit', $post->title, $post->id) !!}</td>
      <td>{{ $post->created_at }}</td>
      <td>{{ $post->status }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
{!! $posts->render() !!}
@endsection
