<?php
/*
Template Name: Gallery Page
*/
?>

<?php
$et_ptemplate_settings = array();
$et_ptemplate_settings = maybe_unserialize( get_post_meta(get_the_ID(),'et_ptemplate_settings',true) );

$fullwidth = isset( $et_ptemplate_settings['et_fullwidthpage'] ) ? (bool) $et_ptemplate_settings['et_fullwidthpage'] : (bool) $et_ptemplate_settings['et_fullwidthpage'];

$gallery_cats = isset( $et_ptemplate_settings['et_ptemplate_gallerycats'] ) ? $et_ptemplate_settings['et_ptemplate_gallerycats'] : array();
$et_ptemplate_gallery_perpage = isset( $et_ptemplate_settings['et_ptemplate_gallery_perpage'] ) ? (int) $et_ptemplate_settings['et_ptemplate_gallery_perpage'] : 12;
?>

<?php get_header(); ?>

<div id="container">
	<div id="container2">
		<div id="left-div">
			<div class="post-wrapper <?php if($fullwidth) echo (' no_sidebar');?>">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<h1 class="titles2">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(esc_attr__('Permanent Link to %s','BlueMist'), the_title()) ?>">
							<?php the_title(); ?>
						</a>
					</h1>
					<div style="clear: both;"></div>

					<?php if (get_option('bluemist_page_thumbnails') == 'on') { ?>

						<?php $thumb = '';

						$width = (int) get_option('bluemist_thumbnail_width_pages');
						$height = (int) get_option('bluemist_thumbnail_height_pages');
						$classtext = '';
						$titletext = get_the_title();

						$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
						$thumb = $thumbnail["thumb"]; ?>

						<?php if($thumb <> '') { ?>
							<div style="float: left; margin: 15px 15px 10px 0px;">
								<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height, $classtext); ?>
							</div>
						<?php }; ?>

					<?php }; ?>

					<?php the_content(); ?>
					<?php wp_link_pages(array('before' => '<p><strong>'.esc_html__('Pages','BlueMist').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
					<?php edit_post_link(esc_html__('Edit this page','BlueMist')); ?>

					<div id="et_pt_gallery" class="clearfix">
						<?php $gallery_query = '';
						if ( !empty($gallery_cats) ) $gallery_query = '&cat=' . implode(",", $gallery_cats);
						else echo '<!-- gallery category is not selected -->'; ?>
						<?php
							$et_paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
						?>
						<?php query_posts("posts_per_page=$et_ptemplate_gallery_perpage&paged=" . $et_paged . $gallery_query); ?>
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php $width = 207;
							$height = 136;
							$titletext = get_the_title();

							$thumbnail = get_thumbnail($width,$height,'portfolio',$titletext,$titletext,true,'Portfolio');
							$thumb = $thumbnail["thumb"]; ?>

							<div class="et_pt_gallery_entry">
								<div class="et_pt_item_image">
									<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, 'portfolio'); ?>
									<span class="overlay"></span>

									<a class="zoom-icon fancybox" title="<?php the_title_attribute(); ?>" rel="gallery" href="<?php echo($thumbnail['fullpath']); ?>"><?php esc_html_e('Zoom in','BlueMist'); ?></a>
									<a class="more-icon" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more','BlueMist'); ?></a>
								</div> <!-- end .et_pt_item_image -->
							</div> <!-- end .et_pt_gallery_entry -->

						<?php endwhile; ?>
							<div class="page-nav clearfix">
								<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
								else { ?>
									 <?php get_template_part('includes/navigation'); ?>
								<?php } ?>
							</div> <!-- end .entry -->
						<?php else : ?>
							<?php get_template_part('includes/no-results'); ?>
						<?php endif; wp_reset_query(); ?>

					</div> <!-- end #et_pt_gallery -->


					<div style="clear: both;"></div>
				</div> <!-- end .post-wrapper -->

				<?php if (get_option('bluemist_show_pagescomments') == 'on') { ?>
					<?php comments_template('', true); ?>
				<?php }; ?>
			<?php endwhile; endif; ?>
		</div> <!-- end #left-div -->
	</div> <!-- end #container2 -->
	<?php if (!$fullwidth) get_sidebar(); ?>
</div>	<!-- end #container -->
<?php get_footer(); ?>
</body>
</html>