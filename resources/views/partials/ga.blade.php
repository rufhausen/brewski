  @if (\App::environment() == 'production')
  @if (isset(Cache::get('settings')['google_analytics_id']))
  <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', '{{Cache::get('settings')['google_analytics_id']}}']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  </script>
  @endif
  @endif