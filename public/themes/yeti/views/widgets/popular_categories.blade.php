<ul style="list-style: none;margin-left: -40px;">
    @foreach ($popular_categories as $cat)
    <li>{{link_to_route('category', $cat->name,[$cat->slug])}}</li>
    @endforeach
</ul>
