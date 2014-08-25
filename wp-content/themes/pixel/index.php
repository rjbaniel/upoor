<?php get_header(); ?>

<div id="main">

<div id="contentwrapper">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<?php if (function_exists('wp_list_comments')): ?>
<div <?php post_class('topPost'); ?>>

<?php else : ?>
<div class="topPost">
<?php endif; ?>

 <h2 class="topTitle"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
  <p class="topMeta"><?php _e('by', 'pixel'); ?> <?php the_author_posts_link(); ?> <?php _e('on', 'pixel'); ?> <?php the_time('M.d, Y') ?>, <?php _e('under', 'pixel'); ?> <?php the_category(', '); ?></p>
  <div class="topContent"><?php the_content(__('(continue reading...)', 'pixel')); ?></div>
  <span class="topComments"><?php comments_popup_link(__('Leave a Comment', 'pixel'), __('1 Comment', 'pixel'), __('% Comments', 'pixel')); ?></span>
  <span class="topTags"><?php the_tags('<em>:</em>', ', ', ''); ?></span>
  <span class="topMore"><a href="<?php the_permalink() ?>"><?php _e('more...', 'pixel'); ?></a></span>
<div class="cleared"></div>
</div> <!-- Closes topPost --><br/>

<?php endwhile; ?>

<?php else : ?>

<div class="topPost">
    <h2 class="topTitle"><a href="<?php the_permalink() ?>"><?php _e('Not Found', 'pixel'); ?></a></h2>
  <div class="topContent"><p><?php _e("Sorry, but you are looking for something that isn't here. You can search again by using", 'pixel'); ?> <a href="#searchform"><?php _e('this form', 'pixel'); ?></a>...</p></div>
</div> <!-- Closes topPost -->

<?php endif; ?>

<div id="nextprevious">
<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'pixel')) ?></div>
<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'pixel')) ?></div>
<div class="cleared"></div>
</div>
</div> <!-- Closes contentwrapper-->



<?php get_sidebar(); ?>
<div class="cleared"></div>

</div><!-- Closes Main -->


<?php get_footer(); ?>
