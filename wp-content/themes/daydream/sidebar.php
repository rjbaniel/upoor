	<ul id="sidebar">

		<div id="sidebar_wrapper">

              	<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("daydream-160"); } ?>

		<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>
			
			<li id="categories"><h2><?php _e('Categories','daydream');?></h2>
				<ul>
				<?php wp_list_categories('sort_column=name&optioncount=1&hierarchical=0'); ?>
				</ul>
			</li>
			
			<li id="archives"><h2><?php _e('Archives','daydream');?></h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>
				
				<li id="meta"><h2><?php _e('Meta','daydream');?></h2>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<li><a href="http://gmpg.org/xfn/"><abbr title="<?php _e('XHTML Friends Network');?>">XFN</abbr></a></li>
					<?php wp_meta(); ?>
				</ul>
				</li>

		<?php endif; ?>
		
		<div style="clear: both;"></div>
		
		<!-- The search form stays, brother -->
		
		<li style="margin: 0;">
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
			</li>
			
		<div style="clear: both;"></div>
		
		</div>
			
	</ul>


