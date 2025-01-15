<?php

		/**
		* Triggered if user comments on activity in BuddyPress to send push notifications.
		* Opt in/out for the notification can be controlled from plugin settings.
		*
		*
		* @param string   $activity_content Activity content
		* @param numeric  $user_id 			USER ID
		* @param numeric  $activity_id		Activity ID
		*
		*
		* @since 1.0.0
		*/

            $apiaccesskey = get_option('pnfpb_ic_fcm_google_api');

			$deviceidswebview = array();
				
			$deviceids = array();

			$mergeddeviceidswebview = array();
	
			$mergeddeviceids = array();

			// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery
            
			if ((($comment_id && (false === as_has_scheduled_action( 'PNFPB_cron_buddypresscomments_hook' ))) || ($comment_id === null && (as_has_scheduled_action( 'PNFPB_cron_buddypresscomments_hook' )))) && get_option('pnfpb_ic_fcm_bcomment_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false) || (get_option('pnfpb_ic_fcm_bcomment_enable') == 1 && (get_option( 'pnfpb_onesignal_push' ) === '1' || get_option('pnfpb_httpv1_push') === '1' || get_option('pnfpb_progressier_push') === '1' || get_option('pnfpb_webtoapp_push') === '1'))) {

				global $wpdb;
				
				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
				
				$activity_content_push = esc_html( __("New comments posted in ","push-notification-for-post-and-buddypress")).get_bloginfo( 'name' );
				
				$activitylink = get_home_url();

				if (function_exists('bp_is_active')){
					$activitylink = get_home_url().'/'.buddypress()->pages->activity->slug;
				}				
				
				if ($comment_id) {
					
					extract( $params, EXTR_SKIP );
	
					$activity_content_push = wp_strip_all_tags(urldecode($content));
	
					$activitylink = bp_activity_get_permalink( $activity_id );
					
					$activitylink = $activitylink.'#acomment-'.$comment_id;
					
				}
				
				$activityuserid = 0;
				
				$authoractivityuserid = 0;
				
				$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
				
			
				if ($comment_id && $user_id) {
					
					$activityuserid = $user_id;
					
					if ($activity && $activity !== null) {
						
						$authoractivityuserid = $activity->user_id;
					}
					
					$iconurl =	bp_core_fetch_avatar ( 
    						array(  'item_id'   => $user_id,       // output user id of post author
            						'type'      => 'full',
            						'html'      => FALSE        // FALSE = return url, TRUE (default) = return url wrapped with html
							  
   									) 
							);					
					
				}
				
				if (!$iconurl || $iconurl !== '' || $iconurl === null  ) {
					
					$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
					
				}

            
				$blog_title = get_bloginfo( 'name' );
            
				$localactivitycontent = substr(stripslashes(wp_strip_all_tags($activity_content_push)),0,80);
				
				$sender_name = '';
				
				$table_name_activity = $wpdb->prefix.'bp_activity';
			
				if ($comment_id===null ) {
					
					$recent_comments = $wpdb->get_results($wpdb->prepare( "SELECT user_id, content, item_id, id, date_recorded FROM %i WHERE TYPE = %s ORDER BY date_recorded DESC LIMIT 1",$table_name_activity,'activity_comment' ));

    				foreach( $recent_comments as $recent_comment ) {
						
						$activity_id = $recent_comment->item_id;
						
						$activityuserid = $recent_comment->user_id;

        				$activitylink = bp_activity_get_permalink( $recent_comment->item_id );
					
						$activitylink = $activitylink.'#acomment-'.$comment_id;
						
						$localactivitycontent = substr(stripslashes(wp_strip_all_tags($recent_comment->content)),0,80);
						
						$activity_details = $wpdb->get_results($wpdb->prepare( "SELECT user_id, content, item_id, id, date_recorded FROM %i WHERE id = %d AND TYPE = %s ORDER BY date_recorded DESC LIMIT 1",$table_name_activity,$activity_id,'activity_update' ));
						
						foreach( $activity_details as $activity_detail ) {
					
							$authoractivityuserid = $activity_detail->user_id;
							
						}
    				}
					
				}
				
				if (get_option('pnfpb_ic_fcm_comment_activity_title') != false && get_option('pnfpb_ic_fcm_comment_activity_title') != '') {
					
					$commenttitle = get_option('pnfpb_ic_fcm_comment_activity_title');
					
					if ($activityuserid != '' || $activityuserid !== null) {
						
						$sender_name = bp_core_get_user_displayname( $activityuserid );
						
						$commenttitle = str_replace("[member name]", $sender_name, $commenttitle);
						
					}
				}
				else
				{
					$commenttitle = esc_html( __('New comment posted in ',"push-notification-for-post-and-buddypress")).$blog_title;
				}				
				
				if (get_option('pnfpb_ic_fcm_comment_activity_message') != false && get_option('pnfpb_ic_fcm_comment_activity_message') != '') {
					
					if ($comment_id) {
						$localactivitycontent = get_option('pnfpb_ic_fcm_comment_activity_message');
					} else {
						$localactivitycontent .= get_option('pnfpb_ic_fcm_comment_activity_message');
					}
					
				}				
				
				preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($localactivitycontent), $imgresult);
				
				$imageurl = '';
				
				if (is_array($imgresult)) {
					if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
						$imageurl = str_replace('"','',$imgresult[2][0]);
					}
				}				
				
				$localactivitycontent = str_replace("[member name]", $sender_name, $localactivitycontent);
				
				$deviceids = [];
					
				$deviceidswebview = [];
				
				if (get_option('pnfpb_progressier_push') === '1') {
					
					if (get_option('pnfpb_ic_fcm_buddypress_comments_radio_enable') !== '2' && $activity_id > 0) {
								
						$target_userid_array_values=$wpdb->get_col($wpdb->prepare( "SELECT device_id FROM %i WHERE device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",$table_name,'%progressier%') );
								
					}
							
					if (get_option('pnfpb_ic_fcm_buddypress_comments_radio_enable') === '2' && $activity_id > 0) {
								
						$target_userid_array_values=$wpdb->get_col($wpdb->prepare( "SELECT device_id FROM %i WHERE userid = %d AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,4,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",$table_name,$authoractivityuserid,'%progressier%' ));	
								
					}
					
					if (get_option('pnfpb_ic_fcm_comments_schedule_now_enable') && get_option('pnfpb_ic_fcm_comments_schedule_now_enable') === '1') {
					
						$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_progressier_schedule_push_notification_hook', array(0, $commenttitle, $localactivitycontent, $activitylink, $iconurl, 0, '', $target_userid_array_values));
						
					} else {
						
						$response = $this->PNFPB_icfcm_progressier_send_push_notification(0, $commenttitle, $localactivitycontent, $activitylink,$iconurl, 0, '', $target_userid_array_values);
						
					}

				}
				
				if (get_option('pnfpb_webtoapp_push') === '1') {
					
					if (get_option('pnfpb_ic_fcm_buddypress_comments_radio_enable') !== '2' && $activity_id > 0) {
								
						$target_userid_array_values=$wpdb->get_col($wpdb->prepare( "SELECT device_id FROM %i WHERE (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",$table_name) );
								
					}
							
					if (get_option('pnfpb_ic_fcm_buddypress_comments_radio_enable') === '2' && $activity_id > 0) {
								
						$target_userid_array_values=$wpdb->get_col($wpdb->prepare( "SELECT device_id FROM %i WHERE userid = %d AND  (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,4,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",$table_name,$authoractivityuserid) );
						
					}
					
					if (get_option('pnfpb_ic_fcm_comments_schedule_now_enable') && get_option('pnfpb_ic_fcm_comments_schedule_now_enable') === '1') {
					
						$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_webtoapp_schedule_push_notification_hook', array(0, $commenttitle, $localactivitycontent, $activitylink, $iconurl, $target_userid_array_values, '', ''));
						
					} else {
					
						$response = $this->PNFPB_icfcm_webtoapp_send_push_notification(0, $commenttitle, $localactivitycontent, $activitylink, $iconurl, $target_userid_array_values, '', '');
						
					}

				}						
	
				if (get_option('pnfpb_onesignal_push') === '1' && $activity_id > 0 && get_option('pnfpb_progressier_push') !== '1') {
					
					// Update the users who have favorited this activity.
					
					$bb_target_userid_array = array();
					
					if ( function_exists('bb_activity_is_item_favorite') ) {

						$table_name_bbreactions = $wpdb->prefix.'bb_user_reactions';
					
						$reacted_users = $wpdb->get_results($wpdb->prepare( "SELECT id,user_id,reaction_id,item_type,item_id FROM %i WHERE item_id = %d AND item_type = %s",$table_name_bbreactions,$activity_id,'activity') );
						
						$liked_users = array();
						
						foreach( $reacted_users as $result ) {
							
							array_push($liked_users,$result->user_id);
							
						}

						if ( empty( $liked_users ) || ! is_array( $liked_users ) ) {
							$liked_user_ids = array("0");
						}
						else {
							$liked_user_ids = array_map(function($value) {
    							return $value == 1 ? '1pnfpbadm' : strval($value);
							}, $liked_users);						
						}

						$target_userid_array = array();
						
						if (count($liked_users) > 0) {
							
							$liked_user_ids_implArray = implode(',',$liked_users);
							
							if (get_option('pnfpb_ic_fcm_buddypress_comments_radio_enable') !== '2' && $activity_id > 0) {
								
								$target_userid_array_values=$wpdb->get_col($wpdb->prepare( "SELECT userid FROM %i WHERE userid IN ($liked_user_ids_implArray) AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",$table_name,'%onesignal%' ));
								
							}
							
							if (get_option('pnfpb_ic_fcm_buddypress_comments_radio_enable') === '2' && $activity_id > 0) {
								
								$target_userid_array_values=$wpdb->get_col($wpdb->prepare( "SELECT userid FROM %i WHERE userid = %d AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,4,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",$table_name,$authoractivityuserid,'%onesignal%' ));							
								
							}

							$target_userid_array = array_map(function ($value) {
    							return $value == 1 ? '1pnfpbadm' : $value;
							}, $target_userid_array_values);

							if (get_option('pnfpb_ic_fcm_comments_schedule_now_enable') && get_option('pnfpb_ic_fcm_comments_schedule_now_enable') === '1') {
				
								$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_onesignal_schedule_push_notification_hook', array($activity_id, $commenttitle, $localactivitycontent, $activitylink, $imageurl, $target_userid_array));
								
							} else {
								
								$response = $this->PNFPB_icfcm_onesignal_push_notification($activity_id, $commenttitle, $localactivitycontent, $activitylink, $imageurl, $target_userid_array);
								
							}
							
						}
						
					} else {
						
						$target_userid_array = array();
						
						$mergeduserids_array = array();
						
						$target_userid_array_values=$wpdb->get_col($wpdb->prepare( "SELECT userid FROM %i WHERE device_id LIKE %d AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",$table_name,'%onesignal%' ));
								
						$target_myactivities_userid_array_values=$wpdb->get_col($wpdb->prepare( "SELECT userid FROM %i WHERE userid = %d AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,4,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",$table_name,$authoractivityuserid,'%onesignal%' ));
				
						$target_userid_array = array_map(function ($value) {
    						return $value == 1 ? '1pnfpbadm' : $value;
						}, $target_userid_array_values);
						
						$target_myactivities_userid_array = array_map(function ($value) {
    						return $value == 1 ? '1pnfpbadm' : $value;
						}, $target_myactivities_userid_array_values);
						
						$mergeduserids_array = array_merge($target_userid_array,$target_myactivities_userid_array);
						
						if (get_option('pnfpb_ic_fcm_comments_schedule_now_enable') && get_option('pnfpb_ic_fcm_comments_schedule_now_enable') === '1') {
						
							$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_onesignal_schedule_push_notification_hook', array($activity_id, $commenttitle, $localactivitycontent, $activitylink, $imageurl, $mergeduserids_array));
							
						} else {
							
							$response = $this->PNFPB_icfcm_onesignal_push_notification($activity_id, $commenttitle, $localactivitycontent, $activitylink, $imageurl, $mergeduserids_array);
							
						}
						
					}
							
				} else {
					
					if (get_option('pnfpb_progressier_push') !== '1') {
					
						$liked_user_ids = array();
					
						$buddyboss_pnfpb = false;
					
						if ( function_exists('bb_activity_is_item_favorite') ) {
						
							$buddyboss_pnfpb = true;

							$table_name_bb = $wpdb->prefix.'bb_user_reactions';
					
							$reacted_users = $wpdb->get_results($wpdb->prepare( "SELECT id,user_id,reaction_id,item_type,item_id FROM %i WHERE item_id = %d AND item_type = %s",$table_name_bb,$activity_id,'activity' ));
						
							$liked_users = array();
						
							foreach( $reacted_users as $result ) {
							
								array_push($liked_users,$result->user_id);
							
							}
						
							if ( empty( $liked_users ) || ! is_array( $liked_users ) ) {
								$liked_user_ids = array();
							}
							else {
								$liked_user_ids = array_map(function($value) {
    								return $value == 1 ? 1 : strval($value);
								}, $liked_users);						
							}
							if (count($liked_user_ids) > 0) {
								$liked_user_ids_implode = implode(",",$liked_user_ids);
							}
					
						}
				
						if (get_option('pnfpb_ic_fcm_buddypress_comments_radio_enable') !== '2'  && $activity_id > 0) {
						
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
							
							

								if (count($liked_user_ids) > 0) {
							
									$deviceids=$wpdb->get_col($wpdb->prepare( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > 0 AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND  userid IN ($liked_user_ids_implode) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)",$table_name,'%webview%','%@N%','%!!%'));
								
									$deviceidswebview=$wpdb->get_col($wpdb->prepare( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > 0 AND device_id LIKE %s AND userid IN ($liked_user_ids_implode) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)",$table_name,'%webview%') );								
							
								}	else {
									if (!$buddyboss_pnfpb) {
									
										$deviceids=$wpdb->get_col($wpdb->prepare( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > 0 AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)",$table_name,'%webview%','%@N%','%!!%') );
									
										$deviceidswebview=$wpdb->get_col($wpdb->prepare( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > 0 AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)",$table_name,'%webview%') );
									
									}
								}
							} else {
							
							
							
								if (count($liked_user_ids) > 0) {
							
									$deviceids=$wpdb->get_col($wpdb->prepare( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND userid IN ($liked_user_ids_implode) AND  (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)",$table_name,'%webview%','%@N%','%!!%' ));
								
									$deviceidswebview=$wpdb->get_col($wpdb->prepare( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id LIKE %s AND userid IN ($liked_user_ids_implode) AND  (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)",$table_name,'%webview%'));								
								
							
								} else {
									if (!$buddyboss_pnfpb) {
									
										$deviceids=$wpdb->get_col($wpdb->prepare( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)",$table_name,'%webview%','%@N%','%!!%' ));
									
										$deviceidswebview=$wpdb->get_col($wpdb->prepare( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)",$table_name,'%webview%') );									
									
									}

								}
							}
					
						}

				
						/* Logic to get subscribers who subscribed only comments made on my activities */
				
						$deviceidsmyactivities = [];
					
						$deviceidsmyactivitieswebview = [];
				
						if (get_option('pnfpb_ic_fcm_buddypress_comments_radio_enable') === '2' && $activity_id > 0) {
							
							if(count($liked_user_ids) <= 0 && !$buddyboss_pnfpb) {
							
								$deviceidsmyactivities = $wpdb->get_col($wpdb->prepare( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid = %d AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND (SUBSTRING(subscription_option,1,1) != '0' OR SUBSTRING(subscription_option,4,1) = '1' )",$table_name,$authoractivityuserid,'%webview%','%!!%','%@N%' ));							
	
								$deviceidsmyactivitieswebview = $wpdb->get_col($wpdb->prepare( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid = %d AND device_id LIKE %s AND device_id NOT LIKE %s AND (SUBSTRING(subscription_option,1,1) != '0' OR SUBSTRING(subscription_option,4,1) = '1' )",$table_name,$authoractivityuserid,'%webview%','%@N%' ));
								
							}
							
							if (count($liked_user_ids) > 0) {
							
								$deviceidsmyactivities = $wpdb->get_col($wpdb->prepare( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid = %d AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND (SUBSTRING(subscription_option,1,1) != '0' OR SUBSTRING(subscription_option,4,1) = '1' )",$table_name,$authoractivityuserid,'%webview%','%!!%','%@N%' ));							
							
								$deviceidsmyactivitieswebview = $wpdb->get_col($wpdb->prepare( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid = %d AND device_id LIKE %s AND device_id NOT LIKE %s AND (SUBSTRING(subscription_option,1,1) != '0' OR SUBSTRING(subscription_option,4,1) = '1' )",$table_name,$authoractivityuserid,'%webview%','%@N%' ));
							
							}							
							
						}
			
						$pushtype = 'comments';
					
						if (count($deviceidsmyactivitieswebview) > 0 || count($deviceidsmyactivities) > 0) {
						
							$pushtype = 'mycomments';
						
						}
					
						$mergeddeviceids = array_merge($deviceids,$deviceidsmyactivities);
				
						$mergeddeviceidswebview = array_merge($deviceidswebview,$deviceidsmyactivitieswebview);
	
						$url = 'https://fcm.googleapis.com/fcm/send';

						$regid = $mergeddeviceids;
					
						if (function_exists('bp_follow_get_followers') && ((get_option( 'pnfpb_ic_fcm_buddypress_followers_enable') && get_option( 'pnfpb_ic_fcm_buddypress_followers_enable')  === '1'))) {

								$bp_follow_get_followers_array = bp_follow_get_followers($authoractivityuserid);
									
								$bp_follow_get_followers_implarray = implode(",",$bp_follow_get_followers_array);
						
										
								$deviceids=$wpdb->get_col($wpdb->prepare( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > 0 AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND userid IN ($bp_follow_get_followers_implarray) AND device_id NOT LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)",$table_name,'%webview%','%@N%','%!!%' ));
						
								$regid = $deviceids;
									
								$deviceidswebview=$wpdb->get_col($wpdb->prepare( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > 0 AND device_id LIKE %s AND device_id NOT LIKE %s AND userid IN ($bp_follow_get_followers_implarray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)",$table_name,'%webview%','%@N%'  ));
						
								$mergeddeviceidswebview = $deviceidswebview;
										
						}					

						if (count($regid) > 0) {
							// prepare the message
							if (get_option('pnfpb_httpv1_push') === '1'  && $activity_id > 0) {
								
								if (get_option('pnfpb_ic_fcm_comments_schedule_now_enable') && get_option('pnfpb_ic_fcm_comments_schedule_now_enable') === '1') {
								
									$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_httpv1_schedule_push_notification_hook', array(0,
																		$commenttitle,
																		mb_substr(stripslashes(wp_strip_all_tags(trim($localactivitycontent))),0,130, 'UTF-8'),
																		$iconurl,
																		$iconurl,
																		$activitylink,
																		array('click_url' => $activitylink),
																		$regid,
																		$mergeddeviceidswebview,
																		$activityuserid,
																		$authoractivityuserid,
																		$pushtype));
									
								} else {
									
									$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																		$commenttitle,
																		mb_substr(stripslashes(wp_strip_all_tags(trim($localactivitycontent))),0,130, 'UTF-8'),
																		$iconurl,
																		$iconurl,
																		$activitylink,
																		array('click_url' => $activitylink),
																		$regid,
																		$mergeddeviceidswebview,
																		$activityuserid,
																		$authoractivityuserid,
																		$pushtype							
																		);
									
								}

							}
						
						}
				
					}
				}
			}


?>