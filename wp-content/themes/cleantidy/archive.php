<?php get_header(); ?>





<div id="recent">


<div class="container">


<div class="recent-post">


	


	<?php if (have_posts()) : ?>





<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>


<?php /* If this is a category archive */ if (is_category()) { ?>


<h2 class="yellow"><?php echo single_cat_title(); ?> <?php _e('category archive','cleantidy'); ?> </h2>





<?php /* If this is a daily archive */ } elseif (is_day()) { ?>


<h2 class="yellow"><?php the_time(__('F jS, Y')); ?> <?php _e('Archive','cleantidy');?></h2>





<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>


<h2 class="yellow"><?php the_time('F, Y'); ?><?php _e('Archive','cleantidy');?></h2>





<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>


<h2 class="yellow"><?php the_time('Y'); ?> <?php _e('Archive','cleantidy');?></h2>





<?php /* If this is a search */ } elseif (is_search()) { ?>


<h2 class="yellow"><?php _e('Search Results','cleantidy');?></h2>





<?php /* If this is an author archive */ } elseif (is_author()) { ?>


<h2 class="yellow"><?php _e('Author Archive','cleantidy');?></h2>





<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>


<h2 class="yellow"><?php _e('Blog Archives','cleantidy');?></h2>





<?php } ?>


	





</div><div class="clear"></div>


</div>


</div>





<div id="posts">


	<div class="container">


	<div class="recent-post">





<?php while (have_posts()) : the_post(); ?>


<!-- BEGIN post -->


<div class="post" id="post-<?php the_ID(); ?>">
<h2 class="post-title"><a href="<?php the_permalink() ?>" title="<?php _e('Permanent Link to','cleantidy');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
<small><?php the_time(__('F jS, Y')) ?> | <?php the_category(', ') ?> | <?php comments_popup_link(__('No comments','cleantidy'), __('1 comment','cleantidy'), __('% comments','cleantidy'), __('Comments are off for this post','cleantidy') ); ?>&nbsp;&nbsp;&nbsp; <?php edit_post_link(__('Edit this post','cleantidy')); ?> </small>
<div class="post-body">
<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt(__('Continue reading','cleantidy')); ?>
</div>
</div>


<?php endwhile; ?>


<!-- END post -->





<div class="content-navigate clearfix">


<span class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries','cleantidy')) ?></span>


<span class="alignright"><?php previous_posts_link(__('Next Entries &raquo;','cleantidy')) ?></span>


</div>





<?php else : ?>





<h3><?php _e('Not Found','cleantidy');?></h3>


<?php include (TEMPLATEPATH . '/searchform.php'); ?>





<?php endif; ?>





</div>


<?php get_sidebar(); ?>


</div>


<div class="clear"></div>


</div>





<?php get_footer(); ?>
