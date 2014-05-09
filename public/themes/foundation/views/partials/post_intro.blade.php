<div class="post-item">
    <article>
        <heading>
            <h2 style="margin-bottom: 0px;">
                {{link_to_route('post', $post->title, [$post->year,$post->month,$post->slug])}}
            </h2>
            <small style="font-size: 13px;font-weight: 400">
                <strong>{{$post->published_at->format('F j, Y')}}</strong>
            </small>
        </heading>
        <p style="margin-top: 10px">
            {{Markdown::render($post->intro)}}

        <div id="read-more">{{showMoreLink($post)}}</div>
        </p>
        <div id="categories">
            @foreach ($post->categories as $category)
        <span class="label ">
            {{link_to_route('category',$category->name,[$category->slug], ['style' => 'color:white'])}}
        </span>&nbsp
            @endforeach
        </div>
    </article>
</div>
