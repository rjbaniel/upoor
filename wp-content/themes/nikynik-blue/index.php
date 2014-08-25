<?php get_header(); ?>

        <div id="content" class="narrowcolumn">

        <?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

                        <div class="post">
                                <h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>&nbsp;<small>
                                                                <?php foreach((get_the_category()) as $cat) {  if ($cat->cat_name == 'Noteworthy') { ?>
						<span><img src="<?php bloginfo('template_url'); ?>/images/favorite.png" alt="Favorite Entry"></a></span>
					<?php } } ?>
					
					<?php /* Support for noteworthy plugin */ if (function_exists('nw_noteworthyLink')) { ?><span><?php nw_noteworthyLink($post->ID); ?></span><?php } ?></small></h2>
                                <small><?php _e('Filed under:'); ?> <?php the_category(', ') ?> <?php _e('on','nikynik'); ?> <?php the_time(__('l, F jS, Y','nikynik')) ?> <?php _e('by','nikynik'); ?> <?php the_author_posts_link() ?> <strong>|</strong> <?php edit_post_link(__('Edit','nikynik'),'','<strong> |</strong>'); ?> <?php comments_popup_link(__('No Comments'), __('1 Comment'), __('% Comments')); ?>  </small>

                                <div class="entry">
                                        <?php the_content(__('Read the rest of this entry &raquo;','nikynik')); ?>
                                        <p><?php printf(__('%s',TEMPLATE_DOMAIN), get_the_tag_list(__('tags: '), ', ', ' ')); ?></p>
                                </div>
                </div>


                                <!--
                                <?php trackback_rdf(); ?>
                                -->


                <?php endwhile; ?>

               <div class="navigation">
                <div class="left"><?php next_posts_link('<span>&laquo;</span> Previous Entries') ?></div>
                <div class="right"><?php previous_posts_link('Next Entries <span>&raquo;</span>') ?></div>
                <div class="clear"></div>
        </div>
        <?php else : ?>

                <h2 class="center"><?php __('Not Found','nikynik'); ?></h2>
                <p class="center"><?php _e('Sorry, but you are looking for something that isn\'t here.','nikynik'); ?></p>
                <?php include (TEMPLATEPATH . "/searchform.php"); ?>
<?php endif; ?>

        </div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
