<?php get_header(); ?>

			<div id="content">

<?php if (have_posts()) : ?>

				<h2 class="sectionhead"><a href="<?php the_permalink() ?>feed"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/rss.gif" alt="<?php _e("RSS Feed for This Post",TEMPLATE_DOMAIN); ?>" title="<?php _e("RSS Feed for This Post",TEMPLATE_DOMAIN); ?>" style="float:right;margin: 2px 0 0 5px;" /></a><?php _e("Current Article",TEMPLATE_DOMAIN); ?></h2>

<?php while (have_posts()) : the_post(); ?>

				<div class="post" id="post-<?php the_ID(); ?>">

					<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',TEMPLATE_DOMAIN);?> <?php the_title(); ?>"><?php the_title(); ?></a></h1>

					<p class="postinfo"><?php _e("By",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link(); ?> <?php _e('on',TEMPLATE_DOMAIN);?> <?php the_time('M j, Y') ?> <?php _e('in',TEMPLATE_DOMAIN);?> <?php the_category(', ') ?><?php the_tags( '&nbsp;' . __( 'and tagged',TEMPLATE_DOMAIN ) . ' ', ', ', ''); ?><?php edit_post_link(__('Edit',TEMPLATE_DOMAIN), ' | ', ''); ?></p>

					<div class="entry">
                          <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

						<?php the_content(); ?>

                       <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
					</div>
				</div>

				<p class="tb"><a href="<?php trackback_url(); ?>">Trackback URL</a></p>

<?php if (function_exists('related_posts')) { ?>
				<h2 class="related"><?php _e("Related Posts",TEMPLATE_DOMAIN); ?></h2>
				<div class="related">
					<ul><?php related_posts(); ?></ul>
				</div>
<?php } ?>



<?php endwhile; ?>

	<?php comments_template('',true); ?>

<?php endif; ?>

				<div class="navigation">
					<div class="alignleft">
						<?php next_posts_link(__('&laquo; Previous Posts',TEMPLATE_DOMAIN)) ?>
					</div>
					<div class="alignright">
						<?php previous_posts_link(__('Next Posts  &raquo;',TEMPLATE_DOMAIN)) ?>
					</div>
	               		</div>

			</div>

<?php include (TEMPLATEPATH . "/sidebar1.php"); ?>	

		</div>

<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>
