<?php get_header(); ?>
<div id="container">
<div id="left-div">
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

    <!--Start Post-->
    <div class="home-post-wrap2">
    <?php if (get_option('cion_share_this_pages') == 'on') { ?>
        <!--Begin Share Button-->
        <img src="<?php echo get_template_directory_uri(); ?>/images/share-<?php echo esc_attr(get_option('cion_color_scheme')); ?>.gif" alt="delete" class="share" style="float: right; margin-right: 10px; margin-bottom: 5px; cursor: pointer; clear: left; visibility: <?php echo esc_attr(get_option('cion_share')); ?>;" />
        <div class="share-div" style="clear: both;"> <a href="http://del.icio.us/post?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-1.gif" alt="bookmark" style="float: left; margin-left: 15px; margin-right: 8px; border: none;" /></a> <a href="http://www.digg.com/submit?phase=2&amp;url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-2.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> <a href="http://www.reddit.com/submit?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-3.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> <a href="http://www.stumbleupon.com/submit?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-4.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> <a href="http://www.squidoo.com/lensmaster/bookmark?<?php the_permalink() ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-5.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> <a href="http://myweb2.search.yahoo.com/myresults/bookmarklet?t=<?php the_title(); ?>&amp;u=<?php the_permalink() ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-6.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> <a href="http://www.google.com/bookmarks/mark?op=edit&amp;bkmk=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-7.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> <a href="http://www.blinklist.com/index.php?Action=Blink/addblink.php&amp;Url=<?php the_permalink() ?>&amp;Title=<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-8.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> <a href="http://www.technorati.com/faves?add=<?php the_permalink() ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-9.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> <a href="http://www.furl.net/storeIt.jsp?t=<?php the_title(); ?>&amp;u=<?php the_permalink() ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-10.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> <a href="http://cgi.fark.com/cgi/fark/edit.pl?new_url=<?php the_permalink() ?>&amp;new_comment=<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-11.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> <a href="http://www.sphinn.com/submit.php?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-12.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> </div>
        <div style="clear: both;"></div>
        <?php }; ?>
        <?php if (get_option('cion_integration_single_top') <> '' && get_option('cion_integrate_singletop_enable') == 'on') echo(get_option('cion_integration_single_top')); ?>
        <!--End Share Button-->
        <h1 class="titles"><a href="<?php the_permalink() ?>" title="<?php printf(esc_attr__('Permanent Link to %s','Cion'), get_the_title()) ?>">
            <?php the_title(); ?>
            </a></h1>

        <?php if (get_option('cion_page_thumbnails') == 'on') { ?>
            <?php $width = (int) get_option('cion_thumbnail_width_pages');
                  $height = (int) get_option('cion_thumbnail_height_pages');

                  $classtext = 'thumbnail';
                  $titletext = get_the_title();

                  $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
                  $thumb = $thumbnail["thumb"]; ?>

            <?php if($thumb != '') { ?>
                <a href="<?php the_permalink() ?>" title="<?php printf(esc_attr__('Permanent Link to %s','Cion'), get_the_title()) ?>" class="thumbnail-link">
                    <?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
                </a>
            <?php } ?>
        <?php }; ?>

        <?php the_content(); ?>
    </div>
        <div style="clear: both;"></div>
          <?php if (get_option('cion_integration_single_bottom') <> '' && get_option('cion_integrate_singlebottom_enable') == 'on') echo(get_option('cion_integration_single_bottom')); ?>
        <div style="clear: both;"></div>
        <?php if (get_option('cion_show_pagescomments') == 'on') { ?>
    <div class="home-post-wrap2" style="margin-top: 10px;">
        <?php comments_template('',true); ?>
    </div>
    <?php }; ?>
    <?php endwhile; ?>
    <!--End Post-->
    <?php else : ?>
    <!--If no results are found-->
    <div class="home-post-wrap2">
        <h1><?php esc_html_e('No Results Found','Cion') ?></h1>
        <p><?php esc_html_e('The page you requested could not be found. Try refining your search, or use the navigation above to locate the post.','Cion') ?></p>
    </div>
    <!--End if no results are found-->
    <?php endif; ?>
</div>
<!--Begin Sidebar-->
<?php get_sidebar(); ?>
<!--End Sidebar-->
<!--Begin Footer-->
<?php get_footer(); ?>
<!--End Footer-->
</body>
</html>