<?php get_header(); ?>

<body id="body-page">
     <div id="inwrap"> 
<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>
	
<div id="intro">
	
	<span id="page-id"><?php _e("page",TEMPLATE_DOMAIN); ?></span>
	
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

	<div class="page-summary">
	
		<h2 class="page-title"><?php the_title(); ?></h2>
	</div>	
	
	<span class="clearer"></span>

</div>	

<div id="post-content">
	<?php the_content(); ?>
</div>

<div id="discussion-area">

	<div id="post-comments">
	   <?php if ( comments_open() ) { ?> <?php comments_template('',true); ?><?php } ?>
	</div>
	
</div>
	
<?php endwhile; ?>

<?php else : ?>

	<h2><?php _e('Not Found',TEMPLATE_DOMAIN);?></h2>
	<p><?php _e("Sorry, but you are looking for something that isn't here.",TEMPLATE_DOMAIN);?></p>

<?php endif; ?>

<?php get_footer(); ?>
