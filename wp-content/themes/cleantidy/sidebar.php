<div id="sidebar">


		<ul class="widgets">


<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('MostRecent sidebar') ) : ?>

<li><h2><?php _e('Archives','cleantidy');?></h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
				</li>

<?php endif; ?>


<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Recents sidebar') ) : ?>


<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>

<?php wp_list_bookmarks(); ?>

<?php } ?>


<?php endif; ?>


		</ul>


	</div>
