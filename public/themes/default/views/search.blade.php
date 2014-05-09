@extends(Theme::getLayoutPath().'default')
@section('title','Search Results for "' . $q. '"')
@section('meta-description', Cache::get('description'))
@section('content')

<p>The search functionality is not ready just yet.</p>

@stop
