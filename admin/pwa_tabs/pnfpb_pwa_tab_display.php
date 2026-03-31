<?php
/* PWA Sub-tab: Display
 * Included by pnfpb_admin_pwa_app_settings.php
 */
?>
<div id="pnfpb-pwa-display" class="pnfpb-pwa-settings-tab">

	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-visibility pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'Colors & Display Mode', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Set the theme color, background color, and display mode for your progressive web app.', 'push-notification-for-post-and-buddypress' ); ?></p>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--3col">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-art"></span>
					<?php esc_html_e( 'Theme Color', 'push-notification-for-post-and-buddypress' ); ?>
					<span style="color:#EF4444;margin-left:2px;">*</span>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_push_pwa_color"
						   id="pnfpb_ic_pwa_theme_color"
						   name="pnfpb_ic_pwa_theme_color"
						   type="color"
						   required="required"
						   value="<?php
							$_pnfpb_v = get_option( 'pnfpb_ic_pwa_theme_color' );
							echo esc_attr( $_pnfpb_v ? $_pnfpb_v : '#161515' );
						?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Browser UI accent color for this app. Required.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-appearance"></span>
					<?php esc_html_e( 'Background Color', 'push-notification-for-post-and-buddypress' ); ?>
					<span style="color:#EF4444;margin-left:2px;">*</span>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_push_pwa_color"
						   id="pnfpb_ic_pwa_app_backgroundcolor"
						   name="pnfpb_ic_pwa_app_backgroundcolor"
						   type="color"
						   required="required"
						   value="<?php
							$_pnfpb_v = get_option( 'pnfpb_ic_pwa_app_backgroundcolor' );
							echo esc_attr( $_pnfpb_v ? $_pnfpb_v : '#ffffff' );
						?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Splash screen background color. Required.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-desktop"></span>
					<?php esc_html_e( 'Display Mode', 'push-notification-for-post-and-buddypress' ); ?>
					<span style="color:#EF4444;margin-left:2px;">*</span>
				</div>
				<div class="pnfpb-field-card__control">
					<select name="pnfpb_ic_pwa_app_display" id="pnfpb_ic_pwa_app_display" required="required">
						<?php
						$_pnfpb_disp = get_option( 'pnfpb_ic_pwa_app_display', 'standalone' );
						foreach ( [ 'standalone', 'fullscreen', 'minimal-ui' ] as $_pnfpb_d ) {
							echo '<option value="' . esc_attr( $_pnfpb_d ) . '"' . selected( $_pnfpb_disp, $_pnfpb_d, false ) . '>' . esc_html( $_pnfpb_d ) . '</option>';
						}
						?>
					</select>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'How the PWA is presented to the user. Required.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

		</div>
	</section>

</div>
