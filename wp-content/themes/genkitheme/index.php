<?php get_header(); ?>
<div id="contentwrapper">
<div id="content">

<div id="custom-img-header">
<h1><a title="<?php _e('back to','genki'); ?> <?php bloginfo('name'); ?>" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
<p><?php bloginfo('description'); ?></p>

<div id="custom-navigation">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<?php if ( has_nav_menu( 'main-nav' ) ) { ?>
<ul id="nav">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
</ul>
<?php } ?>
<?php } else { ?>
<ul id="nav">
<?php wp_list_pages('title_li=&depth=1'); ?>
</ul>
<?php } ?>
</div>

</div>

	<?php if (have_posts()) :?>

          <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

		<?php $postCount=0; ?>
		<?php while (have_posts()) : the_post();?>
			<?php $postCount++;?>

	<div class="entry">
		<div class="entrytitle entry-<?php echo $postCount ;?>">
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','genki');?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<h3><?php the_category(', ') ?> <?php the_time(__('F jS, Y')) ?> </h3>
		</div>

		<div class="entrybody">


           <?php if( is_date() || is_search() || is_tag() || is_author() ) { ?>

<?php if(function_exists('the_post_thumbnail')) { ?><?php if(get_the_post_thumbnail() != "") { ?><div class="alignleft">
<?php the_post_thumbnail(); ?></div><?php } } ?>
<?php the_excerpt();?>

<?php } else { ?>

<?php the_content(__('...Read the rest of this entry &raquo;','genki')); ?>
<?php wp_link_pages('before=<p>&after=</p>'); ?>

<?php } ?>

		</div>

		<div class="entrymeta">
		<div class="postinfo">
			<?php comments_popup_link(__('No Comments','genki'), __('1 Comment','genki'), __('% Comments','genki'), 'commentmeta'); ?> <?php edit_post_link(__('Edit','genki'), ' | ', ' | '); ?> <?php the_tags( '&nbsp;' . __( 'Tagged' ,'genki') . ' ', ', ', ''); ?>
		</div>
		</div>
	</div>

	<div class="commentsblock">
		<?php // comments_template('',true); ?>
	</div>

	<?php endwhile; ?>
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries','genki')) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;','genki')) ?></div>
		</div>

	<?php else : ?>
		<h2><?php _e('Not Found','genki');?></h2>
		<div class="entrybody"><?php _e("Sorry, but you are looking for something that isn't here.",'genki');?></div>

	<?php endif; ?>

   <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
