<!-- open sidebar-wrapper --><div id="sidebar-wrapper">

<!-- open sidebar --><div id="sidebar">

<?php if ( !function_exists('dynamic_sidebar')
|| !dynamic_sidebar() ) : ?>

<!-- open block --><div class="block">
<h2><?php _e('Categories', '72class');?></h2>
<ul>
<?php wp_list_categories('sort_column=name&optioncount=1&hierarchical=0'); ?>
</ul>
<!-- close block --></div>

<!-- open block --><div class="block">
<h2><?php _e('Archives', '72class');?></h2>
<ul>
<?php wp_get_archives('type=monthly'); ?>
</ul>
<!-- close block --></div>

<!-- open block --><div class="block">
<h2><?php _e('Meta', '72class');?></h2>
<ul>
<?php wp_register(); ?>
<li><?php wp_loginout(); ?></li>
<li><a href="http://wordpress.org/" title="<?php _e('Provided by WordPress, state-of-the-art semantic personal publishing platform.');?>">WordPress</a></li>
<?php wp_meta(); ?>
</ul>

<!-- close block --></div>

<?php endif; ?>
<!-- close sidebar --></div>

<!-- close sidebar-wrapper --></div>
