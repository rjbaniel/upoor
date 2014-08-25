<div id="sidebar">
  <div class="side2">
    <ul>
 <li class="boxy"> <?php if (function_exists('wp_ozh_wsa')) { wp_ozh_wsa("20090linkunitnocolor"); } ?></li>
	  <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar() ) : else : ?>
	  <li class="boxy"><h2><?php _e('Blog Search','dignity'); ?></h2>
	  		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	  </li>
 <?php wp_list_categories('show_count=1&title_li=<h2>'.__('Categories','dignity').'</h2>'); ?>
	 <li class="boxy">
        <h2><?php _e('Archives','dignity');?></h2>
        <ul>
          <?php wp_get_archives('type=monthly'); ?>
        </ul>
      </li>
     <?php /* If this is the frontpage */ if (is_home()) { ?>
      <?php wp_list_bookmarks(); ?>
      <?php } ?>
	  <li class="boxy">
	   <h2><?php _e('Meta','dignity');?></h2>
        <ul>
          <?php wp_register(); ?>
          <li>
            <?php wp_loginout(); ?>
          </li>

          <li><a href="http://gmpg.org/xfn/"><abbr title="<?php _e('XHTML Friends Network');?>">XFN</abbr></a></li>

          <?php wp_meta(); ?>
        </ul>
	</li>
      <?php endif; ?>
    </ul>
  </div>
</div>
