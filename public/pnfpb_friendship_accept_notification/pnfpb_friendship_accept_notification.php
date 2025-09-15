<?php

/**
 * Triggered after friendship accepted sent for user in BuddyPress.
 * to send push notifications Opt in/out for the notification can be
 * controlled from plugin settings.
 *
 *
 * @param array   $raw_args		Message content array
 *
 *
 * @since 1.47
 */
if (!class_exists("PNFPB_friendship_accept_notification_class")) {
    class PNFPB_friendship_accept_notification_class
    {
        public function PNFPB_friendship_accept_notification(
			$friendship_id,
            $initiator_id,
            $friend_id
		) {
			$apiaccesskey = get_option("pnfpb_ic_fcm_google_api");
			
			$webpush_option = get_option("pnfpb_webpush_push");
			$webpush_firebase = get_option("pnfpb_webpush_push_firebase");				

			// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

			if (
				(get_option("pnfpb_ic_fcm_friendship_accept_enable") == 1 &&
					($apiaccesskey != "" && $apiaccesskey != false)) ||
				(get_option("pnfpb_ic_fcm_friendship_accept_enable") == 1 &&
					(get_option("pnfpb_onesignal_push") === "1" ||
						get_option("pnfpb_httpv1_push") === "1" ||
						get_option("pnfpb_progressier_push") === "1" ||
						$webpush_option === '1' || 
					 	$webpush_option === '2' || 
					 	$webpush_firebase === '1' ||			 
						get_option("pnfpb_webtoapp_push") === "1"))
			) {
				global $wpdb;

				$friendship_initiator_name = bp_core_get_user_displayname($initiator_id);

				$friend_name = bp_core_get_user_displayname($friend_id);

				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

				$url = "https://fcm.googleapis.com/fcm/send";

				$activity_content_push =
					$friend_name .
					esc_html(
						__(
							" accepted your friendship request",
							"push-notification-for-post-and-buddypress"
						)
					);

				$notificationtitle =
					"[friendship acceptor name]" .
					esc_html(
						__(
							" accepted your friendship request",
							"push-notification-for-post-and-buddypress"
						)
					);

					$notificationtitle = str_replace(
						"[friendship acceptor name]",
						$friend_name,
						$notificationtitle
					);	

				$titletext = get_option("pnfpb_ic_fcm_friendship_accept_text");

				if ($titletext && $titletext !== "") {
					$notificationtitle = str_replace(
						"[friendship acceptor name]",
						$friend_name,
						$titletext
					);
				}

				$activity_content_push = str_replace(
					"[friendship acceptor name]",
					$friend_name,
					$activity_content_push
				);

				$contenttext = get_option("pnfpb_ic_fcm_friendship_accept_text");

				if ($contenttext && $contenttext !== "") {
					$activity_content_push = str_replace(
						"[friendship acceptor name]",
						$friend_name,
						$contenttext
					);
				}	

				if (function_exists("bp_members_get_user_url")) {
					$messageurl = esc_url(
						bp_members_get_user_url($friend_id) .
							bp_get_friends_slug() .
							"/requests/"
					);
				} else {
					$messageurl = esc_url(
						bp_core_get_user_domain($friend_id) .
							bp_get_friends_slug() .
							"/requests/"
					);
				}

				$imageurl = "";

				$iconurl = bp_core_fetch_avatar([
					"item_id" => $friend_id, // output user id of post author
					"type" => "full",
					"html" => false, // FALSE = return url, TRUE (default) = return url wrapped with html
				]);
				
				$pushtype = "friendshipaccepted";
				
		
				$target_deviceid_values = [];					
				
				if ($webpush_option === '1' || $webpush_option === '2' || $webpush_firebase === '1') {

					$target_deviceid_values = $wpdb->get_results(
						$wpdb->prepare(
							"SELECT * FROM %i WHERE device_id NOT LIKE %s AND web_auth <> %s AND web_256 <> %s AND subscription_auth_token <> %s AND userid = %d AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,8,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
							$table_name,
							"%!!%",
							"","","",$initiator_id,
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
							$messageurl,
							["click_url" => $messageurl],
							$target_subscription_array,
							$initiator_id,
							$friend_id,
							$pushtype	
						);						
					}
				} else {				

					if (get_option("pnfpb_progressier_push") === "1") {
						$target_userid = $initiator_id;

						$target_userid_array_values = $wpdb->get_col(
							$wpdb->prepare(
								"SELECT device_id FROM %i WHERE userid = %d AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,8,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
								$table_name,
								$initiator_id,
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
										$messageurl,
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
									$messageurl,
									$iconurl,
									$target_userid_array_values[0],
									$pushtype
								);
							}
						}
					}

					if (get_option("pnfpb_webtoapp_push") === "1") {
						$target_userid = $initiator_id;

						$target_userid_array_values = $wpdb->get_col(
							$wpdb->prepare(
								"SELECT device_id FROM %i WHERE userid = %d AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,8,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
								$table_name,
								$initiator_id
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
										$messageurl,
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
									$messageurl,
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
									"SELECT userid FROM %i WHERE userid = %d AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,8,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
									$table_name,
									$initiator_id,
									"%onesignal%"
								)
							);
						} else {
							$target_userid_array_values = ["$initiator_id"];
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
										$friend_id,
										$notificationtitle,
										$activity_content_push,
										$messageurl,
										$iconurl,
										$target_userid_array,
									]
								);
							} else {
								$PNFPB_WP_onesignal_notification_class_obj = new PNFPB_onesignal_notification_class();
								$PNFPB_WP_onesignal_notification_class_obj->PNFPB_onesignal_notification(
									$friend_id,
									$notificationtitle,
									$activity_content_push,
									$messageurl,
									$iconurl,
									$target_userid_array
								);
							}
						}
					} else {
						if (get_option("pnfpb_progressier_push") !== "1") {

							$deviceids = $wpdb->get_col(
									$wpdb->prepare(
										"SELECT DISTINCT(SUBSTRING_INDEX(device_id, '!!', 1)) FROM %i WHERE device_id NOT LIKE %s AND userid = %d AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,8,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) ORDER BY id DESC LIMIT 1000",
										$table_name,
										"%@N%",
										$initiator_id
									)
								);

							$webview = false;

							if (count($deviceids) > 0) {
								$regid = $deviceids;

								if (
									get_option("pnfpb_ic_fcm_friendship_accept_content") !=
										false &&
									get_option("pnfpb_ic_fcm_friendship_accept_content") != ""
								) {
									$activity_content_push = get_option(
										"pnfpb_ic_fcm_friendship_accept_content"
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
												$messageurl,
												["click_url" => $messageurl],
												$deviceids,
												[],
												$friend_id,
												$initiator_id,
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
											$messageurl,
											["click_url" => $messageurl],
											$deviceids,
											[],
											$friend_id,
											$initiator_id,
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
