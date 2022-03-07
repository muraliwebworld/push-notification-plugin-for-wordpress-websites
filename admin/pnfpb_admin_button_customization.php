<?php
/**
* Plugin settings area to customize buttons for subscribe/unsubscribe push notifications
*
* @since 1.0.0
*/
?>

<h2 class="nav-tab-wrapper"><a href="options-general.php?page=pnfpb-icfcm-slug" class="nav-tab ">Push notification</a><a href="options-general.php?page=pnfpb_icfm_device_tokens_list" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_DEVICE_TOKENS_HEADER);?></a><a href="options-general.php?page=pnfpb_icfm_pwa_app_settings" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_PWA_HEADER);?></a><a href="options-general.php?page=pnfpb_icfmtest_notification" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_ONDEMANDPUSH_HEADER);?></a><a href="options-general.php?page=pnfpb_icfm_button_settings" class="nav-tab nav-tab-active"><?php echo __(PNFPB_PLUGIN_NM_BUTTON_HEADER);?></a><a href="options-general.php?page=pnfpb_icfm_integrate_app" class="nav-tab"><?php echo 'Integrate app API';?></a></h2>

<h2 class="pnfpb_ic_push_settings_header"><?php echo __("Subscribe/un-subscribe notification button customization",PNFPB_TD);?></h2>

<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
    <?php settings_fields( 'pnfpb_icfcm_buttons'); ?>
    <?php do_settings_sections( 'pnfpb_icfcm_buttons' ); ?>
	
	<table class="pnfpb_ic_push_settings_table widefat fixed">
  		<tbody>
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
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_button_text"><?php echo __("Group subscription button text",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_button_text" name="pnfpb_ic_fcm_subscribe_button_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_button_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_button_text' );} else { echo 'Subscribe to push notifications'; } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_unsubscribe_button_text"><?php echo __("Group unsubscription button text",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_unsubscribe_button_text" name="pnfpb_ic_fcm_unsubscribe_button_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_unsubscribe_button_text' )) {echo get_option( 'pnfpb_ic_fcm_unsubscribe_button_text' );} else { echo 'Unsubscribe to push notifications'; } ?>" />
				</td>
    		</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_group_subscribe_dialog_text"><?php echo __("Group subscription dialog text",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_group_subscribe_dialog_text" name="pnfpb_ic_fcm_group_subscribe_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_group_subscribe_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_group_subscribe_dialog_text' );} else { echo 'Would you like to subscribe notifications for this group?'; } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"><?php echo __("Group subscription dialog text after complete",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_group_subscribe_dialog_text_confirm" name="pnfpb_ic_fcm_group_subscribe_dialog_text_confirm" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_group_subscribe_dialog_text_confirm' )) {echo get_option( 'pnfpb_ic_fcm_group_subscribe_dialog_text_confirm' );} else { echo 'Your device is subscribed'; } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_group_unsubscribe_dialog_text"><?php echo __("Group unsubscription dialog text",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_group_unsubscribe_dialog_text" name="pnfpb_ic_fcm_group_unsubscribe_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_group_unsubscribe_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_group_unsubscribe_dialog_text' );} else { echo 'Would you like to unsubscribe notifications for this group?';} ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"><?php echo __("Group unsubscription dialog text after complete",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm" name="pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm' )) {echo get_option( 'pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm' );} else { echo 'Your device is unsubscribed';} ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row"><td class="pnfpb_ic_push_settings_table_label_column column-columnname"><h3 class="pnfpb_ic_push_settings_header"><?php echo __("Shortcode subscribe options text customization ('subscribe_PNFPB_push_notification')",PNFPB_TD);?></h3></td></tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_button_shortcode_text"><?php echo __("Shortcode - subscription button text",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_button_shortcode_text" name="pnfpb_ic_fcm_subscribe_button_shortcode_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_button_shortcode_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_button_shortcode_text' );} else { echo 'Subscribe to push notifications'; } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_unsubscribe_button_shortcode_text"><?php echo __("Shortcode - unsubscription button text",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_unsubscribe_button_shortcode_text" name="pnfpb_ic_fcm_unsubscribe_button_shortcode_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_unsubscribe_button_shortcode_text' )) {echo get_option( 'pnfpb_ic_fcm_unsubscribe_button_shortcode_text' );} else { echo 'Unsubscribe to push notifications'; } ?>" />
				</td>
    		</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_button_text_shortcode"><?php echo __("Shortcode - site subscribe/un-subscribe save text",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_save_button_text_shortcode" name="pnfpb_ic_fcm_subscribe_save_button_text_shortcode" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_save_button_text_shortcode' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_save_button_text_shortcode' );} else { echo 'Save'; } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_unsubscribe_button_text_shortcode"><?php echo __("Shortcode - site subscribe/un-subscribe cancel text",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode" name="pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode' )) {echo get_option( 'pnfpb_ic_fcm_unsubscribe_cancel_button_text_shortcode' );} else { echo 'Cancel'; } ?>" />
				</td>
    		</tr>				
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text"><?php echo __("Subscribe all notifications option text in shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_all_dialog_text" name="pnfpb_ic_fcm_subscribe_all_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_all_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_all_dialog_text' );} else { echo 'Subscribe all notifications'; } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text"><?php echo __("Subscribe new post/BuddyPress activity notifications option text in shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_post_activity_dialog_text" name="pnfpb_ic_fcm_subscribe_post_activity_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_post_activity_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_post_activity_dialog_text' );} else { echo 'Subscribe new post/new BuddyPress activity notifications'; } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text"><?php echo __("Subscribe all comments notifications option text in shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_all_comments_dialog_text" name="pnfpb_ic_fcm_subscribe_all_comments_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_all_comments_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_all_comments_dialog_text' );} else { echo 'Subscribe all new comments notifications'; } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text"><?php echo __("Subscribe comments notifications only from my post/my BuddyPress activities option text in shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_my_comments_dialog_text" name="pnfpb_ic_fcm_subscribe_my_comments_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_my_comments_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_my_comments_dialog_text' );} else { echo 'Subscribe comments notifications only from my post/my BuddyPress activities '; } ?>" />
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text"><?php echo __("Un-subscribe all notifications option text in shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_unsubscribe_all_dialog_text" name="pnfpb_ic_fcm_unsubscribe_all_dialog_text" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_unsubscribe_all_dialog_text' )) {echo get_option( 'pnfpb_ic_fcm_unsubscribe_all_dialog_text' );} else { echo 'Un-subscribe all notifications'; } ?>" />
				</td>
    		</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_subscribe_dialog_text_confirm"><?php echo __("Site Subscription dialog text after complete using shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_dialog_text_confirm" name="pnfpb_ic_fcm_subscribe_dialog_text_confirm" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_subscribe_dialog_text_confirm' )) {echo get_option( 'pnfpb_ic_fcm_subscribe_dialog_text_confirm' );} else { echo 'Your device is subscribed'; } ?>" />
				</td>
    		</tr>				
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_unsubscribe_dialog_text_confirm"><?php echo __("Site unsubscription dialog text after complete using shortcode",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_unsubscribe_dialog_text_confirm" name="pnfpb_ic_fcm_unsubscribe_dialog_text_confirm" type="text" value="<?php if (get_option( 'pnfpb_ic_fcm_unsubscribe_dialog_text_confirm' )) {echo get_option( 'pnfpb_ic_fcm_unsubscribe_dialog_text_confirm' );} else { echo 'Your device is unsubscribed';} ?>" />
				</td>
    		</tr>
			<tr>
				<td class="column-columnname"> <div class="col-sm-10"><?php submit_button(); ?></div></td>
    		</tr>
  		</tbody>
	</table>
</form>