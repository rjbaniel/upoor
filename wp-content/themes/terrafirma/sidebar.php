<div id="sidebar">
<ul>

<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar() ) : else : ?>


<?php if(is_home()) { ?>
<li>

	<h2><?php _e('About',TEMPLATE_DOMAIN); ?></h2>
	<p>



    <?php if($img_firma = "") { ?>
	<img src="<?php bloginfo('stylesheet_directory');?>/images/profile.jpg" alt="Profile" class="profile" />
    <?php } else { ?>
    <img src="<?php echo get_option('terrafirma_profileimg'); ?>" width="150" height="80" alt="Profile" class="profile" />
    <?php } ?>


	<strong><?php bloginfo('name');?></strong><br/><?php bloginfo('description'); ?>

	</p>


</li>
<?php } ?>


<li>
	<h2><?php _e('Recent Posts',TEMPLATE_DOMAIN); ?></h2>
	<ul><?php wp_get_archives('type=postbypost&limit=6')?></ul>
</li>
  <?php if (function_exists('wp_tag_cloud')) {	?>
  <li>
    <h2>
      <?php _e('Tags'); ?>
    </h2>
    <p>
      <?php wp_tag_cloud(); ?>
    </p>
  </li>
  <?php } ?>
<li>
	<h2><?php _e('Archives',TEMPLATE_DOMAIN); ?></h2>
	<ul><?php wp_get_archives('type=monthly&show_post_count=true'); ?></ul>
</li>

<li>
	<h2><?php _e('Categories',TEMPLATE_DOMAIN); ?></h2>
	<ul>
		<?php 
         wp_list_categories('title_li=&show_count=1');    ?>
	</ul>		
</li>

<li>
	<h2><?php _e('Pages',TEMPLATE_DOMAIN); ?></h2>
	<ul><?php wp_list_pages('title_li=' ); ?></ul>	
</li>

<?php if(is_home()) { terrafirma_ShowLinks(); ?>
  <li>
	<h2><?php _e('Feed on RSS',TEMPLATE_DOMAIN); ?></h2>
	<ul class="feeds">
		<li>
			<a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Posts Feed'); ?>"><?php _e('Posts Feed'); ?></a>
		</li>
		<li>
			<a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('Posts Feed'); ?>"><?php _e('Comments Feed'); ?></a>
		</li>
	</ul>
</li>


<li>
	<h2><?php _e('Meta',TEMPLATE_DOMAIN); ?></h2>
	<ul>
		<?php wp_register(); ?>
		<li><?php wp_loginout(); ?></li>

		<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>

		<?php wp_meta(); ?>
	</ul>
</li>
<?php }?>
  <?php endif; ?>
</ul>
</div><!-- end id:sidebar -->
