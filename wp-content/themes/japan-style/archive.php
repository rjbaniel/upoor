<?php get_header(); ?>

	<div id="content">

		<?php if (have_posts()) : ?>
			<div class="post post-list">
			


             <?php $post = $posts[0]; // Thanks Kubrick for this code ?>

		<?php if (is_category()) { ?>
		<h1><?php _e('Archive for', TEMPLATE_DOMAIN); ?> <?php single_cat_title(); ?></h1>

 	  	<?php } elseif (is_tag()) { ?>
		<h1><?php _e('Posts tagged with', TEMPLATE_DOMAIN); ?> <?php single_tag_title(); ?></h1>

 	  	<?php } elseif (is_day()) { ?>
		<h1><?php _e('Archive for', TEMPLATE_DOMAIN); ?> <?php the_time('F j, Y'); ?></h1>

	 	<?php } elseif (is_month()) { ?>
		<h1><?php _e('Archive for', TEMPLATE_DOMAIN); ?> <?php the_time('F, Y'); ?></h1>

		<?php } elseif (is_year()) { ?>
		<h1><?php _e('Archive for', TEMPLATE_DOMAIN); ?> <?php the_time('Y'); ?></h1>

		<?php } elseif (is_author()) { ?>
		<h1><?php _e('Author Archive', TEMPLATE_DOMAIN); ?></h1>


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
		<h1><?php _e('Search Results', TEMPLATE_DOMAIN); ?></h1>

		<?php } ?>






				<?php while (have_posts()) : the_post(); ?>


                   <div class="post" id="post-<?php the_ID(); ?>">
                                <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',TEMPLATE_DOMAIN); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>


<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

<?php the_content(__('Read the rest of this entry &raquo;',TEMPLATE_DOMAIN)); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } ?>



				<div class="post-info">
                    <?php _e("Posted by",TEMPLATE_DOMAIN); ?> <?php the_author_posts_link(); ?> <?php _e("on",TEMPLATE_DOMAIN); ?> <?php the_time('F jS,Y') ?>
					<?php the_category(', '); ?>
					<?php the_tags('| tags: ', ', ', ''); ?> |
					<?php comments_popup_link(__('No Comments',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN)); ?>
				</div>
			</div>



				<?php endwhile; ?>

			</div>

			<div id="pages">
				<a href="#"><?php next_posts_link(__('&larr;Older',TEMPLATE_DOMAIN)) ?></a>&nbsp;&nbsp;&nbsp;<a href="#"><?php previous_posts_link(__('Newer&rarr;',TEMPLATE_DOMAIN)) ?></a>
			</div>

		<?php else : ?>

			<h2 class="center"><?php _e("Not Found",TEMPLATE_DOMAIN); ?></h2>

		<?php endif; ?>

	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
