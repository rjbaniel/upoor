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

	$importOptions = 'YToxMDE6e3M6MDoiIjtOO3M6MTQ6ImRlZXBmb2N1c19sb2dvIjtzOjA6IiI7czoxNzoiZGVlcGZvY3VzX2Zhdmljb24iO3M6MDoiIjtzOjIyOiJkZWVwZm9jdXNfY29sb3Jfc2NoZW1lIjtzOjc6IkRlZmF1bHQiO3M6MjA6ImRlZXBmb2N1c19ibG9nX3N0eWxlIjtOO3M6MjA6ImRlZXBmb2N1c19ncmFiX2ltYWdlIjtOO3M6MTg6ImRlZXBmb2N1c19ibG9nX2NhdCI7czo0OiJCbG9nIjtzOjIyOiJkZWVwZm9jdXNfY2F0bnVtX3Bvc3RzIjtzOjI6IjEyIjtzOjI2OiJkZWVwZm9jdXNfYXJjaGl2ZW51bV9wb3N0cyI7czoyOiIxMiI7czoyNToiZGVlcGZvY3VzX3NlYXJjaG51bV9wb3N0cyI7czoyOiIxMiI7czoyMjoiZGVlcGZvY3VzX3RhZ251bV9wb3N0cyI7czoyOiIxMiI7czoyMToiZGVlcGZvY3VzX2RhdGVfZm9ybWF0IjtzOjY6Ik0gaiwgWSI7czoyMToiZGVlcGZvY3VzX3VzZV9leGNlcnB0IjtOO3M6MTU6ImRlZXBmb2N1c19jdWZvbiI7czoyOiJvbiI7czoxNToiZGVlcGZvY3VzX3F1b3RlIjtzOjI6Im9uIjtzOjE5OiJkZWVwZm9jdXNfcXVvdGVfb25lIjtzOjUwOiJJbWFnZXJ5IGlzIG15IGxpZmUgYW5kIGxpZmUgaXMgc29tZXRoaW5nIGJlYXV0aWZ1bCI7czoxOToiZGVlcGZvY3VzX3F1b3RlX3R3byI7czo4ODoiTmFtIGRhcGlidXMgdG9ydG9yIGF0IG1hc3NhIG9ybmFyZSB0aW5jaWR1bnQgZG9uZWMgc2FnaXR0aXMgY29tbW9kbyBkaWFtLCBhIG9ybmFyZSBtZXR1cyI7czoyMToiZGVlcGZvY3VzX2hvbWVfcGFnZV8xIjtzOjg6IldobyBJIEFtIjtzOjIxOiJkZWVwZm9jdXNfaG9tZV9wYWdlXzIiO3M6OToiV2hhdCBJIERvIjtzOjI1OiJkZWVwZm9jdXNfZnJvbWJsb2dfbnVtYmVyIjtzOjE6IjkiO3M6MjY6ImRlZXBmb2N1c19wb3J0Zm9saW9fbnVtYmVyIjtzOjE6IjgiO3M6MjM6ImRlZXBmb2N1c19wb3J0Zm9saW9fY2F0IjtzOjk6IlBvcnRmb2xpbyI7czoyNToiZGVlcGZvY3VzX2ZlYXRfY2F0ZWdvcmllcyI7TjtzOjI0OiJkZWVwZm9jdXNfaG9tZXBhZ2VfcG9zdHMiO3M6MToiNyI7czoyNDoiZGVlcGZvY3VzX2V4bGNhdHNfcmVjZW50IjtOO3M6MTg6ImRlZXBmb2N1c19mZWF0dXJlZCI7czoyOiJvbiI7czoxOToiZGVlcGZvY3VzX2R1cGxpY2F0ZSI7TjtzOjE4OiJkZWVwZm9jdXNfZmVhdF9jYXQiO3M6ODoiRmVhdHVyZWQiO3M6MjI6ImRlZXBmb2N1c19mZWF0dXJlZF9udW0iO3M6MToiNSI7czoxOToiZGVlcGZvY3VzX3VzZV9wYWdlcyI7TjtzOjIwOiJkZWVwZm9jdXNfZmVhdF9wYWdlcyI7TjtzOjIxOiJkZWVwZm9jdXNfc2xpZGVyX2F1dG8iO3M6Mjoib24iO3M6MjY6ImRlZXBmb2N1c19zbGlkZXJfYXV0b3NwZWVkIjtzOjQ6IjM1MDAiO3M6MjM6ImRlZXBmb2N1c19zbGlkZXJfZWZmZWN0IjtzOjQ6ImZhZGUiO3M6MTk6ImRlZXBmb2N1c19tZW51cGFnZXMiO2E6Mjp7aTowO3M6MzoiMjM1IjtpOjE7czozOiI2NjgiO31zOjI2OiJkZWVwZm9jdXNfZW5hYmxlX2Ryb3Bkb3ducyI7czoyOiJvbiI7czoxOToiZGVlcGZvY3VzX2hvbWVfbGluayI7czoyOiJvbiI7czoyMDoiZGVlcGZvY3VzX3NvcnRfcGFnZXMiO3M6MTA6InBvc3RfdGl0bGUiO3M6MjA6ImRlZXBmb2N1c19vcmRlcl9wYWdlIjtzOjM6ImFzYyI7czoyNzoiZGVlcGZvY3VzX3RpZXJzX3Nob3duX3BhZ2VzIjtzOjE6IjMiO3M6MTg6ImRlZXBmb2N1c19tZW51Y2F0cyI7YToyOntpOjA7czoyOiI4NyI7aToxO3M6MToiMSI7fXM6Mzc6ImRlZXBmb2N1c19lbmFibGVfZHJvcGRvd25zX2NhdGVnb3JpZXMiO3M6Mjoib24iO3M6MjY6ImRlZXBmb2N1c19jYXRlZ29yaWVzX2VtcHR5IjtzOjI6Im9uIjtzOjMyOiJkZWVwZm9jdXNfdGllcnNfc2hvd25fY2F0ZWdvcmllcyI7czoxOiIzIjtzOjE4OiJkZWVwZm9jdXNfc29ydF9jYXQiO3M6NDoibmFtZSI7czoxOToiZGVlcGZvY3VzX29yZGVyX2NhdCI7czozOiJhc2MiO3M6MjE6ImRlZXBmb2N1c19zd2FwX25hdmJhciI7TjtzOjI1OiJkZWVwZm9jdXNfZGlzYWJsZV90b3B0aWVyIjtOO3M6MTk6ImRlZXBmb2N1c19wb3N0aW5mbzIiO2E6NDp7aTowO3M6NjoiYXV0aG9yIjtpOjE7czo0OiJkYXRlIjtpOjI7czoxMDoiY2F0ZWdvcmllcyI7aTozO3M6ODoiY29tbWVudHMiO31zOjI1OiJkZWVwZm9jdXNfYmxvZ190aHVtYm5haWxzIjtzOjI6Im9uIjtzOjI3OiJkZWVwZm9jdXNfc2hvd19wb3N0Y29tbWVudHMiO3M6Mjoib24iO3M6Mjg6ImRlZXBmb2N1c19nYWxsZXJ5X3RodW1ibmFpbHMiO3M6Mjoib24iO3M6MjU6ImRlZXBmb2N1c19wYWdlX3RodW1ibmFpbHMiO047czoyODoiZGVlcGZvY3VzX3Nob3dfcGFnZXNjb21tZW50cyI7TjtzOjE5OiJkZWVwZm9jdXNfcG9zdGluZm8xIjthOjQ6e2k6MDtzOjY6ImF1dGhvciI7aToxO3M6NDoiZGF0ZSI7aToyO3M6MTA6ImNhdGVnb3JpZXMiO2k6MztzOjg6ImNvbW1lbnRzIjt9czoyNjoiZGVlcGZvY3VzX3RodW1ibmFpbHNfaW5kZXgiO3M6Mjoib24iO3M6MjM6ImRlZXBmb2N1c19jdXN0b21fY29sb3JzIjtOO3M6MTk6ImRlZXBmb2N1c19jaGlsZF9jc3MiO047czoyMjoiZGVlcGZvY3VzX2NoaWxkX2Nzc3VybCI7czowOiIiO3M6MjM6ImRlZXBmb2N1c19jb2xvcl9iZ2NvbG9yIjtzOjA6IiI7czoyNDoiZGVlcGZvY3VzX2NvbG9yX21haW5mb250IjtzOjA6IiI7czoyNDoiZGVlcGZvY3VzX2NvbG9yX21haW5saW5rIjtzOjA6IiI7czoyNDoiZGVlcGZvY3VzX2NvbG9yX3BhZ2VsaW5rIjtzOjA6IiI7czoyNDoiZGVlcGZvY3VzX2NvbG9yX2NhdHNsaW5rIjtzOjA6IiI7czozMDoiZGVlcGZvY3VzX2NvbG9yX3NpZGViYXJfdGl0bGVzIjtzOjA6IiI7czoyOToiZGVlcGZvY3VzX2NvbG9yX2Zvb3Rlcl90aXRsZXMiO3M6MDoiIjtzOjI4OiJkZWVwZm9jdXNfY29sb3JfZm9vdGVyX2xpbmtzIjtzOjA6IiI7czoyNDoiZGVlcGZvY3VzX3Nlb19ob21lX3RpdGxlIjtOO3M6MzA6ImRlZXBmb2N1c19zZW9faG9tZV9kZXNjcmlwdGlvbiI7TjtzOjI3OiJkZWVwZm9jdXNfc2VvX2hvbWVfa2V5d29yZHMiO047czoyODoiZGVlcGZvY3VzX3Nlb19ob21lX2Nhbm9uaWNhbCI7TjtzOjI4OiJkZWVwZm9jdXNfc2VvX2hvbWVfdGl0bGV0ZXh0IjtzOjA6IiI7czozNDoiZGVlcGZvY3VzX3Nlb19ob21lX2Rlc2NyaXB0aW9udGV4dCI7czowOiIiO3M6MzE6ImRlZXBmb2N1c19zZW9faG9tZV9rZXl3b3Jkc3RleHQiO3M6MDoiIjtzOjIzOiJkZWVwZm9jdXNfc2VvX2hvbWVfdHlwZSI7czoyNzoiQmxvZ05hbWUgfCBCbG9nIGRlc2NyaXB0aW9uIjtzOjI3OiJkZWVwZm9jdXNfc2VvX2hvbWVfc2VwYXJhdGUiO3M6MzoiIHwgIjtzOjI2OiJkZWVwZm9jdXNfc2VvX3NpbmdsZV90aXRsZSI7TjtzOjMyOiJkZWVwZm9jdXNfc2VvX3NpbmdsZV9kZXNjcmlwdGlvbiI7TjtzOjI5OiJkZWVwZm9jdXNfc2VvX3NpbmdsZV9rZXl3b3JkcyI7TjtzOjMwOiJkZWVwZm9jdXNfc2VvX3NpbmdsZV9jYW5vbmljYWwiO047czozMjoiZGVlcGZvY3VzX3Nlb19zaW5nbGVfZmllbGRfdGl0bGUiO3M6OToic2VvX3RpdGxlIjtzOjM4OiJkZWVwZm9jdXNfc2VvX3NpbmdsZV9maWVsZF9kZXNjcmlwdGlvbiI7czoxNToic2VvX2Rlc2NyaXB0aW9uIjtzOjM1OiJkZWVwZm9jdXNfc2VvX3NpbmdsZV9maWVsZF9rZXl3b3JkcyI7czoxMjoic2VvX2tleXdvcmRzIjtzOjI1OiJkZWVwZm9jdXNfc2VvX3NpbmdsZV90eXBlIjtzOjIxOiJQb3N0IHRpdGxlIHwgQmxvZ05hbWUiO3M6Mjk6ImRlZXBmb2N1c19zZW9fc2luZ2xlX3NlcGFyYXRlIjtzOjM6IiB8ICI7czoyOToiZGVlcGZvY3VzX3Nlb19pbmRleF9jYW5vbmljYWwiO047czozMToiZGVlcGZvY3VzX3Nlb19pbmRleF9kZXNjcmlwdGlvbiI7TjtzOjI0OiJkZWVwZm9jdXNfc2VvX2luZGV4X3R5cGUiO3M6MjQ6IkNhdGVnb3J5IG5hbWUgfCBCbG9nTmFtZSI7czoyODoiZGVlcGZvY3VzX3Nlb19pbmRleF9zZXBhcmF0ZSI7czozOiIgfCAiO3M6MzM6ImRlZXBmb2N1c19pbnRlZ3JhdGVfaGVhZGVyX2VuYWJsZSI7czoyOiJvbiI7czozMToiZGVlcGZvY3VzX2ludGVncmF0ZV9ib2R5X2VuYWJsZSI7czoyOiJvbiI7czozNjoiZGVlcGZvY3VzX2ludGVncmF0ZV9zaW5nbGV0b3BfZW5hYmxlIjtzOjI6Im9uIjtzOjM5OiJkZWVwZm9jdXNfaW50ZWdyYXRlX3NpbmdsZWJvdHRvbV9lbmFibGUiO3M6Mjoib24iO3M6MjY6ImRlZXBmb2N1c19pbnRlZ3JhdGlvbl9oZWFkIjtzOjA6IiI7czoyNjoiZGVlcGZvY3VzX2ludGVncmF0aW9uX2JvZHkiO3M6MDoiIjtzOjMyOiJkZWVwZm9jdXNfaW50ZWdyYXRpb25fc2luZ2xlX3RvcCI7czowOiIiO3M6MzU6ImRlZXBmb2N1c19pbnRlZ3JhdGlvbl9zaW5nbGVfYm90dG9tIjtzOjA6IiI7czoyMDoiZGVlcGZvY3VzXzQ2OF9lbmFibGUiO047czoxOToiZGVlcGZvY3VzXzQ2OF9pbWFnZSI7czowOiIiO3M6MTc6ImRlZXBmb2N1c180NjhfdXJsIjtzOjA6IiI7czoyMToiZGVlcGZvY3VzXzQ2OF9hZHNlbnNlIjtzOjA6IiI7fQ==';

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

	update_option( $shortname . '_use_pages', 'false' );
} ?>