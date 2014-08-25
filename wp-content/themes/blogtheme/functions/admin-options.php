<?php



// THIS IS THE DIFFERENT FIELDS

$options[] = array(	"name" => "General Settings",

					"type" => "heading");

						

$options[] = array(	"name" => "Theme Stylesheet",

					"desc" => "Please select your colour scheme here.",

					"id" => $shortname."_alt_stylesheet",

					"std" => "",

					"type" => "select",

					"options" => $alt_stylesheets);





$options[] = array(	"name" => "Body Font",

					"desc" => "Please select your font here.",

					"id" => $shortname."_custom_body_font",

					"std" => "",

					"type" => "select",

                    "options" => array(

            "Arial, sans-serif",

            "Lucida Grande, Lucida Sans, sans-serif",

            "Verdana, sans-serif",

            "Trebuchet MS, sans-serif",

            "Fertigo, serif",

            "Georgia, serif",

            "Times New Roman, Times, Georgia, serif",

            "Cambria, Georgia, serif",

            "Tahoma, sans-serif",

            "Helvetica, Arial, sans-serif",

            "Corpid, Corpid Bold, sans-serif",

            "Century Gothic, Century, sans-serif",

            "Palatino Linotype, Times New Roman, serif",

            "Garamond, Georgia, serif",

            "Caslon Book BE, Caslon, Arial Narrow",

            "Arial Rounded Bold, Arial",

            "Arial Narrow, Arial",

            "Myriad Pro, Calibri, sans-serif",

            "Candara, Calibri, Lucida Grande",

            "Univers LT 55, Univers LT Std 55, Univers, sans-serif",

            "Ronda, Ronda Light, Century Gothic",

            "Century, Times New Roman, serif",

            "Courier New, Courier, monospace",

            "Walbaum LT Roman, Walbaum, Times New Roman",

            "Dax, Dax-Regular, Dax-Bold, Trebuchet MS",

            "VAG Round, Arial Rounded Bold, sans-serif",

            "Humana Sans ITC, Humana Sans Md ITC, Lucida Grande",

            "Qlassik Medium, Qlassik Bold, Lucida Grande",

            "TradeGothic LT, Lucida Sans, Lucida Grande",

            "Cocon, Cocon-Light, sans-serif",

            "Frutiger, Frutiger LT Std 55 Roman, tahoma",

            "Futura LT Book, Century Gothic, sans-serif",

            "Steinem, Cocon, Cambria",

            "Delicious, Trebuchet MS, sans-serif",

            "Helvetica 65 Medium, Helvetica Neue, Helvetica Bold, sans-serif",

            "Helvetica Neue, Helvetica, Helvetica-Normal, sans-serif",

            "Helvetica Rounded, Arial Rounded Bold, VAGRounded BT, sans-serif",

            "Decker, sans-serif",

            "Mrs Eaves OT, Georgia, Cambria, serif",

            "Anivers, Lucida Sans, Lucida Grande",

            "Geneva, sans-serif",

            "Trajan, Trajan Pro, serif",

            "FagoCo, Calibri, Lucida Grande",

            "Meta, Meta Bold , Meta Medium, sans-serif",

            "Chocolate, Segoe UI, Seips",

            "Ronda, Ronda Light, Century Gothic",

            "DIN, DINPro-Regular, DINPro-Medium, sans-serif",

            "Gotham, Georgia, serif"

            )

            );





$options[] = array(	"name" => "Headline Font",

					"desc" => "Please select your headline font here.",

					"id" => $shortname."_custom_headline_font",

					"std" => "",

					"type" => "select",

                    "options" => array(

            "Arial, sans-serif",

            "Lucida Grande, Lucida Sans, sans-serif",

            "Verdana, sans-serif",

            "Trebuchet MS, sans-serif",

            "Fertigo, serif",

            "Georgia, serif",

            "Times New Roman, Times, Georgia, serif",

            "Cambria, Georgia, serif",

            "Tahoma, sans-serif",

            "Helvetica, Arial, sans-serif",

            "Corpid, Corpid Bold, sans-serif",

            "Century Gothic, Century, sans-serif",

            "Palatino Linotype, Times New Roman, serif",

            "Garamond, Georgia, serif",

            "Caslon Book BE, Caslon, Arial Narrow",

            "Arial Rounded Bold, Arial",

            "Arial Narrow, Arial",

            "Myriad Pro, Calibri, sans-serif",

            "Candara, Calibri, Lucida Grande",

            "Univers LT 55, Univers LT Std 55, Univers, sans-serif",

            "Ronda, Ronda Light, Century Gothic",

            "Century, Times New Roman, serif",

            "Courier New, Courier, monospace",

            "Walbaum LT Roman, Walbaum, Times New Roman",

            "Dax, Dax-Regular, Dax-Bold, Trebuchet MS",

            "VAG Round, Arial Rounded Bold, sans-serif",

            "Humana Sans ITC, Humana Sans Md ITC, Lucida Grande",

            "Qlassik Medium, Qlassik Bold, Lucida Grande",

            "TradeGothic LT, Lucida Sans, Lucida Grande",

            "Cocon, Cocon-Light, sans-serif",

            "Frutiger, Frutiger LT Std 55 Roman, tahoma",

            "Futura LT Book, Century Gothic, sans-serif",

            "Steinem, Cocon, Cambria",

            "Delicious, Trebuchet MS, sans-serif",

            "Helvetica 65 Medium, Helvetica Neue, Helvetica Bold, sans-serif",

            "Helvetica Neue, Helvetica, Helvetica-Normal, sans-serif",

            "Helvetica Rounded, Arial Rounded Bold, VAGRounded BT, sans-serif",

            "Decker, sans-serif",

            "Mrs Eaves OT, Georgia, Cambria, serif",

            "Anivers, Lucida Sans, Lucida Grande",

            "Geneva, sans-serif",

            "Trajan, Trajan Pro, serif",

            "FagoCo, Calibri, Lucida Grande",

            "Meta, Meta Bold , Meta Medium, sans-serif",

            "Chocolate, Segoe UI, Seips",

            "Ronda, Ronda Light, Century Gothic",

            "DIN, DINPro-Regular, DINPro-Medium, sans-serif",

            "Gotham, Georgia, serif"

            )

            );





$options[] = array(	"name" => "Custom Logo",

					"desc" => "Paste the full URL of your custom logo image, should you wish to replace our default logo. recommended size 300px x 40px",

					"id" => $shortname."_logo",

					"std" => "",

					"type" => "text");



/*$options[] = array(	"name" => "Google Analytics",

					"desc" => "Please paste your Google Analytics (or other) tracking code here.",

					"id" => $shortname."_google_analytics",

					"std" => "",

					"type" => "textarea");*/



$options[] = array(	"name" => "Feedburner RSS URL",

					"desc" => "Enter your Feedburner URL here.",

					"id" => $shortname."_feedburner_url",

					"std" => "",

					"type" => "text");	



$options[] = array(	"name" => "Twitter Username",

					"desc" => "Enter your Twitter Username here.",

					"id" => $shortname."_twitter",

					"std" => "",

					"type" => "text");						



$options[] = array(	"name" => "Layout Options",

					"type" => "heading");



/*$options[] = array(	"name" => "Exclude pages from menu",

					"desc" => "Enter a comma-separated list of the <a href'http://faq.wordpress.com/2008/05/29/how-to-find-page-id-numbers/'>page ID's</a> that you'd like to exclude from the main top navigation. (ie. 1,2,3,4)",

					"id" => $shortname."_menupages",

					"std" => "",

					"type" => "text");*/

					

$options[] = array(	"name" => "Display Full Post or Excerpt?",

					"desc" => "If checked, the homepage will display the full post content. If unchecked it will display the excerpt only.",

					"id" => $shortname."_the_content",

					"std" => "false",

					"type" => "checkbox");




 



?>
