<?php

/**
 * Triggered after avatar change sent for user in BuddyPress.
 * to send push notifications Opt in/out for the notification can be
 * controlled from plugin settings.
 *
 *
 * @param array   $raw_args		Message content array
 *
 *
 * @since 1.47
 */
if (!class_exists("PNFPB_avatar_change_notification_class")) {
    class PNFPB_avatar_change_notification_class
    {
        public function PNFPB_avatar_change_notification(
			$user_id = 0
		) {

			$apiaccesskey = get_option("pnfpb_ic_fcm_google_api");
			$webpush_option = get_option("pnfpb_webpush_push");
			$webpush_firebase = get_option("pnfpb_webpush_push_firebase");				

			if (
				(get_option("pnfpb_ic_fcm_avatar_change_enable") == 1 &&
					get_option("pnfpb_progressier_push") !== "1" &&
					($apiaccesskey != "" && $apiaccesskey != false)) ||
				(get_option("pnfpb_ic_fcm_avatar_change_enable") == 1 &&
					(get_option("pnfpb_onesignal_push") === "1" ||
					 $webpush_option === '1' || 
					 $webpush_option === '2' || 
					 $webpush_firebase === '1' || 
					 get_option("pnfpb_httpv1_push") === "1"))
			) {
				global $wpdb;

				// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

				$deviceidswebview = [];

				$deviceids = [];
				
				$webpush_option = get_option("pnfpb_webpush_push");
				$webpush_firebase = get_option("pnfpb_webpush_push_firebase");			
				$target_deviceid_values = [];				

				$member_name = bp_core_get_user_displayname($user_id);

				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

				$url = "https://fcm.googleapis.com/fcm/send";

				$activity_content_push = "";

				$notificationtitle =
					$member_name .
					esc_html(
						__(" updated avatar", "push-notification-for-post-and-buddypress")
					);

				$titletext = get_option("pnfpb_ic_fcm_avatar_change_text");

				if ($titletext && $titletext !== "") {
					$notificationtitle = str_replace(
						"[member name]",
						$member_name,
						$titletext
					);
				}
				
				$activity_content_push =
					$member_name .
					esc_html(
						__(
							" updated profile avatar",
							"push-notification-for-post-and-buddypress"
						)
					);				
				
				$contenttext = get_option("pnfpb_ic_fcm_avatar_change_content");

				if ($contenttext && $contenttext != '') {
					$activity_content_push = str_replace(
						"[member name]",
						$user_name,
						$contenttext
					);		
				}				

				if (function_exists("bp_members_get_user_url")) {
					$messageurl = esc_url(bp_members_get_user_url($user_id));
				} else {
					$messageurl = esc_url(bp_core_get_user_domain($user_id));
				}

				$imageurl = "";

				$iconurl = bp_core_fetch_avatar([
					"item_id" => $user_id, // output user id of post author
					"type" => "full",
					"html" => false, // FALSE = return url, TRUE (default) = return url wrapped with html
				]);
				
				if ($webpush_option === '1' || $webpush_option === '2' || $webpush_firebase === '1') {
					
					$target_deviceid_values = $wpdb->get_results(
						$wpdb->prepare(
							"SELECT * FROM %i WHERE device_id NOT LIKE %s AND web_auth <> %s AND web_256 <> %s AND subscription_auth_token <> %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,9,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
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
							$notificationtitle,
							mb_substr(
								stripslashes(
									wp_strip_all_tags(trim($activity_content_push))
								),
								0,
								130,
								"UTF-8"
							),
							$iconurl,
							$imageurl,
							$messageurl,
							["click_url" => $messageurl],
							$target_subscription_array,
							0,
							0,
							"avatarchange"
						);						
					}
					
				} else {

					if (get_option("pnfpb_onesignal_push") === "1") {
						$target_userid_array = [];

						$target_userid_array_values = $wpdb->get_col(
							$wpdb->prepare(
								"SELECT userid FROM %i WHERE device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,9,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
								$table_name,
								"%onesignal%"
							)
						);

						$target_userid_array = array_map(function ($value) {
							return $value == 1 ? "1pnfpbadm" : $value;
						}, $target_userid_array_values);

						if (
							get_option("pnfpb_ic_fcm_buddypressoptions_schedule_now_enable") &&
							get_option("pnfpb_ic_fcm_buddypressoptions_schedule_now_enable") ===
								"1"
						) {
							$action_scheduler_status = as_schedule_single_action(
								time(),
								"PNFPB_onesignal_schedule_push_notification_hook",
								[
									$user_id,
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
								$user_id,
								$notificationtitle,
								$activity_content_push,
								$messageurl,
								$iconurl,
								$target_userid_array
							);
						}
					} else {
						if (
							get_option("pnfpb_ic_fcm_avatar_change_content") != false &&
							get_option("pnfpb_ic_fcm_avatar_change_content") != ""
						) {
							$activity_content_push = get_option(
								"pnfpb_ic_fcm_avatar_change_content"
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
												wp_strip_all_tags(trim($activity_content_push))
											),
											0,
											130,
											"UTF-8"
										),
										$iconurl,
										$imageurl,
										$messageurl,
										["click_url" => $messageurl],
										[],
										[],
										$user_id,
										0,
										"avatarchange",
									]
								);
							} else {
								$FB_httpv1_notification_class_obj = new PNFPB_firebase_httpv1_notification_class();
								$FB_httpv1_notification_class_obj->PNFPB_firebase_httpv1_notification(							
									0,
									$notificationtitle,
									mb_substr(
										stripslashes(
											wp_strip_all_tags(trim($activity_content_push))
										),
										0,
										130,
										"UTF-8"
									),
									$iconurl,
									$imageurl,
									$messageurl,
									["click_url" => $messageurl],
									[],
									[],
									$user_id,
									0,
									"avatarchange"
								);
							}
						}

						do_action("PNFPB_connect_to_external_api_for_avatar_change");
					}
				}
			}
		}
	}
}

?>
