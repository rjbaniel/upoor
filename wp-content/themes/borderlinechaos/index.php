<?php get_header(); ?>

<?php get_sidebar(); ?>

<div id="contentwrapper">


<div id="content">

<?php if('' != get_header_image() ) { ?>
<div id="custom-img-header">
<a href="<?php bloginfo('url'); ?>"><img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /></a>
</div>
<?php } ?>


<br /><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		





	

		<div class="singlepost">


        <div class="pwrap">
	 <a class="posttitle" href="<?php the_permalink() ?>" style="text-decoration:none;" rel="bookmark" title="<?php _e('Permanent Link:', 'borderline');?> <?php the_title(); ?>"><?php the_title(); ?></a>

	<div class="cite"><?php the_time("l F dS Y") ?>, <?php the_time() ?> <?php edit_post_link(); ?><?php the_tags( '&nbsp;' . __( 'Tagged', 'borderline' ) . ' ', ', ', ''); ?><br />

<?php _e("Filed under:", 'borderline'); ?> <?php the_category(',') ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php comments_popup_link(__('Leave a Comment', 'borderline'), __('1 Comment', 'borderline'), __('% Comments', 'borderline')); ?></div></div> <br/>

			<div class="entrytext">
	<?php if(file_exists(WP_CONTENT_DIR . '/ads-block-two.php')) include(WP_CONTENT_DIR . '/ads-block-two.php'); ?>



                 <?php if( is_archive() || is_search() || is_category() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>

<?php } else { ?>

	<?php the_content(__('<p class="serif">Read the rest of this entry &raquo;</p>', 'borderline')); ?>

<?php wp_link_pages('before=<p>&after=</p>'); ?>

<?php } ?>








				<?php wp_link_pages('<p><strong>'.__('Pages:').'</strong> ', '</p>', 'number'); ?>

	

				</div>
	<br />
		</div>

	<br />



	



	<?php endwhile; ?>


        <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>

      <div class="navigation">

		 <div class="alignleft"><?php next_posts_link( __( '&laquo; Previous Entries','borderline' ) ) ?></div>
<div class="alignright"><?php previous_posts_link( __( 'Next Entries &raquo;','borderline' ) ) ?></div>

  				</div>

    <?php else: ?>

	

		<p><?php _e('Sorry, no posts matched your criteria.', 'borderline'); ?></p>

	

<?php endif; ?>





</div>

<?php get_footer(); ?>
