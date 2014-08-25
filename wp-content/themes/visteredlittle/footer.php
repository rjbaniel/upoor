<div id="footer">
	<div class="blogbefore">
		<div class="left"></div>
		<div class="right"></div>
		<div class="middle"></div>
	</div>
	<div class="post"><?php
	if( is_single() ) { 
		next_post_link('%link', '<span class="right">%title &raquo;</span>');
		previous_post_link('%link', '<span class="left">&laquo; %title</span>');
    } 
    else { 
		previous_posts_link('<span class="right">' . __('Newer', VL_DOMAIN ) . ' &raquo;</span>');
		next_posts_link('<span class="left">&laquo; ' . __('Older', VL_DOMAIN ) . '</span>');
	}
	?></div><?php
	if( function_exists('dynamic_sidebar') ) {
		dynamic_sidebar( 'Footer Bar' );
	}
	
	if( !function_exists('get_theme_option') || get_theme_option('credits') != 'hide' ) {
		?><div class="post"><p class="credits"><?php if( SHOW_AUTHORS != 'false') { ?>
			<a href="http://windyroad.org/software/wordpress/vistered-little-theme">Vistered Little <?php _e('Theme', VL_DOMAIN); ?></a>
			<?php _e('by', VL_DOMAIN); ?> <a href="http://windyroad.org">
				<img src="http://windyroad.org/static/logos/windyroad-105x15.png" alt="Windy Road" /><?php } ?>
                <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by',VL_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?> <br />
		</p></div><?php
	}?>
	<div class="blogafter">
		<div class="left"></div>
		<div class="right"></div>
		<div class="middle"></div>
	</div>
</div>

</div>
 </div>
<?php wp_footer(); ?>
 </body>
</html>
