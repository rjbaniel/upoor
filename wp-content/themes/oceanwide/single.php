<?php get_header(); ?>



	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>



				<div class="item_class" id="post-<?php the_ID(); ?>">

					<div class="item_class_title">

						<div class="item_class_title_text">

						

							<div class="date">

								<div class="date_month"><?php the_time('M') ?></div>

								<div class="date_day"><?php the_time('d') ?></div>

							</div>

							<div class="titles">

								<div class="top_title"><h1><?php the_title(); ?></h1></div>

								<div class="end_title"><?php _e("Filed Under",TEMPLATE_DOMAIN); ?> (<?php the_category(', ') ?>) <?php _e("by",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link() ?> <?php _e('on');?> <?php the_time('d-m-Y') ?><?php the_tags( '&nbsp;' . __( 'and tagged',TEMPLATE_DOMAIN ) . ' ', ', ', ''); ?></div>

							</div>

							

						</div>

					</div>

					<div class="item_class_text">
                      <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
				<?php the_content(__('Read the rest of this entry &raquo;')); ?>
                     <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
					</div>

					<div class="item_class_panel">

						<div>

							<div class="links_left">

								<span class="panel_comm"><a href="<?php the_permalink() ?>#respond"><?php _e("Post a Comment",TEMPLATE_DOMAIN); ?></a></span>&nbsp;&nbsp;&nbsp;

							<?php edit_post_link(__('Edit',TEMPLATE_DOMAIN), '', ''); ?>

							</div>

							<div class="links_right">

<?php comments_popup_link(__('(0) Comments',TEMPLATE_DOMAIN), __('(1) Comment',TEMPLATE_DOMAIN), __('(%) Comments',TEMPLATE_DOMAIN)); ?>&nbsp;&nbsp;

								<a href="<?php the_permalink() ?>" class="panel_read"><?php _e("Read More",TEMPLATE_DOMAIN); ?></a>

							</div>

						</div>

					</div>

				</div>
<div id="blog_comm">
	<?php comments_template('',true); ?>
               </div>


	<?php endwhile; else: ?>



		<p><?php _e('Sorry, no posts matched your criteria.',TEMPLATE_DOMAIN);?></p>



<?php endif; ?>



<?php get_footer(); ?>

