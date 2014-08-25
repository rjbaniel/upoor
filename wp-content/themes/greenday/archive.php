<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

		<?php if (have_posts()) : ?>

		 <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php /* If this is a category archive */ if (is_category()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for the','greenday');?> '<?php echo single_cat_title(); ?>' <?php _e('Category','greenday');?></h2>

 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for','greenday');?>
    <?php the_time(__('F jS, Y')); ?></h2>

	 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for','greenday');?>
    <?php the_time('F, Y'); ?></h2>

		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="pagetitle"><?php _e('Archive for','greenday');?>
    <?php the_time('Y'); ?></h2>

	  <?php /* If this is a search */ } elseif (is_search()) { ?>
		<h2 class="pagetitle"><?php _e('Search Results','greenday');?></h2>

	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="pagetitle"><?php _e('Author Archive','greenday');?></h2>

		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle"><?php _e('Blog Archives','greenday');?></h2>

		<?php } ?>


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







		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries','greenday')) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;','greenday')) ?></div>
		</div>

		<?php while (have_posts()) : the_post(); ?>
			<h3 class="cdate">
					<div id="date"><?php the_time('d') ?></div>
					<div id="mon"><?php the_time('M') ?></div>
					<div id="year"><?php the_time('Y') ?></div>
				</h3>
				<div class="post" id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','greenday');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<small><?php _e('by','greenday'); ?> <?php the_author() ?></small>

				<div class="entry">

<?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>

<?php } else { ?>

<?php the_content(__('Read the rest of this entry &raquo;','greenday')); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>

<?php } ?>

</div>

				<p class="postmetadata"><?php _e('Posted in ','greenday');?> <?php the_category(', ') ?> | <?php edit_post_link(__('Edit','greenday'), '', ' | '); ?>  <?php comments_popup_link(__('No Comments &#187;','greenday'), __('1 Comment &#187;','greenday'), __('% Comments &#187;','greenday')); ?></p>
			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries','greenday')) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;','greenday')) ?></div>
		</div>

	<?php else : ?>

		<h2 class="center"><?php _e('Not Found','greenday');?></h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
