<?php get_header(); ?>

<body id="body-404">
           <div id="inwrap"> 
<div id="intro">
	
	<span id="page-id"><?php _e("404",TEMPLATE_DOMAIN); ?></span>
	
	<div id="identity">
		
		<h1><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a></h1>
		<div id="main-nav">

         <div id="custom">
          <div id="custom-navigation">
<?php if ( function_exists( 'wp_nav_menu' ) ) { // Added in 3.0 ?>
<ul id="nav">
<?php echo bp_wp_custom_nav_menu($get_custom_location='main-nav', $get_default_menu='revert_wp_menu_page'); ?>
</ul>
<?php } else { ?>
<ul id="nav">
<?php wp_list_pages('title_li=&depth=1'); ?>
</ul>
<?php } ?>
</div>
              </div>
              
		</div>

	</div>
		
	<?php include (TEMPLATEPATH . "/searchform.php"); ?>
	
	<span class="clearer"></span>

</div>

<div id="summary">

	<div class="post-summary">
		<h2 class="page-title"><?php _e("Error: Not Found",TEMPLATE_DOMAIN); ?></h2>
	</div>	
	
	<span class="clearer"></span>

</div>	

<div id="post-content">

	<p><?php _e("Sorry, what you are looking for can't be found, try searching for it.",TEMPLATE_DOMAIN); ?></p>

</div>

<?php get_footer(); ?>
