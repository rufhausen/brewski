<div class="post-item">
    <article style="margin-bottom: 20px;">
        <heading>
            <small style="font-size: 13px;font-weight: 400">
                <strong style="color: #777"><i class="fa fa-calendar"></i> {{$post->published_at->format('F j, Y')}}</strong>
            </small>
            <h3 style="margin-top: 0px;margin-bottom: 5px;">
                {{link_to_route('post', $post->title, [$post->year,$post->month,$post->slug])}}
            </h3>

        </heading>
        <div id="tags">
            <small>
                @foreach($post->tags as $tag)
                <i class="fa fa-tag"></i> {{link_to_route('tag',$tag->name,[$tag->slug])}}
                @endforeach
            </small>
        </div>
        <p style="margin-top: 10px">
            {{Markdown::render($post->intro)}}
        </p>
        <div id="categories">
            @foreach ($post->categories as $category)
        <span class="label label-primary">
            {{HTML::decode(link_to_route('category','<i class="fa fa-folder-open"></i> ' . $category->name,[$category->slug], ['style' => 'color:white']))}}
        </span>&nbsp
            @endforeach
        </div>
        <div class="clearfix"></div>
        <div id="read-more">
            <span class="pull-right">{{showMoreLink($post)}}</span>
        </div>
    </article>
</div>
