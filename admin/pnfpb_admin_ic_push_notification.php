<?php
/**
* Plugin settings area to store FireBase configuration, API key, server key
* Custom title for BuddyPress activity related push notification
*
* @since 1.0.0
*/
?>
<h1 class="pnfpb_ic_push_settings_header"><?php echo __("PNFPB - Settings for Push Notification",PNFPB_TD);?></h1>
<div class="pnfpb_admin_top_menu">
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb-icfcm-slug" class="tab active"><?php echo __("Push Settings",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_device_tokens_list" class="tab "><?php echo __("Device tokens",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_pwa_app_settings" class="tab "><?php echo __("PWA",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfmtest_notification" class="tab "><?php echo __("One time push",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc" class="tab"><?php echo __("Notifications",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_frontend_settings" class="tab "><?php echo __("Frontend settings",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_button_settings" class="tab "><?php echo __("Customize buttons",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_integrate_app" class="tab "><?php echo __("Mobile app",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_settings_for_ngnix_server" class="tab "><?php echo __("NGINX",PNFPB_TD);?></a>
	<a href="<?php echo admin_url();?>admin.php?page=pnfpb_icfm_action_scheduler&s=pnfpb&action=-1&paged=1&action2=-1" class="tab "><?php echo __("Action Scheduler",PNFPB_TD);?></a>
</div>
<div class="pnfpb_column_left_900">
<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
    <?php settings_fields( 'pnfpb_icfcm_group'); ?>
    <?php do_settings_sections( 'pnfpb_icfcm_group' ); ?>
	<?php
		if (get_option( 'pnfpb_bell_icon_prompt_options_on_off','0' ) === '0') {
					
			update_option( 'pnfpb_bell_icon_prompt_options_on_off', '1' );
					
		}
	if ( ! class_exists( 'OneSignal' )  && get_option('pnfpb_onesignal_push') === '1') {
	?>
    	<div class="notice notice-error is-dismissible">
        	<p><?php _e( 'Onesignal plugin is required. Please install Onesignal plugin to enable onesignal as push notification provider', 'PNFPB_TD' ); ?></p>
    	</div>		
	<?php
	}
    ?>
<?php

	$args = array(
  		'public'   => true,
  		'_builtin' => false
	); 
	
	$output = 'names'; // or objects
	$operator = 'and'; // 'and' or 'or'
	$custposttypes = get_post_types( $args, $output, $operator );
    
    $blog_title = get_bloginfo( 'name' );
	
	if (get_option('pnfpb_sa_json_data') == false || get_option('pnfpb_sa_json_data') == '') {
		$pnfpb_sa = false;
	}
	else {
		$pnfpb_sa = true;
	}
        
    if (get_option( 'pnfpb_ic_fcm_activity_title' ) ==  false || get_option( 'pnfpb_ic_fcm_activity_title' ) ==  '') {
            
            $activitytitle = '[member name] posted new activity '.$blog_title;
    }
    else
    {
           $activitytitle = get_option( 'pnfpb_ic_fcm_activity_title' );
    }
	
    if (get_option( 'pnfpb_ic_fcm_activity_message' ) ==  false || get_option( 'pnfpb_ic_fcm_activity_message' ) ==  '') {
            
            $activitymessage = '';
    }
    else
    {
           $activitymessage = get_option( 'pnfpb_ic_fcm_activity_message' );
    }
	
    if (get_option( 'pnfpb_ic_fcm_group_activity_message' ) ==  false || get_option( 'pnfpb_ic_fcm_group_activity_message' ) ==  '') {
            
            $groupactivitymessage = '';
    }
    else
    {
           $groupactivitymessage = get_option( 'pnfpb_ic_fcm_group_activity_message' );
    }	
        
    if (get_option( 'pnfpb_ic_fcm_group_activity_title' ) ==  false || get_option( 'pnfpb_ic_fcm_group_activity_title' ) ==  '') {
            
            $activitygroup = '[member name] posted a new group post in [group name]';
    }
    else
    {
            $activitygroup = get_option( 'pnfpb_ic_fcm_group_activity_title' );
    }        
        
    if (get_option( 'pnfpb_ic_fcm_comment_activity_title' ) ==  false || get_option( 'pnfpb_ic_fcm_comment_activity_title' ) ==  '') {
            
            $activitycomment = '[member name] posted a new comment posted in '.$blog_title;
    }
    else
    {
            $activitycomment = get_option( 'pnfpb_ic_fcm_comment_activity_title' );
    }
	
    if (get_option( 'pnfpb_ic_fcm_comment_activity_message' ) ==  false || get_option( 'pnfpb_ic_fcm_comment_activity_message' ) ==  '') {
            
            $commentactivitymessage = '';
    }
    else
    {
           $commentactivitymessage = get_option( 'pnfpb_ic_fcm_comment_activity_message' );
    }
	
    if (get_option( 'pnfpb_ic_fcm_bprivatemessage_content' ) ==  false || get_option( 'pnfpb_ic_fcm_bprivatemessage_content' ) ==  '') {
            
            $privatemessagecontent = '';
    }
    else
    {
           $privatemessagecontent = get_option( 'pnfpb_ic_fcm_bprivatemessage_content' );
    }
	
    if (get_option( 'pnfpb_ic_fcm_new_member_content' ) ==  false || get_option( 'pnfpb_ic_fcm_new_member_content' ) ==  '') {
            
            $newmembercontent = '';
    }
    else
    {
           $newmembercontent = get_option( 'pnfpb_ic_fcm_new_member_content' );
    }
	
    if (get_option( 'pnfpb_ic_fcm_friendship_request_content' ) ==  false || get_option( 'pnfpb_ic_fcm_friendship_request_content' ) ==  '') {
            
            $friendshiprequestcontent = '';
    }
    else
    {
           $friendshiprequestcontent = get_option( 'pnfpb_ic_fcm_friendship_request_content' );
    }
	
    if (get_option( 'pnfpb_ic_fcm_friendship_accept_content' ) ==  false || get_option( 'pnfpb_ic_fcm_friendship_accept_content' ) ==  '') {
            
            $friendshipacceptcontent = '';
    }
    else
    {
           $friendshipacceptcontent = get_option( 'pnfpb_ic_fcm_friendship_accept_content' );
    }	
	
    if (get_option( 'pnfpb_ic_fcm_avatar_change_content' ) ==  false || get_option( 'pnfpb_ic_fcm_avatar_change_content' ) ==  '') {
            
            $avatarchangecontent = '';
    }
    else
    {
           $avatarchangecontent = get_option( 'pnfpb_ic_fcm_avatar_change_content' );
    }
	
    if (get_option( 'pnfpb_ic_fcm_cover_image_change_content' ) ==  false || get_option( 'pnfpb_ic_fcm_cover_image_change_content' ) ==  '') {
            
            $coverimagechangecontent = '';
    }
    else
    {
           $coverimagechangecontent = get_option( 'pnfpb_ic_fcm_cover_image_change_content' );
    }
	
    if (get_option( 'pnfpb_ic_fcm_group_details_updated_content' ) ==  false || get_option( 'pnfpb_ic_fcm_group_details_updated_content' ) ==  '') {
            
            $groupdetailsupdatedcontent = '';
    }
    else
    {
           $groupdetailsupdatedcontent = get_option( 'pnfpb_ic_fcm_group_details_updated_content' );
    }
	
    if (get_option( 'pnfpb_ic_fcm_group_invitation_content' ) ==  false || get_option( 'pnfpb_ic_fcm_group_invitation_content' ) ==  '') {
            
            $groupinvitationcontent = '';
    }
    else
    {
           $groupinvitationcontent = get_option( 'pnfpb_ic_fcm_group_invitation_content' );
    }
	
    if (get_option( 'pnfpb_ic_fcm_buddypress_new_user_registration_content_enable' ) ==  false || get_option( 'pnfpb_ic_fcm_buddypress_new_user_registration_content_enable' ) ==  '') {
            
            $newuserregistrationcontent = '';
    }
    else
    {
           $newuserregistrationcontent = get_option( 'pnfpb_ic_fcm_buddypress_new_user_registration_content_enable' );
    }
	
    if (get_option( 'pnfpb_ic_fcm_buddypress_contact_form7_content_enable' ) ==  false || get_option( 'pnfpb_ic_fcm_buddypress_contact_form7_content_enable' ) ==  '') {
            
            $contactform7content = '';
    }
    else
    {
           $contactform7content = get_option( 'pnfpb_ic_fcm_buddypress_contact_form7_content_enable' );
    }
	
	$pnfpb_popup_subscribe_icon = plugin_dir_url( __DIR__ ).'public/img/pushbell-pnfpb.png';

?>
<h2 class="pnfpb_ic_push_settings_header2"><?php echo __("Enable/Disable push notifications for following types",PNFPB_TD);?></h2>
<p><?php echo __("If schedule is enabled then push notification will be sent as per selected schedule otherwise it will be sent whenever new item is posted.<br/>BuddyPress notifications will work only when BuddyPress plugin is installed and active.<br/><b>If you have more than 1000 subscribers, enable schedule in background mode(asynchronous).<br/>Refer scheduled action tab for background scheduled jobs</b><br/>",PNFPB_TD);?></p>
<table class="pnfpb_ic_push_notification_settings_table widefat fixed" cellspacing="0">
    <tbody>
		<tr class="pnfpb_ic_push_settings_table_row">
            <td class="pnfpb_ic_push_settings_table_column column-columnname">
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
						<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_push_prompt_enable">
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_fcm_push_prompt_enable" name="pnfpb_ic_fcm_push_prompt_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_push_prompt_enable' ) ); ?>  />
									<span class="pnfpb_slider round"></span>
								</label>
									<?php echo __("Show custom prompt to subscribe push notification",'PNFPB_TD');?>
							</label>
							<button type="button" class="pnfpb_custom_push_prompt_button" onclick="toggle_custom_push_prompt_form()"><?php echo __("Customize",PNFPB_TD); ?></button>
						</div>
						<div>
							<?php echo __("It is mandatory, if safari browser is used for push notification and also custom prompt is needed for Firefox android",PNFPB_TD);?>								
						</div>						
					</div>
				</div>
				<div class="pnfpb_ic_push_prompt_form pnfpb_column_400">
					<table class="pnfpb_ic_push_firebase_settings_table widefat fixed">
						<thead>
							<tr>
								<th>
									<?php echo __("Turn ON prompt style checkbox to display custom prompt style-1 or 2 followed by turn on radio button of prompt style 1 or 2. If cancel button is clicked on custom prompt push notification by front end user then custom prompt will not be displayed for next 7 days.",PNFPB_TD);?>
								</th>
							</tr>
						</thead>						
    					<tbody>
							<tr class="pnfpb_ic_push_settings_table_row pnfpb_ic_push_settings_table_border_bottom">
								<td class="column-columnname pnfpb-push-msg-model-column-head widefat">
									<div class="pnfpb-push-msg-model-column">
										<div class="pnfpb-push-msg-model-outer-container">
											<div class="pnfpb-push-msg-model-container">
												<div class="pnfpb-push-model-icon">
													<div class="pnfpb-push-msg-model-square"></div>																																	</div>
												<div class="pnfpb-push-msg-model-text-layout">
													<div class="pnfpb-push-msg-model-text-long-line"></div>
													<div class="pnfpb-push-msg-model-text-line"></div>
													<div class="pnfpb-push-msg-model-cancel-button"></div>
													<div class="pnfpb-push-msg-model-yes-button"></div>
												</div>
											</div>
											<div class="pnfpb-push-msg-model-prompt-button-container">
												<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_prompt_on_off">
													<?php echo __("Prompt style",'PNFPB_TD');?>
												</label>
												<label class="pnfpb_switch">
													<input  id="pnfpb_ic_fcm_prompt_on_off" name="pnfpb_ic_fcm_prompt_on_off" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_prompt_on_off' ) ); ?>  />
													<span class="pnfpb_slider round"></span>
												</label>
											</div>												
										</div>									
										<div class="pnfpb-push-msg-model-prompt-button-container">
											<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container pnfpb_margin_left_4 pnfpb_padding_top_8">
												<?php echo __("Prompt Style-1",'PNFPB_TD');?>
												<input  id="pnfpb_ic_fcm_prompt_style" name="pnfpb_ic_fcm_prompt_style" type="radio" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_prompt_style' ) ); ?>  />
												<span class="pnfpb_checkmark pnfpb_margin_top_6"></span>
											</label>
										</div>
									</div>
									<div class="pnfpb-push-msg-model-column">
										<div class="pnfpb-push-msg-model-outer-container">
											<div class="pnfpb-push-msg-vertical-model-container">
												<div class="pnfpb-push-msg-vertical-model-text-layout">
													<div class="pnfpb-push-vertical-model-icon">
														<div class="pnfpb-push-msg-model-square"></div>																										</div>														
													<div class="pnfpb-push-msg-vertical-model-text-long-line"></div>
													<div class="pnfpb-push-msg-vertical-model-text-line"></div>
													<div class="pnfpb-push-msg-vertical-model-cancel-button"></div>
													<div class="pnfpb-push-msg-vertical-model-yes-button"></div>
												</div>
											</div>
										</div>
										<div class="pnfpb-push-msg-model-prompt-button-container">
											<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container pnfpb_margin_left_4 pnfpb_padding_top_8">
												<?php echo __("Prompt Style-2",'PNFPB_TD');?>
												<input  id="pnfpb_ic_fcm_prompt_style" name="pnfpb_ic_fcm_prompt_style" type="radio" value="2" <?php checked( '2', get_option( 'pnfpb_ic_fcm_prompt_style' ) ); ?>  />
												<span class="pnfpb_checkmark pnfpb_margin_top_6"></span>
											</label>
										</div>
									</div>
									<div class="pnfpb-push-msg-model-column">
										<div class="pnfpb-push-msg-model-outer-container">				
											<div class="pnfpb-push-msg-vertical-model-container">
												<div class="pnfpb-push-msg-vertical-model-text-layout">
													<div class="pnfpb-push-vertical-model-bell">
														<div class="pnfpb-push-msg-vertical-model-bell-square">
															<img src="<?php echo $pnfpb_popup_subscribe_icon; ?>" width="30px" height="30px" />
														</div>																																											</div>														
												</div>
											</div>
										</div>
										<div class="pnfpb-push-msg-model-prompt-button-container">
											<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_prompt_style3">
												<?php echo __("Bell prompt",'PNFPB_TD');?>
											</label>
											<label class="pnfpb_switch">
												<input  id="pnfpb_ic_fcm_prompt_style3" name="pnfpb_ic_fcm_prompt_style3" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_prompt_style3' ) ); ?>  />
												<span class="pnfpb_slider round"></span>
											</label>
										</div>
									</div>									
								</td>
							</tr>
							<tr class="pnfpb_ic_push_settings_table_row pnfpb_ic_push_settings_table_border_bottom">
								<td class="pnfpb_ic_push_settings_table_label_column column-columnname pnfpb_ic_push_settings_table_label_custom_prompt_column">
								<table class="pnfpb_ic_push_firebase_settings_table widefat fixed">
									<thead>
										<tr>
											<th>
												<?php echo "<b>".__("Customize prompt style color and text",PNFPB_TD)."</b>";?>
											</th>
										</tr>
									</thead>									
									<tbody>
    									<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname pnfpb_ic_push_settings_table_label_custom_prompt_column">
												<p>
													<?php echo __("Custom prompt Icon(recommended 80x80 pixels or less than 80x80 pixels)",PNFPB_TD);?>
												</p>
												<table>
													<tr>
                										<td class="column-columnname">
                    										<button id="pnfpb_ic_fcm_popup_custom_prompt_icon" class="pnfpb_ic_push_settings_upload_icon">
																<?php echo __("Upload Icon",PNFPB_TD);?>
															</button>
                    										<input type="hidden" id="pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon" name="pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon" value="<?php if (get_option( 'pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon' )) { echo get_option('pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon'); } else { echo plugin_dir_url( __DIR__ ).'public/img/pushbell-pnfpb.png';} ?>" />
                										</td>
            										</tr>
													<tr>
                										<td class="column-columnname">
                    										<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        										<div id="pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon' )) { echo get_option('pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon'); } else { echo plugin_dir_url( __DIR__ ).'public/img/pushbell-pnfpb.png';} ?>);width:32px; height:32px;overflow:hidden;border-radius:50%;margin:20px auto;background-position:center;background-repeat:no-repeat;background-size:cover;">
																</div>
                    										</div>
                										</td>
            										</tr>
												</table>
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
											<td class="pnfpb_ic_push_settings_table_label_column column-columnname pnfpb_ic_push_settings_table_label_custom_prompt_column">
												<p><?php echo __("Custom prompt Animation style",'PNFPB_TD');?></p>
												<select id="pnfpb_ic_fcm_custom_prompt_animation" name="pnfpb_ic_fcm_custom_prompt_animation">
					    							<option value="slideDown" <?php if (get_option( 'pnfpb_ic_fcm_custom_prompt_animation' ) === 'slideDown'){ echo 'selected';} else {echo '';} ?>><?php echo __("Slide Down",PNFPB_TD);?></option>
													<option value="slideUp" <?php if (get_option( 'pnfpb_ic_fcm_custom_prompt_animation' ) === 'slideUp'){ echo 'selected';} else {echo '';} ?>><?php echo __("Slide Up",PNFPB_TD);?></option>
												</select>
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname pnfpb_ic_push_settings_table_label_custom_prompt_column">		
												<p><?php echo __("Header text in custom prompt",'PNFPB_TD');?></p>
												<textarea  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_custom_prompt_header_text" name="pnfpb_ic_fcm_custom_prompt_header_text" ><?php if(get_option( 'pnfpb_ic_fcm_custom_prompt_header_text' )) {echo get_option( 'pnfpb_ic_fcm_custom_prompt_header_text' );} else { echo __("We would like to show you notifications for the latest news and updates.",'PNFPB_TD');} ?></textarea>
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">		
												<p><?php echo __("If cancel button is pressed while subscribing, show custom prompt after below number of days",'PNFPB_TD');?></p>
												<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_custom_prompt_show_again_days" name="pnfpb_ic_fcm_custom_prompt_show_again_days" type="number" value="<?php if(get_option( 'pnfpb_ic_fcm_custom_prompt_show_again_days' )) {echo get_option( 'pnfpb_ic_fcm_custom_prompt_show_again_days' );} else { echo "7";} ?>"/>
											</td>
										</tr>										
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo __("Allow Notification Button text color",'PNFPB_TD');?></p>
												<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_custom_prompt_allow_button_background" id="pnfpb_ic_fcm_custom_prompt_allow_button_text_color" name="pnfpb_ic_fcm_custom_prompt_allow_button_text_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_custom_prompt_allow_button_text_color' )) {echo get_option( 'pnfpb_ic_fcm_custom_prompt_allow_button_text_color' ); } else { echo '#ffffff'; }?>" />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo __("Push notification subscribe Button background color",'PNFPB_TD');?></p>
												<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_custom_prompt_allow_button_background" id="pnfpb_ic_fcm_push_custom_prompt_allow_button_background" name="pnfpb_ic_fcm_push_custom_prompt_allow_button_background" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_push_custom_prompt_allow_button_background' )) {echo get_option( 'pnfpb_ic_fcm_push_custom_prompt_allow_button_background' ); } else { echo '#0078d1';}?>" />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo __("Allow notification button text",'PNFPB_TD');?></p>
												<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_custom_prompt_allow_button_text" name="pnfpb_ic_fcm_custom_prompt_allow_button_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_custom_prompt_allow_button_text' )) {echo get_option( 'pnfpb_ic_fcm_custom_prompt_allow_button_text' );} else { echo __("Allow",'PNFPB_TD');} ?>"  />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo __("Cancel Notification Button text color",'PNFPB_TD');?></p>
												<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_custom_prompt_cancel_button_background" id="pnfpb_ic_fcm_custom_prompt_cancel_button_text_color" name="pnfpb_ic_fcm_custom_prompt_cancel_button_text_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_custom_prompt_cancel_button_text_color' )) {echo get_option( 'pnfpb_ic_fcm_custom_prompt_cancel_button_text_color' ); } else { echo '#0078d1'; }?>" />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo __("Cancel Button background color",'PNFPB_TD');?></p>
												<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_custom_prompt_cancel_button_background" id="pnfpb_ic_fcm_push_custom_prompt_cancel_button_background" name="pnfpb_ic_fcm_push_custom_prompt_cancel_button_background" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_push_custom_prompt_cancel_button_background' )) {echo get_option( 'pnfpb_ic_fcm_push_custom_prompt_cancel_button_background' ); } else { echo '#ffffff';}?>" />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo __("Cancel button text",'PNFPB_TD');?></p>
												<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_custom_prompt_cancel_button_text" name="pnfpb_ic_fcm_custom_prompt_cancel_button_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_custom_prompt_cancel_button_text' )) {echo get_option( 'pnfpb_ic_fcm_custom_prompt_cancel_button_text' );} else { echo __("Cancel",'PNFPB_TD');} ?>"  />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo __("Close Button text color",'PNFPB_TD');?></p>
												<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_custom_prompt_close_button_background" id="pnfpb_ic_fcm_custom_prompt_close_button_text_color" name="pnfpb_ic_fcm_custom_prompt_close_button_text_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_custom_prompt_close_button_text_color' )) {echo get_option( 'pnfpb_ic_fcm_custom_prompt_close_button_text_color' ); } else { echo '#0078d1'; }?>" />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo __("Close Button background color",'PNFPB_TD');?></p>
												<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_custom_prompt_close_button_background" id="pnfpb_ic_fcm_push_custom_prompt_close_button_background" name="pnfpb_ic_fcm_push_custom_prompt_close_button_background" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_push_custom_prompt_close_button_background' )) {echo get_option( 'pnfpb_ic_fcm_push_custom_prompt_close_button_background' ); } else { echo '#ffffff';}?>" />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo __("Close button text",'PNFPB_TD');?></p>
												<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_custom_prompt_close_button_text" name="pnfpb_ic_fcm_custom_prompt_close_button_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_custom_prompt_close_button_text' )) {echo get_option( 'pnfpb_ic_fcm_custom_prompt_close_button_text' );} else { echo __("Close",'PNFPB_TD');} ?>"  />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo __("Wait message while processing push subscription",'PNFPB_TD');?></p>
												<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_custom_prompt_popup_wait_message" name="pnfpb_ic_fcm_custom_prompt_popup_wait_message" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_custom_prompt_popup_wait_message' )) {echo get_option( 'pnfpb_ic_fcm_custom_prompt_popup_wait_message' );} else { echo __("Please wait...processing",'PNFPB_TD');} ?>"  />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_custom_prompt_options_on_off">
													<?php echo __("Show subscription options button",'PNFPB_TD');?>
												</label>												
												<label class="pnfpb_switch">
													<input  id="pnfpb_custom_prompt_options_on_off" name="pnfpb_custom_prompt_options_on_off" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_custom_prompt_options_on_off' ) ); ?>  />
													<span class="pnfpb_slider round"></span>
												</label>
											</td>
										</tr>
									</tbody>
								</table>
								</td>
							</tr>
    						<tr class="pnfpb_ic_push_settings_table_row pnfpb_ic_push_settings_table_border_bottom">
        						<td class="pnfpb_ic_push_settings_table_label_column column-columnname pnfpb_ic_push_settings_table_label_custom_prompt_column">
									<table class="pnfpb_ic_push_firebase_settings_table widefat fixed">
										<thead>
											<tr>
												<th>
													<?php echo "<b>".__("Customize Bell prompt icon, Button color and text",PNFPB_TD)."</b>";?>
												</th>
											</tr>
										</thead>
										<tbody>
    										<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">										
													<p>
														<?php echo __("Push Subscribe prompt Icon(32x32 pixels)",PNFPB_TD);?>
													</p>
													<table>
														<tr>
                											<td class="column-columnname">
                    											<button id="pnfpb_ic_fcm_popup_subscribe_button_icon" class="pnfpb_ic_push_settings_upload_icon">
																	<?php echo __("Upload Icon",PNFPB_TD);?>
																</button>
                    											<input type="hidden" id="pnfpb_ic_fcm_popup_subscribe_button_icon" name="pnfpb_ic_fcm_popup_subscribe_button_icon" value="<?php if (get_option( 'pnfpb_ic_fcm_popup_subscribe_button_icon' )) { echo get_option('pnfpb_ic_fcm_popup_subscribe_button_icon'); } else { echo plugin_dir_url( __DIR__ ).'public/img/pushbell-pnfpb.png';} ?>" />
                											</td>
            											</tr>
														<tr>
                											<td class="column-columnname">
                    											<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        											<div id="pnfpb_ic_fcm_popup_subscribe_button_icon_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_popup_subscribe_button_icon' )) { echo get_option('pnfpb_ic_fcm_popup_subscribe_button_icon'); } else { echo plugin_dir_url( __DIR__ ).'public/img/pushbell-pnfpb.png';} ?>);width:32px; height:32px;overflow:hidden;border-radius:50%;margin:20px auto;background-position:center;background-repeat:no-repeat;background-size:cover;">
																	</div>
                    											</div>
                											</td>
            											</tr>
													</table>
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Header text in custom prompt",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_popup_header_text" name="pnfpb_ic_fcm_popup_header_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_popup_header_text' )) {echo get_option( 'pnfpb_ic_fcm_popup_header_text' );} else { echo __("Manage push notifications",'PNFPB_TD');} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Button text color",'PNFPB_TD');?></p>
													<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_prompt_button_background" id="pnfpb_ic_fcm_popup_subscribe_button_text_color" name="pnfpb_ic_fcm_popup_subscribe_button_text_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_popup_subscribe_button_text_color' )) {echo get_option( 'pnfpb_ic_fcm_popup_subscribe_button_text_color' ); } else { echo '#ffffff'; }?>" />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Push notification subscribe Button background color",'PNFPB_TD');?></p>
													<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_prompt_button_background" id="pnfpb_ic_fcm_popup_subscribe_button_color" name="pnfpb_ic_fcm_popup_subscribe_button_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_popup_subscribe_button_color' )) {echo get_option( 'pnfpb_ic_fcm_popup_subscribe_button_color' ); } else { echo '#e54b4d';}?>" />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Push notification subscribe text",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_popup_subscribe_button" name="pnfpb_ic_fcm_popup_subscribe_button" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_popup_subscribe_button' )) {echo get_option( 'pnfpb_ic_fcm_popup_subscribe_button' );} else { echo __("Subscribe",'PNFPB_TD');} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Push notification unsubscribe text",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_popup_unsubscribe_button" name="pnfpb_ic_fcm_popup_unsubscribe_button" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_popup_unsubscribe_button' )) {echo get_option( 'pnfpb_ic_fcm_popup_unsubscribe_button' );} else { echo __("Unsubscribe",'PNFPB_TD');} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Notification subscribed message when hover on push icon",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_popup_subscribe_message" name="pnfpb_ic_fcm_popup_subscribe_message" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_popup_subscribe_message' )) {echo get_option( 'pnfpb_ic_fcm_popup_subscribe_message' );} else { echo __("You are subscribed to push notification",'PNFPB_TD');} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Notification not subscribed message when hover on push icon",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_popup_unsubscribe_message" name="pnfpb_ic_fcm_popup_unsubscribe_message" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_popup_unsubscribe_message' )) {echo get_option( 'pnfpb_ic_fcm_popup_unsubscribe_message' );} else { echo __("Push notification not subscribed",'PNFPB_TD');} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Wait message while processing push subscription",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_popup_wait_message" name="pnfpb_ic_fcm_popup_wait_message" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_popup_wait_message' )) {echo get_option( 'pnfpb_ic_fcm_popup_wait_message' );} else { echo __("Please wait...processing",'PNFPB_TD');} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_bell_icon_prompt_options_on_off">
														<?php echo __("Show subscription options button",'PNFPB_TD');?>
													</label>												
													<label class="pnfpb_switch">
														<input  id="pnfpb_bell_icon_prompt_options_on_off" name="pnfpb_bell_icon_prompt_options_on_off" type="checkbox" value="1" <?php  if(get_option( 'pnfpb_bell_icon_prompt_options_on_off','0' ) === '0' || get_option( 'pnfpb_bell_icon_prompt_options_on_off','0' ) === '1' ) { echo 'checked';
} ?>  />
														<span class="pnfpb_slider round"></span>
													</label>
												</td>
											</tr>											
										</tbody>
									</table>
								</td>
							</tr>
    						<tr class="pnfpb_ic_push_settings_table_row pnfpb_ic_push_settings_table_border_bottom">
        						<td class="pnfpb_ic_push_settings_table_label_column column-columnname pnfpb_ic_push_settings_table_label_custom_prompt_column">
									<table class="pnfpb_ic_push_firebase_settings_table widefat fixed">
										<thead>
											<tr>
												<th>
													<?php echo "<b>".__("Customize Subscription options text,color,button in bell icon and in custom prompt",PNFPB_TD)."</b>";?>
												</th>
											</tr>
										</thead>
										<tbody>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Subscription option update button text",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_update_text" name="pnfpb_bell_icon_subscription_option_update_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_update_text' )) {echo get_option( 'pnfpb_bell_icon_subscription_option_update_text' );} else { echo __("Update",'PNFPB_TD');} ?>"  />
												</td>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Subscription option update button text color",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_update_text_color" name="pnfpb_bell_icon_subscription_option_update_text_color" type="color" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_update_text_color' )) {echo get_option( 'pnfpb_bell_icon_subscription_option_update_text_color' );} else { echo '#ffffff';} ?>"  />
												</td>
<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Subscription option update button background color",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_update_background_color" name="pnfpb_bell_icon_subscription_option_update_background_color" type="color" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_update_background_color' )) {echo get_option( 'pnfpb_bell_icon_subscription_option_update_background_color' );} else { echo '#135e96';} ?>"  />
												</td>												
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Subscription option list background color ",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_list_background_color" name="pnfpb_bell_icon_subscription_option_list_background_color" type="color" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_list_background_color' )) {echo get_option( 'pnfpb_bell_icon_subscription_option_list_background_color' );} else { echo '#cccccc';} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Subscription option list text color ",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_list_text_color" name="pnfpb_bell_icon_subscription_option_list_text_color" type="color" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_list_text_color' )) {echo get_option( 'pnfpb_bell_icon_subscription_option_list_text_color' );} else { echo '#000000';} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Subscription option list checkbox color ",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_list_checkbox_color" name="pnfpb_bell_icon_subscription_option_list_checkbox_color" type="color" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_list_checkbox_color' )) {echo get_option( 'pnfpb_bell_icon_subscription_option_list_checkbox_color' );} else { echo '#135e96';} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Subscription option update confirmation message ",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_update_confirmation_message" name="pnfpb_bell_icon_subscription_option_update_confirmation_message" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_update_confirmation_message' )) {echo get_option( 'pnfpb_bell_icon_subscription_option_update_confirmation_message' );} else { echo __("subscription updated",'PNFPB_TD');} ?>"  />
												</td>
											</tr>											
											<tr class="pnfpb_ic_push_settings_table_row">
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Subscription option text for all subscriptions",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_activity_text" name="pnfpb_bell_icon_subscription_option_all_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_all_text' )) {echo get_option( 'pnfpb_bell_icon_subscription_option_all_text' );} else { echo __("All",'PNFPB_TD');} ?>"  />
												</td>												
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Subscription option text for Post",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_post_text" name="pnfpb_bell_icon_subscription_option_post_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_post_text' )) {echo get_option( 'pnfpb_bell_icon_subscription_option_post_text' );} else { echo __("Post",'PNFPB_TD');} ?>"  />
												</td>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Subscription option text for Activity",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_activity_text" name="pnfpb_bell_icon_subscription_option_activity_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_activity_text' )) {echo get_option( 'pnfpb_bell_icon_subscription_option_activity_text' );} else { echo __("Activity",'PNFPB_TD');} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Subscription option text for all comments",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_all_comments_text" name="pnfpb_bell_icon_subscription_option_all_comments_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_all_comments_text' )) {echo get_option( 'pnfpb_bell_icon_subscription_option_all_comments_text' );} else { echo __("All Comments",'PNFPB_TD');} ?>"  />
												</td>												
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Subscription option text for my comments",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_my_comments_text" name="pnfpb_bell_icon_subscription_option_my_comments_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_my_comments_text' )) {echo get_option( 'pnfpb_bell_icon_subscription_option_my_comments_text' );} else { echo __("My Comments",'PNFPB_TD');} ?>"  />
												</td>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Subscription option text for Private message",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_private_message_text" name="pnfpb_bell_icon_subscription_option_private_message_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_private_message_text' )) {echo get_option( 'pnfpb_bell_icon_subscription_option_private_messsage_text' );} else { echo __("Private Message",'PNFPB_TD');} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Subscription option text for New member joined",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_new_member_joined_text" name="pnfpb_bell_icon_subscription_option_new_member_joined_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_new_member_joined_text' )) {echo get_option( 'pnfpb_bell_icon_subscription_option_new_member_joined_text' );} else { echo __("New Member joined",'PNFPB_TD');} ?>"  />
												</td>												
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Subscription option text for Friendship request",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_friendship_request_text" name="pnfpb_bell_icon_subscription_option_friendship_request_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_friendship_request_text' )) {echo get_option( 'pnfpb_bell_icon_subscription_option_friendship_request_text' );} else { echo __("Friendship request",'PNFPB_TD');} ?>"  />
												</td>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Subscription option text for Friendship accepted",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_friendship_accepted_text" name="pnfpb_bell_icon_subscription_option_friendship_accepted_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_friendship_accepted_text' )) {echo get_option( 'pnfpb_bell_icon_subscription_option_friendship_accepted_text' );} else { echo __("Friendship accepted",'PNFPB_TD');} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Subscription option text for Avatar change",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_avatar_change_text" name="pnfpb_bell_icon_subscription_option_avatar_change_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_avatar_change_text' )) {echo get_option( 'pnfpb_bell_icon_subscription_option_avatar_change_text' );} else { echo __("Avatar change",'PNFPB_TD');} ?>"  />
												</td>												
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Subscription option text for Cover image change",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_cover_image_change_text" name="pnfpb_bell_icon_subscription_option_cover_image_change_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_cover_image_change_text' )) {echo get_option( 'pnfpb_bell_icon_subscription_option_cover_image_change_text' );} else { echo __("Cover image change",'PNFPB_TD');} ?>"  />
												</td>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Subscription option text for Group details update",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_group_details_update_text" name="pnfpb_bell_icon_subscription_option_group_details_update_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_group_details_update_text' )) {echo get_option( 'pnfpb_bell_icon_subscription_option_group_details_update_text' );} else { echo __("Group details update",'PNFPB_TD');} ?>"  />
												</td>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo __("Subscription option text for Group invite",'PNFPB_TD');?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_group_invite_text" name="pnfpb_bell_icon_subscription_option_group_invite_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_group_invite_text' )) {echo get_option( 'pnfpb_bell_icon_subscription_option_group_invite_text' );} else { echo __("Group invite",'PNFPB_TD');} ?>"  />
												</td>												
											</tr>											
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</div>				
			</td>
		</tr>
		<tr class="pnfpb_ic_push_settings_table_row">
			<td class="pnfpb_ic_push_settings_table_column column-columnname">
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
						<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_push_prompt_enable">
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_fcm_loggedin_notify" name="pnfpb_ic_fcm_loggedin_notify" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_loggedin_notify' ) ); ?>  />
									<span class="pnfpb_slider round"></span>
								</label>
									<?php echo __("Push notification only for loggedin users<br/>(if you enable this then all old prior subscriptions for httpv1 version needs to be re-subscribed and if you use legacy api then no need to re-subscribe)",'PNFPB_TD');?>
							</label>
						</div>						
					</div>
				</div>
			</td>
		</tr>
        <tr class="pnfpb_ic_push_settings_table_row">
			<td class="pnfpb_ic_push_settings_table_column column-columnname">
				<div  class="pnfpb_row">
					<?php echo '<b>'.__('In edit/New post page with posttype=post, make sure metabox for PNFPB Push notification is switched on to send notification. <br/>For frontend post/custom post,it will work as it is without metabox',PNFPB_TD).'</b>'; ?>
				</div>				
				<div class="pnfpb_row">
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">				
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_post_enable"><?php echo __("Post",'PNFPB_TD');?></label>						<label class="pnfpb_switch">
								<input id="pnfpb_ic_fcm_post_enable" name="pnfpb_ic_fcm_post_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_post_enable' ) ); ?>  /> 
								<span class="pnfpb_slider round"></span>
							</label>
						</div>
					</div>
        		<?php
            		$posttypecount = 0;
            		$rowcount = 0;
					$cutomize_post_field_notification_title = '<br/><br/><br/><br/>'.__('(use [member name] shortcode to display member name)<br/>if following custom title are blank then post title/custom post type title will be in push notification title<br/>Example "[member name] published a post" will display as "Tom published a post" where Tom is member name<br/>',PNFPB_TD).'<div class="pnfpb_ic_post_content_form"><b>'.__("Notification title for Post",PNFPB_TD).'</b><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_post_title" name="pnfpb_ic_fcm_post_title" type="text" value="'.get_option('pnfpb_ic_fcm_post_title').'" /></div><br/>';
					
           			 $totalposttype = count($custposttypes);
            		foreach ( $custposttypes as $post_type ) {
                		$labeltext = $post_type;
						$cutomize_post_field_notification_title .= '<div class="pnfpb_ic_'.$post_type.'_content_form"><b>'.__("Notification title for $post_type",PNFPB_TD).'</b><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_'.$post_type.'_title" name="pnfpb_ic_fcm_'.$post_type.'_title" type="text" value="'.get_option('pnfpb_ic_fcm_'.$post_type.'_title').'" /></div><br/>';
        		?>  
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">				
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_<?php echo $labeltext; ?>_enable"><?php echo $labeltext; ?></label>		<label class="pnfpb_switch">	
								<input id="pnfpb_ic_fcm_<?php echo $post_type; ?>_enable" name="pnfpb_ic_fcm_<?php echo $post_type; ?>_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_'.$post_type.'_enable' ) ); ?>  />
								<span class="pnfpb_slider round"></span>
							</label>
						</div>
					</div>
        		<?php                
                	$posttypecount++;
                	$rowcount++;
           	 	}
        		?>
					<div class="pnfpb_column">
						<button type="button" class="pnfpb_post_type_content_button" onclick="toggle_post_type_content_form()"><?php echo __("Customize",PNFPB_TD); ?></button>
					</div>
			</div>
			<div class="pnfpb_row">
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_post_schedule_enable">
								<?php echo __("Schedule <br/>(using action scheduler)",'PNFPB_TD');?>
							</label>
							<?php
								$pnfpb_ic_fcm_post_schedule_enable = '0';
								if ((get_option( 'pnfpb_ic_fcm_post_schedule_enable') && get_option( 'pnfpb_ic_fcm_post_schedule_enable')  === '1') || (get_option( 'pnfpb_ic_fcm_post_schedule_background_enable') && get_option( 'pnfpb_ic_fcm_post_schedule_background_enable')  === '1')) {
									$pnfpb_ic_fcm_post_schedule_enable = '1';
								}
							?>
							<label class="pnfpb_switch">
								<input  id="pnfpb_ic_fcm_post_schedule_enable" name="pnfpb_ic_fcm_post_schedule_enable" type="checkbox" value="1" <?php checked( '1', $pnfpb_ic_fcm_post_schedule_enable ); ?>  />
								<span class="pnfpb_slider round"></span>
							</label>
						</div>
					</div>
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container pnfpb_ic_fcm_post_timeschedule_seconds_radio_block">
								<?php echo __("In seconds<br/>(min 300)",'PNFPB_TD');?>
								<input  class="pnfpb_ic_fcm_post_timeschedule_seconds_radio_block" class="pnfpb_ic_fcm_post_timeschedule_seconds" name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" value="seconds" <?php checked( 'seconds', get_option( 'pnfpb_ic_fcm_post_timeschedule_enable' ) ); ?>  />
								<span class="pnfpb_checkmark"></span>
							</label>
							<label class="pnfpb_ic_fcm_post_timeschedule_seconds_block">
								<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_post_timeschedule_seconds" name="pnfpb_ic_fcm_post_timeschedule_seconds" class="pnfpb_ic_fcm_post_timeschedule_seconds" type="number" min="300" value="<?php if ((!get_option( 'pnfpb_ic_fcm_post_timeschedule_seconds')) || (get_option( 'pnfpb_ic_fcm_post_timeschedule_seconds' ) && get_option( 'pnfpb_ic_fcm_post_timeschedule_seconds' ) < 300)) { echo 300; } else  { echo get_option( 'pnfpb_ic_fcm_post_timeschedule_seconds' ); } ?>" required/>		
							</label>
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container">
								<?php echo __("Hourly",'PNFPB_TD');?>
								<input  name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" value="hourly" <?php checked( 'hourly', get_option( 'pnfpb_ic_fcm_post_timeschedule_enable' ) ); ?>  />
								<span class="pnfpb_checkmark"></span>
							</label>
							<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
								<?php echo __("Twicedaily",'PNFPB_TD');?>
								<input name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" value="twicedaily" <?php checked( 'twicedaily', get_option( 'pnfpb_ic_fcm_post_timeschedule_enable' ) ); ?>  />
								<span class="pnfpb_checkmark"></span>
							</label>
							<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
								<?php echo __("Daily",'PNFPB_TD');?>
								<input name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" value="daily" <?php checked( 'daily', get_option( 'pnfpb_ic_fcm_post_timeschedule_enable' ) ); ?>  />
								<span class="pnfpb_checkmark"></span>
							</label>
							<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
								<?php echo __("Weekly",'PNFPB_TD');?>
								<input name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" value="weekly" <?php checked( 'weekly', get_option( 'pnfpb_ic_fcm_post_timeschedule_enable' ) ); ?>  />
								<span class="pnfpb_checkmark"></span>
							</label>
						</div>
					</div>
				</div>
				<div  class="pnfpb_row">
					<?php echo '<a href="'.get_home_url().'/wp-admin/admin.php?page=pnfpb_icfm_action_scheduler&s=PNFPB_cron_post_hook&action=-1&paged=1&action2=-1" target="_blank">'.__('Manage your scheduled tasks for post notifications in action scheduler tab - click here. Scheduling is available only for POST type (not for custom post types)',PNFPB_TD).'</a>'; ?>
				</div>				
				<div class="pnfpb_ic_post_type_content_form">
					<?php echo $cutomize_post_field_notification_title; ?>
				</div>
			</td>			
		</tr>
		<tr class="pnfpb_ic_push_settings_table_row">
            <td class="pnfpb_ic_push_settings_table_column column-columnname">
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
						<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_buddypress_bactivity_enable">
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_fcm_bactivity_enable" name="pnfpb_ic_fcm_bactivity_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_bactivity_enable' ) ); ?>  />
									<span class="pnfpb_slider round"></span>
								</label>
									<?php echo __("BuddyPress activities",'PNFPB_TD');?>
							</label>
						</div>
					</div>
					<div class="pnfpb_column_400">
						<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container  pnfpb_margin_left_4 pnfpb_padding_top_8">
								<?php echo __("All activities",'PNFPB_TD');?>
								<input  id="pnfpb_ic_fcm_buddypress_enable" name="pnfpb_ic_fcm_buddypress_enable" type="radio" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_buddypress_enable' ) ); ?>  />
								<span class="pnfpb_checkmark pnfpb_margin_top_6"></span>
							</label>
							<?php if (get_option('pnfpb_onesignal_push') !== '1') { ?>
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container  pnfpb_padding_top_8">
									<input  id="pnfpb_ic_fcm_buddypress_group_enable" name="pnfpb_ic_fcm_buddypress_enable" type="radio" value="2" <?php checked( '2', get_option( 'pnfpb_ic_fcm_buddypress_enable' ) ); ?>  />
									<span class="pnfpb_checkmark  pnfpb_margin_top_6"></span>
									<?php echo __("Group activity (only for group members)",'PNFPB_TD');?>
								</label>
							<?php } ?>
							<button type="button" class="pnfpb_activity_form_button" onclick="toggle_activity_content_form()"><?php echo __("Customize",PNFPB_TD); ?></button>
						</div>
					</div>
				</div>
				<div class="pnfpb_row">					
						<div class="pnfpb_column_400">
    						<div class="pnfpb_card">
								<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypressactivities_schedule_enable">
									<?php echo __("Schedule  <br/>(using action scheduler)",'PNFPB_TD');?>
									<label class="pnfpb_switch">
										<?php
											$pnfpb_ic_fcm_buddypressactivities_schedule_enable = '0';
											if ((get_option( 'pnfpb_ic_fcm_buddypressactivities_schedule_enable') && get_option( 'pnfpb_ic_fcm_buddypressactivities_schedule_enable')  === '1') || (get_option( 'pnfpb_ic_fcm_buddypressactivities_schedule_background_enable') && get_option( 'pnfpb_ic_fcm_buddypressactivities_schedule_background_enable')  === '1')) {
												$pnfpb_ic_fcm_buddypressactivities_schedule_enable = '1';
											}
										?>										
										<input  id="pnfpb_ic_fcm_buddypressactivities_schedule_enable" name="pnfpb_ic_fcm_buddypressactivities_schedule_enable" type="checkbox" value="1" <?php checked( '1', $pnfpb_ic_fcm_buddypressactivities_schedule_enable ); ?>  />				
										<span class="pnfpb_slider round"></span>
									</label>
								</label>
							</div>
						</div>
  						<div class="pnfpb_column_400">
    						<div class="pnfpb_card">
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_radio_block">
									<?php echo __("In seconds<br/>(min 300)",'PNFPB_TD');?>
									<input  class="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_radio_block" class="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds" name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable" type="radio" value="seconds" <?php checked( 'seconds', get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_enable' ) ); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_block">
									<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds" name="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds" class="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds" type="number" min="300" value="<?php if ((!get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds')) || (get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds' ) && get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds' ) < 300)) { echo 300; } else  { echo get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds' ); } ?>" required/>		
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container" >
									<?php echo __("Hourly",'PNFPB_TD');?>
									<input  id="pnfpb_ic_fcm_buddypressactivities_hourly_enable" name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable" type="radio" value="hourly" <?php checked( 'hourly', get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_enable' ) ); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container">
									<?php echo __("Twicedaily",'PNFPB_TD');?>						
									<input  id="pnfpb_ic_fcm_buddypressactivities_twicedaily_enable" name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable" type="radio" value="twicedaily" <?php checked( 'twicedaily', get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_enable' ) ); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container">
									<?php echo __("Daily",'PNFPB_TD');?>						
									<input  id="pnfpb_ic_fcm_buddypressactivities_daily_enable" name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable" type="radio" value="daily" <?php checked( 'daily', get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_enable' ) ); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container" >
									<?php echo __("Weekly",'PNFPB_TD');?>						
									<input  id="pnfpb_ic_fcm_buddypressactivities_weekly_enable" name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable" type="radio" value="weekly" <?php checked( 'weekly', get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_enable' ) ); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
							</div>
						</div>					
				</div>
				<div  class="pnfpb_row">
					<?php if (get_option( 'pnfpb_ic_fcm_buddypress_enable' ) === '1') { ?>
						<?php echo '<a href="'.get_home_url().'/wp-admin/admin.php?page=pnfpb_icfm_action_scheduler&s=PNFPB_cron_buddypressactivities_hook&action=-1&paged=1&action2=-1" target="_blank">'.__('Manage your scheduled tasks for BuddyPress activities notifications in action scheduler tab - click here',PNFPB_TD).'</a>'; ?>
					<?php } else  { ?>
						<?php echo '<a href="'.get_home_url().'/wp-admin/admin.php?page=pnfpb_icfm_action_scheduler&s=PNFPB_cron_buddypressgroupactivities_hook&action=-1&paged=1&action2=-1" target="_blank">'.__('Manage your scheduled tasks for BuddyPress group activities notifications in action scheduler tab - click here',PNFPB_TD).'</a>'; ?>
					<?php } ?>
				</div>				
				<div class="pnfpb_ic_activity_content_form">
					<?php echo __("Notification title for BuddyPress new activity<br/>use [member name] shortcode to display member name along with custom title<br/>(use [group name] shortcode only for group buddypress activities to display member name)<br/>Example '[member name] posted an activity' will display as 'Tom posted an activity' where Tom is member name",PNFPB_TD);?><br/>
        			<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_activity_title" name="pnfpb_ic_fcm_activity_title" type="text" value="<?php echo $activitytitle; ?>" /><br/><br/>
					<?php echo __("Default Notification content for BuddyPress new activity<br/> (or leave it as blank to display activity content in notification message)",PNFPB_TD); ?><br/>
        			<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_activity_message" name="pnfpb_ic_fcm_activity_message" type="text" value="<?php echo $activitymessage; ?>" /><br/><br/>					
					<?php echo __("Notification title for BuddyPress new group activity",PNFPB_TD);?><br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_group_activity_title" name="pnfpb_ic_fcm_group_activity_title" type="text" value="<?php echo $activitygroup; ?>"/><br/><br/>
					<?php echo __("Default Notification content for BuddyPress new group activity<br/> (or leave it as blank to display activity content in notification message)",PNFPB_TD);?><br/>
        			<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_group_activity_message" name="pnfpb_ic_fcm_group_activity_message" type="text" value="<?php echo $groupactivitymessage; ?>" /><br/><br/>
					<div class="pnfpb_column_400">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_followers_enable">
								<?php echo __("Notify only BuddyPress user followers<br/><b>(it requires BuddyPress-followers plugin)</b>",'PNFPB_TD');?>
								<label class="pnfpb_switch">
									<?php
										$pnfpb_ic_fcm_buddypress_followers_enable = '0';
										if ((get_option( 'pnfpb_ic_fcm_buddypress_followers_enable') && get_option( 'pnfpb_ic_fcm_buddypress_followers_enable')  === '1') || (get_option( 'pnfpb_ic_fcm_buddypress_followers_enable') && get_option( 'pnfpb_ic_fcm_buddypress_followers_enable')  === '1')) {
												$pnfpb_ic_fcm_buddypress_followers_enable = '1';
										}
									?>										
									<input  id="pnfpb_ic_fcm_buddypress_followers_enable" name="pnfpb_ic_fcm_buddypress_followers_enable" type="checkbox" value="1" <?php checked( '1', $pnfpb_ic_fcm_buddypress_followers_enable ); ?>  />				
									<span class="pnfpb_slider round"></span>
								</label>
							</label>
						</div>
					</div>					
				</div>
			</td>
		</tr>
		<tr class="pnfpb_ic_push_settings_table_row">
            <td class="pnfpb_ic_push_settings_table_column column-columnname">		
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_buddypress_bcomment_enable">
								<?php echo __("BuddyPress/Post comments",'PNFPB_TD');?>
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_fcm_bcomment_enable" name="pnfpb_ic_fcm_bcomment_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_bcomment_enable' ) ); ?>  />
									<span class="pnfpb_slider round"></span>
								</label>
							</label>
						</div>
					</div>
					<div class="pnfpb_column_400">
						<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container  pnfpb_margin_left_4 pnfpb_padding_top_8">
								<?php echo __("All",'PNFPB_TD');?>
								<input  id="pnfpb_ic_fcm_buddypress_comments_radio_enable" name="pnfpb_ic_fcm_buddypress_comments_radio_enable" type="radio" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_buddypress_comments_radio_enable' ) ); ?>  />
								<span class="pnfpb_checkmark pnfpb_margin_top_6"></span>
							</label>
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container  pnfpb_padding_top_8">
								<input  id="pnfpb_ic_fcm_buddypress_comments_radio_enable" name="pnfpb_ic_fcm_buddypress_comments_radio_enable" type="radio" value="2" <?php checked( '2', get_option( 'pnfpb_ic_fcm_buddypress_comments_radio_enable' ) ); ?>  />
								<span class="pnfpb_checkmark  pnfpb_margin_top_6"></span>
								<?php echo __("Only for User's activities/Posts/My activities",'PNFPB_TD');?>
							</label>
							<button type="button" class="pnfpb_comments_content_button" onclick="toggle_comments_content_form()"><?php echo __("Customize",PNFPB_TD); ?></button>
						</div>
					</div>	
				</div>
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
    						<div class="pnfpb_card">				
								<label class="pnfpb_ic_push_settings_table_label_checkbox">
									<?php echo __("Schedule  <br/>(using action scheduler)",'PNFPB_TD');?>
									<label class="pnfpb_switch">
										<?php
											$pnfpb_ic_fcm_buddypresscomments_schedule_enable = '0';
											if ((get_option( 'pnfpb_ic_fcm_buddypresscomments_schedule_enable') && get_option( 'pnfpb_ic_fcm_buddypresscomments_schedule_enable')  === '1') || (get_option( 'pnfpb_ic_fcm_buddypresscomments_schedule_background_enable') && get_option( 'pnfpb_ic_fcm_buddypresscomments_schedule_background_enable')  === '1')) {
												$pnfpb_ic_fcm_buddypresscomments_schedule_enable = '1';
											}
										?>										
										<input  id="pnfpb_ic_fcm_buddypresscomments_schedule_enable" name="pnfpb_ic_fcm_buddypresscomments_schedule_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_buddypresscomments_schedule_enable' ) ); ?>  />				
										<span class="pnfpb_slider round"></span>
									</label>
								</label>
							</div>
					</div>
 					<div class="pnfpb_column_400">
    						<div class="pnfpb_card">
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_radio_block">
									<?php echo __("In seconds<br/>(min 300)",'PNFPB_TD');?>
									<input  class="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_radio_block" class="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds" name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable" type="radio" value="seconds" <?php checked( 'seconds', get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_enable' ) ); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_block">
									<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds" name="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds" class="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds" type="number" min="300" value="<?php if ((!get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds')) || (get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds' ) && get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds' ) < 300)) { echo 300; } else  { echo get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds' ); } ?>" required/>		
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
									<?php echo __("Hourly",'PNFPB_TD');?>
									<input  id="pnfpb_ic_fcm_buddypresscomments_hourly_enable" name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable" type="radio" value="hourly" <?php checked( 'hourly', get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_enable' ) ); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
									<?php echo __("Twicedaily",'PNFPB_TD');?>
									<input  id="pnfpb_ic_fcm_buddypresscomments_twicedaily_enable" name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable" type="radio" value="twicedaily" <?php checked( 'twicedaily', get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_enable' ) ); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
									<?php echo __("Daily",'PNFPB_TD');?>
									<input  id="pnfpb_ic_fcm_buddypresscomments_daily_enable" name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable" type="radio" value="daily" <?php checked( 'daily', get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_enable' ) ); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
									<input  id="pnfpb_ic_fcm_buddypresscomments_weekly_enable" name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable" type="radio" value="weekly" <?php checked( 'weekly', get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_enable' ) ); ?>  />
									<?php echo __("Weekly",'PNFPB_TD');?>
									<span class="pnfpb_checkmark"></span>
								</label>
							</div>
					</div>
				</div>
							<div  class="pnfpb_row">
								<?php echo '<a href="'.get_home_url().'/wp-admin/admin.php?page=pnfpb_icfm_action_scheduler&s=PNFPB_cron_buddypresscomments_hook&action=-1&paged=1&action2=-1" target="_blank">'.__('Manage your scheduled tasks for BuddyPress comments/Post comments notifications in action scheduler tab - click here',PNFPB_TD).'</a>'; ?>
							</div>				
				<div class="pnfpb_ic_comments_content_form">
					<label for="pnfpb_ic_fcm_comment_activity_title"><?php echo __("Notification title for BuddyPress new comment<br/>use [member name] shortcode to display member name along with custom title<br/>Example '[member name] posted a comment' will display as 'Tom posted a comment' where Tom is member name",PNFPB_TD);?></label><br/>
        			<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_comment_activity_title" name="pnfpb_ic_fcm_comment_activity_title" type="text" value="<?php echo $activitycomment; ?>" /><br/><br/>
					<label for="pnfpb_ic_fcm_comment_activity_message"><?php echo __("Default Notification content for BuddyPress new comment<br/> (or leave it as blank to display comment content in notification message)",PNFPB_TD);?></label><br/>
        			<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_comment_activity_message" name="pnfpb_ic_fcm_comment_activity_message" type="text" value="<?php echo $commentactivitymessage; ?>" /><br/><br/>
				</div>
			</td>
		</tr>
		<tr class="pnfpb_ic_push_settings_table_row">
            <td class="pnfpb_ic_push_settings_table_column column-columnname">		
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
						<?php echo __("(For below BuddyPress options, user avatar image replaces notification icon in push notification)",'PNFPB_TD');?>
					</div>
				</div>
				<div class="pnfpb_row">
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_bprivatemessage_enable">
								<?php echo __("New private message",'PNFPB_TD');?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
									<input  id="pnfpb_ic_fcm_bprivatemessage_enable" name="pnfpb_ic_fcm_bprivatemessage_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_bprivatemessage_enable' ) ); ?>  />	
									<span class="pnfpb_slider round"></span>
							</label>								
							<button type="button" class="pnfpb_private_message_button" onclick="toggle_private_message_form()"><?php echo __("Customize",PNFPB_TD); ?></button>
						</div>
					</div>
					<div class="pnfpb_ic_private_message_form pnfpb_column_400">
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_bprivatemessage_text_enable"><?php echo __("Private messages notification title",'PNFPB_TD');?></label><br/>
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_bprivatemessage_text" name="pnfpb_ic_fcm_bprivatemessage_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_bprivatemessage_text' )) {echo get_option( 'pnfpb_ic_fcm_bprivatemessage_text' );} else { echo __('[sender name] sent you a private message','PNFPB_TD');} ?>"  />
					<br/><p><?php echo __('[sender name] is the shortcode which replaces with sender name and modify remaining text according to your choice','PNFPB_TD') ?></p><br/>
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_bprivatemessage_text_enable"><?php echo __("Default Private message notification content",'PNFPB_TD');?></label><br/>				
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_bprivatemessage_content" name="pnfpb_ic_fcm_bprivatemessage_content" type="text" value="<?php echo $privatemessagecontent; ?>"  />
					</div>
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_new_member_enable">
								<?php echo __("New Member joined",'PNFPB_TD');?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
								<input  id="pnfpb_ic_fcm_new_member_enable" name="pnfpb_ic_fcm_new_member_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_new_member_enable' ) ); ?>  />	
								<span class="pnfpb_slider round"></span>
							</label>
							<button type="button" class="pnfpb_new_member_button" onclick="toggle_new_member_form()"><?php echo __("Customize",PNFPB_TD); ?></button>	
						</div>
					</div>
					<div class="pnfpb_ic_new_member_form pnfpb_column_400">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_new_member_text"><?php echo __("New member notification title",'PNFPB_TD');?></label><br/>
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_new_member_text" name="pnfpb_ic_fcm_new_member_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_new_member_text' )) {echo get_option( 'pnfpb_ic_fcm_new_member_text' );} else { echo '[member name] registered as new member';} ?>"  />
						<br/><p><?php echo __('[member name] is the shortcode which replaces with sender name and modify remaining text according to your choice','PNFPB_TD') ?></p><br/>
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_new_member_content"><?php echo __("Default New member notification content",'PNFPB_TD');?></label><br/>				
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_new_member_content" name="pnfpb_ic_fcm_new_member_content" type="text" value="<?php echo $newmembercontent; ?>"  />
					</div>					
				</div>
				<div class="pnfpb_row">
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_friendship_request_enable">
								<?php echo __("Friendship request",'PNFPB_TD');?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
								<input  id="pnfpb_ic_fcm_friendship_request_enable" name="pnfpb_ic_fcm_friendship_request_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_friendship_request_enable' ) ); ?>  />	
								<span class="pnfpb_slider round"></span>
							</label>
							<button type="button" class="pnfpb_friendship_request_button" onclick="toggle_friendship_request_form()"><?php echo __("Customize",PNFPB_TD); ?></button>
						</div>
					</div>
					<div class="pnfpb_ic_friendship_request_form pnfpb_column_400">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_friendship_request_text_enable"><?php echo __("Friendship request notification title",'PNFPB_TD');?></label><br/>
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_friendship_request_text" name="pnfpb_ic_fcm_friendship_request_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_friendship_request_text' )) {echo get_option( 'pnfpb_ic_fcm_friendship_request_text' );} else { echo __('[friendship initiator name] sent friendship request',PNFPB_TD);} ?>"  />
						<br/><p><?php echo __('[friendship initiator name] is the shortcode which replaces with sender name and modify remaining text according to your choice','PNFPB_TD');?></p><br/>
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_friendship_request_text_enable"><?php echo __("Default Friendship request notification content",'PNFPB_TD');?></label><br/>				
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_friendship_request_content" name="pnfpb_ic_fcm_friendship_request_content" type="text" value="<?php echo $friendshiprequestcontent; ?>"  />
					</div>
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_friendship_accept_enable">
								<?php echo __("Friendship accepted",'PNFPB_TD');?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
								<input  id="pnfpb_ic_fcm_friendship_accept_enable" name="pnfpb_ic_fcm_friendship_accept_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_friendship_accept_enable' ) ); ?>  />	
								<span class="pnfpb_slider round"></span>
							</label>
							<button type="button" class="pnfpb_friendship_accept_button" onclick="toggle_friendship_accept_form()"><?php echo __("Customize",PNFPB_TD); ?></button>
						</div>
					</div>
					<div class="pnfpb_ic_friendship_accept_form pnfpb_column_400">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_friendship_accept_text_enable"><?php echo __("Friendship accepted notification title",'PNFPB_TD');?></label><br/>
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_friendship_accept_text" name="pnfpb_ic_fcm_friendship_accept_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_friendship_accept_text' )) {echo get_option( 'pnfpb_ic_fcm_friendship_accept_text' );} else { echo __('[friendship acceptor name] accepted your friendship request','PNFPB_TD');} ?>"  />
						<br/><p><?php echo __('[friendship acceptor name] is the shortcode which replaces with sender name and modify remaining text according to your choice','PNFPB_TD');?></p><br/>
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_friendship_accept_text_enable"><?php echo __("Default Friendship accepted notification content",'PNFPB_TD');?></label><br/>				
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_friendship_accept_content" name="pnfpb_ic_fcm_friendship_accept_content" type="text" value="<?php echo $friendshipacceptcontent; ?>"  />
					</div>
				</div>
				<div class="pnfpb_row">
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_avatar_change_enable">
								<?php echo __("User avatar change",'PNFPB_TD');?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
								<input  id="pnfpb_ic_fcm_avatar_change_enable" name="pnfpb_ic_fcm_avatar_change_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_avatar_change_enable' ) ); ?>  />	
								<span class="pnfpb_slider round"></span>
							</label>
							<button type="button" class="pnfpb_avatar_change_button" onclick="toggle_avatar_change_form()"><?php echo __("Customize",PNFPB_TD); ?></button>
						</div>
					</div>
					<div class="pnfpb_ic_avatar_change_form pnfpb_column_400">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_avatar_change_text_enable"><?php echo __("User avatar change notification title",'PNFPB_TD');?></label><br/>
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_avatar_change_text" name="pnfpb_ic_fcm_avatar_change_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_avatar_change_text' )) {echo get_option( 'pnfpb_ic_fcm_avatar_change_text' );} else { echo __('[member name] updated avatar',PNFPB_TD);} ?>"  />
						<br/><p><?php echo __('[member name] is the shortcode which replaces with sender name and modify remaining text according to your choice','PNFPB_TD');?></p><br/>
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_avatar_change_text_enable"><?php echo __("Default Avatar change notification content",'PNFPB_TD');?></label><br/>				
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_avatar_change_content" name="pnfpb_ic_fcm_avatar_change_content" type="text" value="<?php echo $avatarchangecontent; ?>"  />
					</div>
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_cover_image_change_enable">
								<?php echo __("User cover image change",'PNFPB_TD');?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
								<input  id="pnfpb_ic_fcm_cover_image_change_enable" name="pnfpb_ic_fcm_cover_image_change_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_cover_image_change_enable' ) ); ?>  />	
								<span class="pnfpb_slider round"></span>
							</label>
							<button type="button" class="pnfpb_cover_image_change_button" onclick="toggle_cover_image_change_form()"><?php echo __("Customize",PNFPB_TD); ?></button>
						</div>
					</div>
					<div class="pnfpb_ic_cover_image_change_form pnfpb_column_400">
						<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8" for="pnfpb_ic_fcm_buddypress_cover_image_change_text_enable"><?php echo __("User cover image notification title",'PNFPB_TD');?></label><br/>
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_cover_image_change_text" name="pnfpb_ic_fcm_cover_image_change_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_cover_image_change_text' )) {echo get_option( 'pnfpb_ic_fcm_cover_image_change_text' );} else { __('[member name] updated cover photo',PNFPB_TD);} ?>"  />
						<br/><p><?php echo __('[member name] is the shortcode which replaces with sender name and modify remaining text according to your choice','PNFPB_TD');?></p><br/>
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_cover_image_change_text_enable"><?php echo __("Default user cover image change notification content",'PNFPB_TD');?></label><br/>				
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_cover_image_change_content" name="pnfpb_ic_fcm_cover_image_change_content" type="text" value="<?php echo $coverimagechangecontent; ?>"  />
					</div>
				</div>
				<div class="pnfpb_row">
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_group_invitation_enable">
								<?php echo __("Group Invitation",'PNFPB_TD');?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
									<input  id="pnfpb_ic_fcm_group_invitation_enable" name="pnfpb_ic_fcm_group_invitation_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_group_invitation_enable' ) ); ?>  />	
									<span class="pnfpb_slider round"></span>
							</label>								
							<button type="button" class="pnfpb_group_invitation_button" onclick="toggle_group_invitation_form()"><?php echo __("Customize",PNFPB_TD); ?></button>
						</div>
					</div>
					<div class="pnfpb_ic_group_invitation_form pnfpb_column_400">
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_group_invitation_text_enable"><?php echo __("Group Invitation notification title",'PNFPB_TD');?></label><br/>
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_buddypress_group_invitation_text_enable" name="pnfpb_ic_fcm_buddypress_group_invitation_text_enable" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_buddypress_group_invitation_text_enable' )) {echo get_option( 'pnfpb_ic_fcm_buddypress_group_invitation_text_enable' );} else { echo __('[sender name] invited to [group name]','PNFPB_TD');} ?>"  />
					<br/><p><?php echo __('[sender name]  and [group name] are the shortcode which replaces with sender name, group name respectively. Modify remaining text according to your choice','PNFPB_TD') ?></p><br/>
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_group_invitation_content_enable"><?php echo __("Default Group invitation notification content",'PNFPB_TD');?></label><br/>				
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_buddypress_group_invitation_content_enable" name="pnfpb_ic_fcm_buddypress_group_invitation_content_enable" type="text" value="<?php echo $groupinvitationcontent; ?>"  />
					</div>
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_group_details_updated_enable">
								<?php echo __("Group details update",'PNFPB_TD');?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
									<input  id="pnfpb_ic_fcm_group_details_updated_enable" name="pnfpb_ic_fcm_group_details_updated_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_group_details_updated_enable' ) ); ?>  />	
									<span class="pnfpb_slider round"></span>
							</label>								
							<button type="button" class="pnfpb_group_details_updated_button" onclick="toggle_group_details_updated_form()"><?php echo __("Customize",PNFPB_TD); ?></button>
						</div>
					</div>
					<div class="pnfpb_ic_group_details_updated_form pnfpb_column_400">
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_group_details_updated_text_enable"><?php echo __("Group updated notification title",'PNFPB_TD');?></label><br/>
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_buddypress_group_details_updated_text_enable" name="pnfpb_ic_fcm_buddypress_group_details_updated_text_enable" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_buddypress_group_details_updated_text_enable' )) {echo get_option( 'pnfpb_ic_fcm_buddypress_group_details_updated_text_enable' );} else { echo __('[group name] group updated','PNFPB_TD');} ?>"  />
					<br/><p><?php echo __('[group name] is the shortcode which replaces with group name. Modify remaining text according to your choice','PNFPB_TD') ?></p><br/>
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_group_details_updated_content_enable"><?php echo __("Default Group updated notification content",'PNFPB_TD');?></label><br/>				
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_buddypress_group_details_updated_content_enable" name="pnfpb_ic_fcm_buddypress_group_details_updated_content_enable" type="text" value="<?php echo $groupdetailsupdatedcontent; ?>"  />
					</div>				
				</div>
			</td>
		</tr>
		<tr class="pnfpb_ic_push_settings_table_row">
            <td class="pnfpb_ic_push_settings_table_column column-columnname">
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
						<?php echo __("(following push notifications will be sent only to admin)",'PNFPB_TD');?>
					</div>
				</div>
				<div class="pnfpb_row">
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_new_user_registration_enable">
								<?php echo __("New user registration",'PNFPB_TD');?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
									<input  id="pnfpb_ic_fcm_new_user_registration_enable" name="pnfpb_ic_fcm_new_user_registration_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_new_user_registration_enable' ) ); ?>  />	
									<span class="pnfpb_slider round"></span>
							</label>								
							<button type="button" class="pnfpb_new_user_registration_button" onclick="toggle_new_user_registration_form()"><?php echo __("Customize",PNFPB_TD); ?></button>
						</div>
					</div>
					<div class="pnfpb_ic_new_user_registration_form pnfpb_column_400">
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_new_user_registration_text_enable"><?php echo __("New user registration notification title",'PNFPB_TD');?></label><br/>
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_buddypress_new_user_registration_text_enable" name="pnfpb_ic_fcm_buddypress_new_user_registration_text_enable" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_buddypress_new_user_registration_text_enable' )) {echo get_option( 'pnfpb_ic_fcm_buddypress_new_user_registration_text_enable' );} else { echo __('[user name] registered as new member','PNFPB_TD');} ?>"  />
					<br/><p><?php echo __('[user name] is the shortcode which replaces with new user name. Modify remaining text according to your choice','PNFPB_TD') ?></p><br/>
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_new_user_registration_content_enable"><?php echo __("Default New user registration notification content",'PNFPB_TD');?></label><br/>				
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_buddypress_new_user_registration_content_enable" name="pnfpb_ic_fcm_buddypress_new_user_registration_content_enable" type="text" value="<?php echo $newuserregistrationcontent; ?>"  />
					</div>
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_contact_form7_enable">
								<?php echo __("On Contact form7 submitted",'PNFPB_TD');?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
									<input  id="pnfpb_ic_fcm_contact_form7_enable" name="pnfpb_ic_fcm_contact_form7_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_contact_form7_enable' ) ); ?>  />	
									<span class="pnfpb_slider round"></span>
							</label>								
							<button type="button" class="pnfpb_contact_form7_button" onclick="toggle_contact_form7_form()"><?php echo __("Customize",PNFPB_TD); ?></button>
						</div>
					</div>
					<div class="pnfpb_ic_contact_form7_form pnfpb_column_400">
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_contact_form7_text_enable"><?php echo __("Contact form7 submitted notification title",'PNFPB_TD');?></label><br/>
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_buddypress_contact_form7_text_enable" name="pnfpb_ic_fcm_buddypress_contact_form7_text_enable" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_buddypress_contact_form7_text_enable' )) {echo get_option( 'pnfpb_ic_fcm_buddypress_contact_form7_text_enable' );} else { echo __('You have received message from contact us page','PNFPB_TD');} ?>"  />
					<br/><p><?php echo __('Modify text according to your choice','PNFPB_TD') ?></p><br/>
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_contact_form7_content_enable"><?php echo __("Default message for notification content when contact form7 submitted",'PNFPB_TD');?></label><br/>				
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_buddypress_contact_form7_content_enable" name="pnfpb_ic_fcm_buddypress_contact_form7_content_enable" type="text" value="<?php echo $contactform7content; ?>"  />
					</div>				
				</div>				
			</td>
		</tr>
    </tbody>
</table>
<h2 class="pnfpb_ic_push_settings_header2"><?php echo __("Use latest version of Firebase API httpv1",PNFPB_TD);?></h2>
<p><?php echo __('(Since Google depreceted legacy version of Firebase API (work until next year June 2024), <br/>please enable below option to use latest version of Firebase API - http v1. Recommended PHP version for this is 8.0 or above. It will work with PHP version 7.4 but recommended PHP version is 8.0 to use latest version of Firebase API httpv1)','PNFPB_TD') ?></p>
<p><?php echo __('(It requires service account json file to be uploaded)','PNFPB_TD') ?></p>
<p><?php echo __('(In the Firebase console, open Settings > Service Accounts.Click Generate New Private Key, then confirm by clicking Generate Key.Download & store the JSON file containing the key. Select service account json file in below field , Plugin will read and update required data in database for push notification. Physical file will not be stored.)','PNFPB_TD') ?></p>	
<h2 class="pnfpb_ic_push_settings_header2"><?php echo __("Upload Service account json file for latest version of Firebase API httpv1",PNFPB_TD);?></h2>
<div class="pnfpb_row">
	<div class="pnfpb_column_full">
		<table class="pnfpb_ic_push_firebase_settings_table widefat fixed">
    		<tbody>
				<tr class="pnfpb_ic_push_settings_table_row">
            		<td class="pnfpb_ic_push_settings_table_column column-columnname">
						<div class="pnfpb_row">
							<div class="pnfpb_column_400">
    							<div class="pnfpb_card">
									<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_latest_firebase_v1_enable">
										<?php echo __("Use latest version of Firebase api httpv1",'PNFPB_TD');?>
									</label>
									<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
										<input  id="pnfpb_httpv1_push" name="pnfpb_httpv1_push" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_httpv1_push' ) ); ?>  />	
										<span class="pnfpb_slider round"></span>
									</label>								
								</div>
							</div>
							<div class="pnfpb_column_400">
								<label for="pnfpb_icfcm_service_account_upload">Select service account json file</label>
								<input type="file"  style="width: 90px" name="pnfpb_icfcm_service_account_upload" id="pnfpb_icfcm_service_account_upload" class="pnfpb_icfcm_service_account_upload" />
								<?php if ($pnfpb_sa) { echo "<div class='pnfpb_icfcm_service_account_upload_message'><b>".__("Service account file already uploaded. If you want to update it, select new file",'PNFPB_TD')."</b></div>"; } else { echo "<div class='pnfpb_icfcm_service_account_upload_message'><b>".__("Service account data not available. Upload now",'PNFPB_TD')."</b></div>";} ?>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<h2 class="pnfpb_ic_push_settings_header2"><?php echo __("Use Firebase (or) Onesignal as push notification provider",PNFPB_TD);?></h2>
<div class="pnfpb_column_full">
	<button type="button" class="pnfpb_ic_firebase_configuration_help_button" onclick="toggle_firebase_configuration_help()"><?php echo __("Tutorial on Firebase",PNFPB_TD); ?></button>
</div>
<div class="pnfpb_ic_firebase_configuration_help">
	<a href="https://www.youtube.com/watch?v=02oymYLt3qo" target="_blank"><?php echo __("Watch this tutorial on Firebase settings and configuration",PNFPB_TD); ?></a>
	<ul>
		<li><?php echo __("Sign in to Firebase, then open your project, click settings icon & select Project settings",PNFPB_TD); ?></li>

		<li><?php echo __("To get Firebase server key (for field 1 in admin firebase settings)",PNFPB_TD); ?></li>
		<li><?php echo __("project settings > cloud messaging tab > get server key or add server key button to get server key",PNFPB_TD); ?></li>

		<li><?php echo __("To get Firebase config fields (for fields 2 to 8 in admin firebase settings)",PNFPB_TD); ?></li>
		<li><?php echo __("If you do not have web app, Create a new web app. After creating a new app, it will show firebase config fields",PNFPB_TD); ?></li>
		<li><?php echo __("Project settings > General under your apps section > click on config button to view configuration fields",PNFPB_TD); ?></li> 

		<li><?php echo __("To get Firebase public key (for field 9 in admin firebase settings)",PNFPB_TD); ?></li>
		<li><?php echo __("Open the Cloud Messaging tab of the Firebase console Settings pane and scroll to the Web configuration section",PNFPB_TD); ?></li>
		<li><?php echo __("project settings > cloud messaging tab > Under web push certificates > Generate key pair to get public key",PNFPB_TD); ?></li>
		<li><?php echo __("In the Web Push certificates tab, click Generate Key Pair. The console displays a notice that the key pair was generated, and displays the public key string and date added",PNFPB_TD); ?></li>
		<li><?php echo __("If you already Generated key pair then no need to generate it again",PNFPB_TD); ?></li>
		<li><?php echo __("After saving below fields, you will get browser prompt asking to allow notification for this website, click on allow notification",PNFPB_TD); ?></li>
		<li><?php echo __("After completing above steps, push notification will work based on option selected for posts/buddypress",PNFPB_TD); ?></li>
	</ul>
</div>
		<div class="pnfpb_column_full">
			<button type="button" class="pnfpb_ic_firebase_configuration_button" onclick="toggle_firebase_configuration()"><?php echo __("Firebase configuration",PNFPB_TD); ?></button>
			<button type="button" class="pnfpb_ic_or_button"><?php echo __(" (or) ",PNFPB_TD); ?></button>
			<button type="button" class="pnfpb_ic_onesignal_configuration_button" onclick="toggle_onesignal_configuration()"><?php echo __("Show Onesignal configuration",PNFPB_TD); ?></button>
			<p>
				<?php echo __("In Firebase configuration, <b>all fields are required except database url. Please follow above tutorial for configuration</b>",PNFPB_TD); ?>
			</p>
			<p>
				<?php echo __("If Onesignal is enabled then, <b>it requires onesignal wordpress plugin installed and activated with required configuration</b>",PNFPB_TD); ?>
			</p>			
		</div>
		<div class="pnfpb_ic_firebase_configuration">
			<table class="pnfpb_ic_push_firebase_settings_table widefat fixed">
    			<tbody>
    				<tr  class="pnfpb_ic_push_settings_table_row">
        				<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_google_api"><?php echo __("Firebase Server Key",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_google_api" name="pnfpb_ic_fcm_google_api" type="text" value="<?php echo get_option( 'pnfpb_ic_fcm_google_api' ); ?>" /></td>
    				</tr>
        
    				<tr  class="pnfpb_ic_push_settings_table_row">
        				<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_api"><?php echo __("Firebase API Key",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_api" name="pnfpb_ic_fcm_api" type="text" value="<?php echo get_option( 'pnfpb_ic_fcm_api' ); ?>" /></td>
					</tr>
	   				<tr class="pnfpb_ic_push_settings_table_row">
        				<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_authdomain"><?php echo __("Firebase Auth domain",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_authdomain" name="pnfpb_ic_fcm_authdomain" type="text" value="<?php echo get_option( 'pnfpb_ic_fcm_authdomain' ); ?>" /> </td>
    				</tr>
		
	   				<tr class="pnfpb_ic_push_settings_table_row">
        				<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_databaseurl"><?php echo __("Firebase Database url (optional)",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_databaseurl" name="pnfpb_ic_fcm_databaseurl" type="text" value="<?php echo get_option( 'pnfpb_ic_fcm_databaseurl' ); ?>" /></td>
    				</tr>
		
	   				<tr class="pnfpb_ic_push_settings_table_row">
        				<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_projectid"><?php echo __("Firebase Project id",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_projectid" name="pnfpb_ic_fcm_projectid" type="text" value="<?php echo get_option( 'pnfpb_ic_fcm_projectid' ); ?>" /></td>
    				</tr>

					<tr class="pnfpb_ic_push_settings_table_row">
        				<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_storagebucket"><?php echo __("Firebase Storage Bucket",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_storagebucket" name="pnfpb_ic_fcm_storagebucket" type="text" value="<?php echo get_option( 'pnfpb_ic_fcm_storagebucket' ); ?>" /></td>
   	 				</tr>
		
					<tr class="pnfpb_ic_push_settings_table_row">
        				<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_messagingsenderid"><?php echo __("Firebase Messaging Sender id",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_messagingsenderid" name="pnfpb_ic_fcm_messagingsenderid" type="text" value="<?php echo get_option( 'pnfpb_ic_fcm_messagingsenderid' ); ?>" /></td>
    				</tr>

					<tr class="pnfpb_ic_push_settings_table_row">
        				<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_appid"><?php echo __("Firebase App id",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"   id="pnfpb_ic_fcm_appid" name="pnfpb_ic_fcm_appid" type="text" value="<?php echo get_option( 'pnfpb_ic_fcm_appid' ); ?>" /> </td>
    				</tr>
					<tr class="pnfpb_ic_push_settings_table_row">
        				<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_publickey"><?php echo __("Firebase Public key",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_publickey" name="pnfpb_ic_fcm_publickey" type="text" value="<?php echo get_option( 'pnfpb_ic_fcm_publickey' ); ?>" /></td>
    				</tr>
    				<tr class="pnfpb_ic_push_settings_table_row">
        				<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_upload_icon"><?php echo __("FCM Push Icon(16x16 pixels)",PNFPB_TD);?></label><br/>          
						<table>
							<tr>
                				<td class="column-columnname">
                    				<input type="button" value="<?php echo __("Upload Icon",PNFPB_TD);?>" id="pnfpb_ic_fcm_upload_button" class="pnfpb_ic_push_settings_upload_icon" />
                    				<input type="hidden" id="pnfpb_ic_fcm_upload_icon" name="pnfpb_ic_fcm_upload_icon" value="<?php echo get_option( 'pnfpb_ic_fcm_upload_icon' ); ?>" />
                				</td>
            				</tr>
							<tr>
                				<td class="column-columnname">
                    				<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        				<div id="pnfpb_ic_fcm_upload_preview" style="background-image: url(<?php echo get_option('pnfpb_ic_fcm_upload_icon'); ?>);width:32px; height:32px;overflow:hidden;border-radius:50%;margin:20px auto;background-position:center center;background-repeat:no-repeat;background-size:cover;"></div>
                    				</div>
                				</td>
            				</tr>
						</table>
					</td>
				</tr>				
  			</tbody>
		</table>
	</div>		
	<div class="pnfpb_ic_onesignal_configuration">
		<h3>
			Onesignal configuration	
		</h3>
		<p>
			(Either Firebase or Onesignal used as push notification provider. If onesignal is enabled then it will use onesignal instead of firebase.<br/>It requires onesignal WordPress plugin installed with required configuration )
		</p>		
		<table class="pnfpb_ic_push_notification_settings_table widefat fixed" cellspacing="0">
    		<tbody>
				<tr class="pnfpb_ic_push_settings_table_row">
            		<td class="pnfpb_ic_push_settings_table_column column-columnname">
						<div class="pnfpb_row">
							<div class="pnfpb_column_400">
								<div class="pnfpb_card">
									<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_onesignal_push">
										<label class="pnfpb_switch">
											<input  id="pnfpb_onesignal_push" name="pnfpb_onesignal_push" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_onesignal_push' ) ); ?>  />
											<span class="pnfpb_slider round"></span>
										</label>
											<?php echo __("Use ONESIGNAL to send PUSH notification instead of FIREBASE",'PNFPB_TD');?>
									</label>
								</div>
								<div>
									<?php echo __("If enabled, it will use onesignal to send push notification provided ONESIGNAL Push notification installed and activated in your site. It will take onesignal credentials entered in ONESIGNAL push notification plugin",PNFPB_TD);?>								
								</div>						
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
 <div class="pnfpb_column_full"><?php submit_button(__('Save changes',PNFPB_TD),'pnfpb_ic_push_save_configuration_button'); ?></div>
</form>

<?php if(get_option('pnfpb_ic_fcm_api')){ ?>
<div>
    <h3><?php echo __("Test Notification",PNFPB_TD);?></h3>
    <p><?php echo __("Click below link to send test notification to your subscribed device. Please make sure you already subscribed to notification for this website from browser",PNFPB_TD);?></p>
    <a href="<?php echo admin_url('admin.php'); ?>?page=pnfpb_icfmtest_notification"><?php echo __("Test Notification",PNFPB_TD);?></a>
</div>

<?php
}
?>
</div>
<div id="pnfpb-admin-right_sidebar" class="pnfpb_column_left_300 pnfpb-admin-right_sidebar" >
	<h4><?php echo __("Need Help?",PNFPB_TD);?></h4>
	<ol>
	<li><?php echo __("Check out the",PNFPB_TD);?><a href="https://wordpress.org/support/plugin/push-notification-for-post-and-buddypress/"><?php echo __("support forum",PNFPB_TD);?></a> <?php echo __("and",PNFPB_TD);?> <a href="https://wordpress.org/plugins/push-notification-for-post-and-buddypress/#do%20you%20have%20any%20questions%3F"><?php echo __("FAQ",PNFPB_TD);?></a>.</li>
	<li><a href="https://github.com/muraliwebworld?tab=repositories" target="_blank"><?php echo __("Github repository sample code To Integrate mobile app with this plugin using API",PNFPB_TD);?></a></li>
	<li><?php echo __("Visit ",PNFPB_TD);?><a href="https://wordpress.org/plugins/push-notification-for-post-and-buddypress/"><?php echo __("plugin homepage",PNFPB_TD);?></a>.</li>
	<li><?php echo __("If you need help, Please feel free to send us your queries",PNFPB_TD);?><code>murali@indiacitys.com</code></li>
	</ol>
	<h4><?php echo __("Rate This Plugin",PNFPB_TD);?></h4>
	<p><?php echo __("Please",PNFPB_TD);?> <a href="https://wordpress.org/support/plugin/push-notification-for-post-and-buddypress/reviews/#new-post"><?php echo __("give your rating",PNFPB_TD);?></a><?php echo __(" and feedback.",PNFPB_TD);?></p>
</div>

<div id="pnfpb-admin-right_sidebar" class="pnfpb_column_left_300 pnfpb-admin-right_sidebar" >
	<h4><?php echo __("Mobile app integration help on github respository",PNFPB_TD);?></h4>
	<ol>
	<li><a href="https://github.com/muraliwebworld/android-app-to-integrate-push-notification-wordpress-plugin" target="_blank"><?php echo __("Procedure/Sample code to Integrate Android mobile app with this plugin using API",PNFPB_TD);?></a></li>
	<li><a href="https://github.com/muraliwebworld/ios-swift-app-to-integrate-push-notification-wordpress-plugin" target="_blank"><?php echo __("Procedure/Sample code to Integrate IOS mobile app with this plugin using API",PNFPB_TD);?></a></li>
	</ol>
</div>