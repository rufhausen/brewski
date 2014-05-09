@extends(Theme::getLayoutPath().'default')
@section('title', 'Category: ' . $category->name)
@section('meta-description', Cache::get('description'))
@section('content')
@if($posts->count())
@foreach ($posts as $post)
@include(Theme::getPartialpath().'post_intro')
@endforeach
<div id="pagination">
    {{$posts->links()}}
</div>
@else
<div class="alert alert-info">No published posts at this time.</div>
@endif
@stop
