
<!-- begin sidebar -->
<div id="right">

<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>
	<!--
		<div id="author">
			Here is a section you can use to briefly talk about yourself or your site. Uncomment and delete this line to use.
			<h3><?php _e('The Author'); ?></h3>
			<p>Your description here.</p>
		</div>
		
		<div class="line"></div>
	-->
		<div id="links">

		<div id="pages">
			<h3><?php _e('The Pages','greenmarinee'); ?></h3>
				<ul>
					<?php wp_list_pages('title_li=&depth=1'); ?>
				</ul>
		</div>

		<div class="line"></div>

		<h3><?php _e('The Search','greenmarinee'); ?></h3>
			<p class="searchinfo">search site archives</p>
			<div id="search">
				<div id="search_area">
					<form id="searchform" method="get" action="<?php bloginfo('url'); ?>">
						<input class="searchfield" type="text" name="s" id="s" value="" title="<?php _e('Enter keyword to search','greenmarinee'); ?>" />
						<input class="submit" type="submit" name="submit" value="" title="<?php _e('Click to search archives','greenmarinee'); ?>" />
					</form>
				</div>
			</div>


		<div class="line"></div>
		
		<h3><?php _e('The Associates','greenmarinee'); ?></h3>
			<ul>
				<?php get_bookmarks('-1', '<li>', '</li>', '', 0, 'name', 0, 0, -1, 0); ?>
			</ul>

		<div class="line"></div>

		<h3><?php _e('The Storage','greenmarinee'); ?></h3>
			<ul>
		 		<?php wp_get_archives('type=monthly'); ?>
 			</ul>
 
		<div class="line"></div>

			<h3><?php _e('The Categories','greenmarinee'); ?></h3>
				<ul>
					<?php wp_list_categories(); ?>
				</ul>	
		<div class="line"></div>

			<h3><?php _e('The Meta','greenmarinee'); ?></h3>
				<ul>
					<!-- <li><?php // wp_register(); ?></li> -->
					<li><?php wp_loginout(); ?></li>
				   	<li><a href="http://gmpg.org/xfn/"><abbr title="<?php _e('XHTML Friends Network');?>">XFN</abbr></a></li>
					<li><a href="feed:<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
					<li><a href="feed:<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
					<li><a href="#content" title="<?php _e('back to top','greenmarinee'); ?>"><?php _e('Back to top','greenmarinee'); ?></a></li>
					<?php wp_meta(); ?>
				</ul>

		</div>
<?php endif; ?>
</div>

<!-- end sidebar -->
