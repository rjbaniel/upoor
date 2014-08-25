<?php get_header(); ?>

<div class="content">
	
	<div id="middlecolumn">
		<div id="primary">
			<?php if( get_option('redo_livesearchposition') == 1 ) { ?>
			<div id="current-content">
			<?php } ?>
			
				<div id="primarycontent" class="hfeed">
<?php if(file_exists(WP_CONTENT_DIR . '/ads-block-two.php')) include(WP_CONTENT_DIR . '/ads-block-two.php'); ?>
					<?php include (TEMPLATEPATH . '/single_post.php'); ?>
					
				</div> <!-- #primarycontent .hfeed -->
			
			<?php if( get_option('redo_livesearchposition') == 1 ) { ?>
			</div> <!-- #current-content -->
			
			<div id="dynamic-content"></div>
			<?php } ?>
			
		</div> <!-- #primary -->
	</div>

	<?php if ( comments_open() ) comments_template('',true); ?>

	<div id="rightcolumn">
		<?php get_sidebar(); ?>
	</div>
	<div class="clear"></div>

</div> <!-- .content -->

<?php get_footer(); ?>
