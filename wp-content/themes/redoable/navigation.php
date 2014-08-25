	<?php /*
		This navigation is used on most pages to move back and forth in your archives.
		It has been placed in its own file so it's easier to change across all of K2/Redoable
	*/ ?>

	<hr />

	<?php if (is_single()) { ?>

	<div class="navigation">
		<?php previous_post_link('<div class="left"> %link</div>','<span>&laquo;</span>','yes') ?>
		<?php next_post_link('<div class="right">%link </div>','<span>&raquo;</span>','yes') ?>
		<div class="clear"></div>
	</div>

	<?php } else { ?>
		
	<?php /* global $pagenow; echo $pagenow; */ $redo_asidescategory = 0; ?>
		
	<div class="navigati<?php _e('on');?> <?php if ( is_home() and $redo_asidescategory != 0 ) { echo 'rightmargin'; } ?>">
		<div class="left"><?php next_posts_link('<span>&laquo;</span> '.__('Previous Entries','redo_domain').''); ?></div>
		<div class="right"><?php previous_posts_link(''.__('Next Entries','redo_domain').' <span>&raquo;</span>'); ?></div>
		<div class="clear"></div>
	</div>

	<?php } ?>

	<hr />
