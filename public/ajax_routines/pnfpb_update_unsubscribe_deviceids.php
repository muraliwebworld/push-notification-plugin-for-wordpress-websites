<?php

/**
* Ajax routine to delete device id from database after user opts to un-subscribe push notifications.
*
* @param string   $_POST['device_id'] Device id
*
*
* @since 1.0.0
*/

	/** Sanitize the device id generated by Google's Firebase for the user who subscribed push notification  **/
	
    $bpdeviceid = sanitize_text_field($_POST['device_id']);
    
    
	
	/** securing data from Firebase who subscribed push notification  **/
	
	$bpdeviceid = esc_html($bpdeviceid);
	
	if ($bpdeviceid != '') {
	
		global $wpdb;
	
		$table = $wpdb->prefix.'pnfpb_ic_subscribed_deviceids_web';
		
		$newbpdeviceid = $bpdeviceid.'@N';
		
		$deviceid_update_status = $wpdb->query("UPDATE {$table} SET device_id = '{$newbpdeviceid}' WHERE device_id = '{$bpdeviceid}'") ;
		
		if($deviceid_update_status > 0) {
		    
			echo "unsubscribed";
			
		}
		else
		{
			echo "...failed to delete/unsubscribe device id ";
		}
	}
	else
	{
		echo "Device id empty...failed to unsubscribe device id";
	}
	
?>