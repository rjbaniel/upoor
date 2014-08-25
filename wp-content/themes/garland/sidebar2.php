<div id="sidebar-right" class="sidebar">
<?php // do we hide this sidebar?
if (!get_theme_mod( 'sbr' )) { ?>
<ul class="menu">
<?php /* WordPress Widget Support */ 
if (function_exists('dynamic_sidebar') and dynamic_sidebar('right-sidebar')) { ?> <?php } else { ?>
<li>
<script type="text/javascript">
function clickclear(thisfield, defaulttext) {
  if (thisfield.value == defaulttext) {
    thisfield.value = "";
  }
}
function clickrecall(thisfield, defaulttext) {
  if (thisfield.value == "") {
   thisfield.value = defaulttext;
  }
}
</script>
<form method="get" id="searchform" action="<?php echo home_url('/'); ?>">
	<div>
    	<input type="text" id="s" name="s" size="25" value="Start your search ..." onclick="clickclear(this, 'Start your search ...')" onblur="clickrecall(this,'Start your search ...')" />        
    </div>    
</form>
</li>
<?php wp_list_bookmarks( array( 'title_before' => '<h3>', 'title_after' => '</h3>' ) ); ?>
<li>
<h3>Archives</h3>
<ul>
<?php wp_get_archives('type=monthly'); ?>
</ul>
</li>
<li>
<h3>Misc</h3>
<ul>
<?php wp_register(); ?>
<li><?php wp_loginout(); ?></li>
<li><a href="http://wordpress.org/">WordPress.org</a></li>
<li><a href="http://wordpress.com/">WordPress.com</a></li>
<?php wp_meta(); ?>
</ul>
</li>
<?php } ?>
</ul>
<?php } ?>
</div>
