<head>
    <meta charset="utf-8">
    <title>{{Cache::get('options')->site_name}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <meta name="author" content="http://bootstraptaste.com" />
    <!-- css -->
    <link href="{{Theme::getURlPath()}}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{Theme::getURlPath()}}/css/fancybox/jquery.fancybox.css" rel="stylesheet">
    <link href="{{Theme::getURlPath()}}/css/jcarousel.css" rel="stylesheet" />
    <link href="{{Theme::getURlPath()}}/css/flexslider.css" rel="stylesheet" />
    <link href="{{Theme::getURlPath()}}/css/style.css" rel="stylesheet" />


    <!-- Theme skin -->
    <link href="{{Theme::getURlPath()}}/skins/default.css" rel="stylesheet" />

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
