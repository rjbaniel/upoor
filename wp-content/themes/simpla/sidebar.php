<div id="sidebar">
<?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("20090linkunitnocolor"); } ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

<h2>Pages</h2>
<ul>
<li><a href="<?php echo get_option('home'); ?>/">Home</a></li>
<?php wp_list_pages('title_li='); ?> 
</ul>
<h2><?php _e('Categories');?></h2>
<ul>
<?php wp_list_categories('sort_column=name&optioncount=1&hierarchical=0'); ?>
</ul>
<ul>
<?php wp_list_bookmarks(); ?>
</ul>

<?php endif; ?>
</div>
