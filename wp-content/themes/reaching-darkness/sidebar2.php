<!-- BEGIN SIDEBAR2.PHP -->

<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar 2') ) : else : ?>

<div class="menu">
<h2 class="menu-header"><?php _e('Meta',TEMPLATE_DOMAIN); ?></h2>
<ul>
<?php wp_register(); ?>
<li><?php wp_loginout(); ?></li>
<?php wp_meta(); ?>
</ul>
</div>

<!-- uncomment this to add the calendar to your sidebar
<div class="menu">
<h2 class="menu-header"><?php _e('Calendar'); ?></h2>
<?php get_calendar(); ?>
</div>
-->

<?php endif; ?>

<!-- END SIDEBAR2.PHP -->
