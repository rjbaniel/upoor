 <!-- begin sidebar -->

		<div id="colThree">
		<?php if ( !function_exists('dynamic_sidebar')
			|| !dynamic_sidebar() ) : ?>
		<ul>
		<form id="searchform" method="get" action="<?php bloginfo('url'); ?>/index.php">
        <div> 
          <input type="text" name="s" size="18" />
          <input type="submit" id="submit" name="Submit" value="<?php _e('Search');?>" />
        </div>
      </form>
		</ul>
		<h2><?php _e('Categories');?></h2>
		<ul>
		<?php wp_list_categories(0, '', 'name', 'asc', '', 1, 0, 1, 1, 1, 1, 0,'','','','','') ?>
		</ul>
		<h2><?php _e('Archives');?></h2>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>
		<ul>
			<?php wp_list_bookmarks(); ?>
		</ul>
		<?php endif; ?>
	</div>
<!-- end sidebar -->
