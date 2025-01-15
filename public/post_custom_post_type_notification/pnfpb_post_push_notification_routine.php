<?php

			global $wpdb;

			// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery
			
			if  ( 'publish' !== $new_status ) {
				return;
			}


			if ( $old_status === 'publish' && $new_status === 'publish' && get_option('pnfpb_ic_fcm_disable_post_update_enable') === '1' && ( !isset($_POST['pnfpb_push_notification_send_checkbox']) && !isset( $_POST['pnfpb_push_notification_schedule_checkbox'] ))) {
				
				return;
				
			}

            if( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
                return;
            }
			
			if ( !function_exists( 'get_current_screen' ) ) { 
   				require_once ABSPATH . '/wp-admin/includes/screen.php'; 
			}
			
			$screen = get_current_screen();	
				
			update_post_meta( $post->ID, 'pnfpb_push_notification_send_checkbox', '' );

	
			if ( isset( $_POST['pnfpb_push_notification_schedule_checkbox'] ) && $_POST['pnfpb_push_notification_schedule_checkbox'] === '1' && isset( $_POST['pnfpb_ic_fcm_token_ondemand_datepicker_post'] ) && $_POST['pnfpb_ic_fcm_token_ondemand_datepicker_post'] !== '' && $post->ID ) {
				
				$pnfpb_push_notification_schedule_checkbox = sanitize_text_field(wp_unslash($_POST['pnfpb_push_notification_schedule_checkbox']));

				$pnfpb_ic_fcm_token_ondemand_datepicker_post = sanitize_text_field(wp_unslash($_POST['pnfpb_ic_fcm_token_ondemand_datepicker_post']));

				$pnfpb_ic_fcm_token_ondemand_timerpicker_post = '';

				if (isset($_POST['pnfpb_ic_fcm_token_ondemand_timepicker_post'])) {

					$pnfpb_ic_fcm_token_ondemand_timerpicker_post = sanitize_text_field(wp_unslash($_POST['pnfpb_ic_fcm_token_ondemand_timepicker_post']));
				}
				
				update_post_meta( $post->ID, 'pnfpb_push_notification_schedule_checkbox', $_POST['pnfpb_push_notification_schedule_checkbox'] );
			
				$selected_day_push_notification = $pnfpb_ic_fcm_token_ondemand_datepicker_post.' '.$pnfpb_ic_fcm_token_ondemand_timerpicker_post;
				
				if ($_POST['pnfpb_ic_fcm_token_ondemand_timepicker_post'] === '') {
					
					$selected_day_push_notification = $pnfpb_ic_fcm_token_ondemand_datepicker_post.'00:00';
				}
				
				if ($pnfpb_ic_fcm_token_ondemand_datepicker_post === '' && $pnfpb_ic_fcm_token_ondemand_timerpicker_post === '') {
					
					$pnfpb_selected_datetime = new DateTime('now', new DateTimeZone(wp_timezone_string()));
					
				} else {
					
					$pnfpb_selected_datetime = new DateTime($selected_day_push_notification, new DateTimeZone(wp_timezone_string()));
				}
				
				$pnfpb_selected_datetime = $pnfpb_selected_datetime->setTimezone(new DateTimeZone("UTC"));

				$scheduled_day_push_notification = strtotime($pnfpb_selected_datetime->format("Y-m-d H:i:s"));
				
				if (isset($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month_post']) && ($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month_post'] != "" || $_POST['pnfpb_ic_fcm_token_ondemand_repeat_day_post'] != '')) {

					$pnfpb_ic_fcm_token_ondemand_repeat_month_post = sanitize_text_field(wp_unslash($_POST['pnfpb_ic_fcm_token_ondemand_repeat_month_post']));

					$pnfpb_ic_fcm_token_ondemand_repeat_day_post = sanitize_text_field(wp_unslash($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day_post']));

					$pnfpb_ic_fcm_token_ondemand_repeat_day_number_post = '';

					if (isset($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day_number_post'])) {

						$pnfpb_ic_fcm_token_ondemand_repeat_day_number_post = sanitize_text_field(wp_unslash($_POST['pnfpb_ic_fcm_token_ondemand_repeat_day_number_post']));

					}

					$selected_recurring_schedule_formatted = $pnfpb_selected_datetime->format('Y-m-d H:i:s'); 
					
					$selected_recurring_schedule_split_array = explode(' ',$selected_recurring_schedule_formatted);
				
					$selected_recurring_date_array = explode('-',$selected_recurring_schedule_split_array[0]);
				
					$selected_recurring_date_month = 0;
				
					$selected_recurring_date_day = 0;
				
					if (count($selected_recurring_date_array) > 2) {
					
						$selected_recurring_date_month = $selected_recurring_date_array[1];
					
						$selected_recurring_date_day = $selected_recurring_date_array[2];
					}
					
					if ($pnfpb_ic_fcm_token_ondemand_repeat_day_number_post !== '') {

						$selected_recurring_date_day = $pnfpb_ic_fcm_token_ondemand_repeat_day_number_post;

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
					
					if ($pnfpb_ic_fcm_token_ondemand_repeat_month_post === '') {
						
						$selected_recurring_month = '*';
						$selected_recurring_month_status .= esc_html( __('Every month ', "push-notification-for-post-and-buddypress"));
							
					} else {
					
						$selected_recurring_month = $pnfpb_ic_fcm_token_ondemand_repeat_month_post;
						
						if ($pnfpb_ic_fcm_token_ondemand_repeat_month_post === '*') {
							
							
							$selected_recurring_month_status .= esc_html( __('Every Month ', "push-notification-for-post-and-buddypress"));
							
						}						
						
						if ($pnfpb_ic_fcm_token_ondemand_repeat_month_post === '1') {
							
							$selected_recurring_month = '1';
							
							$selected_recurring_month_status .= esc_html( __('Every January ', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($pnfpb_ic_fcm_token_ondemand_repeat_month_post === '2') {
							
							$selected_recurring_month = '2';
							
							$selected_recurring_month_status .= esc_html( __('Every February ', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($pnfpb_ic_fcm_token_ondemand_repeat_month_post === '3') {
							
							$selected_recurring_month = '3';
							
							$selected_recurring_month_status .= esc_html( __('Every March ', "push-notification-for-post-and-buddypress"));
							
						}

						if ($pnfpb_ic_fcm_token_ondemand_repeat_month_post === '4') {
							
							$selected_recurring_month = '4';
							
							$selected_recurring_month_status .= esc_html( __('Every April ', "push-notification-for-post-and-buddypress"));
							
						}

						if ($pnfpb_ic_fcm_token_ondemand_repeat_month_post === '5') {
							
							$selected_recurring_month = '5';
							
							$selected_recurring_month_status .= esc_html( __('Every May ', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($pnfpb_ic_fcm_token_ondemand_repeat_month_post === '6') {
							
							$selected_recurring_month = '6';
							
							$selected_recurring_month_status .= esc_html( __('Every June ', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($pnfpb_ic_fcm_token_ondemand_repeat_month_post === '7') {
							
							$selected_recurring_month = '7';
							
							$selected_recurring_month_status .= esc_html( __('Every July ', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($pnfpb_ic_fcm_token_ondemand_repeat_month_post === '8') {
							
							$selected_recurring_month = '8';
							
							$selected_recurring_month_status .= esc_html( __('Every August ', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($pnfpb_ic_fcm_token_ondemand_repeat_month_post === '9') {
							
							$selected_recurring_month = '9';
							
							$selected_recurring_month_status .= esc_html( __('Every September ', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($pnfpb_ic_fcm_token_ondemand_repeat_month_post === '10') {
							
							$selected_recurring_month = '10';
							
							$selected_recurring_month_status .= esc_html( __('Every October ', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($pnfpb_ic_fcm_token_ondemand_repeat_month_post === '11') {
							
							$selected_recurring_month = '11';
							
							$selected_recurring_month_status .= esc_html( __('Every November ', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($pnfpb_ic_fcm_token_ondemand_repeat_month_post === '12') {
							
							$selected_recurring_month = '12';
							
							$selected_recurring_month_status .= esc_html( __('Every December ', "push-notification-for-post-and-buddypress"));
							
						}						
					
					}
					
					if ($pnfpb_ic_fcm_token_ondemand_repeat_day_post === '') {
						
						$selected_recurring_day = '*';
						$selected_recurring_day_status .= esc_html( __(' (any day)', "push-notification-for-post-and-buddypress"));
							
					} else {
					
						$selected_recurring_day = $pnfpb_ic_fcm_token_ondemand_repeat_day_post;
						
						if ($pnfpb_ic_fcm_token_ondemand_repeat_day_post === '0') {
							
							$selected_recurring_day = '0';
							
							$selected_recurring_day_status .= esc_html( __(' (on Sunday)', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($pnfpb_ic_fcm_token_ondemand_repeat_day_post === '1') {
							
							$selected_recurring_day = '1';
							
							$selected_recurring_day_status .= esc_html( __(' (on Monday)', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($pnfpb_ic_fcm_token_ondemand_repeat_day_post === '2') {
							
							$selected_recurring_day = '2';
							
							$selected_recurring_day_status .= esc_html( __(' (on Tuesday)', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($pnfpb_ic_fcm_token_ondemand_repeat_day_post === '3') {
							
							$selected_recurring_day = '3';
							
							$selected_recurring_day_status .= esc_html( __(' (on Wednesday)', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($pnfpb_ic_fcm_token_ondemand_repeat_day_post === '4') {
							
							$selected_recurring_day = '4';
							
							$selected_recurring_day_status .= esc_html( __(' (on Thursday)', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($pnfpb_ic_fcm_token_ondemand_repeat_day_post === '5') {
							
							$selected_recurring_day = '5';
							
							$selected_recurring_day_status .= esc_html( __(' (on Friday)', "push-notification-for-post-and-buddypress"));
							
						}
						
						if ($pnfpb_ic_fcm_token_ondemand_repeat_day_post === '6') {
							
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
					
					$imageurl = '';
					
					if ( has_post_thumbnail($post->ID) ) {
						
						$imageurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
						
						update_option('pnfpb_ic_fcm_new_post_image',$imageurl);
						
					}
					else 
					{
						preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($post->post_content), $imgresult);
				
						if (is_array($imgresult)) {
							if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
								$imageurl = str_replace('"','',$imgresult[2][0]);
								update_option('pnfpb_ic_fcm_new_post_image',$imageurl);
							}
							else 
							{
								update_option('pnfpb_ic_fcm_new_post_image','');
							}
						}					
					}
					
					update_post_meta( $post->ID, 'pnfpb_push_notification_schedule_checkbox', '' );
				
					update_post_meta( $post->ID, 'pnfpb_ic_fcm_token_ondemand_datepicker_post', '' );

					update_post_meta( $post->ID, 'pnfpb_ic_fcm_token_ondemand_timepicker_post', '');

					update_post_meta( $post->ID, 'pnfpb_ic_fcm_token_ondemand_repeat_day_number_post', '' );

					update_post_meta( $post->ID, 'pnfpb_ic_fcm_token_ondemand_repeat_month_post', '' );

					update_post_meta( $post->ID, 'pnfpb_ic_fcm_token_ondemand_repeat_day_post', '' );					
					
					$data = array('userid' => get_current_user_id(),
								  'action_scheduler_id' => $scheduled_day_push_notification,
								  'title' => stripslashes(wp_strip_all_tags($post->post_title)),
								  'content' => mb_substr(stripslashes(wp_strip_all_tags(urldecode(trim(htmlspecialchars_decode($post->post_content))))),0,130, 'UTF-8'),
								  'image_url' => $imageurl,
								  'click_url' => get_permalink($post->ID),
								  'scheduled_timestamp' => $selected_recurring_schedule_formatted_notification_db,
								  'scheduled_type' => 'recurring',
								  'recurring_day_number' => $pnfpb_ic_fcm_token_ondemand_repeat_day_number_post,
								  'recurring_month_number'=> $pnfpb_ic_fcm_token_ondemand_repeat_month_post,
								  'recurring_day_name'=> $pnfpb_ic_fcm_token_ondemand_repeat_day_post,
							  	  'status'	=> $selected_recurring_cycle_status.' '.$selected_recurring_month_status.' '.$selected_recurring_day_status
								 );
					
					$insertstatus = $wpdb->insert($table,$data);
					
					$insertid = $wpdb->insert_id;
					
					$action_scheduler_status = '';
					
					$action_scheduler_status = as_schedule_cron_action( $scheduled_day_push_notification, $selected_recurring_cron_string, 'PNFPB_ondemand_schedule_push_notification_hook', array( $scheduled_day_push_notification,$insertid,$occurence,$selected_recurring_cycle_status.' '.$selected_recurring_month_status.' '.$selected_recurring_day_status,'post',$post->ID ));	
					
					//admin notices to show settings menu moved to top level menu
					
					$pnfpb_admin_message = '';
					
					if ($action_scheduler_status) {
					
						$pnfpb_admin_message = esc_html( __('Push notification scheduled for this post. ',"push-notification-for-post-and-buddypress")).'<a href="'.admin_url().'admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc">'.esc_html( __('Refer notification list tab on id ',"push-notification-for-post-and-buddypress")).$insertid.'</a>.'.esc_html( __('<br/>Scheduled timestamp reference number is ',"push-notification-for-post-and-buddypress")).$scheduled_day_push_notification.' .'.esc_html( __('Action scheduler task id is ',"push-notification-for-post-and-buddypress")).$action_scheduler_status;
					
					} 
					else {
						
						$pnfpb_admin_message = esc_html( __('Error in  scheduling push notification for this post, Please try again ',"push-notification-for-post-and-buddypress"));
					}
					update_post_meta($post->ID,'pnfpb_post_schedule',$pnfpb_admin_message);

				} else {
					
					$table = $wpdb->prefix.'pnfpb_ic_schedule_push_notifications';
					
					$selected_day_push_notification_db = $selected_day_push_notification;
					
					$pnfpb_selected_datetime_notification_db = $pnfpb_selected_datetime;
					
					$pnfpb_selected_datetime_notification_db = new DateTime($selected_day_push_notification_db, new DateTimeZone(wp_timezone_string()));

					$pnfpb_selected_datetime_notification_db = $pnfpb_selected_datetime_notification_db->setTimezone(new DateTimeZone(wp_timezone_string()));
				
					$selected_recurring_schedule_formatted_notification_db = strtotime($pnfpb_selected_datetime_notification_db->format('Y-m-d H:i:s'));
					
					update_post_meta( $post->ID, 'pnfpb_push_notification_schedule_checkbox', '' );
				
					update_post_meta( $post->ID, 'pnfpb_ic_fcm_token_ondemand_datepicker_post', '' );

					update_post_meta( $post->ID, 'pnfpb_ic_fcm_token_ondemand_timepicker_post', '');

					update_post_meta( $post->ID, 'pnfpb_ic_fcm_token_ondemand_repeat_day_number_post', '' );

					update_post_meta( $post->ID, 'pnfpb_ic_fcm_token_ondemand_repeat_month_post', '' );

					update_post_meta( $post->ID, 'pnfpb_ic_fcm_token_ondemand_repeat_day_post', '' );
					
					$imageurl = '';
					
					if ( has_post_thumbnail($post->ID) ) {
						
						$imageurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
						
						update_option('pnfpb_ic_fcm_new_post_image',$imageurl);
						
					}
					else 
					{
					
						preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($post->post_content), $imgresult);
				
						if (is_array($imgresult)) {
							if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
								$imageurl = str_replace('"','',$imgresult[2][0]);
								update_option('pnfpb_ic_fcm_new_post_image',$imageurl);
							}
							else 
							{
								update_option('pnfpb_ic_fcm_new_post_image','');
							}
						}					
					}
					
					$data = array('userid' => get_current_user_id(),
								  'action_scheduler_id' => $scheduled_day_push_notification,
								  'title' => stripslashes(wp_strip_all_tags($post->post_title)),
								  'content' => mb_substr(stripslashes(wp_strip_all_tags(urldecode(trim(htmlspecialchars_decode($post->post_content))))),0,130, 'UTF-8'),
								  'image_url' => $imageurl,
								  'click_url' => get_permalink($post->ID),
								  'scheduled_type' => 'single',
								  'scheduled_timestamp' => $selected_recurring_schedule_formatted_notification_db,
							  	  'status'	=> __('Onetime scheduled', "push-notification-for-post-and-buddypress")
								 );
					
					$insertstatus = $wpdb->insert($table,$data);
					
					$insertid = $wpdb->insert_id;
						
					$occurence = 'Onetime scheduled';
					
					$action_scheduler_status = as_schedule_single_action( $scheduled_day_push_notification, 'PNFPB_ondemand_schedule_push_notification_hook', array( $scheduled_day_push_notification,$insertid,$occurence,'','post',$post->ID ));
					
					//admin notices to show settings menu moved to top level menu
				
					$pnfpb_admin_message = '';
					
			
					if ($action_scheduler_status) {
					
						$pnfpb_admin_message = esc_html( __('Push notification scheduled successfully.',"push-notification-for-post-and-buddypress")).'<a href="'.admin_url().'admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc">'.esc_html( __('Refer notification list tab on id ',"push-notification-for-post-and-buddypress")).$insertid.'</a>.'.esc_html( __('Scheduled timestamp reference number is ',"push-notification-for-post-and-buddypress")).$scheduled_day_push_notification.' .'.esc_html( __('Action scheduler task id is ',"push-notification-for-post-and-buddypress")).$action_scheduler_status;
						
				
					}
					else {
						
						$pnfpb_admin_message = esc_html( __('Error in  scheduling push notification for this post, Please try again ',"push-notification-for-post-and-buddypress"));

						
					}
					
					update_post_meta($post->ID,'pnfpb_post_schedule',$pnfpb_admin_message);
					
				}
			
			} else {
				
					update_post_meta( $post->ID, 'pnfpb_push_notification_schedule_checkbox', '' );
				
					update_post_meta( $post->ID, 'pnfpb_ic_fcm_token_ondemand_datepicker_post', '' );

					update_post_meta( $post->ID, 'pnfpb_ic_fcm_token_ondemand_timepicker_post', '');

					update_post_meta( $post->ID, 'pnfpb_ic_fcm_token_ondemand_repeat_day_number_post', '' );

					update_post_meta( $post->ID, 'pnfpb_ic_fcm_token_ondemand_repeat_month_post', '' );

					update_post_meta( $post->ID, 'pnfpb_ic_fcm_token_ondemand_repeat_day_post', '' );
				
					if (!wp_next_scheduled( 'PNFPB_cron_post_hook' ) && (false === as_has_scheduled_action( 'PNFPB_cron_post_hook' )))
					{
						
						$from = get_bloginfo('name');
				
						$post_type = $post->post_type;
				
						$post_meta_box_push_notification = get_post_meta( $post->ID, 'pnfpb_push_notification_send_checkbox', true);

						if ((isset($screen) && $screen->base == "post" && isset( $_POST['pnfpb_push_notification_send_checkbox'] ) && sanitize_text_field(wp_unslash($_POST['pnfpb_push_notification_send_checkbox'] === '1'))) || (isset($screen) && $screen->base == "post" && $post_meta_box_push_notification === '1') || ((!isset($screen) || !isset($screen->base)) && get_option('pnfpb_ic_fcm_'.$post_type.'_enable'))) {		
							
							$postlink = get_permalink($post->ID);

							//new post/page
							if (isset($post->post_status)) {

								if ($post->post_status == 'publish') {
							
									if (isset($_POST['pnfpb_push_notification_send_checkbox'])) {
										update_post_meta( $post->ID, 'pnfpb_push_notification_send_checkbox', '' );
									}
						
                       	 			if ((isset($screen) && $screen->base == "post" && isset( $_POST['pnfpb_push_notification_send_checkbox'] ) && $_POST['pnfpb_push_notification_send_checkbox'] === '1') || (isset($screen) && $screen->base == "post" && $post_meta_box_push_notification === '1') || ((!isset($screen) || !isset($screen->base)) && get_option('pnfpb_ic_fcm_'.$post_type.'_enable'))) {
								
										if ($post_type === 'reply' && function_exists('bbp_get_reply_url')) {
											
											$postlink = bbp_get_reply_url($post->ID);
										}
										
										if ($post_type === 'topic' && function_exists('bbp_get_topic_permalink')) {
											
											$postlink = bbp_get_topic_permalink( $post->ID );
										}
										
										if ($post_type === 'forum' && function_exists('bbp_get_forum_permalink')) {
											
											$postlink = bbp_get_forum_permalink( $post->ID );
										}
										
										$this->PNFPB_icforum_push_notifications_post_web($post->post_title,$post->post_content,$postlink,$post->ID,$post);
								
                        			}
                       
								}

							}
						}
				}
				else
				{
					// update latest post title,content,link in the option to send push notification later as per scheduled time
					if ( $post !== null)
					{
						update_option('pnfpb_ic_fcm_new_post_id',$post->ID);
						update_option('pnfpb_ic_fcm_new_post_title',$post->post_title);
						update_option('pnfpb_ic_fcm_new_post_content',$post->post_content);
						update_option('pnfpb_ic_fcm_new_post_link',get_permalink($post->ID));
						update_option('pnfpb_ic_fcm_new_post_type',$post->post_type);
						update_option('pnfpb_ic_fcm_new_post_author',$post->post_author);
						$imageurl = '';
				
						if ( has_post_thumbnail($post->ID) ) {
							$imageurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
							update_option('pnfpb_ic_fcm_new_post_image',$imageurl);
						}
						else 
						{
					
							preg_match_all('/(alt|title|src)=("[^"]*")/i',stripslashes($post->post_content), $imgresult);
				
							if (is_array($imgresult)) {
								if (count($imgresult) > 2 && is_array($imgresult[2]) && count($imgresult[2]) > 0) {
									$imageurl = str_replace('"','',$imgresult[2][0]);
									update_option('pnfpb_ic_fcm_new_post_image',$imageurl);
								}
								else 
								{
									update_option('pnfpb_ic_fcm_new_post_image','');
								}
							}					
						}				
				
					}
				}				
			}		
?>