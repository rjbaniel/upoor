<?php get_header(); ?>

<div id="container">
<div id="left-div">
    <div id="left-inside">
        <?php if (get_option('lightsource_format') == 'on') { ?>
			<?php get_template_part('includes/blogstyle'); ?>
        <?php } else { get_template_part('includes/defaultindex'); } ?>
    </div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
</body>
</html>