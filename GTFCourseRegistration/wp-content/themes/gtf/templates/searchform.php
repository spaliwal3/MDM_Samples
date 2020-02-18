<form role="search" method="get" class="search-form form-inline" action="<?= esc_url(home_url('/')); ?>">
  <label class="sr-only"><?php _e('Search for:', 'sage'); ?></label>
    <input type="search" value="<?= get_search_query(); ?>" name="s" class="search-field form-control" required>
      <button type="submit" class="search-submit btn btn-default"><?php _e('Search', 'sage'); ?></button>
</form>
<a href="take-action" class="btn btn-primary btn-lg">Take Action</a>
