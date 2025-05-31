<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
  <label>
    <span class="screen-reader-text">Search for:</span>
    <input type="search" class="search-field" placeholder="Search Toothwise…" value="<?php echo get_search_query(); ?>" name="s" />
  </label>
  <button type="submit" class="search-submit" aria-label="Submit search">🔍</button>
</form>
