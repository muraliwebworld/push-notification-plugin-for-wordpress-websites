<?php

use WpOrg\Requests\Requests;

if (!class_exists("PNFPB_httpv1_subscription_option_update")) {
    class PNFPB_httpv1_subscription_option_update
    {
        public function PNFPB_httpv1_default_subscription_option_update(
            $bpdeviceid
        ) {
            /*** Function to opt for default Firebase httpv1 push notification for all options  ***/

            // phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

            global $wpdb;
            $table = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
			$pnfpb_fbauth_token = get_option("pnfpb_firebase_oauth_token");

			if (get_option("pnfpb_firebase_oauth_token") === false || get_option("pnfpb_firebase_oauth_token") === "") {

				$client = new Google_Client();

				// Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
				//
				$client->useApplicationDefaultCredentials();

				// Alternatively, provide the JSON authentication file directly.
				$configArray = json_decode(get_option("pnfpb_sa_json_data"), true);
				$client->setAuthConfig($configArray);

				// Add the scope as a string (multiple scopes can be provided as an array)
				$client->addScope("https://www.googleapis.com/auth/firebase.messaging");
				$client->refreshTokenWithAssertion();
				$pnfpb_fbauth_token_array = $client->getAccessToken();
				$pnfpb_fbauth_token = $pnfpb_fbauth_token_array["access_token"];
				update_option("pnfpb_firebase_oauth_token", $pnfpb_fbauth_token);
			}
            $url = "https://iid.googleapis.com/iid/v1:batchAdd";
            $headers = [
                "Authorization" => "Bearer " . $pnfpb_fbauth_token,
                "Content-Type" => "application/json",
                "access_token_auth" => "true",
            ];

            if (
                get_option("pnfpb_ic_fcm_loggedin_notify") &&
                get_option("pnfpb_ic_fcm_loggedin_notify") === "1"
            ) {
                $fieldsgeneral = wp_json_encode([
                    "to" => "/topics/pnfpbgeneralloggedin",
                    "registration_tokens" => [$bpdeviceid],
                ]);
            } else {
                $fieldsgeneral = wp_json_encode([
                    "to" => "/topics/pnfpbgeneral",
                    "registration_tokens" => [$bpdeviceid],
                ]);
            }

            $pnfpb_topic_requests = [
                // Request 1
                [
                    "url" => $url,
                    "headers" => $headers,
                    "data" => wp_json_encode([
                        "to" => "/topics/pnfpbondemand",
                        "registration_tokens" => [$bpdeviceid],
                    ]),
                    "type" => Requests::POST,
                ],
            ];

            array_push($pnfpb_topic_requests, [
                "url" => $url,
                "headers" => $headers,
                "data" => $fieldsgeneral,
                "type" => Requests::POST,
            ]);

            $pnfpb_topic_subscriptions_request = Requests::request_multiple(
                $pnfpb_topic_requests, array("blocking" => false)
            );

            $deviceid_version_update_status = $wpdb->query(
                $wpdb->prepare(
                    "UPDATE %i SET firebase_version = %s WHERE device_id LIKE %s",
                    $table,
                    "v5",
                    "%" . $wpdb->esc_like($bpdeviceid) . "%"
                )
            );
        }

        public function PNFPB_httpv1_multiple_subscription_option_update(
            $bpsubscribeoptions,
            $bpdeviceid,
            $pushtype = "",
            $old_subscription_option = "",
            $pnfpb_versionvalue = "v5"
        ) {
            /*** Function to opt for various Firebase httpv1 push notification options  ***/

            global $wpdb;
            $table = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

            $subscription_option_array = [];
            $old_subscription_option_array = [];

            if ($bpsubscribeoptions != "") {
                $subscription_option_array = str_split($bpsubscribeoptions);

                if (
                    get_option(
                        "pnfpb_ic_fcm_buddypress_comments_radio_enable"
                    ) === "2" &&
                    count($subscription_option_array) > 3 &&
                    $subscription_option_array[2] === "1"
                ) {
                    $subscription_option_array[2] = "0";
                    $subscription_option_array[3] = "1";
                    $bpsubscribeoptions = implode(
                        "",
                        $subscription_option_array
                    );
                }
            }

            if ($old_subscription_option != "") {
                $old_subscription_option_array = str_split(
                    $old_subscription_option
                );

                if (
                    get_option(
                        "pnfpb_ic_fcm_buddypress_comments_radio_enable"
                    ) === "2" &&
                    count($old_subscription_option_array) > 3 &&
                    $old_subscription_option_array[2] === "1"
                ) {
                    $old_subscription_option_array[2] = "0";
                    $old_subscription_option_array[3] = "1";
                    $old_subscription_option = implode(
                        "",
                        $old_subscription_option_array
                    );
                }
            }

			$pnfpb_fbauth_token = get_option("pnfpb_firebase_oauth_token");

			if (get_option("pnfpb_firebase_oauth_token") === false || get_option("pnfpb_firebase_oauth_token") === "") {

				$client = new Google_Client();

				// Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
				//
				$client->useApplicationDefaultCredentials();

				// Alternatively, provide the JSON authentication file directly.
				$configArray = json_decode(get_option("pnfpb_sa_json_data"), true);
				$client->setAuthConfig($configArray);

				// Add the scope as a string (multiple scopes can be provided as an array)
				$client->addScope("https://www.googleapis.com/auth/firebase.messaging");
				$client->refreshTokenWithAssertion();
				$pnfpb_fbauth_token_array = $client->getAccessToken();
				$pnfpb_fbauth_token = $pnfpb_fbauth_token_array["access_token"];
				update_option("pnfpb_firebase_oauth_token", $pnfpb_fbauth_token);
			}
            $url = "https://iid.googleapis.com/iid/v1:batchAdd";
            $headers = [
                "Authorization" => "Bearer " . $pnfpb_fbauth_token,
                "Content-Type" => "application/json",
                "access_token_auth" => "true",
            ];

            $pnfpb_topic_requests = [];

            /*** On demand Firebase httpv1 push notification subscription group **/

            $pnfpb_topic_requests = [
                [
                    "url" => "https://iid.googleapis.com/iid/v1:batchAdd",
                    "headers" => $headers,
                    "data" => wp_json_encode([
                        "to" => "/topics/pnfpbondemand",
                        "registration_tokens" => [$bpdeviceid],
                    ]),
                    "type" => Requests::POST,
                ],
            ];

            /*** Subscribe all options for Firebase httpv1 push notification  ***/

            if (
                count($subscription_option_array) > 0 &&
                $subscription_option_array[0] === "1"
            ) {
                $urlgeneral = "https://iid.googleapis.com/iid/v1:batchAdd";
                $fieldsgeneral = wp_json_encode([
                    "to" => "/topics/pnfpbgeneral",
                    "registration_tokens" => [$bpdeviceid],
                ]);
                array_push($pnfpb_topic_requests, [
                    "url" => $urlgeneral,
                    "headers" => $headers,
                    "data" => $fieldsgeneral,
                    "type" => Requests::POST,
                ]);
            } else {
                if (
                    (count($subscription_option_array) > 0 &&
                        $subscription_option_array[0] === "0") ||
                    (count($subscription_option_array) > 8 &&
                        $subscription_option_array[8] === "1")
                ) {
                    $urlgeneral =
                        "https://iid.googleapis.com/iid/v1:batchRemove";
                    $fieldsgeneral = wp_json_encode([
                        "to" => "/topics/pnfpbgeneral",
                        "registration_tokens" => [$bpdeviceid],
                    ]);
                    array_push($pnfpb_topic_requests, [
                        "url" => $urlgeneral,
                        "headers" => $headers,
                        "data" => $fieldsgeneral,
                        "type" => Requests::POST,
                    ]);
                }
            }

            /*** WordPress post subscription for Firebase httpv1 push notification  ***/

            if (
                count($subscription_option_array) > 1 &&
                $subscription_option_array[1] === "1"
            ) {
                $urlpost = "https://iid.googleapis.com/iid/v1:batchAdd";
                $fieldspost = wp_json_encode([
                    "to" => "/topics/pnfpbpost",
                    "registration_tokens" => [$bpdeviceid],
                ]);
                array_push($pnfpb_topic_requests, [
                    "url" => $urlpost,
                    "headers" => $headers,
                    "data" => $fieldspost,
                    "type" => Requests::POST,
                ]);
            } else {
                if (
                    (count($subscription_option_array) > 1 &&
                        $subscription_option_array[1] === "0") ||
                    (count($subscription_option_array) > 8 &&
                        $subscription_option_array[8] === "1")
                ) {
                    $urlpost = "https://iid.googleapis.com/iid/v1:batchRemove";
                    $fieldspost = wp_json_encode([
                        "to" => "/topics/pnfpbpost",
                        "registration_tokens" => [$bpdeviceid],
                    ]);
                    array_push($pnfpb_topic_requests, [
                        "url" => $urlpost,
                        "headers" => $headers,
                        "data" => $fieldspost,
                        "type" => Requests::POST,
                    ]);
                }
            }

            /*** BuddyPress Activities subscription for Firebase httpv1 push notification  ***/

            if (
                count($subscription_option_array) > 11 &&
                $subscription_option_array[11] === "1"
            ) {
                $urlactivity = "https://iid.googleapis.com/iid/v1:batchAdd";
                $fieldsactivity = wp_json_encode([
                    "to" => "/topics/pnfpbactivity",
                    "registration_tokens" => [$bpdeviceid],
                ]);
                array_push($pnfpb_topic_requests, [
                    "url" => $urlactivity,
                    "headers" => $headers,
                    "data" => $fieldsactivity,
                    "type" => Requests::POST,
                ]);
            } else {
                if (
                    (count($subscription_option_array) > 11 &&
                        $subscription_option_array[11] === "0") ||
                    (count($subscription_option_array) > 8 &&
                        $subscription_option_array[8] === "1")
                ) {
                    $urlactivity =
                        "https://iid.googleapis.com/iid/v1:batchRemove";
                    $fieldsactivity = wp_json_encode([
                        "to" => "/topics/pnfpbactivity",
                        "registration_tokens" => [$bpdeviceid],
                    ]);
                    array_push($pnfpb_topic_requests, [
                        "url" => $urlactivity,
                        "headers" => $headers,
                        "data" => $fieldsactivity,
                        "type" => Requests::POST,
                    ]);
                }
            }

            /*** BuddyPress comments subscription for Firebase httpv1 push notification  ***/

            if (
                count($subscription_option_array) > 2 &&
                $subscription_option_array[2] === "1" &&
                get_option("pnfpb_ic_fcm_buddypress_comments_radio_enable") ===
                    "1"
            ) {
                $urlcomments = "https://iid.googleapis.com/iid/v1:batchAdd";
                $fieldscomments = wp_json_encode([
                    "to" => "/topics/pnfpbcomments",
                    "registration_tokens" => [$bpdeviceid],
                ]);
                array_push($pnfpb_topic_requests, [
                    "url" => $urlcomments,
                    "headers" => $headers,
                    "data" => $fieldscomments,
                    "type" => Requests::POST,
                ]);
            } else {
                if (
                    get_option(
                        "pnfpb_ic_fcm_buddypress_comments_radio_enable"
                    ) === "1" &&
                    ((count($subscription_option_array) > 2 &&
                        $subscription_option_array[2] === "0") ||
                        (count($subscription_option_array) > 8 &&
                            $subscription_option_array[8] === "1"))
                ) {
                    $urlcomments =
                        "https://iid.googleapis.com/iid/v1:batchRemove";
                    $fieldscomments = wp_json_encode([
                        "to" => "/topics/pnfpbcomments",
                        "registration_tokens" => [$bpdeviceid],
                    ]);
                    array_push($pnfpb_topic_requests, [
                        "url" => $urlcomments,
                        "headers" => $headers,
                        "data" => $fieldscomments,
                        "type" => Requests::POST,
                    ]);
                }
            }

            /*** BuddyPress Mycomments subscription for Firebase httpv1 push notification  ***/

            if (
                (count($subscription_option_array) > 3 &&
                    $subscription_option_array[3] === "1" &&
                    get_option(
                        "pnfpb_ic_fcm_buddypress_comments_radio_enable"
                    ) === "2" &&
                    ((count($old_subscription_option_array) > 3 &&
                        $subscription_option_array[3] !==
                            $old_subscription_option_array[3]) ||
                        count($old_subscription_option_array) <= 3 ||
                        $pnfpb_versionvalue !== "v5")) ||
                (count($subscription_option_array) > 3 &&
                    $subscription_option_array[2] === "1" &&
                    get_option(
                        "pnfpb_ic_fcm_buddypress_comments_radio_enable"
                    ) === "2" &&
                    ((count($old_subscription_option_array) > 3 &&
                        $subscription_option_array[2] !==
                            $old_subscription_option_array[2]) ||
                        count($old_subscription_option_array) <= 3 ||
                        $pnfpb_versionvalue !== "v5"))
            ) {
                $urlmycomments = "https://iid.googleapis.com/iid/v1:batchAdd";
                $fieldsmycomments = wp_json_encode([
                    "to" => "/topics/pnfpbmycomments",
                    "registration_tokens" => [$bpdeviceid],
                ]);
                array_push($pnfpb_topic_requests, [
                    "url" => $urlmycomments,
                    "headers" => $headers,
                    "data" => $fieldsmycomments,
                    "type" => Requests::POST,
                ]);
            } else {
                if (
                    (((count($subscription_option_array) > 3 &&
                        $subscription_option_array[3] === "0") ||
                        (count($subscription_option_array) > 8 &&
                            $subscription_option_array[8] === "1")) &&
                        $pushtype !== "checkdeviceid" &&
                        get_option(
                            "pnfpb_ic_fcm_buddypress_comments_radio_enable"
                        ) === "2" &&
                        ((count($old_subscription_option_array) > 3 &&
                            $subscription_option_array[3] !==
                                $old_subscription_option_array[3]) ||
                            count($old_subscription_option_array) <= 3 ||
                            $pnfpb_versionvalue !== "v5")) ||
                    (((count($subscription_option_array) > 3 &&
                        $subscription_option_array[2] === "0") ||
                        (count($subscription_option_array) > 8 &&
                            $subscription_option_array[8] === "1")) &&
                        $pushtype !== "checkdeviceid" &&
                        get_option(
                            "pnfpb_ic_fcm_buddypress_comments_radio_enable"
                        ) === "2" &&
                        ((count($old_subscription_option_array) > 3 &&
                            $subscription_option_array[2] !==
                                $old_subscription_option_array[2]) ||
                            count($old_subscription_option_array) <= 3 ||
                            $pnfpb_versionvalue !== "v5"))
                ) {
                    $urlmycomments =
                        "https://iid.googleapis.com/iid/v1:batchRemove";
                    $fieldsmycomments = wp_json_encode([
                        "to" => "/topics/pnfpbmycomments",
                        "registration_tokens" => [$bpdeviceid],
                    ]);
                    array_push($pnfpb_topic_requests, [
                        "url" => $urlmycomments,
                        "headers" => $headers,
                        "data" => $fieldsmycomments,
                        "type" => Requests::POST,
                    ]);
                }
            }

            /*** New member joined subscription for Firebase httpv1 push notification  ***/

            if (
                count($subscription_option_array) > 4 &&
                $subscription_option_array[4] === "1" &&
                ((count($old_subscription_option_array) > 4 &&
                    $subscription_option_array[4] !==
                        $old_subscription_option_array[4]) ||
                    count($old_subscription_option_array) <= 4 ||
                    $pnfpb_versionvalue !== "v5")
            ) {
                $urlnewmemberjoined =
                    "https://iid.googleapis.com/iid/v1:batchAdd";
                $fieldsnewmemberjoined = wp_json_encode([
                    "to" => "/topics/pnfpbnewmemberjoined",
                    "registration_tokens" => [$bpdeviceid],
                ]);
                array_push($pnfpb_topic_requests, [
                    "url" => $urlnewmemberjoined,
                    "headers" => $headers,
                    "data" => $fieldsnewmemberjoined,
                    "type" => Requests::POST,
                ]);
            } else {
                if (
                    ((count($subscription_option_array) > 4 &&
                        $subscription_option_array[4] === "0") ||
                        (count($subscription_option_array) > 8 &&
                            $subscription_option_array[8] === "1")) &&
                    $pushtype !== "checkdeviceid"
                ) {
                    $urlnewmemberjoined =
                        "https://iid.googleapis.com/iid/v1:batchRemove";
                    $fieldsnewmemberjoined = wp_json_encode([
                        "to" => "/topics/pnfpbnewmemberjoined",
                        "registration_tokens" => [$bpdeviceid],
                    ]);
                    array_push($pnfpb_topic_requests, [
                        "url" => $urlnewmemberjoined,
                        "headers" => $headers,
                        "data" => $fieldsnewmemberjoined,
                        "type" => Requests::POST,
                    ]);
                }
            }

            /*** Avatar change subscription for Firebase httpv1 push notification  ***/

            if (
                count($subscription_option_array) > 9 &&
                $subscription_option_array[9] === "1" &&
                ((count($old_subscription_option_array) > 9 &&
                    $subscription_option_array[9] !==
                        $old_subscription_option_array[9]) ||
                    count($old_subscription_option_array) <= 9 ||
                    $pnfpb_versionvalue !== "v5")
            ) {
                $urlavatarchange = "https://iid.googleapis.com/iid/v1:batchAdd";
                $fieldsavatarchange = wp_json_encode([
                    "to" => "/topics/pnfpbavatarchange",
                    "registration_tokens" => [$bpdeviceid],
                ]);
                array_push($pnfpb_topic_requests, [
                    "url" => $urlavatarchange,
                    "headers" => $headers,
                    "data" => $fieldsavatarchange,
                    "type" => Requests::POST,
                ]);
            } else {
                if (
                    ((count($subscription_option_array) > 9 &&
                        $subscription_option_array[9] === "0") ||
                        (count($subscription_option_array) > 8 &&
                            $subscription_option_array[8] === "1")) &&
                    $pushtype !== "checkdeviceid" &&
                    ((count($old_subscription_option_array) > 9 &&
                        $subscription_option_array[9] !==
                            $old_subscription_option_array[9]) ||
                        count($old_subscription_option_array) <= 9 ||
                        $pnfpb_versionvalue !== "v5")
                ) {
                    $urlavatarchange =
                        "https://iid.googleapis.com/iid/v1:batchRemove";
                    $fieldsavatarchange = wp_json_encode([
                        "to" => "/topics/pnfpbavatarchange",
                        "registration_tokens" => [$bpdeviceid],
                    ]);
                    array_push($pnfpb_topic_requests, [
                        "url" => $urlavatarchange,
                        "headers" => $headers,
                        "data" => $fieldsavatarchange,
                        "type" => Requests::POST,
                    ]);
                }
            }

            /*** Cover image change subscription for Firebase httpv1 push notification  ***/

            if (
                count($subscription_option_array) > 10 &&
                $subscription_option_array[10] === "1" &&
                ((count($old_subscription_option_array) > 10 &&
                    $subscription_option_array[10] !==
                        $old_subscription_option_array[10]) ||
                    count($old_subscription_option_array) <= 10 ||
                    $pnfpb_versionvalue !== "v5")
            ) {
                $urlcoverimagechange =
                    "https://iid.googleapis.com/iid/v1:batchAdd";
                $fieldscoverimagechange = wp_json_encode([
                    "to" => "/topics/pnfpbcoverimagechange",
                    "registration_tokens" => [$bpdeviceid],
                ]);
                array_push($pnfpb_topic_requests, [
                    "url" => $urlcoverimagechange,
                    "headers" => $headers,
                    "data" => $fieldscoverimagechange,
                    "type" => Requests::POST,
                ]);
            } else {
                if (
                    ((count($subscription_option_array) > 10 &&
                        $subscription_option_array[10] === "0") ||
                        (count($subscription_option_array) > 8 &&
                            $subscription_option_array[8] === "1")) &&
                    $pushtype !== "checkdeviceid" &&
                    ((count($old_subscription_option_array) > 10 &&
                        $subscription_option_array[10] !==
                            $old_subscription_option_array[10]) ||
                        count($old_subscription_option_array) <= 10 ||
                        $pnfpb_versionvalue !== "v5")
                ) {
                    $urlcoverimagechange =
                        "https://iid.googleapis.com/iid/v1:batchRemove";
                    $fieldscoverimagechange = wp_json_encode([
                        "to" => "/topics/pnfpbcoverimagechange",
                        "registration_tokens" => [$bpdeviceid],
                    ]);
                    array_push($pnfpb_topic_requests, [
                        "url" => $urlcoverimagechange,
                        "headers" => $headers,
                        "data" => $fieldscoverimagechange,
                        "type" => Requests::POST,
                    ]);
                }
            }

            /*** Group invite subscription for Firebase httpv1 push notification  ***/

            if (
                count($subscription_option_array) > 12 &&
                $subscription_option_array[12] === "1" &&
                ((count($old_subscription_option_array) > 12 &&
                    $subscription_option_array[12] !==
                        $old_subscription_option_array[12]) ||
                    count($old_subscription_option_array) <= 12 ||
                    $pnfpb_versionvalue !== "v5")
            ) {
                $urlgroupinvite = "https://iid.googleapis.com/iid/v1:batchAdd";
                $fieldsgroupinvite = wp_json_encode([
                    "to" => "/topics/pnfpbgroupinvite",
                    "registration_tokens" => [$bpdeviceid],
                ]);
                array_push($pnfpb_topic_requests, [
                    "url" => $urlgroupinvite,
                    "headers" => $headers,
                    "data" => $fieldsgroupinvite,
                    "type" => Requests::POST,
                ]);
            } else {
                if (
                    ((count($subscription_option_array) > 12 &&
                        $subscription_option_array[12] === "0") ||
                        (count($subscription_option_array) > 8 &&
                            $subscription_option_array[8] === "1")) &&
                    $pushtype !== "checkdeviceid" &&
                    ((count($old_subscription_option_array) > 12 &&
                        $subscription_option_array[12] !==
                            $old_subscription_option_array[12]) ||
                        count($old_subscription_option_array) <= 12 ||
                        $pnfpb_versionvalue !== "v5")
                ) {
                    $urlgroupinvite =
                        "https://iid.googleapis.com/iid/v1:batchRemove";
                    $fieldsgroupinvite = wp_json_encode([
                        "to" => "/topics/pnfpbgroupinvite",
                        "registration_tokens" => [$bpdeviceid],
                    ]);
                    array_push($pnfpb_topic_requests, [
                        "url" => $urlgroupinvite,
                        "headers" => $headers,
                        "data" => $fieldsgroupinvite,
                        "type" => Requests::POST,
                    ]);
                }
            }

            /*** Group details update subscription for Firebase httpv1 push notification  ***/

            if (
                count($subscription_option_array) > 13 &&
                $subscription_option_array[13] === "1" &&
                ((count($old_subscription_option_array) > 13 &&
                    $subscription_option_array[13] !==
                        $old_subscription_option_array[13]) ||
                    count($old_subscription_option_array) <= 13 ||
                    $pnfpb_versionvalue !== "v5")
            ) {
                $urlgroupdetailsupdate =
                    "https://iid.googleapis.com/iid/v1:batchAdd";
                $fieldsgroupdetailsupdate = wp_json_encode([
                    "to" => "/topics/pnfpbgroupdetailsupdate",
                    "registration_tokens" => [$bpdeviceid],
                ]);
                array_push($pnfpb_topic_requests, [
                    "url" => $urlgroupdetailsupdate,
                    "headers" => $headers,
                    "data" => $fieldsgroupdetailsupdate,
                    "type" => Requests::POST,
                ]);
            } else {
                if (
                    ((count($subscription_option_array) > 13 &&
                        $subscription_option_array[13] === "0") ||
                        (count($subscription_option_array) > 8 &&
                            $subscription_option_array[8] === "1")) &&
                    $pushtype !== "checkdeviceid" &&
                    $pushtype !== "checkdeviceid" &&
                    ((count($old_subscription_option_array) > 13 &&
                        $subscription_option_array[13] !==
                            $old_subscription_option_array[13]) ||
                        count($old_subscription_option_array) <= 13 ||
                        $pnfpb_versionvalue !== "v5")
                ) {
                    $urlgroupdetailsupdate =
                        "https://iid.googleapis.com/iid/v1:batchRemove";
                    $fieldsgroupdetailsupdate = wp_json_encode([
                        "to" => "/topics/pnfpbgroupdetailsupdate",
                        "registration_tokens" => [$bpdeviceid],
                    ]);
                    array_push($pnfpb_topic_requests, [
                        "url" => $urlgroupdetailsupdate,
                        "headers" => $headers,
                        "data" => $fieldsgroupdetailsupdate,
                        "type" => Requests::POST,
                    ]);
                }
            }

            $args = [
                "public" => true,
                "_builtin" => false,
            ];

            /*** Custom post types subscription for Firebase httpv1 push notification  ***/

            $output = "names"; // or objects
            $operator = "and"; // 'and' or 'or'
            $custposttypes = get_post_types($args, $output, $operator);

            $custom_post_type_max_index = 6;

            $custom_post_type_index = 1;

            $custom_post_type_increment = 14;

            /*** Maximum 5 custom post types can be opted for Firebase httpv1 push notification  ***/

            foreach ($custposttypes as $post_type) {
                if (
                    get_option("pnfpb_ic_fcm_" . $post_type . "_enable") ===
                        "1" &&
                    $post_type !== "buddypress" &&
                    $post_type !== "post" &&
                    $custom_post_type_max_index >= $custom_post_type_index
                ) {
                    $pnfpb_custom_post_type_groupname =
                        "/topics/pnfpb" . $post_type;

                    if (
                        count($subscription_option_array) >
                            $custom_post_type_increment &&
                        $subscription_option_array[
                            $custom_post_type_increment
                        ] === "1" &&
                        ((count($old_subscription_option_array) >
                            $custom_post_type_increment &&
                            $subscription_option_array[
                                $custom_post_type_increment
                            ] !==
                                $old_subscription_option_array[
                                    $custom_post_type_increment
                                ]) ||
                            count($old_subscription_option_array) <=
                                $custom_post_type_increment)
                    ) {
                        $url = "https://iid.googleapis.com/iid/v1:batchAdd";
                        $fields = [
                            "to" => $pnfpb_custom_post_type_groupname,
                            "registration_tokens" => [$bpdeviceid],
                        ];
                        $body = wp_json_encode($fields);
                        array_push($pnfpb_topic_requests, [
                            "url" => $url,
                            "headers" => $headers,
                            "data" => $body,
                            "type" => Requests::POST,
                        ]);
                    } else {
                        if (
                            count($subscription_option_array) >
                                $custom_post_type_increment &&
                            $subscription_option_array[
                                $custom_post_type_increment
                            ] === "0" &&
                            $pushtype !== "checkdeviceid" &&
                            ((count($old_subscription_option_array) >
                                $custom_post_type_increment &&
                                $subscription_option_array[
                                    $custom_post_type_increment
                                ] !==
                                    $old_subscription_option_array[
                                        $custom_post_type_increment
                                    ]) ||
                                count($old_subscription_option_array) <=
                                    $custom_post_type_increment)
                        ) {
                            $url =
                                "https://iid.googleapis.com/iid/v1:batchRemove";
                            $fields = [
                                "to" => $pnfpb_custom_post_type_groupname,
                                "registration_tokens" => [$bpdeviceid],
                            ];
                            $body = wp_json_encode($fields);
                            array_push($pnfpb_topic_requests, [
                                "url" => $url,
                                "headers" => $headers,
                                "data" => $body,
                                "type" => Requests::POST,
                            ]);
                        }
                    }
                }

                $custom_post_type_increment++;
                $custom_post_type_index++;
            }

            $pnfpb_topic_subscriptions_request = Requests::request_multiple(
                $pnfpb_topic_requests, array("blocking" => false)
            );

            $deviceid_version_update_status = $wpdb->query(
                $wpdb->prepare(
                    "UPDATE %i SET firebase_version = %s WHERE device_id LIKE %s",
                    $table,
                    "v5",
                    "%" . $wpdb->esc_like($bpdeviceid) . "%"
                )
            );
        }
    }
}
?>
