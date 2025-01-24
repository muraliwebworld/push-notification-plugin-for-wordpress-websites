<?php
/**
* Plugin settings area to customize text for push notification subscription for frontend users
*
* @since 1.52.0
*/
?>

<h1 class="pnfpb_ic_push_settings_header"><?php echo esc_html(
    __(
        "PNFPB - Frontend subscription settings",
        "push-notification-for-post-and-buddypress"
    )
); ?></h1>

<div class="nav-tab-wrapper">
	<a href="<?php echo esc_url(
     admin_url()."admin.php?page=pnfpb-icfcm-slug"); ?>" 
	   class="nav-tab tab">
		<?php echo esc_html(
    		__("Push Settings", "push-notification-for-post-and-buddypress")
		); ?>
	</a>
	<a href="<?php echo esc_url(
     	admin_url()."admin.php?page=pnfpb_icfm_device_tokens_list"); ?>" 
	   	class="nav-tab tab ">
			<?php echo esc_html(
    			__("Device tokens", "push-notification-for-post-and-buddypress")
			); ?>
	</a>
	<a href="<?php echo esc_url(
     	admin_url()."admin.php?page=pnfpb_icfm_pwa_app_settings"); ?>" 
		class="nav-tab tab">
			<?php echo esc_html(
    			__("PWA", "push-notification-for-post-and-buddypress")
			); ?>
	</a>
	<a href="<?php echo esc_url(
     	admin_url()."admin.php?page=pnfpb_icfmtest_notification"); ?>"
	   	class="nav-tab tab ">
			<?php echo esc_html(
    			__("Send push notification", "push-notification-for-post-and-buddypress")
			); ?>
	</a>
	<a href="<?php echo esc_url(
     	admin_url()."admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc"); ?>"
	   class=" nav-tab tab">
			<?php echo esc_html(
    			__("Push Notifications list", "push-notification-for-post-and-buddypress")
			); ?>
	</a>
	<a href="<?php echo esc_url(
     	admin_url()."admin.php?page=pnfpb_icfm_frontend_settings"); ?>"
	   class="nav-tab tab active nav-tab-active">
			<?php echo esc_html(
    			__(
        			"Frontend subscription settings",
        			"push-notification-for-post-and-buddypress"
    			)
			); ?>
	</a>
	<a href="<?php echo esc_url(
     	admin_url()."admin.php?page=pnfpb_icfm_button_settings"); ?>"
	   class="nav-tab tab ">
			<?php echo esc_html(
    			__("Customize buttons", "push-notification-for-post-and-buddypress")
			); ?>
	</a>
	<a href="<?php echo esc_url(
     	admin_url()."admin.php?page=pnfpb_icfm_integrate_app"); ?>" 
	   	class="nav-tab tab ">
			<?php echo esc_html(
    			__("Integrate Mobile app", "push-notification-for-post-and-buddypress")
			); ?>
	</a>
	<a href="<?php echo esc_url(
     admin_url()."admin.php?page=pnfpb_icfm_settings_for_ngnix_server"); ?>"
	   class="nav-tab tab ">
			<?php echo esc_html(
    			__("NGINX", "push-notification-for-post-and-buddypress")
			); ?>
	</a>
	<a href="<?php echo esc_url(
     	admin_url()."admin.php?page=pnfpb_icfm_action_scheduler&s=pnfpb&action=-1&paged=1&action2=-1"); ?>"
	   class="nav-tab tab ">
			<?php echo esc_html(
    			__("Action Scheduler", "push-notification-for-post-and-buddypress")
			); ?>
	</a>
</div>

<div class="pnfpb_column_1200">
<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
    <?php settings_fields("pnfpb_icfcm_frontend_buttons"); ?>
    <?php do_settings_sections("pnfpb_icfcm_frontend_buttons"); ?>
	<?php if (
     !class_exists("OneSignal") &&
     get_option("pnfpb_onesignal_push") === "1"
 ) { ?>
		
		<div class="notice notice-success is-dismissible">
  			<p><?php esc_html_e(
         "Onesignal plugin is required to use Onesignal as push notification provider. Please install and configure Onesignal plugin",
         "push-notification-for-post-and-buddypress"
     ); ?></p>
    	</div>
	
	<?php } ?>

	
	<table class="pnfpb_ic_push_settings_table widefat fixed">
  		<tbody>
			<tr class="pnfpb_ic_push_settings_table_row">
				<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<h3 class="pnfpb_ic_push_settings_header">
						<?php echo esc_html(
       						__(
           						"Customize Frontend subscription buttons and text",
           						"push-notification-for-post-and-buddypress"
       						)
   						); ?>
					</h3>
				</td>
			</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
				<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<h4 class="pnfpb_ic_push_settings_header">
						<p>
						<?php echo esc_html(
       						__(
           						"Front end subscription available only for BuddyPress users under user profile.",
           						"push-notification-for-post-and-buddypress"
       						)); ?>
						</p>
						<p>
							<?php echo esc_html(
       						__(	
								"members/username profile->settings->Push Notification subscription",
								"push-notification-for-post-and-buddypress"
							));?>
						</p>
						<p>
							<?php echo esc_html(
       						__(	
								"Example: 'https://domain name/members/user name/settings/push-subscription/'",
								"push-notification-for-post-and-buddypress"
							));?>
						</p>
					</h4>
				</td>
			</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
            	<td class="pnfpb_ic_push_settings_table_label column-columnname">
					<div class="pnfpb_row">
						<div class="pnfpb_column_400">
							<div class="pnfpb_card">
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_frontend_enable_subscription">
									<label class="pnfpb_switch">
										<input  id="pnfpb_ic_fcm_frontend_enable_subsription" 
											   name="pnfpb_ic_fcm_frontend_enable_subscription" 
											   type="checkbox" 
											   value="1" <?php checked("1",get_option("pnfpb_ic_fcm_frontend_enable_subscription")); ?>  
										/>
										<span class="pnfpb_slider round"></span>
									</label>
										<?php echo esc_html(
              								__(
                  								"Enable/disable Frontend subscription in BuddyPress user profile menu",
                  								"push-notification-for-post-and-buddypress"
              								)
          								); ?>
								</label>
							</div>
						</div>
					</div>
				</td>
			</tr>
   	 		<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_frontend_background_button_color">
						<?php echo esc_html(
          					__(
              					"Frontend menu background color",
              					"push-notification-for-post-and-buddypress"
          					)
      					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field 
								  pnfpb_ic_pwa_prompt_install_button_color pnfpb_ic_push_pwa_color" 
						   id="pnfpb_ic_fcm_frontend_subscribe_button_color" 
						   name="pnfpb_ic_fcm_frontend_subscribe_button_color" 
						   type="color" 
						   value="<?php if (
         						get_option("pnfpb_ic_fcm_frontend_subscribe_button_color")
     						) {
         						echo esc_attr(
             						get_option("pnfpb_ic_fcm_frontend_subscribe_button_color")
         						);
     						} else {
         							echo esc_attr("#aaaaaa");
     						} ?>" 
					/>
				</td>
			</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_frontend_settings_post_button_text">
						<?php echo esc_html(
           					__(
               					"Subscription text/label for Post",
               					"push-notification-for-post-and-buddypress"
           						)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  
						   id="pnfpb_ic_fcm_frontend_settings_post_text" 
						   name="pnfpb_ic_fcm_frontend_settings_post_text" type="text" 
						   value="<?php if (
    							get_option("pnfpb_ic_fcm_frontend_settings_post_text")
								) {
    								echo esc_attr(get_option("pnfpb_ic_fcm_frontend_settings_post_text"));
								} else {
    								echo esc_attr(__("Post", "push-notification-for-post-and-buddypress"));
								} ?>" 
					/>
				</td>
    		</tr>
	<?php
   $args = [
       "public" => true,
       "_builtin" => false,
   ];

   $output = "names"; // or objects
   $operator = "and"; // 'and' or 'or'

   $custposttypes = get_post_types($args, $output, $operator);

   foreach ($custposttypes as $post_type) {
       if ($post_type !== "buddypress" && $post_type !== "post") { ?>		
						<tr class="pnfpb_ic_push_settings_table_row">
    						<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
								<label for="<?php echo esc_attr("pnfpb_ic_fcm_frontend_settings_".$post_type."_button_text"); ?>">
									<?php echo esc_html(
    									__(
        								"Subscription text/label for ",
        								"push-notification-for-post-and-buddypress"
    									)
									) .esc_html($post_type); ?>
								</label>
								<br/>
								<input class="pnfpb_ic_push_settings_table_value_column_input_field"  
									   id="<?php echo esc_attr("pnfpb_ic_fcm_frontend_settings_".$post_type."_text"); ?>_text" 
									   name="<?php echo esc_attr("pnfpb_ic_fcm_frontend_settings_".$post_type."_text"); ?>"
									    type="text" 
									   value="<?php if (
    										get_option("pnfpb_ic_fcm_frontend_settings_" . $post_type . "_text")
										) {
    										echo esc_attr(get_option("pnfpb_ic_fcm_frontend_settings_" . $post_type . "_text"));
										} else {
    										echo esc_attr(ucwords($post_type));
								} ?>" />
							</td>
    					</tr>						
				<?php }
   }
   ?>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_frontend_settings_activities_button_text">
						<?php echo esc_html(
           					__(
               					"Subscription text/label for Activities",
               					"push-notification-for-post-and-buddypress"
           						)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_frontend_settings_activities_text" name="pnfpb_ic_fcm_frontend_settings_activities_text" type="text" 
						   value="<?php if (
    							get_option("pnfpb_ic_fcm_frontend_settings_activities_text")
							) {
    							echo esc_attr(get_option("pnfpb_ic_fcm_frontend_settings_activities_text"));
							} else {
    							echo esc_attr(
        							__("Activities", "push-notification-for-post-and-buddypress")
    							);
							} ?>" 
					/>
				</td>
    		</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_frontend_settings_comments_text">
						<?php echo esc_html(
           					__(
               					"Subscription text/label for comments",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  
						   id="pnfpb_ic_fcm_frontend_settings_comments_text" 
						   name="pnfpb_ic_fcm_frontend_settings_comments_text" 
						   type="text" 
						   value="<?php if (
    								get_option("pnfpb_ic_fcm_frontend_settings_comments_text")
								) {
    								echo esc_attr(get_option("pnfpb_ic_fcm_frontend_settings_comments_text"));
								} else {
    								echo esc_attr(__("Comments", "push-notification-for-post-and-buddypress"));
								} 
							?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_frontend_settings_mycomments_text">
						<?php echo esc_html(
           					__(
               					"Subscription text/label for comments on My activities/My Post",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
				</label>
				<br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field"  
					   id="pnfpb_ic_fcm_frontend_settings_mycomments_text" 
					   name="pnfpb_ic_fcm_frontend_settings_mycomments_text" 
					   type="text" 
					   value="<?php if (
    							get_option("pnfpb_ic_fcm_frontend_settings_mycomments_text")
							) {
    							echo esc_attr(get_option("pnfpb_ic_fcm_frontend_settings_mycomments_text"));
							} else {
    							echo esc_attr(
        							__(
            							"Comments on My activity/My Post",
            							"push-notification-for-post-and-buddypress"
        							)
    							);
							} 
						?>" 
					/>
				</td>
    		</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_frontend_settings_privatemessage_text">
						<?php echo esc_html(
           					__(
               					"Subscription text/label for private message",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  
						   id="pnfpb_ic_fcm_frontend_settings_privatemessage_text" 
						   name="pnfpb_ic_fcm_frontend_settings_privatemessage_text" 
						   type="text" 
						   value="<?php if (
    							get_option("pnfpb_ic_fcm_frontend_settings_privatemessage_text")
							) {
    							echo esc_attr(
        							get_option("pnfpb_ic_fcm_frontend_settings_privatemessage_text")
    							);
							} else {
    							echo esc_attr(
        							__("Private message", "push-notification-for-post-and-buddypress")
    							);
							} 
							?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_frontend_settings_newmember_text">
						<?php echo esc_html(
           					__(
               					"Subscription text/label for new member joined",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  
						   id="pnfpb_ic_fcm_frontend_settings_newmember_text" 
						   name="pnfpb_ic_fcm_frontend_settings_newmember_text" 
						   type="text" 
						   value="<?php if (
    								get_option("pnfpb_ic_fcm_frontend_settings_newmember_text")
								) {
    								echo esc_attr(get_option("pnfpb_ic_fcm_frontend_settings_newmember_text"));
								} else {
    								echo esc_attr("New member joined");
							} ?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_frontend_settings_friend_request_text">
						<?php echo esc_html(
           					__(
               					"Subscription text/label for Friendship request",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  
						   id="pnfpb_ic_fcm_frontend_settings_friend_request_text" 
						   name="pnfpb_ic_fcm_frontend_settings_friend_request_text" 
						   type="text" 
						   value="<?php if (
    							get_option("pnfpb_ic_fcm_frontend_settings_friend_request_text")
							) {
    							echo esc_attr(
        							get_option("pnfpb_ic_fcm_frontend_settings_friend_request_text")
    							);
							} else {
    							echo esc_attr(
        							__("Friendship request", "push-notification-for-post-and-buddypress")
    							);
							} 
						?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_frontend_settings_friend_accept_text">
						<?php echo esc_html(
           					__(
               					"Subscription text/label for Friendship accepted",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  
						   id="pnfpb_ic_fcm_frontend_settings_friend_accept_text" 
						   name="pnfpb_ic_fcm_frontend_settings_friend_accept_text" 
						   type="text" 
						   value="<?php if (
    								get_option("pnfpb_ic_fcm_frontend_settings_friend_accept_text")
								) {
    								echo esc_attr(
        								get_option("pnfpb_ic_fcm_frontend_settings_friend_accept_text")
    								);
								} else {
    								echo esc_attr(
        								__("Friendship accepted", "push-notification-for-post-and-buddypress")
    								);
								} 
							?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_frontend_settings_avatar_change_text">
						<?php echo esc_html(
           					__(
               					"Subscription text/label for Avatar change",
               					"push-notification-for-post-and-buddypress"
          					 )
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_frontend_settings_avatar_change_text" 
						   name="pnfpb_ic_fcm_frontend_settings_avatar_change_text" type="text" 
						   value="<?php if (
    									get_option("pnfpb_ic_fcm_frontend_settings_avatar_change_text")
									) {
    									echo esc_attr(
        									get_option("pnfpb_ic_fcm_frontend_settings_avatar_change_text")
    									);
									} else {
    									echo esc_attr(
        									__("Avatar change", "push-notification-for-post-and-buddypress")
    									);
									} ?>" 
					/>
				</td>
    		</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_frontend_settings_coverimage_change_text">
						<?php echo esc_html(
           					__(
               					"Subscription text for Cover image change",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_frontend_settings_coverimage_change_text" 
						   name="pnfpb_ic_fcm_frontend_settings_coverimage_change_text" type="text" 
						   value="<?php if (
    								get_option("pnfpb_ic_fcm_frontend_settings_coverimage_change_text")
								) {
    								echo esc_attr(
        								get_option("pnfpb_ic_fcm_frontend_settings_coverimage_change_text")
    								);
								} else {
    								echo esc_attr(
        								__("Cover image change", "push-notification-for-post-and-buddypress")
    								);
								} ?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_frontend_settings_groupdetails_text">
						<?php echo esc_html(
           						__(
               						"Subscription text for Group details update",
               						"push-notification-for-post-and-buddypress"
           						)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_frontend_settings_groupdetails_text" 
						   name="pnfpb_ic_fcm_frontend_settings_groupdetails_text" 
						   type="text" value="<?php if (
    								get_option("pnfpb_ic_fcm_frontend_settings_groupdetails_text")
								) {
    								echo esc_attr(
        								get_option("pnfpb_ic_fcm_frontend_settings_groupdetails_text")
    								);
								} else {
    								echo esc_attr(
        								__("Group details update", "push-notification-for-post-and-buddypress")
    								);
								} ?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_frontend_settings_groupinvite_text">
						<?php echo esc_html(
           					__(
               					"Subscription text for Group invite",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  
						   id="pnfpb_ic_fcm_frontend_settings_groupinvite_text" 
						   name="pnfpb_ic_fcm_frontend_settings_groupinvite_text" 
						   type="text" 
						   value="<?php if (
    								get_option("pnfpb_ic_fcm_frontend_settings_groupinvite_text")
								) {
    								echo esc_attr(
        								get_option("pnfpb_ic_fcm_frontend_settings_groupinvite_text")
    								);
								} else {
    								echo esc_attr(
        								__("Group invite", "push-notification-for-post-and-buddypress")
    								);
								} ?>" 
						/>
				</td>
    		</tr>
			<tr>
				<td class="column-columnname">
					<div class="pnfpb_column_full">
						<?php submit_button(
        					__("Save changes", "push-notification-for-post-and-buddypress"),
        					"pnfpb_ic_push_frontend_save_configuration_button"
    					); ?>
					</div>
				</td>
    		</tr>
  		</tbody>
	</table>
</form>
</div>