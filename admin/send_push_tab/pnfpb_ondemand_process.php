<?php
// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery
$onetime_push_id = "";
$onetime_push_title = "";
$onetime_push_content = "";
$onetime_push_imageurl = "";
$onetime_push_clickurl = "";
$onetime_push_time = "";
$onetime_push_status = "";

$onetime_recurring_day_number = "";
$onetime_recurring_month_number = "";
$onetime_recurring_day_name = "";

$onetime_push_date_field = "";
$onetime_push_time_field = "";
	
$deviceids = [];
$deviceidswebview = [];

global $wpdb;
	
$senderid = 0;
	
if ( is_user_logged_in() ) {
	
    $senderid = get_current_user_id();
	
}

if (
    isset($_POST["submit"]) &&
    isset($_POST["pnfpb_ic_on_demand_push_title"]) &&
    isset($_POST["pnfpb_ic_on_demand_push_content"])
) {
    $apiaccesskey = get_option("pnfpb_ic_fcm_google_api");
	$webpush_option = get_option("pnfpb_webpush_push");
	$webpush_firebase = get_option("pnfpb_webpush_push_firebase");	

    if (
        ($apiaccesskey != "" && $apiaccesskey != false) ||
        get_option("pnfpb_httpv1_push") === "1" ||
        get_option("pnfpb_onesignal_push") === "1" ||
        get_option("pnfpb_progressier_push") === "1" ||
        get_option("pnfpb_webtoapp_push") === "1" ||
		$webpush_option === "1" || 
		$webpush_option === "2" ||
		$webpush_firebase === "1"
    ) {
        $table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
		
		$is_selected_userids = false;
		
		if (isset($_POST["pnfpb_ic_on_demand_push_select_user_ids"]) && sanitize_text_field(
                $_POST["pnfpb_ic_on_demand_push_select_user_ids"]
            ) !== '') {
			
  			$on_demand_push_select_user_id_array = explode(',',sanitize_text_field( $_POST["pnfpb_ic_on_demand_push_select_user_ids"] ));
			$sanitized_on_demand_push_select_user_id_array = implode( ',', wp_parse_id_list( $on_demand_push_select_user_id_array ) );
			
			$deviceids = $wpdb->get_col(
				$wpdb->prepare(
					"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid IN ({$sanitized_on_demand_push_select_user_id_array}) ORDER BY id DESC LIMIT 10",
					$table_name
				)
			);

			$deviceidswebview = array();
			
			$is_selected_userids = true;
			
		} 

        $url = "https://fcm.googleapis.com/fcm/send";

        $regid = $deviceids;

        $activity_content_push = wp_strip_all_tags(
            urldecode(
                sanitize_text_field(
                    wp_unslash(
                        $_POST["pnfpb_ic_on_demand_push_content"]
                    )
                )
            )
        );

        $imageurl = "";
        if (isset($_POST["pnfpb_ic_on_demand_push_image_url"])) {
            $imageurl = sanitize_text_field(
                $_POST["pnfpb_ic_on_demand_push_image_url"]
            );
        }

        $postlink = get_home_url();
        if (isset($_POST["pnfpb_ic_on_demand_push_url_link"])) {
            $postlink = sanitize_text_field(
                $_POST["pnfpb_ic_on_demand_push_url_link"]
            );
        }
		
		$send_push_type = 'ondemand';

		if ($is_selected_userids){
			$send_push_type = 'ondemandselectedusers';
		}
		
		$post_topic_count = intval(get_option('pnfpb_general_subscription_count'));		
		
		if ($webpush_option === '1' || $webpush_option === '2' || $webpush_firebase === '1') {

			$target_deviceid_values = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT * FROM %i WHERE device_id NOT LIKE %s AND web_auth <> %s AND web_256 <> %s AND subscription_auth_token <> %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
					$table_name,
					"%!!%",
					"","",""
				)
			);

			if (count($target_deviceid_values) > 0) {
				foreach ($target_deviceid_values as $target_deviceid_value) {
					$target_subscription_array[] =  [
						"endpoint" => $target_deviceid_value->web_auth,
						"keys" => [
							'p256dh' => $target_deviceid_value->web_256,
							'auth' => $target_deviceid_value->subscription_auth_token
						]
					];
				}
				
				if (
					defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON
				) {
					$PNFPB_WP_web_push_notification_class_obj = new PNFPB_web_push_notification_class();
					$PNFPB_WP_web_push_notification_class_obj->PNFPB_web_push_notification(
						0,
						stripslashes(
							wp_strip_all_tags(
								sanitize_text_field(
									wp_unslash(
										$_POST[
											"pnfpb_ic_on_demand_push_title"
										]
									)
								)
							)
						),
						mb_substr(
							stripslashes(
								wp_strip_all_tags(
									urldecode(
										trim(
											htmlspecialchars_decode(
												$activity_content_push
											)
										)
									)
								)
							),
							0,
							130,
							"UTF-8"
						),
						$imageurl,
						$imageurl,
						$postlink,
						["click_url" => $postlink],
						$target_subscription_array,
						$senderid,
						0,
						$send_push_type
					);						
				} else {
					$action_scheduler_status = as_schedule_single_action(
						time()+5,
						"PNFPB_webpush_schedule_push_notification_hook",
						[
							0,
							stripslashes(
								wp_strip_all_tags(
									sanitize_text_field(
										wp_unslash(
											$_POST[
												"pnfpb_ic_on_demand_push_title"
											]
										)
									)
								)
							),
							mb_substr(
								stripslashes(
									wp_strip_all_tags(
										urldecode(
											trim(
												htmlspecialchars_decode(
													$activity_content_push
												)
											)
										)
									)
								),
								0,
								130,
								"UTF-8"
							),
							$imageurl,
							$imageurl,
							$postlink,
							["click_url" => $postlink],
							$target_subscription_array,
							$senderid,
							0,
							$send_push_type,
						]
					);
				}
			}
		} else {		

			if (get_option("pnfpb_webtoapp_push") === "1") {
				if (
					defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON
				) {
					$PNFPB_WP_webtoapp_notification_class_obj = new PNFPB_webtoapp_notification_class();
					$PNFPB_WP_webtoapp_notification_class_obj->PNFPB_webtoapp_notification(
						0,
						stripslashes(
							wp_strip_all_tags(
								sanitize_text_field(
									wp_unslash(
										$_POST["pnfpb_ic_on_demand_push_title"]
									)
								)
							)
						),
						$activity_content_push,
						$postlink,
						$imageurl
					);					
				} else {
					$action_scheduler_status = as_schedule_single_action(
						time()+5,
						"PNFPB_webtoapp_schedule_push_notification_hook",
						[
							0,
							stripslashes(
								wp_strip_all_tags(
									sanitize_text_field(
										wp_unslash(
											$_POST["pnfpb_ic_on_demand_push_title"]
										)
									)
								)
							),
							$activity_content_push,
							$postlink,
							$imageurl,
						]
					);
				}
			}

			if (get_option("pnfpb_progressier_push") === "1") {
				if (
					defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON
				) {
					if ($is_selected_userids) {
						$PNFPB_WP_progressier_notification_class_obj = new PNFPB_progressier_notification_class();
						$PNFPB_WP_progressier_notification_class_obj->PNFPB_progressier_notification(
							0,
							stripslashes(
								wp_strip_all_tags(
									sanitize_text_field(
										wp_unslash(
											$_POST["pnfpb_ic_on_demand_push_title"]
										)
									)
								)
							),
							$activity_content_push,
							$postlink,
							$imageurl,
							$deviceids
						);					
					} else {
						$PNFPB_WP_progressier_notification_class_obj = new PNFPB_progressier_notification_class();
						$PNFPB_WP_progressier_notification_class_obj->PNFPB_progressier_notification(
							0,
							stripslashes(
								wp_strip_all_tags(
									sanitize_text_field(
										wp_unslash(
											$_POST["pnfpb_ic_on_demand_push_title"]
										)
									)
								)
							),
							$activity_content_push,
							$postlink,
							$imageurl
						);					
					}					
				} else {
					if ($is_selected_userids) {
						$action_scheduler_status = as_schedule_single_action(
							time()+5,
							"PNFPB_progressier_schedule_push_notification_hook",
							[
								0,
								stripslashes(
									wp_strip_all_tags(
										sanitize_text_field(
											wp_unslash(
												$_POST["pnfpb_ic_on_demand_push_title"]
											)
										)
									)
								),
								$activity_content_push,
								$postlink,
								$imageurl,
								$deviceids
							]
						);				
					} else {
						$action_scheduler_status = as_schedule_single_action(
							time()+5,
							"PNFPB_progressier_schedule_push_notification_hook",
							[
								0,
								stripslashes(
									wp_strip_all_tags(
										sanitize_text_field(
											wp_unslash(
												$_POST["pnfpb_ic_on_demand_push_title"]
											)
										)
									)
								),
								$activity_content_push,
								$postlink,
								$imageurl,
							]
						);
					}
				}
			} else {
				if (get_option("pnfpb_onesignal_push") === "1") {
					if (
						defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON
					) {
						if ($is_selected_userids) {
							$PNFPB_WP_onesignal_notification_class_obj = new PNFPB_onesignal_notification_class();
							$PNFPB_WP_onesignal_notification_class_obj->PNFPB_onesignal_notification(
									0,
									stripslashes(
										wp_strip_all_tags(
											sanitize_text_field(
												wp_unslash(
													$_POST["pnfpb_ic_on_demand_push_title"]
												)
											)
										)
									),
									$activity_content_push,
									$postlink,
									$imageurl,
									$deviceids
								);
						} else {
							$PNFPB_WP_onesignal_notification_class_obj = new PNFPB_onesignal_notification_class();
							$PNFPB_WP_onesignal_notification_class_obj->PNFPB_onesignal_notification(
								0,
								stripslashes(
									wp_strip_all_tags(
										sanitize_text_field(
											wp_unslash(
												$_POST["pnfpb_ic_on_demand_push_title"]
											)
										)
									)
								),
								$activity_content_push,
								$postlink,
								$imageurl
							);
						}						
					} else {
						if ($is_selected_userids) {
							$action_scheduler_status = as_schedule_single_action(
								time()+5,
								"PNFPB_onesignal_schedule_push_notification_hook",
								[
									0,
									stripslashes(
										wp_strip_all_tags(
											sanitize_text_field(
												wp_unslash(
													$_POST[
														"pnfpb_ic_on_demand_push_title"
													]
												)
											)
										)
									),
									$activity_content_push,
									$postlink,
									$imageurl,
									$deviceids
								]
							);
						} else {
							$action_scheduler_status = as_schedule_single_action(
								time()+5,
								"PNFPB_onesignal_schedule_push_notification_hook",
								[
									0,
									stripslashes(
										wp_strip_all_tags(
											sanitize_text_field(
												wp_unslash(
													$_POST[
														"pnfpb_ic_on_demand_push_title"
													]
												)
											)
										)
									),
									$activity_content_push,
									$postlink,
									$imageurl
								]
							);
						}
					}
				} else {
					if (get_option("pnfpb_httpv1_push") === "1") {

						if (
							defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON
						) {
							$FB_httpv1_notification_class_obj = new PNFPB_firebase_httpv1_notification_class();
							$FB_httpv1_notification_class_obj->PNFPB_firebase_httpv1_notification(							
								0,
								stripslashes(
									wp_strip_all_tags(
										sanitize_text_field(
											wp_unslash(
												$_POST[
													"pnfpb_ic_on_demand_push_title"
												]
											)
										)
									)
								),
								mb_substr(
									stripslashes(
										wp_strip_all_tags(
											urldecode(
												trim(
													htmlspecialchars_decode(
														$activity_content_push
													)
												)
											)
										)
									),
									0,
									130,
									"UTF-8"
								),
								$imageurl,
								$imageurl,
								$postlink,
								["click_url" => $postlink],
								$regid,
								$deviceidswebview,
								$senderid,
								0,
								$send_push_type,
								"",
								0,
								$post_topic_count
							);								
						} else {
							$action_scheduler_status = as_schedule_single_action(
								time()+5,
								"PNFPB_httpv1_schedule_push_notification_hook",
								[
									0,
									stripslashes(
										wp_strip_all_tags(
											sanitize_text_field(
												wp_unslash(
													$_POST[
														"pnfpb_ic_on_demand_push_title"
													]
												)
											)
										)
									),
									mb_substr(
										stripslashes(
											wp_strip_all_tags(
												urldecode(
													trim(
														htmlspecialchars_decode(
															$activity_content_push
														)
													)
												)
											)
										),
										0,
										130,
										"UTF-8"
									),
									$imageurl,
									$imageurl,
									$postlink,
									["click_url" => $postlink],
									$regid,
									$deviceidswebview,
									$senderid,
									0,
									$send_push_type,
									"",
									0,
									$post_topic_count									
								]
							);
						}
					}
				}
			}
		}

        $bpuserid = 0;

        if (is_user_logged_in()) {
            $bpuserid = get_current_user_id();
        }

        $table = $wpdb->prefix . "pnfpb_ic_schedule_push_notifications";

        if (
            isset($_POST["pnfpb_ic_on_demand_push_id"]) &&
            $_POST["pnfpb_ic_on_demand_push_id"] != "" &&
            $_POST["pnfpb_ic_on_demand_push_id"] != 0 &&
            $_POST["pnfpb_ic_on_demand_push_id"] != "0"
        ) {
			
            $onetime_title = stripslashes(
                wp_strip_all_tags(
                    sanitize_text_field($_POST["pnfpb_ic_on_demand_push_title"])
                )
            );

            $onetime_content = trim(stripslashes(
                wp_strip_all_tags($activity_content_push))
            );

            $onetime_timestamp = time();

            $insertid = intval(
                sanitize_text_field($_POST["pnfpb_ic_on_demand_push_id"])
            );

            $wpdb->query(
                $wpdb->prepare(
                    "UPDATE %i 
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
                    "onetime",
                    "sent",
                    $insertid
                )
            );
			if ($action_scheduler_status) { ?>
				<div class="notice notice-success is-dismissible">
					<p>
						<?php echo esc_html(__("Push notification scheduled successfully.", "push-notification-for-post-and-buddypress"))?>
					</p>
					<a href="<?php echo esc_url(admin_url()."admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc"); ?>">
						<?php echo esc_html(__("Notification id: ", "push-notification-for-post-and-buddypress").$insertid)?>
					</a>
					<p>
						<?php echo esc_html(__("Refer action scheduler tab for scheduled tasks. Scheduled timestamp reference number is ").$onetime_timestamp)?>
					</p>
					<p>
						<a href="<?php echo esc_url(admin_url().'admin.php?page=pnfpb_icfm_action_scheduler&orderby=schedule&order=desc&s=pnfpb&action=-1&paged=1&action2=-1'); ?>">				
							<?php echo esc_html(__("Action scheduler task id is ").$action_scheduler_status)?>
						</a>
					</p>
				</div>
			<?php } else {
				$error_message = "";
				if (is_wp_error($action_scheduler_status)) {
					$error_message = $action_scheduler_status->get_error_message();
				}
				?>
				<div class="notice notice-error is-dismissible">
					<p>
						<?php esc_html_e(
					"CRON Error...in scheduling notification. Please try again",
					"push-notification-for-post-and-buddypress"
				); ?>
					</p>
					<?php if ($error_message != "") { ?>
						<p>
							<?php echo esc_html($error_message); ?>
						</p>
					<?php } ?>
				</div>
			<?php }				
        } else {
			$onetime_timestamp = time();
            $data = [
                "userid" => $bpuserid,
                "action_scheduler_id" => null,
                "title" => stripslashes(
                    sanitize_text_field($_POST["pnfpb_ic_on_demand_push_title"])
                ),
                "content" => mb_substr(
                    wp_strip_all_tags(
                        urldecode(
                            trim(
                                htmlspecialchars_decode(
                                    wp_unslash(
                                        sanitize_text_field(
                                            $activity_content_push
                                        )
                                    )
                                )
                            )
                        )
                    ),
                    0,
                    130,
                    "UTF-8"
                ),
                "image_url" => $imageurl,
                "click_url" => $postlink,
                "scheduled_timestamp" => $onetime_timestamp,
                "scheduled_type" => "onetime",
                "status" => "sent",
            ];
            $insertid = $wpdb->insert($table, $data);
			if ($action_scheduler_status) { ?>
				<div class="notice notice-success is-dismissible">
					<p>
						<?php echo esc_html(__("Push notification scheduled successfully.", "push-notification-for-post-and-buddypress"))?>
					</p>
					<a href="<?php echo esc_url(admin_url()."admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc"); ?>">
						<?php echo esc_html(__("Notification id: ", "push-notification-for-post-and-buddypress").$insertid)?>
					</a>
					<p>
						<?php echo esc_html(__("Refer action scheduler tab for scheduled tasks. Scheduled timestamp reference number is ").$onetime_timestamp)?>
					</p>
					<p>
						<a href="<?php echo esc_url(admin_url().'admin.php?page=pnfpb_icfm_action_scheduler&orderby=schedule&order=desc&s=pnfpb&action=-1&paged=1&action2=-1'); ?>">				
							<?php echo esc_html(__("Action scheduler task id is ").$action_scheduler_status)?>
						</a>
					</p>
				</div>
			<?php } else {
				$error_message = "";
				if (is_wp_error($action_scheduler_status)) {
					$error_message = $action_scheduler_status->get_error_message();
				}
				?>
				<div class="notice notice-error is-dismissible">
					<p>
						<?php esc_html_e(
					"CRON Error...in scheduling notification. Please try again",
					"push-notification-for-post-and-buddypress"
				); ?>
					</p>
					<?php if ($error_message != "") { ?>
						<p>
							<?php echo esc_html($error_message); ?>
						</p>
					<?php } ?>
				</div>
			<?php }				
        }
    }
} else {
    if (
        isset($_POST["schedule_now"]) &&
        isset($_POST["pnfpb_ic_on_demand_push_title"]) &&
        isset($_POST["pnfpb_ic_on_demand_push_content"])
    ) {
		
		$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
		
		$is_selected_userids = false;

		if (isset($_POST["pnfpb_ic_on_demand_push_select_user_ids"]) && sanitize_text_field(wp_unslash($_POST["pnfpb_ic_on_demand_push_select_user_ids"])) !== '') {

			$on_demand_push_select_user_id_array = explode(',',sanitize_text_field(wp_unslash( $_POST["pnfpb_ic_on_demand_push_select_user_ids"] )));

			$sanitized_on_demand_push_select_user_id_array = implode( ',', wp_parse_id_list( $on_demand_push_select_user_id_array ) );

			$deviceids = $wpdb->get_col(
				$wpdb->prepare(
					"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid IN ({$sanitized_on_demand_push_select_user_id_array})",
					$table_name
				)
			);

			$deviceidswebview = array();

			$is_selected_userids = true;

		}
		
        $selected_day_push_notification =
            sanitize_text_field(
                wp_unslash(
                    $_POST["pnfpb_ic_fcm_token_ondemand_datepicker"]
                )
            ) .
            " " .
            sanitize_text_field(
                wp_unslash(
                    $_POST["pnfpb_ic_fcm_token_ondemand_timepicker"]
                )
            );

        if ($_POST["pnfpb_ic_fcm_token_ondemand_timepicker"] === "") {
            $selected_day_push_notification =
                sanitize_text_field(
                    wp_unslash(
                        $_POST["pnfpb_ic_fcm_token_ondemand_datepicker"]
                    )
                ) . "00:00";
        }

        if (
            $_POST["pnfpb_ic_fcm_token_ondemand_datepicker"] === "" &&
            $_POST["pnfpb_ic_fcm_token_ondemand_timepicker"] === ""
        ) {
            $pnfpb_selected_datetime = new DateTime(
                "now",
                new DateTimeZone(wp_timezone_string())
            );
        } else {
            $pnfpb_selected_datetime = new DateTime(
                $selected_day_push_notification,
                new DateTimeZone(wp_timezone_string())
            );
        }

        $pnfpb_selected_datetime = $pnfpb_selected_datetime->setTimezone(
            new DateTimeZone("UTC")
        );

        $scheduled_day_push_notification = strtotime(
            $pnfpb_selected_datetime->format("Y-m-d H:i:s")
        );

        if (
            isset($_POST["pnfpb_ic_fcm_token_ondemand_repeat_month"]) &&
            ($_POST["pnfpb_ic_fcm_token_ondemand_repeat_month"] != "" ||
                $_POST["pnfpb_ic_fcm_token_ondemand_repeat_day"] != "")
        ) {

            $selected_recurring_schedule_formatted = $pnfpb_selected_datetime->format(
                "Y-m-d H:i:s"
            );

            $selected_recurring_schedule_split_array = explode(
                " ",
                $selected_recurring_schedule_formatted
            );

            $selected_recurring_date_array = explode(
                "-",
                $selected_recurring_schedule_split_array[0]
            );

            $selected_recurring_date_month = 0;

            $selected_recurring_date_day = 0;

            if (count($selected_recurring_date_array) > 2) {
                $selected_recurring_date_month =
                    $selected_recurring_date_array[1];

                $selected_recurring_date_day =
                    $selected_recurring_date_array[2];
            }

            if (
                $_POST["pnfpb_ic_fcm_token_ondemand_repeat_day_number"] !== ""
            ) {
                $selected_recurring_date_day = sanitize_text_field(
                    wp_unslash(
                        $_POST["pnfpb_ic_fcm_token_ondemand_repeat_day_number"]
                    )
                );
            } else {
                $selected_recurring_date_day = "*";
            }

            $selected_recurring_time_array = explode(
                ":",
                $selected_recurring_schedule_split_array[1]
            );

            $selected_recurring_hour = 0;

            $selected_recurring_minute = 0;

            if (count($selected_recurring_time_array) > 1) {
                $selected_recurring_hour = $selected_recurring_time_array[0];

                $selected_recurring_minute = $selected_recurring_time_array[1];
            }

            $selected_recurring_cycle_status = esc_html(
                __("Recurring ", "push-notification-for-post-and-buddypress")
            );
            $selected_recurring_month_status = "";
            $selected_recurring_day_status = "";

            if ($_POST["pnfpb_ic_fcm_token_ondemand_repeat_month"] === "") {
                $selected_recurring_month = "*";
                $selected_recurring_month_status .= esc_html(
                    __(
                        "Every month ",
                        "push-notification-for-post-and-buddypress"
                    )
                );
            } else {
                $selected_recurring_month = sanitize_text_field(
                    wp_unslash(
                        $_POST["pnfpb_ic_fcm_token_ondemand_repeat_month"]
                    )
                );

                if (
                    $_POST["pnfpb_ic_fcm_token_ondemand_repeat_month"] === "*"
                ) {
                    $selected_recurring_month_status .= esc_html(
                        __(
                            "Every Month ",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if (
                    $_POST["pnfpb_ic_fcm_token_ondemand_repeat_month"] === "1"
                ) {
                    $selected_recurring_month = "1";

                    $selected_recurring_month_status .= esc_html(
                        __(
                            "Every January ",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if (
                    $_POST["pnfpb_ic_fcm_token_ondemand_repeat_month"] === "2"
                ) {
                    $selected_recurring_month = "2";

                    $selected_recurring_month_status .= esc_html(
                        __(
                            "Every February ",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if (
                    $_POST["pnfpb_ic_fcm_token_ondemand_repeat_month"] === "3"
                ) {
                    $selected_recurring_month = "3";

                    $selected_recurring_month_status .= esc_html(
                        __(
                            "Every March ",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if (
                    $_POST["pnfpb_ic_fcm_token_ondemand_repeat_month"] === "4"
                ) {
                    $selected_recurring_month = "4";

                    $selected_recurring_month_status .= esc_html(
                        __(
                            "Every April ",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if (
                    $_POST["pnfpb_ic_fcm_token_ondemand_repeat_month"] === "5"
                ) {
                    $selected_recurring_month = "5";

                    $selected_recurring_month_status .= esc_html(
                        __(
                            "Every May ",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if (
                    $_POST["pnfpb_ic_fcm_token_ondemand_repeat_month"] === "6"
                ) {
                    $selected_recurring_month = "6";

                    $selected_recurring_month_status .= esc_html(
                        __(
                            "Every June ",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if (
                    $_POST["pnfpb_ic_fcm_token_ondemand_repeat_month"] === "7"
                ) {
                    $selected_recurring_month = "7";

                    $selected_recurring_month_status .= esc_html(
                        __(
                            "Every July ",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if (
                    $_POST["pnfpb_ic_fcm_token_ondemand_repeat_month"] === "8"
                ) {
                    $selected_recurring_month = "8";

                    $selected_recurring_month_status .= esc_html(
                        __(
                            "Every August ",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if (
                    $_POST["pnfpb_ic_fcm_token_ondemand_repeat_month"] === "9"
                ) {
                    $selected_recurring_month = "9";

                    $selected_recurring_month_status .= esc_html(
                        __(
                            "Every September ",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if (
                    $_POST["pnfpb_ic_fcm_token_ondemand_repeat_month"] === "10"
                ) {
                    $selected_recurring_month = "10";

                    $selected_recurring_month_status .= esc_html(
                        __(
                            "Every October ",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if (
                    $_POST["pnfpb_ic_fcm_token_ondemand_repeat_month"] === "11"
                ) {
                    $selected_recurring_month = "11";

                    $selected_recurring_month_status .= esc_html(
                        __(
                            "Every November ",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if (
                    $_POST["pnfpb_ic_fcm_token_ondemand_repeat_month"] === "12"
                ) {
                    $selected_recurring_month = "12";

                    $selected_recurring_month_status .= esc_html(
                        __(
                            "Every December ",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }
            }

            if ($_POST["pnfpb_ic_fcm_token_ondemand_repeat_day"] === "") {
                $selected_recurring_day = "*";

                $selected_recurring_day_status .= esc_html(
                    __(
                        " (any day)",
                        "push-notification-for-post-and-buddypress"
                    )
                );
            } else {
                $selected_recurring_day = sanitize_text_field(
                    wp_unslash($_POST["pnfpb_ic_fcm_token_ondemand_repeat_day"])
                );

                if ($_POST["pnfpb_ic_fcm_token_ondemand_repeat_day"] === "0") {
                    $selected_recurring_day = "0";

                    $selected_recurring_day_status .= esc_html(
                        __(
                            " (on Sunday)",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if ($_POST["pnfpb_ic_fcm_token_ondemand_repeat_day"] === "1") {
                    $selected_recurring_day = "1";

                    $selected_recurring_day_status .= esc_html(
                        __(
                            " (on Monday)",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if ($_POST["pnfpb_ic_fcm_token_ondemand_repeat_day"] === "2") {
                    $selected_recurring_day = "2";

                    $selected_recurring_day_status .= esc_html(
                        __(
                            " (on Tuesday)",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if ($_POST["pnfpb_ic_fcm_token_ondemand_repeat_day"] === "3") {
                    $selected_recurring_day = "3";

                    $selected_recurring_day_status .= esc_html(
                        __(
                            " (on Wednesday)",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if ($_POST["pnfpb_ic_fcm_token_ondemand_repeat_day"] === "4") {
                    $selected_recurring_day = "4";

                    $selected_recurring_day_status .= esc_html(
                        __(
                            " (on Thursday)",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if ($_POST["pnfpb_ic_fcm_token_ondemand_repeat_day"] === "5") {
                    $selected_recurring_day = "5";

                    $selected_recurring_day_status .= esc_html(
                        __(
                            " (on Friday)",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }

                if ($_POST["pnfpb_ic_fcm_token_ondemand_repeat_day"] === "6") {
                    $selected_recurring_day = "6";

                    $selected_recurring_day_status .= esc_html(
                        __(
                            " (on Saturday)",
                            "push-notification-for-post-and-buddypress"
                        )
                    );
                }
            }

            $occurence = "recurring";

            $selected_recurring_cron_string =
                ltrim($selected_recurring_minute, "0") .
                " " .
                ltrim($selected_recurring_hour, "0") .
                " " .
                ltrim($selected_recurring_date_day, "0") .
                " " .
                ltrim($selected_recurring_month, "0") .
                " " .
                ltrim($selected_recurring_day, "0");

            $table = $wpdb->prefix . "pnfpb_ic_schedule_push_notifications";

            $pnfpb_selected_datetime_notification_db = $pnfpb_selected_datetime;

            $selected_day_push_notification_db = $selected_day_push_notification;

            $pnfpb_selected_datetime_notification_db = new DateTime(
                $selected_day_push_notification_db,
                new DateTimeZone(wp_timezone_string())
            );

            $pnfpb_selected_datetime_notification_db = $pnfpb_selected_datetime_notification_db->setTimezone(
                new DateTimeZone(wp_timezone_string())
            );

            $selected_recurring_schedule_formatted_notification_db = strtotime(
                $pnfpb_selected_datetime_notification_db->format("Y-m-d H:i:s")
            );

            if ($_POST["pnfpb_ic_on_demand_push_id"]) {
                $onetime_title = stripslashes(
                    wp_strip_all_tags(
                        sanitize_text_field(
                            $_POST["pnfpb_ic_on_demand_push_title"]
                        )
                    )
                );

                $onetime_content = stripslashes(
                    wp_strip_all_tags(
                        urldecode(
                            sanitize_text_field(
                                $_POST["pnfpb_ic_on_demand_push_content"]
                            )
                        )
                    )
                );

                $onetime_userid = get_current_user_id();

                $onetime_status =
                    $selected_recurring_cycle_status .
                    " " .
                    $selected_recurring_month_status .
                    " " .
                    $selected_recurring_day_status;

                $insertid = intval(
                    sanitize_text_field($_POST["pnfpb_ic_on_demand_push_id"])
                );

                $insertlink = sanitize_text_field(
                    $_POST["pnfpb_ic_on_demand_push_url_link"]
                );

                $insertimageurl = sanitize_text_field(
                    $_POST["pnfpb_ic_on_demand_push_image_url"]
                );

                $insert_day_number = sanitize_text_field(
                    $_POST["pnfpb_ic_fcm_token_ondemand_repeat_day_number"]
                );

                $insert_month_number = sanitize_text_field(
                    $_POST["pnfpb_ic_fcm_token_ondemand_repeat_month"]
                );

                $insert_day_name = sanitize_text_field(
                    $_POST["pnfpb_ic_fcm_token_ondemand_repeat_day"]
                );

                $onetime_push_update_status = $wpdb->query(
                    $wpdb->prepare(
                        "UPDATE %i 
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
                        "recurring",
                        $insert_day_number,
                        $insert_month_number,
                        $insert_day_name,
                        $onetime_status,
                        $insertid
                    )
                );
            } else {
                $data = [
                    "userid" => get_current_user_id(),
                    "action_scheduler_id" => $scheduled_day_push_notification,
                    "title" => stripslashes(
                        wp_strip_all_tags(
                            sanitize_text_field(
                                $_POST["pnfpb_ic_on_demand_push_title"]
                            )
                        )
                    ),
                    "content" => ($pushcontent = mb_substr(
                        stripslashes(
                            wp_strip_all_tags(
                                urldecode(
                                    trim(
                                        htmlspecialchars_decode(
                                            sanitize_text_field(
                                                $_POST[
                                                    "pnfpb_ic_on_demand_push_content"
                                                ]
                                            )
                                        )
                                    )
                                )
                            )
                        ),
                        0,
                        130,
                        "UTF-8"
                    )),
                    "image_url" => sanitize_text_field(
                        $_POST["pnfpb_ic_on_demand_push_image_url"]
                    ),
                    "click_url" => sanitize_text_field(
                        $_POST["pnfpb_ic_on_demand_push_url_link"]
                    ),
                    "scheduled_timestamp" => $selected_recurring_schedule_formatted_notification_db,
                    "scheduled_type" => "recurring",
                    "recurring_day_number" => sanitize_text_field(
                        $_POST["pnfpb_ic_fcm_token_ondemand_repeat_day_number"]
                    ),
                    "recurring_month_number" => sanitize_text_field(
                        $_POST["pnfpb_ic_fcm_token_ondemand_repeat_month"]
                    ),
                    "recurring_day_name" => sanitize_text_field(
                        $_POST["pnfpb_ic_fcm_token_ondemand_repeat_day"]
                    ),
                    "status" =>
                        $selected_recurring_cycle_status .
                        " " .
                        $selected_recurring_month_status .
                        " " .
                        $selected_recurring_day_status,
                ];

                $insertstatus = $wpdb->insert($table, $data);

                $insertid = $wpdb->insert_id;
            }

            $action_scheduler_status = "";
			
			if ($is_selected_userids) {
				$action_scheduler_status = as_schedule_cron_action(
					$scheduled_day_push_notification,
					$selected_recurring_cron_string,
					"PNFPB_ondemand_schedule_push_notification_hook",
					[
						$scheduled_day_push_notification,
						$insertid,
						$occurence,
						$selected_recurring_cycle_status .
						" " .
						$selected_recurring_month_status .
						" " .
						$selected_recurring_day_status,
						"",
						0,
						$deviceids						
					],
				);				
			} else {
				$action_scheduler_status = as_schedule_cron_action(
					$scheduled_day_push_notification,
					$selected_recurring_cron_string,
					"PNFPB_ondemand_schedule_push_notification_hook",
					[
						$scheduled_day_push_notification,
						$insertid,
						$occurence,
						$selected_recurring_cycle_status .
						" " .
						$selected_recurring_month_status .
						" " .
						$selected_recurring_day_status,
						"",
						0,
						[]						
					],
				);				
			}
        } else {
            $table = $wpdb->prefix . "pnfpb_ic_schedule_push_notifications";

            $selected_day_push_notification_db = $selected_day_push_notification;

            $pnfpb_selected_datetime_notification_db = $pnfpb_selected_datetime;

            $pnfpb_selected_datetime_notification_db = new DateTime(
                $selected_day_push_notification_db,
                new DateTimeZone(wp_timezone_string())
            );

            $pnfpb_selected_datetime_notification_db = $pnfpb_selected_datetime_notification_db->setTimezone(
                new DateTimeZone(wp_timezone_string())
            );

            $selected_recurring_schedule_formatted_notification_db = strtotime(
                $pnfpb_selected_datetime_notification_db->format("Y-m-d H:i:s")
            );

            if ($_POST["pnfpb_ic_on_demand_push_id"]) {
                $onetime_title = stripslashes(
                    wp_strip_all_tags(
                        sanitize_text_field(
                            $_POST["pnfpb_ic_on_demand_push_title"]
                        )
                    )
                );

                $onetime_content = stripslashes(
                    wp_strip_all_tags(
                        urldecode(
                            sanitize_text_field(
                                $_POST["pnfpb_ic_on_demand_push_content"]
                            )
                        )
                    )
                );

                $onetime_status = esc_html(
                    __(
                        "Onetime scheduled",
                        "push-notification-for-post-and-buddypress"
                    )
                );

                $onetime_userid = get_current_user_id();

                $insertid = intval(
                    sanitize_text_field($_POST["pnfpb_ic_on_demand_push_id"])
                );

                $insertlink = sanitize_text_field(
                    $_POST["pnfpb_ic_on_demand_push_url_link"]
                );

                $insertimageurl = sanitize_text_field(
                    $_POST["pnfpb_ic_on_demand_push_image_url"]
                );

                $onetime_push_update_status = $wpdb->query(
                    $wpdb->prepare(
                        "UPDATE %i 
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
                        "single",
                        $onetime_status,
                        $insertid
                    )
                );
            } else {
                $data = [
                    "userid" => get_current_user_id(),
                    "action_scheduler_id" => $scheduled_day_push_notification,
                    "title" => stripslashes(
                        wp_strip_all_tags(
                            sanitize_text_field(
                                $_POST["pnfpb_ic_on_demand_push_title"]
                            )
                        )
                    ),
                    "content" => mb_substr(
                        stripslashes(
                            wp_strip_all_tags(
                                urldecode(
                                    trim(
                                        htmlspecialchars_decode(
                                            sanitize_text_field(
                                                $_POST[
                                                    "pnfpb_ic_on_demand_push_content"
                                                ]
                                            )
                                        )
                                    )
                                )
                            )
                        ),
                        0,
                        130,
                        "UTF-8"
                    ),
                    "image_url" => sanitize_text_field(
                        $_POST["pnfpb_ic_on_demand_push_image_url"]
                    ),
                    "click_url" => sanitize_text_field(
                        $_POST["pnfpb_ic_on_demand_push_url_link"]
                    ),
                    "scheduled_type" => "single",
                    "scheduled_timestamp" => $selected_recurring_schedule_formatted_notification_db,
                    "status" => __(
                        "Onetime scheduled",
                        "push-notification-for-post-and-buddypress"
                    ),
                ];

                $insertstatus = $wpdb->insert($table, $data);

                $insertid = $wpdb->insert_id;
            }

            $occurence = "Onetime scheduled";
			
			if ($is_selected_userids) {
				$action_scheduler_status = as_schedule_single_action(
					$scheduled_day_push_notification,
					"PNFPB_ondemand_schedule_push_notification_hook",
					[$scheduled_day_push_notification, $insertid, $occurence, "","",0,$deviceids],
				);				
			} else {
				$action_scheduler_status = as_schedule_single_action(
					$scheduled_day_push_notification,
					"PNFPB_ondemand_schedule_push_notification_hook",
					[$scheduled_day_push_notification, $insertid, $occurence, ""]
				);
			}
        }

        if ($action_scheduler_status) { ?>
    			<div class="notice notice-success is-dismissible">
					<p>
						<?php echo esc_html(__("Push notification scheduled successfully.", "push-notification-for-post-and-buddypress"))?>
					</p>
					<a href="<?php echo esc_url(admin_url()."admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc"); ?>">
						<?php echo esc_html(__("Notification id: ", "push-notification-for-post-and-buddypress").$insertid)?>
					</a>
					<p>
						<?php echo esc_html(__("Refer action scheduler tab for scheduled tasks. Scheduled timestamp reference number is ").$scheduled_day_push_notification)?>
					</p>
					<p>
						<?php echo esc_html(__("Action scheduler task id is ").$action_scheduler_status)?>
					</p>
    			</div>
		<?php } else {
            $error_message = "";
            if (is_wp_error($action_scheduler_status)) {
                $error_message = $action_scheduler_status->get_error_message();
            }
            ?>
	    			<div class="notice notice-error is-dismissible">
        				<p>
							<?php esc_html_e(
                				"CRON Error...in scheduling notification. Please try again",
               					 "push-notification-for-post-and-buddypress"
            				); ?>
						</p>
						<?php if ($error_message != "") { ?>
						<p>
							<?php echo esc_html($error_message); ?>
						</p>
						<?php } ?>
    				</div>
					<?php }
    } else {
        if (
            isset($_POST["schedule_now"]) &&
            isset($_POST["pnfpb_ic_on_demand_push_title"]) &&
            isset($_POST["pnfpb_ic_on_demand_push_content"])
        ) { ?>
    				<div class="notice notice-error is-dismissible">
        				<p>
							<?php esc_html_e(
                				"Error...Please fill all required fields and try again!!!",
                				"push-notification-for-post-and-buddypress"
            				); ?>
						</p>
    				</div>				
			<?php } else {if (
                isset($_GET["action"]) &&
                isset($_GET["pushnotificationid"]) &&
                isset($_GET["_wpnonce"]) &&
                intval(
                    sanitize_text_field(wp_unslash($_GET["pushnotificationid"]))
                ) > 0
            ) {
                $nonce = "";

                $nonce = esc_attr(
                    sanitize_text_field(wp_unslash($_GET["_wpnonce"]))
                );

                if (!wp_verify_nonce($nonce, "pnfpb_edit_pushnotification")) {
                    die("wnonce failure");
                } else {
                    global $wpdb;

                    $notification_table_name =
                        $wpdb->prefix . "pnfpb_ic_schedule_push_notifications";

                    $pushnotificationid = sanitize_text_field(
                        wp_unslash($_GET["pushnotificationid"])
                    );

                    $pushnotificationid = esc_html($pushnotificationid);

                    $notifications = $wpdb->get_results(
                        $wpdb->prepare(
                            "SELECT * FROM %i WHERE `id` = %d ",
                            $notification_table_name,
                            $pushnotificationid
                        )
                    );

                    $onetime_push_id = $pushnotificationid;

                    foreach ($notifications as $notification) {
                        $onetime_push_title = $notification->title;
                        $onetime_push_content = $notification->content;
                        $onetime_push_imageurl = $notification->image_url;
                        $onetime_push_clickurl = $notification->click_url;
                        $onetime_push_time = $notification->scheduled_timestamp;

                        $onetime_push_date_field = gmdate(
                            "Y-m-d",
                            $onetime_push_time
                        );
                        $onetime_push_time_field = gmdate(
                            "H:i:s",
                            $onetime_push_time
                        );

                        if ($notification->recurring_day_number != null) {
                            $onetime_recurring_day_number =
                                $notification->recurring_day_number;
                        }

                        if ($notification->recurring_month_number != null) {
                            $onetime_recurring_month_number =
                                $notification->recurring_month_number;
                        }

                        if ($notification->recurring_day_name != null) {
                            $onetime_recurring_day_name =
                                $notification->recurring_day_name;
                        }

                        $onetime_push_status = $notification->status;
                    }
                }
            }}
    }
}
	
function pnfpb_recursive_sanitize_array($array) {
    foreach ( $array as $key => &$value ) {
        if ( is_array( $value ) ) {
            $value = recursive_sanitize_text_field($value);
        }
        else {
            $value = sanitize_text_field( $value );
        }
    }

    return $array;
}
