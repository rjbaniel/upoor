<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
<div>
	<input type="text" name="s" id="s" value="<?php echo esc_attr(__('Journal Search...', 'chaoticsoul')); ?>" />
	<!-- <input type="submit" id="searchsubmit" value="Search" /> -->
</div>
</form>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#s').focus(function() {
			if (jQuery('#s').val() == '<?php echo esc_attr(__('Journal Search...', 'chaoticsoul')); ?>') {
				jQuery('#s').val('');
			}
		});
		jQuery('#s').blur(function() {
			if (jQuery('#s').val() == '') {
				jQuery('#s').val('<?php echo esc_attr(__('Journal Search...', 'chaoticsoul')); ?>');
			}
		});
	});
</script>
