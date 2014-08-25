<?php get_header(); ?>

	<div id="content">

		<h2><?php _e('Doh!','regulus'); ?></h2>
		<p><?php _e('Something has gone wrong, the page you\'re looking for can\'t be found.','regulus'); ?></p>
		<p><?php _e('Hopefully one of the options below will help you','regulus'); ?></p>
		<ul>
		<li><?php _e('You can search the site using the search box to the right','regulus'); ?></li>
		<li><?php printf(__('You could visit <a href="%s">the homepage</a>','regulus'), get_option('home')); ?></li>
		<li><?php _e('Or you could have a look through the recent posts listed below, maybe what you\'re looking for is there','regulus'); ?></li>
		</ul>

		<h3><?php _e('Recent Posts','regulus'); ?></h3>
		<ul>
		<?php
		query_posts('posts_per_page=5');
		if (have_posts()) : while (have_posts()) : the_post(); ?>
			<li><a href="<?php the_permalink() ?>" title="<?php _e('Permalink for :','regulus'); ?> <?php the_title(); ?>"><?php the_title(); ?></a>
		<?php endwhile; endif; ?>
		</ul>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
