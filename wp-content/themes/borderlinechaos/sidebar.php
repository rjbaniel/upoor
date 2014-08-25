<!--If you would like to add or delete sideboxes please be sure to start at <div id="sidebox#> through the closing </div> and the next <br />. Contact me at http://theloo.org/2005/03/06/borderline-chaos/ with questions! -->

<div id="sidebar">
	<div id="sidebox">

<div class="title"><?php bloginfo('description'); ?></div>

<?php /* If this is a category archive */ if (is_category()) { ?>

			<p><?php _e('You are currently browsing the', 'borderline');?> <a href="<?php bloginfo('url'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives for the ', 'borderline');?>'<?php echo single_cat_title(); ?>' ')<?php _e('category.', 'borderline');?></p>



			<?php /* If this is a yearly archive */ } elseif (is_day()) { ?>

			<p><?php _e('You are currently browsing the', 'borderline');?> <a href="<?php bloginfo('url'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives.', 'borderline');?></p>


			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>

			<p><?php _e('You are currently browsing the', 'borderline');?> <a href="<?php bloginfo('url'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives.', 'borderline');?></p>



      <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>

			<p><?php _e('You are currently browsing the', 'borderline');?> <a href="<?php bloginfo('url'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives.', 'borderline');?></p>



		 <?php /* If this is a monthly archive */ } elseif (is_search()) { ?>

			<p><?php _e('You have searched the', 'borderline');?> <a href="<?php bloginfo('url'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives for', 'borderline');?> <strong>'<?php echo $s; ?>'</strong>. <?php _e("If you are unable to find anything in these search results, we're really sorry.", 'borderline');?></p>



			<?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>

			<p><?php _e('You are currently browsing the', 'borderline')?> <a href="<?php bloginfo('url'); ?>"><?php echo bloginfo('name'); ?></a> <?php _e('weblog archives.', 'borderline');?></p>



			<?php } ?>



</div>

<br />


	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>

	



<br />

        <div id="sidebox2">

<div class="title"><?php _e('Pages', 'borderline');?></div>
<ul><?php wp_list_pages('title_li=&depth=0'); ?></ul>
</div>
            <br />

	<div id="sidebox2">

<div class="title"><?php _e('Categories', 'borderline');?></div>

				<?php wp_list_categories(0, '', 'name', 'asc', '', 0, 0, 1, 1, 1, 1, 0,'','','','','28') ?>
</div>

<br />

	<div id="sidebox3">

<div class="title"><?php _e('Archives', 'borderline'); ?></div>

<?php wp_get_archives('type=monthly&format=other&after=<br />'); ?></div>



<br />

	<div id="sidebox4">

<form style="padding: 0px; margin-top: 0px; margin-bottom: 0px;" id="searchform" method="get" action="<?php bloginfo('url'); ?>">



<div class="title"><?php _e('Search:', 'borderline');?></div>

<p style="padding: 0px; margin-top: 0px; margin-bottom: 0px;"><input type="text" class="input" name="s" id="search" size="15" />

<input name="submit" type="submit" tabindex="5" value="<?php _e('GO', 'borderline'); ?>" /></p>

</form></div>


	<?php endif; ?>

</div>

