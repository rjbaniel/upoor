<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<input type="text" value="Search" name="s" id="s" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}" />
	<input type="submit" id="searchsubmit" value="<?php _e('Go', 'iblog'); ?>" />
</form>
