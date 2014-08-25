<?php get_header(); ?>
				<div id="content">
					<div class="contentbox">
						<?php if (have_posts()) : ?>
							<div class="boxheading"><span>Latest Posts</span><div class="clear"></div><div class="left"></div></div>
							<?php while (have_posts()) : the_post(); ?>
								<div class="posts">
									<h6 class="postheading" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
									<?php the_excerpt(); ?>
									<a href="<?php the_permalink() ?>" class="readmorelink"><?php _e('Read More', 'technical-speech'); ?></a>
									<div class="postsmetadata">
										<?php _e('Category', 'technical-speech'); ?> : <?php the_category(', ') ?>.<br />
										<?php the_tags( 'Tags: ', ', ', '.<br />'); ?>
										<?php edit_post_link(__('Edit Post', 'technical-speech'), '', ''); ?>
									</div>
								</div>
								<div class="boxheading" style="font-size:0.9em"><span><?php _e('Posted on', 'technical-speech'); ?> <?php the_time('jS F Y') ?></span><span class="right"><?php comments_number(__('No Responses', 'technical-speech'), __('One Response', 'technical-speech'), __('% Responses', 'technical-speech') );?></span><div class="clear"></div><div class="left"></div></div>
							<?php endwhile; ?>
							<?php if (show_posts_nav()) : ?>
								<div class="postsnav"><span class="left"><?php next_posts_link(__('&laquo; Older Entries', 'technical-speech')) ?></span><span class="right"><?php previous_posts_link(__('Newer Entries &raquo;', 'technical-speech')) ?></span><div class="clear"></div></div>
							<?php endif; ?>
						<?php else : ?>
							<div class="boxheading"><span><?php _e('Error : Not Found', 'technical-speech'); ?></span><div class="clear"></div><div class="left"></div></div>
							<div class="posts">
								<p><?php _e("Sorry, but you are looking for something that isn't here.", 'technical-speech'); ?></p>
								<?php get_search_form(); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
<?php get_sidebar('block'); ?>
<?php get_sidebar('right'); ?>
<?php get_sidebar('left'); ?> 
<?php get_footer(); ?>
