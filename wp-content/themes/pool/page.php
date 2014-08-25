<?php get_header(); ?>

	<div id="content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>
			<div class="entry">
				<?php the_content(__('<p>Continue reading &raquo;</p>',TEMPLATE_DOMAIN)); ?>
	
				<?php //if page is split into more than one
					wp_link_pages('<p>Pages: ', '</p>', 'number'); ?>
             	<?php edit_post_link(__('Edit',TEMPLATE_DOMAIN), '<p>', '</p>'); ?>
			</div>
		</div>
	  <?php endwhile; endif; ?>


      <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>   


</div>

<?php include(TEMPLATEPATH."/left.php");?>
<?php include(TEMPLATEPATH."/right.php");?>

<?php get_footer(); ?>
