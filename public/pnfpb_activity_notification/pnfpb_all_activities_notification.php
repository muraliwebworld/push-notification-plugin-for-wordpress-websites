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

			// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery
			
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
				
				$deviceids_count=0;
				
				if ($activity_content) {
					
					$localactivitycontent = $activity_content;
					
				}
				else 
				{
					$cron_get_scheduled_activities = bp_activity_get( $args = array('per_page' => 1,'sort'=> 'DESC') );
					
					foreach ( $cron_get_scheduled_activities['activities'] as $activity ) {
							
						$localactivitycontent = mb_substr(stripslashes(wp_strip_all_tags(urldecode(trim($activity->content)))),0,80, 'UTF-8');

						$activitylink = bp_activity_get_permalink( $activity->id, $activity );
								
						$user_id = $activity->user_id;
					}
				}				
				$imageurl = '';
				
				$activitytitle = '[member name]'.esc_html( __(' posted new activity in ',"push-notification-for-post-and-buddypress")).$blog_title;
				
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
				
				$buddyboss_platform_plugin_file = 'buddyboss-platform/bp-loader.php';
				
				if (get_option('pnfpb_progressier_push') === '1') {
					
					$target_userid_array_values=$wpdb->get_col($wpdb->prepare( "SELECT device_id FROM %i WHERE device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",$table_name,'%progressier%' ));
					
					if (get_option('pnfpb_ic_fcm_activity_schedule_now_enable') && get_option('pnfpb_ic_fcm_activity_schedule_now_enable') === '1') 
					{
					
						$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_progressier_schedule_push_notification_hook', array(0, $activitytitle, $localactivitycontent, $activitylink, $imageurl, 0, '', $target_userid_array_values));
					
					} else {
						
						$response = $this->PNFPB_icfcm_progressier_send_push_notification(0, $activitytitle, $localactivitycontent, $activitylink, $imageurl, 0, '', $target_userid_array_values);
						
					}
						
					
				}
				
				if (get_option('pnfpb_webtoapp_push') === '1') {
					
					$target_userid_array_values=$wpdb->get_col($wpdb->prepare( "SELECT device_id FROM %i WHERE (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",$table_name) );
					
					if (get_option('pnfpb_ic_fcm_activity_schedule_now_enable') && get_option('pnfpb_ic_fcm_activity_schedule_now_enable') === '1') 
					{
						$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_webtoapp_schedule_push_notification_hook', array(0, $activitytitle, $localactivitycontent, $activitylink, $imageurl, 0, '', $target_userid_array_values));
						
					} else {
						
						$response = $this->PNFPB_icfcm_webtoapp_send_push_notification(0, $activitytitle, $localactivitycontent, $activitylink, $imageurl, 0, '', $target_userid_array_values);
						
					}
						
										
				}			
				
				if (get_option('pnfpb_onesignal_push') === '1' && get_option('pnfpb_progressier_push') !== '1') {
				
					$target_userid = 0;
					
					$target_userid_array = array();
					
					if (($pos = strpos($localactivitycontent, "@")) !== FALSE) {
						
    					$str = stripslashes($localactivitycontent);
							
						$target_username_array = explode('@',$str);

						if (count($target_username_array) > 1) {
						
							$target_userid_array = explode( ' ',$target_username_array[1] );
									
							if (count($target_userid_array) > 0) {
										
								$target_userid = intval(bp_activity_get_userid_from_mentionname($target_userid_array[0]));
								
								array_push($target_userid_array,"$target_userid");
								
							}
									
						}
							
						if ($target_userid === 0 && function_exists( 'is_plugin_active' ) && is_plugin_active( $buddyboss_platform_plugin_file ) ) {
								
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
					}
					
					if (((get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') || (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1' && get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1')) && (($pos = strpos($localactivitycontent, "@")) === FALSE)) {
						
						$target_userid_array_values=$wpdb->get_col($wpdb->prepare( "SELECT userid FROM %i WHERE device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",$table_name,'%onesignal%' ) );
						
						$target_userid_array = array_map(function ($value) {
    						return $value == 1 ? '1pnfpbadm' : $value;
						}, $target_userid_array_values);						
					}
					
					if (get_option('pnfpb_ic_fcm_activity_schedule_now_enable') && get_option('pnfpb_ic_fcm_activity_schedule_now_enable') === '1') 
					{
					
						$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_onesignal_schedule_push_notification_hook', array($activity_id, $activitytitle, $localactivitycontent, $activitylink, $imageurl, $target_userid_array));
						
					} else {
						
						$response = $this->PNFPB_icfcm_onesignal_push_notification($activity_id,$activitytitle,$localactivitycontent,$activitylink,$imageurl,$target_userid_array);
					}
					
												
				} else {
					
					if (get_option('pnfpb_progressier_push') !== '1'  && (($pos = strpos($localactivitycontent, "@")) !== FALSE) ) {
					
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
							
							if ($target_userid === 0 && function_exists( 'is_plugin_active' ) && is_plugin_active( $buddyboss_platform_plugin_file )) {
								
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
											
										}								
        							}
								}
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

							
						if (get_option('pnfpb_httpv1_push') === '1' && $target_userid > 0) {
									
							$deviceids=$wpdb->get_col($wpdb->prepare( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE  %s AND userid = %d",$table_name,'%!!%','%@N%',$target_userid));

							$regid = $deviceids;
									
							$deviceidswebview=$wpdb->get_col($wpdb->prepare( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id LIKE %s AND device_id NOT LIKE %s AND userid = %d",$table_name,'%webview%','%@N%',$target_userid));

							$regidwebview = $deviceidswebview;

									
							if (get_option('pnfpb_ic_fcm_activity_schedule_now_enable') && get_option('pnfpb_ic_fcm_activity_schedule_now_enable') === '1') {
									
									$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_httpv1_schedule_push_notification_hook', array(0,
																			stripslashes(wp_strip_all_tags($activitytitle)),
																			mb_substr(stripslashes(wp_strip_all_tags(urldecode(trim($localactivitycontent)))),0,130, 'UTF-8'),
																			$iconurl,
																			$imageurl,
																			$activitylink,
																			array('click_url' => $activitylink),
																			$regid,
																			$regidwebview,
																			$user_id,
																			$target_userid,
																			$pushtype));
								} else {
										
									$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			stripslashes(wp_strip_all_tags($activitytitle)),
																			mb_substr(stripslashes(wp_strip_all_tags(urldecode(trim($localactivitycontent)))),0,130, 'UTF-8'),
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
									
									
									
							}
							
						} else {
					
							if (get_option('pnfpb_httpv1_push') === '1' && get_option('pnfpb_onesignal_push') !== '1' && get_option('pnfpb_progressier_push') !== '1') {

								$dcount = 0;
					
								$regid = array();
    
								$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
            
								$blog_title = get_bloginfo( 'name' );
								
	    						$targetid = 0;
						
								$deviceidswebview = array();
							
								if (get_option('pnfpb_ic_fcm_activity_schedule_now_enable') && get_option('pnfpb_ic_fcm_activity_schedule_now_enable') === '1') {
						
									$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_httpv1_schedule_push_notification_hook', array(0,
																			stripslashes(wp_strip_all_tags($activitytitle)),
																			mb_substr(stripslashes(wp_strip_all_tags(urldecode(trim($localactivitycontent)))),0,130, 'UTF-8'),
																			$iconurl,
																			$imageurl,
																			$activitylink,
																			array('click_url' => $activitylink),
																			$regid,
																			$deviceidswebview,
																			$user_id,
																			$targetid,
																			'activity'));
								} else {
									
									$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			stripslashes(wp_strip_all_tags($activitytitle)),
																			mb_substr(stripslashes(wp_strip_all_tags(urldecode(trim($localactivitycontent)))),0,130, 'UTF-8'),
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
									
								}
							
								do_action('PNFPB_connect_to_external_api_for_activity');
							
							}
						}
				
					}
				}
?>