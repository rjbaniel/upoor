<?php get_header(); ?>

<div id="main">
<h2>Search This Site:</h2><br />
<form method="get" action="<?php bloginfo('url');; ?>" />
<input type="text" name="s" id="s" />&nbsp;&nbsp;
<input type="submit" id="button" name="submit" value="<?php _e("Go!",TEMPLATE_DOMAIN); ?>" />
</form><br />
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="archive_title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></div>

<div class="main_post">
<?php the_excerpt(__('Continue Reading &raquo;')); ?><br />
<?php _e('Posted at:',TEMPLATE_DOMAIN);?> <?php the_time('F jS, Y - g:i a');?> - <?php comments_popup_link(__('Number of Comments &raquo; 0',TEMPLATE_DOMAIN), __('Number of Comments &raquo; 1',TEMPLATE_DOMAIN), __('Number of Comments &raquo; %',TEMPLATE_DOMAIN)); ?><hr />
</div>




<!--
	<?php trackback_rdf(); ?>
	-->



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
