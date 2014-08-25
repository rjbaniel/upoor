<?php/*Template Name: Custom Search Page*/?>
<?php get_header(); ?>
	<div id="content">
<h2 class="pagetitle">Search Result for 
<?php /* Search Count */ 
$allsearch = &new WP_Query("s=$s&showposts=-1");
$key = esc_html($s, 1); 
$count = $allsearch->post_count;
echo sprintf(__('<span class="search-terms">%s</span> &mdash; %d articles'), $key, $count);
wp_reset_query(); ?>
</h2>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>  
<div class="post" id="post-<?php the_ID(); ?>">
<?php $title = get_the_title(); 
$keys= explode(" ",$s); 
$title = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $title); ?>
<h2 id="result-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php echo $title; ?></a></h2>
	<div class="entrytext">
	  <?php the_excerpt(); ?>
	</div>
 </div>
	<?php endwhile; endif; ?></div>
<div class="nextprev">
<div class="alignright"><?php next_posts_link(__('Next results &raquo;')) ?>
 <?php previous_post_link('&laquo; %link') ?></div>
<div class="alignleft"><?php previous_posts_link(__('&laquo; Previous results')) ?>
 <?php next_post_link('%link &raquo;') ?></div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
