<?php
			global $wpdb;
			$imageurl = '';

			$deviceids = array();
							
			$deviceidswebview = array();
			
			if ($post_title === null || wp_next_scheduled( 'PNFPB_cron_post_hook' )
			   || (as_has_scheduled_action( 'PNFPB_cron_post_hook' ))){
				
				$post_type_meta_key = 'pnfpb_push_notification_send_checkbox';
				
				
				$post_title = "[member name] posted new post in ".get_bloginfo( 'name' );
				$post_content = "New content in ".get_bloginfo( 'name' );
				$postlink = get_home_url();
				$authorid = null;
				
				$pnfbp_post_type = $post->post_type;
				
				$recent_posts = wp_get_recent_posts(array(
					'numberposts' => 1, // Number of recent posts thumbnails to display
					'post_status' => 'publish', // Show only the published posts
					'meta_key'	  => $post_type_meta_key,
					'meta_value' => '1',
					'post_type'	=> $pnfbp_post_type
				));
				
				foreach( $recent_posts as $post_item ) {
					// if it is called from scheduled hook for post cron schedule
					$postid = $post_item['ID'];
					$post_title = $post_item['post_title'];
					$post_content = mb_substr(stripslashes(strip_tags(urldecode(trim($post_item['post_content'])))),0,130, 'UTF-8');
					$postlink = get_permalink($post_item['ID']);
					$authorid = $post_item['post_author'];
					$imageurl = get_the_post_thumbnail_url($post_item['ID'], 'full' );
					if (!$imageurl) { 
						$imageurl = '';
					}
				}
	
			}

			if ( has_post_thumbnail($postid) ) {
				$imageurl = get_the_post_thumbnail_url($postid,'full');
				if (!$imageurl) { 
					$imageurl = '';
				}				
			}
			else 
			{
				preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($post_content), $imgresult);
				
				if (is_array($imgresult)) {
					if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
						$imageurl = str_replace('"','',$imgresult[2][0]);
					}
				}					
			}
				

			$apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
			
			if ((($apiaccesskey != '' && $apiaccesskey != false) || get_option('pnfpb_httpv1_push') === '1' || get_option('pnfpb_progressier_push') === '1' || get_option('pnfpb_webtoapp_push') === '1' || (get_option( 'pnfpb_onesignal_push' ) === '1')) && get_permalink( $postid ) && get_permalink( $postid ) != '') {
	
			    $table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
				
				
				if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
					$deviceids_count = $wpdb->get_results("SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)");
				}
				else 
				{
					if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
						
						$deviceids_count = $wpdb->get_results("SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%'");
						
					} else {
						
						$deviceids_count = $wpdb->get_results("SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%'");
						
					}
				}
				
				if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
						
					$deviceids_webview_count = $wpdb->get_results("SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)");
						
				} else {				
					$deviceids_webview_count = $wpdb->get_results("SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL)");
				}
				
			    $activity_content_push = mb_substr(stripslashes(strip_tags(urldecode(trim(htmlspecialchars_decode($post_content))))),0,130, 'UTF-8');
				
				$activity_content_push = preg_replace("/\r|\n/", " ",$activity_content_push);
				
			    $iconurl = get_option ('pnfpb_ic_fcm_upload_icon');
					
				$pnfbp_post_type = 'post';
				if (isset($post)) {
					$pnfbp_post_type = $post->post_type;
				}
				else {
					if (get_option("pnfpb_ic_fcm_new_post_type") && get_option("pnfpb_ic_fcm_new_post_type") != '') {
						$pnfbp_post_type = get_option("pnfpb_ic_fcm_new_post_type");
					}
				}
					
				$sender_name =  '';
					
				if (isset($post) && $post !== null) {
					$authorid = $post->post_author;
					$sender_name = get_the_author_meta( 'display_name', $authorid );
				}
				else {						
					if ($authorid) {
						$sender_name = get_the_author_meta( 'display_name', $authorid );							
					}
				}					
					
				if (get_option("pnfpb_ic_fcm_".$pnfbp_post_type."_title") && get_option("pnfpb_ic_fcm_".$pnfbp_post_type."_title") != '') {
					$post_title = get_option("pnfpb_ic_fcm_".$pnfbp_post_type."_title");

					$post_title = str_replace("[member name]", $sender_name, $post_title);

				}
				else 
				{
					if ($post_title === null || $post_title == '') {
						$post_title = __("New post from ",'PNFPB_TD').get_bloginfo( 'name' );
					}
				}
				
				$post_title = str_replace("[member name]", $sender_name, $post_title);
				
				$activity_content_push = str_replace("[member name]", $sender_name, $activity_content_push);
				
				if (get_option('pnfpb_webtoapp_push') === '1') {
							
					$target_userid_array_values=$wpdb->get_col( "SELECT device_id FROM {$table_name} WHERE (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );					
						
					$response = $this->PNFPB_icfcm_webtoapp_send_push_notification(0,$post_title,$activity_content_push,$postlink,$imageurl,0,'',$target_userid_array_values);
							
				}				
				
				if (get_option('pnfpb_progressier_push') === '1') {
					
					if (get_option('pnfpb_progressier_push') === '1') {
					
						$target_userid_array_values=$wpdb->get_col( "SELECT device_id FROM {$table_name} WHERE device_id LIKE '%progressier%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );					
						
						$response = $this->PNFPB_icfcm_progressier_send_push_notification(0,$post_title,$activity_content_push,$postlink,$imageurl,0,'',$target_userid_array_values);
						
					} 
					
				} else {				
				
					if (get_option('pnfpb_onesignal_push') === '1') {
						
						$target_userid_array = array();
						
						$target_group_userid_array = array();
						
						$target_userid_array_values=$wpdb->get_col( "SELECT userid FROM {$table_name} WHERE device_id LIKE '%onesignal%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000" );
						
						$target_userid_array = array_map(function ($value) {
    						return $value == 1 ? '1pnfpbadm' : $value;
						}, $target_userid_array_values);
						
						$target_group_userid_array = $target_userid_array;
						
						if (($pnfbp_post_type === 'forum' || $pnfbp_post_type === 'reply' || $pnfbp_post_type === 'topic' ) && function_exists('bb_is_member_subscribed_group') && function_exists( 'bbp_is_group_forums_active' ) && function_exists( 'bp_group_is_forum_enabled' )  && bbp_is_group_forums_active() ) {
							
							$bb_target_userid_array = array();
							
							$forum_id = null;
							
							$post_id = intval($postid);

							if ( 'reply' === $pnfbp_post_type ) {
								$topic_id = $post->post_parent;
								$forum_id = bbp_get_topic_forum_id( $topic_id );

							} else {
								if ( 'topic' === $pnfbp_post_type) {
									$topic_id = $post->post_parent;
									$forum_id = bbp_get_topic_forum_id( $topic_id );

								}
							}
							
							$group_ids = get_post_meta( $forum_id, '_bbp_group_ids', true );
							
							// Make sure result is an array.
							if ( ! is_array( $group_ids ) ) {
								$group_ids = (array) $group_ids;
							}

							// Trim out any empty array items.
							$group_ids = array_filter( $group_ids );
							
							for($ig = 0; $ig < count($group_ids); $ig++) {
								
								$bbp_bp_group_id = $group_ids[$ig];
								
								for($i = 0; $i < count($target_group_userid_array); $i++) {
									
									if ( bb_is_member_subscribed_group($bbp_bp_group_id, $target_group_userid_array[$i] )) {
								
										array_push($bb_target_userid_array,$target_group_userid_array[$i]);
									}
									
								}
								
								if (count($bb_target_userid_array) > 0) {
							
									$response = $this->PNFPB_icfcm_onesignal_push_notification($postid,$post_title,$activity_content_push,$postlink,$imageurl,$bb_target_userid_array);	
									
								}
								
							}
						
						} else {
							
							if (count($target_userid_array) > 0) {							
						
								$response = $this->PNFPB_icfcm_onesignal_push_notification($postid,$post_title,$activity_content_push,$postlink,$imageurl,$target_userid_array);
								
							}
							
						}
							
					} else {
						
						$target_group_userid_array = $wpdb->get_col( "SELECT userid FROM {$table_name} WHERE device_id NOT LIKE '%onesignal%' LIMIT 1000");
						
						if (get_option('pnfpb_httpv1_push') !== '1') {
				
							for ($dcount=0; $dcount<=count($deviceids_count); $dcount+=1000) {
							
								$bb_target_userid_array = array();
							
								$deviceids = array();
							
								$deviceidswebview = array();
							
								$buddyboss_pnfpb = false;
							
								if (($pnfbp_post_type === 'forum' || $pnfbp_post_type === 'reply' || $pnfbp_post_type === 'topic' ) && function_exists('bb_is_member_subscribed_group') && function_exists( 'bbp_is_group_forums_active' ) && function_exists( 'bp_group_is_forum_enabled' )  && bbp_is_group_forums_active() ) {
							
									$buddyboss_pnfpb = true;
								
									$bb_target_userid_array = array();
							
									$forum_id = null;
								
									$post_id = intval($postid);

									if ( 'reply' === $pnfbp_post_type ) {
										$topic_id = $post->post_parent;
										$forum_id = bbp_get_topic_forum_id( $topic_id );

									} else {
										if ( 'topic' === $pnfbp_post_type) {
											$topic_id = $post->post_parent;
											$forum_id = bbp_get_topic_forum_id( $topic_id );

										}
									}

							
									$group_ids = get_post_meta( $forum_id, '_bbp_group_ids', true );
							
							
									// Make sure result is an array.
									if ( ! is_array( $group_ids ) ) {
										$group_ids = (array) $group_ids;
									}

									// Trim out any empty array items.
									$group_ids = array_filter( $group_ids );
							
							
									for($ig = 0; $ig < count($group_ids); $ig++) {
								
										$bbp_bp_group_id = $group_ids[$ig];
								
						
										for($i = 0; $i < count($target_group_userid_array); $i++) {
									
						
											if ( bb_is_member_subscribed_group($bbp_bp_group_id, $target_group_userid_array[$i] )) {
								
												array_push($bb_target_userid_array,$target_group_userid_array[$i]);
											}
									
										}
								
						
									}
								
								}

								if (get_option('pnfpb_shortcode_enable') === 'yes' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1') {
									
									if(count($bb_target_userid_array) > 0) {
										
										$bb_target_userid_implArray = implode(",",$bb_target_userid_array);
										
										$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%!!%' AND userid IN ($bb_target_userid_implArray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );										
										
									} else {
										
										if (!$buddyboss_pnfpb) {
											$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%!!%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
										}
										
									}
									
								}
								else
								{
									if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
										
										if(count($bb_target_userid_array) > 0) {
											
											$bb_target_userid_implArray = implode(",",$bb_target_userid_array);
											
											$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND userid IN ($bb_target_userid_implArray) LIMIT {$dcount}, 1000" );
											
										}
										else {
											if (!$buddyboss_pnfpb) {
												$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' LIMIT {$dcount}, 1000" );
											}
										}
									
									} else {

										if(count($bb_target_userid_array) > 0) {
											
											$bb_target_userid_implArray = implode(",",$bb_target_userid_array);
											
											$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' AND userid IN ($bb_target_userid_implArray) LIMIT {$dcount}, 1000" );
											
										} else {
											if (!$buddyboss_pnfpb) {
												$deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%!!webview%' AND device_id NOT LIKE '%@N%' AND device_id NOT LIKE '%!!%' LIMIT {$dcount}, 1000" );
											}
										}
									
									}
								}
							

								if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {

									if(count($bb_target_userid_array) > 0) {
									
										$bb_target_userid_implArray = implode(",",$bb_target_userid_array);
									
										$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND userid IN ($bb_target_userid_implArray) AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );									

									} else { 
										if (!$buddyboss_pnfpb) {
											$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
										}
									
									}
								
								} else {
								
									if(count($bb_target_userid_array) > 0) {
									
										$bb_target_userid_implArray = implode(",",$bb_target_userid_array);
									
										$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND userid IN ($bb_target_userid_implArray)  AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );									
									
									} else {
										if (!$buddyboss_pnfpb) {
											$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
										}
									}
								
								}

								$url = 'https://fcm.googleapis.com/fcm/send';

								$regid = $deviceids;
								$ownerid = 0;
								$targetid= 0;

								if (count($regid) > 0) {
									
									$this->PNFPB_icfcm_legacy_send_push_notification(0,
																				 stripslashes(strip_tags($post_title)),
																				 stripslashes(strip_tags($activity_content_push)),
																				 $iconurl,
																				 $imageurl,
																				 $postlink,
																				 array(),
																				 $regid,
																				 array(),
																				 $ownerid,
																			     $targetid																					 
																				);
						
									do_action('PNFPB_connect_to_external_api_for_post');
								}
						
							}
						}
					
						if (get_option('pnfpb_httpv1_push') === '1') {
						
							$dcount = 0;
							
							$bb_target_userid_array = array();
							
							$deviceids = array();
							
							$deviceidswebview = array();
							
							$buddyboss_pnfpb = false;
							
							$url = 'https://fcm.googleapis.com/fcm/send';

							$regid = $deviceids;
							$ownerid = 0;
							$targetid= 0;
							
							$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			stripslashes(strip_tags($post_title)),
																			stripslashes(strip_tags($activity_content_push)),
																			$iconurl,
																			$imageurl,
																			$postlink,
																			array('click_url' => $postlink),
																			$regid,
																			$deviceidswebview,
																			$ownerid,
																			$targetid,
																			$pnfbp_post_type
																			);
							
							$table = $wpdb->prefix.'pnfpb_ic_schedule_push_notifications';
							
							$bpuserid = 0;
	
							if ( is_user_logged_in() ) {
		
    							$bpuserid = get_current_user_id();
							}							
							
							$data = array('userid' => $bpuserid,
							  	  'action_scheduler_id' => NULL,
								  'title' => stripslashes(strip_tags($post_title)),
								  'content' => stripslashes(strip_tags($activity_content_push)),
								  'image_url' => $imageurl,
								  'click_url' => $postlink,
								  'scheduled_timestamp' => time(),
							  	  'scheduled_type' => 'onetime post',
							  	  'status'	=> 'sent'
								 );
							
							$insertid = $wpdb->insert($table,$data);							
						
							do_action('PNFPB_connect_to_external_api_for_post');
						}
					
						if (get_option('pnfpb_httpv1_push') !== '1') {
				
							for ($dcount=0; $dcount<=count($deviceids_webview_count); $dcount+=1000) {
				
								if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
									
									if(count($bb_target_userid_array) > 0) {
										
										$bb_target_userid_implArray = implode(",",$bb_target_userid_array);
										
										$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND userid IN ($bb_target_userid_implArray)  AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );										
									}
									else {
										if (!$buddyboss_pnfpb) {
											$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
										}
										
									}
									
								} else {
								
									if(count($bb_target_userid_array) > 0) {
										$bb_target_userid_implArray = implode(",",$bb_target_userid_array);
										$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE userid > 0 AND device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND userid IN ($bb_target_userid_implArray)  AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );									
									}
									else {
										if (!$buddyboss_pnfpb) {
											$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%' AND device_id LIKE '%!!webview%' AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,2,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT {$dcount}, 1000" );
										}
									}
								}
				
								if (count($deviceidswebview) > 0) {				
									// prepare the message
									$this->PNFPB_icfcm_legacy_send_push_notification(0,
																				 stripslashes(strip_tags($post_title)),
																				 stripslashes(strip_tags($activity_content_push)),
																				 $iconurl,
																				 $imageurl,
																				 $postlink,
																				 array('click_url' => $postlink),
																				 array(),
																				 $deviceidswebview,
																				 $ownerid,
																			     $targetid																						 
																				);
						
									do_action('PNFPB_connect_to_external_api_for_post_webview');
								}
							}
						}
					}
				}
			}
?>