<?php get_header(); ?>
  <div id="content">
    <div class="post">
	<h2><?php _e('Search Results','glossyblue');?></h2>

  
  <?php if (have_posts()) : ?>
			  
	<?php while (have_posts()) : the_post(); ?>
	<div class="post-content" id="post-<?php the_ID(); ?>">
	
		  <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','glossyblue');?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
     <?php the_excerpt(); ?>

	</div>
	<?php endwhile; ?>
	
	<div class="navigation">
	  <span class="previous-entries"><?php next_posts_link(__('Previous Entries','glossyblue')) ?></span> <span class="next-entries"><?php previous_posts_link(__('Next Entries','glossyblue')) ?></span>
	</div>
	
  <?php else : ?>
  	<h3><?php _e('Sorry, nothing found.','glossyblue'); ?></h3>
    <?php endif; ?>
	</div><!--/content -->
  </div><!--/content -->
  
<?php get_sidebar(); ?>

<?php get_footer(); ?>
