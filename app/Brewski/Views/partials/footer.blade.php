@if (Auth::check())
<div id="footer">
    <hr style="margin-top: 20px;margin-bottom: 0px;"/>
    &copy{{date('Y')}} <a href="http://electricweks.com" target="_blank">electricwerks.com</a>
    <span class="pull-right"><a href="#">Brewski</a> {{getCmsVersion()}}</span>
</div>
@endif
