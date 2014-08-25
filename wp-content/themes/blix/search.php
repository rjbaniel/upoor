<?php get_header(); ?>



<!-- content ................................. -->

<div id="content" class="archive">



<?php if (have_posts()) : ?>



	<h2><?php _e('Search Results for ','blix');?> <em>&#8216;<?php echo esc_html($s, 1); ?>&#8217;</em></h2>



<?php while (have_posts()) : the_post(); ?>



	<div class="entry">



		<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>



		<?php ($post->post_excerpt != "")? the_excerpt() : BX_shift_down_headlines(get_the_content()); ?>



		<p class="info"><?php if ($post->post_excerpt != "") { ?><a href="<?php the_permalink() ?>" class="more"><?php _e('Continue Reading','blix'); ?></a><?php } ?>

   		<?php comments_popup_link(__('Add comment','blix'), __('1 comment','blix'), __('% comments','blix'), __('commentlink'), ''); ?>

   		<em class="date"><?php the_time(__('F jS, Y')) ?><!-- at <?php the_time('h:ia')  ?>--></em>

   		<!--<em class="author"><?php the_author(); ?></em>-->

   		<?php edit_post_link(__('Edit','blix'), '<span class="editlink">','</span>'); ?>

   		</p>



	</div>





<?php endwhile; ?>



	<p><!-- this is ugly -->
 <span class="next"><?php previous_posts_link(__('Next Posts', 'blix')) ?></span>
	<span class="previous"><?php next_posts_link(__('Previous Posts', 'blix')) ?></span>
	</p>



<?php else : ?>



	<h2><?php _e('No Results for', 'blix'); ?> <em>&#8216;<?php echo $s ?>&#8217;</em></h2>

	<p><?php _e("Sorry, but you are looking for something that isn't here.", 'blix');?></p>



<?php endif; ?>



</div> <!-- /content -->



<?php get_sidebar(); ?>



<?php get_footer(); ?>
