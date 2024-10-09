<?php

		/**
		* Insert subscription token received in rest api from Android app/Ios app for push notifications
		* 
		* @since 1.36
		* 
		*/	
			global $wpdb;
			
			$bpuserid = 0;
			
			if ( is_user_logged_in() ) {
		
    			$bpuserid = get_current_user_id();
				
			}
			
			$table = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
		
			$dbname = $wpdb->dbname;

			$is_firebase_version_col = $wpdb->get_results(  "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `table_name` = '{$table}' AND `TABLE_SCHEMA` = '{$dbname}' AND `COLUMN_NAME` = 'firebase_version'"  );

			if( empty($is_firebase_version_col) ):
				$add_status_column = "ALTER TABLE `{$table}` ADD `firebase_version` VARCHAR(100) DEFAULT 'L'; ";
				$wpdb->query( $add_firebase_version_column );
			endif;			
			
			

            if (isset($request['userid'])) {
            	$bpuserid = sanitize_text_field($request['userid']);
            }			
			
			$encryption_key = get_option('PNFPB_icfcm_integrate_app_secret_code');
			
			$encrypted = sanitize_text_field($request['token']);
			
			$subscriptionoptions = '100000000000';
			
			if (isset($request['subscriptionoptions']) && $request['subscriptionoptions'] !== '') {
				$subscriptionoptions = sanitize_text_field($request['subscriptionoptions']);
			}			
			
        	$parts = explode(':', $encrypted);
			
			$keynonce = $encryption_key;
			
			// Decode AES-256-CBC encrypted data from mobile app to extract and store subscription token in WordPress database
			
        	// Don't forget to base64-decode the $iv before feeding it back to
        	//openssl_decrypt
        	//
        	$decrypted = openssl_decrypt(base64_decode($parts[0]), "aes-256-cbc", $keynonce, OPENSSL_RAW_DATA, base64_decode($parts[1]));
			
        	if (!$decrypted) {
				
            	$res = new WP_REST_Response($response);
				
        		$res->set_status(200);
				
        		return ['req' => $res,'tokenupdatestatus'=>' failed - invalid data '.$parts[0].'-----***'.$parts[1]];	
				
        	}
			else 
			{
				$key = hash('sha256', $encryption_key);

				$receivedhasmac = base64_decode($parts[2]);

				$bphasmac = hash_hmac('sha256',$decrypted, $encryption_key);

				if ($bphasmac !== $parts[3]) {
					
            		$res = new WP_REST_Response($response);
				
        			$res->set_status(200);
				
        			return ['req' => $res,'tokenupdatestatus'=>' failed - invalid data/encryption ','$bphasmac' => $bphasmac,'$receivedhasmac' => $parts[3], 'decrypted' => $decrypted];					
				}
			
				$table = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
				
				if ($request['subscription-type'] === 'subscribe-group') {
					
					
					$deviceid_select_status = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$table} WHERE device_id LIKE %s", '%' . $wpdb->esc_like( $decrypted) . '%'));
				
					$updatetokenresponse = 'fail';
					
				
					foreach( $deviceid_select_status as $result ) {
						
						$subscriptionoptions = $result->subscription_option;
						
						$bpuserid =  $result->userid;
						
					}
					
					$bpcheckdeviceid = $decrypted.'!!'.sanitize_text_field($request['groupid']).'!!'.sanitize_text_field($request['cookievalue']).'!!webview';
					
					
					
					$deviceid_check_status = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$table} WHERE device_id LIKE %s",'%' . $wpdb->esc_like( $bpcheckdeviceid) . '%'));
					
					if(count($deviceid_check_status) > 0) {
						
						foreach( $deviceid_select_status as $result ) {
						
							if ($bpuserid !== 0){

								$deviceid_update_status = $wpdb->query($wpdb->prepare("UPDATE {$table} SET userid = %d WHERE device_id = %s AND device_id LIKE %s",$bpuserid,$bpcheckdeviceid,'%' . $wpdb->esc_like( 'webview' ) . '%'));
								
							}
						}
						
						$version_values = $wpdb->get_col($wpdb->prepare( "SELECT firebase_version FROM {$table} WHERE device_id = %s",$bpcheckdeviceid ));
						
						$version_value = 'L';
						
						foreach ( $version_values as $value ) {
							
							$version_value = $value;
							
						}
			
						if (($version_value !== 'httpv3' && $version_value !== 'httpv4') && get_option('pnfpb_httpv1_push') === '1') {						
						
							$group_name = 'pnfpbgroupid'.sanitize_text_field($request['groupid']);
							$client = new Google_Client();
							// Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
							$client->useApplicationDefaultCredentials(); 
							
							// Alternatively, provide the JSON authentication file directly.
							$configArray = json_decode(get_option('pnfpb_sa_json_data'),true);
							$client->setAuthConfig($configArray);
							
							// Add the scope as a string (multiple scopes can be provided as an array)
							$client->addScope('https://www.googleapis.com/auth/firebase.messaging');
							$client->refreshTokenWithAssertion();
							$pnfpb_fbauth_token_array = $client->getAccessToken();
							$pnfpb_fbauth_token = $pnfpb_fbauth_token_array['access_token'];
			
							$url = 'https://iid.googleapis.com/iid/v1:batchAdd';
			
							$headers = array( 
								'Authorization' => 'Bearer '.$pnfpb_fbauth_token, 
								'Content-Type' => 'application/json',
								'access_token_auth'=> 'true'
							);
							$grouptopic = "/topics/".$group_name;
							$fields = array( 
								"to" => $grouptopic,
								"registration_tokens"=> array($decrypted)
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
							
							$apibody = wp_remote_retrieve_body($apiresults);
							
							$bodyresults = json_decode($apibody,true);
							
							$deviceid_version_update_status = $wpdb->query($wpdb->prepare("UPDATE {$table} SET firebase_version = %s WHERE device_id = %s",'httpv4',$bpcheckdeviceid)) ;
							
						}
						
			
						$updatetokenresponse = 'duplicate';
					
		    		}
					else 
					{					
					
						$bpnewdeviceid = $decrypted.'!!'.sanitize_text_field($request['groupid']).'!!'.sanitize_text_field($request['cookievalue']).'!!webview';
					
						$data = array('userid' => $bpuserid, 'device_id' => $bpnewdeviceid, 'subscription_option' => $subscriptionoptions,'firebase_version' => 'httpv4');
					
						$insertstatus = $wpdb->insert($table,$data);
						
						if (get_option('pnfpb_httpv1_push') === '1') {	
						
						
							$group_name = 'pnfpbgroupid'.$request['groupid'];
						
							$client = new Google_Client();
							// Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
							$client->useApplicationDefaultCredentials(); 
							
							// Alternatively, provide the JSON authentication file directly.
							$configArray = json_decode(get_option('pnfpb_sa_json_data'),true);
							$client->setAuthConfig($configArray);
							
							// Add the scope as a string (multiple scopes can be provided as an array)
							$client->addScope('https://www.googleapis.com/auth/firebase.messaging');
							$client->refreshTokenWithAssertion();
							$pnfpb_fbauth_token_array = $client->getAccessToken();
							$pnfpb_fbauth_token = $pnfpb_fbauth_token_array['access_token'];
			
							$url = 'https://iid.googleapis.com/iid/v1:batchAdd';
			
							$headers = array( 
								'Authorization' => 'Bearer '.$pnfpb_fbauth_token, 
								'Content-Type' => 'application/json',
								'access_token_auth'=> 'true'
							);
						
							$grouptopic = "/topics/".$group_name;
			
							$fields = array( 
	          					"to" => $grouptopic,
			  					"registration_tokens"=> array($decrypted)
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
							$apibody = wp_remote_retrieve_body($apiresults);
							$bodyresults = json_decode($apibody,true);
							
						}
						
					
						if (!$insertstatus || $insertstatus !== 0){
						
							$updatetokenresponse = 'subscribed'.$insertstatus.count($deviceid_select_status);
						
						}
					}						
				}
				else 
				{
					
					if ($request['subscription-type'] === 'unsubscribe-group') {
					
						$bpolddeviceid = $decrypted.'!!'.sanitize_text_field($request['groupid']).'!!'.sanitize_text_field($request['cookievalue']).'!!webview';
		
		    			$deviceid_update_status = $wpdb->query($wpdb->prepare("DELETE from {$table} WHERE device_id = %s",$bpolddeviceid));
						
						if (get_option('pnfpb_httpv1_push') === '1') {	
							
							$group_name = 'pnfpbgroupid'.$request['groupid'];
						
							$client = new Google_Client();
							// Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
							$client->useApplicationDefaultCredentials(); 
							
							// Alternatively, provide the JSON authentication file directly.
							$configArray = json_decode(get_option('pnfpb_sa_json_data'),true);
							$client->setAuthConfig($configArray);
							
							// Add the scope as a string (multiple scopes can be provided as an array)
							$client->addScope('https://www.googleapis.com/auth/firebase.messaging');
							$client->refreshTokenWithAssertion();
							$pnfpb_fbauth_token_array = $client->getAccessToken();
							$pnfpb_fbauth_token = $pnfpb_fbauth_token_array['access_token'];
			
							$url = 'https://iid.googleapis.com/iid/v1:batchRemove';
			
							$headers = array( 
								'Authorization' => 'Bearer '.$pnfpb_fbauth_token, 
								'Content-Type' => 'application/json',
								'access_token_auth'=> 'true'
							);
						
							$grouptopic = "/topics/".$group_name;
			
							$fields = array( 
	          					"to" => $grouptopic,
			  					"registration_tokens"=> array($decrypted)
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
							$apibody = wp_remote_retrieve_body($apiresults);
							$bodyresults = json_decode($apibody,true);
							
						}
						
					}
					else 
					{
						$deviceid = $decrypted;
                        
                        $deviceidinsert = $decrypted.'!!webview';
						
						$data = array('userid' => $bpuserid, 'device_id' => $deviceidinsert, 'subscription_option' => $subscriptionoptions);
						
				
						$deviceid_select_status = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$table} WHERE device_id LIKE %s AND device_id LIKE %s",'%' .$wpdb->esc_like($deviceid). '%','%' . $wpdb->esc_like( 'webview') . '%'));
				
						$updatetokenresponse = 'fail';
						
						foreach( $deviceid_select_status as $result ) {
			
							if ($bpuserid !== 0){

								$deviceid_update_status = $wpdb->query($wpdb->prepare("UPDATE {$table} SET userid = %d WHERE device_id LIKE %s AND device_id LIKE %s",$bpuserid,'%' .$wpdb->esc_like($deviceid). '%','%' . $wpdb->esc_like( 'webview') . '%')) ;		
							}
							
							if ($result->subscription_option == '') {
								
								$deviceid_update_status = $wpdb->query($wpdb->prepare("UPDATE {$table} SET subscription_option = %s WHERE device_id LIKE %s AND device_id LIKE %s",'100000000000','%' .$wpdb->esc_like($deviceid). '%','%' . $wpdb->esc_like( 'webview') . '%')) ;
																	   
							}

							if ($subscriptionoptions !== '100000000000' || $subscriptionoptions == ''){

								$deviceid_update_status = $wpdb->query($wpdb->prepare("UPDATE {$table} SET subscription_option = %s WHERE device_id LIKE %s AND device_id LIKE %s",$subscriptionoptions,'%' .$wpdb->esc_like($deviceid). '%','%' . $wpdb->esc_like( 'webview') . '%')) ;	
							}

							if ($subscriptionoptions !== '100000000000' || $subscriptionoptions == '' && $result->userid !== 0){

								$deviceid_update_status = $wpdb->query($wpdb->prepare("UPDATE {$table} SET subscription_option = %s WHERE userid = %d",$subscriptionoptions,$result->userid)) ;	
							}							
						}						
				
						if($deviceid_select_status != null && count($deviceid_select_status) > 0) {
							
							$version_values = $wpdb->get_col($wpdb->prepare( "SELECT firebase_version FROM {$table} WHERE device_id = %s",$deviceid ));
							
							$version_value = 'L';
							
							foreach ( $version_values as $value ) {
								
								$version_value = $value;
								
							}
			
							if (($version_value !== 'httpv3' && $version_value !== 'httpv4') && get_option('pnfpb_httpv1_push') === '1') {	
								
								$client = new Google_Client();
								// Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
								$client->useApplicationDefaultCredentials(); 
							
								// Alternatively, provide the JSON authentication file directly.
								$configArray = json_decode(get_option('pnfpb_sa_json_data'),true);
								$client->setAuthConfig($configArray);
							
								// Add the scope as a string (multiple scopes can be provided as an array)
								$client->addScope('https://www.googleapis.com/auth/firebase.messaging');
								$client->refreshTokenWithAssertion();
								$pnfpb_fbauth_token_array = $client->getAccessToken();
								$pnfpb_fbauth_token = $pnfpb_fbauth_token_array['access_token'];
			
								$url = 'https://iid.googleapis.com/iid/v1:batchAdd';
			
								$headers = array( 
									'Authorization' => 'Bearer '.$pnfpb_fbauth_token, 
									'Content-Type' => 'application/json',
									'access_token_auth'=> 'true'
								);
			
								$fields = array( 
									"to" => "/topics/pnfpbgeneral",
									"registration_tokens"=> array($deviceid)
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
								$apibody = wp_remote_retrieve_body($apiresults);
								$bodyresults = json_decode($apibody,true);
								$deviceid_version_update_status = $wpdb->query($wpdb->prepare("UPDATE {$table} SET firebase_version = %s WHERE device_id = %d",'httpv4',$deviceid)
) ;
								
							}
			
							$updatetokenresponse = 'duplicate';
					
		    			}
						else 
						{
							$insertstatus = $wpdb->insert($table,$data);
					
							if (!$insertstatus || $insertstatus !== 0){
						
								$updatetokenresponse = 'subscribed'.$insertstatus.count($deviceid_select_status);
						
							}
							
							if (get_option('pnfpb_httpv1_push') === '1') {	
							
								$client = new Google_Client();
								// Authentication with the GOOGLE_APPLICATION_CREDENTIALS environment variable
								$client->useApplicationDefaultCredentials(); 
							
								// Alternatively, provide the JSON authentication file directly.
								$configArray = json_decode(get_option('pnfpb_sa_json_data'),true);
								$client->setAuthConfig($configArray);
							
								// Add the scope as a string (multiple scopes can be provided as an array)
								$client->addScope('https://www.googleapis.com/auth/firebase.messaging');
								$client->refreshTokenWithAssertion();
								$pnfpb_fbauth_token_array = $client->getAccessToken();
								$pnfpb_fbauth_token = $pnfpb_fbauth_token_array['access_token'];
			
								$url = 'https://iid.googleapis.com/iid/v1:batchAdd';
			
								$headers = array( 
									'Authorization' => 'Bearer '.$pnfpb_fbauth_token, 
									'Content-Type' => 'application/json',
									'access_token_auth'=> 'true'
								);
			
								$fields = array( 
	          						"to" => "/topics/pnfpbgeneral",
			  						"registration_tokens"=> array($deviceid)
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
								$apibody = wp_remote_retrieve_body($apiresults);
								$bodyresults = json_decode($apibody,true);
								$deviceid_version_update_status = $wpdb->query($wpdb->prepare("UPDATE {$table} SET firebase_version = %s WHERE device_id = %d",'httpv4',$deviceid)
) ;
							}
							
						}
					}
				}
				
				$response = array(
					'status'  => 200,
					'message' => $updatetokenresponse
				);
				
        		$res = new WP_REST_Response($response);
				
        		$res->set_status(200);
				
        		return ['req' => $res,'tokenupdatestatus'=>$updatetokenresponse];			
				
			}



?>