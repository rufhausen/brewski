<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{Cache::get('options')->site_name}}</title>
    <link rel="stylesheet" href="{{Theme::getUrlPath()}}/css/foundation.css"/>
    <link rel="stylesheet"  href="{{Theme::getUrlPath()}}/css/custom.css"/>
    <script src="{{Theme::getUrlPath()}}/js/vendor/modernizr.js"></script>
</head>
<body>

<nav class="top-bar" style="margin-bottom: 40px" data-topbar>
    <ul class="title-area">
        <li class="name">
            <h1><a href="/">{{Cache::get('options')->site_name}}</a></h1>
        </li>
        <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>

    <section class="top-bar-section">
<!--        <!-- Right Nav Section -->
<!--        <ul class="right">-->
<!--            <li class="active"><a href="#">Right Button Active</a></li>-->
<!--            <li class="has-dropdown">-->
<!--                <a href="#">Right Button Dropdown</a>-->
<!--                <ul class="dropdown">-->
<!--                    <li><a href="#">First link in dropdown</a></li>-->
<!--                </ul>-->
<!--            </li>-->
<!--        </ul>-->

        <!-- Left Nav Section -->
        <ul class="left">
            <li><a href="/">Home</a></li>
            <li><a href="/contact">Contact</a></li>
        </ul>
    </section>
</nav>
<div class="row">
    <div class="large-9 columns">
        <h1>@yield('title')</h1>
        @yield('content', 'Default Content')
    </div>
    <div class="large-3 columns">
        <div class="panel">
            <h3>Social Media</h3>
            @include(Theme::getWidgetPath() . 'social')
        </div>
        <div class="panel">
            <h3>Recent Posts</h3>
            @include(Theme::getWidgetPath() . 'recent_posts')
        </div>
        <div class="panel">
            <h3>Popular Categories</h3>
            @include(Theme::getWidgetPath() . 'popular_categories')
        </div>
    </div>
</div>

<script src="{{Theme::getUrlPath()}}/js/vendor/jquery.js"></script>
<script src="{{Theme::getUrlPath()}}/js/foundation.min.js"></script>
<script>
    $(document).foundation();
</script>
</body>
</html>
