<?php
/*
* BuddyPress options settings for push notification
* @Since 2.08
*/
?>
    <tr class="pnfpb_navy_blue_background_color pnfpb_white_text_color pnfpb_section_header_font_16px">
		<td class="pnfpb_ic_push_settings_table_column pnfpb_white_text_color pnfpb_section_header_font_16px">
			<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_white_text_color pnfpb_section_header_font_16px"><?php echo wp_kses_post(
                __(
                    "BuddyPress or BuddyBoss Private messages, Friendship request/accept and other options",
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
					<?php echo esc_html(
                    __(
                        "(For below BuddyPress options, user avatar image replaces notification icon in push notification)",
                        "push-notification-for-post-and-buddypress"
                    )
                    ); ?>
				</div>
			</div>
			<div class="pnfpb_row">
  			    <div class="pnfpb_column">
    				<div class="pnfpb_card">
						<?php
                            $pnfpb_ic_fcm_buddypressoptions_schedule_now_enable = "0";
                            if (
                                get_option("pnfpb_ic_fcm_buddypressoptions_schedule_now_enable") &&
                                get_option("pnfpb_ic_fcm_buddypressoptions_schedule_now_enable") ===
                                "1"
                            ) {
                                $pnfpb_ic_fcm_buddypressoptions_schedule_now_enable = "1";
                            }
                        ?>
						<label class="pnfpb_switch">
							<input  id="pnfpb_ic_fcm_buddypressoptions_schedule_now_enable" 
                                name="pnfpb_ic_fcm_buddypressoptions_schedule_now_enable" 
                                type="checkbox" value="1" 
                                <?php checked(
                                    "1",
                                    $pnfpb_ic_fcm_buddypressoptions_schedule_now_enable
                                ); ?>  />
							<span class="pnfpb_slider round"></span>
						</label>							
						<label class="pnfpb_ic_push_settings_table_label_checkbox" 
                            for="pnfpb_ic_fcm_buddypressoptions_schedule_now_enable">
							<?php echo esc_html(
                                __(
                                    "Send notification in action scheduler asynchronous background mode to avoid server overload.",
                                    "push-notification-for-post-and-buddypress"
                                )
                            ); ?>
						</label>
					</div>
				</div>
			</div>				
			<div class="pnfpb_row">
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" 
                            for="pnfpb_ic_fcm_buddypress_bprivatemessage_enable">
								<?php echo esc_html(
                                    __(
                                        "New private message",
                                        "push-notification-for-post-and-buddypress"
                                    )
                                ); ?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
								<input  id="pnfpb_ic_fcm_bprivatemessage_enable" 
                                    name="pnfpb_ic_fcm_bprivatemessage_enable" 
                                    type="checkbox" value="1" <?php checked(
                                        "1",
                                        get_option("pnfpb_ic_fcm_bprivatemessage_enable")
                                    ); ?>  
                                />	
								<span class="pnfpb_slider round"></span>
							</label>								
							<button type="button" 
                                class="pnfpb_private_message_button" 
                                onclick="toggle_private_message_form()">
                                    <?php echo wp_kses_post( __("Customize", "push-notification-for-post-and-buddypress")); ?>
                            </button>
						</div>
					</div>
					<div class="pnfpb_ic_private_message_form pnfpb_column_400">
					    <label class="pnfpb_ic_push_settings_table_label_checkbox" 
                            for="pnfpb_ic_fcm_buddypress_bprivatemessage_text_enable">
                            <?php echo wp_kses_post(
                                __(
                                    "Private messages notification title",
                                    "push-notification-for-post-and-buddypress"
                             )
                            ); ?>
                        </label>
                        <br/>
					    <input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
                            id="pnfpb_ic_fcm_bprivatemessage_text" name="pnfpb_ic_fcm_bprivatemessage_text" 
                            type="text" value="<?php if (
                                get_option("pnfpb_ic_fcm_bprivatemessage_text")
                         ) {
                                echo esc_attr(get_option("pnfpb_ic_fcm_bprivatemessage_text"));
                            } else {
                                echo esc_attr(
                                    __(
                                    "[sender name] sent you a private message",
                                    "push-notification-for-post-and-buddypress"
                                    )
                                );
                            } ?>"  
                        />
					    <br/>
                        <p>
                            <?php echo esc_html(
                                __(
                                    "[sender name] is the shortcode which replaces with sender name and modify remaining text according to your choice",
                                    "push-notification-for-post-and-buddypress"
                                )
                            ); ?>
                        </p>
                        <br/>
					    <label class="pnfpb_ic_push_settings_table_label_checkbox" 
                            for="pnfpb_ic_fcm_buddypress_bprivatemessage_text_enable">
                            <?php echo esc_html(
                                __(
                                    "Default Private message notification content",
                                    "push-notification-for-post-and-buddypress"
                                )
                            ); ?>
                        </label>
                        <br/>				
					    <input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
                            id="pnfpb_ic_fcm_bprivatemessage_content" 
                            name="pnfpb_ic_fcm_bprivatemessage_content" 
                            type="text" value="<?php echo esc_attr(
                                $privatemessagecontent
                            ); ?>"  
                        />
					</div>
					<?php if (
                        get_option("pnfpb_progressier_push") !== "1" &&
                        get_option("pnfpb_webtoapp_push") !== "1"
                    ) { ?>
					    <div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					    <div class="pnfpb_card">
							    <label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" 
                                for="pnfpb_ic_fcm_buddypress_new_member_enable">
								    <?php echo esc_html(
                                        __("New Member joined", "push-notification-for-post-and-buddypress")
                                    ); ?>
							    </label>
							    <label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
								    <input  id="pnfpb_ic_fcm_new_member_enable" 
                                        name="pnfpb_ic_fcm_new_member_enable" 
                                        type="checkbox" value="1" <?php checked(
                                            "1",
                                            get_option("pnfpb_ic_fcm_new_member_enable")
                                        ); ?>  
                                    />	
								    <span class="pnfpb_slider round"></span>
							    </label>
							    <button type="button" class="pnfpb_new_member_button" 
                                    onclick="toggle_new_member_form()">
                                        <?php echo esc_html(
                                        __("Customize", "push-notification-for-post-and-buddypress")
                                    ); ?>
                                </button>	
						    </div>
					    </div>
					    <div class="pnfpb_ic_new_member_form pnfpb_column_400">
						    <label class="pnfpb_ic_push_settings_table_label_checkbox" 
                                for="pnfpb_ic_fcm_buddypress_new_member_text">
                                <?php echo esc_html(
                                __(
                                    "New member notification title",
                                    "push-notification-for-post-and-buddypress"
                                )
                                ); ?>
                            </label>
                            <br/>
						    <input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
                                id="pnfpb_ic_fcm_new_member_text" 
                                name="pnfpb_ic_fcm_new_member_text" 
                                type="text" value="<?php if (
                                    get_option("pnfpb_ic_fcm_new_member_text")
                                ) {
                                    echo esc_attr(get_option("pnfpb_ic_fcm_new_member_text"));
                                } else {
                                    echo esc_attr("[member name] registered as new member");
                                } ?>"  
                            />
						    <br/>
                            <p>
                            <?php echo esc_html(
                                __(
                                    "[member name] is the shortcode which replaces with sender name and modify remaining text according to your choice",
                                    "push-notification-for-post-and-buddypress"
                                )
                            ); ?></p><br/>
						    <label class="pnfpb_ic_push_settings_table_label_checkbox" 
                                for="pnfpb_ic_fcm_buddypress_new_member_content">
                                <?php echo esc_html(
                                    __(
                                     "Default New member notification content",
                                        "push-notification-for-post-and-buddypress"
                                    )
                                ); ?>
                            </label>
                            <br/>				
						    <input  
                                class="pnfpb_ic_push_settings_table_value_column_input_field" 
                                id="pnfpb_ic_fcm_new_member_content" 
                                name="pnfpb_ic_fcm_new_member_content" 
                                type="text" value="<?php echo esc_attr(
                                    $newmembercontent
                                ); ?>"  
                            />
					    </div>
					<?php } ?>
				</div>
				<div class="pnfpb_row">
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" 
                            for="pnfpb_ic_fcm_buddypress_friendship_request_enable">
								<?php echo esc_html(
                                    __(
                                        "Friendship request",
                                        "push-notification-for-post-and-buddypress"
                                    )
                                ); ?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
								<input  id="pnfpb_ic_fcm_friendship_request_enable" 
                                    name="pnfpb_ic_fcm_friendship_request_enable" 
                                    type="checkbox" value="1" <?php checked(
                                        "1", get_option("pnfpb_ic_fcm_friendship_request_enable") ); ?>  />	
								<span class="pnfpb_slider round"></span>
							</label>
							<button type="button" class="pnfpb_friendship_request_button" 
                                    onclick="toggle_friendship_request_form()">
                                    <?php echo esc_html(__("Customize", "push-notification-for-post-and-buddypress")); ?>
                            </button>
						</div>
					</div>
					<div class="pnfpb_ic_friendship_request_form pnfpb_column_400">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_friendship_request_text_enable">
                            <?php echo esc_html(
                                __(
                                    "Friendship request notification title",
                                    "push-notification-for-post-and-buddypress"
                                )
                            ); ?></label><br/>
						    <input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
                                    id="pnfpb_ic_fcm_friendship_request_text" 
                                    name="pnfpb_ic_fcm_friendship_request_text" type="text" 
                                    value="<?php if (
                                        get_option("pnfpb_ic_fcm_friendship_request_text")
                                    ) {
                                        echo esc_attr(get_option("pnfpb_ic_fcm_friendship_request_text"));
                                    } else {
                                        echo esc_attr(
                                            __(
                                                "[friendship initiator name] sent friendship request",
                                                "push-notification-for-post-and-buddypress"
                                            )
                                        );
                                    } ?>"  />
						            <br/>
                                    <p>
                                        <?php echo esc_html(
                                            __(
                                                "[friendship initiator name] is the shortcode which replaces with sender name and modify remaining text according to your choice",
                                                "push-notification-for-post-and-buddypress"
                                            )
                                        ); ?>
                                    </p>
                                    <br/>
						<label class="pnfpb_ic_push_settings_table_label_checkbox" 
                            for="pnfpb_ic_fcm_buddypress_friendship_request_text_enable">
                            <?php echo esc_html(
                                __(
                                    "Default Friendship request notification content",
                                    "push-notification-for-post-and-buddypress"
                                )
                            ); ?>
                        </label>
                        <br/>				
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
                            id="pnfpb_ic_fcm_friendship_request_content" 
                            name="pnfpb_ic_fcm_friendship_request_content" 
                            type="text" 
                            value="<?php echo esc_attr(
                                $friendshiprequestcontent
                            ); ?>"  
                        />
					</div>
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox 
                                    pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" 
                                    for="pnfpb_ic_fcm_buddypress_friendship_accept_enable">
								<?php echo esc_html(
                                    __(
                                        "Friendship accepted",
                                        "push-notification-for-post-and-buddypress"
                                    )
                                ); ?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
								<input  id="pnfpb_ic_fcm_friendship_accept_enable" 
                                    name="pnfpb_ic_fcm_friendship_accept_enable" 
                                    type="checkbox" value="1" <?php checked(
                                        "1",
                                        get_option("pnfpb_ic_fcm_friendship_accept_enable")
                                    ); ?>  
                                />	
								<span class="pnfpb_slider round"></span>
							</label>
							<button type="button" class="pnfpb_friendship_accept_button" 
                                onclick="toggle_friendship_accept_form()">
                                <?php echo esc_html(
                                    __("Customize", "push-notification-for-post-and-buddypress")
                                ); ?></button>
						</div>
					</div>
					<div class="pnfpb_ic_friendship_accept_form pnfpb_column_400">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" 
                            for="pnfpb_ic_fcm_buddypress_friendship_accept_text_enable">
                                <?php echo esc_html(
                                    __(
                                        "Friendship accepted notification title",
                                        "push-notification-for-post-and-buddypress"
                                    )
                                ); ?></label><br/>
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
                            id="pnfpb_ic_fcm_friendship_accept_text" 
                                name="pnfpb_ic_fcm_friendship_accept_text" 
                                    type="text" value="<?php if (
                                        get_option("pnfpb_ic_fcm_friendship_accept_text")
                                    ) {
                                        echo esc_attr(get_option("pnfpb_ic_fcm_friendship_accept_text"));
                                    } else {
                                        echo esc_attr(
                                            __(
                                                "[friendship acceptor name] accepted your friendship request",
                                                "push-notification-for-post-and-buddypress"
                                            )
                                        );
                                    } ?>"  
                        />
						<br/>
                        <p>
                            <?php echo esc_html(
                                __(
                                    "[friendship acceptor name] is the shortcode which replaces with sender name and modify remaining text according to your choice",
                                    "push-notification-for-post-and-buddypress"
                                )
                            ); ?>
                        </p>
                        <br/>
						<label class="pnfpb_ic_push_settings_table_label_checkbox" 
                            for="pnfpb_ic_fcm_buddypress_friendship_accept_text_enable">
                            <?php echo esc_html(
                                __(
                                    "Default Friendship accepted notification content",
                                    "push-notification-for-post-and-buddypress"
                                )
                            ); ?>
                        </label>
                        <br/>				
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
                            id="pnfpb_ic_fcm_friendship_accept_content" 
                            name="pnfpb_ic_fcm_friendship_accept_content" type="text" 
                                value="<?php echo esc_attr(
                                    $friendshipacceptcontent
                                ); ?>"  
                        />
					</div>
				</div>
				<?php if (
                    get_option("pnfpb_progressier_push") !== "1" &&
                    get_option("pnfpb_webtoapp_push") !== "1"
                ) { ?>				
				    <div class="pnfpb_row">
					    <div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					    <div class="pnfpb_card">
							    <label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" 
                                for="pnfpb_ic_fcm_buddypress_avatar_change_enable">
								    <?php echo esc_html(
                                        __(
                                            "User avatar change",
                                         "push-notification-for-post-and-buddypress"
                                        )
                                    ); ?>
							    </label>
							    <label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
								    <input  id="pnfpb_ic_fcm_avatar_change_enable" 
                                        name="pnfpb_ic_fcm_avatar_change_enable" 
                                            type="checkbox" value="1" <?php checked(
                                                "1",
                                                esc_attr(get_option("pnfpb_ic_fcm_avatar_change_enable"))
                                            ); ?>  
                                    />	
								<span class="pnfpb_slider round"></span>
							</label>
							<button type="button" 
                                class="pnfpb_avatar_change_button" 
                                onclick="toggle_avatar_change_form()"><?php echo esc_html(
                                    __("Customize", "push-notification-for-post-and-buddypress")
                                ); ?>
                            </button>
						</div>
					</div>
					<div class="pnfpb_ic_avatar_change_form pnfpb_column_400">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_avatar_change_text_enable">
                            <?php echo esc_html(
                            __(
                                "User avatar change notification title",
                                "push-notification-for-post-and-buddypress"
                            )
                            ); ?>
                        </label>
                        <br/>
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
                                id="pnfpb_ic_fcm_avatar_change_text" 
                                name="pnfpb_ic_fcm_avatar_change_text" 
                                type="text" value="<?php if (
                                    get_option("pnfpb_ic_fcm_avatar_change_text")
                                ) {
                                    echo esc_attr(get_option("pnfpb_ic_fcm_avatar_change_text"));
                                } else {
                                    echo esc_attr(
                                        __(
                                            "[member name] updated avatar",
                                            "push-notification-for-post-and-buddypress"
                                        )
                                    );
                                } ?>"  
                            />
						<br/>
                        <p>
                            <?php echo esc_html(
                                __(
                                    "[member name] is the shortcode which replaces with sender name and modify remaining text according to your choice",
                                    "push-notification-for-post-and-buddypress"
                                )
                            ); ?>
                        </p>
                    <br/>
					<label class="pnfpb_ic_push_settings_table_label_checkbox" for="pnfpb_ic_fcm_buddypress_avatar_change_text_enable"><?php echo esc_html(
                            __(
                                "Default Avatar change notification content",
                                "push-notification-for-post-and-buddypress"
                            )
                        ); ?>
                    </label>
                    <br/>				
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
                        id="pnfpb_ic_fcm_avatar_change_content" 
                        name="pnfpb_ic_fcm_avatar_change_content" 
                        type="text" value="<?php echo esc_attr(
                            $avatarchangecontent
                        ); ?>"  
                    />
				</div>
				<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    				<div class="pnfpb_card">
						<label class="pnfpb_ic_push_settings_table_label_checkbox 
                            pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" 
                            for="pnfpb_ic_fcm_buddypress_cover_image_change_enable">
							<?php echo esc_html(
                                __(
                                    "User cover image change",
                                    "push-notification-for-post-and-buddypress"
                                )
                            ); ?>
						</label>
						<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 
                            pnfpb_margin_left_4 pnfpb_max_width_40">
							<input  id="pnfpb_ic_fcm_cover_image_change_enable" 
                                name="pnfpb_ic_fcm_cover_image_change_enable" 
                                type="checkbox" value="1" <?php checked(
                                    "1",
                                     get_option("pnfpb_ic_fcm_cover_image_change_enable")
                                ); ?>  
                            />	
							<span class="pnfpb_slider round"></span>
						</label>
						<button type="button" 
                            class="pnfpb_cover_image_change_button" 
                            onclick="toggle_cover_image_change_form()">
                                <?php echo esc_html(
                                    __("Customize", "push-notification-for-post-and-buddypress")
                                ); ?>
                        </button>
					</div>
				</div>
				<div class="pnfpb_ic_cover_image_change_form pnfpb_column_400">
					<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8" 
                    for="pnfpb_ic_fcm_buddypress_cover_image_change_text_enable"><?php echo esc_html(
                        __(
                            "User cover image notification title",
                            "push-notification-for-post-and-buddypress"
                        )
                        ); ?>
                    </label><br/>
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
                        id="pnfpb_ic_fcm_cover_image_change_text" 
                        name="pnfpb_ic_fcm_cover_image_change_text" 
                        type="text" 
                        value="<?php if (
                                get_option("pnfpb_ic_fcm_cover_image_change_text")
                            ) {
                                echo esc_attr(get_option("pnfpb_ic_fcm_cover_image_change_text"));
                            } else {
                                esc_attr(
                                    __(
                                        "[member name] updated cover photo",
                                        "push-notification-for-post-and-buddypress"
                                    )
                                );
                            } ?>"  
                        />
						<br/>
                        <p>
                            <?php echo esc_html(
                                __(
                                    "[member name] is the shortcode which replaces with sender name and modify remaining text according to your choice",
                                     "push-notification-for-post-and-buddypress"
                                )
                            ); ?>
                        </p>
                        <br/>
						<label class="pnfpb_ic_push_settings_table_label_checkbox" 
                            for="pnfpb_ic_fcm_buddypress_cover_image_change_text_enable">
                                <?php echo esc_html(
                                    __(
                                        "Default user cover image change notification content",
                                        "push-notification-for-post-and-buddypress"
                                    )
                                ); ?>
                        </label>
                        <br/>				
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
                            id="pnfpb_ic_fcm_cover_image_change_content" 
                            name="pnfpb_ic_fcm_cover_image_change_content" 
                            type="text" value="<?php echo esc_attr(
                                $coverimagechangecontent
                            ); ?>"  
                        />
					</div>
				</div>
				<div class="pnfpb_row">
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" 
                            for="pnfpb_ic_fcm_group_invitation_enable">
								<?php echo esc_html(
                                    __("Group Invitation", "push-notification-for-post-and-buddypress")
                                ); ?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
									<input  id="pnfpb_ic_fcm_group_invitation_enable" 
                                            name="pnfpb_ic_fcm_group_invitation_enable" 
                                            type="checkbox" value="1" <?php checked(
                                                "1",
                                                esc_attr(get_option("pnfpb_ic_fcm_group_invitation_enable"))
                                            ); ?>  
                                    />	
									<span class="pnfpb_slider round"></span>
							</label>								
							<button type="button" 
                                class="pnfpb_group_invitation_button" 
                                onclick="toggle_group_invitation_form()">
                                <?php echo esc_html( __("Customize", "push-notification-for-post-and-buddypress")); ?>
                            </button>
						</div>
					</div>
					<div class="pnfpb_ic_group_invitation_form pnfpb_column_400">
					<label class="pnfpb_ic_push_settings_table_label_checkbox" 
                        for="pnfpb_ic_fcm_buddypress_group_invitation_text_enable">
                            <?php echo esc_html(
                                __(
                                    "Group Invitation notification title",
                                    "push-notification-for-post-and-buddypress"
                                )
                            ); ?>
                    </label>
                    <br/>
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
                            id="pnfpb_ic_fcm_buddypress_group_invitation_text_enable" 
                            name="pnfpb_ic_fcm_buddypress_group_invitation_text_enable" 
                            type="text" value="<?php if (
                                get_option("pnfpb_ic_fcm_buddypress_group_invitation_text_enable")
                            ) {
                                echo esc_attr(
                                    get_option("pnfpb_ic_fcm_buddypress_group_invitation_text_enable")
                                );
                            } else {
                                echo esc_attr(
                                    __(
                                        "[sender name] invited to [group name]",
                                        "push-notification-for-post-and-buddypress"
                                    )
                                );
                            } ?>"  />
					<br/>
                    <p>
                        <?php echo esc_html(
                            __(
                                "[sender name]  and [group name] are the shortcode which replaces with sender name, group name respectively",
                                "push-notification-for-post-and-buddypress"
                            )
                        ); ?>
                    </p>
                    <br/>
					<label class="pnfpb_ic_push_settings_table_label_checkbox" 
                        for="pnfpb_ic_fcm_buddypress_group_invitation_content_enable">
                            <?php echo esc_html(
                                __(
                                    "Default Group invitation notification content",
                                    "push-notification-for-post-and-buddypress"
                                )
                            ); ?>
                    </label>
                    <br/>				
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
                        id="pnfpb_ic_fcm_buddypress_group_invitation_content_enable" 
                        name="pnfpb_ic_fcm_buddypress_group_invitation_content_enable" 
                        type="text" value="<?php echo esc_attr(
                            $groupinvitationcontent
                        ); ?>"  
                    />
					</div>
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox 
                                pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" 
                                for="pnfpb_ic_fcm_group_details_updated_enable">
								<?php echo esc_html(
                                    __(
                                        "Group details update",
                                        "push-notification-for-post-and-buddypress"
                                    )
                                ); ?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
									<input  id="pnfpb_ic_fcm_group_details_updated_enable" 
                                            name="pnfpb_ic_fcm_group_details_updated_enable" 
                                            type="checkbox" 
                                            value="1" <?php checked(
                                                "1",
                                                esc_attr(get_option("pnfpb_ic_fcm_group_details_updated_enable"))
                                                ); ?>  
                                    />	
									<span class="pnfpb_slider round"></span>
							</label>								
							<button type="button" 
                                class="pnfpb_group_details_updated_button" 
                                onclick="toggle_group_details_updated_form()">
                                    <?php echo esc_html(
                                        __("Customize", "push-notification-for-post-and-buddypress")
                                    ); ?>
                            </button>
						</div>
					</div>
					<div class="pnfpb_ic_group_details_updated_form pnfpb_column_400">
					<label class="pnfpb_ic_push_settings_table_label_checkbox" 
                        for="pnfpb_ic_fcm_buddypress_group_details_updated_text_enable">
                            <?php echo esc_html(
                                __(
                                    "Group updated notification title",
                                     "push-notification-for-post-and-buddypress"
                                )
                            ); ?>
                    </label>
                    <br/>
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
                        id="pnfpb_ic_fcm_buddypress_group_details_updated_text_enable" 
                        name="pnfpb_ic_fcm_buddypress_group_details_updated_text_enable" 
                        type="text" value="<?php if (
                            get_option("pnfpb_ic_fcm_buddypress_group_details_updated_text_enable")
                        ) {
                            echo esc_attr(
                                get_option(
                                    "pnfpb_ic_fcm_buddypress_group_details_updated_text_enable"
                                )
                            );
                        } else {
                            echo esc_attr(
                                __(
                                    "[group name] group updated",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        } ?>"  />
					<br/>
                    <p>
                        <?php echo esc_html(
                            __(
                                "[group name] is the shortcode which replaces with group name. Modify remaining text according to your choice",
                                "push-notification-for-post-and-buddypress"
                            )
                        ); ?>
                    </p>
                    <br/>
					    <label class="pnfpb_ic_push_settings_table_label_checkbox" 
                        for="pnfpb_ic_fcm_buddypress_group_details_updated_content_enable">
                            <?php echo esc_html(
                                __(
                                "Default Group updated notification content",
                                "push-notification-for-post-and-buddypress"
                                )
                            ); ?>
                        </label>
                    <br/>				
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
                            id="pnfpb_ic_fcm_buddypress_group_details_updated_content_enable" 
                            name="pnfpb_ic_fcm_buddypress_group_details_updated_content_enable" 
                            type="text" value="<?php echo esc_attr(
                                $groupdetailsupdatedcontent
                            ); ?>"  />
					</div>				
				</div>
				<div class="pnfpb_row">
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" 
                            for="pnfpb_ic_fcm_mark_favourite_enable">
								<?php echo esc_html(
                                    __("Likes / Mark as favourite", "push-notification-for-post-and-buddypress")
                                ); ?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
									<input  id="pnfpb_ic_fcm_mark_favourite_enable" 
                                            name="pnfpb_ic_fcm_mark_favourite_enable" 
                                            type="checkbox" value="1" <?php checked(
                                                "1",
                                                esc_attr(get_option("pnfpb_ic_fcm_mark_favourite_enable"))
                                            ); ?>  
                                    />	
									<span class="pnfpb_slider round"></span>
							</label>								
							<button type="button" 
                                class="pnfpb_mark_favourite_button" 
                                onclick="toggle_mark_favourite_form()">
                                <?php echo esc_html( __("Customize", "push-notification-for-post-and-buddypress")); ?>
                            </button>
						</div>
					</div>
					<div class="pnfpb_ic_mark_favourite_form pnfpb_column_400">
						<label class="pnfpb_ic_push_settings_table_label_checkbox" 
							for="pnfpb_ic_fcm_buddypress_mark_favourite_text_enable">
								<?php echo esc_html(
									__(
										"Mark as favourite / Likes notification title",
										"push-notification-for-post-and-buddypress"
									)
								); ?>
						</label>
						<br/>
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
								id="pnfpb_ic_fcm_buddypress_mark_favourite_text_enable" 
								name="pnfpb_ic_fcm_buddypress_mark_favourite_text_enable" 
								type="text" value="<?php if (
									get_option("pnfpb_ic_fcm_buddypress_mark_favourite_text_enable")
								) {
									echo esc_attr(
										get_option("pnfpb_ic_fcm_buddypress_mark_favourite_text_enable")
									);
								} else {
									echo esc_attr(
										__(
											"[username] liked your activity",
											"push-notification-for-post-and-buddypress"
										)
									);
								} ?>"  />
						<br/>
						<p>
							[username]
							<?php echo esc_html(
								__(
									"is shortcode which replaces with username who liked activity/marked activity as favourite",
									"push-notification-for-post-and-buddypress"
								)
							); ?>
						</p>
						<br/>
						<label class="pnfpb_ic_push_settings_table_label_checkbox" 
							for="pnfpb_ic_fcm_buddypress_mark_favourite_content_enable">
								<?php echo esc_html(
									__(
										"Default content for Mark as favourite/Likes notification",
										"push-notification-for-post-and-buddypress"
									)
								); ?>
						</label>
						<br/>				
						<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
							id="pnfpb_ic_fcm_buddypress_mark_favourite_content_enable" 
							name="pnfpb_ic_fcm_buddypress_mark_favourite_content_enable" 
							type="text" value="<?php echo esc_attr(
								$markfavouritecontent
							); ?>"  
						/>
					</div>
				</div>			
				<?php } ?>		
			</td>
		</tr>
		<?php if (get_option("pnfpb_progressier_push") !== "1") { ?>
		<tr class="pnfpb_navy_blue_background_color pnfpb_white_text_color pnfpb_section_header_font_16px">
			<td class="pnfpb_ic_push_settings_table_column pnfpb_white_text_color pnfpb_section_header_font_16px">
				<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_white_text_color pnfpb_section_header_font_16px">
                    <?php echo esc_html(
                        __(
                            "Admin only push notifications",
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
						<?php echo esc_html(
                            __(
                                "(following push notifications will be sent only to admin)",
                                "push-notification-for-post-and-buddypress"
                            )
                        ); ?>
					</div>
				</div>
				<div class="pnfpb_row">
  					<div class="pnfpb_column">
    					<div class="pnfpb_card">
							<?php
                                $pnfpb_ic_fcm_admin_schedule_now_enable = "0";
                                if (
                                    get_option("pnfpb_ic_fcm_admin_schedule_now_enable") &&
                                    get_option("pnfpb_ic_fcm_admin_schedule_now_enable") === "1"
                                ) {
                                    $pnfpb_ic_fcm_admin_schedule_now_enable = "1";
                                }
                            ?>
							<label class="pnfpb_switch">
								<input  id="pnfpb_ic_fcm_admin_schedule_now_enable" 
                                    name="pnfpb_ic_fcm_admin_schedule_now_enable" type="checkbox" 
                                    value="1" <?php checked(
                                            "1",
                                            esc_attr($pnfpb_ic_fcm_admin_schedule_now_enable)
                                    ); ?>  
                                />
								<span class="pnfpb_slider round"></span>
							</label>							
							<label class="pnfpb_ic_push_settings_table_label_checkbox" 
                                for="pnfpb_ic_fcm_admin_schedule_now_enable">
								<?php echo esc_html(
                                __(
                                    "Send notification in action scheduler asynchronous background mode to avoid server overload using batch process)",
                                    "push-notification-for-post-and-buddypress"
                                )
                                 ); ?>
							</label>
						</div>
					</div>
				</div>				
				<div class="pnfpb_row">
					<div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" 
                            for="pnfpb_ic_fcm_new_user_registration_enable">
								<?php echo esc_html(
                                    __(
                                        "New user registration",
                                        "push-notification-for-post-and-buddypress"
                                    )
                                ); ?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
									<input  id="pnfpb_ic_fcm_new_user_registration_enable" 
                                        name="pnfpb_ic_fcm_new_user_registration_enable" 
                                            type="checkbox" value="1" <?php checked(
                                                "1",
                                                esc_attr(get_option("pnfpb_ic_fcm_new_user_registration_enable"))
                                            ); ?>  
                                    />	
									<span class="pnfpb_slider round"></span>
							</label>								
							<button type="button" 
                                class="pnfpb_new_user_registration_button" 
                                    onclick="toggle_new_user_registration_form()">
                                        <?php echo esc_html(
                                            __("Customize", "push-notification-for-post-and-buddypress")
                                        ); ?>
                            </button>
						</div>
					</div>
					<div class="pnfpb_ic_new_user_registration_form pnfpb_column_400">
					    <label class="pnfpb_ic_push_settings_table_label_checkbox" 
                            for="pnfpb_ic_fcm_buddypress_new_user_registration_text_enable">
                            <?php echo esc_html(
                            __(
                                "New user registration notification title",
                                "push-notification-for-post-and-buddypress"
                            )
                            ); ?>
                        </label><br/>
					    <input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
                            id="pnfpb_ic_fcm_buddypress_new_user_registration_text_enable" 
                            name="pnfpb_ic_fcm_buddypress_new_user_registration_text_enable" 
                            type="text" 
                            value="<?php if (
                                get_option("pnfpb_ic_fcm_buddypress_new_user_registration_text_enable")
                            ) {
                                echo esc_attr(
                                    get_option(
                                        "pnfpb_ic_fcm_buddypress_new_user_registration_text_enable"
                                    )
                                );
                            } else {
                                echo esc_attr(
                                    __(
                                        "[user name] registered as new member",
                                    "push-notification-for-post-and-buddypress"
                                    )
                                );
                            } ?>"  
                        />
					    <br/>
                        <p>
                            <?php echo esc_html(
                                __(
                                    "[user name] is the shortcode which replaces with new user name. Modify remaining text according to your choice",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );  ?>
                        </p>
                        <br/>
					    <label class="pnfpb_ic_push_settings_table_label_checkbox" 
                            for="pnfpb_ic_fcm_buddypress_new_user_registration_content_enable">
                            <?php echo esc_html(
                                __(
                                    "Default New user registration notification content",
                                    "push-notification-for-post-and-buddypress"
                                )
                            ); ?>
                        </label>
                        <br/>				
					    <input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
                            id="pnfpb_ic_fcm_buddypress_new_user_registration_content_enable" 
                            name="pnfpb_ic_fcm_buddypress_new_user_registration_content_enable" 
                            type="text" value="<?php echo esc_attr(
                                $newuserregistrationcontent
                            ); ?>"  
                        />
					    </div>
					    <div class="pnfpb_column_400 pnfpb_column_buddypress_functions">
    					    <div class="pnfpb_card">
							    <label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_flex_grow_6 pnfpb_padding_top_8 pnfpb_max_width_236" for="pnfpb_ic_fcm_contact_form7_enable">
								    <?php echo esc_html(
                                        __(
                                            "On Contact form7 submitted",
                                            "push-notification-for-post-and-buddypress"
                                        )
                                    ); ?>
							</label>
							<label class="pnfpb_switch pnfpb_flex_grow_1 pnfpb_margin_top_8 pnfpb_margin_left_4 pnfpb_max_width_40">
									<input  id="pnfpb_ic_fcm_contact_form7_enable" 
                                            name="pnfpb_ic_fcm_contact_form7_enable" 
                                            type="checkbox" value="1" <?php checked(
                                                "1",
                                                esc_attr(get_option("pnfpb_ic_fcm_contact_form7_enable"))
                                            ); ?>  
                                    />	
									<span class="pnfpb_slider round"></span>
							</label>								
							<button type="button" 
                                class="pnfpb_contact_form7_button" 
                                    onclick="toggle_contact_form7_form()">
                                        <?php echo esc_html(
                                            __("Customize", "push-notification-for-post-and-buddypress")
                                        ); ?>
                            </button>
						</div>
					</div>
					<div class="pnfpb_ic_contact_form7_form pnfpb_column_400">
					    <label class="pnfpb_ic_push_settings_table_label_checkbox" 
                            for="pnfpb_ic_fcm_buddypress_contact_form7_text_enable">
                                <?php echo esc_html(
                                    __(
                                        "Contact form7 submitted notification title",
                                        "push-notification-for-post-and-buddypress"
                                    )
                                ); ?>
                        </label>
                    <br/>
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
                        id="pnfpb_ic_fcm_buddypress_contact_form7_text_enable" 
                        name="pnfpb_ic_fcm_buddypress_contact_form7_text_enable" 
                        type="text" value="<?php if (
                            get_option("pnfpb_ic_fcm_buddypress_contact_form7_text_enable")
                        ) {
                            echo esc_attr(
                                get_option("pnfpb_ic_fcm_buddypress_contact_form7_text_enable")
                            );
                        } else {
                            echo esc_attr(
                                __(
                                    "You have received message from contact us page",
                                    "push-notification-for-post-and-buddypress"
                                )
                            );
                        } ?>"  
                    />
					<br/>
                    <p>
                        <?php echo esc_html(
                            __(
                                "Modify text according to your choice",
                                "push-notification-for-post-and-buddypress"
                            )
                        ); ?>
                    </p>
                    <br/>
					<label class="pnfpb_ic_push_settings_table_label_checkbox" 
                        for="pnfpb_ic_fcm_buddypress_contact_form7_content_enable">
                            <?php echo esc_html( __(
                             "Default message for notification content when contact form7 submitted",
                                "push-notification-for-post-and-buddypress"
                            )
                        ); ?>
                    </label>
                    <br/>				
					<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
                        id="pnfpb_ic_fcm_buddypress_contact_form7_content_enable" 
                        name="pnfpb_ic_fcm_buddypress_contact_form7_content_enable" 
                        type="text" value="<?php echo esc_attr(
                                $contactform7content
                        ); ?>"  />
					</div>				
				</div>				
			</td>
		</tr>
	<?php } ?>