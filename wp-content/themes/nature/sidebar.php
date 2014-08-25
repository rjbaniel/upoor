	<div id="sidebar" class="sidebars">
		<ul>
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ){ ?>
			<?php
			} else { ?>	
            
            
			<li class="widget_categories">
                <h2><?php _e('Category', 'nature'); ?></h2>
                <ul>
                    <?php wp_list_categories('sort_column=name&optioncount=1'); ?>
                </ul>
            </li>

			<li class="widwp_get_archives"><h2><?php _e('Archives', 'nature'); ?></h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</li>
            
			<?php wp_list_bookmarks(); ?>
            
		<?php } ?>
        </ul>
	</div>

