<?php
get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php the_date('','<h2>','</h2>'); ?>

<div class="post">
<h3 class="storytitle" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
<div class="meta"><?php _e("Filed under:",'deichnetz'); ?> <?php the_category(',') ?> &#8212; <?php the_author() ?> @ <?php the_time() ?> <?php the_tags( '&nbsp;' . __( 'Tagged','deichnetz' ) . ' ', ', ', ''); ?> <?php edit_post_link(__('Edit This','deichnetz')); ?></div>

<div class="storycontent"><?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>



	   <?php if( is_archive() || is_search() || is_category() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>

<?php } else { ?>

<?php the_content(__('(more...)','deichnetz')); ?>

<?php } ?>






<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
</div>

<div class="feedback">
<?php wp_link_pages(); ?>
<?php if(!is_single()) { ?>
<?php comments_popup_link(__('Comments (0)','deichnetz'), __('Comments (1)','deichnetz'), __('Comments (%)','deichnetz')); ?>
<?php } ?>
</div>

</div>

<?php if(is_page()) { ?>
<?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>
<?php } else { ?>
<?php comments_template('',true); // Get wp-comments.php template ?>
<?php } ?>


<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.','deichnetz'); ?></p>
<?php endif; ?>

<p id="pagenav">
<?php if(is_single()) { ?>
	<p><?php previous_post_link('&larr; %link') ?></p>
	<p class="next"><?php next_post_link('%link &rarr;') ?></p>
<?php } else { ?>
<?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page', 'deichnetz'), __('Next Page &raquo;', 'deichnetz')); ?>
<?php } ?>
</p>

<?php get_footer(); ?>
