<?php
/* PWA Sub-tab: App Basics
 * Included by pnfpb_admin_pwa_app_settings.php
 */
?>
<div id="pnfpb-pwa-name" class="pnfpb-pwa-settings-tab active">

	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-admin-site-alt3 pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'App Identity', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Configure how your PWA is named and identified on home screens and app launchers.', 'push-notification-for-post-and-buddypress' ); ?></p>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-edit"></span>
					<?php esc_html_e( 'App Name', 'push-notification-for-post-and-buddypress' ); ?>
					<span style="color:#EF4444;margin-left:2px;">*</span>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_pwa_app_name"
						   name="pnfpb_ic_pwa_app_name"
						   type="text"
						   maxlength="50"
						   required="required"
						   value="<?php
							$_pnfpb_v = get_option( 'pnfpb_ic_pwa_app_name' );
							echo esc_attr( $_pnfpb_v ? $_pnfpb_v : get_bloginfo( 'name' ) );
						?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Full app name shown on home screen. Max 50 characters. Required.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-tag"></span>
					<?php esc_html_e( 'Short Name', 'push-notification-for-post-and-buddypress' ); ?>
					<span style="color:#EF4444;margin-left:2px;">*</span>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_pwa_app_shortname"
						   name="pnfpb_ic_pwa_app_shortname"
						   type="text"
						   maxlength="25"
						   required="required"
						   value="<?php echo esc_attr( get_option( 'pnfpb_ic_pwa_app_shortname' ) ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Abbreviated name for limited-space contexts. Max 25 characters. Required.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

		</div>

		<div class="pnfpb-settings-grid" style="grid-template-columns:1fr;">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-links"></span>
					<?php esc_html_e( 'Start URL', 'push-notification-for-post-and-buddypress' ); ?>
					<span style="color:#EF4444;margin-left:2px;">*</span>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_pwa_app_starturl"
						   name="pnfpb_ic_pwa_app_starturl"
						   type="text"
						   required="required"
						   value="<?php
							$_pnfpb_v = get_option( 'pnfpb_ic_pwa_app_starturl' );
							echo esc_url( $_pnfpb_v ? $_pnfpb_v : home_url() );
						?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'URL opened when the app launches from the home screen. Required.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

		</div>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-text-page"></span>
					<?php esc_html_e( 'Description', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_pwa_app_description"
						   name="pnfpb_ic_pwa_app_description"
						   type="text"
						   maxlength="25"
						   value="<?php echo esc_attr( get_option( 'pnfpb_ic_pwa_app_description' ) ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Brief app description. Max 25 characters. Optional.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-smartphone"></span>
					<?php esc_html_e( 'Orientation', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<select name="pnfpb_ic_pwa_app_orientation" id="pnfpb_ic_pwa_app_orientation">
						<?php
						$_pnfpb_ori = get_option( 'pnfpb_ic_pwa_app_orientation', 'any' );
						$_pnfpb_orientations = [ 'any', 'natural', 'portrait', 'portrait-primary', 'portrait-secondary', 'landscape', 'landscape-primary', 'landscape-secondary' ];
						foreach ( $_pnfpb_orientations as $_pnfpb_o ) {
							echo '<option value="' . esc_attr( $_pnfpb_o ) . '"' . selected( $_pnfpb_ori, $_pnfpb_o, false ) . '>' . esc_html( $_pnfpb_o ) . '</option>';
						}
						?>
					</select>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Screen orientation lock for the app. Optional.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

		</div>

		<div class="pnfpb-settings-grid" style="grid-template-columns:1fr;">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-site"></span>
					<?php esc_html_e( 'Scope URL', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_pwa_app_scope"
						   name="pnfpb_ic_pwa_app_scope"
						   type="text"
						   value="<?php echo esc_url( get_option( 'pnfpb_ic_pwa_app_scope' ) ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Top-level URL path defining the app scope. Pages outside scope show the browser URL bar. Optional.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

		</div>
	</section>

</div>
