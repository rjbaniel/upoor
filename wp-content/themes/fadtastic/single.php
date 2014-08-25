<?php get_header(); ?>

		<div id="content_wrapper">
			<div id="content">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<h1 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','fadtastic');?> <?php the_title(); ?>"><?php the_title(); ?></a></h1>
				<p class="author"><?php _e('Posted by','fadtastic'); ?> <?php the_author_posts_link(); ?> <?php _e('on','fadtastic'); ?> <em><?php the_time(get_option('date_format')) ?>&nbsp;&nbsp;&nbsp;<?php _e('Category:','fadtastic'); ?> <?php the_category(' ,'); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php the_tags( ' &#183;' . __( 'Tagged','fadtastic' ) . ' ', ', ', ''); ?></em>.</p>
				          <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
				

			<?php the_content(); ?>

               <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>


								
				<?php endwhile; ?>
				
				
				<?php else : ?>

				<h2><?php _e('Not Found','fadtastic');?></h2>
				<p><?php _e("Sorry, but you are looking for something that isn't here.",'fadtastic');?></p>
				<?php include (TEMPLATEPATH . "/searchform.php"); ?>
			
				<?php endif; ?>
				
				<!-- Story ends here -->
				
				<?php comments_template('',true); ?>

			</div>
		</div>
			
	
	<?php include("sidebar.php") ?>

<?php get_footer(); ?>
