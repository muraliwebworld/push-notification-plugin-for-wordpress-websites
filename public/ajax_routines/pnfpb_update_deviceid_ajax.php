<?php

/**
* Ajax routine to Store Device id token generated from Google's FireBase 
* based on user subscription from browser to allow push notifications. 
* Device id is generated by Google's Firebase.
*
* @param string   $_POST['device_id'] Device id sent from firebase ajax routine
*
*
* @since 1.0.0
*/

	/** Sanitize the device id generated by Google's Firebase for the user who subscribed push notification  **/
	
    $bpdeviceid = sanitize_text_field($_POST['device_id']);

	$bpsubscribeoptions = '10000000000';

	if (isset($_POST['subscriptionoptions'])) {
    	$bpsubscribeoptions = sanitize_text_field($_POST['subscriptionoptions']);
	}
	
	/** securing data from Firebase who subscribed push notification  **/
	
	$bpdeviceid = esc_html($bpdeviceid);
	
	$pushtype = 'normal';

	$pnfpbshortcodeactive = 'no';
	
	global $wpdb;
	
	if (isset($_POST['pushtype'])) {
	
	    $pushtype = sanitize_text_field($_POST['pushtype']);
	
	    $pushtype = esc_html($pushtype);
	    
	}

	$isadminpage = 'no';

	if (isset($_POST['pnfpbshortcodeactive']) ) {
		
		if (isset($_POST['isadminpage'])) {
			$isadminpage = $_POST['isadminpage'];
		}
		
		$pnfpbshortcodeactive = sanitize_text_field($_POST['pnfpbshortcodeactive']);
		
		if ($isadminpage === 'no') {
			update_option( 'pnfpb_shortcode_enable', $pnfpbshortcodeactive );
		}
	}

	$bpuserid = 0;
	
	if ( is_user_logged_in() ) {
		
    	$bpuserid = get_current_user_id();
	}
    
	if ($bpdeviceid != '' && $pushtype == 'normal') {
	
		$table = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
		
		$dbname = $wpdb->dbname;

 		$is_status_col = $wpdb->get_results(  "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS`    WHERE `table_name` = '{$table}' AND `TABLE_SCHEMA` = '{$dbname}' AND `COLUMN_NAME` = 'subscription_option'"  );

		if( empty($is_status_col) ):
    		$add_status_column = "ALTER TABLE `{$table}` ADD `subscription_option` VARCHAR(50) NULL DEFAULT NULL AFTER `device_id`; ";
   			$wpdb->query( $add_status_column );
		endif;		
		
		$deviceid_exists = $wpdb->get_results("SELECT * FROM $table WHERE device_id LIKE '%".$bpdeviceid."%'"  ) ;
		
		foreach( $deviceid_exists as $result ) {
			
				if ($result->userid == 0 || $result->userid != $bpuserid){

					$deviceid_update_status = $wpdb->query("UPDATE $table SET userid = {$bpuserid} WHERE device_id = '{$bpdeviceid}'") ;	
				}  
		}		
	
		if(count($deviceid_exists) > 0) {
			echo "duplicate";
		}
		else
		{
			$data = array('userid' => $bpuserid, 'device_id' => $bpdeviceid);
			$insertstatus = $wpdb->insert($table,$data);
			if (!$insertstatus || $insertstatus != 0){
				$my_id = $wpdb->insert_id;
				echo 'subscribed';
			}
			else
			{
				echo "fail";
			}
		}
	}
	else
	{
		if ($bpdeviceid != '' && $pushtype == 'subscribe-button') {
		    
		    $table = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
			
			
			$dbname = $wpdb->dbname;

 			$is_status_col = $wpdb->get_results(  "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS`    WHERE `table_name` = '{$table}' AND `TABLE_SCHEMA` = '{$dbname}' AND `COLUMN_NAME` = 'subscription_option'"  );

			if( empty($is_status_col) ):
    			$add_status_column = "ALTER TABLE `{$table}` ADD `subscription_option` VARCHAR(50) NULL DEFAULT NULL AFTER `device_id`; ";
   				$wpdb->query( $add_status_column );
			endif;			
		
			
		    $deviceid_update_status = $wpdb->query("UPDATE {$table} SET device_id = '{$bpdeviceid}' , subscription_option = '{$bpsubscribeoptions}' WHERE device_id LIKE '%{$bpdeviceid}%' AND device_id NOT LIKE '%!!%'") ;
			
			$deviceid_group_update_status = $wpdb->query("UPDATE {$table} SET subscription_option = '{$bpsubscribeoptions}' WHERE device_id LIKE '%{$bpdeviceid}%' AND device_id LIKE '%!!%'") ;			
			
			$deviceid_select_status = $wpdb->get_results("SELECT * FROM {$table} WHERE device_id LIKE '%".$bpdeviceid."%'");			
		
		    if($deviceid_update_status > 0) {

				echo json_encode(array('subscriptionstatus' => 'subscribed', 'subscriptionoptions' => $bpsubscribeoptions));
			
		    }
		    else
		    {
				if(count($deviceid_select_status) <= 0) {
					$bpdeviceid = $bpdeviceid;
			    	$data = array('userid' => $bpuserid, 'device_id' => $bpdeviceid, 'subscription_option' => $bpsubscribeoptions);
			    	$insertstatus = $wpdb->insert($table,$data);
			    	if (!$insertstatus || $insertstatus != 0){
				    	$my_id = $wpdb->insert_id;
					
				    	echo json_encode(array('subscriptionstatus' => 'subscribed', 'subscriptionoptions' => $bpsubscribeoptions));
			    	}
			    	else
			    	{
				    	echo json_encode(array('subscriptionstatus' => 'fail', 'subscriptionoptions' => $bpsubscribeoptions));
			    	}
				}
				else 
				{
					echo json_encode(array('subscriptionstatus' => 'subscribed', 'subscriptionoptions' => $bpsubscribeoptions));
				
				}
		    }		    
		}
		else
		{
		    
		    if ($bpdeviceid != '' && $pushtype == 'checkdeviceid') {

		        $table = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
				
				$dbname = $wpdb->dbname;

				$is_status_col = $wpdb->get_results(  "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS`    WHERE `table_name` = '{$table}' AND `TABLE_SCHEMA` = '{$dbname}' AND `COLUMN_NAME` = 'subscription_option'"  );

				if( empty($is_status_col) ):
					$add_status_column = "ALTER TABLE `{$table}` ADD `subscription_option` VARCHAR(50) NULL DEFAULT NULL AFTER `device_id`; ";
					$wpdb->query( $add_status_column );
				endif;				
		
		        $deviceid_select_status = $wpdb->get_results("SELECT * FROM {$table} WHERE device_id LIKE '%".$bpdeviceid."%'");
				
				$subscribed = true;
				$subscriptionoptions = '00000';

				foreach( $deviceid_select_status as $result ) {
					
					if ($result->userid == 0 || $result->userid != $bpuserid) {

						$deviceid_update_status = $wpdb->query("UPDATE {$table} SET userid = {$bpuserid} WHERE device_id = '{$bpdeviceid}'") ;	
					}
					
					$subscriptionoptions = $result->subscription_option;
					
					if ($subscriptionoptions === NULL || $subscriptionoptions === null || $subscriptionoptions == 'NULL') {
						
						$subscriptionoptions = '10000';
						
						$deviceid_update_status = $wpdb->query("UPDATE {$table} SET subscription_option = '10000' WHERE device_id = '{$bpdeviceid}'") ;
							
					}
				
				}			
				
				if (strpos($result->device_id,'@N') !== false || $subscriptionoptions === '00000' || $subscriptionoptions === '00001' ) 
				{
						$subscribed = false;
				}				
		
		        if(count($deviceid_select_status) > 0) {
					
	    			if ($subscribed) {
						echo json_encode(array('subscriptionstatus' => 'subscribed', 'subscriptionoptions' => $subscriptionoptions));
					}
					else 
					{
						echo json_encode(array('subscriptionstatus' => 'not-subscribed', 'subscriptionoptions' => $subscriptionoptions));
					}
			
		        }
		        else
		        {
					$data = array('userid' => $bpuserid, 'device_id' => $bpdeviceid);
					$insertstatus = $wpdb->insert($table,$data);
					if (!$insertstatus || $insertstatus != 0){
						$my_id = $wpdb->insert_id;
						echo json_encode(array('subscriptionstatus' => 'subscribed', 'subscriptionoptions' => $subscriptionoptions));
					}
					else
					{
						echo json_encode(array('subscriptionstatus' => 'not-subscribed', 'subscriptionoptions' => $subscriptionoptions));
					}
		        }		        
		        
		    }
		    
		    else
		    {
		    	if ($bpdeviceid != '' && $pushtype == 'checkdeviceidforgroup') {
					
					$bpgroupid = sanitize_text_field($_POST['bpgroup_id']);

		        	$table = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
		
		        	$deviceid_select_status = $wpdb->query("SELECT * FROM {$table} WHERE device_id = '{$bpdeviceid}!!{$bpgroupid}' AND userid = {$bpuserid}") ;
					
					$subscribed = true;
					$subscriptionoptions = '00000';					
					
		        	if($deviceid_select_status > 0) {
		    
			        	echo "subscribed";
			
		        	}
		        	else
		        	{
			        	echo "not-subscribed";
		        	}		        
		        
		    	}
				else
				{
		    		if ($bpdeviceid != '' && $pushtype == 'subscribe-group-button') {
						
						$bpgroupid = sanitize_text_field($_POST['bpgroup_id']);

		    			$table = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
						
						$dbname = $wpdb->dbname;

 						$is_status_col = $wpdb->get_results(  "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS`    WHERE `table_name` = '{$table}' AND `TABLE_SCHEMA` = '{$dbname}' AND `COLUMN_NAME` = 'subscription_option'"  );

						if( empty($is_status_col) ):
    						$add_status_column = "ALTER TABLE `{$table}` ADD `subscription_option` VARCHAR(50) NULL DEFAULT NULL AFTER `device_id`; ";
							$wpdb->query( $add_status_column );
						endif;			
						
						$cookievalue = '';
						if(!isset($_COOKIE[$cookie_name])) {
							$cookievalue = $_COOKIE['pnfpb_group_push_notification_'.$bpgroupid];
						}
						
						$bpnewdeviceid = $bpdeviceid.'!!'.$bpgroupid.'!!'.$cookievalue;
						
						$deviceid_select_status = $wpdb->get_results("SELECT * FROM {$table} WHERE device_id LIKE '%".$bpdeviceid."%'");
				
						$subscribed = true;
						$subscriptionoptions = '00000';

						foreach( $deviceid_select_status as $result ) {
							$subscriptionoptions = $result->subscription_option;
						}
		
		
						$uniqueid = uniqid();
						setcookie('pnfpb_group_push_notification_'.$bpgroupid, $uniqueid, time() + (86400 * 30), "/"); // 86400 = 1 day
						$bpnewdeviceid = $bpdeviceid.'!!'.$bpgroupid.'!!'.$uniqueid;
    					$data = array('userid' => $bpuserid, 'device_id' => $bpnewdeviceid,'subscription_option' => $subscriptionoptions);
    					$insertstatus = $wpdb->insert($table,$data);
   						if (!$insertstatus || $insertstatus != 0){
	    					$my_id = $wpdb->insert_id;
	    					echo 'subscribed';
    					}
    					else
    					{
	    					echo "fail";
    					}
		        
		    		}
					else
					{
		    			if ($bpdeviceid != '' && $pushtype == 'unsubscribe-group-button') {
						
							$bpgroupid = sanitize_text_field($_POST['bpgroup_id']);

		    				$table = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';

							$cookievalue = '';
							if(!isset($_COOKIE[$cookie_name])) {
								$cookievalue = $_COOKIE['pnfpb_group_push_notification_'.$bpgroupid];
							}							
		
							$bpolddeviceid = $bpdeviceid.'!!'.$bpgroupid.'!!'.$cookievalue;
		
		    				$deviceid_update_status = $wpdb->query("DELETE from {$table} WHERE userid = {$bpuserid} AND device_id = '{$bpolddeviceid}'") ;
		
		    				if($deviceid_update_status > 0) {
		    
			    				echo "unsubscribed";
			
		    				}
		    				else
		   					{
				    				echo "fail";
		    				}		        
		        
		    			}
						else
						{
                			echo "fail";		    
						}		    
					}
				}
		    }
		}
		
	}

	wp_die();
	
?>