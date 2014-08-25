<?php get_header(); ?>



<div id="content" class="narrowcolumn">

  <?php if (have_posts()) : ?>

  <h2 class="pagetitle"><?php _e('Search Results','dignity');?></h2>

  <div class="navigation">

    <div class="alignleft">

      <?php next_posts_link(__('&larr; Previous Entries','dignity')) ?>

    </div>

    <div class="alignright">

      <?php previous_posts_link(__('Next Entries &rarr;','dignity')) ?>

    </div>

    <br class="clear" />

  </div>

  <?php while (have_posts()) : the_post(); ?>

  <div class="post">

    <h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','dignity');?> <?php the_title(); ?>">

      <?php the_title(); ?>

      </a></h2>

    <p class="postmetadata"><span class="timr"><?php _e('Published','dignity'); ?>

      <?php the_time(__('F jS, Y')) ?>

      </span>

      <!-- by <?php the_author() ?> -->

	  <?php _e('in','dignity'); ?>

      <span class="catr">

      <?php the_category(', ') ?>

      </span> |

      <?php edit_post_link(__('Edit','dignity'), '<span class="editr">', ' | </span>'); ?>

      <span class="commr">

      <?php comments_popup_link(__('No Comments &#187;','dignity'), __('1 Comment &#187;','dignity'), __('% Comments &#187;','dignity')); ?>

      </span></p>

         <?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>

  </div>

  <?php endwhile; ?>

  <div class="navigation">

    <div class="alignleft">

      <?php next_posts_link(__('&larr; Previous Entries','dignity')) ?>

    </div>

    <div class="alignright">

      <?php previous_posts_link(__('Next Entries &rarr;','dignity')) ?>

    </div>

  </div>

  <?php else : ?>

  <h2 class="center"><?php _e('No posts found. Try a different search?','dignity');?></h2>

  <?php include (TEMPLATEPATH . '/searchform.php'); ?>

  <?php endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

