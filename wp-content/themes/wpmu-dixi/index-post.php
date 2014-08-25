<?php if( is_front_page() ): ?>

<?php locate_template ( array('index-home.php'), true ); ?>

<?php else: ?>

<?php get_header(); ?>

<div id="post-entry">

<div id="blog-content">

<?php if (have_posts()) : ?>

<?php locate_template ( array('/lib/templates/headline.php'), true ); ?>

<?php while (have_posts()) : the_post(); ?>

<div <?php if(function_exists("post_class")) : ?><?php post_class(); ?><?php else: ?>class="post"<?php endif; ?> id="post-<?php the_ID(); ?>">

<h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>

<?php $postmeta_status = get_option('tn_wpmu_dixi_postmeta_status'); if ($postmeta_status != 'disable') { ?>
<div class="post-author"><?php _e('Posted by', TEMPLATE_DOMAIN); ?>&nbsp;<?php the_author_posts_link(); ?>&nbsp;<?php _e('on', TEMPLATE_DOMAIN); ?>&nbsp;<?php the_time('l, F jS Y') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php edit_post_link(__('edit', TEMPLATE_DOMAIN)); ?></div>
<?php } ?>

<?php do_action('bp_before_post_content'); ?>

<div class="post-content">
<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>
<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?>
<?php the_post_thumbnail(array(200,160), array('class' => 'alignleft')); ?><?php } } ?>
<?php the_excerpt();?>
<p><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php _e('Read the rest of this entry &raquo;',TEMPLATE_DOMAIN); ?></a></p>
<?php } else { ?>
<?php the_content(__('<p>Read the rest of this entry &raquo;</p>', TEMPLATE_DOMAIN)); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php } ?>
</div>

<?php do_action('bp_after_post_content'); ?>

<?php locate_template ( array('/lib/templates/social.php'), false ); ?>

</div>



<?php endwhile; ?>

<?php if ( comments_open() ) { ?><?php comments_template('', true); ?><?php } ?>

<?php locate_template ( array('/lib/templates/paginate.php'), true ); ?>

<?php else: ?>

<?php locate_template ( array('/lib/templates/result.php'), true ); ?>

<?php endif; ?>

</div>

<?php get_sidebar('right'); ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

<?php endif; ?>