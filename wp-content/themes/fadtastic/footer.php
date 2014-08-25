</div>
</div>

<div id="feed_bar">
 	<p><?php _e('Liked it here?'); ?><br />
	<span class="small"><?php _e('Why not tryout the sites on the blogroll...'); ?></span></p>
</div>

<div id="footer">
	<div id="footer_wrapper">
		<div class="content_padding">
			 <div class="footer_links">
				   <ul class="blogroll_list">
						<?php wp_list_bookmarks(array(
							'title_before' => '<h4>',
							'title_after' => '</h4>', 
							'before' => '<li>',
							'after' => '</li>',
							'show_images'=>true)
							); ?>
				   </ul>
			</div>
			<div class="footer_meta">

				<p>&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?>&nbsp;&nbsp;&nbsp;<?php if( SHOW_AUTHORS != 'false') { ?>Theme <a href="http://fadtastic.net/theme/">Fadtastic</a> by Andrew Faulkner.<br />
				<?php } ?><?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by', 'fadtastic'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
                   <br />
                   <?php wp_footer(); ?>
                </p>
			</div>
			
		</div>
	</div>
</div>


</body>
</html>

