<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

		<?php if (have_posts()) : ?>

		 <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php /* If this is a category archive */ if (is_category()) { ?>				
		<h2 class="pagetitle"><?php _e("Archive for the",TEMPLATE_DOMAIN); ?> '<?php echo single_cat_title(); ?>' <?php _e("Category",TEMPLATE_DOMAIN); ?></h2>
		
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for',TEMPLATE_DOMAIN);?> <?php the_time(__('F jS, Y')); ?></h2>
		
	 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for',TEMPLATE_DOMAIN);?> <?php the_time('F, Y'); ?></h2>

		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for',TEMPLATE_DOMAIN);?> <?php the_time('Y'); ?></h2>
		
	  <?php /* If this is a search */ } elseif (is_search()) { ?>
		<h2 class="pagetitle"><php _e('Search Results',TEMPLATE_DOMAIN);?></h2>
		
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="pagetitle"><php _e('Author Archive',TEMPLATE_DOMAIN);?></h2>

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




		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle"><php _e('Blog Archives',TEMPLATE_DOMAIN);?></h2>

		<?php } ?>
<?php /* If this is a 404 page */ if (is_404()) { ?>
			<?php /* If this is a category archive */ } elseif (is_category()) { ?>
			<p><?php _e('You are currently browsing the archives for the',TEMPLATE_DOMAIN);?> <?php single_cat_title(''); ?> <?php _e('category.',TEMPLATE_DOMAIN);?></p>
			
			<?php /* If this is a yearly archive */ } elseif (is_day()) { ?>
			<p><?php _e('You are currently browsing the',TEMPLATE_DOMAIN);?> <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives',TEMPLATE_DOMAIN);?>
			<?php _e('for the day',TEMPLATE_DOMAIN);?> <?php the_time('l, F jS, Y'); ?>.</p>
			
			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<p><?php _e('You are currently browsing the',TEMPLATE_DOMAIN);?> <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives',TEMPLATE_DOMAIN);?>
			for <?php the_time('F, Y'); ?>.</p>

      <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<p><?php _e('You are currently browsing the',TEMPLATE_DOMAIN);?> <a href="<?php bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives',TEMPLATE_DOMAIN);?>
			<?php _e('for the year',TEMPLATE_DOMAIN);?> <?php the_time('Y'); ?>.</p>
			

			<?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<p><?php _e('You are currently browsing the',TEMPLATE_DOMAIN);?> <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives',TEMPLATE_DOMAIN);?>.</p>

			<?php } ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('Previous Entries',TEMPLATE_DOMAIN)) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Next Entries',TEMPLATE_DOMAIN)) ?></div>
		</div>

		<?php while (have_posts()) : the_post(); ?>
		<div class="post">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to',TEMPLATE_DOMAIN);?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<div class="metaright"><div class="articlemeta"><span class="editentry"><?php edit_post_link('<img src="'.get_bloginfo('template_directory').'/images/pencil.png" alt="'.__("Edit Link").'" />','<span class="editlink">','</span>'); ?></span>	<li class="date"><?php the_time('M jS, Y') ?></li> | <li class="cat"><?php the_category(', ') ?></li> | <li class="comm"> <?php comments_popup_link(__('No Comments',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN)); ?></li> <br/></div></div>
		<div class="metaright"><?php the_tags(__('Tags: '), ', ', ''); ?></div>


				<div class="entrytext">



                  <?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

<?php the_content( __('...read more',TEMPLATE_DOMAIN) ); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } ?>

</div>

</div>

<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('Previous Entries',TEMPLATE_DOMAIN)) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Next Entries',TEMPLATE_DOMAIN)) ?></div>
		</div>
	
	<?php else : ?>

		<h2 class="center"><?php _e('Not Found',TEMPLATE_DOMAIN);?></h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<?php endif; ?>
		
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
