<?php

		/**
		* Triggered after creating activity in BuddyPress to send push notifications
		* Opt in/out for the notification can be controlled from plugin settings.
		*
		* @param string   $activity_content Activity content
		* @param numeric  $user_id 			USER ID
		* @param numeric  $activity_id		Activity ID
		*
		*
		* @since 1.0.0
		*/
			$apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
			
			$bactivity = 0;
			
			if (get_option('pnfpb_ic_fcm_bactivity_enable')) {
				$bactivity = get_option('pnfpb_ic_fcm_bactivity_enable');
			}
			else 
			{
				if (false === get_option('pnfpb_ic_fcm_bactivity_enable')) {
					$bactivity = 1;
				}
				else 
				{
					$bactivity = 0;
				}
			}

			$deviceidswebview = array();
				
			$deviceids = array();



			if ((( 
				($activity_content && (false === as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ))) || (!$activity_content && (as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' ))))) && (($bactivity == 1 && get_option('pnfpb_ic_fcm_buddypress_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false)) || ($bactivity == 1 && get_option('pnfpb_ic_fcm_buddypress_enable') == 1 && (get_option( 'pnfpb_onesignal_push' ) === '1' || get_option('pnfpb_httpv1_push') === '1' || get_option('pnfpb_progressier_push') === '1' || get_option('pnfpb_webtoapp_push') === '1')))) {

				global $wpdb;
				
				$blog_title = get_bloginfo( 'name' );

				$activitylink = get_home_url();
				if (function_exists('bp_is_active')){
					$activitylink = get_home_url().'/'.buddypress()->pages->activity->slug;
				}
				
				if ($activity_id) {
					
					$activitylink = bp_activity_get_permalink($activity_id);
					
				}
	
				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
				
				if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1' && get_option( 'pnfpb_onesignal_push' ) !== '1') {
					if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
						$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );						
					} else {
						$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
					}
				}
				else 
				{
						
					if (get_option('pnfpb_shortcode_enable') === 'yes'  && get_option( 'pnfpb_onesignal_push' ) !== '1') {
						if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );							
						} else {
							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
						}
					}
					else 
					{
						if ( get_option( 'pnfpb_onesignal_push' ) !== '1' && get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%'" );							
						} else {
							$deviceids_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%'" );
						}
					}
				}
				
	
				if ($activity_content) {
					
					$localactivitycontent = $activity_content;
					
				}
				else 
				{
					$cron_get_scheduled_activities = bp_activity_get( $args = array('per_page' => 1,'sort'=> 'DESC') );
					
					foreach ( $cron_get_scheduled_activities['activities'] as $activity ) {
							
						$localactivitycontent = mb_substr(stripslashes(strip_tags(urldecode(trim($activity->content)))),0,80, 'UTF-8');

						$activitylink = bp_activity_get_permalink( $activity->id, $activity );
								
						$user_id = $activity->user_id;
					}
				}				
				$imageurl = '';
				
				$activitytitle = '[member name]'.__(' posted new activity in ','PNFPB_TD').$blog_title;
				
				$sender_name = '';
			
				if (get_option('pnfpb_ic_fcm_activity_title') != false && get_option('pnfpb_ic_fcm_activity_title') != '') {
					
					$activitytitle = get_option('pnfpb_ic_fcm_activity_title');
					
				}
				
				if ($user_id !== null) {
					
					$sender_name = bp_core_get_user_displayname( $user_id );
					
					$activitytitle = str_replace("[member name]", $sender_name, $activitytitle);
					
				}				
		
			
				
				if (get_option('pnfpb_ic_fcm_activity_message') != false && get_option('pnfpb_ic_fcm_activity_message') != '') {
					
					if ($activity_content) {
						$localactivitycontent = get_option('pnfpb_ic_fcm_activity_message');
					} else {
						$localactivitycontent .= get_option('pnfpb_ic_fcm_activity_message');
					}
					
				}
				
				if ($localactivitycontent) {
					preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($localactivitycontent), $imgresult);
					
				
					if (is_array($imgresult)) {
						if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
							$imageurl = str_replace('"','',$imgresult[2][0]);
							$imageurl = stripslashes($imageurl);
						}
					}
				}
					
				$localactivitycontent = str_replace("[member name]", $sender_name, $localactivitycontent);
				
				if (get_option('pnfpb_progressier_push') === '1') {
					
					$target_userid_array_values=$wpdb->get_col( "SELECT device_id FROM {$table_name} WHERE device_id LIKE '%progressier%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );					
						
					$response = $this->PNFPB_icfcm_progressier_send_push_notification(0,$activitytitle,$localactivitycontent,$activitylink,$imageurl,0,'',$target_userid_array_values);
					
				}
				
				if (get_option('pnfpb_webtoapp_push') === '1') {
					
					$target_userid_array_values=$wpdb->get_col( "SELECT device_id FROM {$table_name} WHERE (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );					
						
					$response = $this->PNFPB_icfcm_webtoapp_send_push_notification(0,$activitytitle,$localactivitycontent,$activitylink,$imageurl,0,'',$target_userid_array_values);
					
				}				
				
				if (get_option('pnfpb_onesignal_push') === '1' && get_option('pnfpb_progressier_push') !== '1') {
				
					$target_userid = 0;
					
					$target_userid_array = array();
					
					if (($pos = strpos($localactivitycontent, "@")) !== FALSE) {
						
    					$str = stripslashes($localactivitycontent);

    					$DOM = new DOMDocument;
    					$DOM->loadHTML($str);

    					$items = $DOM->getElementsByTagName('span');
    					$span_list = '';
    					for($i = 0; $i < $items->length; $i++) {
        					$item = $items->item($i);

        					if($item->getAttribute('class') == 'atwho-inserted'){
            					$span_list = $item->nodeValue;
								
								$target_username_array = explode('@',$span_list);
								if (count($target_username_array) > 1) {
						
									$target_userid = bp_activity_get_userid_from_mentionname( $target_username_array[1] );
									array_push($target_userid_array,"$target_userid");
								}								
        					}
    					}
			
						
					}
					
					if (((get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') && (($pos = strpos($localactivitycontent, "@")) === FALSE)) {
						
						$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE device_id LIKE '%onesignal%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );
						
						$target_userid_array = array_map(function ($value) {
    						return $value == 1 ? '1pnfpbadm' : $value;
						}, $target_userid_array_values);						
					}
					
					$response = $this->PNFPB_icfcm_onesignal_push_notification($activity_id,$activitytitle,$localactivitycontent,$activitylink,$imageurl,$target_userid_array);
							
				} else {
					
					if (get_option('pnfpb_progressier_push') !== '1' ) {
					
						$target_userid = 0;
					
						$target_userid_array = array();					
					
						if (($pos = strpos($localactivitycontent, "@")) !== FALSE) {
						
    							$str = stripslashes($localactivitycontent);
							
								$target_username_array = explode('@',$str);

								if (count($target_username_array) > 1) {
						
									$target_userid_array = explode( ' ',$target_username_array[1] );
									
									if (count($target_userid_array) > 0) {
										
										$target_userid = intval(bp_activity_get_userid_from_mentionname($target_userid_array[0]));
										
									}
									
								}
							
								$pushtype = 'privatemessages';
							
								$url = 'https://fcm.googleapis.com/fcm/send';

								$regid = array();
    
								$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
							
								if ($user_id !== null) {
							
									$iconurl =	bp_core_fetch_avatar ( 
    									array(  'item_id'   => $user_id,       // output user id of post author
            								'type'      => 'full',
            								'html'      => FALSE        // FALSE = return url, TRUE (default) = return url wrapped with html
							  
   											) 
										);
							
									if (!$iconurl || $iconurl !== '' || $iconurl === null  ) {
					
										$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
					
									}
								}
							
							
								if (get_option('pnfpb_httpv1_push') === '1'&& $target_userid > 0) {
									
									$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = '{$target_userid}'");
										

									$regid = $deviceids;
									
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND userid = '{$target_userid}'");

									$regidwebview = $deviceidswebview;
									
									$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			stripslashes(strip_tags($activitytitle)),
																			mb_substr(stripslashes(strip_tags(urldecode(trim($localactivitycontent)))),0,130, 'UTF-8'),
																			$iconurl,
																			$imageurl,
																			$activitylink,
																			array('click_url' => $activitylink),
																			$regid,
																			$regidwebview,
																			$user_id,
																			$target_userid,
																			$pushtype
																			);
																	
									
									
								}
								else {

									if ($target_userid > 0) {
										
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND userid = '{$target_userid}'");
										

										$regid = $deviceids;
										
									
										$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			stripslashes(strip_tags($activitytitle)),
																			mb_substr(stripslashes(strip_tags(urldecode(trim($localactivitycontent)))),0,130, 'UTF-8'),
																			$iconurl,
																			$imageurl,
																			$activitylink,
																			array(),
																			$regid,
																			array(),
																			$user_id,
																			$target_userid,
																			$pushtype
																			);
										
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND userid = '{$target_userid}'");							

										$regid = $deviceids;										
										
										$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			stripslashes(strip_tags($activitytitle)),
																			mb_substr(stripslashes(strip_tags(urldecode(trim($localactivitycontent)))),0,130, 'UTF-8'),
																			$iconurl,
																			$imageurl,
																			'',
																			array('click_url' => $activitylink),
																			array(),
																			$regid,
																			$user_id,
																			$target_userid,
																			$pushtype
																			);										
									}
							}
							
						} else {

							if (get_option('pnfpb_httpv1_push') !== '1') {							
				
								for ($dcount=0; $dcount<=count($deviceids_count); $dcount+=1000) {
				
									if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
									
										if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
											$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );										
										} else {
					
											$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
										}
									}
									else 
									{
										if (get_option('pnfpb_shortcode_enable') === 'yes') {
											if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
												$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );											
											} else {
												$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND  device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
											}
										}
										else
										{
											if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
												$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' LIMIT {$dcount}, 1000" );											
											} else {
												$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' LIMIT {$dcount}, 1000" );
											}
										}
									}
								
									$regid = $deviceids;
    
									$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
            
									$blog_title = get_bloginfo( 'name' );
								
									if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
						
										if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
											$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );										
										} else {
											$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
										}
						
									}
									else {
										if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
											$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' LIMIT {$dcount}, 1000" );										
										} else {
											$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' LIMIT {$dcount}, 1000" );
										}
						
									}								
				

									if (function_exists('bp_follow_get_followers') && ((get_option( 'pnfpb_ic_fcm_buddypress_followers_enable') && get_option( 'pnfpb_ic_fcm_buddypress_followers_enable')  === '1'))) {
										
										$bp_follow_get_followers_array = bp_follow_get_followers($user_id);
									
										$bp_follow_get_followers_implarray = implode(",",$bp_follow_get_followers_array);
										
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%!!%' AND userid IN ($bp_follow_get_followers_implarray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
									
										$regid = $deviceids;
									
										$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND userid IN ($bp_follow_get_followers_implarray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );									
										
									}								
								
									if (count($regid) > 0) {


										// prepare the message
										$targetid = 0;
   				
										$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			stripslashes(strip_tags($activitytitle)),
																			mb_substr(stripslashes(strip_tags(urldecode(trim($localactivitycontent)))),0,130, 'UTF-8'),
																			$iconurl,
																			$imageurl,
																			$activitylink,
																			array(),
																			$regid,
																			array(),
																			$user_id,
																			$targetid																				
																			);

										do_action('PNFPB_connect_to_external_api_for_activity');
								}
							}
						}	
					}
					
					if (get_option('pnfpb_httpv1_push') === '1' && get_option('pnfpb_onesignal_push') !== '1' && get_option('pnfpb_progressier_push') !== '1') {

								$dcount = 0;
					
								$regid = array();
    
								$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
            
								$blog_title = get_bloginfo( 'name' );
								
	    						$targetid = 0;
						
								$deviceidswebview = array();
								
								$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			stripslashes(strip_tags($activitytitle)),
																			mb_substr(stripslashes(strip_tags(urldecode(trim($localactivitycontent)))),0,130, 'UTF-8'),
																			$iconurl,
																			$imageurl,
																			$activitylink,
																			array('click_url' => $activitylink),
																			$regid,
																			$deviceidswebview,
																			$user_id,
																			$targetid,
																			'activity'
																			);

								do_action('PNFPB_connect_to_external_api_for_activity');
							
					}
				
					$isWebView = false;

					if (get_option('pnfpb_httpv1_push') !== '1' && get_option('pnfpb_onesignal_push') !== '1' && get_option('pnfpb_progressier_push') !== '1') {
				
			
						if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );							
							} else {
								$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
							}
					
						}
						else {
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' " );
							} else {
								$deviceids_webview_count=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' " );
							}
						}
				
						if (count($deviceids_webview_count) > 0) {
							$isWebView = true;
						}				
				
						for ($dcount=0; $dcount<=count($deviceids_webview_count); $dcount+=1000) {
					
							if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
							
								if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );								
								} else {
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
								}
						
							}
							else {
								if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' LIMIT {$dcount}, 1000" );								
								} else {
									$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' LIMIT {$dcount}, 1000" );
								}
						
							}
						
							if (function_exists('bp_follow_get_followers') && ((get_option( 'pnfpb_ic_fcm_buddypress_followers_enable') && get_option( 'pnfpb_ic_fcm_buddypress_followers_enable')  === '1'))) {
										
								$bp_follow_get_followers_array = bp_follow_get_followers($user_id);
									
								$bp_follow_get_followers_implarray = implode(",",$bp_follow_get_followers_array);
													
								$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND userid IN ($bp_follow_get_followers_implarray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );									
										
							}
						
							if ($isWebView) 
							{
								// prepare the message
								$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			stripslashes(strip_tags($activitytitle)),
																			stripslashes(strip_tags($localactivitycontent)),
																			$iconurl,
																			$imageurl,
																			"",
																			array('click_url' => $activitylink),
																			array(),
																			$deviceidswebview,
																			$user_id,
																			$targetid																					 
																			);
							
								do_action('PNFPB_connect_to_external_api_for_activity_webview');
							
								}
							}
						}
					}
				}
			}
?>