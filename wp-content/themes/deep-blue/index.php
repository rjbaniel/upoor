<?php
get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php the_date('','<h2>','</h2>'); ?>
	
<div class="post">
	 <h3 class="storytitle" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
	<div class="meta"><?php _e("Filed under:", 'deep-blue'); ?> <?php the_category(',') ?> &#8212; <?php the_author() ?> @ <?php the_time() ?> <?php edit_post_link(__('Edit This', 'deep-blue')); ?> <?php the_tags( '&nbsp;' . __( 'Tagged', 'deep-blue' ) . ' ', ', ', ''); ?></div>
	
	<div class="storycontent">
    <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>


	   <?php if( is_archive() || is_search() || is_category() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>

<?php } else { ?>

<?php the_content( __('<p>Click here to read more</p>', 'deep-blue') ); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>

<?php } ?>


        <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
	</div>
	
	<div class="feedback">
            <?php wp_link_pages(); ?>


             <?php if(!is_single()) { ?>
            <?php comments_popup_link(__('Comments (0)', 'deep-blue'), __('Comments (1)', 'deep-blue'), __('Comments (%)', 'deep-blue')); ?>
    <?php } ?>   	</div>

</div>

<?php if(is_page()) { ?>
<?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>
<?php } else { ?>
<?php comments_template('',true); // Get wp-comments.php template ?>
<?php } ?>


<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.', 'deep-blue'); ?></p>
<?php endif; ?>

<?php if(is_single()) { ?>
	<p><?php previous_post_link('&larr; %link') ?></p>
	<p class="next"><?php next_post_link('%link &rarr;') ?></p>
<?php } else { ?>
<?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page', 'deep-blue'), __('Next Page &raquo;', 'deep-blue')); ?>
<?php } ?>

<?php get_footer(); ?>
<?php get_sidebar(); ?>
