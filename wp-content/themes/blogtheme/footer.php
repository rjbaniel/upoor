

		</div><!--wrap-->

		

		</div><!--contentwrap-->

	

	</div><!--outerwrap-->

	

	<div class="clearfix"></div>

	

	<div id="footer">

		

		<div class="container_12">

		

			<div class="grid_4 alpha">

				

				<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) :endif; ?>	

		

			</div><!--grid_4-->



			<div class="grid_4">



				<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar(3) ) :endif; ?>	

		

			</div><!--grid_4-->



			<div class="grid_4 omega">



				<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar(4) ) :endif; ?>				

		

			</div><!--grid_4-->				



			<div class="clearfix"></div>

			

			<div id="credit">



				<p>&copy;<?php echo gmdate(__('Y')); ?> <a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a>. All Rights Reserved. <?php if( SHOW_AUTHORS != 'false') { ?><br />Theme by <a href="http://woothemes.com/">WooThemes</a><?php } ?>
<?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?><br />
<?php _e('Hosted by', 'blogtheme'); ?> <a title="<?php echo $current_network_site->site_name; ?>" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>.<br /><?php wp_footer(); ?> </p>



			</div>

		

		</div><!--container_12-->

		

	</div>



<?php

$twitter_status =  get_option('woo_twitter');

if( $twitter_status != "" ) { ?>

<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>

<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo get_option('woo_twitter'); ?>.json?callback=twitterCallback2&amp;count=1"></script>

<?php } ?>







<?php if ( get_option('woo_google_analytics') <> "" ) { echo stripslashes(get_option('woo_google_analytics')); } ?>



</body>

</html>
