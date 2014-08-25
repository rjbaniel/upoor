body {
font-family: <?php echo $tn_wpmu_dixi_body_font; ?> !important;
color: <?php echo $tn_wpmu_dixi_body_font_colour; ?> !important;
<?php if ( ! get_background_image() && ! get_background_color() ) { ?>
background: <?php if($tn_wpmu_dixi_bg_colour == ""){ ?><?php echo "#E4E4E4"; } else { ?><?php echo $tn_wpmu_dixi_bg_colour; ?><?php } ?><?php if($tn_wpmu_dixi_bg_image == "") { ?><?php } else { ?> url(<?php echo $tn_wpmu_dixi_bg_image; ?>)<?php } ?> <?php echo $tn_wpmu_dixi_bg_image_repeat; ?> <?php echo $tn_wpmu_dixi_bg_image_attachment; ?> <?php echo $tn_wpmu_dixi_bg_image_horizontal; ?> <?php echo $tn_wpmu_dixi_bg_image_vertical; ?>!important;
<?php } ?>
}



h1, h2, h3, h4, h5, h6 {
font-family: <?php echo $tn_wpmu_dixi_headline_font; ?>!important;
}

<?php if(($tn_wpmu_dixi_font_size == "normal") || ($tn_wpmu_dixi_font_size == "")) { ?>
#wrapper { font-size: 0.785em; }
<?php } elseif ($tn_wpmu_dixi_font_size == "small") { ?>
#wrapper { font-size: 0.6875em; }
<?php } elseif ($tn_wpmu_dixi_font_size == "bigger") { ?>
#wrapper { font-size: 0.85em; }
<?php } elseif ($tn_wpmu_dixi_font_size == "largest") { ?>
#wrapper { font-size: 0.9125em; }
<?php } ?>


<?php if( $tn_wpmu_dixi_nav_font != "") { ?>
#nav li { font-family: <?php echo $tn_wpmu_dixi_nav_font; ?> !important;  }
<?php } ?>


<?php if($tn_wpmu_dixi_nv_bg_hover_colour != "") { ?>
#nav li a:hover { background: <?php echo $tn_wpmu_dixi_nv_bg_hover_colour; ?>!important; }
<?php } ?>

<?php if($tn_wpmu_dixi_nv_link_colour != "") { ?>
#nav li a, #nav ul li a { color: <?php echo $tn_wpmu_dixi_nv_link_colour; ?>!important; }
<?php } ?>

<?php if($tn_wpmu_dixi_nv_link_hover_colour != "") { ?>
#nav li a:hover, #nav ul li a:hover { color: <?php echo $tn_wpmu_dixi_nv_link_hover_colour; ?>!important; }
<?php } ?>

<?php if($tn_wpmu_dixi_nv_dropdown_bg_colour != "") { ?>
#nav ul li a { background: <?php echo $tn_wpmu_dixi_nv_dropdown_bg_colour; ?>!important; }
<?php } ?>

<?php if($tn_wpmu_dixi_nv_dropdown_bg_hover_colour != "") { ?>
#nav ul li a:hover { background: <?php echo $tn_wpmu_dixi_nv_dropdown_bg_hover_colour; ?>!important; }
<?php } ?>

<?php if($tn_wpmu_dixi_nv_dropdown_line_colour != "") { ?>
#nav ul li a { border-bottom: 1px solid <?php echo $tn_wpmu_dixi_nv_dropdown_line_colour; ?>!important; }
<?php } ?>


<?php if($tn_wpmu_dixi_content_link_colour != "") { ?>
.content a, #top-header a {
color: <?php echo $tn_wpmu_dixi_content_link_colour; ?>!important;
}
<?php } ?>



<?php if($tn_wpmu_dixi_content_line_colour != "") { ?>
.post-content blockquote {
border-left: 5px solid <?php echo $tn_wpmu_dixi_content_line_colour; ?>!important;
}
#sidebar, #right-sidebar, ol.commentlist li {
border: 1px solid <?php echo $tn_wpmu_dixi_content_line_colour; ?>!important;
}

.wp-caption {
background-color: <?php echo $tn_wpmu_dixi_content_line_colour; ?>!important;
}
#sidebar h3, #right-sidebar h3, #front-content h3 {
	border-bottom: 1px solid <?php echo $tn_wpmu_dixi_content_line_colour; ?>!important;
}
li.feat-img {
    border-bottom: 1px solid <?php echo $tn_wpmu_dixi_content_line_colour; ?>!important;
}
ul.tabbernav {
	border-bottom: 1px solid <?php echo $tn_wpmu_dixi_content_line_colour; ?>!important;
}
.tabbertab .list, .tabbertab .feed-pull, .list .textf {
	border-top: 1px solid <?php echo $tn_wpmu_dixi_content_line_colour; ?>!important;
	border-right: 1px solid <?php echo $tn_wpmu_dixi_content_line_colour; ?>!important;
	border-bottom: 1px solid <?php echo $tn_wpmu_dixi_content_line_colour; ?>!important;
	border-left: 1px solid <?php echo $tn_wpmu_dixi_content_line_colour; ?>!important;
}
div.post, div.page, ol.pinglist li a, ol.pinglist li a:hover, #commentpost h4, #respond h3 {
	border-bottom: 1px solid <?php echo $tn_wpmu_dixi_content_line_colour; ?>!important;
}
ol.commentlist li div.reply a, ol.commentlist li div.reply a:hover {
background: <?php echo $tn_wpmu_dixi_content_line_colour; ?>!important;
color: #FFF!important;
text-decoration: none!important;
}

#cf {
background: <?php echo $tn_wpmu_dixi_content_line_colour; ?>!important;
}

.com, .com-alt {
	border-bottom: 1px solid <?php echo $tn_wpmu_dixi_content_line_colour; ?>!important;
}

.com-avatar img {
	border: 1px solid <?php echo $tn_wpmu_dixi_content_line_colour; ?>!important;
}
<?php } ?>




<?php if($tn_wpmu_dixi_content_link_hover_colour != "") { ?>
#container h1.post-title a:hover, .content a:hover, #top-header a:hover {
color: <?php echo $tn_wpmu_dixi_content_link_hover_colour; ?>!important;
}
<?php } ?>




<?php if($tn_wpmu_dixi_container_colour != "") { ?>
#container { background: <?php echo $tn_wpmu_dixi_container_colour; ?>!important; }
<?php } ?>


<?php if($tn_wpmu_dixi_nv_footer_colour != "") { ?>
#footer { background: <?php echo $tn_wpmu_dixi_nv_footer_colour; ?>!important; }
<?php } ?>

<?php if($tn_wpmu_dixi_nv_footer_colour != "") { ?>
#navigation { background: <?php echo $tn_wpmu_dixi_nv_footer_colour; ?>!important; }
<?php } ?>

<?php if($tn_wpmu_dixi_image_height != "") { ?>
#custom-img-header { height: <?php echo $tn_wpmu_dixi_image_height; ?>px!important; }
<?php } ?>


<?php if($tn_wpmu_dixi_post_title_link_colour != "") { ?>
#front-content .tabbernav li.tabberactive a { background: <?php echo $tn_wpmu_dixi_nv_footer_colour; ?>!important; }
<?php } ?>

<?php if($tn_wpmu_dixi_nv_footer_colour != "") { ?>
#container h1.post-title a {
color: <?php echo $tn_wpmu_dixi_post_title_link_colour; ?>!important;
}
<?php } ?>


<?php if($tn_wpmu_dixi_site_width != "") { ?>
#wrapper {
width: <?php echo $tn_wpmu_dixi_site_width; ?>px !important;
}
<?php } ?>


<?php if($tn_wpmu_dixi_post_width != "") {
$entry_width = $tn_wpmu_dixi_post_width + $tn_wpmu_dixi_right_sidebar_width; ?>
#post-entry {
width: <?php echo $entry_width; ?>px !important;
}
#blog-content {
width: <?php echo $tn_wpmu_dixi_post_width; ?>px !important;
}
<?php } ?>

<?php if($tn_wpmu_dixi_right_sidebar_width != "") { ?>
#right-sidebar {
width: <?php echo $tn_wpmu_dixi_right_sidebar_width - 50; ?>px !important;
}
<?php } ?>

<?php if($tn_wpmu_dixi_left_sidebar_width != "") { ?>
#sidebar {
width: <?php echo $tn_wpmu_dixi_left_sidebar_width - 50; ?>px !important;
}
<?php } ?>


<?php if($tn_wpmu_dixi_container_colour != "") { ?>

table thead tr, .bpfb_form_container {
  background: <?php echo colourCreator($tn_wpmu_dixi_container_colour, 12); ?>;
}

span.activity {
 background: none repeat scroll 0 0 <?php echo colourCreator($tn_wpmu_dixi_container_colour, 20); ?>;
  border: 1px solid <?php echo colourCreator($tn_wpmu_dixi_container_colour, 10); ?>;
color: <?php echo colourCreator($tn_wpmu_dixi_container_colour, 80); ?>;
}

table.forum tr.sticky td {
  background: none repeat scroll 0 0 <?php echo colourCreator($tn_wpmu_dixi_container_colour, 20); ?>;
  border-bottom: 1px solid <?php echo colourCreator($tn_wpmu_dixi_container_colour, 20); ?>;
  border-top: 1px solid <?php echo colourCreator($tn_wpmu_dixi_container_colour, 20); ?>;
}

#forums-dir-list .alt, table tr.alt td,ul#topic-post-list li.alt {background: <?php echo colourCreator($tn_wpmu_dixi_container_colour, 6); ?> !important; }

div.activity-comments form.ac-form {
  background: none repeat scroll 0 0 <?php echo colourCreator($tn_wpmu_dixi_container_colour, 8); ?>;
  border: 1px solid <?php echo colourCreator($tn_wpmu_dixi_container_colour, 10); ?>;
}

ul.item-list li {
  border-bottom: 1px solid <?php echo colourCreator($tn_wpmu_dixi_container_colour, 10); ?>;
}

div.item-list-tabs {
  background: none repeat scroll 0 0 <?php echo colourCreator($tn_wpmu_dixi_container_colour, 15); ?>;
}
div#subnav.item-list-tabs {
  background: none repeat scroll 0 0 <?php echo $tn_wpmu_dixi_container_colour; ?>;
}
div.item-list-tabs ul li.selected a, div.item-list-tabs ul li.current a {
  background-color: <?php echo $tn_wpmu_dixi_container_colour; ?>;
}

div.activity-comments > ul {
  background: none repeat scroll 0 0 <?php echo colourCreator($tn_wpmu_dixi_container_colour, 8); ?>;
}
div.activity-comments ul li {
  border-top: 2px solid <?php echo colourCreator($tn_wpmu_dixi_container_colour, 15); ?>;
}
.activity-list li.load-more {
  background: none repeat scroll 0 0 <?php echo colourCreator($tn_wpmu_dixi_container_colour, 30); ?> !important;
  border-bottom: 1px solid <?php echo colourCreator($tn_wpmu_dixi_container_colour, 10); ?>;
  border-right: 1px solid <?php echo colourCreator($tn_wpmu_dixi_container_colour, 10); ?>;
}
#custom .activity-list li.load-more a {
     color: <?php echo $tn_wpmu_dixi_body_font_colour; ?> !important;
}

.activity-list li.new_forum_post .activity-content .activity-inner, .activity-list li.new_forum_topic .activity-content .activity-inner {
  border-left: 2px solid <?php echo colourCreator($tn_wpmu_dixi_container_colour, 20); ?>;
}

div#subnav.item-list-tabs {
  border-bottom: 1px solid <?php echo colourCreator($tn_wpmu_dixi_container_colour, 20); ?>;
}

.activity-list .activity-content .activity-header, .activity-list .activity-content .comment-header {
  color: <?php echo colourCreator($tn_wpmu_dixi_body_font_colour, 10); ?> !important;
}

button, a.button, input[type="submit"], input[type="button"], input[type="reset"], ul.button-nav li a, div.generic-button a, .comment-reply-link {
 color: #666 !important;
}
button:hover, a.button:hover, input[type="submit"]:hover, input[type="button"]:hover, input[type="reset"]:hover, ul.button-nav li a:hover, div.generic-button a:hover, .comment-reply-link:hover {
 color: #444 !important;
}
<?php } ?>




<?php if($tn_wpmu_dixi_container_colour != "") { ?>
.post-content th {
  background: none repeat scroll 0 0  <?php echo colourCreator($tn_wpmu_dixi_container_colour, 10); ?>;
}
table tr td.label {
  border-right: 1px solid <?php echo colourCreator($tn_wpmu_dixi_container_colour, 30); ?>;
}
.post-content table {
  background: none repeat scroll 0 0 <?php echo colourCreator($tn_wpmu_dixi_container_colour, 20); ?>;
  border: 2px solid <?php echo colourCreator($tn_wpmu_dixi_container_colour, 10); ?>;
}
.bbp-forums .even, .bbp-topics .even {
  background: none repeat scroll 0 0 <?php echo colourCreator($tn_wpmu_dixi_container_colour, 40); ?>;
}
#custom div.bbp-template-notice a {
  color: #555 !important;
}
#content fieldset.bbp-form, #container fieldset.bbp-form, #wrapper fieldset.bbp-form {
  border: 1px solid <?php echo $tn_wpmu_dixi_content_line_colour; ?>;
}
table.bbp-topic tbody tr td, table.bbp-replies tbody tr td {
  background-color: transparent;
}
.bbp-topics-front tr.super-sticky td, .bbp-topics tr.super-sticky td, .bbp-topics tr.sticky td, .bbp-forum-content tr.sticky td {
  background-color:  <?php echo colourCreator($tn_wpmu_dixi_container_colour, 60); ?> !important;
}

.post-content th, .post-content td {
  border: 1px solid <?php echo colourCreator($tn_wpmu_dixi_container_colour, 30); ?>;
}
table.bbp-forums th, table.bbp-topics th, table.bbp-topic th, table.bbp-replies th {
  background-color: <?php echo colourCreator($tn_wpmu_dixi_container_colour, 10); ?>;
}
<?php } ?>