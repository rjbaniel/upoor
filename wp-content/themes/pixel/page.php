<?php get_header(); ?>

<div id="main">

<div id="contentwrapper">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<div class="topPost">
  <h2 class="topTitle"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
  <div class="topContent"><?php the_content(); ?></div>
  <div class="cleared"></div>
  <span class="linkpages"><?php wp_link_pages(); ?></span>
<div class="cleared"></div>
</div> <!-- Closes topPost -->


<?php endwhile; ?>
<?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>  
<?php else : ?>

<div class="topPost">
    <h2 class="topTitle"><a href="<?php the_permalink() ?>"><?php _e('Not Found', 'pixel'); ?></a></h2>
  <div class="topContent"><p><?php _e("Sorry, but you are looking for something that isn't here. You can search again by using", 'pixel'); ?> <a href="#searchform"><?php _e('this form', 'pixel'); ?></a>...</p></div>
</div> <!-- Closes topPost -->

<?php endif; ?>

</div> <!-- Closes contentwrapper-->


<?php get_sidebar(); ?>
<div class="cleared"></div>

</div><!-- Closes Main -->


<?php get_footer(); ?>
