<?php get_header(); ?>
  <div id="content">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  
    <div class="post" id="post-<?php the_ID(); ?>">
        <h2><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:','glossyblue');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<span class="post-cat"><?php the_category(', ') ?> <?php the_tags( '&nbsp;' . __( 'Tagged','glossyblue' ) . ' ', ', ', ''); ?></span> <span class="post-calendar"><?php the_time(__('F jS, Y')) ?></span>
		<div class="post-content">


		<?php the_content(__('<p class="serif">Read the rest of this entry &raquo;</p>','glossyblue')); ?>
		
		<?php wp_link_pages(__('<p><strong>Pages:</strong> '), '</p>', 'number'); ?>

		<?php edit_post_link(__('Edit','glossyblue'), '', ''); ?>
		
		</div>

	   <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>

			<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.','glossyblue'); ?></p>

<?php endif; ?>

	</div><!--/post -->

  </div><!--/content -->

<?php get_sidebar(); ?>
  
<?php get_footer(); ?>

