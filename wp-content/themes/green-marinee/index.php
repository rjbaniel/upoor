<?php  get_header(); ?>
<?php get_sidebar(); ?>
<hr />
<div id="content">
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

        <div class="alignleft"><?php echo get_avatar($curauth->user_email, '80', $avatar); ?></div>


        <div class="info">
        <strong style="font-size: 18px;"><?php echo $curauth->display_name; ?></strong>
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

	<?php // Post dates off by default the_date('','<h2>','</h2>'); ?>
	<div id="post-<?php the_ID(); ?>">
	<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>	
	<div class="meta">
		<?php _e('Posted in','greenmarinee'); ?> <?php the_category(',') ?> <?php _e('by','greenmarinee'); ?> <?php the_author_posts_link(); ?> <?php _e('on the','greenmarinee'); ?> <?php the_time(get_option('date_format')) ?> <?php edit_post_link(__('Edit This','greenmarinee')); ?>
		<?php the_tags('<br />Tags: ', ', '); ?>
	</div>
	<div class="main">


<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>

<?php the_content(__('(more...)','greenmarinee')); ?>

<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } ?>


	</div>
	</div>
	<div class="comments">
	 <?php wp_link_pages('before=<p>&after=</p>'); ?>
		<?php comments_popup_link(__('<strong>0</strong> Comments','greenmarinee'), __('<strong>1</strong> Comment','greenmarinee'), __('<strong>%</strong> Comments','greenmarinee')); ?>
	</div>

<?php if(!is_page()) { ?>
<?php comments_template('',true); ?>
<?php } else { ?>
<?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>
<?php } ?>

<?php endwhile; else: ?>
<div class="warning">
	<p><?php _e('Sorry, no posts matched your criteria, please try and search again.','greenmarinee'); ?></p>
</div>
<?php endif; ?>

<?php posts_nav_link(' &#8212; ',__('&laquo; Previous Page','greenmarinee'),__('Next Page &raquo;','greenmarinee')); ?>

	</div>
<!-- End float clearing -->
</div>
<!-- End content -->
<?php get_footer(); ?>
