<?php

/**
 * Triggered after creating activity in BuddyPress to send push notifications
 * Opt in/out for the notification can be controlled from plugin settings.
 *
 * @param string   $activity_content Activity content
 * @param numeric  $user_id 			USER ID
 * @param numeric  $activity_id		Activity ID
 *
 *
 * @since 1.0.0
 */
// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

if (!class_exists("PNFPB_all_activities_notification_class")) {
    class PNFPB_all_activities_notification_class
    {
        public function PNFPB_all_activities_notification(
            $activity_content = null,
			$user_id = null,
			$activity_id = null,
        ) {
			$apiaccesskey = get_option("pnfpb_ic_fcm_google_api");

			$bactivity = 0;

			if (get_option("pnfpb_ic_fcm_bactivity_enable")) {
				$bactivity = get_option("pnfpb_ic_fcm_bactivity_enable");
			} else {
				if (false === get_option("pnfpb_ic_fcm_bactivity_enable")) {
					$bactivity = 1;
				} else {
					$bactivity = 0;
				}
			}

			$deviceidswebview = [];

			$deviceids = [];

			if (
				(($activity_content &&
					false ===
						as_has_scheduled_action("PNFPB_cron_buddypressactivities_hook")) ||
					(!$activity_content &&
						as_has_scheduled_action("PNFPB_cron_buddypressactivities_hook"))) &&
				(($bactivity == 1 &&
					($apiaccesskey != "" && $apiaccesskey != false)) ||
					($bactivity == 1 &&
						(get_option("pnfpb_onesignal_push") === "1" ||
							get_option("pnfpb_httpv1_push") === "1" ||
							get_option("pnfpb_progressier_push") === "1" ||
							get_option("pnfpb_webtoapp_push") === "1")))
			) {
				global $wpdb;
				$blog_title = get_bloginfo("name");

				$activitylink = get_home_url();
				if (function_exists("bp_is_active")) {
					$activitylink =
						get_home_url() . "/" . buddypress()->pages->activity->slug;
				}

				if ($activity_id) {
					$activitylink = bp_activity_get_permalink($activity_id);
				}

				$table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

				$deviceids_count = 0;

				if ($activity_content) {
					$localactivitycontent = $activity_content;
				} else {
					$cron_get_scheduled_activities = bp_activity_get(
						$args = ["per_page" => 1, "sort" => "DESC"]
					);

					foreach ($cron_get_scheduled_activities["activities"] as $activity) {
						$localactivitycontent = mb_substr(
							stripslashes(
								wp_strip_all_tags(urldecode(trim($activity->content)))
							),
							0,
							80,
							"UTF-8"
						);

						$activitylink = bp_activity_get_permalink($activity->id, $activity);

						$user_id = $activity->user_id;
					}
				}
				$imageurl = "";

				$activitytitle =
					"[member name]" .
					esc_html(
						__(
							" posted new activity in ",
							"push-notification-for-post-and-buddypress"
						)
					) .
					$blog_title;

				$sender_name = "";

				if (
					get_option("pnfpb_ic_fcm_activity_title") != false &&
					get_option("pnfpb_ic_fcm_activity_title") != ""
				) {
					$activitytitle = get_option("pnfpb_ic_fcm_activity_title");
				}

				if ($user_id !== null) {
					$sender_name = bp_core_get_user_displayname($user_id);

					$activitytitle = str_replace(
						"[member name]",
						$sender_name,
						$activitytitle
					);
				}

				if (
					get_option("pnfpb_ic_fcm_activity_message") != false &&
					get_option("pnfpb_ic_fcm_activity_message") != ""
				) {
					if ($activity_content) {
						$localactivitycontent = get_option("pnfpb_ic_fcm_activity_message");
					} else {
						$localactivitycontent .= get_option(
							"pnfpb_ic_fcm_activity_message"
						);
					}
				}

				if ($localactivitycontent) {
					preg_match_all(
						'/(alt|title|src)=("[^"]*")/i',
						stripslashes($localactivitycontent),
						$imgresult
					);

					if (is_array($imgresult)) {
						if (
							count($imgresult) > 2 &&
							is_array($imgresult[2]) &&
							count($imgresult[2]) > 0
						) {
							$imageurl = str_replace('"', "", $imgresult[2][0]);
							$imageurl = stripslashes($imageurl);
						}
					}
				}

				$localactivitycontent = str_replace(
					"[member name]",
					$sender_name,
					$localactivitycontent
				);

				$bp_activity_table_name = $wpdb->prefix."bp_activity";

				$check_privacy_column_exists = false;

				/* To make compatible with Youzify pro plugin privacy options - onlyme and friends activities **/

				if (class_exists("Youzify_Pro")) {

					$check_privacy_column_exists = true;
				}

				$activity_privacy = '';

				if ($check_privacy_column_exists) {

					$privacy_column_sql = $wpdb->prepare( "SELECT privacy from {$bp_activity_table_name} WHERE id = %d", $activity_id );

					$activity_privacy = $wpdb->get_var( $privacy_column_sql );
				}

				$buddyboss_platform_plugin_file = "buddyboss-platform/bp-loader.php";
				
				$webpush_option = get_option("pnfpb_webpush_push");
				$webpush_firebase = get_option("pnfpb_webpush_push_firebase");			
				$target_deviceid_values = [];
				$table = $wpdb->prefix . 'pnfpb_ic_subscribed_deviceids_web';
				
				$iconurl = get_option("pnfpb_ic_fcm_upload_icon");

				if ($webpush_option === '1' || $webpush_option === '2' || $webpush_firebase === '1') {
					
					$target_deviceid_values = $wpdb->get_results(
						$wpdb->prepare(
							"SELECT * FROM %i WHERE device_id NOT LIKE %s AND web_auth <> %s AND web_256 <> %s AND subscription_auth_token <> %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
							$table_name,
							"%!!%",
							"","",""
						)
					);
					
					$merged_target_subscription_array = [];

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
							stripslashes(wp_strip_all_tags($activitytitle)),
							mb_substr(
								stripslashes(
									wp_strip_all_tags(
										urldecode(trim($localactivitycontent))
									)
								),
								0,
								130,
								"UTF-8"
							),
							$iconurl,
							"",
							$activitylink,
							["click_url" => $activitylink],
							$target_subscription_array,
							0,
							0,
							"activity"
						);
					}
					
				} else {

					if (get_option("pnfpb_progressier_push") === "1" ) {
						$target_userid_array_values = $wpdb->get_col(
							$wpdb->prepare(
								"SELECT device_id FROM %i WHERE device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
								$table_name,
								"%progressier%"
							)
						);

						if (
							get_option("pnfpb_ic_fcm_activity_schedule_now_enable") &&
							get_option("pnfpb_ic_fcm_activity_schedule_now_enable") === "1"
						) {
							$action_scheduler_status = as_schedule_single_action(
								time(),
								"PNFPB_progressier_schedule_push_notification_hook",
								[
									0,
									$activitytitle,
									$localactivitycontent,
									$activitylink,
									$imageurl,
									0,
									"",
									$target_userid_array_values,
								]
							);
						} else {
							$PNFPB_WP_progressier_notification_class_obj = new PNFPB_progressier_notification_class();
							$PNFPB_WP_progressier_notification_class_obj->PNFPB_progressier_notification(							
								0,
								$activitytitle,
								$localactivitycontent,
								$activitylink,
								$imageurl,
								0,
								"",
								$target_userid_array_values
							);
						}
					}

					if (get_option("pnfpb_webtoapp_push") === "1") {
						$target_userid_array_values = $wpdb->get_col(
							$wpdb->prepare(
								"SELECT device_id FROM %i WHERE (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
								$table_name
							)
						);

						if (
							get_option("pnfpb_ic_fcm_activity_schedule_now_enable") &&
							get_option("pnfpb_ic_fcm_activity_schedule_now_enable") === "1"
						) {
							$action_scheduler_status = as_schedule_single_action(
								time(),
								"PNFPB_webtoapp_schedule_push_notification_hook",
								[
									0,
									$activitytitle,
									$localactivitycontent,
									$activitylink,
									$imageurl,
									0,
									"",
									$target_userid_array_values,
								]
							);
						} else {
							$PNFPB_WP_webtoapp_notification_class_obj = new PNFPB_webtoapp_notification_class();
							$PNFPB_WP_webtoapp_notification_class_obj->PNFPB_webtoapp_notification(							
								0,
								$activitytitle,
								$localactivitycontent,
								$activitylink,
								$imageurl,
								0,
								"",
								$target_userid_array_values
							);
						}
					}

					if (
						get_option("pnfpb_onesignal_push") === "1" &&
						get_option("pnfpb_progressier_push") !== "1"				
					) {
						$target_userid = 0;

						$target_userid_array = [];

						if (($pos = strpos($localactivitycontent, "@")) !== false) {
							$str = stripslashes($localactivitycontent);

							$target_username_array = explode("@", $str);

							if (count($target_username_array) > 1) {
								$target_userid_array = explode(" ", $target_username_array[1]);

								if (count($target_userid_array) > 0) {
									$target_userid = intval(
										bp_activity_get_userid_from_mentionname(
											$target_userid_array[0]
										)
									);

									array_push($target_userid_array, "$target_userid");
								}
							}

							if (
								$target_userid === 0 &&
								function_exists("is_plugin_active") &&
								is_plugin_active($buddyboss_platform_plugin_file)
							) {
								$str = stripslashes($localactivitycontent);

								$DOM = new DOMDocument();
								$DOM->loadHTML($str);

								$items = $DOM->getElementsByTagName("span");
								$span_list = "";

								for ($i = 0; $i < $items->length; $i++) {
									$item = $items->item($i);

									if ($item->getAttribute("class") == "atwho-inserted") {
										$span_list = $item->nodeValue;

										$target_username_array = explode("@", $span_list);

										if (count($target_username_array) > 1) {
											$target_userid = bp_activity_get_userid_from_mentionname(
												$target_username_array[1]
											);

											array_push($target_userid_array, "$target_userid");
										}
									}
								}
							}
						}

						if (
							((get_option("pnfpb_ic_fcm_loggedin_notify") &&
								get_option("pnfpb_ic_fcm_loggedin_notify") === "1") ||
								(get_option("pnfpb_ic_fcm_frontend_enable_subscription") ===
									"1" &&
									get_option("pnfpb_ic_fcm_loggedin_notify") &&
									get_option("pnfpb_ic_fcm_loggedin_notify") === "1")) &&
							($pos = strpos($localactivitycontent, "@")) === false
						) {
							$target_userid_array_values = $wpdb->get_col(
								$wpdb->prepare(
									"SELECT userid FROM %i WHERE device_id LIKE %s AND (SUBSTRING(subscription_option,1,1) = '1' OR SUBSTRING(subscription_option,12,1) = '1' OR subscription_option = '' OR subscription_option IS NULL) LIMIT 2000",
									$table_name,
									"%onesignal%"
								)
							);

							$target_userid_array = array_map(function ($value) {
								return $value == 1 ? "1pnfpbadm" : $value;
							}, $target_userid_array_values);
						}

						if (
							get_option("pnfpb_ic_fcm_activity_schedule_now_enable") &&
							get_option("pnfpb_ic_fcm_activity_schedule_now_enable") === "1"
						) {
							$action_scheduler_status = as_schedule_single_action(
								time(),
								"PNFPB_onesignal_schedule_push_notification_hook",
								[
									$activity_id,
									$activitytitle,
									$localactivitycontent,
									$activitylink,
									$imageurl,
									$target_userid_array,
								]
							);
						} else {
							$PNFPB_WP_onesignal_notification_class_obj = new PNFPB_onesignal_notification_class();
							$PNFPB_WP_onesignal_notification_class_obj->PNFPB_onesignal_notification(
								$activity_id,
								$activitytitle,
								$localactivitycontent,
								$activitylink,
								$imageurl,
								$target_userid_array
							);
						}
					} else {
						if (
							get_option("pnfpb_progressier_push") !== "1" &&
							(($pos = strpos($localactivitycontent, "@")) !== false || $activity_privacy === "onlyme" || $activity_privacy === "friends"
						)) {
							$target_userid = 0;

							$target_userid_array = [];

							if (($pos = strpos($localactivitycontent, "@")) !== false) {
								$str = stripslashes($localactivitycontent);

								$target_username_array = explode("@", $str);

								if (count($target_username_array) > 1) {
									$target_userid_array = explode(
										" ",
										$target_username_array[1]
									);

									if (count($target_userid_array) > 0) {
										$target_userid = intval(
											bp_activity_get_userid_from_mentionname(
												$target_userid_array[0]
											)
										);
									}
								}

								if (
									$target_userid === 0 &&
									function_exists("is_plugin_active") &&
									is_plugin_active($buddyboss_platform_plugin_file)
								) {
									$str = stripslashes($localactivitycontent);

									$DOM = new DOMDocument();
									$DOM->loadHTML($str);

									$items = $DOM->getElementsByTagName("span");
									$span_list = "";

									for ($i = 0; $i < $items->length; $i++) {
										$item = $items->item($i);

										if ($item->getAttribute("class") == "atwho-inserted") {
											$span_list = $item->nodeValue;

											$target_username_array = explode("@", $span_list);

											if (count($target_username_array) > 1) {
												$target_userid = bp_activity_get_userid_from_mentionname(
													$target_username_array[1]
												);
											}
										}
									}
								}
							}

							$pushtype = "privatemessages";

							if ($activity_privacy === "onlyme" || $activity_privacy === "friends") {

								$target_userid = get_current_user_id();

								if ($activity_privacy === "friends") {

									$pushtype = "onlytofriends";

								}
							}			

							$url = "https://fcm.googleapis.com/fcm/send";

							$regid = [];
							$regidwebview = [];

							$iconurl = get_option("pnfpb_ic_fcm_upload_icon");

							if ($user_id !== null) {
								$iconurl = bp_core_fetch_avatar([
									"item_id" => $user_id, // output user id of post author
									"type" => "full",
									"html" => false, // FALSE = return url, TRUE (default) = return url wrapped with html
								]);

								if (!$iconurl || $iconurl !== "" || $iconurl === null) {
									$iconurl = get_option("pnfpb_ic_fcm_upload_icon");
								}
							}

							if (get_option("pnfpb_httpv1_push") === "1" && $target_userid > 0) {

								if ($activity_privacy !== "friends") {

									$deviceids = $wpdb->get_col(
										$wpdb->prepare(
											"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE  %s AND userid = %d",
											$table_name,
											"%!!%",
											"%@N%",
											$target_userid
										)
									);

									$regid = $deviceids;

									$deviceidswebview = $wpdb->get_col(
										$wpdb->prepare(
											"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id LIKE %s AND device_id NOT LIKE %s AND userid = %d",
											$table_name,
											"%webview%",
											"%@N%",
											$target_userid
										)
									);

									$regidwebview = $deviceidswebview;

								} else {

									if ($activity_privacy === "friends") {

										$pushtype = "onlytofriends";

										$action_scheduler_status = as_schedule_single_action(
											time(),
											"PNFPB_httpv1_schedule_push_notification_hook",
											[
												0,
												stripslashes(wp_strip_all_tags($activitytitle)),
												mb_substr(
													stripslashes(
														wp_strip_all_tags(
															urldecode(trim($localactivitycontent))
														)
													),
													0,
													130,
													"UTF-8"
												),
												$iconurl,
												$imageurl,
												$activitylink,
												["click_url" => $activitylink],
												[],
												[],
												$user_id,
												$target_userid,
												$pushtype,
											]
										);

									}
								}

								if (
									get_option("pnfpb_ic_fcm_activity_schedule_now_enable") &&
									get_option("pnfpb_ic_fcm_activity_schedule_now_enable") ===
										"1" && $activity_privacy !== "friends"
								) {
									$action_scheduler_status = as_schedule_single_action(
										time(),
										"PNFPB_httpv1_schedule_push_notification_hook",
										[
											0,
											stripslashes(wp_strip_all_tags($activitytitle)),
											mb_substr(
												stripslashes(
													wp_strip_all_tags(
														urldecode(trim($localactivitycontent))
													)
												),
												0,
												130,
												"UTF-8"
											),
											$iconurl,
											$imageurl,
											$activitylink,
											["click_url" => $activitylink],
											$regid,
											$regidwebview,
											$user_id,
											$target_userid,
											$pushtype,
										]
									);
								} else {

									if ($activity_privacy !== "friends") {

									$FB_httpv1_notification_class_obj = new PNFPB_firebase_httpv1_notification_class();
									$FB_httpv1_notification_class_obj->PNFPB_firebase_httpv1_notification(
											0,
											stripslashes(wp_strip_all_tags($activitytitle)),
											mb_substr(
												stripslashes(
													wp_strip_all_tags(
														urldecode(trim($localactivitycontent))
													)
												),
												0,
												130,
												"UTF-8"
											),
											$iconurl,
											$imageurl,
											$activitylink,
											["click_url" => $activitylink],
											$regid,
											$regidwebview,
											$user_id,
											$target_userid,
											$pushtype
										);
									}
								}
							}
						} else {
							if (
								get_option("pnfpb_httpv1_push") === "1" &&
								get_option("pnfpb_onesignal_push") !== "1" &&
								get_option("pnfpb_progressier_push") !== "1" &&
								$webpush_option !== '1' && $webpush_firebase !== '1'							
							) {
								$dcount = 0;
								$regid = [];
								$regidwebview = [];

								$iconurl = get_option("pnfpb_ic_fcm_upload_icon");

								$blog_title = get_bloginfo("name");

								$targetid = 0;

								$deviceidswebview = [];

								if (
									get_option("pnfpb_ic_fcm_activity_schedule_now_enable") &&
									get_option("pnfpb_ic_fcm_activity_schedule_now_enable") ===
										"1"
								) {
									$action_scheduler_status = as_schedule_single_action(
										time(),
										"PNFPB_httpv1_schedule_push_notification_hook",
										[
											0,
											stripslashes(wp_strip_all_tags($activitytitle)),
											mb_substr(
												stripslashes(
													wp_strip_all_tags(
														urldecode(trim($localactivitycontent))
													)
												),
												0,
												130,
												"UTF-8"
											),
											$iconurl,
											$imageurl,
											$activitylink,
											["click_url" => $activitylink],
											$regid,
											$deviceidswebview,
											$user_id,
											$targetid,
											"activity",
										]
									);
								} else {
									$FB_httpv1_notification_class_obj = new PNFPB_firebase_httpv1_notification_class();
									$FB_httpv1_notification_class_obj->PNFPB_firebase_httpv1_notification(
										0,
										stripslashes(wp_strip_all_tags($activitytitle)),
										mb_substr(
											stripslashes(
												wp_strip_all_tags(
													urldecode(trim($localactivitycontent))
												)
											),
											0,
											130,
											"UTF-8"
										),
										$iconurl,
										$imageurl,
										$activitylink,
										["click_url" => $activitylink],
										$regid,
										$deviceidswebview,
										$user_id,
										$targetid,
										"activity"
									);
								}

								do_action("PNFPB_connect_to_external_api_for_activity");
							}
						}
					}
				}
			}
		}
	}
}
?>
