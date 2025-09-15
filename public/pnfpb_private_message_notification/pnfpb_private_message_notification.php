<?php

/**
 * Triggered after private messages sent for user in BuddyPress.
 * to send push notifications Opt in/out for the notification can be
 * controlled from plugin settings.
 *
 *
 * @param array   $raw_args		Message content array
 *
 *
 * @since 1.13
 */
if (!class_exists("PNFPB_private_message_notification_class")) {
    class PNFPB_private_message_notification_class
    {
        public function PNFPB_private_message_notification(
			$raw_args = []
		) {
			$apiaccesskey = get_option("pnfpb_ic_fcm_google_api");
			
			$webpush_option = get_option("pnfpb_webpush_push");
			$webpush_firebase = get_option("pnfpb_webpush_push_firebase");				

			// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

			if (
				(get_option("pnfpb_ic_fcm_bprivatemessage_enable") == 1 &&
					($apiaccesskey != "" && $apiaccesskey != false)) ||
				(get_option("pnfpb_ic_fcm_bprivatemessage_enable") == 1 &&
					(get_option("pnfpb_onesignal_push") === "1" ||
						get_option("pnfpb_httpv1_push") === "1" ||
						get_option("pnfpb_progressier_push") === "1" ||
					 	$webpush_option === '1' || 
					 	$webpush_option === '2' || 
					 	$webpush_firebase === '1' ||
						get_option("pnfpb_webtoapp_push") === "1"))
			) {
				global $wpdb;

				if (is_object($raw_args)) {
					$args = (array) $raw_args;
				} else {
					$args = $raw_args;
				}

				// These should be extracted below.
				$recipients = [];
				$email_subject = $email_content = "";
				$sender_id = 0;

				// Barf.
				extract($args);


				if (empty($recipients)) {
					return;
				}

				// Send an email to each recipient.
				foreach ($recipients as $recipient) {
					$sender_name = "";

					$sender_name = bp_core_get_user_displayname($sender_id);

					if (isset($message)) {
						$message = wpautop($message);
					} else {
						$message = "";
					}

					$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

					$url = "https://fcm.googleapis.com/fcm/send";

					$activity_content_push = $message;

					$notificationtitle =
						$sender_name .
						esc_html(
							__(
								" sent you private message",
								"push-notification-for-post-and-buddypress"
							)
						);

						$notificationtitle = str_replace(
							"[sender name]",
							$sender_name,
							$notificationtitle
						);		

					$titletext = get_option("pnfpb_ic_fcm_bprivatemessage_text");

					if ($titletext && $titletext !== "") {
						$notificationtitle = str_replace(
							"[sender name]",
							$sender_name,
							$titletext
						);
					}

					$activity_content_push = str_replace(
						"[sender name]",
						$sender_name,
						$activity_content_push
					);

					$contenttext = get_option("pnfpb_ic_fcm_bprivatemessage_content");

					if ($contenttext && $contenttext !== "") {
						$activity_content_push = str_replace(
							"[sender name]",
							$sender_name,
							$contenttext
						);
					}		

					$iconurl = get_option("pnfpb_ic_fcm_upload_icon");

					if (function_exists("bp_members_get_user_url")) {
						$messageurl = esc_url(
							bp_members_get_user_url($recipient->user_id) .
								bp_get_messages_slug() .
								"/view/" .
								$thread_id .
								"/"
						);
					} else {
						$messageurl = esc_url(
							bp_core_get_user_domain($recipient->user_id) .
								bp_get_messages_slug() .
								"/view/" .
								$thread_id .
								"/"
						);
					}

					if (class_exists("Better_Messages")) {
						$bettermessages_slug = Better_Messages()->settings["bpProfileSlug"];

						if (function_exists("bp_members_get_user_url")) {
							$messageurl = esc_url(
								bp_members_get_user_url($recipient->user_id) .
									$bettermessages_slug
							);
						} else {
							$messageurl = esc_url(
								bp_core_get_user_domain($recipient->user_id) .
									$bettermessages_slug
							);
						}

						$current_user_id = $recipient->user_id;

						$url_overwritten = apply_filters(
							"bp_better_messages_page",
							null,
							$current_user_id
						);

						if ($url_overwritten !== null) {
							$messageurl = $url_overwritten;
						} else {
							if (is_user_logged_in() || wp_doing_cron()) {
								if (
									class_exists("AsgarosForum") &&
									Better_Messages()->settings["chatPage"] ===
										"asgaros-forum"
								) {
									global $asgarosforum;

									$link =
										$asgarosforum->get_link(
											"profile",
											$current_user_id
										) . "messages";

									$messageurl = $link;
								} else {
									if (
										class_exists("WooCommerce") &&
										Better_Messages()->settings["chatPage"] ===
											"woocommerce"
									) {
										$link =
											trailingslashit(
												get_permalink(
													get_option(
														"woocommerce_myaccount_page_id"
													)
												)
											) . $bettermessages_slug;

										$messageurl = $link;
									} else {
										if (
											Better_Messages()->settings["chatPage"] !== "0"
										) {
											$messageurl = get_permalink(
												Better_Messages()->settings["chatPage"]
											);
										} else {
											if (class_exists("BuddyPress")) {
												$messageurl = esc_url(
													bp_core_get_user_domain(
														$recipient->user_id
													) . $bettermessages_slug
												);
											}
										}
									}
								}
							}
						}

						$messageurl = $messageurl . "/#/conversation/" . $thread_id . "/";
					}

					$imageurl = "";

					$iconurl = bp_core_fetch_avatar([
						"item_id" => $sender_id, // output user id of post author
						"type" => "full",
						"html" => false, // FALSE = return url, TRUE (default) = return url wrapped with html
					]);
					
					$pushtype = "privatemessages";
					
					$target_deviceid_values = [];						
					
					if ($webpush_option === '1' || $webpush_option === '2' || $webpush_firebase === '1') {

						$target_deviceid_values = $wpdb->get_results(
							$wpdb->prepare(
								"SELECT * FROM %i WHERE device_id NOT LIKE %s AND userid = %d AND web_auth <> %s AND web_256 <> %s AND subscription_auth_token <> %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,6,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
								$table_name,
								"%!!%",
								$recipient->user_id,
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
								$messageurl,
								[
									"thread_id" => strval($thread_id),
									"click_url" => $messageurl,
								],
								$target_subscription_array,
								$sender_id,
								$recipient->user_id,
								$pushtype	
							);						
						}
					} else {			
						if (get_option("pnfpb_progressier_push") === "1") {
							$target_userid = $recipient->user_id;

							$target_userid_array_values = $wpdb->get_col(
								$wpdb->prepare(
									"SELECT device_id FROM %i WHERE userid = %d AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,6,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
									$table_name,
									$recipient->user_id,
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
							$target_userid = $recipient->user_id;

							$target_userid_array_values = $wpdb->get_col(
								$wpdb->prepare(
									"SELECT device_id FROM %i WHERE userid = %d AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,6,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
									$table_name,
									$recipient->user_id
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
							if (
								get_option("pnfpb_ic_fcm_frontend_enable_subscription") === "1"
							) {
								$target_userid_array_values = $wpdb->get_col(
									$wpdb->prepare(
										"SELECT userid FROM %i WHERE userid = %d AND device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,6,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
										$table_name,
										$recipient->user_id,
										"%onesignal%"
									)
								);
							} else {
								$target_userid_array_values = ["$recipient->user_id"];
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
											$sender_id,
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
										$sender_id,
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
											"SELECT DISTINCT(SUBSTRING_INDEX(device_id, '!!', 1)) FROM %i WHERE device_id NOT LIKE %s AND userid = %d AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,6,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) ORDER BY id DESC LIMIT 1000",
											$table_name,
											"%@N%",
											$recipient->user_id
										)
									);

								$webview = false;

								if (count($deviceids) > 0) {
									$regid = $deviceids;

									if (
										get_option("pnfpb_ic_fcm_bprivatemessage_content") !=
											false &&
										get_option("pnfpb_ic_fcm_bprivatemessage_content") != ""
									) {
										$activity_content_push = get_option(
											"pnfpb_ic_fcm_bprivatemessage_content"
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
													[
														"thread_id" => strval($thread_id),
														"click_url" => $messageurl,
													],
													$regid,
													[],
													$sender_id,
													$recipient->user_id,
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
												[
													"thread_id" => strval($thread_id),
													"click_url" => $messageurl,
												],
												$regid,
												[],
												$sender_id,
												$recipient->user_id,
												$pushtype
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
}

?>
