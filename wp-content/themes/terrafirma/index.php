<?php get_header();?>
		<div id="content">		
			<!-- primary content start -->
			<?php if ($posts) {
				if (get_option('terrafirma_asideid') != "")
					$AsideId = get_option('terrafirma_asideid');
				function stupid_hack($str)
				{
					return preg_replace('|</ul>\s*<ul class="asides">|', '', $str);
				}
				ob_start('stupid_hack');
				foreach($posts as $post)
				{
					the_post();
				?>
				<?php if ( isset($AsideId) && in_category($AsideId) ) : ?>
					<ul class="asides">
						<li id="p<?php the_ID(); ?>">
							<?php echo wptexturize($post->post_content); ?>
							<br/>
							<?php comments_popup_link('(0)', '(1)','(%)')?>  | <a href="<?php the_permalink(); ?>" title="<?php _e("Permalink:",TEMPLATE_DOMAIN); ?> <?php echo wptexturize(strip_tags(stripslashes($post->post_title), '')); ?>" rel="bookmark">#</a> <?php edit_post_link('(edit)'); ?>
						</li>						
					</ul>
					<?php else: // If it's a regular post or a permalink page ?>
						<div class="post" id="post-<?php the_ID(); ?>">
							<div class="header">
								<div class="date"><em class="user"><?php the_author_posts_link() ?></em> <br/><em class="postdate"><?php the_time('M jS, Y') ?></em></div>
			<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e("Permanent Link to",TEMPLATE_DOMAIN); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>
							</div>
							<div class="entry">
								<?php the_content(__('Continue Reading &raquo;',TEMPLATE_DOMAIN)); ?>
								<?php wp_link_pages(); ?>
                                <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
                <p class="post-tags">
                  <?php if (function_exists('the_tags')) the_tags(__('Tags: ',TEMPLATE_DOMAIN), ', ', '<br/>'); ?>
                </p>

							</div>
							<div class="footer">
								<ul>
			 <li class="readmore"><?php the_category(' , ') ?> <?php edit_post_link(__('Edit',TEMPLATE_DOMAIN)); ?></li>
			<li class="comments"><?php comments_popup_link(__('No Comments yet',TEMPLATE_DOMAIN), __('One Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN) ); ?></li>
								</ul>
							</div>
						</div>
					<?php endif; // end if in category ?>
				<?php
				}
			}
			else
			{
				echo __('<p>Sorry, No Posts matched your criteria.</p>',TEMPLATE_DOMAIN);
			}
		?>
		<p align="center"><?php posts_nav_link(' - ', __('&#171; Newer Entries',TEMPLATE_DOMAIN), __('Older Entries &#187;',TEMPLATE_DOMAIN) ) ?></p>
		<!-- primary content end -->	
		</div>		
	<?php get_sidebar();?>	
<?php get_footer();?>
