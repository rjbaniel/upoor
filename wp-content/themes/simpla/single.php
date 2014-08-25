<?php
get_header();
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="entry">
			<h2 class="entrydate"><?php the_date() ?></h2>
			<h3 class="entrytitle" id="post-<?php the_ID(); ?>"><?php the_title(); ?></h3>
			<div class="entrybody">

<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

<?php the_content(); ?>

<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>


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

<?php comments_template('',true); // Get wp-comments.php template ?>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<div class="navigation">
	<p><?php next_posts_link(__('&larr; Previous Entries','gentle-calm')) ?></p>
	<p class="next"><?php previous_posts_link(__('Next Entries &rarr;','gentle-calm')) ?></p>
</div>

</div>
</div><!-- The main content column ends  -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
