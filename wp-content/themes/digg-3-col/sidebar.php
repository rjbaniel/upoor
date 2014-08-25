<!-- Start Sidebar -->





	<div class="sidebar">


<ul>





<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : else : ?>





	<li><h2><?php _e('Calendar','digg-3-col'); ?></h2>


		<ul>


			<li><?php get_calendar(); ?></li>


		</ul>


	</li>





	<?php wp_list_bookmarks(); ?>





<?php endif; ?>





	<li><h2><?php _e('Meta'); ?></h2>


		<ul>


			<?php wp_register(); ?>


			<li><?php wp_loginout(); ?></li>





			<li><a href="http://gmpg.org/xfn/"><abbr title="<?php _e('XHTML Friends Network');?>">XFN</abbr></a></li>


			<?php wp_meta(); ?>


		</ul>


	</li>





</ul>


	</div>





<!-- End Sidebar -->
