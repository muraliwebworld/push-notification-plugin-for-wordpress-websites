<?php

		/**
		* Triggered after private messages sent for user in BuddyPress.
		* to send push notifications Opt in/out for the notification can be 
		* controlled from plugin settings.		
		*
		*
		* @param array   $raw_args		Message content array
		*
		*
		* @since 1.13
		*/

            $apiaccesskey = get_option('pnfpb_ic_fcm_google_api');		    
        
			if (get_option('pnfpb_ic_fcm_bprivatemessage_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false) || (get_option('pnfpb_ic_fcm_bprivatemessage_enable') == 1 && (get_option( 'pnfpb_onesignal_push' ) === '1' || get_option('pnfpb_httpv1_push') === '1' || get_option('pnfpb_progressier_push') === '1' || get_option('pnfpb_webtoapp_push') === '1'))) {
				
				global $wpdb;
				
				if ( is_object( $raw_args ) ) {
					$args = (array) $raw_args;
				} else {
					$args = $raw_args;
				}
		
				// These should be extracted below.
				$recipients    = array();
				$email_subject = $email_content = '';
				$sender_id     = 0;
		
				// Barf.
				extract( $args );
				
				//print_r($args);
		
				if ( empty( $recipients ) ) {
					return;
				}
				
	
				// Send an email to each recipient.
				foreach ( $recipients as $recipient ) {

					$sender_name = '';

					$sender_name = bp_core_get_user_displayname( $sender_id );

					if ( isset( $message ) ) {
						$message = wpautop( $message );
					} else {
						$message = '';
					}

					$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
					$url = 'https://fcm.googleapis.com/fcm/send';

					//$activity_content_push = strip_tags(urldecode($message));
					$activity_content_push = $message;
				
					$notificationtitle = $sender_name.__(' sent you private message','PNFPB_TD');
				
					$titletext = get_option('pnfpb_ic_fcm_bprivatemessage_text');
				
					if ( $titletext && $titletext !== '') {
						$notificationtitle = str_replace("[sender name]", $sender_name, $titletext);
					}
				
					$activity_content_push = str_replace("[sender name]", $sender_name, $activity_content_push);
				
					$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
					
					if (function_exists('bp_members_get_user_url')) {
				
						$messageurl = esc_url( bp_members_get_user_url( $recipient->user_id ).bp_get_messages_slug().'/view/'.$thread_id.'/');
						
					} else {
						
						$messageurl = esc_url( bp_core_get_user_domain( $recipient->user_id ).bp_get_messages_slug().'/view/'.$thread_id.'/');
					}					
				
					$imageurl = '';
					
					$iconurl =	bp_core_fetch_avatar ( 
    							array(  'item_id'   => $sender_id,       // output user id of post author
            							'type'      => 'full',
            							'html'      => FALSE    // FALSE = return url, TRUE (default) = return url wrapped with html
   									 ) 
								);
								
					if (get_option('pnfpb_progressier_push') === '1') {
						
						$target_userid = $recipient->user_id;
						
						$pushtype = 'privatemessages';
						
						$target_userid_array_values=$wpdb->get_col( "SELECT device_id FROM {$table_name} WHERE userid = '{$recipient->user_id}' AND device_id LIKE '%progressier%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );
					
						if (count($target_userid_array_values) > 0) {						
					
							$response = $this->PNFPB_icfcm_progressier_send_push_notification(0,$notificationtitle,$activity_content_push,$messageurl,$iconurl,$target_userid_array_values[0],$pushtype);
							
						}
					
					}
					
					if (get_option('pnfpb_webtoapp_push') === '1') {
						
						$target_userid = $recipient->user_id;
						
						$pushtype = 'privatemessages';
						
						$target_userid_array_values=$wpdb->get_col( "SELECT device_id FROM {$table_name} WHERE userid = '{$recipient->user_id}' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );
					
						if (count($target_userid_array_values) > 0) {						
					
							$response = $this->PNFPB_icfcm_webtoapp_send_push_notification(0,$notificationtitle,$activity_content_push,$messageurl,$iconurl,$target_userid_array_values,$pushtype);
							
						}
					
					}					
				
					if (get_option('pnfpb_onesignal_push') === '1' && get_option('pnfpb_progressier_push') !== '1') {
						
						if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						
							$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE userid = '{$recipient->user_id}' AND device_id LIKE '%onesignal%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );
							
						} else {
							
							$target_userid_array_values = array("$recipient->user_id");
						}
						
						if (count($target_userid_array_values) > 0) {
							
							$target_userid_array = array_map(function ($value) {
    							return $value == 1 ? '1pnfpbadm' : $value;
							}, $target_userid_array_values);						
						
							$response = $this->PNFPB_icfcm_onesignal_push_notification($sender_id,$notificationtitle,$activity_content_push,$messageurl,$iconurl,$target_userid_array);
							
						}
							
					} else {				
						
						if (get_option('pnfpb_progressier_push') !== '1' ) {
					
							if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
							$deviceids=$wpdb->get_col( "SELECT DISTINCT(SUBSTRING_INDEX(device_id, '!!', 1)) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND userid = '{$recipient->user_id}' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) ORDER BY id DESC LIMIT 1000"  );
							} else {
								$deviceids=$wpdb->get_col( "SELECT DISTINCT(SUBSTRING_INDEX(device_id, '!!', 1)) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND userid = '{$recipient->user_id}' ORDER BY id DESC LIMIT 1000"  );
							}
					
					
							$webview = false;
											
							$pushtype = 'privatemessages';
						
							if (count($deviceids) > 0) {

								$regid = $deviceids;
						
						
								if (get_option('pnfpb_ic_fcm_bprivatemessage_content') != false && get_option('pnfpb_ic_fcm_bprivatemessage_content') != '') {
									$activity_content_push = get_option('pnfpb_ic_fcm_bprivatemessage_content');
								}
							
								if (get_option('pnfpb_httpv1_push') === '1') {
									$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			$notificationtitle,
																			mb_substr(stripslashes(strip_tags(trim($activity_content_push))),0,130, 'UTF-8'),
																			$iconurl,
																			$iconurl,
																			$messageurl,
																			array('thread_id' => strval($thread_id),'click_url' => $messageurl),
																			$regid,
																			array(),
																			$sender_id,
																			$recipient->user_id,
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
																			array('thread_id' => $thread_id,'click_url' => $messageurl),
																			$regid,
																			array(),
																			$sender_id,
																			$recipient->user_id,
																			$pushtype
																			);
								}

								do_action('PNFPB_connect_to_external_api_for_private_messages');
							}
				
						}
					}
				}
			}


?>