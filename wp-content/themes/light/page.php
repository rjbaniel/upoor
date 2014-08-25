<?php
get_header();
?>

<div id="content">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <div class="entry">
    <h3 class="entrytitle" id="post-<?php the_ID(); ?>">
      <?php the_title(); ?>
 </h3>
    <div class="entrymeta-single">
      <?php 
			edit_post_link(__('<strong> Edit</strong>',TEMPLATE_DOMAIN));?>
    </div>
    <div class="entrybody">
      <?php the_content(__('Read more &raquo;',TEMPLATE_DOMAIN));?>
      <?php wp_link_pages('before=<p>&after=</p>'); ?>
    </div>
	
    <!--
	<?php trackback_rdf(); ?>
	-->
  </div>

  <?php endwhile; ?>

   <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>


  <?php else: ?>
  <p>
    <?php _e('Sorry, no posts matched your criteria.',TEMPLATE_DOMAIN); ?>
  </p>
  <?php endif; ?>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
