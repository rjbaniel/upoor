	<div id="sidebar">



		<ul>

        
<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>




<?php /* If this is a 404 page */ if (is_404()) { ?>

	<?php /* If this is a category archive */ } elseif (is_category()) { ?>

	<li><p><?php _e('You are currently browsing the archives for the', TEMPLATE_DOMAIN);?> <em><?php single_cat_title(''); ?></em> <?php _e('category.', TEMPLATE_DOMAIN);?></p>

<p><?php next_post_link(__('&laquo; previous', TEMPLATE_DOMAIN)) ?> <?php previous_post_link(__('next &raquo;', TEMPLATE_DOMAIN)) ?></p></li>

		

	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>

	<li><p><?php _e('You are currently browsing the', TEMPLATE_DOMAIN);?> <a href="<?php echo get_option('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives', TEMPLATE_DOMAIN);?>

	<?php _e('for the day', TEMPLATE_DOMAIN);?> <?php the_time('l, F jS, Y'); ?>.</p></li>



	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>

	<li><p><?php _e('You are currently browsing the', TEMPLATE_DOMAIN);?> <a href="<?php echo get_option('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives', TEMPLATE_DOMAIN);?>

	for <?php the_time('F, Y'); ?>.</p></li>





      	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>

	<li><p><?php _e('You are currently browsing the', TEMPLATE_DOMAIN);?> <a href="<?php echo get_option('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives');?>

	<?php _e('for the year', TEMPLATE_DOMAIN);?> <?php the_time('Y'); ?>.</p></li>

			

	<?php /* If this is the search page */ } elseif (is_search()) { ?>

	<li><p><?php _e('You have searched the', TEMPLATE_DOMAIN);?> <a href="<?php echo get_option('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives');?>

	<?php _e('for', TEMPLATE_DOMAIN);?> <strong>'<?php echo esc_html($s); ?>'</strong>. <?php _e('If you are unable to find anything in these search results, you can try one of these links.', TEMPLATE_DOMAIN);?></p></li>



<?php /* If this is a single archive */ } elseif (is_single()) { ?>

	<li>

<p><?php _e('You can follow any responses to this entry through the', TEMPLATE_DOMAIN);?>  <?php post_comments_feed_link('RSS 2.0'); ?> <?php _e('feed', TEMPLATE_DOMAIN);?>.

						

						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {

							// Both Comments and Pings are open ?>

							<?php _e('You can', TEMPLATE_DOMAIN);?> <a href="#respond"><?php _e('leave a response', TEMPLATE_DOMAIN);?></a>, <?php _e('or', TEMPLATE_DOMAIN);?> <a href="<?php trackback_url(true); ?>" rel="trackback"><?php _e('trackback', TEMPLATE_DOMAIN);?></a> <?php _e('from your own site', TEMPLATE_DOMAIN);?>.

						

						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {

							// Only Pings are Open ?>

							<?php _e('Responses are currently closed, but you can', TEMPLATE_DOMAIN);?> <a href="<?php trackback_url(true); ?> " rel="trackback"><?php _e('trackback', TEMPLATE_DOMAIN)?></a> <?php _e('from your own site', TEMPLATE_DOMAIN);?>.

						

						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {

							// Comments are open, Pings are not ?>

							<?php _e('You can skip to the end and leave a response. Pinging is currently not allowed.', TEMPLATE_DOMAIN);?>

			

						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {

							// Neither Comments, nor Pings are open ?>

							<?php _e('Both comments and pings are currently closed.', TEMPLATE_DOMAIN);?>

<?php } ?>		

</p></li>



	<?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>

	<li><p><?php _e('You are currently browsing the', TEMPLATE_DOMAIN);?> <a href="<?php echo get_option('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives', TEMPLATE_DOMAIN);?>.</p></li>



	<?php } ?>


           <li id="categories"><h2><?php _e('Categories', TEMPLATE_DOMAIN);?></h2>

<ul>

<?php wp_list_categories(); ?>

</ul></li>




<li id="archives"><h2><?php _e('Archives', TEMPLATE_DOMAIN);?></h2>

<ul>

<?php wp_get_archives(); ?>

</ul></li>







<?php /* If this is the home page */ if (is_home()) { ?>



<?php wp_list_bookmarks(); ?>



<?php } ?>



<li><h2><?php _e('Meta', TEMPLATE_DOMAIN);?></h2>

<ul>

<?php wp_register(); ?>

					<li><?php wp_loginout(); ?></li>



					<li><a href="http://gmpg.org/xfn/"><abbr title="<?php _e('XHTML Friends Network');?>">XFN</abbr></a></li>

				   

					<?php wp_meta(); ?>

</ul></li>



<li>

				<?php include (TEMPLATEPATH . '/searchform.php'); ?>

			</li>

			<?php endif; ?>

		</ul>

	</div>
