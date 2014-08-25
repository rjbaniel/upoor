<?php get_header(); ?>
<div id="main">

<!-- end header -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
<div class="main_title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></div>

<div class="main_post">

<?php the_content(__('<strong>&raquo; Continue Reading</strong>',TEMPLATE_DOMAIN)); ?></div>
<div class="main_feedback">
<?php the_time(__('F jS, Y'));?> <?php _e('at');?> <?php the_time() ?><?php the_tags( '&nbsp;' . __( 'and tagged',TEMPLATE_DOMAIN ) . ' ', ', ', ''); ?>&nbsp;|&nbsp;<?php comments_popup_link(__('Comments &amp; Trackbacks (0)',TEMPLATE_DOMAIN), __('Comments &amp; Trackbacks (1)',TEMPLATE_DOMAIN), __('Comments &amp; Trackbacks (%)',TEMPLATE_DOMAIN)); ?>&nbsp;|&nbsp;<a href="<?php the_permalink() ?>" rel="bookmark"><?php _e('Permalink',TEMPLATE_DOMAIN);?></a> </div>



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
