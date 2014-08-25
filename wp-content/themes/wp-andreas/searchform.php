<h2><?php _e('Site search', 'wp-andreas'); ?></h2>
<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
<div>
<label for="s"><?php _e('Search for:', 'wp-andreas'); ?></label>
<input type="text" value="<?php echo isset($s)?esc_html($s, 1):''; ?>" name="s" id="s" size="14" />
<input type="hidden" id="searchsubmit" value="<?php _e('Search', 'wp-andreas'); ?>" />
</div>
</form>
