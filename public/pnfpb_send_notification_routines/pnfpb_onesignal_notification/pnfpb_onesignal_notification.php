<?php

/** Onesignal push notification
 *
 * @since 1.65 version
 */

// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery
if (!class_exists("PNFPB_onesignal_notification_class")) {
	
    class PNFPB_onesignal_notification_class
    {
        public function PNFPB_onesignal_notification(
            $pushid,
            $pushtitle,
            $pushcontent,
            $pushlink,
            $pushimageurl,
            $target_device_id = 0,
            $retry_count = 4
        ) {
			try {
				$onesignal_post_url = "https://onesignal.com/api/v1/notifications";

				if (defined("ONESIGNAL_DEBUG") && defined("ONESIGNAL_LOCAL")) {
					$onesignal_post_url = "https://localhost:3001/api/v1/notifications";
				}

				$onesignalv3_settings = get_option("OneSignalWPSetting", []);

				if (
					class_exists("OneSignal") &&
					get_option("pnfpb_onesignal_push") === "1"
				) {
					$onesignal_wp_settings = OneSignal::get_onesignal_settings();
				} else {
					if (
						!empty($onesignalv3_settings) &&
						get_option("pnfpb_onesignal_push") === "1"
					) {
						$onesignal_wp_settings = $onesignalv3_settings;
					}
				}

				$onesignal_auth_key = $onesignal_wp_settings["app_rest_api_key"];

				$include_external_ids = [];

				$externalid = $this->PNFPB_icfcm_generate_random_uuid($pushtitle);

				$pushcontent = mb_substr(
					stripslashes(wp_strip_all_tags(urldecode(trim($pushcontent)))),
					0,
					130,
					"UTF-8"
				);

				$pushimageurl = str_replace("&#038;", "&", $pushimageurl);

				if (
					$target_device_id !== 0 &&
					(is_array($target_device_id) && count($target_device_id) > 0)
				) {
					$include_external_ids = $target_device_id;

					$fields = [
						"external_id" => $externalid,
						"app_id" => $onesignal_wp_settings["app_id"],
						"data" => ["post_id" => $pushid, "imageUrl" => $pushimageurl],
						"headings" => [
							"en" => stripslashes_deep(wp_specialchars_decode($pushtitle)),
						],
						//'included_segments' => array('All'),
						"isAnyWeb" => true,
						"url" => $pushlink,
						"contents" => [
							"en" => stripslashes_deep(
								wp_specialchars_decode(
									stripslashes(
										wp_strip_all_tags(urldecode(trim($pushcontent)))
									)
								)
							),
						],
						//'include_external_user_ids' => $include_external_ids,
						"include_aliases" => ["external_id" => $include_external_ids],
						"target_channel" => "push",
					];
				} else {
					$fields = [
						"external_id" => $externalid,
						"app_id" => $onesignal_wp_settings["app_id"],
						"data" => ["post_id" => $pushid, "imageUrl" => $pushimageurl],
						"headings" => [
							"en" => stripslashes_deep(wp_specialchars_decode($pushtitle)),
						],
						"included_segments" => ["All"],
						"isAnyWeb" => true,
						"url" => $pushlink,
						"contents" => [
							"en" => stripslashes_deep(
								wp_specialchars_decode(
									stripslashes(
										wp_strip_all_tags(urldecode(trim($pushcontent)))
									)
								)
							),
						],
					];
				}

				$fields["isIos"] = true;
				$fields["isAndroid"] = true;

				//$config_use_featured_image_as_image = $onesignal_wp_settings['showNotificationImageFromPostThumbnail'] === true;

				if ($pushimageurl != "") {
					$fields["chrome_web_icon"] = $pushimageurl;
					$fields["chrome_web_image"] = $pushimageurl;
					$fields["firefox_icon"] = $pushimageurl;
					$fields["big_picture"] = $pushimageurl;
					$fields["huawei_big_picture"] = $pushimageurl;
					$fields["adm_big_picture"] = $pushimageurl;
					$fields["chrome_big_picture"] = $pushimageurl;
					$fields["large_icon"] = $pushimageurl;
					$fields["ios_attachments"] = wp_json_encode(["id1" => $pushimageurl]);
				}
				
				$request = [
					"headers" => [
						"content-type" => "application/json;charset=utf-8",
						"Authorization" => "Basic " . $onesignal_auth_key,
					],
					"body" => wp_json_encode($fields),
					"timeout" => 3,
				];

				$response = wp_remote_post($onesignal_post_url, $request);

				if (is_wp_error($response)) {
					$status = $response->get_error_code();
					$error_message = $response->get_error_message();
					error_log(
						"There was a " .
							$status .
							" error in push notification: " .
							$error_message
					);
				}
			} catch (Exception $e) {
				$wp_error_msg = new WP_Error(
					"err",
					__("OneSignal: There was a problem sending a notification")
				);
				if (is_wp_error($wp_error_msg)) {
					error_log($wp_error_msg->get_error_message());
				}
			}
		}
		
        /** To generate random uuid function
         *
         * @since 1.65 version
         */
        public function PNFPB_icfcm_generate_random_uuid($title)
        {
            $now_minutes = floor(time() / 60);
            $prev_minutes = get_option("TimeLastUpdated");
            $prehash = (string) $title;
            $updatedAMinuteOrMoreAgo =
                $prev_minutes !== false && $now_minutes - $prev_minutes > 0;

            if ($updatedAMinuteOrMoreAgo || $prev_minutes === false) {
                update_option("TimeLastUpdated", $now_minutes);
                $timestamp = $now_minutes;
            } else {
                $timestamp = $prev_minutes;
            }

            $prehash = $prehash . $timestamp;
            $sha1 = substr(sha1($prehash), 0, 32);
            return substr($sha1, 0, 8) .
                "-" .
                substr($sha1, 8, 4) .
                "-" .
                substr($sha1, 12, 4) .
                "-" .
                substr($sha1, 16, 4) .
                "-" .
                substr($sha1, 20, 12);
        }		
	}
}

?>
