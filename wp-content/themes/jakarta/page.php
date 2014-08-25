<?php get_header(); ?>

	<div id="content" class="narrowcolumn">
<div id="headerimg">
		<a href="<?php echo get_option('home'); ?>"><img src="<?php header_image() ?>" width="480" height="200" /></a>
	</div>
	
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post">
		<h2 id="post-<?php the_ID(); ?>"><?php the_title(); ?></h2>
			<div class="entrytext">
				<?php the_content(__('<p class="serif">Read the rest of this page &raquo;</p>',TEMPLATE_DOMAIN)); ?>
				<?php wp_link_pages('<p><strong>'.__('Pages:',TEMPLATE_DOMAIN).'</strong> ', '</p>', 'number'); ?>
	            <?php edit_post_link(__('Edit this entry.',TEMPLATE_DOMAIN), '<p>', '</p>'); ?>
			</div>
		</div>
	  <?php endwhile; endif; ?>
      <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
