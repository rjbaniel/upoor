<?php get_header(); ?>

<div id="main">

<div id="contentwrapper">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<div class="topPost">
  <h2 class="topTitle"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
  <p class="topMeta"><?php _e('by', 'pixel'); ?> <?php the_author_posts_link(); ?> <?php _e('on', 'pixel'); ?> <?php the_time('M.d, Y') ?>, <?php _e('under', 'pixel'); ?> <?php the_category(', '); ?></p>
  <div class="topContent"><?php the_content(__('(continue reading...)', 'pixel')); ?></div>
  <span class="topComments"><?php comments_popup_link(__('Leave a Comment', 'pixel'), __('1 Comment', 'pixel'), __('% Comments', 'pixel')); ?></span>
  <span class="topTags"><?php the_tags('<em>:</em>', ', ', ''); ?></span>
  <span class="topMore"><a href="<?php the_permalink() ?>"><?php _e('more...', 'pixel'); ?></a></span>
<div class="cleared"></div>
</div> <!-- Closes topPost -->
<br/><small><?php edit_post_link(__('Edit this entry?', 'pixel'),'',''); ?></small>

<div id="comments">
<?php if (function_exists('wp_list_comments')): ?>
<!-- WP 2.7 and above -->
<?php comments_template('', true); ?>

<?php else : ?>
<!-- WP 2.6 and below -->
<?php comments_template(); ?>
<?php endif; ?>
</div> <!-- Closes Comment -->

<div id="extrastuff">
<span id="rssleft"><?php post_comments_feed_link(__('<abbr title="Really Simple Syndication">RSS</abbr> feed for this post (comments)', 'pixel')); ?></span>

<span id="trackright"><?php if ( pings_open() ) : ?> &#183; <a href="<?php trackback_url() ?>" rel="trackback"><?php _e('TrackBack <abbr title="Uniform Resource Identifier">URI</abbr>', 'pixel'); ?></a><?php endif; ?></span>
<div class="cleared"></div>
</div>

<?php endwhile; ?>

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
