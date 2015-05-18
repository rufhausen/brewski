<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Search</h3>
  </div>
  <div class="panel-body">
    {!!Form::open(['method' => 'GET', 'route' => 'search'])!!}
    {!!Form::text('q',null,['placeholder' => 'Enter search term(s)','class' => 'form-control'])!!}
    {!!Form::close()!!}

  </div>
</div>
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Popular Categories</h3>
  </div>
  <div class="panel-body">
    @foreach($popular_categories as $category)
    {!! link_to_route('category', $category->name, $category->slug)!!}<br />
    @endforeach
  </div>
</div>
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Recent Posts</h3>
  </div>
  <div class="panel-body">
    <ul style="list-style: none;margin-left: -30px">
      @foreach($recent_posts as $post)
      <li style="margin-bottom: 5px;">
        <strong><small>{{ $post->published_at->format('F j, Y') }}</small></strong><br />
        {!! link_to($post->url, $post->title)!!}</li>
        @endforeach
      </ul>
    </div>
  </div>
