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

	$importOptions = 'YTo5MTp7czowOiIiO047czoxNzoiZWFydGhseXRvdWNoX2xvZ28iO3M6MDoiIjtzOjIwOiJlYXJ0aGx5dG91Y2hfZmF2aWNvbiI7czowOiIiO3M6MjU6ImVhcnRobHl0b3VjaF9jb2xvcl9zY2hlbWUiO3M6MzoiUmVkIjtzOjIzOiJlYXJ0aGx5dG91Y2hfYmxvZ19zdHlsZSI7TjtzOjIzOiJlYXJ0aGx5dG91Y2hfZ3JhYl9pbWFnZSI7TjtzOjI1OiJlYXJ0aGx5dG91Y2hfY2F0bnVtX3Bvc3RzIjtzOjE6IjYiO3M6Mjk6ImVhcnRobHl0b3VjaF9hcmNoaXZlbnVtX3Bvc3RzIjtzOjE6IjUiO3M6Mjg6ImVhcnRobHl0b3VjaF9zZWFyY2hudW1fcG9zdHMiO3M6MToiNSI7czoyNToiZWFydGhseXRvdWNoX3RhZ251bV9wb3N0cyI7czoxOiI1IjtzOjI0OiJlYXJ0aGx5dG91Y2hfZGF0ZV9mb3JtYXQiO3M6NjoiTSBqLCBZIjtzOjI0OiJlYXJ0aGx5dG91Y2hfdXNlX2V4Y2VycHQiO047czozMToiZWFydGhseXRvdWNoX3JlY2VudGNvbW1lbnRzX251bSI7czoxOiI2IjtzOjI4OiJlYXJ0aGx5dG91Y2hfcmFuZG9tcG9zdHNfbnVtIjtzOjE6IjYiO3M6MzM6ImVhcnRobHl0b3VjaF9zaG93X3JlY2VudF9jb21tZW50cyI7czoyOiJvbiI7czozMDoiZWFydGhseXRvdWNoX3Nob3dfcmFuZG9tX3Bvc3RzIjtzOjI6Im9uIjtzOjI3OiJlYXJ0aGx5dG91Y2hfaG9tZXBhZ2VfcG9zdHMiO3M6MToiOCI7czoyNzoiZWFydGhseXRvdWNoX2V4bGNhdHNfcmVjZW50IjtOO3M6MjE6ImVhcnRobHl0b3VjaF9mZWF0dXJlZCI7czoyOiJvbiI7czoyMjoiZWFydGhseXRvdWNoX2R1cGxpY2F0ZSI7czoyOiJvbiI7czoyMToiZWFydGhseXRvdWNoX2ZlYXRfY2F0IjtzOjEzOiJVbmNhdGVnb3JpemVkIjtzOjI1OiJlYXJ0aGx5dG91Y2hfZmVhdHVyZWRfbnVtIjtzOjE6IjMiO3M6MjI6ImVhcnRobHl0b3VjaF9tZW51cGFnZXMiO047czoyOToiZWFydGhseXRvdWNoX2VuYWJsZV9kcm9wZG93bnMiO3M6Mjoib24iO3M6MjI6ImVhcnRobHl0b3VjaF9ob21lX2xpbmsiO3M6Mjoib24iO3M6MjM6ImVhcnRobHl0b3VjaF9zb3J0X3BhZ2VzIjtzOjEwOiJwb3N0X3RpdGxlIjtzOjIzOiJlYXJ0aGx5dG91Y2hfb3JkZXJfcGFnZSI7czozOiJhc2MiO3M6MzA6ImVhcnRobHl0b3VjaF90aWVyc19zaG93bl9wYWdlcyI7czoxOiIzIjtzOjIxOiJlYXJ0aGx5dG91Y2hfbWVudWNhdHMiO047czo0MDoiZWFydGhseXRvdWNoX2VuYWJsZV9kcm9wZG93bnNfY2F0ZWdvcmllcyI7czoyOiJvbiI7czoyOToiZWFydGhseXRvdWNoX2NhdGVnb3JpZXNfZW1wdHkiO3M6Mjoib24iO3M6MzU6ImVhcnRobHl0b3VjaF90aWVyc19zaG93bl9jYXRlZ29yaWVzIjtzOjE6IjMiO3M6MjE6ImVhcnRobHl0b3VjaF9zb3J0X2NhdCI7czo0OiJuYW1lIjtzOjIyOiJlYXJ0aGx5dG91Y2hfb3JkZXJfY2F0IjtzOjM6ImFzYyI7czoyNDoiZWFydGhseXRvdWNoX3N3YXBfbmF2YmFyIjtOO3M6Mjg6ImVhcnRobHl0b3VjaF9kaXNhYmxlX3RvcHRpZXIiO047czoyMjoiZWFydGhseXRvdWNoX3Bvc3RpbmZvMiI7YTo0OntpOjA7czo2OiJhdXRob3IiO2k6MTtzOjQ6ImRhdGUiO2k6MjtzOjEwOiJjYXRlZ29yaWVzIjtpOjM7czo4OiJjb21tZW50cyI7fXM6MjM6ImVhcnRobHl0b3VjaF90aHVtYm5haWxzIjtzOjI6Im9uIjtzOjMwOiJlYXJ0aGx5dG91Y2hfc2hvd19wb3N0Y29tbWVudHMiO3M6Mjoib24iO3M6MzQ6ImVhcnRobHl0b3VjaF90aHVtYm5haWxfd2lkdGhfcG9zdHMiO3M6MjoiODQiO3M6MzU6ImVhcnRobHl0b3VjaF90aHVtYm5haWxfaGVpZ2h0X3Bvc3RzIjtzOjI6Ijg0IjtzOjI4OiJlYXJ0aGx5dG91Y2hfcGFnZV90aHVtYm5haWxzIjtOO3M6MzE6ImVhcnRobHl0b3VjaF9zaG93X3BhZ2VzY29tbWVudHMiO047czozNDoiZWFydGhseXRvdWNoX3RodW1ibmFpbF93aWR0aF9wYWdlcyI7czoyOiI4NCI7czozNToiZWFydGhseXRvdWNoX3RodW1ibmFpbF9oZWlnaHRfcGFnZXMiO3M6MjoiODQiO3M6MjI6ImVhcnRobHl0b3VjaF9wb3N0aW5mbzEiO2E6NDp7aTowO3M6NjoiYXV0aG9yIjtpOjE7czo0OiJkYXRlIjtpOjI7czoxMDoiY2F0ZWdvcmllcyI7aTozO3M6ODoiY29tbWVudHMiO31zOjI5OiJlYXJ0aGx5dG91Y2hfdGh1bWJuYWlsc19pbmRleCI7czoyOiJvbiI7czoyNjoiZWFydGhseXRvdWNoX2N1c3RvbV9jb2xvcnMiO047czoyMjoiZWFydGhseXRvdWNoX2NoaWxkX2NzcyI7TjtzOjI1OiJlYXJ0aGx5dG91Y2hfY2hpbGRfY3NzdXJsIjtzOjA6IiI7czoyNzoiZWFydGhseXRvdWNoX2NvbG9yX21haW5mb250IjtzOjA6IiI7czoyNzoiZWFydGhseXRvdWNoX2NvbG9yX21haW5saW5rIjtzOjA6IiI7czoyNzoiZWFydGhseXRvdWNoX2NvbG9yX3BhZ2VsaW5rIjtzOjA6IiI7czozNDoiZWFydGhseXRvdWNoX2NvbG9yX3BhZ2VsaW5rX2FjdGl2ZSI7czowOiIiO3M6Mjc6ImVhcnRobHl0b3VjaF9jb2xvcl9oZWFkaW5ncyI7czowOiIiO3M6MzI6ImVhcnRobHl0b3VjaF9jb2xvcl9zaWRlYmFyX2xpbmtzIjtzOjA6IiI7czoyNDoiZWFydGhseXRvdWNoX2Zvb3Rlcl90ZXh0IjtzOjA6IiI7czozMDoiZWFydGhseXRvdWNoX2NvbG9yX2Zvb3RlcmxpbmtzIjtzOjA6IiI7czoyNzoiZWFydGhseXRvdWNoX3Nlb19ob21lX3RpdGxlIjtOO3M6MzM6ImVhcnRobHl0b3VjaF9zZW9faG9tZV9kZXNjcmlwdGlvbiI7TjtzOjMwOiJlYXJ0aGx5dG91Y2hfc2VvX2hvbWVfa2V5d29yZHMiO047czozMToiZWFydGhseXRvdWNoX3Nlb19ob21lX2Nhbm9uaWNhbCI7TjtzOjMxOiJlYXJ0aGx5dG91Y2hfc2VvX2hvbWVfdGl0bGV0ZXh0IjtzOjA6IiI7czozNzoiZWFydGhseXRvdWNoX3Nlb19ob21lX2Rlc2NyaXB0aW9udGV4dCI7czowOiIiO3M6MzQ6ImVhcnRobHl0b3VjaF9zZW9faG9tZV9rZXl3b3Jkc3RleHQiO3M6MDoiIjtzOjI2OiJlYXJ0aGx5dG91Y2hfc2VvX2hvbWVfdHlwZSI7czoyNzoiQmxvZ05hbWUgfCBCbG9nIGRlc2NyaXB0aW9uIjtzOjMwOiJlYXJ0aGx5dG91Y2hfc2VvX2hvbWVfc2VwYXJhdGUiO3M6MzoiIHwgIjtzOjI5OiJlYXJ0aGx5dG91Y2hfc2VvX3NpbmdsZV90aXRsZSI7TjtzOjM1OiJlYXJ0aGx5dG91Y2hfc2VvX3NpbmdsZV9kZXNjcmlwdGlvbiI7TjtzOjMyOiJlYXJ0aGx5dG91Y2hfc2VvX3NpbmdsZV9rZXl3b3JkcyI7TjtzOjMzOiJlYXJ0aGx5dG91Y2hfc2VvX3NpbmdsZV9jYW5vbmljYWwiO047czozNToiZWFydGhseXRvdWNoX3Nlb19zaW5nbGVfZmllbGRfdGl0bGUiO3M6OToic2VvX3RpdGxlIjtzOjQxOiJlYXJ0aGx5dG91Y2hfc2VvX3NpbmdsZV9maWVsZF9kZXNjcmlwdGlvbiI7czoxNToic2VvX2Rlc2NyaXB0aW9uIjtzOjM4OiJlYXJ0aGx5dG91Y2hfc2VvX3NpbmdsZV9maWVsZF9rZXl3b3JkcyI7czoxMjoic2VvX2tleXdvcmRzIjtzOjI4OiJlYXJ0aGx5dG91Y2hfc2VvX3NpbmdsZV90eXBlIjtzOjIxOiJQb3N0IHRpdGxlIHwgQmxvZ05hbWUiO3M6MzI6ImVhcnRobHl0b3VjaF9zZW9fc2luZ2xlX3NlcGFyYXRlIjtzOjM6IiB8ICI7czozMjoiZWFydGhseXRvdWNoX3Nlb19pbmRleF9jYW5vbmljYWwiO047czozNDoiZWFydGhseXRvdWNoX3Nlb19pbmRleF9kZXNjcmlwdGlvbiI7TjtzOjI3OiJlYXJ0aGx5dG91Y2hfc2VvX2luZGV4X3R5cGUiO3M6MjQ6IkNhdGVnb3J5IG5hbWUgfCBCbG9nTmFtZSI7czozMToiZWFydGhseXRvdWNoX3Nlb19pbmRleF9zZXBhcmF0ZSI7czozOiIgfCAiO3M6MzY6ImVhcnRobHl0b3VjaF9pbnRlZ3JhdGVfaGVhZGVyX2VuYWJsZSI7czoyOiJvbiI7czozNDoiZWFydGhseXRvdWNoX2ludGVncmF0ZV9ib2R5X2VuYWJsZSI7czoyOiJvbiI7czozOToiZWFydGhseXRvdWNoX2ludGVncmF0ZV9zaW5nbGV0b3BfZW5hYmxlIjtzOjI6Im9uIjtzOjQyOiJlYXJ0aGx5dG91Y2hfaW50ZWdyYXRlX3NpbmdsZWJvdHRvbV9lbmFibGUiO3M6Mjoib24iO3M6Mjk6ImVhcnRobHl0b3VjaF9pbnRlZ3JhdGlvbl9oZWFkIjtzOjA6IiI7czoyOToiZWFydGhseXRvdWNoX2ludGVncmF0aW9uX2JvZHkiO3M6MDoiIjtzOjM1OiJlYXJ0aGx5dG91Y2hfaW50ZWdyYXRpb25fc2luZ2xlX3RvcCI7czowOiIiO3M6Mzg6ImVhcnRobHl0b3VjaF9pbnRlZ3JhdGlvbl9zaW5nbGVfYm90dG9tIjtzOjA6IiI7czoyMzoiZWFydGhseXRvdWNoXzQ2OF9lbmFibGUiO047czoyMjoiZWFydGhseXRvdWNoXzQ2OF9pbWFnZSI7czowOiIiO3M6MjA6ImVhcnRobHl0b3VjaF80NjhfdXJsIjtzOjA6IiI7fQ==';

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