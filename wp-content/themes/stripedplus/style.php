<?php

// IMAGES
if (get_option( 'striped_backgroundimage' ) == "") { $backgroundimage = get_bloginfo('template_directory') . "/pic/bg.gif"; } else {
$backgroundimage = "http://".get_option( 'striped_backgroundimage' ); }

$headerimage = "http://".get_option( 'striped_headerimage' );



// SITE COLORS
if (get_option( 'striped_backgroundcolor' ) == "") { $backgroundcolor = "#FFF"; } else {
$backgroundcolor = "#".get_option( 'striped_backgroundcolor' ); }

if (get_option( 'striped_maincolor' ) == "") { $maincolor = "#AA0000"; } else {
$maincolor = "#".get_option( 'striped_maincolor' ); }

if (get_option( 'striped_maincolortwo' ) == "") { $maincolortwo = "#444"; } else {
$maincolortwo = "#".get_option( 'striped_maincolortwo' ); }

if (get_option( 'striped_lightborder' ) == "") { $lightborder = "#CCC"; } else {
$lightborder = "#".get_option( 'striped_lightborder' ); }

if (get_option( 'striped_darkborder' ) == "") { $darkborder = "#666"; } else {
$darkborder = "#".get_option( 'striped_darkborder' ); }

if (get_option( 'striped_commentoddcolor' ) == "") { $commentoddcolor = "#EEE"; } else {
$commentoddcolor = "#".get_option( 'striped_commentoddcolor' ); }

if (get_option( 'striped_commentblockquotecolor' ) == "") { $commentblockquotecolor = "#DDD"; } else {
$commentblockquotecolor = "#".get_option( 'striped_commentblockquotecolor' ); }



// FONT COLORS
if (get_option( 'striped_headerfooterfontcolor' ) == "") { $headerfooterfontcolor = "#FFF"; } else {
$headerfooterfontcolor = "#".get_option( 'striped_headerfooterfontcolor' ); }

if (get_option( 'striped_headerfontcolorhover' ) == "") { $headerfontcolorhover = "#EEE"; } else {
$headerfontcolorhover = "#".get_option( 'striped_headerfontcolorhover' ); }

if (get_option( 'striped_currentpagefontcolor' ) == "") { $currentpagefontcolor = "#AAA"; } else {
$currentpagefontcolor = "#".get_option( 'striped_currentpagefontcolor' ); }

if (get_option( 'striped_mainfontcolor' ) == "") { $mainfontcolor = "#000"; } else {
$mainfontcolor = "#".get_option( 'striped_mainfontcolor' ); }

if (get_option( 'striped_datefontcolor' ) == "") { $datefontcolor = "#666"; } else {
$datefontcolor = "#".get_option( 'striped_datefontcolor' ); }

if (get_option( 'striped_smalldatefontcolor' ) == "") { $smalldatefontcolor = "#999"; } else {
$smalldatefontcolor = "#".get_option( 'striped_smalldatefontcolor' ); }

if (get_option( 'striped_commentfontcolor' ) == "") { $commentfontcolor = "#333"; } else {
$commentfontcolor = "#".get_option( 'striped_commentfontcolor' ); }

if (get_option( 'striped_commentlinkcolor' ) == "") { $commentlinkcolor = "#666"; } else {
$commentlinkcolor = "#".get_option( 'striped_commentlinkcolor' ); }



// SITE SETTINGS
if (get_option( 'striped_font' ) == "") { $font = 'Georgia, "Times New Roman", Times, serif'; } else {
$font = stripslashes(get_option( 'striped_font' )); }

if (get_option( 'striped_headerheight' ) == "") { $headerheight = "120"; } else {
$headerheight = get_option( 'striped_headerheight' ); }

if (get_option( 'striped_sitewidth' ) === FALSE) { $sitewidth = "600"; } else {
$sitewidth = get_option( 'striped_sitewidth' ); }

if (get_option( 'striped_type' ) == "") { $type = "px"; } else {
$type = get_option( 'striped_type' ); } ?>
body { 
	font-family:<?php echo $font; ?>;
	margin:0; 
	padding:0;
	background-image:url(<?php echo $backgroundimage; ?>);
}

a:link, a:visited {
    text-decoration:none;
}

a:hover {
    text-decoration:underline;
}

form {
padding:0;
margin:0;
display:inline;
}
 
#bigwrapper {
	width:<?php echo $sitewidth; echo $type; ?>;
	margin:40px auto 40px auto;
	overflow:hidden;
	position:relative;
	border:3px double <?php echo $lightborder; ?>;
	background-color:<?php echo $backgroundcolor; ?>;
	padding:20px 20px 20px 20px;
}

#header h1 {
	position:relative;
	float:left;
	display:block;
	margin:<?php echo $headerheight - 40; ?>px 0 0 20px;
	font-weight:bold;
	font-size:35px;
	line-height:35px;
	color:<?php echo $headerfooterfontcolor; ?>;
	text-transform:uppercase;
}

#header h1 a:link, #header h1 a:visited {
    color:<?php echo $headerfooterfontcolor; ?>;
}

#header h1 a:hover {
    color:<?php echo $headerfontcolorhover; ?>;
    text-decoration:none;
}

#Search input {
	padding:0;
	margin:0;
}

#Search {
	text-align:center;
	padding:5px 0 0 0;
	margin:0;
}


/* Captions and image alignment for wordpress */

div.aligncenter {
	display: block !important;
    margin: 0px auto 10px;
}
div.alignleft {
	float: left !important;
	margin-right: 10px;
}
div.alignright {
	float: right !important;
	margin-right: 0px;
	margin-left: 10px;
}
.wp-caption {
	border: 1px solid #CCCCCC;
	text-align: center;
	background-color: #F8F8F8;
	padding-top: 4px;
	margin-top: 10px;
	margin-bottom: 10px;
}

.wp-caption img {
	margin: 0;
	padding: 0;
	border: 0 none;
}

.wp-caption p.wp-caption-text {
	font-size: 11px;
	line-height: 16px;
    text-align: center !important;
	padding: 5px 4px;
	margin: 0;
	font-family: Arial, Tahoma, "Lucida Sans";
	color: #949494;
	font-style: normal;
}

blockquote p {
	margin: 0px !important;
	padding: 0px;
}

blockquote {
	margin: 1em 25px;
	line-height: 24px;
	font-size: 16px;
	font-weight: normal;
	padding: 10px;
	font-family: Georgia, "Times New Roman", Helvetica, sans-serif;
	font-style: italic;
	border-left: 5px solid #000000;
}


pre {
	margin: 8px 0px;
	padding: 10px;
	clear: both;
	width: 92%;
	overflow: scroll;
	font-family: "Courier New", "MS Sans Serif", sans-serif, serif;
	background: #FFFFFF;
	color: #000000;
	font-size: 13px;
	line-height: 22px;
	white-space: nowrap;
	border: 1px solid #eeeeee;
}
em {
	font-style: italic;
}

p img {
	padding: 0;
	max-width: 100%;
	}

img.centered {
	display: block;
	margin-left: auto;
	margin-right: auto;
	text-align: center;
	}

img.alignright {
	padding: 4px;
	margin: 0 0 2px 7px;
	float: right;
	}

img.alignleft {
	padding: 4px;
	margin: 0 7px 2px 0;
	float: left;
	}

.alignright {
	float: right;
	}

.alignleft {
	float: left;
	}

.commentlist {
  margin: 10px 0px 10px 20px;
  padding: 0px;
  list-style: none;
}
.commentlist li {
  margin-left: 0px;
  padding: 8px;
}
.thread-alt {
  background: #eee;
  padding-top: 10px;
  border-left: 1px solid #ddd;
  border-bottom: 1px solid #ccc;
}


.commentlist .children {
padding-left: 0px;
}

.commentlist .children img.avatar {
  width: 32px;
  height: 32px;
}
.commentlist .children {
padding-left: 10px;
margin-left: 20px;
margin-top: 10px;
border-left: 2px solid #ddd;
list-style: none;
}

.commentlist .children .children img.avatar {
  width: 25px;
  height: 25px;
}

#post-navigator-single {
width: 100%;
float: left;
}

#pings {
  list-style: none;
}
#author-block {
  width: 94%;
  padding: 3%;
  float: left;
  margin-bottom: 25px;
  background: #eee;
}
#author-block h1 {
display: block;
width: 100%;
float: left;
font-size: 20px;
  margin-bottom: 10px;
}
#author-block .info {
 float: left;
 width: 70%;
 padding-left: 15px;
}
#author-block .info p {
 font-size: 12px;
 width: 100%;
float: left;
 margin-top: 0px;
 margin-bottom: 16px;
 line-height: 20px;
}


/* End captions and image alignment */


#header {
	position:relative;
	margin:0;
	background-color:<?php echo $maincolortwo; ?>;
	width:100%;
	height:<?php echo $headerheight; ?>px;
	float:left;
	background-image:url(<?php echo $headerimage; ?>);
}

#footer {
	position:relative;
	margin:0;
	background-color:<?php echo $maincolortwo; ?>;
	width:100%;
	border-top:5px solid <?php echo $maincolor; ?>;
	float:left;
    padding-bottom: 15px;
}

#footer p {
	font-size:10px;
	line-height:16px;
	text-align:center;
	color:<?php echo $headerfooterfontcolor; ?>;
	padding:10px 0 0 0;
	margin:0 0 0 22px;	
}

#footer p a:link, #footer p a:visited {
    color:<?php echo $headerfooterfontcolor; ?>;
}

#topbar {
	position:relative;
	margin:0;
	width:100%;
	overflow:hidden;
	float:left;
	background-color:<?php echo $backgroundcolor; ?>;
}

#redline {
	position:relative;
    height:30px;
	background-color:<?php echo $maincolor; ?>;
	text-align:left;
}

#redline p {
	font-size:10px;
	line-height:10px;
	color:<?php echo $headerfontcolorhover; ?>;
	text-transform:uppercase;
	padding:10px 0 0 0;
	margin:0 0 0 22px;	
	display:block;
	position:relative;
	float:left;
}

#redline .where {
    color:<?php echo $currentpagefontcolor; ?>;
}

#topbarmenuwrapper, #bottombarmenuwrapper {
    position:relative;
    float:left;
    width:100%;
    text-align:center;
    font-size:12px;
}

#topbarmenuwrapper {
    border-bottom:5px solid <?php echo $maincolor; ?>;
    padding:0 0 25px 0;
}

#bottombarmenuwrapper {
    border-top:5px solid <?php echo $maincolor; ?>;
    padding:0 0 25px 0;
}


.barmenuright {
	position:relative;
	width:47%;
	float:right;
	vertical-align:bottom;
	margin-right:1%;
}

.barmenuleft {
	position:relative;
	width:47%;
	float:left;
	vertical-align:bottom;
	margin-left:1%;
}

#bottombarmenuwrapper h3, #topbarmenuwrapper h3 {
	font-size:14px;
	line-height:14px;
	color:<?php echo $headerfontcolorhover; ?>;
	text-transform:uppercase;
	margin:25px 0 0 0;
	padding:6px 0 5px 0;
	display:block;
	background-color:<?php echo $maincolortwo; ?>;
}

#bottombarmenuwrapper h3 a:link, #topbarmenuwrapper h3 a:link, #bottombarmenuwrapper h3 a:hover, #topbarmenuwrapper h3 a:hover, #bottombarmenuwrapper h3 a:visited, #topbarmenuwrapper h3 a:visited {
	color:<?php echo $headerfontcolorhover; ?>;
	text-decoration:none;
}

#bottombarmenuwrapper ul, #topbarmenuwrapper ul {
	padding:0;
	margin:0;
}

#bottombarmenuwrapper ul li, #topbarmenuwrapper ul li {
	list-style:none;
	display:block;
	position:relative;
	line-height:24px;
}

#bottombarmenuwrapper .textwidget, #topbarmenuwrapper .textwidget  { 
margin-top:5px; 
}

#wp-calendar {
	width:100%;
	text-align:center;
	border-collapse: collapse;
}

#wp-calendar caption, #wp-calendar th {
	color:<?php echo $maincolor; ?>;
	padding:4px;
}

#wp-calendar td {
	padding:1px;
	border:none;
}

#wp-calendar caption {
	font-weight:bold;
}

#wp-calendar #today {
	font-weight:bold;
	color:<?php echo $maincolor; ?>;
}

#wp-calendar a {
	color:<?php echo $maincolor; ?>;
	text-decoration:underline;
}

#topbarmenuwrapper img, #bottombarmenuwrapper img {
border:0;
}

#bottombarmenuwrapper ul li a:link, #topbarmenuwrapper ul li a:link, #bottombarmenuwrapper ul li a:visited, #topbarmenuwrapper ul li a:visited {
	display:block;
	position:relative;
	line-height:24px;
	height:100%;
	color:<?php echo $mainfontcolor; ?>;
	text-decoration:none;
	border-bottom:1px solid <?php echo $datefontcolor; ?>;
}

#bottombarmenuwrapper ul li a:hover, #topbarmenuwrapper ul li a:hover {
	color:<?php echo $backgroundcolor; ?>;
	background-color:<?php echo $maincolor; ?>;
}

#recentcomments li {
line-height:24px;
border-bottom:1px solid <?php echo $datefontcolor; ?>;
display:block;
}

#bottombarmenuwrapper ul li a:visited.rsswidget, #bottombarmenuwrapper ul li a:link.rsswidget, #topbarmenuwrapper ul li a:visited.rsswidget, #topbarmenuwrapper ul li a:link.rsswidget, #bottombarmenuwrapper #recentcomments li a:link, #bottombarmenuwrapper #recentcomments li a:visited, #topbarmenuwrapper #recentcomments li a:link, #topbarmenuwrapper #recentcomments li a:visited {
border:0;
display:inline;
line-height:auto;
}

#bottombarmenuwrapper #recentcomments li a:hover, #topbarmenuwrapper #recentcomments li a:hover, #bottombarmenuwrapper ul li a:hover.rsswidget, #topbarmenuwrapper ul li a:hover.rsswidget {
text-decoration:underline;
background-color:<?php echo $backgroundcolor; ?>;
color:<?php echo $mainfontcolor; ?>;
}

.pings a, #post-navigator-single a, .cancel-comment-reply a  {
  color: #444;
  text-decoration: none;
}

.post {
	position:relative;
	width:100%;
	overflow:hidden;
	float:left;
	margin:30px 0 0 0;
	padding:0 0 30px 0;

}

.post p, .post ul {
	font-size:12px;
	line-height:20px;
	color:<?php echo $mainfontcolor; ?>;
	margin:0 20px 0 0;
	padding: 0 0 20px 15px;
	border-left:5px solid <?php echo $maincolor; ?>;
}

.postsnav {
	position:relative;
	width:100%;
	overflow:hidden;
	float:left;
	margin:10px 0 0 0;
	padding:0 0 10px 0;
	font-size:12px;
	color:<?php echo $mainfontcolor; ?>;
	text-align:center;
}

.postsnav a:link, .postsnav a:visited {
color:<?php echo $mainfontcolor; ?>;
}

.post ul {
	border-left:5px solid <?php echo $darkborder; ?>;
	padding:20px 0 20px 50px;
	margin:-20px 0 0 0;
	display:block;
	width:95%;
}

.post ul li ul {
    border:0;
    padding-left:20px;
}

.post p a:link, .post p a:visited, .post ul a:link, .post ul a:visited {
    color:<?php echo $datefontcolor; ?>;
}

.post .posth3 {
	font-size:30px;
	line-height:30px;
	color:<?php echo $mainfontcolor; ?>;
	text-transform:none;
	margin:0 20px 0 0;
	padding:0 0 5px 15px;
	border-left:5px solid <?php echo $lightborder; ?>;
}

.post .posth3 a:link, .post .posth3 a:visited {
    color:<?php echo $mainfontcolor; ?>;
}

.post .posth3 a:hover {
    color:<?php echo $datefontcolor; ?>;
    text-decoration:none;
}

.post .posth2 {
	font-size:20px;
	line-height:20px;
	color:<?php echo $datefontcolor; ?>;
	text-transform:none;
	margin:0 20px 0 0;
	padding:0 0 0 15px;
	border-left:5px solid <?php echo $lightborder; ?>;
}

.post blockquote {
	margin:-20px 0 0 0;
	display:block;
	position:relative;
	float:left;
	border-left:5px solid <?php echo $darkborder; ?>;
	z-index:5;
	width:95%;
}

.post blockquote p {
	border:0;
	padding:20px 0 20px 35px;
	font-style:italic;
}

.post h1 {
	font-size:20px;
	line-height:30px;
	color:<?php echo $maincolor; ?>;
	text-transform:uppercase;
	margin:-20px 20px 0 0;
	padding:15px 0 5px 15px;
	border-left:5px solid <?php echo $lightborder; ?>;
}

.post h2 {
	font-size:16px;
	line-height:25px;
	color:<?php echo $maincolor; ?>;
	text-transform:uppercase;
	margin:-20px 20px 0 0;
	padding:15px 0 5px 15px;
	border-left:5px solid <?php echo $lightborder; ?>;
}

.post h3 {
	font-size:14px;
	line-height:20px;
	color:<?php echo $maincolor; ?>;
	text-transform:uppercase;
	margin:-20px 20px 0 0;
	padding:15px 0 5px 15px;
	border-left:5px solid <?php echo $lightborder; ?>;
}

.post .postdata {
	color:<?php echo $smalldatefontcolor; ?>;
	text-transform:uppercase;
	font-size:11px;
	line-height:11px;
	padding:0 0 0 15px;
}

.post .postdata a:link, .post .postdata a:visited {
    color:<?php echo $smalldatefontcolor; ?>;
}


#commentbar {
	position:relative;
	height:30px;
	background-color:<?php echo $maincolor; ?>;
	background-image:url(pic/headerbg.gif);
	text-align:left;
	overflow:hidden;
}

#commentbar p {
	font-size:10px;
	line-height:10px;
	color:<?php echo $headerfooterfontcolor; ?>;
	text-transform:uppercase;
	padding:10px 0 0 0;
	margin:0 0 0 22px;
	font-weight:bold;	
}

#commentwrapper {
    position:relative;
    float:left;
    width:100%;
    margin:-20px 0 0 0;
}

.commenteven, .commentodd {
    position:relative;
    float:left;
    width:100%;
    margin:25px 0 0 0;
    border:3px double <?php echo $lightborder; ?>;
}

.commentodd {
    background-color:<?php echo $commentoddcolor; ?>;
}

.commentcontent {
    margin:10px 15px 10px 15px;
}

.commentcontent p {
	font-size:12px;
	line-height:16px;
	color:<?php echo $commentfontcolor; ?>;
}

.commentcontent p a:link, .commentcontent p a:visited {
    color:<?php echo $commentlinkcolor; ?>;
}

.commentcontent blockquote {
    font-style:italic;
    margin:0 0 0 10px;
    border-left:3px solid <?php echo $maincolor; ?>;
    padding:0 0 0 5px;
    background-color:<?php echo $commentblockquotecolor; ?>;
}

.commentcontent .commentinfo {
    color:<?php echo $smalldatefontcolor; ?>;
    font-size:10px;
    line-height:10px;
    text-transform:uppercase;
}

.commentcontent .commentinfo a:link, .commentcontent .commentinfo a:visited {
    color:<?php echo $smalldatefontcolor; ?>;
}

#comment {
    width:100%;
}
