<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">



<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title>
<?php
if (is_home()) { echo bloginfo('name'); echo (' - '); bloginfo('description');}
elseif (is_404()) { bloginfo('name'); echo ' - Oops, this is a 404 page'; }
else if ( is_search() ) { bloginfo('name'); echo (' - Search Results');}
else { bloginfo('name'); echo (' - '); wp_title(''); }
?>
</title>

	



	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />

	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />

	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!-- favicon.ico location -->
<?php if(file_exists( WP_CONTENT_DIR . '/favicon.ico')) { //put your favicon.ico inside wp-content/ ?>
<link rel="icon" href="<?php echo WP_CONTENT_URL; ?>/favicon.ico" type="images/x-icon" />
<?php } elseif(file_exists( WP_CONTENT_DIR . '/favicon.png')) { //put your favicon.png inside wp-content/ ?>
<link rel="icon" href="<?php echo WP_CONTENT_URL; ?>/favicon.png" type="images/x-icon" />
<?php } elseif(file_exists( TEMPLATEPATH . '/favicon.ico')) { ?>
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="images/x-icon" />
<?php } elseif(file_exists( TEMPLATEPATH . '/favicon.png')) { ?>
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png" type="images/x-icon" />
<?php } ?>


<?php remove_action( 'wp_head', 'wp_generator' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

<?php if( get_background_image() || get_theme_mod('preset_bg') ) { ?>
<style>
body, .BGbig {
    background: transparent none;
}
</style>
<?php } ?>
</head>

<body id="custom" class="bgsmall" topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginheight="0" marginwidth="0">



<div class="BGbig">


     

<div align="center">
  <table id="Table_01" width="750" height="480" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="5" class="image1" width="750" height="144">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="5" class="image2" width="750" height="177"><div class="title"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a><br /><span class="sub"><?php bloginfo('description'); ?></span></div></td>
    </tr>
    <tr>
      <td valign="top" class="image3" width="52"><div class="image4">&nbsp;</div></td>
      <td bgcolor="#FFFFFF" width="171" height="159" valign="top" class="tdleft"><div class="td3">
	  
	  <div id="menu">

		<?php get_sidebar(); ?>
	  </div>

	  
      </div>      </td>
      <td bgcolor="#FFFFFF" width="9" height="159">&nbsp;</td>
      <td bgcolor="#FFFFFF" width="410" height="159" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="td1"><span class="style1"></span></td>
        </tr>
        <tr>
          <td valign="top" class="td2">
		  <?php  get_header(); ?>
		


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

			

		<div class="post" id="post-<?php the_ID(); ?>">

			<a href="<?php the_permalink() ?>" rel="bookmark" class="postlink" title="<?php bloginfo('name');?>: <?php the_title(); ?>"><?php the_title(); ?></a><br/>

			<span id="postdata"><?php _e('Posted on',TEMPLATE_DOMAIN);?> <?php the_time(__('F jS, Y')) ?> <?php _e('at',TEMPLATE_DOMAIN);?> <?php the_time('g:i a'); ?> <?php _e('by',TEMPLATE_DOMAIN);?> <?php the_author_posts_link() ?> and <?php the_tags( '' . __( 'tagged',TEMPLATE_DOMAIN ) . ' ', ', ', ''); ?></span>



			<div class="entry">

            <?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } else { ?>
<?php the_content(__('(Read the rest of this story.)',TEMPLATE_DOMAIN)); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
<?php } ?>




			</div>

	

			<div id="cats">
                  <p class="postmetadata"><?php _e('Posted in ',TEMPLATE_DOMAIN);?> <?php the_category(', ') ?>
                    <strong>|</strong> 
                    <?php edit_post_link(__('Edit',TEMPLATE_DOMAIN), '','<strong> |</strong>'); ?>
                    <?php comments_popup_link(__('No Comments',TEMPLATE_DOMAIN), __('1 Comment',TEMPLATE_DOMAIN), __('% Comments',TEMPLATE_DOMAIN)); ?>
                  </p>
                  <div id="divider"> </div></div>
		</div>



	<?php comments_template('',true); ?>

	<?php endwhile; ?>



		<p align="center"><?php next_posts_link(__('&laquo; Previous Entries',TEMPLATE_DOMAIN)) ?> &nbsp; <?php previous_posts_link(__('Next Entries &raquo;',TEMPLATE_DOMAIN)) ?></p>



	<?php else : ?>

		<h2 align="center"><?php _e('Not Found',TEMPLATE_DOMAIN);?></h2>

		<p align="center"><?php _e("Sorry, but you are looking for something that isn't here.",TEMPLATE_DOMAIN);?></p>

	<?php endif; ?>

</td>
        </tr>
      </table><br /><div align="center"><?php get_footer(); ?></div></td>
      <td valign="top" class="image5" width="108"><div class="image6">&nbsp;</div></td>
    </tr>
  </table>
</div>
</body>
