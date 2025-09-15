<?php

/*
 *
 * Push Notification for Group invitation sent
 *
 * @since 1.58
 */
if (!class_exists("PNFPB_group_invite_notification_class")) {
    class PNFPB_group_invite_notification_class
    {
        public function PNFPB_group_invite_notification(
            $group_id,
            $invited_users,
            $inviter_id
		) {
			global $wpdb;
			
			$apiaccesskey = get_option("pnfpb_ic_fcm_google_api");

			$deviceidswebview = [];

			$deviceids = [];

			// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

			$group_name = bp_get_group_name(groups_get_group($group_id));

			$group_image = bp_get_group_avatar_url(groups_get_group($group_id));

			if (function_exists("bp_get_group_url")) {
				$group_link = bp_get_group_url(groups_get_group($group_id));
			} else {
				$group_link = bp_get_group_permalink(groups_get_group($group_id));
			}
			
			$webpush_option = get_option("pnfpb_webpush_push");
			$webpush_firebase = get_option("pnfpb_webpush_push_firebase");					

			if (
				(get_option("pnfpb_ic_fcm_group_invitation_enable") == 1 &&
					get_option("pnfpb_progressier_push") !== "1" &&
					($apiaccesskey != "" && $apiaccesskey != false)) ||
				(get_option("pnfpb_ic_fcm_group_invitation_enable") == 1 &&
					(get_option("pnfpb_onesignal_push") === "1" ||
						get_option("pnfpb_httpv1_push") === "1" || 
					 $webpush_option === '1' || 
					 $webpush_option === '2' || 
					 $webpush_firebase === '1'))
			) {

				$sender_name = bp_core_get_user_displayname($inviter_id);

				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

				$url = "https://fcm.googleapis.com/fcm/send";

				$notificationcontent =
					$sender_name .
					esc_html(
						__(
							" invited you to join in group ",
							"push-notification-for-post-and-buddypress"
						)
					) .
					$group_name;

				$notificationtitle =
					esc_html(
						__(
							"Group invite to join in group ",
							"push-notification-for-post-and-buddypress"
						)
					) . $group_name;

				$titletext = get_option(
					"pnfpb_ic_fcm_buddypress_group_invitation_text_enable"
				);

				$deviceids = [];

				$deviceidswebview = [];

				if ($titletext && $titletext !== "") {
					$notificationtitle = str_replace(
						"[sender name]",
						$sender_name,
						$titletext
					);
					$notificationtitle = str_replace(
						"[group name]",
						$group_name,
						$notificationtitle
					);
				}

				$contenttext = get_option(
					"pnfpb_ic_fcm_buddypress_group_invitation_content_enable"
				);

				if ($contenttext && $contenttext !== "") {
					$notificationcontent = str_replace(
						"[sender name]",
						$sender_name,
						$contenttext
					);
					$notificationcontent = str_replace(
						"[group name]",
						$group_name,
						$contenttext
					);
				}

				$iconurl = get_option("pnfpb_ic_fcm_upload_icon");
				
				$target_deviceid_values = [];
				
				// Send an email to each recipient.
				foreach ($invited_users as $invited_user) {
					
					if ($webpush_option === '1' || $webpush_option === '2' || $webpush_firebase === '1') {
						
						$target_deviceid_values = $wpdb->get_results(
							$wpdb->prepare(
								"SELECT * FROM %i WHERE device_id NOT LIKE %s AND web_auth <> %s AND web_256 <> %s AND subscription_auth_token <> %s AND userid = %d AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,13,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
								$table_name,
								"%!!%",
								"","","",
								$invited_user
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
								stripslashes(wp_strip_all_tags($notificationcontent)),
								$group_image,
								$iconurl,
								$group_link,
								["click_url" => $group_link],
								$target_subscription_array,
								$inviter_id,
								$invited_user,
								"groupinvite"	
							);						
						}
					} else {						
						if (get_option("pnfpb_onesignal_push") === "1") {
							$target_userid_array = [];

							if (
								(get_option("pnfpb_ic_fcm_loggedin_notify") &&
									get_option("pnfpb_ic_fcm_loggedin_notify") === "1") ||
								get_option("pnfpb_ic_fcm_frontend_enable_subscription") === "1"
							) {
								$target_userid_array_values = $wpdb->get_col(
									$wpdb->prepare(
										"SELECT userid FROM %i WHERE device_id LIKE %s AND userid = %d AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,13,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
										$table_name,
										"%onesignal%",
										$invited_user
									)
								);

								$target_userid_array = array_map(function ($value) {
									return $value == 1 ? "1pnfpbadm" : $value;
								}, $target_userid_array_values);
							}

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
										$group_id,
										$notificationtitle,
										$notificationcontent,
										$group_link,
										$group_image,
										$target_userid_array,
									]
								);
							} else {
								$PNFPB_WP_onesignal_notification_class_obj = new PNFPB_onesignal_notification_class();
								$PNFPB_WP_onesignal_notification_class_obj->PNFPB_onesignal_notification(
									$group_id,
									$notificationtitle,
									$notificationcontent,
									$group_link,
									$group_image,
									$target_userid_array
								);
							}
						} else {
							$imageurl = "";

							$iconurl = bp_core_fetch_avatar([
								"item_id" => $invited_user, // output user id of post author
								"type" => "full",
								"html" => false, // FALSE = return url, TRUE (default) = return url wrapped with html
							]);

							if (get_option("pnfpb_httpv1_push") === "1") {

								$deviceids = $wpdb->get_col(
										$wpdb->prepare(
											"SELECT DISTINCT(SUBSTRING_INDEX(device_id, '!!', 1)) FROM %i WHERE device_id NOT LIKE %s AND userid = %d AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,13,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) ORDER BY id DESC LIMIT 1000",
											$table_name,
											"%@N%",
											$invited_user
										)
									);				

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
											stripslashes(
												wp_strip_all_tags($notificationcontent)
											),
											$group_image,
											$iconurl,
											$group_link,
											["click_url" => $group_link],
											$deviceids,
											[],
											$inviter_id,
											$invited_user,
											"groupinvite",
										]
									);
								} else {
									$FB_httpv1_notification_class_obj = new PNFPB_firebase_httpv1_notification_class();
									$FB_httpv1_notification_class_obj->PNFPB_firebase_httpv1_notification(								
										0,
										$notificationtitle,
										stripslashes(wp_strip_all_tags($notificationcontent)),
										$group_image,
										$iconurl,
										$group_link,
										["click_url" => $group_link],
										$deviceids,
										[],
										$inviter_id,
										$invited_user,
										"groupinvite"
									);
								}
							}

							do_action(
								"PNFPB_connect_to_external_api_for_group_invitation_notification"
							);
						}
					}
				}
			}
		}
	}
}

?>
