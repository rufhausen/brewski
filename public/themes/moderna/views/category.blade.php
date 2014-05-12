@extends(Theme::getLayoutPath().'default')
@section('title', $category->name)
@section('meta-description', Cache::get('description'))
@section('content')
<h2>Category: {{$category->name}}</h2>
@if($posts->count())
@foreach ($posts as $post)
@include('Themes::'.Cache::get('options')->theme.'.views.partials.post_intro')
@endforeach
<div id="pagination">
    {{$posts->links()}}
</div>
@else
<div class="alert alert-info">No published posts at this time.</div>
@endif
@stop