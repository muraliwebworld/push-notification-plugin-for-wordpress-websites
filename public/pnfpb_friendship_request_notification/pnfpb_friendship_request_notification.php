<?php

		/**
		* Triggered after friendship request sent for user in BuddyPress.
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
        
			if (get_option('pnfpb_ic_fcm_friendship_request_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false) || (get_option('pnfpb_ic_fcm_friendship_request_enable') == 1 && (get_option( 'pnfpb_onesignal_push' ) === '1' || get_option('pnfpb_httpv1_push') === '1' || get_option('pnfpb_progressier_push') === '1' || get_option('pnfpb_webtoapp_push') === '1'))) {
				
				global $wpdb;
	
				$friendship_initiator_name = bp_core_get_user_displayname( $initiator_id );
				
				$friend_name = bp_core_get_user_displayname( $friend_id );

				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
				$url = 'https://fcm.googleapis.com/fcm/send';

				$activity_content_push = $friendship_initiator_name.__(' sent you friendship request','PNFPB_TD');
				
				$notificationtitle = '[friendship initiator name]'.__(' sent you friend request','PNFPB_TD');
				
				$titletext = get_option('pnfpb_ic_fcm_friendship_request_text');
				
				if ( $titletext && $titletext !== '') {
					$notificationtitle = str_replace("[friendship initiator name]", $friendship_initiator_name, $titletext);
				}
				
				$activity_content_push = str_replace("[friendship initiator name]", $friendship_initiator_name, $activity_content_push);
				
				if (function_exists('bp_members_get_user_url')) {
				
					$messageurl = esc_url( bp_members_get_user_url( $friend_id ) . bp_get_friends_slug() . '/requests/');
						
				} else {
						
					$messageurl = esc_url( bp_core_get_user_domain( $friend_id ) . bp_get_friends_slug() . '/requests/');
				}				
				
				$imageurl = '';
					
				$iconurl =	bp_core_fetch_avatar ( 
    							array(  'item_id'   => $initiator_id,       // output user id of post author
            							'type'      => 'full',
            							'html'      => FALSE       // FALSE = return url, TRUE (default) = return url wrapped with html
								  
   									 ) 
								);
				
				if (get_option('pnfpb_progressier_push') === '1') {
					
					$target_userid = $friend_id;
					
					$pushtype = 'friendshiprequest';
					
					$target_userid_array_values=$wpdb->get_col( "SELECT device_id FROM {$table_name} WHERE userid = '{$friend_id}' AND device_id LIKE '%progressier%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,7,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );
					
					if (count($target_userid_array_values) > 0) {
						
						$response = $this->PNFPB_icfcm_progressier_send_push_notification(0,$notificationtitle,$activity_content_push,$messageurl,$iconurl,$target_userid_array_values[0],$pushtype);
						
					}
					
				}
				
				if (get_option('pnfpb_webtoapp_push') === '1') {
					
					$target_userid = $friend_id;
					
					$pushtype = 'friendshiprequest';
					
					$target_userid_array_values=$wpdb->get_col( "SELECT device_id FROM {$table_name} WHERE userid = '{$friend_id}' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,7,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );
					
					if (count($target_userid_array_values) > 0) {
						
						$response = $this->PNFPB_icfcm_webtoapp_send_push_notification(0,$notificationtitle,$activity_content_push,$messageurl,$iconurl,$target_userid_array_values,$pushtype);
						
					}
					
				}				
				
				if (get_option('pnfpb_onesignal_push') === '1' && get_option('pnfpb_progressier_push') !== '1') {
					
					$target_userid_array = array();
					
					if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
							
						$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE userid = '{$friend_id}' AND device_id LIKE '%onesignal%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,7,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );
						
					} else {
						
						$target_userid_array_values = array("$friend_id");
					}
					
					if (count($target_userid_array_values) > 0) {						
						$target_userid_array = array_map(function ($value) {
    						return $value == 1 ? '1pnfpbadm' : $value;
						}, $target_userid_array_values);					
						
						$response = $this->PNFPB_icfcm_onesignal_push_notification($initiator_id,$notificationtitle,$activity_content_push,$messageurl,$iconurl,$target_userid_array);
					}
							
				} else {
					
					if (get_option('pnfpb_progressier_push') !== '1' ) {
				
						if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {

						$deviceids=$wpdb->get_col( "SELECT DISTINCT(SUBSTRING_INDEX(device_id, '!!', 1)) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND userid = '{$friend_id}' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,7,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) ORDER BY id DESC LIMIT 1000"  );
						
						} else {
						
							$deviceids=$wpdb->get_col( "SELECT DISTINCT(SUBSTRING_INDEX(device_id, '!!', 1)) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND userid = '{$friend_id}' ORDER BY id DESC LIMIT 1000"  );
						
						}
					
						$webview = false;
									
						$pushtype = 'friendshiprequest';

						if (count($deviceids) > 0) {

							$regid = $deviceids;
						
						
							if (get_option('pnfpb_ic_fcm_friendship_request_content') != false && get_option('pnfpb_ic_fcm_friendship_request_content') != '') {
								$activity_content_push = get_option('pnfpb_ic_fcm_friendship_request_content');
							}

							if (get_option('pnfpb_httpv1_push') === '1') {
								$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																		$notificationtitle,
																		mb_substr(stripslashes(strip_tags(trim($activity_content_push))),0,130, 'UTF-8'),
																		$iconurl,
																		$iconurl,
																		$messageurl,
																		array('click_url' => $messageurl),
																		$regid,
																		array(),
																		$initiator_id,
																		$friend_id,
																		$pushtype
																		);
							}
							else {						
								$this->PNFPB_icfcm_legacy_send_push_notification(0,
																		$notificationtitle,
																		mb_substr(stripslashes(strip_tags(trim($activity_content_push))),0,130, 'UTF-8'),
																		$iconurl,
																		$iconurl,
																		$messageurl,
																		array('click_url' => $messageurl),
																		$regid,
																		array(),
																		$initiator_id,
																		$friend_id,
																		$pushtype
																		);
							}

							do_action('PNFPB_connect_to_external_api_for_friend_request');
						}
					}
				}
			}

?>