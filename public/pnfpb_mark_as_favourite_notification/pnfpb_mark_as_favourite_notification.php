<?php

/**
 * Triggered after user marked as favourite or like on activity in BuddyPress.
 * To send push notifications Opt in/out for the notifications which can be
 * controlled from plugin settings.
 *
 *
 * @param array   $raw_args		Message content array
 *
 *
 * @since 2.14
 */
if (!class_exists("PNFPB_mark_as_favourite_notification_class")) {
    class PNFPB_mark_as_favourite_notification_class
    {
        public function PNFPB_mark_as_favourite_notification(
           $activity_id,
           $user_id
		) {
			$apiaccesskey = get_option("pnfpb_ic_fcm_google_api");
			
			$webpush_option = get_option("pnfpb_webpush_push");
			$webpush_firebase = get_option("pnfpb_webpush_push_firebase");				

			// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

			if (
				(get_option("pnfpb_ic_fcm_mark_favourite_enable") == 1 &&
					($apiaccesskey != "" && $apiaccesskey != false)) ||
				(get_option("pnfpb_ic_fcm_mark_favourite_enable") == 1 &&
					(get_option("pnfpb_onesignal_push") === "1" ||
						get_option("pnfpb_httpv1_push") === "1" ||
						get_option("pnfpb_progressier_push") === "1" ||
					 	$webpush_option === '1' || 
					 	$webpush_option === '2' || 
					 	$webpush_firebase === '1' ||
						get_option("pnfpb_webtoapp_push") === "1"))
			) {
				global $wpdb;

				//$initiator_name = bp_core_get_user_displayname($initiator_id);
				$authoractivityuserid = 0;

				$table_name_activity = $wpdb->prefix . "bp_activity";

				$activity_details = $wpdb->get_results(
							$wpdb->prepare(
								"SELECT user_id, content, item_id, id, date_recorded FROM %i WHERE id = %d ORDER BY date_recorded DESC LIMIT 1",
								$table_name_activity,
								$activity_id
							)
				 );

				foreach ($activity_details as $activity_detail) {
				   $authoractivityuserid = $activity_detail->user_id;
				}

				$activitylink = '';

				if ($activity_id) {
					$activitylink = bp_activity_get_permalink($activity_id);
				}

				$user_name = bp_core_get_user_displayname($user_id);

				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

				$url = "https://fcm.googleapis.com/fcm/send";

				$activity_content_push =
					$user_name .
					esc_html(
						__(
							" marked your activity as favourite/liked your activity",
							"push-notification-for-post-and-buddypress"
						)
					);

				$notificationtitle =
					"[username]" .
					esc_html(
						__(
							" marked your activity as favourite/liked your activity",
							"push-notification-for-post-and-buddypress"
						)
					);

				$titletext = get_option("pnfpb_ic_fcm_buddypress_mark_favourite_text_enable");

				if ($titletext && $titletext !== "") {
					$notificationtitle = str_replace(
						"[username]",
						$user_name,
						$titletext
					);
				} else {
					if ($notificationtitle !== '') {
						$notificationtitle = str_replace(
							"[username]",
							$user_name,
							$notificationtitle
						);			
					}
				} 

				$activity_content_push = str_replace(
					"[username]",
					$user_name,
					$activity_content_push
				);

				$contenttext = get_option("pnfpb_ic_fcm_buddypress_mark_favourite_content_enable");

				if ($contenttext && $contenttext != '') {
					$activity_content_push = str_replace(
						"[username]",
						$user_name,
						$contenttext
					);		
				}

				$imageurl = "";

				$iconurl = bp_core_fetch_avatar([
					"item_id" => $user_id, // output user id of post author
					"type" => "full",
					"html" => false, // FALSE = return url, TRUE (default) = return url wrapped with html
				]);
				
				$pushtype = "markasfavourite";
				
				if ($webpush_option === '1' || $webpush_option === '2' || $webpush_firebase === '1') {
					
					$target_deviceid_values = $wpdb->get_results(
						$wpdb->prepare(
							"SELECT * FROM %i WHERE userid = %d AND device_id NOT LIKE %s AND web_auth <> %s AND web_256 <> %s AND subscription_auth_token <> %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,25,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
							$table_name,
							$authoractivityuserid,
							"%!!%", /* eliminate group subscription device ids */
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
							$notificationtitle,
							mb_substr(
								stripslashes(
									wp_strip_all_tags(
										trim($activity_content_push)
									)
								),
								0,
								130,
								"UTF-8"
							),
							$iconurl,
							$iconurl,
							$activitylink,
							["click_url" => $activitylink],
							$target_subscription_array,
							$user_id,
							$authoractivityuserid,
							$pushtype	
						);						
					}
				} else {			
					if (get_option("pnfpb_progressier_push") === "1") {
						$target_userid = $authoractivityuserid;

						$target_userid_array_values = $wpdb->get_col(
							$wpdb->prepare(
								"SELECT device_id FROM %i WHERE userid = %d AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,15,1) = '1' OR SUBSTRING(subscription_option,25,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
								$table_name,
								$authoractivityuserid,
								"%progressier%"
							)
						);

						if (count($target_userid_array_values) > 0) {
							if (
								get_option(
									"pnfpb_ic_fcm_buddypressoptions_schedule_now_enable"
								) &&
								get_option(
									"pnfpb_ic_fcm_buddypressoptions_schedule_now_enable"
								) === "1"
							) {
								$action_scheduler_status = as_schedule_single_action(
									time(),
									"PNFPB_progressier_schedule_push_notification_hook",
									[
										0,
										$notificationtitle,
										$activity_content_push,
										$activitylink,
										$iconurl,
										$target_userid_array_values[0],
										$pushtype,
									]
								);
							} else {
								$PNFPB_WP_progressier_notification_class_obj = new PNFPB_progressier_notification_class();
								$PNFPB_WP_progressier_notification_class_obj->PNFPB_progressier_notification(
									0,
									$notificationtitle,
									$activity_content_push,
									$activitylink,
									$iconurl,
									$target_userid_array_values[0],
									$pushtype
								);
							}
						}
					}

					if (get_option("pnfpb_webtoapp_push") === "1") {
						$target_userid = $authoractivityuserid;

						$target_userid_array_values = $wpdb->get_col(
							$wpdb->prepare(
								"SELECT device_id FROM %i WHERE userid = %d AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,15,1) = '1' OR SUBSTRING(subscription_option,25,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
								$table_name,
								$authoractivityuserid
							)
						);

						if (count($target_userid_array_values) > 0) {
							if (
								get_option(
									"pnfpb_ic_fcm_buddypressoptions_schedule_now_enable"
								) &&
								get_option(
									"pnfpb_ic_fcm_buddypressoptions_schedule_now_enable"
								) === "1"
							) {
								$action_scheduler_status = as_schedule_single_action(
									time(),
									"PNFPB_webtoapp_schedule_push_notification_hook",
									[
										0,
										$notificationtitle,
										$activity_content_push,
										$activitylink,
										$iconurl,
										$target_userid_array_values,
										$pushtype,
									]
								);
							} else {
								$PNFPB_WP_webtoapp_notification_class_obj = new PNFPB_webtoapp_notification_class();
								$PNFPB_WP_webtoapp_notification_class_obj->PNFPB_webtoapp_notification(
									0,
									$notificationtitle,
									$activity_content_push,
									$activitylink,
									$iconurl,
									$target_userid_array_values,
									$pushtype
								);
							}
						}
					}

					if (
						get_option("pnfpb_onesignal_push") === "1" &&
						get_option("pnfpb_progressier_push") !== "1"
					) {
						$target_userid_array = [];

						if (get_option("pnfpb_ic_fcm_frontend_enable_subscription") === "1") {
							$target_userid_array_values = $wpdb->get_col(
								$wpdb->prepare(
									"SELECT userid FROM %i WHERE userid = %d AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,15,1) = '1' OR SUBSTRING(subscription_option,25,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
									$table_name,
									$authoractivityuserid,
									"%onesignal%"
								)
							);
						} else {
							$target_userid_array_values = ["$authoractivityuserid"];
						}

						if (count($target_userid_array_values) > 0) {
							$target_userid_array = array_map(function ($value) {
								return $value == 1 ? "1pnfpbadm" : $value;
							}, $target_userid_array_values);

							if (
								get_option(
									"pnfpb_ic_fcm_buddypressoptions_schedule_now_enable"
								) &&
								get_option(
									"pnfpb_ic_fcm_buddypressoptions_schedule_now_enable"
								) === "1"
							) {
								$action_scheduler_status = as_schedule_single_action(
									time(),
									"PNFPB_onesignal_schedule_push_notification_hook",
									[
										$user_id,
										$notificationtitle,
										$activity_content_push,
										$activitylink,
										$iconurl,
										$target_userid_array,
									]
								);
							} else {
								$PNFPB_WP_onesignal_notification_class_obj = new PNFPB_onesignal_notification_class();
								$PNFPB_WP_onesignal_notification_class_obj->PNFPB_onesignal_notification(
									$user_id,
									$notificationtitle,
									$activity_content_push,
									$activitylink,
									$iconurl,
									$target_userid_array
								);
							}
						}
					} else {
						if (get_option("pnfpb_progressier_push") !== "1") {

							$deviceids = $wpdb->get_col(
									$wpdb->prepare(
										"SELECT DISTINCT(SUBSTRING_INDEX(device_id, '!!', 1)) FROM %i WHERE device_id NOT LIKE %s AND userid = %d AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,15,1) = '1' OR SUBSTRING(subscription_option,25,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) ORDER BY id DESC LIMIT 1000",
										$table_name,
										"%@N%",
										$authoractivityuserid
									)
								);

							$webview = false;

							if (count($deviceids) > 0) {
								$regid = $deviceids;

								if (
									get_option("pnfpb_ic_fcm_mark_favourite_text") !=
										false &&
									get_option("pnfpb_ic_fcm_mark_favourite_text") != ""
								) {
									$activity_content_push = get_option(
										"pnfpb_ic_fcm_mark_favourite_text"
									);
								}

								if (get_option("pnfpb_httpv1_push") === "1") {
									if (
										get_option(
											"pnfpb_ic_fcm_buddypressoptions_schedule_now_enable"
										) &&
										get_option(
											"pnfpb_ic_fcm_buddypressoptions_schedule_now_enable"
										) === "1"
									) {
										$action_scheduler_status = as_schedule_single_action(
											time(),
											"PNFPB_httpv1_schedule_push_notification_hook",
											[
												0,
												$notificationtitle,
												mb_substr(
													stripslashes(
														wp_strip_all_tags(
															trim($activity_content_push)
														)
													),
													0,
													130,
													"UTF-8"
												),
												$iconurl,
												$iconurl,
												$activitylink,
												["click_url" => $activitylink],
												$deviceids,
												[],
												$user_id,
												$authoractivityuserid,
												$pushtype,
											]
										);
									} else {
										$FB_httpv1_notification_class_obj = new PNFPB_firebase_httpv1_notification_class();
										$FB_httpv1_notification_class_obj->PNFPB_firebase_httpv1_notification(									
											0,
											$notificationtitle,
											mb_substr(
												stripslashes(
													wp_strip_all_tags(
														trim($activity_content_push)
													)
												),
												0,
												130,
												"UTF-8"
											),
											$iconurl,
											$iconurl,
											$activitylink,
											["click_url" => $activitylink],
											$deviceids,
											[],
											$user_id,
											$authoractivityuserid,
											$pushtype
										);
									}
								}

								do_action(
									"PNFPB_connect_to_external_api_for_friend_request_accepted"
								);
							}
						}
					}
				}
			}
		}
	}
}

?>