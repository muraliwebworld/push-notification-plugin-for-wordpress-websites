<?php
/**
* Plugin settings area to store FireBase configuration, API key, server key
* Custom title for BuddyPress activity related push notification
*
* @since 1.0.0
*/
?>
<h1 class="pnfpb_ic_push_settings_header"><?php echo wp_kses_post( __("PNFPB - Settings for Push Notification","push-notification-for-post-and-buddypress"));?></h1>
<div class="nav-tab-wrapper">
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb-icfcm-slug" class="nav-tab tab active nav-tab-active"><?php echo wp_kses_post( __("Push Settings","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_device_tokens_list" class="nav-tab tab "><?php echo wp_kses_post( __("Device tokens","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_pwa_app_settings" class="nav-tab tab "><?php echo wp_kses_post( __("PWA","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfmtest_notification" class="nav-tab tab "><?php echo wp_kses_post( __("Send push notification","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc" class=" nav-tab tab"><?php echo wp_kses_data(__("Push Notifications list","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_frontend_settings" class="nav-tab tab "><?php echo wp_kses_post( __("Frontend subscription settings","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_button_settings" class="nav-tab tab "><?php echo wp_kses_data(__("Customize buttons","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_integrate_app" class="nav-tab tab "><?php echo wp_kses_data(__("Integrate Mobile app","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_settings_for_ngnix_server" class="nav-tab tab "><?php echo wp_kses_data(__("NGINX","push-notification-for-post-and-buddypress"));?></a>
	<a href="<?php echo esc_url(admin_url());?>admin.php?page=pnfpb_icfm_action_scheduler&s=pnfpb&action=-1&paged=1&action2=-1" class="nav-tab tab "><?php echo wp_kses_data(__("Action Scheduler","push-notification-for-post-and-buddypress"));?></a>
</div>
<div class="pnfpb_column_left_900">
<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
    <?php settings_fields( 'pnfpb_icfcm_group'); ?>
    <?php do_settings_sections( 'pnfpb_icfcm_group' ); ?>
	<?php
		if (get_option( 'pnfpb_bell_icon_prompt_options_on_off','0' ) === '0') {
					
			update_option( 'pnfpb_bell_icon_prompt_options_on_off', '1' );
					
		}
	$onesignalv3_settings = get_option('OneSignalWPSetting', array());
	if ( (! class_exists( 'OneSignal' )  &&  ! function_exists('onesignal_init'))  && get_option('pnfpb_onesignal_push') === '1') {
	?>
    	<div class="notice notice-error is-dismissible">
        	<p><?php wp_kses_data_e( 'Onesignal plugin is required. Please install Onesignal plugin to enable onesignal as push notification provider', "push-notification-for-post-and-buddypress" ); ?></p>
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
	
	$allowed_html = array(
    		'a' => array(
        		'href' => array(),
        		'title' => array()
    		),
			'input' => array(
				'class' => array(),
				'id' => array(),
				'name' => array(),
				'type' => array(),
				'value' => array()
			),		
			'div' => array (
				'class' => array(),
				'input' => array(
					'class' => array(),
					'id' => array(),
					'name' => array(),
					'type' => array(),
					'value' => array()
				)
			),
    		'br' => array(),
    		'em' => array(),
    		'b' => array(),						
             'option' => array(
                'value' => array(),
                 'selected' => array()
              ),
     );
	
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
<h2 class="pnfpb_ic_push_settings_header2"><?php echo wp_kses_post( __("Enable/Disable push notifications for following types","push-notification-for-post-and-buddypress"));?></h2>
<table class="pnfpb_ic_push_notification_settings_table widefat fixed" cellspacing="0">
    <tbody>
		<?php if (get_option('pnfpb_progressier_push') !== '1') { ?>
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
									<?php echo wp_kses_post( __("Show custom prompt to subscribe push notification","push-notification-for-post-and-buddypress"));?>
							</label>
							<button type="button" class="pnfpb_custom_push_prompt_button" onclick="toggle_custom_push_prompt_form()"><?php echo wp_kses_post( __("Customize","push-notification-for-post-and-buddypress")); ?></button>
						</div>
						<div>
							<?php echo wp_kses_post( __("Custom prompt is mandatory for all apple devices browsers, PWA and also needed for Firefox android","push-notification-for-post-and-buddypress"));?>								
						</div>						
					</div>
				</div>
				<div class="pnfpb_ic_push_prompt_form pnfpb_column_400">
					<table class="pnfpb_ic_push_firebase_settings_table widefat fixed">
						<thead>
							<tr>
								<th>
									<?php echo wp_kses_post( __("Turn ON prompt style checkbox to display custom prompt style-1 or 2 followed by turn on radio button of prompt style 1 or 2. If cancel button is clicked on custom prompt push notification by front end user then custom prompt will not be displayed for next 7 days.","push-notification-for-post-and-buddypress"));?>
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
													<?php echo wp_kses_post( __("Prompt style","push-notification-for-post-and-buddypress"));?>
												</label>
												<label class="pnfpb_switch">
													<input  id="pnfpb_ic_fcm_prompt_on_off" name="pnfpb_ic_fcm_prompt_on_off" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_prompt_on_off' ) ); ?>  />
													<span class="pnfpb_slider round"></span>
												</label>
											</div>												
										</div>									
										<div class="pnfpb-push-msg-model-prompt-button-container">
											<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container pnfpb_margin_left_4 pnfpb_padding_top_8">
												<?php echo wp_kses_post( __("Prompt Style-1","push-notification-for-post-and-buddypress"));?>
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
														<div class="pnfpb-push-msg-model-square"></div>
													</div>														
													<div class="pnfpb-push-msg-vertical-model-text-long-line"></div>
													<div class="pnfpb-push-msg-vertical-model-text-line"></div>
													<div class="pnfpb-push-msg-vertical-model-cancel-button"></div>
													<div class="pnfpb-push-msg-vertical-model-yes-button"></div>
												</div>
											</div>
										</div>
										<div class="pnfpb-push-msg-model-prompt-button-container">
											<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container pnfpb_margin_left_4 pnfpb_padding_top_8">
												<?php echo wp_kses_post( __("Prompt Style-2","push-notification-for-post-and-buddypress"));?>
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
															<a href="#"><img src="<?php echo esc_url(plugin_dir_url( __DIR__ ).'public/img/pushbell-pnfpb.png'); ?>" width="30px" height="30px" /></a>
														</div>
													</div>														
												</div>
											</div>
										</div>
										<div class="pnfpb-push-msg-model-prompt-button-container">
											<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_prompt_style3">
												<?php echo wp_kses_post( __("Bell prompt","push-notification-for-post-and-buddypress"));?>
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
												<?php echo "<b>".wp_kses_data( __("Customize prompt style color and text","push-notification-for-post-and-buddypress"))."</b>";?>
											</th>
										</tr>
									</thead>									
									<tbody>
    									<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname pnfpb_ic_push_settings_table_label_custom_prompt_column">
												<p>
													<?php echo wp_kses_post( __("Custom prompt Icon(recommended 80x80 pixels or less than 80x80 pixels)","push-notification-for-post-and-buddypress"));?>
												</p>
												<table>
													<tr>
                										<td class="column-columnname">
                    										<button id="pnfpb_ic_fcm_popup_custom_prompt_icon" class="pnfpb_ic_push_settings_upload_icon">
																<?php echo wp_kses_post( __("Upload Icon","push-notification-for-post-and-buddypress"));?>
															</button>
                    										<input type="hidden" id="pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon" name="pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon" value="<?php if (get_option( 'pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon' )) { echo wp_kses_data(get_option('pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon')); } else { echo esc_url(plugin_dir_url( __DIR__ )).'public/img/pushbell-pnfpb.png';} ?>" />
                										</td>
            										</tr>
													<tr>
                										<td class="column-columnname">
                    										<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        										<div id="pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon' )) { echo wp_kses_data(get_option('pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon')); } else { echo esc_url(plugin_dir_url( __DIR__ )).'public/img/pushbell-pnfpb.png';} ?>);width:32px; height:32px;overflow:hidden;border-radius:50%;margin:20px auto;background-position:center;background-repeat:no-repeat;background-size:cover;">
																</div>
                    										</div>
                										</td>
            										</tr>
												</table>
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
											<td class="pnfpb_ic_push_settings_table_label_column column-columnname pnfpb_ic_push_settings_table_label_custom_prompt_column">
												<p><?php echo wp_kses_post( __("Custom prompt Animation style","push-notification-for-post-and-buddypress"));?></p>
												<select id="pnfpb_ic_fcm_custom_prompt_animation" name="pnfpb_ic_fcm_custom_prompt_animation">
					    							<option value="slideDown" <?php if (get_option( 'pnfpb_ic_fcm_custom_prompt_animation' ) === 'slideDown'){ echo wp_kses_data('selected');} else {echo '';} ?>><?php echo wp_kses_post( __("Slide Down","push-notification-for-post-and-buddypress"));?></option>
													<option value="slideUp" <?php if (get_option( 'pnfpb_ic_fcm_custom_prompt_animation' ) === 'slideUp'){ echo wp_kses_data('selected');} else {echo '';} ?>><?php echo wp_kses_post( __("Slide Up","push-notification-for-post-and-buddypress"));?></option>
												</select>
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname pnfpb_ic_push_settings_table_label_custom_prompt_column">		
												<p><?php echo wp_kses_post( __("Header text in custom prompt","push-notification-for-post-and-buddypress"));?></p>
												<textarea  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_custom_prompt_header_text" name="pnfpb_ic_fcm_custom_prompt_header_text" ><?php if(get_option( 'pnfpb_ic_fcm_custom_prompt_header_text' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_custom_prompt_header_text' ));} else { echo wp_kses_post( __("We would like to show you notifications for the latest news and updates.","push-notification-for-post-and-buddypress"));} ?></textarea>
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname pnfpb_ic_push_settings_table_label_custom_prompt_column">		
												<p><?php echo wp_kses_post( __("Confirmation message after subscribing for notifications","push-notification-for-post-and-buddypress"));?></p>
												<textarea  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_custom_prompt_subscribed_text" name="pnfpb_ic_fcm_custom_prompt_subscribed_text" ><?php if(get_option( 'pnfpb_ic_fcm_custom_prompt_subscribed_text' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_custom_prompt_subscribed_text' ));} else { echo wp_kses_post( __("You are subscribed to notifications","push-notification-for-post-and-buddypress"));} ?></textarea>
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_custom_prompt_confirmation_message_on_off">
													<?php echo wp_kses_post( __("Hide Confirmation message after subscribing for notifications","push-notification-for-post-and-buddypress"));?>
												</label>												
												<label class="pnfpb_switch">
													<input  id="pnfpb_custom_prompt_confirmation_message_on_off" name="pnfpb_custom_prompt_confirmation_message_on_off" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_custom_prompt_confirmation_message_on_off' ) ); ?>  />
													<span class="pnfpb_slider round"></span>
												</label>
											</td>
										</tr>										
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">		
												<p><?php echo wp_kses_post( __("If cancel button is pressed while subscribing, show custom prompt after below number of days","push-notification-for-post-and-buddypress"));?></p>
												<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_custom_prompt_show_again_days" name="pnfpb_ic_fcm_custom_prompt_show_again_days" type="number" value="<?php if(get_option( 'pnfpb_ic_fcm_custom_prompt_show_again_days' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_custom_prompt_show_again_days' ));} else { echo "7";} ?>"/>
											</td>
										</tr>										
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo wp_kses_post( __("Allow Notification Button text color","push-notification-for-post-and-buddypress"));?></p>
												<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_custom_prompt_allow_button_background" id="pnfpb_ic_fcm_custom_prompt_allow_button_text_color" name="pnfpb_ic_fcm_custom_prompt_allow_button_text_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_custom_prompt_allow_button_text_color' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_custom_prompt_allow_button_text_color' )); } else { echo wp_kses_data('#ffffff'); }?>" />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo wp_kses_post( __("Push notification subscribe Button background color","push-notification-for-post-and-buddypress"));?></p>
												<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_custom_prompt_allow_button_background" id="pnfpb_ic_fcm_push_custom_prompt_allow_button_background" name="pnfpb_ic_fcm_push_custom_prompt_allow_button_background" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_push_custom_prompt_allow_button_background' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_push_custom_prompt_allow_button_background' )); } else { echo wp_kses_data('#0078d1');}?>" />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo wp_kses_post( __("Allow notification button text","push-notification-for-post-and-buddypress"));?></p>
												<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_custom_prompt_allow_button_text" name="pnfpb_ic_fcm_custom_prompt_allow_button_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_custom_prompt_allow_button_text' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_custom_prompt_allow_button_text') );} else { echo wp_kses_post( __("Allow","push-notification-for-post-and-buddypress"));} ?>"  />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo wp_kses_post( __("Cancel Notification Button text color","push-notification-for-post-and-buddypress"));?></p>
												<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_custom_prompt_cancel_button_background" id="pnfpb_ic_fcm_custom_prompt_cancel_button_text_color" name="pnfpb_ic_fcm_custom_prompt_cancel_button_text_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_custom_prompt_cancel_button_text_color' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_custom_prompt_cancel_button_text_color' )); } else { echo wp_kses_data('#0078d1'); }?>" />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo wp_kses_post( __("Cancel Button background color","push-notification-for-post-and-buddypress"));?></p>
												<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_custom_prompt_cancel_button_background" id="pnfpb_ic_fcm_push_custom_prompt_cancel_button_background" name="pnfpb_ic_fcm_push_custom_prompt_cancel_button_background" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_push_custom_prompt_cancel_button_background' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_push_custom_prompt_cancel_button_background' )); } else { echo wp_kses_data('#ffffff');}?>" />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo wp_kses_post( __("Cancel button text","push-notification-for-post-and-buddypress"));?></p>
												<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_custom_prompt_cancel_button_text" name="pnfpb_ic_fcm_custom_prompt_cancel_button_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_custom_prompt_cancel_button_text' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_custom_prompt_cancel_button_text' ));} else { echo wp_kses_post( __("Cancel","push-notification-for-post-and-buddypress"));} ?>"  />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo wp_kses_post( __("Close Button text color","push-notification-for-post-and-buddypress"));?></p>
												<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_custom_prompt_close_button_background" id="pnfpb_ic_fcm_custom_prompt_close_button_text_color" name="pnfpb_ic_fcm_custom_prompt_close_button_text_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_custom_prompt_close_button_text_color' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_custom_prompt_close_button_text_color' )); } else { echo wp_kses_data('#0078d1'); }?>" />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo wp_kses_post( __("Close Button background color","push-notification-for-post-and-buddypress"));?></p>
												<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_custom_prompt_close_button_background" id="pnfpb_ic_fcm_push_custom_prompt_close_button_background" name="pnfpb_ic_fcm_push_custom_prompt_close_button_background" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_push_custom_prompt_close_button_background' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_push_custom_prompt_close_button_background' )); } else { echo wp_kses_data('#ffffff');}?>" />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo wp_kses_post( __("Close button text","push-notification-for-post-and-buddypress"));?></p>
												<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_custom_prompt_close_button_text" name="pnfpb_ic_fcm_custom_prompt_close_button_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_custom_prompt_close_button_text' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_custom_prompt_close_button_text' ));} else { echo wp_kses_post( __("Close","push-notification-for-post-and-buddypress"));} ?>"  />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo wp_kses_post( __("Wait message while processing push subscription","push-notification-for-post-and-buddypress"));?></p>
												<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_custom_prompt_popup_wait_message" name="pnfpb_ic_fcm_custom_prompt_popup_wait_message" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_custom_prompt_popup_wait_message' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_custom_prompt_popup_wait_message' ));} else { echo wp_kses_post( __("Please wait...processing","push-notification-for-post-and-buddypress"));} ?>"  />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_custom_prompt_options_on_off">
													<?php echo wp_kses_post( __("Show subscription options button","push-notification-for-post-and-buddypress"));?>
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
													<?php echo "<b>".wp_kses_data( __("Customize Bell prompt icon, Button color and text","push-notification-for-post-and-buddypress"))."</b>";?>
												</th>
											</tr>
										</thead>
										<tbody>
    										<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">										
													<p>
														<?php echo wp_kses_post( __("Push Subscribe prompt Icon(32x32 pixels)","push-notification-for-post-and-buddypress"));?>
													</p>
													<table>
														<tr>
                											<td class="column-columnname">
                    											<button id="pnfpb_ic_fcm_popup_subscribe_button_icon" class="pnfpb_ic_push_settings_upload_icon">
																	<?php echo wp_kses_post( __("Upload Icon","push-notification-for-post-and-buddypress"));?>
																</button>
                    											<input type="hidden" id="pnfpb_ic_fcm_popup_subscribe_button_icon" name="pnfpb_ic_fcm_popup_subscribe_button_icon" value="<?php if (get_option( 'pnfpb_ic_fcm_popup_subscribe_button_icon' )) { echo wp_kses_data(get_option('pnfpb_ic_fcm_popup_subscribe_button_icon')); } else { echo esc_url(plugin_dir_url( __DIR__ )).'public/img/pushbell-pnfpb.png';} ?>" />
                											</td>
            											</tr>
														<tr>
                											<td class="column-columnname">
                    											<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        											<div id="pnfpb_ic_fcm_popup_subscribe_button_icon_preview" style="background-image: url(<?php if (get_option( 'pnfpb_ic_fcm_popup_subscribe_button_icon' )) { echo wp_kses_data(get_option('pnfpb_ic_fcm_popup_subscribe_button_icon')); } else { echo esc_url(plugin_dir_url( __DIR__ )).'public/img/pushbell-pnfpb.png';} ?>);width:32px; height:32px;overflow:hidden;border-radius:50%;margin:20px auto;background-position:center;background-repeat:no-repeat;background-size:cover;">
																	</div>
                    											</div>
                											</td>
            											</tr>
													</table>
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Header text in custom prompt","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_popup_header_text" name="pnfpb_ic_fcm_popup_header_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_popup_header_text' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_popup_header_text' ));} else { echo wp_kses_post( __("Manage push notifications","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Button text color","push-notification-for-post-and-buddypress"));?></p>
													<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_prompt_button_background" id="pnfpb_ic_fcm_popup_subscribe_button_text_color" name="pnfpb_ic_fcm_popup_subscribe_button_text_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_popup_subscribe_button_text_color' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_popup_subscribe_button_text_color' )); } else { echo wp_kses_data('#ffffff'); }?>" />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Push notification subscribe Button background color","push-notification-for-post-and-buddypress"));?></p>
													<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_prompt_button_background" id="pnfpb_ic_fcm_popup_subscribe_button_color" name="pnfpb_ic_fcm_popup_subscribe_button_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_popup_subscribe_button_color' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_popup_subscribe_button_color' )); } else { echo wp_kses_data('#e54b4d');}?>" />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Push notification subscribe text","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_popup_subscribe_button" name="pnfpb_ic_fcm_popup_subscribe_button" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_popup_subscribe_button' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_popup_subscribe_button' ));} else { echo wp_kses_post( __("Subscribe","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Push notification unsubscribe text","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_popup_unsubscribe_button" name="pnfpb_ic_fcm_popup_unsubscribe_button" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_popup_unsubscribe_button' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_popup_unsubscribe_button' ));} else { echo wp_kses_post( __("Unsubscribe","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Notification subscribed message when hover on push icon","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_popup_subscribe_message" name="pnfpb_ic_fcm_popup_subscribe_message" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_popup_subscribe_message' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_popup_subscribe_message' ));} else { echo wp_kses_post( __("You are subscribed to push notification","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Notification not subscribed message when hover on push icon","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_popup_unsubscribe_message" name="pnfpb_ic_fcm_popup_unsubscribe_message" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_popup_unsubscribe_message' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_popup_unsubscribe_message' ));} else { echo wp_kses_post( __("Push notification not subscribed","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Wait message while processing push subscription","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_popup_wait_message" name="pnfpb_ic_fcm_popup_wait_message" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_popup_wait_message' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_popup_wait_message' ));} else { echo wp_kses_post( __("Please wait...processing","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_bell_icon_prompt_options_on_off">
														<?php echo wp_kses_post( __("Show subscription options button","push-notification-for-post-and-buddypress"));?>
													</label>												
													<label class="pnfpb_switch">
														<input  id="pnfpb_bell_icon_prompt_options_on_off" name="pnfpb_bell_icon_prompt_options_on_off" type="checkbox" value="1" <?php  if(get_option( 'pnfpb_bell_icon_prompt_options_on_off','0' ) === '0' || get_option( 'pnfpb_bell_icon_prompt_options_on_off','0' ) === '1' ) { echo wp_kses_data('checked');
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
													<?php echo "<b>".wp_kses_data( __("Customize Subscription options text,color,button in bell icon and in custom prompt","push-notification-for-post-and-buddypress"))."</b>";?>
												</th>
											</tr>
										</thead>
										<tbody>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Subscription option update button text","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_update_text" name="pnfpb_bell_icon_subscription_option_update_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_update_text' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_update_text' ));} else { echo wp_kses_post( __("Update","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Subscription option update button text color","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_update_text_color" name="pnfpb_bell_icon_subscription_option_update_text_color" type="color" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_update_text_color' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_update_text_color' ));} else { echo wp_kses_data('#ffffff');} ?>"  />
												</td>
<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Subscription option update button background color","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_update_background_color" name="pnfpb_bell_icon_subscription_option_update_background_color" type="color" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_update_background_color' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_update_background_color' ));} else { echo wp_kses_data('#135e96');} ?>"  />
												</td>												
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Subscription option list background color ","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_list_background_color" name="pnfpb_bell_icon_subscription_option_list_background_color" type="color" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_list_background_color' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_list_background_color' ));} else { echo wp_kses_data('#cccccc');} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Subscription option list text color ","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_list_text_color" name="pnfpb_bell_icon_subscription_option_list_text_color" type="color" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_list_text_color' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_list_text_color' ));} else { echo wp_kses_data('#000000');} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Subscription option list checkbox color ","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_list_checkbox_color" name="pnfpb_bell_icon_subscription_option_list_checkbox_color" type="color" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_list_checkbox_color' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_list_checkbox_color' ));} else { echo wp_kses_data('#135e96');} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Subscription option update confirmation message ","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_update_confirmation_message" name="pnfpb_bell_icon_subscription_option_update_confirmation_message" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_update_confirmation_message' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_update_confirmation_message' ));} else { echo wp_kses_post( __("subscription updated","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>
											</tr>											
											<tr class="pnfpb_ic_push_settings_table_row">
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Subscription option text for all subscriptions","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_activity_text" name="pnfpb_bell_icon_subscription_option_all_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_all_text' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_all_text' ));} else { echo wp_kses_post( __("All","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>												
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Subscription option text for Post","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_post_text" name="pnfpb_bell_icon_subscription_option_post_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_post_text' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_post_text' ));} else { echo wp_kses_post( __("Post","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>
												<?php
													$args = array(
														'public'   => true,
														'_builtin' => false
													); 												
													$output = 'names'; // or objects
													$operator = 'and'; // 'and' or 'or'
													$custposttypes = get_post_types( $args, $output, $operator );
													foreach ( $custposttypes as $post_type ) {
														if ($post_type !== 'buddypress' && $post_type !== 'post') {
												?>
															<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
																<p><?php echo wp_kses_post( __("Subscription option text for ","push-notification-for-post-and-buddypress")).esc_html(ucwords($post_type));?></p>
																<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_<?php echo wp_kses_data($post_type); ?>_text" name="pnfpb_bell_icon_subscription_option_<?php echo wp_kses_data($post_type); ?>_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_'.wp_kses_data($post_type).'_text' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_'.wp_kses_data($post_type).'_text' ));} else { echo esc_html(ucwords($post_type));} ?>"  />
															</td>
												<?php
														}
													}
												?>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Subscription option text for Activity","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_activity_text" name="pnfpb_bell_icon_subscription_option_activity_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_activity_text' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_activity_text' ));} else { echo wp_kses_post( __("Activity","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Subscription option text for all comments","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_all_comments_text" name="pnfpb_bell_icon_subscription_option_all_comments_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_all_comments_text' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_all_comments_text' ));} else { echo wp_kses_post( __("All Comments","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>												
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Subscription option text for my comments","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_my_comments_text" name="pnfpb_bell_icon_subscription_option_my_comments_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_my_comments_text' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_my_comments_text') );} else { echo wp_kses_post( __("My Comments","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Subscription option text for Private message","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_private_message_text" name="pnfpb_bell_icon_subscription_option_private_message_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_private_message_text' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_private_message_text') );} else { echo wp_kses_post( __("Private Message","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Subscription option text for New member joined","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_new_member_joined_text" name="pnfpb_bell_icon_subscription_option_new_member_joined_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_new_member_joined_text' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_new_member_joined_text' ));} else { echo wp_kses_post( __("New Member joined","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Subscription option text for Friendship request","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_friendship_request_text" name="pnfpb_bell_icon_subscription_option_friendship_request_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_friendship_request_text' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_friendship_request_text' ));} else { echo wp_kses_post( __("Friendship request","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Subscription option text for Friendship accepted","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_friendship_accepted_text" name="pnfpb_bell_icon_subscription_option_friendship_accepted_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_friendship_accepted_text' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_friendship_accepted_text' ));} else { echo wp_kses_post( __("Friendship accepted","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Subscription option text for Avatar change","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_avatar_change_text" name="pnfpb_bell_icon_subscription_option_avatar_change_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_avatar_change_text' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_avatar_change_text' ));} else { echo wp_kses_post( __("Avatar change","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>												
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Subscription option text for Cover image change","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_cover_image_change_text" name="pnfpb_bell_icon_subscription_option_cover_image_change_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_cover_image_change_text' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_cover_image_change_text' ));} else { echo wp_kses_post( __("Cover image change","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Subscription option text for Group details update","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_group_details_update_text" name="pnfpb_bell_icon_subscription_option_group_details_update_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_group_details_update_text' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_group_details_update_text' ));} else { echo wp_kses_post( __("Group details update","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo wp_kses_post( __("Subscription option text for Group invite","push-notification-for-post-and-buddypress"));?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_bell_icon_subscription_option_group_invite_text" name="pnfpb_bell_icon_subscription_option_group_invite_text" type="text" value="<?php if(get_option( 'pnfpb_bell_icon_subscription_option_group_invite_text' )) {echo wp_kses_data(get_option( 'pnfpb_bell_icon_subscription_option_group_invite_text' ));} else { echo wp_kses_post( __("Group invite","push-notification-for-post-and-buddypress"));} ?>"  />
												</td>												
											</tr>											
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
						<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_replace_notifications">
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_fcm_replace_notifications" name="pnfpb_ic_fcm_replace_notifications" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_replace_notifications' ) ); ?>  />
									<span class="pnfpb_slider round"></span>
								</label>
									<?php echo wp_kses_post( __("Replace previous notification with new notification using tag parameter (web push except safari)","push-notification-for-post-and-buddypress"));?>
									<br/>
									<?php echo wp_kses_post( __("(If tag is enabled it will replace previous notification with new notification to avoid too many notification filled up in notification center )","push-notification-for-post-and-buddypress"));?>
							</label>
						</div>						
					</div>
				</div>					
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
						<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_renotify_notification">
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_fcm_renotify_notification" name="pnfpb_ic_fcm_renotify_notification" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_renotify_notification' ) ); ?>  />
									<span class="pnfpb_slider round"></span>
								</label>
									<?php echo wp_kses_post( __("Stop re-notify after replacing previous notification using renotify parameter (web push except safari)","push-notification-for-post-and-buddypress"));?>
									<br/>
									<?php echo wp_kses_post( __("(If tag is enabled to replace previous notification then it will not re-notify users after replacing previous notification )","push-notification-for-post-and-buddypress"));?>
							</label>
						</div>						
					</div>
				</div>				
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
						<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_push_prompt_enable">
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_fcm_loggedin_notify" name="pnfpb_ic_fcm_loggedin_notify" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_loggedin_notify' ) ); ?>  />
									<span class="pnfpb_slider round"></span>
								</label>
									<?php echo wp_kses_post( __("Push notification only for loggedin users","push-notification-for-post-and-buddypress"));?>
							</label>
						</div>						
					</div>
				</div>
			</td>
		</tr>
		<?php } ?>
		<tr class="pnfpb_navy_blue_background_color pnfpb_white_text_color pnfpb_section_header_font_16px">
			<td class="pnfpb_ic_push_settings_table_column pnfpb_white_text_color pnfpb_section_header_font_16px">
				<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_white_text_color pnfpb_section_header_font_16px"><?php echo wp_kses_post( __("Post/Custom post types","push-notification-for-post-and-buddypress")); ?></label>
			</td>
		</tr>
        <tr class="pnfpb_ic_push_settings_table_row">
			<td class="pnfpb_ic_push_settings_table_column column-columnname">
				<div  class="pnfpb_row">
					<b><?php echo wp_kses_post( __('While saving/updating post in admin area, make sure metabox for PNFPB Push notification is switched ON. For frontend post/custom post,it will work as it is without metabox',"push-notification-for-post-and-buddypress")); ?></b>
				</div>
				<div class="pnfpb_row">
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">				
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_post_enable"><?php echo wp_kses_post( __("Post","push-notification-for-post-and-buddypress"));?></label>						<label class="pnfpb_switch">
								<input id="pnfpb_ic_fcm_post_enable" name="pnfpb_ic_fcm_post_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_post_enable' ) ); ?>  /> 
								<span class="pnfpb_slider round"></span>
							</label>
						</div>
					</div>
        		<?php
            		$posttypecount = 0;
            		$rowcount = 0;
					$cutomize_post_field_notification_title = '<br/><br/><br/><br/>'.__('(use [member name] shortcode to display member name)<br/>if following custom title are blank then post title/custom post type title will be in push notification title<br/>Example "[member name] published a post" will display as "Tom published a post" where Tom is member name<br/>',"push-notification-for-post-and-buddypress").'<div class="pnfpb_ic_post_content_form"><b>'.__("Notification title for Post","push-notification-for-post-and-buddypress").'</b><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_post_title" name="pnfpb_ic_fcm_post_title" type="text" value="'.get_option('pnfpb_ic_fcm_post_title').'" /></div><br/>';
					
           			 $totalposttype = count($custposttypes);
					 
            		foreach ( $custposttypes as $post_type ) {
						
                		$labeltext = $post_type;
						
						$cutomize_post_field_notification_title .= '<div class="pnfpb_ic_'.$post_type.'_content_form"><b>'.__("Notification title for ","push-notification-for-post-and-buddypress").$post_type.'</b><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_'.$post_type.'_title" name="pnfpb_ic_fcm_'.$post_type.'_title" type="text" value="'.get_option('pnfpb_ic_fcm_'.$post_type.'_title').'" /></div><br/>';
        		?> 
					<?php if ($post_type !== 'buddypress') { ?>
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">				
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_<?php echo wp_kses_data($labeltext); ?>_enable"><?php echo wp_kses_data($labeltext); ?></label>
							<label class="pnfpb_switch">	
								<input id="pnfpb_ic_fcm_<?php echo wp_kses_data($post_type); ?>_enable" name="pnfpb_ic_fcm_<?php echo wp_kses_data($post_type); ?>_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_'.$post_type.'_enable' ) ); ?>  />
								<span class="pnfpb_slider round"></span>
							</label>
						</div>
					</div>
        		<?php
					}
                	$posttypecount++;
                	$rowcount++;
           	 	}
        		?>
					<div class="pnfpb_column">
						<button type="button" class="pnfpb_post_type_content_button" onclick="toggle_post_type_content_form()"><?php echo wp_kses_post( __("Customize","push-notification-for-post-and-buddypress")); ?></button>
					</div>
			</div>	
			<div class="pnfpb_row">
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">
							<?php
								$pnfpb_ic_fcm_disable_post_update_enable = '0';
								if (get_option( 'pnfpb_ic_fcm_disable_post_update_enable') && get_option( 'pnfpb_ic_fcm_disable_post_update_enable')  === '1') {
									$pnfpb_ic_fcm_disable_post_update_enable = '1';
								}
							?>
							<label class="pnfpb_switch">
								<input  id="pnfpb_ic_fcm_disable_post_update_enable" name="pnfpb_ic_fcm_disable_post_update_enable" type="checkbox" value="1" <?php checked( '1', $pnfpb_ic_fcm_disable_post_update_enable ); ?>  />
								<span class="pnfpb_slider round"></span>
							</label>							
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_disable_post_update_enable">
								<?php echo wp_kses_post( __("Send notifications only for new post (not for updated post)","push-notification-for-post-and-buddypress"));?>
							</label>
						</div>
					</div>
			</div>
			<div class="pnfpb_row">
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">
							<?php
								$pnfpb_ic_fcm_only_post_subscribers_enable = '0';
								if (get_option( 'pnfpb_ic_fcm_only_post_subscribers_enable') && get_option( 'pnfpb_ic_fcm_only_post_subscribers_enable')  === '1') {
									$pnfpb_ic_fcm_only_post_subscribers_enable = '1';
								}
							?>
							<label class="pnfpb_switch">
								<input  id="pnfpb_ic_fcm_only_post_subscribers_enable" name="pnfpb_ic_fcm_only_post_subscribers_enable" type="checkbox" value="1" <?php checked( '1', $pnfpb_ic_fcm_only_post_subscribers_enable ); ?>  />
								<span class="pnfpb_slider round"></span>
							</label>							
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_only_post_subscribers_enable">
								<?php echo wp_kses_post( __("To send notifications only to bbpress forum topic subscribers","push-notification-for-post-and-buddypress"));?>
							</label>
						</div>
					</div>
			</div>				
			<div class="pnfpb_row">
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">
							<?php
								$pnfpb_ic_fcm_post_schedule_now_enable = '0';
								if (get_option( 'pnfpb_ic_fcm_post_schedule_now_enable') && get_option( 'pnfpb_ic_fcm_post_schedule_now_enable')  === '1') {
									$pnfpb_ic_fcm_post_schedule_now_enable = '1';
								}
							?>
							<label class="pnfpb_switch">
								<input  id="pnfpb_ic_fcm_post_schedule_now_enable" name="pnfpb_ic_fcm_post_schedule_now_enable" type="checkbox" value="1" <?php checked( '1', $pnfpb_ic_fcm_post_schedule_now_enable ); ?>  />
								<span class="pnfpb_slider round"></span>
							</label>							
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_post_schedule_now_enable">
								<?php echo wp_kses_post( __("Send notification in action scheduler asynchronous background mode to avoid server overload.<br/>(Enable this when more number of subscribers or notifications, it will take 30 to 60 seconds for batch process)","push-notification-for-post-and-buddypress"));?>
							</label>
						</div>
					</div>
			</div>
			<div class="pnfpb_row">
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_post_schedule_enable">
								<?php echo wp_kses_post( __("Schedule","push-notification-for-post-and-buddypress")).'<br/>'.wp_kses_data( __("in action scheduler","push-notification-for-post-and-buddypress"));?>
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
								<?php echo wp_kses_post( __("In seconds<br/>(min 300)","push-notification-for-post-and-buddypress"));?>
								<input  class="pnfpb_ic_fcm_post_timeschedule_seconds_radio_block" class="pnfpb_ic_fcm_post_timeschedule_seconds" name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" value="seconds" <?php checked( 'seconds', get_option( 'pnfpb_ic_fcm_post_timeschedule_enable' ) ); ?>  />
								<span class="pnfpb_checkmark"></span>
							</label>
							<label class="pnfpb_ic_fcm_post_timeschedule_seconds_block">
								<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_post_timeschedule_seconds" name="pnfpb_ic_fcm_post_timeschedule_seconds" class="pnfpb_ic_fcm_post_timeschedule_seconds" type="number" min="300" value="<?php if ((!get_option( 'pnfpb_ic_fcm_post_timeschedule_seconds')) || (get_option( 'pnfpb_ic_fcm_post_timeschedule_seconds' ) && get_option( 'pnfpb_ic_fcm_post_timeschedule_seconds' ) < 300)) { echo 300; } else  { echo wp_kses_data(get_option( 'pnfpb_ic_fcm_post_timeschedule_seconds' )); } ?>" required/>		
							</label>
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container">
								<?php echo wp_kses_post( __("Hourly","push-notification-for-post-and-buddypress"));?>
								<input  name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" value="hourly" <?php checked( 'hourly', get_option( 'pnfpb_ic_fcm_post_timeschedule_enable' ) ); ?>  />
								<span class="pnfpb_checkmark"></span>
							</label>
							<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
								<?php echo wp_kses_post( __("Twicedaily","push-notification-for-post-and-buddypress"));?>
								<input name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" value="twicedaily" <?php checked( 'twicedaily', get_option( 'pnfpb_ic_fcm_post_timeschedule_enable' ) ); ?>  />
								<span class="pnfpb_checkmark"></span>
							</label>
							<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
								<?php echo wp_kses_post( __("Daily","push-notification-for-post-and-buddypress"));?>
								<input name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" value="daily" <?php checked( 'daily', get_option( 'pnfpb_ic_fcm_post_timeschedule_enable' ) ); ?>  />
								<span class="pnfpb_checkmark"></span>
							</label>
							<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
								<?php echo wp_kses_post( __("Weekly","push-notification-for-post-and-buddypress"));?>
								<input name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" value="weekly" <?php checked( 'weekly', get_option( 'pnfpb_ic_fcm_post_timeschedule_enable' ) ); ?>  />
								<span class="pnfpb_checkmark"></span>
							</label>
						</div>
					</div>
				</div>
				<div  class="pnfpb_row">
					<?php echo esc_url('<a href="'.get_home_url().'/wp-admin/admin.php?page=pnfpb_icfm_action_scheduler&s=PNFPB_cron_post_hook&action=-1&paged=1&action2=-1" target="_blank">').wp_kses_data( __('Manage your scheduled tasks for post notifications in action scheduler tab - click here. Scheduling is available only for POST type (not for custom post types)',"push-notification-for-post-and-buddypress")).'</a>'; ?>
				</div>
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
						<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_push_prompt_enable">
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_fcm_show_allposttype_subscriptions_custom_prompt" name="pnfpb_ic_fcm_show_allposttype_subscriptions_custom_prompt" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_show_allposttype_subscriptions_custom_prompt' ) ); ?>  />
									<span class="pnfpb_slider round"></span>
								</label>
									<?php echo wp_kses_post( __("Show custom post types subscription options in custom prompt/bell prompt/shortcode","push-notification-for-post-and-buddypress"));?>
							</label>
						</div>						
					</div>
				</div>
				<div class="pnfpb_ic_post_type_content_form">
					<?php echo wp_kses($cutomize_post_field_notification_title,$allowed_html); ?>
				</div>
			</td>			
		</tr>
		<tr class="pnfpb_navy_blue_background_color pnfpb_white_text_color pnfpb_section_header_font_16px">
			<td class="pnfpb_ic_push_settings_table_column pnfpb_white_text_color pnfpb_section_header_font_16px">
				<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_white_text_color pnfpb_section_header_font_16px"><?php echo wp_kses_post( __("BuddyPress or BuddyBoss activities or group activities push notification","push-notification-for-post-and-buddypress")); ?></label>
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
									<?php echo wp_kses_post( __("BuddyPress activities","push-notification-for-post-and-buddypress"));?>
							</label>
						</div>
					</div>
					<div class="pnfpb_column_400">
						<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container  pnfpb_margin_left_4 pnfpb_padding_top_8">
								<?php echo wp_kses_post( __("All activities","push-notification-for-post-and-buddypress"));?>
								<input  id="pnfpb_ic_fcm_buddypress_enable" name="pnfpb_ic_fcm_buddypress_enable" type="radio" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_buddypress_enable' ) ); ?>  />
								<span class="pnfpb_checkmark pnfpb_margin_top_6"></span>
							</label>
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container  pnfpb_padding_top_8">
									<input  id="pnfpb_ic_fcm_buddypress_group_enable" name="pnfpb_ic_fcm_buddypress_enable" type="radio" value="2" <?php checked( '2', get_option( 'pnfpb_ic_fcm_buddypress_enable' ) ); ?>  />
									<span class="pnfpb_checkmark  pnfpb_margin_top_6"></span>
									<?php echo wp_kses_post( __("Group activity (only for group members)","push-notification-for-post-and-buddypress"));?>
							</label>
							<button type="button" class="pnfpb_activity_form_button" onclick="toggle_activity_content_form()"><?php echo wp_kses_post( __("Customize","push-notification-for-post-and-buddypress")); ?></button>
						</div>
					</div>
				</div>
				<div class="pnfpb_row">
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">
							<?php
								$pnfpb_ic_fcm_activity_schedule_now_enable = '0';
								if (get_option( 'pnfpb_ic_fcm_activity_schedule_now_enable') && get_option( 'pnfpb_ic_fcm_activity_schedule_now_enable')  === '1') {
									$pnfpb_ic_fcm_activity_schedule_now_enable = '1';
								}
							?>
							<label class="pnfpb_switch">
								<input  id="pnfpb_ic_fcm_activity_schedule_now_enable" name="pnfpb_ic_fcm_activity_schedule_now_enable" type="checkbox" value="1" <?php checked( '1', $pnfpb_ic_fcm_activity_schedule_now_enable ); ?>  />
								<span class="pnfpb_slider round"></span>
							</label>							
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_activity_schedule_now_enable">
								<?php echo wp_kses_post( __("Send notification in action scheduler asynchronous background mode to avoid server overload.<br/>(Enable this when more number of subscribers or notifications, it will take 30 to 60 seconds for batch process)","push-notification-for-post-and-buddypress"));?>
							</label>
						</div>
					</div>
				</div>				
				<div class="pnfpb_row">
						<div class="pnfpb_column_400">
    						<div class="pnfpb_card">
								<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypressactivities_schedule_enable">
									<?php echo wp_kses_post( __("Schedule","push-notification-for-post-and-buddypress")).'<br/>'.wp_kses_data( __("in action scheduler","push-notification-for-post-and-buddypress"));?>
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
									<?php echo wp_kses_post( __("In seconds<br/>(min 300)","push-notification-for-post-and-buddypress"));?>
									<input  class="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_radio_block" class="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds" name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable" type="radio" value="seconds" <?php checked( 'seconds', get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_enable' ) ); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_block">
									<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds" name="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds" class="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds" type="number" min="300" value="<?php if ((!get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds')) || (get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds' ) && get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds' ) < 300)) { echo 300; } else  { echo wp_kses_data(get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds' )); } ?>" required/>		
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container" >
									<?php echo wp_kses_post( __("Hourly","push-notification-for-post-and-buddypress"));?>
									<input  id="pnfpb_ic_fcm_buddypressactivities_hourly_enable" name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable" type="radio" value="hourly" <?php checked( 'hourly', get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_enable' ) ); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container">
									<?php echo wp_kses_post( __("Twicedaily","push-notification-for-post-and-buddypress"));?>						
									<input  id="pnfpb_ic_fcm_buddypressactivities_twicedaily_enable" name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable" type="radio" value="twicedaily" <?php checked( 'twicedaily', get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_enable' ) ); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container">
									<?php echo wp_kses_post( __("Daily","push-notification-for-post-and-buddypress"));?>						
									<input  id="pnfpb_ic_fcm_buddypressactivities_daily_enable" name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable" type="radio" value="daily" <?php checked( 'daily', get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_enable' ) ); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container" >
									<?php echo wp_kses_post( __("Weekly","push-notification-for-post-and-buddypress"));?>						
									<input  id="pnfpb_ic_fcm_buddypressactivities_weekly_enable" name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable" type="radio" value="weekly" <?php checked( 'weekly', get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_enable' ) ); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
							</div>
						</div>					
				</div>
				<div  class="pnfpb_row">
					<?php if (get_option( 'pnfpb_ic_fcm_buddypress_enable' ) === '1') { ?>
						<?php echo esc_url('<a href="'.get_home_url().'/wp-admin/admin.php?page=pnfpb_icfm_action_scheduler&s=PNFPB_cron_buddypressactivities_hook&action=-1&paged=1&action2=-1" target="_blank">').wp_kses_data( __('Manage your scheduled tasks for BuddyPress activities notifications in action scheduler tab - click here',"push-notification-for-post-and-buddypress")).'</a>'; ?>
					<?php } else  { ?>
						<?php echo esc_url('<a href="'.get_home_url().'/wp-admin/admin.php?page=pnfpb_icfm_action_scheduler&s=PNFPB_cron_buddypressgroupactivities_hook&action=-1&paged=1&action2=-1" target="_blank">').wp_kses_data( __('Manage your scheduled tasks for BuddyPress group activities notifications in action scheduler tab - click here',"push-notification-for-post-and-buddypress")).'</a>'; ?>
					<?php } ?>
				</div>				
				<div class="pnfpb_ic_activity_content_form">
					<?php echo wp_kses_post( __("Notification title for BuddyPress new activity<br/>use [member name] shortcode to display member name along with custom title<br/>(use [group name] shortcode only for group buddypress activities to display member name)<br/>Example '[member name] posted an activity' will display as 'Tom posted an activity' where Tom is member name","push-notification-for-post-and-buddypress"));?><br/>
        			<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_activity_title" name="pnfpb_ic_fcm_activity_title" type="text" value="<?php echo wp_kses_data($activitytitle); ?>" /><br/><br/>
					<?php echo wp_kses_post( __("Default Notification content for BuddyPress new activity<br/> (or leave it as blank to display activity content in notification message)","push-notification-for-post-and-buddypress")); ?><br/>
        			<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_activity_message" name="pnfpb_ic_fcm_activity_message" type="text" value="<?php echo wp_kses_data($activitymessage); ?>" /><br/><br/>					
					<?php echo wp_kses_post( __("Notification title for BuddyPress new group activity","push-notification-for-post-and-buddypress"));?><br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_group_activity_title" name="pnfpb_ic_fcm_group_activity_title" type="text" value="<?php echo wp_kses_data($activitygroup); ?>"/><br/><br/>
					<?php echo wp_kses_post( __("Default Notification content for BuddyPress new group activity<br/> (or leave it as blank to display activity content in notification message)","push-notification-for-post-and-buddypress"));?><br/>
        			<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_group_activity_message" name="pnfpb_ic_fcm_group_activity_message" type="text" value="<?php echo wp_kses_data($groupactivitymessage); ?>" /><br/><br/>
					<div class="pnfpb_column_400">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_followers_enable">
								<?php echo wp_kses_post( __("Notify only BuddyPress user followers<br/><b>(it requires BuddyPress-followers plugin)</b>","push-notification-for-post-and-buddypress"));?>
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
		<tr class="pnfpb_navy_blue_background_color pnfpb_white_text_color pnfpb_section_header_font_16px">
			<td class="pnfpb_ic_push_settings_table_column pnfpb_white_text_color pnfpb_section_header_font_16px">
				<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_white_text_color pnfpb_section_header_font_16px"><?php echo wp_kses_post( __("BuddyPress or BuddyBoss comments push notification","push-notification-for-post-and-buddypress")); ?></label>
			</td>
		</tr>		
		<tr class="pnfpb_ic_push_settings_table_row">
            <td class="pnfpb_ic_push_settings_table_column column-columnname">
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_buddypress_bcomment_enable">
								<?php echo wp_kses_post( __("BuddyPress/Post comments","push-notification-for-post-and-buddypress"));?>
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
								<?php echo wp_kses_post( __("All","push-notification-for-post-and-buddypress"));?>
								<input  id="pnfpb_ic_fcm_buddypress_comments_radio_enable" name="pnfpb_ic_fcm_buddypress_comments_radio_enable" type="radio" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_buddypress_comments_radio_enable' ) ); ?>  />
								<span class="pnfpb_checkmark pnfpb_margin_top_6"></span>
							</label>
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container  pnfpb_padding_top_8">
								<input  id="pnfpb_ic_fcm_buddypress_comments_radio_enable" name="pnfpb_ic_fcm_buddypress_comments_radio_enable" type="radio" value="2" <?php checked( '2', get_option( 'pnfpb_ic_fcm_buddypress_comments_radio_enable' ) ); ?>  />
								<span class="pnfpb_checkmark  pnfpb_margin_top_6"></span>
								<?php echo wp_kses_post( __("Only for User's activities/Posts/My activities","push-notification-for-post-and-buddypress"));?>
							</label>
							<button type="button" class="pnfpb_comments_content_button" onclick="toggle_comments_content_form()"><?php echo wp_kses_post( __("Customize","push-notification-for-post-and-buddypress")); ?></button>
						</div>
					</div>	
				</div>
				<div class="pnfpb_row">
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">
							<?php
								$pnfpb_ic_fcm_comments_schedule_now_enable = '0';
								if (get_option( 'pnfpb_ic_fcm_comments_schedule_now_enable') && get_option( 'pnfpb_ic_fcm_comments_schedule_now_enable')  === '1') {
									$pnfpb_ic_fcm_comments_schedule_now_enable = '1';
								}
							?>
							<label class="pnfpb_switch">
								<input  id="pnfpb_ic_fcm_comments_schedule_now_enable" name="pnfpb_ic_fcm_comments_schedule_now_enable" type="checkbox" value="1" <?php checked( '1', $pnfpb_ic_fcm_comments_schedule_now_enable ); ?>  />
								<span class="pnfpb_slider round"></span>
							</label>						
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_comments_schedule_now_enable">
								<?php echo wp_kses_post( __("Send notification in action scheduler asynchronous background mode to avoid server overload.<br/>(Enable this when more number of subscribers or notifications, it will take 30 to 60 seconds for batch process)","push-notification-for-post-and-buddypress"));?>
							</label>
						</div>
					</div>
				</div>					
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
    						<div class="pnfpb_card">				
								<label class="pnfpb_ic_push_settings_table_label_checkbox">
									<?php echo wp_kses_post( __("Schedule","push-notification-for-post-and-buddypress")).'<br/>'.wp_kses_data( __("in action scheduler","push-notification-for-post-and-buddypress"));?>
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
									<?php echo wp_kses_post( __("In seconds<br/>(min 300)","push-notification-for-post-and-buddypress"));?>
									<input  class="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_radio_block" class="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds" name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable" type="radio" value="seconds" <?php checked( 'seconds', get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_enable' ) ); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_block">
									<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds" name="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds" class="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds" type="number" min="300" value="<?php if ((!get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds')) || (get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds' ) && get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds' ) < 300)) { echo 300; } else  { echo wp_kses_data(get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds' )); } ?>" required/>		
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
									<?php echo wp_kses_post( __("Hourly","push-notification-for-post-and-buddypress"));?>
									<input  id="pnfpb_ic_fcm_buddypresscomments_hourly_enable" name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable" type="radio" value="hourly" <?php checked( 'hourly', get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_enable' ) ); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
									<?php echo wp_kses_post( __("Twicedaily","push-notification-for-post-and-buddypress"));?>
									<input  id="pnfpb_ic_fcm_buddypresscomments_twicedaily_enable" name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable" type="radio" value="twicedaily" <?php checked( 'twicedaily', get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_enable' ) ); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
									<?php echo wp_kses_post( __("Daily","push-notification-for-post-and-buddypress"));?>
									<input  id="pnfpb_ic_fcm_buddypresscomments_daily_enable" name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable" type="radio" value="daily" <?php checked( 'daily', get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_enable' ) ); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
									<input  id="pnfpb_ic_fcm_buddypresscomments_weekly_enable" name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable" type="radio" value="weekly" <?php checked( 'weekly', get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_enable' ) ); ?>  />
									<?php echo wp_kses_post( __("Weekly","push-notification-for-post-and-buddypress"));?>
									<span class="pnfpb_checkmark"></span>
								</label>
							</div>
					</div>
				</div>
							<div  class="pnfpb_row">
								<?php echo esc_url('<a href="'.get_home_url().'/wp-admin/admin.php?page=pnfpb_icfm_action_scheduler&s=PNFPB_cron_buddypresscomments_hook&action=-1&paged=1&action2=-1" target="_blank">').wp_kses_data( __('Manage your scheduled tasks for BuddyPress comments/Post comments notifications in action scheduler tab - click here',"push-notification-for-post-and-buddypress")).'</a>'; ?>
							</div>				
				<div class="pnfpb_ic_comments_content_form">
					<label for="pnfpb_ic_fcm_comment_activity_title"><?php echo wp_kses_post( __("Notification title for BuddyPress new comment<br/>use [member name] shortcode to display member name along with custom title<br/>Example '[member name] posted a comment' will display as 'Tom posted a comment' where Tom is member name","push-notification-for-post-and-buddypress"));?></label><br/>
        			<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_comment_activity_title" name="pnfpb_ic_fcm_comment_activity_title" type="text" value="<?php echo wp_kses_data($activitycomment); ?>" /><br/><br/>
					<label for="pnfpb_ic_fcm_comment_activity_message"><?php echo wp_kses_post( __("Default Notification content for BuddyPress new comment<br/> (or leave it as blank to display comment content in notification message)","push-notification-for-post-and-buddypress"));?></label><br/>
        			<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_comment_activity_message" name="pnfpb_ic_fcm_comment_activity_message" type="text" value="<?php echo wp_kses_data($commentactivitymessage); ?>" /><br/><br/>
				</div>
			</td>
		</tr>
		<tr class="pnfpb_navy_blue_background_color pnfpb_white_text_color pnfpb_section_header_font_16px">
			<td class="pnfpb_ic_push_settings_table_column pnfpb_white_text_color pnfpb_section_header_font_16px">
				<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_white_text_color pnfpb_section_header_font_16px"><?php echo wp_kses_post( __("BuddyPress or BuddyBoss Private messages, Friendship request/accept and other options","push-notification-for-post-and-buddypress")); ?></label>
			</td>
		</tr>		
		<tr class="pnfpb_ic_push_settings_table_row">
            <td class="pnfpb_ic_push_settings_table_column column-columnname">
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
						<?php echo wp_kses_post( __("(For below BuddyPress options, user avatar image replaces notification icon in push notification)","push-notification-for-post-and-buddypress"));?>
					</div>
				</div>
				<div class="pnfpb_row">
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">
							<?php
								$pnfpb_ic_fcm_buddypressoptions_schedule_now_enable = '0';
								if (get_option( 'pnfpb_ic_fcm_buddypressoptions_schedule_now_enable') && get_option( 'pnfpb_ic_fcm_buddypressoptions_schedule_now_enable')  === '1') {
									$pnfpb_ic_fcm_buddypressoptions_schedule_now_enable = '1';
								}
							?>
							<label class="pnfpb_switch">
								<input  id="pnfpb_ic_fcm_buddypressoptions_schedule_now_enable" name="pnfpb_ic_fcm_buddypressoptions_schedule_now_enable" type="checkbox" value="1" <?php checked( '1', $pnfpb_ic_fcm_buddypressoptions_schedule_now_enable ); ?>  />
								<span class="pnfpb_slider round"></span>
							</label>							
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypressoptions_schedule_now_enable">
								<?php echo wp_kses_post( __("Send notification in action scheduler asynchronous background mode to avoid server overload.<br/>(Enable this when more number of subscribers or notifications, it will take 30 to 60 seconds for batch process)","push-notification-for-post-and-buddypress"));?>
							</label>
						</div>
					</div>
				</div>				
				<div class="pnfpb_row">
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_bprivatemessage_enable">
								<?php echo wp_kses_post( __("New private message","push-notification-for-post-and-buddypress"));?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
									<input  id="pnfpb_ic_fcm_bprivatemessage_enable" name="pnfpb_ic_fcm_bprivatemessage_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_bprivatemessage_enable' ) ); ?>  />	
									<span class="pnfpb_slider round"></span>
							</label>								
							<button type="button" class="pnfpb_private_message_button" onclick="toggle_private_message_form()"><?php echo wp_kses_post( __("Customize","push-notification-for-post-and-buddypress")); ?></button>
						</div>
					</div>
					<div class="pnfpb_ic_private_message_form pnfpb_column_400">
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_bprivatemessage_text_enable"><?php echo wp_kses_post( __("Private messages notification title","push-notification-for-post-and-buddypress"));?></label><br/>
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_bprivatemessage_text" name="pnfpb_ic_fcm_bprivatemessage_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_bprivatemessage_text' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_bprivatemessage_text' ));} else { echo wp_kses_post( __('[sender name] sent you a private message',"push-notification-for-post-and-buddypress"));} ?>"  />
					<br/><p><?php echo wp_kses_post( __('[sender name] is the shortcode which replaces with sender name and modify remaining text according to your choice',"push-notification-for-post-and-buddypress")); ?></p><br/>
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_bprivatemessage_text_enable"><?php echo wp_kses_post( __("Default Private message notification content","push-notification-for-post-and-buddypress"));?></label><br/>				
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_bprivatemessage_content" name="pnfpb_ic_fcm_bprivatemessage_content" type="text" value="<?php echo wp_kses_data($privatemessagecontent); ?>"  />
					</div>
					<?php if (get_option('pnfpb_progressier_push') !== '1' && get_option('pnfpb_webtoapp_push') !== '1') { ?>
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_new_member_enable">
								<?php echo wp_kses_post( __("New Member joined","push-notification-for-post-and-buddypress"));?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
								<input  id="pnfpb_ic_fcm_new_member_enable" name="pnfpb_ic_fcm_new_member_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_new_member_enable' ) ); ?>  />	
								<span class="pnfpb_slider round"></span>
							</label>
							<button type="button" class="pnfpb_new_member_button" onclick="toggle_new_member_form()"><?php echo wp_kses_post( __("Customize","push-notification-for-post-and-buddypress")); ?></button>	
						</div>
					</div>
					<div class="pnfpb_ic_new_member_form pnfpb_column_400">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_new_member_text"><?php echo wp_kses_post( __("New member notification title","push-notification-for-post-and-buddypress"));?></label><br/>
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_new_member_text" name="pnfpb_ic_fcm_new_member_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_new_member_text' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_new_member_text' ));} else { echo wp_kses_data('[member name] registered as new member');} ?>"  />
						<br/><p><?php echo wp_kses_post( __('[member name] is the shortcode which replaces with sender name and modify remaining text according to your choice',"push-notification-for-post-and-buddypress")); ?></p><br/>
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_new_member_content"><?php echo wp_kses_post( __("Default New member notification content","push-notification-for-post-and-buddypress"));?></label><br/>				
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_new_member_content" name="pnfpb_ic_fcm_new_member_content" type="text" value="<?php echo wp_kses_data($newmembercontent); ?>"  />
					</div>
					<?php } ?>
				</div>
				<div class="pnfpb_row">
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_friendship_request_enable">
								<?php echo wp_kses_post( __("Friendship request","push-notification-for-post-and-buddypress"));?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
								<input  id="pnfpb_ic_fcm_friendship_request_enable" name="pnfpb_ic_fcm_friendship_request_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_friendship_request_enable' ) ); ?>  />	
								<span class="pnfpb_slider round"></span>
							</label>
							<button type="button" class="pnfpb_friendship_request_button" onclick="toggle_friendship_request_form()"><?php echo wp_kses_post( __("Customize","push-notification-for-post-and-buddypress")); ?></button>
						</div>
					</div>
					<div class="pnfpb_ic_friendship_request_form pnfpb_column_400">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_friendship_request_text_enable"><?php echo wp_kses_post( __("Friendship request notification title","push-notification-for-post-and-buddypress"));?></label><br/>
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_friendship_request_text" name="pnfpb_ic_fcm_friendship_request_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_friendship_request_text' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_friendship_request_text' ));} else { echo wp_kses_post( __('[friendship initiator name] sent friendship request',"push-notification-for-post-and-buddypress"));} ?>"  />
						<br/><p><?php echo wp_kses_post( __('[friendship initiator name] is the shortcode which replaces with sender name and modify remaining text according to your choice',"push-notification-for-post-and-buddypress"));?></p><br/>
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_friendship_request_text_enable"><?php echo wp_kses_post( __("Default Friendship request notification content","push-notification-for-post-and-buddypress"));?></label><br/>				
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_friendship_request_content" name="pnfpb_ic_fcm_friendship_request_content" type="text" value="<?php echo wp_kses_data($friendshiprequestcontent); ?>"  />
					</div>
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_friendship_accept_enable">
								<?php echo wp_kses_post( __("Friendship accepted","push-notification-for-post-and-buddypress"));?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
								<input  id="pnfpb_ic_fcm_friendship_accept_enable" name="pnfpb_ic_fcm_friendship_accept_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_friendship_accept_enable' ) ); ?>  />	
								<span class="pnfpb_slider round"></span>
							</label>
							<button type="button" class="pnfpb_friendship_accept_button" onclick="toggle_friendship_accept_form()"><?php echo wp_kses_post( __("Customize","push-notification-for-post-and-buddypress")); ?></button>
						</div>
					</div>
					<div class="pnfpb_ic_friendship_accept_form pnfpb_column_400">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_friendship_accept_text_enable"><?php echo wp_kses_post( __("Friendship accepted notification title","push-notification-for-post-and-buddypress"));?></label><br/>
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_friendship_accept_text" name="pnfpb_ic_fcm_friendship_accept_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_friendship_accept_text' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_friendship_accept_text' ));} else { echo wp_kses_post( __('[friendship acceptor name] accepted your friendship request',"push-notification-for-post-and-buddypress"));} ?>"  />
						<br/><p><?php echo wp_kses_post( __('[friendship acceptor name] is the shortcode which replaces with sender name and modify remaining text according to your choice',"push-notification-for-post-and-buddypress"));?></p><br/>
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_friendship_accept_text_enable"><?php echo wp_kses_post( __("Default Friendship accepted notification content","push-notification-for-post-and-buddypress"));?></label><br/>				
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_friendship_accept_content" name="pnfpb_ic_fcm_friendship_accept_content" type="text" value="<?php echo wp_kses_data($friendshipacceptcontent); ?>"  />
					</div>
				</div>
				<?php if (get_option('pnfpb_progressier_push') !== '1' && get_option('pnfpb_webtoapp_push') !== '1') { ?>				
				<div class="pnfpb_row">
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_avatar_change_enable">
								<?php echo wp_kses_post( __("User avatar change","push-notification-for-post-and-buddypress"));?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
								<input  id="pnfpb_ic_fcm_avatar_change_enable" name="pnfpb_ic_fcm_avatar_change_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_avatar_change_enable' ) ); ?>  />	
								<span class="pnfpb_slider round"></span>
							</label>
							<button type="button" class="pnfpb_avatar_change_button" onclick="toggle_avatar_change_form()"><?php echo wp_kses_post( __("Customize","push-notification-for-post-and-buddypress")); ?></button>
						</div>
					</div>
					<div class="pnfpb_ic_avatar_change_form pnfpb_column_400">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_avatar_change_text_enable"><?php echo wp_kses_post( __("User avatar change notification title","push-notification-for-post-and-buddypress"));?></label><br/>
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_avatar_change_text" name="pnfpb_ic_fcm_avatar_change_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_avatar_change_text' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_avatar_change_text' ));} else { echo wp_kses_post( __('[member name] updated avatar',"push-notification-for-post-and-buddypress"));} ?>"  />
						<br/><p><?php echo wp_kses_post( __('[member name] is the shortcode which replaces with sender name and modify remaining text according to your choice',"push-notification-for-post-and-buddypress"));?></p><br/>
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_avatar_change_text_enable"><?php echo wp_kses_post( __("Default Avatar change notification content","push-notification-for-post-and-buddypress"));?></label><br/>				
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_avatar_change_content" name="pnfpb_ic_fcm_avatar_change_content" type="text" value="<?php echo wp_kses_data($avatarchangecontent); ?>"  />
					</div>
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_buddypress_cover_image_change_enable">
								<?php echo wp_kses_post( __("User cover image change","push-notification-for-post-and-buddypress"));?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
								<input  id="pnfpb_ic_fcm_cover_image_change_enable" name="pnfpb_ic_fcm_cover_image_change_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_cover_image_change_enable' ) ); ?>  />	
								<span class="pnfpb_slider round"></span>
							</label>
							<button type="button" class="pnfpb_cover_image_change_button" onclick="toggle_cover_image_change_form()"><?php echo wp_kses_post( __("Customize","push-notification-for-post-and-buddypress")); ?></button>
						</div>
					</div>
					<div class="pnfpb_ic_cover_image_change_form pnfpb_column_400">
						<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8" for="pnfpb_ic_fcm_buddypress_cover_image_change_text_enable"><?php echo wp_kses_post( __("User cover image notification title","push-notification-for-post-and-buddypress"));?></label><br/>
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_cover_image_change_text" name="pnfpb_ic_fcm_cover_image_change_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_cover_image_change_text' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_cover_image_change_text' ));} else { wp_kses_data(__('[member name] updated cover photo',"push-notification-for-post-and-buddypress"));} ?>"  />
						<br/><p><?php echo wp_kses_post( __('[member name] is the shortcode which replaces with sender name and modify remaining text according to your choice',"push-notification-for-post-and-buddypress"));?></p><br/>
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_cover_image_change_text_enable"><?php echo wp_kses_post( __("Default user cover image change notification content","push-notification-for-post-and-buddypress"));?></label><br/>				
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_cover_image_change_content" name="pnfpb_ic_fcm_cover_image_change_content" type="text" value="<?php echo wp_kses_data($coverimagechangecontent); ?>"  />
					</div>
				</div>
				<div class="pnfpb_row">
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_group_invitation_enable">
								<?php echo wp_kses_post( __("Group Invitation","push-notification-for-post-and-buddypress"));?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
									<input  id="pnfpb_ic_fcm_group_invitation_enable" name="pnfpb_ic_fcm_group_invitation_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_group_invitation_enable' ) ); ?>  />	
									<span class="pnfpb_slider round"></span>
							</label>								
							<button type="button" class="pnfpb_group_invitation_button" onclick="toggle_group_invitation_form()"><?php echo wp_kses_post( __("Customize","push-notification-for-post-and-buddypress")); ?></button>
						</div>
					</div>
					<div class="pnfpb_ic_group_invitation_form pnfpb_column_400">
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_group_invitation_text_enable"><?php echo wp_kses_post( __("Group Invitation notification title","push-notification-for-post-and-buddypress"));?></label><br/>
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_buddypress_group_invitation_text_enable" name="pnfpb_ic_fcm_buddypress_group_invitation_text_enable" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_buddypress_group_invitation_text_enable' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_buddypress_group_invitation_text_enable' ));} else { echo wp_kses_post( __('[sender name] invited to [group name]',"push-notification-for-post-and-buddypress"));} ?>"  />
					<br/><p><?php echo wp_kses_post( __('[sender name]  and [group name] are the shortcode which replaces with sender name, group name respectively. Modify remaining text according to your choice',"push-notification-for-post-and-buddypress")); ?></p><br/>
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_group_invitation_content_enable"><?php echo wp_kses_post( __("Default Group invitation notification content","push-notification-for-post-and-buddypress"));?></label><br/>				
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_buddypress_group_invitation_content_enable" name="pnfpb_ic_fcm_buddypress_group_invitation_content_enable" type="text" value="<?php echo wp_kses_data($groupinvitationcontent); ?>"  />
					</div>
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_group_details_updated_enable">
								<?php echo wp_kses_post( __("Group details update","push-notification-for-post-and-buddypress"));?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
									<input  id="pnfpb_ic_fcm_group_details_updated_enable" name="pnfpb_ic_fcm_group_details_updated_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_group_details_updated_enable' ) ); ?>  />	
									<span class="pnfpb_slider round"></span>
							</label>								
							<button type="button" class="pnfpb_group_details_updated_button" onclick="toggle_group_details_updated_form()"><?php echo wp_kses_post( __("Customize","push-notification-for-post-and-buddypress")); ?></button>
						</div>
					</div>
					<div class="pnfpb_ic_group_details_updated_form pnfpb_column_400">
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_group_details_updated_text_enable"><?php echo wp_kses_post( __("Group updated notification title","push-notification-for-post-and-buddypress"));?></label><br/>
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_buddypress_group_details_updated_text_enable" name="pnfpb_ic_fcm_buddypress_group_details_updated_text_enable" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_buddypress_group_details_updated_text_enable' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_buddypress_group_details_updated_text_enable' ));} else { echo wp_kses_post( __('[group name] group updated',"push-notification-for-post-and-buddypress"));} ?>"  />
					<br/><p><?php echo wp_kses_post( __('[group name] is the shortcode which replaces with group name. Modify remaining text according to your choice',"push-notification-for-post-and-buddypress")); ?></p><br/>
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_group_details_updated_content_enable"><?php echo wp_kses_post( __("Default Group updated notification content","push-notification-for-post-and-buddypress"));?></label><br/>				
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_buddypress_group_details_updated_content_enable" name="pnfpb_ic_fcm_buddypress_group_details_updated_content_enable" type="text" value="<?php echo wp_kses_data($groupdetailsupdatedcontent); ?>"  />
					</div>				
				</div>
				<?php } ?>		
			</td>
		</tr>
		<?php if (get_option('pnfpb_progressier_push') !== '1') { ?>
		<tr class="pnfpb_navy_blue_background_color pnfpb_white_text_color pnfpb_section_header_font_16px">
			<td class="pnfpb_ic_push_settings_table_column pnfpb_white_text_color pnfpb_section_header_font_16px">
				<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_white_text_color pnfpb_section_header_font_16px"><?php echo wp_kses_post( __("Admin only push notifications","push-notification-for-post-and-buddypress")); ?></label>
			</td>
		</tr>		
		<tr class="pnfpb_ic_push_settings_table_row">
            <td class="pnfpb_ic_push_settings_table_column column-columnname">
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
						<?php echo wp_kses_post( __("(following push notifications will be sent only to admin)","push-notification-for-post-and-buddypress"));?>
					</div>
				</div>
				<div class="pnfpb_row">
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">
							<?php
								$pnfpb_ic_fcm_admin_schedule_now_enable = '0';
								if (get_option( 'pnfpb_ic_fcm_admin_schedule_now_enable') && get_option( 'pnfpb_ic_fcm_admin_schedule_now_enable')  === '1') {
									$pnfpb_ic_fcm_admin_schedule_now_enable = '1';
								}
							?>
							<label class="pnfpb_switch">
								<input  id="pnfpb_ic_fcm_admin_schedule_now_enable" name="pnfpb_ic_fcm_admin_schedule_now_enable" type="checkbox" value="1" <?php checked( '1', $pnfpb_ic_fcm_admin_schedule_now_enable ); ?>  />
								<span class="pnfpb_slider round"></span>
							</label>							
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_admin_schedule_now_enable">
								<?php echo wp_kses_post( __("Send notification in action scheduler asynchronous background mode to avoid server overload.<br/>(Enable this when more number of subscribers or notifications, it will take 30 to 60 seconds for batch process)","push-notification-for-post-and-buddypress"));?>
							</label>
						</div>
					</div>
				</div>				
				<div class="pnfpb_row">
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_new_user_registration_enable">
								<?php echo wp_kses_post( __("New user registration","push-notification-for-post-and-buddypress"));?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
									<input  id="pnfpb_ic_fcm_new_user_registration_enable" name="pnfpb_ic_fcm_new_user_registration_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_new_user_registration_enable' ) ); ?>  />	
									<span class="pnfpb_slider round"></span>
							</label>								
							<button type="button" class="pnfpb_new_user_registration_button" onclick="toggle_new_user_registration_form()"><?php echo wp_kses_post( __("Customize","push-notification-for-post-and-buddypress")); ?></button>
						</div>
					</div>
					<div class="pnfpb_ic_new_user_registration_form pnfpb_column_400">
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_new_user_registration_text_enable"><?php echo wp_kses_post( __("New user registration notification title","push-notification-for-post-and-buddypress"));?></label><br/>
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_buddypress_new_user_registration_text_enable" name="pnfpb_ic_fcm_buddypress_new_user_registration_text_enable" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_buddypress_new_user_registration_text_enable' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_buddypress_new_user_registration_text_enable' ));} else { echo wp_kses_post( __('[user name] registered as new member',"push-notification-for-post-and-buddypress"));} ?>"  />
					<br/><p><?php echo wp_kses_post( __('[user name] is the shortcode which replaces with new user name. Modify remaining text according to your choice',"push-notification-for-post-and-buddypress")); ?></p><br/>
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_new_user_registration_content_enable"><?php echo wp_kses_post( __("Default New user registration notification content","push-notification-for-post-and-buddypress"));?></label><br/>				
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_buddypress_new_user_registration_content_enable" name="pnfpb_ic_fcm_buddypress_new_user_registration_content_enable" type="text" value="<?php echo wp_kses_data($newuserregistrationcontent); ?>"  />
					</div>
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_contact_form7_enable">
								<?php echo wp_kses_post( __("On Contact form7 submitted","push-notification-for-post-and-buddypress"));?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
									<input  id="pnfpb_ic_fcm_contact_form7_enable" name="pnfpb_ic_fcm_contact_form7_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_contact_form7_enable' ) ); ?>  />	
									<span class="pnfpb_slider round"></span>
							</label>								
							<button type="button" class="pnfpb_contact_form7_button" onclick="toggle_contact_form7_form()"><?php echo wp_kses_post( __("Customize","push-notification-for-post-and-buddypress")); ?></button>
						</div>
					</div>
					<div class="pnfpb_ic_contact_form7_form pnfpb_column_400">
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_contact_form7_text_enable"><?php echo wp_kses_post( __("Contact form7 submitted notification title","push-notification-for-post-and-buddypress"));?></label><br/>
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_buddypress_contact_form7_text_enable" name="pnfpb_ic_fcm_buddypress_contact_form7_text_enable" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_buddypress_contact_form7_text_enable' )) {echo wp_kses_data(get_option( 'pnfpb_ic_fcm_buddypress_contact_form7_text_enable' ));} else { echo wp_kses_post( __('You have received message from contact us page',"push-notification-for-post-and-buddypress"));} ?>"  />
					<br/><p><?php echo wp_kses_post( __('Modify text according to your choice',"push-notification-for-post-and-buddypress")); ?></p><br/>
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_contact_form7_content_enable"><?php echo wp_kses_post( __("Default message for notification content when contact form7 submitted","push-notification-for-post-and-buddypress"));?></label><br/>				
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_buddypress_contact_form7_content_enable" name="pnfpb_ic_fcm_buddypress_contact_form7_content_enable" type="text" value="<?php echo wp_kses_data($contactform7content); ?>"  />
					</div>				
				</div>				
			</td>
		</tr>
		<?php } ?>
    </tbody>
</table>
<h2 class="pnfpb_ic_push_settings_header2"><?php echo wp_kses_post( __("Firebase API httpv1","push-notification-for-post-and-buddypress"));?></h2>
<p><?php echo wp_kses_post( __('(Enable below option to use latest version of Firebase API - http v1. Recommended PHP version for this is 8.0 or above. It will work with PHP version 7.4 but recommended PHP version is 8.0 to use latest version of Firebase API httpv1)',"push-notification-for-post-and-buddypress")); ?></p>
<p><?php echo wp_kses_post( __('(It requires service account json file to be uploaded)',"push-notification-for-post-and-buddypress")); ?></p>
<p><?php echo wp_kses_post( __('(In the Firebase console, open Settings > Service Accounts.Click Generate New Private Key, then confirm by clicking Generate Key.Download & store the JSON file containing the key. Select service account json file in below field , Plugin will read and update required data in database for push notification. Physical file will not be stored.)',"push-notification-for-post-and-buddypress")); ?></p>	
<h2 class="pnfpb_ic_push_settings_header2"><?php echo wp_kses_post( __("Upload Service account json file for latest version of Firebase API httpv1","push-notification-for-post-and-buddypress"));?></h2>
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
										<?php echo wp_kses_post( __("Firebase api httpv1","push-notification-for-post-and-buddypress"));?>
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
								<?php if ($pnfpb_sa) { echo "<div class='pnfpb_icfcm_service_account_upload_message'><b>".wp_kses_data( __("Service account file already uploaded. If you want to update it, select new file","push-notification-for-post-and-buddypress"))."</b></div>"; } else { echo "<div class='pnfpb_icfcm_service_account_upload_message'><b>".wp_kses_data( __("Service account data not available. Upload now","push-notification-for-post-and-buddypress"))."</b></div>";} ?>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<h2 class="pnfpb_ic_push_settings_header2"><?php echo wp_kses_post( __("Use Firebase (or) Onesignal (or) Progressier (and / or) webtoapp.design as push notification provider","push-notification-for-post-and-buddypress"));?></h2>
<p><?php echo wp_kses_post( __("<b>webtoapp.design</b> push notification is for Android/IOS mobile app, if webtoapp.design push notifications is enabled then it will also work along with Firebase/Onesignal notifications by enabling Firebase/Onesignal along with webtoapp.design to send notifications to desktop also to mobile app generated from webtoapp.design","push-notification-for-post-and-buddypress"))." <a href='https://webtoapp.design/' target='_blank'>https://webtoapp.design/</a> ";?></p>
<div class="pnfpb_column_full">
	<button type="button" class="pnfpb_ic_firebase_configuration_help_button" onclick="toggle_firebase_configuration_help()"><?php echo wp_kses_post( __("Tutorial on Firebase","push-notification-for-post-and-buddypress")); ?></button>
</div>
<div class="pnfpb_ic_firebase_configuration_help">
	<a href="https://www.youtube.com/watch?v=02oymYLt3qo" target="_blank"><?php echo wp_kses_post( __("Watch this tutorial on Firebase settings and configuration","push-notification-for-post-and-buddypress")); ?></a>
	<ul>
		<li><?php echo wp_kses_post( __("Sign in to Firebase, then open your project, click settings icon & select Project settings","push-notification-for-post-and-buddypress")); ?></li>

		<li><?php echo wp_kses_post( __("To get Firebase server key (for field 1 in admin firebase settings)","push-notification-for-post-and-buddypress")); ?></li>
		<li><?php echo wp_kses_post( __("project settings > cloud messaging tab > get server key or add server key button to get server key","push-notification-for-post-and-buddypress")); ?></li>

		<li><?php echo wp_kses_post( __("To get Firebase config fields (for fields 2 to 8 in admin firebase settings)","push-notification-for-post-and-buddypress")); ?></li>
		<li><?php echo wp_kses_post( __("If you do not have web app, Create a new web app. After creating a new app, it will show firebase config fields","push-notification-for-post-and-buddypress")); ?></li>
		<li><?php echo wp_kses_post( __("Project settings > General under your apps section > click on config button to view configuration fields","push-notification-for-post-and-buddypress")); ?></li> 

		<li><?php echo wp_kses_post( __("To get Firebase public key (for field 9 in admin firebase settings)","push-notification-for-post-and-buddypress")); ?></li>
		<li><?php echo wp_kses_post( __("Open the Cloud Messaging tab of the Firebase console Settings pane and scroll to the Web configuration section","push-notification-for-post-and-buddypress")); ?></li>
		<li><?php echo wp_kses_post( __("project settings > cloud messaging tab > Under web push certificates > Generate key pair to get public key","push-notification-for-post-and-buddypress")); ?></li>
		<li><?php echo wp_kses_post( __("In the Web Push certificates tab, click Generate Key Pair. The console displays a notice that the key pair was generated, and displays the public key string and date added","push-notification-for-post-and-buddypress")); ?></li>
		<li><?php echo wp_kses_post( __("If you already Generated key pair then no need to generate it again","push-notification-for-post-and-buddypress")); ?></li>
		<li><?php echo wp_kses_post( __("After saving below fields, you will get browser prompt asking to allow notification for this website, click on allow notification","push-notification-for-post-and-buddypress")); ?></li>
		<li><?php echo wp_kses_post( __("After completing above steps, push notification will work based on option selected for posts/buddypress","push-notification-for-post-and-buddypress")); ?></li>
	</ul>
</div>
		<div class="pnfpb_column_full">
			<button type="button" class="pnfpb_ic_firebase_configuration_button" onclick="toggle_firebase_configuration()"><?php echo wp_kses_post( __("Firebase configuration","push-notification-for-post-and-buddypress")); ?></button>
			<button type="button" class="pnfpb_ic_or_button"><?php echo wp_kses_post( __(" (or) ","push-notification-for-post-and-buddypress")); ?></button>
			<button type="button" class="pnfpb_ic_onesignal_configuration_button" onclick="toggle_onesignal_configuration()"><?php echo wp_kses_post( __("Onesignal configuration","push-notification-for-post-and-buddypress")); ?></button>
			<button type="button" class="pnfpb_ic_or_button"><?php echo wp_kses_post( __(" (or) ","push-notification-for-post-and-buddypress")); ?></button>
			<button type="button" class="pnfpb_ic_progressier_configuration_button" onclick="toggle_progressier_configuration()"><?php echo wp_kses_post( __("Progressier configuration","push-notification-for-post-and-buddypress")); ?></button>
			<button type="button" class="pnfpb_ic_or_button"><?php echo wp_kses_post( __(" (and / or) ","push-notification-for-post-and-buddypress")); ?></button>
			<button type="button" class="pnfpb_ic_webtoapp_configuration_button" onclick="toggle_webtoapp_configuration()"><?php echo wp_kses_post( __("Webtoapp.design configuration","push-notification-for-post-and-buddypress")); ?></button>
		</div>
		<div class="pnfpb_ic_firebase_configuration">
			<p>
				<?php echo wp_kses_post( __("If Firebase is used for push notification then for Firebase configuration, <b>all fields are required except database url. Please follow above tutorial for configuration</b>","push-notification-for-post-and-buddypress")); ?>
			</p>			
			<table class="pnfpb_ic_push_firebase_settings_table widefat fixed">
    			<tbody>
    				<tr  class="pnfpb_ic_push_settings_table_row">
        				<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_api"><?php echo wp_kses_post( __("Firebase API Key","push-notification-for-post-and-buddypress"));?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_api" name="pnfpb_ic_fcm_api" type="text" value="<?php echo wp_kses_data(get_option( 'pnfpb_ic_fcm_api' )); ?>" /></td>
					</tr>
	   				<tr class="pnfpb_ic_push_settings_table_row">
        				<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_authdomain"><?php echo wp_kses_post( __("Firebase Auth domain","push-notification-for-post-and-buddypress"));?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_authdomain" name="pnfpb_ic_fcm_authdomain" type="text" value="<?php echo wp_kses_data(get_option( 'pnfpb_ic_fcm_authdomain' )); ?>" /> </td>
    				</tr>
		
	   				<tr class="pnfpb_ic_push_settings_table_row">
        				<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_databaseurl"><?php echo wp_kses_post( __("Firebase Database url (optional)","push-notification-for-post-and-buddypress"));?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_databaseurl" name="pnfpb_ic_fcm_databaseurl" type="text" value="<?php echo wp_kses_data(get_option( 'pnfpb_ic_fcm_databaseurl' )); ?>" /></td>
    				</tr>
		
	   				<tr class="pnfpb_ic_push_settings_table_row">
        				<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_projectid"><?php echo wp_kses_post( __("Firebase Project id","push-notification-for-post-and-buddypress"));?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_projectid" name="pnfpb_ic_fcm_projectid" type="text" value="<?php echo wp_kses_data(get_option( 'pnfpb_ic_fcm_projectid' )); ?>" /></td>
    				</tr>

					<tr class="pnfpb_ic_push_settings_table_row">
        				<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_storagebucket"><?php echo wp_kses_post( __("Firebase Storage Bucket","push-notification-for-post-and-buddypress"));?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_storagebucket" name="pnfpb_ic_fcm_storagebucket" type="text" value="<?php echo wp_kses_data(get_option( 'pnfpb_ic_fcm_storagebucket' )); ?>" /></td>
   	 				</tr>
		
					<tr class="pnfpb_ic_push_settings_table_row">
        				<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_messagingsenderid"><?php echo wp_kses_post( __("Firebase Messaging Sender id","push-notification-for-post-and-buddypress"));?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_messagingsenderid" name="pnfpb_ic_fcm_messagingsenderid" type="text" value="<?php echo wp_kses_data(get_option( 'pnfpb_ic_fcm_messagingsenderid' )); ?>" /></td>
    				</tr>

					<tr class="pnfpb_ic_push_settings_table_row">
        				<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_appid"><?php echo wp_kses_post( __("Firebase App id","push-notification-for-post-and-buddypress"));?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"   id="pnfpb_ic_fcm_appid" name="pnfpb_ic_fcm_appid" type="text" value="<?php echo wp_kses_data(get_option( 'pnfpb_ic_fcm_appid' )); ?>" /> </td>
    				</tr>
					<tr class="pnfpb_ic_push_settings_table_row">
        				<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_publickey"><?php echo wp_kses_post( __("Firebase Web Push certificate (from cloudmessaging tab in Firebase console)","push-notification-for-post-and-buddypress"));?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_publickey" name="pnfpb_ic_fcm_publickey" type="text" value="<?php echo wp_kses_data(get_option( 'pnfpb_ic_fcm_publickey' )); ?>" /></td>
    				</tr>
    				<tr class="pnfpb_ic_push_settings_table_row">
        				<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_upload_icon"><?php echo wp_kses_post( __("FCM Push Icon(16x16 pixels)","push-notification-for-post-and-buddypress"));?></label><br/>          
						<table>
							<tr>
                				<td class="column-columnname">
                    				<input type="button" value="<?php echo wp_kses_post( __("Upload Icon","push-notification-for-post-and-buddypress"));?>" id="pnfpb_ic_fcm_upload_button" class="pnfpb_ic_push_settings_upload_icon" />
                    				<input type="hidden" id="pnfpb_ic_fcm_upload_icon" name="pnfpb_ic_fcm_upload_icon" value="<?php echo esc_url(get_option( 'pnfpb_ic_fcm_upload_icon' )); ?>" />
                				</td>
            				</tr>
							<tr>
                				<td class="column-columnname">
                    				<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        				<div id="pnfpb_ic_fcm_upload_preview" style="background-image: url(<?php echo esc_url(get_option('pnfpb_ic_fcm_upload_icon')); ?>);width:32px; height:32px;overflow:hidden;border-radius:50%;margin:20px auto;background-position:center center;background-repeat:no-repeat;background-size:cover;"></div>
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
			<?php echo wp_kses_post( __("Onesignal push notification configuration","push-notification-for-post-and-buddypress"));?>	
		</h3>
		<p>
			<?php echo wp_kses_post( __("If Onesignal is enabled then, <b>it requires onesignal wordpress plugin installed and activated with required configuration</b>","push-notification-for-post-and-buddypress")); ?>
		</p>		
		<p>
			<?php echo wp_kses_post( __("(Either Firebase or Onesignal or Progressier can be used as push notification provider. If onesignal is enabled then Firebase & Progressier will be disabled.<br/>It requires onesignal WordPress plugin installed with required configuration )","push-notification-for-post-and-buddypress"));?>
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
											<?php echo wp_kses_post( __("Use ONESIGNAL to send PUSH notification instead of FIREBASE","push-notification-for-post-and-buddypress"));?>
									</label>
								</div>
								<div>
									<?php echo wp_kses_post( __("If enabled, it will use onesignal to send push notification provided ONESIGNAL Push notification installed and activated in your site. It will take onesignal credentials entered in ONESIGNAL push notification plugin","push-notification-for-post-and-buddypress"));?>								
								</div>						
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="pnfpb_ic_progressier_configuration">
		<h3>
			<?php echo wp_kses_post( __("Progressier push notification configuration","push-notification-for-post-and-buddypress"));?>	
		</h3>
		<p>
			<?php echo wp_kses_post( __("If Progressier is enabled then, <b>it requires Progressier api key from your Progressier account</b>","push-notification-for-post-and-buddypress")); ?>
		</p>		
		<p>
			<?php echo wp_kses_post( __("(Either Firebase or Onesignal or Progressier can be used as push notification provider. If Progressier is enabled then Firebase & Onesignal will be disabled)","push-notification-for-post-and-buddypress"));?>
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
											<input  id="pnfpb_progressier_push" name="pnfpb_progressier_push" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_progressier_push' ) ); ?>  />
											<span class="pnfpb_slider round"></span>
										</label>
											<?php echo wp_kses_post( __("Use Progressier to send PUSH notification instead of FIREBASE","push-notification-for-post-and-buddypress"));?>
									</label>
								</div>
								<div>
									<?php echo wp_kses_post( __("If enabled, it will use Progressier to send push notification. Progressier notification has limited features","push-notification-for-post-and-buddypress"));?>
									<br />
									<?php echo wp_kses_post( __("Post, Custom post types, BuddyPress Activities, Group activities, Private message, Friendship request/accept and Front end BuddyPress notification settings are available for Progressier push notification","push-notification-for-post-and-buddypress"));?>
									<br />
								</div>						
							</div>
						</div>
					</td>
				</tr>
				<tr class="pnfpb_ic_push_settings_table_row">
        			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
						<label for="pnfpb_ic_fcm_progressier_api_key"><?php echo wp_kses_post( __("Progressier API key","push-notification-for-post-and-buddypress"));?></label>
						<br/>
						<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_progressier_api_key" name="pnfpb_ic_fcm_progressier_api_key" type="text" value="<?php echo wp_kses_data(get_option( 'pnfpb_ic_fcm_progressier_api_key' )); ?>" />
					</td>
    			</tr>
				<tr class="pnfpb_ic_push_settings_table_row">
					<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
						<div class="pnfpb_column_full">
							<?php echo wp_kses_post( __("Custom bell prompt, renotify, replace notification and notification only for logged in users options are not available for Progressier","push-notification-for-post-and-buddypress"));?>
							<br />
							<?php echo wp_kses_post( __("New member joined, Group details update, Group invitation, Avatar change, Cover image change notification are not available for Progressier","push-notification-for-post-and-buddypress"));?>	
						</div>					
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="pnfpb_ic_webtoapp_configuration">
		<h3>
			<?php echo wp_kses_post( __("Webtoapp.design push notification configuration","push-notification-for-post-and-buddypress"));?>	
		</h3>
		<p>
			<?php echo wp_kses_post( __("If Webtoapp.design is enabled then, <b>it requires webtoapp api key from your webtoapp.design account</b>","push-notification-for-post-and-buddypress")); ?>
		</p>
		<p>
			<?php echo wp_kses_post( __("Get webtoapp.design API key here","push-notification-for-post-and-buddypress"))." <a href='https://webtoapp.design/' target='_blank'>https://webtoapp.design/</a> "; ?>
		</p>
		<p><?php echo wp_kses_post( __("<b>webtoapp.design</b> push notification is for Android/IOS mobile app, if webtoapp.design push notifications is enabled then it will also work along with Firebase/Onesignal notifications by enabling Firebase/Onesignal along with webtoapp.design to send notifications to desktop also to mobile app generated from webtoapp.design","push-notification-for-post-and-buddypress"))." <a href='https://webtoapp.design/' target='_blank'>https://webtoapp.design/</a> ";?></p>		
		<table class="pnfpb_ic_push_notification_settings_table widefat fixed" cellspacing="0">
    		<tbody>
				<tr class="pnfpb_ic_push_settings_table_row">
            		<td class="pnfpb_ic_push_settings_table_column column-columnname">
						<div class="pnfpb_row">
							<div class="pnfpb_column_400">
								<div class="pnfpb_card">
									<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_onesignal_push">
										<label class="pnfpb_switch">
											<input  id="pnfpb_webtoapp_push" name="pnfpb_webtoapp_push" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_webtoapp_push' ) ); ?>  />
											<span class="pnfpb_slider round"></span>
										</label>
											<?php echo wp_kses_post( __("Use Webtoapp.design to send PUSH notification","push-notification-for-post-and-buddypress"));?>
									</label>
								</div>
								<div>
									<?php echo wp_kses_post( __("If enabled, it will use Webtoapp.design to send push notification","push-notification-for-post-and-buddypress"));?>
									<br />
									<?php echo wp_kses_post( __("Post, Custom post types, BuddyPress Activities, Group activities, Private message, Friendship request/accept and Front end BuddyPress notification settings are available for Webtoapp.design push notification","push-notification-for-post-and-buddypress"));?>
									<br />
								</div>						
							</div>
						</div>
					</td>
				</tr>
				<tr class="pnfpb_ic_push_settings_table_row">
        			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
						<label for="pnfpb_ic_fcm_webtoapp_api_key"><?php echo wp_kses_post( __("Webtoapp.design API key","push-notification-for-post-and-buddypress"));?></label>
						<br/>
						<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_webtoapp_api_key" name="pnfpb_ic_fcm_webtoapp_api_key" type="text" value="<?php echo wp_kses_data(get_option( 'pnfpb_ic_fcm_webtoapp_api_key' )); ?>" />
					</td>
    			</tr>
				<tr class="pnfpb_ic_push_settings_table_row">
					<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
						<div class="pnfpb_column_full">
							<?php echo wp_kses_post( __("Custom bell prompt, renotify, replace notification and notification only for logged in users options are not available for webtoapp","push-notification-for-post-and-buddypress"));?>
							<br />
							<?php echo wp_kses_post( __("New member joined, Group details update, Group invitation, Avatar change, Cover image change notification are not available for webtoapp","push-notification-for-post-and-buddypress"));?>	
						</div>					
					</td>
				</tr>
			</tbody>
		</table>
	</div>		
 <div class="pnfpb_column_full"><?php submit_button(__('Save changes',"push-notification-for-post-and-buddypress"),'pnfpb_ic_push_save_configuration_button'); ?></div>
</form>

<?php if(get_option('pnfpb_ic_fcm_api')){ ?>
<div>
    <h3><?php echo wp_kses_post( __("Test Notification","push-notification-for-post-and-buddypress"));?></h3>
    <p><?php echo wp_kses_post( __("Click below link to send test notification to your subscribed device. Please make sure you already subscribed to notification for this website from browser","push-notification-for-post-and-buddypress"));?></p>
    <a href="<?php echo esc_url(admin_url('admin.php')); ?>?page=pnfpb_icfmtest_notification"><?php echo wp_kses_post( __("Test Notification","push-notification-for-post-and-buddypress"));?></a>
</div>

<?php
}
?>
</div>
<div id="pnfpb-admin-right_sidebar" class="pnfpb_column_left_300 pnfpb-admin-right_sidebar" >
	<h4><?php echo wp_kses_post( __("Need Help?","push-notification-for-post-and-buddypress"));?></h4>
	<ol>
	<li><?php echo wp_kses_post( __("Check out the","push-notification-for-post-and-buddypress"));?><a href="https://wordpress.org/support/plugin/push-notification-for-post-and-buddypress/"><?php echo wp_kses_post( __("support forum","push-notification-for-post-and-buddypress"));?></a> <?php echo wp_kses_post( __("and","push-notification-for-post-and-buddypress"));?> <a href="https://wordpress.org/plugins/push-notification-for-post-and-buddypress/#do%20you%20have%20any%20questions%3F"><?php echo wp_kses_post( __("FAQ","push-notification-for-post-and-buddypress"));?></a>.</li>
	<li><a href="https://github.com/muraliwebworld?tab=repositories" target="_blank"><?php echo wp_kses_post( __("Github repository sample code To Integrate mobile app with this plugin using API","push-notification-for-post-and-buddypress"));?></a></li>
	<li><?php echo wp_kses_post( __("Visit ","push-notification-for-post-and-buddypress"));?><a href="https://wordpress.org/plugins/push-notification-for-post-and-buddypress/"><?php echo wp_kses_post( __("plugin homepage","push-notification-for-post-and-buddypress"));?></a>.</li>
	<li><?php echo wp_kses_post( __("If you need help, Please feel free to send us your queries","push-notification-for-post-and-buddypress"));?><code>murali@indiacitys.com</code></li>
	</ol>
	<h4><?php echo wp_kses_post( __("Rate This Plugin","push-notification-for-post-and-buddypress"));?></h4>
	<p><?php echo wp_kses_post( __("Please","push-notification-for-post-and-buddypress"));?> <a href="https://wordpress.org/support/plugin/push-notification-for-post-and-buddypress/reviews/#new-post"><?php echo wp_kses_post( __("give your rating","push-notification-for-post-and-buddypress"));?></a><?php echo wp_kses_post( __(" and feedback.","push-notification-for-post-and-buddypress"));?></p>
	<h4><?php echo wp_kses_post( __("Contribute/Donate","push-notification-for-post-and-buddypress"));?></h4>
	<p><a href="https://www.muraliwebworld.com/support-to-push-notification-plugin-for-buddypress-and-for-post/"><?php echo wp_kses_post( __("Donate/Contribute to this plugin","push-notification-for-post-and-buddypress"));?></a></p>
	<h4><?php echo wp_kses_post( __("Mobile app integration help on github respository","push-notification-for-post-and-buddypress"));?></h4>
	<ol>
	<li><a href="https://github.com/muraliwebworld/android-app-to-integrate-push-notification-wordpress-plugin" target="_blank"><?php echo wp_kses_post( __("Procedure/Sample code to Integrate Android mobile app with this plugin using API","push-notification-for-post-and-buddypress"));?></a></li>
	<li><a href="https://github.com/muraliwebworld/ios-swift-app-to-integrate-push-notification-wordpress-plugin" target="_blank"><?php echo wp_kses_post( __("Procedure/Sample code to Integrate IOS mobile app with this plugin using API","push-notification-for-post-and-buddypress"));?></a></li>
	</ol>
	<h4><?php echo wp_kses_post( __("Demo site using WordPress Playground to test this plugin","push-notification-for-post-and-buddypress"));?></h4>
	<ol>
	<li><a href="https://www.muraliwebworld.com" target="_blank"><?php echo wp_kses_post( __("Plugin support forum","push-notification-for-post-and-buddypress"));?></a></li>
	</ol>
</div>