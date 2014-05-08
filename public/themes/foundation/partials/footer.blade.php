<div id="footer" class="row">
    <div class="small-12 columns">
    <hr />
    &copy{{date('Y')}} {{Cache::get('settings')->site_name}}
    </div>
</div>
{{HTML::script(\Brewski\BrewHelpers::currentThemePath().'/css/foundation/js/jquery.js')}}
{{HTML::script(\Brewski\BrewHelpers::currentThemePath().'/css/foundation/js/foundation.min.js')}}
{{HTML::script(\Brewski\BrewHelpers::currentThemePath().'/js/holder.js')}}
<script>
$(document).foundation();
</script>
