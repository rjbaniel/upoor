<form method="get" action="<?php bloginfo('url'); ?>/">


<input type="text" value="<?php if (isset($noresults) && !$noresults) { echo isset($s)?esc_html($s, 1):''; } ?>" name="s" id="s" />


<input type="submit" id="searchsubmit" value="<?php _e('Search','citrus');?>" />


</form>
