<?php get_header(); ?>
				<div id="content">
					<?php global $tp_about_display; ?>
					<?php if ($tp_about_display != "true") : ?>
					<div class="contentbox">
						<div class="boxheading"><span><?php echo $tp_about_title; ?></span><div class="clear"></div><div class="left"></div></div>
						<div class="blockborder-all">
							<?php global $tp_about_avatar; ?>
							<?php if ($tp_about_avatar != "true") : ?>
							<img class="alignleft" src="<?php bloginfo('template_directory'); ?>/images/about_avatar.jpg" alt="about" width="120" height="120" />
							<?php endif; ?>
							<p><?php echo $tp_about_text; ?></p>
							<div class="clear"></div>
						</div>
					</div>
					<?php endif; ?> 
					<div class="contentbox">
						<div class="boxheading"><span><?php _e('Popular Posts', 'technical-speech'); ?></span><div class="clear"></div><div class="left"></div></div>
						<div class="blockborder" id="pop_border">
							<?php popularPosts(); ?>
							<div class="clear"></div>
						</div>
					</div>
					<div class="contentbox">
						<div class="boxheading"><span><?php _e('Recent Posts', 'technical-speech'); ?></span><div class="clear"></div><div class="left"></div></div>
						<div class="blockborder" id="rcp_border">
							<?php
	  							$postslist = get_posts('numberposts=3&order=DSC&orderby=date');
	  							foreach ($postslist as $post) :
	  							setup_postdata($post);
	 						?>
							<div class="postblock">
								<div class="postblockwrap">
									<h6><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
									<?php the_excerpt(); ?>
									<a href="<?php the_permalink() ?>" class="readmorelink"><?php _e('Read More', 'technical-speech'); ?></a>
								</div>
							</div>
							<?php endforeach; ?>
							<div class="clear"></div>
						</div>
					</div>
				</div>
<?php get_sidebar('block'); ?>
<?php get_sidebar('right'); ?>
<?php get_sidebar('left'); ?>
<?php get_footer(); ?>
