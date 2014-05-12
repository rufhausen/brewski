@extends(Theme::getLayoutPath().'default')
@section('title')
@section('meta-description', Cache::get('description'))
@section('content')
@if($posts->count())
<div id="pagination">
    {{$posts->links()}}
</div>
@foreach ($posts as $post)
@include(Theme::getPartialpath().'post_intro')
@endforeach
<div id="pagination">
    {{$posts->links()}}
</div>
@include('Shared::disqus_home')
@else
<div class="alert alert-info">No published posts at this time.</div>
@endif
@stop
