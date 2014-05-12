@extends(Theme::getLayoutPath().'default')
@section('title')
@section('meta-description', Cache::get('description'))
@section('content')
<h1>404 Error</h1>
<p>Sorry, the page you are looking for is not here. Maybe it's because I just switched from Wordpress to my own custom CMS.</p>
@stop
