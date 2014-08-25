<?php get_header(); ?>

<?php include (TEMPLATEPATH . "/sidebar1.php"); ?>	

		<div id="content">

	<?php if (have_posts()) : ?>

		<h2 class="sectionhead"><?php _e("Search Results for",TEMPLATE_DOMAIN); ?> "<?php echo esc_html($s, 1); ?>"</h2>

	<?php while (have_posts()) : the_post(); ?>
				
				<div class="post" id="post-<?php the_ID(); ?>">

<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',TEMPLATE_DOMAIN);?> <?php the_title(); ?>"><?php the_title(); ?> &raquo;</a></h2>

 <p class="postinfo"><?php _e("By",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link(); ?> <?php _e('on',TEMPLATE_DOMAIN);?> <?php the_time('M j, Y') ?> <?php _e('in',TEMPLATE_DOMAIN);?> <?php the_category(', ') ?> | <?php comments_popup_link(__('0 Comments',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN)); ?><?php edit_post_link(__('Edit',TEMPLATE_DOMAIN), ' | ', ''); ?></p>

					<div class="entry">
						<?php the_excerpt(); ?>
					</div>

				</div>

	        <?php endwhile; endif; ?>

		<div class="navigation">
			<div class="alignleft">
				<?php next_posts_link(__('&laquo; Previous Entries',TEMPLATE_DOMAIN)) ?>
			</div>
			<div class="alignright">
				<?php previous_posts_link(__('Next Entries &raquo;',TEMPLATE_DOMAIN)) ?>
			</div>
		</div>	

	</div>

</div>

<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>
