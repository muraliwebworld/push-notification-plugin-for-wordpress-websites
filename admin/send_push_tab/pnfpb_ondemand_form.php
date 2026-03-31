<?php
/**
 * Send Push — form template (modern card layout).
 * Variables set by pnfpb_ondemand_process.php:
 *   $onetime_push_id, $onetime_push_title, $onetime_push_content,
 *   $onetime_push_imageurl, $onetime_push_clickurl,
 *   $onetime_recurring_day_number, $onetime_recurring_month_number,
 *   $onetime_recurring_day_name, $onetime_push_date_field, $onetime_push_time_field
 *
 * @since 2.08
 */
?>
<form method="post" enctype="multipart/form-data" class="form-field">

	<?php /* ─── Section 1: Compose Message ────────────────────────────── */ ?>
	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-megaphone pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'Compose Message', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>

		<div class="pnfpb-info-box pnfpb-info-box--blue">
			<span class="dashicons dashicons-update"></span>
			<?php esc_html_e( 'All notifications will be sent using asynchronous scheduler. Notifications will be processed in batch CRON queue in 30 to 60 seconds.', 'push-notification-for-post-and-buddypress' ); ?>
		</div>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col" style="margin-top:16px;">

			<input id="pnfpb_ic_on_demand_push_id" name="pnfpb_ic_on_demand_push_id"
				   type="hidden" value="<?php echo esc_attr( $onetime_push_id ); ?>" />

			<!-- Message Title — full width -->
			<div class="pnfpb-field-card" style="grid-column:1/-1;">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-editor-textcolor"></span>
					<?php esc_html_e( 'Message Title', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_on_demand_push_title" name="pnfpb_ic_on_demand_push_title"
						   type="text" value="<?php echo esc_attr( $onetime_push_title ); ?>" required />
				</div>
			</div>

			<!-- Message Content — full width -->
			<div class="pnfpb-field-card" style="grid-column:1/-1;">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-editor-paragraph"></span>
					<?php esc_html_e( 'Message Content', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control" style="align-items:stretch;">
					<textarea class="pnfpb_ic_push_settings_table_value_column_input_field"
							  id="pnfpb_ic_on_demand_push_content" name="pnfpb_ic_on_demand_push_content"
							  required rows="4"><?php echo esc_textarea( trim( $onetime_push_content ) ); ?></textarea>
				</div>
			</div>

			<!-- Notification Image — full width -->
			<div class="pnfpb-field-card" style="grid-column:1/-1;">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-format-image"></span>
					<?php esc_html_e( 'Notification Image', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control" style="flex-direction:column; align-items:flex-start; gap:10px;">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_on_demand_push_image_url" name="pnfpb_ic_on_demand_push_image_url"
						   type="text" value="<?php echo esc_attr( $onetime_push_imageurl ); ?>"
						   placeholder="https://example.com/image.jpg" />
					<div style="display:flex; align-items:center; gap:10px;">
						<input type="button"
							   value="<?php esc_attr_e( 'Select Image', 'push-notification-for-post-and-buddypress' ); ?>"
							   id="pnfpb_ic_fcm_on_demand_push_image_button"
							   class="button button-secondary pnfpb_ic_push_pwa_settings_upload_icon" />
						<input type="hidden" id="pnfpb_ic_fcm_on_demand_push_image"
							   name="pnfpb_ic_fcm_on_demand_push_image"
							   value="<?php echo esc_attr( $onetime_push_imageurl ); ?>" />
					</div>
					<?php if ( $onetime_push_imageurl !== '' ) : ?>
					<img src="<?php echo esc_url( $onetime_push_imageurl ); ?>"
						 id="pnfpb_ic_fcm_on_demand_push_image_preview"
						 class="pnfpb_ic_fcm_on_demand_push_image_preview" />
					<?php endif; ?>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Paste an image URL or use the button to select from Media Library.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

		</div>
	</section>

	<?php /* ─── Section 2: Delivery Settings ──────────────────────────── */ ?>
	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-admin-links pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'Delivery Settings', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<!-- Click Action URL (left column) -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-links"></span>
					<?php esc_html_e( 'Click Action URL', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_on_demand_push_url_link" name="pnfpb_ic_on_demand_push_url_link"
						   type="text"
						   value="<?php echo $onetime_push_clickurl === '' ? esc_attr( get_home_url() ) : esc_attr( $onetime_push_clickurl ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'URL opened when the notification is clicked. Paste a URL or select a page.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<!-- Select a page (right column) -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-page"></span>
					<?php esc_html_e( 'Or Select a Page', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<select id="pnfpb_ic_on_demand_push_url" name="pnfpb_ic_on_demand_push_url">
						<?php if ( $pages = get_pages() ) : ?>
						<option value="<?php echo esc_attr( get_home_url() ); ?>">
							<?php esc_html_e( 'Home page', 'push-notification-for-post-and-buddypress' ); ?>
						</option>
						<?php foreach ( $pages as $page ) : ?>
						<option value="<?php echo esc_attr( get_page_link( $page->ID ) ); ?>">
							<?php echo esc_html( $page->post_title ); ?>
						</option>
						<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</div>
			</div>

			<!-- Target Audience — full width -->
			<div class="pnfpb-field-card" style="grid-column:1/-1;">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-groups"></span>
					<?php esc_html_e( 'Target Audience', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control" style="flex-direction:column; align-items:flex-start; gap:10px;">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_on_demand_push_select_user"
						   id="pnfpb_ic_on_demand_push_select_user" name="pnfpb_ic_on_demand_push_select_user"
						   type="text"
						   placeholder="<?php esc_attr_e( 'Type a few characters to search users...', 'push-notification-for-post-and-buddypress' ); ?>"
						   value="" />
					<div class="pnfpb_ic_user_selected_items" id="pnfpb_ic_user_selected_items"></div>
					<input class="pnfpb_ic_on_demand_push_select_user_id"
						   id="pnfpb_ic_on_demand_push_select_user_ids" name="pnfpb_ic_on_demand_push_select_user_ids"
						   type="hidden" value="" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'By default the notification is sent to all subscribers. Search and select specific users to target them only.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

		</div>

		<div style="margin-top:20px;">
			<?php submit_button(
				__( 'Send now', 'push-notification-for-post-and-buddypress' ),
				'pnfpb_ic_push_save_configuration_button',
				'submit',
				false
			); ?>
		</div>
	</section>

	<?php /* ─── Section 3: Schedule Push ─────────────────────────────── */ ?>
	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-calendar-alt pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'Schedule Push Notification', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>

		<div class="pnfpb-info-box pnfpb-info-box--blue">
			<span class="dashicons dashicons-info"></span>
			<?php esc_html_e( 'Always select a starting date and time. Recurring fields (day of month, month, day of week) are optional. If both day number and day name are selected, one or both must match the current date. Recommended: use day number and month for recurring schedules (similar to CRON).', 'push-notification-for-post-and-buddypress' ); ?>
		</div>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col" style="margin-top:16px;">

			<!-- Start Date -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-calendar"></span>
					<?php esc_html_e( 'Start Date', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input id="pnfpb_ic_fcm_token_ondemand_datepicker" name="pnfpb_ic_fcm_token_ondemand_datepicker"
						   type="date"
						   value="<?php echo $onetime_push_date_field !== '' ? esc_attr( $onetime_push_date_field ) : ''; ?>" />
				</div>
			</div>

			<!-- Start Time -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-clock"></span>
					<?php esc_html_e( 'Start Time', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input id="pnfpb_ic_fcm_token_ondemand_timepicker" name="pnfpb_ic_fcm_token_ondemand_timepicker"
						   type="time"
						   value="<?php echo $onetime_push_time_field !== '' ? esc_attr( $onetime_push_time_field ) : ''; ?>" />
				</div>
			</div>

			<!-- Repeat — Day of Month -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-calendar-alt"></span>
					<?php esc_html_e( 'Repeat — Day of Month', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<select id="pnfpb_ic_fcm_token_ondemand_repeat_day_number"
							name="pnfpb_ic_fcm_token_ondemand_repeat_day_number">
						<option value=""<?php selected( $onetime_recurring_day_number, '' ); ?>>
							<?php esc_html_e( 'Select Day', 'push-notification-for-post-and-buddypress' ); ?>
						</option>
						<?php for ( $d = 1; $d <= 31; $d++ ) : ?>
						<option value="<?php echo esc_attr( $d ); ?>"<?php selected( $onetime_recurring_day_number, (string) $d ); ?>>
							<?php echo esc_html( sprintf( __( 'Day %d', 'push-notification-for-post-and-buddypress' ), $d ) ); ?>
						</option>
						<?php endfor; ?>
					</select>
				</div>
			</div>

			<!-- Repeat — Month -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-calendar-alt"></span>
					<?php esc_html_e( 'Repeat — Month', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<select id="pnfpb_ic_fcm_token_ondemand_repeat_month"
							name="pnfpb_ic_fcm_token_ondemand_repeat_month">
						<option value=""<?php selected( $onetime_recurring_month_number, '' ); ?>>
							<?php esc_html_e( 'Select Month', 'push-notification-for-post-and-buddypress' ); ?>
						</option>
						<option value="*"<?php selected( $onetime_recurring_month_number, '*' ); ?>>
							<?php esc_html_e( 'Every Month', 'push-notification-for-post-and-buddypress' ); ?>
						</option>
						<?php
						$_months = [
							1  => 'January',  2  => 'February', 3  => 'March',    4  => 'April',
							5  => 'May',      6  => 'June',     7  => 'July',     8  => 'August',
							9  => 'September',10 => 'October',  11 => 'November', 12 => 'December',
						];
						foreach ( $_months as $_num => $_name ) : ?>
						<option value="<?php echo esc_attr( $_num ); ?>"<?php selected( $onetime_recurring_month_number, (string) $_num ); ?>>
							<?php echo esc_html( __( $_name, 'push-notification-for-post-and-buddypress' ) ); ?>
						</option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<!-- Repeat — Day of Week — full width -->
			<div class="pnfpb-field-card" style="grid-column:1/-1;">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-calendar-alt"></span>
					<?php esc_html_e( 'Repeat — Day of Week', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<select id="pnfpb_ic_fcm_token_ondemand_repeat_day"
							name="pnfpb_ic_fcm_token_ondemand_repeat_day">
						<option value=""<?php selected( $onetime_recurring_day_name, '' ); ?>>
							<?php esc_html_e( 'Select Day name', 'push-notification-for-post-and-buddypress' ); ?>
						</option>
						<option value="*"<?php selected( $onetime_recurring_day_name, '*' ); ?>>
							<?php esc_html_e( 'Any day', 'push-notification-for-post-and-buddypress' ); ?>
						</option>
						<?php
						$_days = [
							'7' => 'Sunday', '1' => 'Monday',  '2' => 'Tuesday', '3' => 'Wednesday',
							'4' => 'Thursday','5' => 'Friday', '6' => 'Saturday',
						];
						foreach ( $_days as $_val => $_day ) : ?>
						<option value="<?php echo esc_attr( $_val ); ?>"<?php selected( $onetime_recurring_day_name, $_val ); ?>>
							<?php echo esc_html( __( $_day, 'push-notification-for-post-and-buddypress' ) ); ?>
						</option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

		</div>

		<div style="margin-top:20px; display:flex; align-items:center; gap:16px; flex-wrap:wrap;">
			<?php submit_button(
				__( 'Schedule now', 'push-notification-for-post-and-buddypress' ),
				'pnfpb_ic_push_save_configuration_button',
				'schedule_now',
				false
			); ?>
			<span class="description" style="font-style:italic;">
				<?php esc_html_e( '(To send push notification later on selected schedule)', 'push-notification-for-post-and-buddypress' ); ?>
			</span>
		</div>
	</section>

</form>
