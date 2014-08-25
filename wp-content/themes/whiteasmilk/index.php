<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : ?>
		
		<?php while (have_posts()) : the_post(); ?>

			<div class="post">
				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:', TEMPLATE_DOMAIN); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<small><?php the_time(get_option('date_format')) ?></small>

				<div class="entry">
                         <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
					<?php the_content(__('Read the rest of this entry &raquo;', TEMPLATE_DOMAIN)); ?>
                      <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
				</div>
		
				<p class="postmetadata"><?php _e('Posted by ', TEMPLATE_DOMAIN);?> <?php the_author_posts_link(); ?> <?php _e("in",TEMPLATE_DOMAIN); ?> <?php the_category(', ') ?> <strong>|</strong> <?php edit_post_link(__('Edit', TEMPLATE_DOMAIN), '','<strong>|</strong>'); ?> <?php if ( comments_open() ) { ?><?php comments_popup_link(__('No Comments &#187;', TEMPLATE_DOMAIN), __('1 Comment &#187;', TEMPLATE_DOMAIN), __('% Comments &#187;', TEMPLATE_DOMAIN)); ?><?php } ?></p>
				<hr />
			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php posts_nav_link('','',__('&laquo; Previous Entries', TEMPLATE_DOMAIN)) ?></div>
			<div class="alignright"><?php posts_nav_link('',__('Next Entries &raquo;', TEMPLATE_DOMAIN),'') ?></div>
		</div>
		
	<?php else : ?>

		<h2 class="center"><?php _e('Not Found', TEMPLATE_DOMAIN); ?></h2>
		<p class="center"><?php _e("Sorry, but you are looking for something that isn't here.", TEMPLATE_DOMAIN); ?></p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
