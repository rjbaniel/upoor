<?php get_header(); ?>
<table class="content_table columns" cellspacing="0">
	<tbody class="content_tbody">
		<tr class="content_tr">
<td id="content" class="content_td column round-left">
	<div class="wrapper">
		<div class="section">
		<div id="tip-control">
			<?php
	// If this is a category archive
	if (is_category()) {
		printf( __('Archive for the &#8216;%1$s&#8217; Category', 'retweet'), single_cat_title('', false) );	
	// If this is a tag archive
	} elseif(is_tag()) {
		printf( __('Posts Tagged &#8216;%1$s&#8217;', 'retweet'), single_tag_title('', false) );
	// If this is a daily archive
	} elseif (is_day()) {
		printf( __('Archive for %1$s', 'retweet'), get_the_time(__('F jS, Y', 'retweet')) );
	// If this is a monthly archive
	} elseif (is_month()) {
		printf( __('Archive for %1$s', 'retweet'), get_the_time(__('F, Y', 'retweet')) );
	// If this is a yearly archive
	} elseif (is_year()) {
		printf( __('Archive for %1$s', 'retweet'), get_the_time(__('Y', 'retweet')) ); 
	} elseif (is_author()) { ; ?>
<?php
if(isset($_GET['author_name'])) :
$curauth = get_userdatabylogin(get_the_author_login());
else :
$curauth = get_userdata(intval($author));
endif;
?>
<a href="<?php $curauth->user_url; ?>"><?php echo $curauth->display_name; ?></a> <?php echo $curauth->description; ?>
<?php
	// If this is a paged archive
	} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
		_e('Blog Archives', 'retweet');
	}
	?>
		</div>
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
			<div class="entry" id="post-<?php the_ID(); ?>">
				<h2 class="posttitle"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<p class="postmeta"><span class="date"><?php _e('Date : ', 'retweet') ?><?php the_time(__('F jS, Y', 'retweet')) ?></span><span class="category"><?php _e('Category : ', 'retweet') ?><?php the_category(', ') ?></span><span class="author"><?php _e('Author : ', 'retweet') ?><?php the_author_posts_link(); ?></span><span class="comment"><?php comments_popup_link(__('No comments', 'retweet'), __('1 Comment', 'retweet'), __('% Comments', 'retweet')); ?></span>
				</p>
				<div class="panel">
					<span class="add_fav"><a href="javascript:void(location.href='http://twitter.com/home?status=Now%20reading%20&lt;<?php the_title(); ?>&gt;%20<?php the_permalink(); ?>')" title="<?php _e('Tweet This', 'retweet') ?>"> </a></span>
					<span class="add_comment"><a href="<?php the_permalink(); ?>#comments" title="<?php _e('Add a comment', 'retweet') ?>"> </a></span>
					<?php edit_post_link(' ' , '<span class="edit_post">', '</span>'); ?>
				</div>

				<div class="post">

               <?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

<?php the_content(__('More &raquo;' ,'retweet')) ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } ?>
                </div>

				<?php the_tags('<p class="tag"> Tags : ', ', ', '</p>'); ?>
			</div>
			<?php endwhile; ?>
			<?php if(function_exists('wp_pagenavi')) : ?>
			<?php wp_pagenavi() ?>
			<?php else : ?>
				<div id="pagination" class="navigation round">
					<div class="alignleft"><?php previous_posts_link(__('&laquo; Older Entries', 'retweet')) ?></div>
					<div class="alignright"><?php next_posts_link(__('Newer Entries &raquo;', 'retweet')) ?></div>
				</div>
			<?php endif; ?>
		<?php else : ?>
			<div class="entry" id="404">
				<h2 class="posttitle"><a href="javascript:history.back();" title="<?php _e('Not Found', 'retweet') ?>" rel="bookmark"><?php _e('Not Found', 'retweet') ?></a></h2>
				<div class="post"><?php _e('Sorry, but you are searching for something that is not here.', 'retweet') ?></div>
			</div>
		<?php endif; ?>
		</div>
	</div>
</td>
<td id="side_base" class="content_td column round-right">
	<?php get_sidebar(); ?>
</td>
		</tr>
	</tbody>
</table>
<?php get_footer(); ?>
