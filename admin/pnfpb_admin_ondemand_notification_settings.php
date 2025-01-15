<?php
/**
* Plugin settings area to send one time/on demand push notification to all subscribers
*
* @since 1.21
*/
?>

<h1 class="pnfpb_ic_push_settings_header"><?php echo esc_html( __("PNFPB - On demand/one time push notification","push-notification-for-post-and-buddypress"));?></h1>
<div class="nav-tab-wrapper">
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb-icfcm-slug" class="nav-tab tab"><?php echo esc_html( __("Push Settings","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_device_tokens_list" class="nav-tab tab "><?php echo esc_html( __("Device tokens","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_pwa_app_settings" class="nav-tab tab "><?php echo esc_html( __("PWA","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfmtest_notification" class="nav-tab nav-tab-active tab active"><?php echo esc_html( __("Send push notification","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc" class="nav-tab tab"><?php echo esc_html(__("Push Notifications list","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_frontend_settings" class="nav-tab tab"><?php echo esc_html( __("Frontend subscription settings","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_button_settings" class="nav-tab tab "><?php echo esc_html(__("Customize buttons","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_integrate_app" class="nav-tab tab "><?php echo esc_html(__("Integrate Mobile app","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_settings_for_ngnix_server" class="nav-tab tab "><?php echo esc_html(__("NGINX","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_action_scheduler&s=pnfpb&action=-1&paged=1&action2=-1" class="nav-tab tab "><?php echo esc_html(__("Action Scheduler","push-notification-for-post-and-buddypress"));?></a>
</div>
<div class="pnfpb_column_1200">
<h2 class="pnfpb_ic_push_settings_details"><?php echo esc_html(__("To send on demand or one time push notification to all subscribers with image","push-notification-for-post-and-buddypress"));?></h2>

<?php
		// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery
		$onetime_push_id = '';
		$onetime_push_title = '';
		$onetime_push_content = '';
		$onetime_push_imageurl = '';
		$onetime_push_clickurl = '';
		$onetime_push_time = '';
		$onetime_push_status = '';
	
		$onetime_recurring_day_number = '';
		$onetime_recurring_month_number = '';
		$onetime_recurring_day_name = '';
	
		$onetime_push_date_field = '';
		$onetime_push_time_field = '';
	
		global $wpdb;
	
		if( isset($_POST['submit']) && isset($_POST['pnfpb_ic_on_demand_push_title']) && isset($_POST['pnfpb_ic_on_demand_push_content']))
        {
		
			$apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
			
			if (($apiaccesskey != '' && $apiaccesskey != false)  || get_option('pnfpb_httpv1_push') === '1' || (get_option( 'pnfpb_onesignal_push' ) === '1') || (get_option( 'pnfpb_progressier_push' ) === '1') || (get_option( 'pnfpb_webtoapp_push' ) === '1')) {
	
			    	$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
			   		$deviceids=$wpdb->get_col($wpdb->prepare("SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE %s",$table_name,'%webview%','%@N%' ));
				
					$deviceidswebview=$wpdb->get_col($wpdb->prepare( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id LIKE %s AND device_id NOT LIKE %s",$table_name,'%webview%','%@N%' ));
	
			    	$url = 'https://fcm.googleapis.com/fcm/send';

			    	$regid = $deviceids;
	
			    	$activity_content_push = wp_strip_all_tags(urldecode(wp_unslash(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_content']))));
				
			   	 	$imageurl = '';
                	if (isset($_POST['pnfpb_ic_on_demand_push_image_url'])) {

                    	$imageurl = sanitize_text_field($_POST['pnfpb_ic_on_demand_push_image_url']);
               	 	}

                	$postlink = get_home_url();
                	if (isset($_POST['pnfpb_ic_on_demand_push_url_link'])) {
                    	$postlink = sanitize_text_field($_POST['pnfpb_ic_on_demand_push_url_link']);
                	}
				
					if (get_option('pnfpb_webtoapp_push') === '1') {
						
						if (isset($_POST['pnfpb_ic_fcm_ondemand_schedule_now_enable']) && $_POST['pnfpb_ic_fcm_ondemand_schedule_now_enable'] === '1') {
						
							$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_webtoapp_schedule_push_notification_hook', array(0, stripslashes(wp_strip_all_tags(wp_unslash(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_title'])))), $activity_content_push, $postlink, $imageurl));	
							
						} else {
							
							$response = $this->PNFPB_icfcm_webtoapp_send_push_notification(0, stripslashes(wp_strip_all_tags(wp_unslash(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_title'])))), $activity_content_push, $postlink, $imageurl);
							
						}
					

					}				
				
					if (get_option('pnfpb_progressier_push') === '1') {
						
						if (isset($_POST['pnfpb_ic_fcm_ondemand_schedule_now_enable']) && $_POST['pnfpb_ic_fcm_ondemand_schedule_now_enable'] === '1') {
						
							$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_progressier_schedule_push_notification_hook', array(0, stripslashes(wp_strip_all_tags(wp_unslash(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_title'])))), $activity_content_push, $postlink, $imageurl));
							
						} else {
							
							$response = $this->PNFPB_icfcm_progressier_send_push_notification(0, stripslashes(wp_strip_all_tags(wp_unslash(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_title'])))), $activity_content_push, $postlink, $imageurl);
							
						}
						
					
					} else {
				
						if (get_option('pnfpb_onesignal_push') === '1') {
							
							if (isset($_POST['pnfpb_ic_fcm_ondemand_schedule_now_enable']) && $_POST['pnfpb_ic_fcm_ondemand_schedule_now_enable'] === '1') {
							
								$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_onesignal_schedule_push_notification_hook', array(0, stripslashes(wp_strip_all_tags(wp_unslash(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_title'])))), $activity_content_push, $postlink, $imageurl));
								
							} else {
								
								$response = $this->PNFPB_icfcm_onesignal_push_notification(0, stripslashes(wp_strip_all_tags(wp_unslash(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_title'])))), $activity_content_push, $postlink, $imageurl);
								
							}
						
							
						} else {				
				
						if (count($regid) > 0) {
							if (get_option('pnfpb_httpv1_push') === '1') {
								
								if (isset($_POST['pnfpb_ic_fcm_ondemand_schedule_now_enable']) && $_POST['pnfpb_ic_fcm_ondemand_schedule_now_enable'] === '1') {
								
									$action_scheduler_status = as_schedule_single_action( time(), 'PNFPB_httpv1_schedule_push_notification_hook', array(0,
																			stripslashes(wp_strip_all_tags(wp_unslash(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_title'])))),
																			mb_substr(stripslashes(wp_strip_all_tags(urldecode(trim(htmlspecialchars_decode($activity_content_push))))),0,130, 'UTF-8'),
																			$imageurl,
																			$imageurl,
																			$postlink,
																			array('click_url' => $postlink),
																			$regid,
																			array(),
																			0,
																			0,
																			'ondemand'));
									
								} else {
									
									$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			stripslashes(wp_strip_all_tags(wp_unslash(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_title'])))),
																			mb_substr(stripslashes(wp_strip_all_tags(urldecode(trim(htmlspecialchars_decode($activity_content_push))))),0,130, 'UTF-8'),
																			$imageurl,
																			$imageurl,
																			$postlink,
																			array('click_url' => $postlink),
																			$regid,
																			array(),
																			0,
																			0,
																			'ondemand'
																			);
									
								}
								
							}

						}
						
					}
				
				}
				
				$bpuserid = 0;
	
				if ( is_user_logged_in() ) {
		
    					$bpuserid = get_current_user_id();
				}					
					
				$table = $wpdb->prefix.'pnfpb_ic_schedule_push_notifications';
				
				if (isset($_POST['pnfpb_ic_on_demand_push_id']) && $_POST['pnfpb_ic_on_demand_push_id'] != '' && $_POST['pnfpb_ic_on_demand_push_id'] != 0 && $_POST['pnfpb_ic_on_demand_push_id'] != '0') {
					
					$onetime_title = stripslashes(wp_strip_all_tags(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_title'])));
					
					$onetime_content = stripslashes(wp_strip_all_tags($activity_content_push));
					
					$onetime_timestamp = time();
					
					$insertid = intval(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_id']));
					
					$wpdb->query($wpdb->prepare("UPDATE %i 
												SET userid = %d,
												action_scheduler_id = NULL,
												title = %s,
												content = %s,
												image_url = %s,
												click_url = %s,
												scheduled_timestamp = %d,
												scheduled_type = %s,
												status = %s 
												WHERE id = %d",
												$table,
												$bpuserid,
												$onetime_title,
												$onetime_content,
												$imageurl,
												$postlink,
												$onetime_timestamp,
												'onetime',
												'sent',
												$insertid));
				} else {
					
					$data = array('userid' => $bpuserid,
							  	  'action_scheduler_id' => NULL,
								  'title' => stripslashes(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_title'])),
								  'content' => mb_substr(wp_strip_all_tags(urldecode(trim(htmlspecialchars_decode(wp_unslash(sanitize_text_field($activity_content_push)))))),0,130, 'UTF-8'),
								  'image_url' => $imageurl,
								  'click_url' => $postlink,
								  'scheduled_timestamp' => time(),
							  	  'scheduled_type' => 'onetime',
							  	  'status'	=> 'sent'
								 );
					$insertid = $wpdb->insert($table,$data);
					
				}
                
			}    

        }
		else 
		{
        	if( isset($_POST['schedule_now']) && isset($_POST['pnfpb_ic_on_demand_push_title']) && isset($_POST['pnfpb_ic_on_demand_push_content']))
        	{
				$selected_day_push_notification = wp_unslash(sanitize_text_field($_POST['pnfpb_ic_fcm_token_ondemand_datepicker'])).' '.wp_unslash(sanitize_text_field($_POST['pnfpb_ic_fcm_token_ondemand_timepicker']));
				
				if ($_POST['pnfpb_ic_fcm_token_ondemand_timepicker'] === '') {
					
					$selected_day_push_notification = wp_unslash(sanitize_text_field($_POST['pnfpb_ic_fcm_token_ondemand_datepicker'])).'00:00';
				}
				
				if ($_POST['pnfpb_ic_fcm_token_ondemand_datepicker'] === '' && $_POST['pnfpb_ic_fcm_token_ondemand_timepicker'] === '') {
					
					$pnfpb_selected_datetime = new DateTime('now', new DateTimeZone(wp_timezone_string()));
					
				} else {
					
					$pnfpb_selected_datetime = new DateTime($selected_day_push_notification, new DateTimeZone(wp_timezone_string()));
				}
				
				$pnfpb_selected_datetime = $pnfpb_selected_datetime->setTimezone(new DateTimeZone("UTC"));

				$scheduled_day_push_notification = strtotime($pnfpb_selected_datetime->format("Y-m-d H:i:s"));
				
				if (isset($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month']) && ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] != "" || $_POST['pnfpb_ic_fcm_token_ondemand_repeat_day'] != '')) {
					
					//$pnfpb_selected_datetime->setTimestamp($scheduled_day_push_notification);
										
					$selected_recurring_schedule_formatted = $pnfpb_selected_datetime->format('Y-m-d H:i:s'); 
					
					$selected_recurring_schedule_split_array = explode(' ',$selected_recurring_schedule_formatted);
				
					$selected_recurring_date_array = explode('-',$selected_recurring_schedule_split_array[0]);
				
					$selected_recurring_date_month = 0;
				
					$selected_recurring_date_day = 0;
				
					if (count($selected_recurring_date_array) > 2) {
					
						$selected_recurring_date_month = $selected_recurring_date_array[1];
					
						$selected_recurring_date_day = $selected_recurring_date_array[2];
					}
					
					if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day_number'] !== '') {
						$selected_recurring_date_day = wp_unslash(sanitize_text_field($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day_number']));
					}
					else {
						$selected_recurring_date_day = '*';
					}
				
					$selected_recurring_time_array = explode(':',$selected_recurring_schedule_split_array[1]);
				
					$selected_recurring_hour = 0;
					
					$selected_recurring_minute = 0;
				
					if (count($selected_recurring_time_array) > 1) {
					
						$selected_recurring_hour = $selected_recurring_time_array[0];
					
						$selected_recurring_minute = $selected_recurring_time_array[1];
					}					
					
					$selected_recurring_cycle_status = esc_html( __('Recurring ', "push-notification-for-post-and-buddypress"));					
					$selected_recurring_month_status = '';
					$selected_recurring_day_status = '';
					
					if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '') {
						
						$selected_recurring_month = '*';
						$selected_recurring_month_status .= esc_html( __('Every month ', "push-notification-for-post-and-buddypress"));
							
					} else {
					
						$selected_recurring_month = wp_unslash(sanitize_text_field($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month']));
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '*') {
							
							
							$selected_recurring_month_status .= esc_html( __('Every Month ', "push-notification-for-post-and-buddypress"));
							
						}						
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '1') {
							
							$selected_recurring_month = '1';
							
							$selected_recurring_month_status .= esc_html( __('Every January ', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '2') {
							
							$selected_recurring_month = '2';
							
							$selected_recurring_month_status .= esc_html( __('Every February ', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '3') {
							
							$selected_recurring_month = '3';
							
							$selected_recurring_month_status .= esc_html( __('Every March ', "push-notification-for-post-and-buddypress"));
							
						}

						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '4') {
							
							$selected_recurring_month = '4';
							
							$selected_recurring_month_status .= esc_html( __('Every April ', "push-notification-for-post-and-buddypress"));
							
						}

						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '5') {
							
							$selected_recurring_month = '5';
							
							$selected_recurring_month_status .= esc_html( __('Every May ', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '6') {
							
							$selected_recurring_month = '6';
							
							$selected_recurring_month_status .= esc_html( __('Every June ', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '7') {
							
							$selected_recurring_month = '7';
							
							$selected_recurring_month_status .= esc_html( __('Every July ', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '8') {
							
							$selected_recurring_month = '8';
							
							$selected_recurring_month_status .= esc_html( __('Every August ', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '9') {
							
							$selected_recurring_month = '9';
							
							$selected_recurring_month_status .= esc_html( __('Every September ', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '10') {
							
							$selected_recurring_month = '10';
							
							$selected_recurring_month_status .= esc_html( __('Every October ', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '11') {
							
							$selected_recurring_month = '11';
							
							$selected_recurring_month_status .= esc_html( __('Every November ', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '12') {
							
							$selected_recurring_month = '12';
							
							$selected_recurring_month_status .= esc_html( __('Every December ', "push-notification-for-post-and-buddypress"));
							
						}						
						
					
					}
					
					if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day'] === '') {
						
						$selected_recurring_day = '*';
						
						$selected_recurring_day_status .= esc_html( __(' (any day)', "push-notification-for-post-and-buddypress"));
							
					} else {
					
						$selected_recurring_day = sanitize_text_field(wp_unslash($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day']));
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day'] === '0') {
							
							$selected_recurring_day = '0';
							
							$selected_recurring_day_status .= esc_html( __(' (on Sunday)', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day'] === '1') {
							
							$selected_recurring_day = '1';
							
							$selected_recurring_day_status .= esc_html( __(' (on Monday)', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day'] === '2') {
							
							$selected_recurring_day = '2';
							
							$selected_recurring_day_status .= esc_html( __(' (on Tuesday)', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day'] === '3') {
							
							$selected_recurring_day = '3';
							
							$selected_recurring_day_status .= esc_html( __(' (on Wednesday)', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day'] === '4') {
							
							$selected_recurring_day = '4';
							
							$selected_recurring_day_status .= esc_html( __(' (on Thursday)', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day'] === '5') {
							
							$selected_recurring_day = '5';
							
							$selected_recurring_day_status .= esc_html( __(' (on Friday)', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day'] === '6') {
							
							$selected_recurring_day = '6';
							
							$selected_recurring_day_status .= esc_html( __(' (on Saturday)', "push-notification-for-post-and-buddypress"));
							
						}					
					
					}					
					
					$occurence = 'recurring';

					$selected_recurring_cron_string = ltrim($selected_recurring_minute, '0').' '.ltrim($selected_recurring_hour, '0').' '.ltrim($selected_recurring_date_day, '0').' '.ltrim($selected_recurring_month, '0').' '.ltrim($selected_recurring_day, '0');

					$table = $wpdb->prefix.'pnfpb_ic_schedule_push_notifications';
					
					$pnfpb_selected_datetime_notification_db = $pnfpb_selected_datetime;
					
					$selected_day_push_notification_db = $selected_day_push_notification;
					
					$pnfpb_selected_datetime_notification_db = new DateTime($selected_day_push_notification_db, new DateTimeZone(wp_timezone_string()));

					$pnfpb_selected_datetime_notification_db = $pnfpb_selected_datetime_notification_db->setTimezone(new DateTimeZone(wp_timezone_string()));
				
					$selected_recurring_schedule_formatted_notification_db = strtotime($pnfpb_selected_datetime_notification_db->format('Y-m-d H:i:s'));
					
					if ($_POST['pnfpb_ic_on_demand_push_id']) {
					
						$onetime_title = stripslashes(wp_strip_all_tags(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_title'])));
					
						$onetime_content = stripslashes(wp_strip_all_tags(urldecode(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_content']))));
						
						$onetime_userid = get_current_user_id();
						
						$onetime_status = $selected_recurring_cycle_status.' '.$selected_recurring_month_status.' '.$selected_recurring_day_status;
						
						$insertid = intval(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_id']));
					
						$insertlink = sanitize_text_field($_POST['pnfpb_ic_on_demand_push_url_link']);

						$insertimageurl = sanitize_text_field($_POST['pnfpb_ic_on_demand_push_image_url']);

						$insert_day_number = sanitize_text_field($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day_number']);

						$insert_month_number = sanitize_text_field($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month']);

						$insert_day_name =  sanitize_text_field($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day']);

						$onetime_push_update_status = $wpdb->query($wpdb->prepare("UPDATE %i 
							SET userid = %d,
							action_scheduler_id = %d,
							title = %s,
							content = %s,
							image_url = %s,
							click_url = %s,
							scheduled_timestamp = %d,
							scheduled_type = %s,
							recurring_day_number = %s,
							recurring_month_number = %s,
							recurring_day_name = %s,
							status = %s 
							WHERE id = %d",
							$table,
							$onetime_userid,
							$scheduled_day_push_notification,
							$onetime_title,
							$onetime_content,
							$insertimageurl,
							$insertlink,
							$selected_recurring_schedule_formatted_notification_db,
							'recurring',
							$insert_day_number,
							$insert_month_number,
							$insert_day_name,
							$onetime_status,
							$insertid));

					} else {					
					
						$data = array('userid' => get_current_user_id(),
								  'action_scheduler_id' => $scheduled_day_push_notification,
								  'title' => stripslashes(wp_strip_all_tags(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_title']))),
								  'content' => $pushcontent = mb_substr(stripslashes(wp_strip_all_tags(urldecode(trim(htmlspecialchars_decode(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_content'])))))),0,130, 'UTF-8'),
								  'image_url' => sanitize_text_field($_POST['pnfpb_ic_on_demand_push_image_url']),
								  'click_url' => sanitize_text_field($_POST['pnfpb_ic_on_demand_push_url_link']),
								  'scheduled_timestamp' => $selected_recurring_schedule_formatted_notification_db,
								  'scheduled_type' => 'recurring',
								  'recurring_day_number' => sanitize_text_field($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day_number']),
								  'recurring_month_number'=> sanitize_text_field($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month']),
								  'recurring_day_name'=> sanitize_text_field($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day']),
							  	  'status'	=> $selected_recurring_cycle_status.' '.$selected_recurring_month_status.' '.$selected_recurring_day_status
								 );
					
						$insertstatus = $wpdb->insert($table,$data);
					
						$insertid = $wpdb->insert_id;
					}
					
					$action_scheduler_status = '';
					
					$action_scheduler_status = as_schedule_cron_action( $scheduled_day_push_notification, $selected_recurring_cron_string, 'PNFPB_ondemand_schedule_push_notification_hook', array( $scheduled_day_push_notification,$insertid,$occurence,$selected_recurring_cycle_status.' '.$selected_recurring_month_status.' '.$selected_recurring_day_status ));					
				}
				else {
					
					$table = $wpdb->prefix.'pnfpb_ic_schedule_push_notifications';
					
					$selected_day_push_notification_db = $selected_day_push_notification;
					
					$pnfpb_selected_datetime_notification_db = $pnfpb_selected_datetime;
					
					$pnfpb_selected_datetime_notification_db = new DateTime($selected_day_push_notification_db, new DateTimeZone(wp_timezone_string()));

					$pnfpb_selected_datetime_notification_db = $pnfpb_selected_datetime_notification_db->setTimezone(new DateTimeZone(wp_timezone_string()));
				
					$selected_recurring_schedule_formatted_notification_db = strtotime($pnfpb_selected_datetime_notification_db->format('Y-m-d H:i:s'));
					
					if ($_POST['pnfpb_ic_on_demand_push_id']) {
					
						$onetime_title = stripslashes(wp_strip_all_tags(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_title'])));
					
						$onetime_content = stripslashes(wp_strip_all_tags(urldecode(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_content']))));
						
						$onetime_status = esc_html( __('Onetime scheduled', "push-notification-for-post-and-buddypress"));
						
						$onetime_userid = get_current_user_id();
						
						$insertid = intval(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_id']));

						$insertlink = sanitize_text_field($_POST['pnfpb_ic_on_demand_push_url_link']);

						$insertimageurl = sanitize_text_field($_POST['pnfpb_ic_on_demand_push_image_url']); 
					
						$onetime_push_update_status = $wpdb->query($wpdb->prepare("UPDATE %i 
												SET userid = %d,
												action_scheduler_id = %d,
												title = %s,
												content = %s,
												image_url = %s,
												click_url = %s,
												scheduled_timestamp = %d,
												scheduled_type = %s,
												status = %s 
												WHERE id = %d",
												$table,
												$onetime_userid,
												$scheduled_day_push_notification,
												$onetime_title,
												$onetime_content,
												$insertimageurl,
												$insertlink,
												$selected_recurring_schedule_formatted_notification_db,
												'single',
												$onetime_status,
												$insertid));
					
					} else {					
										
						$data = array('userid' => get_current_user_id(),
								  'action_scheduler_id' => $scheduled_day_push_notification,
								  'title' => stripslashes(wp_strip_all_tags(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_title']))),
								  'content' => mb_substr(stripslashes(wp_strip_all_tags(urldecode(trim(htmlspecialchars_decode(sanitize_text_field($_POST['pnfpb_ic_on_demand_push_content'])))))),0,130, 'UTF-8'),
								  'image_url' => sanitize_text_field($_POST['pnfpb_ic_on_demand_push_image_url']),
								  'click_url' => sanitize_text_field($_POST['pnfpb_ic_on_demand_push_url_link']),
								  'scheduled_type' => 'single',
								  'scheduled_timestamp' => $selected_recurring_schedule_formatted_notification_db,
							  	  'status'	=> __('Onetime scheduled', "push-notification-for-post-and-buddypress")
								 );
					
						$insertstatus = $wpdb->insert($table,$data);
					
						$insertid = $wpdb->insert_id;
						
					}
					
					$occurence = 'Onetime scheduled';
					
					$action_scheduler_status = as_schedule_single_action( $scheduled_day_push_notification, 'PNFPB_ondemand_schedule_push_notification_hook', array( $scheduled_day_push_notification,$insertid,$occurence,'' ));	
					
				}

				if ($action_scheduler_status) {
				?>
    			<div class="notice notice-success is-dismissible">
        			<p><?php echo wp_kses_post( 'Push notification scheduled successfully. <a href="'.admin_url().'admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc">Refer notification list tab on id '.$insertid.'</a>. Also refer action scheduler tab for scheduled tasks. Scheduled timestamp reference number is '.$scheduled_day_push_notification.' . Action scheduler task id is '.$action_scheduler_status, "push-notification-for-post-and-buddypress" ); ?></p>
    			</div>
				<?php
				}
				else 
				{
						$error_message = '';
						if( is_wp_error( $action_scheduler_status ) ) {
    						$error_message = $action_scheduler_status->get_error_message();
						}
					?>
	    			<div class="notice notice-error is-dismissible">
        				<p><?php esc_html_e( 'CRON Error...in scheduling notification. Please try again', "push-notification-for-post-and-buddypress" ); ?></p>
						<?php if ($error_message != '') { ?>
						<p>
							<?php echo esc_html($error_message); ?>
						</p>
						<?php } ?>
    				</div>
					<?php
					
				}
			}
			else 
			{
				if( isset($_POST['schedule_now']) && isset($_POST['pnfpb_ic_on_demand_push_title']) && isset($_POST['pnfpb_ic_on_demand_push_content']))				{
			?>
    				<div class="notice notice-error is-dismissible">
        				<p><?php esc_html_e( 'Error...Please fill all required fields and try again!!!', "push-notification-for-post-and-buddypress" ); ?></p>
    				</div>				
			<?php
				}
				else {
					if (isset($_GET['action']) && isset($_GET['pushnotificationid']) && isset($_GET['_wpnonce']) && intval(sanitize_text_field(wp_unslash($_GET['pushnotificationid']))) > 0 ) {
						
						$nonce = '';
						
						$nonce = esc_attr(sanitize_text_field(wp_unslash($_GET['_wpnonce'])));

						if ( ! wp_verify_nonce( $nonce, 'pnfpb_edit_pushnotification' ) ) {
							
							die( 'wnonce failure' );
							
						} else {						
						
							global $wpdb;
						
							$notification_table_name = $wpdb->prefix . 'pnfpb_ic_schedule_push_notifications';

							$pushnotificationid = sanitize_text_field(wp_unslash($_GET['pushnotificationid']));

							$pushnotificationid = esc_html($pushnotificationid);
					
							$notifications = $wpdb->get_results($wpdb->prepare("SELECT * FROM %i WHERE `id` = %d ",$notification_table_name,$pushnotificationid));
						
							$onetime_push_id = $pushnotificationid;
						
							foreach ( $notifications as $notification ){
							
								$onetime_push_title = $notification->title;
								$onetime_push_content = $notification->content;
								$onetime_push_imageurl = $notification->image_url;
								$onetime_push_clickurl = $notification->click_url;
								$onetime_push_time = $notification->scheduled_timestamp;
							
								$onetime_push_date_field = gmdate('Y-m-d',$onetime_push_time);
								$onetime_push_time_field = gmdate('H:i:s',$onetime_push_time);
							
								if ($notification->recurring_day_number != NULL) {
									$onetime_recurring_day_number = $notification->recurring_day_number;
								}
							
								if ($notification->recurring_month_number != NULL) {
									$onetime_recurring_month_number = $notification->recurring_month_number;
								}
							
								if ($notification->recurring_day_name != NULL) {
									$onetime_recurring_day_name = $notification->recurring_day_name;
								}
							
								$onetime_push_status = $notification->status;
							}
						}
					}
				}
			}
		}
	
?>

<form method="post" enctype="multipart/form-data" class="form-field">
	<table class="pnfpb_ic_push_settings_table widefat fixed">
    	<tbody>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">			
					<div class="pnfpb_row">
  						<div class="pnfpb_column">
    						<div class="pnfpb_card">
								<?php
								$pnfpb_ic_fcm_ondemand_schedule_now_enable = '0';
								if (get_option( 'pnfpb_ic_fcm_ondemand_schedule_now_enable') && get_option( 'pnfpb_ic_fcm_ondemand_schedule_now_enable')  === '1') {
									$pnfpb_ic_fcm_ondemand_schedule_now_enable = '1';
								}
								?>
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_fcm_ondemand_schedule_now_enable" name="pnfpb_ic_fcm_ondemand_schedule_now_enable" type="checkbox" value="1" <?php checked( '1', $pnfpb_ic_fcm_ondemand_schedule_now_enable ); ?>  />
									<span class="pnfpb_slider round"></span>
								</label>							
								<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_ondemand_schedule_now_enable">
									<?php echo esc_html( __("Send notification in action scheduler asynchronous background mode to avoid server overload.","push-notification-for-post-and-buddypress"));?>
								</label>
							</div>
						</div>
					</div>
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_name">
                        <?php echo esc_html( __("Message title","push-notification-for-post-and-buddypress"));?>
					</label>
					<br/>
					<input id="pnfpb_ic_on_demand_push_id" name="pnfpb_ic_on_demand_push_id" type="hidden" value="<?php echo esc_html($onetime_push_id); ?>" />
					
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_on_demand_push_title" name="pnfpb_ic_on_demand_push_title" type="text" value="<?php echo esc_html($onetime_push_title); ?>" required="required" />					
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_name">
						<?php echo esc_html( __("Message content","push-notification-for-post-and-buddypress"));?>
					</label>
					<br/>
					<textarea class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_on_demand_push_content" name="pnfpb_ic_on_demand_push_content" type="text" value="<?php echo esc_html($onetime_push_content); ?>" required="required" rows="3"><?php echo esc_html($onetime_push_content); ?></textarea>					
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_name">
						<?php echo esc_html( __("Add Image link/URL or Select Image","push-notification-for-post-and-buddypress"));?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_on_demand_push_image_url" name="pnfpb_ic_on_demand_push_image_url" type="text" value="<?php echo esc_url($onetime_push_imageurl); ?>" />					
				</td>
			</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">				
            		<table>
						<tr>
                			<td class="column-columnname">
                    			<input type="button" value="<?php echo esc_html( __("Select Image","push-notification-for-post-and-buddypress"));?>" id="pnfpb_ic_fcm_on_demand_push_image_button" class="pnfpb_ic_push_pwa_settings_upload_icon" />
                    			<input type="hidden" id="pnfpb_ic_fcm_on_demand_push_image" name="pnfpb_ic_fcm_on_demand_push_image" value="<?php echo esc_url($onetime_push_imageurl); ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
									<?php
										if ($onetime_push_imageurl != '') {
									?>
									<div id="pnfpb_ic_fcm_on_demand_push_image_preview" style="width:50px; height:50px;overflow:hidden;border-radius:0%;margin:0px auto;background-image: url(<?php echo esc_url($onetime_push_imageurl); ?>);background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
									<?php
										} else {
									?>
									<div id="pnfpb_ic_fcm_on_demand_push_image_preview" style="width:50px; height:50px;overflow:hidden;border-radius:0%;margin:0px auto;background-position:center center;background-repeat:no-repeat;background-size:cover;">										
									</div>
									<?php
										}
									?>
                    			</div>
                			</td>
            			</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						<?php echo esc_html( __("Add push notification click action url/link or Select page from dropdown list","push-notification-for-post-and-buddypress"));?>
					</p>
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_on_demand_push_url_link" name="pnfpb_ic_on_demand_push_url_link" type="text" value="<?php if ($onetime_push_clickurl === '') { echo esc_url(get_home_url()); } else { echo esc_url($onetime_push_clickurl); } ?>" />					
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">				
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">
					<select id="pnfpb_ic_on_demand_push_url" name="pnfpb_ic_on_demand_push_url">
					    <?php
					    if( $pages = get_pages() ){
						    echo '<option value="' . esc_url(get_home_url()) . '"> Home page</option>';	        		
						    foreach( $pages as $page ){
						    echo '<option value="' . esc_html(get_page_link( $page->ID )) . '">' . esc_html($page->post_title) . '</option>';						
       					    }
    				    }
					    ?>
				    </select>					
				</td>
			</tr>
			<tr>
				<td class="column-columnname"><div class="pnfpb_column_full_ondemand"><?php submit_button(__('Send now',"push-notification-for-post-and-buddypress"),'pnfpb_ic_push_save_configuration_button'); ?></div></td>
			</tr>
			<tr>
				<td>
  					<div class="pnfpb_column_400">
						<?php echo wp_kses_post( __("Always select starting date and time, recurring schedule fields day, month, day name are optional. <br />In recurring schedule, if you select day number and day name then one or both must match current date.<br /> It is recommended to use day number and month for recurring schedule(simple use). It is based on CRON schedule string.","push-notification-for-post-and-buddypress"));?>
    					<div class="pnfpb_card pnfpb_schedule_later_ondemand">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_ic_push_settings_table_label_schedule_later_ondemand" for="pnfpb_ic_fcm_token_ondemand_datepicker">
								<?php echo esc_html( __("Select date","push-notification-for-post-and-buddypress"));?>
							</label>
							<input  id="pnfpb_ic_fcm_token_ondemand_datepicker" name="pnfpb_ic_fcm_token_ondemand_datepicker" type="date" value="<?php if ($onetime_push_date_field != '') { echo esc_html($onetime_push_date_field); } ?>" />
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_ic_push_settings_table_label_schedule_later_ondemand" for="pnfpb_ic_fcm_token_ondemand_timepicker">
								<?php echo esc_html( __("Select time","push-notification-for-post-and-buddypress"));?>
							</label>
							<input  id="pnfpb_ic_fcm_token_ondemand_timepicker" name="pnfpb_ic_fcm_token_ondemand_timepicker" type="time" value="<?php if ($onetime_push_time_field != '') { echo esc_html($onetime_push_time_field); } ?>" />
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_ic_push_settings_table_label_schedule_later_ondemand" for="pnfpb_ic_fcm_token_ondemand_repeat">
								<?php echo esc_html( __("Repeat every<br/>(Recurring schedule)","push-notification-for-post-and-buddypress"));?>
							</label>
							<select id="pnfpb_ic_fcm_token_ondemand_repeat_day_number" name="pnfpb_ic_fcm_token_ondemand_repeat_day_number">
								<option value="" <?php if ($onetime_recurring_day_number === ''){ echo 'selected';} else {echo '';} ?>>Select Day</option>
								<option value="1"  <?php if ($onetime_recurring_day_number === '1'){ echo 'selected';} else {echo '';} ?>>Day 1</option>
								<option value="2"  <?php if ($onetime_recurring_day_number === '2'){ echo 'selected';} else {echo '';} ?>>Day 2</option>
								<option value="3"  <?php if ($onetime_recurring_day_number === '3'){ echo 'selected';} else {echo '';} ?>>Day 3</option>
								<option value="4"  <?php if ($onetime_recurring_day_number === '4'){ echo 'selected';} else {echo '';} ?>>Day 4</option>
								<option value="5"  <?php if ($onetime_recurring_day_number === '5'){ echo 'selected';} else {echo '';} ?>>Day 5</option>
								<option value="6"  <?php if ($onetime_recurring_day_number === '6'){ echo 'selected';} else {echo '';} ?>>Day 6</option>
								<option value="7"  <?php if ($onetime_recurring_day_number === '7'){ echo 'selected';} else {echo '';} ?>>Day 7</option>
								<option value="8"  <?php if ($onetime_recurring_day_number === '8'){ echo 'selected';} else {echo '';} ?>>Day 8</option>
								<option value="9"  <?php if ($onetime_recurring_day_number === '9'){ echo 'selected';} else {echo '';} ?>>Day 9</option>
								<option value="10"  <?php if ($onetime_recurring_day_number === '10'){ echo 'selected';} else {echo '';} ?>>Day 10</option>
								<option value="11"  <?php if ($onetime_recurring_day_number === '11'){ echo 'selected';} else {echo '';} ?>>Day 11</option>
								<option value="12"  <?php if ($onetime_recurring_day_number === '12'){ echo 'selected';} else {echo '';} ?>>Day 12</option>
								<option value="13"  <?php if ($onetime_recurring_day_number === '13'){ echo 'selected';} else {echo '';} ?>>Day 13</option>
								<option value="14"  <?php if ($onetime_recurring_day_number === '14'){ echo 'selected';} else {echo '';} ?>>Day 14</option>
								<option value="15"  <?php if ($onetime_recurring_day_number === '15'){ echo 'selected';} else {echo '';} ?>>Day 15</option>
								<option value="16"  <?php if ($onetime_recurring_day_number === '16'){ echo 'selected';} else {echo '';} ?>>Day 16</option>
								<option value="17"  <?php if ($onetime_recurring_day_number === '17'){ echo 'selected';} else {echo '';} ?>>Day 17</option>
								<option value="18"  <?php if ($onetime_recurring_day_number === '18'){ echo 'selected';} else {echo '';} ?>>Day 18</option>
								<option value="19"  <?php if ($onetime_recurring_day_number === '19'){ echo 'selected';} else {echo '';} ?>>Day 19</option>
								<option value="20"  <?php if ($onetime_recurring_day_number === '20'){ echo 'selected';} else {echo '';} ?>>Day 20</option>
								<option value="21"  <?php if ($onetime_recurring_day_number === '21'){ echo 'selected';} else {echo '';} ?>>Day 21</option>
								<option value="22"  <?php if ($onetime_recurring_day_number === '22'){ echo 'selected';} else {echo '';} ?>>Day 22</option>
								<option value="23"  <?php if ($onetime_recurring_day_number === '23'){ echo 'selected';} else {echo '';} ?>>Day 23</option>
								<option value="24"  <?php if ($onetime_recurring_day_number === '24'){ echo 'selected';} else {echo '';} ?>>Day 24</option>
								<option value="25"  <?php if ($onetime_recurring_day_number === '25'){ echo 'selected';} else {echo '';} ?>>Day 25</option>
								<option value="26"  <?php if ($onetime_recurring_day_number === '26'){ echo 'selected';} else {echo '';} ?>>Day 26</option>
								<option value="27"  <?php if ($onetime_recurring_day_number === '27'){ echo 'selected';} else {echo '';} ?>>Day 27</option>
								<option value="28"  <?php if ($onetime_recurring_day_number === '28'){ echo 'selected';} else {echo '';} ?>>Day 28</option>
								<option value="29"  <?php if ($onetime_recurring_day_number === '29'){ echo 'selected';} else {echo '';} ?>>Day 29</option>
								<option value="30"  <?php if ($onetime_recurring_day_number === '30'){ echo 'selected';} else {echo '';} ?>>Day 30</option>
								<option value="31"  <?php if ($onetime_recurring_day_number === '31'){ echo 'selected';} else {echo '';} ?>>Day 31</option>
							</select>							
							<select id="pnfpb_ic_fcm_token_ondemand_repeat_month" name="pnfpb_ic_fcm_token_ondemand_repeat_month">
								<option value=""  <?php if ($onetime_recurring_month_number === ''){ echo 'selected';} else {echo '';} ?>>Select Month</option>
								<option value="*" <?php if ($onetime_recurring_month_number === '*'){ echo 'selected';} else {echo '';} ?>>Every Month</option>
								<option value="1" <?php if ($onetime_recurring_month_number === '1'){ echo 'selected';} else {echo '';} ?>>January</option>
								<option value="2" <?php if ($onetime_recurring_month_number === '2'){ echo 'selected';} else {echo '';} ?>>February</option>
								<option value="3" <?php if ($onetime_recurring_month_number === '3'){ echo 'selected';} else {echo '';} ?>>March</option>
								<option value="4" <?php if ($onetime_recurring_month_number === '4'){ echo 'selected';} else {echo '';} ?>>April</option>
								<option value="5" <?php if ($onetime_recurring_month_number === '5'){ echo 'selected';} else {echo '';} ?>>May</option>
								<option value="6" <?php if ($onetime_recurring_month_number === '6'){ echo 'selected';} else {echo '';} ?>>June</option>
								<option value="7" <?php if ($onetime_recurring_month_number === '7'){ echo 'selected';} else {echo '';} ?>>July</option>
								<option value="8" <?php if ($onetime_recurring_month_number === '8'){ echo 'selected';} else {echo '';} ?>>August</option>
								<option value="9" <?php if ($onetime_recurring_month_number === '9'){ echo 'selected';} else {echo '';} ?>>September</option>
								<option value="10" <?php if ($onetime_recurring_month_number === '10'){ echo 'selected';} else {echo '';} ?>>October</option>
								<option value="11" <?php if ($onetime_recurring_month_number === '11'){ echo 'selected';} else {echo '';} ?>>November</option>
								<option value="12" <?php if ($onetime_recurring_month_number === '12'){ echo 'selected';} else {echo '';} ?>>December</option>
							</select>
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_ic_push_settings_table_label_schedule_later_ondemand" for="pnfpb_ic_fcm_token_ondemand_repeat">
								<?php echo esc_html( __("On day: ","push-notification-for-post-and-buddypress"));?>
							</label>
							<select id="pnfpb_ic_fcm_token_ondemand_repeat_day" name="pnfpb_ic_fcm_token_ondemand_repeat_day">
								<option value="" <?php if ($onetime_recurring_day_name === ''){ echo 'selected';} else {echo '';} ?>>Select Day name</option>
								<option value="*" <?php if ($onetime_recurring_day_name === '*'){ echo 'selected';} else {echo '';} ?>>Any day</option>
								<option value="7" <?php if ($onetime_recurring_day_name === '7'){ echo 'selected';} else {echo '';} ?>>Sunday</option>
								<option value="1" <?php if ($onetime_recurring_day_name === '1'){ echo 'selected';} else {echo '';} ?>>Monday</option>
								<option value="2" <?php if ($onetime_recurring_day_name === '2'){ echo 'selected';} else {echo '';} ?>>Tuesday</option>
								<option value="3" <?php if ($onetime_recurring_day_name === '3'){ echo 'selected';} else {echo '';} ?>>Wednesday</option>
								<option value="4" <?php if ($onetime_recurring_day_name === '4'){ echo 'selected';} else {echo '';} ?>>Thursday</option>
								<option value="5" <?php if ($onetime_recurring_day_name === '5'){ echo 'selected';} else {echo '';} ?>>Friday</option>
								<option value="6" <?php if ($onetime_recurring_day_name === '6'){ echo 'selected';} else {echo '';} ?>>Saturday</option>
							</select>
							
						</div>
						<div class="pnfpb_column_full_ondemand">
							<?php submit_button(__('Schedule now',"push-notification-for-post-and-buddypress"),'pnfpb_ic_push_save_configuration_button','schedule_now'); ?>
							<?php echo esc_html( __('(To send push notification later on selected schedule)',"push-notification-for-post-and-buddypress")); ?>							
						</div>						
					</div>					
				</td>
				<td class="column-columnname">
					<div class="pnfpb_column_full_ondemand">

					</div>
				</td>				
    		</tr>
   		</tbody>
	</table>
</form>
</div>