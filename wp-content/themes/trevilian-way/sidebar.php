	<div class="widget-block-wide">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Widget Block Wide') ) : ?>

			<div id="latest-post" class="widget widget_text">
			<h3><?php _e("Most Recent Post",TEMPLATE_DOMAIN); ?></h3>
			<?php
				$posts = get_posts("numberposts=1");
				foreach($posts as $post) : setup_postdata($post);
			?>
				<strong><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></strong>
				<?php the_excerpt(); ?>
			<?php
				endforeach;
			?>
			</div>
			
		<?php endif; ?>
	</div>

	<div class="widget-block">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Widget Block 1') ) : ?>
			
			<div id="recent-posts" class="widget widget_recent_entries">
			<h3><?php _e("Recent Posts",TEMPLATE_DOMAIN); ?></h3>
				<ul>
					<?php wp_get_archives('type=postbypost&limit=10'); ?>
				</ul>
			</div>				
			
		<?php endif; ?>
	</div>

	<div class="widget-block">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Widget Block 2') ) : ?>

			<div id="archives" class="widget widwp_get_archives">
			<h3><?php _e('Archives',TEMPLATE_DOMAIN);?></h3>
				<ul>
					<?php wp_get_archives('limit=12'); ?>
				</ul>
			</div>
			
		<?php endif; ?>
	</div>

	<div class="widget-block">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Widget Block 3') ) : ?>

			<div id="categories" class="widget widget_categories">
			<h3><?php _e('Categories');?></h3>	
				<ul>
					<?php wp_list_categories('show_count=1'); ?>
				</ul>
			</div>
			
		<?php endif; ?>
	</div>

	<span class="clearer"></span>