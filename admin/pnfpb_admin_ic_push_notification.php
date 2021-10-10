<?php
/**
* Plugin settings area to store FireBase configuration, API key, server key
* Custom title for BuddyPress activity related push notification
*
* @since 1.0.0
*/
?>

<h2 class="nav-tab-wrapper"><a href="options-general.php?page=pnfpb-icfcm-slug" class="nav-tab nav-tab-active">Push notification settings</a><a href="options-general.php?page=pnfpb_icfm_device_tokens_list" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_DEVICE_TOKENS_HEADER);?></a><a href="options-general.php?page=pnfpb_icfm_pwa_app_settings" class="nav-tab"><?php echo __(PNFPB_PLUGIN_NM_PWA_HEADER);?></a></h2>

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

?>
<h2 class="pnfpb_ic_push_settings_header2"><?php echo __(PNFPB_PLUGIN_ENABLE_PUSH,PNFPB_TD);?></h2>
<p><?php echo __(PNFPB_PLUGIN_SCHEDULE_PUSH,PNFPB_TD);?></p>
<table class="pnfpb_ic_push_settings_table widefat fixed" cellspacing="0">
    <tbody>
        <tr class="pnfpb_ic_push_settings_table_row">
			<td class="pnfpb_ic_push_settings_table_column column-columnname">
				<input id="pnfpb_ic_fcm_post_enable" name="pnfpb_ic_fcm_post_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_post_enable' ) ); ?>  /> 
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_post_enable"><?php echo __("Post",'PNFPB_TD');?></label>	
        		<?php
            		$posttypecount = 0;
            		$rowcount = 0;
           			 $totalposttype = count($custposttypes);
            		foreach ( $custposttypes as $post_type ) {
                		$labeltext = $post_type;
                
        		?>        
					<input id="pnfpb_ic_fcm_<?php echo $post_type; ?>_enable" name="pnfpb_ic_fcm_<?php echo $post_type; ?>_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_'.$post_type.'_enable' ) ); ?>  />        
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_<?php echo $labeltext; ?>_enable"><?php echo $labeltext; ?></label>
        		<?php                
                	$posttypecount++;
                	$rowcount++;
           	 	}
        		?>
				<br/><br/>
				<input  id="pnfpb_ic_fcm_post_schedule_enable" name="pnfpb_ic_fcm_post_schedule_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_post_schedule_enable' ) ); ?>  />				
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_post_schedule_enable"><?php echo __("Schedule",'PNFPB_TD');?>
				</label>
				<input  id="pnfpb_ic_fcm_post_hourly_enable" name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" value="hourly" <?php checked( 'hourly', get_option( 'pnfpb_ic_fcm_post_timeschedule_enable' ) ); ?>  />
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_post_timeschedule_enable"><?php echo __("Hourly",'PNFPB_TD');?>
				</label>
				<input  id="pnfpb_ic_fcm_post_twicedaily_enable" name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" value="twicedaily" <?php checked( 'twicedaily', get_option( 'pnfpb_ic_fcm_post_timeschedule_enable' ) ); ?>  />
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_post_timeschedule_enable"><?php echo __("Twicedaily",'PNFPB_TD');?>
				</label>
				<input  id="pnfpb_ic_fcm_post_daily_enable" name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" value="daily" <?php checked( 'daily', get_option( 'pnfpb_ic_fcm_post_timeschedule_enable' ) ); ?>  />
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_post_daily_enable"><?php echo __("Daily",'PNFPB_TD');?>
				</label>
				<input  id="pnfpb_ic_fcm_post_weekly_enable" name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" value="weekly" <?php checked( 'weekly', get_option( 'pnfpb_ic_fcm_post_timeschedule_enable' ) ); ?>  />
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_post_timeschedule_enable">
					<?php echo __("Weekly",'PNFPB_TD');?>
				</label>
			</td>			
		</tr>
		<tr class="pnfpb_ic_push_settings_table_row">
            <td class="pnfpb_ic_push_settings_table_column column-columnname">
				<input  id="pnfpb_ic_fcm_buddypress_enable" name="pnfpb_ic_fcm_buddypress_enable" type="radio" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_buddypress_enable' ) ); ?>  />
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_enable"><?php echo __("To all BuddyPress users (when new activity posted)",'PNFPB_TD');?>
				</label><br/><br/>
				<input  id="pnfpb_ic_fcm_buddypress_group_enable" name="pnfpb_ic_fcm_buddypress_enable" type="radio" value="2" <?php checked( '2', get_option( 'pnfpb_ic_fcm_buddypress_enable' ) ); ?>  />
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_group_enable"><?php echo __("To only BuddyPress group members (when subscribed new group activity posted)",'PNFPB_TD');?>
				</label>
				<br/><br/>
				<input  id="pnfpb_ic_fcm_buddypressactivities_schedule_enable" name="pnfpb_ic_fcm_buddypressactivities_schedule_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_buddypressactivities_schedule_enable' ) ); ?>  />				
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypressactivities_schedule_enable"><?php echo __("Schedule",'PNFPB_TD');?>
				</label>
				<input  id="pnfpb_ic_fcm_buddypressactivities_hourly_enable" name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable" type="radio" value="hourly" <?php checked( 'hourly', get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_enable' ) ); ?>  />
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"><?php echo __("Hourly",'PNFPB_TD');?>
				</label>
				<input  id="pnfpb_ic_fcm_buddypressactivities_twicedaily_enable" name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable" type="radio" value="twicedaily" <?php checked( 'twicedaily', get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_enable' ) ); ?>  />
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"><?php echo __("Twicedaily",'PNFPB_TD');?>
				</label>
				<input  id="pnfpb_ic_fcm_buddypressactivities_daily_enable" name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable" type="radio" value="daily" <?php checked( 'daily', get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_enable' ) ); ?>  />
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypressactivities_daily_enable"><?php echo __("Daily",'PNFPB_TD');?>
				</label>
				<input  id="pnfpb_ic_fcm_buddypressactivities_weekly_enable" name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable" type="radio" value="weekly" <?php checked( 'weekly', get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_enable' ) ); ?>  />
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"><?php echo __("Weekly",'PNFPB_TD');?>
				</label><br/><br/>
				<?php echo __("Notification title for BuddyPress new activity",PNFPB_TD);?><br/>
        		<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_activity_title" name="pnfpb_ic_fcm_activity_title" type="text" value="<?php echo $activitytitle; ?>" /><br/><br/>				
				<?php echo __("Notification title for BuddyPress new group activity",PNFPB_TD);?><br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_group_activity_title" name="pnfpb_ic_fcm_group_activity_title" type="text" value="<?php echo $activitygroup; ?>"/>
			</td>
        </tr>
		<tr class="pnfpb_ic_push_settings_table_row">
            <td class="pnfpb_ic_push_settings_table_column column-columnname">
				<input  id="pnfpb_ic_fcm_bcomment_enable" name="pnfpb_ic_fcm_bcomment_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_bcomment_enable' ) ); ?>  />				
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_bcomment_enable"><?php echo __("For comments in BuddyPress (when new comment posted for BuddyPress activities)",'PNFPB_TD');?>
				</label>
				<br/><br/>
				<input  id="pnfpb_ic_fcm_buddypresscomments_schedule_enable" name="pnfpb_ic_fcm_buddypresscomments_schedule_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_buddypresscomments_schedule_enable' ) ); ?>  />				
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypresscomments_schedule_enable"><?php echo __("Schedule",'PNFPB_TD');?>
				</label>
				<input  id="pnfpb_ic_fcm_buddypresscomments_hourly_enable" name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable" type="radio" value="hourly" <?php checked( 'hourly', get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_enable' ) ); ?>  />
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"><?php echo __("Hourly",'PNFPB_TD');?>
				</label>
				<input  id="pnfpb_ic_fcm_buddypresscomments_twicedaily_enable" name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable" type="radio" value="twicedaily" <?php checked( 'twicedaily', get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_enable' ) ); ?>  />
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"><?php echo __("Twicedaily",'PNFPB_TD');?>
				</label>
				<input  id="pnfpb_ic_fcm_buddypresscomments_daily_enable" name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable" type="radio" value="daily" <?php checked( 'daily', get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_enable' ) ); ?>  />
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"><?php echo __("Daily",'PNFPB_TD');?>
				</label>
				<input  id="pnfpb_ic_fcm_buddypresscomments_weekly_enable" name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable" type="radio" value="weekly" <?php checked( 'weekly', get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_enable' ) ); ?>  />
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"><?php echo __("Weekly",'PNFPB_TD');?>
				</label><br/><br/>
				<label for="pnfpb_ic_fcm_comment_activity_title"><?php echo __("Notification title for BuddyPress new comment",PNFPB_TD);?></label><br/>
        		<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_comment_activity_title" name="pnfpb_ic_fcm_comment_activity_title" type="text" value="<?php echo $activitycomment; ?>" />
			</td>
        </tr>
		
		<tr class="pnfpb_ic_push_settings_table_row">
			<td class="pnfpb_ic_push_settings_table_column column-columnname">
				<input  id="pnfpb_ic_fcm_bprivatemessage_enable" name="pnfpb_ic_fcm_bprivatemessage_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ic_fcm_bprivatemessage_enable' ) ); ?>  />				
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_bprivatemessage_enable"><?php echo __("Private messages notifications in BuddyPress",'PNFPB_TD');?>
				</label><br/><br/>
				<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_bprivatemessage_text_enable"><?php echo __("Private messages notifications text",'PNFPB_TD');?></label><br/>
				<input  class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_bprivatemessage_text" name="pnfpb_ic_fcm_bprivatemessage_text" type="text" value="<?php if(get_option( 'pnfpb_ic_fcm_bprivatemessage_text' )) {echo get_option( 'pnfpb_ic_fcm_bprivatemessage_text' );} else { echo '[sender name] sent you a private message';} ?>"  />
				<br/><p>[sender name] is the shortcode which replaces with sender name and modify remaining text according to your choice</p>
			</td>
		</tr>
    </tbody>
</table>
<h2 class="pnfpb_ic_push_settings_header2"><?php echo __(PNFPB_PLUGIN_FIREBASE_SETTINGS,PNFPB_TD);?></h2>
<ul>
<li>To get Firebase server key, select project settings from Firebase account, go to cloud messaging tab, get server key fill below first field</li>
<li>For remaining fields, you need to get it from your Firebase web app.</li>
<li>Sign in to Firebase, then open your project click settings icon & select Project settings</li>
<li>In the Your apps card, select the nickname of the web app for which you need a config object.</li>
<li>Select Config from the Firebase SDK snippet pane and fill below fields</li>
<li>After saving below fields, it will ask to allow notification for this website, click on allow notification</li>
<li>After completing above steps, push notification will work based on option selected for posts/buddypress</li>
</ul>
<table class="pnfpb_ic_push_settings_table widefat fixed">
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
        <td class="pnfpb_ic_push_settings_table_label_column column-columnname"><label for="pnfpb_ic_fcm_databaseurl"><?php echo __("Firebase Database url",PNFPB_TD);?></label><br/><input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_databaseurl" name="pnfpb_ic_fcm_databaseurl" type="text" value="<?php echo get_option( 'pnfpb_ic_fcm_databaseurl' ); ?>" required="required" /></td>
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
			<table><tr>
                <td class="column-columnname">
                    <input type="button" value="<?php echo __("Update Push Notification Icon",PNFPB_TD);?>" id="pnfpb_ic_fcm_upload_button" class="pnfpb_ic_push_settings_upload_icon" />
                    <input type="hidden" id="pnfpb_ic_fcm_upload_icon" name="pnfpb_ic_fcm_upload_icon" value="<?php echo get_option( 'pnfpb_ic_fcm_upload_icon' ); ?>" />
                </td>
            </tr><tr>
                <td class="column-columnname">
                    <div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        <div id="pnfpb_ic_fcm_upload_preview" style="background-image: url(<?php echo get_option('pnfpb_ic_fcm_upload_icon'); ?>);width:32px; height:32px;overflow:hidden;border-radius:50%;margin:20px auto;background-position:center center;background-repeat:no-repeat;background-size:cover;"></div>
                    </div>
                </td>
            </tr></table></td>
    </tr>
		
    <tr>
		<td class="column-columnname"> <div class="col-sm-10"><?php submit_button(); ?></div></td>

    </tr>

    </tbody>
    </table>

</form>

<?php if(get_option('pnfpb_ic_fcm_api')){ ?>
<div>
    <h3>Test Notification</h3>
    <p>Click below link to send test notification to your subscribed device. Please make sure you already subscribed to notification for this website from browser</p>
    <a href="<?php echo admin_url('admin.php'); ?>?page=pnfpb_icfmtest_notification">Test Notification</a>
</div>

<?php
}
?>
