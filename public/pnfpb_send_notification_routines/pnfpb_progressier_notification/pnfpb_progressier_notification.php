<?php

/** Progressier push notification API
 *
 * @since 1.97 version
 *
 */

global $wpdb;

// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

$apiaccesskey = get_option("pnfpb_ic_fcm_progressier_api_key");

$progressier_app_id = get_option("pnfpb_ic_pwa_thirdparty_app_id");

$url = "https://progressier.app/" . $progressier_app_id . "/send";

$recipients = json_decode('{"users":"all"}');

$pushcontent = mb_substr(
    stripslashes(
        wp_strip_all_tags(
            urldecode(trim(htmlspecialchars_decode($pushcontent)))
        )
    ),
    0,
    130,
    "UTF-8"
);

$pushcontent = preg_replace("/\r|\n/", " ", $pushcontent);

$pushimageurl = str_replace("&#038;", "&", $pushimageurl);

if (
    $pushtype === "privatemessages" ||
    $pushtype === "friendshiprequest" ||
    $pushtype === "friendshipaccepted"
) {
    if ($target_user_id !== 0 && $target_user_id !== "") {
        $recipients = json_decode('{"id": "' . $target_user_id . '"}');

        $fields = [
            "recipients" => $recipients,
            "title" => trim($pushtitle),
            "body" => $pushcontent,
            "icon" => $pushimageurl,
            "image" => $pushimageurl,
            "url" => $pushlink,
        ];

        $headers = [
            "Authorization" => "Bearer " . $apiaccesskey,
            "Content-Type" => "application/json",
        ];

        $body = wp_json_encode($fields);

        $args = [
            "httpversion" => "1.0",
            "blocking" => true,
            "sslverify" => true,
            "body" => $body,
            "headers" => $headers,
        ];

        $apiresults = wp_remote_post($url, $args);

        $apibody = wp_remote_retrieve_body($apiresults);
    }
} else {
    if (count($target_user_id_array) > 0) {
        $json_user_ids = '{"id":"';

        $json_user_ids_data = "";

        $pnfpb_next_record = "";

        for ($i = 0; $i < count($target_user_id_array); $i++) {
            $json_user_ids .= $pnfpb_next_record . $target_user_id_array[$i];

            $pnfpb_next_record = ",";
        }

        $json_user_ids .= '"}';

        $recipients = json_decode($json_user_ids);
    }

    $fields = [
        "recipients" => $recipients,
        "title" => trim($pushtitle),
        "body" => $pushcontent,
        "icon" => $pushimageurl,
        "image" => $pushimageurl,
        "url" => $pushlink,
    ];

    $headers = [
        "Authorization" => "Bearer " . $apiaccesskey,
        "Content-Type" => "application/json",
    ];

    $body = wp_json_encode($fields);

    $args = [
        "httpversion" => "1.0",
        "blocking" => true,
        "sslverify" => true,
        "body" => $body,
        "headers" => $headers,
    ];

    $apiresults = wp_remote_post($url, $args);

    $apibody = wp_remote_retrieve_body($apiresults);
}

?>