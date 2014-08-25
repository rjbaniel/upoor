					<div id="footer" class="clearfix">

						<div>

							<ul class="footer-pages clearfix">

								<li class="first"><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?> Home"><?php _e('Home', 'colorpaper'); ?></a></li>

								<?php wp_list_pages('title_li=&depth=1'); ?>

							</ul>

			<br><p><big><strong>&copy; Copyright <?php bloginfo('name'); ?>. All rights reserved.</strong</big>
<?php if( SHOW_AUTHORS != 'false') { ?>
<br />
Designed by FTL <a href="http://www.freethemelayouts.com/" style="color: #dce7c0;text-decoration: none;">Wordpress Themes</a> brought to you by <a href="http://smashingmagazine.com/" style="color: #dce7c0;text-decoration: none;">Smashing Magazine</a>.<?php } ?> <?php if(function_exists('get_current_site')) { $current_site = get_current_site();  $current_network_site = get_current_site_name(get_current_site());  ?><?php _e('Hosted by', 'colorpaper'); ?> <a style="color: #dce7c0;text-decoration: none;" target="_blank" href="http://<?php echo $current_site->domain . $current_site->path ?>"><?php echo $current_network_site->site_name; ?></a>
<?php } ?>



								</p>

						</div>

						<a href="#top" class="btn btn-footer right"><?php _e('Back to Top', 'colorpaper'); ?></a>

					</div>

				</div>

			</div>

		</div>

	</div></div>

	<?php wp_footer(); ?>

</body>

</html>
