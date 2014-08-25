<?php get_header(); ?>
<div id="left">
<div id="content" class="narrowcolumn">
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336x280-anubis-top"); } ?>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <div class="post" id="post-<?php the_ID(); ?>">
    <h2>
      <?php the_title(); ?>
    </h2>
    <div class="entry">
      <?php the_content(__('<p class="serif">Read the rest of this page &raquo;</p>', 'anubis')); ?>
      <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
      <?php edit_post_link(__('Edit this entry.', 'anubis'), '<p>', '</p>'); ?>        
    </div>
  </div>
  <?php endwhile; ?>
 <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>
  <?php endif; ?>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
