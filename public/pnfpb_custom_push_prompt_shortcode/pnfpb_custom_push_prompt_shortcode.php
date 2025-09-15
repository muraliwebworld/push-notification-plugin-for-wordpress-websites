<?php

/** Shortcode for custom push notification subscription prompt
 *
 * @since 2.12 version
 *
 */

            if (
                !get_option("pnfpb_ic_fcm_loggedin_notify") ||
                (get_option("pnfpb_ic_fcm_loggedin_notify") &&
                    get_option("pnfpb_ic_fcm_loggedin_notify") === "1" &&
                    is_user_logged_in()) ||
                (get_option("pnfpb_ic_fcm_loggedin_notify") &&
                    get_option("pnfpb_ic_fcm_loggedin_notify") !== "1")
            ) {

            	$allowed_html = [
                "a" => [
                    "href" => [],
                    "title" => [],
                ],
                "input" => [
                    "class" => [],
                    "id" => [],
                    "name" => [],
                    "type" => [],
                    "value" => [],
					"pnfpb_index" => []
                ],
                "div" => [
                    "class" => [],
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
								"pnfpb_index" => [],
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
				
			$pnfpb_popup_subscribe_icon = "";
            if (get_option("pnfpb_ic_fcm_popup_subscribe_button_icon_shortcode")) {
                    $pnfpb_popup_subscribe_icon = get_option(
                        "pnfpb_ic_fcm_popup_subscribe_button_icon_shortcode"
                    );
            } else {
                    $pnfpb_popup_subscribe_icon =
                        plugin_dir_url(__DIR__) .
                        "/img/pushbell-pnfpb.png";
            }
				
			$pnfpb_ic_fcm_label_text_shortcode = "";
            if (get_option("pnfpb_ic_fcm_label_text_shortcode")) {
                    $pnfpb_ic_fcm_label_text_shortcode = get_option(
                        "pnfpb_ic_fcm_label_text_shortcode"
                    );
            } else {
                    $pnfpb_ic_fcm_label_text_shortcode = esc_html(
						__(
							"Subscribe Push notifications",
							"push-notification-for-post-and-buddypress"
						)
					);
            }			
				
           $pnfpb_notification_shortcode = '<div id="pnfpb-unsubscribe-notifications" class="pnfpb-unsubscribe-notifications ">
	   											<img class="pnfpb-push-subscribe-icon-shortcode" src="' .esc_url($pnfpb_popup_subscribe_icon) .'" width="32px" height="32px"/>';


			$pnfpb_ic_fcm_popup_header_text = esc_html(
                        __(
                            "Manage Push Notifications",
                            "push-notification-for-post-and-buddypress"
                        )
                    );

    		if (get_option("pnfpb_ic_fcm_popup_header_text")) {
                        $pnfpb_ic_fcm_popup_header_text = get_option(
                            "pnfpb_ic_fcm_popup_header_text_shortcode"
                        );
       		}
				
			if ($pnfpb_ic_fcm_popup_header_text === '' || !$pnfpb_ic_fcm_popup_header_text) {
				$pnfpb_ic_fcm_popup_header_text = esc_html(
                        __(
                            "Manage Push Notifications",
                            "push-notification-for-post-and-buddypress"
                        )
                    );				
				
			}

            $pnfpb_ic_fcm_popup_subscribe_button_color = "#E54B4D";

				if (
					get_option("pnfpb_ic_fcm_popup_subscribe_button_color")
				) {
					$pnfpb_ic_fcm_popup_subscribe_button_color = get_option(
						"pnfpb_ic_fcm_popup_subscribe_button_color_shortcode"
					);
				}

				$pnfpb_ic_fcm_popup_subscribe_options_button_color =
					"#CCCCCC";

				if (
					get_option(
						"pnfpb_ic_fcm_popup_subscribe_options_button_color"
					)
				) {
					$pnfpb_ic_fcm_popup_subscribe_options_button_color = get_option(
						"pnfpb_ic_fcm_popup_subscribe_options_button_color"
					);
				}

				$pnfpb_ic_fcm_popup_subscribe_button_text_color = "#FFFFFF";

				if (
					get_option(
						"pnfpb_ic_fcm_popup_subscribe_button_text_color"
					)
				) {
					$pnfpb_ic_fcm_popup_subscribe_button_text_color = get_option(
						"pnfpb_ic_fcm_popup_subscribe_button_text_color"
					);
				}

				$pnfpb_ic_fcm_popup_subscribe_options_button_text_color =
					"#000000";

				if (
					get_option(
						"pnfpb_ic_fcm_popup_subscribe_options_button_text_color_shortcode"
					)
				) {
					$pnfpb_ic_fcm_popup_subscribe_options_button_text_color = get_option(
						"pnfpb_ic_fcm_popup_subscribe_options_button_text_color_shortcode"
					);
				}

				$pnfpb_ic_fcm_popup_subscribe_options_button_text =
					"Update";

				if (
					get_option(
						"pnfpb_ic_fcm_popup_subscribe_options_button_text_color_shortcode"
					)
				) {
					$pnfpb_ic_fcm_popup_subscribe_options_button_text = get_option(
						"pnfpb_ic_fcm_popup_subscribe_options_button_text_shortcode"
					);
				}

				$pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon =
					"#FFFFFF";

				if (
					get_option(
						"pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon_shortcode"
					)
				) {
					$pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon = get_option(
						"pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon_shortcode"
					);
				}

				$pnfpb_ic_fcm_custom_prompt_header_text = esc_html(
					__(
						"We would like to show you notifications for the latest news and updates.",
						"push-notification-for-post-and-buddypress"
					)
				);

				$pnfpb_ic_fcm_custom_prompt_header_text_line_2 = "";					

				if (get_option("pnfpb_ic_fcm_custom_prompt_header_text")) {
					$pnfpb_ic_fcm_custom_prompt_header_text = get_option(
						"pnfpb_ic_fcm_custom_prompt_header_text_shortcode"
					);
				}

				if (get_option("pnfpb_ic_fcm_custom_prompt_header_text_line_2")) {
					$pnfpb_ic_fcm_custom_prompt_header_text_line_2 = get_option(
						"pnfpb_ic_fcm_custom_prompt_header_text_line_2_shortcode"
					);
				}					

				$pnfpb_ic_fcm_custom_prompt_allow_button_text = esc_html(
					__("Allow", "push-notification-for-post-and-buddypress")
				);

				if (
					get_option(
						"pnfpb_ic_fcm_custom_prompt_allow_button_text_shortcode"
					)
				) {
					$pnfpb_ic_fcm_custom_prompt_allow_button_text = get_option(
						"pnfpb_ic_fcm_custom_prompt_allow_button_text_shortcode"
					);
				}

				$pnfpb_ic_fcm_custom_prompt_cancel_button_text = esc_html(
					__(
						"Cancel",
						"push-notification-for-post-and-buddypress"
					)
				);

				if (
					get_option(
						"pnfpb_ic_fcm_custom_prompt_cancel_button_text_shortcode"
					)
				) {
					$pnfpb_ic_fcm_custom_prompt_cancel_button_text = get_option(
						"pnfpb_ic_fcm_custom_prompt_cancel_button_text_shortcode"
					);
				}

				$pnfpb_ic_fcm_custom_prompt_close_button_text = esc_html(
					__("Close", "push-notification-for-post-and-buddypress")
				);

				if (
					get_option(
						"pnfpb_ic_fcm_custom_prompt_close_button_text_shortcode"
					)
				) {
					$pnfpb_ic_fcm_custom_prompt_close_button_text = get_option(
						"pnfpb_ic_fcm_custom_prompt_close_button_text_shortcode"
					);
				}

				$pnfpb_ic_fcm_custom_prompt_header_text_processing = esc_html(
					__(
						"Please wait...it is processing",
						"push-notification-for-post-and-buddypress"
					)
				);

				if (
					get_option(
						"pnfpb_ic_fcm_custom_prompt_popup_wait_message"
					)
				) {
					$pnfpb_ic_fcm_custom_prompt_header_text_processing = get_option(
						"pnfpb_ic_fcm_custom_prompt_popup_wait_message_shortcode"
					);
				}

				$pnfpb_ic_fcm_custom_prompt_subscribed_text = esc_html(
					__(
						"You are subscribed to notifications",
						"push-notification-for-post-and-buddypress"
					)
				);

				if (
					get_option("pnfpb_ic_fcm_custom_prompt_subscribed_text")
				) {
					$pnfpb_ic_fcm_custom_prompt_subscribed_text = get_option(
						"pnfpb_ic_fcm_custom_prompt_subscribed_text_shortcode"
					);
				}

				$pnfpb_ic_fcm_custom_prompt_animation = "slideDown";

				if (get_option("pnfpb_ic_fcm_custom_prompt_animation")) {
					$pnfpb_ic_fcm_custom_prompt_animation = get_option(
						"pnfpb_ic_fcm_custom_prompt_animation_shortcode"
					);

					if (
						$pnfpb_ic_fcm_custom_prompt_animation !==
						"slideDown" &&
						$pnfpb_ic_fcm_custom_prompt_animation !== "slideUp"
					) {
						$pnfpb_ic_fcm_custom_prompt_animation = "slideDown";
					}
				}

				$pnfpb_bell_icon_subscription_option_update_text = "Update";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_update_text_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_update_text = get_option(
						"pnfpb_bell_icon_subscription_option_update_text_shortcode"
					);
				}

				$pnfpb_bell_icon_subscription_option_update_text_color =
					"#000000";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_update_text_color_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_update_text_color = get_option(
						"pnfpb_bell_icon_subscription_option_update_text_color_shortcode"
					);
				}

				$pnfpb_bell_icon_subscription_option_update_background_color =
					"#cccccc";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_update_background_color_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_update_background_color = get_option(
						"pnfpb_bell_icon_subscription_option_update_background_color_shortcode"
					);
				}

				$pnfpb_bell_icon_subscription_option_list_background_color =
					"#cccccc";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_list_background_color_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_list_background_color = get_option(
						"pnfpb_bell_icon_subscription_option_list_background_color_shortcode"
					);
				}

				$pnfpb_bell_icon_subscription_option_list_text_color =
					"#000000";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_list_text_color_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_list_text_color = get_option(
						"pnfpb_bell_icon_subscription_option_list_text_color_shortcode"
					);
				}

				$pnfpb_bell_icon_subscription_option_list_checkbox_color =
					"#135e96";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_list_checkbox_color_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_list_checkbox_color = get_option(
						"pnfpb_bell_icon_subscription_option_list_checkbox_color_shortcode"
					);
				}

				$pnfpb_bell_icon_subscription_option_update_confirmation_message =
					"subscription updated";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_update_confirmation_message_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_update_confirmation_message = get_option(
						"pnfpb_bell_icon_subscription_option_update_confirmation_message_shortcode"
					);
				}

				$pnfpb_bell_icon_subscription_option_update_text = "Update";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_update_text_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_update_text = get_option(
						"pnfpb_bell_icon_subscription_option_update_text_shortcode"
					);
				}

				$pnfpb_bell_icon_subscription_option_all_text = "All";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_all_text_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_all_text = get_option(
						"pnfpb_bell_icon_subscription_option_all_text_shortcode"
					);
				}

				$pnfpb_bell_icon_subscription_option_post_text = "Post";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_post_text_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_post_text = get_option(
						"pnfpb_bell_icon_subscription_option_post_text_shortcode"
					);
				}

				$pnfpb_bell_icon_subscription_option_activity_text =
					"Activity";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_activity_text_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_activity_text = get_option(
						"pnfpb_bell_icon_subscription_option_activity_text_shortcode"
					);
				}

				$pnfpb_bell_icon_subscription_option_all_comments_text =
					"All comments";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_all_comments_text_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_all_comments_text = get_option(
						"pnfpb_bell_icon_subscription_option_all_comments_text_shortcode"
					);
				}

				$pnfpb_bell_icon_subscription_option_my_comments_text =
					"My comments";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_my_comments_text_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_my_comments_text = get_option(
						"pnfpb_bell_icon_subscription_option_my_comments_text_shortcode"
					);
				}

				$pnfpb_bell_icon_subscription_option_private_message_text =
					"Private Message";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_private_messsage_text_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_private_message_text = get_option(
						"pnfpb_bell_icon_subscription_option_private_message_text_shortcode"
					);
				}

				$pnfpb_bell_icon_subscription_option_new_member_joined_text =
					"New member joined";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_new_member_joined_text_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_new_member_joined_text = get_option(
						"pnfpb_bell_icon_subscription_option_new_member_joined_text_shortcode"
					);
				}

				$pnfpb_bell_icon_subscription_option_friendship_request_text =
					"Friendship request";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_friendship_request_text_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_friendship_request_text = get_option(
						"pnfpb_bell_icon_subscription_option_friendship_request_text_shortcode"
					);
				}

				$pnfpb_bell_icon_subscription_option_friendship_accepted_text =
					"Friendship accepted";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_friendship_accepted_text_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_friendship_accepted_text = get_option(
						"pnfpb_bell_icon_subscription_option_friendship_accepted_text_shortcode"
					);
				}

				$pnfpb_bell_icon_subscription_option_avatar_change_text =
					"Avatar change";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_avatar_change_text_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_avatar_change_text = get_option(
						"pnfpb_bell_icon_subscription_option_avatar_change_text_shortcode"
					);
				}

				$pnfpb_bell_icon_subscription_option_cover_image_change_text =
					"Cover image change";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_cover_image_change_text_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_cover_image_change_text = get_option(
						"pnfpb_bell_icon_subscription_option_cover_image_change_text_shortcode"
					);
				}

				$pnfpb_bell_icon_subscription_option_group_details_update_text =
					"Group details update";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_group_details_update_text_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_group_details_update_text = get_option(
						"pnfpb_bell_icon_subscription_option_group_details_update_text_shortcode"
					);
				}

				$pnfpb_bell_icon_subscription_option_group_invite_text =
					"Group invite";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_group_invite_text_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_group_invite_text = get_option(
						"pnfpb_bell_icon_subscription_option_group_invite_text_shortcode"
					);
				}
				
				$pnfpb_bell_icon_subscription_option_favourite_text =
					"Likes/Favourites";

				if (
					get_option(
						"pnfpb_bell_icon_subscription_option_favourite_text_shortcode"
					)
				) {
					$pnfpb_bell_icon_subscription_option_favourite_text = get_option(
						"pnfpb_bell_icon_subscription_option_favourite_text_shortcode"
					);
				}				

				$pnfpb_custom_prompt_options_on_off = "0";

				if (get_option("pnfpb_custom_prompt_options_on_off")) {
					$pnfpb_custom_prompt_options_on_off = get_option(
						"pnfpb_custom_prompt_options_on_off_shortcode"
					);
				}

				$pnfpb_bell_icon_prompt_options_on_off = "1";

				if (
					get_option(
						"pnfpb_bell_icon_prompt_options_on_off_shortcode",
						"0"
					) != "0"
				) {
					$pnfpb_bell_icon_prompt_options_on_off = get_option(
						"pnfpb_bell_icon_prompt_options_on_off_shortcode"
					);
				}

				$args = [
					"public" => true,
					"_builtin" => false,
				];

				$output = "names"; // or objects
				$operator = "and"; // 'and' or 'or'
				$custposttypes = get_post_types($args, $output, $operator);

				$frontend_post_push_enable = false;

				$pnfpb_html_subscription_custom_post_options = "";

				$pnfpb_html_subscription_post_options = "";
				
				$pnfpb_html_subscription_favourite_options = "";

				$pnfpb_html_bellicon_subscription_post_options = "";
				
				$pnfpb_html_bellicon_subscription_favourite_options = "";

				$pnfpb_html_subscription_push_type_options = "";

				$pnfpb_html_bellicon_subscription_custom_post_options = "";

				$pnfpb_html_subscription_activity_options = "";

				$pnfpb_html_bellicon_subscription_activity_options = "";

				$pnfpb_push_count = 14;

				foreach ($custposttypes as $post_type) {
					if (
						get_option(
							"pnfpb_ic_fcm_" . $post_type . "_enable"
						) === "1" &&
						$post_type !== "post" &&
						$post_type !== "buddypress"
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
									"pnfpb_bell_icon_subscription_option_" .
									$post_type .
									"_text"
								)
							) {
								$pnfpb_ic_fcm_bell_subscription_default_label = get_option(
									"pnfpb_bell_icon_subscription_option_" .
									$post_type .
									"_text"
								);
							}

							$pnfpb_html_subscription_custom_post_options .=
								'<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox 
											pnfpb_flex_grow_6 pnfpb_max_width_236" 
											for="' .esc_html("pnfpb_bell_icon_subscription_".$post_type."_enable_shortcode") .
								'">' .
								esc_html(
								$pnfpb_ic_fcm_bell_subscription_default_label
							) .
								'	
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="' .
								esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable_shortcode") .
								'" class="' .
								esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable_shortcode") .
								'" name="' .
								esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable_shortcode") .
								'" pnfpb_index="' .
								esc_attr($pnfpb_push_count) .
								'" type="checkbox" value="1"
											/> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';

							$pnfpb_html_bellicon_subscription_custom_post_options .=
								'<div class="pnfpb_card">				
											<label class="pnfpb_ic_push_settings_table_label_checkbox 
												pnfpb_flex_grow_6 pnfpb_max_width_236" 
												for="' .
								esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable_shortcode") .
								'">' .
								esc_html(
								$pnfpb_ic_fcm_bell_subscription_default_label
							) .'
											</label>
											<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
												<input id="' .
								esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable_shortcode") .
								'" class="' .
								esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable_shortcode") .
								'" name="' .
								esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable_shortcode") .
								'" pnfpb_index="' .
								esc_attr($pnfpb_push_count) .
								'" type="checkbox" value="1"
												/> 
												<span class="pnfpb_slider round"></span>
											</label>
										</div>';
						}
					}
					$pnfpb_push_count++;
				}

				if (get_option("pnfpb_ic_fcm_post_enable") === "1") {
					$post_type = "post";

					$pnfpb_html_subscription_post_options .=
						'<div class="pnfpb_card">				
								<label class="pnfpb_ic_push_settings_table_label_checkbox 
									pnfpb_flex_grow_6 pnfpb_max_width_236" 
									for="' .
						esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable_shortcode") .
						'">' .
						esc_html(
						$pnfpb_bell_icon_subscription_option_post_text
					) .
						'
								</label>
								<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
									<input id="' .
						esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable_shortcode") .
						'" class="' .
						esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable_shortcode") .
						'" name="'.
						esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable_shortcode") .
						'" pnfpb_index="1" type="checkbox" value="1" 
									/> 
									<span class="pnfpb_slider round"></span>
								</label>
							</div>';

					$pnfpb_html_bellicon_subscription_post_options .=
						'<div class="pnfpb_card">				
								<label class="pnfpb_ic_push_settings_table_label_checkbox 
										pnfpb_flex_grow_6 pnfpb_max_width_236" 
										for="' .
						esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable_shortcode") .
						'">' .
						esc_html(
						$pnfpb_bell_icon_subscription_option_post_text
					) .
						'
								</label>
								<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
									<input id="' .
						esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable_shortcode") .
						'" class="'.
						esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable_shortcode") .
						'" name="' .
						esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable_shortcode") .
						'"  pnfpb_index="1" type="checkbox" value="1"
									/> 
									<span class="pnfpb_slider round"></span>
								</label>
							</div>';
				}

				if (get_option("pnfpb_ic_fcm_bactivity_enable") === "1") {
					$post_type = "activity";

					$pnfpb_html_subscription_activity_options .=
						'<div class="pnfpb_card">				
								<label class="pnfpb_ic_push_settings_table_label_checkbox 
										pnfpb_flex_grow_6 pnfpb_max_width_236" 
										for="' .
						esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable_shortcode") .
						'		">' .
						esc_html(
						$pnfpb_bell_icon_subscription_option_activity_text
					) .'
								</label>
								<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
									<input id="' .
						esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable_shortcode") .
						'" class="' .
						esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable_shortcode") .
						'" name="' .
						esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable_shortcode") .
						'" pnfpb_index="11" type="checkbox" value="1"
									/> 
									<span class="pnfpb_slider round"></span>
								</label>
							</div>';

					$pnfpb_html_bellicon_subscription_activity_options .=
						'<div class="pnfpb_card">				
								<label class="pnfpb_ic_push_settings_table_label_checkbox 
									pnfpb_flex_grow_6 pnfpb_max_width_236" 
									for="' .esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable_shortcode") .
						'">' .
						esc_html($pnfpb_bell_icon_subscription_option_activity_text) .'
								</label>
								<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
									<input id="' .
						esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable_shortcode") .
						'" class="' .
						esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable_shortcode") .
						'" name="' .
						esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable_shortcode") .
						'"  pnfpb_index="11" type="checkbox" value="1"
									/> 
									<span class="pnfpb_slider round"></span>
								</label>
							</div>';
				}
				
				if (get_option("pnfpb_ic_fcm_mark_favourite_enable") === "1") {
					$post_type = "favourite";

					$pnfpb_html_subscription_favourite_options .=
						'<div class="pnfpb_card">				
								<label class="pnfpb_ic_push_settings_table_label_checkbox 
									pnfpb_flex_grow_6 pnfpb_max_width_236" 
									for="' .
						esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable_shortcode") .
						'">' .
						esc_html(
						$pnfpb_bell_icon_subscription_option_favourite_text
					) .
						'
								</label>
								<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
									<input id="' .
						esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable_shortcode") .
						'" class="' .
						esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable_shortcode") .
						'" name="'.
						esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable_shortcode") .
						'" pnfpb_index="1" type="checkbox" value="1" 
									/> 
									<span class="pnfpb_slider round"></span>
								</label>
							</div>';

					$pnfpb_html_bellicon_subscription_favourite_options .=
						'<div class="pnfpb_card">				
								<label class="pnfpb_ic_push_settings_table_label_checkbox 
										pnfpb_flex_grow_6 pnfpb_max_width_236" 
										for="' .
						esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable_shortcode") .
						'">' .
						esc_html(
						$pnfpb_bell_icon_subscription_option_favourite_text
					) .
						'
								</label>
								<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
									<input id="' .
						esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable_shortcode") .
						'" class="'.
						esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable_shortcode") .
						'" name="' .
						esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable_shortcode") .
						'"  pnfpb_index="1" type="checkbox" value="1"
									/> 
									<span class="pnfpb_slider round"></span>
								</label>
							</div>';
				}				
			
				
				$pnfpb_html_bellicon_subscription_options = "";

				$pnfpb_html_bellicon_subscription_push_type_options = "";

				$pnfpb_html_bellicon_subscription_options_header = "";

				$pnfpb_html_bellicon_subscription_options_header =
					'<div class="pnfpb_bell_icon_prompt_subscription_options_container_shortcode" 
							style="background:' .
					esc_attr(
					$pnfpb_bell_icon_subscription_option_list_background_color
				) .
					";color:" .
					esc_attr(
					$pnfpb_bell_icon_subscription_option_list_text_color
				) .
					';">
									<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox 
											pnfpb_flex_grow_6 pnfpb_max_width_236" 
											for="pnfpb_bell_icon_subscription_all_enable_shortcode">
											' .
					esc_html(
					$pnfpb_bell_icon_subscription_option_all_text
				) .
					'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="pnfpb_bell_icon_prompt_subscription_all_enable_shortcode" class="pnfpb_bell_icon_prompt_subscription_all_enable_shortcode" name="pnfpb_bell_icon_prompt_subscription_all_enable_shortcode" type="checkbox" pnfpb_index="0" value="1"> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';

                    $pnfpb_show_push_notify_admin_types = [
                        "",
                        "post",
                        "bcomment",
                        "bcomment",
                        "bprivatemessage",
                        "new_member",
                        "friendship_request",
                        "friendship_accept",
                        "unsubscribe-all",
                        "avatar_change",
                        "cover_image_change",
                        "bactivity",
                        "group_details_updated",
                        "group_invitation",
                    ];

                    $pnfpb_show_push_notify_types = [
                        "all",
                        "post",
                        "all_comments",
                        "my_comments",
                        "private_message",
                        "new_member",
                        "friendship_request",
                        "friendship_accepted",
                        "unsubscribe-all",
                        "avatar_change",
                        "cover_image_change",
                        "activity",
                        "group_details_update",
                        "group_invite",
                    ];

                    $pnfpb_push_admin_type_count = 0;

                    foreach ($pnfpb_show_push_notify_types as $push_type) {
                        if ($push_type === "all") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "All",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "activity") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Activities",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "all_comments") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Comments in Activity/Post",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "my_comments") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Comments in My Activity/My Post",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "private_message") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "New private message",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "new_member") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "New member joined",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "friendship_request") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Friendship request",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "friendship_accepted") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Friendship accepted",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "avatar_change") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Avatar change",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "cover_image_change") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Cover image change",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "group_details_update") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Group details update",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if ($push_type === "group_invite") {
                            $pnfpb_ic_fcm_front_enable_default_label = esc_html(
                                __(
                                    "Group Invites",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        }

                        if (
                            $push_type !== "all" &&
                            $push_type !== "post" &&
                            $push_type !== "buddypress" &&
                            $push_type !== "activity" &&
                            $push_type !== "unsubscribe-all" &&
                            get_option(
                                "pnfpb_ic_fcm_" .
                                    $pnfpb_show_push_notify_admin_types[
                                        $pnfpb_push_admin_type_count
                                    ] .
                                    "_enable"
                            ) === "1"
                        ) {
                            $pnfpb_ic_fcm_bell_subscription_default_label = $pnfpb_ic_fcm_front_enable_default_label;

                            if (
                                get_option(
                                    "pnfpb_bell_icon_subscription_option_" .
                                        $push_type .
                                        "_text_shortcode"
                                )
                            ) {
                                $pnfpb_ic_fcm_bell_subscription_default_label = get_option(
                                    "pnfpb_bell_icon_subscription_option_" .
                                        $push_type .
                                        "_text_shortcode"
                                );
                            }

                            $pnfpb_html_bellicon_subscription_push_type_options .=
                                '<div class="pnfpb_card">				
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" 
									for="' .
                                		esc_attr("pnfpb_bell_icon_prompt_subscription_".$push_type."_enable_shortcode") .
                                '">' .
                                		esc_html(
                                    		$pnfpb_ic_fcm_bell_subscription_default_label
                                		) .
                                '
								</label>
								<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
									<input id="' .
                                		esc_attr("pnfpb_bell_icon_prompt_subscription_".$push_type."_enable_shortcode") .
                                		'" class="' .
                                		esc_attr("pnfpb_bell_icon_prompt_subscription_".$push_type."_enable_shortcode") .
                                		'" name="' .
                                		esc_attr("pnfpb_bell_icon_prompt_subscription_".$push_type."_enable_shortcode") .
                                		'_enable" pnfpb_index="' .
                                		esc_attr($pnfpb_push_admin_type_count) .
                                		'" type="checkbox" value="1"
									/> 
									<span class="pnfpb_slider round"></span>
								</label>
							</div>';
                        }
                        $pnfpb_push_admin_type_count++;
                    }

                    $pnfpb_html_bellicon_subscription_footer_options =
                        '								
								<button type="button" class="pnfpb-push-subscribe-options-button-shortcode" 
										id="pnfpb-push-subscribe-options-button-shortcode" 
										style="background:' .
                        						esc_attr(
                            						$pnfpb_bell_icon_subscription_option_update_background_color
                        						) .
                        						";color:" .
                        						esc_attr(
                            						$pnfpb_bell_icon_subscription_option_update_text_color
                        						) .
                        		';">' .
                        			esc_attr(
                            			$pnfpb_bell_icon_subscription_option_update_text
                        			) .
                        	"</button>";


				$pnfpb_html_bellicon_subscription_options = "";
				
				/* Center popup without push notification subscription options */
				$pnfpb_push_subscribe_button_layout_shortcode = "pnfpb-push-subscribe-button-layout-shortcode-center-nooptions";
				
				/* Top popup  without push notification subscription options */
				if (get_option("pnfpb_ic_fcm_bellicon_shortcode_style") && get_option("pnfpb_ic_fcm_bellicon_shortcode_style") === '2' ) {
					
					$pnfpb_push_subscribe_button_layout_shortcode = "pnfpb-push-subscribe-button-layout-shortcode-top-nooptions";
					
				}

				/* Bottom side popup  without push notification subscription options */
				if (get_option("pnfpb_ic_fcm_bellicon_shortcode_style") && get_option("pnfpb_ic_fcm_bellicon_shortcode_style") === '3' ) {
					
					$pnfpb_push_subscribe_button_layout_shortcode = "pnfpb-push-subscribe-button-layout-shortcode-bottom-nooptions";
					
				}
			
				
				/* Left side popup  without push notification subscription options */
				if (get_option("pnfpb_ic_fcm_bellicon_shortcode_style") && get_option("pnfpb_ic_fcm_bellicon_shortcode_style") === '4' ) {
					
					$pnfpb_push_subscribe_button_layout_shortcode = "pnfpb-push-subscribe-button-layout-shortcode-nooptions";
					
				}
				
				/* Right side popup  without push notification subscription options */
				if (get_option("pnfpb_ic_fcm_bellicon_shortcode_style") && get_option("pnfpb_ic_fcm_bellicon_shortcode_style") === '5' ) {
					
					$pnfpb_push_subscribe_button_layout_shortcode = "pnfpb-push-subscribe-button-layout-shortcode-nooptions";
					
				}				

				if ($pnfpb_bell_icon_prompt_options_on_off === "1") {
					$pnfpb_html_bellicon_subscription_options =
						$pnfpb_html_bellicon_subscription_options_header .
						$pnfpb_html_bellicon_subscription_post_options .
						$pnfpb_html_bellicon_subscription_custom_post_options .
						$pnfpb_html_bellicon_subscription_activity_options .
						$pnfpb_html_bellicon_subscription_push_type_options .
						$pnfpb_html_bellicon_subscription_favourite_options .
						"</div>" .
						$pnfpb_html_bellicon_subscription_footer_options;
					
					/* Top popup with push notification subscription options */
					$pnfpb_push_subscribe_button_layout_shortcode = "pnfpb-push-subscribe-button-layout-shortcode-center-options";
					
					/* Top popup with push notification subscription options */
					if (get_option("pnfpb_ic_fcm_bellicon_shortcode_style") && get_option("pnfpb_ic_fcm_bellicon_shortcode_style") === '2' ) {
					
						$pnfpb_push_subscribe_button_layout_shortcode = "pnfpb-push-subscribe-button-layout-shortcode-top-options";
					
					}
					
					/* Bottom side popup with push notification subscription options */
					if (get_option("pnfpb_ic_fcm_bellicon_shortcode_style") && get_option("pnfpb_ic_fcm_bellicon_shortcode_style") === '3' ) {
					
						$pnfpb_push_subscribe_button_layout_shortcode = "pnfpb-push-subscribe-button-layout-shortcode-bottom-options";
					
					}
					
					/* Left side popup with push notification subscription options */
					if (get_option("pnfpb_ic_fcm_bellicon_shortcode_style") && get_option("pnfpb_ic_fcm_bellicon_shortcode_style") === '4' ) {
					
						$pnfpb_push_subscribe_button_layout_shortcode = "pnfpb-push-subscribe-button-layout-shortcode-options";
					
					}					
					
					/* Right side popup with push notification subscription options */
					if (get_option("pnfpb_ic_fcm_bellicon_shortcode_style") && get_option("pnfpb_ic_fcm_bellicon_shortcode_style") === '5' ) {
					
						$pnfpb_push_subscribe_button_layout_shortcode = "pnfpb-push-subscribe-button-layout-shortcode-right-options";
					
					}
					
				}

				$pnfpb_notification_shortcode .= '<div id="pnfpb-push-subscribe-button-layout-shortcode" class="pnfpb-push-subscribe-button-layout-shortcode '.esc_attr($pnfpb_push_subscribe_button_layout_shortcode).'">
							<span class="pnfpb-bell-icon-header-shortcode">'.esc_html($pnfpb_ic_fcm_popup_header_text).'</span>
							<span class="dashicons dashicons-no pnfpb_shortcode_popup_close pnfpb_margin_left_12 pnfpb_padding_left_4"></span>
							<div id="pnfpb-push-subscribe-options-button-container-shortcode" class="pnfpb-push-subscribe-options-button-container-shortcode">
								' .
					wp_kses(
					$pnfpb_html_bellicon_subscription_options,
					$allowed_html
				) .
					'							
							</div>					
							<div class="pnfpb-push-msg-container-shortcode">
								<div class="pnfpb-push-icon-shortcode"><img src="' .
					esc_url($pnfpb_popup_subscribe_icon) .
					'" /></div>
								<div class="pnfpb-push-msg-text-layout">
									<div class="pnfpb_bell_icon_custom_prompt_loader_shortcode" id="pnfpb_bell_icon_custom_prompt_loader_shortcode"></div>
									<div class="pnfpb-push-msg-text-line"></div>
									<div class="pnfpb-push-msg-text-long-line"></div>
									<div class="pnfpb-push-msg-text-line"></div>
									<div class="pnfpb-push-msg-text-long-line"></div>
									<div class="pnfpb-push-msg-text-line"></div>
								</div>
								<div class="pnfpb-flex-break"></div>
								<div id="pnfpb-push-status-text-shortcode" class="pnfpb-push-status-text-shortcode"></div>								
							</div>						
							<div id="pnfpb-push-subscribe-button-container-shortcode" class="pnfpb-push-subscribe-button-container-shortcode">
								<button type="button" class="pnfpb-push-subscribe-button-shortcode" 
									id="pnfpb-push-subscribe-button-shortcode" 
									style="background:' .
					esc_attr($pnfpb_ic_fcm_popup_subscribe_button_color) .
					";color:" .
					esc_attr(
					$pnfpb_ic_fcm_popup_subscribe_button_text_color
				) .
					';">
								</button>
							</div>
						</div>
					</div>
					<div id="pnfpb-push-shortcode-label" class="pnfpb-push-shortcode-label">'
			   			.esc_html($pnfpb_ic_fcm_label_text_shortcode).
			   		'</div>';				
            }
?>