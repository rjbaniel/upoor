<?php
/*
Template Name: Links
*/
?>

<?php get_header(); ?>



<div class="page_archives_div entry">

<div class="ar_panel">
	<h2><?php _e('Links',TEMPLATE_DOMAIN);?></h2>
	
	<ul class="dark">
	<?php wp_list_bookmarks(); ?>
	</ul>
</div>

</div>

<?php get_footer(); ?>
