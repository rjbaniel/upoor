<?php

// GENERAL

	// SITE WIDTH
	if (get_option( 'rf_sitewidth' ) === FALSE) { $sitewidth = "70"; } else { $sitewidth = get_option( 'rf_sitewidth' ); }

	// WIDTH TYPE
	if (get_option( 'rf_sitewidthtype' ) == "") { $sitewidthtype = "%"; } else { $sitewidthtype = get_option( 'rf_sitewidthtype' ); }

	// SITE FONT
	if (get_option( 'rf_font' ) == "") { $font = '"Lucida Grande", Verdana, Arial, Sans-Serif'; } else { $font = stripslashes(get_option( 'rf_font' )); }

	// BACKGROUND COLOR
	if (get_option( 'rf_bgcolor' ) == "") { $bgcolor = "#222"; } else { $bgcolor = "#".get_option( 'rf_bgcolor' ); }

	// TOP AND BOTTOM PADDING
	if (get_option( 'rf_topbottompadding' ) == "") { $topbottompadding = "40"; } else { $topbottompadding = get_option( 'rf_topbottompadding' ); }

// HEADER

	// HEADER COLOR
	if (get_option( 'rf_headerbgcolor' ) == "") { $headerbgcolor = "#D82"; } else { $headerbgcolor = "#".get_option( 'rf_headerbgcolor' ); }

	// SITE TITLE COLOR
	if (get_option( 'rf_sitetitlecolor' ) == "") { $sitetitlecolor = "#FFF"; } else { $sitetitlecolor = "#".get_option( 'rf_sitetitlecolor' ); }

	// TAG LINE COLOR
	if (get_option( 'rf_taglinecolor' ) == "") { $taglinecolor = "#FFF"; } else { $taglinecolor = "#".get_option( 'rf_taglinecolor' ); }


// NAVIGATION
	
	// NAVIGATION COLOR
	if (get_option( 'rf_navbgcolor' ) == "") { $navbgcolor = "#8C2"; } else { $navbgcolor = "#".get_option( 'rf_navbgcolor' ); }

	// LINK COLOR
	if (get_option( 'rf_navlinkcolor' ) == "") { $navlinkcolor = "#FFF"; } else { $navlinkcolor = "#".get_option( 'rf_navlinkcolor' ); }

	// LINK HOVER COLOR
	if (get_option( 'rf_navlinkhovercolor' ) == "") { $navlinkhovercolor = "#FFF"; } else { $navlinkhovercolor = "#".get_option( 'rf_navlinkhovercolor' ); }


// CHILD PAGE NAVIGATION
	
	// CHILD PAGE NAVIGATION COLOR
	if (get_option( 'rf_childnavbgcolor' ) == "") { $childnavbgcolor = "#28C"; } else { $childnavbgcolor = "#".get_option( 'rf_childnavbgcolor' ); }

	// LINK COLOR
	if (get_option( 'rf_childnavlinkcolor' ) == "") { $childnavlinkcolor = "#FFF"; } else { $childnavlinkcolor = "#".get_option( 'rf_childnavlinkcolor' ); }

	// LINK HOVER COLOR
	if (get_option( 'rf_childnavlinkhovercolor' ) == "") { $childnavlinkhovercolor = "#FFF"; } else { $childnavlinkhovercolor = "#".get_option( 'rf_childnavlinkhovercolor' ); }


// MAIN CONTENT
	
	// MAIN CONTENT COLOR
	if (get_option( 'rf_mainbgcolor' ) == "") { $mainbgcolor = "#EEE"; } else { $mainbgcolor = "#".get_option( 'rf_mainbgcolor' ); }

	// TEXT COLOR
	if (get_option( 'rf_maintextcolor' ) == "") { $maintextcolor = "#333"; } else { $maintextcolor = "#".get_option( 'rf_maintextcolor' ); }

	// TEXT LINK COLOR
	if (get_option( 'rf_maintextlinkcolor' ) == "") { $maintextlinkcolor = "#28C"; } else { $maintextlinkcolor = "#".get_option( 'rf_maintextlinkcolor' ); }

	// TEXT LINK HOVER COLOR
	if (get_option( 'rf_maintextlinkhovercolor' ) == "") { $maintextlinkhovercolor = "#28C"; } else { $maintextlinkhovercolor = "#".get_option( 'rf_maintextlinkhovercolor' ); }

	// POST TITLE COLOR
	if (get_option( 'rf_mainposttitlecolor' ) == "") { $mainposttitlecolor = "#333"; } else { $mainposttitlecolor = "#".get_option( 'rf_mainposttitlecolor' ); }

	// POST TITLE HOVER COLOR
	if (get_option( 'rf_mainposttitlehovercolor' ) == "") { $mainposttitlehovercolor = "#28C"; } else { $mainposttitlehovercolor = "#".get_option( 'rf_mainposttitlehovercolor' ); }

	// POST INFO COLOR
	if (get_option( 'rf_mainpostinfocolor' ) == "") { $mainpostinfocolor = "#AAA"; } else { $mainpostinfocolor = "#".get_option( 'rf_mainpostinfocolor' ); }

	// POST INFO LINK COLOR
	if (get_option( 'rf_mainpostinfolinkcolor' ) == "") { $mainpostinfolinkcolor = "#AAA"; } else { $mainpostinfolinkcolor = "#".get_option( 'rf_mainpostinfolinkcolor' ); }

	// POST INFO LINK HOVER COLOR
	if (get_option( 'rf_mainpostinfolinkhovercolor' ) == "") { $mainpostinfolinkhovercolor = "#28C"; } else { $mainpostinfolinkhovercolor = "#".get_option( 'rf_mainpostinfolinkhovercolor' ); }

	// BORDER COLOR
	if (get_option( 'rf_mainbordercolor' ) == "") { $mainbordercolor = "#999"; } else { $mainbordercolor = "#".get_option( 'rf_mainbordercolor' ); }

	// H1, H2, H3 COLOR
	if (get_option( 'rf_mainheadercolor' ) == "") { $mainheadercolor = "#333"; } else { $mainheadercolor = "#".get_option( 'rf_mainheadercolor' ); }


// COMMENTS

	// COMMENTS COLOR
	if (get_option( 'rf_commentsbgcolor' ) == "") { $commentsbgcolor = "#EEE"; } else { $commentsbgcolor = "#".get_option( 'rf_commentsbgcolor' ); }

	// TEXT COLOR
	if (get_option( 'rf_commentstextcolor' ) == "") { $commentstextcolor = "#333"; } else { $commentstextcolor = "#".get_option( 'rf_commentstextcolor' ); }

	// LINK COLOR
	if (get_option( 'rf_commentslinkcolor' ) == "") { $commentslinkcolor = "#28C"; } else { $commentslinkcolor = "#".get_option( 'rf_commentslinkcolor' ); }

	// LINK HOVER COLOR
	if (get_option( 'rf_commentslinkhovercolor' ) == "") { $commentslinkhovercolor = "#28C"; } else { $commentslinkhovercolor = "#".get_option( 'rf_commentslinkhovercolor' ); }

	// INFO TEXT COLOR
	if (get_option( 'rf_commentsinfotextcolor' ) == "") { $commentsinfotextcolor = "#AAA"; } else { $commentsinfotextcolor = "#".get_option( 'rf_commentsinfotextcolor' ); }

	// INFO LINK COLOR
	if (get_option( 'rf_commentsinfolinkcolor' ) == "") { $commentsinfolinkcolor = "#AAA"; } else { $commentsinfolinkcolor = "#".get_option( 'rf_commentsinfolinkcolor' ); }

	// INFO LINK HOVER COLOR
	if (get_option( 'rf_commentsinfolinkhovercolor' ) == "") { $commentsinfolinkhovercolor = "#28C"; } else { $commentsinfolinkhovercolor = "#".get_option( 'rf_commentsinfolinkhovercolor' ); }

	// BORDER COLOR
	if (get_option( 'rf_commentsbordercolor' ) == "") { $commentsbordercolor = "#999"; } else { $commentsbordercolor = "#".get_option( 'rf_commentsbordercolor' ); }


// BOTTOMBAR

	// BOTTOMBAR COLOR
	if (get_option( 'rf_bottombgcolor' ) == "") { $bottombgcolor = "#28C"; } else { $bottombgcolor = "#".get_option( 'rf_bottombgcolor' ); }

	// TITLE COLOR
	if (get_option( 'rf_bottomtitlecolor' ) == "") { $bottomtitlecolor = "#FFF"; } else { $bottomtitlecolor = "#".get_option( 'rf_bottomtitlecolor' ); }

	// TEXT COLOR
	if (get_option( 'rf_bottomtextcolor' ) == "") { $bottomtextcolor = "#FFF"; } else { $bottomtextcolor = "#".get_option( 'rf_bottomtextcolor' ); }

	// LINK COLOR
	if (get_option( 'rf_bottomlinkcolor' ) == "") { $bottomlinkcolor = "#FFF"; } else { $bottomlinkcolor = "#".get_option( 'rf_bottomlinkcolor' ); }

	// LINK HOVER COLOR
	if (get_option( 'rf_bottomlinkhovercolor' ) == "") { $bottomlinkhovercolor = "#FFF"; } else { $bottomlinkhovercolor = "#".get_option( 'rf_bottomlinkhovercolor' ); }

	// BORDER COLOR
	if (get_option( 'rf_bottombordercolor' ) == "") { $bottombordercolor = "#FFF"; } else { $bottombordercolor = "#".get_option( 'rf_bottombordercolor' ); }


// FOOTER

	// FOOTER COLOR
	if (get_option( 'rf_footerbgcolor' ) == "") { $footerbgcolor = "#8C2"; } else { $footerbgcolor = "#".get_option( 'rf_footerbgcolor' ); }

	// TEXT COLOR
	if (get_option( 'rf_footertextcolor' ) == "") { $footertextcolor = "#FFF"; } else { $footertextcolor = "#".get_option( 'rf_footertextcolor' ); }

	// LINK COLOR
	if (get_option( 'rf_footerlinkcolor' ) == "") { $footerlinkcolor = "#FFF"; } else { $footerlinkcolor = "#".get_option( 'rf_footerlinkcolor' ); }

	// LINK HOVER COLOR
	if (get_option( 'rf_footerlinkhovercolor' ) == "") { $footerlinkhovercolor = "#FFF"; } else { $footerlinkhovercolor = "#".get_option( 'rf_footerlinkhovercolor' ); } ?>


                                                                     
                                                                     
                                                                     
                                             
/* Captions and image alignment for wordpress */


div.aligncenter {
	display: block!important;
	margin: 0px auto;
}
div.alignleft {
	float: left!important;
	margin-right: 10px;
}
div.alignright {
	float: right!important;
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
	padding: 5px 4px;
	margin: 0;
	font-family: Arial, Tahoma, "Lucida Sans";
	color: #949494;
	font-style: normal;
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
	float: left
	}


/* End captions and image alignment */

body{ 
margin:0 auto 0 auto;
font-family:<?php echo $font; ?>;
font-size:12px;
line-height:17px;
color:#333;
background-color:<?php echo $bgcolor; ?>;
}

a:link, a:visited {
text-decoration:none;
}

form {
display:inline;
margin:0;
padding:0;
}

blockquote {
font-style:italic;
}

a img {
border:0;
}

#wrapper {
margin:0 auto 0 auto;
padding:<?php echo $topbottompadding; ?>px 0 <?php echo $topbottompadding; ?>px 0;
width:<?php echo $sitewidth.$sitewidthtype; ?>;
}

#header {
position:relative;
background-color:<?php echo $headerbgcolor; ?>;

}

    #header h1 {
    padding:45px 0 0 5%;
    margin:0;

    text-align:left;
    color:<?php echo $sitetitlecolor; ?>;
    font-weight:bold;
    line-height:25px;
    font-size:25px;
    }
    
    #header h2 {
    padding:0 0 30px 8%;
    margin:0;
    text-align:left;
    color:<?php echo $taglinecolor; ?>;
    font-weight:lighter;
    line-height:14px;
    font-size:14px;
    }

#navigation {
margin:5px 0 0 0;
background-color:<?php echo $navbgcolor; ?>;
}

    #navigation ul {
    margin:0;
    padding:0;
    display:block;
    position:relative;
    margin:0 0 0 5%;
    list-style:none;
    }
    
        #navigation ul li {
        display:inline;
        }
        
            #navigation ul li a:link, #navigation ul li a:visited {
            font-size:10px;
            line-height:30px;
            text-transform:uppercase;
            display:inline;
            font-weight:bold;
            padding:5px 0 5px 0;
            margin:0 10px 0 0;
            color:<?php echo $navlinkcolor; ?>;
            }
            
            #navigation ul li a:hover {
            text-decoration:underline;
            color:<?php echo $navlinkhovercolor; ?>;
            }

#childnavigation {
margin:5px 0 0 0;
background-color:<?php echo $childnavbgcolor; ?>;
}

    #childnavigation ul {
    margin:0;
    padding:0;
    display:block;
    position:relative;
    margin:0 0 0 5%;
    list-style:none;
    }
    
        #childnavigation ul li {
        display:inline;
        }
        
            #childnavigation ul li a:link, #childnavigation ul li a:visited {
            font-size:10px;
            line-height:30px;
            text-transform:uppercase;
            display:inline;
            font-weight:bold;
            padding:5px 0 5px 0;
            margin:0 10px 0 0;
            color:<?php echo $childnavlinkcolor; ?>;
            }
            
            #childnavigation ul li a:hover {
            text-decoration:underline;
	   color:<?php echo $childnavlinkhovercolor; ?>;
            }

#maincontent {
background-color:<?php echo $mainbgcolor; ?>;
margin:5px 0 0 0;
padding:30px 0 0 0;
}

    .post {
    width: 90%;
    margin: 0 auto 0 auto;
    clear: both;

    }
    
        .posttitle {
        margin:0;
        font-size:20px;
        line-height:20px;
        font-weight:bold;
        letter-spacing:2px;
        }
        
            .posttitle a:link, .posttitle a:visited {
            color:<?php echo $mainposttitlecolor; ?>;
            }
            
            .posttitle a:hover {
            color:<?php echo $mainposttitlehovercolor; ?>;
            }
        
        .postinfo {
        margin:0;
        color:<?php echo $mainpostinfocolor; ?>;
        display:block;
        border-top:1px solid <?php echo $mainbordercolor; ?>;
        line-height:15px;
        text-transform:uppercase;
        font-size:9px;
        }
        
            .postinfo a:link, .postinfo a:visited {
            color:<?php echo $mainpostinfolinkcolor; ?>;
            }
            
            .postinfo a:hover {
            color:<?php echo $mainpostinfolinkhovercolor; ?>;
            }
        
        .postcontent {
        padding: 15px 0 30px 0;
        color:<?php echo $maintextcolor; ?>;
        }
        
        .postcontent p {
        margin: 0 0 18px 0;
        }
        
        .postcontent a:link, .postcontent a:visited {
        color:<?php echo $maintextlinkcolor; ?>;
        }
        
        .postcontent a:hover {
        text-decoration:underline;
        color:<?php echo $maintextlinkhovercolor; ?>;
        }


        .postcontent h1 {
        margin:15px 0 0 0;
        font-size:16px;
        line-height:20px;
        font-weight:bold;
        letter-spacing:2px;
        color:<?php echo $mainheadercolor; ?>;
        border-bottom:1px solid <?php echo $mainbordercolor; ?>;
        }
        
        .postcontent h2 {
        margin:15px 0 0 0;
        font-size:14px;
        line-height:20px;
        font-weight:bold;
        letter-spacing:2px;
        color:<?php echo $mainheadercolor; ?>;
        border-bottom:1px solid <?php echo $mainbordercolor; ?>;
        }
        
        .postcontent h3 {
        margin:15px 0 0 0;
        font-size:12px;
        line-height:20px;
        font-weight:bold;
        letter-spacing:2px;
        color:<?php echo $mainheadercolor; ?>;
        border-bottom:1px solid <?php echo $mainbordercolor; ?>;
        }
        
        .postcontent .pagenav {
        text-align:center;
        }

#comments {
margin:5px 0 0 0;
padding:20px 0 0 0;
background-color:<?php echo $commentsbgcolor; ?>;
}
    
        #comments a:link, #comments a:visited {
        color:<?php echo $commentslinkcolor; ?>;
        }
        
        #comments a:hover {
	text-decoration:underline;
	color:<?php echo $commentslinkhovercolor; ?>;
        }
    
    #comment, #author, #url, #email {
    width:100%;
    }

    #comments h3 {
    margin:0;
    font-size:15px;
    line-height:20px;
    font-weight:bold;
    letter-spacing:2px;
    border-bottom:1px solid <?php echo $commentsbordercolor; ?>;
    }

    .comment {
    width:90%;
    margin:0 auto 0 auto;
    color:<?php echo $commentstextcolor; ?>;
    font-size:11px;
    }
    
        #comments .commentinfo {
        margin:20px 0 0 0;
        color:<?php echo $commentsinfotextcolor; ?>;
        display:block;
        border-bottom:1px solid <?php echo $commentsbordercolor; ?>;
        line-height:15px;
        text-transform:uppercase;
        font-size:9px;
        }
        
            #comments .commentinfo a:link, #comments .commentinfo a:visited {
            color:<?php echo $commentsinfolinkcolor; ?>;
            }
            
	#comments .commentinfo a:hover {
	color:<?php echo $commentsinfolinkhovercolor; ?>;
	text-decoration:none;
	}

#bottombar {
margin:5px 0 0 0;
background-color:<?php echo $bottombgcolor; ?>;
}

    #bottombar .column1 {
    position:inline;
    float:left;
    width:42%;
    padding:20px 0 0 5%;
    }
    
    #bottombar .column2 {
    position:inline;
    float:right;
    width:42%;
    padding:20px 5% 0 0;
    }

    #bottombar .spacer {
    line-height:5px;
    clear:both;
    }
    
    #bottombar ul {
    margin:0;
    padding:0;
    list-style:none;
    }
    
        #bottombar ul li {
        margin:0;
        padding:0;
        }
        
            #bottombar ul li h2 {
            margin:0;
            text-align:center;
            display:block;
            color:<?php echo $bottomtitlecolor; ?>;
            font-weight:bold;
            line-height:20px;
            font-size:11px;
            text-transform:uppercase;
            border-bottom:2px solid <?php echo $bottombordercolor; ?>;
            }
            
            #bottombar ul li {
            margin:0 0 20px 0;
            }
            
                #bottombar ul li ul li, #bottombar ul li div {
                color:<?php echo $bottomtextcolor; ?>;
                text-transform:uppercase;
                font-size:10px;
                line-height:20px;
                display:block;
                border-bottom:1px dotted <?php echo $bottombordercolor; ?>;
                text-align:center;
	       margin:0;
                }
                
        #bottombar a:link, #bottombar a:visited {
        color:<?php echo $bottomlinkcolor; ?>;
        }

        #bottombar a:hover {
	text-decoration:underline;
	color:<?php echo $bottomlinkhovercolor; ?>;
        }

#wp-calendar {
	width:80%;
	text-align:center;
	border-collapse: collapse;
	color:<?php echo $bottomtextcolor; ?>;
	margin:0 auto 0 auto;
}

#wp-calendar caption, #wp-calendar th {
	color:<?php echo $bottomtitlecolor; ?>;
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
	color:<?php echo $bottomtitlecolor; ?>;
}

#wp-calendar a:link, #wp-calendar a:visited {
	color:<?php echo $bottomlinkcolor; ?>;
	font-weight:bold;
}

#wp-calendar a:hover {
	color:<?php echo $bottomlinkhovercolor; ?>;
	text-decoration:underline;
}


#footer {
margin:5px 0 0 0;
background-color:<?php echo $footerbgcolor; ?>;
}

    #footer p {
    text-align:center;
    font-size:10px;
    margin:0;
    line-height:30px;
    text-transform:uppercase;
    color:<?php echo $footertextcolor; ?>;
    }
    
    #footer a:link, #footer a:visited {
    color:<?php echo $footerlinkcolor; ?>;
    }
    
    #footer a:hover {
    text-decoration:underline;
    color:<?php echo $footerlinkhovercolor; ?>;
    }
