<ul style="list-style: none;">
    @foreach ($recent_posts as $post)
    <li style="margin-bottom: 10px;"><span class="small">{{$post->published_at->format('M j, Y')}}</span><br/>
        {{link_to_route('post', $post->title, [$post->year,$post->month,$post->slug])}}
    </li>
    @endforeach
</ul>
