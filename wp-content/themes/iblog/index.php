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
		<h2><?php _e('Search Results', TEMPLATE_DOMAIN); ?></h2>

		<?php } ?>


		<?php while (have_posts()) : the_post(); ?>

        <div class="post" id="post-<?php the_ID(); ?>">
		  <div class="date"><span><?php the_time('M') ?></span> <?php the_time('d') ?></div>
		  <div class="title">
          <h2  class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
          <div class="postdata"><span class="category"><?php _e('Posted by', 'iblog'); ?> <?php the_author_posts_link(); ?> <?php _e('under', 'iblog'); ?> <?php the_category(', ') ?></span> <span class="comments"><?php comments_popup_link(__('No Comments &#187;', 'iblog'), __('1 Comment &#187;', 'iblog'), __('% Comments &#187;', 'iblog')); ?></span></div>
		  </div>
          <div class="entry">



           <?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

<?php the_content(__('Continue reading &raquo;', 'iblog')); ?>

<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } ?>








          </div><!--entry -->
  			<span class="tags"><?php the_tags(__('Tagged with: ', 'iblog'),' &bull; ','<br />'); ?></span>
        </div><!--post -->

		<?php endwhile; ?>

        <div class="page-nav fix"> <span class="previous-entries"><?php next_posts_link(__('Previous Entries', 'iblog')) ?></span> <span class="next-entries"><?php previous_posts_link(__('Next Entries', 'iblog')) ?></span></div><!-- page nav -->

	<?php else : ?>

		<h2><?php _e('Not Found', 'iblog'); ?></h2>
		<p><?php _e("Sorry, but you are looking for something that isn't here.", 'iblog'); ?></p>
		
	<?php endif; ?>
</div></div><?php get_sidebar(); ?>

<div class="centered"><?php echo iblog_footer_link(); ?></div>
</div>

</div></div>

<?php get_footer(); ?>
