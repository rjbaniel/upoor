<?php
/*
Template Name: Sitemap Page
*/
?>
<?php
$et_ptemplate_settings = array();
$et_ptemplate_settings = maybe_unserialize( get_post_meta(get_the_ID(),'et_ptemplate_settings',true) );

$fullwidth = isset( $et_ptemplate_settings['et_fullwidthpage'] ) ? (bool) $et_ptemplate_settings['et_fullwidthpage'] : false;
?>

<?php get_header(); ?>
<div id="container"<?php if ($fullwidth) echo ' class="no_sidebar"'; ?>>
<div id="left-div">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
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

		<div id="sitemap">
			<div class="sitemap-col">
				<h2><?php esc_html_e('Pages','Cion'); ?></h2>
				<ul id="sitemap-pages"><?php wp_list_pages('title_li='); ?></ul>
			</div> <!-- end .sitemap-col -->

			<div class="sitemap-col">
				<h2><?php esc_html_e('Categories','Cion'); ?></h2>
				<ul id="sitemap-categories"><?php wp_list_categories('title_li='); ?></ul>
			</div> <!-- end .sitemap-col -->

			<div class="sitemap-col">
				<h2><?php esc_html_e('Tags','Cion'); ?></h2>
				<ul id="sitemap-tags">
					<?php $tags = get_tags();
					if ($tags) {
						foreach ($tags as $tag) {
							echo '<li><a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a></li> ';
						}
					} ?>
				</ul>
			</div> <!-- end .sitemap-col -->

			<div class="sitemap-col<?php echo ' last'; ?>">
				<h2><?php esc_html_e('Authors','Cion'); ?></h2>
				<ul id="sitemap-authors" ><?php wp_list_authors('show_fullname=1&optioncount=1&exclude_admin=0'); ?></ul>
			</div> <!-- end .sitemap-col -->
		</div> <!-- end #sitemap -->

		<div class="clear"></div>

          <?php if (get_option('cion_integration_single_bottom') <> '' && get_option('cion_integrate_singlebottom_enable') == 'on') echo(get_option('cion_integration_single_bottom')); ?>
        <div style="clear: both;"></div>
	<?php endwhile; endif; ?>
</div>
<?php if($fullwidth) echo ('</div>');?>
<!--Begin Sidebar-->
<?php if (!$fullwidth) get_sidebar(); ?>
<!--End Sidebar-->
<!--Begin Footer-->
<?php get_footer(); ?>
<!--End Footer-->
</body>
</html>