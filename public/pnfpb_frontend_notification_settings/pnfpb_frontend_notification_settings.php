<?php

            global $bp, $wpdb;
            $args = [
                "public" => true,
                "_builtin" => false,
            ];

            $output = "names"; // or objects
            $operator = "and"; // 'and' or 'or'
            $custposttypes = get_post_types($args, $output, $operator);

            $bpsubscribeoptions = "10000000000";

            $allowed_html = [
                "a" => [
                    "href" => [],
                    "title" => [],
                ],
                "span" => [
                    "class" => [],
                ],
                "p" => [
                    "class" => [],
                ],
                "aside" => [
                    "class" => [],
                    "span" => [
                        "class" => [],
                    ],
                    "p" => [
                        "class" => [],
                    ],
                ],
                "input" => [
                    "class" => [],
                    "id" => [],
                    "name" => [],
                    "type" => [],
                    "value" => [],
                ],
                "div" => [
                    "class" => [],
                    "input" => [
                        "class" => [],
                        "id" => [],
                        "name" => [],
                        "type" => [],
                        "value" => [],
						"pnfpb_index" => []
                    ],
                ],
                "label" => [
                    "class" => [
                        "span" => [
                            "class" => [],
                        ],
                        "input" => [
                            "class" => [],
                            "id" => [],
                            "name" => [],
                            "type" => [],
                            "value" => [],
							"pnfpb_index" => []
                        ],
                    ],
                ],
                "span" => [
                    "class" => [],
                ],
                "input" => [
                    "class" => [],
                    "id" => [],
                    "name" => [],
                    "type" => [],
                    "value" => [],
					"pnfpb_index" => [],
                ],
                "button" => [
                    "class" => [],
                    "id" => [],
                    "class" => [],
                    "type" => [],
                    "style" => [],
                ],				
                "br" => [],
                "em" => [],
                "b" => [],
                "option" => [
                    "value" => [],
                    "selected" => [],
                ],
            ];
            ?>
			<form class="standard-form" id="pnfpb_push_notification_frontend-settings-form">
				
				<table class="pnfpb_ic_front_push_notification_settings_table widefat" cellspacing="0">
    				<tbody>
        				<tr class="pnfpb_ic_push_settings_table_row">
							<td class="pnfpb_ic_push_settings_table_column column-columnname">
								<div class="pnfpb_bell_icon_custom_prompt_loader_frontend" id="pnfpb_bell_icon_custom_prompt_loader_frontend"></div>
								<div class="pnfpb_row pnfpb_frontend_subscriptions_options_menu_all">
									<?php
         $args = [
             "public" => true,
             "_builtin" => false,
         ];

         $output = "names"; // or objects
         $operator = "and"; // 'and' or 'or'
         $custposttypes = get_post_types($args, $output, $operator);
         $frontend_post_push_enable = false;

         $pnfpb_html_frontend_subscription_custom_post_options = "";

         $pnfpb_push_count = 14;
		 $posttypecount = 0;
         foreach ($custposttypes as $post_type) {
             if (
                 get_option("pnfpb_ic_fcm_" . $post_type . "_enable") === "1" &&
                 $post_type !== "buddypress" &&
                 $post_type !== "post"
             ) {
                 if (
                     get_option(
                         "pnfpb_ic_fcm_show_allposttype_subscriptions_custom_prompt"
                     ) === "1"
                 ) {
                     $pnfpb_ic_fcm_bell_subscription_default_label = ucwords(
                         $post_type
                     );

                     if (
                         get_option(
                             "pnfpb_ic_fcm_frontend_settings_" .
                                 $post_type .
                                 "_text"
                         )
                     ) {
                         $pnfpb_ic_fcm_bell_subscription_default_label = get_option(
                             "pnfpb_ic_fcm_frontend_settings_" .
                                 $post_type .
                                 "_text"
                         );
                     }

                     $pnfpb_html_frontend_subscription_custom_post_options .=
                         '<div class="pnfpb_column pnfpb_column_buddypress_functions">
							<div class="pnfpb_card">				
								<label class="pnfpb_ic_push_settings_table_label_checkbox 
									pnfpb_flex_grow_6 pnfpb_max_width_236" 
									for="'.esc_attr("pnfpb_ic_fcm_front_subscription_".$post_type."_enable").'">' .
                         					esc_html($pnfpb_ic_fcm_bell_subscription_default_label).
                         		'</label>
								<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
									<input id="' .
                         				esc_attr("pnfpb_ic_fcm_front_subscription_".$post_type."_enable").
                         				'" class="' .
                         				esc_attr("pnfpb_ic_fcm_front_subscription_".$post_type."_enable").
                         				'" name="' .
                         				esc_attr("pnfpb_ic_fcm_front_subscription_".$post_type."_enable").
                         				'" type="checkbox" pnfpb_index="' .
                         				esc_attr($pnfpb_push_count) .
                         				'" value="1"> 
									<span class="pnfpb_slider round"></span>
								</label>
							</div>
						</div>';
                 } else {
                     $frontend_post_push_enable = true;
                 }
             }
             $pnfpb_push_count++;
     		$posttypecount++;
			if ($posttypecount >= 10) {
				
				break;
			}			 
         }

         $pnfpb_ic_fcm_front_post_enable_label = esc_html(
             __("Post", "push-notification-for-post-and-buddypress")
         );

         if (get_option("pnfpb_ic_fcm_frontend_settings_post_text")) {
             $pnfpb_ic_fcm_front_post_enable_label = get_option(
                 "pnfpb_ic_fcm_frontend_settings_post_text"
             );
         }

         $pnfpb_show_push_notify_admin_types = [
             "activities",
             "comments",
             "mycomments",
             "privatemessage",
             "newmember",
             "friend_request",
             "friend_accept",
             "avatar_change",
             "coverimage_change",
         ];

         $pnfpb_show_push_notify_types = [
             "bactivity",
             "bcomment",
             "mybcomment",
             "bprivatemessage",
             "new_member",
             "friendship_request",
             "friendship_accept",
             "avatar_change",
             "cover_image_change",
         ];

         if (get_option("pnfpb_ic_fcm_post_enable") === "1") { ?>
												
			<div class="pnfpb_column pnfpb_column_buddypress_functions">
				<div class="pnfpb_card">				
					<label class="pnfpb_ic_push_settings_table_label_checkbox 
								  pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_ic_fcm_front_post_enable">
						<?php echo esc_html(
                    		get_option("pnfpb_ic_fcm_frontend_settings_post_text")
                		) ??
                    		esc_html(
                        		__("Post", "push-notification-for-post-and-buddypress")
                    	); ?>
					</label>
					<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
						<input id="pnfpb_ic_fcm_front_post_enable" 
							   class="pnfpb_ic_fcm_front_post_enable" 
							   name="pnfpb_ic_fcm_front_post_enable" 
							   type="checkbox" value="1"
						/> 
						<span class="pnfpb_slider round"></span>
					</label>
				</div>
			</div>
		<?php }

         echo wp_kses(
             $pnfpb_html_frontend_subscription_custom_post_options,
             $allowed_html
         );

         $pnfpb_push_admin_type_count = 0;

         $pnfpb_ic_fcm_front_enable_default_label = "";

         foreach ($pnfpb_show_push_notify_types as $notify_type) {
             if (
                 get_option("pnfpb_ic_fcm_" . $notify_type . "_enable") === "1"
             ) {

                 if ($notify_type === "bactivity") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "Activities",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if ($notify_type === "bcomment") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "Comments in Activity/Post",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if ($notify_type === "mybcomment") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "Comments in My Activity/My Post",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if ($notify_type === "bprivatemessage") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "New private message",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if ($notify_type === "new_member") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "New member joined",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if ($notify_type === "friendship_request") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "Friendship request",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if ($notify_type === "friendship_accept") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "Friendship accepted",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if ($notify_type === "avatar_change") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "Avatar change",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if ($notify_type === "cover_image_change") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "Cover image change",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if ($notify_type === "group_details_updated") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "Group details update",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if ($notify_type === "group_invite") {
                     $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                         __(
                             "Group Invites",
                             "push-notification-for-post-and-buddypress"
                         )
                     );
                 }

                 if (
                     get_option(
                         "pnfpb_ic_fcm_frontend_settings_" .
                             $post_type .
                             "_text"
                     )
                 ) {
                     $pnfpb_ic_fcm_front_enable_default_label = get_option(
                         "pnfpb_ic_fcm_frontend_settings_" .
                             $pnfpb_show_push_notify_admin_types[
                                 $pnfpb_push_admin_type_count
                             ] .
                             "_text"
                     );
                 }
                 ?>	
				<div class="pnfpb_column pnfpb_column_buddypress_functions">
					<div class="pnfpb_card">				
						<label class="pnfpb_ic_push_settings_table_label_checkbox 
									  pnfpb_flex_grow_6 pnfpb_max_width_236" 
							   	for="<?php echo esc_attr(
                    					"pnfpb_ic_fcm_front_".$notify_type."_enable"); ?>"
						>
							<?php echo esc_html($pnfpb_ic_fcm_front_enable_default_label); ?>
						</label>
						<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
							<input id="<?php echo esc_attr(
                     			"pnfpb_ic_fcm_front_".$notify_type."_enable"
                 			); ?>" class="<?php echo esc_attr(
    							"pnfpb_ic_fcm_front_".$notify_type."_enable"
							); ?>" name="<?php echo esc_attr(
    							"pnfpb_ic_fcm_front_".$notify_type."_enable"
							); ?>" type="checkbox" value="1"> 
							<span class="pnfpb_slider round"></span>
						</label>
					</div>
				</div>
				<?php
             }
             $pnfpb_push_admin_type_count++;
         }
			if (get_option("pnfpb_ic_fcm_group_details_updated_enable") === "1") { ?>
				<div class="pnfpb_column pnfpb_column_buddypress_functions">
					<div class="pnfpb_card">
						<label class="pnfpb_ic_push_settings_table_label_checkbox 
									pnfpb_flex_grow_6 pnfpb_max_width_236" 
								for="pnfpb_ic_fcm_group_details_updated_enable">
							<?php if (get_option("pnfpb_ic_fcm_frontend_settings_groupdetails_text")) {
								echo esc_html(
									get_option(
										"pnfpb_ic_fcm_frontend_settings_groupdetails_text"
									)
								);
							} else {
								echo esc_html(
									__(
										"Group details update",
										"push-notification-for-post-and-buddypress"
									)
								);
							} ?>
						</label>
						<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
							<input  id="pnfpb_ic_fcm_front_group_details_update_enable" 
									name="pnfpb_ic_fcm_front_group_details_update_enable" 
									type="checkbox" value="1"  
							/>	
							<span class="pnfpb_slider round"></span>
						</label>
					</div>
				</div>
			<?php }
         	if (get_option("pnfpb_ic_fcm_group_invitation_enable") === "1") { ?>
				<div class="pnfpb_column pnfpb_column_buddypress_functions">
    				<div class="pnfpb_card">
						<label class="pnfpb_ic_push_settings_table_label_checkbox 
									pnfpb_flex_grow_6 pnfpb_max_width_236" 
									for="pnfpb_ic_fcm_group_invite_enable"
						>
						<?php if (get_option("pnfpb_ic_fcm_frontend_settings_groupinvite_text")) {
							echo esc_html(
								get_option(
									"pnfpb_ic_fcm_frontend_settings_groupinvite_text"
								)
							);
            			} else {
							echo esc_html(
								__(
									"Group Invites",
									"push-notification-for-post-and-buddypress"
								)
							);
            			} ?>
						</label>
						<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
							<input  id="pnfpb_ic_fcm_front_group_invite_enable" name="pnfpb_ic_fcm_front_group_invite_enable" type="checkbox" value="1"  />	
							<span class="pnfpb_slider round"></span>
						</label>
					</div>
				</div>
			<?php }
         	if (get_option("pnfpb_ic_fcm_mark_favourite_enable") === "1") { ?>								
				<div class="pnfpb_column pnfpb_column_buddypress_functions">
					<div class="pnfpb_card">				
						<label class="pnfpb_ic_push_settings_table_label_checkbox 
									  pnfpb_flex_grow_6 pnfpb_max_width_236" for="pnfpb_ic_fcm_front_favourite_enable">
									<?php if (get_option("pnfpb_ic_fcm_frontend_settings_favourite_text")) {
										echo esc_html(
											get_option(
												"pnfpb_ic_fcm_frontend_settings_favourite_text"
											)
										);
									} else {
										echo esc_html(
											__("Likes/Favourites", "push-notification-for-post-and-buddypress")
										);
									} ?>							
						</label>
						<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
							<input id="pnfpb_ic_fcm_front_favourite_enable" 
								   class="pnfpb_ic_fcm_front_favourite_enable" 
								   name="pnfpb_ic_fcm_front_favourite_enable" 
								   type="checkbox" value="1"
							/> 
							<span class="pnfpb_slider round"></span>
						</label>
					</div>
				</div>
		<?php }			
         ?>
								</div>
							</td>
						</tr>
    				</tbody>
				</table>
			</form>
			<?php do_action("pnfpb_push_notification_frontend_before_submit"); ?>
			<div class="submit">
				<input id="submit" type="button" class="pnfpb_push_notification_frontend_settings_submit primary" 
					   name="pnfpb_push_notification_frontend_settings_submit" 
					   value="<?php echo esc_attr(__("Save Settings", "push-notification-for-post-and-buddypress")); ?>" 
					   class="auto" 
				/>
			</div>
			<br/>
			<?php do_action("pnfpb_push_notification_frontend_after_submit"); ?>
			<?php echo wp_kses(
      			'<aside class="screen-heading email-settings-screen pnfpb_ic_front_push_notification_settings_messages bp-feedback bp-messages bp-template-notice">
					<span class="bp-icon" aria-hidden="true"></span>
					<p class="pnfpb_ic_front_push_notification_settings_text">',
      					$allowed_html
  				) .
      			esc_html(
          		__(
             		 "Your notification settings have been saved.",
              		"push-notification-for-post-and-buddypress"
          		)
      		) .
      		wp_kses("</p></aside>", $allowed_html);

?>