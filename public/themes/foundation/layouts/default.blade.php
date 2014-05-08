<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en">
    <head>
    @include('Themes::'.Cache::get('settings')->theme.'.partials.head')
    </head>
    <body>
        <div id="header" class="row">
            <a href="/">
            <div class="small-6 columns">
                <h1>{{Cache::get('settings')->site_name}}</h1>
            </div>
            </a>
            <div class="small-6 columns">&nbsp;</div>
        </div>
        @include('Themes::'.Cache::get('settings')->theme.'.partials.top_navigation')
        <div id="content" class="row">
            <div class="small-12 columns">
            @if(Auth::check())
            @yield('edit')
            @endif
            <h3>@yield('title')</h3>
            @yield('content')
            </div>
        </div>
        </div>
        @include('Themes::'.Cache::get('settings')->theme.'.partials.footer')
    </body>
</html>