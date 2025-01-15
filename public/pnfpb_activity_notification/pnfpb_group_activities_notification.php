<?php

		/**
		* Triggered after creating activity under group in BuddyPress to send push notifications
		* Opt in/out for the notification can be controlled from plugin settings.		
		*
		*
		* @param string   $content 		Activity content
		* @param numeric  $user_id 		USER ID
		* @param numeric  $group_id		GROUP ID
		* @param numeric  $activity_id	Activity ID
		*
		*
		* @since 1.0.0
		*/

            $apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
			
			$bactivity = 0;

			$deviceidswebview = array();
				
			$deviceids = array();
			
			$blog_title = get_bloginfo( 'name' );

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
			
			global $wpdb;
        	
			if ((($content && (false === as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' )))
				 || ($content===null && (as_has_scheduled_action( 'PNFPB_cron_buddypressactivities_hook' )))) 
				&& (($bactivity == 1 &&  get_option('pnfpb_ic_fcm_buddypress_enable') == 1 && ($apiaccesskey != '' && $apiaccesskey != false)) || 
				($bactivity == 1 && get_option('pnfpb_ic_fcm_buddypress_enable') == 1 && (get_option( 'pnfpb_onesignal_push' ) === '1' || 
				get_option('pnfpb_httpv1_push') === '1' || get_option('pnfpb_progressier_push') === '1' || get_option('pnfpb_webtoapp_push') === '1')))) {
				
				preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($content), $imgresult);
				
				$imageurl = '';
				
				if (is_array($imgresult)) {
					if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
						$imageurl = str_replace('"','',$imgresult[2][0]);
						update_option('pnfpb_ic_fcm_new_buddypressactivities_image',$imageurl);
					}
				}				

				$bpgroup = '';
				$grouplink = get_home_url();
				if (function_exists('bp_is_active')){
					$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;
				}
				
				$group_name = '';
				
				if ($group_id && !wp_next_scheduled( 'PNFPB_cron_buddypressgroupactivities_hook' )) {
					
					$bpgroup = groups_get_group( array( 'group_id' => $group_id) );

					$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;
					
					$bpgroupid = $group_id;
					
					$group_name = bp_get_group_name( groups_get_group( $bpgroupid));
				}
				
				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
				
				if ($content) {
					
					$localactivitycontent = $content;
					
				}
				else 
				{
					$cron_get_scheduled_activities = bp_activity_get( $args = array('per_page' => 1,'sort'=> 'DESC','filter' => array('primary_id'   => $group_id)) );
					
					foreach ( $cron_get_scheduled_activities['activities'] as $activity ) {
							
						$localactivitycontent = substr(stripslashes(wp_strip_all_tags(urldecode($activity->content))),0,80);
							
						$activitylink = bp_activity_get_permalink( $activity->id, $activity );
								
						$user_id = $activity->user_id;
					}
				}				
				$imageurl = '';
				
				$group_name = bp_get_group_name( groups_get_group( $group_id));
				
				$grouptitle = '[member name]'.esc_html( __(' posted activity in group ',"push-notification-for-post-and-buddypress")).$group_name;
				
				$sender_name = '';
			
				if (get_option('pnfpb_ic_fcm_group_activity_title') != false && get_option('pnfpb_ic_fcm_group_activity_title') != '') {
					
					$grouptitle = get_option('pnfpb_ic_fcm_group_activity_title');
					
				}
				
				if ($user_id !== null) {
					
					$sender_name = bp_core_get_user_displayname( $user_id );
					
					$grouptitle = str_replace("[member name]", $sender_name, $grouptitle);
					
					$grouptitle = str_replace("[group name]", $group_name, $grouptitle);
					
				}
           
				$grouplink = get_home_url();
				if (function_exists('bp_is_active')){
					$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;
				}
				
				if (strpos($content, "[bpfb_images]") !== false) {
    
					$bpfbimagesstart = strpos($localactivitycontent, "[bpfb_images]");
    
					$bpfbimagesend = strrpos($localactivitycontent, "[/bpfb_images]");
    
					$bpfbimagestaglength = ($bpfbimagesend+17) - $bpfbimagesstart;
    
					$localactivitycontent = wp_strip_all_tags(urldecode(substr_replace($content,"",$bpfbimagesstart,$bpfbimagestaglength)));

				}
				
				if ($content) {
					preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($localactivitycontent), $imgresult);
					$imageurl = '';
				
					if (is_array($imgresult)) {
						if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
							$imageurl = str_replace('"','',$imgresult[2][0]);
						}
					}
				}
				
				
				if (get_option('pnfpb_ic_fcm_group_activity_message') != false && get_option('pnfpb_ic_fcm_group_activity_message') != '') {
					
					if ($content) {
						$localactivitycontent = get_option('pnfpb_ic_fcm_group_activity_message');
					} else {
						$localactivitycontent .= get_option('pnfpb_ic_fcm_group_activity_message');
					}
					
				}	
		
				$localactivitycontent = str_replace("[member name]", $sender_name, $localactivitycontent);
				
				if (get_option('pnfpb_progressier_push') === '1') {
					
					$target_userid_array_values=$wpdb->get_col($wpdb->prepare( "SELECT device_id FROM %i WHERE device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",$table_name,'%progressier%' ));
					
					if (get_option('pnfpb_ic_fcm_activity_schedule_now_enable') && get_option('pnfpb_ic_fcm_activity_schedule_now_enable') === '1') {
					
						$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_progressier_schedule_push_notification_hook', array(0, $group_title, $localactivitycontent, $grouplink, $imageurl, 0, '', $target_userid_array_values));
						
					} else {
						
						$response = $this->PNFPB_icfcm_progressier_send_push_notification(0,$group_title,$localactivitycontent,$grouplink,$imageurl,0,'',$target_userid_array_values);
						
					}
						
				}
				
				if (get_option('pnfpb_webtoapp_push') === '1') {
					
					$target_userid_array_values=$wpdb->get_col($wpdb->prepare( "SELECT device_id FROM %i WHERE (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",$table_name) );
					
					if (get_option('pnfpb_ic_fcm_activity_schedule_now_enable') && get_option('pnfpb_ic_fcm_activity_schedule_now_enable') === '1') {
					
							$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_webtoapp_schedule_push_notification_hook', array(0, $group_title, $localactivitycontent, $grouplink, $imageurl, $target_userid_array_values, '', ''));
						
					} else {
						
						$response = $this->PNFPB_icfcm_webtoapp_send_push_notification(0, $group_title, $localactivitycontent, $grouplink, $imageurl, $target_userid_array_values, '', '');
						
					}
						
				}				

				if (get_option('pnfpb_onesignal_push') === '1' && get_option('pnfpb_progressier_push') !== '1' ) {
					
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
											array_push($target_userid_array,"$target_userid");
											
										}								
        							}
								}
							}	
						}					
					
					if (((get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') 
					|| get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') 
					&& (($pos = strpos($localactivitycontent, "@")) === FALSE)) {

						$target_userid_array_values=$wpdb->get_col($wpdb->prepare( "SELECT userid FROM %i WHERE device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",$table_name,'%onesignal%' ) );
						
						$target_userid_array = array_map(function ($value) {
    						return $value == 1 ? '1pnfpbadm' : $value;
						}, $target_userid_array_values);						
					}
					
					if (get_option('pnfpb_ic_fcm_activity_schedule_now_enable') && get_option('pnfpb_ic_fcm_activity_schedule_now_enable') === '1') {
					
						$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_onesignal_schedule_push_notification_hook', array($activity_id, $grouptitle, $localactivitycontent, $grouplink, $imageurl, $target_userid_array));
						
					} else {
						
						$response = $this->PNFPB_icfcm_onesignal_push_notification($activity_id,$grouptitle,$localactivitycontent,$grouplink,$imageurl,$target_userid_array);
						
					}

			
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
								$pushtype = 'privatemessages';
							
								$url = 'https://fcm.googleapis.com/fcm/send';
							

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
									
									$deviceids=$wpdb->get_col($wpdb->prepare( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE  %s AND userid = %d",$table_name,'%!!%','%@N%',$target_userid));

									$regid = $deviceids;
									
									$deviceidswebview=$wpdb->get_col($wpdb->prepare( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id LIKE %s AND device_id NOT LIKE %s AND userid = %d",$table_name,'%webview%','%@N%',$target_userid));

									$regidwebview = $deviceidswebview;
									
									if (get_option('pnfpb_ic_fcm_activity_schedule_now_enable') && get_option('pnfpb_ic_fcm_activity_schedule_now_enable') === '1') {
									
										$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_httpv1_schedule_push_notification_hook', array(0,
																			stripslashes(wp_strip_all_tags($grouptitle)),
																			stripslashes(wp_strip_all_tags($localactivitycontent)),
																			$iconurl,
																			$imageurl,
																			$grouplink,
																			array('click_url' => $grouplink),
																			$regid,
																			$regidwebview,
																			$user_id,
																			$target_userid,
																			$pushtype));
									} else {
										
										$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			stripslashes(wp_strip_all_tags($grouptitle)),
																			stripslashes(wp_strip_all_tags($localactivitycontent)),
																			$iconurl,
																			$imageurl,
																			$grouplink,
																			array('click_url' => $grouplink),
																			$regid,
																			$regidwebview,
																			$user_id,
																			$target_userid,
																			$pushtype
																			);
										
									}

									
								}
							
						} 
					
						if (get_option('pnfpb_httpv1_push') === '1') {
						
									$dcount = 0;

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
								
									$regid = array();
									$deviceidswebview = array();
						
									if (get_option('pnfpb_ic_fcm_activity_schedule_now_enable') && get_option('pnfpb_ic_fcm_activity_schedule_now_enable') === '1') {
						
										$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_httpv1_schedule_push_notification_hook', array(0,
																			stripslashes(wp_strip_all_tags($grouptitle)),
																			stripslashes(wp_strip_all_tags($localactivitycontent)),
																			$iconurl,
																			$imageurl,
																			$grouplink,
																			array('click_url' => $grouplink),
																			$regid,
																			$deviceidswebview,
																			$user_id,
																			0,
																			'activity',
																			'no',
																			$group_id));
										
									} else {
										
										$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			stripslashes(wp_strip_all_tags($grouptitle)),
																			stripslashes(wp_strip_all_tags($localactivitycontent)),
																			$iconurl,
																			$imageurl,
																			$grouplink,
																			array('click_url' => $grouplink),
																			$regid,
																			$deviceidswebview,
																			$user_id,
																			0,
																			'activity',
																			'no',
																			$group_id
																			);
										
									}
						

								do_action('PNFPB_connect_to_external_api_for_group');

						}
					
					}
				}
			}
			else
			{
				if ((($content && (false === as_has_scheduled_action( 'PNFPB_cron_buddypressgroupactivities_hook' ))) || ($content===null && (as_has_scheduled_action( 'PNFPB_cron_buddypressgroupactivities_hook' )))) && ($bactivity == 1 && get_option('pnfpb_ic_fcm_buddypress_enable') == 2 && get_option('pnfpb_progressier_push') !== '1' && ($apiaccesskey != '' && $apiaccesskey != false) || ($bactivity == 1 && get_option('pnfpb_ic_fcm_buddypress_enable') == 2 && get_option('pnfpb_progressier_push') !== '1' && (get_option( 'pnfpb_onesignal_push' ) === '1' || get_option('pnfpb_httpv1_push') === '1' || get_option('pnfpb_webtoapp_push') === '1')))) {
					
					preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($content), $imgresult);
				
					$imageurl = '';
				
					if (is_array($imgresult)) {
						if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
							$imageurl = str_replace('"','',$imgresult[2][0]);
							update_option('pnfpb_ic_fcm_new_buddypressactivities_image',$imageurl);
						}
					}					
					
					$bpgroup = '';
					$grouplink = get_home_url();
					if (function_exists('bp_is_active')){
						$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;
					}
					
					$bpgroupid = null;

					if ($group_id) {
	
						$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;

						$bpgroupid = $group_id;
						
					}
					else 
					{
						$bpgroupid = strval(get_option('pnfpb_ic_fcm_new_buddypressgroup_id'));


						$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;
	
					}
	
					$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
					if ($content) {
					
						$localactivitycontent = $content;
					
					}
					else 
					{
						$cron_get_scheduled_activities = bp_activity_get( $args = array('per_page' => 1,'sort'=> 'DESC','filter' => array('primary_id'   => $bpgroupid)) );
					
						foreach ( $cron_get_scheduled_activities['activities'] as $activity ) {
							
							$localactivitycontent = substr(stripslashes(wp_strip_all_tags(urldecode($activity->content))),0,80);
							
							$activitylink = bp_activity_get_permalink( $activity->id, $activity );
								
							$user_id = $activity->user_id;
						}
					}				
					$imageurl = '';
				
					$group_name = bp_get_group_name( groups_get_group( $bpgroupid));
				
					$grouptitle = '[member name]'.esc_html( __(' posted activity in group ',"push-notification-for-post-and-buddypress")).$group_name;
				
					$sender_name = '';
			
					if (get_option('pnfpb_ic_fcm_group_activity_title') != false && get_option('pnfpb_ic_fcm_group_activity_title') != '') {
					
						$grouptitle = get_option('pnfpb_ic_fcm_group_activity_title');
					
					}
				
					if ($user_id !== null) {
					
						$sender_name = bp_core_get_user_displayname( $user_id );
					
						$grouptitle = str_replace("[member name]", $sender_name, $grouptitle);
						
						$grouptitle = str_replace("[group name]", $group_name, $grouptitle);
					
					}
					
           
					$grouplink = get_home_url();
					
					if (function_exists('bp_is_active')){
						
						$grouplink = get_home_url().'/'.buddypress()->pages->activity->slug;
					}

					
					preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($localactivitycontent), $imgresult);
					
					$imageurl = '';
				
					if (is_array($imgresult)) {
						
						if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
							
							$imageurl = str_replace('"','',$imgresult[2][0]);
							
						}
					}
					
					if (get_option('pnfpb_ic_fcm_group_activity_message') != false && get_option('pnfpb_ic_fcm_group_activity_message') != '') {
					
						if ($content) {
							
							$localactivitycontent = get_option('pnfpb_ic_fcm_group_activity_message');
							
						} else {
							
							$localactivitycontent .= get_option('pnfpb_ic_fcm_group_activity_message');
							
						}
					
					}					
				
					$localactivitycontent = str_replace("[member name]", $sender_name, $localactivitycontent);
					
					$localactivitycontent = str_replace("[group name]", $group_name, $localactivitycontent);
					
					if (get_option('pnfpb_progressier_push') === '1') {
					
						$target_userid_array_values=$wpdb->get_col( "SELECT DISTINCT(device_id) FROM %i WHERE device_id LIKE %s AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",$table_name,'%progressier%','%!!'.$bpgroupid.'!!%' );

						if (get_option('pnfpb_ic_fcm_activity_schedule_now_enable') && get_option('pnfpb_ic_fcm_activity_schedule_now_enable') === '1') {
						
							$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_progressier_schedule_push_notification_hook', array(0, $group_title, $localactivitycontent, $grouplink, $imageurl, 0, '', $target_userid_array_values));
							
						} else {
							
							$response = $this->PNFPB_icfcm_progressier_send_push_notification(0, $group_title, $localactivitycontent, $grouplink, $imageurl, 0, '', $target_userid_array_values);
							
						}
					
					}
					
					if (get_option('pnfpb_webtoapp_push') === '1') {
					
						$target_userid_array_values=$wpdb->get_col( "SELECT DISTINCT(device_id) FROM %i WHERE (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",$table_name );
						
						if (get_option('pnfpb_ic_fcm_activity_schedule_now_enable') && get_option('pnfpb_ic_fcm_activity_schedule_now_enable') === '1') {
						
							$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_webtoapp_schedule_push_notification_hook', array(0, $group_title, $localactivitycontent, $grouplink, $imageurl, $target_userid_array_values, '', ''));
							
						} else {
							
							$response = $this->PNFPB_icfcm_webtoapp_send_push_notification(0, $group_title, $localactivitycontent, $grouplink, $imageurl, $target_userid_array_values, '', '');
							
						}
					
					}					
					
					if (get_option('pnfpb_onesignal_push') === '1' && get_option('pnfpb_progressier_push') !== '1' ) {
						
						// Update the users who have favorited this activity.

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
											array_push($target_userid_array,"$target_userid");
											
										}								
        							}
								}
							}
						
						}
						else 
						{
						
							$target_userid_array = array();
							
							if ( function_exists('bb_activity_is_item_favorite') ) {
						
								$members = groups_get_group_members(
										array(
											'group_id' => $bpgroupid,
											'exclude_admins_mods' => false,
										)
									);

								$members = $members['members'];

								foreach ( $members as $member ) {
									array_push($gg_target_userid_array,$member->ID);
								}
							
								$gg_target_userid_implArray = implode(",",$gg_target_userid_array);
								
								$target_userid_array_values = $gg_target_userid_array;
								
							} else {
							
								$target_userid_array_values=$wpdb->get_col($wpdb->prepare( "SELECT DISTINCT(userid) FROM %i WHERE device_id LIKE %s AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",$table_name,'%onesignal%','%!!'.$bpgroupid.'!!%' ));
								
							}
							
							$target_userid_array = array_map(function ($value) {
    							return $value == 1 ? '1pnfpbadm' : $value;
							}, $target_userid_array_values);							
							
						}
						
						if (count($target_userid_array) > 0) {
							
							if (get_option('pnfpb_ic_fcm_activity_schedule_now_enable') && get_option('pnfpb_ic_fcm_activity_schedule_now_enable') === '1') {
							
								$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_onesignal_schedule_push_notification_hook', array($group_id, $grouptitle, $localactivitycontent, $grouplink, $imageurl, $target_userid_array));
								
							} else {
								
								$response = $this->PNFPB_icfcm_onesignal_push_notification($group_id,$grouptitle,$localactivitycontent,$grouplink,$imageurl,$target_userid_array);
								
							}
						
						}
							
					} else {
						
						if (get_option('pnfpb_progressier_push') !== '1') {
						
							$target_userid = 0;
						
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
									
									$deviceids=$wpdb->get_col($wpdb->prepare( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id LIKE %s AND device_id NOT LIKE %s AND userid = %d",$table_name,'%webview%','%!!'.$bpgroupid.'!!%','%@N%',$target_userid));
										

									$regid = $deviceids;
									
									$deviceidswebview=$wpdb->get_col($wpdb->prepare( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id LIKE %s AND device_id LIKE %s AND device_id NOT LIKE %s AND userid = %d",$table_name,'%webview%','%!!'.$bpgroupid.'!!%','%@N%',$target_userid));

									$regidwebview = $deviceidswebview;
									
									if (get_option('pnfpb_ic_fcm_activity_schedule_now_enable') && get_option('pnfpb_ic_fcm_activity_schedule_now_enable') === '1') {
									
										$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_httpv1_schedule_push_notification_hook', array(0,
																			stripslashes(wp_strip_all_tags($grouptitle)),
																			stripslashes(wp_strip_all_tags($localactivitycontent)),
																			$iconurl,
																			$imageurl,
																			$grouplink,
																			array('click_url' => $grouplink),
																			$regid,
																			$regidwebview,
																			$user_id,
																			$target_userid,
																			$pushtype));
										
									} else {
										
										$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			stripslashes(wp_strip_all_tags($grouptitle)),
																			stripslashes(wp_strip_all_tags($localactivitycontent)),
																			$iconurl,
																			$imageurl,
																			$grouplink,
																			array('click_url' => $grouplink),
																			$regid,
																			$regidwebview,
																			$user_id,
																			$target_userid,
																			$pushtype
																			);
										
									}

								}
							
							}
						
							if (get_option('pnfpb_httpv1_push') === '1') {

									$dcount = 0;

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
							
									if (get_option('pnfpb_ic_fcm_activity_schedule_now_enable') && get_option('pnfpb_ic_fcm_activity_schedule_now_enable') === '1') {
					
										$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_httpv1_schedule_push_notification_hook', array(0,
																		stripslashes(wp_strip_all_tags($grouptitle)),
																		stripslashes(wp_strip_all_tags($localactivitycontent)),
																		$iconurl,
																		$imageurl,
																		$grouplink,
																		array('click_url' => $grouplink),
																		array(),
																		array(),
																		$user_id,
																		0,
																		'groupactivity',
																		'yes',
																		$group_id));
									} else {
										
										$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																		stripslashes(wp_strip_all_tags($grouptitle)),
																		stripslashes(wp_strip_all_tags($localactivitycontent)),
																		$iconurl,
																		$imageurl,
																		$grouplink,
																		array('click_url' => $grouplink),
																		array(),
																		array(),
																		$user_id,
																		0,
																		'groupactivity',
																		'yes',
																		$group_id																					 
																		);
										
									}
								
									do_action('PNFPB_connect_to_external_api_for_group');

							}
						
						}
					}	
				}
				else {
					update_option('pnfpb_ic_fcm_new_buddypressgroup_id', $group_id);
				}
			}
?>