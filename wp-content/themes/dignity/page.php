<?php get_header(); ?>

<div id="content" class="narrowcolumn">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <div class="post" id="post-<?php the_ID(); ?>">
    <h2>
      <?php the_title(); ?>
    </h2>
    <div class="entry">

<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

      <?php the_content(__('<p class="serif">Read the rest of this page &raquo;</p>','dignity')); ?>
	  
      <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

      <?php edit_post_link(__('Edit this entry.','dignity'), '<p>', '</p>'); ?>

    </div>
  </div>
  <?php endwhile; endif; ?>


  <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
