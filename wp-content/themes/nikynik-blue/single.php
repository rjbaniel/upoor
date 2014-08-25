<?php get_header(); ?>

        <div id="content" class="widecolumn">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <div class="navigation">
                <div class="left"><?php previous_post_link(' %link','<span>&laquo;</span>','yes') ?></div>
                <div class="right"><?php next_post_link(' %link ','<span>&raquo;</span>','yes') ?></div>
                <div class="clear"></div>
        </div>
               <br />
                <div class="post">
                        <h2 id="post-<?php the_ID(); ?>"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h2>

                        <div class="entrytext">
                                <?php the_content(__('Read the rest of this entry &raquo;','nikynik')); ?>
<?php wp_link_pages(__('<p><strong>Pages:</strong> ','nikynik'), '</p>', __('number','nikynik')); ?>

                                <p class="postmetadata alt">
                                        <small>
                                                <?php _e('This entry was posted','nikynik'); ?> <?php _e('on','nikynik'); ?> <?php the_time(__('l, F jS, Y','nikynik')) ?> @ <?php the_time() ?> <?php _e('on the category','nikynik'); ?> <?php the_category(', ') ?>.
                                                <?php _e('You can follow any responses to this entry through the','nikynik'); ?> <?php post_comments_feed_link('RSS 2.0'); ?> <?php ('feed. '); ?>
<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
                                                        // Both Comments and Pings are open ?>
<?php _e('You can','nikynik'); ?> <a href="#respond"><?php _e('leave a response','nikynik'); ?></a>, <?php _e('or','nikynik'); ?> <a href="<?php trackback_url(display); ?>"><?php _e('trackback'); ?></a> <?php _e('from your own site.','nikynik'); ?>
<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
                                                        // Only Pings are Open ?>
<?php _e('Responses are currently closed, but you can','nikynik'); ?> <a href="<?php trackback_url(display); ?> "><?php _e('trackback'); ?></a> <?php _e('from your own site.','nikynik'); ?>
<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
                                                        // Comments are open, Pings are not ?>
<?php _e('You can skip to the end and leave a response. Pinging is currently not allowed.','nikynik'); ?>
<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
                                                        // Neither Comments, nor Pings are open ?>
<?php _e('Both comments and pings are currently closed.','nikynik'); ?>
<?php } edit_post_link(__('<br>Edit this entry','nikynik'),'',''); ?>

                                        </small>
                                </p>

                        </div>
                </div>

        <?php comments_template('',true); ?>
<?php endwhile; else: ?>

                <p><?php _e('Sorry, no posts matched your criteria.','nikynik'); ?></p>

<?php endif; ?>

        </div>


<?php get_footer(); ?>
