<?php

/** Firebase Legacy api send push notification routine
 *
 * @since 1.65 version
 */

global $wpdb;

// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

$apiaccesskey = get_option("pnfpb_ic_fcm_google_api");

$url = "https://fcm.googleapis.com/fcm/send";

if ($senderid > 0) {
    $avataricon = bp_core_fetch_avatar([
        "item_id" => $senderid, // output user id of post author
        "type" => "full",
        "no_grav" => false,
        "html" => false, // FALSE = return url, TRUE (default) = return url wrapped with html
    ]);
} else {
    $avataricon = "";
}

if ($avataricon) {
    $pushicon = $avataricon;
}

if (
    $pushtype === "privatemessages" ||
    $pushtype === "friendshiprequest" ||
    $pushtype === "friendshipaccepted"
) {
    $table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

    $deviceidswebviewcheck = $wpdb->get_col(
        $wpdb->prepare(
            "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM %i WHERE device_id LIKE %s AND device_id NOT LIKE %s AND userid = %d ORDER BY id DESC LIMIT 1000",
            $table_name,
            "%webview%",
            "%@N%",
            $receiverid
        )
    );

    if (count($deviceidswebviewcheck) > 0) {
        $pushclickurl = "";
    }
}

if (count($target_device_ids) > 0) {
    $regid = $target_device_ids;
    // prepare the message
    $message = [
        "title" => trim($pushtitle),
        "body" => mb_substr(
            stripslashes(wp_strip_all_tags(urldecode(trim($pushcontent)))),
            0,
            130,
            "UTF-8"
        ),
        "icon" => $pushicon,
        "image" => $pushimageurl,
        "click_action" => $pushclickurl,
        "tag" => "PNFPB_webpush",
    ];

    if (count($pushextradata) > 0) {
        $fields = [
            "registration_ids" => $target_device_ids,
            "notification" => $message,
            "data" => $pushextradata,
        ];
    } else {
        $fields = [
            "registration_ids" => $target_device_ids,
            "notification" => $message,
        ];
    }

    $headers = [
        "Authorization" => "key=" . $apiaccesskey,
        "Content-Type" => "application/json",
    ];

    $body = wp_json_encode($fields);

    $args = [
        "httpversion" => "1.0",
        "blocking" => true,
        "sslverify" => false,
        "body" => $body,
        "headers" => $headers,
    ];

    $table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

    $apiresults = wp_remote_post($url, $args);

    $apibody = wp_remote_retrieve_body($apiresults);

    $bodyresults = json_decode($apibody, true);

    if (is_array($bodyresults)) {
        if (array_key_exists("results", $bodyresults)) {
            foreach ($bodyresults["results"] as $idx => $result) {
                if (array_key_exists("error", $result)) {
                    if (
                        ($result["error"] === "NotRegistered" ||
                            $result["error"] === "InvalidRegistration") &&
                        strpos($target_device_ids[$idx], "!!") === false
                    ) {
                        $deviceid_delete_status = $wpdb->query(
                            $wpdb->prepare(
                                "DELETE from %i WHERE device_id = %s",
                                $table_name,
                                $target_device_ids[$idx]
                            )
                        );
                    }
                }
            }
        }
    }

    if (is_wp_error($apiresults)) {
        $status = $apiresults->get_error_code(); // custom code for WP_ERROR
        $error_message = $apiresults->get_error_message();
        //error_log('There was a '.$status.' error in push notification: '.$error_message);
    }
}

if (count($deviceidswebview) > 0) {
    $regid = $deviceidswebview;

    $message = [
        "title" => trim($pushtitle),
        "body" => mb_substr(
            stripslashes(wp_strip_all_tags(urldecode(trim($pushcontent)))),
            0,
            130,
            "UTF-8"
        ),
        "icon" => $pushicon,
        "image" => $pushimageurl,
        "tag" => "PNFPB_webpush",
    ];

    if (count($pushextradata) > 0) {
        $fields = [
            "registration_ids" => $deviceidswebview,
            "notification" => $message,
            "data" => $pushextradata,
        ];
    } else {
        $fields = [
            "registration_ids" => $deviceidswebview,
            "notification" => $message,
        ];
    }

    $headers = [
        "Authorization" => "key=" . $apiaccesskey,
        "Content-Type" => "application/json",
    ];

    $body = wp_json_encode($fields);

    $args = [
        "httpversion" => "1.0",
        "blocking" => true,
        "sslverify" => false,
        "body" => $body,
        "headers" => $headers,
    ];

    $table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";

    $apiresults = wp_remote_post($url, $args);

    $apibody = wp_remote_retrieve_body($apiresults);

    $bodyresults = json_decode($apibody, true);

    if (is_array($bodyresults)) {
        if (array_key_exists("results", $bodyresults)) {
            foreach ($bodyresults["results"] as $idx => $result) {
                if (array_key_exists("error", $result)) {
                    if (
                        $result["error"] === "NotRegistered" ||
                        $result["error"] === "InvalidRegistration"
                    ) {
                        $deviceid_delete_status = $wpdb->query(
                            $wpdb->prepare(
                                "DELETE from %i WHERE device_id LIKE %s",
                                $table_name,
                                "%" . $deviceidswebview[$idx] . "%"
                            )
                        );
                    }
                }
            }
        }
    }

    if (is_wp_error($apiresults)) {
        $status = $apiresults->get_error_code();
        $error_message = $apiresults->get_error_message();
        //error_log('There was a '.$status.' error in push notification: '.$error_message);
    }
}
?>
