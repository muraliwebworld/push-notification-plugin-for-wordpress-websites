<?php
?>
	<h1 class="pnfpb_ic_push_settings_header">
				<?php echo esc_html(
       __(
           "PNFPB - settings for NGNIX server",
           "push-notification-for-post-and-buddypress"
       )
   ); ?></h1>
	<?php
		$pnfpb_tab_nginx_active = "nav-tab-active";
		require_once( plugin_dir_path( __FILE__ ) . 'push_admin_menu_list.php' );
	?>
			<div class="pnfpb_column_1200">	
				<h1 class="pnfpb_ic_push_settings_header"><?php echo esc_html(
        __(
            "Settings for NGINX based server/hosting",
            "push-notification-for-post-and-buddypress"
        )
    ); ?></h1>

		<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
	
    				<?php settings_fields("pnfpb_icfcm_nginx"); ?>
				
    				<?php do_settings_sections("pnfpb_icfcm_nginx"); ?>
				
					<?php if (get_option("pnfpb_ic_nginx_static_files_enable") != "1") {
         global $wp_filesystem;

         if (empty($wp_filesystem)) {
             require_once trailingslashit(ABSPATH) .
                 "wp-admin/includes/file.php";
             WP_Filesystem();
         }

         $swresponse = wp_remote_head(
             home_url("/") . "pnfpb_icpush_pwa_sw.js",
             ["sslverify" => false]
         );

         $swresponse_code = wp_remote_retrieve_response_code($swresponse);

         if (200 === $swresponse_code) {
             $createfileresult = $wp_filesystem->delete(
                 trailingslashit(get_home_path()) . "pnfpb_icpush_pwa_sw.js"
             );
         }

         $firebase_swresponse = wp_remote_head(
             home_url("/") . "firebase-messaging-sw.js",
             ["sslverify" => false]
         );

         $firebase_swresponse_code = wp_remote_retrieve_response_code(
             $firebase_swresponse
         );

         if (200 === $firebase_swresponse_code) {
             $createfileresult = $wp_filesystem->delete(
                 trailingslashit(get_home_path()) . "firebase-messaging-sw.js"
             );
         }

         if (get_option("pnfpb_ic_pwa_app_enable") === "1") {
             $pwa_manifest_response = wp_remote_head(
                 home_url("/") . "pnfpbmanifest.json",
                 ["sslverify" => false]
             );

             $pwa_manifest_response_code = wp_remote_retrieve_response_code(
                 $pwa_manifest_response
             );

             if (200 === $pwa_manifest_response_code) {
                 $createfileresult = $wp_filesystem->delete(
                     trailingslashit(get_home_path()) . "pnfpbmanifest.json"
                 );
             }
         }
     } ?>
	
					<ul>
					
						<li><?php echo esc_html(PNFPB_PLUGIN_NGINX_SETTINGS_DESCRIPTION); ?></li>
					
					</ul>
				
					<table class="pnfpb_ic_push_settings_table widefat fixed">
    					<tbody>
							<tr class="pnfpb_ic_push_settings_table_row">
								<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
									<div class="pnfpb_row">
  										<div class="pnfpb_column_400">
    										<div class="pnfpb_card">									
												<label for="pnfpb_ic_nginx_static_files_enable">
													<?php echo esc_html(
                 __(
                     "Enable/Disable static service worker and PWA manifest files",
                     "push-notification-for-post-and-buddypress"
                 )
             ); ?>
												</label>
												<label class="pnfpb_switch">
													<input  id="pnfpb_ic_nginx_static_files_enable" name="pnfpb_ic_nginx_static_files_enable" type="checkbox" value="1" <?php checked(
                 "1",
                 esc_attr(get_option("pnfpb_ic_nginx_static_files_enable"))
             ); ?>  />
													<span class="pnfpb_slider round"></span>
												</label>
											</div>
										</div>
									</div>
								</td>
							</tr>
    						<tr  class="pnfpb_ic_push_settings_table_row">
								<td class="column-columnname">
									<div class="pnfpb_column_full"><?php submit_button(
             __("Save changes", "push-notification-for-post-and-buddypress"),
             "pnfpb_ic_push_save_configuration_button"
         ); ?></div>
									<ul>
					
										<li><?php echo esc_html(PNFPB_PLUGIN_NGINX_SETTINGS_DESCRIPTION2); ?></li>
					
									</ul>
									<ul>
					
										<li><?php echo esc_html(
              __(
                  "If Push notification admin settings or PWA admin settings are changed then regenerate service worker file by switching off this option, save changes, switch on again and save the changes again, so that service worker file and PWA manifest files will be regenerated",
                  "push-notification-for-post-and-buddypress"
              )
          ); ?></li>
					
									</ul>									
								</td>							
    						</tr>							
						</tbody>
					</table>
				</form>
			</div>
<?php

?>