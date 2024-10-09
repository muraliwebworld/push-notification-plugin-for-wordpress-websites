<?php

		/*
		 * 
		 * 
		 * Push Notification when Group details updated
		 * 
		 * @since 1.58  
		 */
			global $wpdb;

			$apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
			
			$imageurl = '';

			$deviceids = array();

			$deviceidswebview = array();

			$deviceids_webview_count = 0;
			
			$group_name = bp_get_group_name( groups_get_group( $group_id));
			
			if (function_exists('bp_get_group_url')) {
				
				$group_link = bp_get_group_url( groups_get_group( $group_id));
				
			} else {
			
				$group_link = bp_get_group_permalink( groups_get_group( $group_id));
				
			}
			
			$group_image = bp_get_group_avatar_url( groups_get_group( $group_id));
				
			if (get_option('pnfpb_ic_fcm_group_details_updated_enable') == 1 && get_option('pnfpb_progressier_push') !== '1' && ($apiaccesskey != '' && $apiaccesskey != false) || (get_option('pnfpb_ic_fcm_group_details_updated_enable') == 1 && (get_option( 'pnfpb_onesignal_push' ) === '1' || get_option('pnfpb_httpv1_push') === '1'))) {
				
				$bpgroup = '';
					
				$bpgroupid = null;

				if ($group_id) {

					$bpgroupid = $group_id;
						
				}
				
				$blog_title = get_bloginfo( 'name' );
            
				if (get_option('pnfpb_ic_fcm_buddypress_group_details_updated_text_enable') != false && get_option('pnfpb_ic_fcm_buddypress_group_details_updated_text_enable') != '') {
						$grouptitle = get_option('pnfpb_ic_fcm_buddypress_group_details_updated_text_enable');
				}
				else
				{
						$grouptitle = __('Group update ','PNFPB_TD').$group_name;
				}
					
				$grouptitle = str_replace("[group name]", $group_name, $grouptitle);
					
					
				if (get_option('pnfpb_ic_fcm_buddypress_group_details_updated_content_enable') != false && get_option('pnfpb_ic_fcm_buddypress_group_details_updated_content_enable') != '') {
						
					$localactivitycontent = get_option('pnfpb_ic_fcm_buddypress_group_details_updated_content_enable');
						
				}	
				else 
				{						
					$localactivitycontent = $group_name.__(" group details updated",'PNFPB_TD');
				}
					
				$localactivitycontent = str_replace("[group name]", $group_name, $localactivitycontent);				
				
				if (get_option('pnfpb_onesignal_push') === '1') {
					
					$target_userid_array = array();
					
					if ((get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') || (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1')) {
						
						$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE device_id LIKE '%onesignal%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );
						
						$target_userid_array = array_map(function ($value) {
    						return $value == 1 ? '1pnfpbadm' : $value;
						}, $target_userid_array_values);						
					}

					$response = $this->PNFPB_icfcm_onesignal_push_notification($group_id,$grouptitle,$localactivitycontent,$group_link,$group_image,$target_userid_array);
							
				} else {
					
					if (get_option('pnfpb_httpv1_push') !== '1') {
	
					$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
					
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						
							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1 OR subscription_option = '' OR subscription_option IS NULL) = '1')" );
						
					}
					else				
					{

							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%'" );
							
					}
					
					$webview = false;
					
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
					
							$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );	
						
					}
					else {
						
						$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%'" );							
					}
					
					
						if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
								if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
									$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
								} else {
									$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
								}
						}
						else				
						{

							if (get_option('pnfpb_shortcode_enable') === 'yes') {
									if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );										
									} else {
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
									}
						
								}							
								else 
								{
									if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' LIMIT {$dcount}, 1000" );										
									} else {
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' LIMIT {$dcount}, 1000" );
									}
								
								}
						}
						}
					

						$url = 'https://fcm.googleapis.com/fcm/send';

						$regid = $deviceids;
 
						if (get_option('pnfpb_httpv1_push') === '1') {
									$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																	$grouptitle,
																	stripslashes(strip_tags($localactivitycontent)),
																	$group_image,
																	$group_image,
																	$group_link,
																	array('click_url' => $group_link),
																	array(),
																	array(),
																	$group_id,
																	0,
																	'groupdetailsupdate'
																	);
						}
						else {
							if (count($regid) > 0) {
									$this->PNFPB_icfcm_legacy_send_push_notification(0,
																	$grouptitle,
																	stripslashes(strip_tags($localactivitycontent)),
																	$group_image,
																	$group_image,
																	$group_link,
																	array(),
																	$regid,
																	array(),
																	$group_id,
																	0			 
																	);
							}
							
						}
					do_action('PNFPB_connect_to_external_api_for_group_details_updated_notification');
					
					if (get_option('pnfpb_httpv1_push') !== '1' && get_option('pnfpb_onesignal_push') !== '1') {
					
						$webview = false;
						
						if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
							
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );								
							} else {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
							}
						}
						else 
						{
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' LIMIT {$dcount}, 1000" );								
							} else {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id LIKE '%!!{$bpgroupid}!!%' LIMIT {$dcount}, 1000" );
							}
						}
				
						if (count($deviceidswebview) > 0) {
							// prepare the message
							$this->PNFPB_icfcm_legacy_send_push_notification(0,
																	$grouptitle,
																	stripslashes(strip_tags($localactivitycontent)),
																	$group_image,
																	$group_image,
																	"",
																	array('click_url' => $group_link),
																	array(),
																	$deviceidswebview,
																	$group_id,
																	0			 
																	);
							do_action('PNFPB_connect_to_external_api_for_group_details_updated_notification');
						}
				
					}
				}
			}

?>