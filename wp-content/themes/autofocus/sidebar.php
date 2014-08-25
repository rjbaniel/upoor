	<div id="primary" class="sidebar">
				<ul class="xoxo">
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : // begin primary sidebar widgets ?>

			<li id="pages" class="widget">
				<h3><?php _e('Pages', 'sandbox') ?></h3>
				<ul>
<?php wp_list_pages('title_li=&sort_column=post_title&depth=1' ) ?>
				</ul>
			</li>
			
			<li id="search">
				<h3><label for="s"><?php _e('Search', 'sandbox') ?></label></h3>
				<form id="searchform" method="get" action="<?php bloginfo('url') ?>">
					<div>
						<input id="s" name="s" type="text" value="<?php echo esc_html(stripslashes($_GET['s']), true) ?>" size="10" tabindex="1" />
						<input id="searchsubmit" name="searchsubmit" type="submit" value="<?php _e('Find', 'sandbox') ?>" tabindex="2" />
					</div>
				</form>
			</li>


			<li id="categories" class="widget">
				<h3><?php _e('Categories', 'sandbox'); ?></h3>
				<ul>
<?php wp_list_categories('title_li=&hierarchical=1&use_desc_for_title=1') ?>

				</ul>
			</li>

			<li id="archives" class="widget">
				<h3><?php _e('Archives', 'sandbox') ?></h3>
				<ul>
<?php wp_get_archives('type=monthly') ?>

				</ul>
			</li>		
<?php endif; // end primary sidebar widgets  ?>
		</ul>
	</div><!-- #primary .sidebar -->

	<div id="secondary" class="sidebar">

		<ul class="xoxo">
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ) : // begin  secondary sidebar widgets ?>

			<li id="rss-links" class="widget">
				<h3><?php _e('Subscribe', 'sandbox') ?></h3>
				<ul>
					<li><a href="<?php bloginfo('rss2_url') ?>" title="<?php echo esc_html(get_bloginfo('name'), 1) ?> <?php _e('Posts RSS feed', 'sandbox'); ?>" rel="alternate" type="application/rss+xml"><?php _e('All posts', 'sandbox') ?></a></li>
					<li><a href="<?php bloginfo('comments_rss2_url') ?>" title="<?php echo esc_html(bloginfo('name'), 1) ?> <?php _e('Comments RSS feed', 'sandbox'); ?>" rel="alternate" type="application/rss+xml"><?php _e('All comments', 'sandbox') ?></a></li>
				</ul>
			</li>

			<li id="meta" class="widget">
				<h3><?php _e('Meta', 'sandbox') ?></h3>
				<ul>
					<?php wp_register() ?>

					<li><?php wp_loginout() ?></li>
					<?php wp_meta() ?>

				</ul>
			</li>
<?php endif; // end secondary sidebar widgets  ?>
		</ul>

	</div><!-- #secondary .sidebar -->
