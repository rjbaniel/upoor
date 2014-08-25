<?php get_header(); ?>
<?php get_sidebar(); ?>

<div id="content">

	<?php if (have_posts()) :?>
		<?php $postCount=0; ?>
		<?php while (have_posts()) : the_post();?>
			<?php $postCount++;?>


		<div class="navigation">
			<div style="float:right" class="alignright"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignleft"><?php next_post_link('%link &raquo;') ?></div>
		</div>



	<div class="entry entry-<?php echo $postCount ;?>">

		<div class="entrytitle">
			<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', TEMPLATE_DOMAIN);?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<h3><?php the_time(__('F jS, Y')) ?></h3>
		</div>
		<div class="entrybody">
         <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
			<?php the_content(__('Read the rest of this entry &raquo;', TEMPLATE_DOMAIN)); ?>
         <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
		</div>
		
		<div class="entrymeta">
		<div class="postinfo">
			<p class="postedby"><?php _e('Posted by', TEMPLATE_DOMAIN);?> <?php the_author_posts_link() ?> 		<?php comments_popup_link(__('No Comments &#187;', TEMPLATE_DOMAIN), __('1 Comment &#187;', TEMPLATE_DOMAIN),__('% Comments &#187;', TEMPLATE_DOMAIN), 'commentslink'); ?></p>
		<p class="filedto"><?php _e('Filed under', TEMPLATE_DOMAIN);?>: <?php the_category(', ') ?> <?php edit_post_link(__('Edit', TEMPLATE_DOMAIN), ' | ', ''); ?></p>
		</div>

		</div>

				<p class="entrymeta">
						<?php _e('This entry was posted', TEMPLATE_DOMAIN);?>
						<?php /* This is commented, because it requires a little adjusting sometimes.
							You'll need to download this plugin, and follow the instructions:
							http://binarybonsai.com/archives/2004/08/17/time-since-plugin/ */
							/* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; */ ?>
						<?php _e('on', TEMPLATE_DOMAIN);?> <?php the_time(__('l, F jS, Y')) ?> <?php _e('at', TEMPLATE_DOMAIN);?> <?php the_time() ?>
						<?php _e('and is filed under', TEMPLATE_DOMAIN);?> <?php the_category(', ') ?>.<br />
						<?php _e("You can follow any responses to this entry through the",TEMPLATE_DOMAIN); ?> <?php post_comments_feed_link('RSS 2.0'); ?> <?php _e('feed', TEMPLATE_DOMAIN);?>.

						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>
							<?php _e('You can', TEMPLATE_DOMAIN);?>  <a href="#respond"><?php _e('leave a response', TEMPLATE_DOMAIN);?></a>, <?php _e('or', TEMPLATE_DOMAIN);?> <a href="<?php trackback_url(true); ?>" rel="trackback"><?php _e('trackback', TEMPLATE_DOMAIN);?></a> <?php _e('from your own site', TEMPLATE_DOMAIN);?>.

						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open ?>
							<?php _e('Responses are currently closed, but you can', TEMPLATE_DOMAIN);?> <a href="<?php trackback_url(true); ?> " rel="trackback"><?php _e('trackback', TEMPLATE_DOMAIN)?></a> <?php _e('from your own site', TEMPLATE_DOMAIN);?>.

						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
							<?php _e('You can skip to the end and leave a response. Pinging is currently not allowed.', TEMPLATE_DOMAIN);?>

						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
							<?php _e('Both comments and pings are currently closed.', TEMPLATE_DOMAIN);?>

						<?php } edit_post_link(__('Edit this entry.', TEMPLATE_DOMAIN),'',''); ?>

				</p>
		
	</div>

	<div class="commentsblock">
		<?php comments_template('',true); ?>
	</div>
		<?php endwhile; ?>
		
	<?php else : ?>

		<h2><?php _e('Not Found', TEMPLATE_DOMAIN);?></h2>
		<div class="entrybody"><?php _e("Sorry, but you are looking for something that isn't here.", TEMPLATE_DOMAIN);?></div>

	<?php endif; ?>
<?php
$this_post = $post;
$category = get_the_category(); $category = $category[0]; $category = $category->cat_ID;
$posts = get_posts('numberposts=6&offset=0&orderby=post_date&order=DESC&category='.$category);
$count = 0;
foreach ( $posts as $post ) {
	if ( $post->ID == $this_post->ID || $count == 5) {
	unset($posts[$count]);
	}else{
	$count ++;
	}
}
?>
<?php if ( $posts ) : ?>
<div class="entrytitle">
	<h3><?php _e('See also', TEMPLATE_DOMAIN);?>:</h3>
<ul>
<?php foreach ( $posts as $post ) : ?>
<li><a href="<?php the_permalink() ?>" title="<?php echo trim(str_replace("\n"," ",preg_replace('#<[^>]*?>#si','',get_the_excerpt()))) ?>"><?php if ( get_the_title() ){ the_title(); }else{ echo "Untitled"; } ?></a> (<?php the_time(__('F jS, Y')) ?>)</li>
<?php endforeach // $posts as $post ?>
</ul>
	</div>
<?php endif // $posts ?>
	
</div>
<?php get_footer(); ?>
