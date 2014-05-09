<nav class="navbar navbar-inverse" role="navigation" style="margin-bottom: 40px;">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/admin">{{Cache::get('options')->site_name}}</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{( (Request::path() == 'admin') ? 'active' : null)}}"><a href="/admin">Home</a></li>
                <li class="dropdown {{( (Request::segment(2) == 'posts') ? 'active' : null)}}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Posts <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/posts">List</a></li>
                        <li><a href="/admin/posts/create">Create</a></li>
                    </ul>
                </li>
                <li class="dropdown {{( (Request::segment(2) == 'media') ? 'active' : null)}}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Media <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/media">List</a></li>
                        <li><a href="/admin/media/create">Create</a></li>
                    </ul>
                </li>
                <li>{{link_to_action('Brewski\Controllers\Admin\OptionsController@getClearCache','Clear Cache')}}</li>
                <li class="{{( (Request::path() == 'admin/options') ? 'active' : null)}}"><a href="/admin/options">Options</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/admin/logout">Logout</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
