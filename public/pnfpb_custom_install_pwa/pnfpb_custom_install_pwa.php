<?php
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

	$pnfpb_pwa_prompt_ios_prompt_background = "#000000";

	$posttypecount = 0;

	if (
		get_option(
			"pnfpb_ic_fcm_pwa_ios_prompt_dialog_background"
		) && get_option(
			"pnfpb_ic_fcm_pwa_ios_prompt_dialog_background"
		) === ""
	) {
		$pnfpb_pwa_prompt_ios_prompt_background = get_option(
			"pnfpb_ic_fcm_pwa_ios_prompt_dialog_background"
		);
	}

	if (get_option("pnfpb-pwa-ios-message")) {
		$pnfpb_pwa_ios_message_custom_prompt = get_option(
			"pnfpb-pwa-ios-message"
		);
	} else {
		$pnfpb_pwa_ios_message_custom_prompt = esc_html(
			__(
				"For IOS and IPAD browsers, Install PWA using add to home screen in ios safari browser or add to dock option in macos safari browser",
				"push-notification-for-post-and-buddypress"
			)
		);
	}				

	$pnfpb_pwa_prompt_ios_prompt_text_color = "#ffffff";

	if (
		get_option(
			"pnfpb_ic_fcm_pwa_ios_prompt_text_color"
		)
	) {
		$pnfpb_pwa_prompt_ios_prompt_text_color = get_option(
			"pnfpb_ic_fcm_pwa_ios_prompt_text_color"
		);
	}					

	echo '<div class="pnfpb-pwa-dialog-ios-container" id="pnfpb-pwa-dialog-ios-container" 
									style="background-color:' .
		esc_attr($pnfpb_pwa_prompt_ios_prompt_background) .
		'">
							<div class="pnfpb-pwa-dialog-ios-box">
								<div class="pnfpb-pwa-dialog-ios-title pnfpb-notice" 
									style="color:' .
		esc_attr($pnfpb_pwa_prompt_ios_prompt_text_color) .
		';">
									<img class="pnfpb-apple-share-icon" src="' .
		esc_url(plugin_dir_url(__DIR__)."/img/pnfpb-apple-share-icon-50px.png") .
		'" 
										alt="PNFPB Install PWA using share icon" 
										width="50px" height="50px">
									<p>' .
		esc_html($pnfpb_pwa_ios_message_custom_prompt) .
		'</p>
									<button type="button" id="pnfpb-pwa-dialog-ios-cancel" class="pnfpb-notice-dismiss">
										<span class="pnfpb-screen-reader-text">Dismiss this notice.</span>
									</button>
								</div>
							</div>
					</div>';			

	if (
		get_option("pnfpb_onesignal_push") !== "1" &&
		get_option("pnfpb_progressier_push") !== "1"
	) {
		if (
			get_option("pnfpb_ic_fcm_push_prompt_text") &&
			get_option("pnfpb_ic_fcm_push_prompt_text") != ""
		) {
			$pnfpb_push_prompt_text = get_option(
				"pnfpb_ic_fcm_push_prompt_text"
			);
		} else {
			$pnfpb_push_prompt_text = esc_html(
				__(
					"Would you like to subscribe to our notifications?",
					"push-notification-for-post-and-buddypress"
				)
			);
		}
		if (
			get_option("pnfpb_ic_fcm_push_prompt_confirm_button") &&
			get_option("pnfpb_ic_fcm_push_prompt_confirm_button") != ""
		) {
			$pnfpb_push_prompt_confirm_button_text = get_option(
				"pnfpb_ic_fcm_push_prompt_confirm_button"
			);
		} else {
			$pnfpb_push_prompt_confirm_button_text = esc_html(
				__("Yes", "push-notification-for-post-and-buddypress")
			);
		}
		if (
			get_option("pnfpb_ic_fcm_push_prompt_cancel_button") &&
			get_option("pnfpb_ic_fcm_push_prompt_cancel_button") != ""
		) {
			$pnfpb_push_prompt_cancel_button_text = get_option(
				"pnfpb_ic_fcm_push_prompt_cancel_button"
			);
		} else {
			$pnfpb_push_prompt_cancel_button_text = esc_html(
				__("No", "push-notification-for-post-and-buddypress")
			);
		}
		if (
			get_option("pnfpb_ic_fcm_push_prompt_button_background") &&
			get_option("pnfpb_ic_fcm_push_prompt_button_background") !=
			""
		) {
			$pnfpb_push_prompt_button_background = get_option(
				"pnfpb_ic_fcm_push_prompt_button_background"
			);
		} else {
			$pnfpb_push_prompt_button_background = "#121240";
		}
		if (
			get_option("pnfpb_ic_fcm_push_prompt_dialog_background") &&
			get_option("pnfpb_ic_fcm_push_prompt_dialog_background") !=
			""
		) {
			$pnfpb_push_prompt_dialog_background = get_option(
				"pnfpb_ic_fcm_push_prompt_dialog_background"
			);
		} else {
			$pnfpb_push_prompt_dialog_background = "#DAD7D7";
		}
		if (
			get_option("pnfpb_ic_fcm_push_prompt_text_color") &&
			get_option("pnfpb_ic_fcm_push_prompt_text_color") != ""
		) {
			$pnfpb_push_prompt_text_color = get_option(
				"pnfpb_ic_fcm_push_prompt_text_color"
			);
		} else {
			$pnfpb_push_prompt_text_color = "#161515";
		}
		if (
			get_option("pnfpb_ic_fcm_push_prompt_button_text_color") &&
			get_option("pnfpb_ic_fcm_push_prompt_button_text_color") !=
			""
		) {
			$pnfpb_push_prompt_button_text_color = get_option(
				"pnfpb_ic_fcm_push_prompt_button_text_color"
			);
		} else {
			$pnfpb_push_prompt_button_text_color = "#ffffff";
		}
		if (
			get_option("pnfpb_ic_fcm_push_prompt_position") &&
			get_option("pnfpb_ic_fcm_push_prompt_position") != ""
		) {
			$pnfpb_push_prompt_position = get_option(
				"pnfpb_ic_fcm_push_prompt_position"
			);
		} else {
			$pnfpb_push_prompt_position = esc_html(
				__(
					"pnfpb-top-left",
					"push-notification-for-post-and-buddypress"
				)
			);
		}

		if (
			get_option("pnfpb_ic_fcm_pwa_prompt_text") &&
			get_option("pnfpb_ic_fcm_pwa_prompt_text") != ""
		) {
			$pnfpb_pwa_prompt_text = get_option(
				"pnfpb_ic_fcm_pwa_prompt_text"
			);
		} else {
			$pnfpb_pwa_prompt_text = esc_html(
				__(
					"Would you like to install our app?",
					"push-notification-for-post-and-buddypress"
				)
			);
		}
		if (
			get_option("pnfpb_ic_fcm_pwa_prompt_confirm_button") &&
			get_option("pnfpb_ic_fcm_pwa_prompt_confirm_button") != ""
		) {
			$pnfpb_pwa_prompt_confirm_button_text = get_option(
				"pnfpb_ic_fcm_pwa_prompt_confirm_button"
			);
		} else {
			$pnfpb_pwa_prompt_confirm_button_text = esc_html(
				__(
					"Install",
					"push-notification-for-post-and-buddypress"
				)
			);
		}
		if (
			get_option("pnfpb_ic_fcm_pwa_prompt_cancel_button") &&
			get_option("pnfpb_ic_fcm_pwa_prompt_cancel_button") != ""
		) {
			$pnfpb_pwa_prompt_cancel_button_text = get_option(
				"pnfpb_ic_fcm_pwa_prompt_cancel_button"
			);
		} else {
			$pnfpb_pwa_prompt_cancel_button_text = esc_html(
				__(
					"Cancel",
					"push-notification-for-post-and-buddypress"
				)
			);
		}
		if (
			get_option("pnfpb_ic_fcm_pwa_prompt_button_background") &&
			get_option("pnfpb_ic_fcm_pwa_prompt_button_background") !=
			""
		) {
			$pnfpb_pwa_prompt_button_background = get_option(
				"pnfpb_ic_fcm_pwa_prompt_button_background"
			);
		} else {
			$pnfpb_pwa_prompt_button_background = "#121240";
		}
		if (
			get_option("pnfpb_ic_fcm_pwa_prompt_dialog_background") &&
			get_option("pnfpb_ic_fcm_pwa_prompt_dialog_background") !=
			""
		) {
			$pnfpb_pwa_prompt_dialog_background = get_option(
				"pnfpb_ic_fcm_pwa_prompt_dialog_background"
			);
		} else {
			$pnfpb_pwa_prompt_dialog_background = "#DAD7D7";
		}
		if (
			get_option("pnfpb_ic_fcm_pwa_prompt_text_color") &&
			get_option("pnfpb_ic_fcm_pwa_prompt_text_color") != ""
		) {
			$pnfpb_pwa_prompt_text_color = get_option(
				"pnfpb_ic_fcm_pwa_prompt_text_color"
			);
		} else {
			$pnfpb_pwa_prompt_text_color = "#161515";
		}
		if (
			get_option("pnfpb_ic_fcm_pwa_prompt_button_text_color") &&
			get_option("pnfpb_ic_fcm_pwa_prompt_button_text_color") !=
			""
		) {
			$pnfpb_pwa_prompt_button_text_color = get_option(
				"pnfpb_ic_fcm_pwa_prompt_button_text_color"
			);
		} else {
			$pnfpb_pwa_prompt_button_text_color = "#ffffff";
		}
		$pnfpb_popup_subscribe_icon = "";
		if (get_option("pnfpb_ic_fcm_popup_subscribe_button_icon")) {
			$pnfpb_popup_subscribe_icon = get_option(
				"pnfpb_ic_fcm_popup_subscribe_button_icon"
			);
		} else {
			$pnfpb_popup_subscribe_icon =
				plugin_dir_url(__DIR__) .
				"public/img/pushbell-pnfpb.png";
		}

		if (
			get_option("pnfpb_ic_fcm_push_prompt_enable") === "1" &&
			(!get_option("pnfpb_ic_fcm_loggedin_notify") ||
			 (get_option("pnfpb_ic_fcm_loggedin_notify") &&
			  get_option("pnfpb_ic_fcm_loggedin_notify") ===
			  "1" &&
			  is_user_logged_in()) ||
			 (get_option("pnfpb_ic_fcm_loggedin_notify") &&
			  get_option("pnfpb_ic_fcm_loggedin_notify") !== "1"))
		) {
			echo '<button type="button" id="pnfpb-push-subscribe-icon" class="pnfpb-push-subscribe-icon"><img src="' .
				esc_url($pnfpb_popup_subscribe_icon) .
				'" width="32px" height="32px"/></button>';

			$pnfpb_ic_fcm_popup_header_text = esc_html(
				__(
					"Manage Push Notifications",
					"push-notification-for-post-and-buddypress"
				)
			);

			if (get_option("pnfpb_ic_fcm_popup_header_text")) {
				$pnfpb_ic_fcm_popup_header_text = get_option(
					"pnfpb_ic_fcm_popup_header_text"
				);
			}

			$pnfpb_ic_fcm_popup_subscribe_button_color = "#E54B4D";

			if (
				get_option("pnfpb_ic_fcm_popup_subscribe_button_color")
			) {
				$pnfpb_ic_fcm_popup_subscribe_button_color = get_option(
					"pnfpb_ic_fcm_popup_subscribe_button_color"
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
					"pnfpb_ic_fcm_popup_subscribe_options_button_text_color"
				)
			) {
				$pnfpb_ic_fcm_popup_subscribe_options_button_text_color = get_option(
					"pnfpb_ic_fcm_popup_subscribe_options_button_text_color"
				);
			}

			$pnfpb_ic_fcm_popup_subscribe_options_button_text =
				"Update";

			if (
				get_option(
					"pnfpb_ic_fcm_popup_subscribe_options_button_text_color"
				)
			) {
				$pnfpb_ic_fcm_popup_subscribe_options_button_text = get_option(
					"pnfpb_ic_fcm_popup_subscribe_options_button_text"
				);
			}

			$pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon =
				"#FFFFFF";

			if (
				get_option(
					"pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon"
				)
			) {
				$pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon = get_option(
					"pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon"
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
					"pnfpb_ic_fcm_custom_prompt_header_text"
				);
			}

			if (get_option("pnfpb_ic_fcm_custom_prompt_header_text_line_2")) {
				$pnfpb_ic_fcm_custom_prompt_header_text_line_2 = get_option(
					"pnfpb_ic_fcm_custom_prompt_header_text_line_2"
				);
			}					

			$pnfpb_ic_fcm_custom_prompt_allow_button_text = esc_html(
				__("Allow", "push-notification-for-post-and-buddypress")
			);

			if (
				get_option(
					"pnfpb_ic_fcm_custom_prompt_allow_button_text"
				)
			) {
				$pnfpb_ic_fcm_custom_prompt_allow_button_text = get_option(
					"pnfpb_ic_fcm_custom_prompt_allow_button_text"
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
					"pnfpb_ic_fcm_custom_prompt_cancel_button_text"
				)
			) {
				$pnfpb_ic_fcm_custom_prompt_cancel_button_text = get_option(
					"pnfpb_ic_fcm_custom_prompt_cancel_button_text"
				);
			}

			$pnfpb_ic_fcm_custom_prompt_close_button_text = esc_html(
				__("Close", "push-notification-for-post-and-buddypress")
			);

			if (
				get_option(
					"pnfpb_ic_fcm_custom_prompt_close_button_text"
				)
			) {
				$pnfpb_ic_fcm_custom_prompt_close_button_text = get_option(
					"pnfpb_ic_fcm_custom_prompt_close_button_text"
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
					"pnfpb_ic_fcm_custom_prompt_popup_wait_message"
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
					"pnfpb_ic_fcm_custom_prompt_subscribed_text"
				);
			}

			$pnfpb_ic_fcm_custom_prompt_animation = "slideDown";

			if (get_option("pnfpb_ic_fcm_custom_prompt_animation")) {
				$pnfpb_ic_fcm_custom_prompt_animation = get_option(
					"pnfpb_ic_fcm_custom_prompt_animation"
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
					"pnfpb_bell_icon_subscription_option_update_text"
				)
			) {
				$pnfpb_bell_icon_subscription_option_update_text = get_option(
					"pnfpb_bell_icon_subscription_option_update_text"
				);
			}

			$pnfpb_bell_icon_subscription_option_update_text_color =
				"#000000";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_update_text_color"
				)
			) {
				$pnfpb_bell_icon_subscription_option_update_text_color = get_option(
					"pnfpb_bell_icon_subscription_option_update_text_color"
				);
			}

			$pnfpb_bell_icon_subscription_option_update_background_color =
				"#cccccc";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_update_background_color"
				)
			) {
				$pnfpb_bell_icon_subscription_option_update_background_color = get_option(
					"pnfpb_bell_icon_subscription_option_update_background_color"
				);
			}

			$pnfpb_bell_icon_subscription_option_list_background_color =
				"#cccccc";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_list_background_color"
				)
			) {
				$pnfpb_bell_icon_subscription_option_list_background_color = get_option(
					"pnfpb_bell_icon_subscription_option_list_background_color"
				);
			}

			$pnfpb_bell_icon_subscription_option_list_text_color =
				"#000000";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_list_text_color"
				)
			) {
				$pnfpb_bell_icon_subscription_option_list_text_color = get_option(
					"pnfpb_bell_icon_subscription_option_list_text_color"
				);
			}

			$pnfpb_bell_icon_subscription_option_list_checkbox_color =
				"#135e96";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_list_checkbox_color"
				)
			) {
				$pnfpb_bell_icon_subscription_option_list_checkbox_color = get_option(
					"pnfpb_bell_icon_subscription_option_list_checkbox_color"
				);
			}

			$pnfpb_bell_icon_subscription_option_update_confirmation_message =
				"subscription updated";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_update_confirmation_message"
				)
			) {
				$pnfpb_bell_icon_subscription_option_update_confirmation_message = get_option(
					"pnfpb_bell_icon_subscription_option_update_confirmation_message"
				);
			}

			$pnfpb_bell_icon_subscription_option_update_text = "Update";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_update_text"
				)
			) {
				$pnfpb_bell_icon_subscription_option_update_text = get_option(
					"pnfpb_bell_icon_subscription_option_update_text"
				);
			}

			$pnfpb_bell_icon_subscription_option_all_text = "All";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_all_text"
				)
			) {
				$pnfpb_bell_icon_subscription_option_all_text = get_option(
					"pnfpb_bell_icon_subscription_option_all_text"
				);
			}

			$pnfpb_bell_icon_subscription_option_post_text = "Post";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_post_text"
				)
			) {
				$pnfpb_bell_icon_subscription_option_post_text = get_option(
					"pnfpb_bell_icon_subscription_option_post_text"
				);
			}

			$pnfpb_bell_icon_subscription_option_activity_text =
				"Activity";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_activity_text"
				)
			) {
				$pnfpb_bell_icon_subscription_option_activity_text = get_option(
					"pnfpb_bell_icon_subscription_option_activity_text"
				);
			}

			$pnfpb_bell_icon_subscription_option_all_comments_text =
				"All comments";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_all_comments_text"
				)
			) {
				$pnfpb_bell_icon_subscription_option_all_comments_text = get_option(
					"pnfpb_bell_icon_subscription_option_all_comments_text"
				);
			}

			$pnfpb_bell_icon_subscription_option_my_comments_text =
				"My comments";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_my_comments_text"
				)
			) {
				$pnfpb_bell_icon_subscription_option_my_comments_text = get_option(
					"pnfpb_bell_icon_subscription_option_my_comments_text"
				);
			}

			$pnfpb_bell_icon_subscription_option_private_message_text =
				"Private Message";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_private_messsage_text"
				)
			) {
				$pnfpb_bell_icon_subscription_option_private_message_text = get_option(
					"pnfpb_bell_icon_subscription_option_private_message_text"
				);
			}

			$pnfpb_bell_icon_subscription_option_new_member_joined_text =
				"New member joined";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_new_member_joined_text"
				)
			) {
				$pnfpb_bell_icon_subscription_option_new_member_joined_text = get_option(
					"pnfpb_bell_icon_subscription_option_new_member_joined_text"
				);
			}

			$pnfpb_bell_icon_subscription_option_friendship_request_text =
				"Friendship request";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_friendship_request_text"
				)
			) {
				$pnfpb_bell_icon_subscription_option_friendship_request_text = get_option(
					"pnfpb_bell_icon_subscription_option_friendship_request_text"
				);
			}

			$pnfpb_bell_icon_subscription_option_friendship_accepted_text =
				"Friendship accepted";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_friendship_accepted_text"
				)
			) {
				$pnfpb_bell_icon_subscription_option_friendship_accepted_text = get_option(
					"pnfpb_bell_icon_subscription_option_friendship_accepted_text"
				);
			}

			$pnfpb_bell_icon_subscription_option_favourite_text =
				"Likes/Favourites";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_favourite_text"
				)
			) {
				$pnfpb_bell_icon_subscription_option_favourite_text = get_option(
					"pnfpb_bell_icon_subscription_option_favourite_text"
				);
			}					

			$pnfpb_bell_icon_subscription_option_avatar_change_text =
				"Avatar change";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_avatar_change_text"
				)
			) {
				$pnfpb_bell_icon_subscription_option_avatar_change_text = get_option(
					"pnfpb_bell_icon_subscription_option_avatar_change_text"
				);
			}

			$pnfpb_bell_icon_subscription_option_cover_image_change_text =
				"Cover image change";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_cover_image_change_text"
				)
			) {
				$pnfpb_bell_icon_subscription_option_cover_image_change_text = get_option(
					"pnfpb_bell_icon_subscription_option_cover_image_change_text"
				);
			}

			$pnfpb_bell_icon_subscription_option_group_details_update_text =
				"Group details update";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_group_details_update_text"
				)
			) {
				$pnfpb_bell_icon_subscription_option_group_details_update_text = get_option(
					"pnfpb_bell_icon_subscription_option_group_details_update_text"
				);
			}

			$pnfpb_bell_icon_subscription_option_group_invite_text =
				"Group invite";

			if (
				get_option(
					"pnfpb_bell_icon_subscription_option_group_invite_text"
				)
			) {
				$pnfpb_bell_icon_subscription_option_group_invite_text = get_option(
					"pnfpb_bell_icon_subscription_option_group_invite_text"
				);
			}

			$pnfpb_custom_prompt_options_on_off = "0";

			if (get_option("pnfpb_custom_prompt_options_on_off")) {
				$pnfpb_custom_prompt_options_on_off = get_option(
					"pnfpb_custom_prompt_options_on_off"
				);
			}

			$pnfpb_bell_icon_prompt_options_on_off = "1";

			if (
				get_option(
					"pnfpb_bell_icon_prompt_options_on_off",
					"0"
				) != "0"
			) {
				$pnfpb_bell_icon_prompt_options_on_off = get_option(
					"pnfpb_bell_icon_prompt_options_on_off"
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
												for="' .esc_html("pnfpb_bell_icon_subscription_".$post_type."_enable") .
							'">' .
							esc_html(
							$pnfpb_ic_fcm_bell_subscription_default_label
						) .
							'	
											</label>
											<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
												<input id="' .
							esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
							'" class="' .
							esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
							'" name="' .
							esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
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
							esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
							'">' .
							esc_html(
							$pnfpb_ic_fcm_bell_subscription_default_label
						) .'
												</label>
												<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
													<input id="' .
							esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
							'" class="' .
							esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
							'" name="' .
							esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
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
				$posttypecount++;
				if ($posttypecount >= 10) {

					break;
				}						
			}

			if (get_option("pnfpb_ic_fcm_post_enable") === "1") {
				$post_type = "post";

				$pnfpb_html_subscription_post_options .=
					'<div class="pnfpb_card">				
									<label class="pnfpb_ic_push_settings_table_label_checkbox 
										pnfpb_flex_grow_6 pnfpb_max_width_236" 
										for="' .
					esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
					'">' .
					esc_html(
					$pnfpb_bell_icon_subscription_option_post_text
				) .
					'
									</label>
									<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
										<input id="' .
					esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
					'" class="' .
					esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
					'" name="'.
					esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
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
					esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
					'">' .
					esc_html(
					$pnfpb_bell_icon_subscription_option_post_text
				) .
					'
									</label>
									<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
										<input id="' .
					esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
					'" class="'.
					esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
					'" name="' .
					esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
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
					esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
					'		">' .
					esc_html(
					$pnfpb_bell_icon_subscription_option_activity_text
				) .'
									</label>
									<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
										<input id="' .
					esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
					'" class="' .
					esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
					'" name="' .
					esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
					'" pnfpb_index="11" type="checkbox" value="1"
										/> 
										<span class="pnfpb_slider round"></span>
									</label>
								</div>';

				$pnfpb_html_bellicon_subscription_activity_options .=
					'<div class="pnfpb_card">				
									<label class="pnfpb_ic_push_settings_table_label_checkbox 
										pnfpb_flex_grow_6 pnfpb_max_width_236" 
										for="' .esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
					'">' .
					esc_html($pnfpb_bell_icon_subscription_option_activity_text) .'
									</label>
									<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
										<input id="' .
					esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
					'" class="' .
					esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
					'" name="' .
					esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
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
					esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
					'">' .
					esc_html(
					$pnfpb_bell_icon_subscription_option_favourite_text
				) .
					'
									</label>
									<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
										<input id="' .
					esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
					'" class="' .
					esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
					'" name="'.
					esc_attr("pnfpb_bell_icon_subscription_".$post_type."_enable") .
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
					esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
					'">' .
					esc_html(
					$pnfpb_bell_icon_subscription_option_favourite_text
				) .
					'
									</label>
									<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
										<input id="' .
					esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
					'" class="'.
					esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
					'" name="' .
					esc_attr("pnfpb_bell_icon_prompt_subscription_".$post_type."_enable") .
					'"  pnfpb_index="1" type="checkbox" value="1"
										/> 
										<span class="pnfpb_slider round"></span>
									</label>
								</div>';
			}					

			$pnfpb_html_subscription_options = "";

			$pnfpb_html_subscription_options_header = "";

			$pnfpb_html_subscription_options_header =
				'<div class="pnfpb_bell_icon_subscription_options_container" 
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
									for="pnfpb_bell_icon_subscription_all_enable">' .
				esc_html(
				$pnfpb_bell_icon_subscription_option_all_text
			) .'
								</label>
								<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
									<input id="pnfpb_bell_icon_subscription_all_enable" 
										class="pnfpb_bell_icon_subscription_all_enable" 
										name="pnfpb_bell_icon_subscription_all_enable" 
										type="checkbox" pnfpb_index="0" value="1"
									> 
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

			$pnfpb_push_type_index = 0;

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
					$push_type !== "activity" &&
					$push_type !== "unsubscribe-all" &&
					$push_type !== "buddypress" &&
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
							"_text"
						)
					) {
						$pnfpb_ic_fcm_bell_subscription_default_label = get_option(
							"pnfpb_bell_icon_subscription_option_" .
							$push_type .
							"_text"
						);
					}

					$pnfpb_html_subscription_push_type_options .=
						'<div class="pnfpb_card">				
										<label class="pnfpb_ic_push_settings_table_label_checkbox 
												pnfpb_flex_grow_6 pnfpb_max_width_236" 
												for="'.esc_attr("pnfpb_bell_icon_subscription_".$push_type."_enable") .'">' .
						esc_html(
						$pnfpb_ic_fcm_bell_subscription_default_label
					) .'
										</label>
										<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
											<input id="' .
						esc_attr("pnfpb_bell_icon_subscription_".$push_type."_enable") .
						'" class="' .
						esc_attr("pnfpb_bell_icon_subscription_".$push_type."_enable") .
						'" name="' .
						esc_attr("pnfpb_bell_icon_subscription_".$push_type."_enable") .
						'" pnfpb_index="' .
						esc_attr($pnfpb_push_type_index) .
						'" type="checkbox" value="1"
											/> 
											<span class="pnfpb_slider round"></span>
										</label>
									</div>';
				}

				$pnfpb_push_admin_type_count++;
				$pnfpb_push_type_index++;
			}

			$pnfpb_html_subscription_footer_options =
				'<button type="button" class="pnfpb-push-subscribe-options-button" 
										id="pnfpb-push-subscribe-options-button" 
										style="background:' .
				esc_attr(
				$pnfpb_bell_icon_subscription_option_update_background_color
			) .
				";color:" .
				esc_attr(
				$pnfpb_bell_icon_subscription_option_update_text_color
			) .
				';">
											' .
				esc_html(
				$pnfpb_bell_icon_subscription_option_update_text
			) .
				"</button>";

			$pnfpb_html_bellicon_subscription_options = "";

			$pnfpb_html_bellicon_subscription_push_type_options = "";

			$pnfpb_html_bellicon_subscription_options_header = "";

			$pnfpb_html_bellicon_subscription_options_header =
				'<div class="pnfpb_bell_icon_prompt_subscription_options_container" 
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
												for="pnfpb_bell_icon_subscription_all_enable">
												' .
				esc_html(
				$pnfpb_bell_icon_subscription_option_all_text
			) .
				'
											</label>
											<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
												<input id="pnfpb_bell_icon_prompt_subscription_all_enable" class="pnfpb_bell_icon_prompt_subscription_all_enable" name="pnfpb_bell_icon_prompt_subscription_all_enable" type="checkbox" pnfpb_index="0" value="1"> 
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
							"_text"
						)
					) {
						$pnfpb_ic_fcm_bell_subscription_default_label = get_option(
							"pnfpb_bell_icon_subscription_option_" .
							$push_type .
							"_text"
						);
					}

					$pnfpb_html_bellicon_subscription_push_type_options .=
						'<div class="pnfpb_card">				
									<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_max_width_236" 
										for="' .
						esc_attr("pnfpb_bell_icon_prompt_subscription_".$push_type."_enable") .
						'">' .
						esc_html(
						$pnfpb_ic_fcm_bell_subscription_default_label
					) .
						'
									</label>
									<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_max_width_40">
										<input id="' .
						esc_attr("pnfpb_bell_icon_prompt_subscription_".$push_type."_enable") .
						'" class="' .
						esc_attr("pnfpb_bell_icon_prompt_subscription_".$push_type."_enable") .
						'" name="' .
						esc_attr("pnfpb_bell_icon_prompt_subscription_".$push_type."_enable") .
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
									<button type="button" class="pnfpb-push-subscribe-options-button" 
											id="pnfpb-push-subscribe-options-button" 
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

			$pnfpb_html_subscription_options = "";

			if ($pnfpb_custom_prompt_options_on_off === "1") {
				$pnfpb_html_subscription_options =
					$pnfpb_html_subscription_options_header .
					$pnfpb_html_subscription_post_options .
					$pnfpb_html_subscription_custom_post_options .
					$pnfpb_html_subscription_activity_options .
					$pnfpb_html_subscription_push_type_options .
					$pnfpb_html_subscription_favourite_options .
					"</div>" .
					$pnfpb_html_subscription_footer_options;
			}

			$pnfpb_html_bellicon_subscription_options = "";

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
			}

			echo '<div id="pnfpb-push-subscribe-button-layout" class="pnfpb-push-subscribe-button-layout">
								<p class="pnfpb-bell-icon-header">' .
				esc_html($pnfpb_ic_fcm_popup_header_text) .
				'</p>
								<div class="pnfpb_bell_icon_custom_prompt_loader" id="pnfpb_bell_icon_custom_prompt_loader"></div>
								<div id="pnfpb-push-subscribe-options-button-container" class="pnfpb-push-subscribe-options-button-container">
									' .
				wp_kses(
				$pnfpb_html_bellicon_subscription_options,
				$allowed_html
			) .
				'							
								</div>					
								<div class="pnfpb-push-msg-container">
									<div class="pnfpb-push-icon"><img src="' .
				esc_url($pnfpb_popup_subscribe_icon) .
				'" /></div>
									<div class="pnfpb-push-msg-text-layout">
										<div class="pnfpb-push-msg-text-line"></div>
										<div class="pnfpb-push-msg-text-long-line"></div>
										<div class="pnfpb-push-msg-text-line"></div>
										<div class="pnfpb-push-msg-text-long-line"></div>
										<div class="pnfpb-push-msg-text-line"></div>
									</div>
									<div class="pnfpb-flex-break"></div>
									<div id="pnfpb-push-status-text" class="pnfpb-push-status-text"></div>
								</div>						
								<div id="pnfpb-push-subscribe-button-container" class="pnfpb-push-subscribe-button-container">
									<button type="button" class="pnfpb-push-subscribe-button" 
										id="pnfpb-push-subscribe-button" 
										style="background:' .
				esc_attr($pnfpb_ic_fcm_popup_subscribe_button_color) .
				";color:" .
				esc_attr(
				$pnfpb_ic_fcm_popup_subscribe_button_text_color
			) .
				';">
									</button>
								</div>
							</div>';

			echo '<div id="pnfpb-popup-customprompt-container" class="pnfpb-popup-customprompt-container">
								<div id="' .
				esc_attr("pnfpb-popup-customprompt-container-dialog-".$pnfpb_ic_fcm_custom_prompt_animation) .
				'" class="' .
				esc_attr("pnfpb-popup-customprompt-container-dialog-".$pnfpb_ic_fcm_custom_prompt_animation) .
				'">
								<div id="pnfpb-popup-customprompt-transistion" class="pnfpb-popup-customprompt-transistion">
									<div class="pnfpb-popup-customprompt-transistion-body" id="pnfpb-popup-customprompt-transistion-body">
										<div class="pnfpb-popup-customprompt-transistion-body-icon">
											<img alt="notification icon" src="' .
				esc_url(
				$pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon
			) .
				'">
										</div>';

			if ($pnfpb_ic_fcm_custom_prompt_header_text_line_2 !== '') {
				echo '<div class="pnfpb-popup-customprompt-transistion-body-line-1 pnfpb-popup-customprompt-transistion-body-message">' .
					esc_html($pnfpb_ic_fcm_custom_prompt_header_text) .
					'</div> <div class="pnfpb-popup-customprompt-transistion-body-line-2 pnfpb-popup-customprompt-transistion-body-message">' .
					esc_html($pnfpb_ic_fcm_custom_prompt_header_text_line_2) .
					'</div>';
			} else {
				echo '<div class="pnfpb-popup-customprompt-transistion-body-message">' .
					esc_html($pnfpb_ic_fcm_custom_prompt_header_text) .
					'</div>';
			}

			echo wp_kses($pnfpb_html_subscription_options,$allowed_html) .
				'								
										<div class="clearfix"></div>
										<div id="pnfpb-loading-container"></div>
									</div>
									<div class="pnfpb-popup-customprompt-transistion-footer" id="pnfpb-popup-customprompt-transistion-footer">
										<button class="pnfpb-popup-customprompt-transistion-allow-button" id="pnfpb-popup-customprompt-transistion-allow-button">' .
				esc_html(
				$pnfpb_ic_fcm_custom_prompt_allow_button_text
			) .
				'</button>
										<button class="pnfpb-popup-customprompt-transistion-cancel-button" id="pnfpb-popup-customprompt-transistion-cancel-button">' .
				esc_html(
				$pnfpb_ic_fcm_custom_prompt_cancel_button_text
			) .
				'</button>
										<div class="pnfpb_custom_prompt_loader" id="pnfpb_custom_prompt_loader"></div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div id="pnfpb-popup-customprompt-transistion-confirmation" class="pnfpb-popup-customprompt-transistion-confirmation">
									<div class="pnfpb-popup-customprompt-transistion-body" id="pnfpb-popup-customprompt-transistion-body">
										<div class="pnfpb-popup-customprompt-transistion-body-icon">
											<img alt="notification icon" src="' .
				esc_url(
				$pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon
			) .
				'">
										</div>
										<div class="pnfpb-popup-customprompt-transistion-body-message">' .
				esc_html($pnfpb_ic_fcm_custom_prompt_subscribed_text) .
				'</div>
										<div class="clearfix"></div>
										<div id="pnfpb-loading-container"></div>
									</div>
									<div class="pnfpb-popup-customprompt-transistion-footer" id="pnfpb-popup-customprompt-transistion-footer">
										<button class="pnfpb-popup-customprompt-transistion-close-button" id="pnfpb-popup-customprompt-transistion-close-button">' .
				esc_html(
				$pnfpb_ic_fcm_custom_prompt_close_button_text
			) .
				'</button>
										<div class="clearfix"></div>
									</div>
								</div>							
							</div>
						</div>';

			echo '<div id="pnfpb-popup-customprompt-vertical-container" class="pnfpb-popup-customprompt-vertical-container">
								<div id="pnfpb-popup-customprompt-vertical-container-dialog-' .
				esc_attr($pnfpb_ic_fcm_custom_prompt_animation) .
				'" class="pnfpb-popup-customprompt-vertical-container-dialog-' .
				esc_attr($pnfpb_ic_fcm_custom_prompt_animation) .
				'">
									<div id="pnfpb-popup-customprompt-vertical-transistion" class="pnfpb-popup-customprompt-vertical-transistion">
										<div class="pnfpb-popup-customprompt-vertical-transistion-body" id="pnfpb-popup-customprompt-vertical-transistion-body">
											<div class="pnfpb-popup-customprompt-vertical-transistion-body-icon">
												<img alt="notification icon" src="' .
				esc_url(
				$pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon
			) .
				'">
										</div>';
			if ($pnfpb_ic_fcm_custom_prompt_header_text_line_2 !== '') {
				echo '<div class="pnfpb-popup-customprompt-vertical-transistion-body-line-1 pnfpb-popup-customprompt-vertical-transistion-body-message">' .
					esc_html($pnfpb_ic_fcm_custom_prompt_header_text) .
					'</div> <div class="pnfpb-popup-customprompt-vertical-transistion-body-line-2 pnfpb-popup-customprompt-vertical-transistion-body-message">' .
					esc_html($pnfpb_ic_fcm_custom_prompt_header_text_line_2) .
					'</div>';
			} else {
				echo '<div class="pnfpb-popup-customprompt-vertical-transistion-body-message">' .
					esc_html($pnfpb_ic_fcm_custom_prompt_header_text) .
					'</div>';
			}					
			echo wp_kses($pnfpb_html_subscription_options,$allowed_html) .
				'	
										<div class="clearfix"></div>
										<div id="pnfpb-loading-container"></div>
									</div>
									<div class="pnfpb-popup-customprompt-vertical-transistion-footer" id="pnfpb-popup-customprompt-vertical-transistion-footer">
										<button class="pnfpb-popup-customprompt-vertical-transistion-allow-button" 
												id="pnfpb-popup-customprompt-vertical-transistion-allow-button">' .
				esc_html(
				$pnfpb_ic_fcm_custom_prompt_allow_button_text
			) .
				'</button>
										<button class="pnfpb-popup-customprompt-vertical-transistion-cancel-button" 
												id="pnfpb-popup-customprompt-vertical-transistion-cancel-button">' .
				esc_html(
				$pnfpb_ic_fcm_custom_prompt_cancel_button_text
			) .
				'</button>
										<div class="pnfpb_custom_prompt_loader" id="pnfpb_custom_prompt_loader"></div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div id="pnfpb-popup-customprompt-vertical-transistion-confirmation" class="pnfpb-popup-customprompt-vertical-transistion-confirmation">
									<div class="pnfpb-popup-customprompt-vertical-transistion-body" id="pnfpb-popup-customprompt-vertical-transistion-body">
										<div class="pnfpb-popup-customprompt-vertical-transistion-body-icon">
											<img alt="notification icon" src="' .
				esc_url(
				$pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon
			) .
				'">
										</div>
										<div class="pnfpb-popup-customprompt-vertical-transistion-body-message">' .
				esc_html($pnfpb_ic_fcm_custom_prompt_subscribed_text) .
				'</div>
										<div class="clearfix"></div>
										<div id="pnfpb-loading-container"></div>
									</div>
									<div class="pnfpb-popup-customprompt-vertical-transistion-footer" id="pnfpb-popup-customprompt-vertical-transistion-footer">
										<button class="pnfpb-popup-customprompt-vertical-transistion-close-button" 
												id="pnfpb-popup-customprompt-vertical-transistion-close-button">' .
				esc_html(
				$pnfpb_ic_fcm_custom_prompt_close_button_text
			) .
				'</button>
										<div class="clearfix"></div>
									</div>
								</div>							
							</div>
						</div>';
		}

		if (
			get_option("pnfpb_ic_pwa_app_enable") === "1" &&
			(get_option("pnfpb_ic_pwa_app_custom_prompt_enable") ===
			 "1" ||
			 get_option(
				 "pnfpb_ic_pwa_app_desktop_custom_prompt_enable"
			 ) === "1" ||
			 get_option(
				 "pnfpb_ic_pwa_app_mobile_custom_prompt_enable"
			 ) === "1" ||
			 get_option(
				 "pnfpb_ic_pwa_app_pixels_custom_prompt_enable"
			 ) === "1") &&
			get_option(
				"pnfpb_ic_disable_serviceworker_pwa_pushnotification"
			) != "1"
		) {

			echo '<div class="pnfpb-pwa-dialog-container" id="pnfpb-pwa-dialog-container">
							<div class="pnfpb-pwa-dialog-box" style="background-color:' .
				esc_attr($pnfpb_pwa_prompt_dialog_background) .
				'">
								<div class="pnfpb-pwa-dialog-title" style="color:' .
				esc_attr($pnfpb_pwa_prompt_text_color) .
				';">' .
				esc_html($pnfpb_pwa_prompt_text) .
				'</div>
								<div class="pnfpb-pwa-dialog-buttons">
									<button id="pnfpb-pwa-dialog-cancel" type="button" class="button secondary" 
											style="color:' .
				esc_attr($pnfpb_pwa_prompt_button_text_color) .
				";background-color:" .
				esc_attr($pnfpb_pwa_prompt_button_background) .
				';">' .
				esc_html($pnfpb_pwa_prompt_cancel_button_text) .
				'</button>
									<button id="pnfpb-pwa-dialog-subscribe" type="button" class="button primary" 
										style="color:' .
				esc_attr($pnfpb_pwa_prompt_button_text_color) .
				";background-color:" .
				esc_attr($pnfpb_pwa_prompt_button_background) .
				';">' .
				esc_html($pnfpb_pwa_prompt_confirm_button_text) .
				'</button>
								</div>
							</div>
					</div>';

			$pnfpb_ic_fcm_custom_prompt_close_button_text = esc_html(
				__("Close", "push-notification-for-post-and-buddypress")
			);

			if (
				get_option(
					"pnfpb_ic_fcm_custom_prompt_close_button_text"
				)
			) {
				$pnfpb_ic_fcm_custom_prompt_close_button_text = get_option(
					"pnfpb_ic_fcm_custom_prompt_close_button_text"
				);
			}

	?>

	<div id="pnfpb-pwa-dialog-app-installed" class="pnfpb-pwa-dialog-app-installed" 
		 title="<?php if (
				get_option("pnfpb-pwa-dialog-app-installed_text", false)
			) {
				echo esc_attr(get_option("pnfpb-pwa-dialog-app-installed_text"));
			} else {
				echo esc_attr(
					__(
						"App installed successfully",
						"push-notification-for-post-and-buddypress"
					)
				);
			} ?>"
		 >
		<p>
			<span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
			<?php if (
				get_option("pnfpb-pwa-dialog-app-installed_description", false)
			) {
				echo esc_html(
					get_option("pnfpb-pwa-dialog-app-installed_description")
				);
			} else {
				echo esc_html(
					__(
						"Progressive Web App (PWA) is installed successfully.",
						"push-notification-for-post-and-buddypress"
					)
				);
			} ?>
		</p>
	</div>

	<div id="pnfpb-push-notification-blocked" class="pnfpb-push-notification-blocked" 
		 title="<?php echo esc_attr(
				__(
					"Push notification permission",
					"push-notification-for-post-and-buddypress"
				)
			); ?>"
		 >
		<p>
			<span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
			<?php echo esc_html(
				__(
					"Push notification permission blocked in browser settings. Reset the notification settings for website/PWA",
					"push-notification-for-post-and-buddypress"
				)
			); ?>
		</p>
	</div>
	<?php
		}
	} else {
		if (
			get_option("pnfpb_ic_fcm_push_prompt_text") &&
			get_option("pnfpb_ic_fcm_push_prompt_text") != ""
		) {
			$pnfpb_push_prompt_text = get_option(
				"pnfpb_ic_fcm_push_prompt_text"
			);
		} else {
			$pnfpb_push_prompt_text = esc_html(
				__(
					"Would you like to subscribe to our notifications?",
					"push-notification-for-post-and-buddypress"
				)
			);
		}

		if (
			get_option("pnfpb_ic_fcm_push_prompt_confirm_button") &&
			get_option("pnfpb_ic_fcm_push_prompt_confirm_button") != ""
		) {
			$pnfpb_push_prompt_confirm_button_text = get_option(
				"pnfpb_ic_fcm_push_prompt_confirm_button"
			);
		} else {
			$pnfpb_push_prompt_confirm_button_text = esc_html(
				__("Yes", "push-notification-for-post-and-buddypress")
			);
		}

		if (
			get_option("pnfpb_ic_fcm_push_prompt_cancel_button") &&
			get_option("pnfpb_ic_fcm_push_prompt_cancel_button") != ""
		) {
			$pnfpb_push_prompt_cancel_button_text = get_option(
				"pnfpb_ic_fcm_push_prompt_cancel_button"
			);
		} else {
			$pnfpb_push_prompt_cancel_button_text = esc_html(
				__("No", "push-notification-for-post-and-buddypress")
			);
		}

		if (
			get_option("pnfpb_ic_fcm_push_prompt_button_background") &&
			get_option("pnfpb_ic_fcm_push_prompt_button_background") !=
			""
		) {
			$pnfpb_push_prompt_button_background = get_option(
				"pnfpb_ic_fcm_push_prompt_button_background"
			);
		} else {
			$pnfpb_push_prompt_button_background = "#121240";
		}

		if (
			get_option("pnfpb_ic_fcm_push_prompt_dialog_background") &&
			get_option("pnfpb_ic_fcm_push_prompt_dialog_background") !=
			""
		) {
			$pnfpb_push_prompt_dialog_background = get_option(
				"pnfpb_ic_fcm_push_prompt_dialog_background"
			);
		} else {
			$pnfpb_push_prompt_dialog_background = "#DAD7D7";
		}

		if (
			get_option("pnfpb_ic_fcm_push_prompt_text_color") &&
			get_option("pnfpb_ic_fcm_push_prompt_text_color") != ""
		) {
			$pnfpb_push_prompt_text_color = get_option(
				"pnfpb_ic_fcm_push_prompt_text_color"
			);
		} else {
			$pnfpb_push_prompt_text_color = "#161515";
		}

		if (
			get_option("pnfpb_ic_fcm_push_prompt_button_text_color") &&
			get_option("pnfpb_ic_fcm_push_prompt_button_text_color") !=
			""
		) {
			$pnfpb_push_prompt_button_text_color = get_option(
				"pnfpb_ic_fcm_push_prompt_button_text_color"
			);
		} else {
			$pnfpb_push_prompt_button_text_color = "#ffffff";
		}

		if (
			get_option("pnfpb_ic_fcm_push_prompt_position") &&
			get_option("pnfpb_ic_fcm_push_prompt_position") != ""
		) {
			$pnfpb_push_prompt_position = get_option(
				"pnfpb_ic_fcm_push_prompt_position"
			);
		} else {
			$pnfpb_push_prompt_position = esc_html(
				__(
					"pnfpb-top-left",
					"push-notification-for-post-and-buddypress"
				)
			);
		}

		if (
			get_option("pnfpb_ic_fcm_pwa_prompt_text") &&
			get_option("pnfpb_ic_fcm_pwa_prompt_text") != ""
		) {
			$pnfpb_pwa_prompt_text = get_option(
				"pnfpb_ic_fcm_pwa_prompt_text"
			);
		} else {
			$pnfpb_pwa_prompt_text = esc_html(
				__(
					"Would you like to install our app?",
					"push-notification-for-post-and-buddypress"
				)
			);
		}

		if (
			get_option("pnfpb_ic_fcm_pwa_prompt_confirm_button") &&
			get_option("pnfpb_ic_fcm_pwa_prompt_confirm_button") != ""
		) {
			$pnfpb_pwa_prompt_confirm_button_text = get_option(
				"pnfpb_ic_fcm_pwa_prompt_confirm_button"
			);
		} else {
			$pnfpb_pwa_prompt_confirm_button_text = esc_html(
				__(
					"Install",
					"push-notification-for-post-and-buddypress"
				)
			);
		}

		if (
			get_option("pnfpb_ic_fcm_pwa_prompt_cancel_button") &&
			get_option("pnfpb_ic_fcm_pwa_prompt_cancel_button") != ""
		) {
			$pnfpb_pwa_prompt_cancel_button_text = get_option(
				"pnfpb_ic_fcm_pwa_prompt_cancel_button"
			);
		} else {
			$pnfpb_pwa_prompt_cancel_button_text = esc_html(
				__(
					"Cancel",
					"push-notification-for-post-and-buddypress"
				)
			);
		}

		if (
			get_option("pnfpb_ic_fcm_pwa_prompt_button_background") &&
			get_option("pnfpb_ic_fcm_pwa_prompt_button_background") !=
			""
		) {
			$pnfpb_pwa_prompt_button_background = get_option(
				"pnfpb_ic_fcm_pwa_prompt_button_background"
			);
		} else {
			$pnfpb_pwa_prompt_button_background = "#121240";
		}

		if (
			get_option("pnfpb_ic_fcm_pwa_prompt_dialog_background") &&
			get_option("pnfpb_ic_fcm_pwa_prompt_dialog_background") !=
			""
		) {
			$pnfpb_pwa_prompt_dialog_background = get_option(
				"pnfpb_ic_fcm_pwa_prompt_dialog_background"
			);
		} else {
			$pnfpb_pwa_prompt_dialog_background = "#6666ff";
		}

		if (
			get_option("pnfpb_ic_fcm_pwa_prompt_text_color") &&
			get_option("pnfpb_ic_fcm_pwa_prompt_text_color") != ""
		) {
			$pnfpb_pwa_prompt_text_color = get_option(
				"pnfpb_ic_fcm_pwa_prompt_text_color"
			);
		} else {
			$pnfpb_pwa_prompt_text_color = "#ffffff";
		}

		if (
			get_option("pnfpb_ic_fcm_pwa_prompt_button_text_color") &&
			get_option("pnfpb_ic_fcm_pwa_prompt_button_text_color") !=
			""
		) {
			$pnfpb_pwa_prompt_button_text_color = get_option(
				"pnfpb_ic_fcm_pwa_prompt_button_text_color"
			);
		} else {
			$pnfpb_pwa_prompt_button_text_color = "#ffffff";
		}

		if (
			get_option("pnfpb_ic_pwa_app_enable") === "1" &&
			(get_option("pnfpb_ic_pwa_app_custom_prompt_enable") ===
			 "1" ||
			 get_option(
				 "pnfpb_ic_pwa_app_desktop_custom_prompt_enable"
			 ) === "1" ||
			 get_option(
				 "pnfpb_ic_pwa_app_mobile_custom_prompt_enable"
			 ) === "1" ||
			 get_option(
				 "pnfpb_ic_pwa_app_pixels_custom_prompt_enable"
			 ) === "1") &&
			get_option(
				"pnfpb_ic_disable_serviceworker_pwa_pushnotification"
			) != "1"
		) {
			echo '<div class="pnfpb-pwa-dialog-container" id="pnfpb-pwa-dialog-container">
							<div class="pnfpb-pwa-dialog-box" style="background-color:' .
				esc_attr($pnfpb_pwa_prompt_dialog_background) .
				'">
								<div class="pnfpb-pwa-dialog-title" style="color:' .
				esc_attr($pnfpb_pwa_prompt_text_color) .
				';">' .
				esc_html($pnfpb_pwa_prompt_text) .
				'</div>
								<div class="pnfpb-pwa-dialog-buttons">
									<button id="pnfpb-pwa-dialog-cancel" type="button" class="button secondary" style="color:' .
				esc_attr($pnfpb_pwa_prompt_button_text_color) .
				";background-color:" .
				esc_attr($pnfpb_pwa_prompt_button_background) .
				';">' .
				esc_html($pnfpb_pwa_prompt_cancel_button_text) .
				'</button>
									<button id="pnfpb-pwa-dialog-subscribe" type="button" class="button primary" style="color:' .
				esc_attr($pnfpb_pwa_prompt_button_text_color) .
				";background-color:" .
				esc_attr($pnfpb_pwa_prompt_button_background) .
				';">' .
				esc_html($pnfpb_pwa_prompt_confirm_button_text) .
				'</button>
								</div>
							</div>
							</div>'; ?>

	<div id="pnfpb-pwa-dialog-ios" class="pnfpb-pwa-dialog-app-installed" 
		 title="<?php echo esc_attr(
								__(
									"PWA for IOS browsers",
									"push-notification-for-post-and-buddypress"
								)
							); ?>"
		 >
		<p>
			<span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
			<?php echo esc_html(
								__(
									"For IOS and IPAD browsers, Only option to install PWA is to use add to home screen in safari browser",
									"push-notification-for-post-and-buddypress"
								)
							); ?>
		</p>
	</div>

	<div id="pnfpb-pwa-dialog-app-installed" class="pnfpb-pwa-dialog-app-installed" 
		 title="<?php if (
								get_option("pnfpb-pwa-dialog-app-installed_text", false)
							) {
								echo esc_attr(get_option("pnfpb-pwa-dialog-app-installed_text"));
							} else {
								echo esc_attr(
									__(
										"App installed successfully",
										"push-notification-for-post-and-buddypress"
									)
								);
							} ?>"
		 >
		<p>
			<span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>
			<?php if (
								get_option("pnfpb-pwa-dialog-app-installed_description", false)
							) {
								echo esc_html(
									get_option("pnfpb-pwa-dialog-app-installed_description")
								);
							} else {
								echo esc_html(
									__(
										"Progressive Web App (PWA) is installed successfully.",
										"push-notification-for-post-and-buddypress"
									)
								);
							} ?></p>
	</div>
	<?php
		}

		$subscribe_button_text = esc_html(
			__(
				"Subscribe push notification",
				"push-notification-for-post-and-buddypress"
			)
		);

		if (
			get_option("pnfpb_ic_fcm_subscribe_button_text") &&
			get_option("pnfpb_ic_fcm_subscribe_button_text") !==
			false &&
			get_option("pnfpb_ic_fcm_subscribe_button_text") !== ""
		) {
			$subscribe_button_text = get_option(
				"pnfpb_ic_fcm_subscribe_button_text"
			);
		}

		$unsubscribe_button_text = esc_html(
			__(
				"Unsubscribe push notification",
				"push-notification-for-post-and-buddypress"
			)
		);

		if (
			get_option("pnfpb_ic_fcm_unsubscribe_button_text") &&
			get_option("pnfpb_ic_fcm_unsubscribe_button_text") !==
			false &&
			get_option("pnfpb_ic_fcm_unsubscribe_button_text") !== ""
		) {
			$unsubscribe_button_text = get_option(
				"pnfpb_ic_fcm_unsubscribe_button_text"
			);
		}

		$subscribe_button_text_color = "#ffffff";

		if (
			get_option("pnfpb_ic_fcm_subscribe_button_text_color") &&
			get_option("pnfpb_ic_fcm_subscribe_button_text_color") !==
			false &&
			get_option("pnfpb_ic_fcm_subscribe_button_text_color") !==
			""
		) {
			$subscribe_button_text_color = get_option(
				"pnfpb_ic_fcm_subscribe_button_text_color"
			);
		}

		$subscribe_button_color = "#000000";

		if (
			get_option("pnfpb_ic_fcm_subscribe_button_color") &&
			get_option("pnfpb_ic_fcm_subscribe_button_color") !==
			false &&
			get_option("pnfpb_ic_fcm_subscribe_button_color") !== ""
		) {
			$subscribe_button_color = get_option(
				"pnfpb_ic_fcm_subscribe_button_color"
			);
		}

		$group_unsubscribe_dialog_text_confirm = esc_html(
			__(
				"Your device is unsubscribed from notification",
				"push-notification-for-post-and-buddypress"
			)
		);

		if (
			get_option(
				"pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
			) &&
			get_option(
				"pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
			) !== false &&
			get_option(
				"pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
			) !== ""
		) {
			$group_unsubscribe_dialog_text_confirm = get_option(
				"pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
			);
		}

		$group_subscribe_dialog_text_confirm = esc_html(
			__(
				"Your device is subscribed from notification",
				"push-notification-for-post-and-buddypress"
			)
		);

		if (
			get_option(
				"pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
			) &&
			get_option(
				"pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
			) !== false &&
			get_option(
				"pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
			) !== ""
		) {
			$group_subscribe_dialog_text_confirm = get_option(
				"pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
			);
		}

		$group_unsubscribe_dialog_text = esc_html(
			__(
				"Would you like to unsubscribe push notifications?",
				"push-notification-for-post-and-buddypress"
			)
		);

		if (
			get_option("pnfpb_ic_fcm_group_unsubscribe_dialog_text") &&
			get_option("pnfpb_ic_fcm_group_unsubscribe_dialog_text") !==
			false &&
			get_option("pnfpb_ic_fcm_group_unsubscribe_dialog_text") !==
			""
		) {
			$group_unsubscribe_dialog_text = get_option(
				"pnfpb_ic_fcm_group_unsubscribe_dialog_text"
			);
		}

		$group_subscribe_dialog_text = esc_html(
			__(
				"Would you like to subscribe to push notifications?",
				"push-notification-for-post-and-buddypress"
			)
		);

		if (
			get_option("pnfpb_ic_fcm_group_subscribe_dialog_text") &&
			get_option("pnfpb_ic_fcm_group_subscribe_dialog_text") !==
			false &&
			get_option("pnfpb_ic_fcm_group_subscribe_dialog_text") !==
			""
		) {
			$group_subscribe_dialog_text = get_option(
				"pnfpb_ic_fcm_group_subscribe_dialog_text"
			);
		}

		$pnfpb_ic_ios_pwa_prompt_reappear = '7';
		$pnfpb_ic_ios_pwa_prompt_disable = '';

		if (
			get_option("pnfpb_ic_ios_pwa_prompt_reappear") &&
			get_option("pnfpb_ic_ios_pwa_prompt_reappear") !==
			false &&
			get_option("pnfpb_ic_ios_pwa_prompt_reappear") !==
			""
		) {
			$pnfpb_ic_ios_pwa_prompt_reappear = get_option(
				"pnfpb_ic_ios_pwa_prompt_reappear"
			);
		}
		if (
			get_option("pnfpb_ic_ios_pwa_prompt_disable") &&
			get_option("pnfpb_ic_ios_pwa_prompt_disable") !==
			false &&
			get_option("pnfpb_ic_ios_pwa_prompt_disable") !==
			""
		) {
			$pnfpb_ic_ios_pwa_prompt_disable = get_option(
				"pnfpb_ic_ios_pwa_prompt_disable"
			);
		}
         $args = [
             "public" => true,
             "_builtin" => false,
         ];		
		$pnfpb_show_custom_post_types = [];
		$output = "names"; // or objects
		$operator = "and"; // 'and' or 'or'
		$custposttypes = get_post_types($args, $output, $operator);

		foreach ($custposttypes as $post_type) {
			if (
				get_option(
					"pnfpb_ic_fcm_" . $post_type . "_enable"
				) === "1"
			) {
				array_push(
					$pnfpb_show_custom_post_types,
					$post_type
				);
			}
			$posttypecount++;
			if ($posttypecount >= 10) {

				break;
			}
		}

		$pnfpb_show_custom_post_types = wp_json_encode(
			$pnfpb_show_custom_post_types
		);
		
		if (
			get_option("pnfpb_progressier_push") !== "1" &&
			get_option("pnfpb_webtoapp_push") !== "1"
		) {
			$pnfpb_push_prompt = get_option(
				"pnfpb_ic_fcm_push_prompt_enable"
			);
			$pnfpb_onesignal_on = get_option("pnfpb_onesignal_push");
			$filename = "/js/pnfpb_pushscript_onesignal_pwa.js";
			$ajaxobject = "pnfpb_ajax_object_onesignal_push";

			wp_enqueue_script(
				"pnfpb-icajax-onesignal-script-push",
				plugins_url($filename, __DIR__),
				["jquery", "wp-i18n"],
				"3.00.1",
				true
			);

			wp_localize_script(
				"pnfpb-icajax-onesignal-script-push",
				$ajaxobject,
				[
					"ajax_url" => admin_url("admin-ajax.php"),
					"userid" => get_current_user_id(),
					"nonce" => wp_create_nonce('pnfpbpushnonce'),
					"pnfpb_onesignal_on" => $pnfpb_onesignal_on,
					"pnfpb_show_custom_post_types" => $pnfpb_show_custom_post_types,
					"subscribe_button_text" => $subscribe_button_text,
					"unsubscribe_button_text" => $unsubscribe_button_text,
					"subscribe_button_text_color" => $subscribe_button_text_color,
					"subscribe_button_color" => $subscribe_button_color,
					"group_unsubscribe_dialog_text_confirm" => $group_unsubscribe_dialog_text_confirm,
					"group_subscribe_dialog_text_confirm" => $group_subscribe_dialog_text_confirm,
					"group_unsubscribe_dialog_text" => $group_unsubscribe_dialog_text,
					"group_subscribe_dialog_text" => $group_subscribe_dialog_text,
					"pnfpb_ic_ios_pwa_prompt_reappear" => $pnfpb_ic_ios_pwa_prompt_reappear,
					"pnfpb_ic_ios_pwa_prompt_disable" => $pnfpb_ic_ios_pwa_prompt_disable,							
				]
			);
		}
	}
?>