<form method="get" action="<?php bloginfo('url'); ?>">
<p>
<input type="text" value="<?php echo isset($s)?esc_html($s, 1):''; ?>" name="s" id="s" />
<input type="submit" value="<?php _e('Search', 'almost-spring'); ?>" />
</p>
</form>
