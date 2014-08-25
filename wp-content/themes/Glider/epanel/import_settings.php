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

	$importOptions = 'YTo2ODp7czowOiIiO047czoxMToiZ2xpZGVyX2xvZ28iO3M6MDoiIjtzOjE0OiJnbGlkZXJfZmF2aWNvbiI7czowOiIiO3M6MTk6ImdsaWRlcl9jb2xvcl9zY2hlbWUiO3M6NzoiRGVmYXVsdCI7czoxNzoiZ2xpZGVyX2Jsb2dfc3R5bGUiO047czoxNzoiZ2xpZGVyX2dyYWJfaW1hZ2UiO047czoxNToiZ2xpZGVyX2Jsb2dfY2F0IjtzOjQ6IkJsb2ciO3M6MTk6ImdsaWRlcl9jYXRudW1fcG9zdHMiO3M6MToiNiI7czoyMzoiZ2xpZGVyX2FyY2hpdmVudW1fcG9zdHMiO3M6MToiNSI7czoyMjoiZ2xpZGVyX3NlYXJjaG51bV9wb3N0cyI7czoxOiI1IjtzOjE5OiJnbGlkZXJfdGFnbnVtX3Bvc3RzIjtzOjE6IjUiO3M6MTg6ImdsaWRlcl9kYXRlX2Zvcm1hdCI7czo2OiJNIGosIFkiO3M6MTg6ImdsaWRlcl91c2VfZXhjZXJwdCI7TjtzOjEyOiJnbGlkZXJfY3Vmb24iO3M6Mjoib24iO3M6MTI6ImdsaWRlcl9xdW90ZSI7czoyOiJvbiI7czoxNjoiZ2xpZGVyX3F1b3RlX29uZSI7czo0OToiV2hlcmUgYmVhdXR5IDxzcGFuPiY8L3NwYW4+IGZ1bmN0aW9uYWxpdHkgY29tYmluZSI7czoxNjoiZ2xpZGVyX3F1b3RlX3R3byI7czo3NDoiV2ViIGRlc2lnbiBpcyBteSBwYXNzaW9uLCBhbmQgSSB0cmVhdCBlYWNoIG5ldyB3ZWJzaXRlIGxpa2UgYSBwaWVjZSBvZiBhcnQiO3M6MTc6ImdsaWRlcl9ob21lX3BhZ2VzIjthOjM6e2k6MDtzOjM6IjE2NCI7aToxO3M6MzoiMjM1IjtpOjI7czozOiI2NjgiO31zOjE2OiJnbGlkZXJfcG9zdGluZm8yIjthOjQ6e2k6MDtzOjY6ImF1dGhvciI7aToxO3M6NDoiZGF0ZSI7aToyO3M6MTA6ImNhdGVnb3JpZXMiO2k6MztzOjg6ImNvbW1lbnRzIjt9czoyMjoiZ2xpZGVyX2Jsb2dfdGh1bWJuYWlscyI7czoyOiJvbiI7czoyNDoiZ2xpZGVyX3Nob3dfcG9zdGNvbW1lbnRzIjtzOjI6Im9uIjtzOjIyOiJnbGlkZXJfcGFnZV90aHVtYm5haWxzIjtzOjI6Im9uIjtzOjI1OiJnbGlkZXJfc2hvd19wYWdlc2NvbW1lbnRzIjtOO3M6MTY6ImdsaWRlcl9wb3N0aW5mbzEiO2E6NDp7aTowO3M6NjoiYXV0aG9yIjtpOjE7czo0OiJkYXRlIjtpOjI7czoxMDoiY2F0ZWdvcmllcyI7aTozO3M6ODoiY29tbWVudHMiO31zOjIzOiJnbGlkZXJfdGh1bWJuYWlsc19pbmRleCI7czoyOiJvbiI7czoyMDoiZ2xpZGVyX2N1c3RvbV9jb2xvcnMiO047czoxNjoiZ2xpZGVyX2NoaWxkX2NzcyI7TjtzOjE5OiJnbGlkZXJfY2hpbGRfY3NzdXJsIjtzOjA6IiI7czoyMDoiZ2xpZGVyX2NvbG9yX2JnY29sb3IiO3M6MDoiIjtzOjIxOiJnbGlkZXJfY29sb3JfbWFpbmZvbnQiO3M6MDoiIjtzOjIxOiJnbGlkZXJfY29sb3JfbWFpbmxpbmsiO3M6MDoiIjtzOjIxOiJnbGlkZXJfY29sb3JfcGFnZWxpbmsiO3M6MDoiIjtzOjIzOiJnbGlkZXJfY29sb3JfYWN0aXZlbGluayI7czowOiIiO3M6MjA6ImdsaWRlcl9jb2xvcl9oZWFkaW5nIjtzOjA6IiI7czoyMToiZ2xpZGVyX3Nlb19ob21lX3RpdGxlIjtOO3M6Mjc6ImdsaWRlcl9zZW9faG9tZV9kZXNjcmlwdGlvbiI7TjtzOjI0OiJnbGlkZXJfc2VvX2hvbWVfa2V5d29yZHMiO047czoyNToiZ2xpZGVyX3Nlb19ob21lX2Nhbm9uaWNhbCI7TjtzOjI1OiJnbGlkZXJfc2VvX2hvbWVfdGl0bGV0ZXh0IjtzOjA6IiI7czozMToiZ2xpZGVyX3Nlb19ob21lX2Rlc2NyaXB0aW9udGV4dCI7czowOiIiO3M6Mjg6ImdsaWRlcl9zZW9faG9tZV9rZXl3b3Jkc3RleHQiO3M6MDoiIjtzOjIwOiJnbGlkZXJfc2VvX2hvbWVfdHlwZSI7czoyNzoiQmxvZ05hbWUgfCBCbG9nIGRlc2NyaXB0aW9uIjtzOjI0OiJnbGlkZXJfc2VvX2hvbWVfc2VwYXJhdGUiO3M6MzoiIHwgIjtzOjIzOiJnbGlkZXJfc2VvX3NpbmdsZV90aXRsZSI7TjtzOjI5OiJnbGlkZXJfc2VvX3NpbmdsZV9kZXNjcmlwdGlvbiI7TjtzOjI2OiJnbGlkZXJfc2VvX3NpbmdsZV9rZXl3b3JkcyI7TjtzOjI3OiJnbGlkZXJfc2VvX3NpbmdsZV9jYW5vbmljYWwiO047czoyOToiZ2xpZGVyX3Nlb19zaW5nbGVfZmllbGRfdGl0bGUiO3M6OToic2VvX3RpdGxlIjtzOjM1OiJnbGlkZXJfc2VvX3NpbmdsZV9maWVsZF9kZXNjcmlwdGlvbiI7czoxNToic2VvX2Rlc2NyaXB0aW9uIjtzOjMyOiJnbGlkZXJfc2VvX3NpbmdsZV9maWVsZF9rZXl3b3JkcyI7czoxMjoic2VvX2tleXdvcmRzIjtzOjIyOiJnbGlkZXJfc2VvX3NpbmdsZV90eXBlIjtzOjIxOiJQb3N0IHRpdGxlIHwgQmxvZ05hbWUiO3M6MjY6ImdsaWRlcl9zZW9fc2luZ2xlX3NlcGFyYXRlIjtzOjM6IiB8ICI7czoyNjoiZ2xpZGVyX3Nlb19pbmRleF9jYW5vbmljYWwiO047czoyODoiZ2xpZGVyX3Nlb19pbmRleF9kZXNjcmlwdGlvbiI7TjtzOjIxOiJnbGlkZXJfc2VvX2luZGV4X3R5cGUiO3M6MjQ6IkNhdGVnb3J5IG5hbWUgfCBCbG9nTmFtZSI7czoyNToiZ2xpZGVyX3Nlb19pbmRleF9zZXBhcmF0ZSI7czozOiIgfCAiO3M6MzA6ImdsaWRlcl9pbnRlZ3JhdGVfaGVhZGVyX2VuYWJsZSI7czoyOiJvbiI7czoyODoiZ2xpZGVyX2ludGVncmF0ZV9ib2R5X2VuYWJsZSI7czoyOiJvbiI7czozMzoiZ2xpZGVyX2ludGVncmF0ZV9zaW5nbGV0b3BfZW5hYmxlIjtzOjI6Im9uIjtzOjM2OiJnbGlkZXJfaW50ZWdyYXRlX3NpbmdsZWJvdHRvbV9lbmFibGUiO3M6Mjoib24iO3M6MjM6ImdsaWRlcl9pbnRlZ3JhdGlvbl9oZWFkIjtzOjA6IiI7czoyMzoiZ2xpZGVyX2ludGVncmF0aW9uX2JvZHkiO3M6MDoiIjtzOjI5OiJnbGlkZXJfaW50ZWdyYXRpb25fc2luZ2xlX3RvcCI7czowOiIiO3M6MzI6ImdsaWRlcl9pbnRlZ3JhdGlvbl9zaW5nbGVfYm90dG9tIjtzOjA6IiI7czoxNzoiZ2xpZGVyXzQ2OF9lbmFibGUiO047czoxNjoiZ2xpZGVyXzQ2OF9pbWFnZSI7czowOiIiO3M6MTQ6ImdsaWRlcl80NjhfdXJsIjtzOjA6IiI7czoxODoiZ2xpZGVyXzQ2OF9hZHNlbnNlIjtzOjA6IiI7fQ==';

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