<?php /*
	Post Template
	This page holds the code used by category.php, date.php, index.php and single.php.
	It it is the default post design.
	*/
?>

<?php /* Guess Noteworthy categories */
$noteworthy_cat = $wpdb->get_var("SELECT t.term_id FROM {$wpdb->terms} AS t LEFT JOIN {$wpdb->term_taxonomy} AS tt ON ( tt.term_id = t.term_id ) WHERE t.slug = 'noteworthy' AND tt.taxonomy = 'category'"); 
?>
<div class="box entry">

	<?php /* Show entry date on everything but permalinks */
			if (!is_single()) { ?>
	<div class="entry-date">
		<p><?php comments_popup_link(__('Comments (0)','fauna'), __('Comments (1)','fauna'), __('Comments (%)','fauna'), '', __('<span>Comments Off</span>','fauna') ); ?></p>
	</div>
	<?php } ?>
	
	<?php /* Noteworthies */ ?>
	<?php if ( in_category($noteworthy_cat) ) { ?><div class="noteworthy"><?php echo(noteworthy_link($noteworthy_cat,TRUE,'')); ?></div>
	<?php } ?>

	<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','fauna');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
	
	<?php /* If we're not on a permalink and there's a written excerpt, only that */


	if ( is_date() || is_search() || is_tag() ) { ?>

    <?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
    <?php the_post_thumbnail(); ?></div><?php } } ?>
    <?php the_excerpt(); ?>

    <?php } else { ?>

	<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

    <?php the_content(__('Continue reading this entry &raquo;','fauna')); ?>

    <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
	
	<?php wp_link_pages('before=<strong>Page: &after=</strong>&next_or_number=number&pagelink=%'); ?>

<?php } ?>





	<div class="entry-meta">
		<?php _e("Filed in",'fauna'); ?>
		<?php the_category(',') ?> 
		<?php the_tags( ' and ' . __( 'tagged' ,'fauna') . ' ', ', ', ''); ?>
		<?php if (function_exists('time_since')) {
		echo time_since(abs(strtotime($post->post_date_gmt . " GMT")), time()) . " ago";
		} else {
		the_time(__('F jS, Y'));
		} ?> 
		by <?php the_author_posts_link(); ?>
	</div>

	
	<?php edit_post_link(__('Edit This','fauna'), ' &#8212; '); ?>
	
	<hr />
	
</div>
