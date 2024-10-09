<?php
/**
* Plugin settings area to customize buttons for subscribe/unsubscribe push notifications
* @since 1.0.0
*/
?>

<h1 class="pnfpb_ic_push_settings_header"><?php echo __("PNFPB - Customize buttons",PNFPB_TD);?></h1>
<div class="nav-tab-wrapper">
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb-icfcm-slug" class="nav-tab tab"><?php echo __("Push Settings",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_device_tokens_list" class="nav-tab tab "><?php echo __("Device tokens",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_pwa_app_settings" class="nav-tab tab "><?php echo __("PWA",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfmtest_notification" class="nav-tab tab "><?php echo __("Send push notification",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc" class="nav-tab tab"><?php echo __("Push Notifications list",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_frontend_settings" class="nav-tab tab"><?php echo __("Frontend subscription settings",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_button_settings" class="nav-tab nav-tab-active tab active"><?php echo __("Customize buttons",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_integrate_app" class="nav-tab tab "><?php echo __("Integrate Mobile app",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_settings_for_ngnix_server" class="nav-tab tab "><?php echo __("NGINX",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_action_scheduler&s=pnfpb&action=-1&paged=1&action2=-1" class="nav-tab tab "><?php echo __("Action Scheduler",PNFPB_TD);?></a>
</div>
<div class="pnfpb_column_1200">
<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
    <?php settings_fields( 'pnfpb_icfcm_buttons'); ?>
    <?php do_settings_sections( 'pnfpb_icfcm_buttons' ); ?>
	
	<table class="pnfpb_ic_push_settings_table widefat fixed">
  		<tbody>
			<tr class="pnfpb_ic_push_settings_table_row"><td class="pnfpb_ic_push_settings_table_label_column column-columnname"><h3 class="pnfpb_ic_push_settings_header"><?php echo __("Subscribe/un-subscribe notification button customization",PNFPB_TD);?></h3></td></tr>				
   	 		<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_subscribe_button_color">
						<?php echo __("Subscribe/Un-subscribe button background color",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_pwa_prompt_install_button_color pnfpb_ic_push_pwa_color" id="pnfpb_ic_fcm_subscribe_button_color" name="pnfpb_ic_fcm_subscribe_button_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_button_color' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_button_color' ); } else { echo '#aaaaaa';}?>" />
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_subscribe_button_text_color">
						<?php echo __("Subscribe/Un-subscribe button text color",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_pwa_prompt_install_text_color pnfpb_ic_push_pwa_color" id="pnfpb_ic_fcm_subscribe_button_text_color" name="pnfpb_ic_fcm_subscribe_button_text_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_button_text_color' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_button_text_color' ); } else { echo '#ffffff';}?>"  />			
				</td>
			</tr>
			<tr class="pnfpb_ic_push_settings_table_row"><td class="pnfpb_ic_push_settings_table_label_column column-columnname"><h3 class="pnfpb_ic_push_settings_header"><?php echo __("BuddyPress Group subscribe/unsubscribe button customization",PNFPB_TD);?></h3></td></tr>
			<tr class="pnfpb_ic_push_settings_table_row">
            	<td class="pnfpb_ic_push_settings_table_label column-columnname">
					<div class="pnfpb_row">
						<div class="pnfpb_column_400">
							<div class="pnfpb_card">
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_subscribe_group_push_notification_icon_enable">
									<label class="pnfpb_switch">
										<input  id="pnfpb_subscribe_group_push_notification_icon_enable" name="pnfpb_subscribe_group_push_notification_icon_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_subscribe_group_push_notification_icon_enable' ) ); ?>  />
										<span class="pnfpb_slider round"></span>
									</label>
										<?php echo __("Show/Hide subscribe/unsubscribe group icon<br/>(if disabled, it will display text instead of icon for subscribe/unsubscribe push notification for groups)",PNFPB_TD);?>
								</label>
							</div>
						</div>
					</div>
				</td>
			</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_button_text"><?php echo __("Group subscription button text",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_button_text" name="pnfpb_ic_fcm_subscribe_button_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_button_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_button_text' );} else { echo __('Subscribe push notification',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">				
            		<table>
						<tr>
                			<td class="column-columnname">
                    			<input type="button" value="<?php echo __("Select Image",PNFPB_TD);?>" id="pnfpb_select_subscribe_group_push_notification_icon" class="pnfpb_ic_push_pwa_settings_upload_icon" />
                    			<input type="hidden" id="pnfpb_subscribe_group_push_notification_icon" name="pnfpb_subscribe_group_push_notification_icon" value="<?php if (get_option('pnfpb_subscribe_group_push_notification_icon')) {echo get_option('pnfpb_subscribe_group_push_notification_icon');} else { echo plugin_dir_url( __DIR__ ).'public/img/icon_push_subscribe.png';} ?>" />
                			</td>
						</tr>
						<tr>							
							<td class="column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_subscribe_group_push_notification_icon_preview" style="background-image: url(<?php if (get_option('pnfpb_subscribe_group_push_notification_icon')) {echo get_option('pnfpb_subscribe_group_push_notification_icon');} else { echo plugin_dir_url( __DIR__ ).'public/img/icon_push_subscribe.png';} ?>);width:16px; height:30px;overflow:hidden;border-radius:0%;margin:0px auto;background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
                    			</div>
                			</td>
            			</tr>
					</table>
				</td>
			</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_unsubscribe_button_text"><?php echo __("Group unsubscription button text",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_unsubscribe_button_text" name="pnfpb_ic_fcm_unsubscribe_button_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_unsubscribe_button_text' )) {echo get_option( 'pnfpb_ic_fcm_unsubscribe_button_text' );} else { echo __('Unsubscribe push notification',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">				
            		<table>
						<tr>
                			<td class="column-columnname">
                    			<input type="button" value="<?php echo __("Select Image",PNFPB_TD);?>" id="pnfpb_select_unsubscribe_group_push_notification_icon" class="pnfpb_ic_push_pwa_settings_upload_icon" />
                    			<input type="hidden" id="pnfpb_unsubscribe_group_push_notification_icon" name="pnfpb_unsubscribe_group_push_notification_icon" value="<?php if (get_option('pnfpb_unsubscribe_group_push_notification_icon')) {echo get_option('pnfpb_unsubscribe_group_push_notification_icon');} else { echo plugin_dir_url( __DIR__ ).'public/img/icon_push_unsubscribe.png';} ?>" />
                			</td>
						</tr>
						<tr>							
							<td class="column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_unsubscribe_group_push_notification_icon_preview" style="background-image: url(<?php if (get_option('pnfpb_unsubscribe_group_push_notification_icon')) {echo get_option('pnfpb_unsubscribe_group_push_notification_icon');} else { echo plugin_dir_url( __DIR__ ).'public/img/icon_push_unsubscribe.png';} ?>);width:16px; height:30px;overflow:hidden;border-radius:0%;margin:0px auto;background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
                    			</div>
                			</td>
            			</tr>
					</table>
				</td>
			</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_group_subscribe_dialog_text"><?php echo __("Group subscription dialog text",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_group_subscribe_dialog_text" name="pnfpb_ic_fcm_group_subscribe_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_group_subscribe_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_group_subscribe_dialog_text' );} else { echo __('Would you like to subscribe notifications for this group?',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"><?php echo __("Group subscription dialog text after complete",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_group_subscribe_dialog_text_confirm" name="pnfpb_ic_fcm_group_subscribe_dialog_text_confirm" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_group_subscribe_dialog_text_confirm' )) {echo get_option( 'pnfpb_ic_fcm_group_subscribe_dialog_text_confirm' );} else { echo __('Your device is subscribed',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_group_unsubscribe_dialog_text"><?php echo __("Group unsubscription dialog text",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_group_unsubscribe_dialog_text" name="pnfpb_ic_fcm_group_unsubscribe_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_group_unsubscribe_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_group_unsubscribe_dialog_text' );} else { echo __('Would you like to unsubscribe notifications for this group?',PNFPB_TD);} ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"><?php echo __("Group unsubscription dialog text after complete",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm" name="pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm' )) {echo get_option( 'pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm' );} else { echo __('Your device is unsubscribed',PNFPB_TD);} ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row"><td class="pnfpb_ic_push_settings_table_label_column column-columnname"><h3 class="pnfpb_ic_push_settings_header"><?php echo __("Shortcode subscribe options text customization [subscribe_PNFPB_push_notification]",PNFPB_TD);?></h3></td></tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_button_shortcode_text"><?php echo __("Shortcode - subscription button text",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_button_shortcode_text" name="pnfpb_ic_fcm_subscribe_button_shortcode_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_button_shortcode_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_button_shortcode_text' );} else { echo __('Subscribe to push notifications',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_unsubscribe_button_shortcode_text"><?php echo __("Shortcode - unsubscription button text",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_unsubscribe_button_shortcode_text" name="pnfpb_ic_fcm_unsubscribe_button_shortcode_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_unsubscribe_button_shortcode_text' )) {echo get_option( 'pnfpb_ic_fcm_unsubscribe_button_shortcode_text' );} else { echo __('Unsubscribe to push notifications',PNFPB_TD); } ?>" />
				</td>
    		</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_button_text_shortcode"><?php echo __("Shortcode - site subscribe/un-subscribe save text",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_save_button_text_shortcode" name="pnfpb_ic_fcm_subscribe_save_button_text_shortcode" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_save_button_text_shortcode' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_save_button_text_shortcode' );} else { echo __('Save',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_unsubscribe_button_text_shortcode"><?php echo __("Shortcode - site subscribe/un-subscribe cancel text",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode" name="pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode' )) {echo get_option( 'pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode' );} else { echo __('Cancel',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_shortcode_close_button_text"><?php echo __("Close",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_shortcode_close_button_text" name="pnfpb_ic_fcm_shortcode_close_button_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_shortcode_close_button_text' )) {echo get_option( 'pnfpb_ic_fcm_shortcode_close_button_text' );} else { echo __('Close',PNFPB_TD); } ?>" />
				</td>
    		</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text"><?php echo __("Sub-heading text while subscribing for (first time) push notification in shortcode popup box",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text" name="pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_subheading_notoken_dialog_text' );} else { echo __('Please wait...subscribing push notification is in progress.',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text"><?php echo __("Sub-heading text for the users with subscription in shortcode popup box",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text" name="pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_subheading_withtoken_dialog_text' );} else { echo __('You are subscribed. Change/Update subscriptions according to your choice.',PNFPB_TD); } ?>" />
				</td>
    		</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text"><?php echo __("Subscribe all notifications option text in shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_all_dialog_text" name="pnfpb_ic_fcm_subscribe_all_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_all_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_all_dialog_text' );} else { echo __('All notifications',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<?php
			
				$args = array(
					'public'   => true,
					'_builtin' => false
				); 
			
				$output = 'names'; // or objects
				$operator = 'and'; // 'and' or 'or'
			
				$custposttypes = get_post_types( $args, $output, $operator );
			
				foreach ( $custposttypes as $post_type ) {
					
					if ($post_type !== 'buddypress') {
				?>		
						<tr class="pnfpb_ic_push_settings_table_row">
    						<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_<?php echo $post_type; ?>_text"><?php echo __("Customize text for subscription ".$post_type,'PNFPB_TD');?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_<?php echo $post_type; ?>_dialog_text" name="pnfpb_ic_fcm_subscribe_<?php echo $post_type; ?>_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_'.$post_type.'_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_'.$post_type.'_dialog_text' );} else { echo __(ucwords($post_type),'PNFPB_TD'); } ?>" />
							</td>
    					</tr>						
				<?php		
					}
					
				}
			?>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text"><?php echo __("New post notifications option text in shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_post_dialog_text" name="pnfpb_ic_fcm_subscribe_post_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_post_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_post_dialog_text' );} else { echo __('New post',PNFPB_TD); } ?>" />
				</td>
    		</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text"><?php echo __("New BuddyPress activity notifications option text in shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_post_activity_dialog_text" name="pnfpb_ic_fcm_subscribe_post_activity_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_post_activity_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_post_activity_dialog_text' );} else { echo __('New post/activity',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text"><?php echo __("Subscribe all comments notifications option text in shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_all_comments_dialog_text" name="pnfpb_ic_fcm_subscribe_all_comments_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_all_comments_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_all_comments_dialog_text' );} else { echo __('Comments',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text"><?php echo __("Subscribe comments notifications only from my post/my BuddyPress activities option text in shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_my_comments_dialog_text" name="pnfpb_ic_fcm_subscribe_my_comments_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_my_comments_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_my_comments_dialog_text' );} else { echo __('Comments on my posts/my activities ',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text"><?php echo __("Subscribe Private messages option text in shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_private_message_dialog_text" name="pnfpb_ic_fcm_subscribe_private_message_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_private_message_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_private_message_dialog_text' );} else { echo __('Private message',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text"><?php echo __("Subscribe new member joined option text in shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_new_member_dialog_text" name="pnfpb_ic_fcm_subscribe_new_member_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_new_member_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_new_member_dialog_text' );} else { echo __('New member joined',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text"><?php echo __("Subscribe Friend request option text in shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_friend_request_dialog_text" name="pnfpb_ic_fcm_subscribe_friend_request_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_friend_request_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_friend_request_dialog_text' );} else { echo __('Friend request',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text"><?php echo __("Subscribe Friendship accepted text in shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_friendship_accepted_dialog_text" name="pnfpb_ic_fcm_subscribe_friendship_accepted_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_friendship_accepted_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_friendship_accepted_dialog_text' );} else { echo __('Friendship accepted ',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text"><?php echo __("Subscribe user avatar change option text in shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_user_avatar_dialog_text" name="pnfpb_ic_fcm_subscribe_user_avatar_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_user_avatar_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_user_avatar_dialog_text' );} else { echo __('User avatar change',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text"><?php echo __("Subscribe cover image change option text in shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_cover_image_dialog_text" name="pnfpb_ic_fcm_subscribe_cover_image_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_cover_image_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_cover_image_dialog_text' );} else { echo __('Cover image change',PNFPB_TD); } ?>" />
				</td>
    		</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text"><?php echo __("Un-subscribe all notifications option text in shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_unsubscribe_all_dialog_text" name="pnfpb_ic_fcm_unsubscribe_all_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_unsubscribe_all_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_unsubscribe_all_dialog_text' );} else { echo __('Unsubscribe all notifications',PNFPB_TD); } ?>" />
				</td>
    		</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text_confirm"><?php echo __("Site Subscription dialog text after complete using shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_dialog_text_confirm" name="pnfpb_ic_fcm_subscribe_dialog_text_confirm" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_dialog_text_confirm' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_dialog_text_confirm' );} else { echo __('Subscription option updated',PNFPB_TD); } ?>" />
				</td>
    		</tr>				
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_unsubscribe_dialog_text_confirm"><?php echo __("Site unsubscription dialog text after complete using shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_unsubscribe_dialog_text_confirm" name="pnfpb_ic_fcm_unsubscribe_dialog_text_confirm" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_unsubscribe_dialog_text_confirm' )) {echo get_option( 'pnfpb_ic_fcm_unsubscribe_dialog_text_confirm' );} else { echo __('Subscription option updated',PNFPB_TD);} ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row"><td class="pnfpb_ic_push_settings_table_label_column column-columnname"><h3 class="pwa-install-shortcode-customize-section pnfpb_ic_push_settings_header"><a id="pwa-install-shortcode-customize-section" href="#pwa-install-shortcode-customize-section"><?php echo __("PWA Install shortcode button customization",PNFPB_TD);?></a></h3><h5 class="pnfpb_ic_push_settings_header"><?php echo __("[PNFPB_PWA_PROMPT]",PNFPB_TD);?></h5></td></tr>
   	 		<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_install_pwa_shortcode_button_color">
						<?php echo __("Install PWA shortcode button background color",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_pwa_prompt_install_button_color pnfpb_ic_push_pwa_color" id="pnfpb_ic_fcm_install_pwa_shortcode_button_color" name="pnfpb_ic_fcm_install_pwa_shortcode_button_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_install_pwa_shortcode_button_color' )) {echo get_option( 'pnfpb_ic_fcm_install_pwa_shortcode_button_color' ); } else { echo '#000000';}?>" />
				</td>
			</tr>
   	 		<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_install_pwa_shortcode_button_text_color">
						<?php echo __("Install PWA shortcode button text color",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_pwa_prompt_install_button_color pnfpb_ic_push_pwa_color" id="pnfpb_ic_fcm_install_pwa_shortcode_button_text_color" name="pnfpb_ic_fcm_install_pwa_shortcode_button_text_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_install_pwa_shortcode_button_text_color' )) {echo get_option( 'pnfpb_ic_fcm_install_pwa_shortcode_button_text_color' ); } else { echo '#ffffff';}?>" />
				</td>
			</tr>
   	 		<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_install_pwa_shortcode_button_text_color">
						<?php echo __("Install PWA shortcode button text",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_pwa_prompt_install_button_color pnfpb_ic_push_pwa_color" id="pnfpb_ic_fcm_install_pwa_shortcode_button_text" name="pnfpb_ic_fcm_install_pwa_shortcode_button_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_install_pwa_shortcode_button_text' )) {echo get_option( 'pnfpb_ic_fcm_install_pwa_shortcode_button_text' ); } else { echo 'Install PWA';}?>" />
				</td>
			</tr>
   	 		<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<div class="pnfpb_row">
  						<div class="pnfpb_column">
    						<div class="pnfpb_card">				
								<label for="pnfpb-pwa-shortcode-install-icon"><?php echo __("Show PWA icon instead of text in PWA install shortcode button",'PNFPB_TD');?></label>
								<label class="pnfpb_switch">
									<input  id="pnfpb-pwa-shortcode-install-icon" name="pnfpb-pwa-shortcode-install-icon" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb-pwa-shortcode-install-icon' ) ); ?>  />	
									<span class="pnfpb_slider round"></span>
								</label>
								<label for="pnfpb-pwa-shortcode-install-icon">
									<?php echo __("If above option is enabled then PWA app icon 132px size which is uploaded in PWA -> ICON settings tab will be used as icon for PWA install widget. ",PNFPB_TD);?>
								</label>								
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class="column-columnname"><div class="pnfpb_column_full"><?php submit_button(__('Save changes',PNFPB_TD),'pnfpb_ic_push_save_configuration_button'); ?></div></td>
    		</tr>
  		</tbody>
	</table>
</form>
</div>