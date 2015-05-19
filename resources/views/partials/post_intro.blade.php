<div class="post-item">
    <article style="margin-bottom: 20px;">
        <heading>
            <div class="post-date">
                {{$post->published_at->format('M j, Y')}}
            </div>

            <h3 style="margin-top: 0px;margin-bottom: 5px;" id="post-title">
                {!! link_to_route('post', $post->title, [$post->year,$post->month,$post->slug]) !!}
            </h3>
        </heading>
        @include('partials.post_tag_list')
        <p style="margin-top: 10px">
            {!! $post->intro !!}
        </p>
        <div class="clearfix"></div>
        <div id="read-more">
            <strong>
                <small>{!! showMoreLink($post) !!}</small>
            </strong>
        </div>
    </article>
</div>
