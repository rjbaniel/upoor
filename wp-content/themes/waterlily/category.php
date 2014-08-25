<?php get_header(); ?>

<div id="main">

<h4><?php single_cat_title(__('&raquo; Currently browsing: ',TEMPLATE_DOMAIN)); ?></h4><br />
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
<div class="archive_title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></div>

<div class="main_post">
<?php the_excerpt(__('Continue Reading &raquo;',TEMPLATE_DOMAIN)); ?><br />
<?php _e('Posted at:',TEMPLATE_DOMAIN);?> <?php the_time('F jS, Y - g:i a');?> - <?php comments_popup_link(__('Number of Comments &raquo; 0',TEMPLATE_DOMAIN), __('Number of Comments &raquo; 1',TEMPLATE_DOMAIN), __('Number of Comments &raquo; %',TEMPLATE_DOMAIN)); ?><hr />
</div>



<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.',TEMPLATE_DOMAIN); ?></p>
<?php endif; ?>
<div class="navi" align="right"><?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page',TEMPLATE_DOMAIN), __('Next Page &raquo;',TEMPLATE_DOMAIN)); ?></div>

</div> 


<div id="menu">
<?php get_sidebar(); ?>
</div>

</div>
<div class="clearfix"></div>
<div id="footer"><?php get_footer(); ?></div>
</div>

</body>
</html>
