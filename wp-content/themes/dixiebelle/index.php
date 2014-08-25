<?php include_once('gravatar.php'); get_header(); ?>


<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	
<div class="post">
	 <h3 class="storytitle" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
	<div class="meta"><?php _e("Filed under:", 'dixiebelle'); ?> <?php the_category(',') ?> &#8212; <?php the_author() ?> <?php _e('at');?> <?php the_time('g:i a') ?> <?php _e('on');?> <?php the_time('l, F j, Y') ?> <?php the_tags( '&nbsp;' . __( 'Tagged', 'dixiebelle' ) . ' ', ', ', ''); ?> <?php edit_post_link(__('Edit This', 'dixiebelle')); ?></div>
	
	<div class="storycontent">

       <?php if( is_archive() || is_search() || is_category() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>

<?php } else { ?>

<?php the_content(__('(Read on ...)', 'dixiebelle')); ?>

<?php } ?>


	</div>

	<div class="feedback">
            <?php wp_link_pages(); ?>
            <?php comments_popup_link(__('Comments (0)', 'dixiebelle'), __('Comments (1)', 'dixiebelle'), __('Comments (%)', 'dixiebelle')); ?>
	</div>
	
	<!--
	<?php trackback_rdf(); ?>
	-->

</div>

<?php comments_template('',true); ?>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.', 'dixiebelle'); ?></p>
<?php endif; ?>

<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

<?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page', 'dixiebelle'), __('Next Page &raquo;', 'dixiebelle')); ?>

<?php get_footer(); ?>
