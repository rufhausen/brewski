@if ( ($post->allow_comments) and (!empty(Cache::get('options')->disqus_shortname)) )
<div id="disqus_thread"></div>
<script type="text/javascript">
    var disqus_identifier = "{{$post->id.' '. Request::root(). '?p='. $post->id}}";
    var disqus_title = "{{htmlentities($post->title)}}";
    var disqus_url = "{{Request::fullUrl()}}/";
    var disqus_shortname = "{{Cache::get('options')->disqus_shortname}}"; // required: replace example with your forum shortname
    var disqus_container_id = 'disqus_thread';
    var disqus_domain = 'disqus.com';

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var dsq = document.createElement('script');
        dsq.type = 'text/javascript';
        dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a>
</noscript>
<a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
@endif
