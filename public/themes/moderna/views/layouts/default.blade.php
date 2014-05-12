<!DOCTYPE html>
<html lang="en">
@include(Theme::getPartialPath() . 'head')
<body>
<div id="wrapper">
    @include(Theme::getPartialPath() . 'nav')
    <section id="inner-headline">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="/"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
                        <li class="active">@yield('title')</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @include(Theme::getPartialPath() . 'messages')
                    @yield('content')
                </div>
                <div class="col-md-4">
                    <aside class="right-sidebar">
                        <div class="widget">
                            {{Form::open(['method' => 'GET', 'action' => 'HomeController@search'])}}
                            {{Form::text('q',null,['placeholder' => 'Search...','class' => 'form-control'])}}
                            {{Form::close()}}
                        </div>
                        @include(Theme::getWidgetPath() . 'popular_categories')
                        @include(Theme::getWidgetPath() . 'recent_posts')
                        <!--                    <div class="widget">-->
                        <!--                        <h5 class="widgetheading">Popular tags</h5>-->
                        <!--                        <ul class="tags">-->
                        <!--                            <li><a href="#">Web design</a></li>-->
                        <!--                            <li><a href="#">Trends</a></li>-->
                        <!--                            <li><a href="#">Technology</a></li>-->
                        <!--                            <li><a href="#">Internet</a></li>-->
                        <!--                            <li><a href="#">Tutorial</a></li>-->
                        <!--                            <li><a href="#">Development</a></li>-->
                        <!--                        </ul>-->
                        <!--                    </div>-->
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>
                            <span>&copy; Electricwerks 2014 All right reserved. Theme based on Moderna by </span><a
                                href="http://bootstraptaste.com" target="_blank">Bootstraptaste</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{Theme::getUrlPath()}}/js/jquery.js"></script>
<script src="{{Theme::getUrlPath()}}/js/jquery.easing.1.3.js"></script>
<script src="{{Theme::getUrlPath()}}/js/bootstrap.min.js"></script>
<script src="{{Theme::getUrlPath()}}/js/jquery.fancybox.pack.js"></script>
<script src="{{Theme::getUrlPath()}}/js/jquery.fancybox-media.js"></script>
<script src="{{Theme::getUrlPath()}}/js/google-code-prettify/prettify.js"></script>
<script src="{{Theme::getUrlPath()}}/js/portfolio/jquery.quicksand.js"></script>
<script src="{{Theme::getUrlPath()}}/js/portfolio/setting.js"></script>
<script src="{{Theme::getUrlPath()}}/js/jquery.flexslider.js"></script>
<script src="{{Theme::getUrlPath()}}/js/animate.js"></script>
<script src="{{Theme::getUrlPath()}}/js/custom.js"></script>
</body>
</html>
