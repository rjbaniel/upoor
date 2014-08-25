<?php get_header(); ?>

<?php get_sidebar(); ?>



  <div id="content">
  
    <div>
	
	</div>
        
    <div class="tabs"></div>
            <!-- begin content --><div id="first-time">
			
<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

<div class="post" id="post-<?php the_ID(); ?>">

<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',TEMPLATE_DOMAIN);?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>



<div class="entry">

<?php the_content(); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>

<?php edit_post_link(__('Edit',TEMPLATE_DOMAIN), '<p>','</p>'); ?>
</div>

</div>



<?php endwhile; ?>

<?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>

<?php else : ?>

<h2 align="center"><?php _e('Not Found',TEMPLATE_DOMAIN);?></h2>

<p align="center"><?php _e("Sorry, but you are looking for something that isn't here.",TEMPLATE_DOMAIN);?></p>

<?php endif; ?>
			
			
	  </div><!-- end content --> 

	  </div>

	  <?php get_footer(); ?>
</div>
</body>
</html>
