<?php get_header(); ?>

<div id="main">

<h1 class="main_title">Error - <?php _e('Page not found',TEMPLATE_DOMAIN)?></h1>
<?php _e("Searching for something in particular?  Enter your keywords below:",TEMPLATE_DOMAIN); ?>
<form id="searchform" method="get" action="<?php bloginfo('url'); ?>">
<input type="text" name="s" id="s" size="15" />&nbsp;<input type="submit" id="b" name="submit" value="<?php _e('Go!',TEMPLATE_DOMAIN); ?>" />
</form><br />


</div> 


<div id="sidebar">
<?php get_sidebar(); ?>
</div>

</div>
<div id="frame2"><div id="footer"><?php get_footer(); ?></div></div>
</div>

</body>
</html>
