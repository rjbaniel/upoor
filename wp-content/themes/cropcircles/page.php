<?php get_header(); ?>
	<div id="content" class="widecolumn">


    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post">
		<h2 class="posttitle" id="post-<?php the_ID(); ?>"><?php the_title(); ?></h2>
			<div class="entrytext">
				<?php the_content(); ?>
	<br />
				<?php wp_link_pages(__('<p><strong>Pages:</strong> '), '</p>', 'number'); ?>

	<div class="navigation">

			<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">&<?php _e('laquo; Return Home','cropcircles'); ?></a></div>
	
			</div>
		</div>
	  <?php endwhile; endif; ?>

      <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>

	</div>

<?php get_footer(); ?>
