<div style="clear: both;"></div>
<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
else { ?>
	<p class="pagination">
		<?php next_posts_link(esc_html__('&laquo; Previous Entries','ePhoto')) ?>
		<?php previous_posts_link(esc_html__('Next Entries &raquo;','ePhoto')) ?>
	</p>
<?php } ?>