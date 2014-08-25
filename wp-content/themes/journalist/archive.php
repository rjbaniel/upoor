<?php get_header(); ?>

<div id="content">
<?php if (have_posts()) : ?>

<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php /* If this is a category archive */ if (is_category()) { ?>
<h2 class="archive"><?php _e('Archive for the', 'journalist'); ?> &#8216;<?php single_cat_title(); ?>&#8217; <?php _e('Category', 'journalist'); ?></h2>
<?php /* If this is a tag */ } elseif (is_tag()) { ?>
<h2 class="archive"><?php _e('Archive for the', 'journalist'); ?> &#8216;<?php single_tag_title(); ?>&#8217; <?php _e('tag', 'journalist'); ?></h2>
<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
<h2 class="archive"><?php _e('Archive for', 'journalist'); ?> <?php the_time('F jS, Y'); ?></h2>
<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
<h2 class="archive"><?php _e('Archive for', 'journalist'); ?> <?php the_time('F, Y'); ?></h2>
<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
<h2 class="archive"><?php _e('Archive for', 'journalist'); ?> <?php the_time('Y'); ?></h2>
<?php /* If this is an author archive */ } elseif (is_author()) { ?>
<h2 class="archive"><?php _e('Author Archive', 'journalist'); ?></h2>
<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
<h2 class="archive"><?php _e('Blog Archives', 'journalist'); ?></h2>
<?php } ?>


 <?php if (is_author()) { ?>
       <?php if(isset($_GET['author_name'])) : $curauth = get_userdatabylogin($author_name); else : $curauth = get_userdata(intval($author)); endif; ?>
        <div id="author-block">

        <div class="alignleft"><?php echo get_avatar($curauth->user_email, '128', $avatar); ?></div>


        <div class="info">
        <h3><?php echo $curauth->display_name; ?></h3>
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

<div class="post hentry<?php if (function_exists('sticky_class')) { sticky_class(); } ?>">
<h2 id="post-<?php the_ID(); ?>" class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<p class="comments"><a href="<?php comments_link(); ?>"><?php comments_number(__('leave a comment', 'journalist'),__('one comment', 'journalist'),__('% comments', 'journalist')); ?></a></p>

<div class="main entry-content">



<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

<?php the_content(__('Read the rest of this entry &raquo;', 'journalist')); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } ?>

</div>



<div class="meta group">
<div class="signature">
    <p class="author vcard"><?php _e('Written by', 'journalist'); ?> <span class="fn"><?php the_author() ?></span> <span class="edit"><?php edit_post_link(__('Edit', 'journalist')); ?></span></p>
    <p><abbr class="updated" title="<?php the_time('Y-m-d\TH:i:s')?>"><?php the_time('F jS, Y'); ?> <?php _e("at", 'journalist'); ?> <?php the_time('g:i a'); ?></abbr></p>
</div>	
<div class="tags">
    <p><?php _e('Posted in', 'journalist'); ?> <?php the_category(',') ?></p>
    <?php if ( the_tags('<p>Tagged with ', ', ', '</p>') ) ?>
</div>
</div>
</div><!-- END .hentry -->

<?php comments_template('',true); ?>

<?php endwhile; else: ?>
<div class="warning">
	<p><?php _e("Sorry, but you are looking for something that isn't here.", 'journalist'); ?></p>
</div>
<?php endif; ?>

<div class="navigation group">
	<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'journalist')) ?></div>
	<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'journalist')) ?></div>
</div>

</div> 

<?php get_sidebar(); ?>

<?php get_footer(); ?>
