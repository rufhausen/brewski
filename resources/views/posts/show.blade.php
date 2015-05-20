@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div>{{ $post->published_at }}</div>
        <h2>{!! $post->title !!}</h2>
        @include('partials.post_share_list')
        @include('partials.post_tag_list')
        <p>{!! $post->content !!}</p>
        @include('partials.post_disqus')
    </div>
</div>
@endsection
