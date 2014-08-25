<?php
/*
Template Name: Portfolio Page
*/
?>
<?php
$et_ptemplate_settings = array();
$et_ptemplate_settings = maybe_unserialize( get_post_meta(get_the_ID(),'et_ptemplate_settings',true) );

$fullwidth = isset( $et_ptemplate_settings['et_fullwidthpage'] ) ? (bool) $et_ptemplate_settings['et_fullwidthpage'] : false;
$et_ptemplate_showtitle = isset( $et_ptemplate_settings['et_ptemplate_showtitle'] ) ? (bool) $et_ptemplate_settings['et_ptemplate_showtitle'] : false;
$et_ptemplate_showdesc = isset( $et_ptemplate_settings['et_ptemplate_showdesc'] ) ? (bool) $et_ptemplate_settings['et_ptemplate_showdesc'] : false;
$et_ptemplate_detect_portrait = isset( $et_ptemplate_settings['et_ptemplate_detect_portrait'] ) ? (bool) $et_ptemplate_settings['et_ptemplate_detect_portrait'] : false;

$gallery_cats = isset( $et_ptemplate_settings['et_ptemplate_gallerycats'] ) ? (array) $et_ptemplate_settings['et_ptemplate_gallerycats'] : array();
$et_ptemplate_gallery_perpage = isset( $et_ptemplate_settings['et_ptemplate_gallery_perpage'] ) ? (int) $et_ptemplate_settings['et_ptemplate_gallery_perpage'] : 12;

$et_ptemplate_portfolio_size = isset( $et_ptemplate_settings['et_ptemplate_imagesize'] ) ? (int) $et_ptemplate_settings['et_ptemplate_imagesize'] : 2;

$et_ptemplate_portfolio_class = '';
if ( $et_ptemplate_portfolio_size == 1 ) $et_ptemplate_portfolio_class = ' et_portfolio_small';
if ( $et_ptemplate_portfolio_size == 3 ) $et_ptemplate_portfolio_class = ' et_portfolio_large';
?>

<?php get_header(); ?>

<?php if (get_option('ebusiness_blog_style') == 'Blog Based') : ?>

	<?php if (get_option('ebusiness_categories') == 'on') : ?>
	<div id="categories"> <img src="<?php echo get_template_directory_uri(); ?>/images/categories-left-<?php echo esc_attr( get_option('ebusiness_color_scheme') ); ?>.gif" alt="line" style="float: left;" />
		<?php $menuClass = 'nav superfish';
		$menuID = 'nav2';
		$secondaryNav = '';
		if (function_exists('wp_nav_menu')) {
			$secondaryNav = wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => $menuID, 'echo' => false ) );
		};
		if ($secondaryNav == '') { ?>
			<ul id="<?php echo esc_attr( $menuID ); ?>" class="<?php echo esc_attr( $menuClass ); ?>">
				<?php show_categories_menu($menuClass,false); ?>
			</ul> <!-- end ul#nav -->
		<?php }
		else echo($secondaryNav); ?>
		<img src="<?php echo get_template_directory_uri(); ?>/images/categories-right-<?php echo esc_attr( get_option('ebusiness_color_scheme') ); ?>.gif" alt="line" style="float: left;" /> </div>
	<?php endif; ?>

<?php endif; ?>

<div id="container">
	<div id="left-div<?php if ($fullwidth) echo('-full'); ?>">
        <!--Start Post-->
        <div class="home-post-wrap-2">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <h1 class="titles"><a href="<?php the_permalink() ?>" title="<?php printf(esc_attr__('Permanent Link to %s','eBusiness'), get_the_title()) ?>">
                <?php the_title() ?>
                </a></h1>
            <?php $desc = get_post_meta(get_the_ID(), 'Description', $single = true); ?>
            <?php if($desc != '') { ?>
            <div class="post-info-wrap"> <img src="<?php echo get_template_directory_uri(); ?>/images/home-title-2-left-<?php echo esc_attr( get_option('ebusiness_color_scheme') ); ?>.gif" alt="home title" class="home-title-image" /> <span class="post-info"><?php echo esc_html($desc); ?></span> <img src="<?php echo get_template_directory_uri(); ?>/images/home-title-2-right-<?php echo esc_attr( get_option('ebusiness_color_scheme') ); ?>.gif" alt="home title" class="home-title-image" /> </div>
            <?php } ?>
            <div style="clear: both;"></div>

			<?php if (get_option('ebusiness_page_thumbnails') == 'on') { ?>

				<?php $width = (int) get_option('ebusiness_thumbnail_width_pages');
					  $height = (int) get_option('ebusiness_thumbnail_height_pages');
					  $classtext = 'thumbnail';
					  $titletext = get_the_title();

				      $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
					  $thumb = $thumbnail["thumb"];  ?>

				<?php if($thumb != '') { ?>
					<a href="<?php the_permalink() ?>" title="<?php printf(esc_attr__('Permanent Link to %s','eBusiness'), get_the_title()) ?>">
						<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
					</a>
				<?php } ?>

			<?php } ?>

            <?php the_content(''); ?>

						<div id="et_pt_portfolio_gallery" class="clearfix<?php echo $et_ptemplate_portfolio_class; ?>">
							<?php $gallery_query = '';
							$portfolio_count = 1;
							$et_open_row = false;
							if ( !empty($gallery_cats) ) $gallery_query = '&cat=' . implode(",", $gallery_cats);
							else echo '<!-- gallery category is not selected -->'; ?>
							<?php
								global $wp_embed;
								$et_videos_output = '';
								$et_paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
							?>
							<?php query_posts("posts_per_page=$et_ptemplate_gallery_perpage&paged=" . $et_paged . $gallery_query); ?>
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<?php $width = 260;
								$height = 170;

								if ( $et_ptemplate_portfolio_size == 1 ) {
									$width = 140;
									$height = 94;
									$et_portrait_height = 170;
								}
								if ( $et_ptemplate_portfolio_size == 2 ) $et_portrait_height = 315;
								if ( $et_ptemplate_portfolio_size == 3 ) {
									$width = 430;
									$height = 283;
									$et_portrait_height = 860;
								}

								$et_auto_image_detection = false;
								if ( has_post_thumbnail( get_the_ID() ) && $et_ptemplate_detect_portrait ) {
									$wordpress_thumbnail = get_post( get_post_thumbnail_id(get_the_ID()) );
									$wordpress_thumbnail_url = $wordpress_thumbnail->guid;

									if ( et_is_portrait($wordpress_thumbnail_url) )	$height = $et_portrait_height;
								}

								$titletext = get_the_title();
								$et_portfolio_title = get_post_meta(get_the_ID(),'et_portfolio_title',true) ? get_post_meta(get_the_ID(),'et_portfolio_title',true) : get_the_title();
								$et_videolink = get_post_meta(get_the_ID(),'et_videolink',true) ? get_post_meta(get_the_ID(),'et_videolink',true) : '';

								$et_custom_embed_video = ( $embed_custom_code = get_post_meta( get_the_ID(), 'et_videolink_embed', true ) ) && '' != $embed_custom_code ? $embed_custom_code : '';

								if ( '' != $et_videolink || '' != $et_custom_embed_video ){
									$et_video_id = 'et_video_post_' . get_the_ID();
									if ( '' != $et_custom_embed_video )
										$et_videos_output .= '<div id="'. esc_attr( $et_video_id ) .'">' . $embed_custom_code . '</div>';
									else
										$et_videos_output .= '<div id="'. esc_attr( $et_video_id ) .'">' . $wp_embed->shortcode( '', esc_url( $et_videolink ) ) . '</div>';
								}

								$thumbnail = get_thumbnail($width,$height,'',$titletext,$titletext,true,'et_portfolio');
								$thumb = $thumbnail["thumb"];

								if ( $et_ptemplate_detect_portrait && $thumbnail["use_timthumb"] && et_is_portrait($thumb) ) {
									$height = $et_portrait_height;
								} ?>

								<?php if ( $portfolio_count == 1 || ( $et_ptemplate_portfolio_size == 2 && (!$fullwidth && ($portfolio_count+1) % 2 == 0) ) || ( $et_ptemplate_portfolio_size == 3 && (($portfolio_count+1) % 2 == 0) ) ) {
									$et_open_row = true; ?>
									<div class="et_pt_portfolio_row clearfix">
								<?php } ?>

										<div class="et_pt_portfolio_item">
											<?php if ($et_ptemplate_showtitle) { ?>
												<h2 class="et_pt_portfolio_title"><?php echo esc_html( $et_portfolio_title ); ?></h2>
											<?php } ?>
											<div class="et_pt_portfolio_entry<?php if ( $height == $et_portrait_height ) echo ' et_portrait_layout'; ?>">
												<div class="et_pt_portfolio_image<?php if ( '' != $et_videolink || '' != $et_custom_embed_video ) echo ' et_video'; ?>">
													<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, ''); ?>
													<span class="et_pt_portfolio_overlay"></span>

													<a class="et_portfolio_zoom_icon fancybox" title="<?php the_title_attribute(); ?>"<?php if ( '' == $et_videolink && '' == $et_custom_embed_video ) echo ' rel="portfolio"'; ?> href="<?php if ( '' != $et_videolink || '' != $et_custom_embed_video ) echo esc_url( '#' . $et_video_id ); else echo($thumbnail['fullpath']); ?>"><?php esc_html_e('Zoom in','eBusiness'); ?></a>
													<a class="et_portfolio_more_icon" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more','eBusiness'); ?></a>
												</div> <!-- end .et_pt_portfolio_image -->
											</div> <!-- end .et_pt_portfolio_entry -->
											<?php if ($et_ptemplate_showdesc) { ?>
												<p><?php truncate_post(90); ?></p>
											<?php } ?>
										</div> <!-- end .et_pt_portfolio_item -->

								<?php if ( ($et_ptemplate_portfolio_size == 2 && !$fullwidth && $portfolio_count % 2 == 0) || ( $et_ptemplate_portfolio_size == 3 && ($portfolio_count % 2 == 0) ) ) {
									$et_open_row = false; ?>
									</div> <!-- end .et_pt_portfolio_row -->
								<?php } ?>

								<?php if ( ($et_ptemplate_portfolio_size == 2 && $fullwidth && $portfolio_count % 3 == 0) || ($et_ptemplate_portfolio_size == 1 && !$fullwidth && $portfolio_count % 3 == 0) || ($et_ptemplate_portfolio_size == 1 && $fullwidth && $portfolio_count % 5 == 0) ) { ?>
									</div> <!-- end .et_pt_portfolio_row -->
									<div class="et_pt_portfolio_row clearfix">
									<?php $et_open_row = true; ?>
								<?php } ?>

							<?php $portfolio_count++;
							endwhile; ?>
								<?php if ( $et_open_row ) {
									$et_open_row = false; ?>
									</div> <!-- end .et_pt_portfolio_row -->
								<?php } ?>
								<div class="page-nav clearfix">
									<?php if (function_exists('wp_pagenavi')) { wp_pagenavi(); }
									else { ?>
										 <?php get_template_part('includes/navigation'); ?>
									<?php } ?>
								</div> <!-- end .entry -->
							<?php else : ?>
								<?php if ( $et_open_row ) {
									$et_open_row = false; ?>
									</div> <!-- end .et_pt_portfolio_row -->
								<?php } ?>
								<?php get_template_part('includes/no-results'); ?>
							<?php endif; wp_reset_query(); ?>

							<?php if ( $et_open_row ) {
								$et_open_row = false; ?>
								</div> <!-- end .et_pt_portfolio_row -->
							<?php } ?>

							<?php if ( '' != $et_videos_output ) echo '<div class="et_embedded_videos">' . $et_videos_output . '</div>'; ?>
						</div> <!-- end #et_pt_portfolio_gallery -->

            <?php if (get_option('ebusiness_foursixeight') == 'on') { ?>
            <?php get_template_part('includes/468x60'); ?>
            <?php } else { echo ''; } ?>
		<?php endwhile; endif; ?>
	</div>
	</div>

	<?php if (!$fullwidth) { ?>
		<!--Begin Sidebar-->
		<div id="sidebar">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Pages") ) : ?>
			<?php endif; ?>
		</div>
		<!--End Sidebar-->
	<?php } ?>
    <img src="<?php echo get_template_directory_uri(); ?>/images/content-bg-<?php echo esc_attr( get_option('ebusiness_color_scheme') ); ?>.gif" alt="line" style="float: left; margin-top: 15px;" /> </div>
<!--Begin Footer-->
<?php get_footer(); ?>
<!--End Footer-->
</body></html>