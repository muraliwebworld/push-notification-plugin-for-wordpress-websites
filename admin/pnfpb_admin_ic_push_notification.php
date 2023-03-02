<?php
/**
* Plugin settings area to store FireBase configuration, API key, server key
* Custom title for BuddyPress activity related push notification
*
* @since 1.0.0
*/
?>

<h2 class="nav-tab-wrapper"><a href="options-general.php?page=pnfpb-icfcm-slug" class="nav-tab nav-tab-active"><?php echo __("Push notification",PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_device_tokens_list" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_DEVICE_TOKENS_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_pwa_app_settings" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_PWA_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfmtest_notification" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_ONDEMANDPUSH_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_frontend_settings" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_FRONTEND_SETTINGS_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_button_settings" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_BUTTON_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_integrate_app" class="nav-tab"><?php echo __(PNFPB_PLUGIN_API_MOBILE_APP_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_settings_for_ngnix_server" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NGINX_HEADER,PNFPB_TD);?></a><a href="options-general.php?page=pnfpb_icfm_action_scheduler" class="nav-tab"><?php echo __(PNFPB_PLUGIN_SCHEDULE_ACTIONS,PNFPB_TD);?></a></h2>

<div class="pnfpb_column_left_900">
<h1 class="pnfpb_ic_push_settings_header"><?php echo __(PNFPB_PLUGIN_NM_SETTINGS,PNFPB_TD);?></h1>

<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
    <?php settings_fields( 'pnfpb_icfcm_group'); ?>
    <?php do_settings_sections( 'pnfpb_icfcm_group' ); ?>
    
<?php

	$args = array(
  		'public'   => true,
  		'_builtin' => false
	); 
	
	$output = 'names'; // or objects
	$operator = 'and'; // 'and' or 'or'
	$custposttypes = get_post_types( $args, $output, $operator );
    
    $blog_title = get_bloginfo( 'name' );
        
    if (get_option( 'pnfpb_ic_fcm_activity_title' ) ==  false || get_option( 'pnfpb_ic_fcm_activity_title' ) ==  '') {
            
            $activitytitle = 'New activity post in '.$blog_title;
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
            
            $activitygroup = 'New group post in '.$blog_title;
    }
    else
    {
            $activitygroup = get_option( 'pnfpb_ic_fcm_group_activity_title' );
    }        
        
    if (get_option( 'pnfpb_ic_fcm_comment_activity_title' ) ==  false || get_option( 'pnfpb_ic_fcm_comment_activity_title' ) ==  '') {
            
            $activitycomment = 'New comment posted for activity in '.$blog_title;
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

?>
<h2 class="pnfpb_ic_push_settings_header2"><?php echo __(PNFPB_PLUGIN_ENABLE_PUSH,PNFPB_TD);?></h2>
<p><?php echo __(PNFPB_PLUGIN_SCHEDULE_PUSH,PNFPB_TD);?></p>
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
							<?php echo __("Custom prompt is needed for Firefox android",PNFPB_TD);?>								
						</div>						
					</div>
				</div>
				<div class="pnfpb_ic_push_prompt_form pnfpb_column_400">
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_push_prompt_text"><?php echo __("Custom text to subscribe push notification in custom prompt",'PNFPB_TD');?></label><br/>
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_push_prompt_text" name="pnfpb_ic_fcm_push_prompt_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_push_prompt_text' )) {echo get_option( 'pnfpb_ic_fcm_push_prompt_text' );} else { echo __("Subscribe our push notification",'PNFPB_TD');} ?>"  />					
					<br/><br /><p><?php echo __("Push subscription confirmation button text",'PNFPB_TD');?></p>	
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_push_prompt_confirm_button" name="pnfpb_ic_fcm_push_prompt_confirm_button" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_push_prompt_confirm_button' )) {echo get_option( 'pnfpb_ic_fcm_push_prompt_confirm_button' );} else { echo __("Yes",'PNFPB_TD');} ?>"  />
					<br/><br /><p><?php echo __("Push subscription cancel button text",'PNFPB_TD');?></p>	
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_push_prompt_cancel_button" name="pnfpb_ic_fcm_push_prompt_cancel_button" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_push_prompt_cancel_button' )) {echo get_option( 'pnfpb_ic_fcm_push_prompt_cancel_button' );} else { echo __("No",'PNFPB_TD');} ?>"  />
					<br /><br/><p><?php echo __("Button background color",'PNFPB_TD');?></p>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_prompt_button_background" id="pnfpb_ic_fcm_push_prompt_button_background" name="pnfpb_ic_fcm_push_prompt_button_background" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_push_prompt_button_background' )) {echo get_option( 'pnfpb_ic_fcm_push_prompt_button_background' ); } else { echo '#121240';}?>" required="required" />					
					<br /><br/><p><?php echo __("Dialog box background color",'PNFPB_TD');?></p>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_prompt_dialog_background" id="pnfpb_ic_fcm_push_prompt_dialog_background" name="pnfpb_ic_fcm_push_prompt_dialog_background" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_push_prompt_dialog_background' )) {echo get_option( 'pnfpb_ic_fcm_push_prompt_dialog_background' ); } else { echo '#DAD7D7';}?>" required="required" />					
					<br /><br/><p><?php echo __("Dialog Text color",'PNFPB_TD');?></p>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_prompt_text_color" id="pnfpb_ic_fcm_push_prompt_text_color" name="pnfpb_ic_fcm_push_prompt_text_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_push_prompt_text_color' )) {echo get_option( 'pnfpb_ic_fcm_push_prompt_text_color' ); } else { echo '#161515';}?>" required="required" />
					<br /><br/><p><?php echo __("Button Text color",'PNFPB_TD');?></p>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_prompt_button_text_color" id="pnfpb_ic_fcm_push_prompt_button_text_color" name="pnfpb_ic_fcm_push_prompt_button_text_color" type="color" value="<?php if (get_option( 'pnfpb_ic_fcm_push_prompt_button_text_color' )) {echo get_option( 'pnfpb_ic_fcm_push_prompt_button_text_color' ); } else { echo '#ffffff';}?>" required="required" />
					<br /><br/><p><?php echo __("Dialog box position",'PNFPB_TD');?></p>
					<select name="pnfpb_ic_fcm_push_prompt_position" id="pnfpb_ic_fcm_push_prompt_position" required="required">
						<option value="pnfpb-top-left" <?php if (get_option( 'pnfpb_ic_fcm_push_prompt_position' ) === 'pnfpb-top-left'){ echo 'selected';} else {echo '';} ?>><?php echo __("Top left",'PNFPB_TD');?></option>
						<option value="pnfpb-top-right" <?php if (get_option( 'pnfpb_ic_fcm_push_prompt_position' ) === 'pnfpb-top-right'){ echo 'selected';} else {echo '';} ?>><?php echo __("Top right",'PNFPB_TD');?></option>
						<option value="pnfpb-bottom-left" <?php if (get_option( 'pnfpb_ic_fcm_push_prompt_position' ) === 'pnfpb-bottom-left'){ echo 'selected';} else {echo '';} ?>><?php echo __("Bottom left",'PNFPB_TD');?></option>
						<option value="pnfpb-bottom-right" <?php if (get_option( 'pnfpb_ic_fcm_push_prompt_position' ) === 'pnfpb-bottom-right'){ echo 'selected';} else {echo '';} ?>><?php echo __("Bottom right",'PNFPB_TD');?></option>
					</select>					
				</div>				
			</td>
		</tr>
        <tr class="pnfpb_ic_push_settings_table_row">
			<td class="pnfpb_ic_push_settings_table_column column-columnname">
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
					$cutomize_post_field_notification_title = '<div class="pnfpb_ic_post_type_content_form">'.__('<br/>(use [member name] shortcode to display member name)<br/>if following custom title are blank then post title/custom post type title will be in push notification title<br/>Example "[member name] published a post" will display as "Tom published a post" where Tom is member name<br/>',PNFPB_TD).'<div class="pnfpb_ic_post_content_form"><b>'.__("Notification title for Post",PNFPB_TD).'</b><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_post_title" name="pnfpb_ic_fcm_post_title" type="text" value="'.get_option('pnfpb_ic_fcm_post_title').'" /></div><br/>';
					
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
				$cutomize_post_field_notification_title .= '</div>';
        		?>
				</div>
				<div class="pnfpb_row">
  					<div class="pnfpb_column_400">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_post_schedule_enable">
								<?php echo __("Schedule",'PNFPB_TD');?>
							</label>
							<label class="pnfpb_switch">
								<input  id="pnfpb_ic_fcm_post_schedule_enable" name="pnfpb_ic_fcm_post_schedule_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_post_schedule_enable' ) ); ?>  />
								<span class="pnfpb_slider round"></span>
							</label>
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_post_schedule_background_enable">
								<?php echo __("in background",'PNFPB_TD');?>
							</label>
							<label class="pnfpb_switch">
								<input  id="pnfpb_ic_fcm_post_schedule_background_enable" name="pnfpb_ic_fcm_post_schedule_background_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_post_schedule_background_enable' ) ); ?>  />
								<span class="pnfpb_slider round"></span>
							</label>
						</div>
					</div>
  					<div class="pnfpb_column_400">
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
					<button type="button" class="pnfpb_post_type_content_button" onclick="toggle_post_type_content_form()"><?php echo __("Customize",PNFPB_TD); ?></button>
				</div>
				<?php echo $cutomize_post_field_notification_title; ?>
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
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container  pnfpb_padding_top_8">
								<input  id="pnfpb_ic_fcm_buddypress_group_enable" name="pnfpb_ic_fcm_buddypress_enable" type="radio" value="2" <?php checked( '2', get_option( 'pnfpb_ic_fcm_buddypress_enable' ) ); ?>  />
								<span class="pnfpb_checkmark  pnfpb_margin_top_6"></span>
								<?php echo __("Group activity (only for group members)",'PNFPB_TD');?>
							</label>
							<button type="button" class="pnfpb_activity_form_button" onclick="toggle_activity_content_form()"><?php echo __("Customize",PNFPB_TD); ?></button>
						</div>
					</div>
				</div>
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypressactivities_schedule_enable">
								<?php echo __("Schedule",'PNFPB_TD');?>
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_fcm_buddypressactivities_schedule_enable" name="pnfpb_ic_fcm_buddypressactivities_schedule_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_buddypressactivities_schedule_enable' ) ); ?>  />				
									<span class="pnfpb_slider round"></span>
								</label>
							</label>
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypressactivities_schedule_background_enable">
								<?php echo __("in background",'PNFPB_TD');?>
							</label>
							<label class="pnfpb_switch">
								<input  id="pnfpb_ic_fcm_buddypressactivities_schedule_background_enable" name="pnfpb_ic_fcm_buddypressactivities_schedule_background_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_buddypressactivities_schedule_background_enable' ) ); ?>  />
								<span class="pnfpb_slider round"></span>
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
				<div class="pnfpb_ic_activity_content_form">
					<?php echo __("Notification title for BuddyPress new activity<br/>use [member name] shortcode to display member name along with custom title<br/>Example '[member name] posted an activity' will display as 'Tom posted an activity' where Tom is member name",PNFPB_TD);?><br/>
        			<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_activity_title" name="pnfpb_ic_fcm_activity_title" type="text" value="<?php echo $activitytitle; ?>" /><br/><br/>
					<?php echo __("Default Notification content for BuddyPress new activity<br/> (or leave it as blank to display activity content in notification message)",PNFPB_TD); ?><br/>
        			<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_activity_message" name="pnfpb_ic_fcm_activity_message" type="text" value="<?php echo $activitymessage; ?>" /><br/><br/>					
					<?php echo __("Notification title for BuddyPress new group activity",PNFPB_TD);?><br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_group_activity_title" name="pnfpb_ic_fcm_group_activity_title" type="text" value="<?php echo $activitygroup; ?>"/><br/><br/>
					<?php echo __("Default Notification content for BuddyPress new group activity<br/> (or leave it as blank to display activity content in notification message)",PNFPB_TD);?><br/>
        			<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_group_activity_message" name="pnfpb_ic_fcm_group_activity_message" type="text" value="<?php echo $groupactivitymessage; ?>" /><br/><br/>
				</div>
			</td>
        </tr>
		<tr class="pnfpb_ic_push_settings_table_row">
            <td class="pnfpb_ic_push_settings_table_column column-columnname">
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_buddypress_bcomment_enable">
								<?php echo __("New comments in BuddyPress/Post types",'PNFPB_TD');?>
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_fcm_bcomment_enable" name="pnfpb_ic_fcm_bcomment_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_bcomment_enable' ) ); ?>  />
									<span class="pnfpb_slider round"></span>
								</label>
							</label>
							<button type="button" class="pnfpb_comments_content_button" onclick="toggle_comments_content_form()"><?php echo __("Customize",PNFPB_TD); ?></button>
						</div>
					</div>
				</div>
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
    					<div class="pnfpb_card">				
							<label class="pnfpb_ic_push_settings_table_label_checkbox">
								<?php echo __("Schedule",'PNFPB_TD');?>
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_fcm_buddypresscomments_schedule_enable" name="pnfpb_ic_fcm_buddypresscomments_schedule_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_buddypresscomments_schedule_enable' ) ); ?>  />				
									<span class="pnfpb_slider round"></span>
								</label>
							</label>
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypresscomments_schedule_background_enable">
								<?php echo __("in background",'PNFPB_TD');?>
							</label>
							<label class="pnfpb_switch">
								<input  id="pnfpb_ic_fcm_buddypresscomments_schedule_background_enable" name="pnfpb_ic_fcm_buddypresscomments_schedule_background_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_buddypresscomments_schedule_background_enable' ) ); ?>  />
								<span class="pnfpb_slider round"></span>
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
							<button type="button" class="pnfpb_private_message_button pnfpb_flex_grow_3" onclick="toggle_private_message_form()"><?php echo __("Customize",PNFPB_TD); ?></button>
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
							<button type="button" class="pnfpb_new_member_button pnfpb_flex_grow_3" onclick="toggle_new_member_form()"><?php echo __("Customize",PNFPB_TD); ?></button>	
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
							<button type="button" class="pnfpb_friendship_request_button pnfpb_flex_grow_3" onclick="toggle_friendship_request_form()"><?php echo __("Customize",PNFPB_TD); ?></button>
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
							<button type="button" class="pnfpb_friendship_accept_button pnfpb_flex_grow_3" onclick="toggle_friendship_accept_form()"><?php echo __("Customize",PNFPB_TD); ?></button>
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
							<button type="button" class="pnfpb_avatar_change_button pnfpb_flex_grow_3" onclick="toggle_avatar_change_form()"><?php echo __("Customize",PNFPB_TD); ?></button>
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
							<button type="button" class="pnfpb_cover_image_change_button pnfpb_flex_grow_3" onclick="toggle_cover_image_change_form()">Customize</button>
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
			</td>
		</tr>
    </tbody>
</table>
<h2 class="pnfpb_ic_push_settings_header2"><?php echo __(PNFPB_PLUGIN_FIREBASE_SETTINGS,PNFPB_TD);?></h2>
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
	<button type="button" class="pnfpb_ic_firebase_configuration_button" onclick="toggle_firebase_configuration()"><?php echo __("Hide Firebase configuration",PNFPB_TD); ?></button>
</div>
<div class="pnfpb_ic_firebase_configuration">
	<table class="pnfpb_ic_push_firebase_settings_table widefat fixed">
    	<tbody>
    		<tr  class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_google_api"><?php echo __("Firebase Server Key",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_google_api" name="pnfpb_ic_fcm_google_api" type="text" value="<?php echo get_option( 'pnfpb_ic_fcm_google_api' ); ?>" required="required" /></td>
    		</tr>
        
    		<tr  class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_api"><?php echo __("Firebase API Key",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_api" name="pnfpb_ic_fcm_api" type="text" value="<?php echo get_option( 'pnfpb_ic_fcm_api' ); ?>" required="required" /></td>
	   		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_authdomain"><?php echo __("Firebase Auth domain",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_authdomain" name="pnfpb_ic_fcm_authdomain" type="text" value="<?php echo get_option( 'pnfpb_ic_fcm_authdomain' ); ?>" required="required" /> </td>
    		</tr>
		
	   		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_databaseurl"><?php echo __("Firebase Database url (optional)",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_databaseurl" name="pnfpb_ic_fcm_databaseurl" type="text" value="<?php echo get_option( 'pnfpb_ic_fcm_databaseurl' ); ?>" /></td>
    		</tr>
		
	   		<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_projectid"><?php echo __("Firebase Project id",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_projectid" name="pnfpb_ic_fcm_projectid" type="text" value="<?php echo get_option( 'pnfpb_ic_fcm_projectid' ); ?>" required="required" /></td>
    		</tr>

			<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_storagebucket"><?php echo __("Firebase Storage Bucket",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_storagebucket" name="pnfpb_ic_fcm_storagebucket" type="text" value="<?php echo get_option( 'pnfpb_ic_fcm_storagebucket' ); ?>" required="required" /></td>
   	 		</tr>
		
			<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_messagingsenderid"><?php echo __("Firebase Messaging Sender id",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_messagingsenderid" name="pnfpb_ic_fcm_messagingsenderid" type="text" value="<?php echo get_option( 'pnfpb_ic_fcm_messagingsenderid' ); ?>" required="required" /></td>
    		</tr>

			<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_appid"><?php echo __("Firebase App id",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field"   id="pnfpb_ic_fcm_appid" name="pnfpb_ic_fcm_appid" type="text" value="<?php echo get_option( 'pnfpb_ic_fcm_appid' ); ?>" required="required" /> </td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_publickey"><?php echo __("Firebase Public key",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_publickey" name="pnfpb_ic_fcm_publickey" type="text" value="<?php echo get_option( 'pnfpb_ic_fcm_publickey' ); ?>" required="required" /></td>
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
	<li><?php echo __("Visit ",PNFPB_TD);?><a href="https://wordpress.org/plugins/push-notification-for-post-and-buddypress/"><?php echo __("plugin homepage",PNFPB_TD);?></a>.</li>
	<li><?php echo __("If you need help, Please feel free to send us your queries",PNFPB_TD);?><code>murali@indiacitys.com</code></li>
	</ol>
	<h4><?php echo __("Rate This Plugin",PNFPB_TD);?></h4>
	<p><?php echo __("Please",PNFPB_TD);?> <a href="https://wordpress.org/support/plugin/push-notification-for-post-and-buddypress/reviews/#new-post"><?php echo __("give your rating",PNFPB_TD);?></a><?php echo __(" and feedback.",PNFPB_TD);?></p>
</div>
