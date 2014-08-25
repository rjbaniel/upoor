<?php get_header(); ?>

<!-- open wrapper --><div id="wrapper">

<!-- open content --><div id="content">

<?php if (have_posts()) : ?>
<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php /* If this is a category archive */ if (is_category()) { ?>				
<h1 class="pagetitle"><?php echo single_cat_title(); ?> <?php _e('Archive', '72class');?></h1>
<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
<h1 class="pagetitle"><?php the_time(__('F jS, Y')); ?> <?php _e('Archive', '72class');?></h1>
<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
<h1 class="pagetitle"><?php the_time('F, Y'); ?> <?php _e('Archive', '72class');?></h1>
<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
<h1 class="pagetitle"><?php the_time('Y'); ?> <?php _e('Archive', '72class');?></h1>
<?php /* If this is a search */ } elseif (is_search()) { ?>
<h1 class="pagetitle"><?php _e('Search Results', '72class');?></h1>
<?php /* If this is an author archive */ } elseif (is_author()) { ?>
<h1 class="pagetitle"><?php _e('Author Archive', '72class');?></h1>
<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
<h1 class="pagetitle"><?php _e('Blog Archives', '72class');?></h1>
<?php } ?>

<?php while (have_posts()) : the_post(); ?>

<!-- open post --><div class="post" id="post-<?php the_ID(); ?>">

<!-- open date --><div class="date">
<span><?php the_time('M') ?></span> <?php the_time('d') ?>
<!-- close date --></div>

<!-- open title --><div class="title">
<h2>
<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', '72class');?> <?php the_title(); ?>">
<?php the_title(); ?></a>
</h2>
<!-- open postdata --><div class="postdata">
<span class="category">
<?php _e('Posted in ', '72class');?> <?php the_category(', ') ?> <?php if(function_exists('the_views')) { the_views(); } ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php edit_post_link(__('Edit', TEMPLATE_DOMAIN)); ?> </span>
<span class="right mini-add-comment">
<?php comments_popup_link(__('No Comments &#187;', '72class'), __('1 Comment &#187;', '72class'), __('% Comments &#187;', '72class')); ?></span>
<!-- close postdata --></div>
<!-- close title --></div>

<!-- open clearing --><div class="clearing"><!-- close clearing --></div>

<!-- open entry --><div class="entry">
<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>
<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?>
<?php the_post_thumbnail(array(200,160), array('class' => 'alignleft')); ?><?php } } ?>
<?php the_excerpt();?>
<p><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php _e('Read the rest of this entry &raquo;',TEMPLATE_DOMAIN); ?></a></p>
<?php } else { ?>
<?php the_content(__('<p>Read the rest of this entry &raquo;</p>', TEMPLATE_DOMAIN)); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php } ?>
<!-- close entry --></div>
<!-- close post --></div>

<?php endwhile; ?>

<!-- open navigation --><div class="navigation">
<span class="alignleft">
<?php next_posts_link(__('Previous Entries', '72class')) ?>
</span>
<span class="alignright">
<?php previous_posts_link(__('Next Entries', '72class')) ?>
</span>
<!-- close navigation --></div>

<?php else : ?>

<h2 class="center"><?php _e('Not Found', '72class');?></h2>
<p class="center"><?php _e("Sorry, but you are looking for something that isn't here.", '72class');?></p>

<?php endif; ?>

<!-- close content --></div>
<!-- close wrapper --></div>
<!-- close page --></div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
