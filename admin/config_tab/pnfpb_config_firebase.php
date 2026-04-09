<?php
/**
 * Firebase configuration provider panel — modern card/grid layout.
 *
 * Included by pnfpb_admin_push_notification_configuration_content.php.
 * Variables available from parent scope: $pnfpb_sa
 *
 * @since 2.30.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<div id="pnfpb_ic_firebase_configuration" class="pnfpb_ic_firebase_configuration pnfpb_config_tab_content pnfpb-provider-panel active">

	<div class="pnfpb-provider-panel-header pnfpb-provider-panel-header--firebase">
		<div class="pnfpb-provider-panel-header-icon">
			<span class="dashicons dashicons-cloud"></span>
		</div>
		<div class="pnfpb-provider-panel-header-text">
			<h3><?php esc_html_e( 'Firebase Configuration', 'push-notification-for-post-and-buddypress' ); ?></h3>
			<p><?php esc_html_e( 'Free · Google Cloud Messaging · Mobile & Web Push', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>
	</div>

	<div class="pnfpb-provider-panel-body">

		<?php require_once( plugin_dir_path( __FILE__ ) . '../pnfpb_admin_push_settings_firebase_service_account.php' ); ?>

		<!-- Tutorial collapsible -->
		<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-bottom:12px;">
			<span class="dashicons dashicons-video-alt2"></span>
			<a href="https://www.youtube.com/watch?v=02oymYLt3qo" target="_blank" rel="noopener noreferrer">
				<?php esc_html_e( 'Watch the Firebase setup tutorial on YouTube', 'push-notification-for-post-and-buddypress' ); ?>
			</a>
			&nbsp;&mdash;&nbsp;
			<button type="button" class="button-link pnfpb_ic_firebase_configuration_help_button"
					onclick="toggle_firebase_configuration_help()">
				<?php esc_html_e( 'Show step-by-step instructions', 'push-notification-for-post-and-buddypress' ); ?>
			</button>
		</div>

		<div class="pnfpb_ic_firebase_configuration_help" style="display:none;">
			<div class="pnfpb-info-box pnfpb-info-box--blue" style="flex-direction:column;align-items:flex-start;">
				<ul style="margin:0;padding-left:20px;font-size:13px;line-height:1.7;">
					<li><?php esc_html_e( 'Sign in to Firebase, open your project, click the settings icon and select Project settings.', 'push-notification-for-post-and-buddypress' ); ?></li>
					<li><?php esc_html_e( 'Config fields (for fields Api key, Auth domain, DB url, Project ID, Storage bucket, Sender ID, App ID, Measurement ID in admin firebase settings): create a web app if you don\'t have one, then project settings → General → your apps → Config button.', 'push-notification-for-post-and-buddypress' ); ?></li>
					<li><?php esc_html_e( 'For Web Push Certificate field: project settings → cloud messaging → Web configuration → Generate Key Pair.', 'push-notification-for-post-and-buddypress' ); ?></li>
					<li><?php esc_html_e( 'If you already generated a key pair, do not generate it again.', 'push-notification-for-post-and-buddypress' ); ?></li>
					<li><?php esc_html_e( 'After saving, your browser will prompt to allow notifications — click Allow.', 'push-notification-for-post-and-buddypress' ); ?></li>
				</ul>
			</div>
		</div>

		<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-bottom:16px;">
			<span class="dashicons dashicons-info"></span>
			<?php esc_html_e( 'All fields are required except Database URL. Please follow the tutorial above for configuration.', 'push-notification-for-post-and-buddypress' ); ?>
		</div>

		<!-- Firebase fields grid -->
		<section class="pnfpb-settings-section">
			<h3 class="pnfpb-settings-section__title">
				<span class="dashicons dashicons-admin-network pnfpb-settings-section__icon"></span>
				<?php esc_html_e( 'Firebase App Credentials', 'push-notification-for-post-and-buddypress' ); ?>
			</h3>

			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

				<!-- Firebase API Key -->
				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-admin-network"></span>
						<label for="pnfpb_ic_fcm_api"><?php esc_html_e( 'Firebase API Key', 'push-notification-for-post-and-buddypress' ); ?></label>
					</div>
					<div class="pnfpb-field-card__control">
						<input class="pnfpb_ic_push_settings_table_value_column_input_field"
							   id="pnfpb_ic_fcm_api" name="pnfpb_ic_fcm_api"
							   type="text"
							   value="<?php echo esc_attr( get_option( 'pnfpb_ic_fcm_api' ) ); ?>" />
					</div>
				</div>

				<!-- Firebase Auth Domain -->
				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-shield"></span>
						<label for="pnfpb_ic_fcm_authdomain"><?php esc_html_e( 'Firebase Auth Domain', 'push-notification-for-post-and-buddypress' ); ?></label>
					</div>
					<div class="pnfpb-field-card__control">
						<input class="pnfpb_ic_push_settings_table_value_column_input_field"
							   id="pnfpb_ic_fcm_authdomain" name="pnfpb_ic_fcm_authdomain"
							   type="text"
							   value="<?php echo esc_attr( get_option( 'pnfpb_ic_fcm_authdomain' ) ); ?>" />
					</div>
				</div>

				<!-- Firebase Database URL (optional) -->
				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-database"></span>
						<label for="pnfpb_ic_fcm_databaseurl"><?php esc_html_e( 'Firebase Database URL', 'push-notification-for-post-and-buddypress' ); ?></label>
					</div>
					<div class="pnfpb-field-card__control">
						<input class="pnfpb_ic_push_settings_table_value_column_input_field"
							   id="pnfpb_ic_fcm_databaseurl" name="pnfpb_ic_fcm_databaseurl"
							   type="text"
							   value="<?php echo esc_attr( get_option( 'pnfpb_ic_fcm_databaseurl' ) ); ?>" />
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Optional field.', 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>

				<!-- Firebase Project ID -->
				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-editor-code"></span>
						<label for="pnfpb_ic_fcm_projectid"><?php esc_html_e( 'Firebase Project ID', 'push-notification-for-post-and-buddypress' ); ?></label>
					</div>
					<div class="pnfpb-field-card__control">
						<input class="pnfpb_ic_push_settings_table_value_column_input_field"
							   id="pnfpb_ic_fcm_projectid" name="pnfpb_ic_fcm_projectid"
							   type="text"
							   value="<?php echo esc_attr( get_option( 'pnfpb_ic_fcm_projectid' ) ); ?>" />
					</div>
				</div>

				<!-- Firebase Storage Bucket -->
				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-archive"></span>
						<label for="pnfpb_ic_fcm_storagebucket"><?php esc_html_e( 'Firebase Storage Bucket', 'push-notification-for-post-and-buddypress' ); ?></label>
					</div>
					<div class="pnfpb-field-card__control">
						<input class="pnfpb_ic_push_settings_table_value_column_input_field"
							   id="pnfpb_ic_fcm_storagebucket" name="pnfpb_ic_fcm_storagebucket"
							   type="text"
							   value="<?php echo esc_attr( get_option( 'pnfpb_ic_fcm_storagebucket' ) ); ?>" />
					</div>
				</div>

				<!-- Firebase Messaging Sender ID -->
				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-email"></span>
						<label for="pnfpb_ic_fcm_messagingsenderid"><?php esc_html_e( 'Firebase Messaging Sender ID', 'push-notification-for-post-and-buddypress' ); ?></label>
					</div>
					<div class="pnfpb-field-card__control">
						<input class="pnfpb_ic_push_settings_table_value_column_input_field"
							   id="pnfpb_ic_fcm_messagingsenderid" name="pnfpb_ic_fcm_messagingsenderid"
							   type="text"
							   value="<?php echo esc_attr( get_option( 'pnfpb_ic_fcm_messagingsenderid' ) ); ?>" />
					</div>
				</div>

				<!-- Firebase App ID -->
				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-smartphone"></span>
						<label for="pnfpb_ic_fcm_appid"><?php esc_html_e( 'Firebase App ID', 'push-notification-for-post-and-buddypress' ); ?></label>
					</div>
					<div class="pnfpb-field-card__control">
						<input class="pnfpb_ic_push_settings_table_value_column_input_field"
							   id="pnfpb_ic_fcm_appid" name="pnfpb_ic_fcm_appid"
							   type="text"
							   value="<?php echo esc_attr( get_option( 'pnfpb_ic_fcm_appid' ) ); ?>" />
					</div>
				</div>

				<!-- Firebase Web Push Certificate -->
				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-lock"></span>
						<label for="pnfpb_ic_fcm_publickey"><?php esc_html_e( 'Firebase Web Push Certificate', 'push-notification-for-post-and-buddypress' ); ?></label>
					</div>
					<div class="pnfpb-field-card__control">
						<input class="pnfpb_ic_push_settings_table_value_column_input_field"
							   id="pnfpb_ic_fcm_publickey" name="pnfpb_ic_fcm_publickey"
							   type="text"
							   value="<?php echo esc_attr( get_option( 'pnfpb_ic_fcm_publickey' ) ); ?>" />
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( 'From Cloud Messaging tab in Firebase console.', 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>

				<!-- MeasurementId -->
				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-chart-bar"></span>
						<label for="pnfpb_ic_fcm_measurementId"><?php esc_html_e( 'Measurement ID', 'push-notification-for-post-and-buddypress' ); ?></label>
					</div>
					<div class="pnfpb-field-card__control">
						<input class="pnfpb_ic_push_settings_table_value_column_input_field"
							   id="pnfpb_ic_fcm_measurementId" name="pnfpb_ic_fcm_measurementId"
							   type="text"
							   value="<?php echo esc_attr( get_option( 'pnfpb_ic_fcm_measurementId' ) ); ?>" />
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Available when Google Analytics is enabled in your Firebase project.', 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>

				<!-- FCM Push Icon -->
				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-format-image"></span>
						<label for="pnfpb_ic_fcm_upload_icon"><?php esc_html_e( 'FCM Push Notification Icon (16&times;16 px)', 'push-notification-for-post-and-buddypress' ); ?></label>
					</div>
					<div class="pnfpb-field-card__control" style="flex-direction:column;align-items:flex-start;gap:12px;">
						<div style="display:flex;align-items:center;gap:16px;">
							<input type="button"
								   value="<?php esc_attr_e( 'Upload Icon', 'push-notification-for-post-and-buddypress' ); ?>"
								   id="pnfpb_ic_fcm_upload_button"
								   class="button pnfpb_ic_push_settings_upload_icon" />
							<input type="hidden"
								   id="pnfpb_ic_fcm_upload_icon"
								   name="pnfpb_ic_fcm_upload_icon"
								   value="<?php echo esc_attr( get_option( 'pnfpb_ic_fcm_upload_icon' ) ); ?>" />
						</div>
						<div id="pnfpb_ic_fcm_upload_preview"
							 style="background-image:url(<?php echo esc_url( get_option( 'pnfpb_ic_fcm_upload_icon' ) ); ?>);width:48px;height:48px;border-radius:50%;background-position:center;background-repeat:no-repeat;background-size:cover;border:1px solid #c3c4c7;">
						</div>
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Small icon displayed alongside the push notification.', 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>

			</div><!-- /.pnfpb-settings-grid -->
		</section>

	</div><!-- /.pnfpb-provider-panel-body -->
</div><!-- /#pnfpb_ic_firebase_configuration -->
