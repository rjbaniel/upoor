<?php get_header(); ?>

	<div id="body">

		<div id="main" class="entry">
			<div class="box">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
				<?php if ($about_text != true) { /* This shows the "about text" only once */ ?>
			
				<h2><?php _e('About') ?> <?php the_author(); ?></h2>
				<?php $author_nicename = $wpdb->get_var("SELECT user_nicename FROM $wpdb->users WHERE ID = " . $author); ?>
				<p><?php the_author_meta('description'); ?></p>
				<ul>
					<li><?php _e('Full name:','fauna') ?> <?php the_author_firstname(); ?> <?php the_author_lastname(); ?></li>
					<li><?php _e('Web site:','fauna') ?> <a href="<?php the_author_meta('url'); ?>"><?php the_author_meta('url'); ?></a></li>
					<li><?php _e('Contact via ICQ:','fauna') ?> <?php the_author_icq(); ?></li>
					<li><?php _e('Contact via AOL Instant Messenger:','fauna') ?> <?php the_author_aim(); ?></li>
					<li><?php _e('Contact via Yahoo Messenger:','fauna') ?> <?php the_author_yim(); ?></li>
					<li><?php _e('Contact via MSN Messenger:','fauna') ?> <?php the_author_msn(); ?></li>
				</ul>
				
				<h2><?php _e('Entries Authored by','fauna') ?> <?php the_author(); ?></h2>

				<p><?php _e('You can follow entries authored by','fauna') ?> <?php the_author(); ?> <?php _e('via an','fauna') ?> <a href="<?php echo get_author_rss_link(0, $author, $author_nicename); ?>" title="<?php _e('RSS 2.0','fauna') ?>"><?php _e('author-only XML feed','fauna') ?></a>.</p>
				<p><?php the_author(); ?> <?php _e('has authored','fauna') ?> <?php the_author_posts(); ?> <?php _e('on this weblog','fauna') ?>:</p>
				
				<ul><?php } $about_text = true; ?>
					<li><a href="<?php the_permalink() ?>" title="<?php _e('Permanent Link:','fauna');?> <?php the_title(); ?>"><?php the_title(); ?></a></li>
					<?php endwhile; ?>
				</ul>

				<hr />
			
			</div>

			<?php $numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish'"); ?>
			<?php if ($numposts > $posts_per_page) { ?>
			<div class="box">
				<div class="align-left"><?php posts_nav_link('','',__('&laquo; Previous Entries','fauna')) ?></div>
				<div class="align-right"><?php posts_nav_link('',__('Next Entries &raquo;','fauna'),'') ?></div>
				<br class="clear" />
			</div>
			<?php } ?>
			
			<?php else : ?>
			<div class="box">
				<h2><?php _e('Not Found','fauna');?></h2>
				<p><?php _e('Sorry, no posts matched your criteria.','fauna'); ?></p>
			</div>
			<?php endif; ?>
			
			<hr />
		</div>

		<?php get_sidebar(); ?>

	</div>
				
	<?php get_footer(); ?>
