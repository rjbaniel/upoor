<?php get_header(); ?>





  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>



<?php $attachment_link = get_the_attachment_link($post->ID, true, array(450, 800)); // This also populates the iconsize for the next line ?>

<?php $_post = &get_post($post->ID); $classname = ($_post->iconsize[0] <= 128 ? 'small' : '') . 'attachment'; // This lets us style narrow icons specially ?>



				<div class="item_class" id="post-<?php the_ID(); ?>">

					<div class="item_class_title">

						<div class="item_class_title_text">

						

							<div class="date">

								<div class="date_month"><?php the_time('M') ?></div>

								<div class="date_day"><?php the_time('d') ?></div>

							</div>

							<div class="titles">

								<div class="top_title"><h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',TEMPLATE_DOMAIN);?> <?php the_title(); ?>"><?php the_title(); ?></a></h1></div>

								<div class="end_title"><?php _e("Filed Under",TEMPLATE_DOMAIN); ?> (<?php the_category(', ') ?>) <?php _e("by",TEMPLATE_DOMAIN); ?> <?php the_author() ?> <?php _e('on',TEMPLATE_DOMAIN);?> <?php the_time('d-m-Y') ?></div>

							</div>

							

						</div>

					</div>

					<div class="item_class_text">

						<?php the_content(__('Read the rest of this entry &raquo;',TEMPLATE_DOMAIN)); ?>

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



 <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>


	<?php endwhile; else: ?>



		<div id="content" class="narrowcolumn"><p><?php _e('Sorry, no attachments matched your criteria.',TEMPLATE_DOMAIN);?></p>

							<?php _e('Both comments and pings are currently closed.',TEMPLATE_DOMAIN);?></div>



<?php endif; ?>



<?php get_footer(); ?>

