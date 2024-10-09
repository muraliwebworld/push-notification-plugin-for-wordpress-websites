<?php
		/** Push notification for post comment
		 * 
		 * 
		 * @since 1.31
		 * 
		 */
			global $wpdb;
				
            $apiaccesskey = get_option('pnfpb_ic_fcm_google_api');

			$deviceidswebview = array();
				
			$deviceids = array();

			$mergeddeviceidswebview = array();
	
			$mergeddeviceids = array();
				
            
			if ((($comment_ID && (false === as_has_scheduled_action( 'PNFPB_cron_comments_post_hook' ))) || ($comment_ID === null && (as_has_scheduled_action( 'PNFPB_cron_comments_post_hook' )))) && get_option('pnfpb_ic_fcm_bcomment_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false) || (get_option('pnfpb_ic_fcm_bcomment_enable') == 1 && get_option('pnfpb_progressier_push') !== '1' && (get_option( 'pnfpb_onesignal_push' ) === '1' || get_option('pnfpb_httpv1_push') === '1'))) {
				
				
				if ($comment_ID === null ) {
				
					$comment_ID = get_option('pnfpb_ic_fcm_new_comment_id');
					
					$commentData = get_comment($comment_ID);
				
					$comment_approved = get_option('pnfpb_ic_fcm_new_comment_approved');
				}
				else {
					
					$commentData = get_comment($comment_ID);
				}
				
		
				if( 1 === $comment_approved && $commentData) {
			
					$commentData = get_comment($comment_ID);
					
					$postData = get_post($commentData->comment_post_ID);
					
					$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
					
					$iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
            
					$blog_title = get_bloginfo( 'name' );
            
					$commenttitle = __('New comment for post - ','PNFPB_TD').$postData->post_title;
				
					$localpostcontent = $commentData->comment_content;
					
					$postcommentlink = get_permalink($postData->ID);
					
					$postuserid = 0;
				
					if ( !wp_next_scheduled( 'PNFPB_cron_comments_post_hook' ) )
					{				
				
						if ($comment_ID && $comment_ID !== null) {
							
							$postuserid = $commentData->user_id;
							
							$commentData = get_comment($comment_ID);
					
							$postData = get_post($commentData->comment_post_ID);
					
							$authorid = $postData->post_author;	
							
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
				
						
					}
					else 
					{
						if ( get_option('pnfpb_ic_fcm_new_comments_post_userid' )) {
						
							$postuserid = get_option('pnfpb_ic_fcm_new_comments_post_userid' );
							
							$authorid = get_option('pnfpb_ic_fcm_new_comments_author_userid' );
						
						}
					}					
						
					if (get_option('pnfpb_ic_fcm_comment_activity_message') != false && get_option('pnfpb_ic_fcm_comment_activity_message') != '') {
						$localpostcontent = get_option('pnfpb_ic_fcm_comment_activity_message');
					}						
				
								
					preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($localpostcontent), $imgresult);
					$imageurl = '';
				
					if (is_array($imgresult)) {
						if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
							$imageurl = str_replace('"','',$imgresult[2][0]);
						}
					}
					
					if (get_option('pnfpb_ic_fcm_comment_activity_title') != false && get_option('pnfpb_ic_fcm_comment_activity_title') != '') {
						$commenttitle = get_option('pnfpb_ic_fcm_comment_activity_title');
						if ($postuserid != '' || $postuserid !== null) {
							$sender_name = bp_core_get_user_displayname( $postuserid );
							$commenttitle = str_replace("[member name]", $sender_name, $commenttitle);
						}
						else 
						{
							$commenttitle = __('New comment for post - ','PNFPB_TD').$postData->post_title;
						}
					}
					else
					{
						$commenttitle = __('New comment for post - ','PNFPB_TD').$postData->post_title;
					}
					
					if ($comment_ID) {
					
						$commentData = get_comment($comment_ID);
					
						$postData = get_post($commentData->comment_post_ID);
					
						$post_content_push = __("New comments for post - ",'PNFPB_TD').$postData->post_title;
				
						$postuserid = $commentData->user_id;
						
						$authorid = $postData->post_author;
					
						$postlink = get_permalink($postData->ID);
					
						update_option('pnfpb_ic_fcm_new_comment_id',$comment_ID);
					
						update_option('pnfpb_ic_fcm_new_comment_approved',$comment_approved);
				
						update_option('pnfpb_ic_fcm_new_comments_post_content',$post_content_push);
					
						update_option('pnfpb_ic_fcm_new_comments_post_link',$postlink);
					
						update_option('pnfpb_ic_fcm_new_comments_post_userid',$postuserid);	
						
						update_option('pnfpb_ic_fcm_new_comments_post_authorid',$authorid);
					}
					
					$localpostcontent = str_replace("[member name]", $sender_name, $localpostcontent);
					
					
					if (get_option('pnfpb_onesignal_push') === '1') {
						
						// Update the users who have favorited this activity.
						// 
						$liked_user_ids = array();
						if ( function_exists('bb_activity_is_item_favorite') ) {
						
							$liked_users = bp_activity_get_meta( $activity_id, 'bp_favorite_users', true );
						
							if ( empty( $liked_users ) || ! is_array( $liked_users ) ) {
								$liked_user_ids = array();
							}	else {
								$liked_user_ids = array_map(function($value) {
    								return $value == 1 ? '1pnfpbadm' : strval($value);
								}, $liked_users);						
							}
							
							$target_userid_array = array();
							
							if (count($liked_user_ids) > 0) {
					
								$liked_user_ids_implArray = implode(',',$liked_user_ids);
								
								if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1')  {
							
									$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE userid IN ($liked_user_ids_implArray) AND device_id LIKE '%onesignal%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );
									
								} else {
									
									$target_userid_array_values = $liked_user_ids;
								}
								
								$target_userid_array = array_map(function ($value) {
    								return $value == 1 ? '1pnfpbadm' : $value;
								}, $target_userid_array_values);
								
							}
						
							$response = $this->PNFPB_icfcm_onesignal_push_notification($activity_id,$activitytitle,$localactivitycontent,$activitylink,$imageurl,$target_userid_array);
							
						} else {
							
							$mergeduserids_array = array();
							
							if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1')  {
							
								$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE device_id LIKE '%onesignal%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );
								
								$target_userid_array = array_map(function ($value) {
    								return $value == 1 ? '1pnfpbadm' : $value;
								}, $target_userid_array_values);
								
								$target_myactivities_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE serid = {$authorid} AND device_id LIKE '%onesignal%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,4,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );
								
								$target_myactivities_userid_array = array_map(function ($value) {
    								return $value == 1 ? '1pnfpbadm' : $value;
								}, $target_myactivities_userid_array_values);
								
								$mergeduserids_array = array_merge($target_userid_array,$target_myactivities_userid_array);
									
							}
							
							$response = $this->PNFPB_icfcm_onesignal_push_notification($activity_id,$activitytitle,$localactivitycontent,$activitylink,$imageurl,$mergeduserids_array);
						}
							
					} else {
						
						if (get_option('pnfpb_httpv1_push') !== '1') {
				
						if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1')  {
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );								
							} else {
								$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
							}
					
						}
						else				
						{
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%'" );								
							} else {
								$deviceids=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%'" );
							}
						}
						if (get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1')  {
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceidswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );								
							} else {
								$deviceidswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,3,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)" );
							}
					} else  {
							if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
								$deviceidswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id LIKE '%!!webview%'" );	
							} else {
							$deviceidswebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%!!webview%'" );
							}
						}
				
						/* Logic to get subscribers who subscribed only comments made on my posts */
				
						$deviceidsmypost = [];
				
			
						if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
							$deviceidsmypost=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid = {$authorid} AND device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%!!%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,4,1) = '1')" );

						}
					
						if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
							$deviceidsmypostwebview=$wpdb->get_col( "SELECT DISTINCT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid = {$authorid} AND device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,4,1) = '1')" );

						}					
				
						$mergeddeviceids = array_merge($deviceids,$deviceidsmypost);
					
						$mergeddeviceidswebview = array_merge($deviceids,$deviceidsmypostwebview);
						
					}
	
						$url = 'https://fcm.googleapis.com/fcm/send';

						$regid = $mergeddeviceids;

						if (get_option('pnfpb_httpv1_push') === '1') {
								$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			$commenttitle,
																			mb_substr(stripslashes(strip_tags(trim($localpostcontent))),0,130, 'UTF-8'),
																			$iconurl,
																			$iconurl,
																			$postcommentlink,
																			array('click_url' => $postcommentlink),
																			array(),
																			array(),
																			$postuserid,
																			$authorid,
																			'comments'
																			);
						}
						else {
							if (count($regid) > 0) {
								$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			$commenttitle,
																			mb_substr(stripslashes(strip_tags(trim($localpostcontent))),0,130, 'UTF-8'),
																			$iconurl,
																			$iconurl,
																			$postcommentlink,
																			array(),
																			$regid,
																			array(),
																			$postuserid,
																			$authorid																			 
																			);
							}
							
						}
					
						if (count($mergeddeviceidswebview) > 0 && get_option('pnfpb_httpv1_push') !== '1' && get_option('pnfpb_onesignal_push') !== '1') {
					
							// prepare the message
							$this->PNFPB_icfcm_legacy_send_push_notification(0,
																			$commenttitle,
																			mb_substr(stripslashes(strip_tags(trim($localpostcontent))),0,130, 'UTF-8'),
																			$iconurl,
																			$imageurl,
																			"",
																			array('click_url' => $postcommentlink),
																			array(),
																			$mergeddeviceidswebview,
																			$postuserid,
																			$authorid																			 
																			);
						}
					}	
				}
			}
			else 
			{
				if ($comment_ID && (wp_next_scheduled( 'PNFPB_cron_comments_post_hook' ) 
									|| (as_has_scheduled_action( 'PNFPB_cron_comments_post_hook' )))) {
					
					$commentData = get_comment($comment_ID);
					
					$postData = get_post($commentData->comment_post_ID);
					
					$authorid = $postData->post_author;												
					
					$post_content_push = __("New comments for post - ",'PNFPB_TD').$postData->post_title;
				
					$postuserid = $commentData->user_id;
					
					$postlink = get_permalink($postData->ID);
					
					update_option('pnfpb_ic_fcm_new_comment_id',$comment_ID);
					
					update_option('pnfpb_ic_fcm_new_comment_approved',$comment_approved);
				
					update_option('pnfpb_ic_fcm_new_comments_post_content',$post_content_push);
					
					update_option('pnfpb_ic_fcm_new_comments_post_link',$postlink);
					
					update_option('pnfpb_ic_fcm_new_comments_post_userid',$postuserid);
					
					update_option('pnfpb_ic_fcm_new_comments_post_authorid',$authorid);
					
				}
			}				




?>