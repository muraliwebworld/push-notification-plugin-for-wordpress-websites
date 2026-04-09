<?php
/**
 * Plugin settings area to customize shortcode options
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<h1 class="pnfpb_ic_push_settings_header"><?php echo esc_html( __( "PNFPB - Customize Shortcode Options", "push-notification-for-post-and-buddypress" ) ); ?></h1>
<?php
	$pnfpb_tab_shortcode_active = "nav-tab-active";
	require_once( plugin_dir_path( __FILE__ ) . 'push_admin_menu_list.php' );
?>

<div class="pnfpb_column_1200">
<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
	<?php settings_fields( "pnfpb_icfcm_buttons" ); ?>
	<?php do_settings_sections( "pnfpb_icfcm_buttons" ); ?>

	<!-- ===== Shortcodes info strip ===== -->
	<div class="pnfpb-info-box pnfpb-info-box--blue">
		<span class="dashicons dashicons-shortcode pnfpb-info-box__icon"></span>
		<div>
			<strong><?php esc_html_e( "Available Shortcodes", "push-notification-for-post-and-buddypress" ); ?></strong>
			<p><code>[subscribe_PNFPB_push_notification]</code> &mdash; <?php esc_html_e( "Push notification bell-icon subscription widget", "push-notification-for-post-and-buddypress" ); ?></p>
			<p><code>[PNFPB_PWA_PROMPT]</code> &mdash; <?php esc_html_e( "PWA app install prompt button", "push-notification-for-post-and-buddypress" ); ?></p>
		</div>
	</div>

	<!-- ===== Sub-tab navigation ===== -->
	<nav id="pnfpb-sc-tabs" class="nav-tab-wrapper pnfpb-sc-sub-bar">
		<a id="pnfpb-sc-tab-bell" class="nav-tab pnfpb-sc-tab pnfpb-sc-tab--bell nav-tab-active" href="#pnfpb-sc-pane-bell" data-pane="pnfpb-sc-pane-bell">
			<span class="pnfpb-sc-tab__icon"><span class="dashicons dashicons-megaphone"></span></span>
			<span class="pnfpb-sc-tab__label"><?php esc_html_e( "Bell Notification", "push-notification-for-post-and-buddypress" ); ?></span>
		</a>
		<a id="pnfpb-sc-tab-pwa" class="nav-tab pnfpb-sc-tab pnfpb-sc-tab--pwa" href="#pnfpb-sc-pane-pwa" data-pane="pnfpb-sc-pane-pwa">
			<span class="pnfpb-sc-tab__icon"><span class="dashicons dashicons-smartphone"></span></span>
			<span class="pnfpb-sc-tab__label"><?php esc_html_e( "PWA Install", "push-notification-for-post-and-buddypress" ); ?></span>
		</a>
	</nav>

	<!-- ===== Tab 1: Bell Notification Shortcode ===== -->
	<div id="pnfpb-sc-pane-bell" class="pnfpb-tab-pane">

		<!-- Section: Integration -->
		<section class="pnfpb-settings-section">
			<h3 class="pnfpb-settings-section__title">
				<span class="dashicons dashicons-admin-settings pnfpb-settings-section__icon"></span>
				<?php esc_html_e( "Integration", "push-notification-for-post-and-buddypress" ); ?>
			</h3>
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">
				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-shortcode"></span>
						<?php esc_html_e( "Enable Shortcode Mode", "push-notification-for-post-and-buddypress" ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<label class="pnfpb_switch">
							<input id="pnfpb_shortcode_installed" name="pnfpb_shortcode_installed" type="checkbox" value="1"
								   <?php if ( get_option( "pnfpb_shortcode_installed", "0" ) === "1" ) { echo esc_attr( "checked" ); } ?> />
							<span class="pnfpb_slider round"></span>
						</label>
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( "Enable when the shortcode is placed in a single page or post.", "push-notification-for-post-and-buddypress" ); ?></p>
				</div>
			</div>
		</section>

		<!-- Section: Popup Appearance -->
		<section class="pnfpb-settings-section">
			<h3 class="pnfpb-settings-section__title">
				<span class="dashicons dashicons-art pnfpb-settings-section__icon"></span>
				<?php esc_html_e( "Popup Appearance", "push-notification-for-post-and-buddypress" ); ?>
			</h3>
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

				<!-- Bell Icon upload -->
				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-admin-media"></span>
						<?php esc_html_e( "Bell Icon (32\xc3\x9732 px)", "push-notification-for-post-and-buddypress" ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<button id="pnfpb_ic_fcm_popup_icon_shortcode" class="pnfpb_ic_push_settings_upload_icon_shortcode button button-secondary">
							<?php esc_html_e( "Upload Icon", "push-notification-for-post-and-buddypress" ); ?>
						</button>
						<input type="hidden" id="pnfpb_ic_fcm_popup_subscribe_button_icon_shortcode"
							   name="pnfpb_ic_fcm_popup_subscribe_button_icon_shortcode"
							   value="<?php if ( get_option( "pnfpb_ic_fcm_popup_subscribe_button_icon_shortcode" ) ) {
									echo esc_attr( get_option( "pnfpb_ic_fcm_popup_subscribe_button_icon_shortcode" ) );
								} else { echo esc_attr( plugin_dir_url( __DIR__ ) ) . "public/img/pushbell-pnfpb.png"; } ?>" />
						<div id="pnfpb_ic_fcm_popup_subscribe_button_icon_preview_shortcode"
							 style="background-image:url(<?php if ( get_option( "pnfpb_ic_fcm_popup_subscribe_button_icon_shortcode" ) ) {
								echo esc_url( get_option( "pnfpb_ic_fcm_popup_subscribe_button_icon_shortcode" ) );
							} else { echo esc_url( plugin_dir_url( __DIR__ ) ) . "public/img/pushbell-pnfpb.png"; } ?>);width:32px;height:32px;border-radius:50%;margin:10px 0;background-position:center;background-repeat:no-repeat;background-size:cover;">
						</div>
					</div>
				</div>

				<!-- Popup position -->
				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-move"></span>
						<?php esc_html_e( "Popup Position", "push-notification-for-post-and-buddypress" ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<?php
						$pnfpb_positions = [
							1 => __( "Center of screen", "push-notification-for-post-and-buddypress" ),
							2 => __( "Top of icon", "push-notification-for-post-and-buddypress" ),
							3 => __( "Bottom of icon", "push-notification-for-post-and-buddypress" ),
							4 => __( "Left of icon", "push-notification-for-post-and-buddypress" ),
							5 => __( "Right of icon", "push-notification-for-post-and-buddypress" ),
						];
						foreach ( $pnfpb_positions as $pnfpb_val => $pnfpb_label ) { ?>
						<label class="pnfpb_ic_push_settings_table_label_checkbox pnfpb_container pnfpb_margin_left_4 pnfpb_margin_top_6 pnfpb_padding_top_8">
							<?php echo esc_html( $pnfpb_label ); ?>
							<input id="pnfpb_ic_fcm_bellicon_shortcode_style"
								   name="pnfpb_ic_fcm_bellicon_shortcode_style"
								   type="radio"
								   value="<?php echo esc_attr( $pnfpb_val ); ?>"
								   <?php checked( (string)$pnfpb_val, get_option( "pnfpb_ic_fcm_bellicon_shortcode_style" ) ); ?> />
							<span class="pnfpb_checkmark pnfpb_margin_top_6"></span>
						</label>
						<?php } ?>
					</div>
				</div>

			</div><!-- .pnfpb-settings-grid -->

			<!-- Text / color row -->
			<div class="pnfpb-settings-grid pnfpb-settings-grid--3col" style="margin-top:14px;">

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_popup_header_text_shortcode">
						<span class="dashicons dashicons-editor-textcolor"></span>
						<?php esc_html_e( "Popup Header Text", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input"
						   id="pnfpb_ic_fcm_popup_header_text_shortcode"
						   name="pnfpb_ic_fcm_popup_header_text_shortcode"
						   type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_popup_header_text_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_popup_header_text_shortcode" ) );
							} else { echo esc_attr( __( "Manage push notifications", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_label_text_shortcode">
						<span class="dashicons dashicons-editor-textcolor"></span>
						<?php esc_html_e( "Bell Label Text", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input"
						   id="pnfpb_ic_fcm_label_text_shortcode"
						   name="pnfpb_ic_fcm_label_text_shortcode"
						   type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_label_text_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_label_text_shortcode" ) );
							} else { echo esc_attr( __( "Subscribe Push notifications", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

			</div>
		</section>

		<!-- Section: Button & Messages -->
		<section class="pnfpb-settings-section">
			<h3 class="pnfpb-settings-section__title">
				<span class="dashicons dashicons-button pnfpb-settings-section__icon"></span>
				<?php esc_html_e( "Button & Messages", "push-notification-for-post-and-buddypress" ); ?>
			</h3>
			<div class="pnfpb-settings-grid pnfpb-settings-grid--3col">

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_popup_subscribe_button_shortcode">
						<span class="dashicons dashicons-yes"></span>
						<?php esc_html_e( "Subscribe Button Text", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input"
						   id="pnfpb_ic_fcm_popup_subscribe_button_shortcode"
						   name="pnfpb_ic_fcm_popup_subscribe_button_shortcode"
						   type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_popup_subscribe_button_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_popup_subscribe_button_shortcode" ) );
							} else { echo esc_attr( __( "Subscribe", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_popup_unsubscribe_button_shortcode">
						<span class="dashicons dashicons-no"></span>
						<?php esc_html_e( "Unsubscribe Button Text", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input"
						   id="pnfpb_ic_fcm_popup_unsubscribe_button_shortcode"
						   name="pnfpb_ic_fcm_popup_unsubscribe_button_shortcode"
						   type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_popup_unsubscribe_button_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_popup_unsubscribe_button_shortcode" ) );
							} else { echo esc_attr( __( "Unsubscribe", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_popup_wait_message_shortcode">
						<span class="dashicons dashicons-clock"></span>
						<?php esc_html_e( "Processing Message", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input"
						   id="pnfpb_ic_fcm_popup_wait_message_shortcode"
						   name="pnfpb_ic_fcm_popup_wait_message_shortcode"
						   type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_popup_wait_message_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_popup_wait_message_shortcode" ) );
							} else { echo esc_attr( __( "Please wait...processing", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_popup_subscribe_message_shortcode">
						<span class="dashicons dashicons-yes-alt"></span>
						<?php esc_html_e( "Subscribed Hover Message", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input"
						   id="pnfpb_ic_fcm_popup_subscribe_message_shortcode"
						   name="pnfpb_ic_fcm_popup_subscribe_message_shortcode"
						   type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_popup_subscribe_message_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_popup_subscribe_message_shortcode" ) );
							} else { echo esc_attr( __( "You are subscribed to push notification", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_popup_unsubscribe_message_shortcode">
						<span class="dashicons dashicons-minus"></span>
						<?php esc_html_e( "Not Subscribed Hover Message", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input"
						   id="pnfpb_ic_fcm_popup_unsubscribe_message_shortcode"
						   name="pnfpb_ic_fcm_popup_unsubscribe_message_shortcode"
						   type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_popup_unsubscribe_message_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_popup_unsubscribe_message_shortcode" ) );
							} else { echo esc_attr( __( "Push notification not subscribed", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

			</div><!-- .pnfpb-settings-grid -->

			<!-- Color row -->
			<div class="pnfpb-settings-grid pnfpb-settings-grid--3col" style="margin-top:14px;">

				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-art"></span>
						<?php esc_html_e( "Button Background Color", "push-notification-for-post-and-buddypress" ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_prompt_button_background"
							   id="pnfpb_ic_fcm_popup_subscribe_button_color_shortcode"
							   name="pnfpb_ic_fcm_popup_subscribe_button_color_shortcode"
							   type="color"
							   value="<?php if ( get_option( "pnfpb_ic_fcm_popup_subscribe_button_color_shortcode" ) ) {
									echo esc_attr( get_option( "pnfpb_ic_fcm_popup_subscribe_button_color_shortcode" ) );
								} else { echo esc_attr( "#e54b4d" ); } ?>" />
					</div>
				</div>

				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-editor-textcolor"></span>
						<?php esc_html_e( "Button Text Color", "push-notification-for-post-and-buddypress" ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_prompt_button_background"
							   id="pnfpb_ic_fcm_popup_subscribe_button_text_color_shortcode"
							   name="pnfpb_ic_fcm_popup_subscribe_button_text_color_shortcode"
							   type="color"
							   value="<?php if ( get_option( "pnfpb_ic_fcm_popup_subscribe_button_text_color_shortcode" ) ) {
									echo esc_attr( get_option( "pnfpb_ic_fcm_popup_subscribe_button_text_color_shortcode" ) );
								} else { echo esc_attr( "#ffffff" ); } ?>" />
					</div>
				</div>

				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-list-view"></span>
						<?php esc_html_e( "Show Options Button", "push-notification-for-post-and-buddypress" ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<label class="pnfpb_switch">
							<input id="pnfpb_bell_icon_prompt_options_on_off_shortcode"
								   name="pnfpb_bell_icon_prompt_options_on_off_shortcode"
								   type="checkbox" value="1"
								   <?php if ( get_option( "pnfpb_bell_icon_prompt_options_on_off_shortcode", "0" ) === "0" || get_option( "pnfpb_bell_icon_prompt_options_on_off_shortcode", "0" ) === "1" ) {
										echo esc_attr( "checked" );
									} ?> />
							<span class="pnfpb_slider round"></span>
						</label>
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( "Show the subscription category options button in the popup.", "push-notification-for-post-and-buddypress" ); ?></p>
				</div>

			</div>
		</section>

		<!-- Section: Subscription Option Labels -->
		<section class="pnfpb-settings-section">
			<h3 class="pnfpb-settings-section__title">
				<span class="dashicons dashicons-list-view pnfpb-settings-section__icon"></span>
				<?php esc_html_e( "Subscription Option Labels", "push-notification-for-post-and-buddypress" ); ?>
			</h3>
			<p class="pnfpb-settings-section__desc"><?php esc_html_e( "Customize the text shown for each notification category in the popup dropdown.", "push-notification-for-post-and-buddypress" ); ?></p>
			<div class="pnfpb-settings-grid pnfpb-settings-grid--3col">

				<?php
				$pnfpb_args = [ "public" => true, "_builtin" => false ];
				$pnfpb_custposttypes = get_post_types( $pnfpb_args, "names", "and" );
				foreach ( $pnfpb_custposttypes as $pnfpb_post_type ) {
					if ( $pnfpb_post_type !== "buddypress" ) { ?>
				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="<?php echo esc_attr( "pnfpb_bell_icon_subscription_option_" . $pnfpb_post_type . "_text_shortcode" ); ?>">
						<span class="dashicons dashicons-admin-post"></span>
						<?php echo esc_html( ucwords( $pnfpb_post_type ) ); ?>
					</label>
					<input class="pnfpb-field-row__input"
						   id="<?php echo esc_html( "pnfpb_bell_icon_subscription_option_" . $pnfpb_post_type . "_text_shortcode" ); ?>"
						   name="<?php echo esc_html( "pnfpb_bell_icon_subscription_option_" . $pnfpb_post_type . "_text_shortcode" ); ?>"
						   type="text"
						   value="<?php if ( get_option( "pnfpb_bell_icon_subscription_option_" . $pnfpb_post_type . "_text_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_bell_icon_subscription_option_" . $pnfpb_post_type . "_text_shortcode" ) );
							} else { echo esc_attr( ucwords( $pnfpb_post_type ) ); } ?>" />
				</div>
					<?php }
				} ?>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_bell_icon_subscription_option_all_text_shortcode">
						<span class="dashicons dashicons-yes-alt"></span>
						<?php esc_html_e( "Subscribe All", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_bell_icon_subscription_option_all_text_shortcode" name="pnfpb_bell_icon_subscription_option_all_text_shortcode" type="text"
						   value="<?php if ( get_option( "pnfpb_bell_icon_subscription_option_all_text_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_bell_icon_subscription_option_all_text_shortcode" ) );
							} else { echo esc_attr( __( "Subscribe all", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_bell_icon_subscription_option_post_text_shortcode">
						<span class="dashicons dashicons-admin-post"></span>
						<?php esc_html_e( "New Post", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_bell_icon_subscription_option_post_text_shortcode" name="pnfpb_bell_icon_subscription_option_post_text_shortcode" type="text"
						   value="<?php if ( get_option( "pnfpb_bell_icon_subscription_option_post_text_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_bell_icon_subscription_option_post_text_shortcode" ) );
							} else { echo esc_attr( __( "New post", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_bell_icon_subscription_option_activity_text_shortcode">
						<span class="dashicons dashicons-buddicons-activity"></span>
						<?php esc_html_e( "New Activity", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_bell_icon_subscription_option_activity_text_shortcode" name="pnfpb_bell_icon_subscription_option_activity_text_shortcode" type="text"
						   value="<?php if ( get_option( "pnfpb_bell_icon_subscription_option_activity_text_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_bell_icon_subscription_option_activity_text_shortcode" ) );
							} else { echo esc_attr( __( "New post/activity", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_bell_icon_subscription_option_all_comments_text_shortcode">
						<span class="dashicons dashicons-admin-comments"></span>
						<?php esc_html_e( "All Comments", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_bell_icon_subscription_option_all_comments_text_shortcode" name="pnfpb_bell_icon_subscription_option_all_comments_text_shortcode" type="text"
						   value="<?php if ( get_option( "pnfpb_bell_icon_subscription_option_all_comments_text_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_bell_icon_subscription_option_all_comments_text_shortcode" ) );
							} else { echo esc_attr( __( "Comments", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_bell_icon_subscription_option_my_comments_text_shortcode">
						<span class="dashicons dashicons-admin-comments"></span>
						<?php esc_html_e( "Comments on My Posts", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_bell_icon_subscription_option_my_comments_text_shortcode" name="pnfpb_bell_icon_subscription_option_my_comments_text_shortcode" type="text"
						   value="<?php if ( get_option( "pnfpb_bell_icon_subscription_option_my_comments_text_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_bell_icon_subscription_option_my_comments_text_shortcode" ) );
							} else { echo esc_attr( __( "Comments on my posts/my activities ", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_bell_icon_subscription_option_private_message_text_shortcode">
						<span class="dashicons dashicons-email-alt"></span>
						<?php esc_html_e( "Private Message", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_bell_icon_subscription_option_private_message_text_shortcode" name="pnfpb_bell_icon_subscription_option_private_message_text_shortcode" type="text"
						   value="<?php if ( get_option( "pnfpb_bell_icon_subscription_option_private_message_text_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_bell_icon_subscription_option_private_message_text_shortcode" ) );
							} else { echo esc_attr( __( "Private message", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_bell_icon_subscription_option_new_member_text_shortcode">
						<span class="dashicons dashicons-groups"></span>
						<?php esc_html_e( "New Member Joined", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_bell_icon_subscription_option_new_member_text_shortcode" name="pnfpb_bell_icon_subscription_option_new_member_text_shortcode" type="text"
						   value="<?php if ( get_option( "pnfpb_bell_icon_subscription_option_new_member_text_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_bell_icon_subscription_option_new_member_text_shortcode" ) );
							} else { echo esc_attr( __( "New member joined", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_bell_icon_subscription_option_friend_request_text_shortcode">
						<span class="dashicons dashicons-buddicons-friends"></span>
						<?php esc_html_e( "Friend Request", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_bell_icon_subscription_option_friend_request_text_shortcode" name="pnfpb_bell_icon_subscription_option_friend_request_text_shortcode" type="text"
						   value="<?php if ( get_option( "pnfpb_bell_icon_subscription_option_friend_request_text_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_bell_icon_subscription_option_friend_request_text_shortcode" ) );
							} else { echo esc_attr( __( "Friend request", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_bell_icon_subscription_option_friendship_accepted_text_shortcode">
						<span class="dashicons dashicons-yes-alt"></span>
						<?php esc_html_e( "Friendship Accepted", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_bell_icon_subscription_option_friendship_accepted_text_shortcode" name="pnfpb_bell_icon_subscription_option_friendship_accepted_text_shortcode" type="text"
						   value="<?php if ( get_option( "pnfpb_bell_icon_subscription_option_friendship_accepted_text_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_bell_icon_subscription_option_friendship_accepted_text_shortcode" ) );
							} else { echo esc_attr( __( "Friendship accepted ", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_bell_icon_subscription_option_user_avatar_text_shortcode">
						<span class="dashicons dashicons-admin-users"></span>
						<?php esc_html_e( "Avatar Change", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_bell_icon_subscription_option_user_avatar_text_shortcode" name="pnfpb_bell_icon_subscription_option_user_avatar_text_shortcode" type="text"
						   value="<?php if ( get_option( "pnfpb_bell_icon_subscription_option_user_avatar_text_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_bell_icon_subscription_option_user_avatar_text_shortcode" ) );
							} else { echo esc_attr( __( "User avatar change", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_bell_icon_subscription_option_cover_image_text_shortcode">
						<span class="dashicons dashicons-format-image"></span>
						<?php esc_html_e( "Cover Image Change", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_bell_icon_subscription_option_cover_image_text_shortcode" name="pnfpb_bell_icon_subscription_option_cover_image_text_shortcode" type="text"
						   value="<?php if ( get_option( "pnfpb_bell_icon_subscription_option_cover_image_text_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_bell_icon_subscription_option_cover_image_text_shortcode" ) );
							} else { echo esc_attr( __( "Cover image change", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_bell_icon_subscription_option_group_details_update_text_shortcode">
						<span class="dashicons dashicons-buddicons-groups"></span>
						<?php esc_html_e( "Group Details Update", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_bell_icon_subscription_option_group_details_update_text_shortcode" name="pnfpb_bell_icon_subscription_option_group_details_update_text_shortcode" type="text"
						   value="<?php if ( get_option( "pnfpb_bell_icon_subscription_option_group_details_update_text_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_bell_icon_subscription_option_group_details_update_text_shortcode" ) );
							} else { echo esc_attr( __( "Group details update", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_bell_icon_subscription_option_group_invite_text_shortcode">
						<span class="dashicons dashicons-buddicons-groups"></span>
						<?php esc_html_e( "Group Invite", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_bell_icon_subscription_option_group_invite_text_shortcode" name="pnfpb_bell_icon_subscription_option_group_invite_text_shortcode" type="text"
						   value="<?php if ( get_option( "pnfpb_bell_icon_subscription_option_group_invite_text_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_bell_icon_subscription_option_group_invite_text_shortcode" ) );
							} else { echo esc_attr( __( "Group invite", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_bell_icon_subscription_option_favourite_text_shortcode">
						<span class="dashicons dashicons-heart"></span>
						<?php esc_html_e( "Likes / Favourites", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_bell_icon_subscription_option_favourite_text_shortcode" name="pnfpb_bell_icon_subscription_option_favourite_text_shortcode" type="text"
						   value="<?php if ( get_option( "pnfpb_bell_icon_subscription_option_favourite_text_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_bell_icon_subscription_option_favourite_text_shortcode" ) );
							} else { echo esc_attr( __( "Likes/Favourites", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_bell_icon_subscription_option_followers_text_shortcode">
						<span class="dashicons dashicons-groups"></span>
						<?php esc_html_e( "BP Followers", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_bell_icon_subscription_option_followers_text_shortcode" name="pnfpb_bell_icon_subscription_option_followers_text_shortcode" type="text"
						   value="<?php if ( get_option( "pnfpb_bell_icon_subscription_option_followers_text_shortcode" ) ) {
								echo esc_attr( get_option( "pnfpb_bell_icon_subscription_option_followers_text_shortcode" ) );
							} else { echo esc_attr( __( "BP Followers", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_bell_icon_subscription_option_text_shortcode_confirm">
						<span class="dashicons dashicons-yes"></span>
						<?php esc_html_e( "Subscription Confirmed Message", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_bell_icon_subscription_option_text_shortcode_confirm" name="pnfpb_bell_icon_subscription_option_text_shortcode_confirm" type="text"
						   value="<?php if ( get_option( "pnfpb_bell_icon_subscription_option_text_shortcode_confirm" ) ) {
								echo esc_attr( get_option( "pnfpb_bell_icon_subscription_option_text_shortcode_confirm" ) );
							} else { echo esc_attr( __( "Subscription option updated", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_bell_icon_subscription_text_shortcode_text_confirm">
						<span class="dashicons dashicons-no-alt"></span>
						<?php esc_html_e( "Unsubscription Confirmed Message", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_bell_icon_subscription_text_shortcode_text_confirm" name="pnfpb_bell_icon_subscription_text_shortcode_text_confirm" type="text"
						   value="<?php if ( get_option( "pnfpb_bell_icon_subscription_text_shortcode_text_confirm" ) ) {
								echo esc_attr( get_option( "pnfpb_bell_icon_subscription_text_shortcode_text_confirm" ) );
							} else { echo esc_attr( __( "Subscription option updated", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

			</div><!-- .pnfpb-settings-grid -->
		</section>

	</div><!-- #pnfpb-sc-pane-bell -->

	<!-- ===== Tab 2: PWA Install Shortcode ===== -->
	<div id="pnfpb-sc-pane-pwa" class="pnfpb-tab-pane" style="display:none;">

		<section class="pnfpb-settings-section">
			<h3 class="pnfpb-settings-section__title">
				<span class="dashicons dashicons-smartphone pnfpb-settings-section__icon"></span>
				<?php esc_html_e( "PWA Install Button", "push-notification-for-post-and-buddypress" ); ?>
				<code style="font-size:12px;margin-left:8px;background:#F3F4F6;padding:2px 6px;border-radius:4px;">[PNFPB_PWA_PROMPT]</code>
			</h3>
			<div class="pnfpb-settings-grid pnfpb-settings-grid--3col">

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_install_pwa_shortcode_button_text">
						<span class="dashicons dashicons-editor-textcolor"></span>
						<?php esc_html_e( "Button Text", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input"
						   id="pnfpb_ic_fcm_install_pwa_shortcode_button_text"
						   name="pnfpb_ic_fcm_install_pwa_shortcode_button_text"
						   type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_install_pwa_shortcode_button_text" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_install_pwa_shortcode_button_text" ) );
							} else { echo esc_attr( "Install PWA" ); } ?>" />
				</div>

				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-art"></span>
						<?php esc_html_e( "Button Background Color", "push-notification-for-post-and-buddypress" ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_pwa_prompt_install_button_color pnfpb_ic_push_pwa_color"
							   id="pnfpb_ic_fcm_install_pwa_shortcode_button_color"
							   name="pnfpb_ic_fcm_install_pwa_shortcode_button_color"
							   type="color"
							   value="<?php if ( get_option( "pnfpb_ic_fcm_install_pwa_shortcode_button_color" ) ) {
									echo esc_attr( get_option( "pnfpb_ic_fcm_install_pwa_shortcode_button_color" ) );
								} else { echo esc_attr( "#000000" ); } ?>" />
					</div>
				</div>

				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-editor-textcolor"></span>
						<?php esc_html_e( "Button Text Color", "push-notification-for-post-and-buddypress" ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_pwa_prompt_install_button_color pnfpb_ic_push_pwa_color"
							   id="pnfpb_ic_fcm_install_pwa_shortcode_button_text_color"
							   name="pnfpb_ic_fcm_install_pwa_shortcode_button_text_color"
							   type="color"
							   value="<?php if ( get_option( "pnfpb_ic_fcm_install_pwa_shortcode_button_text_color" ) ) {
									echo esc_attr( get_option( "pnfpb_ic_fcm_install_pwa_shortcode_button_text_color" ) );
								} else { echo esc_attr( "#ffffff" ); } ?>" />
					</div>
				</div>

				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-smartphone"></span>
						<?php esc_html_e( "Show PWA Icon", "push-notification-for-post-and-buddypress" ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<label class="pnfpb_switch">
							<input id="pnfpb-pwa-shortcode-install-icon" name="pnfpb-pwa-shortcode-install-icon"
								   type="checkbox" value="1" <?php checked( "1", esc_attr( get_option( "pnfpb-pwa-shortcode-install-icon" ) ) ); ?> />
							<span class="pnfpb_slider round"></span>
						</label>
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( "Show PWA app icon (132px) instead of text label in the install button.", "push-notification-for-post-and-buddypress" ); ?></p>
				</div>

			</div><!-- .pnfpb-settings-grid -->
		</section>

	</div><!-- #pnfpb-sc-pane-pwa -->

	<div class="pnfpb_column_full pnfpb-save-wrap">
		<?php submit_button( __( "Save Changes", "push-notification-for-post-and-buddypress" ), "pnfpb_ic_push_save_configuration_button" ); ?>
	</div>
</form>
</div>

<script>
jQuery(document).ready(function($) {
	$('#pnfpb-sc-tabs > a.pnfpb-sc-tab').on('click', function(e) {
		e.preventDefault();
		var pane = $(this).data('pane');
		$('#pnfpb-sc-tabs > a.pnfpb-sc-tab').removeClass('nav-tab-active');
		$(this).addClass('nav-tab-active');
		$('.pnfpb-tab-pane').hide();
		$('#' + pane).show();
	});
});
</script>
