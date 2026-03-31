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
if (!class_exists("PNFPB_buddypress_follow_notification_class")) {
    class PNFPB_buddypress_follow_notification_class
    {
        public function PNFPB_buddypress_follow_notification(
           $pnfpb_buddypress_follow_array
		) {
			//wp_cache_set( "{$this->leader_id}:{$this->follower_id}:{$this->follow_type}", $data, 'bp_follow_data' );
			$pnfpb_apiaccesskey = get_option("pnfpb_ic_fcm_google_api");
			$pnfpb_webpush_option = get_option("pnfpb_webpush_push");
			$pnfpb_webpush_firebase = get_option("pnfpb_webpush_push_firebase");				

			// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

			if (
				(get_option("pnfpb_ic_fcm_bprivatemessage_enable") == 1 &&
					($pnfpb_apiaccesskey != "" && $pnfpb_apiaccesskey != false)) ||
				(get_option("pnfpb_ic_fcm_buddypress_follow_enable") == 1 &&
					(get_option("pnfpb_onesignal_push") === "1" ||
						get_option("pnfpb_httpv1_push") === "1" ||
						get_option("pnfpb_progressier_push") === "1" ||
					 	$pnfpb_webpush_option === '1' || 
					 	$pnfpb_webpush_option === '2' || 
					 	$pnfpb_webpush_firebase === '1' ||
						get_option("pnfpb_webtoapp_push") === "1"))
			) {
				global $wpdb;

				if (is_object($pnfpb_buddypress_follow_array)) {
					$pnfpb_args = (array) $pnfpb_buddypress_follow_array;
				} else {
					$pnfpb_args = $pnfpb_buddypress_follow_array;
				}

				if (empty($pnfpb_args) || !isset($pnfpb_args['leader_id'])
					|| !isset($pnfpb_args['follower_id'])
				   ) {
					return;
				}
				
				// These should be extracted below.
				$pnfpb_leader_id = 0;
				$pnfpb_follower_id = 0;
				$pnfpb_follower_type = '';
				
				if (isset($pnfpb_args['leader_id'])) {
					$pnfpb_leader_id = $pnfpb_args['leader_id'];
				}

				if (isset($pnfpb_args['follower_id'])) {
					$pnfpb_follower_id = $pnfpb_args['follower_id'];
				}
				
				if (isset($pnfpb_args['follower_type'])) {
					$pnfpb_follower_type = $pnfpb_args['follower_type'];
				}
					
				
				$pnfpb_follower_name = "";

				$pnfpb_follower_name = bp_core_get_user_displayname($pnfpb_follower_id );
				
				$pnfpb_leader_name = "";
				
				$pnfpb_leader_name = bp_core_get_user_displayname($pnfpb_leader_id );

				$pnfpb_message = $pnfpb_follower_name." Followed you";

				$pnfpb_table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

				$pnfpb_url = "https://fcm.googleapis.com/fcm/send";

				$pnfpb_activity_content_push = $pnfpb_message;

				$pnfpb_notificationtitle =
					$pnfpb_follower_name .
					esc_html(
					__(
						" New follower",
						"push-notification-for-post-and-buddypress"
					)
				);

				$pnfpb_notificationtitle = str_replace(
					"[follower name]",
					$pnfpb_follower_name,
					$pnfpb_notificationtitle
				);		

				$pnfpb_titletext = get_option("pnfpb_ic_fcm_bfollowermessage_text");

				if ($pnfpb_titletext && $pnfpb_titletext !== "") {
					$pnfpb_notificationtitle = str_replace(
						"[follower name]",
						$pnfpb_follower_name,
						$pnfpb_titletext
					);
				}

				$pnfpb_activity_content_push = str_replace(
					"[follower name]",
					$pnfpb_follower_name,
					$pnfpb_activity_content_push
				);

				$pnfpb_contenttext = get_option("pnfpb_ic_fcm_bfollowermessage_content");

				if ($pnfpb_contenttext && $pnfpb_contenttext !== "") {
					$pnfpb_activity_content_push = str_replace(
						"[follower name]",
						$pnfpb_follower_name,
						$pnfpb_contenttext
					);
				}		

				$pnfpb_iconurl = get_option("pnfpb_ic_fcm_upload_icon");

				if (function_exists("bp_members_get_user_url")) {
					$pnfpb_messageurl = esc_url(
						bp_members_get_user_url($pnfpb_follower_id) .
						bp_get_messages_slug() .
						"/view/" 
					);
				} else {
					$pnfpb_messageurl = esc_url(
						bp_core_get_user_domain($pnfpb_follower_id) .
						bp_get_messages_slug() .
						"/view/" 
					);
				}

				$pnfpb_imageurl = "";

				$pnfpb_iconurl = bp_core_fetch_avatar([
					"item_id" => $pnfpb_leader_id, // output user id of post author
					"type" => "full",
					"html" => false, // FALSE = return url, TRUE (default) = return url wrapped with html
				]);

				$pnfpb_pushtype = "bpfollower";

				$pnfpb_target_deviceid_values = [];						

				if ($pnfpb_webpush_option === '1' || $pnfpb_webpush_option === '2' || $pnfpb_webpush_firebase === '1') {

					$pnfpb_target_deviceid_values = $wpdb->get_results(
						$wpdb->prepare(
							"SELECT * FROM %i WHERE device_id NOT LIKE %s AND userid = %d AND web_auth <> %s AND web_256 <> %s AND subscription_auth_token <> %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,26,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) ORDER BY id DESC LIMIT 50",
							$pnfpb_table_name,
							"%!!%",
							$pnfpb_leader_id,
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

						$PNFPB_WP_web_push_notification_class_obj = new PNFPB_web_push_notification_class();
						$PNFPB_WP_web_push_notification_class_obj->PNFPB_web_push_notification(
							0,
							$pnfpb_notificationtitle,
							mb_substr(
								stripslashes(
									wp_strip_all_tags(
										trim($pnfpb_activity_content_push)
									)
								),
								0,
								130,
								"UTF-8"
							),
							$pnfpb_iconurl,
							$pnfpb_iconurl,
							$pnfpb_messageurl,
							[
								"receipient_id" => strval($pnfpb_leader_id),
								"click_url" => $pnfpb_messageurl,
							],
							$pnfpb_target_subscription_array,
							$pnfpb_follower_id,
							$pnfpb_leader_id,
							$pnfpb_pushtype	
						);						
					}
				} else {			
					if (get_option("pnfpb_progressier_push") === "1") {
						$pnfpb_target_userid = $pnfpb_leader_id;

						$pnfpb_target_userid_array_values = $wpdb->get_col(
							$wpdb->prepare(
								"SELECT device_id FROM %i WHERE userid = %d AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,26,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) ORDER BY id DESC LIMIT 50",
								$pnfpb_table_name,
								$pnfpb_leader_id,
								"%progressier%"
							)
						);

						if (count($pnfpb_target_userid_array_values) > 0) {
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
									"PNFPB_progressier_schedule_push_notification_hook",
									[
										0,
										$pnfpb_notificationtitle,
										$pnfpb_activity_content_push,
										$pnfpb_messageurl,
										$pnfpb_iconurl,
										$pnfpb_target_userid_array_values[0],
										$pnfpb_pushtype,
									]
								);
							} else {
								$PNFPB_WP_progressier_notification_class_obj = new PNFPB_progressier_notification_class();
								$PNFPB_WP_progressier_notification_class_obj->PNFPB_progressier_notification(
									0,
									$pnfpb_notificationtitle,
									$pnfpb_activity_content_push,
									$pnfpb_messageurl,
									$pnfpb_iconurl,
									$pnfpb_target_userid_array_values[0],
									$pnfpb_pushtype
								);
							}
						}
					}

					if (get_option("pnfpb_webtoapp_push") === "1") {
						$pnfpb_target_userid = $pnfpb_leader_id;

						$pnfpb_target_userid_array_values = $wpdb->get_col(
							$wpdb->prepare(
								"SELECT device_id FROM %i WHERE userid = %d AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,26,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) ORDER BY id DESC LIMIT 50",
								$pnfpb_table_name,
								$pnfpb_leader_id
							)
						);

						if (count($pnfpb_target_userid_array_values) > 0) {
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
									"PNFPB_webtoapp_schedule_push_notification_hook",
									[
										0,
										$pnfpb_notificationtitle,
										$pnfpb_activity_content_push,
										$pnfpb_messageurl,
										$pnfpb_iconurl,
										$pnfpb_target_userid_array_values,
										$pnfpb_pushtype,
									]
								);
							} else {
								$PNFPB_WP_webtoapp_notification_class_obj = new PNFPB_webtoapp_notification_class();
								$PNFPB_WP_webtoapp_notification_class_obj->PNFPB_webtoapp_notification(
									0,
									$pnfpb_notificationtitle,
									$pnfpb_activity_content_push,
									$pnfpb_messageurl,
									$pnfpb_iconurl,
									$pnfpb_target_userid_array_values,
									$pnfpb_pushtype
								);
							}
						}
					}

					if (
						get_option("pnfpb_onesignal_push") === "1" &&
						get_option("pnfpb_progressier_push") !== "1"
					) {
						if (
							get_option("pnfpb_ic_fcm_frontend_enable_subscription") === "1"
						) {
							$pnfpb_target_userid_array_values = $wpdb->get_col(
								$wpdb->prepare(
									"SELECT userid FROM %i WHERE userid = %d AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,26,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) ORDER BY id DESC LIMIT 50",
									$pnfpb_table_name,
									$pnfpb_leader_id,
									"%onesignal%"
								)
							);
						} else {
							$pnfpb_target_userid_array_values = ["$pnfpb_leader_id"];
						}

						if (count($pnfpb_target_userid_array_values) > 0) {
							$pnfpb_target_userid_array = array_map(function ($pnfpb_value) {
								return $pnfpb_value == 1 ? "1pnfpbadm" : $pnfpb_value;
							}, $pnfpb_target_userid_array_values);

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
									"PNFPB_onesignal_schedule_push_notification_hook",
									[
										$pnfpb_sender_id,
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
									$pnfpb_sender_id,
									$pnfpb_notificationtitle,
									$pnfpb_activity_content_push,
									$pnfpb_messageurl,
									$pnfpb_iconurl,
									$pnfpb_target_userid_array
								);
							}
						}
					} else {
						if (get_option("pnfpb_progressier_push") !== "1") {

							$pnfpb_deviceids = $wpdb->get_col(
								$wpdb->prepare(
									"SELECT DISTINCT(SUBSTRING_INDEX(device_id, '!!', 1)) FROM %i WHERE device_id NOT LIKE %s AND userid = %d AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,26,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) ORDER BY id DESC LIMIT 50",
									$pnfpb_table_name,
									"%@N%",
									$pnfpb_leader_id
								)
							);

							$pnfpb_webview = false;

							if (count($pnfpb_deviceids) > 0) {
								$pnfpb_regid = $pnfpb_deviceids;

								if (
									get_option("pnfpb_ic_fcm_bfollowermessage_content") !=
									false &&
									get_option("pnfpb_ic_fcm_bfollowermessage_content") != ""
								) {
									$pnfpb_activity_content_push = get_option(
										"pnfpb_ic_fcm_bfollowermessage_content"
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
										$pnfpb_action_scheduler_status = as_schedule_single_action(
											time(),
											"PNFPB_httpv1_schedule_push_notification_hook",
											[
												0,
												$pnfpb_notificationtitle,
												mb_substr(
													stripslashes(
														wp_strip_all_tags(
															trim($pnfpb_activity_content_push)
														)
													),
													0,
													130,
													"UTF-8"
												),
												$pnfpb_iconurl,
												$pnfpb_iconurl,
												$pnfpb_messageurl,
												[
													"receipient_id" => strval($pnfpb_leader_id),
													"click_url" => $pnfpb_messageurl,
												],
												$pnfpb_regid,
												[],
												$pnfpb_follower_id,
												$pnfpb_leader_id,
												$pushtype,
											]
										);
									} else {
										$PNFPB_httpv1_notification_class_obj = new PNFPB_firebase_httpv1_notification_class();
										$PNFPB_httpv1_notification_class_obj->PNFPB_firebase_httpv1_notification(										
											0,
											$pnfpb_notificationtitle,
											mb_substr(
												stripslashes(
													wp_strip_all_tags(
														trim($pnfpb_activity_content_push)
													)
												),
												0,
												130,
												"UTF-8"
											),
											$pnfpb_iconurl,
											$pnfpb_iconurl,
											$pnfpb_messageurl,
											[
												"receipient_id" => strval($pnfpb_leader_id),
												"click_url" => $pnfpb_messageurl,
											],
											$pnfpb_regid,
											[],
											$pnfpb_follower_id,
											$pnfpb_leader_id,
											$pnfpb_pushtype
										);
									}
								}

								do_action(
									"PNFPB_connect_to_external_api_for_private_messages"
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