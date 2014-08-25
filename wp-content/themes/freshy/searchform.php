<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
<p>
<input size="12" type="text" value="<?php echo isset($s)?esc_html($s, 1):''; ?>" name="s" id="s" /><input class="btn" type="submit" id="searchsubmit" value="<?php _e('Search',TEMPLATE_DOMAIN); ?>" />
</p>
</form>
