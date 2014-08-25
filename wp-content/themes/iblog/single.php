<?php get_header(); ?>
  <div id="content">
  
  <div class="post-nav"> <span class="previous"><?php previous_post_link('%link') ?></span> <span class="next"><?php next_post_link('%link') ?></span></div>
  
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="post fix" id="post-<?php the_ID(); ?>">
		  <div class="date"><span><?php the_time('M') ?></span> <?php the_time('d') ?></div>
		  <div class="title">
          <h2  class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'iblog'); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
          <div class="postdata"><span class="category"><?php the_category(', ') ?></span> <span class="right mini-add-comment"><a href="#respond"><?php _e('Add comments', 'iblog'); ?></a></span></div>
		  </div>
          <div class="entry fix">
            <?php the_content(__('Continue reading &raquo;', 'iblog')); ?>
			<?php wp_link_pages(__('<p><strong>Pages:</strong> ', 'iblog'), '</p>', 'number'); ?>
			<?php edit_post_link(__('Edit', 'iblog'), '', ''); ?>
          </div><!--/entry -->
		
		<?php comments_template('', true); ?>
		</div><!--/post -->
		
			<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.', 'iblog'); ?></p>

<?php endif; ?>
</div></div><?php get_sidebar(); ?></div>

<?php echo iblog_footer_link(); ?>

</div><?php get_footer(); ?>
