<!-- begin footer -->

<div style="clear:both;"></div>
<div style="clear:both;"></div>

<div id="footerbg">
<div id="footer">

	<div id="footerleft">
		<h2><?php _e("Recently Written",TEMPLATE_DOMAIN); ?></h2>
			<ul>
				<?php wp_get_archives('postbypost', 8); ?>
			</ul>
	</div>
	
	<div id="footermiddle1">
		<h2><?php _e('Monthly Archives',TEMPLATE_DOMAIN);?></h2>
			<ul>
				<?php wp_get_archives('type=monthly&limit=8'); ?>
			</ul><br />
	</div>
	
	<div id="footermiddle2">
		<h2><?php _e('Blogroll',TEMPLATE_DOMAIN);?></h2>
			<ul>
				 <?php wp_list_bookmarks('limit=4'); ?> 
			</ul>
	</div>
	
	<div id="footerright">
		<h2><?php _e("Find It",TEMPLATE_DOMAIN); ?></h2>
	   		<form id="searchform" method="get" action="<?php bloginfo('url'); ?>">
	   		<input type="text" value="To search, type and hit enter..." name="s" id="s" onfocus="if (this.value == 'To search, type and hit enter...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'To search, type and hit enter...';}" />
			</form>
		
		<h2><?php _e("Admin",TEMPLATE_DOMAIN); ?></h2>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>

				<?php wp_meta(); ?>

			</ul>
			
	 <h2><?php _e("Credits",TEMPLATE_DOMAIN); ?></h2>
			<p>	<?php if( SHOW_AUTHORS != 'false') { ?><a href="http://www.briangardner.com/themes/vertigo-wordpress-theme.htm" >Vertigo Theme</a> by <a href="http://www.briangardner.com" >Brian Gardner</a>.<?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?><br /><?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
<br />


</p>
		</div>
	
</div>

<div id="footerbottom">
</div>

</div>

   <?php wp_footer(); ?>
    </div> 
</body>
</html>
