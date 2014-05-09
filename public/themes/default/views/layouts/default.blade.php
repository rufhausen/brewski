<!doctype html>
<html lang="en">
@include(Theme::getPartialPath() . 'head')
<body>
<div class="container">
    @include(Theme::getPartialPath() . 'nav')
    @include(Theme::getPartialPath() . 'messages')
    <div id="content" class="row">
        <div class="col-md-9">
            <h2>@yield('title')</h2>
            @yield('content')
        </div>
        <div class="col-md-3">
            <div class="sidebar sidebar-right">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Search</h3>
                    </div>
                    <div class="panel-body">
                        @include(Theme::getWidgetPath() . 'search')
                    </div>
                </div>
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">Where to Find Me</h3>
                    </div>
                    <div class="panel-body">
                        @include(Theme::getWidgetPath() . 'social')
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Recent Posts</h3>
                    </div>
                    <div class="panel-body">
                        @include(Theme::getWidgetPath() . 'recent_posts')
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Popular Categories</h3>
                    </div>
                    <div class="panel-body">
                        @include(Theme::getWidgetPath() . 'popular_categories')
                    </div>
                </div>
            </div>
            <!-- end sidebar sidebar-right -->
        </div>
        @include(Theme::getPartialPath() . '.footer')
    </div>
    @include('Shared::ga')
</body>
</html>
