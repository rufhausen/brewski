<!doctype html>
<html lang="en">
@include(Theme::getViewPath() . 'partials.head')
<body>
<div class="container">
    @include(Theme::getViewPath() . 'partials.nav')
    @include(Theme::getViewPath() . 'partials.messages')
    <div id="content" class="row">
        <div class="col-md-9">
            <h2>@yield('title')</h2>
            @yield('content')
        </div>
        <div class="col-md-3">
            <div class="sidebar sidebar-right">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">Where to Find Me</h3>
                    </div>
                    <div class="panel-body">
                        @include(Theme::getViewPath() . 'widgets.social')
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Recent Posts</h3>
                    </div>
                    <div class="panel-body">
                        @include(Theme::getViewPath() . 'widgets.recent_posts')
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Popular Categories</h3>
                    </div>
                    <div class="panel-body">
                        @include(Theme::getViewPath() . 'widgets.popular_categories')
                    </div>
                </div>
            </div>
            <!-- end sidebar sidebar-right -->
        </div>
        @include(Theme::getViewPath() . '.partials.footer')
    </div>
    @include('Shared::ga')
</body>
</html>
