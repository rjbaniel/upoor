<?php get_header();?>

		<div id="content">
		
			<!-- primary content start -->
			<div class="post" id="post-<?php the_ID(); ?>">
				<div class="header">
					<div class="date"><em class="user"><?php _e("Server",TEMPLATE_DOMAIN); ?></em> <br/><em class="postdate"><?php echo date ('h:m:s a') ?></em></div>
					<h3><?php _e("404 - Not Found",TEMPLATE_DOMAIN); ?></h3>
				</div>
				<div class="entry">
					 <p><?php _e("The Server tried all of its options before returning this page to you.",TEMPLATE_DOMAIN); ?></p>
					<p><?php _e("You are looking for something that is not here. Please try searching or browsing the archives.",TEMPLATE_DOMAIN); ?></p>
				</div>
				<div class="footer">
					<ul>
						<li class="readmore"><?php _e("Not Found ",TEMPLATE_DOMAIN); ?><?php edit_post_link(__('Edit',TEMPLATE_DOMAIN)); ?></li>
					</ul>
				</div>				
			</div>				
			<!-- primary content end -->	
		</div>		
	<?php get_sidebar();?>	
<?php get_footer();?>
