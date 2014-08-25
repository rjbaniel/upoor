<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">

<div><input type="text" value="<?php the_search_query(); ?>" name="s" id="s" class="text" size="40" />

<input type="submit" id="searchsubmit" value="<?php _e('Search', 'colorpaper'); ?>" class="btn submit btn-<?php echo $style; ?>" />

</div>

</form>

