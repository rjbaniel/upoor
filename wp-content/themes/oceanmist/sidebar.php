	<div id="sidebar">




      <?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>
		
	  <div class="title">
        <h2><?php _e("Browse",TEMPLATE_DOMAIN); ?></h2>
      </div>
      <div class="post">
        <select name="archivemenu" onchange="document.location.href=this.options[this.selectedIndex].value;">
          <option value=""><?php _e("Monthly Archives",TEMPLATE_DOMAIN); ?></option>
          <?php wp_get_archives('monthly','','option','','',''); ?>
        </select>		
        <?php include (TEMPLATEPATH . '/searchform.php'); ?>
	  </div>
	  <div class="title">
        <h2><?php _e("Subscribe",TEMPLATE_DOMAIN); ?></h2>
      </div>
	  <div class="post">
	    <ul>
	      <li><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Entries (RSS)',TEMPLATE_DOMAIN);?></a></li>
		  <li><a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments (RSS)',TEMPLATE_DOMAIN);?></a></li>
		</ul>
      </div>
<?php endif; ?>
</div>
