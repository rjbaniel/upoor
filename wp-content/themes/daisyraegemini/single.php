<?php

include_once('gravatar.php');

get_header();
?>



<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	
<div class="post">
	 <h3 class="storytitle" id="post-<?php the_ID(); ?>"><?php the_title(); ?></h3>
	<div class="meta"><?php _e("Filed under:", 'daisyrae'); ?> <?php the_category(',') ?> &#8212; <?php the_author() ?> <?php _e('at');?> <?php the_time('g:i a') ?> <?php _e('on');?> <?php the_time('l, F j, Y') ?> <?php the_tags( '&nbsp;' . __( 'Tagged', 'daisyrae' ) . ' ', ', ', ''); ?> <?php edit_post_link(__('Edit This', 'daisyrae')); ?></div>

	<div class="storycontent">

          <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

		<?php the_content(); ?>
        <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>        
	</div>

	<div class="feedback">
            <?php wp_link_pages(); ?>
            <?php comments_popup_link(__('Comments (0)', 'daisyrae'), __('Comments (1)', 'daisyrae'), __('Comments (%)', 'daisyrae')); ?>
	</div>

	<!--
	<?php trackback_rdf(); ?>
	-->

</div>

<?php comments_template('',true); ?>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?>

<?php get_footer(); ?>
