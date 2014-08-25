<?php
/*
Template Name: Links
*/
?>

<?php get_header(); ?>

<div id="bloque">
	<div id="noticias">
		<div class="entrada">
			<h2><?php _e('Links:',TEMPLATE_DOMAIN);?></h2>
			<ul>
			<?php get_bookmarks(-1, '<li>', '</li>', ''); ?>
			</ul>
		</div>
	</div>	

<?php get_footer(); ?>
