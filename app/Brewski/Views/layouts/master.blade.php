<!doctype html>
<html lang="en">
@include('Admin::partials.head')
<body>
<div class="container">

@if(Auth::check())
@include('Admin::partials.nav')
<p class="lead">@yield('title')</p>
@endif
@include('Admin::partials.messages')
@yield('content')
@include('Admin::partials.footer')
</div>
</body>
</html>

