<div>
    <ul class="tag-button-list">
        @foreach($post->tags as $tag)
        <li>
            <a href="/tag/{{ $tag->slug }}">
                <i class="fa fa-tag"></i><span class="tag"> {{ $tag->name }}</span>
            </a>
        </li>
        @endforeach
    </ul>
</div>
