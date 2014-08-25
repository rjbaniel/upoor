<div class="paddingtop">

<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>

<!-- begin sidebar -->
    <!--  START PAGES LIST  -->
    <span id="menutitle"><?php _e('Pages',TEMPLATE_DOMAIN); ?></span>
    <?php wp_list_pages('title_li='); ?>
    <!--  END PAGES LIST  -->
    <p></p>
    <!--  START CATEGORIES  -->
<span id="menutitle"><?php _e('Categories',TEMPLATE_DOMAIN); ?></span>
        <?php wp_list_categories('sort_column=name'); ?>
    <!--  END CATEGORIES  -->
    <p></p>
    <!--  START ARCHIVES  -->
<span id="menutitle"><?php _e('Archives',TEMPLATE_DOMAIN); ?></span>
        <?php wp_get_archives('type=monthly'); ?>
    <!--  END ARCHIVES  -->
    <p></p>
    <!--  START META  -->
<span id="menutitle"><?php _e('Meta',TEMPLATE_DOMAIN); ?></span><br/>
        <?php wp_register(); ?>
        <?php wp_loginout(); ?><p>
        <a href="feed:<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS',TEMPLATE_DOMAIN); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>',TEMPLATE_DOMAIN); ?></a><br/>
        <a href="feed:<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS',TEMPLATE_DOMAIN); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>',TEMPLATE_DOMAIN); ?></a><br/>
        <?php wp_meta(); /* do not remove this line */ ?>
    <!--  END META  -->
<p></p>
<?php if (function_exists('wp_theme_switcher')) { ?>
    <!--  START THEME SWITCHER -->
<span id="menutitle"><?php _e('Themes',TEMPLATE_DOMAIN); ?></span>
<?php wp_theme_switcher(); ?>
    <!--  END THEME SWITCHER  -->
<?php } ?><br>

<?php endif; ?>

<!-- end sidebar -->
</div>

