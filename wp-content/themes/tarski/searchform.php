<div class="searchbox">
	<form method="get" id="searchform" action="<?php bloginfo('url'); ?>"><fieldset>
		<input type="text" value="<?php echo isset($s)?esc_html($s, 1):''; ?>" name="s" id="s" tabindex="21" />
		<input type="submit" id="searchsubmit" value="Search" tabindex="22" />
	</fieldset></form>
</div>
