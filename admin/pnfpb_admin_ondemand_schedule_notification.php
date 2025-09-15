<?php
// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

global $wpdb;

$apiaccesskey = get_option("pnfpb_ic_fcm_google_api");
$webpush_option = get_option("pnfpb_webpush_push");
$webpush_firebase = get_option("pnfpb_webpush_push_firebase");	

$senderid = 0;

if ( is_user_logged_in() ) {
	$senderid = get_current_user_id();
}			

update_post_meta($schedule_post_id, "pnfpb_post_schedule", "");

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
	$table_name =
		$wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

	if (
		get_option("pnfpb_ic_fcm_loggedin_notify") &&
		get_option("pnfpb_ic_fcm_loggedin_notify") === "1"
	) {
		$deviceids = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > %d AND device_id NOT LIKE %s AND device_id NOT LIKE %s",
				$table_name,
				0,
				"%webview%",
				"%@N%"
			)
		);

		$deviceidswebview = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > %d AND device_id LIKE %s AND device_id NOT LIKE %s",
				$table_name,
				0,
				"%webview%",
				"%@N%"
			)
		);
	} else {
		$deviceids = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE %s",
				$table_name,
				"%webview%",
				"%@N%"
			)
		);

		$deviceidswebview = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id LIKE %s AND device_id NOT LIKE %s",
				$table_name,
				"%webview%",
				"%@N%"
			)
		);
	}

	$url = "https://fcm.googleapis.com/fcm/send";

	$regid = $deviceids;

	$activity_content_push = wp_strip_all_tags(
		urldecode(
			get_option(
				"pnfpb_ic_fcm_ondemand_schedule_pn_content" .
				$scheduled_day_push_notification
			)
		)
	);

	$imageurl = "";
	if (
		get_option(
			"pnfpb_ic_fcm_ondemand_schedule_pn_image" .
			$scheduled_day_push_notification
		)
	) {
		$imageurl = get_option(
			"pnfpb_ic_fcm_ondemand_schedule_pn_image" .
			$scheduled_day_push_notification
		);
	}

	$postlink = get_home_url();
	if (
		get_option(
			"pnfpb_ic_fcm_ondemand_schedule_pn_url" .
			$scheduled_day_push_notification
		)
	) {
		$postlink = get_option(
			"pnfpb_ic_fcm_ondemand_schedule_pn_url" .
			$scheduled_day_push_notification
		);
	}

	$notification_table_name =
		$wpdb->prefix . "pnfpb_ic_schedule_push_notifications";

	$notifications = $wpdb->get_results(
		"SELECT * FROM {$notification_table_name} WHERE `id` = {$notification_id} "
	);

	foreach ($notifications as $notification) {
		$onetime_push_title = $notification->title;
		$onetime_push_content = $notification->content;
		$onetime_push_imageurl = $notification->image_url;
		$onetime_push_clickurl = $notification->click_url;
		$onetime_push_time = gmdate(
			"Y/m/d H:i:s",
			$notification->scheduled_timestamp
		);
		$onetime_push_status = $notification->status;
	}

	if ($schedule_push_type === "post") {
		if (has_post_thumbnail($schedule_post_id)) {
			$onetime_push_imageurl = wp_get_attachment_url(
				get_post_thumbnail_id($schedule_post_id),
				"thumbnail"
			);

			update_option("pnfpb_ic_fcm_new_post_image", $imageurl);
		}
	}

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

			$PNFPB_WP_web_push_notification_class_obj = new PNFPB_web_push_notification_class();
			$PNFPB_WP_web_push_notification_class_obj->PNFPB_web_push_notification(
				0,
				stripslashes(
					wp_strip_all_tags($onetime_push_title)
				),
				stripslashes(
					wp_strip_all_tags($onetime_push_content)
				),
				$onetime_push_imageurl,
				$onetime_push_imageurl,
				$onetime_push_clickurl,
				["click_url" => $postlink],
				$target_subscription_array,
				$senderid,
				0,
				"ondemand"	
			);						
		}
	} else {	

		if (get_option("pnfpb_webtoapp_push") === "1") {
			$PNFPB_WP_webtoapp_notification_class_obj = new PNFPB_webtoapp_notification_class();
			$PNFPB_WP_webtoapp_notification_class_obj->PNFPB_webtoapp_notification(
				0,
				stripslashes(wp_strip_all_tags($onetime_push_title)),
				stripslashes(wp_strip_all_tags($onetime_push_content)),
				$onetime_push_clickurl,
				$onetime_push_imageurl
			);
		}

		if (get_option("pnfpb_progressier_push") === "1") {
			$PNFPB_WP_progressier_notification_class_obj = new PNFPB_progressier_notification_class();
			$PNFPB_WP_progressier_notification_class_obj->PNFPB_progressier_notification(
				0,
				stripslashes(wp_strip_all_tags($onetime_push_title)),
				stripslashes(wp_strip_all_tags($onetime_push_content)),
				$onetime_push_clickurl,
				$onetime_push_imageurl,
				$selected_user_ids
			);
		} else {
			if (get_option("pnfpb_onesignal_push") === "1") {
				$PNFPB_WP_onesignal_notification_class_obj = new PNFPB_onesignal_notification_class();
				$PNFPB_WP_onesignal_notification_class_obj->PNFPB_onesignal_notification(
					0,
					stripslashes(
						wp_strip_all_tags($onetime_push_title)
					),
					stripslashes(
						wp_strip_all_tags($onetime_push_content)
					),
					$onetime_push_clickurl,
					$onetime_push_imageurl,
					$selected_user_ids
				);
			} else {
				if (count($regid) > 0) {
					if (get_option("pnfpb_httpv1_push") === "1") {
						if (count($selected_user_ids) > 0) {
							$FB_httpv1_notification_class_obj = new PNFPB_firebase_httpv1_notification_class();
							$FB_httpv1_notification_class_obj->PNFPB_firebase_httpv1_notification(	
								0,
								stripslashes(
									wp_strip_all_tags($onetime_push_title)
								),
								stripslashes(
									wp_strip_all_tags($onetime_push_content)
								),
								$onetime_push_imageurl,
								$onetime_push_imageurl,
								$onetime_push_clickurl,
								["click_url" => $postlink],
								$selected_user_ids,
								[],
								$senderid,
								0,
								"ondemandselectedusers"
							);									
						} else {
							$FB_httpv1_notification_class_obj = new PNFPB_firebase_httpv1_notification_class();
							$FB_httpv1_notification_class_obj->PNFPB_firebase_httpv1_notification(	
								0,
								stripslashes(
									wp_strip_all_tags($onetime_push_title)
								),
								stripslashes(
									wp_strip_all_tags($onetime_push_content)
								),
								$onetime_push_imageurl,
								$onetime_push_imageurl,
								$onetime_push_clickurl,
								["click_url" => $postlink],
								$regid,
								[],
								$senderid,
								0,
								"ondemand"
							);
						}
					}
				}
			}
		}
	}
}

$table = $table =
	$wpdb->prefix . "pnfpb_ic_schedule_push_notifications";

if ($occurence === "recurring") {
	$recurring_status = $selected_recurring_status;

	try {
		$future_action_id = ActionScheduler::store()->query_action([
			"hook" =>
			"PNFPB_ondemand_schedule_push_notification_hook",
			"date" => $scheduled_day_push_notification,
			"date_compare" => "=",
			"status" => [
				ActionScheduler_Store::STATUS_RUNNING,
				ActionScheduler_Store::STATUS_PENDING,
			],
		]);

		if (!$future_action_id) {
			$datetime = new DateTime();
			$datetime->setTimestamp(
				$scheduled_day_push_notification
			);
			$datetime->setTimezone(
				new DateTimeZone(wp_timezone_string())
			);
			$recurring_status =
				esc_html(
				__(
					"Finished on ",
					"push-notification-for-post-and-buddypress"
				)
			) . $datetime->format("Y-m-d H:i:s");

			if ($schedule_push_type === "post") {
				update_post_meta(
					$schedule_post_id,
					"pnfpb_post_schedule",
					""
				);
			}
		} else {
			$action = ActionScheduler::store()->fetch_action(
				$future_action_id
			);
			$scheduled_date = $action->get_schedule()->get_date();
			$scheduled_date->setTimezone(
				new DateTimeZone(wp_timezone_string())
			);

			if ($scheduled_date) {
				$recurring_status =
					"<br/>" . $selected_recurring_status;

				if ($schedule_push_type === "post") {
					update_post_meta(
						$schedule_post_id,
						"pnfpb_post_schedule",
						$selected_recurring_status
					);
				}
			}
		}
	} catch (Exception $e) {
		/* for debugging purpose */
		/*error_log(serialize($e));*/
	}

	$datetime = new DateTime();
	$datetime->setTimestamp($scheduled_day_push_notification);
	$datetime->setTimezone(new DateTimeZone(wp_timezone_string()));
	$current_run_timestamp = strtotime(
		$datetime->format("Y-m-d H:i:s")
	);
	$onetime_push_update_status = $wpdb->query(
		$wpdb->prepare(
			"UPDATE %i SET scheduled_timestamp = %d,status = %s WHERE id = %d",
			$table,
			$current_run_timestamp,
			$notification_id
		)
	);
} else {
	$future_action_id = ActionScheduler::store()->query_action([
		"hook" => "PNFPB_ondemand_schedule_push_notification_hook",
		"date" => $scheduled_day_push_notification,
		"date_compare" => "=",
		"status" => [
			ActionScheduler_Store::STATUS_RUNNING,
			ActionScheduler_Store::STATUS_PENDING,
		],
	]);

	$datetime = new DateTime();
	$datetime->setTimestamp($scheduled_day_push_notification);
	$datetime->setTimezone(new DateTimeZone(wp_timezone_string()));
	$recurring_status =
		esc_html(
		__(
			"Finished on ",
			"push-notification-for-post-and-buddypress"
		)
	) . $datetime->format("Y/m/d H:i:s");
	$onetime_push_update_status = $wpdb->query(
		$wpdb->prepare(
			"UPDATE %i SET status = %s WHERE id = %d",
			$table,
			$recurring_status,
			$notification_id
		)
	);
	if ($schedule_push_type === "post") {
		update_post_meta(
			$schedule_post_id,
			"pnfpb_post_schedule",
			""
		);
	}
}

?>