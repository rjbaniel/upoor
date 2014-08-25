<form method="get" id="search_form" action="<?php bloginfo('url'); ?>/">
	<p style="margin-bottom: 5px;"><input type="text" class="text_input" value="<?php echo isset($s)?esc_html($s, 1):''; ?>" name="s" id="s" /></p>
	<p style="margin-bottom: 0;"><input type="submit" id="searchsubmit" value="<?php _e('Search',TEMPLATE_DOMAIN);?>" /></p>
</form>
