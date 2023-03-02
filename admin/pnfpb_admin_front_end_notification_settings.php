<?php
/**
* Plugin settings area to customize text for push notification subscription for frontend users
*
* @since 1.52.0
*/
?>

<h2 class="nav-tab-wrapper"><a href="options-general.php?page=pnfpb-icfcm-slug" class="nav-tab "><?php echo __("Push notification",PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_device_tokens_list" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_DEVICE_TOKENS_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_pwa_app_settings" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_PWA_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfmtest_notification" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_ONDEMANDPUSH_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_frontend_settings" class="nav-tab nav-tab-active"><?php echo __(PNFPB_PLUGIN_NM_FRONTEND_SETTINGS_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_button_settings" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_BUTTON_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_integrate_app" class="nav-tab"><?php echo __(PNFPB_PLUGIN_API_MOBILE_APP_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_settings_for_ngnix_server" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NGINX_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_action_scheduler" class="nav-tab"><?php echo __(PNFPB_PLUGIN_SCHEDULE_ACTIONS,PNFPB_TD);?></a></h2>

<div class="pnfpb_column_1000">

<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
    <?php settings_fields( 'pnfpb_icfcm_frontend_buttons'); ?>
    <?php do_settings_sections( 'pnfpb_icfcm_frontend_buttons' ); ?>
	
	<table class="pnfpb_ic_push_settings_table widefat fixed">
  		<tbody>
			<tr class="pnfpb_ic_push_settings_table_row"><td class="pnfpb_ic_push_settings_table_label_column column-columnname"><h3 class="pnfpb_ic_push_settings_header"><?php echo __("Customize Frontend subscription buttons and text",PNFPB_TD);?></h3></td></tr>
			<tr class="pnfpb_ic_push_settings_table_row"><td class="pnfpb_ic_push_settings_table_label_column column-columnname"><h4 class="pnfpb_ic_push_settings_header"><?php echo __("Front end subscription available only for BuddyPress users<br/>Front end push notification subscription menu will be in user profile<br/>members/username profile->settings->Push Notification subscription<br/>",PNFPB_TD);?><br/>Example: "https://domain name/members/user name/settings/push-subscription/"</h4></td></tr>
			<tr class="pnfpb_ic_push_settings_table_row">
            	<td class="pnfpb_ic_push_settings_table_label column-columnname">
					<div class="pnfpb_row">
						<div class="pnfpb_column_400">
							<div class="pnfpb_card">
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_frontend_enable_subscription">
									<label class="pnfpb_switch">
										<input  id="pnfpb_ic_fcm_frontend_enable_subsription" name="pnfpb_ic_fcm_frontend_enable_subscription" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_frontend_enable_subscription' ) ); ?>  />
										<span class="pnfpb_slider round"></span>
									</label>
										<?php echo __("Enable/disable Frontend subscription in BuddyPress user profile menu",PNFPB_TD);?>
								</label>
							</div>
						</div>
					</div>
				</td>
			</tr>
   	 		<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_frontend_background_button_color">
						<?php echo __("Frontend menu background color",PNFPB_TD);?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_pwa_prompt_install_button_color pnfpb_ic_push_pwa_color" id="pnfpb_ic_fcm_frontend_subscribe_button_color" name="pnfpb_ic_fcm_frontend_subscribe_button_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_frontend_subscribe_button_color' )) {echo get_option( 'pnfpb_ic_fcm_frontend_subscribe_button_color' ); } else { echo '#aaaaaa';}?>" />
				</td>
			</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_frontend_settings_post_button_text"><?php echo __("Subscription text/label for Post",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_frontend_settings_post_text" name="pnfpb_ic_fcm_frontend_settings_post_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_frontend_settings_post_text' )) {echo get_option( 'pnfpb_ic_fcm_frontend_settings_post_text' );} else { echo __('Post',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_frontend_settings_activities_button_text"><?php echo __("Subscription text/label for Activities",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_frontend_settings_activities_text" name="pnfpb_ic_fcm_frontend_settings_activities_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_frontend_settings_activities_text' )) {echo get_option( 'pnfpb_ic_fcm_frontend_settings_activities_text' );} else { echo __('Activities',PNFPB_TD); } ?>" />
				</td>
    		</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_frontend_settings_comments_text"><?php echo __("Subscription text/label for comments",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_frontend_settings_comments_text" name="pnfpb_ic_fcm_frontend_settings_comments_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_frontend_settings_comments_text' )) {echo get_option( 'pnfpb_ic_fcm_frontend_settings_comments_text' );} else { echo __('Comments',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_frontend_settings_mycomments_text"><?php echo __("Subscription text/label for comments on My activities/My Post",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_frontend_settings_mycomments_text" name="pnfpb_ic_fcm_frontend_settings_mycomments_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_frontend_settings_mycomments_text' )) {echo get_option( 'pnfpb_ic_fcm_frontend_settings_mycomments_text' );} else { echo __('Comments on My activity/My Post',PNFPB_TD); } ?>" />
				</td>
    		</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_frontend_settings_privatemessage_text"><?php echo __("Subscription text/label for private message",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_frontend_settings_privatemessage_text" name="pnfpb_ic_fcm_frontend_settings_privatemessage_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_frontend_settings_privatemessage_text' )) {echo get_option( 'pnfpb_ic_fcm_frontend_settings_privatemessage_text' );} else { echo __('Private message',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_frontend_settings_newmember_text"><?php echo __("Subscription text/label for new member joined",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_frontend_settings_newmember_text" name="pnfpb_ic_fcm_frontend_settings_newmember_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_frontend_settings_newmember_text' )) {echo get_option( 'pnfpb_ic_fcm_frontend_settings_newmember_text' );} else { echo 'New member joined';} ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_frontend_settings_friend_request_text"><?php echo __("Subscription text/label for Friendship request",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_frontend_settings_friend_request_text" name="pnfpb_ic_fcm_frontend_settings_friend_request_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_frontend_settings_friend_request_text' )) {echo get_option( 'pnfpb_ic_fcm_frontend_settings_friend_request_text' );} else { echo __('Friendship request',PNFPB_TD);} ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_frontend_settings_friend_accept_text"><?php echo __("Subscription text/label for Friendship accepted",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_frontend_settings_friend_accept_text" name="pnfpb_ic_fcm_frontend_settings_friend_accept_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_frontend_settings_friend_accept_text' )) {echo get_option( 'pnfpb_ic_fcm_frontend_settings_friend_accept_text' );} else { echo __('Friendship accepted',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_frontend_settings_avatar_change_text"><?php echo __("Subscription text/label for Avatar change",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_frontend_settings_avatar_change_text" name="pnfpb_ic_fcm_frontend_settings_avatar_change_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_frontend_settings_avatar_change_text' )) {echo get_option( 'pnfpb_ic_fcm_frontend_settings_avatar_change_text' );} else { echo __('Avatar change',PNFPB_TD); } ?>" />
				</td>
    		</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_frontend_settings_coverimage_change_text"><?php echo __("Subscription text for Cover image change",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_frontend_settings_coverimage_change_text" name="pnfpb_ic_fcm_frontend_settings_coverimage_change_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_frontend_settings_coverimage_change_text' )) {echo get_option( 'pnfpb_ic_fcm_frontend_settings_coverimage_change_text' );} else { echo __('Cover image change',PNFPB_TD); } ?>" />
				</td>
    		</tr>
			<tr>
				<td class="column-columnname"><div class="pnfpb_column_full"><?php submit_button(__('Save changes',PNFPB_TD),'pnfpb_ic_push_frontend_save_configuration_button'); ?></div></td>
    		</tr>
  		</tbody>
	</table>
</form>
</div>