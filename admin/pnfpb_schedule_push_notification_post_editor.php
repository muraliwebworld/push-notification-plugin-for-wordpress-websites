<?php
$post_type = $post->post_type;

$pnfpb_post_meta_send_push_notification = get_post_meta(
    $post->ID,
    "pnfpb_push_notification_send_checkbox",
    true
);

$onetime_push_date_field_timestamp = get_post_meta(
    $post->ID,
    "pnfpb_ic_fcm_token_ondemand_datepicker_post",
    true
);

$onetime_push_time_field_timestamp = get_post_meta(
    $post->ID,
    "pnfpb_ic_fcm_token_ondemand_timepicker_post",
    true
);

$onetime_recurring_day_number = get_post_meta(
    $post->ID,
    "pnfpb_ic_fcm_token_ondemand_repeat_day_number_post",
    true
);

$onetime_recurring_month_number = get_post_meta(
    $post->ID,
    "pnfpb_ic_fcm_token_ondemand_repeat_month_post",
    true
);

$onetime_recurring_day_name = get_post_meta(
    $post->ID,
    "pnfpb_ic_fcm_token_ondemand_repeat_day_post",
    true
);

if (empty($onetime_push_date_field_timestamp)) {
    $onetime_push_date_field = "";
} else {
    $onetime_push_date_field = gmdate(
        "Y-m-d",
        $onetime_push_date_field_timestamp
    );
}

if (empty($onetime_push_time_field_timestamp)) {
    $onetime_push_time_field = "";
} else {
    $onetime_push_time_field = gmdate(
        "H:i:s",
        $onetime_push_time_field_timestamp
    );
}

if (empty($onetime_recurring_day_number)) {
    $onetime_recurring_day_number = "";
}

if (empty($onetime_recurring_month_number)) {
    $onetime_recurring_month_number = "";
}

if (empty($onetime_recurring_day_name)) {
    $onetime_recurring_day_name = "";
}
?>

	    	<input type="hidden" name="pnfpb_send_notification_meta_box" value="true"/>

      		<fieldset id="pnfpb_push_notification_send_layout">
				
        		<label>
					<?php if (
         				get_option("pnfpb_ic_fcm_" . $post_type . "_enable") === "1" &&
         				$post->post_status !== "publish"
     				) { ?>
						<input type="checkbox" id="pnfpb_push_notification_send_checkbox" name="pnfpb_push_notification_send_checkbox" value="1" checked/>
	
					<?php } else { ?>
          				<input type="checkbox" id="pnfpb_push_notification_send_checkbox" name="pnfpb_push_notification_send_checkbox" value="1" />
					<?php } ?>
				
          			<?php if ($post->post_status === "publish") {
                 		echo esc_html(
                     		"Send notification on " . $post_type . " update"
                 		);
             		} else {
                 		echo esc_html(
                     		"Send notification on " . $post_type . " publish"
                 	);
             } ?>
				
        		</label>
				<br/><br/>
  				<div class="pnfpb_column_400 pnfpb_schedule_push_notification_post_editor">
					<label for="pnfpb_schedule_push_notification_post_editor" 
						class="post-format-icon pnfpb_schedule_push_notification_post_editor_label">
						<?php echo esc_html(
          				__(
              				"Schedule push notification",
              				"push-notification-for-post-and-buddypress"
          					)
      					); ?>
					</label>
					<br/><br/>
					<label>
						<?php echo esc_html(
          					get_post_meta($post->ID, "pnfpb_post_schedule", true)
      					); ?>
					</label>					
    				<div class="pnfpb_schedule_later_ondemand">
						<label class="pnfpb_ic_push_settings_table_label_checkbox 
									  pnfpb_ic_push_settings_table_label_schedule_later_ondemand" 
							   for="pnfpb_ic_fcm_token_ondemand_datepicker">
							<?php echo esc_html(
            					__("Select date", "push-notification-for-post-and-buddypress")
        					); ?>
						</label>
						<br/>
						<input  id="pnfpb_ic_fcm_token_ondemand_datepicker_post" 
							   name="pnfpb_ic_fcm_token_ondemand_datepicker_post" 
							   type="date" value="<?php if (
           								$onetime_push_date_field != ""
       								) {
           								echo esc_attr($onetime_push_date_field);
       								} ?>" 
						/>
						<br/><br/>
						<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_ic_push_settings_table_label_schedule_later_ondemand" for="pnfpb_ic_fcm_token_ondemand_timepicker">
							<?php echo esc_html(
            					__("Select time", "push-notification-for-post-and-buddypress")
        					); ?>
						</label>
						<br/>
						<input  id="pnfpb_ic_fcm_token_ondemand_timepicker_post" 
							   name="pnfpb_ic_fcm_token_ondemand_timepicker_post" 
							   type="time" value="<?php if (
           							$onetime_push_time_field != ""
       							) {
           							echo esc_attr($onetime_push_time_field);
       					} ?>" />
							<br/><br/>
							<label class="pnfpb_ic_push_settings_table_label_checkbox 
										  pnfpb_ic_push_settings_table_label_schedule_later_ondemand" 
								   for="pnfpb_ic_fcm_token_ondemand_repeat">
									<?php echo esc_html(
            						__(
                						"Repeat every (Recurring)",
                						"push-notification-for-post-and-buddypress"
            						)
        						); ?>
							</label>
							<br/>
							<select id="pnfpb_ic_fcm_token_ondemand_repeat_day_number" 
									name="pnfpb_ic_fcm_token_ondemand_repeat_day_number">
								<option value="" 
										<?php if ($onetime_recurring_day_number === "") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
									>
									<?php echo esc_html( __("Select Day","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="1"  
										<?php if ($onetime_recurring_day_number === "1") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 1","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="2"  
										<?php if ($onetime_recurring_day_number === "2") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 2","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="3"  
										<?php if ($onetime_recurring_day_number === "3") {
            								echo esc_attr("selected");
        								} else {
           									 echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 3","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="4"  
										<?php if ($onetime_recurring_day_number === "4") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 4","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="5"  
										<?php if ($onetime_recurring_day_number === "5") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 5","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="6"  
										<?php if ($onetime_recurring_day_number === "6") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 6","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="7"  
										<?php if ($onetime_recurring_day_number === "7") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 7","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="8"  
										<?php if ($onetime_recurring_day_number === "8") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 8","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="9"  
										<?php if ($onetime_recurring_day_number === "9") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 9","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="10"  
										<?php if ($onetime_recurring_day_number === "10") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 10","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="11"  
										<?php if ($onetime_recurring_day_number === "11") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 11","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="12"  
										<?php if ($onetime_recurring_day_number === "12") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 12","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="13"  
										<?php if ($onetime_recurring_day_number === "13") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 13","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="14"  
										<?php if ($onetime_recurring_day_number === "14") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 14","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="15"  
										<?php if ($onetime_recurring_day_number === "15") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 15","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="16"  
										<?php if ($onetime_recurring_day_number === "16") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 16","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="17"  
										<?php if ($onetime_recurring_day_number === "17") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 17","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="18"  
										<?php if ($onetime_recurring_day_number === "18") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 18","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="19"  
										<?php if ($onetime_recurring_day_number === "19") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 19","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="20"  
										<?php if ($onetime_recurring_day_number === "20") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 20","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="21"  
										<?php if ($onetime_recurring_day_number === "21") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 21","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="22"  
										<?php if ($onetime_recurring_day_number === "22") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 22","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="23"  
										<?php if ($onetime_recurring_day_number === "23") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 23","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="24"  
										<?php if ($onetime_recurring_day_number === "24") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 24","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="25"  
										<?php if ($onetime_recurring_day_number === "25") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 25","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="26"  
										<?php if ($onetime_recurring_day_number === "26") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 26","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="27"  
										<?php if ($onetime_recurring_day_number === "27") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 27","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="28"  
										<?php if ($onetime_recurring_day_number === "28") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 28","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="29"  
										<?php if ($onetime_recurring_day_number === "29") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 29","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="30"  
										<?php if ($onetime_recurring_day_number === "30") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 30","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="31"  
										<?php if ($onetime_recurring_day_number === "31") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
								>
									<?php echo esc_html( __("Day 31","push-notification-for-post-and-buddypress"));?>
								</option>
							</select>
							<div class="pnfpb_ic_push_settings_table_margin_5px">
								<select id="pnfpb_ic_fcm_token_ondemand_repeat_month" 
									name="pnfpb_ic_fcm_token_ondemand_repeat_month">
								<option value=""  
									<?php if ($onetime_recurring_month_number === "") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("Select Month","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="*" 
									<?php if ($onetime_recurring_month_number === "*") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("Every Month","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="1" 
									<?php if ($onetime_recurring_month_number === "1") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("January","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="2" 
									<?php if ($onetime_recurring_month_number === "2") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("February","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="3" 
									<?php if ($onetime_recurring_month_number === "3") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("March","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="4" 
									<?php if ($onetime_recurring_month_number === "4") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("April","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="5" 
									<?php if ($onetime_recurring_month_number === "5") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("May","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="6" 
									<?php if ($onetime_recurring_month_number === "6") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("June","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="7" 
									<?php if ($onetime_recurring_month_number === "7") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("July","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="8" 
									<?php if ($onetime_recurring_month_number === "8") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("August","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="9" 
									<?php if ($onetime_recurring_month_number === "9") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("September","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="10" 
									<?php if ($onetime_recurring_month_number === "10") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("October","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="11" 
									<?php if ($onetime_recurring_month_number === "11") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("November","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="12" 
									<?php if ($onetime_recurring_month_number === "12") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("December","push-notification-for-post-and-buddypress"));?>
								</option>
							</select>
						</div>
						<div class="pnfpb_ic_push_settings_table_margin_5px">
							<label class="pnfpb_ic_push_settings_table_label_checkbox 
										  pnfpb_ic_push_settings_table_label_schedule_later_ondemand" 
								   for="pnfpb_ic_fcm_token_ondemand_repeat">
								<?php echo esc_html(
            						__("On day: ", "push-notification-for-post-and-buddypress")
        						); ?>
							</label>
							
							<select id="pnfpb_ic_fcm_token_ondemand_repeat_day" name="pnfpb_ic_fcm_token_ondemand_repeat_day">
								<option value="" 
										<?php if ($onetime_recurring_day_name === "") {
            								echo esc_attr("selected");
        								} else {
            								echo esc_attr("");
        								} ?>
									>
									<?php echo esc_html( __("Select Day name","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="*" 
									<?php if ($onetime_recurring_day_name === "*") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("Any day","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="7" 
									<?php if ($onetime_recurring_day_name === "7") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("Sunday","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="1" 
									<?php if ($onetime_recurring_day_name === "1") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("Monday","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="2" 
									<?php if ($onetime_recurring_day_name === "2") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("Tuesday","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="3" 
									<?php if ($onetime_recurring_day_name === "3") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("Wednesday","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="4" 
									<?php if ($onetime_recurring_day_name === "4") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("Thursday","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="5" 
									<?php if ($onetime_recurring_day_name === "5") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("Friday","push-notification-for-post-and-buddypress"));?>
								</option>
								<option value="6" 
									<?php if ($onetime_recurring_day_name === "6") {
            							echo esc_attr("selected");
        							} else {
            							echo esc_attr("");
        							} ?>
								>
									<?php echo esc_html( __("Saturday","push-notification-for-post-and-buddypress"));?>
								</option>
							</select>
						</div>
						</div>
						<br/><br/>
        				<label>
          						<input type="checkbox" id="pnfpb_push_notification_schedule_checkbox" name="pnfpb_push_notification_schedule_checkbox" value="1" />
							<?php echo esc_html("Enable schedule push notification"); ?>
        				</label>
				</div>	
			</fieldset>