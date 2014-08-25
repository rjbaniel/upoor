<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" size="22" class="search_input"/>
<input type="submit" id="searchsubmit" value="<?php _e('Go', 'golfpr'); ?>" class="submit" />
</form>
