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
	<?php if (get_option('professional_integration_single_top') <> '' && get_option('professional_integrate_singletop_enable') == 'on') echo(get_option('professional_integration_single_top')); ?>

	<div id="content-top"<?php if (!$fullwidth) echo ' class="top-alt"'; ?>></div>
	<div id="content" class="clearfix<?php if (!$fullwidth) echo(' content-alt'); ?>">
		<div id="content-area">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php get_template_part('includes/breadcrumbs'); ?>

			<?php if (get_option('professional_integration_single_top') <> '' && get_option('professional_integrate_singletop_enable') == 'on') echo(get_option('professional_integration_single_top')); ?>

			<div class="entry clearfix post">
				<h1 class="title"><?php the_title(); ?></h1>

				<?php if (get_option('professional_page_thumbnails') == 'on') { ?>

					<?php $thumb = '';
					$width = 184;
					$height = 184;
					$classtext = '';
					$titletext = get_the_title();

					$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
					$thumb = $thumbnail["thumb"]; ?>

					<?php if($thumb <> '') { ?>
						<div class="thumb alignleft">
							<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
							<span class="overlay"></span>
						</div> <!-- end .thumb -->
					<?php }; ?>

				<?php }; ?>

				<?php the_content(); ?>
				<?php wp_link_pages(array('before' => '<p><strong>'.esc_html__('Pages','Professional').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

				<div id="et-login">
					<div class='et-protected'>
						<div class='et-protected-form'>
							<?php $scheme = apply_filters( 'et_forms_scheme', null ); ?>

							<form action='<?php echo esc_url( home_url( '', $scheme ) ); ?>/wp-login.php' method='post'>
								<p><label><span><?php esc_html_e('Username','Professional'); ?>: </span><input type='text' name='log' id='log' value='<?php echo esc_attr($user_login); ?>' size='20' /><span class='et_protected_icon'></span></label></p>
								<p><label><span><?php esc_html_e('Password','Professional'); ?>: </span><input type='password' name='pwd' id='pwd' size='20' /><span class='et_protected_icon et_protected_password'></span></label></p>
								<input type='submit' name='submit' value='Login' class='etlogin-button' />
							</form>
						</div> <!-- .et-protected-form -->
					</div> <!-- .et-protected -->
				</div> <!-- end #et-login -->

				<div class="clear"></div>

				<?php edit_post_link(esc_html__('Edit this page','Professional')); ?>

			</div> <!-- end .entry -->

            <?php if (get_option('professional_integration_single_bottom') <> '' && get_option('professional_integrate_singlebottom_enable') == 'on') echo(get_option('professional_integration_single_bottom')); ?>
		<?php endwhile; endif; ?>
		</div> <!-- end #content-area -->

		<?php if (!$fullwidth) get_sidebar(); ?>

	</div> <!-- end #content -->
	<div id="content-bottom"<?php if (!$fullwidth) echo ' class="bottom-alt"'; ?>></div>

<?php get_footer(); ?>