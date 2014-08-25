<?php get_header(); ?>
<?php is_tag(); ?>

<?php if (have_posts()) : ?>
    <div class="post">
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
        </div>

<?php while (have_posts()) : the_post(); ?>



<div class="post" id="post-<?php the_ID(); ?>">
<?php if (!is_page()) { ?><?php the_date('','<small>','</small>'); ?><?php } ?>

<?php if (!is_page() || !is_single()) { ?>
<h3 class="storytitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
<?php } else { ?>
<h3 class="storytitle"><?php the_title(); ?></h3>
<?php } ?>

<?php if (!is_page()) { ?>
<div class="meta"><?php _e('Filed under:','classic'); ?>  <?php the_category(',') ?> &#8212; <?php the_author_posts_link() ?> @ <?php the_time() ?> <?php edit_post_link(__('Edit This','classic')); ?><br /><?php the_tags(__('Tags: '), ', ', '<br />'); ?></div>
<?php } ?>



<div class="storycontent">
<?php if( is_date() || is_search() || is_tag() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

<?php } else if ( is_author() ) { ?>


<?php } else { ?>

<?php the_content(__('(more...)','classic')); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

<?php if (is_page()) { ?>
<?php edit_post_link(__('Edit This','classic'), '<p>', '</p>'); ?>
<?php } ?>

<?php } ?>
</div>



<?php if (!is_page() && !is_author()) { ?>
<div class="feedback">
<?php wp_link_pages(); ?>
<?php comments_popup_link(__('Comments (0)','classic'), __('Comments (1)','classic'), __('Comments (%)','classic')); ?>
</div>
<?php } ?>


</div>



<?php endwhile; ?>

<?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>

<?php else: ?>
<p><?php _e('Sorry, no posts matched your criteria.','classic'); ?></p>
<?php endif; ?>


<?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page','classic'), __('Next Page &raquo;','classic')); ?>

<?php get_footer(); ?>
