<?php get_header(); ?>
				<div id="content">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="contentbox" id="post-<?php the_ID(); ?>">
						<div class="boxheading" style="font-size:0.9em"><span><?php _e('Posted on', 'technical-speech'); ?> <?php the_time('jS F Y') ?> </span><span class="right"><?php comments_number(__('No Responses', 'technical-speech'), __('One Response', 'technical-speech'), __('% Responses', 'technical-speech') );?></span><div class="clear"></div><div class="left"></div></div>
						<div class="posts">
							<h6 class="postheading"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
							<?php the_content(__('<p>Read the rest of this entry &raquo;</p>', 'technical-speech')); ?>
							<?php wp_link_pages(array('before' => '<div class="postspagination">Pages: ', 'after' => '</div>', 'next_or_number' => 'number')); ?>
							<?php edit_post_link(__('Edit this entry.', 'technical-speech'), '<div class="postsmetadata">', '</div>'); ?>
						</div>
					</div>
					<?php comments_template(); ?>
					<?php endwhile; endif; ?>
				</div>
<?php get_sidebar('block'); ?>
<?php get_sidebar('right'); ?>
<?php get_sidebar('left'); ?> 
<?php get_footer(); ?>
