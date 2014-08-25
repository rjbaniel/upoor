<div class="barmenuleft">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Top Left') ) : ?>
            <h3><?php _e('Pages',TEMPLATE_DOMAIN);?></h3>
			<ul>
			<li><a href="<?php bloginfo('url'); ?>"><?php _e('Home',TEMPLATE_DOMAIN);?></a></li>
			<?php wp_list_pages('sort_column=menu_order&title_li='); ?>
			</ul>
			<?php endif; ?>
		</div>
        <div class="barmenuright">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Top Right') ) : ?>
            <h3><?php _e('Categories',TEMPLATE_DOMAIN); ?></h3>
            <ul>
            <?php wp_list_categories(); ?>
            </ul>
			<?php endif; ?>
        </div>
