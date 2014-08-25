<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
<div><input type="text" value="<?php echo isset($s)?esc_html($s, 1):''; ?>" name="s" id="s" />
<input type="submit" id="searchsubmit" value="<?php _e('Find', 'batavia'); ?>" />
</div>
</form>
