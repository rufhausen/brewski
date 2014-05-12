<div class="widget">
    <h5 class="widgetheading">Latest posts</h5>
    <ul class="recent">
        @foreach ($recent_posts as $post)
        <li style="margin-bottom: 10px;"><span class="small">{{$post->published_at->format('M j, Y')}}</span><br/>
            <strong>{{link_to_route('post', $post->title, [$post->year,$post->month,$post->slug])}}</strong>
        </li>
        @endforeach
    </ul>
</div>
