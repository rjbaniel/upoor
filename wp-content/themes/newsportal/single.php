<?php get_header(); ?>

<?php get_sidebar(); ?>



  <div id="content">
  
 


  
  <!-- begin content --><div id="first-time">
			
<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

<div class="post" id="post-<?php the_ID(); ?>">

<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',TEMPLATE_DOMAIN);?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>

<p><?php the_time(__('F jS, Y')) ?> <?php _e('by',TEMPLATE_DOMAIN);?> <?php the_author_posts_link() ?> <?php the_tags( '' . __( 'and tagged',TEMPLATE_DOMAIN ) . ' ', ', ', ''); ?></p>

<div class="entry">

<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

<?php the_content(); ?>

<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>




</div>

<p class="info"><?php _e('Posted in ',TEMPLATE_DOMAIN);?> <?php the_category(', ') ?> <strong>|</strong> <?php edit_post_link(__('Edit',TEMPLATE_DOMAIN), '','<strong>|</strong>'); ?> <?php comments_popup_link(__('No Comments &raquo;',TEMPLATE_DOMAIN), __('1 Comment &raquo;',TEMPLATE_DOMAIN), __('% Comments &raquo;',TEMPLATE_DOMAIN)); ?></p>

</div>

<?php comments_template('',true); ?>

<?php endwhile; ?>

<p align="center"><?php next_posts_link(__('&laquo; Previous Entries',TEMPLATE_DOMAIN)) ?> <?php previous_posts_link(__('Next Entries &raquo;',TEMPLATE_DOMAIN)) ?></p>

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
