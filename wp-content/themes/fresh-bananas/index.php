<?php get_header(); ?>

<?php /* These tell the user what type of archive they're on. You can easily customize the messages here. They use _e("...") to make them easily translated into other languages. This should help in localization a bunch. This also reduces the need for a page for all these types of archives. Unless you're using a very different setup on each one, this way seems to be much lighter on file sizes, markup, work, etc... */ ?>

<?php // This is the main loop. Body content is passed in through this code. ?>

<?php is_tag(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<h1><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e('Permalink for','fresh-bananas');?> <?php the_title(); ?>"><?php the_title(); ?></a></h1>
<?php // Spit out the header with a link to the article. ?>

<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>

<?php } else { ?>

<?php the_content( __('<p>Click here to read more</p>', 'fresh-bananas') ); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>

<?php } ?>


<p class="meta"><?php the_time(get_option('date_format')); ?>. <?php if (is_callable('the_tags')) the_tags(__('Tags: ','fresh-bananas'), ', ', '.'); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('Category: ','fresh-bananas'); ?> <?php the_category(', '); ?>.&nbsp;&nbsp;&nbsp;<a href="<?php comments_link(); ?>"><?php comments_number(); ?></a>. <?php edit_post_link(__('Edit','fresh-bananas')); ?></p>

<?php // The information related to the post, such as the date, category, and comments. ?>

<?php endwhile; // End looping ?>

<p style="margin-top: 35px;"><?php posts_nav_link('','',__('Older Entries','fresh-bananas')) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php posts_nav_link('',__('Newer Entries','fresh-bananas'),'') ?></p>
<?php // Go to previous and newer posts links. This is needed because WordPress by default limits the number of posts you may have in the loop.?>

<?php else: ?>
<?php if ( is_search () ) { ?>
<p><?php _e('Sadly however, no results were found. Please try searching again.','fresh-bananas'); ?></p>

<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">

<input type="text" value="<?php echo esc_html($s, 1); ?>" name="s" id="s" length="20" />
<input type="submit" id="searchsubmit" name="Submit" value="<?php _e("Search",'fresh-bananas'); ?>" />
</form>

<?php } else { ?>
<p><?php _e('Sorry, no posts matched your criteria.','fresh-bananas'); ?></p>
<?php } endif; ?>

<?php get_footer(); ?>
