<?php /* Arclite/digitalnature */ ?>

<!-- 2nd column (sidebar) -->
<div class="col2">
 <ul id="sidebar">

    <?php if ( is_404() || is_category() || is_day() || is_month() || is_year() || is_search() || is_paged() ) { ?>
    <li class="block">
     <div class="info-text">
      <?php /* If this is a 404 page */ if (is_404()) { ?>
      <?php /* If this is a category archive */ } elseif (is_category()) { ?>
      <p><?php printf(__('You are currently browsing the archives for the %s category.', 'arclite'), single_cat_title('',false)); ?></p>

      <?php /* If this is a yearly archive */ } elseif (is_day()) { ?>
      <p><?php printf(__('You are currently browsing the archives for %s','arclite'), get_the_time(__('l, F jS, Y','arclite'))); ?></p>

      <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
      <p><?php printf(__('You are currently browsing the archives for %s','arclite'), get_the_time(__('F, Y','arclite'))); ?></p>

      <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
      <p><?php printf(__('You are currently browsing the archives for the year %s','arclite'), get_the_time(__('Y','arclite'))); ?></p>

      <?php /* If this is a monthly archive */ } elseif (is_search()) { ?>
      <p class="error"><?php printf(__('You have searched the archives for %s.','arclite'), '<strong>'.get_search_query().'</strong>'); ?></p>

      <?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
      <p><?php _e('You are currently browsing the archives.','arclite'); ?></p>
      <?php } ?>
     </div>
    </li>
    <?php }?>

    <?php if(get_option('arclite_sidebarcat')<>'no')  { ?>
    <li class="block">
      <!-- sidebar menu (categories) -->
      <ul class="menu">
        <?php if(get_option('arclite_jquery')=='no') {
          echo preg_replace('@\<li([^>]*)>\<a([^>]*)>(.*?)\<\/a>@i', '<li$1><a class="fadeThis"$2>$3</a>', wp_list_categories('show_count=0&echo=0&title_li='));
        } else {
          echo preg_replace('@\<li([^>]*)>\<a([^>]*)>(.*?)\<\/a> \(\<a ([^>]*) ([^>]*)>(.*?)\<\/a>\)@i', '<li $1><a class="fadeThis"$2>$3</a><a class="rss tip" $4></a>', wp_list_categories('show_count=0&echo=0&title_li=&feed=XML')); } ?>

        <?php if (function_exists('xili_language_list')) { xili_language_list(); } ?>

      </ul>
      <!-- /sidebar menu -->
    </li>
    <?php } ?>





    <!--feedburner-->
    <li class="block">
      <!-- box -->
      <div class="box">
       <div class="titlewrap"><h4><span><?php _e('Rss Feeds','arclite'); ?></span></h4></div>
       <div class="wrapleft">
        <div class="wrapright">
         <div class="tr">
          <div class="bl">
           <div class="tl">
            <div class="br the-content">
             <ul>

              <li style="font-size: 15px; line-height: 17px !important; list-style: none; margin: 0px 0px 10px 0px;"><strong><?php _e('Subscribe to news and updates'); ?></strong></li>
              <li><a href="<?php $feed_active = get_option('arclite_social_feedburner'); if($feed_active == '') { ?> <?php bloginfo('rss2_url'); ?> <?php } else { ?> <?php echo "http://feeds2.feedburner.com/$feed_active"; ?> <?php } ?>"><?php _e('Subscribe to rss feeds'); ?></a></li>
<li><a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Subscribe to rss comments feeds'); ?></a></li>

             </ul>
            </div>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
      <!-- /box -->
    </li>


    <?php if( is_home() ) { ?>
    <?php $twitter_active = get_option('arclite_social_twitter'); if($twitter_active != '') { ?>
    <!--feedburner-->
    <li class="block">
      <!-- box -->
      <div class="box">
       <div class="titlewrap"><h4><span><?php _e('Twitters','arclite'); ?></span></h4></div>
       <div class="wrapleft">
        <div class="wrapright">
         <div class="tr">
          <div class="bl">
           <div class="tl">
            <div class="br the-content">



<ul id="twitter_update_list">
<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo $twitter_active; ?>.json?callback=twitterCallback2&amp;count=5"></script>
<li style="margin-top: 10px;"><strong>Follow <a title="follow <?php echo $twitter_active; ?> in twitter" href="http://twitter.com/<?php echo $twitter_active; ?>"><?php echo $twitter_active; ?></a> in Twitter</strong></li>
</ul>



            </div>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
      <!-- /box -->
    </li>

    <?php } ?>
    <?php } ?>



    <?php 	/* Widgetized sidebar, if you have the plugin installed. */
    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
    <?php // wp_list_bookmarks('category_before=&category_after=&title_li=&title_before=&title_after='); ?>

    <li class="block">
      <!-- box -->
      <div class="box">
       <div class="titlewrap"><h4><span><?php _e('Archives','arclite'); ?></span></h4></div>      
       <div class="wrapleft">
        <div class="wrapright">
         <div class="tr">
          <div class="bl">
           <div class="tl">
            <div class="br the-content">
             <ul>
              <?php wp_get_archives('type=monthly&show_post_count=1'); ?>
             </ul>
            </div>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
      <!-- /box -->
    </li>

    <li class="block">
      <!-- box -->
      <div class="box">
       <div class="titlewrap"><h4><span><?php _e('Meta','arclite'); ?></span></h4></div>
       <div class="wrapleft">
        <div class="wrapright">
         <div class="tr">
          <div class="bl">
           <div class="tl">
            <div class="br the-content">
             <ul>
              <?php wp_register(); ?>
              <li><?php wp_loginout(); ?></li>
              <li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
              <li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
              <li><a href="http://wordpress.org/" title="Provided by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
              <?php wp_meta(); ?>
             </ul>
            </div>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
      <!-- /box -->
    </li>
    <?php endif; ?>
 </ul>
</div>
<!-- /2nd column -->
