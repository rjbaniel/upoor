<?php get_header(); ?>
<div class="content">
<div class="primary">
                     <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
	<?php include (TEMPLATEPATH . '/theloop.php'); ?>
                    <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("336280nocolor"); } ?>
    <?php comments_template('',true); ?>

</div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
