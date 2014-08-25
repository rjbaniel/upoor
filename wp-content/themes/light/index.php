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

    <?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<p><?php printf(__('category: %s &nbsp;&nbsp;&nbsp; %s',TEMPLATE_DOMAIN), get_the_category_list(', '), get_the_tag_list(__('tags: '), ', ', ' ')); ?></p>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

<?php the_content(__('Read more &raquo;',TEMPLATE_DOMAIN));?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<p><?php printf(__('category: %s &nbsp;&nbsp;&nbsp; %s',TEMPLATE_DOMAIN), get_the_category_list(', '), get_the_tag_list(__('tags: '), ', ', ' ')); ?></p>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } ?>





<div class="sociable">
<?php if(function_exists('wp_email')) { email_link(); } ?>
</div>
    </div>
    <!--
	<?php trackback_rdf(); ?>
	-->
  </div>


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
