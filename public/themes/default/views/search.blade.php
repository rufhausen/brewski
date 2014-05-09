@extends(Theme::getLayoutPath().'default')
@section('title','Search Results for "' . $q. '"')
@section('meta-description', Cache::get('description'))
@section('content')
@if($posts->count())
@foreach($posts as $post)
    @include(Theme::getPartialPath() . 'post_intro')
@endforeach
@else
<div class="alert alert-info">No results.</div>
@endif
@stop
