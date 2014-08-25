<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

		<?php if (have_posts()) : ?>
<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php /* If this is a category archive */ if (is_category()) { ?>				
		<h2 class="pagetitle"><?php _e('Archive for the','nikynik'); ?> '<?php echo single_cat_title(); ?>' <?php _e('Category','nikynik'); ?></h2>
		
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for ','nikynik'); ?> <?php the_time(__('F jS, Y','nikynik')); ?></h2>
		
	 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for ','nikynik'); ?> <?php the_time('F, Y','nikynik'); ?></h2>

		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?><h2 class="pagetitle"><?php _e('Archive for ','nikynik'); ?> <?php the_time('Y'); ?></h2>
		
	  <?php /* If this is a search */ } elseif (is_search()) { ?>
		<h2 class="pagetitle"><?php _e('Search results','nikynik'); ?></h2>
		
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="pagetitle"><?php _e('Author Archive','nikynik'); ?></h2>


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



		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle"><?php _e('Blog Archives','nikynik'); ?></h2>

		<?php } ?>


		<div class="navigation">

			<?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')) ?>
		</div>

		<?php while (have_posts()) : the_post(); ?>
		<div class="post">
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>
				<small><?php the_time(__('F jS, Y','nikynik')); ?></small>
				
				<div class="entry">


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
              <p><?php printf(__('%s',TEMPLATE_DOMAIN), get_the_tag_list(__('tags: '), ', ', ' ')); ?></p>   

				</div>
		
				<p class="postmetadata"><?php _e('Filed under:','nikynik'); ?>&nbsp;
<?php the_category(', ') ?> <strong>|</strong> <?php edit_post_link(__('Edit','nikynik'),'','<strong>| </strong>'); ?>
<?php comments_popup_link(__('No Comments'), __('1 Comment'), __('% Comments')); ?></p> 
				
				<!--
				<?php trackback_rdf(); ?>
				-->
			</div>
	
		<?php endwhile; ?>

		<div class="navigation">

			<?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')) ?>
		</div>
	
	<?php else : ?>

		<h2 class="center"><?php __('Not Found','nikynik'); ?></h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
<?php endif; ?>
		
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
