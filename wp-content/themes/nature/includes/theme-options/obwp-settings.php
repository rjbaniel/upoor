<?php
/**
 * @package WordPress
 * @subpackage magazine_obsession
 */

/**
 * Show the General Settings for Admin oanel
 *
 * @since 2.7.0
 *
 */
function obwp_general_settings()
{
    global $themename, $options;

	$options = array (
				array(	"name" => "General Settings",
						"type" => "heading"),
						
				array(	"name" => "Google Adsense ID",
						"desc" => "Enter google adnsense id. Example: pub-################. Enter pub- too.<br /><br />",
			    		"id" => SHORTNAME."_google_id",
			    		"std" => "",
			    		"type" => "text"),
						
				
																														
		  );
	
	obwp_add_admin('obwp-settings.php');
}



?>
