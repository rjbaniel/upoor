


<hr />


<div id="footer">


	<p>


		&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?>
        <br />
        <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<?php _e('Hosted by', 'batavia'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>
		<br /><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Entries (RSS)');?></a>


		<?php _e('and ');?> <a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments (RSS)', 'batavia');?></a>.


		<br />

         <?php wp_footer(); ?>
	</p>



</div>


</div>





<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/kubrick/ -->


<?php /* "Just what do you think you're doing Dave?" */ ?>










</body>


</html>
