<!doctype html>
<html lang="en">
@include('admin.partials.head')
<body>
<div class="container">

@if(Auth::check())
@include('admin.partials.nav')
<p class="lead">@yield('title')</p>
@endif
@include('admin.partials.messages')
@yield('content')
@include('admin.partials.footer')
</div>
</body>
</html>

