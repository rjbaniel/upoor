<?php get_header(); ?>

	<div id="content_box">
	
		<div id="content" class="page">
			<h1><?php _e('My 404 page is better than yours.','copyblogger'); ?></h1>
			<div class="entry">
				<p><?php _e('Welcome to the seedy underbelly of this otherwise upstanding Web site. Please choose from the following in order to get back on track:','copyblogger'); ?></p>
				<ul>
					<li><?php _e("Try the ol' back button on your browser&#8212;it <em>is</em> the most used button on the Web, you know.",'copyblogger'); ?></li>
					<li><?php _e("Head on back",'copyblogger'); ?> <a href="<?php bloginfo('url'); ?>"><?php _e('Home');?></a>.</li>
					<li>Try the navigation menu at the top &uarr; of the page.</li>
					<li><?php _e("Search or click on a link over in the sidebar.",'copyblogger'); ?></li>
					<li><a href="<?php bloginfo('rss2_url'); ?>"><?php _e("Subscribe to this site's feed",'copyblogger'); ?></a> <?php _e("so you don't have to come here for updates.",'copyblogger'); ?></li>
					<li><?php _e("Relive the glory days of high school football and punt, but <em>please</em> do not strain your groin.",'copyblogger'); ?></li>
				</ul>
			</div>
		</div>

		<?php get_sidebar(); ?>
		
	</div>

<?php get_footer(); ?>
