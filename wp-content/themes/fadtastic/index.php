<?php get_header(); ?>

		<div id="content_wrapper">
			<div id="content">

                <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
		<?php	$loopcounter = 0; ?>
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); $loopcounter++; ?>
				<?php if ($loopcounter == 1) { ?>
				<h1 id="post-<?php the_ID(); ?>" ><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to');?> <?php the_title(); ?>"><?php the_title(); ?></a></h1>
<p class="author fresh" ><?php _e('Posted by','fadtastic'); ?> <?php the_author_posts_link(); ?> <?php _e('on','fadtastic'); ?> <em><?php the_time(get_option('date_format')) ?>&nbsp;&nbsp;&nbsp;&nbsp;Category: <?php the_category(' ,'); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php the_tags( ' &#183;' . __( 'Tagged','fadtastic' ) . ' ', ', ', ''); ?></em>.</p>
				
				<?php the_content(); ?>

				<big>
					<strong><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','fadtastic');?> <?php the_title(); ?>"><?php _e('Read Full Post','fadtastic'); ?></a></strong> |
					<strong>
						<?php if ('open' == $post->comment_status) : ?> 
						<a href="<?php the_permalink() ?>#respond" title="<?php _e('Make a comment','fadtastic'); ?>"><?php _e('Make a Comment','fadtastic'); ?></a>
						<?php else : ?>
						Comments are Closed
						<?php endif;?>
					</strong> 
					<small>
						<?php if ('open' == $post->comment_status) : ?> 
						 ( <strong><?php comments_popup_link('None', '1', '%'); ?></strong> <?php _e('so far','fadtastic'); ?> )
						<?php endif; ?>
					</small>
				</big>
				<?php } ?>
				<?php endwhile; ?>
								
				<?php else : ?>

				<h2><?php _e('Not Found','fadtastic');?></h2>
				<p><?php _e("Sorry, but you are looking for something that isn't here.",'fadtastic');?></p>
				<?php include (TEMPLATEPATH . "/searchform.php"); ?>
			
				<?php endif; ?>
				
				<!-- Minor posts start here -->
				
				<h2 class="recently"><?php _e('Recently on','fadtastic'); ?> <?php bloginfo('name'); ?>...</h2>
				<?php
				if (!isset($loop2counter)) {
					$loop2counter = 0;
				}
				if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); $loop2counter++; ?>
				<?php if ($loop2counter > 1 and $loop2counter < 10 ) { ?>
				
				<div class="recent_post">
					<h2 id="post-<?php the_ID(); ?>" ><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','fadtastic');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<p class="author"><?php _e('Posted by','fadtastic'); ?> <?php the_author_posts_link(); ?> <?php _e('on','fadtastic'); ?> <em><?php the_time(get_option('date_format')) ?>&nbsp;&nbsp;&nbsp;&nbsp;Category: <?php the_category(' ,'); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php the_tags( ' &#183;' . __( 'Tagged','fadtastic' ) . ' ', ', ', ''); ?></em>.</p>
				</div>
				<?php } ?>
				<?php endwhile; ?>
								
				<?php else : ?>

				<h2><?php _e('Not Found','fadtastic');?></h2>
				<p><?php _e("Sorry, but you are looking for something that isn't here.",'fadtastic');?></p>
				<?php include (TEMPLATEPATH . "/searchform.php"); ?>
			
				<?php endif; ?>
            <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
			</div>
		</div>
			
	
	<?php include("sidebar.php") ?>

<?php get_footer(); ?>
