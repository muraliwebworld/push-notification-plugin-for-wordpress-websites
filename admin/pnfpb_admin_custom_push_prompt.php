<?php
/*
* Customize Frontend custom prompt - admin settings to subscribe for push notification
* @Since 2.08
*/
?>
	<?php if (get_option("pnfpb_progressier_push") !== "1") { ?>
		<tr class="pnfpb_ic_push_settings_table_row">
            <td class="pnfpb_ic_push_settings_table_column column-columnname">
				<div class="pnfpb_row">
					<div class="pnfpb_column_400">
						<div class="pnfpb_card">
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" 
								   for="pnfpb_ic_fcm_push_prompt_enable">
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_fcm_push_prompt_enable" 
										   name="pnfpb_ic_fcm_push_prompt_enable" 
										   type="checkbox" 
										   value="1" <?php checked("1",get_option("pnfpb_ic_fcm_push_prompt_enable")); ?>  />
									<span class="pnfpb_slider round"></span>
								</label>
									<?php echo esc_html(
             							__(
                 							"Show custom prompt to subscribe push notification",
                 							"push-notification-for-post-and-buddypress"
             							)
         							); ?>
							</label>
							<button type="button" class="pnfpb_custom_push_prompt_button" onclick="toggle_custom_push_prompt_form()">
								<?php echo esc_html(__("Customize", "push-notification-for-post-and-buddypress")); ?>
							</button>
						</div>
						<div>
							<?php echo esc_html(__("Custom prompt is mandatory for all apple devices browsers, PWA and also needed for Firefox android",
               "push-notification-for-post-and-buddypress")); ?>								
						</div>						
					</div>
				</div>
				<div class="pnfpb_ic_push_prompt_form pnfpb_column_400">
					<table class="pnfpb_ic_push_firebase_settings_table widefat fixed">
						<thead>
							<tr>
								<th>
									<?php echo esc_html(
             							__(
                							 "Turn ON prompt style checkbox to display custom prompt. If cancel button is clicked then custom prompt will not be displayed for next 7 days.",
                 "push-notification-for-post-and-buddypress"
             							)
         							); ?>
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
												<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" 
													   for="pnfpb_ic_fcm_prompt_on_off">
													<?php echo esc_html(
                 										__("Prompt style", "push-notification-for-post-and-buddypress")
             										); ?>
												</label>
												<label class="pnfpb_switch">
													<input  id="pnfpb_ic_fcm_prompt_on_off" 
														   name="pnfpb_ic_fcm_prompt_on_off" 
														   type="checkbox" 
														   value="1" <?php checked("1",	get_option("pnfpb_ic_fcm_prompt_on_off") ); ?>  
													/>
													<span class="pnfpb_slider round"></span>
												</label>
											</div>												
										</div>									
										<div class="pnfpb-push-msg-model-prompt-button-container">
											<label class="pnfpb_ic_push_settings_table_label_checkbox 
														  pnfpb_container pnfpb_margin_left_4 
														  pnfpb_padding_top_8">
												<?php echo esc_html(
                										__(
                   											 "Prompt Style-1",
                    										"push-notification-for-post-and-buddypress"
                										)
            										); 
												?>
												<input  id="pnfpb_ic_fcm_prompt_style" 
													   name="pnfpb_ic_fcm_prompt_style" 
													   type="radio" 
													   value="1" <?php checked(
                											"1",
                											get_option("pnfpb_ic_fcm_prompt_style")
            												); ?>  
												/>
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
											<label class="pnfpb_ic_push_settings_table_label_checkbox 
														  pnfpb_container pnfpb_margin_left_4 
														  pnfpb_padding_top_8">
												<?php echo esc_html(
                										__(
                    										"Prompt Style-2",
                    										"push-notification-for-post-and-buddypress"
                										)
            										); 
												?>
												<input  id="pnfpb_ic_fcm_prompt_style" 
													   name="pnfpb_ic_fcm_prompt_style" 
													   type="radio" 
													   value="2" <?php checked("2",get_option("pnfpb_ic_fcm_prompt_style") ); ?>  
												/>
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
															<a href="#">
																<img 
																	 src="<?php echo esc_url(plugin_dir_url(__DIR__) . "public/img/pushbell-pnfpb.png"); ?>" 
																	 width="30px" height="30px" />
															</a>
														</div>
													</div>														
												</div>
											</div>
										</div>
										<div class="pnfpb-push-msg-model-prompt-button-container">
											<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" 
												   for="pnfpb_ic_fcm_prompt_style3">
												<?php echo esc_html(
                										__("Bell prompt", "push-notification-for-post-and-buddypress")
            									); ?>
											</label>
											<label class="pnfpb_switch">
												<input  id="pnfpb_ic_fcm_prompt_style3" 
													   name="pnfpb_ic_fcm_prompt_style3" 
													   type="checkbox" 
													   value="1" <?php checked("1",get_option("pnfpb_ic_fcm_prompt_style3")); ?>  />
												<span class="pnfpb_slider round"></span>
											</label>
										</div>
									</div>									
								</td>
							</tr>
							<tr class="pnfpb_ic_push_settings_table_row pnfpb_ic_push_settings_table_border_bottom">
								<td class="pnfpb_ic_push_settings_table_label_column column-columnname 
										   pnfpb_ic_push_settings_table_label_custom_prompt_column">
								<table class="pnfpb_ic_push_firebase_settings_table widefat fixed">
									<thead>
										<tr>
											<th>
												<?php echo "<b>" .
                										esc_html(
                    											__(
                        											"Customize prompt style color and text",
                        											"push-notification-for-post-and-buddypress"
                    											)
                									) . "</b>"; ?>
											</th>
										</tr>
									</thead>									
									<tbody>
    									<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column 
													   column-columnname 
													   pnfpb_ic_push_settings_table_label_custom_prompt_column">
												<p>
													<?php echo esc_html(
                 										__(
                     										"Custom prompt Icon(recommended 80x80 pixels or less than 80x80 pixels)",
                     										"push-notification-for-post-and-buddypress"
                 										)
             										); ?>
												</p>
												<table>
													<tr>
                										<td class="column-columnname">
                    										<button id="pnfpb_ic_fcm_popup_custom_prompt_icon" 
																	class="pnfpb_ic_push_settings_upload_icon">
																<?php echo esc_html(
                    													__(
                        													"Upload Icon",
                        													"push-notification-for-post-and-buddypress"
                    														)
                													); 
																?>
															</button>
                    										<input type="hidden" 
																   id="pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon"
																   name="pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon" 
																   value="<?php if (
                                  											get_option(
                                      											"pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon"
                                  											)
                              											) {
                                  											echo esc_attr(
                                      											get_option(
                                          											"pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon"
                                      											)
                                  											);
                              											} else {
                                  											echo esc_attr(plugin_dir_url(__DIR__)) .
                                      											"public/img/pushbell-pnfpb.png";
                              											} ?>" 
																 />
                										</td>
            										</tr>
													<tr>
                										<td class="column-columnname">
                    										<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        										<div id="pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon_preview" 
																	 style="background-image: url(<?php if (
                                      								esc_attr(get_option(
                                          								"pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon"
                                      								))
                                  									) {
                                      									echo esc_attr(
                                          									get_option(
                                              									"pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon"
                                          									)
                                      									);
                                  									} else {
                                      									echo esc_attr(plugin_dir_url(__DIR__)) .
                                          								"public/img/pushbell-pnfpb.png";
                                  										} ?>);width:32px; height:32px;overflow:hidden;border-radius:50%;margin:20px auto;background-position:center;background-repeat:no-repeat;background-size:cover;">
																</div>
                    										</div>
                										</td>
            										</tr>
												</table>
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
											<td class="pnfpb_ic_push_settings_table_label_column 
													   column-columnname 
													   pnfpb_ic_push_settings_table_label_custom_prompt_column">
												<p>
													<?php echo esc_html(
                										__(
                    										"Custom prompt Animation style",
                    										"push-notification-for-post-and-buddypress"
                										)
            											); 
													?>
												</p>
												<select id="pnfpb_ic_fcm_custom_prompt_animation" 
														name="pnfpb_ic_fcm_custom_prompt_animation">
					    							<option value="slideDown" 
															<?php if (
                    												get_option("pnfpb_ic_fcm_custom_prompt_animation") === "slideDown"
                												) {
                    												echo esc_html("selected");
                												} else {
                    												echo "";
                												} ?>>
														<?php echo esc_html(__("Slide Down", "push-notification-for-post-and-buddypress")); ?>
													</option>
													<option value="slideUp" <?php if (
                 											get_option("pnfpb_ic_fcm_custom_prompt_animation") === "slideUp"
             											) {
                 											echo esc_html("selected");
             											} else {
                 											echo "";
             											} ?>>
														<?php echo esc_html(
    														__("Slide Up", "push-notification-for-post-and-buddypress")); ?>
													</option>
												</select>
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname 
													   pnfpb_ic_push_settings_table_label_custom_prompt_column">		
												<p><?php echo esc_html(
                										__(
                    										"Header text in custom prompt (line 1)",
                    										"push-notification-for-post-and-buddypress"
                										)
            										); ?>
												</p>
												<textarea  
														  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														  id="pnfpb_ic_fcm_custom_prompt_header_text" 
														  name="pnfpb_ic_fcm_custom_prompt_header_text" 
													><?php if (
                										get_option("pnfpb_ic_fcm_custom_prompt_header_text")
            										) {
                										echo esc_textarea(get_option("pnfpb_ic_fcm_custom_prompt_header_text"));
            										} else {
                										echo esc_textarea(
                    										__(
                        										"We would like to show you notifications for the latest news and updates.",
                        										"push-notification-for-post-and-buddypress"
                    										)
                										);
            										} 
												?></textarea>
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname 
													   pnfpb_ic_push_settings_table_label_custom_prompt_column">		
												<p><?php echo esc_html(
                										__(
                    										"Header text in custom prompt (line 2)",
                    										"push-notification-for-post-and-buddypress"
                										)
            										); ?>
												</p>
												<textarea  
														  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														  id="pnfpb_ic_fcm_custom_prompt_header_text_line_2" 
														  name="pnfpb_ic_fcm_custom_prompt_header_text_line_2" 
													><?php if (
                										get_option("pnfpb_ic_fcm_custom_prompt_header_text_line_2")
            										) {
                										echo esc_textarea(get_option("pnfpb_ic_fcm_custom_prompt_header_text_line_2"));
            										} else {
                										echo "";
            										} 
												?></textarea>
											</td>
										</tr>										
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname 
													   pnfpb_ic_push_settings_table_label_custom_prompt_column">		
												<p>
													<?php echo esc_html(
                										__(
                    										"Confirmation message after subscribing for notifications",
                    										"push-notification-for-post-and-buddypress"
                										)
            										); ?>
												</p>
												<textarea class="pnfpb_ic_push_settings_table_value_column_input_field" 
														  id="pnfpb_ic_fcm_custom_prompt_subscribed_text" 
														  name="pnfpb_ic_fcm_custom_prompt_subscribed_text" 
												><?php if (
                										get_option("pnfpb_ic_fcm_custom_prompt_subscribed_text")
            										) {
                										echo esc_textarea(get_option("pnfpb_ic_fcm_custom_prompt_subscribed_text"));
            										} else {
               			 								echo esc_textarea(
                    										__(
                        										"You are subscribed to notifications",
                        										"push-notification-for-post-and-buddypress"
                    										)
                										);
            										} ?>
												</textarea>
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<label class="pnfpb_ic_push_settings_table_label_checkbox 
															  pnfpb_padding_top_8" 
													   for="pnfpb_custom_prompt_confirmation_message_on_off">
													<?php echo esc_html(
                 										__(
                     										"Hide Confirmation message after subscribing for notifications",
                     										"push-notification-for-post-and-buddypress"
                 										)
             											); 
													?>
												</label>												
												<label class="pnfpb_switch">
													<input  
														   id="pnfpb_custom_prompt_confirmation_message_on_off" 
														   name="pnfpb_custom_prompt_confirmation_message_on_off" 
														   type="checkbox" 
														   value="1" 
														   <?php checked("1",get_option("pnfpb_custom_prompt_confirmation_message_on_off")); ?>  
													/>
													<span class="pnfpb_slider round"></span>
												</label>
											</td>
										</tr>										
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">		
												<p>
													<?php echo esc_html(
                										__(
                    										"If cancel button is pressed while subscribing, show custom prompt after below number of days",
                    										"push-notification-for-post-and-buddypress"
                										)
            										); ?>
												</p>
												<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
													   id="pnfpb_ic_fcm_custom_prompt_show_again_days" 
													   name="pnfpb_ic_fcm_custom_prompt_show_again_days" 
													   type="number" 
													   value="<?php if (
                											get_option("pnfpb_ic_fcm_custom_prompt_show_again_days")
            											) {
                											echo esc_attr(
                    											get_option("pnfpb_ic_fcm_custom_prompt_show_again_days")
                											);
            											} else {
                											echo esc_attr("7");
            											} ?>"
												/>
											</td>
										</tr>										
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p>
													<?php echo esc_html(
                										__(
                    										"Allow Notification Button text color",
                   											 "push-notification-for-post-and-buddypress"
                										)
            										); ?>
												</p>
												<input class="pnfpb_ic_push_settings_table_value_column_input_field 
															  pnfpb_ic_fcm_push_custom_prompt_allow_button_background" 
													   id="pnfpb_ic_fcm_custom_prompt_allow_button_text_color" 
													   name="pnfpb_ic_fcm_custom_prompt_allow_button_text_color" 
													   type="color" 
													   value="<?php if (
                												get_option("pnfpb_ic_fcm_custom_prompt_allow_button_text_color")
            												) {
                												echo esc_attr(
                    												get_option(
                        												"pnfpb_ic_fcm_custom_prompt_allow_button_text_color"
                    												)
                												);
            												} else {
                												echo esc_attr("#ffffff");
            												} ?>" 
													/>
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p>
													<?php echo esc_html(
                										__(
                    										"Push notification subscribe Button background color",
                    										"push-notification-for-post-and-buddypress"
                										)
            										); 
													?>
												</p>
												<input class="pnfpb_ic_push_settings_table_value_column_input_field 
															  pnfpb_ic_fcm_push_custom_prompt_allow_button_background" 
													   id="pnfpb_ic_fcm_push_custom_prompt_allow_button_background" 
													   name="pnfpb_ic_fcm_push_custom_prompt_allow_button_background" 
													   type="color" 
													   value="<?php if (
                											esc_attr(get_option(
                    											"pnfpb_ic_fcm_push_custom_prompt_allow_button_background"
                											))
            												) {
                												echo esc_attr(
                    												get_option(
                        												"pnfpb_ic_fcm_push_custom_prompt_allow_button_background"
                    												)
                												);
            												} else {
                												echo esc_attr("#0078d1");
            											} ?>" 
												/>
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo esc_html(
                										__(
                    										"Allow notification button text",
                    										"push-notification-for-post-and-buddypress"
                										)
            									); ?></p>
												<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
													   id="pnfpb_ic_fcm_custom_prompt_allow_button_text" 
													   name="pnfpb_ic_fcm_custom_prompt_allow_button_text" 
													   type="text" 
													   value="<?php if (
                										get_option("pnfpb_ic_fcm_custom_prompt_allow_button_text")
            										) {
                										echo esc_attr(
                    										get_option("pnfpb_ic_fcm_custom_prompt_allow_button_text")
                										);
            										} else {
                										echo esc_attr(
                    										__("Allow", "push-notification-for-post-and-buddypress")
                									);
            									} ?>"  />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo esc_html(
                									__(
                    									"Cancel Notification Button text color",
                    									"push-notification-for-post-and-buddypress"
                									)
            									); ?></p>
												<input class="pnfpb_ic_push_settings_table_value_column_input_field 
															  pnfpb_ic_fcm_push_custom_prompt_cancel_button_background" 
													   id="pnfpb_ic_fcm_custom_prompt_cancel_button_text_color" 
													   name="pnfpb_ic_fcm_custom_prompt_cancel_button_text_color" type="color" 
													   value="<?php if (esc_attr(get_option("pnfpb_ic_fcm_custom_prompt_cancel_button_text_color"))) {
                												echo esc_attr(get_option("pnfpb_ic_fcm_custom_prompt_cancel_button_text_color"));
            												} else {
                												echo esc_attr("#0078d1");
            												} ?>" 
												/>
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p>
													<?php echo esc_html(
                										__(
                    										"Cancel Button background color",
                    										"push-notification-for-post-and-buddypress"
                										)
            										); ?>
												</p>
												<input class="pnfpb_ic_push_settings_table_value_column_input_field 
															  pnfpb_ic_fcm_push_custom_prompt_cancel_button_background" 
													   id="pnfpb_ic_fcm_push_custom_prompt_cancel_button_background" 
													   name="pnfpb_ic_fcm_push_custom_prompt_cancel_button_background" 
													   type="color" 
													   value="<?php if (
                												get_option(
                    												"pnfpb_ic_fcm_push_custom_prompt_cancel_button_background"
                												)
            												) {
                												echo esc_attr(
                    												get_option(
                        												"pnfpb_ic_fcm_push_custom_prompt_cancel_button_background"
                    												)
                												);
            												} else {
                												echo esc_attr("#ffffff");
            												} ?>" 
													   />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p>
													<?php echo esc_html(
                										__(
                    										"Cancel button text",
                    										"push-notification-for-post-and-buddypress"
                											)
            											); ?>
												</p>
												<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
													   id="pnfpb_ic_fcm_custom_prompt_cancel_button_text" 
													   name="pnfpb_ic_fcm_custom_prompt_cancel_button_text" 
													   type="text" 
													   value="<?php if (
                											get_option("pnfpb_ic_fcm_custom_prompt_cancel_button_text")
            											) {
                											echo esc_attr(
                    											get_option("pnfpb_ic_fcm_custom_prompt_cancel_button_text")
                											);
            											} else {
                											echo esc_attr(
                    											__("Cancel", "push-notification-for-post-and-buddypress")
                											);
            											} 
													?>"  
												/>
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p>
													<?php echo esc_html(
                										__(
                    										"Close Button text color",
                    										"push-notification-for-post-and-buddypress"
                										)
            										); ?>
												</p>
												<input class="pnfpb_ic_push_settings_table_value_column_input_field 
															  pnfpb_ic_fcm_push_custom_prompt_close_button_background" 
													   id="pnfpb_ic_fcm_custom_prompt_close_button_text_color" 
													   name="pnfpb_ic_fcm_custom_prompt_close_button_text_color" 
													   type="color" 
													   value="<?php if (
                												get_option("pnfpb_ic_fcm_custom_prompt_close_button_text_color")
            												) {
                												echo esc_attr(
                    													get_option(
                       														 "pnfpb_ic_fcm_custom_prompt_close_button_text_color"
                    													)
                													);
            													} else {
                													echo esc_attr("#0078d1");
            													} 
															  ?>" 
													/>
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo esc_html(
                									__(
                    									"Close Button background color",
                    									"push-notification-for-post-and-buddypress"
                									)
            									); ?></p>
												<input class="pnfpb_ic_push_settings_table_value_column_input_field 
															  pnfpb_ic_fcm_push_custom_prompt_close_button_background" 
													   id="pnfpb_ic_fcm_push_custom_prompt_close_button_background" 
													   name="pnfpb_ic_fcm_push_custom_prompt_close_button_background" 
													   type="color" 
													   value="<?php if (
                												get_option(
                   											 		"pnfpb_ic_fcm_push_custom_prompt_close_button_background"
                												)
            												) {
                												echo esc_attr(
                    												get_option(
                        												"pnfpb_ic_fcm_push_custom_prompt_close_button_background"
                    												)
                												);
            												} else {
                												echo esc_attr("#ffffff");
            												} ?>" 
													   />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo esc_html(
                										__(
                    										"Close button text",
                    										"push-notification-for-post-and-buddypress"
                										)
            									); ?></p>
												<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
													   id="pnfpb_ic_fcm_custom_prompt_close_button_text" 
													   name="pnfpb_ic_fcm_custom_prompt_close_button_text" 
													   type="text" 
													   value="<?php if (
                											get_option("pnfpb_ic_fcm_custom_prompt_close_button_text")
            											) {
                											echo esc_attr(
                    											get_option("pnfpb_ic_fcm_custom_prompt_close_button_text")
                											);
            											} else {
                											echo esc_attr(
                    											__("Close", "push-notification-for-post-and-buddypress")
                											);
            											} ?>"  />
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<p><?php echo esc_html(
                									__(
                    									"Wait message while processing push subscription",
                    									"push-notification-for-post-and-buddypress"
                									)
            									); ?></p>
												<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
													   id="pnfpb_ic_fcm_custom_prompt_popup_wait_message" 
													   name="pnfpb_ic_fcm_custom_prompt_popup_wait_message" 
													   type="text" 
														value="<?php if (
                													get_option("pnfpb_ic_fcm_custom_prompt_popup_wait_message")
            													) {
                													echo esc_attr(
                    													get_option("pnfpb_ic_fcm_custom_prompt_popup_wait_message")
                													);
            													} else {
                													echo esc_attr(
                    													__(
                        													"Please wait...processing",
                        													"push-notification-for-post-and-buddypress"
                    													)
                													);
            													} ?>"  
													/>
											</td>
										</tr>
										<tr class="pnfpb_ic_push_settings_table_row">
        									<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
												<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" 
													   for="pnfpb_custom_prompt_options_on_off">
													<?php echo esc_html(
                 										__(
                     										"Show subscription options button",
                     										"push-notification-for-post-and-buddypress"
                 										)
             										); ?>
												</label>												
												<label class="pnfpb_switch">
													<input  id="pnfpb_custom_prompt_options_on_off" 
														   name="pnfpb_custom_prompt_options_on_off" 
														   type="checkbox" 
														   value="1" <?php checked("1",
                 												get_option("pnfpb_custom_prompt_options_on_off")
             												); ?>  />
													<span class="pnfpb_slider round"></span>
												</label>
											</td>
										</tr>
									</tbody>
								</table>
								</td>
							</tr>
    						<tr class="pnfpb_ic_push_settings_table_row pnfpb_ic_push_settings_table_border_bottom">
        						<td class="pnfpb_ic_push_settings_table_label_column column-columnname 
										   pnfpb_ic_push_settings_table_label_custom_prompt_column">
									<table class="pnfpb_ic_push_firebase_settings_table widefat fixed">
										<thead>
											<tr>
												<th>
													<?php echo "<b>" .
                 										esc_html(
                     										__(
                         										"Customize Bell prompt icon, Button color and text",
                         										"push-notification-for-post-and-buddypress"
                     										)
                 										) .
                 									"</b>"; ?>
												</th>
											</tr>
										</thead>
										<tbody>
    										<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">										
													<p>
														<?php echo esc_html(
                  											__(
                      											"Push Subscribe prompt Icon(32x32 pixels)",
                      											"push-notification-for-post-and-buddypress"
                  											)
              											); ?>
													</p>
													<table>
														<tr>
                											<td class="column-columnname">
                    											<button id="pnfpb_ic_fcm_popup_icon" 
																		class="pnfpb_ic_push_settings_upload_icon">
																	<?php echo esc_html(
                     													__(
                         													"Upload Icon",
                         													"push-notification-for-post-and-buddypress"
                     													)
                 												); ?>
																</button>
                    											<input type="hidden" id="pnfpb_ic_fcm_popup_subscribe_button_icon" 
																	   name="pnfpb_ic_fcm_popup_subscribe_button_icon" 
																	   value="<?php if (
                                   											get_option(
                                       											"pnfpb_ic_fcm_popup_subscribe_button_icon"
                                   											)
                               												) {
                                   												echo esc_attr(
                                       												get_option(
                                           												"pnfpb_ic_fcm_popup_subscribe_button_icon"
                                       												)
                                   												);
                               												} else {
                                   												echo esc_attr(plugin_dir_url(__DIR__)) .
                                       												"public/img/pushbell-pnfpb.png";
                               													} ?>" 
																	/>
                											</td>
            											</tr>
														<tr>
                											<td class="column-columnname">
                    											<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        											<div id="pnfpb_ic_fcm_popup_subscribe_button_icon_preview" 
																		 style="background-image: url(
																			<?php if (
                                       											get_option(
                                           											"pnfpb_ic_fcm_popup_subscribe_button_icon"
                                       											)
                                   											) {
                                       											echo esc_url(
                                           											get_option(
                                              									 		"pnfpb_ic_fcm_popup_subscribe_button_icon"
                                           											)
                                       											);
                                   											} else {
                                       											echo esc_url(plugin_dir_url(__DIR__)) .
                                           										"public/img/pushbell-pnfpb.png";
                                   											} ?>);width:32px; height:32px;overflow:hidden;border-radius:50%;margin:20px auto;background-position:center;background-repeat:no-repeat;background-size:cover;">
																	</div>
                    											</div>
                											</td>
            											</tr>
													</table>
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo esc_html(
                 											__(
                     											"Header text in custom prompt",
                     											"push-notification-for-post-and-buddypress"
                 											)
             										); ?></p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_ic_fcm_popup_header_text" name="pnfpb_ic_fcm_popup_header_text" 
														   type="text" 
														   value="<?php if (
                 												get_option("pnfpb_ic_fcm_popup_header_text")
             												) {
                 												echo esc_attr(
                     												get_option("pnfpb_ic_fcm_popup_header_text")
                 												);
             												} else {
                 												echo esc_attr(
                     												__(
                         												"Manage push notifications",
                         												"push-notification-for-post-and-buddypress"
                     												)
                 												);
             												} ?>"  
														 />
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo esc_html(
                 											__(
                     											"Button text color",
                     											"push-notification-for-post-and-buddypress"
                 											)
             										); ?></p>
													<input class="pnfpb_ic_push_settings_table_value_column_input_field 
																  pnfpb_ic_fcm_push_prompt_button_background" 
														   id="pnfpb_ic_fcm_popup_subscribe_button_text_color" 
														   name="pnfpb_ic_fcm_popup_subscribe_button_text_color" 
														   type="color" 
														   value="<?php if (
                 														get_option("pnfpb_ic_fcm_popup_subscribe_button_text_color")
             														) {
                 														echo esc_attr(
                     														get_option(
                         														"pnfpb_ic_fcm_popup_subscribe_button_text_color"
                     														)
                 														);
             														} else {
                 														echo esc_attr("#ffffff");
             														} ?>" 
													/>
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo esc_html(
                 										__(
                     										"Push notification subscribe Button background color",
                     										"push-notification-for-post-and-buddypress"
                 										)
             											); ?>
													</p>
													<input class="pnfpb_ic_push_settings_table_value_column_input_field 
																  pnfpb_ic_fcm_push_prompt_button_background" 
														   id="pnfpb_ic_fcm_popup_subscribe_button_color" 
														   name="pnfpb_ic_fcm_popup_subscribe_button_color" type="color" 
														   value="<?php if (
                 													get_option("pnfpb_ic_fcm_popup_subscribe_button_color")
             													) {
                 													echo esc_attr(
                     													get_option("pnfpb_ic_fcm_popup_subscribe_button_color")
                 													);
             													} else {
                 													echo esc_attr("#e54b4d");
             													} ?>" 
													/>
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p><?php echo esc_html(
                										 	__(
                     											"Push notification subscribe text",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_ic_fcm_popup_subscribe_button" 
														   name="pnfpb_ic_fcm_popup_subscribe_button" type="text" 
														   value="<?php if (
                 													get_option("pnfpb_ic_fcm_popup_subscribe_button")
             													) {
                 													echo esc_attr(
                     													get_option("pnfpb_ic_fcm_popup_subscribe_button")
                 													);
             													} else {
                 													echo esc_attr(
                     														__(
                         														"Subscribe",
                         														"push-notification-for-post-and-buddypress"
                     														)
                 														);
             													} ?>"  
													/>
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Push notification unsubscribe text",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_ic_fcm_popup_unsubscribe_button" 
														   name="pnfpb_ic_fcm_popup_unsubscribe_button" 
														   type="text" value="<?php if (
                 												get_option("pnfpb_ic_fcm_popup_unsubscribe_button")
             												) {
                 												echo esc_attr(
                     												get_option("pnfpb_ic_fcm_popup_unsubscribe_button")
                 												);
             												} else {
                 												echo esc_attr(
                     												__(
                         												"Unsubscribe",
                         												"push-notification-for-post-and-buddypress"
                     												)
                 												);
             											} ?>"  
													/>
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Notification subscribed message when hover on push icon",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_ic_fcm_popup_subscribe_message" 
														   name="pnfpb_ic_fcm_popup_subscribe_message" type="text" 
														   value="<?php if (
                 													get_option("pnfpb_ic_fcm_popup_subscribe_message")
             													) {
                 													echo esc_attr(
                     													get_option("pnfpb_ic_fcm_popup_subscribe_message")
                 													);
             													} else {
                 													echo esc_attr(
                     													__(
                         													"You are subscribed to push notification",
                         													"push-notification-for-post-and-buddypress"
                     													)
                 													);
             													} ?>"  
													/>
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Notification not subscribed message when hover on push icon",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_ic_fcm_popup_unsubscribe_message" 
														   name="pnfpb_ic_fcm_popup_unsubscribe_message" type="text" 
														   value="<?php if (
                 													get_option("pnfpb_ic_fcm_popup_unsubscribe_message")
             													) {
                 													echo esc_attr(
                     													get_option("pnfpb_ic_fcm_popup_unsubscribe_message")
                 													);
             													} else {
                 													echo esc_attr(
                     													__(
                         													"Push notification not subscribed",
                         													"push-notification-for-post-and-buddypress"
                     													)
                 													);
             													} ?>"  
													/>
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Wait message while processing push subscription",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_ic_fcm_popup_wait_message" 
														   name="pnfpb_ic_fcm_popup_wait_message" 
														   type="text" value="<?php if (
                 												get_option("pnfpb_ic_fcm_popup_wait_message")
             												) {
                 												echo esc_attr(
                     												get_option("pnfpb_ic_fcm_popup_wait_message")
                 												);
             												} else {
                 												echo esc_attr(
                     												__(
                         												"Please wait...processing",
                         												"push-notification-for-post-and-buddypress"
                     												)
                 												);
             												} ?>"  
													/>
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" 
														   for="pnfpb_bell_icon_prompt_options_on_off">
														<?php echo esc_html(
                  											__(
                      											"Show subscription options button",
                      											"push-notification-for-post-and-buddypress"
                  											)
              											); ?>
													</label>												
													<label class="pnfpb_switch">
														<input  id="pnfpb_bell_icon_prompt_options_on_off" 
															   name="pnfpb_bell_icon_prompt_options_on_off" 
															   type="checkbox" value="1" <?php if (
                  												get_option("pnfpb_bell_icon_prompt_options_on_off", "0") ===
                     											 "0" ||
                  												get_option("pnfpb_bell_icon_prompt_options_on_off", "0") ===
                      											"1"
              													) {
                  													echo esc_attr("checked");
              													} ?>  
														/>
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
													<b>
													<?php echo 
                 										esc_html(
                     										__(
                         										"Customize Subscription options text,color,button in bell icon and in custom prompt",
                         										"push-notification-for-post-and-buddypress"
                     										)
                 										); ?>
													</b>
												</th>
											</tr>
										</thead>
										<tbody>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Subscription option update button text",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_update_text" 
														   name="pnfpb_bell_icon_subscription_option_update_text" 
														   type="text" value="<?php if (
                 												get_option("pnfpb_bell_icon_subscription_option_update_text")
             												) {
                 												echo esc_attr(
                     												get_option(
                         												"pnfpb_bell_icon_subscription_option_update_text"
                     												)
                 												);
             												} else {
                 												echo esc_attr(
                     												__("Update", "push-notification-for-post-and-buddypress")
                 												);
             												} ?>"  
													/>
												</td>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Subscription option update button text color",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_update_text_color" 
														   name="pnfpb_bell_icon_subscription_option_update_text_color" type="color" 
														   value="<?php if (
                 													get_option(
                     													"pnfpb_bell_icon_subscription_option_update_text_color"
                 													)
             													) {
                 													echo esc_attr(
                     													get_option(
                         													"pnfpb_bell_icon_subscription_option_update_text_color"
                     													)
                 													);
             													} else {
                 													echo esc_attr("#ffffff");
             													} ?>"  
													/>
												</td>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Subscription option update button background color",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_update_background_color" 
														   name="pnfpb_bell_icon_subscription_option_update_background_color" 
														   type="color" value="<?php if (
                 													get_option(
                     													"pnfpb_bell_icon_subscription_option_update_background_color"
                 													)
             													) {
                 													echo esc_attr(
                     													get_option(
                         													"pnfpb_bell_icon_subscription_option_update_background_color"
                     													)
                 													);
             													} else {
                 													echo esc_attr("#135e96");
             													} ?>"  
													/>
												</td>												
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Subscription option list background color ",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_list_background_color" 
														   name="pnfpb_bell_icon_subscription_option_list_background_color" 
														   type="color" value="<?php if (
                 															get_option(
                     															"pnfpb_bell_icon_subscription_option_list_background_color"
                 															)
             															) {
                 															echo esc_attr(
                     															get_option(
                         															"pnfpb_bell_icon_subscription_option_list_background_color"
                     															)
                 															);
             															} else {
                 															echo esc_attr("#cccccc");
             															} ?>"  
													/>
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Subscription option list text color ",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_list_text_color" 
														   name="pnfpb_bell_icon_subscription_option_list_text_color" 
														   type="color" 
														   value="<?php if (
                 												get_option(
                     												"pnfpb_bell_icon_subscription_option_list_text_color"
                 												)
             												) {
                 												echo esc_attr(
                     												get_option(
                         												"pnfpb_bell_icon_subscription_option_list_text_color"
                     												)
                 												);
             												} else {
                 												echo esc_attr("#000000");
             												} ?>"  
													/>
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Subscription option list checkbox color ",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_list_checkbox_color" 
														   name="pnfpb_bell_icon_subscription_option_list_checkbox_color" 
														   type="color" 
														   value="<?php if (
                 												get_option(
                     												"pnfpb_bell_icon_subscription_option_list_checkbox_color"
                 												)
             												) {
                 												echo esc_attr(
                     												get_option(
                         												"pnfpb_bell_icon_subscription_option_list_checkbox_color"
                     												)
                 												);
             												} else {
                 												echo esc_attr("#135e96");
             												} ?>"  
													/>
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Subscription option update confirmation message ",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_update_confirmation_message" 
														   name="pnfpb_bell_icon_subscription_option_update_confirmation_message" 
														   type="text" 
														   value="<?php if (
                 													get_option(
                     													"pnfpb_bell_icon_subscription_option_update_confirmation_message"
                 													)
             													) {
                 													echo esc_attr(
                     													get_option(
                         													"pnfpb_bell_icon_subscription_option_update_confirmation_message"
                     													)
                 													);
             													} else {
                 													echo esc_attr(
                     													__(
                         													"subscription updated",
                         													"push-notification-for-post-and-buddypress"
                     													)
                 													);
             													} ?>"  
													/>
												</td>
											</tr>											
											<tr class="pnfpb_ic_push_settings_table_row">
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Subscription option text for all subscriptions",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_activity_text" 
														   name="pnfpb_bell_icon_subscription_option_all_text" 
														   type="text" value="<?php if (
                 													get_option("pnfpb_bell_icon_subscription_option_all_text")
             													) {
                 													echo esc_attr(
                     													get_option("pnfpb_bell_icon_subscription_option_all_text")
                 													);
             													} else {
                 													echo esc_attr(
                     													__("All", "push-notification-for-post-and-buddypress")
                 													);
             													} ?>"  
													/>
												</td>												
        										<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Subscription option text for Post",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_post_text" 
														   name="pnfpb_bell_icon_subscription_option_post_text" 
														   type="text" 
														   value="<?php if (
                 														get_option("pnfpb_bell_icon_subscription_option_post_text")
             														) {
                 														echo esc_attr(
                     														get_option("pnfpb_bell_icon_subscription_option_post_text")
                 														);
             														} else {
                 														echo esc_attr(
                     														__("Post", "push-notification-for-post-and-buddypress")
                 														);
             														} ?>"  
													/>
												</td>
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
															<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
																<p>
																	<?php echo esc_html(__(
                        												"Subscription option text for ",
                        												"push-notification-for-post-and-buddypress")) . esc_html(ucwords($post_type)); ?>
																</p>
																<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
																	   id="<?php echo esc_attr("pnfpb_bell_icon_subscription_option_".$post_type."_text"); ?>" 
																	   name="<?php echo esc_attr("pnfpb_bell_icon_subscription_option_".$post_type."_text"); ?>"
																	   type="text" 
																	   value="<?php if (get_option("pnfpb_bell_icon_subscription_option_".$post_type."_text")) {
																			echo esc_attr(get_option("pnfpb_bell_icon_subscription_option_".$post_type."_text"));
																		} else {
    																		echo esc_attr(ucwords($post_type));
																		} ?>"  
																/>
															</td>
												<?php }
            }
            ?>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Subscription option text for Activity",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_activity_text" 
														   name="pnfpb_bell_icon_subscription_option_activity_text" 
														   type="text" 
														   value="<?php if (
                 													get_option("pnfpb_bell_icon_subscription_option_activity_text")
             													) {
                 													echo esc_attr(
                     													get_option(
                         													"pnfpb_bell_icon_subscription_option_activity_text"
                     													)
                 													);
             													} else {
                 													echo esc_attr(
                     													__("Activity", "push-notification-for-post-and-buddypress")
                 													);
             													} ?>"  
													/>
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Subscription option text for all comments",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_all_comments_text" 
														   name="pnfpb_bell_icon_subscription_option_all_comments_text" 
														   type="text" 
														   value="<?php if (
                 													get_option(
                     													"pnfpb_bell_icon_subscription_option_all_comments_text"
                 													)
             													) {
                 													echo esc_attr(
                     													get_option(
                         													"pnfpb_bell_icon_subscription_option_all_comments_text"
                     													)
                 													);
             													} else {
                 													echo esc_attr(
                     													__(
                         													"All Comments",
                         													"push-notification-for-post-and-buddypress"
                     													)
                 													);
             													} ?>"  
													/>
												</td>												
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Subscription option text for my comments",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_my_comments_text" 
														   name="pnfpb_bell_icon_subscription_option_my_comments_text" 
														   type="text" 
														   value="<?php if (
                 													get_option(
                     													"pnfpb_bell_icon_subscription_option_my_comments_text"
                 													)
             													) {
                 													echo esc_attr(
                     													get_option(
                         													"pnfpb_bell_icon_subscription_option_my_comments_text"
                     													)
                 													);
             													} else {
                 													echo esc_attr(
                     													__(
                         													"My Comments",
                         													"push-notification-for-post-and-buddypress"
                     													)
                 													);
             													} ?>"  
													/>
												</td>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Subscription option text for Private message",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_private_message_text" 
														   name="pnfpb_bell_icon_subscription_option_private_message_text" 
														   type="text" 
														   value="<?php if (
                 													get_option(
                     													"pnfpb_bell_icon_subscription_option_private_message_text"
                 													)
             													) {
                 													echo esc_attr(
                     													get_option(
                         													"pnfpb_bell_icon_subscription_option_private_message_text"
                     													)
                 													);
             													} else {
                 													echo esc_attr(
                     													__(
                         													"Private Message",
                         													"push-notification-for-post-and-buddypress"
                     													)
                 													);
             													} ?>"  
														/>
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Subscription option text for New member joined",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_new_member_joined_text" 
														   name="pnfpb_bell_icon_subscription_option_new_member_joined_text" 
														   type="text" 
														   value="<?php if (
                 														get_option(
                     														"pnfpb_bell_icon_subscription_option_new_member_joined_text"
                 														)
             														) {
                 														echo esc_attr(
                     														get_option(
                         														"pnfpb_bell_icon_subscription_option_new_member_joined_text"
                     														)
                 														);
             														} else {
                 														echo esc_attr(
                     														__(
                         														"New Member joined",
                         														"push-notification-for-post-and-buddypress"
                     														)
                 														);
             													} ?>"  
													/>
												</td>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Subscription option text for Friendship request",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_friendship_request_text" 
														   name="pnfpb_bell_icon_subscription_option_friendship_request_text" 
														   type="text" 
														   value="<?php if (
                 														get_option(
                     														"pnfpb_bell_icon_subscription_option_friendship_request_text"
                 														)
             														) {
                 														echo esc_attr(
                     														get_option(
                         														"pnfpb_bell_icon_subscription_option_friendship_request_text"
                     														)
                 														);
             														} else {
                 														echo esc_attr(
                     														__(
                         														"Friendship request",
                         														"push-notification-for-post-and-buddypress"
                     														)
                 														);
             														} ?>"  
													/>
												</td>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Subscription option text for Friendship accepted",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_friendship_accepted_text" 
														   name="pnfpb_bell_icon_subscription_option_friendship_accepted_text" 
														   type="text" value="<?php if (
                 													get_option(
                     													"pnfpb_bell_icon_subscription_option_friendship_accepted_text"
                 													)
             													) {
                 													echo esc_attr(
                     													get_option(
                         													"pnfpb_bell_icon_subscription_option_friendship_accepted_text"
                     													)
                 													);
             													} else {
                 													echo esc_attr(
                     													__(
                         													"Friendship accepted",
                         													"push-notification-for-post-and-buddypress"
                     													)
                 													);
             													} ?>"  
													/>
												</td>
											</tr>
											<tr class="pnfpb_ic_push_settings_table_row">
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Subscription option text for Avatar change",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_avatar_change_text" 
														   name="pnfpb_bell_icon_subscription_option_avatar_change_text" 
														   type="text" value="<?php if (
                 														get_option(
                     														"pnfpb_bell_icon_subscription_option_avatar_change_text"
                 														)
             														) {
                 														echo esc_attr(
                     														get_option(
                         														"pnfpb_bell_icon_subscription_option_avatar_change_text"
                     														)
                 														);
             														} else {
                 														echo esc_attr(
                     														__(
                         														"Avatar change",
                         														"push-notification-for-post-and-buddypress"
                     														)
                 													);
             												} ?>"  
													/>
												</td>												
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                											 __(
                     											"Subscription option text for Cover image change",
                     											"push-notification-for-post-and-buddypress"
                 												)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_cover_image_change_text" 
														   name="pnfpb_bell_icon_subscription_option_cover_image_change_text" 
														   type="text" 
														   value="<?php if (
                 													get_option(
                     													"pnfpb_bell_icon_subscription_option_cover_image_change_text"
                 													)
             													) {
                 													echo esc_attr(
                     													get_option(
                         													"pnfpb_bell_icon_subscription_option_cover_image_change_text"
                     													)
                 													);
             													} else {
                 													echo esc_attr(
                     													__(
                         													"Cover image change",
                         													"push-notification-for-post-and-buddypress"
                     													)
                 													);
             													} ?>"  
													/>
												</td>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Subscription option text for Group details update",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_group_details_update_text" 
														   name="pnfpb_bell_icon_subscription_option_group_details_update_text" 
														   type="text" 
														   value="<?php if (
                 														get_option(
                     														"pnfpb_bell_icon_subscription_option_group_details_update_text"
                 														)
             														) {
                 														echo esc_attr(
                     														get_option(
                         														"pnfpb_bell_icon_subscription_option_group_details_update_text"
                     														)
                 														);
             														} else {
                 														echo esc_attr(
                     														__(
                         														"Group details update",
                         														"push-notification-for-post-and-buddypress"
                     														)
                 														);
             														} ?>"  
													/>
												</td>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Subscription option text for Group invite",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  
														   class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_group_invite_text" 
														   name="pnfpb_bell_icon_subscription_option_group_invite_text" 
														   type="text" 
														   value="<?php if (
                 													get_option(
                     													"pnfpb_bell_icon_subscription_option_group_invite_text"
                 													)
             													) {
                 													echo esc_attr(
                     													get_option(
                         													"pnfpb_bell_icon_subscription_option_group_invite_text"
                     													)
                 													);
             													} else {
                 													echo esc_attr(
                     													__(
                         													"Group invite",
                         													"push-notification-for-post-and-buddypress"
                     													)
                 													);
             													} ?>"  
													/>
												</td>
												<td class="pnfpb_ic_push_settings_table_label_column column-columnname">							
													<p>
														<?php echo esc_html(
                 											__(
                     											"Subscription option text for Likes/Mark as favourite",
                     											"push-notification-for-post-and-buddypress"
                 											)
             											); ?>
													</p>
													<input  
														   class="pnfpb_ic_push_settings_table_value_column_input_field" 
														   id="pnfpb_bell_icon_subscription_option_favourite_text" 
														   name="pnfpb_bell_icon_subscription_option_favourite_text" 
														   type="text" 
														   value="<?php if (
                 													get_option(
                     													"pnfpb_bell_icon_subscription_option_favourite_text"
                 													)
             													) {
                 													echo esc_attr(
                     													get_option(
                         													"pnfpb_bell_icon_subscription_option_favourite_text"
                     													)
                 													);
             													} else {
                 													echo esc_attr(
                     													__(
                         													"Likes/Favourites",
                         													"push-notification-for-post-and-buddypress"
                     													)
                 													);
             													} ?>"  
													/>
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
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_async_notifications">
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_fcm_async_notifications" 
										   name="pnfpb_ic_fcm_async_notifications" 
										   type="checkbox" 
										   value="1" <?php checked(
             								"1",
             								$pnfpb_ic_fcm_async_notifications,
         									); ?>  
									/>
									<span class="pnfpb_slider round"></span>
								</label>
									<?php echo esc_html(
             							__(
                 							"Send push notification in asynchronous mode",
                 							"push-notification-for-post-and-buddypress"
             							)
         							); ?>
									<br/>
									<?php echo esc_html(
             							__(
                						 	"(If it is enabled, all push notifications will be sent in async mode without interrupting website flow)",
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
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_replace_notifications">
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_fcm_replace_notifications" 
										   name="pnfpb_ic_fcm_replace_notifications" 
										   type="checkbox" 
										   value="1" <?php checked(
             								"1",
             								get_option("pnfpb_ic_fcm_replace_notifications")
         									); ?>  
									/>
									<span class="pnfpb_slider round"></span>
								</label>
									<?php echo esc_html(
             							__(
                 							"Replace previous notification with new notification using tag parameter (web push except safari)",
                 							"push-notification-for-post-and-buddypress"
             							)
         							); ?>
									<br/>
									<?php echo esc_html(
             							__(
                						 	"(If tag is enabled it will replace previous notification with new notification to avoid too many notification filled up in notification center )",
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
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_renotify_notification">
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_fcm_renotify_notification" 
										   name="pnfpb_ic_fcm_renotify_notification" 
										   type="checkbox" value="1" <?php checked(
             									"1",
             									get_option("pnfpb_ic_fcm_renotify_notification")
         									); ?>  
									/>
									<span class="pnfpb_slider round"></span>
								</label>
									<?php echo esc_html(
             							__(
                 							"Stop re-notify after replacing previous notification using renotify parameter (web push except safari)",
                 							"push-notification-for-post-and-buddypress"
             							)
         							); ?>
									<br/>
									<?php echo esc_html(
             							__(
                 							"(If tag is enabled to replace previous notification then it will not re-notify users after replacing previous notification )",
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
							<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_ic_fcm_push_prompt_enable">
								<label class="pnfpb_switch">
									<input  id="pnfpb_ic_fcm_loggedin_notify" 
										   name="pnfpb_ic_fcm_loggedin_notify" 
										   type="checkbox" value="1" <?php checked(
             									"1",
             									get_option("pnfpb_ic_fcm_loggedin_notify")
         									); ?>  
									/>
									<span class="pnfpb_slider round"></span>
								</label>
									<?php echo esc_html(
             							__(
                 							"Push notification only for loggedin users",
                 							"push-notification-for-post-and-buddypress"
             							)
         							); ?>
							</label>
						</div>						
					</div>
				</div>
			</td>
		</tr>
		<?php } ?>