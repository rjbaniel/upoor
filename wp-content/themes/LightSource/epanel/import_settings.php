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

	$importOptions = 'YTo5Mzp7czowOiIiO047czoxNjoibGlnaHRzb3VyY2VfbG9nbyI7czowOiIiO3M6MTk6ImxpZ2h0c291cmNlX2Zhdmljb24iO3M6MDoiIjtzOjI0OiJsaWdodHNvdXJjZV9jb2xvcl9zY2hlbWUiO3M6NDoiQmx1ZSI7czoxODoibGlnaHRzb3VyY2VfZm9ybWF0IjtOO3M6MjI6ImxpZ2h0c291cmNlX2dyYWJfaW1hZ2UiO047czoyMzoibGlnaHRzb3VyY2VfZGF0ZV9mb3JtYXQiO3M6NzoiTSBqUywgWSI7czoyNDoibGlnaHRzb3VyY2VfY2F0bnVtX3Bvc3RzIjtzOjE6IjUiO3M6Mjg6ImxpZ2h0c291cmNlX2FyY2hpdmVudW1fcG9zdHMiO3M6MToiNSI7czoyNzoibGlnaHRzb3VyY2Vfc2VhcmNobnVtX3Bvc3RzIjtzOjE6IjUiO3M6MjQ6ImxpZ2h0c291cmNlX3RhZ251bV9wb3N0cyI7czoxOiI1IjtzOjIzOiJsaWdodHNvdXJjZV91c2VfZXhjZXJwdCI7TjtzOjIwOiJsaWdodHNvdXJjZV9mZWF0dXJlZCI7czoyOiJvbiI7czoyMToibGlnaHRzb3VyY2VfZHVwbGljYXRlIjtOO3M6MjA6ImxpZ2h0c291cmNlX2ZlYXRfY2F0IjtzOjEzOiJVbmNhdGVnb3JpemVkIjtzOjI5OiJsaWdodHNvdXJjZV9ob21lcGFnZV9mZWF0dXJlZCI7czoxOiIzIjtzOjE4OiJsaWdodHNvdXJjZV9yYW5kb20iO3M6Mjoib24iO3M6MTg6ImxpZ2h0c291cmNlX3JlY2VudCI7czoyOiJvbiI7czoyNDoibGlnaHRzb3VyY2VfcmFuZG9tX3Bvc3RzIjtzOjE6IjUiO3M6Mjc6ImxpZ2h0c291cmNlX3JlY2VudF9jb21tZW50cyI7czoyOiIxNSI7czoyNjoibGlnaHRzb3VyY2VfaG9tZXBhZ2VfcG9zdHMiO3M6MToiNiI7czoyNjoibGlnaHRzb3VyY2VfZXhsY2F0c19yZWNlbnQiO047czoyMToibGlnaHRzb3VyY2VfbWVudXBhZ2VzIjtOO3M6Mjg6ImxpZ2h0c291cmNlX2VuYWJsZV9kcm9wZG93bnMiO3M6Mjoib24iO3M6Mjk6ImxpZ2h0c291cmNlX3RpZXJzX3Nob3duX3BhZ2VzIjtzOjE6IjMiO3M6MjI6ImxpZ2h0c291cmNlX3NvcnRfcGFnZXMiO3M6MTA6InBvc3RfdGl0bGUiO3M6MjI6ImxpZ2h0c291cmNlX29yZGVyX3BhZ2UiO3M6MzoiYXNjIjtzOjIwOiJsaWdodHNvdXJjZV9tZW51Y2F0cyI7TjtzOjM5OiJsaWdodHNvdXJjZV9lbmFibGVfZHJvcGRvd25zX2NhdGVnb3JpZXMiO3M6Mjoib24iO3M6MzQ6ImxpZ2h0c291cmNlX3RpZXJzX3Nob3duX2NhdGVnb3JpZXMiO3M6MToiMyI7czoyMDoibGlnaHRzb3VyY2Vfc29ydF9jYXQiO3M6NDoibmFtZSI7czoyMToibGlnaHRzb3VyY2Vfb3JkZXJfY2F0IjtzOjM6ImFzYyI7czoyMzoibGlnaHRzb3VyY2Vfc3dhcF9uYXZiYXIiO047czoyNzoibGlnaHRzb3VyY2VfZGlzYWJsZV90b3B0aWVyIjtOO3M6MjE6ImxpZ2h0c291cmNlX2hvbWVfbGluayI7czoyOiJvbiI7czoyMjoibGlnaHRzb3VyY2VfdGh1bWJuYWlscyI7czoyOiJvbiI7czoyOToibGlnaHRzb3VyY2Vfc2hvd19wb3N0Y29tbWVudHMiO3M6Mjoib24iO3M6Mjc6ImxpZ2h0c291cmNlX3RodW1ibmFpbF93aWR0aCI7czozOiIyMDAiO3M6Mjg6ImxpZ2h0c291cmNlX3RodW1ibmFpbF9oZWlnaHQiO3M6MzoiMjAwIjtzOjIxOiJsaWdodHNvdXJjZV9wb3N0aW5mbzIiO2E6NDp7aTowO3M6NjoiYXV0aG9yIjtpOjE7czo0OiJkYXRlIjtpOjI7czoxMDoiY2F0ZWdvcmllcyI7aTozO3M6ODoiY29tbWVudHMiO31zOjI3OiJsaWdodHNvdXJjZV9wYWdlX3RodW1ibmFpbHMiO047czozMDoibGlnaHRzb3VyY2Vfc2hvd19wYWdlc2NvbW1lbnRzIjtOO3M6MzM6ImxpZ2h0c291cmNlX3RodW1ibmFpbF93aWR0aF9wYWdlcyI7czozOiIyMDAiO3M6MzQ6ImxpZ2h0c291cmNlX3RodW1ibmFpbF9oZWlnaHRfcGFnZXMiO3M6MzoiMjAwIjtzOjIxOiJsaWdodHNvdXJjZV9wb3N0aW5mbzEiO2E6NDp7aTowO3M6NjoiYXV0aG9yIjtpOjE7czo0OiJkYXRlIjtpOjI7czoxMDoiY2F0ZWdvcmllcyI7aTozO3M6ODoiY29tbWVudHMiO31zOjMyOiJsaWdodHNvdXJjZV90aHVtYm5haWxfdXN1YWx3aWR0aCI7czozOiIyMDAiO3M6MzM6ImxpZ2h0c291cmNlX3RodW1ibmFpbF91c3VhbGhlaWdodCI7czozOiIyMDAiO3M6MjU6ImxpZ2h0c291cmNlX2N1c3RvbV9jb2xvcnMiO047czoyMToibGlnaHRzb3VyY2VfY2hpbGRfY3NzIjtOO3M6MjQ6ImxpZ2h0c291cmNlX2NoaWxkX2Nzc3VybCI7czowOiIiO3M6MjU6ImxpZ2h0c291cmNlX2NvbG9yX2JnY29sb3IiO3M6MDoiIjtzOjI2OiJsaWdodHNvdXJjZV9jb2xvcl9tYWluZm9udCI7czowOiIiO3M6MjY6ImxpZ2h0c291cmNlX2NvbG9yX21haW5saW5rIjtzOjA6IiI7czoyNjoibGlnaHRzb3VyY2VfcG9zdGluZm9fY29sb3IiO3M6MDoiIjtzOjI2OiJsaWdodHNvdXJjZV9jb2xvcl9wYWdlbGluayI7czowOiIiO3M6MzI6ImxpZ2h0c291cmNlX2NvbG9yX3NpZGViYXJfdGl0bGVzIjtzOjA6IiI7czoyNToibGlnaHRzb3VyY2VfY29sb3JfaGVhZGluZyI7czowOiIiO3M6MjY6ImxpZ2h0c291cmNlX3Nlb19ob21lX3RpdGxlIjtOO3M6MzI6ImxpZ2h0c291cmNlX3Nlb19ob21lX2Rlc2NyaXB0aW9uIjtOO3M6Mjk6ImxpZ2h0c291cmNlX3Nlb19ob21lX2tleXdvcmRzIjtOO3M6MzA6ImxpZ2h0c291cmNlX3Nlb19ob21lX2Nhbm9uaWNhbCI7TjtzOjMwOiJsaWdodHNvdXJjZV9zZW9faG9tZV90aXRsZXRleHQiO3M6MDoiIjtzOjM2OiJsaWdodHNvdXJjZV9zZW9faG9tZV9kZXNjcmlwdGlvbnRleHQiO3M6MDoiIjtzOjMzOiJsaWdodHNvdXJjZV9zZW9faG9tZV9rZXl3b3Jkc3RleHQiO3M6MDoiIjtzOjI1OiJsaWdodHNvdXJjZV9zZW9faG9tZV90eXBlIjtzOjI3OiJCbG9nTmFtZSB8IEJsb2cgZGVzY3JpcHRpb24iO3M6Mjk6ImxpZ2h0c291cmNlX3Nlb19ob21lX3NlcGFyYXRlIjtzOjM6IiB8ICI7czoyODoibGlnaHRzb3VyY2Vfc2VvX3NpbmdsZV90aXRsZSI7TjtzOjM0OiJsaWdodHNvdXJjZV9zZW9fc2luZ2xlX2Rlc2NyaXB0aW9uIjtOO3M6MzE6ImxpZ2h0c291cmNlX3Nlb19zaW5nbGVfa2V5d29yZHMiO047czozMjoibGlnaHRzb3VyY2Vfc2VvX3NpbmdsZV9jYW5vbmljYWwiO047czozNDoibGlnaHRzb3VyY2Vfc2VvX3NpbmdsZV9maWVsZF90aXRsZSI7czo5OiJzZW9fdGl0bGUiO3M6NDA6ImxpZ2h0c291cmNlX3Nlb19zaW5nbGVfZmllbGRfZGVzY3JpcHRpb24iO3M6MTU6InNlb19kZXNjcmlwdGlvbiI7czozNzoibGlnaHRzb3VyY2Vfc2VvX3NpbmdsZV9maWVsZF9rZXl3b3JkcyI7czoxMjoic2VvX2tleXdvcmRzIjtzOjI3OiJsaWdodHNvdXJjZV9zZW9fc2luZ2xlX3R5cGUiO3M6MjE6IlBvc3QgdGl0bGUgfCBCbG9nTmFtZSI7czozMToibGlnaHRzb3VyY2Vfc2VvX3NpbmdsZV9zZXBhcmF0ZSI7czozOiIgfCAiO3M6MzE6ImxpZ2h0c291cmNlX3Nlb19pbmRleF9jYW5vbmljYWwiO047czozMzoibGlnaHRzb3VyY2Vfc2VvX2luZGV4X2Rlc2NyaXB0aW9uIjtOO3M6MjY6ImxpZ2h0c291cmNlX3Nlb19pbmRleF90eXBlIjtzOjI0OiJDYXRlZ29yeSBuYW1lIHwgQmxvZ05hbWUiO3M6MzA6ImxpZ2h0c291cmNlX3Nlb19pbmRleF9zZXBhcmF0ZSI7czozOiIgfCAiO3M6MzU6ImxpZ2h0c291cmNlX2ludGVncmF0ZV9oZWFkZXJfZW5hYmxlIjtzOjI6Im9uIjtzOjMzOiJsaWdodHNvdXJjZV9pbnRlZ3JhdGVfYm9keV9lbmFibGUiO3M6Mjoib24iO3M6Mzg6ImxpZ2h0c291cmNlX2ludGVncmF0ZV9zaW5nbGV0b3BfZW5hYmxlIjtzOjI6Im9uIjtzOjQxOiJsaWdodHNvdXJjZV9pbnRlZ3JhdGVfc2luZ2xlYm90dG9tX2VuYWJsZSI7czoyOiJvbiI7czoyODoibGlnaHRzb3VyY2VfaW50ZWdyYXRpb25faGVhZCI7czowOiIiO3M6Mjg6ImxpZ2h0c291cmNlX2ludGVncmF0aW9uX2JvZHkiO3M6MDoiIjtzOjM0OiJsaWdodHNvdXJjZV9pbnRlZ3JhdGlvbl9zaW5nbGVfdG9wIjtzOjA6IiI7czozNzoibGlnaHRzb3VyY2VfaW50ZWdyYXRpb25fc2luZ2xlX2JvdHRvbSI7czowOiIiO3M6MjQ6ImxpZ2h0c291cmNlX2ZvdXJzaXhlaWdodCI7TjtzOjIwOiJsaWdodHNvdXJjZV90d29maWZ0eSI7TjtzOjIyOiJsaWdodHNvdXJjZV9iYW5uZXJfNDY4IjtzOjU3OiJodHRwOi8vd3d3LmVsZWdhbnR0aGVtZXMuY29tL2ltYWdlcy9TdHVkaW9CbHVlLzQ2OHg2MC5naWYiO3M6MjY6ImxpZ2h0c291cmNlX2Jhbm5lcl80NjhfdXJsIjtzOjE6IiMiO3M6MzM6ImxpZ2h0c291cmNlX2Jhbm5lcl90d29maWZ0eV9pbWFnZSI7czo2NzoiaHR0cDovL3d3dy5lbGVnYW50d29yZHByZXNzdGhlbWVzLmNvbS9pbWFnZXMvU3R1ZGlvQmx1ZS8yNTB4MjUwLmdpZiI7czozMToibGlnaHRzb3VyY2VfYmFubmVyX3R3b2ZpZnR5X3VybCI7czoxOiIjIjt9';

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