<?php get_header(); ?>

	<div id="content">			
  	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div class="post" id="post-<?php the_ID(); ?>">
		<div class="navigation">
			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
		</div>
		<div class="clear"></div>
			<h1><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e("Permanent Link:",TEMPLATE_DOMAIN); ?>
			<?php the_title(); ?>"><?php the_title(); ?></a></h1>
	
			<div class="entry">
				<?php the_content(); ?>
	
				<p class="postmetadata alt">
				<small><?php _e("Posted:",TEMPLATE_DOMAIN); ?> <?php the_time('m|j|y') ?> <?php _e("at",TEMPLATE_DOMAIN); ?> <?php the_time() ?>.
				<?php _e("Filed under:",TEMPLATE_DOMAIN); ?> <?php the_category(', ') ?>.
				<br /><?php the_tags('Tags: ', ', '); ?><br />
				<?php _e("New here? Follow this entry via",TEMPLATE_DOMAIN); ?> <?php post_comments_feed_link('RSS 2.0'); ?>. <?php edit_post_link(__('[edit]',TEMPLATE_DOMAIN)); ?>

				<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
				// Both Comments and Pings are open ?>
				<a href="#respond"><?php _e("Comment",TEMPLATE_DOMAIN); ?></a> | <a href="<?php trackback_url(true); ?>" rel="trackback"><?php _e("Trackback",TEMPLATE_DOMAIN); ?></a>
						
				<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
				// Only Pings are Open ?>
				<?php _e("Comments are closed, but you can",TEMPLATE_DOMAIN); ?> <a href="<?php trackback_url(true); ?> " rel="trackback"><?php _e("trackback",TEMPLATE_DOMAIN); ?></a> <?php _e("from your own site.",TEMPLATE_DOMAIN); ?>

				<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
				// Comments are open, Pings are not ?>
				<?php _e("Pinging is currently disabled.",TEMPLATE_DOMAIN); ?>
			
				<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
				// Neither Comments, nor Pings are open ?>
				<?php _e("Comments and pings are currently closed.",TEMPLATE_DOMAIN); ?>
						
				<?php } edit_post_link(__('Moderate',TEMPLATE_DOMAIN),'',''); ?>
				</small>
				</p>
	
			</div>
		</div>
		
	<div id="comments">
		<?php comments_template('',true); ?>
	</div>
	<?php endwhile; else: ?>

	<p><?php _e("Sorry, no posts matched your criteria.",TEMPLATE_DOMAIN); ?></p>

	<?php endif; ?>
	
	</div>

<?php include(TEMPLATEPATH."/left.php");?>
<?php include(TEMPLATEPATH."/right.php");?>

<?php get_footer(); ?>
