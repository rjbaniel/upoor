<div class="post-category"><?php _e('category:&nbsp;', TEMPLATE_DOMAIN); ?><?php the_category(', ') ?></div>
<div class="post-tag"><?php if(function_exists("the_tags")) : ?><?php the_tags(__('tags:&nbsp;', TEMPLATE_DOMAIN), ', ', ''); ?><?php endif; ?></div>


<?php
$get_social = get_option('tn_wpmu_dixi_social_status');
if(($get_social == "") || ($get_social == "disable")) { ?>
<?php } else { ?>
<div class="post-social">
<?php
$plink = get_permalink();
$plink = urlencode($plink);
$ptitle = get_the_title();
$ptitle = urlencode($ptitle);
?>
<!-- AddThis Button BEGIN -->
<div><a href="http://www.addthis.com/bookmark.php?v=300&amp;pubid=xa-4eee37c445773c21" title="Bookmark and Share" target="_blank"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a></div>
<!-- AddThis Button END -->


</div>
<?php } ?>



<div class="post-mail">
<ul>
<?php if((is_single()) || (is_page())) { ?>
<?php } else { ?>
<li class="mycomment"><?php comments_popup_link( __('No Comment', TEMPLATE_DOMAIN), __('1 Comment', TEMPLATE_DOMAIN), __('% Comments', TEMPLATE_DOMAIN) ); ?></li>
<?php } ?>
<li class="myemail"><a href="mailto:your@friend.com?subject=check this post - <?php the_title(); ?>&amp;body=<?php the_permalink(); ?> " rel="nofollow">
<?php _e('Email to friend', TEMPLATE_DOMAIN); ?></a></li>
<li class="myblogit"><a href="<?php trackback_url() ?>"><?php _e('Blog it', TEMPLATE_DOMAIN); ?></a></li>
<li class="myupdate"><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Stay updated', TEMPLATE_DOMAIN); ?></a></li>
</ul>
</div>