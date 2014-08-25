				<div id="sidebar">
					<?php global $tp_large_head; ?>
					<?php if ($tp_large_head == "true") : ?>
					<div class="widgetbox-large" id="search-left">
						<div class="boxheading"><span><?php _e('Search', 'technical-speech'); ?></span><div class="clear"></div><div class="left"></div></div>
						<div class="widgetwrap-large" id="side_search">
							<form action="<?php bloginfo('url')?>" method="get" name="search">
								<input name="s" type="text" value="<?php echo esc_html($s, 1); ?>"/>
								<a href="#"><?php _e('Search', 'technical-speech'); ?></a>
								<div class="clear"></div>
							</form>
						</div>
					</div>
					<?php endif; ?>
					<?php global $tp_f_display; ?>
					<?php if($tp_f_display != "true") : ?>
					<?php global $tp_f_post; ?>
						<?php
	  						$postslist = get_posts('numberposts=1&order=DSC&orderby=date');
	  						foreach ($postslist as $post) :
	  						setup_postdata($post);
							$fp_pl = get_the_ID();
							endforeach;
	 					?>
					<?php if ($tp_f_post){$fpostname = "name=".$tp_f_post."&showposts=1";}else{$fpostname = "p=".$fp_pl."&showposts=1";} ?>
					<?php query_posts($fpostname); if ( have_posts() ) : while ( have_posts() ) : the_post();?>
					<div class="widgetbox-large">
						<div class="boxheading"><span><?php _e('Featured Post', 'technical-speech'); ?></span><div class="clear"></div><div class="left"></div></div>
						<div class="widgetwrap-large">
							<div class="fp_wrap">
								<h6><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h6>
								<?php the_excerpt(); ?>
								<a href="<?php the_permalink() ?>" class="readmorelink"><?php _e('Read More', 'technical-speech'); ?></a>
							</div>
							<div class="postsmetadata" style="font-size:0.8em;">
								<?php _e('Category', 'technical-speech'); ?> : <?php the_category(', ') ?>.<br />
								<?php the_tags( 'Tags: ', ', ', '.<br />'); ?>
								<?php _e('Posted on', 'technical-speech'); ?> <?php the_time('jS F Y') ?>.<br />
								<?php comments_number(__('No Responses', 'technical-speech'), __('One Response', 'technical-speech'), __('% Responses', 'technical-speech') );?>
							</div>
						</div>
					</div>
					<?php endwhile; endif; wp_reset_query();?>
					<?php endif; ?>
					<?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('block') ) : ?>
					<?php endif; ?>
				</div>
