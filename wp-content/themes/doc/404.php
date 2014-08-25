<?php get_header(); ?>
    <div id="main" class="g25">
        <div class="post">
            <h1><?php _e('Error 404. Can anybody tell what we are looking for?', 'doc'); ?></h1>
            <div class="text">
                <p><?php _e('You could search for something else, in the searchbox; or contact me.', 'doc'); ?></p>
                <p><?php _e("If you're lazy, or don't feel social, you could", 'doc'); ?>:</p>
                <ul>
                    <li><?php _e('go back from where you came from (I wont mind).', 'doc'); ?></li>
                    <li><?php _e('visit my homepage.', 'doc'); ?></li>
                    <li><?php _e('visit my blog, using the navigation menus.', 'doc'); ?></li>
                    <li><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('subscribe to feeds', 'doc'); ?></a>.</li>
                    <li><?php _e("take a walk with someone you love (which I'd personally chose if I was to see this page).", 'doc'); ?></li>
                </ul>
                </div>
        </div>
    </div>
    
    <?php include(TEMPLATEPATH."/sidebar.php");?>

</div>

<div class="clear"></div>

<?php get_footer(); ?>
