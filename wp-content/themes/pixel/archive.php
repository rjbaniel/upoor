<?php get_header(); ?>

<div id="main">

<div id="contentwrapper">

<?php if (have_posts()) : ?>

<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

<?php /* If this is a category archive */ if (is_category()) { ?>
<h2 class="pageTitle"><?php single_cat_title(); ?></h2>
<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
<h2 class="pageTitle"><?php _e('Tag:', 'pixel'); ?> <?php single_tag_title(); ?></h2>
<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
<h2 class="pageTitle"><?php _e('Archive for', 'pixel'); ?> <?php the_time('F jS, Y'); ?></h2>
<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
<h2 class="pageTitle"><?php _e('Archive for', 'pixel'); ?> <?php the_time('F, Y'); ?></h2>
<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
<h2 class="pageTitle"><?php _e('Archive for', 'pixel'); ?> <?php the_time('Y'); ?></h2>
<?php /* If this is an author archive */ } elseif (is_author()) { ?>
<h2 class="pageTitle"><?php _e('Author Archive', 'pixel'); ?></h2>
       <?php if(isset($_GET['author_name'])) : $curauth = get_userdatabylogin($author_name); else : $curauth = get_userdata(intval($author)); endif; ?>
        <div id="author-block">

        <div class="alignleft"><?php echo get_avatar($curauth->user_email, '128', $avatar); ?></div>


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


<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
<h2 class="pageTitle"><?php _e('Blog Archives', 'pixel'); ?></h2>
<?php } ?>

<?php while (have_posts()) : the_post(); ?>

<div class="topPost">
  <h2 class="topTitle"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
  <p class="topMeta"><?php _e('by', 'pixel'); ?> <?php the_author_posts_link(); ?> <?php _e('on', 'pixel'); ?> <?php the_time('M.d, Y') ?>, <?php _e('under', 'pixel'); ?> <?php the_category(', '); ?></p>
  <div class="topContent">


<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

  <?php the_content(__('(continue reading...)', 'pixel')); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } ?>

</div>


  <span class="topComments"><?php comments_popup_link(__('Leave a Comment', 'pixel'), __('1 Comment', 'pixel'), __('% Comments', 'pixel')); ?></span>
  <span class="topTags"><?php the_tags('<em>:</em>', ', ', ''); ?></span>
  <span class="topMore"><a href="<?php the_permalink() ?>"><?php _e('more...', 'pixel'); ?></a></span>
<div class="cleared"></div>
</div> <!-- Closes topPost --><br/>

<?php endwhile; ?>

<?php else : ?>

<div class="topPost">
  <h2 class="topTitle"><a href="<?php the_permalink() ?>"><?php _e('Not Found', 'pixel'); ?></a></h2>
  <div class="topContent"><p><?php _e("Sorry, but you are looking for something that isn't here. You can search again by using", 'pixel'); ?> <a href="#searchform"><?php _e('this form', 'pixel'); ?></a>...</p></div>
</div> <!-- Closes topPost -->

<?php endif; ?>

<div id="nextprevious">
<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'pixel')) ?></div>
<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'pixel')) ?></div>
<div class="cleared"></div>
</div>
</div> <!-- Closes contentwrapper-->


<?php get_sidebar(); ?>
<div class="cleared"></div>

</div><!-- Closes Main -->


<?php get_footer(); ?>
