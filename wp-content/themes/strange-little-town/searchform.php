<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" size="21" value="Search" />
	<input type="image" id="searchsubmit" value="seat" src="<?php bloginfo('template_directory'); ?>/img/search.png" style="margin-left: 5px; margin: 3px 0 0 5px;" />
</form>
