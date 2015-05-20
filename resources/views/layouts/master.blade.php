<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <meta name="msvalidate.01" content="" />
  <meta property="og:title" content="{{ settings('site_name') }}">
  <meta property="og:site_name" content="{{ settings('site_name') }}" />
  <meta property="og:url" content="\{{ Request::root() }}">
  <meta property="og:description" content="{{ settings('meta_description')}}">
  <meta property="twitter:url" content="{{ \Request::root() }}">
  <meta property="twitter:creator" content="{{ settings('twitter_handle') }}">
  <meta name="twitter:title" content="{{ settings('site_name') }}">
  <meta name="twitter:description" content="{{ settings('meta_description') }}">
  <meta name="keywords" content="{{ settings('meta_keywords') }}"/>
  <meta name="description" content="{{ settings('meta_description') }}"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="alternate" type="application/rss+xml" title="{{ settings('site_name') }} RSS Feed" href="{{ settings('rss_feed_url') }}" />
  <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
    <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/moment.min.js"></script>
    <script src="/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/js/selectize.min.js"></script>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/fontawesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/selectize.default.css" rel="stylesheet">
    <script src="/js/combined.js"></script>
    <link href="/css/combined.css" rel="stylesheet">

    <title>{{ settings('site_name') }}</title>
  </head>
  <body>
    <div class="container">
      @include('partials.nav')
      <div class="content" style="margin-top: 120px;">
        <div class="container">
          <div class="row">
            <div class="col-md-9">
              @include('partials.messages')
              @yield('content')
            </div>
            <div class="col-md-3">
              @include('partials.sidebar')
            </div>
          </div>
        </div>
        @include('partials.footer')
      </div>
    </div>
    @include('partials.ga')
  </body>
  </html>
