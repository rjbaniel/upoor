<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
<div><input id="searchbox" type="text" value="<?php echo isset($s)?esc_html($s, 1):''; ?>" name="s" alt="<?php _e('Enter search text','andreas09'); ?>"/>
<input type="submit" id="searchbutton" value="<?php _e('Search','andreas09'); ?>" alt="<?php _e('Submit for search results','andreas09'); ?>"/>
</div>
</form>
