<!-- 2nd sidebar -->
<div id="sidebar2">
 <div id="sidebar2-wrap">
  <ul id="sidelist2">
    <?php
     if (function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : else : ?>


       <li class="box-wrap" id="box-archives">
          <div class="box">
           <h2 class="title"><?php _e('Archives','fusion'); ?></h2>
           <div class="inside">
            <ul>
             <?php wp_get_archives('type=monthly&show_post_count=1'); ?>
            </ul>
           </div>
          </div>
        </li>



    <?php endif; ?>
  </ul>
 </div>
</div>
<!-- /2nd sidebar -->
