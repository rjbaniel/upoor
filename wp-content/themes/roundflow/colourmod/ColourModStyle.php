<?php
require_once( dirname(__FILE__) . '../../../../../wp-config.php');
header("Content-type: text/css");

// GENERAL
if (get_option( 'rf_bgcolor' ) == "") { $bgcolor = "#222222"; } else { $bgcolor = "#".get_option( 'rf_bgcolor' ); }

// HEADER
if (get_option( 'rf_headerbgcolor' ) == "") { $headerbgcolor = "#DD8822"; } else { $headerbgcolor = "#".get_option( 'rf_headerbgcolor' ); }
if (get_option( 'rf_sitetitlecolor' ) == "") { $sitetitlecolor = "#FFFFFF"; } else { $sitetitlecolor = "#".get_option( 'rf_sitetitlecolor' ); }
if (get_option( 'rf_taglinecolor' ) == "") { $taglinecolor = "#FFFFFF"; } else { $taglinecolor = "#".get_option( 'rf_taglinecolor' ); }

// NAVIGATION
if (get_option( 'rf_navbgcolor' ) == "") { $navbgcolor = "#88CC22"; } else { $navbgcolor = "#".get_option( 'rf_navbgcolor' ); }
if (get_option( 'rf_navlinkcolor' ) == "") { $navlinkcolor = "#FFFFFF"; } else { $navlinkcolor = "#".get_option( 'rf_navlinkcolor' ); }
if (get_option( 'rf_navlinkhovercolor' ) == "") { $navlinkhovercolor = "#FFFFFF"; } else { $navlinkhovercolor = "#".get_option( 'rf_navlinkhovercolor' ); }

// CHILD PAGE NAVIGATION
if (get_option( 'rf_childnavbgcolor' ) == "") { $childnavbgcolor = "#2288CC"; } else { $childnavbgcolor = "#".get_option( 'rf_childnavbgcolor' ); }
if (get_option( 'rf_childnavlinkcolor' ) == "") { $childnavlinkcolor = "#FFFFFF"; } else { $childnavlinkcolor = "#".get_option( 'rf_childnavlinkcolor' ); }
if (get_option( 'rf_childnavlinkhovercolor' ) == "") { $childnavlinkhovercolor = "#FFFFFF"; } else { $childnavlinkhovercolor = "#".get_option( 'rf_childnavlinkhovercolor' ); }

// MAIN CONTENT
if (get_option( 'rf_mainbgcolor' ) == "") { $mainbgcolor = "#EEE"; } else { $mainbgcolor = "#".get_option( 'rf_mainbgcolor' ); }
if (get_option( 'rf_maintextcolor' ) == "") { $maintextcolor = "#333"; } else { $maintextcolor = "#".get_option( 'rf_maintextcolor' ); }
if (get_option( 'rf_maintextlinkcolor' ) == "") { $maintextlinkcolor = "#28C"; } else { $maintextlinkcolor = "#".get_option( 'rf_maintextlinkcolor' ); }
if (get_option( 'rf_maintextlinkhovercolor' ) == "") { $maintextlinkhovercolor = "#28C"; } else { $maintextlinkhovercolor = "#".get_option( 'rf_maintextlinkhovercolor' ); }
if (get_option( 'rf_mainposttitlecolor' ) == "") { $mainposttitlecolor = "#333"; } else { $mainposttitlecolor = "#".get_option( 'rf_mainposttitlecolor' ); }
if (get_option( 'rf_mainposttitlehovercolor' ) == "") { $mainposttitlehovercolor = "#28C"; } else { $mainposttitlehovercolor = "#".get_option( 'rf_mainposttitlehovercolor' ); }
if (get_option( 'rf_mainpostinfocolor' ) == "") { $mainpostinfocolor = "#AAA"; } else { $mainpostinfocolor = "#".get_option( 'rf_mainpostinfocolor' ); }
if (get_option( 'rf_mainpostinfolinkcolor' ) == "") { $mainpostinfolinkcolor = "#AAA"; } else { $mainpostinfolinkcolor = "#".get_option( 'rf_mainpostinfolinkcolor' ); }
if (get_option( 'rf_mainpostinfolinkhovercolor' ) == "") { $mainpostinfolinkhovercolor = "#28C"; } else { $mainpostinfolinkhovercolor = "#".get_option( 'rf_mainpostinfolinkhovercolor' ); }
if (get_option( 'rf_mainbordercolor' ) == "") { $mainbordercolor = "#999"; } else { $mainbordercolor = "#".get_option( 'rf_mainbordercolor' ); }
if (get_option( 'rf_mainheadercolor' ) == "") { $mainheadercolor = "#333"; } else { $mainheadercolor = "#".get_option( 'rf_mainheadercolor' ); }

// COMMENTS
if (get_option( 'rf_commentsbgcolor' ) == "") { $commentsbgcolor = "#EEE"; } else { $commentsbgcolor = "#".get_option( 'rf_commentsbgcolor' ); }
if (get_option( 'rf_commentstextcolor' ) == "") { $commentstextcolor = "#333"; } else { $commentstextcolor = "#".get_option( 'rf_commentstextcolor' ); }
if (get_option( 'rf_commentslinkcolor' ) == "") { $commentslinkcolor = "#28C"; } else { $commentslinkcolor = "#".get_option( 'rf_commentslinkcolor' ); }
if (get_option( 'rf_commentslinkhovercolor' ) == "") { $commentslinkhovercolor = "#28C"; } else { $commentslinkhovercolor = "#".get_option( 'rf_commentslinkhovercolor' ); }
if (get_option( 'rf_commentsinfotextcolor' ) == "") { $commentsinfotextcolor = "#AAA"; } else { $commentsinfotextcolor = "#".get_option( 'rf_commentsinfotextcolor' ); }
if (get_option( 'rf_commentsinfolinkcolor' ) == "") { $commentsinfolinkcolor = "#AAA"; } else { $commentsinfolinkcolor = "#".get_option( 'rf_commentsinfolinkcolor' ); }
if (get_option( 'rf_commentsinfolinkhovercolor' ) == "") { $commentsinfolinkhovercolor = "#28C"; } else { $commentsinfolinkhovercolor = "#".get_option( 'rf_commentsinfolinkhovercolor' ); }
if (get_option( 'rf_commentsbordercolor' ) == "") { $commentsbordercolor = "#999"; } else { $commentsbordercolor = "#".get_option( 'rf_commentsbordercolor' ); }

// BOTTOMBAR
if (get_option( 'rf_bottombgcolor' ) == "") { $bottombgcolor = "#2288CC"; } else { $bottombgcolor = "#".get_option( 'rf_bottombgcolor' ); }
if (get_option( 'rf_bottomtitlecolor' ) == "") { $bottomtitlecolor = "#FFFFFF"; } else { $bottomtitlecolor = "#".get_option( 'rf_bottomtitlecolor' ); }
if (get_option( 'rf_bottomtextcolor' ) == "") { $bottomtextcolor = "#FFFFFF"; } else { $bottomtextcolor = "#".get_option( 'rf_bottomtextcolor' ); }
if (get_option( 'rf_bottomlinkcolor' ) == "") { $bottomlinkcolor = "#FFFFFF"; } else { $bottomlinkcolor = "#".get_option( 'rf_bottomlinkcolor' ); }
if (get_option( 'rf_bottomlinkhovercolor' ) == "") { $bottomlinkhovercolor = "#FFFFFF"; } else { $bottomlinkhovercolor = "#".get_option( 'rf_bottomlinkhovercolor' ); }
if (get_option( 'rf_bottombordercolor' ) == "") { $bottombordercolor = "#FFFFFF"; } else { $bottombordercolor = "#".get_option( 'rf_bottombordercolor' ); }

// FOOTER
if (get_option( 'rf_footerbgcolor' ) == "") { $footerbgcolor = "#88CC22"; } else { $footerbgcolor = "#".get_option( 'rf_footerbgcolor' ); }
if (get_option( 'rf_footertextcolor' ) == "") { $footertextcolor = "#FFFFFF"; } else { $footertextcolor = "#".get_option( 'rf_footertextcolor' ); }
if (get_option( 'rf_footerlinkcolor' ) == "") { $footerlinkcolor = "#FFFFFF"; } else { $footerlinkcolor = "#".get_option( 'rf_footerlinkcolor' ); }
if (get_option( 'rf_footerlinkhovercolor' ) == "") { $footerlinkhovercolor = "#FFFFFF"; } else { $footerlinkhovercolor = "#".get_option( 'rf_footerlinkhovercolor' ); } ?>

#pickbgcolor { background-color:<?php echo $bgcolor; ?>; }

#pickheaderbgcolor { background-color:<?php echo $headerbgcolor; ?>; }
#picksitetitlecolor { background-color:<?php echo $sitetitlecolor; ?>; }
#picktaglinecolor { background-color:<?php echo $taglinecolor; ?>; }

#picknavbgcolor { background-color:<?php echo $navbgcolor; ?>; }
#picknavlinkcolor { background-color:<?php echo $navlinkcolor; ?>; }
#picknavlinkhovercolor { background-color:<?php echo $navlinkhovercolor; ?>; }

#pickchildnavbgcolor { background-color:<?php echo $childnavbgcolor; ?>; }
#pickchildnavlinkcolor { background-color:<?php echo $childnavlinkcolor; ?>; }
#pickchildnavlinkhovercolor { background-color:<?php echo $childnavlinkhovercolor; ?>; }

#pickmainbgcolor { background-color:<?php echo $mainbgcolor; ?>; }
#pickmaintextcolor { background-color:<?php echo $maintextcolor; ?>; }
#pickmaintextlinkcolor { background-color:<?php echo $maintextlinkcolor; ?>; }
#pickmaintextlinkhovercolor { background-color:<?php echo $maintextlinkhovercolor; ?>; }
#pickmainposttitlecolor { background-color:<?php echo $mainposttitlecolor; ?>; }
#pickmainposttitlehovercolor { background-color:<?php echo $mainposttitlehovercolor; ?>; }
#pickmainpostinfocolor { background-color:<?php echo $mainpostinfocolor; ?>; }
#pickmainpostinfolinkcolor { background-color:<?php echo $mainpostinfolinkcolor; ?>; }
#pickmainpostinfolinkhovercolor { background-color:<?php echo $mainpostinfolinkhovercolor; ?>; }
#pickmainbordercolor { background-color:<?php echo $mainbordercolor; ?>; }
#pickmainheadercolor { background-color:<?php echo $mainheadercolor; ?>; }

#pickcommentsbgcolor { background-color:<?php echo $commentsbgcolor; ?>; }
#pickcommentstextcolor { background-color:<?php echo $commentstextcolor; ?>; }
#pickcommentslinkcolor { background-color:<?php echo $commentslinkcolor; ?>; }
#pickcommentslinkhovercolor { background-color:<?php echo $commentslinkhovercolor; ?>; }
#pickcommentsinfotextcolor { background-color:<?php echo $commentsinfotextcolor; ?>; }
#pickcommentsinfolinkcolor { background-color:<?php echo $commentsinfolinkcolor; ?>; }
#pickcommentsinfolinkhovercolor { background-color:<?php echo $commentsinfolinkhovercolor; ?>; }
#pickcommentsbordercolor { background-color:<?php echo $commentsbordercolor; ?>; }

#pickbottombgcolor { background-color:<?php echo $bottombgcolor; ?>; }
#pickbottomtitlecolor { background-color:<?php echo $bottomtitlecolor; ?>; }
#pickbottomtextcolor { background-color:<?php echo $bottomtextcolor; ?>; }
#pickbottomlinkcolor { background-color:<?php echo $bottomlinkcolor; ?>; }
#pickbottomlinkhovercolor { background-color:<?php echo $bottomlinkhovercolor; ?>; }
#pickbottombordercolor { background-color:<?php echo $bottombordercolor; ?>; }

#pickfooterbgcolor { background-color:<?php echo $footerbgcolor; ?>; }
#pickfootertextcolor { background-color:<?php echo $footertextcolor; ?>; }
#pickfooterlinkcolor { background-color:<?php echo $footerlinkcolor; ?>; }
#pickfooterlinkhovercolor { background-color:<?php echo $footerlinkhovercolor; ?>; }

#cmDefault{
	position:absolute;
	left:0;
	top:0;
	height: 234px;
	width: 282px;
	z-index:900;
}
#ColourMod {
	position:relative;
	left:0;
	top:0;
	display:none;
	z-index:900;
}

.rfpickcolor a:link, .rfpickcolor a:visited {
text-decoration:none;
display:block;
width:100%;
height:100%;
border:0;
}

.rfpickcolor {
height:20px;
width:20px;
margin-right:5px;
float:left;
position:relative;
border:1px solid #666;
text-decoration:none;
}

.cmDefaultMiniOverlay {
	filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale src='<?php bloginfo('template_directory'); ?>/colourmod/images/ColourModMiniBG.png');
	height: 234px;
	width: 282px;
	position:absolute;
	left:0;
	top:0;
}
.cmDefaultMiniOverlay[class] {
 	background: url(<?php bloginfo('template_directory'); ?>/colourmod/images/ColourModMiniBG.png) no-repeat;

}

#cmSatValContainer {
	height: 150px;
	width: 150px;
	position: absolute;
	left: 14px;
	top: 43px;
}

#cmHueContainer {
	position: absolute;
	top: 44px;
	left: 185px;
	height: 168px;
	width: 40px;
}
.cmColorContainer {
	background: #FFFFFF;
	height: 160px;
	width: 20px;
	position: absolute;
	left: 230px;
	top: 49px;
}
.cmBlueDot {
	position: relative;
	z-index: 3;
	filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale src='<?php bloginfo('template_directory'); ?>/colourmod/images/BlueDot.png');
	height: 21px;
	width: 21px;
}
.cmBlueDot[class] {
	background: url(<?php bloginfo('template_directory'); ?>/colourmod/images/BlueDot.png) no-repeat;
}
.cmBlueArrow {
	position: relative;
	z-index: 3;
	filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true, sizingMethod=scale src='<?php bloginfo('template_directory'); ?>/colourmod/images/BlueArrow.png');
	height: 21px;
	width: 23px;
}
.cmBlueArrow[class] {
	background: url(<?php bloginfo('template_directory'); ?>/colourmod/images/BlueArrow.png) no-repeat;
}
.cmSatValBg {
	height: 150px;
	width: 150px;
	background: #FF0000;
	position: absolute;
	left: 29px;
	top: 50px;
}

a.cmLink {
width:90px;
	margin-left: 20px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	position:absolute;
	top:203px;
	z-index:400;
	color: #CCCCCC;
	text-decoration: none;
	border: none 0px;
}
a.cmLink:hover {
	color: #999999;
	text-decoration: none;
	border: none 0px;
}
#cmHex {
	position:relative;
	top:3px;
	color: #333333;
	font: 12px "Arial Narrow", Arial, Helvetica, sans-serif;
	border:1px solid #CCC;

}
#cmClose {
	position:absolute;
	left:135px;
	width:120px;
	text-align:right;
	height:30px;
}
#cmCloseButton {
position:relative;
top:13px;
text-decoration:none;
}
