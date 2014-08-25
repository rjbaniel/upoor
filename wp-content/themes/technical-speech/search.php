<?php get_header(); ?>
				<div id="content">
					<div class="contentbox">
						<?php $archead = esc_html($s, 1);?>
						<?php if (have_posts()) : ?>
							<div class="boxheading"><span><?php _e('Search Results for', 'technical-speech'); ?> &quot;<?php echo $archead; ?>&quot;</span><div class="clear"></div><div class="left"></div></div>
							<?php while (have_posts()) : the_post(); ?>
								<div class="posts">
									<h6 class="postheading" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
									<?php the_excerpt(); ?>
									<a href="<?php the_permalink() ?>" class="readmorelink"><?php _e('Read More', 'technical-speech'); ?></a>
									<div class="postsmetadata">
										<?php _e('Category', 'technical-speech'); ?> : <?php the_category(', ') ?>.<br />
										<?php the_tags( 'Tags: ', ', ', '.<br />'); ?>
										<?php edit_post_link('Edit Post', '', ''); ?>
									</div>
								</div>
								<div class="boxheading" style="font-size:0.9em"><span><?php _e('Posted on', 'technical-speech'); ?> <?php the_time('jS F Y') ?></span><span class="right"><?php comments_popup_link(__('No Comments', 'technical-speech'), __('1 Comment', 'technical-speech'), __('% Comments', 'technical-speech') ); ?></span><div class="clear"></div><div class="left"></div></div>
							<?php endwhile; ?>
							<?php if (show_posts_nav()) : ?>
								<div class="postsnav"><span class="left"><?php next_posts_link(__('&laquo; Older Entries', 'technical-speech')) ?></span><span class="right"><?php previous_posts_link(__('Newer Entries &raquo;', 'technical-speech') ) ?></span><div class="clear"></div></div>
							<?php endif; ?>
						<?php else : ?>
							<div class="boxheading"><span><?php _e('Search Results for', 'technical-speech'); ?> &quot;<?php echo $archead; ?>&quot;</span><div class="clear"></div><div class="left"></div></div>
								<div class="posts">
								<div class="not_found" ><?php _e('No posts found. Try a different search?', 'technical-speech'); ?>
								</div>
								<?php get_search_form(); ?>
								</div>
						<?php endif; ?>
					</div>
				</div>
<?php get_sidebar('block'); ?>
<?php get_sidebar('right'); ?>
<?php get_sidebar('left'); ?> 
<?php get_footer(); ?>				
