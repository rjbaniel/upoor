<?php get_header(); ?>

<div id="content">

<?php if (have_posts()) : ?>

	<?php $post = $posts[0]; // Thanks Kubrick for this code ?>

		<?php if (is_category()) { ?>
		<h2><?php _e('Archive for', TEMPLATE_DOMAIN); ?> <?php single_cat_title(); ?></h2>

 	  	<?php } elseif (is_tag()) { ?>
		<h2><?php _e('Posts tagged with', TEMPLATE_DOMAIN); ?> <?php single_tag_title(); ?></h2>

 	  	<?php } elseif (is_day()) { ?>
		<h2><?php _e('Archive for', TEMPLATE_DOMAIN); ?> <?php the_time('F j, Y'); ?></h2>

	 	<?php } elseif (is_month()) { ?>
		<h2><?php _e('Archive for', TEMPLATE_DOMAIN); ?> <?php the_time('F, Y'); ?></h2>

		<?php } elseif (is_year()) { ?>
		<h2><?php _e('Archive for', TEMPLATE_DOMAIN); ?> <?php the_time('Y'); ?></h2>

		<?php } elseif (is_author()) { ?>
		<h2><?php _e('Author Archive', TEMPLATE_DOMAIN); ?></h2>


      <?php if (is_author()) { ?>
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
           <?php } ?>

		<?php } elseif (is_search()) { ?>
		<h2><?php _e('Search Results', TEMPLATE_DOMAIN); ?></h2>

		<?php } ?>

<?php while (have_posts()) : the_post(); ?>

<h2><?php the_date() ?></h2>

<?php if(!is_page()) { ?>
<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
<?php } else { ?>
<h3 id="post-<?php the_ID(); ?>"><?php the_title(); ?></h3>
<?php } ?>


<?php if(!is_page()) { ?>
<div class="postbyline">
<?php _e("by",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link() ?>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="mailto:<?php the_author_meta('email') ?>"><?php _e("sent email to author",TEMPLATE_DOMAIN); ?></a><br />
</div><div align="center"></div>
<?php } ?>

<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

<?php the_content(__('Read more &#187;',TEMPLATE_DOMAIN)); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

<?php if(is_page()) { ?><?php edit_post_link(__('Edit this page',TEMPLATE_DOMAIN), '',''); ?><?php } ?>

<?php } ?>





<div align="center"></div>

<?php if(!is_page()) { ?>
<div class="postfooter">
<?php _e('Filed under',TEMPLATE_DOMAIN);?> <?php the_category(__(' and ',TEMPLATE_DOMAIN),'single',' &#187; ') ?> <?php _e('at',TEMPLATE_DOMAIN);?> <?php the_time() ?> <?php _e("and",TEMPLATE_DOMAIN); ?> <?php the_tags( '' . __( 'tagged' ,TEMPLATE_DOMAIN) . ' ', ', ', ''); ?><br />
<?php edit_post_link(__('Edit',TEMPLATE_DOMAIN), '','<strong>| </strong>'); ?><?php comments_popup_link(__('Add a comment &#187;',TEMPLATE_DOMAIN), __('1 comment &#187;',TEMPLATE_DOMAIN), __('% comments &#187;',TEMPLATE_DOMAIN)); ?>
<br />
</div>
<?php } ?>


<?php if(!is_page()) { ?>
<?php comments_template('',true); // Get wp-comments.php template ?>
<?php } else { ?>
<?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>
<?php } ?>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.',TEMPLATE_DOMAIN); ?></p>
<?php endif; ?>
<div class="pageFooter">
<?php posts_nav_link(' ', __('<div class="navLast"></div>'), __('<div class="navNext"></div>')); ?>
</div>

 <div style="padding-top: 40px; float: left; width: 100%;"><?php wp_footer(); ?></div>
</div>

<?php get_footer(); ?>
