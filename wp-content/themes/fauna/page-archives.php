<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

	<div id="body">

		<div id="main" class="entry">
			<div class="box">
				<h2><?php _e('Archives by Month', 'fauna') ?></h2>
				<ul>
					<? wp_get_archives('monthly', '', 'html', '', '', true); ?>
				</ul>
				
				<br />
				
				<h2><?php _e('Last 50 Entries', 'fauna') ?></h2>
				<ul>
					<?php wp_get_archives('postbypost','50','html','','', false); ?> 
				</ul>
			</div>
			
			<hr />

		</div>

		<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>
