@extends('layouts.master')
@section('content')
@foreach($posts as $post)
@include('partials.post_intro')
@endforeach
<div class="pagination">{!! $posts->render() !!}</div>
@endsection
