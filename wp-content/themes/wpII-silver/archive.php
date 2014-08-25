<?php get_header(); ?>
<?php get_sidebar(); ?>

<div id="content">

	<?php if (have_posts()) : ?>


	<?php $post = $posts[0]; // Thanks Kubrick for this code ?>

		<?php if (is_category()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for', TEMPLATE_DOMAIN); ?> <?php single_cat_title(); ?></h2>

 	  	<?php } elseif (is_tag()) { ?>
		<h2 class="pagetitle"><?php _e('Posts tagged with', TEMPLATE_DOMAIN); ?> <?php single_tag_title(); ?></h2>

 	  	<?php } elseif (is_day()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for', TEMPLATE_DOMAIN); ?> <?php the_time('F j, Y'); ?></h2>

	 	<?php } elseif (is_month()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for', TEMPLATE_DOMAIN); ?> <?php the_time('F, Y'); ?></h2>

		<?php } elseif (is_year()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for', TEMPLATE_DOMAIN); ?> <?php the_time('Y'); ?></h2>

		<?php } elseif (is_author()) { ?>
		<h2 class="pagetitle"><?php _e('Author Archive', TEMPLATE_DOMAIN); ?></h2>


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
		<h2 class="pagetitle"><?php _e('Search Results', TEMPLATE_DOMAIN); ?></h2>

		<?php } ?>



		<div class="navigation">
			<div style="float:right" class="alignright"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignleft"><?php next_post_link('%link &raquo;') ?></div>
		</div>

	<?php while (have_posts()) : the_post(); ?>
	<div class="entry entry-<?php echo $postCount ;?>">

		<div class="entrytitle">
			<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', TEMPLATE_DOMAIN);?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<h3><?php the_time(__('F jS, Y')) ?></h3>
		</div>
		<div class="entrybody">



<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

<?php the_content( __('<p>Click here to read more</p>',TEMPLATE_DOMAIN) ); ?>

<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } ?>



		</div>
		
		<div class="entrymeta">
		<div class="postinfo">
			<p class="postedby"><?php _e('Posted by', TEMPLATE_DOMAIN);?> <?php the_author_posts_link() ?> 		<?php comments_popup_link(__('No Comments &#187;', TEMPLATE_DOMAIN), __('1 Comment &#187;', TEMPLATE_DOMAIN),__('% Comments &#187;', TEMPLATE_DOMAIN), 'commentslink'); ?></p>
		<p class="filedto"><?php _e('Filed under', TEMPLATE_DOMAIN);?>: <?php the_category(', ') ?> <?php edit_post_link(__('Edit', TEMPLATE_DOMAIN), ' | ', ''); ?></p>
		</div>

			<div class="feedback">
			<?php comments_popup_link(__('No Response', TEMPLATE_DOMAIN), __('1 Pings', TEMPLATE_DOMAIN),__('% Pings', TEMPLATE_DOMAIN), 'commentslink'); ?>
			</div>
		</div>

	</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div style="float:right" class="alignright"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignleft"><?php next_post_link('%link &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2><?php _e('Not Found', TEMPLATE_DOMAIN);?></h2>
		<div class="entrybody"><?php _e("Sorry, but you are looking for something that isn't here.", TEMPLATE_DOMAIN);?></div>

	<?php endif; ?>
	
</div>

<?php get_footer(); ?>
