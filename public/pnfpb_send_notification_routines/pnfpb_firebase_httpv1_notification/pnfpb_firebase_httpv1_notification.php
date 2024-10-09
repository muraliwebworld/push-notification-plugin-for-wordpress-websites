<?php

		/** Firebase httpv1 api send push notification routine
		* 
		* @since 1.65 version
		* 
		* Send notification to all users and also to users who are subscribed to following notifications
		*
		* Post, custom post types, activities, group activities, comments, new memeber joined
		* Group invite, group update, avatar change, cover image change
		*/			
			
			global $wpdb;
			
	
			$pnfpb_firebase_project = get_option( 'pnfpb_ic_fcm_projectid' );
			
			
			$url = "https://fcm.googleapis.com/v1/projects/{$pnfpb_firebase_project}/messages:send";
			
			if ($senderid > 0) {
				$pushicon =	bp_core_fetch_avatar ( 
    				array('item_id'   => $senderid,  // output user id of post author
            			'type'      => 'full',
            			'html'      => FALSE    // FALSE = return url, TRUE (default) = return url wrapped with html
   					 	) 
				);
			}			

			
			if (($pushtype === 'privatemessages' || $pushtype === 'friendshiprequest' || $pushtype === 'friendshipaccepted' || $pushtype === 'mycomments') && count($target_device_ids) > 0 ) {
				
					$table_name = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
			
					$deviceidswebviewcheck=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%' AND userid = '{$receiverid}' ORDER BY id DESC LIMIT 1000"  );
				
					if (count($deviceidswebviewcheck) > 0) {
					
						$pushclickurl = '';
					
					}
			}
			
			$pushcontent = mb_substr(stripslashes(strip_tags(urldecode(trim(htmlspecialchars_decode($pushcontent))))),0,130, 'UTF-8');
			
			$pushcontent = preg_replace("/\r|\n/", " ",$pushcontent);

			$pushicon = str_replace( '&#038;', '&', $pushicon );

			$pushimageurl = str_replace( '&#038;', '&', $pushimageurl );

			// prepare the message
			$message = array( 
				'title'     => trim($pushtitle),
				'body'      => $pushcontent,
				'image'		=> $pushimageurl,
			);
			
			$renotify = false;
			
			if (get_option('pnfpb_ic_fcm_renotify_notification') && get_option('pnfpb_ic_fcm_renotify_notification') === '1') {
				
				$renotify = true;
				
			}
			
			$pnfpb_tag = '';
			
			if (get_option('pnfpb_ic_fcm_replace_notifications') && get_option('pnfpb_ic_fcm_replace_notifications') === '1') {
				
				$pnfpb_tag = 'PNFPB_webpush';
				
			}

			$pushdataarray = array();
					
			$androidarray = array(
				"title" => trim($pushtitle),
  				"body" => $pushcontent,
  				"click_action" => "FLUTTER_NOTIFICATION_CLICK",
				'image'		=> $pushimageurl,
			);
					
			if (is_array($pushextradata) && array_key_exists("click_url",$pushextradata)) {
						
				$pushdataarray = array_merge($androidarray,$pushextradata);
						
			} else {
				
				$pushdataarray = array_merge($androidarray,$pushdataarray);
			} 

			$webpushoptions = array (
				'notification' => array(
					'title'     => trim($pushtitle),
					'body'      => $pushcontent,
					'image'		=> $pushimageurl,
					'icon'		=> $pushicon,
					'link' 		=> $pushclickurl,
					'action'	=> [['action'=> "close_notification",'title'=> "Dismiss"],['action' => "read_more",'title' => "Read More"]],					
					'tag'		=> $pnfpb_tag,
					'renotify'	=> $renotify
				 ),
				'fcm_options' => array (
					'link' => $pushclickurl
				)
			);
			
			$androidoptions = array(
				"notification" => array(
					"title" => trim($pushtitle),
  					"body" => $pushcontent,
  					"click_action" => $pushclickurl,
					'image'		=> $pushimageurl,
					'tag'		=> $pnfpb_tag
				)
			);
			

   			$iosoptions = array(
      			"payload" => array(				
					"aps" => array(
      					"alert" => array(
        					"title" => trim($pushtitle),
         					"body" => $pushcontent,
      					),
						"badge" => 0,
      				)
				),
				'fcm_options' => array (
					"image" => $pushimageurl
				)				
			);

			$topic = 'pnfpbgeneral';



			if ($pushtype === 'privatemessages' || $pushtype === 'friendshiprequest' || $pushtype === 'friendshipaccepted' || $pushtype === 'mycomments') {
				
				if ($receiverid > 0 && count($target_device_ids) > 0) {
					
					$client = new Google_Client();
			
					// Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
					// 
					$client->useApplicationDefaultCredentials(); 
							
					// Alternatively, provide the JSON authentication file directly.
					$configArray = json_decode(get_option('pnfpb_sa_json_data'),true);
					$client->setAuthConfig($configArray);
							
					// Add the scope as a string (multiple scopes can be provided as an array)
					$client->addScope('https://www.googleapis.com/auth/firebase.messaging');
					
					$client->refreshTokenWithAssertion();
					$pnfpb_fbauth_token_array = $client->getAccessToken();
					$pnfpb_fbauth_token = $pnfpb_fbauth_token_array['access_token'];						
					
					$headers = array( 
						'Authorization' => 'Bearer '.$pnfpb_fbauth_token, 
						'Content-Type' => 'application/json'
					);
					
					
					for ($i=0;$i<count($target_device_ids);$i++) {
						
						$notification = array (
							'token' => $target_device_ids[$i],
							'notification' => $message,
							'data'	=> $pushdataarray,
							'webpush' => $webpushoptions,
							'android' => $androidoptions,
							'apns'	  => $iosoptions
						);
						
						$fields = array( 
	           			 'message' => $notification,
						);
						
						$body = json_encode($fields);
						

						$args = array(
			   				'httpversion' => '1.0',
							'blocking' => true,
							'sslverify' => false,
							'body' => $body,
							'headers' => $headers
						);
			
						$table_name = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
			
						$apiresults = wp_remote_post($url, $args);
		
					}
				}
			}
			else 
			{
				
					$client = new Google_Client();
			
					// Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
					// 
					$client->useApplicationDefaultCredentials(); 
							
					// Alternatively, provide the JSON authentication file directly.
					$configArray = json_decode(get_option('pnfpb_sa_json_data'),true);
					$client->setAuthConfig($configArray);
							
					// Add the scope as a string (multiple scopes can be provided as an array)
					$client->addScope('https://www.googleapis.com/auth/firebase.messaging');
					$client->refreshTokenWithAssertion();
					$pnfpb_fbauth_token_array = $client->getAccessToken();
					$pnfpb_fbauth_token = $pnfpb_fbauth_token_array['access_token'];				
					
					$headers = array( 
						'Authorization' => 'Bearer '.$pnfpb_fbauth_token, 
						'Content-Type' => 'application/json'
					);				
				
				if ($pushtype !== 'ondemand') {
					
					$topic = 'pnfpbgeneral';
				
					if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
					
						$topic = "pnfpbgeneralloggedin";
						
					} 
				
					if ($grouppush === 'yes') {
				
						$group_name = 'pnfpbgroupid'.$groupid;

						$topic = $group_name;
					}
				
					$notification = array (
						'topic' => $topic,
						'notification' => $message,
						'data'	=> $pushdataarray,
						'webpush' => $webpushoptions,
						'android' => $androidoptions,
						'apns'	  => $iosoptions
					);
				
					$fields = array( 
	            		'message' => $notification,
					);
					
				
					/** Send notification to users subscribed to all notifications, BuddyPress group activities */

					$body = json_encode($fields);
				
					$args = array(
			    		'httpversion' => '1.0',
						'blocking' => true,
						'sslverify' => false,
						'body' => $body,
						'headers' => $headers
					);
			
					$apiresults = wp_remote_post($url, $args);
					
				}
				
				/** Send notification only to particular users who are subscribed to like BuddyPress all activities, comments, 
				 * group invite, group update, new member joined, avatar change, cover image change
				 **/
				
				if ($pushtype !== '' && $pushtype !== 'groupactivity' && ((get_option('pnfpb_custom_prompt_options_on_off') !== '1' && get_option('pnfpb_bell_icon_prompt_options_on_off') !== '1' && get_option('pnfpb_ic_fcm_frontend_enable_subscription') !== '1' && get_option('pnfpb_shortcode_enable') !== 'yes' && $pushtype === 'ondemand') || (get_option('pnfpb_custom_prompt_options_on_off') === '1' || get_option('pnfpb_bell_icon_prompt_options_on_off') === '1' || get_option('pnfpb_ic_fcm_frontend_enable_subscription') === '1' || get_option('pnfpb_shortcode_enable') === 'yes'))) {
					
					$topic = 'pnfpb'.$pushtype;
					
					$notification = array (
						'topic' => $topic,
						'notification' => $message,
						'data'	=> $pushdataarray,
						'webpush' => $webpushoptions,
						'android' => $androidoptions,
						'apns'	  => $iosoptions
					);
				
					$fields = array( 
	            		'message' => $notification,
					);
					

					$body = json_encode($fields);
				
					$args = array(
			    		'httpversion' => '1.0',
						'blocking' => true,
						'sslverify' => false,
						'body' => $body,
						'headers' => $headers
					);
					
					$apiresults = wp_remote_post($url, $args);
					
				}

			
			}


?>