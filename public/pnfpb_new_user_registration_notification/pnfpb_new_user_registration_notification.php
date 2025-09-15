<?php
// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery
if (!class_exists("PNFPB_new_user_registration_notification_class")) {
    class PNFPB_new_user_registration_notification_class
    {
        public function PNFPB_new_user_registration_notification(
			$user_id,
			$userdata
		) {
			
			$webpush_option = get_option("pnfpb_webpush_push");
			$webpush_firebase = get_option("pnfpb_webpush_push_firebase");
			
			$user_meta = get_userdata($user_id);

			if (empty($userdata) || get_option("pnfpb_ic_fcm_new_user_registration_enable") !== "1") {
				return;
			}

			$super_admins = get_users("role=administrator");
			
			if ($super_admins) {
				foreach ($super_admins as $adminuser) {
					if (isset($adminuser->ID) && !empty($adminuser->ID)) {

						$apiaccesskey = get_option("pnfpb_ic_fcm_google_api");

						if (
							(get_option(
								"pnfpb_ic_fcm_new_user_registration_enable"
							) == "1" &&
							 get_option("pnfpb_progressier_push") !== "1" &&
							 get_option("pnfpb_webtoapp_push") !== "1" &&
							 ($apiaccesskey !== "" &&
							  $apiaccesskey !== false)) ||
							(get_option(
								"pnfpb_ic_fcm_new_user_registration_enable"
							) == 1 &&
							 (get_option("pnfpb_onesignal_push") === "1" ||
							  $webpush_option === '1' || 
							  $webpush_option === '2' || 
							  $webpush_firebase === '1' ||
							  get_option("pnfpb_httpv1_push") === "1"))
						) {
							global $wpdb;

							$new_user_name = bp_core_get_user_displayname(
								$user_id
							);

							$table_name =
								$wpdb->prefix .
								"pnfpb_ic_subscribed_deviceids_web";

							$url = "https://fcm.googleapis.com/fcm/send";

							$activity_content_push =
								"New user registered in " .
								get_bloginfo("name");

							$notificationtitle =
								$new_user_name .
								esc_html(
								__(
									" registered as new member",
									"push-notification-for-post-and-buddypress"
								)
							);

							$titletext = get_option(
								"pnfpb_ic_fcm_buddypress_new_user_registration_text_enable"
							);

							if ($titletext && $titletext !== "") {
								$notificationtitle = str_replace(
									"[user name]",
									$new_user_name,
									$titletext
								);
							}

							$iconurl = get_option("pnfpb_ic_fcm_upload_icon");

							$messageurl = esc_url(admin_url("users.php"));

							if (
								get_option(
									"pnfpb_ic_fcm_buddypress_new_user_registration_content_enable"
								) != false &&
								get_option(
									"pnfpb_ic_fcm_buddypress_new_user_registration_content_enable"
								) != ""
							) {
								$activity_content_push = get_option(
									"pnfpb_ic_fcm_buddypress_new_user_registration_content_enable"
								);
							}

							$activity_content_push = str_replace(
								"[user name]",
								$new_user_name,
								$activity_content_push
							);
							
							$imageurl = '';

							$target_deviceid_values = [];								
							
							if ($webpush_option === '1' || $webpush_option === '2' || $webpush_firebase === '1') {

								$target_deviceid_values = $wpdb->get_results(
									$wpdb->prepare(
										"SELECT * FROM %i WHERE device_id NOT LIKE %s AND userid = %d AND web_auth <> %s AND web_256 <> %s AND subscription_auth_token <> %s LIMIT 2000",
										$table_name,
										"%!!%",
										$adminuser->ID,
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
										stripslashes(
											wp_strip_all_tags(
												$activity_content_push
											)
										),
										$iconurl,
										$imageurl,
										$messageurl,
										["click_url" => $messageurl],
										$target_subscription_array,
										$user_id,
										0	
									);						
								}
								
							} else {								

								if (get_option("pnfpb_onesignal_push") === "1") {
									$target_userid_array = [];

									$target_userid_array_values = $wpdb->get_col(
										$wpdb->prepare(
											"SELECT userid FROM %i WHERE device_id LIKE %s AND userid = %d LIMIT %d",
											$table_name,
											"%onesignal%",
											$adminuser->ID,
											2000
										)
									);

									$target_userid_array = array_map(function (
										$value
									) {
										return $value == 1 ? "1pnfpbadm" : $value;
									}, $target_userid_array_values);

									$PNFPB_WP_onesignal_notification_class_obj = new PNFPB_onesignal_notification_class();
									$PNFPB_WP_onesignal_notification_class_obj->PNFPB_onesignal_notification(
										$group_id,
										$grouptitle,
										$localactivitycontent,
										$group_link,
										$group_image,
										$target_userid_array
									);
								} else {
									if (
										get_option(
											"pnfpb_ic_fcm_loggedin_notify"
										) &&
										get_option(
											"pnfpb_ic_fcm_loggedin_notify"
										) === "1"
									) {
										$deviceids = $wpdb->get_col(
											$wpdb->prepare(
												"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > %d AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND userid = %d LIMIT %d",
												$table_name,
												0,
												"%webview%",
												"%!!%",
												"%@N%",
												$adminuser->ID,
												1000
											)
										);
									} else {
										$deviceids = $wpdb->get_col(
											$wpdb->prepare(
												"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id NOT LIKE %s AND device_id NOT LIKE %s AND device_id NOT LIKE %s AND userid = %d LIMIT %d",
												$table_name,
												"%webview%",
												"%!!%",
												"%@N%",
												$adminuser->ID,
												1000
											)
										);
									}

									$webview = false;
									if (
										get_option(
											"pnfpb_ic_fcm_loggedin_notify"
										) &&
										get_option(
											"pnfpb_ic_fcm_loggedin_notify"
										) === "1"
									) {
										$deviceidswebview = $wpdb->get_col(
											$wpdb->prepare(
												"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE userid > %d AND device_id LIKE %s AND device_id NOT LIKE %s AND userid = %d LIMIT %d",
												$table_name,
												0,
												"%webview%",
												"%!!%",
												$adminuser->ID,
												1000
											)
										);
									} else {
										$deviceidswebview = $wpdb->get_col(
											$wpdb->prepare(
												"SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id LIKE %s AND device_id NOT LIKE %s AND userid = %d LIMIT %d",
												$table_name,
												"%webview%",
												"%!!%",
												$adminuser->ID,
												1000
											)
										);
									}

									$imageurl = "";

									$iconurl = bp_core_fetch_avatar([
										"item_id" => $user_id, // output user id of post author
										"type" => "full",
										"html" => false, // FALSE = return url, TRUE (default) = return url wrapped with html
									]);

									if (count($deviceids) > 0) {
										$regid = $deviceids;
										if (
											get_option("pnfpb_httpv1_push") === "1"
										) {
											$FB_httpv1_notification_class_obj = new PNFPB_firebase_httpv1_notification_class();
											$FB_httpv1_notification_class_obj->PNFPB_firebase_httpv1_notification(										
												0,
												$notificationtitle,
												stripslashes(
													wp_strip_all_tags(
														$activity_content_push
													)
												),
												$iconurl,
												$imageurl,
												$messageurl,
												["click_url" => $messageurl],
												$regid,
												$deviceidswebview,
												$user_id,
												0,
												'newuserregistration'
											);
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
}

?>