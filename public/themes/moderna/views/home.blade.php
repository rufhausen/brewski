@extends(Theme::getLayoutPath().'default')
@section('title','Home')
@section('meta-description', Cache::get('description'))
@section('content')
@foreach($posts as $post)
@include(Theme::getPartialPath() . 'post_intro')
@endforeach
{{$posts->links()}}
@include('Shared::disqus_home')
@stop
