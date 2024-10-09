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
            
			if ((($comment_id && (false === as_has_scheduled_action( 'PNFPB_cron_buddypresscomments_hook' ))) || ($comment_id === null && (as_has_scheduled_action( 'PNFPB_cron_buddypresscomments_hook' )))) && get_option('pnfpb_ic_fcm_bcomment_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false) || (get_option('pnfpb_ic_fcm_bcomment_enable') == 1 && (get_option( 'pnfpb_onesignal_push' ) === '1' || get_option('pnfpb_httpv1_push') === '1' || get_option('pnfpb_progressier_push') === '1' || get_option('pnfpb_webtoapp_push') === '1'))) {

				global $wpdb;
				
				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
				
				$activity_content_push = __("New comments posted in ",'PNFPB_TD').get_bloginfo( 'name' );
				
				$activitylink = get_home_url();
				if (function_exists('bp_is_active')){
					$activitylink = get_home_url().'/'.buddypress()->pages->activity->slug;
				}				
				
				if ($comment_id) {
					extract( $params, EXTR_SKIP );
	
					$activity_content_push = strip_tags(urldecode($content));
	
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
            
				$localactivitycontent = substr(stripslashes(strip_tags($activity_content_push)),0,80);
				
				$sender_name = '';
				
			
				if ($comment_id===null ) {
					
					$recent_comments = $wpdb->get_results( "SELECT user_id, content, item_id, id, date_recorded FROM {$wpdb->prefix}bp_activity WHERE TYPE = 'activity_comment' ORDER BY date_recorded DESC LIMIT 1" );
					

    				foreach( $recent_comments as $recent_comment ) {
						
						$activity_id = $recent_comment->item_id;
						
						$activityuserid = $recent_comment->user_id;

        				$activitylink = bp_activity_get_permalink( $recent_comment->item_id );
					
						$activitylink = $activitylink.'#acomment-'.$comment_id;
						
						$localactivitycontent = substr(stripslashes(strip_tags($recent_comment->content)),0,80);
						
						$activity_details = $wpdb->get_results( "SELECT user_id, content, item_id, id, date_recorded FROM {$wpdb->prefix}bp_activity WHERE id = {$activity_id} AND TYPE = 'activity_update' ORDER BY date_recorded DESC LIMIT 1" );
						
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
					$commenttitle = __('New comment posted in ','PNFPB_TD').$blog_title;
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
								
						$target_userid_array_values=$wpdb->get_col( "SELECT device_id FROM {$table_name} WHERE device_id LIKE '%progressier%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );
								
					}
							
					if (get_option('pnfpb_ic_fcm_buddypress_comments_radio_enable') === '2' && $activity_id > 0) {
								
						$target_userid_array_values=$wpdb->get_col( "SELECT device_id FROM {$table_name} WHERE userid = {$authoractivityuserid} AND device_id LIKE '%progressier%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,4,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );							
								
					}					
					
					$response = $this->PNFPB_icfcm_progressier_send_push_notification(0,$commenttitle,$localactivitycontent,$activitylink,$iconurl,0,'',$target_userid_array_values);

				}
				
				if (get_option('pnfpb_webtoapp_push') === '1') {
					
					if (get_option('pnfpb_ic_fcm_buddypress_comments_radio_enable') !== '2' && $activity_id > 0) {
								
						$target_userid_array_values=$wpdb->get_col( "SELECT device_id FROM {$table_name} WHERE (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );
								
					}
							
					if (get_option('pnfpb_ic_fcm_buddypress_comments_radio_enable') === '2' && $activity_id > 0) {
								
						$target_userid_array_values=$wpdb->get_col( "SELECT device_id FROM {$table_name} WHERE userid = {$authoractivityuserid} AND  (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,4,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );							
								
					}					
					
					$response = $this->PNFPB_icfcm_webtoapp_send_push_notification(0,$commenttitle,$localactivitycontent,$activitylink,$iconurl,0,'',$target_userid_array_values);

				}						
	
				if (get_option('pnfpb_onesignal_push') === '1' && $activity_id > 0 && get_option('pnfpb_progressier_push') !== '1') {
					
					// Update the users who have favorited this activity.
					
					$bb_target_userid_array = array();
					
					if ( function_exists('bb_activity_is_item_favorite') ) {
					
						$reacted_users = $wpdb->get_results( "SELECT id,user_id,reaction_id,item_type,item_id FROM {$wpdb->prefix}bb_user_reactions WHERE item_id = {$activity_id} AND item_type = 'activity'" );
						
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
						
						if (count($liked_user_ids) > 0) {
							
							$liked_user_ids_implArray = implode(',',$liked_user_ids);
							
							if (get_option('pnfpb_ic_fcm_buddypress_comments_radio_enable') !== '2' && $activity_id > 0) {
								
								$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE userid IN ($liked_user_ids_implArray) AND device_id LIKE '%onesignal%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );
								
							}
							
							if (get_option('pnfpb_ic_fcm_buddypress_comments_radio_enable') === '2' && $activity_id > 0) {
								
								$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE userid = {$authoractivityuserid} AND device_id LIKE '%onesignal%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,4,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );							
								
							}
							
							$target_userid_array = array_map(function ($value) {
    							return $value == 1 ? '1pnfpbadm' : $value;
							}, $target_userid_array_values);
				
							
							$response = $this->PNFPB_icfcm_onesignal_push_notification($activity_id,$commenttitle,$localactivitycontent,$activitylink,$imageurl,$target_userid_array);
							
						}
						
					} else {
						
						$target_userid_array = array();
						
						$mergeduserids_array = array();
						
						$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE device_id LIKE '%onesignal%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );
								
						$target_myactivities_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE userid = {$authoractivityuserid} AND device_id LIKE '%onesignal%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,4,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );
							
				
						$target_userid_array = array_map(function ($value) {
    						return $value == 1 ? '1pnfpbadm' : $value;
						}, $target_userid_array_values);
						
						$target_myactivities_userid_array = array_map(function ($value) {
    						return $value == 1 ? '1pnfpbadm' : $value;
						}, $target_myactivities_userid_array_values);
						
						$mergeduserids_array = array_merge($target_userid_array,$target_myactivities_userid_array);
						
						$response = $this->PNFPB_icfcm_onesignal_push_notification($activity_id,$commenttitle,$localactivitycontent,$activitylink,$imageurl,$mergeduserids_array);
						
					}
							
				} else {
					
					if (get_option('pnfpb_progressier_push') !== '1') {
					
						$liked_user_ids = array();
					
						$buddyboss_pnfpb = false;
					
						if ( function_exists('bb_activity_is_item_favorite') ) {
						
							$buddyboss_pnfpb = true;
					
							$reacted_users = $wpdb->get_results( "SELECT id,user_id,reaction_id,item_type,item_id FROM {$wpdb->prefix}bb_user_reactions WHERE item_id = {$activity_id} AND item_type = 'activity'" );
					
						
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
							
									$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND  userid IN ($liked_user_ids_implode) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
								
									$deviceidswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%webview%' AND userid IN ($liked_user_ids_implode) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );								
							
								}	else {
									if (!$buddyboss_pnfpb) {
									
										$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
									
										$deviceidswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
									
									}
								}
							} else {
							
							
							
								if (count($liked_user_ids) > 0) {
							
									$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND userid IN ($liked_user_ids_implode) AND  (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
								
									$deviceidswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND userid IN ($liked_user_ids_implode) AND  (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );								
								
							
								} else {
									if (!$buddyboss_pnfpb) {
									
										$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
									
										$deviceidswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );									
									
									}

								}
							}
					
						}

				
						/* Logic to get subscribers who subscribed only comments made on my activities */
				
						$deviceidsmyactivities = [];
					
						$deviceidsmyactivitieswebview = [];
				
						if (get_option('pnfpb_ic_fcm_buddypress_comments_radio_enable') === '2' && $activity_id > 0) {
							
							if(count($liked_user_ids) <= 0 && !$buddyboss_pnfpb) {
							
								$deviceidsmyactivities = $wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid = {$authoractivityuserid} AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) != '0' OR SUBSTRING(subscription_option,4,1) = '1' )" );							
	
								$deviceidsmyactivitieswebview = $wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid = {$authoractivityuserid} AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) != '0' OR SUBSTRING(subscription_option,4,1) = '1' )" );
								
							}
							
							if (count($liked_user_ids) > 0) {
							
								$deviceidsmyactivities = $wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid = {$authoractivityuserid} AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) != '0' OR SUBSTRING(subscription_option,4,1) = '1' )" );							
							
								$deviceidsmyactivitieswebview = $wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid = {$authoractivityuserid} AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) != '0' OR SUBSTRING(subscription_option,4,1) = '1' )" );
							
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
						
										
								$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND userid IN ($bp_follow_get_followers_implarray) AND device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
						
								$regid = $deviceids;
									
								$deviceidswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND userid IN ($bp_follow_get_followers_implarray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
						
								$mergeddeviceidswebview = $deviceidswebview;
										
						}					

						if (count($regid) > 0) {
							// prepare the message
							if (get_option('pnfpb_httpv1_push') === '1'  && $activity_id > 0) {
								$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																		$commenttitle,
																		mb_substr(stripslashes(strip_tags(trim($localactivitycontent))),0,130, 'UTF-8'),
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
							else {
								if ($activity_id > 0) {
									$this->PNFPB_icfcm_legacy_send_push_notification(0,
																		$commenttitle,
																		mb_substr(stripslashes(strip_tags(trim($localactivitycontent))),0,130, 'UTF-8'),
																		$iconurl,
																		$iconurl,
																		$activitylink,
																		array(),
																		$regid,
																		array(),
																		$activityuserid,
																		$authoractivityuserid															
																		);
								}
							}
						
						}
				
						if (count($mergeddeviceidswebview ) > 0 && $activity_id > 0) {
							// prepare the message
							$this->PNFPB_icfcm_legacy_send_push_notification(0,
																		$commenttitle,
																		mb_substr(stripslashes(strip_tags(trim($localactivitycontent))),0,130, 'UTF-8'),
																		$iconurl,
																		$iconurl,
																		"",
																		array('click_url' => $activitylink),
																		array(),
																		$mergeddeviceidswebview,
																		$activityuserid,
																		$authoractivityuserid															
																		);
						}
					}
				}
			}


?>