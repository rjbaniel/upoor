<?php get_header(); ?>

<div id="maincontent">
<?php if (have_posts()) : while(have_posts()) : the_post(); ?>
    <div class="post">
        <h2 class="posttitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p class="postinfo"><a href="<?php the_permalink(); ?>"><?php comments_number(__('Comments: 0',TEMPLATE_DOMAIN), __('Comments: 1',TEMPLATE_DOMAIN), __('Comments: %',TEMPLATE_DOMAIN)); ?></a> - Date: <?php the_time(__('F jS, Y')) ?> - <?php _e("Categories:",TEMPLATE_DOMAIN); ?> <?php the_category(', ') ?><?php the_tags( '&nbsp;' . __( 'Tagged:',TEMPLATE_DOMAIN ) . ' ', ', ', ''); ?> </p>


        <div class="postcontent">

         <?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

<?php the_content( __('<p>Click here to read more</p>',TEMPLATE_DOMAIN) ); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } ?>


        </div>


    </div>
    <?php endwhile; else: ?>
    <div class="post">
        <h2 class="posttitle"><?php _e("No posts found",TEMPLATE_DOMAIN); ?></h2>
        <p class="postinfo">&nbsp;</p>
	<div class="postcontent"><p><?php _e("No posts were found matching your criteria",TEMPLATE_DOMAIN); ?></p></div>
    </div>

<?php endif; ?>


<div class="post"><div class="postcontent"><p class="pagenav"><?php posts_nav_link(); ?></p></div></div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
