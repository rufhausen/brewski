<div style="margin-top: 20px;">
    <h1>{{link_to('/', Cache::get('options')->site_name)}}</h1>
    <ul class="nav nav-pills">
        <li class="active"><a href="/">Home</a></li>
        <li>{{link_to_route('contact','Contact')}}</a></li>
    </ul>
    <hr />
</div>
