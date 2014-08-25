<div id="sidebar2">

<ul>

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ) : ?>

<?php wp_list_bookmarks(); ?>



<li class="widget_pages"><h2><?php _e('Pages',TEMPLATE_DOMAIN);?></h2>

				<ul>

				<?php wp_list_pages2(); ?>

				</ul>

			</li>

						

			<li class="widget_meta"><h2><?php _e('Meta',TEMPLATE_DOMAIN);?></h2>

				<ul>

					<?php wp_register(); ?>

					<li><?php wp_loginout(); ?></li>



					<li><a href="http://gmpg.org/xfn/"><abbr title="<?php _e('XHTML Friends Network');?>">XFN</abbr></a></li>



					<?php wp_meta(); ?>

				</ul>

			</li>



<?php endif; ?>

		</ul>

	</div>

