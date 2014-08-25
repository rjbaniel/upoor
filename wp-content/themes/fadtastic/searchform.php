<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/" class="float_right">
<label for="s"><?php _e('Search:','fadtastic'); ?> </label><input value="<?php echo isset($s)?esc_html($s, 1):''; ?>" name="s" id="s" type="text" />
<input id="searchsubmit" value="<?php _e('Search','fadtastic'); ?>" class="button" type="submit" />
<div class="clear"></div>
</form>
