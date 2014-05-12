<div class="widget">
    <h5 class="widgetheading">Categories</h5>
    <ul class="cat">
        @foreach ($popular_categories as $cat)
        <li>{{link_to_route('category', $cat->name,[$cat->slug])}}</li>
        @endforeach
    </ul>
</div>
