<h2><?php _e('Search');?></h2>
<form method="get" id="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div><input type="text" value="<?php echo isset($s)?esc_html($s, 1):''; ?>" name="s" id="s" />
<input type="submit" id="searchsubmit" value="Go" />
</div>
</form>
