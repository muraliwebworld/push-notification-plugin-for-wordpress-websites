<?php

/**
 * Insert subscription token received in rest api from Android app/Ios app for push notifications
 *
 * @since 1.36
 *
 */
global $wpdb;

$pnfpb_bpuserid = 0;

// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

/** Get instance of class to subscribe Firebase topics based on  subscription options **/
$PNFPB_Push_Notification_subscription_update_obj = new PNFPB_httpv1_subscription_option_update();

if (is_user_logged_in()) {
    $pnfpb_bpuserid = get_current_user_id();
}

$pnfpb_table = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

$pnfpb_dbname = $wpdb->dbname;

$pnfpb_response = [
    "status" => 200,
    "message" => "",
];

if (isset($pnfpb_request["userid"])) {
    $pnfpb_bpuserid = sanitize_text_field($pnfpb_request["userid"]);
}

if (
    !is_numeric($pnfpb_bpuserid) ||
    $pnfpb_bpuserid === null ||
    $pnfpb_bpuserid === "" ||
    $pnfpb_bpuserid === "0"
) {
    $pnfpb_bpuserid = 0;
}

$pnfpb_encryption_key = get_option("PNFPB_icfcm_integrate_app_secret_code");

$pnfpb_encrypted = sanitize_text_field($pnfpb_request["token"]);

$pnfpb_subscriptionoptions = "";

if (
    isset($pnfpb_request["subscriptionoptions"]) &&
    $pnfpb_request["subscriptionoptions"] !== ""
) {
    $pnfpb_subscriptionoptions = sanitize_text_field($pnfpb_request["subscriptionoptions"]);
    $pnfpb_subscriptionoptions = esc_html($pnfpb_subscriptionoptions);
}

$pnfpb_parts = explode(":", $pnfpb_encrypted);

$pnfpb_keynonce = $pnfpb_encryption_key;

// Decode AES-256-CBC encrypted data from mobile app to extract and store subscription token in WordPress database

// Don't forget to base64-decode the $iv before feeding it back to
//openssl_decrypt
//

$pnfpb_decrypted_cbc = openssl_decrypt(
    base64_decode($pnfpb_parts[0]),
    "aes-256-cbc",
    $pnfpb_keynonce,
    OPENSSL_RAW_DATA,
    base64_decode($pnfpb_parts[1])
);

$pnfpb_tagLength = 16;

$pnfpb_tag = substr(base64_decode($pnfpb_parts[0]), -16);

$pnfpb_ciphertext = substr(base64_decode($pnfpb_parts[0]), 0, -16);

$pnfpb_decrypted_gcm = openssl_decrypt(
    $pnfpb_ciphertext,
    "aes-256-gcm",
    $pnfpb_keynonce,
    OPENSSL_RAW_DATA,
    base64_decode($pnfpb_parts[1]),
    $pnfpb_tag
);

if (!$pnfpb_decrypted_gcm && !$pnfpb_decrypted_cbc) {
    error_log(" failed - invalid data ");

    $pnfpb_response = [
        "status" => 200,
        "message" => " failed - invalid data",
    ];

    $pnfpb_res = new WP_REST_Response($pnfpb_response);

    $pnfpb_res->set_status(200);

    return [
        "req" => $pnfpb_res,
        "tokenupdatestatus" =>
            " failed - invalid data " . $pnfpb_parts[0] . "-----***" . $pnfpb_parts[1],
    ];
} else {
    if (!$pnfpb_decrypted_cbc) {
        $pnfpb_decrypted = $pnfpb_decrypted_gcm;
    } else {
        $pnfpb_decrypted = $pnfpb_decrypted_cbc;
    }

    $pnfpb_key = hash("sha256", $pnfpb_encryption_key);

    $pnfpb_receivedhasmac = base64_decode($pnfpb_parts[2]);

    $pnfpb_bphasmac = hash_hmac("sha256", $pnfpb_decrypted, $pnfpb_encryption_key);

    if ($pnfpb_bphasmac !== $pnfpb_parts[3]) {
        error_log(" failed - invalid data/encryption");

        $pnfpb_response = [
            "status" => 200,
            "message" => " failed - invalid data/encryption",
        ];

        $pnfpb_res = new WP_REST_Response($pnfpb_response);

        $pnfpb_res->set_status(200);

        return [
            "req" => $pnfpb_res,
            "tokenupdatestatus" => " failed - invalid data/encryption ",
            'bphasmac' => $pnfpb_bphasmac,
            'receivedhasmac' => $pnfpb_parts[3],
            "decrypted" => $pnfpb_decrypted,
        ];
    }

    $pnfpb_table = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

    if ($pnfpb_request["subscription-type"] === "subscribe-group") {
        $pnfpb_deviceid_select_status = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM %i WHERE device_id LIKE %s",
                $pnfpb_table,
                "%" . $wpdb->esc_like($pnfpb_decrypted) . "%"
            )
        );

        $pnfpb_updatetokenresponse = "fail";

        foreach ($pnfpb_deviceid_select_status as $pnfpb_result) {
            $pnfpb_subscriptionoptions = $pnfpb_result->subscription_option;

            $pnfpb_bpuserid = $pnfpb_result->userid;
        }

        $pnfpb_bpcheckdeviceid =
            $pnfpb_decrypted .
            "!!" .
            sanitize_text_field($pnfpb_request["groupid"]) .
            "!!" .
            sanitize_text_field($pnfpb_request["cookievalue"]) .
            "!!webview";

        $pnfpb_deviceid_check_status = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM %i WHERE device_id LIKE %s",
                $pnfpb_table,
                "%" . $wpdb->esc_like($pnfpb_bpcheckdeviceid) . "%"
            )
        );

        if (count($pnfpb_deviceid_check_status) > 0) {
            foreach ($pnfpb_deviceid_select_status as $pnfpb_result) {
                if ($pnfpb_bpuserid !== 0) {
                    $pnfpb_deviceid_update_status = $wpdb->query(
                        $wpdb->prepare(
                            "UPDATE %i SET userid = %d WHERE device_id = %s AND device_id LIKE %s",
                            $pnfpb_table,
                            $pnfpb_bpuserid,
                            $pnfpb_bpcheckdeviceid,
                            "%" . $wpdb->esc_like("webview") . "%"
                        )
                    );
                }
            }

            $pnfpb_version_values = $wpdb->get_col(
                $wpdb->prepare(
                    "SELECT firebase_version FROM %i WHERE device_id = %s",
                    $pnfpb_table,
                    $pnfpb_bpcheckdeviceid
                )
            );

            $pnfpb_version_value = "L";

            foreach ($pnfpb_version_values as $pnfpb_value) {
                $pnfpb_version_value = $pnfpb_value;
            }

            if (
                $pnfpb_version_value !== "httpv3" &&
                $pnfpb_version_value !== "httpv4" &&
                get_option("pnfpb_httpv1_push") === "1"
            ) {
                $pnfpb_group_name =
                    "pnfpbgroupid" . sanitize_text_field($pnfpb_request["groupid"]);
                $pnfpb_client = new Google_Client();
                // Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
                $pnfpb_client->useApplicationDefaultCredentials();

                // Alternatively, provide the JSON authentication file directly.
                $pnfpb_configArray = json_decode(
                    get_option("pnfpb_sa_json_data"),
                    true
                );
                $pnfpb_client->setAuthConfig($pnfpb_configArray);

                // Add the scope as a string (multiple scopes can be provided as an array)
                $pnfpb_client->addScope(
                    "https://www.googleapis.com/auth/firebase.messaging"
                );
                $pnfpb_client->refreshTokenWithAssertion();
                $pnfpb_fbauth_token_array = $pnfpb_client->getAccessToken();
                $pnfpb_fbauth_token = $pnfpb_fbauth_token_array["access_token"];

                $pnfpb_url = "https://iid.googleapis.com/iid/v1:batchAdd";

                $pnfpb_headers = [
                    "Authorization" => "Bearer " . $pnfpb_fbauth_token,
                    "Content-Type" => "application/json",
                    "access_token_auth" => "true",
                ];
                $pnfpb_grouptopic = "/topics/" . $pnfpb_group_name;
                $pnfpb_fields = [
                    "to" => $pnfpb_grouptopic,
                    "registration_tokens" => [$pnfpb_decrypted],
                ];

                $pnfpb_body = wp_json_encode($pnfpb_fields);

                $pnfpb_args = [
                    "httpversion" => "1.0",
                    "blocking" => true,
                    "sslverify" => false,
                    "body" => $pnfpb_body,
                    "headers" => $pnfpb_headers,
                ];

                $pnfpb_apiresults = wp_remote_post($pnfpb_url, $pnfpb_args);

                $pnfpb_apibody = wp_remote_retrieve_body($pnfpb_apiresults);

                $pnfpb_bodyresults = json_decode($pnfpb_apibody, true);

                $pnfpb_deviceid_version_update_status = $wpdb->query(
                    $wpdb->prepare(
                        "UPDATE %i SET firebase_version = %s WHERE device_id = %s",
                        $pnfpb_table,
                        "httpv4",
                        $pnfpb_bpcheckdeviceid
                    )
                );
            }

            $pnfpb_updatetokenresponse = "duplicate";
        } else {
            $pnfpb_bpnewdeviceid =
                $pnfpb_decrypted .
                "!!" .
                sanitize_text_field($pnfpb_request["groupid"]) .
                "!!" .
                sanitize_text_field($pnfpb_request["cookievalue"]) .
                "!!webview";

            $pnfpb_data = [
                "userid" => $pnfpb_bpuserid,
                "device_id" => $pnfpb_bpnewdeviceid,
                "subscription_option" => $pnfpb_subscriptionoptions,
                "firebase_version" => "httpv4",
            ];

            $pnfpb_insertstatus = $wpdb->insert($pnfpb_table, $pnfpb_data);

            if (get_option("pnfpb_httpv1_push") === "1") {
                $pnfpb_group_name = "pnfpbgroupid" . $pnfpb_request["groupid"];

                $pnfpb_client = new Google_Client();
                // Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
                $pnfpb_client->useApplicationDefaultCredentials();

                // Alternatively, provide the JSON authentication file directly.
                $pnfpb_configArray = json_decode(
                    get_option("pnfpb_sa_json_data"),
                    true
                );
                $pnfpb_client->setAuthConfig($pnfpb_configArray);

                // Add the scope as a string (multiple scopes can be provided as an array)
                $pnfpb_client->addScope(
                    "https://www.googleapis.com/auth/firebase.messaging"
                );
                $pnfpb_client->refreshTokenWithAssertion();
                $pnfpb_fbauth_token_array = $pnfpb_client->getAccessToken();
                $pnfpb_fbauth_token = $pnfpb_fbauth_token_array["access_token"];

                $pnfpb_url = "https://iid.googleapis.com/iid/v1:batchAdd";

                $pnfpb_headers = [
                    "Authorization" => "Bearer " . $pnfpb_fbauth_token,
                    "Content-Type" => "application/json",
                    "access_token_auth" => "true",
                ];

                $pnfpb_grouptopic = "/topics/" . $pnfpb_group_name;

                $pnfpb_fields = [
                    "to" => $pnfpb_grouptopic,
                    "registration_tokens" => [$pnfpb_decrypted],
                ];

                $pnfpb_body = wp_json_encode($pnfpb_fields);

                $pnfpb_args = [
                    "httpversion" => "1.0",
                    "blocking" => true,
                    "sslverify" => false,
                    "body" => $pnfpb_body,
                    "headers" => $pnfpb_headers,
                ];

                $pnfpb_apiresults = wp_remote_post($pnfpb_url, $pnfpb_args);
                $pnfpb_apibody = wp_remote_retrieve_body($pnfpb_apiresults);
                $pnfpb_bodyresults = json_decode($pnfpb_apibody, true);
            }

            if (!$pnfpb_insertstatus || $pnfpb_insertstatus !== 0) {
                $pnfpb_updatetokenresponse =
                    "subscribed" .
                    $pnfpb_insertstatus .
                    count($pnfpb_deviceid_select_status);
            }
        }
    } else {
        if ($pnfpb_request["subscription-type"] === "unsubscribe-group") {
            $pnfpb_bpolddeviceid =
                $pnfpb_decrypted .
                "!!" .
                sanitize_text_field($pnfpb_request["groupid"]) .
                "!!" .
                sanitize_text_field($pnfpb_request["cookievalue"]) .
                "!!webview";

            $pnfpb_deviceid_update_status = $wpdb->query(
                $wpdb->prepare(
                    "DELETE from %i WHERE device_id = %s",
                    $pnfpb_table,
                    $pnfpb_bpolddeviceid
                )
            );

            if (get_option("pnfpb_httpv1_push") === "1") {
                $pnfpb_group_name = "pnfpbgroupid" . $pnfpb_request["groupid"];

                $pnfpb_client = new Google_Client();
                // Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
                $pnfpb_client->useApplicationDefaultCredentials();

                // Alternatively, provide the JSON authentication file directly.
                $pnfpb_configArray = json_decode(
                    get_option("pnfpb_sa_json_data"),
                    true
                );
                $pnfpb_client->setAuthConfig($pnfpb_configArray);

                // Add the scope as a string (multiple scopes can be provided as an array)
                $pnfpb_client->addScope(
                    "https://www.googleapis.com/auth/firebase.messaging"
                );
                $pnfpb_client->refreshTokenWithAssertion();
                $pnfpb_fbauth_token_array = $pnfpb_client->getAccessToken();
                $pnfpb_fbauth_token = $pnfpb_fbauth_token_array["access_token"];

                $pnfpb_url = "https://iid.googleapis.com/iid/v1:batchRemove";

                $pnfpb_headers = [
                    "Authorization" => "Bearer " . $pnfpb_fbauth_token,
                    "Content-Type" => "application/json",
                    "access_token_auth" => "true",
                ];

                $pnfpb_grouptopic = "/topics/" . $pnfpb_group_name;

                $pnfpb_fields = [
                    "to" => $pnfpb_grouptopic,
                    "registration_tokens" => [$pnfpb_decrypted],
                ];

                $pnfpb_body = wp_json_encode($pnfpb_fields);

                $pnfpb_args = [
                    "httpversion" => "1.0",
                    "blocking" => true,
                    "sslverify" => false,
                    "body" => $pnfpb_body,
                    "headers" => $pnfpb_headers,
                ];

                $pnfpb_apiresults = wp_remote_post($pnfpb_url, $pnfpb_args);
                $pnfpb_apibody = wp_remote_retrieve_body($pnfpb_apiresults);
                $pnfpb_bodyresults = json_decode($pnfpb_apibody, true);
            }
        } else {
            $pnfpb_deviceid = $pnfpb_decrypted;

            $pnfpb_deviceidinsert = $pnfpb_decrypted . "!!webview";

            $pnfpb_data = [
                "userid" => $pnfpb_bpuserid,
                "device_id" => $pnfpb_deviceidinsert,
                "subscription_option" => $pnfpb_subscriptionoptions,
            ];

            $pnfpb_deviceid_select_status = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT * FROM %i WHERE device_id LIKE %s AND device_id LIKE %s",
                    $pnfpb_table,
                    "%" . $wpdb->esc_like($pnfpb_deviceid) . "%",
                    "%" . $wpdb->esc_like("webview") . "%"
                )
            );

            $pnfpb_updatetokenresponse = "fail";

            foreach ($pnfpb_deviceid_select_status as $pnfpb_result) {
                if ($pnfpb_bpuserid !== 0) {
                    $pnfpb_deviceid_update_status = $wpdb->query(
                        $wpdb->prepare(
                            "UPDATE %i SET userid = %d WHERE device_id LIKE %s AND device_id LIKE %s",
                            $pnfpb_table,
                            $pnfpb_bpuserid,
                            "%" . $wpdb->esc_like($pnfpb_deviceid) . "%",
                            "%" . $wpdb->esc_like("webview") . "%"
                        )
                    );
                }

                $pnfpb_old_subscription_option = $pnfpb_result->subscription_option;

                if ($pnfpb_result->subscription_option == "") {
                    $pnfpb_deviceid_update_status = $wpdb->query(
                        $wpdb->prepare(
                            "UPDATE %i SET subscription_option = %s WHERE device_id LIKE %s AND device_id LIKE %s",
                            $pnfpb_table,
                            "10000000000000",
                            "%" . $wpdb->esc_like($pnfpb_deviceid) . "%",
                            "%" . $wpdb->esc_like("webview") . "%"
                        )
                    );

                    $pnfpb_old_subscription_option = "10000000000000";
                } else {
                    if (
                        $pnfpb_subscriptionoptions !== "" &&
                        $pnfpb_subscriptionoptions !== "10000000000000" &&
                        is_numeric($pnfpb_subscriptionoptions)
                    ) {
                        $pnfpb_deviceid_update_status = $wpdb->query(
                            $wpdb->prepare(
                                "UPDATE %i SET subscription_option = %s WHERE device_id LIKE %s AND device_id LIKE %s",
                                $pnfpb_table,
                                $pnfpb_subscriptionoptions,
                                "%" . $wpdb->esc_like($pnfpb_deviceid) . "%",
                                "%" . $wpdb->esc_like("webview") . "%"
                            )
                        );
                    }
                }
            }

            if (
                $pnfpb_deviceid_select_status != null &&
                count($pnfpb_deviceid_select_status) > 0
            ) {
                $pnfpb_version_values = $wpdb->get_col(
                    $wpdb->prepare(
                        "SELECT firebase_version FROM %i WHERE device_id = %s",
                        $pnfpb_table,
                        $pnfpb_deviceid
                    )
                );

                $pnfpb_version_value = "L";

                foreach ($pnfpb_version_values as $pnfpb_value) {
                    $pnfpb_version_value = $pnfpb_value;
                }

                $pnfpb_subscription_option_array = [];

                if ($pnfpb_subscriptionoptions != "") {
                    $pnfpb_subscription_option_array = str_split(
                        $pnfpb_subscriptionoptions
                    );
                }

                $pnfpb_updatetokenresponse = "duplicate";
            } else {
                $pnfpb_insertstatus = $wpdb->insert($pnfpb_table, $pnfpb_data);

                if (!$pnfpb_insertstatus || $pnfpb_insertstatus !== 0) {
                    $pnfpb_updatetokenresponse =
                        "subscribed" .
                        $pnfpb_insertstatus .
                        count($pnfpb_deviceid_select_status);
                }

                $pnfpb_subscription_option_array = [];

                if ($pnfpb_subscriptionoptions != "") {
                    $pnfpb_subscription_option_array = str_split(
                        $pnfpb_subscriptionoptions
                    );
                }

                if (
                    get_option("pnfpb_httpv1_push") === "1" &&
                    $pnfpb_subscriptionoptions !== "" &&
                    (count($pnfpb_subscription_option_array) > 0 &&
                        $pnfpb_subscription_option_array[0] !== "1")
                ) {
                    $PNFPB_Push_Notification_subscription_update_obj->PNFPB_httpv1_multiple_subscription_option_update(
                        $pnfpb_subscriptionoptions,
                        $pnfpb_deviceid,
                        ""
                    );
                } else {
                    $PNFPB_Push_Notification_subscription_update_obj->PNFPB_httpv1_default_subscription_option_update(
                        $pnfpb_deviceid
                    );
                }
            }
        }
    }

    $pnfpb_response = [
        "status" => 200,
        "message" => $pnfpb_updatetokenresponse,
    ];

    $pnfpb_res = new WP_REST_Response($pnfpb_response);

    $pnfpb_res->set_status(200);

    return ["req" => $pnfpb_res, "tokenupdatestatus" => $pnfpb_updatetokenresponse];
}

?>
