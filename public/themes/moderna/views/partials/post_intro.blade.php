<article>
    <div class="post-heading">
        <h3>{{link_to($post->url, $post->title)}}</a></h3>
    </div>
    <p>
        {{Markdown::render($post->intro)}}
    </p>

    <div class="bottom-article">
        <ul class="meta-post">
            <li><i class="icon-calendar"></i><a href="#">{{$post->published_at->format('F d, Y')}}</a></li>
            @foreach ($post->categories as $category)
                <li>{{link_to_route('category',$category->name,[$category->slug])}}</li>
            @endforeach
            <li><i class="icon-comments"></i><a href="#">4 Comments</a></li>
        </ul>
        <a href="{{$post->url}}" class="pull-right">Continue reading <i class="icon-angle-right"></i></a>
    </div>
</article>
