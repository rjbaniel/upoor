<?php
get_header();
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="entry">
			<!--
				<h2 class="entrydate"><?php the_date() ?></h2>
			-->
			<h3 class="entrytitle" id="post-<?php the_ID(); ?>">
				<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
			</h3>
			<div class="entrybody">
				<div class="entrymeta">
<?php if(!is_page()) { ?><?php _e('Posted by','flex');?> <?php the_author() ?> <?php _e('on','flex');?> <?php the_time('F dS Y') ?> <?php _e('to','flex');?> <?php the_category(',') ?>&nbsp;&nbsp;&nbsp;<?php the_tags( '&nbsp;' . __( 'Tagged','flex' ) . ' ', ', ', ''); ?>&nbsp;&nbsp;&nbsp;<?php } ?><?php edit_post_link(__('Edit','flex'), '', ''); ?>
  </div>


<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>

<?php } else { ?>

<?php the_content(__('(more...)','flex')); ?>
<?php if(is_home() || is_archive()) { ?><?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?><?php } ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>

<?php } ?>


<?php if(!is_page()) { ?>
<p class="comments_link">
<?php
$comments_img_link = '<img src="' . get_stylesheet_directory_uri() . '/images/comments.gif"  title="comments" alt="*" />';
comments_popup_link(__('No Comments','flex'), $comments_img_link . __(' 1 Comment','flex'), $comments_img_link . __(' % Comments','flex'));
?>
</p>
<?php } ?>

</div>
	<!--
	<?php trackback_rdf(); ?>
	-->
</div>



<?php if(!is_page()) { ?>
<?php comments_template('',true); // Get wp-comments.php template ?>
<?php } else { ?>
<?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>
<?php } ?>


<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.','flex'); ?></p>
<?php endif; ?>


<?php if(!is_single()) { ?>
<?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page','flex'), __('Next Page &raquo;','flex')); ?>
<?php } else { ?>
<div class="navigation">
<p><?php previous_post_link('&larr; %link') ?></p>
<p class="next"><?php next_post_link('%link &rarr;') ?></p>
</div>
<?php } ?>


</div>
</div><!-- The main content column ends  -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
