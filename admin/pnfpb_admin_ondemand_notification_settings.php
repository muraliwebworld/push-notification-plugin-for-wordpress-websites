<?php
/**
* Plugin settings area to send one time/on demand push notification to all subscribers
*
* @since 1.21
*/
?>

<h1 class="pnfpb_ic_push_settings_header"><?php echo __("PNFPB - On demand/one time push notification",PNFPB_TD);?></h1>
<div class="pnfpb_admin_top_menu">
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb-icfcm-slug" class="tab"><?php echo __("Push Settings",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_device_tokens_list" class="tab "><?php echo __("Device tokens",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_pwa_app_settings" class="tab "><?php echo __("PWA",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfmtest_notification" class="tab active"><?php echo __("One time push",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc" class="tab"><?php echo __("Notifications",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_frontend_settings" class="tab"><?php echo __("Frontend settings",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_button_settings" class="tab "><?php echo __("Customize buttons",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_integrate_app" class="tab "><?php echo __("Mobile app",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_settings_for_ngnix_server" class="tab "><?php echo __("NGINX",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_action_scheduler" class="tab "><?php echo __("Action Scheduler",PNFPB_TD);?></a>
</div>
<div class="pnfpb_column_1200">
<h2 class="pnfpb_ic_push_settings_details"><?php echo __("To send on demand or one time push notification to all subscribers with image",PNFPB_TD);?></h2>

<?php
	
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
			
			
			if ($apiaccesskey != '' && $apiaccesskey != false) {
	
			    $table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
			    $deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%'" );
				
				$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%'" );
	
			    $url = 'https://fcm.googleapis.com/fcm/send';

			    $regid = $deviceids;
	
			    $activity_content_push = strip_tags(urldecode($_POST['pnfpb_ic_on_demand_push_content']));
				
			    $imageurl = '';
                if (isset($_POST['pnfpb_ic_on_demand_push_image_url'])) {
                    $imageurl = $_POST['pnfpb_ic_on_demand_push_image_url'];
                }

                $postlink = get_home_url();
                if (isset($_POST['pnfpb_ic_on_demand_push_url_link'])) {
                    $postlink = $_POST['pnfpb_ic_on_demand_push_url_link'];
                }
				
				if (get_option('pnfpb_onesignal_push') === '1') {
						
					$response = $this->PNFPB_icfcm_onesignal_push_notification(0,stripslashes(strip_tags($_POST['pnfpb_ic_on_demand_push_title'])),$activity_content_push,$postlink,$imageurl);
							
				} else {				
				
				if (count($regid) > 0) {
					if (get_option('pnfpb_httpv1_push') === '1') {
							$this->PNFPB_icfcm_httpv1_send_push_notification(0,
																			stripslashes(strip_tags($_POST['pnfpb_ic_on_demand_push_title'])),
																			stripslashes(strip_tags($activity_content_push)),
																			$imageurl,
																			$imageurl,
																			$postlink,
																			array(),
																			$regid,
																			array(),
																			0,
																			0
																			);
					}
					else {
						$this->PNFPB_icfcm_legacy_send_push_notification(0,
																		 stripslashes(strip_tags($_POST['pnfpb_ic_on_demand_push_title'])),
																		 stripslashes(strip_tags($activity_content_push)),
																		 $imageurl,
																		 $imageurl,
																		 $postlink,
																		 array(),
																		 $regid,
																		 array(),
																		 0,
																	     0																					 
																		);
					}

				}
				
				if (count($deviceidswebview) > 0) {
					
						$this->PNFPB_icfcm_legacy_send_push_notification(0,
																		 stripslashes(strip_tags($post_title)),
																		 stripslashes(strip_tags($activity_content_push)),
																		 $imageurl,
																		 $imageurl,
																		 $postlink,
																		 array(),
																		 $regid,
																		 array(),
																		 0,
																	     0																					 
																		);
				?>	
						<div class="notice notice-success is-dismissible">
        					<p><?php _e( 'Push notification sent successfully!!!', 'PNFPB_TD' ); ?></p>
    					</div>
				<?php


				}
				}
				
				$bpuserid = 0;
	
				if ( is_user_logged_in() ) {
		
    					$bpuserid = get_current_user_id();
				}					
					
				$table = $wpdb->prefix.'pnfpb_ic_schedule_push_notifications';
				
				if (isset($_POST['pnfpb_ic_on_demand_push_id']) && $_POST['pnfpb_ic_on_demand_push_id'] != '' && $_POST['pnfpb_ic_on_demand_push_id'] != 0 && $_POST['pnfpb_ic_on_demand_push_id'] != '0') {
					
					$onetime_title = stripslashes(strip_tags($_POST['pnfpb_ic_on_demand_push_title']));
					
					$onetime_content = stripslashes(strip_tags($activity_content_push));
					
					$onetime_timestamp = time();
					
					$insertid = intval($_POST['pnfpb_ic_on_demand_push_id']);
					
					$onetime_push_update_status = $wpdb->query("UPDATE {$table} SET userid = {$bpuserid},action_scheduler_id = NULL,title = '{$onetime_title}',content = '{$onetime_content}',image_url = '{$imageurl}',click_url = '{$postlink}',scheduled_timestamp = {$onetime_timestamp},scheduled_type = 'onetime',status = 'sent' WHERE id = {$_POST['pnfpb_ic_on_demand_push_id']}");
					
				} else {
					
					$data = array('userid' => $bpuserid,
							  	  'action_scheduler_id' => NULL,
								  'title' => stripslashes(strip_tags($_POST['pnfpb_ic_on_demand_push_title'])),
								  'content' => stripslashes(strip_tags($activity_content_push)),
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
				$selected_day_push_notification = $_POST['pnfpb_ic_fcm_token_ondemand_datepicker'].' '.$_POST['pnfpb_ic_fcm_token_ondemand_timepicker'];
				
				if ($_POST['pnfpb_ic_fcm_token_ondemand_timepicker'] === '') {
					
					$selected_day_push_notification = $_POST['pnfpb_ic_fcm_token_ondemand_datepicker'].'00:00';
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
						$selected_recurring_date_day = $_POST['pnfpb_ic_fcm_token_ondemand_repeat_day_number'];
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
					
					$selected_recurring_cycle_status = __('Recurring ', 'PNFPB_TD');;					
					$selected_recurring_month_status = '';
					$selected_recurring_day_status = '';
					
					if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '') {
						
						$selected_recurring_month = '*';
						$selected_recurring_month_status .= __('Every month ', 'PNFPB_TD');
							
					} else {
					
						$selected_recurring_month = $_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'];
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '*') {
							
							
							$selected_recurring_month_status .= __('Every Month ', 'PNFPB_TD');
							
						}						
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '1') {
							
							$selected_recurring_month = '1';
							
							$selected_recurring_month_status .= __('Every January ', 'PNFPB_TD');
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '2') {
							
							$selected_recurring_month = '2';
							
							$selected_recurring_month_status .= __('Every February ', 'PNFPB_TD');
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '3') {
							
							$selected_recurring_month = '3';
							
							$selected_recurring_month_status .= __('Every March ', 'PNFPB_TD');
							
						}

						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '4') {
							
							$selected_recurring_month = '4';
							
							$selected_recurring_month_status .= __('Every April ', 'PNFPB_TD');
							
						}

						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '5') {
							
							$selected_recurring_month = '5';
							
							$selected_recurring_month_status .= __('Every May ', 'PNFPB_TD');
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '6') {
							
							$selected_recurring_month = '6';
							
							$selected_recurring_month_status .= __('Every June ', 'PNFPB_TD');
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '7') {
							
							$selected_recurring_month = '7';
							
							$selected_recurring_month_status .= __('Every July ', 'PNFPB_TD');
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '8') {
							
							$selected_recurring_month = '8';
							
							$selected_recurring_month_status .= __('Every August ', 'PNFPB_TD');
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '9') {
							
							$selected_recurring_month = '9';
							
							$selected_recurring_month_status .= __('Every September ', 'PNFPB_TD');
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '10') {
							
							$selected_recurring_month = '10';
							
							$selected_recurring_month_status .= __('Every October ', 'PNFPB_TD');
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '11') {
							
							$selected_recurring_month = '11';
							
							$selected_recurring_month_status .= __('Every November ', 'PNFPB_TD');
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'] === '12') {
							
							$selected_recurring_month = '12';
							
							$selected_recurring_month_status .= __('Every December ', 'PNFPB_TD');
							
						}						
						
					
					}
					
					if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day'] === '') {
						
						$selected_recurring_day = '*';
						$selected_recurring_day_status .= __(' (any day)', 'PNFPB_TD');
							
					} else {
					
						$selected_recurring_day = $_POST['pnfpb_ic_fcm_token_ondemand_repeat_day'];
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day'] === '0') {
							
							$selected_recurring_day = '0';
							
							$selected_recurring_day_status .= __(' (on Sunday)', 'PNFPB_TD');
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day'] === '1') {
							
							$selected_recurring_day = '1';
							
							$selected_recurring_day_status .= __(' (on Monday)', 'PNFPB_TD');
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day'] === '2') {
							
							$selected_recurring_day = '2';
							
							$selected_recurring_day_status .= __(' (on Tuesday)', 'PNFPB_TD');
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day'] === '3') {
							
							$selected_recurring_day = '3';
							
							$selected_recurring_day_status .= __(' (on Wednesday)', 'PNFPB_TD');
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day'] === '4') {
							
							$selected_recurring_day = '4';
							
							$selected_recurring_day_status .= __(' (on Thursday)', 'PNFPB_TD');
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day'] === '5') {
							
							$selected_recurring_day = '5';
							
							$selected_recurring_day_status .= __(' (on Friday)', 'PNFPB_TD');
							
						}
						
						if ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day'] === '6') {
							
							$selected_recurring_day = '6';
							
							$selected_recurring_day_status .= __(' (on Saturday)', 'PNFPB_TD');
							
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
					
						$onetime_title = stripslashes(strip_tags($_POST['pnfpb_ic_on_demand_push_title']));
					
						$onetime_content = stripslashes(strip_tags(urldecode($_POST['pnfpb_ic_on_demand_push_content'])));
						
						$onetime_userid = get_current_user_id();
						
						$onetime_status = $selected_recurring_cycle_status.' '.$selected_recurring_month_status.' '.$selected_recurring_day_status;
						
						$insertid = intval($_POST['pnfpb_ic_on_demand_push_id']);
					
						$onetime_push_update_status = $wpdb->query("UPDATE {$table} SET userid = {$onetime_userid},action_scheduler_id = {$scheduled_day_push_notification},title = '{$onetime_title}',content = '{$onetime_content}',image_url = '{$_POST['pnfpb_ic_on_demand_push_image_url']}',click_url = '{$_POST['pnfpb_ic_on_demand_push_url_link']}',scheduled_timestamp = {$selected_recurring_schedule_formatted_notification_db},scheduled_type = 'recurring',recurring_day_number = '{$_POST['pnfpb_ic_fcm_token_ondemand_repeat_day_number']}',recurring_month_number = '{$_POST['pnfpb_ic_fcm_token_ondemand_repeat_month']}',recurring_day_name = '{$_POST['pnfpb_ic_fcm_token_ondemand_repeat_day']}',status = '{$onetime_status}' WHERE id = {$_POST['pnfpb_ic_on_demand_push_id']}");
					
					} else {					
					
						$data = array('userid' => get_current_user_id(),
								  'action_scheduler_id' => $scheduled_day_push_notification,
								  'title' => stripslashes(strip_tags($_POST['pnfpb_ic_on_demand_push_title'])),
								  'content' => stripslashes(strip_tags(urldecode($_POST['pnfpb_ic_on_demand_push_content']))),
								  'image_url' => $_POST['pnfpb_ic_on_demand_push_image_url'],
								  'click_url' => $_POST['pnfpb_ic_on_demand_push_url_link'],
								  'scheduled_timestamp' => $selected_recurring_schedule_formatted_notification_db,
								  'scheduled_type' => 'recurring',
								  'recurring_day_number' => $_POST['pnfpb_ic_fcm_token_ondemand_repeat_day_number'],
								  'recurring_month_number'=> $_POST['pnfpb_ic_fcm_token_ondemand_repeat_month'],
								  'recurring_day_name'=> $_POST['pnfpb_ic_fcm_token_ondemand_repeat_day'],
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
					
						$onetime_title = stripslashes(strip_tags($_POST['pnfpb_ic_on_demand_push_title']));
					
						$onetime_content = stripslashes(strip_tags(urldecode($_POST['pnfpb_ic_on_demand_push_content'])));
						
						$onetime_status = __('Onetime scheduled', 'PNFPB_TD');
						
						$onetime_userid = get_current_user_id();
						
						$insertid = intval($_POST['pnfpb_ic_on_demand_push_id']);
					
						$onetime_push_update_status = $wpdb->query("UPDATE {$table} SET userid = {$onetime_userid},action_scheduler_id = {$scheduled_day_push_notification},title = '{$onetime_title}',content = '{$onetime_content}',image_url = '{$_POST['pnfpb_ic_on_demand_push_image_url']}',click_url = '{$_POST['pnfpb_ic_on_demand_push_url_link']}',scheduled_timestamp = {$selected_recurring_schedule_formatted_notification_db},scheduled_type = 'single',status = '{$onetime_status}' WHERE id = {$_POST['pnfpb_ic_on_demand_push_id']}");
					
					} else {					
										
						$data = array('userid' => get_current_user_id(),
								  'action_scheduler_id' => $scheduled_day_push_notification,
								  'title' => stripslashes(strip_tags($_POST['pnfpb_ic_on_demand_push_title'])),
								  'content' => stripslashes(strip_tags(urldecode($_POST['pnfpb_ic_on_demand_push_content']))),
								  'image_url' => $_POST['pnfpb_ic_on_demand_push_image_url'],
								  'click_url' => $_POST['pnfpb_ic_on_demand_push_url_link'],
								  'scheduled_type' => 'single',
								  'scheduled_timestamp' => $selected_recurring_schedule_formatted_notification_db,
							  	  'status'	=> __('Onetime scheduled', 'PNFPB_TD')
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
        			<p><?php _e( 'Push notification scheduled successfully. <a href="'.admin_url().'admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc">Refer notification list tab on id '.$insertid.'</a>. Also refer action scheduler tab for scheduled tasks. Scheduled timestamp reference number is '.$scheduled_day_push_notification.' . Action scheduler task id is '.$action_scheduler_status, 'PNFPB_TD' ); ?></p>
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
        				<p><?php _e( 'CRON Error...in scheduling notification. Please try again', 'PNFPB_TD' ); ?></p>
						<?php if ($error_message != '') { ?>
						<p>
							<?php echo $error_message; ?>
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
        				<p><?php _e( 'Error...Please fill all required fields and try again!!!', 'PNFPB_TD' ); ?></p>
    				</div>				
			<?php
				}
				else {
					if (isset($_GET['action']) && isset($_GET['pushnotificationid'])) {
						
						global $wpdb;
						
						$notification_table_name = $wpdb->prefix . 'pnfpb_ic_schedule_push_notifications';
						
					
						$notifications = $wpdb->get_results("SELECT * FROM {$notification_table_name} WHERE `id` = {$_GET['pushnotificationid']} ");
						
						$onetime_push_id = $_GET['pushnotificationid'];
						
						foreach ( $notifications as $notification ){
							
							$onetime_push_title = $notification->title;
							$onetime_push_content = $notification->content;
							$onetime_push_imageurl = $notification->image_url;
							$onetime_push_clickurl = $notification->click_url;
							$onetime_push_time = $notification->scheduled_timestamp;
							
							$onetime_push_date_field = date('Y-m-d',$onetime_push_time);
							$onetime_push_time_field = date('H:i:s',$onetime_push_time);
							
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
	
?>

<form method="post" enctype="multipart/form-data" class="form-field">
	<table class="pnfpb_ic_push_settings_table widefat fixed">
    	<tbody>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_name">
                        <?php echo __("Message title",PNFPB_TD);?>
					</label>
					<br/>
					<input id="pnfpb_ic_on_demand_push_id" name="pnfpb_ic_on_demand_push_id" type="hidden" value="<?php echo $onetime_push_id; ?>" />
					
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_on_demand_push_title" name="pnfpb_ic_on_demand_push_title" type="text" value="<?php echo $onetime_push_title; ?>" required="required" />					
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_name">
						<?php echo __("Message content",PNFPB_TD);?>
					</label>
					<br/>
					<textarea class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_on_demand_push_content" name="pnfpb_ic_on_demand_push_content" type="text" value="<?php echo $onetime_push_content; ?>" required="required" rows="3"><?php echo $onetime_push_content; ?></textarea>					
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_name">
						<?php echo __("Add Image link/URL or Select Image",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_on_demand_push_image_url" name="pnfpb_ic_on_demand_push_image_url" type="text" value="<?php echo $onetime_push_imageurl; ?>" />					
				</td>
			</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">				
            		<table>
						<tr>
                			<td class="column-columnname">
                    			<input type="button" value="<?php echo __("Select Image",PNFPB_TD);?>" id="pnfpb_ic_fcm_on_demand_push_image_button" class="pnfpb_ic_push_pwa_settings_upload_icon" />
                    			<input type="hidden" id="pnfpb_ic_fcm_on_demand_push_image" name="pnfpb_ic_fcm_on_demand_push_image" value="<?php echo $onetime_push_imageurl; ?>" />
                			</td>
						</tr>
						<tr>							
                			<td class="column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
									<?php
										if ($onetime_push_imageurl != '') {
									?>
									<div id="pnfpb_ic_fcm_on_demand_push_image_preview" style="width:50px; height:50px;overflow:hidden;border-radius:0%;margin:0px auto;background-image: url(<?php echo $onetime_push_imageurl; ?>);background-position:center center;background-repeat:no-repeat;background-size:cover;">
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
						<?php echo __("Add push notification click action url/link or Select page from dropdown list",PNFPB_TD);?>
					</p>
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_on_demand_push_url_link" name="pnfpb_ic_on_demand_push_url_link" type="text" value="<?php if ($onetime_push_clickurl === '') { echo get_home_url(); } else { echo $onetime_push_clickurl; } ?>" />					
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">				
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">
					<select id="pnfpb_ic_on_demand_push_url" name="pnfpb_ic_on_demand_push_url">
					    <?php
					    if( $pages = get_pages() ){
						    echo '<option value="' . get_home_url() . '"> Home page</option>';	        		
						    foreach( $pages as $page ){
						    echo '<option value="' . get_page_link( $page->ID ) . '">' . $page->post_title . '</option>';						
       					    }
    				    }
					    ?>
				    </select>					
				</td>
			</tr>
			<tr>
				<td class="column-columnname"><div class="pnfpb_column_full_ondemand"><?php submit_button(__('Send now',PNFPB_TD),'pnfpb_ic_push_save_configuration_button'); ?></div></td>
			</tr>
			<tr>
				<td>
  					<div class="pnfpb_column_400">
						<?php echo __("Always select starting date and time, recurring schedule fields day, month, day name are optional. <br />In recurring schedule, if you select day number and day name then one or both must match current date.<br /> It is recommended to use day number and month for recurring schedule(simple use). It is based on CRON schedule string.",'PNFPB_TD');?>
    					<div class="pnfpb_card pnfpb_schedule_later_ondemand">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_ic_push_settings_table_label_schedule_later_ondemand" for="pnfpb_ic_fcm_token_ondemand_datepicker">
								<?php echo __("Select date",'PNFPB_TD');?>
							</label>
							<input  id="pnfpb_ic_fcm_token_ondemand_datepicker" name="pnfpb_ic_fcm_token_ondemand_datepicker" type="date" value="<?php if ($onetime_push_date_field != '') { echo $onetime_push_date_field; } ?>" />
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_ic_push_settings_table_label_schedule_later_ondemand" for="pnfpb_ic_fcm_token_ondemand_timepicker">
								<?php echo __("Select time",'PNFPB_TD');?>
							</label>
							<input  id="pnfpb_ic_fcm_token_ondemand_timepicker" name="pnfpb_ic_fcm_token_ondemand_timepicker" type="time" value="<?php if ($onetime_push_time_field != '') { echo $onetime_push_time_field; } ?>" />
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_ic_push_settings_table_label_schedule_later_ondemand" for="pnfpb_ic_fcm_token_ondemand_repeat">
								<?php echo __("Repeat every<br/>(Recurring schedule)",'PNFPB_TD');?>
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
								<?php echo __("On day: ",'PNFPB_TD');?>
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
							<?php submit_button(__('Schedule now',PNFPB_TD),'pnfpb_ic_push_save_configuration_button','schedule_now'); ?>
							<?php echo __('(To send push notification later on selected schedule)',PNFPB_TD); ?>							
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