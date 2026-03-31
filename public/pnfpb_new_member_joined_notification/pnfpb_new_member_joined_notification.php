<?php

/**
 * Triggered after new member joined in BuddyPress.
 * to send push notifications Opt in/out for the notification can be
 * controlled from plugin settings.
 *
 *
 * @param array   $raw_args		Message content array
 *
 *
 * @since 1.47
 */
if (!class_exists("PNFPB_new_member_joined_notification_class")) {
    class PNFPB_new_member_joined_notification_class
    {
        public function PNFPB_new_member_joined_notification(
			$pnfpb_user_id, $pnfpb_key, $pnfpb_user
		) {
			$pnfpb_apiaccesskey = get_option("pnfpb_ic_fcm_google_api");
			$pnfpb_deviceidswebview = [];
			$pnfpb_deviceids = [];
			
			$pnfpb_webpush_option = get_option("pnfpb_webpush_push");
			$pnfpb_webpush_firebase = get_option("pnfpb_webpush_push_firebase");	

			// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

			if (
				(get_option("pnfpb_ic_fcm_new_member_enable") == 1 &&
					get_option("pnfpb_progressier_push") !== "1" &&
					($pnfpb_apiaccesskey != "" && $pnfpb_apiaccesskey != false)) ||
				(get_option("pnfpb_ic_fcm_new_member_enable") == 1 &&
					(get_option("pnfpb_onesignal_push") === "1" ||
					 $pnfpb_webpush_option === '1' || 
					 $pnfpb_webpush_option === '2' || 
					 $pnfpb_webpush_firebase === '1' ||
					 get_option("pnfpb_httpv1_push") === "1"))
			) {
				global $wpdb;

				if (empty($pnfpb_user_id)) {
					return;
				}

				$pnfpb_member_name = bp_core_get_user_displayname($pnfpb_user_id);

				$pnfpb_table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

				$pnfpb_url = "https://fcm.googleapis.com/fcm/send";

				$pnfpb_activity_content_push =
					esc_html(
						__(
							"Welcome our new member ",
							"push-notification-for-post-and-buddypress"
						)
					) . $pnfpb_member_name;

				$pnfpb_notificationtitle =
					$pnfpb_member_name .
					esc_html(
						__(
							" registered as new member",
							"push-notification-for-post-and-buddypress"
						)
					);

				$pnfpb_titletext = get_option("pnfpb_ic_fcm_new_member_text");

				if ($pnfpb_titletext && $pnfpb_titletext !== "") {
					$pnfpb_notificationtitle = str_replace(
						"[member name]",
						$pnfpb_member_name,
						$pnfpb_titletext
					);
				}

				$pnfpb_imageurl = "";

				$pnfpb_iconurl = bp_core_fetch_avatar([
					"item_id" => $pnfpb_user_id, // output user id of post author
					"type" => "full",
					"html" => false, // FALSE = return url, TRUE (default) = return url wrapped with html
				]);

				$pnfpb_activity_content_push = str_replace(
					"[member name]",
					$pnfpb_member_name,
					$pnfpb_activity_content_push
				);

				if (
					get_option("pnfpb_ic_fcm_new_member_content") != false &&
					get_option("pnfpb_ic_fcm_new_member_content") != ""
				) {
					$pnfpb_activity_content_push = get_option("pnfpb_ic_fcm_new_member_content");
				}

				if (function_exists("bp_members_get_user_url")) {
					$pnfpb_messageurl = esc_url(
						bp_members_get_user_url($pnfpb_user_id) .
							bp_get_profile_slug()
					);
				} else {
					$pnfpb_messageurl = esc_url(
						bp_core_get_user_domain($pnfpb_user_id) .
							bp_get_profile_slug()
					);
				}

				$pnfpb_target_deviceid_values = [];
				$pnfpb_table_name = $wpdb->prefix . 'pnfpb_ic_subscribed_deviceids_web';
				
				if ($pnfpb_webpush_option === '1' || $pnfpb_webpush_option === '2' || $pnfpb_webpush_firebase === '1') {
					
					$pnfpb_target_deviceid_values = $wpdb->get_results(
						$wpdb->prepare(
							"SELECT * FROM %i WHERE device_id NOT LIKE %s AND web_auth <> %s AND web_256 <> %s AND subscription_auth_token <> %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
							$pnfpb_table_name,
							"%!!%",
							"","",""
						)
					);

					if (count($pnfpb_target_deviceid_values) > 0) {
						foreach ($pnfpb_target_deviceid_values as $pnfpb_target_deviceid_value) {
							$pnfpb_target_subscription_array[] =  [
								"endpoint" => $pnfpb_target_deviceid_value->web_auth,
								"keys" => [
									'p256dh' => $pnfpb_target_deviceid_value->web_256,
									'auth' => $pnfpb_target_deviceid_value->subscription_auth_token
								]
							];
						}
						
						$pnfpb_new_member_subscription_count = 0;

						if (get_option('pnfpb_newmemberjoined_subscription_count') !== false && 
							get_option('pnfpb_general_subscription_count') !== false &&
							(get_option('pnfpb_newmemberjoined_subscription_count') > 0 || get_option('pnfpb_general_subscription_count') > 0)) {
							$pnfpb_new_member_subscription_count = intval(get_option('pnfpb_newmemberjoined_subscription_count'))+intval(get_option('pnfpb_general_subscription_count'));
						}						

						$PNFPB_WP_web_push_notification_class_obj = new PNFPB_web_push_notification_class();
						$PNFPB_WP_web_push_notification_class_obj->PNFPB_web_push_notification(
							0,
							$pnfpb_notificationtitle,
							mb_substr(
								stripslashes(
									wp_strip_all_tags(trim($pnfpb_activity_content_push))
								),
								0,
								130,
								"UTF-8"
							),
							$pnfpb_iconurl,
							$pnfpb_iconurl,
							$pnfpb_messageurl,
							["click_url" => $pnfpb_messageurl],
							$pnfpb_target_subscription_array,
							$pnfpb_user_id,
							0,
							"newmemberjoined",
							"",
							0,
							$pnfpb_new_member_subscription_count
						);						
					}
				} else {				
					if (get_option("pnfpb_onesignal_push") === "1") {
						$pnfpb_target_userid_array = [];

						if (
							(get_option("pnfpb_ic_fcm_loggedin_notify") &&
								get_option("pnfpb_ic_fcm_loggedin_notify") === "1") ||
							get_option("pnfpb_ic_fcm_frontend_enable_subscription") === "1"
						) {
							$pnfpb_target_userid_array_values = $wpdb->get_col(
								$wpdb->prepare(
									"SELECT userid FROM %i WHERE device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,5,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
									$pnfpb_table_name,
									"%onesignal%"
								)
							);

							$pnfpb_target_userid_array = array_map(function ($pnfpb_value) {
								return $pnfpb_value == 1 ? "1pnfpbadm" : $pnfpb_value;
							}, $pnfpb_target_userid_array_values);
						}

						if (
							get_option("pnfpb_ic_fcm_buddypressoptions_schedule_now_enable") &&
							get_option("pnfpb_ic_fcm_buddypressoptions_schedule_now_enable") ===
								"1"
						) {
							$pnfpb_action_scheduler_status = as_schedule_single_action(
								time(),
								"PNFPB_onesignal_schedule_push_notification_hook",
								[
									$pnfpb_user_id,
									$pnfpb_notificationtitle,
									$pnfpb_activity_content_push,
									$pnfpb_messageurl,
									$pnfpb_iconurl,
									$pnfpb_target_userid_array,
								]
							);
						} else {
							$PNFPB_WP_onesignal_notification_class_obj = new PNFPB_onesignal_notification_class();
							$PNFPB_WP_onesignal_notification_class_obj->PNFPB_onesignal_notification(
								$pnfpb_user_id,
								$pnfpb_notificationtitle,
								$pnfpb_activity_content_push,
								$pnfpb_messageurl,
								$pnfpb_iconurl,
								$pnfpb_target_userid_array
							);
						}
					} else {
						if (get_option("pnfpb_httpv1_push") === "1") {
								$pnfpb_new_member_subscription_count = 0;

								if (get_option('pnfpb_newmemberjoined_subscription_count') !== false && 
									get_option('pnfpb_general_subscription_count') !== false &&
									(get_option('pnfpb_newmemberjoined_subscription_count') > 0 || get_option('pnfpb_general_subscription_count') > 0)) {
									$pnfpb_new_member_subscription_count = intval(get_option('pnfpb_newmemberjoined_subscription_count'))+intval(get_option('pnfpb_general_subscription_count'));
								}							
							if (
								get_option(
									"pnfpb_ic_fcm_buddypressoptions_schedule_now_enable"
								) &&
								get_option(
									"pnfpb_ic_fcm_buddypressoptions_schedule_now_enable"
								) === "1"
							) {
								$pnfpb_action_scheduler_status = as_schedule_single_action(
									time(),
									"PNFPB_httpv1_schedule_push_notification_hook",
									[
										0,
										$pnfpb_notificationtitle,
										mb_substr(
											stripslashes(
												wp_strip_all_tags(trim($pnfpb_activity_content_push))
											),
											0,
											130,
											"UTF-8"
										),
										$pnfpb_iconurl,
										$pnfpb_iconurl,
										$pnfpb_messageurl,
										["click_url" => $pnfpb_messageurl],
										[],
										[],
										$pnfpb_user_id,
										0,
										"newmemberjoined",
										"",
										0,
										$pnfpb_new_member_subscription_count
									]
								);
							} else {
								$pnfpb_httpv1_notification_class_obj = new PNFPB_firebase_httpv1_notification_class();
								$pnfpb_httpv1_notification_class_obj->PNFPB_firebase_httpv1_notification(							
									0,
									$pnfpb_notificationtitle,
									mb_substr(
										stripslashes(
											wp_strip_all_tags(trim($pnfpb_activity_content_push))
										),
										0,
										130,
										"UTF-8"
									),
									$pnfpb_iconurl,
									$pnfpb_iconurl,
									$pnfpb_messageurl,
									["click_url" => $pnfpb_messageurl],
									[],
									[],
									$pnfpb_user_id,
									0,
									"newmemberjoined",
									"",
									0,
									$pnfpb_new_member_subscription_count
								);
							}
						}

						do_action("PNFPB_connect_to_external_api_for_new_member");
					}
				}
			}
		}
	}
}

?>
