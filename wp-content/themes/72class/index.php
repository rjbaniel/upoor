<?php get_header(); ?>

<!-- open wrapper --><div id="wrapper">

<!-- open content --><div id="content">



<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<!-- open post --><div <?php if(function_exists("post_class")) : ?><?php post_class(); ?><?php else: ?>class="post"<?php endif; ?> id="post-<?php the_ID(); ?>">

<!-- open date --><div class="date">
<span><?php the_time('M') ?></span> <?php the_time('d') ?>
<!-- close date --></div>

<!-- open title --><div class="title">
<h2>
<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', '72class');?> <?php the_title(); ?>">
<?php the_title(); ?></a>
</h2>

<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("72890nocolor"); } ?>
<!-- open postdata --><div class="postdata">
<span class="category">
<?php _e('Posted in ', '72class');?> <?php the_category(' ') ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php the_tags( '&nbsp;' . __( 'Tagged' , '72class') . ' ', ', ', ''); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php edit_post_link(__('Edit', TEMPLATE_DOMAIN)); ?> </span>
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
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("72890nocolor"); } ?>
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
<?php include (TEMPLATEPATH . "/searchform.php"); ?>

<?php endif; ?>

<!-- close content --></div>
<!-- close wrapper --></div>
<!-- close page --></div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
