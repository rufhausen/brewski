@extends(Theme::getLayoutPath().'default')
@section('meta-description', htmlentities($post->intro))
@section('title', $post->title)
@section('content')
<div id="post">
    <h2>{{$post->title}}</h2>
    <div>{{$post->published_at->format('F j, Y')}}</div>
    <p>{{Markdown::render($post->content)}}</p>
</div>
@include('Shared::disqus_post')
@stop
