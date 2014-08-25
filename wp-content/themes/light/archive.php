<?php
get_header();
?>

<div id="content">
  <?php if (have_posts()) : ?>


  	<?php $post = $posts[0]; // Thanks Kubrick for this code ?>

		<?php if (is_category()) { ?>
		<h2 class="archive"><?php _e('Archive for', TEMPLATE_DOMAIN); ?> <?php single_cat_title(); ?></h2>

 	  	<?php } elseif (is_tag()) { ?>
		<h2 class="archive"><?php _e('Posts tagged with', TEMPLATE_DOMAIN); ?> <?php single_tag_title(); ?></h2>

 	  	<?php } elseif (is_day()) { ?>
		<h2 class="archive"><?php _e('Archive for', TEMPLATE_DOMAIN); ?> <?php the_time('F j, Y'); ?></h2>

	 	<?php } elseif (is_month()) { ?>
		<h2 class="archive"><?php _e('Archive for', TEMPLATE_DOMAIN); ?> <?php the_time('F, Y'); ?></h2>

		<?php } elseif (is_year()) { ?>
		<h2 class="archive"><?php _e('Archive for', TEMPLATE_DOMAIN); ?> <?php the_time('Y'); ?></h2>

		<?php } elseif (is_author()) { ?>
		<h2 class="archive"><?php _e('Author Archive', TEMPLATE_DOMAIN); ?></h2>


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

		<?php } elseif (is_search()) { ?>
		<h2 class="archive"><?php _e('Search Results', TEMPLATE_DOMAIN); ?></h2>

		<?php } ?>







  <?php while (have_posts()) : the_post(); ?>
  <div class="entry">
    <h3 class="entrytitle" id="post-<?php the_ID(); ?>"> <a href="<?php the_permalink() ?>" rel="bookmark">
      <?php the_title(); ?>
      </a> </h3>
    <div class="entrymeta">
      <?php _e("Posted by",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link(); ?> <?php _e("on",TEMPLATE_DOMAIN); ?> <?php
			the_time('F j, Y ');
			$comments_img_link= '<img src="' . get_stylesheet_directory_uri() . '/images/comments.gif"  title="comments" alt="*" /><strong>';
			comments_popup_link($comments_img_link .__(' Comments(0)',TEMPLATE_DOMAIN), $comments_img_link .__(' Comments(1)',TEMPLATE_DOMAIN), $comments_img_link . __(' Comments(%)',TEMPLATE_DOMAIN) );
			edit_post_link(__(' Edit',TEMPLATE_DOMAIN));?>
      </strong> </div>
    <div class="entrybody">

    <?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<p><?php printf(__('category: %s &nbsp;&nbsp;&nbsp; %s',TEMPLATE_DOMAIN), get_the_category_list(', '), get_the_tag_list(__('tags: '), ', ', ' ')); ?></p>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

<?php } else { ?>

 <?php the_content(__('Read more &raquo;',TEMPLATE_DOMAIN));?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<p><?php printf(__('category: %s &nbsp;&nbsp;&nbsp; %s',TEMPLATE_DOMAIN), get_the_category_list(', '), get_the_tag_list(__('tags: '), ', ', ' ')); ?></p>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } ?>





<div class="sociable">
<?php if(function_exists('wp_email')) { email_link(); } ?>
</div>
    </div>
    <!--
	<?php trackback_rdf(); ?>
	-->
  </div>
  <?php endwhile; else: ?>
  <p>
    <?php _e('Sorry, no posts matched your criteria.',TEMPLATE_DOMAIN); ?>
  </p>
  <?php endif; ?>
  <p>
    <?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page',TEMPLATE_DOMAIN), __('Next Page &raquo;',TEMPLATE_DOMAIN)); ?>
  </p>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
