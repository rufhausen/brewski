@extends('admin.layouts.master')
@section('content')
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    {!! $users->render() !!}
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Created At</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <th scope="row">{{ $user->id }}</th>
          <td>{!! link_to_route('users.edit', $user->full_name, $user->id) !!}</td>
          <td>{{ $user->created_at }}</td>
          <td>{{ $user->status }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {!! $users->render() !!}
    @endsection
  </div>
</div>
