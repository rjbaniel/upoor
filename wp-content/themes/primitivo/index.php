<?php
get_header();
?>

	
	<div id="colOne">
	<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar(2)) : ?>
		<h2><?php _e("Recent update",TEMPLATE_DOMAIN); ?></h2>
		<ul>
			<?php wp_get_archives('postbypost', 10); ?>
		</ul>

			<div align="center"><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/feed.png" border="0" alt="<?php _e("Subscribe to RSS feed",TEMPLATE_DOMAIN); ?>"/></a></div>
		<?php endif; ?>



	</div>


	<div id="colTwo">
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

		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<p class="file"><small><?php the_time(__('F jS, Y')) ?>  <?php _e("by",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link() ?></small></p>


        <?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

<?php the_content(__('(more...)',TEMPLATE_DOMAIN)); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } ?>


		<p><?php _e('Posted in ',TEMPLATE_DOMAIN);?> <?php the_category(', ') ?> | <?php the_tags( '' . __( 'tagged',TEMPLATE_DOMAIN ) . ' ', ', ', ''); ?> | <?php edit_post_link(__('Edit',TEMPLATE_DOMAIN), ' | ', ''); ?> | <?php wp_link_pages(); ?>
    <?php comments_popup_link(__('0 Comments',TEMPLATE_DOMAIN), __('1 Comments',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN)); ?></p>
		<?php comments_template('',true); // Get wp-comments.php template ?>
<?php endwhile; else: ?><?php endif; ?>

<?php next_posts_link(__('&laquo; Previous Entries',TEMPLATE_DOMAIN)) ?> <?php previous_posts_link(__('Next Entries &raquo;',TEMPLATE_DOMAIN)) ?>
	</div>
<?php get_sidebar();?>	
<?php get_footer(); ?>
