<?php
/*
Template Name: Links
*/
?>
<?php get_header(); ?>
<div id="content">
	<div class="post">
		<div class="header">
					<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e("Permanent Link to",TEMPLATE_DOMAIN); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>
				</div>
		
		<div class="entry">
			<ul>
				<?php wp_list_bookmarks('title_li=');?>
			</ul>
		</div>
	</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
