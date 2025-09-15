<?php
/**
* Plugin settings area to customize buttons for subscribe/unsubscribe push notifications
* @since 1.0.0
*/
?>

<h1 class="pnfpb_ic_push_settings_header"><?php echo esc_html(
    __("PNFPB - Customize buttons", "push-notification-for-post-and-buddypress")
); ?></h1>
<?php
	$pnfpb_tab_adminbutton_active = "active";
	require_once( plugin_dir_path( __FILE__ ) . 'push_admin_menu_list.php' );
?>

<div class="pnfpb_column_1200">
<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
    <?php settings_fields("pnfpb_icfcm_buttons"); ?>
    <?php do_settings_sections("pnfpb_icfcm_buttons"); ?>
	
	<table class="pnfpb_ic_push_settings_table widefat fixed">
  		<tbody>
			<tr class="pnfpb_ic_push_settings_table_row">
				<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<h3 class="pnfpb_ic_push_settings_header">
						<?php echo esc_html(
       						__(
           						"Subscribe/un-subscribe notification button customization",
           						"push-notification-for-post-and-buddypress"
       						)
   						); ?>
					</h3>
				</td>
			</tr>				
   	 		<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_subscribe_button_color">
						<?php echo esc_html(
          					__(
              					"Subscribe/Un-subscribe button background color",
              					"push-notification-for-post-and-buddypress"
          					)
      					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field 
								  pnfpb_ic_pwa_prompt_install_button_color 
								  pnfpb_ic_push_pwa_color" 
						   id="pnfpb_ic_fcm_subscribe_button_color" 
						   name="pnfpb_ic_fcm_subscribe_button_color" type="color" 
						   value="<?php if (
         							get_option("pnfpb_ic_fcm_subscribe_button_color")
     							) {
         							echo esc_attr(get_option("pnfpb_ic_fcm_subscribe_button_color"));
     							} else {
         							echo esc_attr("#aaaaaa");
     							} ?>" 
					/>
				</td>
			</tr>
    		<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_subscribe_button_text_color">
						<?php echo esc_html(
          					__(
              					"Subscribe/Un-subscribe button text color",
              					"push-notification-for-post-and-buddypress"
          					)
      					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field 
								  pnfpb_ic_pwa_prompt_install_text_color pnfpb_ic_push_pwa_color" 
						   id="pnfpb_ic_fcm_subscribe_button_text_color" 
						   name="pnfpb_ic_fcm_subscribe_button_text_color" type="color" 
						   value="<?php if (
         							get_option("pnfpb_ic_fcm_subscribe_button_text_color")
     							) {
         							echo esc_attr(get_option("pnfpb_ic_fcm_subscribe_button_text_color"));
     							} else {
         							echo esc_attr("#ffffff");
     							} ?>"  
					/>			
				</td>
			</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
				<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<h3 class="pnfpb_ic_push_settings_header">
						<?php echo esc_html(
       						__(
           						"BuddyPress Group subscribe/unsubscribe button customization",
           						"push-notification-for-post-and-buddypress"
       						)
   						); ?>
					</h3>
				</td>
			</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
            	<td class="pnfpb_ic_push_settings_table_label column-columnname">
					<div class="pnfpb_row">
						<div class="pnfpb_column_400">
							<div class="pnfpb_card">
								<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_padding_top_8" for="pnfpb_subscribe_group_push_notification_icon_enable">
									<label class="pnfpb_switch">
										<input  id="pnfpb_subscribe_group_push_notification_icon_enable" name="pnfpb_subscribe_group_push_notification_icon_enable" type="checkbox" 											value="1" <?php checked(
              									"1",
              									esc_attr(get_option("pnfpb_subscribe_group_push_notification_icon_enable"))
          									); ?>  />
										<span class="pnfpb_slider round"></span>
									</label>
										<?php echo esc_html(
              									__(
                  									"Show/Hide subscribe/unsubscribe group icon",
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
					<label for="pnfpb_ic_fcm_subscribe_button_text">
					<?php echo esc_html(
           				__(
               				"Group subscription button text",
               				"push-notification-for-post-and-buddypress"
           				)
       				); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_subscribe_button_text" 
						   name="pnfpb_ic_fcm_subscribe_button_text" type="text" 					
						   value="<?php if (
    							get_option("pnfpb_ic_fcm_subscribe_button_text")
							) {
    							echo esc_attr(get_option("pnfpb_ic_fcm_subscribe_button_text"));
							} else {
    							echo esc_attr(
        						__(
            						"Subscribe push notification",
            						"push-notification-for-post-and-buddypress"
        						)
    							);
							} ?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">				
            		<table>
						<tr>
                			<td class="column-columnname">
                    			<input type="button" 
									   value="<?php echo esc_attr(
                           				__(
                               				"Select Image",
                               				"push-notification-for-post-and-buddypress"
                           				)
                       					); ?>" 
									   id="pnfpb_select_subscribe_group_push_notification_icon" class="pnfpb_ic_push_pwa_settings_upload_icon" 
								/>
                    			<input type="hidden" id="pnfpb_subscribe_group_push_notification_icon" name="pnfpb_subscribe_group_push_notification_icon" 
									   value="<?php if (
                           					get_option(
                               					"pnfpb_subscribe_group_push_notification_icon"
                           					)
                       					) {
                           					echo esc_attr(
                               					get_option(
                                   					"pnfpb_subscribe_group_push_notification_icon"
                               					)
                           					);
                       					} else {
                           					echo esc_attr(
                               					plugin_dir_url(__DIR__) .
                                   					"public/img/icon_push_subscribe.png"
                           					);
                       					} ?>" />
                			</td>
						</tr>
						<tr>							
							<td class="column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_subscribe_group_push_notification_icon_preview" style="background-image: url(<?php if (
                               get_option(
                                   "pnfpb_subscribe_group_push_notification_icon"
                               )
                           ) {
                               echo esc_url(
                                   get_option(
                                       "pnfpb_subscribe_group_push_notification_icon"
                                   )
                               );
                           } else {
                               echo esc_url(
                                   plugin_dir_url(__DIR__) .
                                       "public/img/icon_push_subscribe.png"
                               );
                           } ?>);width:16px; height:30px;overflow:hidden;border-radius:0%;margin:0px auto;background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
                    			</div>
                			</td>
            			</tr>
					</table>
				</td>
			</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_unsubscribe_button_text">
						<?php echo esc_html(
           					__(
               					"Group unsubscription button text",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_unsubscribe_button_text" 
						   name="pnfpb_ic_fcm_unsubscribe_button_text" type="text" 
						   value="<?php if (
    								get_option("pnfpb_ic_fcm_unsubscribe_button_text")
								) {
    								echo esc_attr(get_option("pnfpb_ic_fcm_unsubscribe_button_text"));
								} else {
    								echo esc_attr(
        								__(
            								"Unsubscribe push notification",
            								"push-notification-for-post-and-buddypress"
        								)
    								);
								} ?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
        		<td class="pnfpb_ic_push_settings_table_ondemand_label_column column-columnname">				
            		<table>
						<tr>
                			<td class="column-columnname">
                    			<input type="button" value="<?php echo esc_attr(
                           				__(
                               				"Select Image",
                               				"push-notification-for-post-and-buddypress"
                           				)
                       				); ?>" 
									   id="pnfpb_select_unsubscribe_group_push_notification_icon" 
									   class="pnfpb_ic_push_pwa_settings_upload_icon" 
								/>
                    			<input type="hidden" id="pnfpb_unsubscribe_group_push_notification_icon" 
									   name="pnfpb_unsubscribe_group_push_notification_icon" 
									   value="<?php if (
                           							get_option(
                               							"pnfpb_unsubscribe_group_push_notification_icon"
                           							)
                       							) {
                           							echo esc_attr(
                               							get_option(
                                   							"pnfpb_unsubscribe_group_push_notification_icon"
                               							)
                           							);
                       							} else {
                           							echo esc_attr(
                               							plugin_dir_url(__DIR__) .
                                   						"public/img/icon_push_unsubscribe.png"
                           							);
                       							} ?>" 
								/>
                			</td>
						</tr>
						<tr>							
							<td class="column-columnname">
                    			<div style="display:block;width:100%; overflow:hidden; text-align:center;">
                        			<div id="pnfpb_unsubscribe_group_push_notification_icon_preview" style="background-image: url(
									<?php if (
                               				get_option(
                                   				"pnfpb_unsubscribe_group_push_notification_icon"
                               				)
                           				) {
                               				echo esc_url(
                                   				get_option(
                                       				"pnfpb_unsubscribe_group_push_notification_icon"
                                  			 	)
                               				);
                           				} else {
                               				echo esc_url(
                                   				plugin_dir_url(__DIR__) .
                                       			"public/img/icon_push_unsubscribe.png"
                               				);
                           				} ?>);width:16px; height:30px;overflow:hidden;border-radius:0%;margin:0px auto;background-position:center center;background-repeat:no-repeat;background-size:cover;">
									</div>
                    			</div>
                			</td>
            			</tr>
					</table>
				</td>
			</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_group_subscribe_dialog_text">
						<?php echo esc_html(
           					__(
               					"Group subscription dialog text",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_group_subscribe_dialog_text" name="pnfpb_ic_fcm_group_subscribe_dialog_text" type="text" 
						   value="<?php if (
    									get_option("pnfpb_ic_fcm_group_subscribe_dialog_text")
									) {
    									echo esc_attr(get_option("pnfpb_ic_fcm_group_subscribe_dialog_text"));
									} else {
    									echo esc_attr(
        									__(
            									"Would you like to subscribe notifications for this group?",
            									"push-notification-for-post-and-buddypress"
        									)
    									);
									} ?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_group_subscribe_dialog_text_confirm">
						<?php echo esc_html(
           					__(
               					"Group subscription dialog text after complete",
               					"push-notification-for-post-and-buddypress"
           						)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_group_subscribe_dialog_text_confirm" 
						   name="pnfpb_ic_fcm_group_subscribe_dialog_text_confirm" type="text" 
						   value="<?php if (
    									get_option("pnfpb_ic_fcm_group_subscribe_dialog_text_confirm")
									) {
    									echo esc_attr(
        									get_option("pnfpb_ic_fcm_group_subscribe_dialog_text_confirm")
    									);
									} else {
    									echo esc_attr(
        									__(
            									"Your device is subscribed",
           										 "push-notification-for-post-and-buddypress"
        									)
    									);
									} ?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_group_unsubscribe_dialog_text">
						<?php echo esc_html(
           					__(
               					"Group unsubscription dialog text",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_ic_fcm_group_unsubscribe_dialog_text" 
						   name="pnfpb_ic_fcm_group_unsubscribe_dialog_text" type="text" 
						   value="<?php if (
    									get_option("pnfpb_ic_fcm_group_unsubscribe_dialog_text")
									) {
    									echo esc_attr(get_option("pnfpb_ic_fcm_group_unsubscribe_dialog_text"));
									} else {
    									echo esc_attr(
        									__(
            									"Would you like to unsubscribe notifications for this group?",
            									"push-notification-for-post-and-buddypress"
        									)
    									);
									} ?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm">
						<?php echo esc_html(
           					__(
               					"Group unsubscription dialog text after complete",
               					"push-notification-for-post-and-buddypress"
           						)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  
						   id="pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm" 
						   name="pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm" type="text" 
						   value="<?php if (
    									get_option("pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm")
									) {
    									echo esc_attr(
        									get_option("pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm")
    									);
									} else {
    									echo esc_attr(
        									__(
            									"Your device is unsubscribed",
            									"push-notification-for-post-and-buddypress"
        									)
    									);
									} ?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
				<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<h3 class="pnfpb_ic_push_settings_header">
						<?php echo esc_html(
       						__(
           						"Shortcode subscribe options text customization [subscribe_PNFPB_push_notification]",
           						"push-notification-for-post-and-buddypress"
       						)
   						); ?>
					</h3>
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
                         										"Customize Bell prompt icon in shortcode, Button color and text",
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
                    											<button id="pnfpb_ic_fcm_popup_icon_shortcode" 
																		class="pnfpb_ic_push_settings_upload_icon_shortcode">
																	<?php echo esc_html(
                     													__(
                         													"Upload Icon",
                         													"push-notification-for-post-and-buddypress"
                     													)
                 												); ?>
																</button>
                    											<input type="hidden" id="pnfpb_ic_fcm_popup_subscribe_button_icon_shortcode" 
																	   name="pnfpb_ic_fcm_popup_subscribe_button_icon_shortcode" 
																	   value="<?php if (
                                   											get_option(
                                       											"pnfpb_ic_fcm_popup_subscribe_button_icon_shortcode"
                                   											)
                               												) {
                                   												echo esc_attr(
                                       												get_option(
                                           												"pnfpb_ic_fcm_popup_subscribe_button_icon_shortcode"
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
                        											<div id="pnfpb_ic_fcm_popup_subscribe_button_icon_preview_shortcode" 
																		 style="background-image: url(
																			<?php if (
                                       											get_option(
                                           											"pnfpb_ic_fcm_popup_subscribe_button_icon_shortcode"
                                       											)
                                   											) {
                                       											echo esc_url(
                                           											get_option(
                                              									 		"pnfpb_ic_fcm_popup_subscribe_button_icon_shortcode"
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
														   id="pnfpb_ic_fcm_popup_header_text_shortcode" name="pnfpb_ic_fcm_popup_header_text_shortcode" 
														   type="text" 
														   value="<?php if (
                 												get_option("pnfpb_ic_fcm_popup_header_text_shortcode")
             												) {
                 												echo esc_attr(
                     												get_option("pnfpb_ic_fcm_popup_header_text_shortcode")
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
														   id="pnfpb_ic_fcm_popup_subscribe_button_text_color_shortcode" 
														   name="pnfpb_ic_fcm_popup_subscribe_button_text_color_shortcode" 
														   type="color" 
														   value="<?php if (
                 														get_option("pnfpb_ic_fcm_popup_subscribe_button_text_color_shortcode")
             														) {
                 														echo esc_attr(
                     														get_option(
                         														"pnfpb_ic_fcm_popup_subscribe_button_text_color_shortcode"
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
														   id="pnfpb_ic_fcm_popup_subscribe_button_color_shortcode" 
														   name="pnfpb_ic_fcm_popup_subscribe_button_color_shortcode" type="color" 
														   value="<?php if (
                 													get_option("pnfpb_ic_fcm_popup_subscribe_button_color_shortcode")
             													) {
                 													echo esc_attr(
                     													get_option("pnfpb_ic_fcm_popup_subscribe_button_color_shortcode")
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
														   id="pnfpb_ic_fcm_popup_subscribe_button_shortcode" 
														   name="pnfpb_ic_fcm_popup_subscribe_button_shortcode" type="text" 
														   value="<?php if (
                 													get_option("pnfpb_ic_fcm_popup_subscribe_button_shortcode")
             													) {
                 													echo esc_attr(
                     													get_option("pnfpb_ic_fcm_popup_subscribe_button_shortcode")
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
														   id="pnfpb_ic_fcm_popup_unsubscribe_button_shortcode" 
														   name="pnfpb_ic_fcm_popup_unsubscribe_button_shortcode" 
														   type="text" value="<?php if (
                 												get_option("pnfpb_ic_fcm_popup_unsubscribe_button_shortcode")
             												) {
                 												echo esc_attr(
                     												get_option("pnfpb_ic_fcm_popup_unsubscribe_button_shortcode")
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
														   id="pnfpb_ic_fcm_popup_subscribe_message_shortcode" 
														   name="pnfpb_ic_fcm_popup_subscribe_message_shortcode" type="text" 
														   value="<?php if (
                 													get_option("pnfpb_ic_fcm_popup_subscribe_message_shortcode")
             													) {
                 													echo esc_attr(
                     													get_option("pnfpb_ic_fcm_popup_subscribe_message_shortcode")
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
														   id="pnfpb_ic_fcm_popup_unsubscribe_message_shortcode" 
														   name="pnfpb_ic_fcm_popup_unsubscribe_message_shortcode" type="text" 
														   value="<?php if (
                 													get_option("pnfpb_ic_fcm_popup_unsubscribe_message_shortcode")
             													) {
                 													echo esc_attr(
                     													get_option("pnfpb_ic_fcm_popup_unsubscribe_message_shortcode")
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
														   id="pnfpb_ic_fcm_popup_wait_message_shortcode" 
														   name="pnfpb_ic_fcm_popup_wait_message_shortcode" 
														   type="text" value="<?php if (
                 												get_option("pnfpb_ic_fcm_popup_wait_message_shortcode")
             												) {
                 												echo esc_attr(
                     												get_option("pnfpb_ic_fcm_popup_wait_message_shortcode")
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
														   for="pnfpb_bell_icon_prompt_options_on_off_shortcode">
														<?php echo esc_html(
                  											__(
                      											"Show subscription options button",
                      											"push-notification-for-post-and-buddypress"
                  											)
              											); ?>
													</label>												
													<label class="pnfpb_switch">
														<input  id="pnfpb_bell_icon_prompt_options_on_off_shortcode" 
															   name="pnfpb_bell_icon_prompt_options_on_off_shortcode" 
															   type="checkbox" value="1" <?php if (
                  												get_option("pnfpb_bell_icon_prompt_options_on_off_shortcode", "0") ===
                     											 "0" ||
                  												get_option("pnfpb_bell_icon_prompt_options_on_off_shortcode", "0") ===
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
								<?php
					   $args = [
						   "public" => true,
						   "_builtin" => false,
					   ];

					   $output = "names"; // or objects
					   $operator = "and"; // 'and' or 'or'

					   $custposttypes = get_post_types($args, $output, $operator);

					   foreach ($custposttypes as $post_type) {
						   if ($post_type !== "buddypress") { ?>		
						<tr class="pnfpb_ic_push_settings_table_row">
    						<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
								<label 
									   for="<?php echo esc_attr( "pnfpb_bell_icon_subscription_option_". $post_type."_text"); ?>">
									<?php echo esc_html(
    									__(
       								 	"Customize text for subscription ",
        								"push-notification-for-post-and-buddypress"
    									)
									) .	esc_html($post_type); ?>
							</label>
								<br/>
								<input class="pnfpb_ic_push_settings_table_value_column_input_field"  
									   id="<?php echo esc_html("pnfpb_bell_icon_subscription_option_".$post_type."_text_shortcode"); ?>" 
									   name="<?php echo esc_html("pnfpb_bell_icon_subscription_option_".$post_type."_text_shortcode"); ?>" 
									   type="text" 
									   value="<?php if (
    											get_option("pnfpb_bell_icon_subscription_option_" . $post_type . "_text_shortcode")
											) {
    											echo esc_attr(
        											get_option("pnfpb_bell_icon_subscription_option_" . $post_type . "_text_shortcode")
    											);
											} else {
    											echo esc_attr(ucwords($post_type));
											} 
										?>" 
								/>
							</td>
    					</tr>						
				<?php }
   }
   ?>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_subscribe_text_shortcode">
						<?php echo esc_html(
           					__(
               					"Subscribe all notifications option text in shortcode",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_bell_icon_subscription_option_all_text_shortcode" name="pnfpb_bell_icon_subscription_option_all_text_shortcode" type="text" 
						   value="<?php if (
    									get_option("pnfpb_bell_icon_subscription_option_all_text_shortcode")
									) {
    									echo esc_attr(get_option("pnfpb_bell_icon_subscription_option_all_text_shortcode"));
									} else {
    									echo esc_attr(
        										__(
            										"Subscribe all",
            										"push-notification-for-post-and-buddypress"
        										)
    									);
									} ?>" 
					/>
				</td>
    		</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_subscribe_dialog_text">
						<?php echo esc_html(
           					__(
               					"New post notifications option text in shortcode",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_bell_icon_subscription_option_post_text_shortcode" 
						   name="pnfpb_bell_icon_subscription_option_post_text_shortcode" type="text" 
						   value="<?php if (
    									get_option("pnfpb_bell_icon_subscription_option_post_text_shortcode")
									) {
    									echo esc_attr(get_option("pnfpb_bell_icon_subscription_option_post_text_shortcode"));
									} else {
    									echo esc_attr(__("New post", "push-notification-for-post-and-buddypress"));
									} ?>" 
					/>
				</td>
    		</tr>			
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_bell_icon_subscription_option_text_shortcode">
						<?php echo esc_html(
           					__(
               					"New BuddyPress activity notifications option text in shortcode",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_bell_icon_subscription_option_activity_text_shortcode" 
						   name="pnfpb_bell_icon_subscription_option_activity_text_shortcode" type="text" 
						   value="<?php if (
    									get_option("pnfpb_bell_icon_subscription_option_activity_text_shortcode")
									) {
    									echo esc_attr(
        									get_option("pnfpb_bell_icon_subscription_option_activity_text_shortcode")
    									);
									} else {
    									echo esc_attr(
        									__("New post/activity", "push-notification-for-post-and-buddypress")
    									);
									} ?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_bell_icon_subscription_option_text_shortcode">
						<?php echo esc_html(
           					__(
               					"Subscribe all comments notifications option text in shortcode",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_bell_icon_subscription_option_all_comments_text_shortcode" 
						   name="pnfpb_bell_icon_subscription_option_all_comments_text_shortcode" type="text" 
						   value="<?php if (
    									get_option("pnfpb_bell_icon_subscription_option_all_comments_text_shortcode")
									) {
    									echo esc_attr(
        									get_option("pnfpb_bell_icon_subscription_option_all_comments_text_shortcode")
    									);
									} else {
    										echo esc_attr(__("Comments", "push-notification-for-post-and-buddypress"));
									} ?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_bell_icon_subscription_option_text_shortcode">
						<?php echo esc_html(
           					__(
               					"Subscribe comments notifications only from my post/my BuddyPress activities option text in shortcode",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_bell_icon_subscription_option_my_comments_text_shortcode" 
						   name="pnfpb_bell_icon_subscription_option_my_comments_text_shortcode" type="text" 
						   value="<?php if (
    									get_option("pnfpb_bell_icon_subscription_option_my_comments_text_shortcode")
									) {
    									echo esc_attr(get_option("pnfpb_bell_icon_subscription_option_my_comments_text_shortcode"));
									} else {
    									echo esc_attr(
        									__(
            									"Comments on my posts/my activities ",
           										 "push-notification-for-post-and-buddypress"
        									)
    									);
									} ?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_bell_icon_subscription_option_subscribe_text_shortcode">
						<?php echo esc_html(
           					__(
               					"Subscribe Private messages option text in shortcode",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_bell_icon_subscription_option_private_message_text_shortcode" 
						   name="pnfpb_bell_icon_subscription_option_private_message_text_shortcode" type="text" 
						   value="<?php if (
    									get_option("pnfpb_bell_icon_subscription_option_private_message_text_shortcode")
									) {
    									echo esc_attr(
        									get_option("pnfpb_bell_icon_subscription_option_private_message_text_shortcode")
    									);
									} else {
    										echo esc_attr(
        										__("Private message", "push-notification-for-post-and-buddypress")
    										);
									} ?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_bell_icon_subscription_option_text_shortcode">
						<?php echo esc_html(
           					__(
               					"Subscribe new member joined option text in shortcode",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_bell_icon_subscription_option_new_member_text_shortcode" 
						   name="pnfpb_bell_icon_subscription_option_new_member_text_shortcode" type="text" 
						   value="<?php if (
    									get_option("pnfpb_bell_icon_subscription_option_new_member_text_shortcode")
									) {
    									echo esc_attr(get_option("pnfpb_bell_icon_subscription_option_new_member_text_shortcode"));
									} else {
    									echo esc_attr(
        									__("New member joined", "push-notification-for-post-and-buddypress")
    									);
									} ?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_bell_icon_subscription_option_subscribe_dialog_text">
						<?php echo esc_html(
           					__(
               					"Subscribe Friend request option text in shortcode",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_bell_icon_subscription_option_friend_request_text_shortcode" 
						   name="pnfpb_bell_icon_subscription_option_friend_request_text_shortcode" type="text" 
						   value="<?php if (
    										get_option("pnfpb_bell_icon_subscription_option_friend_request_text_shortcode")
										) {
    										echo esc_attr(
        										get_option("pnfpb_bell_icon_subscription_option_friend_request_text_shortcode")
    										);
										} else {
    										echo esc_attr(
        										__("Friend request", "push-notification-for-post-and-buddypress")
    										);
										} ?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_bell_icon_subscription_option_subscribe_text_shortcode">
						<?php echo esc_html(
           					__(
               					"Subscribe Friendship accepted text in shortcode",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_bell_icon_subscription_option_friendship_accepted_text_shortcode" 
						   name="pnfpb_bell_icon_subscription_option_friendship_accepted_text_shortcode" type="text" 
						   value="<?php if (
    									get_option("pnfpb_bell_icon_subscription_option_friendship_accepted_text_shortcode")
									) {
    									echo esc_attr(
        									get_option("pnfpb_bell_icon_subscription_option_friendship_accepted_text_shortcode")
    									);
									} else {
    									echo esc_attr(
        									__("Friendship accepted ", "push-notification-for-post-and-buddypress")
    									);
									} ?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_bell_icon_subscription_option_text_shortcode">
						<?php echo esc_html(
           					__(
               					"Subscribe user avatar change option text in shortcode",
               					"push-notification-for-post-and-buddypress"
          					 )
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_bell_icon_subscription_option_user_avatar_text_shortcode" 
						   name="pnfpb_bell_icon_subscription_option_user_avatar_text_shortcode" type="text" 
						   value="<?php if (
    									get_option("pnfpb_bell_icon_subscription_option_user_avatar_text_shortcode")
									) {
    									echo esc_attr(get_option("pnfpb_bell_icon_subscription_option_user_avatar_text_shortcode"));
									} else {
    									echo esc_attr(
        									__("User avatar change", "push-notification-for-post-and-buddypress")
    									);
									} ?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_subscribe_text_shortcode">
						<?php echo esc_html(
           					__(
               					"Subscribe cover image change option text in shortcode",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_bell_icon_subscription_option_cover_image_text_shortcode" 
						   name="pnfpb_bell_icon_subscription_option_cover_image_text_shortcode" type="text" 
						   value="<?php if (
    									get_option("pnfpb_bell_icon_subscription_option_cover_image_text_shortcode")
									) {
    									echo esc_attr(get_option("pnfpb_bell_icon_subscription_option_cover_image_text_shortcode"));
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
					<label for="pnfpb_ic_fcm_subscribe_text_shortcode">
						<?php echo esc_html(
           					__(
               					"Subscribe Group details update option text in shortcode",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_bell_icon_subscription_option_group_details_update_text_shortcode" 
						   name="pnfpb_bell_icon_subscription_option_group_details_update_text_shortcode" type="text" 
						   value="<?php if (
    									get_option("pnfpb_bell_icon_subscription_option_group_details_update_text_shortcode")
									) {
    									echo esc_attr(get_option("pnfpb_bell_icon_subscription_option_group_details_update_text_shortcode"));
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
					<label for="pnfpb_ic_fcm_subscribe_text_shortcode">
						<?php echo esc_html(
           					__(
               					"Group invite option text in shortcode",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_bell_icon_subscription_option_group_invite_text_shortcode" 
						   name="pnfpb_bell_icon_subscription_option_group_invite_text_shortcode" type="text" 
						   value="<?php if (
    									get_option("pnfpb_bell_icon_subscription_option_group_invite_text_shortcode")
									) {
    									echo esc_attr(get_option("pnfpb_bell_icon_subscription_option_group_invite_text_shortcode"));
									} else {
    									echo esc_attr(
        									__("Group invite", "push-notification-for-post-and-buddypress")
    									);
									} ?>" 
					/>
				</td>
    		</tr>				
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_bell_icon_subscription_option_text_shortcode_confirm">
						<?php echo esc_html(
           					__(
               					"Site Subscription dialog text after complete using shortcode",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_bell_icon_subscription_option_text_shortcode_confirm" 
						   name="pnfpb_bell_icon_subscription_option_text_shortcode_confirm" type="text" 
						   value="<?php if (
    									get_option("pnfpb_bell_icon_subscription_option_text_shortcode_confirm")
									) {
    									echo esc_attr(get_option("pnfpb_bell_icon_subscription_option_text_shortcode_confirm"));
									} else {
    									echo esc_attr(
        									__(
            									"Subscription option updated",
            									"push-notification-for-post-and-buddypress"
        									)
    									);
									} ?>" 
					/>
				</td>
    		</tr>				
			<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_bell_icon_subscription_text_shortcode_text_confirm">
						<?php echo esc_html(
           					__(
               					"Site unsubscription dialog text after complete using shortcode",
               					"push-notification-for-post-and-buddypress"
           					)
       					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"  id="pnfpb_bell_icon_subscription_text_shortcode_text_confirm" 
						   name="pnfpb_bell_icon_subscription_text_shortcode_text_confirm" type="text" 
						   value="<?php if (
    									get_option("pnfpb_bell_icon_subscription_text_shortcode_text_confirm")
									) {
    									echo esc_attr(get_option("pnfpb_bell_icon_subscription_text_shortcode_text_confirm"));
									} else {
    									echo esc_attr(
        									__(
            									"Subscription option updated",
            									"push-notification-for-post-and-buddypress"
        									)
    									);
									} ?>" 
					/>
				</td>
    		</tr>
			<tr class="pnfpb_ic_push_settings_table_row">
				<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<h3 class="pwa-install-shortcode-customize-section pnfpb_ic_push_settings_header">
						<a id="pwa-install-shortcode-customize-section" href="#pwa-install-shortcode-customize-section">
							<?php echo esc_html(
       							__(
           							"PWA Install shortcode button customization",
           							"push-notification-for-post-and-buddypress"
       							)
   							); ?>
						</a>
					</h3>
					<h5 class="pnfpb_ic_push_settings_header">
						<?php echo esc_html(
    						__("[PNFPB_PWA_PROMPT]", "push-notification-for-post-and-buddypress")
						); ?>
					</h5>
				</td>
			</tr>
   	 		<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_install_pwa_shortcode_button_color">
						<?php echo esc_html(
          					__(
              					"Install PWA shortcode button background color",
              					"push-notification-for-post-and-buddypress"
          					)
      					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field 
								  pnfpb_ic_pwa_prompt_install_button_color pnfpb_ic_push_pwa_color" 
						   id="pnfpb_ic_fcm_install_pwa_shortcode_button_color" name="pnfpb_ic_fcm_install_pwa_shortcode_button_color" 
						   type="color" value="<?php if (
         						get_option("pnfpb_ic_fcm_install_pwa_shortcode_button_color")
     						) {
         						echo esc_attr(
             						get_option("pnfpb_ic_fcm_install_pwa_shortcode_button_color")
         						);
     						} else {
         						echo esc_attr("#000000");
     						} ?>" 
					/>
				</td>
			</tr>
   	 		<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_install_pwa_shortcode_button_text_color">
						<?php echo esc_html(
          					__(
              					"Install PWA shortcode button text color",
              					"push-notification-for-post-and-buddypress"
          					)
      					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field 
								  pnfpb_ic_pwa_prompt_install_button_color pnfpb_ic_push_pwa_color" 
						   id="pnfpb_ic_fcm_install_pwa_shortcode_button_text_color" name="pnfpb_ic_fcm_install_pwa_shortcode_button_text_color" 
						   type="color" 
						   value="<?php if (
         								get_option("pnfpb_ic_fcm_install_pwa_shortcode_button_text_color")
     								) {
         								echo esc_attr(
             								get_option("pnfpb_ic_fcm_install_pwa_shortcode_button_text_color")
         								);
     								} else {
         								echo esc_attr("#ffffff");
     								} ?>" 
					/>
				</td>
			</tr>
   	 		<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<label for="pnfpb_ic_fcm_install_pwa_shortcode_button_text_color">
						<?php echo esc_html(
          					__(
              					"Install PWA shortcode button text",
              					"push-notification-for-post-and-buddypress"
          					)
      					); ?>
					</label>
					<br/>
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_pwa_prompt_install_button_color pnfpb_ic_push_pwa_color" 
						   id="pnfpb_ic_fcm_install_pwa_shortcode_button_text" 
						   name="pnfpb_ic_fcm_install_pwa_shortcode_button_text" type="text" 
						   value="<?php if (
         								get_option("pnfpb_ic_fcm_install_pwa_shortcode_button_text")
     								) {
         								echo esc_attr(
             								get_option("pnfpb_ic_fcm_install_pwa_shortcode_button_text")
         								);
     								} else {
         								echo esc_attr("Install PWA");
     								} ?>" 
					/>
				</td>
			</tr>
   	 		<tr class="pnfpb_ic_push_settings_table_row">
    			<td class="pnfpb_ic_push_settings_table_label_column column-columnname">
					<div class="pnfpb_row">
  						<div class="pnfpb_column">
    						<div class="pnfpb_card">				
								<label for="pnfpb-pwa-shortcode-install-icon">
									<?php echo esc_html(
            							__(
                							"Show PWA icon instead of text in PWA install shortcode button",
                							"push-notification-for-post-and-buddypress"
            							)
        							); ?>
								</label>
								<label class="pnfpb_switch">
									<input  id="pnfpb-pwa-shortcode-install-icon" name="pnfpb-pwa-shortcode-install-icon" 
										   type="checkbox" value="1" <?php checked(
             									"1",
             									esc_attr(get_option("pnfpb-pwa-shortcode-install-icon"))
         									); ?>  />	
									<span class="pnfpb_slider round"></span>
								</label>
								<label for="pnfpb-pwa-shortcode-install-icon">
									<?php echo esc_html(
             							__(
                 							"PWA app icon 132px size for PWA install widget. ",
                 							"push-notification-for-post-and-buddypress"
             							)
         								); ?>
								</label>								
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class="column-columnname">
					<div class="pnfpb_column_full">
						<?php submit_button(
        					__("Save changes", "push-notification-for-post-and-buddypress"),
        					"pnfpb_ic_push_save_configuration_button"
    					); ?>
					</div>
				</td>
    		</tr>
  		</tbody>
	</table>
</form>
</div>