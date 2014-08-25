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



	 <a class="posttitle" href="<?php the_permalink() ?>" style="text-decoration:none;" rel="bookmark" title="<?php _e('Permanent Link:', 'borderline');?> <?php the_title(); ?>"><?php the_title(); ?></a>

	<div class="cite"><?php the_time("l F dS Y") ?>, <?php the_time() ?> <?php edit_post_link(); ?><?php the_tags( '&nbsp;' . __( 'Tagged', 'borderline' ) . ' ', ', ', ''); ?><br />

<?php _e("Filed under:", 'borderline'); ?> <?php the_category(',') ?></div><br/>

			<div class="entrytext">
	<?php if(file_exists(WP_CONTENT_DIR . '/ads-block-two.php')) include(WP_CONTENT_DIR . '/ads-block-two.php'); ?>
				<?php the_content(__('<p class="serif">Read the rest of this entry &raquo;</p>')); ?>

	

				<?php wp_link_pages('<p><strong>'.__('Pages:').'</strong> ', '</p>', 'number'); ?>

	

				</div>
	<br />
		</div>

	<br />



	



	<?php endwhile; ?>

  <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>



       <div class="navigation">

			<div class="alignleft"><?php previous_post_link(' %link','&laquo;','yes') ?></div>

			<div class="alignright"><?php next_post_link(' %link ','&raquo;','yes') ?></div>

  				</div>


    <?php else: ?>

	

		<p><?php _e('Sorry, no posts matched your criteria.', 'borderline'); ?></p>

	

<?php endif; ?>





</div>

<?php get_footer(); ?>
