<?php get_header(); ?>

<div id="main">

<!-- end header -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
<h1 class="main_title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>

<div class="main_post">


<?php the_content(); ?></div>

<div class="main_feedback">
<?php _e("Posted by",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link(); ?> <?php _e("on",TEMPLATE_DOMAIN); ?> <?php the_time(__('F jS, Y'));?> <?php _e('at',TEMPLATE_DOMAIN);?> <?php the_time() ?><?php the_tags( '&nbsp;' . __( 'and tagged',TEMPLATE_DOMAIN ) . ' ', ', ', ''); ?>&nbsp;|&nbsp;<?php comments_popup_link(__('Comments &amp; Trackbacks (0)',TEMPLATE_DOMAIN), __('Comments &amp; Trackbacks (1)',TEMPLATE_DOMAIN), __('Comments &amp; Trackbacks (%)',TEMPLATE_DOMAIN)); ?></div>


<br /><br />
<!--
	<?php trackback_rdf(); ?>
	-->
<?php comments_template('',true); // Get wp-comments.php template ?>


<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.',TEMPLATE_DOMAIN); ?></p>
<?php endif; ?>

</div> 


<div id="sidebar">
<?php get_sidebar(); ?>
</div>

</div>
<div id="frame2"><div id="footer"><?php get_footer(); ?></div></div>
</div>

</body>
</html>
