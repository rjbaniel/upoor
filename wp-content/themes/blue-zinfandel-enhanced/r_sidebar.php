<!-- begin r_sidebar -->


<div id="r_sidebar">

<ul id="r_sidebarwidgeted">

<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : else : ?>

<li id="Recent">
<h2><?php _e('Recently Written', 'blue-zinfandel');?></h2>
<ul>
<?php wp_get_archives('postbypost', 10); ?>
</ul>
</li>

<?php endif; ?>

</ul>

</div>


<!-- end r_sidebar -->
