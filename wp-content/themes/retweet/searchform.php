<div id="search_form">
<form method="get" id="sidebar_search" class="search" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="text" value="<?php echo isset($s)?esc_html($s, 1):''; ?>" title="Search" class="round-left" name="s" id="s" />
<input type="submit" value="" class="searchbutton round-right" id="sidebar_search_submit"/>
</form>
</div>
