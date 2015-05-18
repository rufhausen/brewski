<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/moment.min.js"></script>
  <script src="/js/bootstrap-datetimepicker.min.js"></script>
  <script src="/js/selectize.min.js"></script>
  <script src="/ckeditor/ckeditor.js"></script>
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/fontawesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <link href="/css/selectize.default.css" rel="stylesheet">
  <script src="/js/combined.js"></script>
  <link href="/css/combined.css" rel="stylesheet">



  <title>{{ settings('site_name') }}</title>
</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/admin">{{ settings('site_name') }}</a>
      </div>
      @if(\Auth::check())
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="{{ active_route('posts', 2) }}"><a href="/admin/posts">Posts <span class="sr-only">(current)</span></a></li>
          <li class="{{ active_route('users', 2) }}"><a href="/admin/users">Users <span class="sr-only">(current)</span></a></li>
          <li class="{{ active_route('settings', 2) }}"><a href="/admin/settings">Settings <span class="sr-only">(current)</span></a></li>
          <!-- <li><a href="#">Link</a></li> -->
              <!--             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li> -->
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">{{ \Auth::user()->full_name }}</a></li>
            <li><a href="/admin/auth/logout">Logout</a></li>
          </ul>
          @endif
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <div class="content" style="margin-top: 80px;">
      @include('admin.partials.messages')
      <div class="container">
        @yield('content')
      </div>
    </div>
  </body>
  </html>
