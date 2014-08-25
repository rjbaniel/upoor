<?php get_header(); ?>
<?php get_sidebar(); ?>

<div id="content">
<?php if (have_posts()) : ?>
<?php $post = $posts[0]; ?>

<?php if (is_category()) { ?><h2><?php _e('Archive for', 'wp-andreas'); ?> '<?php echo single_cat_title(); ?>'</h2>
<?php } elseif (is_day()) { ?><h2><?php _e('Archive for', 'wp-andreas'); ?> <?php the_time('F jS, Y'); ?></h2>
<?php } elseif (is_month()) { ?><h2><?php _e('Archive for', 'wp-andreas'); ?> <?php the_time('F, Y'); ?></h2>
<?php } elseif (is_year()) { ?><h2><?php _e('Archive for the year', 'wp-andreas'); ?> <?php the_time('Y'); ?></h2>
<?php } elseif (is_tag()) { ?><h2><?php _e('Tag: ', 'wp-andreas'); ?><?php single_tag_title(''); ?></h2>
<?php } elseif (is_search()) { ?><h2><?php _e('Search results', 'wp-andreas'); ?></h2>
<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?><h2><?php _e('Archives', 'wp-andreas'); ?></h2>
<?php } ?>

<?php while (have_posts()) : the_post(); ?>
<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
<div class="contenttext">
<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

<?php the_content( __('<p>Click here to read more</p>', 'wp-andreas') ); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } ?>

</div>

<p class="postinfo"><strong><?php _e('Posted:', 'wp-andreas'); ?></strong> <?php the_time('F jS, Y') ?> <?php _e('under', 'wp-andreas'); ?> <?php the_category(', ') ?>.<br />
<?php the_tags(__('Tags: ', 'wp-andreas'), ', ', '<br />'); ?>
<a href="<?php comments_link(); ?>"><strong><?php _e('Comments:', 'wp-andreas'); ?></strong> <?php comments_number(__('none', 'wp-andreas'),'1','%'); ?></a>
<?php edit_post_link(__('[e]', 'wp-andreas'),' | ',''); ?></p>

<?php endwhile; ?>
<div class="navigation">
<p><span class="prevlink"><?php next_posts_link(__('&laquo; Previous entries', 'wp-andreas')) ?></span>
<span class="nextlink"><?php previous_posts_link(__('Next entries &raquo;', 'wp-andreas')) ?></span></p>
</div>

<?php else : ?>
<h2><?php _e('Page not found!', 'wp-andreas'); ?></h2>
<p><?php _e('The page you trying to reach does not exist, or has been moved. Please use the menus or the search box to find what you are looking for.', 'wp-andreas'); ?></p>
<?php endif; ?>

</div>
<?php get_footer(); ?>
