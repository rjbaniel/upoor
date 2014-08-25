<?php include (TEMPLATEPATH . '/lib/includes/options.php'); ?>

<?php
if (file_exists(ABSPATH . WPINC . '/feed.php')) {
require_once (ABSPATH . WPINC . '/feed.php');
}
else if (file_exists(ABSPATH . WPINC . '/rss.php')) {
require_once (ABSPATH . WPINC . '/rss.php');
}
else if(file_exists(ABSPATH . WPINC . '/rss-functions.php')){
require_once(ABSPATH . WPINC . '/rss-functions.php');
}
?>

<?php if($tn_wpmu_dixi_rss_one_url != ''){ ?>
<div id="tab-content">
<div class="tabber">
<?php if($tn_wpmu_dixi_rss_one_url == ''){ ?>
<?php } else { ?>
<div class="tabbertab">
<h3><?php echo "$tn_wpmu_dixi_rss_one"; ?></h3>
<?php
$get_net_gfeed_url = $tn_wpmu_dixi_rss_one_url;
$rss = @fetch_feed("$get_net_gfeed_url");
$msg = "";
if (!is_wp_error( $rss )) {
$maxitems = $rss->get_item_quantity($tn_wpmu_dixi_rss_one_sum);
foreach($rss->get_items(0, $maxitems) as $item){

$feed_livelink = $item->get_permalink();
$feed_livelink = str_replace("&", "&amp;",$feed_livelink);
$feed_livelink = str_replace("&amp;&amp;", "&amp;", $feed_livelink);

$feed_authorlink = $item->get_author()->name;

$feed_categorylink = $item->get_category()->term;

$feed_livetitle = ucfirst($item->get_title());

$feed_descriptions = $item->get_description();
if ($feed_descriptions) {
$feed_descriptions = strip_tags($feed_descriptions);
$feed_descriptions = substr_replace($feed_descriptions,"...","$tn_wpmu_dixi_rss_one_wordcount");
} else {
$feed_descriptions = '';
}
$msg .= "
<div class=\"feed-pull\"><h1>
<a href=\"".trim($feed_livelink)."\" rel=\"external nofollow\" title=\"".trim($feed_livetitle)."\">".trim($feed_livetitle)."</a>
</h1>
<div class=\"rss-author\">by $feed_authorlink</div>
<div class=\"rss-content\">$feed_descriptions</div></div>\n";
}
echo "$msg";
} else {
_e("<div class=\"rss-content\">Currently there is no feed available</div>", TEMPLATE_DOMAIN);
}
?>
</div>
<?php } ?>





<?php if($tn_wpmu_dixi_rss_two_url == ''){ ?>
<?php } else { ?>
<div class="tabbertab">
<h3><?php echo "$tn_wpmu_dixi_rss_two"; ?></h3>
<?php
$get_net_gfeed_url2 = $tn_wpmu_dixi_rss_two_url;
$rss2 = @fetch_feed("$get_net_gfeed_url2");
$msg2 = "";
if (!is_wp_error( $rss2 )) {
$maxitems2 = $rss2->get_item_quantity($tn_wpmu_dixi_rss_two_sum);
foreach($rss2->get_items(0, $maxitems2) as $item2){

$feed_livelink2 = $item2->get_permalink();
$feed_livelink2 = str_replace("&", "&amp;", $feed_livelink2);
$feed_livelink2 = str_replace("&amp;&amp;", "&amp;", $feed_livelink2);

$feed_authorlink2 = $item2->get_author()->name;

$feed_categorylink2 = $item2->get_category()->term;

$feed_livetitle2 = ucfirst($item2->get_title());

$feed_descriptions2 = $item2->get_description();
if ($feed_descriptions2) {
$feed_descriptions2 = strip_tags($feed_descriptions2);
$feed_descriptions2 = substr_replace($feed_descriptions2,"...","$tn_wpmu_dixi_rss_two_wordcount");
} else {
$feed_descriptions2 = '';
}
$msg2 .= "
<div class=\"feed-pull\"><h1>
<a href=\"".trim($feed_livelink2)."\" rel=\"external nofollow\" title=\"".trim($feed_livetitle2)."\">".trim($feed_livetitle2)."</a>
</h1>
<div class=\"rss-author\">by $feed_authorlink2</div>
<div class=\"rss-content\">$feed_descriptions2</div></div>\n";
}
echo "$msg2";
} else {
_e("<div class=\"rss-content\">Currently there is no feed available</div>", TEMPLATE_DOMAIN);
}
?>
</div>
<?php } ?>





<?php if($tn_wpmu_dixi_rss_three_url == ''){ ?>
<?php } else { ?>
<div class="tabbertab">
<h3><?php echo "$tn_wpmu_dixi_rss_three"; ?></h3>
<?php
$get_net_gfeed_url3 = $tn_wpmu_dixi_rss_three_url;
$rss3 = @fetch_feed("$get_net_gfeed_url3");
$msg3 = "";
if (!is_wp_error( $rss3 )) {
$maxitems3 = $rss->get_item_quantity($tn_wpmu_dixi_rss_three_sum);
foreach($rss3->get_items(0, $maxitems3) as $item3){

$feed_livelink3 = $item3->get_permalink();
$feed_livelink3 = str_replace("&", "&amp;", $feed_livelink3);
$feed_livelink3 = str_replace("&amp;&amp;", "&amp;", $feed_livelink3);

$feed_authorlink3 = $item3->get_author()->name;

$feed_categorylink3 = $item3->get_category()->term;

$feed_livetitle3 = ucfirst($item3->get_title());

$feed_descriptions3 = $item3->get_description();
if ($feed_descriptions3) {
$feed_descriptions3 = strip_tags($feed_descriptions3);
$feed_descriptions3 = substr_replace($feed_descriptions3,"...","$tn_wpmu_dixi_rss_three_wordcount");
} else {
$feed_descriptions3 = '';
}
$msg3 .= "
<div class=\"feed-pull\"><h1>
<a href=\"".trim($feed_livelink3)."\" rel=\"external nofollow\" title=\"".trim($feed_livetitle3)."\">".trim($feed_livetitle3)."</a>
</h1>
<div class=\"rss-author\">by $feed_authorlink3</div>
<div class=\"rss-content\">$feed_descriptions3</div></div>\n";
}
echo "$msg3";
} else {
_e("<div class=\"rss-content\">Currently there is no feed available</div>", TEMPLATE_DOMAIN);
}
?>
</div>
<?php } ?>



<?php if($tn_wpmu_dixi_rss_four_url == ''){ ?>
<?php } else { ?>
<div class="tabbertab">
<h3><?php echo "$tn_wpmu_dixi_rss_four"; ?></h3>
<?php
$get_net_gfeed_url4 = $tn_wpmu_dixi_rss_four_url;
$rss4 = @fetch_feed("$get_net_gfeed_url4");
$msg4 = "";
if (!is_wp_error( $rss4 )) {
$maxitems4 = $rss4->get_item_quantity($tn_wpmu_dixi_rss_four_sum);
foreach($rss4->get_items(0, $maxitems4) as $item4){

$feed_livelink4 = $item4->get_permalink();
$feed_livelink4 = str_replace("&", "&amp;", $feed_livelink4);
$feed_livelink4 = str_replace("&amp;&amp;", "&amp;", $feed_livelink4);

$feed_authorlink4 = $item4->get_author()->name;

$feed_categorylink4 = $item4->get_category()->term;

$feed_livetitle4 = ucfirst($item4->get_title());

$feed_descriptions4 = $item4->get_description();
if ($feed_descriptions4) {
$feed_descriptions4 = strip_tags($feed_descriptions4);
$feed_descriptions4 = substr_replace($feed_descriptions4,"...","$tn_wpmu_dixi_rss_four_wordcount");
} else {
$feed_descriptions4 = '';
}
$msg4 .= "
<div class=\"feed-pull\"><h1>
<a href=\"".trim($feed_livelink4)."\" rel=\"external nofollow\" title=\"".trim($feed_livetitle4)."\">".trim($feed_livetitle4)."</a>
</h1>
<div class=\"rss-author\">by $feed_authorlink4</div>
<div class=\"rss-content\">$feed_descriptions4</div></div>\n";
}
echo "$msg4";
} else {
_e("<div class=\"rss-content\">Currently there is no feed available</div>", TEMPLATE_DOMAIN);
}
?>
</div>
<?php } ?>




<?php if($tn_wpmu_dixi_rss_five_url == ''){ ?>
<?php } else { ?>
<div class="tabbertab">
<h3><?php echo "$tn_wpmu_dixi_rss_five"; ?></h3>
<?php
$get_net_gfeed_url5 = $tn_wpmu_dixi_rss_five_url;
$rss5 = @fetch_feed("$get_net_gfeed_url5");
$msg5 = "";
if (!is_wp_error( $rss5 )) {
$maxitems5 = $rss5->get_item_quantity($tn_wpmu_dixi_rss_five_sum);
foreach($rss5->get_items(0, $maxitems5) as $item5){

$feed_livelink5 = $item5->get_permalink();
$feed_livelink5 = str_replace("&", "&amp;", $feed_livelink5);
$feed_livelink5 = str_replace("&amp;&amp;", "&amp;", $feed_livelink5);

$feed_authorlink5 = $item5->get_author()->name;

$feed_categorylink5 = $item5->get_category()->term;

$feed_livetitle5 = ucfirst($item5->get_title());

$feed_descriptions5 = $item5->get_description();
if ($feed_descriptions5) {
$feed_descriptions5 = strip_tags($feed_descriptions5);
$feed_descriptions5 = substr_replace($feed_descriptions5,"...","$tn_wpmu_dixi_rss_five_wordcount");
} else {
$feed_descriptions5 = '';
}
$msg5 .= "
<div class=\"feed-pull\"><h1>
<a href=\"".trim($feed_livelink5)."\" rel=\"external nofollow\" title=\"".trim($feed_livetitle5)."\">".trim($feed_livetitle5)."</a>
</h1>
<div class=\"rss-author\">by $feed_authorlink5</div>
<div class=\"rss-content\">$feed_descriptions5</div></div>\n";
}
echo "$msg5";
} else {
_e("<div class=\"rss-content\">Currently there is no feed available</div>", TEMPLATE_DOMAIN);
}
?>
</div>
<?php } ?>

</div>
</div>
<?php } ?>