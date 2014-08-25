<?php
add_action( 'admin_enqueue_scripts', 'import_epanel_javascript' );
function import_epanel_javascript( $hook_suffix ) {
	if ( 'admin.php' == $hook_suffix && isset( $_GET['import'] ) && isset( $_GET['step'] ) && 'wordpress' == $_GET['import'] && '1' == $_GET['step'] )
		add_action( 'admin_head', 'admin_headhook' );
}

function admin_headhook(){ ?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$("p.submit").before("<p><input type='checkbox' id='importepanel' name='importepanel' value='1' style='margin-right: 5px;'><label for='importepanel'>Replace ePanel settings with sample data values</label></p>");
		});
	</script>
<?php }

add_action('import_end','importend');
function importend(){
	global $wpdb, $shortname;

	#make custom fields image paths point to sampledata/sample_images folder
	$sample_images_postmeta = $wpdb->get_results(
		$wpdb->prepare( "SELECT meta_id, meta_value FROM $wpdb->postmeta WHERE meta_value REGEXP %s", 'http://et_sample_images.com' )
	);
	if ( $sample_images_postmeta ) {
		foreach ( $sample_images_postmeta as $postmeta ){
			$template_dir = get_template_directory_uri();
			if ( is_multisite() ){
				switch_to_blog(1);
				$main_siteurl = site_url();
				restore_current_blog();

				$template_dir = $main_siteurl . '/wp-content/themes/' . get_template();
			}
			preg_match( '/http:\/\/et_sample_images.com\/([^.]+).jpg/', $postmeta->meta_value, $matches );
			$image_path = $matches[1];

			$local_image = preg_replace( '/http:\/\/et_sample_images.com\/([^.]+).jpg/', $template_dir . '/sampledata/sample_images/$1.jpg', $postmeta->meta_value );

			$local_image = preg_replace( '/s:55:/', 's:' . strlen( $template_dir . '/sampledata/sample_images/' . $image_path . '.jpg' ) . ':', $local_image );

			$wpdb->update( $wpdb->postmeta, array( 'meta_value' => esc_url_raw( $local_image ) ), array( 'meta_id' => $postmeta->meta_id ), array( '%s' ) );
		}
	}

	if ( !isset($_POST['importepanel']) )
		return;

	$importOptions = 'YToxMDI6e3M6MDoiIjtOO3M6MTQ6ImdydW5nZW1hZ19sb2dvIjtzOjA6IiI7czoxNzoiZ3J1bmdlbWFnX2Zhdmljb24iO3M6MDoiIjtzOjIyOiJncnVuZ2VtYWdfY29sb3Jfc2NoZW1lIjtzOjM6IlJlZCI7czoyMDoiZ3J1bmdlbWFnX2Jsb2dfc3R5bGUiO047czoyMDoiZ3J1bmdlbWFnX2dyYWJfaW1hZ2UiO047czoyMToiZ3J1bmdlbWFnX3Nob3dfdGFiYmVkIjtzOjI6Im9uIjtzOjIxOiJncnVuZ2VtYWdfdGFiX2VudHJpZXMiO3M6MToiOCI7czoyMjoiZ3J1bmdlbWFnX3RhYl9jb21tZW50cyI7czoxOiI4IjtzOjE5OiJncnVuZ2VtYWdfYWJvdXR0ZXh0IjtzOjA6IiI7czoyMjoiZ3J1bmdlbWFnX2NhdG51bV9wb3N0cyI7czoxOiI2IjtzOjI2OiJncnVuZ2VtYWdfYXJjaGl2ZW51bV9wb3N0cyI7czoxOiI1IjtzOjI1OiJncnVuZ2VtYWdfc2VhcmNobnVtX3Bvc3RzIjtzOjE6IjUiO3M6MjI6ImdydW5nZW1hZ190YWdudW1fcG9zdHMiO3M6MToiNSI7czoyMToiZ3J1bmdlbWFnX2RhdGVfZm9ybWF0IjtzOjY6Ik0gaiwgWSI7czoyMToiZ3J1bmdlbWFnX3VzZV9leGNlcnB0IjtOO3M6MjI6ImdydW5nZW1hZ19zY3JvbGxlcl9udW0iO3M6MjoiMTEiO3M6MjM6ImdydW5nZW1hZ19zaG93X3Njcm9sbGVyIjtzOjI6Im9uIjtzOjIyOiJncnVuZ2VtYWdfc2hvd19wb3B1bGFyIjtzOjI6Im9uIjtzOjIxOiJncnVuZ2VtYWdfc2hvd19yYW5kb20iO3M6Mjoib24iO3M6MjE6ImdydW5nZW1hZ19wb3B1bGFyX251bSI7czoxOiI2IjtzOjIwOiJncnVuZ2VtYWdfcmFuZG9tX251bSI7czoxOiI2IjtzOjIyOiJncnVuZ2VtYWdfaG9tZV9jYXRfb25lIjtzOjQ6IkJsb2ciO3M6MjI6ImdydW5nZW1hZ19ob21lX2NhdF90d28iO3M6NDoiQmxvZyI7czoyNDoiZ3J1bmdlbWFnX2hvbWVfY2F0X3RocmVlIjtzOjQ6IkJsb2ciO3M6MjM6ImdydW5nZW1hZ19ob21lX2NhdF9mb3VyIjtzOjQ6IkJsb2ciO3M6MjQ6ImdydW5nZW1hZ19ob21lcGFnZV9wb3N0cyI7czoxOiI3IjtzOjI0OiJncnVuZ2VtYWdfZXhsY2F0c19yZWNlbnQiO047czoxODoiZ3J1bmdlbWFnX2ZlYXR1cmVkIjtzOjI6Im9uIjtzOjE5OiJncnVuZ2VtYWdfZHVwbGljYXRlIjtzOjI6Im9uIjtzOjE4OiJncnVuZ2VtYWdfZmVhdF9jYXQiO3M6ODoiRmVhdHVyZWQiO3M6MjI6ImdydW5nZW1hZ19mZWF0dXJlZF9udW0iO3M6MToiMyI7czoxOToiZ3J1bmdlbWFnX21lbnVwYWdlcyI7TjtzOjI2OiJncnVuZ2VtYWdfZW5hYmxlX2Ryb3Bkb3ducyI7czoyOiJvbiI7czoxOToiZ3J1bmdlbWFnX2hvbWVfbGluayI7czoyOiJvbiI7czoyMDoiZ3J1bmdlbWFnX3NvcnRfcGFnZXMiO3M6MTA6InBvc3RfdGl0bGUiO3M6MjA6ImdydW5nZW1hZ19vcmRlcl9wYWdlIjtzOjM6ImFzYyI7czoxODoiZ3J1bmdlbWFnX21lbnVjYXRzIjtOO3M6Mzc6ImdydW5nZW1hZ19lbmFibGVfZHJvcGRvd25zX2NhdGVnb3JpZXMiO3M6Mjoib24iO3M6MjY6ImdydW5nZW1hZ19jYXRlZ29yaWVzX2VtcHR5IjtzOjI6Im9uIjtzOjMyOiJncnVuZ2VtYWdfdGllcnNfc2hvd25fY2F0ZWdvcmllcyI7czoxOiIzIjtzOjE4OiJncnVuZ2VtYWdfc29ydF9jYXQiO3M6NDoibmFtZSI7czoxOToiZ3J1bmdlbWFnX29yZGVyX2NhdCI7czozOiJhc2MiO3M6MjE6ImdydW5nZW1hZ19zd2FwX25hdmJhciI7TjtzOjI1OiJncnVuZ2VtYWdfZGlzYWJsZV90b3B0aWVyIjtOO3M6MTk6ImdydW5nZW1hZ19wb3N0aW5mbzIiO2E6NDp7aTowO3M6NjoiYXV0aG9yIjtpOjE7czo0OiJkYXRlIjtpOjI7czoxMDoiY2F0ZWdvcmllcyI7aTozO3M6ODoiY29tbWVudHMiO31zOjIwOiJncnVuZ2VtYWdfdGh1bWJuYWlscyI7czoyOiJvbiI7czoyNzoiZ3J1bmdlbWFnX3Nob3dfcG9zdGNvbW1lbnRzIjtzOjI6Im9uIjtzOjI1OiJncnVuZ2VtYWdfcGFnZV90aHVtYm5haWxzIjtOO3M6Mjg6ImdydW5nZW1hZ19zaG93X3BhZ2VzY29tbWVudHMiO047czozMToiZ3J1bmdlbWFnX3RodW1ibmFpbF93aWR0aF9wYWdlcyI7czozOiIxODUiO3M6MzI6ImdydW5nZW1hZ190aHVtYm5haWxfaGVpZ2h0X3BhZ2VzIjtzOjM6IjE4NSI7czoxOToiZ3J1bmdlbWFnX3Bvc3RpbmZvMSI7YTo0OntpOjA7czo2OiJhdXRob3IiO2k6MTtzOjQ6ImRhdGUiO2k6MjtzOjEwOiJjYXRlZ29yaWVzIjtpOjM7czo4OiJjb21tZW50cyI7fXM6MjM6ImdydW5nZW1hZ19jdXN0b21fY29sb3JzIjtOO3M6MTk6ImdydW5nZW1hZ19jaGlsZF9jc3MiO047czoyMjoiZ3J1bmdlbWFnX2NoaWxkX2Nzc3VybCI7czowOiIiO3M6MjQ6ImdydW5nZW1hZ19jb2xvcl9tYWluZm9udCI7czowOiIiO3M6MjQ6ImdydW5nZW1hZ19jb2xvcl9tYWlubGluayI7czowOiIiO3M6MjQ6ImdydW5nZW1hZ19jb2xvcl9wYWdlbGluayI7czowOiIiO3M6MzE6ImdydW5nZW1hZ19jb2xvcl9wYWdlbGlua19hY3RpdmUiO3M6MDoiIjtzOjI0OiJncnVuZ2VtYWdfY29sb3JfaGVhZGluZ3MiO3M6MDoiIjtzOjI5OiJncnVuZ2VtYWdfY29sb3Jfc2lkZWJhcl9saW5rcyI7czowOiIiO3M6MjU6ImdydW5nZW1hZ19mb290ZXJfaGVhZGluZ3MiO3M6MDoiIjtzOjI3OiJncnVuZ2VtYWdfY29sb3JfZm9vdGVybGlua3MiO3M6MDoiIjtzOjI0OiJncnVuZ2VtYWdfc2VvX2hvbWVfdGl0bGUiO047czozMDoiZ3J1bmdlbWFnX3Nlb19ob21lX2Rlc2NyaXB0aW9uIjtOO3M6Mjc6ImdydW5nZW1hZ19zZW9faG9tZV9rZXl3b3JkcyI7TjtzOjI4OiJncnVuZ2VtYWdfc2VvX2hvbWVfY2Fub25pY2FsIjtOO3M6Mjg6ImdydW5nZW1hZ19zZW9faG9tZV90aXRsZXRleHQiO3M6MDoiIjtzOjM0OiJncnVuZ2VtYWdfc2VvX2hvbWVfZGVzY3JpcHRpb250ZXh0IjtzOjA6IiI7czozMToiZ3J1bmdlbWFnX3Nlb19ob21lX2tleXdvcmRzdGV4dCI7czowOiIiO3M6MjM6ImdydW5nZW1hZ19zZW9faG9tZV90eXBlIjtzOjI3OiJCbG9nTmFtZSB8IEJsb2cgZGVzY3JpcHRpb24iO3M6Mjc6ImdydW5nZW1hZ19zZW9faG9tZV9zZXBhcmF0ZSI7czozOiIgfCAiO3M6MjY6ImdydW5nZW1hZ19zZW9fc2luZ2xlX3RpdGxlIjtOO3M6MzI6ImdydW5nZW1hZ19zZW9fc2luZ2xlX2Rlc2NyaXB0aW9uIjtOO3M6Mjk6ImdydW5nZW1hZ19zZW9fc2luZ2xlX2tleXdvcmRzIjtOO3M6MzA6ImdydW5nZW1hZ19zZW9fc2luZ2xlX2Nhbm9uaWNhbCI7TjtzOjMyOiJncnVuZ2VtYWdfc2VvX3NpbmdsZV9maWVsZF90aXRsZSI7czo5OiJzZW9fdGl0bGUiO3M6Mzg6ImdydW5nZW1hZ19zZW9fc2luZ2xlX2ZpZWxkX2Rlc2NyaXB0aW9uIjtzOjE1OiJzZW9fZGVzY3JpcHRpb24iO3M6MzU6ImdydW5nZW1hZ19zZW9fc2luZ2xlX2ZpZWxkX2tleXdvcmRzIjtzOjEyOiJzZW9fa2V5d29yZHMiO3M6MjU6ImdydW5nZW1hZ19zZW9fc2luZ2xlX3R5cGUiO3M6MjE6IlBvc3QgdGl0bGUgfCBCbG9nTmFtZSI7czoyOToiZ3J1bmdlbWFnX3Nlb19zaW5nbGVfc2VwYXJhdGUiO3M6MzoiIHwgIjtzOjI5OiJncnVuZ2VtYWdfc2VvX2luZGV4X2Nhbm9uaWNhbCI7TjtzOjMxOiJncnVuZ2VtYWdfc2VvX2luZGV4X2Rlc2NyaXB0aW9uIjtOO3M6MjQ6ImdydW5nZW1hZ19zZW9faW5kZXhfdHlwZSI7czoyNDoiQ2F0ZWdvcnkgbmFtZSB8IEJsb2dOYW1lIjtzOjI4OiJncnVuZ2VtYWdfc2VvX2luZGV4X3NlcGFyYXRlIjtzOjM6IiB8ICI7czozMzoiZ3J1bmdlbWFnX2ludGVncmF0ZV9oZWFkZXJfZW5hYmxlIjtzOjI6Im9uIjtzOjMxOiJncnVuZ2VtYWdfaW50ZWdyYXRlX2JvZHlfZW5hYmxlIjtzOjI6Im9uIjtzOjM2OiJncnVuZ2VtYWdfaW50ZWdyYXRlX3NpbmdsZXRvcF9lbmFibGUiO3M6Mjoib24iO3M6Mzk6ImdydW5nZW1hZ19pbnRlZ3JhdGVfc2luZ2xlYm90dG9tX2VuYWJsZSI7czoyOiJvbiI7czoyNjoiZ3J1bmdlbWFnX2ludGVncmF0aW9uX2hlYWQiO3M6MDoiIjtzOjI2OiJncnVuZ2VtYWdfaW50ZWdyYXRpb25fYm9keSI7czowOiIiO3M6MzI6ImdydW5nZW1hZ19pbnRlZ3JhdGlvbl9zaW5nbGVfdG9wIjtzOjA6IiI7czozNToiZ3J1bmdlbWFnX2ludGVncmF0aW9uX3NpbmdsZV9ib3R0b20iO3M6MDoiIjtzOjIwOiJncnVuZ2VtYWdfNDY4X2VuYWJsZSI7TjtzOjE5OiJncnVuZ2VtYWdfNDY4X2ltYWdlIjtzOjA6IiI7czoxNzoiZ3J1bmdlbWFnXzQ2OF91cmwiO3M6MDoiIjtzOjIxOiJncnVuZ2VtYWdfNDY4X2Fkc2Vuc2UiO3M6MDoiIjtzOjI3OiJncnVuZ2VtYWdfNDY4X2hlYWRlcl9lbmFibGUiO047czoyNjoiZ3J1bmdlbWFnXzQ2OF9oZWFkZXJfaW1hZ2UiO3M6MDoiIjtzOjI0OiJncnVuZ2VtYWdfNDY4X2hlYWRlcl91cmwiO3M6MDoiIjtzOjI4OiJncnVuZ2VtYWdfNDY4X2hlYWRlcl9hZHNlbnNlIjtzOjA6IiI7fQ==';

	/*global $options;

	foreach ($options as $value) {
		if( isset( $value['id'] ) ) {
			update_option( $value['id'], $value['std'] );
		}
	}*/

	$importedOptions = unserialize(base64_decode($importOptions));

	foreach ($importedOptions as $key=>$value) {
		if ($value != '') update_option( $key, $value );
	}
} ?>