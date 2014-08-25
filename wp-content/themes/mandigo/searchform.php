<?php 
	global $dirs;
?>
<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
<div><input type="text" value="<?php echo isset($s)?esc_html($s, 1):''; ?>" name="s" id="s" /> 
<input type="image" id="searchsubmit" src="<?php echo $dirs['www']['scheme']; ?>images/search.gif" />
</div>
</form>
