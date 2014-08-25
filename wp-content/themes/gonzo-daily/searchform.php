<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">

<input type="text" value="<?php echo esc_attr($s); ?>" name="s" id="s" />

<input type="submit" id="searchsubmit" value="<?php _e("Search", 'gonzo-daily'); ?>" />

</form>

