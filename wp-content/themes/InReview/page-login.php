<?php
/*
Template Name: Login Page
*/
?>
<?php
	$et_ptemplate_settings = array();
	$et_ptemplate_settings = maybe_unserialize( get_post_meta(get_the_ID(),'et_ptemplate_settings',true) );

	$fullwidth = isset( $et_ptemplate_settings['et_fullwidthpage'] ) ? (bool) $et_ptemplate_settings['et_fullwidthpage'] : false;
?>

<?php get_header(); ?>

<div id="main-content" <?php if($fullwidth) echo ('class="fullwidth"');?>>
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

				<div id="et-login">
					<div class='et-protected'>
						<div class='et-protected-form'>
							<?php $scheme = apply_filters( 'et_forms_scheme', null ); ?>

							<form action='<?php echo esc_url( home_url( '', $scheme ) ); ?>/wp-login.php' method='post'>
								<p><label><span><?php esc_html_e('Username','InReview'); ?>: </span><input type='text' name='log' id='log' value='<?php echo esc_attr($user_login); ?>' size='20' /><span class='et_protected_icon'></span></label></p>
								<p><label><span><?php esc_html_e('Password','InReview'); ?>: </span><input type='password' name='pwd' id='pwd' size='20' /><span class='et_protected_icon et_protected_password'></span></label></p>
								<input type='submit' name='submit' value='Login' class='etlogin-button' />
							</form>
						</div> <!-- .et-protected-form -->
					</div> <!-- .et-protected -->
				</div> <!-- end #et-login -->

				<div class="clear"></div>

				<?php edit_post_link(esc_html__('Edit this page','InReview')); ?>
			</div> <!-- end .entry -->
		<?php endwhile; endif; ?>
		</div> 	<!-- end #left-area -->

		<?php if (!$fullwidth) get_sidebar(); ?>
	</div> <!-- end #main-content-wrap -->
</div> <!-- end #main-content -->
<?php get_footer(); ?>