@include('Themes::'.Cache::get('settings')->theme.'.functions')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title></title>
<meta property="og:site_name" content="{{Cache::get('settings')->site_name}}" />
<meta name="title" content="@yield('meta-title')">
<meta name="description" content="@yield('meta-description')">
<meta property="og:title" content="@yield('meta-title')" />
<meta property="og:description" content="@yield('meta-description')" />
<meta name="author" content="">
<link rel="canonical" href="" />
<meta property="og:url" content="" />
<meta property="og:locale" content="en_US" />
<meta name="twitter:card" content="summary"/>
<meta name="twitter:site" content=""/>
<meta name="twitter:domain" content="{{Cache::get('settings')->site_name}}"/>
<meta name="twitter:creator" content=""/>
@if (Request::segment(1) == 'posts')
<!-- if post -->
<meta property="og:type" content="article" />
<meta property="article:tag" content="Laravel" />
<meta property="article:tag" content="PHP" />
<meta property="article:section" content="Laravel" />
<meta property="article:section" content="PHP" />
<meta property="article:published_time" content="2013-11-22T10:04:22+00:00" />
<!--end if post -->
@endif
{{HTML::style(\Brewski\BrewHelpers::currentThemePath().'/css/foundation/css/normalize.css')}}
{{HTML::style(\Brewski\BrewHelpers::currentThemePath().'/css/foundation/css/foundation.min.css')}}
{{HTML::style(\Brewski\BrewHelpers::currentThemePath().'/css/foundation/fonts/foundation-icons.css')}}
{{HTML::style(\Brewski\BrewHelpers::currentThemePath().'/css/styles.css')}}
