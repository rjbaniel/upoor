<?php

/**
 * @package WordPress
 * @subpackage golfPR
 */
/*
Template Name: Services
*/
get_header(); ?>
<div id="content_wrapper">
	<div id="call_actions">
		<div class="block">
			<h2>PR</h2>
				<p>
							<?php query_posts('page_id=12'); ?>

							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<?php the_content(); ?>
								<?php endwhile; endif; ?> 
				</p>
				<h2><a href="<?php echo get_option('home'); ?>/pr/">Find out more</a></h2>
		</div>
		<div class="block">
				<h2>Marketing</h2>
					<p>
								<?php query_posts('page_id=14'); ?>

								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
									<?php the_content(); ?>
									<?php endwhile; endif; ?>
					</p>
					<h2><a href="<?php echo get_option('home'); ?>/marketing/">Find out more</a></h2>
		</div>
		<div class="block">
				<h2>Media Buying</h2>
					<p>
								<?php query_posts('page_id=16'); ?>

								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
									<?php the_content(); ?>
									<?php endwhile; endif; ?>
					</p>
					<h2><a href="<?php echo get_option('home'); ?>/media-buying/">Find out more</a></h2>
		</div>
		<div class="block_end">
				<h2>Digital Media Services</h2>
					<p>
								<?php query_posts('page_id=18'); ?>

								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
									<?php the_content(); ?>
									<?php endwhile; endif; ?>
					</p>
					<h2><a href="<?php echo get_option('home'); ?>/digital-media-services/">Find out more</a></h2>
		</div>
		<div class="clear"></div>	<?php wp_reset_query(); ?>
		
	</div>
	<div id="content_area">
		<div id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post">
		<h1><?php the_title(); ?></h1>
		
				<?php the_content(''); ?>
		</div>
		<?php endwhile; endif; ?>
		</div>
		<div id="sidebar"><script src="http://widgets.twimg.com/j/2/widget.js"></script>
		<script>
		new TWTR.Widget({
		  version: 2,
		  type: 'profile',
		  rpp: 4,
		  interval: 6000,
		  width: 220,
		  height: 300,
		  theme: {
		    shell: {
		      background: '#dee9cb',
		      color: '#ffffff'
		    },
		    tweets: {
		      background: '#ffffff',
		      color: '#000000',
		      links: '#78a300'
		    }
		  },
		  features: {
		    scrollbar: false,
		    loop: false,
		    live: false,
		    hashtags: true,
		    timestamp: true,
		    avatars: false,
		    behavior: 'all'
		  }
		}).render().setUser('PMUKLtd').start();
		</script></div>
		<div class="clear"></div>
	</div>
</div>
<?php get_footer(); ?>
