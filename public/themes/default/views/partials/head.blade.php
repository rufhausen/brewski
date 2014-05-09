<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="msvalidate.01" content="" />
    <meta property="og:title" content="{{Cache::get('options')->site_name}}">
    <meta property="og:site_name" content="{{Cache::get('options')->site_name}}" />
    <meta property="og:url" content="{{Request::root()}}">
    <meta property="og:description" content="@yield('meta-description')">
    <meta property="twitter:url" content="{{Request::root()}}">
    <meta name="twitter:title" content="{{Cache::get('options')->site_name}}">
    <meta name="twitter:description" content="@yield('meta-description')">
    <meta name="keywords" content="{{Cache::get('options')->keywords}}"/>
    <meta name="description" content="@yield('meta-description')"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="alternate" type="application/rss+xml" title="{{Cache::get('options')->site_name}} RSS Feed" href="{{URL::to('feed')}}" />
    {{HTML::script('//code.jquery.com/jquery-1.11.0.min.js')}}
    {{HTML::style(Theme::getUrlPath(). '/css/bootstrap.min.css')}}
    {{HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css')}}
    {{HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js')}}
    {{HTML::script(Theme::getUrlPath() . '/js/run_prettify.js')}}
    {{HTML::style(Theme::getUrlPath() . '/css/prettify.css')}}
    {{HTML::style(Theme::getUrlPath() . '/css/styles.css')}}

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
    <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <title>{{Cache::get('options')->site_name}}</title>
</head>


