<!-- menu -->


	 <div id="menu">


	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('leftsidebar') ) : ?>


							


                           <h5><?php _e('Categories','bluebird');?></h5>


			<ul>


				<?php wp_list_categories('title_li='); ?>


			</ul>


						


			<p><span class="feedarea"></span><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS','bluebird'); ?>"> <?php _e('Grab my feed','bluebird');?></a>


			</p>


		    <div id="sidebarSearch">


						<div class="BlogSearch"><h5><?php _e('Quick search','bluebird');?></h5>


							<form id="searchform" method="get" action="<?php bloginfo('url'); ?>">


		<input type="text" name="s" id="s" size="20" value=""/></form>





						</div>


			</div>


			<h5><?php _e('Archives','bluebird');?></h5>


			<ul>


				<?php wp_get_archives('type=monthly'); ?>


			</ul>


			<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>


			<h5><?php _e('Links','bluebird');?></h5>


			<ul>


			<?php wp_list_bookmarks('title_li=0&categorize=0'); ?>


			</ul>


			<?php } ?>


	<?php endif; ?>


	</div>
