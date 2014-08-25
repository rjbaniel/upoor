<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div id="pagecontent">

	<h2><?php _e('Archive:', 'color-splash'); ?></h2>
	
	<hr>
	
				<h3><?php _e('Monthly', 'color-splash'); ?></h3>
				<ul>
					<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
				</ul>

<h3><?php _e('Category:', 'color-splash'); ?></h3>
				<ul>
					<?php wp_list_categories('sort_column=name&optioncount=1'); ?>
				</ul>

<h3><?php _e('Blogroll:', 'color-splash'); ?></h3>
			<ul>
			<?php get_bookmarks(-1, '<li>', '</li>', ' - '); ?>
			</ul>
<h3>Meta</h3>
				<ul>
					<?php wp_register(); ?>
					<li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
					<li><a href="http://wordpress.org/" title="Provided by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
					<?php wp_meta(); ?>
				</ul>
	<hr />



	</p>

</div>

<?php get_footer(); ?>
