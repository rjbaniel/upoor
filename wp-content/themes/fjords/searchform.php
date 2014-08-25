<form method="get" action="/">
<p>
<input type="text" value="<?php echo isset($s)?esc_html($s, 1):''; ?>" size="18" name="s" id="s" />
<input type="submit" value="<?php _e('Search',TEMPLATE_DOMAIN); ?>" />
</p>
</form>
