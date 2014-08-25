
		<ul id="footer">
			<li>&copy; <?php echo gmdate(__('Y')); ?>  <?php bloginfo('name'); ?>&nbsp;&nbsp;&nbsp;</li>
			<!-- I'd appreciate the credit being left in, thanks in advance -->
			<?php if( SHOW_AUTHORS != 'false') { ?><li><a href="http://www.binarymoon.co.uk/" title="Regulus by Ben Gillbanks from Binary Moon - video games and emtertainment"><?php _e('Regulus by Ben @ Binary Moon','regulus'); ?></a></li>
			<?php } ?>
            <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?>
<li><?php _e('Hosted by','regulus'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a></li>
<?php } ?>
			<li><a href="#nav" title="<?php _e('Jump to top of page','regulus'); ?>"><?php _e('Top','regulus'); ?></a></li>
		</ul>
		
	</div>
	
	<?php wp_footer(); ?>
</body>
</html>
