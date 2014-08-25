	<div id="sidebar">
	
		<ul>
			<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?> <!-- begin widget -->
			
			<!-- Author information is disabled per default. Uncomment and fill in your details if you want to use it.
			<li><h2>Author</h2>
			<p>A little something about you, the author. Nothing lengthy, just an overview.</p>
			</li>
			-->

			

			<?php wp_list_pages('title_li=<h2>'.__('Pages').'</h2>' ); ?>

			<li><h2><?php _e('Archives',TEMPLATE_DOMAIN);?></h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>

			<li><h2><?php _e('Categories',TEMPLATE_DOMAIN);?></h2>
				<ul>
				<?php wp_list_categories('sort_column=name&optioncount=1&hierarchical=0'); ?>
				</ul>
			</li>

			<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>				
				<?php wp_list_bookmarks(); ?>
				
				<li><h2><?php _e('Meta',TEMPLATE_DOMAIN);?></h2>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
			 
					<li><a href="http://gmpg.org/xfn/"><abbr title="<?php _e('XHTML Friends Network');?>">XFN</abbr></a></li>

					<?php wp_meta(); ?>
				</ul>
				</li><?php } ?>
				<li>
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
			</li>
<?php endif; ?> <!-- end widget -->
			</ul>
			
		
	</div>

