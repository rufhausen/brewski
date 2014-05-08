<div id="top-navigation" class="row">
    <div class="small-12 columns">
        <nav class="top-bar" data-topbar>
          <section class="top-bar-section">
            <!-- Left Nav Section -->
            {{ createMenu(Cache::get('menu-primary')) }}
          </section>
        </nav>
    </div>
</div>