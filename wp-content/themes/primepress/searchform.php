<h2 class="widgettitle search-title"><?php _e('Search', 'primepress'); ?></h2>

<form method="get" id="pp-searchform" action="<?php bloginfo('url'); ?>">

<div>

	<input type="text" name="s" id="s-input" maxlength="150" accesskey="4" title="Search <?php bloginfo('name'); ?>" onblur="this.value=(this.value=='') ? 'Type in and hit enter to search' : this.value;" onfocus="this.value=(this.value=='Type in and hit enter to search') ? '' : this.value;" value="<?php _e('Type in and hit enter to search', 'primepress'); ?>" />

	<input type="hidden" id="s-submit" value="Search" />

</div>

</form>
