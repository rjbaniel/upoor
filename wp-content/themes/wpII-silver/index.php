<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="content">

<?php
if( file_exists( ABSPATH . WPINC . '/class-simplepie.php') ) {
	require_once(ABSPATH . WPINC . '/class-simplepie.php');
} else {
	require_once(ABSPATH . WPINC . '/rss-functions.php');
}
$flickr_tag = get_option('flickrock');
if (!empty($flickr_tag)){
	echo '<div id="flickr">';
	$rss_url = 'http://www.flickr.com/services/feeds/photos_public.gne?tags='.$flickr_tag.'&format=rss_200';
	$rss = @fetch_rss($rss_url);
	$items = array_slice($rss->items, 0, 7);
	foreach ( $items as $item ) {
	if(preg_match('<img src="([^"]*)" [^/]*/>', $item['description'],$imgUrlMatches)) {
		$imgurl = $imgUrlMatches[1];
             	$imgurl = str_replace("_m.jpg", "_s.jpg", $imgurl);
           }
	echo '<img alt="flickr Photo" src="'.$imgurl.'" />';
	}
	echo '</div>';
}
?>
	<?php if (have_posts()) :?>
		<?php $postCount=0; ?>
		<?php while (have_posts()) : the_post();?>
			<?php $postCount++;?>
	<div class="entry entry-<?php echo $postCount ;?>">
		<div class="entrytitle">
			<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', TEMPLATE_DOMAIN);?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<h3><?php the_time(__('F jS, Y')) ?></h3>
		</div>
		<div class="entrybody">

			<?php the_content(__('Read the rest of this entry &raquo;', TEMPLATE_DOMAIN)); ?>

		</div>
		
		<div class="entrymeta">
		<div class="postinfo">
			<p class="postedby"><?php _e('Posted by', TEMPLATE_DOMAIN);?> <?php the_author_posts_link() ?> 		<?php comments_popup_link(__('No Comments &#187;', TEMPLATE_DOMAIN), __('1 Comment &#187;', TEMPLATE_DOMAIN),__('% Comments &#187;', TEMPLATE_DOMAIN), 'commentslink'); ?></p>
			<p class="filedto"><?php _e('Filed under:', TEMPLATE_DOMAIN);?> <?php the_category(', ') ?><?php the_tags( '&nbsp;' . __( 'and tagged', TEMPLATE_DOMAIN ) . ' ', ', ', ''); ?><?php edit_post_link(__('Edit', TEMPLATE_DOMAIN), ' | ', ''); ?></p>
		</div>

			<div class="feedback">
			<?php comments_popup_link(__('No Response', TEMPLATE_DOMAIN), __('1 Pings', TEMPLATE_DOMAIN),__('% Pings', TEMPLATE_DOMAIN),  'commentslink'); ?>
			</div>
		</div>

	</div>

   
		<?php endwhile; ?>
		<div class="navigation">
			<div style="float:right" class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', TEMPLATE_DOMAIN)) ?></div>
			<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', TEMPLATE_DOMAIN)) ?></div>
		</div>
		
	<?php else : ?>

		<h2><?php _e('Not Found', TEMPLATE_DOMAIN);?></h2>
		<div class="entrybody"><?php _e("Sorry, but you are looking for something that isn't here.", TEMPLATE_DOMAIN);?></div>

	<?php endif; ?>

</div>
<?php get_footer(); ?>
