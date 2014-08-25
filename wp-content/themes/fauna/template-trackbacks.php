<?php /*
	Trackbacks Template
	This page holds the code used by comments.php for showing trackbacks.
	It's separated out here for ease of use, because the comments.php file is already pretty cluttered.
	*/
?>


 <?php if ( $post->ping_status == "open" ) : ?>
 <?php if ( ! empty($comments_by_type['pings']) ) : ?>

	<h3><?php _e('Trackbacks/Pingbacks','fauna'); ?></h3>

    <ol class="pinglist">
    <?php wp_list_comments('type=pings&callback=list_pings'); ?>
	</ol>

	<?php endif; ?>
    <?php endif; ?>
