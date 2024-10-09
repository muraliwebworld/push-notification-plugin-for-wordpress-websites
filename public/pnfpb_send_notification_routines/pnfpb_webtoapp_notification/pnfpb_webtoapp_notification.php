<?php

		/** Webtoapp push notification API
		 * 
		 * @since 1.99 version
		 * 
		 */

			global $wpdb;
			
			$apiaccesskey = get_option('pnfpb_ic_fcm_webtoapp_api_key');
			
			$url = 'https://webtoapp.design/api/global_push_notifications?key='.$apiaccesskey;
			
			$pushcontent = mb_substr(stripslashes(strip_tags(urldecode(trim(htmlspecialchars_decode($pushcontent))))),0,130, 'UTF-8');
			
			$pushcontent = preg_replace("/\r|\n/", " ",$pushcontent);

			$pushimageurl = str_replace( '&#038;', '&', $pushimageurl );

			if (substr($pushimageurl,0,2) === '//') {

				$pushimageurl = str_replace( '//', 'https://', $pushimageurl );
				
			}

			
			if ($pushtype === 'privatemessages' || $pushtype === 'friendshiprequest' || $pushtype === 'friendshipaccepted') {
				
				$url = 'https://webtoapp.design/api/push_notifications?key='.$apiaccesskey;
				
				
				if (count($target_device_ids) > 0) {
					
					for ($i=0;$i<count($target_device_ids);$i++) {

						$fields = array( 
	            			'token' 		=> $target_device_ids[$i], 
							'title'     	=> trim($pushtitle),
							'message'   	=> $pushcontent,
							'image_url'		=> $pushimageurl,
							'url_to_open'  => $pushlink
						);					
			
					
						$headers = array( 
							'Content-Type' => 'application/json'
						);
				
						$body = wp_json_encode($fields);
			
						$args = array(
			    			'httpversion' => '1.0',
							'blocking' => true,
							'sslverify' => true,
							'body' => $body,
							'headers' => $headers
						);
			
						$apiresults = wp_remote_post($url, $args);
				
						$apibody = wp_remote_retrieve_body($apiresults);
						
					
					}
				}
				
			} else {
				
			
				$topic = 'pnfpbgeneral';
				
				if (get_option('pnfpb_ic_fcm_loggedin_notify') && get_option('pnfpb_ic_fcm_loggedin_notify') === '1') {
					
					$topic = "pnfpbgeneralloggedin";
						
				} 
				
				if ($grouppush === 'yes') {
				
					$group_name = 'pnfpbgroupid'.$groupid;

					$topic = $group_name;
				}
				
				$fields = array( 
						'title'     	=> trim($pushtitle),
						'message'      	=> $pushcontent,
						'image_url'		=> $pushimageurl,
						'url_to_open'  	=> $pushlink
				);					
					
				$headers = array( 
					'Content-Type' => 'application/json'
				);
				
				$body = wp_json_encode($fields);
			
				$args = array(
			    	'httpversion' => '1.0',
					'blocking' => true,
					'sslverify' => true,
					'body' => $body,
					'headers' => $headers
				);
			
				$apiresults = wp_remote_post($url, $args);
				
				$apibody = wp_remote_retrieve_body($apiresults);
				
			
			}


?>