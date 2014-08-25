<?php
get_header();
?>
<?php if (have_posts()) : ?>

<?php if (is_author()) { ?>
       <?php if(isset($_GET['author_name'])) : $curauth = get_userdatabylogin($author_name); else : $curauth = get_userdata(intval($author)); endif; ?>
        <div id="author-block">

        <div class="alignleft"><?php echo get_avatar($curauth->user_email, '80', $avatar); ?></div>


        <div class="info">
        <p><strong><?php echo $curauth->display_name; ?></strong></p>
        <p>
        <?php if($curauth->user_description<>''): echo $curauth->user_description; else: _e("This user hasn't shared any biographical information",TEMPLATE_DOMAIN);
         endif; ?>
        </p>
         <?php
          if(($curauth->user_url<>'http://') && ($curauth->user_url<>'')) echo '<p class="im">'.__('Homepage:',TEMPLATE_DOMAIN).' <a href="'.$curauth->user_url.'">'.$curauth->user_url.'</a></p>';
          if($curauth->yim<>'') echo '<p class="im">'.__('Yahoo Messenger:',TEMPLATE_DOMAIN).' <a class="im_yahoo" href="ymsgr:sendIM?'.$curauth->yim.'">'.$curauth->yim.'</a></p>';
          if($curauth->jabber<>'') echo '<p class="im">'.__('Jabber/GTalk:',TEMPLATE_DOMAIN).' <a class="im_jabber" href="gtalk:chat?jid='.$curauth->jabber.'">'.$curauth->jabber.'</a></p>';
          if($curauth->aim<>'') echo '<p class="im">'.__('AIM:',TEMPLATE_DOMAIN).' <a class="im_aim" href="aim:goIM?screenname='.$curauth->aim.'">'.$curauth->aim.'</a></p>';
         ?>
         </div>
         </div>
           <?php } ?>

<?php while (have_posts()) : the_post(); ?>
<?php the_date('','<h2>','</h2>'); ?>
<div class="post">
<h3 class="storytitle" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
<div class="meta"><?php _e("Filed under:",TEMPLATE_DOMAIN); ?> <?php the_category(',') ?> &#8212; <?php the_author_posts_link() ?> @ <?php the_time() ?> <?php edit_post_link(__('Edit This',TEMPLATE_DOMAIN)); ?> and <?php the_tags( '' . __( 'tagged',TEMPLATE_DOMAIN ) . ' ', ', ', ''); ?></div>
<div class="storycontent">


<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

<?php the_content(__('(more...)',TEMPLATE_DOMAIN)); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } ?>


</div>
<div class="feedback">
<?php wp_link_pages(); ?>
<?php comments_popup_link(__('Comments (0)',TEMPLATE_DOMAIN), __('Comments (1)',TEMPLATE_DOMAIN), __('Comments (%)',TEMPLATE_DOMAIN)); ?>
</div>
<!--
<?php trackback_rdf(); ?>
-->
</div>
<?php comments_template(); // Get wp-comments.php template ?>
<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.',TEMPLATE_DOMAIN); ?></p>
<?php endif; ?>
<div style="margin: 10px 0 10px 0"><?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page',TEMPLATE_DOMAIN), __('Next Page &raquo;',TEMPLATE_DOMAIN)); ?></div>
<?php get_footer(); ?>
