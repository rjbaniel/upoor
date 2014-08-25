<?php get_header(); ?>

	<div class="wrapper"><!-- This wrapper class appears only on Page and Single Post pages. -->
	<div class="narrowcolumnwrapper"><div class="narrowcolumn">

		<div class="content">

			<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>

			<div class="post" id="post-<?php the_ID(); ?>">

				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

				<div class="postinfo">
<?php _e('Posted on'); ?> <span class="postdate"><?php the_time(get_option('date_format')) ?></span> <?php _e('by'); ?> <?php the_author() ?> <?php edit_post_link(__('Edit','digg-3-col'), ' &#124; ', ''); ?>
				</div>

				<div class="entry">
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
					<?php the_content(); ?>
					<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
					<?php wp_link_pages('<p><strong>'.__('Pages:').'</strong> ', '</p>', 'number'); ?>

					<p class="postinfo">
				<?php _e('Filed under&#58;','digg-3-col'); ?> <?php the_category(', ') ?> <?php the_tags( '&#124; ' . __( 'Tagged','digg-3-col' ) . ': ', ', ', ''); ?>
					</p>

				</div>
			</div>

<?php endwhile; ?>

<?php include (TEMPLATEPATH . '/browse.php'); ?>

<?php else : ?>

			<div class="post">

				<h2><?php _e('Not Found','digg-3-col'); ?></h2>

				<div class="entry">
<p><?php _e('Sorry, but you are looking for something that isn&#39;t here.','digg-3-col'); ?></p>
				</div>

			</div>

<?php endif; ?>

		</div><!-- End content -->

	</div></div><!-- End narrowcolumnwrapper and narrowcolumn classes -->


<!-- Start Comments Template -->

	<div class="narrowcolumnwrapper"><div class="narrowcolumn">

		<div class="content">

			<div class="post">

<?php comments_template('',true); ?>
			</div>

		</div><!-- End content for comments template -->

	</div></div><!-- End narrowcolumnwrapper and narrowcolumn classes for comments template -->
	</div><!-- End wrapper class -->

<?php get_footer(); ?>
