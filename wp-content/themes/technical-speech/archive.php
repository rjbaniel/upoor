<?php get_header(); ?>
				<div id="content">
					<div class="contentbox">
						<?php if (have_posts()) : ?>
						
							<?php $archead = __('Blog Archives', 'technical-speech'); ?>
							<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  						<?php /* If this is a category archive */ if (is_category()) { ?>
							<?php $archead = single_cat_title('',false); ?>
 	  						<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
							<?php $archead = single_tag_title('',false); ?>
 	  						<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
							<?php $archead = get_the_time('F jS, Y'); ?>
 	  						<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
							<?php $archead = get_the_time('F, Y'); ?>
 	 						<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
							<?php $archead = get_the_time('Y'); ?>
	  						<?php /* If this is an author archive */ } elseif (is_author()) { ?>
							<?php $archead = __('Author Archive', 'technical-speech'); ?>
 	  						<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
							<?php $archead = __('Blog Archives', 'technical-speech'); ?>
 	  						<?php } ?>

							<div class="boxheading"><span><?php echo $archead; ?></span><div class="clear"></div><div class="left"></div></div>
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
								<div class="boxheading" style="font-size:0.9em"><span><?php _e('Posted on', 'technical-speech'); ?> <?php the_time('jS F Y') ?></span><span class="right"><?php comments_popup_link(__('No Comments', 'technical-speech'), __('1 Comment', 'technical-speech'), __('% Comments', 'technical-speech') ); ?></span><div class="clear"></div><div class="left"></div></div>
							<?php endwhile; ?>
							<?php if (show_posts_nav()) : ?>
								<div class="postsnav"><span class="left"><?php next_posts_link(__('&laquo; Older Entries', 'technical-speech')) ?></span><span class="right"><?php previous_posts_link(__('Newer Entries &raquo;', 'technical-speech') ) ?></span><div class="clear"></div></div>
							<?php endif; ?>
						<?php else : ?>
							<div class="boxheading"><span><?php _e('Error : Not Found', 'technical-speech'); ?></span><div class="clear"></div><div class="left"></div></div>
							<div class="posts">
								<div class="not_found" >
								<?php
								if ( is_category() ) { // If this is a category archive
									printf(__("Sorry, but there aren't any posts in the %s category yet.", 'technical-speech'), single_cat_title('',false));
								} else if ( is_date() ) { // If this is a date archive
									echo(__("Sorry, but there aren't any posts with this date.", 'technical-speech'));
								} else if ( is_author() ) { // If this is a category archive
									$userdata = get_userdatabylogin(get_query_var('author_name'));
									printf(__("Sorry, but there aren't any posts by %s yet.", 'technical-speech'), $userdata->display_name);
								} else {
									echo(__("No posts found.", 'technical-speech'));
								}			
								?>
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
