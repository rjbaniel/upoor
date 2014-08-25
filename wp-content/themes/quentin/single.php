<?php get_header(); ?>
<div id="content">

<?php if (have_posts()) : ?>

<?php load_template( TEMPLATEPATH . '/headline.php' ); ?>

<?php while ( have_posts()) : the_post(); ?>


<div class="post">
<h2 class="storytitle" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:',TEMPLATE_DOMAIN);?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>

	
<div class="storycontent">
<div align="center"></div>


<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>

<?php the_content( __('<p>Click here to read more</p>',TEMPLATE_DOMAIN) ); ?>

<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>




<div align="center"></div>
</div>

<?php if (!is_page()) { ?>
<div class="meta">
<?php _e("Published in:",TEMPLATE_DOMAIN); ?> <?php the_category(', ') ?> <?php _e('on',TEMPLATE_DOMAIN);?> <?php the_date('','',''); ?> <?php _e('at',TEMPLATE_DOMAIN);?>
<?php the_time() ?> <?php comments_popup_link(__('Comments (0)',TEMPLATE_DOMAIN), __('Comments (1)',TEMPLATE_DOMAIN), __('Comments (%)',TEMPLATE_DOMAIN)); ?>
<br />
<?php the_tags(__('Tags: ',TEMPLATE_DOMAIN), ', ', '<br />'); ?>
</div>
<?php } ?>


<img src="<?php bloginfo('stylesheet_directory'); ?>/images/printer.gif" width="102" height="27" class="pmark" alt=" " />


<div class="feedback">
<?php wp_link_pages(); ?>
</div>

<?php if( !is_page() ) { ?>
<?php comments_template ('',true); ?>
<?php } else { ?>
<?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>
<?php } ?>

</div>

<?php endwhile; ?>

	<div class="navigation">
		<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries',TEMPLATE_DOMAIN)) ?></div>
		<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;',TEMPLATE_DOMAIN)) ?></div>
	</div>

<?php else: ?>
<p><?php _e('Sorry, no posts matched your criteria.',TEMPLATE_DOMAIN); ?></p>
<?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
