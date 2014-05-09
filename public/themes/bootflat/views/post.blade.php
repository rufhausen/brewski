@extends(Theme::getLayoutPath() . 'default')
@section('title',$post->title)
@section('meta-description', htmlentities($post->intro))
@section('content')
<div id="post">
    <div>{{$post->published_at->format('F j, Y')}}</div>
    <p>{{Markdown::render($post->content)}}</p>
</div>
@include('Shared::disqus_post')
@stop
