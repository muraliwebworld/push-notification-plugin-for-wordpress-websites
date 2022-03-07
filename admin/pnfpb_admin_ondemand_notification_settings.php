<?php
/**
* Plugin settings area to send one time/on demand push notification to all subscribers
*
* @since 1.21
*/
?>

<h2 class="nav-tab-wrapper"><a href="options-general.php?page=pnfpb-icfcm-slug" class="nav-tab">Push notification</a><a href="options-general.php?page=pnfpb_icfm_device_tokens_list" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_DEVICE_TOKENS_HEADER);?></a><a href="options-general.php?page=pnfpb_icfm_pwa_app_settings" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_PWA_HEADER);?></a><a href="options-general.php?page=pnfpb_icfmtest_notification" class="nav-tab nav-tab-active"><?php echo __(PNFPB_PLUGIN_NM_ONDEMANDPUSH_HEADER);?></a><a href="options-general.php?page=pnfpb_icfm_button_settings" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_BUTTON_HEADER);?></a><a href="options-general.php?page=pnfpb_icfm_integrate_app" class="nav-tab"><?php echo 'Integrate app API';?></a></h2>

<h1 class="pnfpb_ic_push_settings_header"><?php echo __(PNFPB_PLUGIN_NM_ONDEMANDPUSH_SETTINGS,PNFPB_TD);?></h1>

<h2 class="pnfpb_ic_push_settings_details"><?php echo __(PNFPB_PLUGIN_NM_ONDEMANDPUSH_DETAIL,PNFPB_TD);?></h2>

<?php
		

        if( isset($_POST['submit']) && isset($_POST['pnfpb_ic_on_demand_push_title']) && isset($_POST['pnfpb_ic_on_demand_push_content']))
        {
			global $wpdb;
			
		
			$apiaccesskey = get_option('pnfpb_ic_fcm_google_api');
			
			
			if ($apiaccesskey != '' && $apiaccesskey != false) {
	
			    $table_name = $wpdb->prefix . "pnfpb_ic_subscribed_deviceids_web";
	
			    $deviceids=$wpdb->get_col( "SELECT SUBSTRING_INDEX(device_id, '!!', 1) FROM {$table_name} WHERE device_id NOT LIKE '%@N%'" );
	
			    $url = 'https://fcm.googleapis.com/fcm/send';

			    $regid = $deviceids;
	
			    $activity_content_push = strip_tags(urldecode($_POST['pnfpb_ic_on_demand_push_content']));
				
			    $imageurl = '';
                if (isset($_POST['pnfpb_ic_fcm_on_demand_push_image'])) {
                    $imageurl = $_POST['pnfpb_ic_fcm_on_demand_push_image'];
                }

                $postlink = get_home_url();
                if (isset($_POST['pnfpb_ic_on_demand_push_url'])) {
                    $postlink = $_POST['pnfpb_ic_on_demand_push_url'];
                }

			    // prepare the message
			    $message = array( 
				    'title'     => $_POST['pnfpb_ic_on_demand_push_title'],
				    'body'      => $activity_content_push,
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

        }

?>

<form method="post" enctype="multipart/form-data" class="form-field">
	
	<table class="pnfpb_ic_push_settings_table widefat fixed">
    	<tbody>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_name">
                        <?php echo __("Message title<br/> (max 50 characters)",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_on_demand_push_title" name="pnfpb_ic_on_demand_push_title" type="text" maxlength="50" value="" required="required" />					
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_pwa_app_name">
						<?php echo __("Message content<br/> (max 125 characters)",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_on_demand_push_content" name="pnfpb_ic_on_demand_push_content" type="text" maxlength="125" value="" required="required" />					
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_on_demand_push_image">
						<?php echo __("Attach Image for push content",PNFPB_TD);?>
					</label>
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">				
            		<table>
						<tr>
                			<td class="column-columnname">
                    			<input type="button" value="<?php echo __("Add Image",PNFPB_TD);?>" id="pnfpb_ic_fcm_on_demand_push_image_button" class="pnfpb_ic_push_pwa_settings_upload_icon" />
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
			<tr><td><b>Select page for push notification link. This link will be used to take user to this page, when user clicked on push notification</b></td></tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_on_demand_push_url">
						<?php echo __("Select page for notification link",PNFPB_TD);?>
					</label>
					<br/>
					<select id="pnfpb_ic_on_demand_push_url" name="pnfpb_ic_on_demand_push_url" required="required">
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
				<td class="column-columnname"> <div class="col-sm-10"><?php submit_button( __( 'Send push notification', 'PNFPB_TD' )); ?></div></td>
    		</tr>
   		</tbody>
	</table>
</form>