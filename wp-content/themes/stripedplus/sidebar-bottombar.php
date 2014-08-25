<div class="barmenuleft">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Bottom Left') ) : ?>
            <h3><?php _e('Archives', TEMPLATE_DOMAIN);?></h3>
            <ul>
            <?php wp_get_archives('monthly', '10', 'html', '', ''); ?>
            </ul>

            <h3><?php _e("10 most commented",TEMPLATE_DOMAIN); ?></h3>
            <ul>
            <?php $result = $wpdb->get_results("SELECT comment_count,ID,post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 , 10");
            foreach ($result as $topten) {
            $postid = $topten->ID;
            $title = $topten->post_title;
            $commentcount = $topten->comment_count; 
            if ($commentcount != 0) {
            ?>
<li><a href="<?php echo get_permalink($postid); ?>"><?php echo $title ?> (<?php echo $commentcount ?>)</a></li>
            <?php } } ?>
</ul>

            <h3><?php _e("Latest 10 posts",TEMPLATE_DOMAIN); ?></h3>
            <ul>
            <?php wp_get_archives('postbypost','10','custom','<li>','</li>'); ?>
            </ul>
<?php endif; ?>
		</div>
        <div class="barmenuright">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Bottom Right') ) : ?>
            <h3><?php _e("Blogroll",TEMPLATE_DOMAIN); ?></h3>
            <ul>
            <?php get_bookmarks('-1', '<li>', '</li>', '<br />', FALSE, 'id', FALSE,
FALSE, -1, FALSE); ?>
            </ul>
<?php endif; ?>
        </div>
