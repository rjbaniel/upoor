<?php get_header(); ?>

<div id="main">

<!-- end header -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
<h1 class="main_title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h1>

<div class="main_post">

<?php the_content(); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>

</div>


<?php endwhile; ?>

<?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>

<?php else: ?>
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
