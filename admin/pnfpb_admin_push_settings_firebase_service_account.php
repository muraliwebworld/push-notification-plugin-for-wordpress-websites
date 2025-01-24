<?php
/*
* Firebase service account upload and configuration settings for push notification
* @Since 2.08
*/
?>

<h2 class="pnfpb_ic_push_settings_header2"><?php echo esc_html(
    __("Firebase API httpv1", "push-notification-for-post-and-buddypress")
); ?></h2>

<p><?php echo wp_kses_post(
    __(
        "(Enable below option to use latest version of Firebase API - http v1. Recommended PHP version for this is 8.0 or above. It will work with PHP version 7.4 but recommended PHP version is 8.0 to use latest version of Firebase API httpv1)",
        "push-notification-for-post-and-buddypress"
    )
); ?></p>
<p><?php echo wp_kses_post(
    __(
        "(It requires service account json file to be uploaded)",
        "push-notification-for-post-and-buddypress"
    )
); ?></p>
<p><?php echo wp_kses_post(
    __(
        "(In the Firebase console, open Settings > Service Accounts.Click Generate New Private Key, then confirm by clicking Generate Key.Download & store the JSON file containing the key. Select service account json file in below field , Plugin will read and update required data in database for push notification. Physical file will not be stored.)",
        "push-notification-for-post-and-buddypress"
    )
); ?></p>	
<h2 class="pnfpb_ic_push_settings_header2"><?php echo esc_html(
    __(
        "Upload Service account json file for latest version of Firebase API httpv1",
        "push-notification-for-post-and-buddypress"
    )
); ?></h2>

<div class="pnfpb_row">
	<div class="pnfpb_column_full">
		<table class="pnfpb_ic_push_firebase_settings_table widefat fixed">
    		<tbody>
				<tr class="pnfpb_ic_push_settings_table_row">
            		<td class="pnfpb_ic_push_settings_table_column column-columnname">
						<div class="pnfpb_row">
							<div class="pnfpb_column_400">
    							<div class="pnfpb_card">
									<label class="pnfpb_ic_push_settings_table_label_checkbox 
												  pnfpb_flex_grow_6 pnfpb_padding_top_8 
												  pnfpb_max_width_236" 
										   for="pnfpb_ic_fcm_latest_firebase_v1_enable">
											<?php echo esc_html(
              									__(
                  									"Firebase api httpv1",
                  									"push-notification-for-post-and-buddypress"
              									)
          									); ?>
									</label>
									<label class="pnfpb_switch pnfpb_flex_grow_1 
												  pnfpb_margin_top_8 pnfpb_margin_left_4 
												  pnfpb_max_width_40">
										<input  id="pnfpb_httpv1_push" 
											   name="pnfpb_httpv1_push" 
											   type="checkbox" 
											   value="1" <?php checked(
              												"1",
              												get_option("pnfpb_httpv1_push")
          												); ?>  />	
										<span class="pnfpb_slider round"></span>
									</label>								
								</div>
							</div>
							<div class="pnfpb_column_400">
								<label for="pnfpb_icfcm_service_account_upload">Select service account json file</label>
								<input type="file"  style="width: 90px" 
									   name="pnfpb_icfcm_service_account_upload" 
									   id="pnfpb_icfcm_service_account_upload" 
									   class="pnfpb_icfcm_service_account_upload" />
								<?php if ($pnfpb_sa) {
            							echo "<div class='pnfpb_icfcm_service_account_upload_message'><b>" .
                						esc_html(
                    						__(
                        						"Service account file already uploaded. If you want to update it, select new file",
                        						"push-notification-for-post-and-buddypress"
                    						)
                						) .
                						"</b></div>";
        							} else {
            							echo "<div class='pnfpb_icfcm_service_account_upload_message'><b>" .
                						esc_html(
                    							__(
                        							"Service account data not available. Upload now",
                        							"push-notification-for-post-and-buddypress"
                    							)
                						) .
                							"</b></div>";
        							} ?>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>