<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="entry">
			<h2 class="entrydate"><?php the_date() ?></h2>
			<h3 class="entrytitle" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			<div class="entrybody">


<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

<?php } else { ?>

<?php the_content(__('(more...)','gentle-calm')); ?>

<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

<?php } ?>


                        <?php if(!is_page()) { ?>
                <p class="comments_link">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/images/file.gif" title="file" alt="*" />
					<?php _e("Filed by",'gentle-calm'); ?> <?php the_author();?> <?php _e("at",'gentle-calm');?> <?php the_time() ?> <?php _e("under",'gentle-calm');?> <?php the_category(',');?> <?php the_tags( '&nbsp;' . __( 'Tagged','gentle-calm' ) . ' ', ', ', ''); ?><br/>
<?php $comments_img_link = '<img src="' . get_stylesheet_directory_uri() . '/images/comments.gif"  title="comments" alt="*" />'; comments_popup_link(__(' No Comments','gentle-calm'), $comments_img_link . __(' 1 Comment','gentle-calm'), $comments_img_link . __(' % Comments','gentle-calm'));
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
<p><?php _e('Sorry, no posts matched your criteria.','gentle-calm'); ?></p>
<?php endif; ?>


<?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page','gentle-calm'), __('Next Page &raquo;','gentle-calm')); ?>


</div>
</div><!-- The main content column ends  -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
