<?php get_header(); ?>

<div id="content" class="narrowcolumn">
  <?php if (have_posts()) : ?>
  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
  <?php /* If this is a category archive */ if (is_category()) { ?>
  <h2 class="pagetitle"><?php _e('Archive for the','dignity');?> &#8216;<?php echo single_cat_title(); ?>&#8217;</h2>
  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
  <h2 class="pagetitle"><?php _e('Archive for','dignity');?>
    <?php the_time(__('F jS, Y')); ?>
  </h2>
  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
  <h2 class="pagetitle"><?php _e('Archive for','dignity');?>
    <?php the_time('F, Y'); ?>
  </h2>
  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
  <h2 class="pagetitle"><?php _e('Archive for','dignity');?>
    <?php the_time('Y'); ?>
  </h2>
  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
  <h2 class="pagetitle"><?php _e('Author Archive','dignity');?></h2>


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
    <h2 class="pagetitle"><?php _e('Blog Archives','dignity');?></h2>
    <?php } ?>
  <div class="navigation">
    <div class="alignleft">
      <?php next_posts_link(__('&larr; Previous Entries','dignity')) ?>
    </div>
    <div class="alignright">
      <?php previous_posts_link(__('Next Entries &rarr;','dignity')) ?>
    </div>
  </div>
  <br class="clear" />

<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?> 


  <?php while (have_posts()) : the_post(); ?>
  <div class="post">
    <h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','dignity');?> <?php the_title(); ?>">
      <?php the_title(); ?>
      </a></h2>
	  <p class="postmetadata"><span class="timr"><?php the_time(__('F jS, Y')) ?>
      </span> <span class="user"><?php _e('by','dignity'); ?> <?php the_author() ?> </span>
</p>
    <div class="entry">


         <?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

<?php the_content( __('<p>Click here to read more</p>', 'dignity') ); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } ?>

	  
    </div>
	<p class="postmetadata"><span class="catr"><?php _e('Category','dignity'); ?> <?php the_category(', ') ?>
      </span> |
      <?php edit_post_link(__('Edit','dignity'), '<span class="editr">', ' | </span>'); ?>
      <span class="commr">
      <?php comments_popup_link(__('No Comments &#187;','dignity'), __('1 Comment &#187;','dignity'), __('% Comments &#187;','dignity')); ?>
      </span></p>
  </div>
  <?php endwhile; ?>
  <div class="navigation">
    <div class="alignleft">
      <?php next_posts_link(__('&laquo; Previous Entries','dignity')) ?>
    </div>
    <div class="alignright">
      <?php previous_posts_link(__('Next Entries &raquo;','dignity')) ?>
    </div>
  </div>
  <?php else : ?>
  <h2 class="center"><?php _e('Not Found','dignity');?></h2>
  <?php include (TEMPLATEPATH . '/searchform.php'); ?>
  <?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
