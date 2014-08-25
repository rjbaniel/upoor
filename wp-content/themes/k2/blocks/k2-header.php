<?php
/**
 * Header Template
 *
 * This file is loaded by header.php and used for content inside the #header div
 *
 * @package K2
 * @subpackage Templates
 */

// For SEO, outputs the blog title in h1 or a div
$block = ( is_front_page() ? 'h1' : 'div' );

// arguments for wp_list_pages
$list_args = k2_get_page_list_args(); // this function is pluggable

?>

<?php if(get_header_textcolor() != 'blank') { ?>
<?php echo "<$block class='blog-title'>"; ?>
<a href="<?php echo get_option('home'); ?>/" accesskey="1"><?php bloginfo('name'); ?></a>
<?php echo "</$block>"; ?>
<?php } ?>

<p class="description"><?php bloginfo('description'); ?></p>


<div id="custom-navigation">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<ul id="menu">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
<?php
// Display an Register tab if registration is enabled or an Admin tab if user is logged in
wp_register('<li class="admintab">','</li>');
?>
</ul>
<?php } else { ?>

<ul id="menu">
	<?php /* K2 Hook - do not remove */ do_action('template_header_menu'); ?>

	<?php
		// List pages
		wp_list_pages( $list_args );
	?>

	<?php
		// Display an Register tab if registration is enabled or an Admin tab if user is logged in
		wp_register('<li class="admintab">','</li>');
	?>
</ul><!-- .menu -->

<?php } ?>
</div>






