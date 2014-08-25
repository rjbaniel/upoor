<?php get_header(); ?>

<div id="content">
  <?php if (have_posts()) : 
	$i = 1; 
  ?>
    <?php while (have_posts()) : the_post(); ?>
  <div class="post<?php if ($i == 1) { echo' new'; } ?>" id="post-<?php the_ID(); ?>">
    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','dignity');?> <?php the_title(); ?>">
      <?php the_title(); ?>
      </a></h2>
	<p class="postmetadata"><span class="timr">
      <?php the_time(__('F jS, Y')) ?>
      </span>
      <span class="user"><?php _e('by','dignity'); ?> <?php the_author() ?> </span>
    </p>  
	<br class="clear" />
    <div class="entry">
	
      <?php the_content(__('Read the rest of this entry &raquo;','dignity')); ?>
	  
    </div>
  <p class="postmetadata">
	  <span class="catr">
      <?php _e('Category','dignity'); ?> <?php the_category(', ') ?>
      </span> |
      <?php edit_post_link(__('Edit','dignity'), '<span class="editr">', ' | </span>'); ?>
      <span class="commr">
      <?php comments_popup_link(__('No Comments &#187;','dignity'), __('1 Comment &#187;','dignity'), __('% Comments &#187;','dignity')); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php the_tags( '&nbsp;' . __( '| Tagged','dignity' ) . ' ', ', ', ''); ?>
      </span></p>
  </div>
  <?php 
	$i = $i + 1;
  endwhile; ?>
  <div class="navigation">
    <div class="alignleft">
      <?php next_posts_link(__('&larr; Previous Entries','dignity')) ?>
    </div>
    <div class="alignright">
      <?php previous_posts_link(__('Next Entries &rarr;','dignity')) ?>
    </div>
  </div>
  <?php else : ?>
  <h2 class="center"><?php _e('Not Found','dignity');?></h2>
  <p class="center"><?php _e("Sorry, but you are looking for something that isn't here.",'dignity');?></p>
  <?php include (TEMPLATEPATH . "/searchform.php"); ?>
  <?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
