<?php get_header(); ?>
  <div id="content">
  
  <?php if (have_posts()) : ?>
  
  	<?php while (have_posts()) : the_post(); ?>
  
    <div class="post" id="post-<?php the_ID(); ?>">
	  <div class="post-date"><span class="post-month"><?php the_time('M') ?></span> <span class="post-day"><?php the_time('d') ?></span></div>
	  <div class="entry">
        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','glossyblue');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<span class="post-cat"><?php the_category(', ') ?> <?php the_tags( '&nbsp;' . __( 'Tagged' ,'glossyblue') . ' ', ', ', ''); ?></span> <span class="post-comments"><?php comments_popup_link(__('No Comments &#187;','glossyblue'), __('1 Comment &#187;','glossyblue'), __('% Comments &#187;','glossyblue')); ?></span>
		<div class="post-content">


           <?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

<?php the_content(__('Read the rest of this entry &raquo;','glossyblue')); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } ?>



		</div>
	  </div>
	</div>
	
	<?php endwhile; ?>
	
	<div class="navigation">
	  <span class="previous-entries"><?php next_posts_link(__('Previous Entries','glossyblue')) ?></span> <span class="next-entries"><?php previous_posts_link(__('Next Entries','glossyblue')) ?></span>
	</div>
	
	<?php else : ?>
	
		<h2 class="center"><?php _e('Not Found','glossyblue');?></h2>
		<p class="center"><?php _e("Sorry, but you are looking for something that isn't here.",'glossyblue'); ?></p>
		
  <?php endif; ?>
	
  </div><!--/content -->
  
<?php get_sidebar(); ?>

<?php get_footer(); ?>
