<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div id="main_content">
	<h3 class="subhead"><?php bloginfo('name'); ?> <?php _e('Archives',TEMPLATE_DOMAIN); ?></h3>
	<p><?php _e("Find what you're looking for.",TEMPLATE_DOMAIN); ?></p>
	
	<?php include (TEMPLATEPATH . '/searchform.php'); ?>

<div class="substory" id="left">
			<h3 class="substory_subhead"><?php _e("Monthly Archives",TEMPLATE_DOMAIN); ?></h3>
            <p>
            <?php wp_get_archives('monthly','','custom','','<br/>'); ?>
            </p>
</div>
<div class="substory" id="right">
			<h3 class="substory_subhead"><?php _e("Archives by Category",TEMPLATE_DOMAIN); ?></h3>
			<p>
			<?php wp_list_categories('orderby=name&style=none&title_li='); ?>
			</p>
</div>
		
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
