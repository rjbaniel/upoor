<?php
get_header();
?>
<div id="content">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <div class="entry">
    <h3 class="entrytitle" id="post-<?php the_ID(); ?>"> <a href="<?php the_permalink() ?>" rel="bookmark">
      <?php the_title(); ?>
      </a> </h3>
    <div class="entrymeta">
      <?php _e("Posted by",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link(); ?> <?php _e("on",TEMPLATE_DOMAIN); ?> <?php
			the_time('F j, Y ');
			$comments_img_link= '<img src="' . get_stylesheet_directory_uri() . '/images/comments.gif"  title="comments" alt="*" /><strong>';
			comments_popup_link($comments_img_link .__(' Comments(0)',TEMPLATE_DOMAIN), $comments_img_link .__(' Comments(1)',TEMPLATE_DOMAIN), $comments_img_link . __(' Comments(%)',TEMPLATE_DOMAIN) );
			edit_post_link(__(' Edit',TEMPLATE_DOMAIN));?>
      </strong> </div>
    <div class="entrybody">
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

 <?php the_content(__('Read more &raquo;',TEMPLATE_DOMAIN));?>

<p><?php printf(__('category: %s &nbsp;&nbsp;&nbsp; %s',TEMPLATE_DOMAIN), get_the_category_list(', '), get_the_tag_list(__('tags: '), ', ', ' ')); ?></p>

<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>






<div class="sociable">
<?php if(function_exists('wp_email')) { email_link(); } ?>
</div>
    </div>
    <!--
	<?php trackback_rdf(); ?>
	-->
  </div>

  <?php comments_template('',true); // Get wp-comments.php template ?>

  <?php endwhile; else: ?>
  <p>
    <?php _e('Sorry, no posts matched your criteria.',TEMPLATE_DOMAIN); ?>
  </p>
  <?php endif; ?>
  <p>
    <?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page',TEMPLATE_DOMAIN), __('Next Page &raquo;',TEMPLATE_DOMAIN)); ?>
  </p>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
