<?php
/*
* Post and custom post type settings for push notification
* @Since 2.08
*/
?>
	<tr class="pnfpb_navy_blue_background_color pnfpb_white_text_color pnfpb_section_header_font_16px">
			<td class="pnfpb_ic_push_settings_table_column pnfpb_white_text_color pnfpb_section_header_font_16px">
				<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_white_text_color pnfpb_section_header_font_16px">
					<?php echo esc_html(
        				__(
            				"Post/Custom post types",
            				"push-notification-for-post-and-buddypress"
        				)
    				); ?>
				</label>
			</td>
		</tr>
        <tr class="pnfpb_ic_push_settings_table_row">
			<td class="pnfpb_ic_push_settings_table_column column-columnname">
				<div  class="pnfpb_row">
					<b>
						<?php echo esc_html(
         					__(
             					"While saving/updating post in admin area, make sure metabox for PNFPB Push notification is switched ON.",
             					"push-notification-for-post-and-buddypress"
         					)
     					); ?>
					</b>
				</div>
				<div class="pnfpb_row">
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">				
							<label class="pnfpb_ic_push_settings_table_label_checkbox" 
								   for="pnfpb_ic_fcm_post_enable">
											<?php echo esc_html(
           										__("Post", "push-notification-for-post-and-buddypress")
       										); ?>
							</label>						
							<label class="pnfpb_switch">
								<input id="pnfpb_ic_fcm_post_enable" name="pnfpb_ic_fcm_post_enable" 
									   type="checkbox" value="1" <?php checked(
            									"1",
            									get_option("pnfpb_ic_fcm_post_enable")
        								); ?>  
								/> 
								<span class="pnfpb_slider round"></span>
							</label>
						</div>
					</div>
        		<?php
          $posttypecount = 0;
          $rowcount = 0;
          $cutomize_post_field_notification_title =
              '<br/><br/>' .
              esc_html(	__(
                  '(use [member name] shortcode to display member name)<',
                  "push-notification-for-post-and-buddypress"
              )) .
			  '<br/>'.
              esc_html(	__(
                  'if following custom title are blank then post title/custom post type title will be in push notification title',
                  "push-notification-for-post-and-buddypress"
              )) .
			  '<br/>'.
              esc_html(	__(
                  'Example "[member name] published a post" will display as "Tom published a post" where Tom is member name',
                  "push-notification-for-post-and-buddypress"
              )).			  
              '<br/>
			  <div class="pnfpb_ic_post_content_form">
			  		<b>' .
              			esc_html(	__(
                  			"Notification title for Post",
                  			"push-notification-for-post-and-buddypress"
              			)) .
              		'</b>
			 		 <br/>
			  		<input class="pnfpb_ic_push_settings_table_value_column_input_field" 
						id="pnfpb_ic_fcm_post_title" name="pnfpb_ic_fcm_post_title" 
						type="text" value="' .
              			get_option("pnfpb_ic_fcm_post_title") .
              	'" />
			</div>
			<br/>';
		$totalposttype = count($custposttypes);
					
        foreach ($custposttypes as $post_type) {

              $labeltext = $post_type;
			  
              $cutomize_post_field_notification_title .=
                  '<div class="'.esc_attr("pnfpb_ic_".$post_type."_content_form").'">
				  	<b>' .
                  		esc_html( __(
                      		"Notification title for ",
                      		"push-notification-for-post-and-buddypress"
                  		)) .
                  		esc_html($post_type) .
                  	'</b>
				  	<br/>
				  	<input class="pnfpb_ic_push_settings_table_value_column_input_field" 
				  		id="'.esc_attr("pnfpb_ic_fcm_".$post_type."_title").'" name="'.esc_attr("pnfpb_ic_fcm_".$post_type."_title").'" 
						type="text" value="'.esc_attr(get_option("pnfpb_ic_fcm_" . $post_type . "_title")).'" />
				</div>
				<br/>';
            ?> 
			<?php
     			if ($post_type !== "buddypress") { ?>
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">				
							<label class="pnfpb_ic_push_settings_table_label_checkbox" 
								   for="<?php echo esc_attr("pnfpb_ic_fcm_".$labeltext."_enable"); ?>">
										<?php echo esc_html($labeltext); ?>
							</label>
							<label class="pnfpb_switch">	
								<input id="<?php echo esc_attr("pnfpb_ic_fcm_".$post_type."_enable"); ?>" 
									   name="<?php echo esc_attr("pnfpb_ic_fcm_".$post_type."_enable"); ?>" 
									   type="checkbox" value="1" <?php checked(
    										"1",
    										esc_attr(get_option("pnfpb_ic_fcm_" . $post_type . "_enable"))
										); ?>  
								/>
								<span class="pnfpb_slider round"></span>
							</label>
						</div>
					</div>
        		<?php }
     $posttypecount++;
     $rowcount++;
			if ($posttypecount >= 10) {
				
				break;
			}

          }
          ?>
					<div class="pnfpb_column">
						<button type="button" class="pnfpb_post_type_content_button" 
								onclick="toggle_post_type_content_form()">
									<?php echo esc_html(
          								__("Customize", "push-notification-for-post-and-buddypress")
      								); ?>
						</button>
					</div>
			</div>	
			<div class="pnfpb_row">
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">
							<?php
       							$pnfpb_ic_fcm_disable_post_update_enable = "0";
       							if (
           							get_option("pnfpb_ic_fcm_disable_post_update_enable") &&
           							get_option("pnfpb_ic_fcm_disable_post_update_enable") === "1"
       							) {
           							$pnfpb_ic_fcm_disable_post_update_enable = "1";
       							}
       						?>
							<label class="pnfpb_switch">
								<input  id="pnfpb_ic_fcm_disable_post_update_enable" name="pnfpb_ic_fcm_disable_post_update_enable" 
									   type="checkbox" value="1" <?php checked(
            								"1",
            								esc_attr($pnfpb_ic_fcm_disable_post_update_enable)
        								); ?>  
								/>
								<span class="pnfpb_slider round"></span>
							</label>							
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_disable_post_update_enable">
								<?php echo esc_html(
            							__(
                							"Send notifications only for new post (not for updated post)",
                							"push-notification-for-post-and-buddypress"
            							)
        							); 
								?>
							</label>
						</div>
					</div>
			</div>
			<div class="pnfpb_row">
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">
							<?php
       							$pnfpb_ic_fcm_only_post_subscribers_enable = "0";
       							if (
           							get_option("pnfpb_ic_fcm_only_post_subscribers_enable") &&
           							get_option("pnfpb_ic_fcm_only_post_subscribers_enable") === "1"
       							) {
           							$pnfpb_ic_fcm_only_post_subscribers_enable = "1";
       							}
       						?>
							<label class="pnfpb_switch">
								<input  id="pnfpb_ic_fcm_only_post_subscribers_enable" name="pnfpb_ic_fcm_only_post_subscribers_enable" 
									   type="checkbox" value="1" <?php checked(
            								"1",
            								esc_attr($pnfpb_ic_fcm_only_post_subscribers_enable)
        								); ?>  
								/>
								<span class="pnfpb_slider round"></span>
							</label>							
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_only_post_subscribers_enable">
								<?php echo esc_html(
            						__(
                						"To send notifications only to bbpress forum topic subscribers",
                						"push-notification-for-post-and-buddypress"
            						)
        						); ?>
							</label>
						</div>
					</div>
			</div>				
			<div class="pnfpb_row">
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">
							<?php
       							$pnfpb_ic_fcm_post_schedule_now_enable = "0";
       							if (
           							get_option("pnfpb_ic_fcm_post_schedule_now_enable") &&
           							get_option("pnfpb_ic_fcm_post_schedule_now_enable") === "1"
       							) {
           							$pnfpb_ic_fcm_post_schedule_now_enable = "1";
       							}
       						?>
							<label class="pnfpb_switch">
								<input  id="pnfpb_ic_fcm_post_schedule_now_enable" name="pnfpb_ic_fcm_post_schedule_now_enable" 
									   type="checkbox" value="1" <?php checked(
            								"1",
            								esc_attr($pnfpb_ic_fcm_post_schedule_now_enable)
        								); ?>  
								/>
								<span class="pnfpb_slider round"></span>
							</label>							
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_post_schedule_now_enable">
								<?php echo esc_html(
            						__(
                						"Send notification in action scheduler asynchronous background mode to avoid server overload.",
                						"push-notification-for-post-and-buddypress"
            						)
        						); ?>
								<br/>
								<?php echo esc_html(
            						__(
                						"(Enable this when more number of subscribers or notifications, it will take 30 to 60 seconds for batch process)",
                						"push-notification-for-post-and-buddypress"
            						)
        						); ?>								
							</label>
						</div>
					</div>
			</div>
			<div class="pnfpb_row">
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_post_schedule_enable">
								<?php echo esc_html(
            						__("Schedule", "push-notification-for-post-and-buddypress")
        						); ?>
							</label>
							<?php
       							$pnfpb_ic_fcm_post_schedule_enable = "0";
       							if ((get_option("pnfpb_ic_fcm_post_schedule_enable") &&
               						get_option("pnfpb_ic_fcm_post_schedule_enable") === "1") ||
           							(get_option("pnfpb_ic_fcm_post_schedule_background_enable") &&
               						get_option("pnfpb_ic_fcm_post_schedule_background_enable") ===
                   				"1")
       							) {
           							$pnfpb_ic_fcm_post_schedule_enable = "1";
       							}
       						?>
							<label class="pnfpb_switch">
								<input  id="pnfpb_ic_fcm_post_schedule_enable" name="pnfpb_ic_fcm_post_schedule_enable" 
									   type="checkbox" value="1" <?php checked(
            								"1",
            								esc_attr($pnfpb_ic_fcm_post_schedule_enable)
        								); ?>  
								/>
								<span class="pnfpb_slider round"></span>
							</label>
						</div>
					</div>
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox 
										  pnfpb_container pnfpb_ic_fcm_post_timeschedule_seconds_radio_block">
								<?php echo esc_html(
            						__(
                						"In seconds (min 300)",
                						"push-notification-for-post-and-buddypress"
            						)
        						); ?>
								<input  class="pnfpb_ic_fcm_post_timeschedule_seconds_radio_block" class="pnfpb_ic_fcm_post_timeschedule_seconds" 
									   name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" 
									   value="seconds" <?php checked(
           								 	"seconds",
            								esc_attr(get_option("pnfpb_ic_fcm_post_timeschedule_enable"))
        								); ?>  
								/>
								<span class="pnfpb_checkmark"></span>
							</label>
							<label class="pnfpb_ic_fcm_post_timeschedule_seconds_block">
								<input class="pnfpb_ic_push_settings_table_value_column_input_field" id="pnfpb_ic_fcm_post_timeschedule_seconds" 
									   name="pnfpb_ic_fcm_post_timeschedule_seconds" 
									   class="pnfpb_ic_fcm_post_timeschedule_seconds" type="number" min="300" 
									   value="<?php if (
            								!get_option("pnfpb_ic_fcm_post_timeschedule_seconds") ||
            								(get_option("pnfpb_ic_fcm_post_timeschedule_seconds") &&
                							get_option("pnfpb_ic_fcm_post_timeschedule_seconds") < 300)
        									) {
            									echo esc_attr(300);
        									} else {
            									echo esc_attr(
                									get_option("pnfpb_ic_fcm_post_timeschedule_seconds")
            									);
        									} ?>" required
								/>		
							</label>
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container">
								<?php echo esc_html(
            						__("Hourly", "push-notification-for-post-and-buddypress")
        						); ?>
								<input  name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" 
									   value="hourly" <?php checked(
            								"hourly",
            								esc_attr(get_option("pnfpb_ic_fcm_post_timeschedule_enable"))
        								); ?>  
								/>
								<span class="pnfpb_checkmark"></span>
							</label>
							<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
								<?php echo esc_html(
            							__("Twicedaily", "push-notification-for-post-and-buddypress")
        						); ?>
								<input name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" 
									   value="twicedaily" <?php checked(
            								"twicedaily",
            								esc_attr(get_option("pnfpb_ic_fcm_post_timeschedule_enable"))
        								); ?>  
								/>
								<span class="pnfpb_checkmark"></span>
							</label>
							<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
								<?php echo esc_html(
            						__("Daily", "push-notification-for-post-and-buddypress")
        						); ?>
								<input name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" 
									   value="daily" <?php checked(
            								"daily",
            								esc_attr(get_option("pnfpb_ic_fcm_post_timeschedule_enable"))
        								); ?>  
								/>
								<span class="pnfpb_checkmark"></span>
							</label>
							<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
								<?php echo esc_html(
            						__("Weekly", "push-notification-for-post-and-buddypress")
        						); ?>
								<input name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" 
									   value="weekly" <?php checked(
            								"weekly",
            								esc_attr(get_option("pnfpb_ic_fcm_post_timeschedule_enable"))
        								); ?>  
								/>
								<span class="pnfpb_checkmark"></span>
							</label>
						</div>
					</div>
				</div>
				<div  class="pnfpb_row">
					<?php echo esc_url('<a href="' .get_home_url() .
             '/wp-admin/admin.php?page=pnfpb_icfm_action_scheduler&s=PNFPB_cron_post_hook&action=-1&paged=1&action2=-1" target="_blank">'
     				) .
         			esc_html(
             			__(
                			 "Manage your scheduled tasks for post notifications in action scheduler tab - click here.",
                			 "push-notification-for-post-and-buddypress"
             			)
         			) .
         			"</a>"; ?>
				</div>
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
						<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_push_prompt_enable">
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_fcm_show_allposttype_subscriptions_custom_prompt" 
										   name="pnfpb_ic_fcm_show_allposttype_subscriptions_custom_prompt" 
										   type="checkbox" value="1" <?php checked(
             									"1",
             									esc_attr(get_option(
                 									"pnfpb_ic_fcm_show_allposttype_subscriptions_custom_prompt"
             									))
         									); ?>  
									/>
									<span class="pnfpb_slider round"></span>
								</label>
									<?php echo esc_html(
             							__(
                 							"Show custom post types subscription options in custom prompt/bell prompt/shortcode",
                 							"push-notification-for-post-and-buddypress"
             							)
         							); ?>
							</label>
						</div>						
					</div>
				</div>
				<div class="pnfpb_ic_post_type_content_form">
					<?php echo wp_kses($cutomize_post_field_notification_title, $allowed_html); ?>
				</div>
			</td>			
		</tr>