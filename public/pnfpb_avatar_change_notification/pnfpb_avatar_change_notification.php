<?php

		/**
		* Triggered after avatar change sent for user in BuddyPress.
		* to send push notifications Opt in/out for the notification can be 
		* controlled from plugin settings.		
		*
		*
		* @param array   $raw_args		Message content array
		*
		*
		* @since 1.47
		*/
            $apiaccesskey = get_option('pnfpb_ic_fcm_google_api');		    
        
			if (get_option('pnfpb_ic_fcm_avatar_change_enable') == 1 && get_option('pnfpb_progressier_push') !== '1' && ($apiaccesskey != '' && $apiaccesskey != false) || (get_option('pnfpb_ic_fcm_avatar_change_enable') == 1 &&  (get_option( 'pnfpb_onesignal_push' ) === '1' || get_option('pnfpb_httpv1_push') === '1'))) {
				
				global $wpdb;
				
				$deviceidswebview = array();
				
				$deviceids = array();				
				
				$member_name = bp_core_get_user_displayname( $user_id );

				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
				$url = 'https://fcm.googleapis.com/fcm/send';

				$activity_content_push = '';
				
				$notificationtitle = $member_name.__(' updated avatar','PNFPB_TD');
				
				$titletext = get_option('pnfpb_ic_fcm_avatar_change_text');
				
				if ( $titletext && $titletext !== '') {
					$notificationtitle = str_replace("[member name]", $member_name, $titletext);
				}
				
				$activity_content_push = str_replace("[member name]", $member_name, $activity_content_push);
				
				if (function_exists('bp_members_get_user_url')) {
				
					$messageurl = esc_url( bp_members_get_user_url( $user_id ));
						
				} else {
						
					$messageurl = esc_url( bp_core_get_user_domain( $user_id ));
				}				
				
				$imageurl = '';
					
				$iconurl =	bp_core_fetch_avatar ( 
    						array(  'item_id'   => $user_id,       // output user id of post author
            						'type'      => 'full',
            						'html'      => FALSE        // FALSE = return url, TRUE (default) = return url wrapped with html
							  
   									) 
							);				
				
				if (get_option('pnfpb_onesignal_push') === '1') {
					
					$target_userid_array = array();
					
					if ((get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') || (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1')) {
						
							$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE device_id LIKE '%onesignal%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,9,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );
						
							$target_userid_array = array_map(function ($value) {
    							return $value == 1 ? '1pnfpbadm' : $value;
							}, $target_userid_array_values);						
					}
					
					$response = $this->PNFPB_icfcm_onesignal_push_notification($user_id,$notificationtitle,$activity_content_push,$messageurl,$iconurl,$target_userid_array);
							
				} else {
					
					if (get_option('pnfpb_httpv1_push') !== '1') {
				
						if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,9,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );							
							} else {
								$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,9,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
							}
						
						} else  {
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );
							} else {
								$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );
							}
						
						}
					
						$webview = false;
						if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,9,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );							
							} else {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,9,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 1000"  );
							}
						} else {
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );							
							} else {
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' LIMIT 1000"  );
							}
						}
						
					}
				

					$regid = $deviceids;
						
					if (get_option('pnfpb_ic_fcm_avatar_change_content') != false && get_option('pnfpb_ic_fcm_avatar_change_content') != '') {
							$activity_content_push = get_option('pnfpb_ic_fcm_avatar_change_content');
					}
					
					if (get_option('pnfpb_httpv1_push') === '1') {
								$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																$notificationtitle,
																mb_substr(stripslashes(strip_tags(trim($activity_content_push))),0,130, 'UTF-8'),
																$iconurl,
																$imageurl,
																$messageurl,
																array('click_url' => $messageurl),
																array(),
																array(),
																$user_id,
																0,
																'avatarchange'
																);
						}
						else {
							if (count($deviceids) > 0) {
								$this->PNFPB_icfcm_legacy_send_push_notification(0,
																$notificationtitle,
																mb_substr(stripslashes(strip_tags(trim($activity_content_push))),0,130, 'UTF-8'),
																$iconurl,
																$iconurl,
																$messageurl,
																array(),
																$deviceids,
																array(),
																$user_id,
																0
																);
							}
						}

						do_action('PNFPB_connect_to_external_api_for_avatar_change');

					if (count($deviceidswebview) > 0 && get_option('pnfpb_httpv1_push') !== '1' && get_option('pnfpb_onesignal_push') !== '1') {

						$regid = $deviceidswebview;
						
						
						if (get_option('pnfpb_ic_fcm_avatar_change_content') != false && get_option('pnfpb_ic_fcm_avatar_change_content') != '') {
							$activity_content_push = get_option('pnfpb_ic_fcm_avatar_change_content');
						}

						$this->PNFPB_icfcm_legacy_send_push_notification(0,
																$notificationtitle,
																mb_substr(stripslashes(strip_tags(trim($activity_content_push))),0,130, 'UTF-8'),
																$iconurl,
																$iconurl,
																"",
																array('click_url' => $messageurl),
																array(),
																$deviceidswebview,
																$user_id,
																0
																);
						do_action('PNFPB_connect_to_external_api_for_avatar_change_webview');
					}
				}
			}

?>