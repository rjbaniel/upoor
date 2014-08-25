<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div id="content">

	<?php query_posts("showposts=1000"); ?>
	<?php if (have_posts()) : ?>

		<h1><?php _e('Blog Archives',TEMPLATE_DOMAIN); ?></h1>

		<div class="post post-list">
			<ul>
			<?php while (have_posts()) : the_post(); ?>

					<li><?php the_time('F jS, Y') ?> - <a href="<?php the_permalink() ?>" rel="<?php _e('bookmark',TEMPLATE_DOMAIN); ?>" title="<?php _e('Permanent Link to',TEMPLATE_DOMAIN); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>

			<?php endwhile; ?>
			</ul>
		</div>



	<?php else : ?>

		<h2 class="center"><?php _e('Not Found',TEMPLATE_DOMAIN); ?></h2>

	<?php endif; ?>

</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
