<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div id="bloque">

	<div id="noticias">
		<div class="entrada">
			<h2><?php _e('Archives',TEMPLATE_DOMAIN);?></h2>
				<h3><?php _e('By month:',TEMPLATE_DOMAIN);?></h3>
				<ul>
					<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
				</ul>
			
				<h3><?php _e('By category:',TEMPLATE_DOMAIN);?></h3>
				<ul>
					<?php wp_list_categories('sort_column=name&optioncount=1&feed=Feed'); ?>
				</ul>
		</div>
	</div>

<?php get_footer(); ?>
