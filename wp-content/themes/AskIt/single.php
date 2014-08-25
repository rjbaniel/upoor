<?php get_header(); ?>

<div id="main-area">

	<?php get_template_part('includes/breadcrumbs'); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<?php if (get_option('askit_integration_single_top') <> '' && get_option('askit_integrate_singletop_enable') == 'on') echo(get_option('askit_integration_single_top')); ?>

		<div class="entry">
			<div class="entry-top">
				<div class="entry-content">
					<?php $comments_num = (int) get_comments_number(); ?>
					<span class="comment-number<?php if ( $comments_num == 0 ) echo ' unanswered'; ?>"><a href="<?php the_permalink(); ?>#comment-wrap"><?php echo esc_html($comments_num); ?></a></span>
					<h2 class="title"><?php the_title(); ?></h2>
					<span class="quote"></span>
					<span class="author">- <?php the_author_posts_link(); ?></span>

					<div class="clear"></div>

					<?php get_template_part('includes/postinfo'); ?>

					<?php $posttags = get_the_tags();
					$i = 0;
					if ($posttags) { ?>
						<div class="tags">
							<?php foreach($posttags as $tag) {
								$i++;
								if ( $i > 5) break; ?>
								<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"><span><?php echo esc_html( $tag->name ); ?></span></a>
							<?php } ?>
						</div> <!-- end .tags -->
					<?php } ?>

					<div class="post-content">
						<?php the_content(); ?>
						<?php wp_link_pages(array('before' => '<p><strong>'.esc_html__('Pages','AskIt').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
						<?php edit_post_link(esc_html__('Edit this page','AskIt')); ?>

						<div class="clear"></div>
					</div>
				</div> <!-- end .entry-content -->
			</div> <!-- end .entry-top -->
		</div> <!-- end .entry -->

		<div class="clear"></div>

		<?php if (get_option('askit_integration_single_bottom') <> '' && get_option('askit_integrate_singlebottom_enable') == 'on') echo(get_option('askit_integration_single_bottom')); ?>

		<?php if (get_option('askit_468_enable') == 'on') { ?>
			<?php if(get_option('askit_468_adsense') <> '') echo ( get_option('askit_468_adsense') );
			else { ?>
				<a href="<?php echo esc_url(get_option('askit_468_url')); ?>"><img src="<?php echo esc_url(get_option('askit_468_image')); ?>" alt="468 ad" class="foursixeight" /></a>
			<?php } ?>
		<?php } ?>

		<?php if (get_option('askit_show_postcomments') == 'on') comments_template('', true); ?>

	<?php endwhile; endif; ?>
</div> <!-- end #main-area -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>