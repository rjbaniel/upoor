	<div id="sidebar">
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("18090linkunitshadow"); } ?>
		<ul>
			<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>
			<li>
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
			</li>

			<!-- Author information is disabled per default. Uncomment and fill in your details if you want to use it.
			<li><h2><?php _e('Author'); ?></h2>
			<p>A little something about you, the author. Nothing lengthy, just an overview.</p>
			</li>
			-->

			<li>
			<?php /* If this is a category archive */ if (is_category()) { ?>
			<p><?php _e('You are currently browsing the archives for the', 'batavia');?> <?php single_cat_title(''); ?> <?php _e('category.', 'batavia');?></p>

			<?php /* If this is a yearly archive */ } elseif (is_day()) { ?>
			<p><?php _e('You are currently browsing the', 'batavia');?> <a href="<?php echo get_option('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives', 'batavia');?>
			<?php _e('for the day');?> <?php the_time('l, F jS, Y'); ?>.</p>
			
			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<p><?php _e('You are currently browsing the', 'batavia');?> <a href="<?php echo get_option('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives', 'batavia');?>
			for <?php the_time('F, Y'); ?>.</p>

      <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<p><?php _e('You are currently browsing the', 'batavia');?> <a href="<?php echo get_option('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives', 'batavia');?>
			<?php _e('for the year');?> <?php the_time('Y'); ?>.</p>
			
		 <?php /* If this is a monthly archive */ } elseif (is_search()) { ?>
			<p><?php _e('You have searched the', 'batavia');?> <a href="<?php echo get_option('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives', 'batavia');?>
			<?php _e('for');?> <strong>'<?php echo esc_html($s); ?>'</strong>. <?php _e('If you are unable to find anything in these search results, you can try one of these links.', 'batavia');?></p>

			<?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<p><?php _e('You are currently browsing the', 'batavia');?> <a href="<?php echo get_option('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives', 'batavia');?>.</p>

			<?php } ?>
			</li>

    <ul>
      <li id="calendar"> 
        <?php get_calendar(); ?> 
      </li> 
    </ul> 
	<?php if (function_exists('wp_theme_switcher')) { ?>
<ul><li><h2><?php _e('Themes'); ?></h2>
<?php wp_theme_switcher('dropdown'); ?>
</li></ul>
<?php } ?>
			<?php wp_list_pages('title_li=<h2>' . __('Pages') . '</h2>' ); ?>

			<li><h2><?php _e('Archives', 'batavia'); ?></h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>

			<li><h2><?php _e('Categories', 'batavia'); ?></h2>
				<ul>
				<?php wp_list_categories(0, '', 'name', 'asc', '', 1, 0, 1, 1, 1, 1, 0,'','','','','') ?>
				</ul>
			</li>

			<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>				
				<?php wp_list_bookmarks(); ?>
				
				<li><h2><?php _e('Meta', 'batavia'); ?></h2>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<li><a href="http://validator.w3.org/check/referer" title="<?php _e('This page validates as XHTML 1.0 Transitional'); ?>"><?php _e('Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr>'); ?></a></li>
					<li><a href="http://gmpg.org/xfn/"><abbr title="<?php _e('XHTML Friends Network');?>">XFN</abbr></a></li>
					
					<?php wp_meta(); ?>
				</ul>
				</li>
			<?php } ?>
			<?php endif; ?>
		</ul>
	</div>

