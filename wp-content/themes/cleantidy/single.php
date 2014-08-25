<?php get_header(); ?>

<div id="recent">
<div class="container">

<div class="recent-post">

<?php if(have_posts()):?><?php while(have_posts()): the_post(); ?>


<div class="recent-post">
<h2 id="post-<?php the_ID(); ?>" class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','cleantidy');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
<small><?php the_time(__('F jS, Y')) ?> | <?php the_category(', ') ?> | <?php the_tags( '&nbsp;' . __( 'Tagged','cleantidy' ) . ' ', ', ', ''); ?>  <?php edit_post_link('Edit this post','cleantidy'); ?> </small>
</div>


</div>

<div class="clear"></div>
</div>
</div>


<div id="posts">
	<div class="container">
	<div class="recent-post">
		
	
<?php if(file_exists(WP_CONTENT_DIR . '/ads-block-two.php')) include(WP_CONTENT_DIR . '/ads-block-two.php'); ?>
	
	<?php the_content(__('More ...','cleantidy')); ?>
	<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
  <div class="navigation">
			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
	</div>
  
  <div id="comment-container">
<?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>
	</div>
<?php endwhile; else: ?>
	
<?php endif; ?>


	</div>
	
	<?php get_sidebar(); ?>
	
	</div>
	<div class="clear"></div>
</div>
<?php get_footer(); ?>
