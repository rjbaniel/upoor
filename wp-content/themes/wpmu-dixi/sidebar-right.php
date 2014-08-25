<?php include (TEMPLATEPATH . '/lib/includes/options.php'); ?>

<div id="right-sidebar">

<ul class="list">
<?php if($tn_wpmu_dixi_show_profile == "yes"){ ?>
<?php locate_template ( array('/lib/templates/profiles.php'), true ); ?>
<?php } ?>

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('right-sidebar') ) : ?>

<li>
<h3><?php _e('Recent Articles', TEMPLATE_DOMAIN); ?></h3>
<ul>
<?php wp_get_archives('type=postbypost&limit=10'); ?>
</ul>
</li>


<?php if(function_exists("wp_tag_cloud")) { ?>
<li>
<h3><?php _e('Popular Tags', TEMPLATE_DOMAIN); ?></h3>
<ul>
<li>
<?php wp_tag_cloud('smallest=10&largest=20&'); ?>
</li>
</ul>
</li>
<?php } ?>

<li>
<h3><?php _e('Recent Comments', TEMPLATE_DOMAIN); ?></h3>
<ul class="list">
<?php get_avatar_recent_comment($avatar_size='32'); ?>
</ul>
</li>

<?php if(function_exists("get_hottopics")) : ?>
<li>
<h3><?php _e('Most Commented', TEMPLATE_DOMAIN); ?></h3>
<ul class="list">
<?php get_hottopics(10); ?>
</ul>
</li>
<?php endif; ?>

<?php endif; ?>
</ul>
</div>