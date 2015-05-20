@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <header>
            <div class="post-date">{{ $post->published_at->format('F j, Y') }}</div>
            <h3 style="margin-top: 0px;margin-bottom: 5px;" id="post-title">{!! $post->title !!}</h3>
            @include('partials.post_share_list')
            @include('partials.post_tag_list')
        </header>
        <article>
            <p>{!! $post->content !!}</p>
        </article>
        @include('partials.post_disqus')
    </div>
</div>
@endsection
