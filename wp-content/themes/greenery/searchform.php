<form method="get" action="<?php bloginfo('url'); ?>?">
<p>
<input type="text" value="<?php echo isset($s)?esc_html($s, 1):''; ?>" name="s" id="s" />&nbsp;
<input class="button" type="submit" value="<?php _e('Search',TEMPLATE_DOMAIN); ?>" />
</p>
</form>
