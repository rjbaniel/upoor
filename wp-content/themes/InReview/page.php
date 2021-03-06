<?php get_header(); ?>

<div id="main-content">
	<div id="main-content-wrap" class="clearfix">
		<div id="left-area">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php get_template_part('includes/breadcrumbs'); ?>
			<div class="entry post clearfix">
				<?php if (get_option('inreview_page_thumbnails') == 'on') { ?>
					<?php
						$thumb = '';
						$width = 222;
						$height = 231;
						$classtext = 'post-thumb';
						$titletext = get_the_title();
						$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,false,'Single');
						$thumb = $thumbnail["thumb"];
					?>

					<?php if($thumb <> '') { ?>
						<div class="post-thumbnail">
							<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
							<span class="post-overlay"></span>
						</div> 	<!-- end .post-thumbnail -->
					<?php } ?>
				<?php } ?>

				<h1 class="title"><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<?php wp_link_pages(array('before' => '<p><strong>'.esc_html__('Pages','InReview').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php edit_post_link(esc_html__('Edit this page','InReview')); ?>
			</div> <!-- end .entry -->

			<?php if (get_option('inreview_show_pagescomments') == 'on') comments_template('', true); ?>
		<?php endwhile; endif; ?>
		</div> 	<!-- end #left-area -->

		<?php get_sidebar(); ?>
	</div> <!-- end #main-content-wrap -->
</div> <!-- end #main-content -->
<?php get_footer(); ?>