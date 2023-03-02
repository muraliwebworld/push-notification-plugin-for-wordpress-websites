<?php
/**
* Plugin settings area to send one time/on demand push notification to all subscribers
*
* @since 1.21
*/
?>

<h2 class="nav-tab-wrapper"><a href="options-general.php?page=pnfpb-icfcm-slug" class="nav-tab"><?php echo __("Push notification",PNFPB_TD); ?></a><a href="options-general.php?page=pnfpb_icfm_device_tokens_list" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_DEVICE_TOKENS_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_pwa_app_settings" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_PWA_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfmtest_notification" class="nav-tab nav-tab-active"><?php echo __(PNFPB_PLUGIN_NM_ONDEMANDPUSH_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_frontend_settings" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_FRONTEND_SETTINGS_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_button_settings" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_BUTTON_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_integrate_app" class="nav-tab"><?php echo __(PNFPB_PLUGIN_API_MOBILE_APP_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_settings_for_ngnix_server" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NGINX_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_action_scheduler" class="nav-tab"><?php echo __(PNFPB_PLUGIN_SCHEDULE_ACTIONS,PNFPB_TD);?></a></h2>

<div class="pnfpb_column_1000">
<h1 class="pnfpb_ic_push_settings_header"><?php echo __(PNFPB_PLUGIN_NM_ONDEMANDPUSH_SETTINGS,PNFPB_TD);?></h1>

<h2 class="pnfpb_ic_push_settings_details"><?php echo __(PNFPB_PLUGIN_NM_ONDEMANDPUSH_DETAIL,PNFPB_TD);?></h2>

<?php
	
		if( isset($_POST['submit']) && isset($_POST['pnfpb_ic_on_demand_push_title']) && isset($_POST['pnfpb_ic_on_demand_push_content']))
        {
			global $wpdb;
			
		
			$apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
			
			
			if ($apiaccesskey != '' && $apiaccesskey != false) {
	
			    $table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
			    $deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%webview%' AND device_id NOT LIKE '%@N%'" );
				
				$deviceidswebview=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id LIKE '%webview%' AND device_id NOT LIKE '%@N%'" );
	
			    $url = 'https://fcm.googleapis.com/fcm/send';

			    $regid = $deviceids;
	
			    $activity_content_push = strip_tags(urldecode($_POST['pnfpb_ic_on_demand_push_content']));
				
			    $imageurl = '';
                if (isset($_POST['pnfpb_ic_on_demand_push_image_url'])) {
                    $imageurl = $_POST['pnfpb_ic_on_demand_push_image_url'];
                }

                $postlink = get_home_url();
                if (isset($_POST['pnfpb_ic_on_demand_push_url_link'])) {
                    $postlink = $_POST['pnfpb_ic_on_demand_push_url_link'];
                }
				
				if (count($regid) > 0) {

					// prepare the message
					$message = array( 
						'title'     => stripslashes(strip_tags($_POST['pnfpb_ic_on_demand_push_title'])),
						'body'      => stripslashes(strip_tags($activity_content_push)),
						'icon'		=> $imageurl,
						'image'		=> $imageurl,
						'click_action' => $postlink
					);
    

					$fields = array( 
						'registration_ids' => $regid, 
						'notification' => $message
					);
    
					$headers = array( 
						'Authorization' => 'key='.$apiaccesskey, 
						'Content-Type' => 'application/json'
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
					if (is_array($bodyresults)) {
						if (array_key_exists('results', $bodyresults)) {
							foreach ($bodyresults['results'] as $idx=>$result){
								if (array_key_exists('error',$result)) {
									if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($regid[$idx], '!!') === false) {
										$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$regid[$idx]}'") ;
									}
								}
							}
						}
					}
		
			
					if (is_wp_error($apiresults)) {
						$status = $apiresults->get_error_code(); 				// custom code for WP_ERROR
						$error_message = $apiresults->get_error_message();
						error_log('There was a '.$status.' error in push notification : '.$error_message);
					}
				}
				
				if (count($deviceidswebview) > 0) {

					// prepare the message
					$message = array( 
						'title'     => $_POST['pnfpb_ic_on_demand_push_title'],
						'body'      => stripslashes(strip_tags($activity_content_push)),
						'icon'		=> $imageurl,
						'image'		=> $imageurl,
						'badge'		=> 0
					);
    

					$fields = array( 
						'registration_ids' => $deviceidswebview, 
						'notification' => $message,
						'data'	=> array('click_url' => $postlink)
					);
    
					$headers = array( 
						'Authorization' => 'key='.$apiaccesskey, 
						'Content-Type' => 'application/json'
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
					if (is_array($bodyresults)) {
						if (array_key_exists('results', $bodyresults)) {
							foreach ($bodyresults['results'] as $idx=>$result){
								if (array_key_exists('error',$result)) {
									if (($result['error'] === 'NotRegistered' || $result['error'] === 'InvalidRegistration') && strpos($deviceidswebview[$idx], '!!') === false) {
										$deviceid_delete_status = $wpdb->query("DELETE from {$table_name} WHERE device_id = '{$deviceidswebview[$idx]}'") ;
									}
								}
							}
						}
					}
		
			
					if (is_wp_error($apiresults)) {
						$status = $apiresults->get_error_code(); 				// custom code for WP_ERROR
						$error_message = $apiresults->get_error_message();
						error_log('There was a '.$status.' error in push notification : '.$error_message);
						?>
    					<div class="notice notice-error is-dismissible">
        					<p><?php _e( 'Error in connecting push notification server endpoint...Please verify hosting error logs and try again!!!', 'PNFPB_TD' ); ?></p>
    					</div>
						<?php
					}
					else 
					{
					?>
						<div class="notice notice-success is-dismissible">
        					<p><?php _e( 'Push notification sent successfully!!!', 'PNFPB_TD' ); ?></p>
    					</div>
					<?php
					}
				}
                
			}    

        }
		else 
		{
        	if( isset($_POST['schedule_now']) && isset($_POST['pnfpb_ic_on_demand_push_title']) && isset($_POST['pnfpb_ic_on_demand_push_content']))
        	{
				$selected_day_push_notification = $_POST['pnfpb_ic_fcm_token_ondemand_datepicker'].' '.$_POST['pnfpb_ic_fcm_token_ondemand_timepicker'].':00';

				//echo wp_timezone_string();
				//echo(date_default_timezone_get() . "<br />");
				$pnfpb_selected_datetime = new DateTime($selected_day_push_notification, new DateTimeZone(wp_timezone_string()));
				//$pnfpb_selected_datetime = $pnfpb_selected_datetime->setTimezone(new DateTimeZone(wp_timezone_string()));
				$pnfpb_selected_datetime = $pnfpb_selected_datetime->setTimezone(new DateTimeZone("UTC"));
				//$pnfpb_selected_datetime_utc = $pnfpb_selected_datetime->setTimezone(new DateTimeZone("UTC"));
				//print_r($pnfpb_selected_datetime_utc->format("Y-m-d H:i:s"));
				$scheduled_day_push_notification = strtotime($pnfpb_selected_datetime->format("Y-m-d H:i:s"));
				//print_r($pnfpb_selected_datetime->format("Y-m-d H:i:s"));
				//print_r($pnfpb_selected_datetime->setTimezone(new DateTimeZone(wp_timezone_string()))->format("Y-m-d H:i:s"));
				update_option('pnfpb_ic_fcm_ondemand_schedule_pn_title'.$scheduled_day_push_notification,$_POST['pnfpb_ic_on_demand_push_title']);
				update_option('pnfpb_ic_fcm_ondemand_schedule_pn_content'.$scheduled_day_push_notification,$_POST['pnfpb_ic_on_demand_push_content']);
				update_option('pnfpb_ic_fcm_ondemand_schedule_pn_image'.$scheduled_day_push_notification,$_POST['pnfpb_ic_on_demand_push_image_url']);
				update_option('pnfpb_ic_fcm_ondemand_schedule_pn_url'.$scheduled_day_push_notification,$_POST['pnfpb_ic_on_demand_push_url_link']);
				
				//$schedule_status = wp_schedule_single_event( $scheduled_day_push_notification, 'PNFPB_ondemand_schedule_push_notification_hook', array( $scheduled_day_push_notification ) );
				
				$action_scheduler_status = as_schedule_single_action( $scheduled_day_push_notification, 'PNFPB_ondemand_schedule_push_notification_hook', array( $scheduled_day_push_notification ));

				if ($action_scheduler_status) {
				?>
    			<div class="notice notice-success is-dismissible">
        			<p><?php _e( 'Push notification scheduled successfully. Refer action scheduler tab for scheduled tasks. Scheduled timestamp reference number is '.$scheduled_day_push_notification.' . Action scheduler task id is '.$action_scheduler_status, 'PNFPB_TD' ); ?></p>
    			</div>
				<?php
				}
				else 
				{
						$error_message = '';
						if( is_wp_error( $action_scheduler_status ) ) {
    						$error_message = $action_scheduler_status->get_error_message();
						}
					?>
	    			<div class="notice notice-error is-dismissible">
        				<p><?php _e( 'CRON Error...in scheduling notification. Please try again', 'PNFPB_TD' ); ?></p>
						<?php if ($error_message != '') { ?>
						<p>
							<?php echo $error_message; ?>
						</p>
						<?php } ?>
    				</div>
					<?php
					
				}
			}
			else 
			{
				if( isset($_POST['schedule_now']) && isset($_POST['pnfpb_ic_on_demand_push_title']) && isset($_POST['pnfpb_ic_on_demand_push_content']))				{
			?>
    				<div class="notice notice-error is-dismissible">
        				<p><?php _e( 'Error...Please fill all required fields and try again!!!', 'PNFPB_TD' ); ?></p>
    				</div>				
			<?php
				}
			}

		}
	
?>

<form method="post" enctype="multipart/form-data" class="form-field">
	<table class="pnfpb_ic_push_settings_table widefat fixed">
    	<tbody>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_name">
                        <?php echo __("Message title",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_on_demand_push_title" name="pnfpb_ic_on_demand_push_title" type="text" value="" required="required" />					
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_name">
						<?php echo __("Message content",PNFPB_TD);?>
					</label>
					<br/>
					<textarea class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_on_demand_push_content" name="pnfpb_ic_on_demand_push_content" type="text" value="" required="required" rows="3"></textarea>					
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_name">
						<?php echo __("Add Image link/URL or Select Image",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_on_demand_push_image_url" name="pnfpb_ic_on_demand_push_image_url" type="text" value="" />					
				</td>
			</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">				
            		<table>
						<tr>
                			<td class="column-columnname">
                    			<input type="button" value="<?php echo __("Select Image",PNFPB_TD);?>" id="pnfpb_ic_fcm_on_demand_push_image_button" class="pnfpb_ic_push_pwa_settings_upload_icon" />
                    			<input type="hidden" id="pnfpb_ic_fcm_on_demand_push_image" name="pnfpb_ic_fcm_on_demand_push_image" value="" />
                			</td>
						</tr>
						<tr>							
                			<td class="column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_ic_fcm_on_demand_push_image_preview" style="width:50px; height:50px;overflow:hidden;border-radius:0%;margin:0px auto;background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
                    			</div>
                			</td>
            			</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<p>
						<?php echo __("Add push notification click action url/link or Select page from dropdown list",PNFPB_TD);?>
					</p>
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_on_demand_push_url_link" name="pnfpb_ic_on_demand_push_url_link" type="text" value="<?php echo get_home_url(); ?>" />					
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">				
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">
					<select id="pnfpb_ic_on_demand_push_url" name="pnfpb_ic_on_demand_push_url">
					    <?php
					    if( $pages = get_pages() ){
						    echo '<option value="' . get_home_url() . '"> Home page</option>';	        		
						    foreach( $pages as $page ){
						    echo '<option value="' . get_page_link( $page->ID ) . '">' . $page->post_title . '</option>';						
       					    }
    				    }
					    ?>
				    </select>					
				</td>
			</tr>
			<tr>
				<td class="column-columnname"><div class="pnfpb_column_full_ondemand"><?php submit_button(__('Send now',PNFPB_TD),'pnfpb_ic_push_save_configuration_button'); ?></div></td>
			</tr>
			<tr>
				<td>
  					<div class="pnfpb_column_400">
    					<div class="pnfpb_card pnfpb_schedule_later_ondemand">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_ic_push_settings_table_label_schedule_later_ondemand" for="pnfpb_ic_fcm_token_ondemand_datepicker">
								<?php echo __("Select date",'PNFPB_TD');?>
							</label>
							<input  id="pnfpb_ic_fcm_token_ondemand_datepicker" name="pnfpb_ic_fcm_token_ondemand_datepicker" type="date" />
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_ic_push_settings_table_label_schedule_later_ondemand" for="pnfpb_ic_fcm_token_ondemand_timepicker">
								<?php echo __("Select time",'PNFPB_TD');?>
							</label>
							<input  id="pnfpb_ic_fcm_token_ondemand_timepicker" name="pnfpb_ic_fcm_token_ondemand_timepicker" type="time" />
						</div>
						<div class="pnfpb_column_full_ondemand">
							<?php submit_button(__('Schedule now',PNFPB_TD),'pnfpb_ic_push_save_configuration_button','schedule_now'); ?>
							<?php echo __('(To send push notification later on selected schedule)',PNFPB_TD); ?>							
						</div>						
					</div>					
				</td>
				<td class="column-columnname">
					<div class="pnfpb_column_full_ondemand">

					</div>
				</td>				
    		</tr>
   		</tbody>
	</table>
</form>
</div>