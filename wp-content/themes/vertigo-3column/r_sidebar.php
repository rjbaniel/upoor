<!-- begin r_sidebar -->

<div id="r_sidebar">

	<ul id="r_sidebarwidgeted">
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : else : ?>

	
	<li id="Blogroll">
	<h2><?php _e('Blogroll',TEMPLATE_DOMAIN);?></h2>
		<ul>
			<?php get_bookmarks(-1, '<li>', '</li>', ' - '); ?>
		</ul>
	</li>
		
	<?php endif; ?>
	</ul>
			
</div>

<!-- end r_sidebar -->
