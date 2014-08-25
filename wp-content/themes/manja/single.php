<?php get_header(); ?>

	<div id="content" class="widecolumn">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="post">

			<h2 id="post-<?php the_ID(); ?>"><?php the_title(); ?></h2>

			<div class="entry">
				

				<?php the_content(); ?>



				<p class="postmetadata alt">
               	<?php _e('Posted by',TEMPLATE_DOMAIN);?> <?php the_author_posts_link() ?> <?php _e("at",TEMPLATE_DOMAIN); ?> <a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:',TEMPLATE_DOMAIN);?> <?php the_title(); ?>"><?php the_time(__('F jS, Y')) ?></a>
				& <?php _e('Filed under',TEMPLATE_DOMAIN);?> <?php the_category(', ') ?> <strong>|</strong> <?php edit_post_link(__('Edit ',TEMPLATE_DOMAIN), '','<strong>|</strong>'); ?>  <?php comments_popup_link(__('No Comments &#187;',TEMPLATE_DOMAIN), __('1 Comment &#187;',TEMPLATE_DOMAIN), __('% Comments &#187;',TEMPLATE_DOMAIN)); ?>


				</p>

			</div>
		</div>






	<?php comments_template('',true); ?>


   	<div class="navigation">
			<div class="alignleft"><?php previous_post_link(' %link','&laquo;','yes')  ?></div>
			<div class="alignright"><?php next_post_link(' %link ','&raquo;','yes')  ?></div>
		</div>


	<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.',TEMPLATE_DOMAIN); ?></p>

<?php endif; ?>

	</div>


<?php get_sidebar(); ?>

<?php get_footer(); ?>
