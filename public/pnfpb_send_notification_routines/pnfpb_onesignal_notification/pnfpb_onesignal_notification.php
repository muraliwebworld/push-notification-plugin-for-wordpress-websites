<?php

		/** Onesignal push notification 
		* 
		* @since 1.65 version
		*/			
			try {
				$onesignal_post_url = 'https://onesignal.com/api/v1/notifications';

            	if (defined('ONESIGNAL_DEBUG') && defined('ONESIGNAL_LOCAL')) {
                 	$onesignal_post_url = 'https://localhost:3001/api/v1/notifications';
            	}
						
				$onesignal_wp_settings = OneSignal::get_onesignal_settings();

						
				$onesignal_auth_key = $onesignal_wp_settings['app_rest_api_key'];
						
				$include_external_ids = array();
				
				$externalid = $this->PNFPB_icfcm_generate_random_uuid($pushtitle);
				
				$pushcontent = mb_substr(stripslashes(strip_tags(urldecode(trim($pushcontent)))),0,130, 'UTF-8');
				
				$pushimageurl = str_replace( '&#038;', '&', $pushimageurl );				

				if ($target_device_id !== 0 && (is_array($target_device_id) && count($target_device_id) > 0)) {

					$include_external_ids = $target_device_id;
					
            		$fields = array(
                  		'external_id' => $externalid,
                  		'app_id' => $onesignal_wp_settings['app_id'],
                  		'data' => array("post_id" => $pushid,"imageUrl" => $pushimageurl),
                  		'headings' => array('en' => stripslashes_deep(wp_specialchars_decode($pushtitle))),
                  		//'included_segments' => array('All'),
                  		'isAnyWeb' => true,
                  		'url' => $pushlink,
                  		'contents' => array('en' => stripslashes_deep(wp_specialchars_decode(stripslashes(strip_tags(urldecode(trim($pushcontent))))))),
				  		//'include_external_user_ids' => $include_external_ids,
						'include_aliases' => array("external_id" => $include_external_ids),
						'target_channel' => 'push'
            		);					
				}
				else {
					
            		$fields = array(
                  		'external_id' => $externalid,
                  		'app_id' => $onesignal_wp_settings['app_id'],
                  		'data' => array("post_id" => $pushid,"imageUrl" => $pushimageurl),
                  		'headings' => array('en' => stripslashes_deep(wp_specialchars_decode($pushtitle))),
                  		'included_segments' => array('All'),
                  		'isAnyWeb' => true,
                  		'url' => $pushlink,
                  		'contents' => array('en' => stripslashes_deep(wp_specialchars_decode(stripslashes(strip_tags(urldecode(trim($pushcontent))))))),
            		);					
					
				}
			


				$fields['isIos'] = true;
				$fields['isAndroid'] = true;
				
				//$config_use_featured_image_as_image = $onesignal_wp_settings['showNotificationImageFromPostThumbnail'] === true;
				
				if ($pushimageurl != '') {
					$fields['chrome_web_icon'] = $pushimageurl;
                    $fields['chrome_web_image'] = $pushimageurl;
                    $fields['firefox_icon'] = $pushimageurl;
					$fields['big_picture'] = $pushimageurl;
					$fields['huawei_big_picture']  = $pushimageurl;
					$fields['adm_big_picture']  = $pushimageurl;
					$fields['chrome_big_picture']  = $pushimageurl;
					$fields['large_icon']  = $pushimageurl;
					$fields['ios_attachments'] = json_encode(array("id1"=>$pushimageurl));
			
				}
				
				
				
            	$request = array(
                 'headers' => array(
                 	'content-type' => 'application/json;charset=utf-8',
                 	'Authorization' => 'Basic '.$onesignal_auth_key,
                  ),
                   'body' => wp_json_encode($fields),
                   'timeout' => 3,
            	);
				
        		$response = wp_remote_post($onesignal_post_url, $request);

				if (is_wp_error($response)) {
				    $status = $response->get_error_code();
                    $error_message = $response->get_error_message();
                    error_log('There was a '.$status.' error in push notification: '.$error_message);
				}
        	} catch (Exception $e) {
            	$wp_error_msg = new WP_Error('err', __( "OneSignal: There was a problem sending a notification"));
				if( is_wp_error( $wp_error_msg ) ) {
    				error_log($wp_error_msg->get_error_message());
				}
        	}		


?>