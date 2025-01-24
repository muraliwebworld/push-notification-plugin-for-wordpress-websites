<?php
/*
* BuddyPress activities and comments settings for push notification
* @Since 2.08
*/
?>
	<tr class="pnfpb_navy_blue_background_color pnfpb_white_text_color pnfpb_section_header_font_16px">
			<td class="pnfpb_ic_push_settings_table_column pnfpb_white_text_color pnfpb_section_header_font_16px">
				<label class="pnfpb_ic_push_settings_table_label_checkbox 
							  pnfpb_white_text_color pnfpb_section_header_font_16px">
								<?php echo esc_html(
        								__(
            								"BuddyPress or BuddyBoss activities or group activities push notification",
            								"push-notification-for-post-and-buddypress"
        								)
    								); 
								?>
				</label>
			</td>
		</tr>		
		<tr class="pnfpb_ic_push_settings_table_row">
            <td class="pnfpb_ic_push_settings_table_column column-columnname">
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
						<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" 
								   for="pnfpb_ic_fcm_buddypress_bactivity_enable">
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_fcm_bactivity_enable" 
										   name="pnfpb_ic_fcm_bactivity_enable" type="checkbox" 
										   value="1" <?php checked(
             									"1",
             									get_option("pnfpb_ic_fcm_bactivity_enable")
         									); ?>  
									/>
									<span class="pnfpb_slider round"></span>
								</label>
									<?php echo esc_html(
             							__(
                 							"BuddyPress activities",
                 							"push-notification-for-post-and-buddypress"
             							)
         							); ?>
							</label>
						</div>
					</div>
					<div class="pnfpb_column_400">
						<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container  
										  pnfpb_margin_left_4 pnfpb_padding_top_8">
								<?php echo esc_html(
            						__("All activities", "push-notification-for-post-and-buddypress")
        						); ?>
								<input  id="pnfpb_ic_fcm_buddypress_enable" name="pnfpb_ic_fcm_buddypress_enable" 
									   type="radio" value="1" <?php checked(
            								"1",
            								esc_attr(get_option("pnfpb_ic_fcm_buddypress_enable")
        								)); ?>  
								/>
								<span class="pnfpb_checkmark pnfpb_margin_top_6"></span>
							</label>
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container  pnfpb_padding_top_8">
									<input  id="pnfpb_ic_fcm_buddypress_group_enable" name="pnfpb_ic_fcm_buddypress_enable" 
										   type="radio" value="2" <?php checked(
             									"2",
             									esc_attr(get_option("pnfpb_ic_fcm_buddypress_enable")
         									)); ?>  
									/>
									<span class="pnfpb_checkmark  pnfpb_margin_top_6"></span>
									<?php echo esc_html(
             							__(
                 							"Group activity (only for group members)",
                 							"push-notification-for-post-and-buddypress"
             							)
         							); ?>
							</label>
							<button type="button" class="pnfpb_activity_form_button" 
									onclick="toggle_activity_content_form()">
								<?php echo esc_html(
           							__("Customize", "push-notification-for-post-and-buddypress")
       							); ?>
							</button>
						</div>
					</div>
				</div>
				<div class="pnfpb_row">
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">
							<?php
       							$pnfpb_ic_fcm_activity_schedule_now_enable = "0";
       							if (
           							get_option("pnfpb_ic_fcm_activity_schedule_now_enable") &&
           							get_option("pnfpb_ic_fcm_activity_schedule_now_enable") === "1"
       							) {
           							$pnfpb_ic_fcm_activity_schedule_now_enable = "1";
       							}
       						?>
							<label class="pnfpb_switch">
								<input  id="pnfpb_ic_fcm_activity_schedule_now_enable" 
									   name="pnfpb_ic_fcm_activity_schedule_now_enable" type="checkbox" 
									   value="1" <?php checked(
            								"1",
            								esc_attr($pnfpb_ic_fcm_activity_schedule_now_enable)
        								); ?>  
								/>
								<span class="pnfpb_slider round"></span>
							</label>							
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_activity_schedule_now_enable">
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
						<div class="pnfpb_column_400">
    						<div class="pnfpb_card">
								<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypressactivities_schedule_enable">
									<?php echo esc_html(
             							__("Schedule", "push-notification-for-post-and-buddypress")
         							); ?>
									<label class="pnfpb_switch">
										<?php
          									$pnfpb_ic_fcm_buddypressactivities_schedule_enable = "0";
          									if (
              									(get_option(
                  									"pnfpb_ic_fcm_buddypressactivities_schedule_enable"
              									) &&
                  								get_option(
                      								"pnfpb_ic_fcm_buddypressactivities_schedule_enable"
                  								) === "1") ||
              									(get_option(
                  									"pnfpb_ic_fcm_buddypressactivities_schedule_background_enable"
              									) &&
                  								get_option(
                      								"pnfpb_ic_fcm_buddypressactivities_schedule_background_enable"
                  								) === "1")
          									) {
              									$pnfpb_ic_fcm_buddypressactivities_schedule_enable = "1";
          									}
          								?>										
										<input  id="pnfpb_ic_fcm_buddypressactivities_schedule_enable" 
											   name="pnfpb_ic_fcm_buddypressactivities_schedule_enable" 
											   type="checkbox" value="1" <?php checked(
              										"1",
              										esc_attr($pnfpb_ic_fcm_buddypressactivities_schedule_enable)
          										); ?>  
										/>				
										<span class="pnfpb_slider round"></span>
									</label>
								</label>
							</div>
						</div>
  						<div class="pnfpb_column_400">
    						<div class="pnfpb_card">
								<label class="pnfpb_ic_push_settings_table_label_checkbox 
											  pnfpb_container 
											  pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_radio_block">
									<?php echo esc_html(
             							__(
                 							"In seconds(min 300)",
                 							"push-notification-for-post-and-buddypress"
             							)
         							); ?>
									<input  class="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_radio_block" 
										   class="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds" 
										   name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable" 
										   type="radio" 
										   value="seconds" <?php checked(
             										"seconds",
             										get_option("pnfpb_ic_fcm_buddypressactivities_timeschedule_enable")
         									); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_block">
									<input class="pnfpb_ic_push_settings_table_value_column_input_field" 
										   id="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds" 
										   name="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds" 
										   class="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds" 
										   type="number" min="300" value="<?php if (
             									!get_option(
                 									"pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds"
             									) ||
             									(get_option(
                 									"pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds"
             									) &&
                 								get_option(
                     								"pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds"
                 								) < 300)
         									) {
             									echo esc_attr(300);
         									} else {
             									echo esc_attr(
                 									get_option(
                     									"pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds"
                 									)
             									);
         									} ?>" required
									/>		
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container" >
									<?php echo esc_html(
             							__("Hourly", "push-notification-for-post-and-buddypress")
         							); ?>
									<input  id="pnfpb_ic_fcm_buddypressactivities_hourly_enable" 
										   name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable" 
										   type="radio" value="hourly" <?php checked(
             									esc_attr("hourly"),
             									esc_attr(get_option("pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"))
         									); ?>  
									/>
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container">
									<?php echo esc_html(
             							__("Twicedaily", "push-notification-for-post-and-buddypress")
         							); ?>						
									<input  id="pnfpb_ic_fcm_buddypressactivities_twicedaily_enable" 
										   name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable" 
										   type="radio" 
										   value="twicedaily" <?php checked(
             										esc_attr("twicedaily"),
             										esc_attr(get_option("pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"))
         									); ?>  
									/>
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container">
									<?php echo esc_html(
             								__("Daily", "push-notification-for-post-and-buddypress")
         							); ?>						
									<input  id="pnfpb_ic_fcm_buddypressactivities_daily_enable" 
										   name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable" 
										   type="radio" value="daily" <?php checked(
             									esc_attr("daily"),
             									esc_attr(get_option("pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"))
         									); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container" >
									<?php echo esc_html(
             							__("Weekly", "push-notification-for-post-and-buddypress")
         							); ?>						
									<input  id="pnfpb_ic_fcm_buddypressactivities_weekly_enable" 
										   name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable" 
										   type="radio" value="weekly" <?php checked(
             									esc_attr("weekly"),
             									esc_attr(get_option("pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"))
         									); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
							</div>
						</div>					
				</div>
				<div  class="pnfpb_row">
					<?php if (get_option("pnfpb_ic_fcm_buddypress_enable") === "1") { ?>
						<a href="
							<?php echo esc_url(
              					get_home_url()
      						);?>
						/wp-admin/admin.php?page=pnfpb_icfm_action_scheduler&s=PNFPB_cron_buddypressactivities_hook&action=-1&paged=1&action2=-1" target="_blank">
          					<?php echo esc_html(
              						__(
                  						"Manage your scheduled tasks for BuddyPress activities notifications in action scheduler tab",
                  						"push-notification-for-post-and-buddypress"
              						)
          					); ?>
          				</a>
				<?php } else { ?>
					<a href="
						<?php echo esc_url(
              				get_home_url()
      					);?>
              		/wp-admin/admin.php?page=pnfpb_icfm_action_scheduler&s=PNFPB_cron_buddypressgroupactivities_hook&action=-1&paged=1&action2=-1" target="_blank">
      					<?php echo esc_html(
              				__(
                  				"Manage your scheduled tasks for BuddyPress group activities notifications in action scheduler tab",
                  				"push-notification-for-post-and-buddypress"
             				)
          				); ?>
					</a>
				<?php } ?>
			</div>				
			<div class="pnfpb_ic_activity_content_form">
					<?php echo esc_html(
         				__(
             				"Notification title for BuddyPress new activity",
             				"push-notification-for-post-and-buddypress"
         				)
     				); ?>
					<br/>
					<?php echo esc_html(
         				__(				
							"use [member name] shortcode to display member name along with custom title",
							"push-notification-for-post-and-buddypress"
						)
					); ?>
					<br/>
					<?php echo esc_html(
         				__(				
							"(use [group name] shortcode only for group buddypress activities to display member name)",
							"push-notification-for-post-and-buddypress"
						)
					); ?>
					<br/>
					<?php echo esc_html(
         				__(	
							"Example '[member name] posted an activity' will display as 'Tom posted an activity' where Tom is member name",
							"push-notification-for-post-and-buddypress"
						)
					); ?>						
        			<input class="pnfpb_ic_push_settings_table_value_column_input_field" 
						   id="pnfpb_ic_fcm_activity_title" 
						   name="pnfpb_ic_fcm_activity_title" 
						   type="text" value="<?php echo esc_attr(
               					$activitytitle
           					); ?>" 
					/>
					<br/><br/>
					<?php echo esc_html(
         			__(
             			"Default Notification content for BuddyPress new activity",
             			"push-notification-for-post-and-buddypress"
         			)
     				); ?>
					<br/>
        			<input class="pnfpb_ic_push_settings_table_value_column_input_field" 
						   id="pnfpb_ic_fcm_activity_message" 
						   name="pnfpb_ic_fcm_activity_message" type="text" 
						   value="<?php echo esc_attr(
               					$activitymessage
           					); ?>" 
					/>
					<br/><br/>					
					<?php echo esc_html(
         				__(
             				"Notification title for BuddyPress new group activity",
             				"push-notification-for-post-and-buddypress"
         				)
     				); ?>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field" 
						   id="pnfpb_ic_fcm_group_activity_title" 
						   name="pnfpb_ic_fcm_group_activity_title" type="text" 
						   value="<?php echo esc_attr(
         						$activitygroup
     				); ?>"/>
					<br/><br/>
					<?php echo esc_html(
         			__(
             			"Default Notification content for BuddyPress new group activity",
             			"push-notification-for-post-and-buddypress"
         			)
     				); ?>
					<br/>
        			<input class="pnfpb_ic_push_settings_table_value_column_input_field" 
						   id="pnfpb_ic_fcm_group_activity_message" name="pnfpb_ic_fcm_group_activity_message" 
						   type="text" value="<?php echo esc_attr(
               					$groupactivitymessage
           					); ?>" 
					/>
					<br/><br/>
					<div class="pnfpb_column_400">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_followers_enable">
								<?php echo esc_html(
            						__(
                						"Notify only BuddyPress user followers (BuddyPress-followers plugin)",
                						"push-notification-for-post-and-buddypress"
            						)
        						); ?>
								<label class="pnfpb_switch">
									<?php
         								$pnfpb_ic_fcm_buddypress_followers_enable = "0";
         								if (
             								(get_option("pnfpb_ic_fcm_buddypress_followers_enable") &&
                 							get_option("pnfpb_ic_fcm_buddypress_followers_enable") ===
                     						"1") ||
             								(get_option("pnfpb_ic_fcm_buddypress_followers_enable") &&
                 							get_option("pnfpb_ic_fcm_buddypress_followers_enable") === "1")
         								) {
             								$pnfpb_ic_fcm_buddypress_followers_enable = "1";
         								}
         							?>										
									<input  id="pnfpb_ic_fcm_buddypress_followers_enable" 
										   name="pnfpb_ic_fcm_buddypress_followers_enable" 
										   type="checkbox" value="1" <?php checked(
             									"1",
             									$pnfpb_ic_fcm_buddypress_followers_enable
         									); ?>  
									/>				
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
				<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_white_text_color pnfpb_section_header_font_16px">
					<?php echo esc_html(
        				__(
            				"BuddyPress or BuddyBoss comments push notification",
            				"push-notification-for-post-and-buddypress"
        				)
    				); ?>
				</label>
			</td>
		</tr>		
		<tr class="pnfpb_ic_push_settings_table_row">
            <td class="pnfpb_ic_push_settings_table_column column-columnname">
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_buddypress_bcomment_enable">
								<?php echo esc_html(
            						__(
                						"BuddyPress/Post comments",
                						"push-notification-for-post-and-buddypress"
            						)
        						); ?>
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_fcm_bcomment_enable" 
										   name="pnfpb_ic_fcm_bcomment_enable" 
										   type="checkbox" value="1" <?php checked(
             									"1",
             									esc_attr(get_option("pnfpb_ic_fcm_bcomment_enable"))
         									); ?>  
									/>
									<span class="pnfpb_slider round"></span>
								</label>
							</label>
						</div>
					</div>
					<div class="pnfpb_column_400">
						<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container  
										  pnfpb_margin_left_4 pnfpb_padding_top_8">
								<?php echo esc_html(
            						__("All", "push-notification-for-post-and-buddypress")
        						); ?>
								<input  id="pnfpb_ic_fcm_buddypress_comments_radio_enable" 
									   name="pnfpb_ic_fcm_buddypress_comments_radio_enable" type="radio" 
									   value="1" <?php checked(
            								"1",
            								esc_attr(get_option("pnfpb_ic_fcm_buddypress_comments_radio_enable"))
        								); ?>  
								/>
								<span class="pnfpb_checkmark pnfpb_margin_top_6"></span>
							</label>
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container  pnfpb_padding_top_8">
								<input  id="pnfpb_ic_fcm_buddypress_comments_radio_enable" 
									   name="pnfpb_ic_fcm_buddypress_comments_radio_enable" type="radio" 
									   value="2" <?php checked(
            								"2",
            								esc_attr(get_option("pnfpb_ic_fcm_buddypress_comments_radio_enable"))
        								); ?>  
								/>
								<span class="pnfpb_checkmark  pnfpb_margin_top_6"></span>
								<?php echo esc_html(
            						__(
                						"Only for User's activities/Posts/My activities",
                						"push-notification-for-post-and-buddypress"
            						)
        						); ?>
							</label>
							<button type="button" class="pnfpb_comments_content_button" 
									onclick="toggle_comments_content_form()">
										<?php echo esc_html(
           									__("Customize", "push-notification-for-post-and-buddypress")
       									); ?>
							</button>
						</div>
					</div>	
				</div>
				<div class="pnfpb_row">
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">
							<?php
       							$pnfpb_ic_fcm_comments_schedule_now_enable = "0";
       							if (
           							get_option("pnfpb_ic_fcm_comments_schedule_now_enable") &&
           							get_option("pnfpb_ic_fcm_comments_schedule_now_enable") === "1"
       							) {
           							$pnfpb_ic_fcm_comments_schedule_now_enable = "1";
       							}
       						?>
							<label class="pnfpb_switch">
								<input  id="pnfpb_ic_fcm_comments_schedule_now_enable" 
									   name="pnfpb_ic_fcm_comments_schedule_now_enable" type="checkbox" 
									   value="1" <?php checked(
            								"1",
            								$pnfpb_ic_fcm_comments_schedule_now_enable
        								); ?>  
								/>
								<span class="pnfpb_slider round"></span>
							</label>						
							<label class="pnfpb_ic_push_settings_table_label_checkbox" 
								   for="pnfpb_ic_fcm_comments_schedule_now_enable">
								<?php echo esc_html(
            						__(
                						"Send notification in action scheduler asynchronous background mode to avoid server overload",
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
					<div class="pnfpb_column_400">
    						<div class="pnfpb_card">				
								<label class="pnfpb_ic_push_settings_table_label_checkbox">
									<?php echo esc_html(
             							__("Schedule", "push-notification-for-post-and-buddypress")
             						); ?>
									<label class="pnfpb_switch">
										<?php
          									$pnfpb_ic_fcm_buddypresscomments_schedule_enable = "0";
          									if (
              									(get_option("pnfpb_ic_fcm_buddypresscomments_schedule_enable") &&
                  								get_option(
                     							 	"pnfpb_ic_fcm_buddypresscomments_schedule_enable"
                  								) === "1") ||
              									(get_option(
                  									"pnfpb_ic_fcm_buddypresscomments_schedule_background_enable"
              									) &&
                  								get_option(
                      								"pnfpb_ic_fcm_buddypresscomments_schedule_background_enable"
                  								) === "1")
          									) {
              									$pnfpb_ic_fcm_buddypresscomments_schedule_enable = "1";
          									}
          								?>										
										<input  id="pnfpb_ic_fcm_buddypresscomments_schedule_enable" 
											   name="pnfpb_ic_fcm_buddypresscomments_schedule_enable" type="checkbox" 
											   value="1" <?php checked(
              										"1",
              										esc_attr(get_option("pnfpb_ic_fcm_buddypresscomments_schedule_enable"))
          										); ?>  
										/>				
										<span class="pnfpb_slider round"></span>
									</label>
								</label>
							</div>
					</div>
 					<div class="pnfpb_column_400">
    						<div class="pnfpb_card">
								<label class="pnfpb_ic_push_settings_table_label_checkbox 
											  pnfpb_container 
											  pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_radio_block">
									<?php echo esc_html(
             							__(
                 							"In seconds (min 300)",
                 							"push-notification-for-post-and-buddypress"
             							)
         							); ?>
									<input  class="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_radio_block" 
										   class="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds" 
										   name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable" 
										   type="radio" value="seconds" <?php checked(
             									"seconds",
             									esc_attr(get_option("pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"))
         									); ?>  />
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_block">
									<input class="pnfpb_ic_push_settings_table_value_column_input_field" 
										   id="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds" 
										   name="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds" 
										   class="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds" 
										   type="number" min="300" value="<?php if (
             									!get_option(
                 									"pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds"
            									 ) ||
             									(get_option(
                 									"pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds"
             									) &&
                 								get_option(
                    								 "pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds"
                 								) < 300)
         									) {
             									echo esc_attr(300);
         									} else {
             									echo esc_html(
                 									esc_attr(get_option(
                     									"pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds"
                 									))
             									);
         									} ?>" required
									/>		
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
									<?php echo esc_html(
             							__("Hourly", "push-notification-for-post-and-buddypress")
         							); ?>
									<input  id="pnfpb_ic_fcm_buddypresscomments_hourly_enable" 
										   name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable" type="radio" 
										   value="hourly" <?php checked(
             									esc_attr("hourly"),
             									esc_attr(get_option("pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"))
         									); ?>  
									/>
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
									<?php echo esc_html(
             							__("Twicedaily", "push-notification-for-post-and-buddypress")
         							); ?>
									<input  id="pnfpb_ic_fcm_buddypresscomments_twicedaily_enable" 
										   name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable" type="radio" 
										   value="twicedaily" <?php checked(
             									esc_attr("twicedaily"),
             									esc_attr(get_option("pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"))
         									); ?>  
									/>
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
									<?php echo esc_html(
             							__("Daily", "push-notification-for-post-and-buddypress")
         							); ?>
									<input  id="pnfpb_ic_fcm_buddypresscomments_daily_enable" 
										   name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable" type="radio" 
										   value="daily" <?php checked(
             									esc_attr("daily"),
             									esc_attr(get_option("pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"))
         									); ?>  
									/>
									<span class="pnfpb_checkmark"></span>
								</label>
								<label class="pnfpb_ic_push_settings_table_label_checkbox  pnfpb_container">
									<input  id="pnfpb_ic_fcm_buddypresscomments_weekly_enable" 
										   name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable" type="radio" 
										   value="weekly" <?php checked(
             									esc_attr("weekly"),
             									esc_attr(get_option("pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"))
         									); ?>  />
									<?php echo esc_html(
             							__("Weekly", "push-notification-for-post-and-buddypress")
         							); ?>
									<span class="pnfpb_checkmark"></span>
								</label>
							</div>
					</div>
				</div>
				<div  class="pnfpb_row">
					<a href="
						<?php echo esc_url(get_home_url()); ?>
							 /wp-admin/admin.php?page=pnfpb_icfm_action_scheduler&s=PNFPB_cron_buddypresscomments_hook&action=-1&paged=1&action2=-1" target="_blank">
            						<?php echo esc_html(
                						__(
                    						"Manage your scheduled tasks for BuddyPress comments/Post comments notifications in action scheduler tab",
                    						"push-notification-for-post-and-buddypress"
                						)
            						); ?>
            		</a>
				</div>				
				<div class="pnfpb_ic_comments_content_form">
					<label for="pnfpb_ic_fcm_comment_activity_title">
						<?php echo esc_html(
         				__(
             				"Notification title for BuddyPress new comment",
             				"push-notification-for-post-and-buddypress"
         				)
     					); ?>
						<br/>
						<?php echo esc_html(
         				__(
             				"use [member name] shortcode to display member name along with custom title.",
             				"push-notification-for-post-and-buddypress"
         				)
     					); ?>
						<br/>
						<?php echo esc_html(
         				__(
             				"Example '[member name] posted a comment' will display as 'Tom posted a comment' where Tom is member name",
             				"push-notification-for-post-and-buddypress"
         				)
     					); ?>						
					</label>
					<br/>
        			<input class="pnfpb_ic_push_settings_table_value_column_input_field" 
						   id="pnfpb_ic_fcm_comment_activity_title" 
						   name="pnfpb_ic_fcm_comment_activity_title" 
						   type="text" value="<?php echo esc_attr(
               					$activitycomment
           			); ?>" />
					<br/><br/>
					<label for="pnfpb_ic_fcm_comment_activity_message">
						<?php echo esc_html(
         				__(
             				"Default Notification content for BuddyPress new comment",
             				"push-notification-for-post-and-buddypress"
         				)
     					); ?>
					</label>
					<br/>
					<label for="pnfpb_ic_fcm_comment_activity_message">
						<?php echo esc_html(
         				__(
             				"(or leave it as blank to display comment content in notification message)",
             				"push-notification-for-post-and-buddypress"
         				)
     					); ?>
					</label>					
        			<input class="pnfpb_ic_push_settings_table_value_column_input_field" 
						   id="pnfpb_ic_fcm_comment_activity_message" 
						   name="pnfpb_ic_fcm_comment_activity_message" type="text" 
						   value="<?php echo esc_attr(
               					$commentactivitymessage
           					); ?>" 
					/>
					<br/><br/>
				</div>
			</td>
		</tr>