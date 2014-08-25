<?php get_header(); ?>
  <div id="content">
 
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
    <div class="post" id="post-<?php the_ID(); ?>">
        <h2><?php the_title(); ?></h2>
        <div class="post-content">
			<?php the_content(__('<p class="serif">Read the rest of this page &raquo;</p>','glossyblue')); ?>
			<?php wp_link_pages(__('<p><strong>Pages:</strong> '), '</p>', 'number'); ?>
        </div>
    </div>
	
  <?php endwhile; endif; ?>

  <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>

  </div><!--/content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
