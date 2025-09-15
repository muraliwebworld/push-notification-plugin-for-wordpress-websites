<?php
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery
// 
if (!class_exists("PNFPB_web_push_notification_class")) {
	
    class PNFPB_web_push_notification_class
    {
		public function PNFPB_web_push_notification(
            $pushid = 0,
            $pushtitle = "",
            $pushcontent = "",
            $pushicon = "",
            $pushimageurl = "",
            $pushclickurl = "",
            $pushextradata = "",
            $subscription_array = [],
            $senderid = 0,
            $receiverid = 0,
            $pushtype = "",
            $grouppush = "",
            $groupid = 0
        ) {

			global $wpdb;
			$webpush_option = get_option("pnfpb_webpush_push");
			$webpush_firebase = get_option("pnfpb_webpush_push_firebase");
			$webpush_vapid = '';
			
			if ($webpush_option === '1' || $webpush_firebase === '1') {			
				$renotify = false;
				if (
					get_option("pnfpb_ic_fcm_renotify_notification") &&
					get_option("pnfpb_ic_fcm_renotify_notification") === "1"
				) {
					$renotify = true;
				}
				$pnfpb_tag = "";
				if (
					get_option("pnfpb_ic_fcm_replace_notifications") &&
					get_option("pnfpb_ic_fcm_replace_notifications") === "1"
				) {
					$pnfpb_tag = "PNFPB_webpush";
				}
				$token = wp_get_session_token();
				$i     = wp_nonce_tick();
				$notification_token = substr( wp_hash( $i . '|' . $token, 'nonce' ), -12, 10 );
				$pushtimestamp = strval(time());

				$web_push_data = [
					"notification" => [
						"title" => trim($pushtitle),
						"body" => $pushcontent,
						"image" => $pushimageurl,
						"icon" => $pushicon,
						"click_action" => $pushclickurl,
						"action" => [
							["action" => "close_notification", "title" => "Dismiss"],
							["action" => "read_more", "title" => "Read More"],
						],
						"tag" => $pnfpb_tag,
						"renotify" => $renotify,
					],
					"data" => [
						"url" => $pushclickurl,
						"notification_id" => $pushtimestamp,
						"notification_auth_token" => $notification_token
					],
				];
				$web_notifications = [];
				foreach ($subscription_array as $pnfpb_subscription) {
					// array of notifications
					$web_notifications[] = 
						[
							// current PushSubscription format (browsers might change this in the future)
							'subscription' => Subscription::create($pnfpb_subscription),
							'payload' => wp_json_encode($web_push_data),
						];
				}
				
				// Your VAPID details
				$vapidPublickey = get_option("pnfpb_web_push_vapid_public_key");
				$vapidPrivatekey = get_option("pnfpb_web_push_vapid_private_key");
				
				if ($webpush_option === '2') {
					$vapidPublickey = get_option("pnfpb_webpush_firebase_public_key");
					$vapidPrivatekey = get_option("pnfpb_webpush_firebase_private_key");					
				}
				
				$auth = [
					'VAPID' => [
						'subject' => home_url(), // or your website URL
						'publicKey' => $vapidPublickey,
						'privateKey' => $vapidPrivatekey,
					],
				];
				$webPush = new WebPush($auth);
				foreach ($web_notifications as $web_notification) {
					$report = $webPush->queueNotification(
						$web_notification['subscription'],
						$web_notification['payload'], // optional (defaults null)
					);
				}
				// Send all queued notifications
				foreach ($webPush->flush() as $report) {
					$endpoint = $report->getRequest()->getUri()->__toString();
					/*if ($report->isSuccess()) {
													
					} else {
						error_log( "[x] Message failed to send to {$endpoint}: {$report->getReason()}\n");
					}*/
				}
				$total_statistics_table_name =	$wpdb->prefix . "pnfpb_ic_total_statistics_notifications";
				$data = array('notificationid' => $pushtimestamp, 'notification_auth_token' => $notification_token, 'title' => $pushtitle, 'content' => $pushcontent, 'total_delivery_confirmation' => 0, 'total_open_confirmation' => 0);
				$insertstatus = $wpdb->insert($total_statistics_table_name, $data);				
			}
		}
	}
}

?>