<?php get_header(); ?>



<?php is_tag(); ?>
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
	
				<h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent link to', TEMPLATE_DOMAIN); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			
				<p class="postmeta">
<?php _e('by',TEMPLATE_DOMAIN); ?> <?php the_author_posts_link(); ?> <?php _e('in',TEMPLATE_DOMAIN); ?> <?php the_time(get_option('date_format')) ?> <?php //_e('at'); ?> <?php //the_time() ?>
				&#183; <?php _e('Filed under', TEMPLATE_DOMAIN); ?> <?php the_category(', ') ?>
				<?php if (is_callable('the_tags')) the_tags(__('&#183 Tagged', TEMPLATE_DOMAIN), ', '); ?>
				<?php edit_post_link(__('Edit', TEMPLATE_DOMAIN), ' &#183; ', ''); ?>
				</p>
			
				<div class="postentry">

<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

<?php the_content(__('Read the rest of this entry &raquo;', TEMPLATE_DOMAIN)); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>

<?php } ?>

</div>

				<p class="postfeedback">
				<?php comments_popup_link(__('No comment &raquo;', TEMPLATE_DOMAIN), __('Comments (1) &raquo;', TEMPLATE_DOMAIN), __('Comments (%) &raquo;', TEMPLATE_DOMAIN), 'commentslink', __('Comments off', TEMPLATE_DOMAIN)); ?>
				</p>
			</div>
				
		<?php endwhile; ?>

			<!-- Page Navigation -->
			<div class="pagenav">
				<div class="alignleft"><?php posts_nav_link('', '', __('&laquo; Previous entries', TEMPLATE_DOMAIN)); ?></div>
					<?php // posts_nav_link(' &#183; ', '', ''); ?>
				<div class="alignright"><?php posts_nav_link('', __('Next entries &raquo;', TEMPLATE_DOMAIN), ''); ?></div>
			</div>


	<?php else : ?>

		<h2><?php _e('404 Not Found', TEMPLATE_DOMAIN); ?></h2>

		<p><?php _e('Oops...! What you requested cannot be found.', TEMPLATE_DOMAIN); ?></p>

	<?php endif; ?>
		

<?php get_sidebar(); ?>

<?php get_footer(); ?>
