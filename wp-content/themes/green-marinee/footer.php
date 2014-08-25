<!-- begin footer -->
<hr />
	<div id="footer">
	<p>&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?>
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
&nbsp;&nbsp;&nbsp;<?php _e('Hosted by',TEMPLATE_DOMAIN); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?><br /><?php wp_footer(); ?>
    </p>
		<div class="extras">
			<ul>
				<li><a href="feed:<?php bloginfo('rss2_url'); ?>" title="Subscribe to RSS feed">RSS</a></li>
				<li><a href="feed:<?php bloginfo('comments_rss2_url'); ?>" title="Subscribe to Comments RSS feed">Comments RSS</a></li>
			</ul>
		</div>
	</div>
	</div>
	</div>
	</div>
	</div>
</div>

</body>
</html>
