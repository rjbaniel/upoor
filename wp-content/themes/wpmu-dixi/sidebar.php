<?php include (TEMPLATEPATH . '/lib/includes/options.php'); ?>

<?php if($bp_existed == 'true') { //check if bp existed ?>

<?php if( bp_is_blog_page() ) : ?>

<div id="sidebar">
<ul class="list">
<?php if ( is_active_sidebar( 'left-sidebar' ) ) : ?>
<?php dynamic_sidebar( 'left-sidebar' ); ?>
<?php else: ?>
<li>
<h3><?php _e('Sidebar Widget', TEMPLATE_DOMAIN); ?></h3>
<ul>
<li><?php printf(__('All you need to do is to visit your <a href="%s/widgets.php">widget</a> tab replace this with your widget', 'nelo'), admin_url()); ?></li>
</ul>
</li>
<?php endif; ?>
</ul>
</div>

<?php else: ?>

<?php if ( is_active_sidebar( 'buddypress-sidebar' ) ) : ?>
<div class="bp-sidebar" id="sidebar">
<ul class="list">
<?php dynamic_sidebar( 'buddypress-sidebar' ); ?>
</ul>
</div>
<?php endif; ?>

<?php endif; ?>

<?php } else { ?>

<div id="sidebar">

<ul class="list">
<?php if ( is_active_sidebar( 'left-sidebar' ) ) : ?>
<?php dynamic_sidebar( 'left-sidebar' ); ?>
<?php else: ?>
<li>
<h3><?php _e('Sidebar Widget', TEMPLATE_DOMAIN); ?></h3>
<ul>
<li><?php printf(__('All you need to do is to visit your <a href="%s/widgets.php">widget</a> tab replace this with your widget', 'nelo'), admin_url()); ?></li>
</ul>
</li>
<?php endif; ?>
</ul>
</div>

<?php } ?>

<?php if ( is_active_sidebar( 'bbpress-sidebar' ) ) : ?>
<div class="bb-sidebar" id="sidebar">
<ul class="list">
<?php dynamic_sidebar( 'bbpress-sidebar' ); ?>
</ul>
</div>
<?php endif; ?>