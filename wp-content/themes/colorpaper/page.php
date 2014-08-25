<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div id="page-title">

				<div class="page-title-content">

					<h3 class="page-title"><?php the_title(); ?></h3>

					 <div class="post-meta-single">

						<?php _e('Written by', 'colorpaper'); ?> <span class="orange weight-normal"><?php the_author_link(); ?></span> on <?php the_time('l, F jS, Y') ?>


                                   	<?php if (('open' == $post-> comment_status)) : ?>
                        <div class="box">



					 <?php _e('Comments <a href="#respond">are open</a> on this page, you can <a href="#respond">leave a response</a>', 'colorpaper'); ?>.



							<?php if(('open' == $post->ping_status)) : ?>

								<?php _e('You may', 'colorpaper'); ?> <?php if(('open' == $post-> comment_status)): ?><?php _e('also', 'colorpaper'); ?><?php endif; ?> <?php _e('leave a', 'colorpaper'); ?> <a href="<?php trackback_url(); ?>" rel="trackback"><?php _e('trackback', 'colorpaper'); ?></a> <?php _e('from your site.', 'colorpaper'); ?>

							<?php endif; ?>

						</div>

                          	<?php endif; ?>



					</div>

				</div>

			</div>

		</div>

		<div class="left-content">

			<div class="post">

				<div class="post-date"><span class="month block"><?php the_time('M'); ?> </span><span class="day"><?php the_time('d'); ?> </span></div>

				<?php the_content(''); ?>


                 				<?php wp_link_pages(array('before' => '<strong>Pages:</strong> ', 'after' => '', 'next_or_number' => 'number')); ?>

							<?php edit_post_link(__('Edit this entry.', 'colorpaper'), '', ''); ?>

			</div>

		   <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>

		</div>

	<?php endwhile; endif; ?>

	</div>

	<div id="right-col">

		<?php get_sidebar(); ?>

	</div>

</div></div>

<?php get_footer(); ?>



