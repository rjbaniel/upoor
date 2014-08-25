<?php get_header(); ?>

	<div id="content" class="narrowcolumn">
				
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div class="navigation">
			<div class="alignleft"><?php previous_post_link('%link') ?></div>
			<div class="alignright"><?php next_post_link('%link') ?></div>
		</div>
	
		<div class="post" id="post-<?php the_ID(); ?>">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',TEMPLATE_DOMAIN);?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<div class="metaright"><div class="articlemeta"><span class="editentry"><?php edit_post_link('<img src="'.get_bloginfo('template_directory').'/images/pencil.png" alt="'.__("Edit Link").'" />','<span class="editlink">','</span>'); ?></span>	<li class="date"><?php the_time('M jS, Y') ?></li> | <li class="cat"><?php the_category(', ') ?></li> | <li class="comm"> <?php comments_popup_link(__('No Comments',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN)); ?></li> <br/></div></div>
		<div class="metaright"><?php the_tags(__('Tags: '), ', ', ''); ?></div>


				<div class="entrytext">
			
             <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
				
				<?php the_content(__('<p class="serif">Read the rest of this entry &raquo;</p>',TEMPLATE_DOMAIN)); ?>
	
				<?php wp_link_pages('<p><strong>'.__('Pages').':</strong> ', '</p>', 'number'); ?>


              <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
	</div> <!-- end entry text -->
				<div class="postmetadata">
					<small>
						<?php the_author(); ?> <?php _e("posted this entry",TEMPLATE_DOMAIN); ?> <?php _e('on',TEMPLATE_DOMAIN);?> <?php the_time(__('l, F jS, Y')) ?> <?php _e('at',TEMPLATE_DOMAIN);?> <?php the_time() ?>.
						<?php _e("Posted in the category",TEMPLATE_DOMAIN); ?> <?php the_category(', ') ?>
			   <li class="utwtags"><?php the_tags(__('Tags: '), ', ', ''); ?></li><br/>
						<?php _e("You can follow any responses to this entry through the",TEMPLATE_DOMAIN); ?> <?php post_comments_feed_link('RSS 2.0'); ?> <?php _e('feed',TEMPLATE_DOMAIN);?>.

						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>
							<?php _e('You can',TEMPLATE_DOMAIN);?>  <a href="#respond"><?php _e('leave a response',TEMPLATE_DOMAIN);?></a>, <?php _e('or',TEMPLATE_DOMAIN);?> <a href="<?php trackback_url(true); ?>" rel="trackback"><?php _e('trackback',TEMPLATE_DOMAIN);?></a> <?php _e('from your own site',TEMPLATE_DOMAIN);?>.
						
						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open ?>
							<?php _e('Responses are currently closed, but you can',TEMPLATE_DOMAIN);?> <a href="<?php trackback_url(true); ?> " rel="trackback"><?php _e('trackback',TEMPLATE_DOMAIN)?></a> <?php _e('from your own site',TEMPLATE_DOMAIN);?>.
						
						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
							<?php _e('You can skip to the end and leave a response. Pinging is currently not allowed.',TEMPLATE_DOMAIN);?>

						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
							<?php _e('Both comments and pings are currently closed.',TEMPLATE_DOMAIN);?>
						
						<?php } edit_post_link(__('Edit this entry.',TEMPLATE_DOMAIN),'',''); ?>
						
					</small>
				
<?php if (function_exists('UTW_ShowRelatedPostsForCurrentPost')) : ?>	<h3>Related Posts</h3>

<div class="utwrelposts"><?php UTW_ShowRelatedPostsForCurrentPost("postcommalist", "", "") ?></div> <?php endif; ?>
			</div>
		</div>
		
	<?php comments_template('',true); ?>
	
	<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.',TEMPLATE_DOMAIN);?></p>
	
<?php endif; ?>
	
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
