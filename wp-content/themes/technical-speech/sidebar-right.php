				<div id="rightsidebar">
				 	<?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('right') ) : ?>
					<?php if(!is_front_page()) : ?>
					<div class="widgetbox2">
						<div class="boxheading"><span><?php _e('Popular Posts', 'technical-speech'); ?></span><div class="clear"></div><div class="left"></div></div>
						<div class="widgetwrap">
							<ul>
      							<?php popularPosts('place=sidebar&count=8'); ?>
    						</ul>
						</div>
					</div>
					<div class="widgetbox2">
						<div class="boxheading"><span><?php _e('Recent Posts', 'technical-speech'); ?></span><div class="clear"></div><div class="left"></div></div>
						<div class="widgetwrap">
							<ul>
      							<?php
	   								$postslist = get_posts('numberposts=8&order=DSC&orderby=date');
	                            	foreach ($postslist as $post) :
	                           		setup_postdata($post);
	 							?>
      							<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
     							<?php endforeach; ?>
    						</ul>
						</div>
					</div>
					<?php endif; ?>
					<div class="widgetbox2">
						<div class="boxheading"><span><?php _e('Recent Comments', 'technical-speech'); ?></span><div class="clear"></div><div class="left"></div></div>
						<div class="widgetwrap">
							<?php get_recent_comments(); ?>
						</div>
					</div>
					<?php wp_list_bookmarks('title_before=<div class="boxheading"><span>& title_after=</span><div class="clear"></div><div class="left"></div></div><div class="widgetwrap">& category_before=<div class="widgetbox2">& category_after=</div></div>'); ?>
					<?php endif; ?>
				</div>
