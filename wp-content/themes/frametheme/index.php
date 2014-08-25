<?php
get_header();
?>
<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>
<?php the_date('','<h2>','</h2>'); ?>
<div class="post">
<h3 class="storytitle" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
<div class="meta"><?php _e("Filed under:",'frame'); ?> <?php the_category(',') ?> &#8212; <?php the_author() ?> @ <?php the_time() ?> <?php the_tags( '&nbsp;' . __( 'Tagged','frame' ) . ' ', ', ', ''); ?> <?php edit_post_link(__('Edit This')); ?></div>
<div class="storycontent">

<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>

<?php } else { ?>

<?php the_content(__('(more...)','frame')); ?>
<?php if(is_home() || is_archive()) { ?><?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?><?php } ?>

<?php } ?>

</div>


<div class="feedback">
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php comments_popup_link(__('Comments (0)','frame'), __('Comments (1)','frame'), __('Comments (%)','frame')); ?>
</div>
<!--
<?php trackback_rdf(); ?>
-->
</div>
<?php comments_template('',true); // Get wp-comments.php template ?>
<?php endwhile; ?>

<?php else: ?>
<p><?php _e('Sorry, no posts matched your criteria.','frame'); ?></p>
<?php endif; ?>
<div id="page-navigation-single"><?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page','frame'), __('Next Page &raquo;','frame')); ?></div>

<?php get_footer(); ?>
