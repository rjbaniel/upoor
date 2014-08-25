<?php get_header(); ?>

      <div id="content">

	<?php if (have_posts()) : ?>
	
		<?php while (have_posts()) : the_post(); ?>

        <div class="post" id="post-<?php the_ID(); ?>">
		  <div class="date"><span><?php the_time('M') ?></span> <?php the_time('d') ?></div>
		  <div class="title">
          <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'iblog'); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
          <div class="postdata"><span class="category"><?php the_category(', ') ?></span> <span class="comments"><?php comments_popup_link(__('No Comments &#187;', 'ibog'), __('1 Comment &#187;', 'iblog'), __('% Comments &#187;', 'iblog') ); ?></span></div>
		  </div>
          <div class="entry">
            <?php the_excerpt(); ?>
          </div><!--/entry -->
        </div><!--/post -->

		<?php endwhile; ?>
		
        <div class="page-nav"> <span class="previous-entries"><?php next_posts_link(__('Previous Entries', 'iblog')) ?></span> <span class="next-entries"><?php previous_posts_link(__('Next Entries', 'iblog')) ?></span></div><!-- /page nav -->

	<?php else : ?>

		<h2><?php _e('Nothing Found', 'iblog'); ?></h2>
		<p><?php _e('Please try another search.', 'iblog'); ?></p>

	<?php endif; ?>
</div></div><?php get_sidebar(); ?></div>

<?php echo iblog_footer_link(); ?>

</div><?php get_footer(); ?>
