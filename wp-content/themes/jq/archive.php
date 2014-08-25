<?php get_header(); ?>
<div id="content" class="clearfix">
<?php get_sidebar(); ?>
<div id="left">
<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<!-- archive header -->
<?php /* If category archive */ if (is_category()) { ?>
<h2 class="archive-title"><?php _e('CAT', 'jq'); ?> | <?php single_cat_title(); ?></h2>
<?php /* If tag archive */ } elseif( is_tag() ) { ?>
<h2 class="archive-title"><?php _e('TAG', 'jq'); ?> | <?php single_tag_title(); ?></h2>
<?php /* If daily archive */ } elseif (is_day()) { ?>
<h2 class="archive-title"><?php _e('Archive for', 'jq'); ?> <?php the_time('F jS, Y'); ?></h2>
<?php /* If monthly archive */ } elseif (is_month()) { ?>
<h2 class="archive-title"><?php _e('Archive for', 'jq'); ?> <?php the_time('F Y'); ?></h2>
<?php /* If yearly archive */ } elseif (is_year()) { ?>
<h2 class="archive-title"><?php _e('Archive for', 'jq'); ?> <?php the_time('Y'); ?></h2>
<?php /* If paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
<h2 class="archive-title"><?php _e('Blog Archive', 'jq'); ?></h2>
<?php } ?>

<?php if (is_author()) { ?>
       <?php if(isset($_GET['author_name'])) : $curauth = get_userdatabylogin($author_name); else : $curauth = get_userdata(intval($author)); endif; ?>
        <div id="author-block">

        <div class="alignleft"><?php echo get_avatar($curauth->user_email, '128', $avatar); ?></div>


        <div class="info">
        <h1><?php echo $curauth->display_name; ?></h1>
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


<?php include (TEMPLATEPATH . "/wp-loop.php"); ?>
</div>




</div>
<?php get_footer(); ?>
