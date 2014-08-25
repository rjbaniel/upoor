<?php get_header(); ?>

<div id="main">
<h2></h2><br />

<div class="archive_title"><?php _e('Error 404');?>- <?php _e('File not Found');?>!</div>

<div class="main_post">
<?php _e("You are <em>totally</em> in the wrong place. Do not pass GO; do not collect $200.<br />
Instead, try one of the following:",TEMPLATE_DOMAIN); ?>
<ul>
<li><?php _e("Hit the \"back\" button on your browser.",TEMPLATE_DOMAIN); ?></li>
<li><?php _e("Head on over to the",TEMPLATE_DOMAIN); ?> <a href="<?php bloginfo('url'); ?>"><?php _e("front page",TEMPLATE_DOMAIN); ?></a>.</li>
<li><?php _e("Try searching using the form below.",TEMPLATE_DOMAIN); ?></li>
<li><?php _e("Click on a link in the sidebar.",TEMPLATE_DOMAIN); ?></li>
<li><?php _e("Use the navigation menu at the top of the page.",TEMPLATE_DOMAIN); ?></li>
<li><?php _e("Punt.",TEMPLATE_DOMAIN); ?></li>
</ul><br /><br />

<?php _e("Searching for something in particular?  Enter your keywords below:",TEMPLATE_DOMAIN); ?>
<form method="get" action="<?php bloginfo('url'); ?>" />
<input type="text" name="s" id="s" />&nbsp;&nbsp;
<input type="submit" id="button" name="submit" value="<?php _e("Go!",TEMPLATE_DOMAIN); ?>" />
</form><br /></div>


</div>


<div id="menu">
<?php get_sidebar(); ?>
</div>

</div>
<div class="clearfix"></div>
<div id="footer"><?php get_footer(); ?></div>
</div>

</body>
</html>
