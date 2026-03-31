<?php
/**
 * Plugin settings area to customize notification button options
 */
?>
<h1 class="pnfpb_ic_push_settings_header"><?php echo esc_html( __( "PNFPB - Customize Button Options", "push-notification-for-post-and-buddypress" ) ); ?></h1>
<?php
	$pnfpb_tab_adminbutton_active = "active";
	require_once( plugin_dir_path( __FILE__ ) . 'push_admin_menu_list.php' );
?>

<div class="pnfpb_column_1200">
<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
	<?php settings_fields( "pnfpb_icfcm_buttons" ); ?>
	<?php do_settings_sections( "pnfpb_icfcm_buttons" ); ?>

	<!-- ===== 4-tab sub-navigation ===== -->
	<nav id="pnfpb-btn-tabs" class="nav-tab-wrapper pnfpb-btn-sub-bar">
		<a id="pnfpb-btn-tab-notify" class="nav-tab pnfpb-btn-tab pnfpb-btn-tab--notify nav-tab-active" href="#pnfpb-btn-pane-notify" data-pane="pnfpb-btn-pane-notify">
			<span class="pnfpb-btn-tab__icon"><span class="dashicons dashicons-bell"></span></span>
			<span class="pnfpb-btn-tab__label"><?php esc_html_e( "Subscribe Button", "push-notification-for-post-and-buddypress" ); ?></span>
		</a>
		<a id="pnfpb-btn-tab-bpgroup" class="nav-tab pnfpb-btn-tab pnfpb-btn-tab--bpgroup" href="#pnfpb-btn-pane-bpgroup" data-pane="pnfpb-btn-pane-bpgroup">
			<span class="pnfpb-btn-tab__icon"><span class="dashicons dashicons-buddicons-groups"></span></span>
			<span class="pnfpb-btn-tab__label"><?php esc_html_e( "BP Group", "push-notification-for-post-and-buddypress" ); ?></span>
		</a>
		<a id="pnfpb-btn-tab-scopts" class="nav-tab pnfpb-btn-tab pnfpb-btn-tab--scopts" href="#pnfpb-btn-pane-scopts" data-pane="pnfpb-btn-pane-scopts">
			<span class="pnfpb-btn-tab__icon"><span class="dashicons dashicons-list-view"></span></span>
			<span class="pnfpb-btn-tab__label"><?php esc_html_e( "Notify Options", "push-notification-for-post-and-buddypress" ); ?></span>
		</a>
		<a id="pnfpb-btn-tab-pwainstall" class="nav-tab pnfpb-btn-tab pnfpb-btn-tab--pwainstall" href="#pnfpb-btn-pane-pwainstall" data-pane="pnfpb-btn-pane-pwainstall">
			<span class="pnfpb-btn-tab__icon"><span class="dashicons dashicons-smartphone"></span></span>
			<span class="pnfpb-btn-tab__label"><?php esc_html_e( "PWA Install", "push-notification-for-post-and-buddypress" ); ?></span>
		</a>
	</nav>

	<!-- ===== Tab 1: Subscribe / Unsubscribe Button Colors ===== -->
	<div id="pnfpb-btn-pane-notify" class="pnfpb-tab-pane">
		<section class="pnfpb-settings-section">
			<h3 class="pnfpb-settings-section__title">
				<span class="dashicons dashicons-bell pnfpb-settings-section__icon"></span>
				<?php esc_html_e( "Subscribe / Unsubscribe Button Colors", "push-notification-for-post-and-buddypress" ); ?>
			</h3>
			<p class="pnfpb-settings-section__desc"><?php esc_html_e( "Set the background color for the subscribe and unsubscribe notification buttons displayed on your site.", "push-notification-for-post-and-buddypress" ); ?></p>
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-yes-alt"></span>
						<?php esc_html_e( "Subscribe Button Color", "push-notification-for-post-and-buddypress" ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_prompt_button_background"
							   id="pnfpb_ic_fcm_subscribe_button_color"
							   name="pnfpb_ic_fcm_subscribe_button_color"
							   type="color"
							   value="<?php if ( get_option( "pnfpb_ic_fcm_subscribe_button_color" ) ) {
									echo esc_attr( get_option( "pnfpb_ic_fcm_subscribe_button_color" ) );
								} else { echo esc_attr( "#e54b4d" ); } ?>" />
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( "Background color of the Subscribe button.", "push-notification-for-post-and-buddypress" ); ?></p>
				</div>

				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-no-alt"></span>
						<?php esc_html_e( "Unsubscribe Button Color", "push-notification-for-post-and-buddypress" ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_fcm_push_prompt_button_background"
							   id="pnfpb_ic_fcm_subscribe_button_text_color"
							   name="pnfpb_ic_fcm_subscribe_button_text_color"
							   type="color"
							   value="<?php if ( get_option( "pnfpb_ic_fcm_subscribe_button_text_color" ) ) {
									echo esc_attr( get_option( "pnfpb_ic_fcm_subscribe_button_text_color" ) );
								} else { echo esc_attr( "#0066ff" ); } ?>" />
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( "Background color of the Unsubscribe button.", "push-notification-for-post-and-buddypress" ); ?></p>
				</div>

			</div>
		</section>
	</div><!-- #pnfpb-btn-pane-notify -->

	<!-- ===== Tab 2: BuddyPress Group ===== -->
	<div id="pnfpb-btn-pane-bpgroup" class="pnfpb-tab-pane" style="display:none;">

		<!-- Section: Visibility -->
		<section class="pnfpb-settings-section">
			<h3 class="pnfpb-settings-section__title">
				<span class="dashicons dashicons-visibility pnfpb-settings-section__icon"></span>
				<?php esc_html_e( "Visibility", "push-notification-for-post-and-buddypress" ); ?>
			</h3>
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">
				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-buddicons-groups"></span>
						<?php esc_html_e( "Show Group Subscribe Button", "push-notification-for-post-and-buddypress" ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<label class="pnfpb_switch">
							<input id="pnfpb_subscribe_group_push_notification_icon_enable"
								   name="pnfpb_subscribe_group_push_notification_icon_enable"
								   type="checkbox" value="1"
								   <?php if ( get_option( "pnfpb_subscribe_group_push_notification_icon_enable", "0" ) === "1" ) { echo esc_attr( "checked" ); } ?> />
							<span class="pnfpb_slider round"></span>
						</label>
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( "Display the group subscribe/unsubscribe button on BuddyPress group pages.", "push-notification-for-post-and-buddypress" ); ?></p>
				</div>
			</div>
		</section>

		<!-- Section: Button Labels -->
		<section class="pnfpb-settings-section">
			<h3 class="pnfpb-settings-section__title">
				<span class="dashicons dashicons-text-page pnfpb-settings-section__icon"></span>
				<?php esc_html_e( "Button Labels", "push-notification-for-post-and-buddypress" ); ?>
			</h3>
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_group_subscribe_button_text">
						<span class="dashicons dashicons-yes"></span>
						<?php esc_html_e( "Subscribe Button Text", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input"
						   id="pnfpb_ic_fcm_group_subscribe_button_text"
						   name="pnfpb_ic_fcm_group_subscribe_button_text"
						   type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_group_subscribe_button_text" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_group_subscribe_button_text" ) );
							} else { echo esc_attr( __( "Subscribe push notifications", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_group_unsubscribe_button_text">
						<span class="dashicons dashicons-no"></span>
						<?php esc_html_e( "Unsubscribe Button Text", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input"
						   id="pnfpb_ic_fcm_group_unsubscribe_button_text"
						   name="pnfpb_ic_fcm_group_unsubscribe_button_text"
						   type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_group_unsubscribe_button_text" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_group_unsubscribe_button_text" ) );
							} else { echo esc_attr( __( "Unsubscribe push notifications", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

			</div>
		</section>

		<!-- Section: Button Icons -->
		<section class="pnfpb-settings-section">
			<h3 class="pnfpb-settings-section__title">
				<span class="dashicons dashicons-admin-media pnfpb-settings-section__icon"></span>
				<?php esc_html_e( "Button Icons", "push-notification-for-post-and-buddypress" ); ?>
			</h3>
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

				<!-- Subscribe icon -->
				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-yes-alt"></span>
						<?php esc_html_e( "Subscribe Button Icon", "push-notification-for-post-and-buddypress" ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<button id="pnfpb_select_subscribe_group_push_notification_icon"
								class="pnfpb_ic_push_pwa_settings_upload_icon button button-secondary">
							<?php esc_html_e( "Upload Icon", "push-notification-for-post-and-buddypress" ); ?>
						</button>
						<input type="hidden"
							   id="pnfpb_subscribe_group_push_notification_icon"
							   name="pnfpb_subscribe_group_push_notification_icon"
							   value="<?php if ( get_option( "pnfpb_subscribe_group_push_notification_icon" ) ) {
									echo esc_attr( get_option( "pnfpb_subscribe_group_push_notification_icon" ) );
								} else { echo esc_attr( plugin_dir_url( __DIR__ ) ) . "public/img/subscribe_push_notification.png"; } ?>" />
						<div id="pnfpb_subscribe_group_push_notification_icon_preview"
							 style="background-image:url(<?php if ( get_option( "pnfpb_subscribe_group_push_notification_icon" ) ) {
								echo esc_url( get_option( "pnfpb_subscribe_group_push_notification_icon" ) );
							} else { echo esc_url( plugin_dir_url( __DIR__ ) ) . "public/img/subscribe_push_notification.png"; } ?>);width:32px;height:32px;border-radius:50%;margin:10px 0;background-position:center;background-repeat:no-repeat;background-size:cover;">
						</div>
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( "Icon displayed on the group subscribe button (32\xc3\x9732 px recommended).", "push-notification-for-post-and-buddypress" ); ?></p>
				</div>

				<!-- Unsubscribe icon -->
				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-no-alt"></span>
						<?php esc_html_e( "Unsubscribe Button Icon", "push-notification-for-post-and-buddypress" ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<button id="pnfpb_select_unsubscribe_group_push_notification_icon"
								class="pnfpb_ic_push_pwa_settings_upload_icon button button-secondary">
							<?php esc_html_e( "Upload Icon", "push-notification-for-post-and-buddypress" ); ?>
						</button>
						<input type="hidden"
							   id="pnfpb_unsubscribe_group_push_notification_icon"
							   name="pnfpb_unsubscribe_group_push_notification_icon"
							   value="<?php if ( get_option( "pnfpb_unsubscribe_group_push_notification_icon" ) ) {
									echo esc_attr( get_option( "pnfpb_unsubscribe_group_push_notification_icon" ) );
								} else { echo esc_attr( plugin_dir_url( __DIR__ ) ) . "public/img/unsubscribe_push_notification.png"; } ?>" />
						<div id="pnfpb_unsubscribe_group_push_notification_icon_preview"
							 style="background-image:url(<?php if ( get_option( "pnfpb_unsubscribe_group_push_notification_icon" ) ) {
								echo esc_url( get_option( "pnfpb_unsubscribe_group_push_notification_icon" ) );
							} else { echo esc_url( plugin_dir_url( __DIR__ ) ) . "public/img/unsubscribe_push_notification.png"; } ?>);width:32px;height:32px;border-radius:50%;margin:10px 0;background-position:center;background-repeat:no-repeat;background-size:cover;">
						</div>
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( "Icon displayed on the group unsubscribe button (32\xc3\x9732 px recommended).", "push-notification-for-post-and-buddypress" ); ?></p>
				</div>

			</div>
		</section>

		<!-- Section: Dialog Messages -->
		<section class="pnfpb-settings-section">
			<h3 class="pnfpb-settings-section__title">
				<span class="dashicons dashicons-format-chat pnfpb-settings-section__icon"></span>
				<?php esc_html_e( "Confirmation Dialogs", "push-notification-for-post-and-buddypress" ); ?>
			</h3>
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_group_subscribe_dialog_text">
						<span class="dashicons dashicons-yes"></span>
						<?php esc_html_e( "Subscribe Dialog Message", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input"
						   id="pnfpb_ic_fcm_group_subscribe_dialog_text"
						   name="pnfpb_ic_fcm_group_subscribe_dialog_text"
						   type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_group_subscribe_dialog_text" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_group_subscribe_dialog_text" ) );
							} else { echo esc_attr( __( "Are you sure you want to subscribe to this group push notifications?", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_group_subscribe_dialog_text_confirm">
						<span class="dashicons dashicons-yes-alt"></span>
						<?php esc_html_e( "Subscribe Confirm Button", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input"
						   id="pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
						   name="pnfpb_ic_fcm_group_subscribe_dialog_text_confirm"
						   type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_group_subscribe_dialog_text_confirm" ) );
							} else { echo esc_attr( __( "Subscribe", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_group_unsubscribe_dialog_text">
						<span class="dashicons dashicons-no"></span>
						<?php esc_html_e( "Unsubscribe Dialog Message", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input"
						   id="pnfpb_ic_fcm_group_unsubscribe_dialog_text"
						   name="pnfpb_ic_fcm_group_unsubscribe_dialog_text"
						   type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_group_unsubscribe_dialog_text" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_group_unsubscribe_dialog_text" ) );
							} else { echo esc_attr( __( "Are you sure you want to unsubscribe from this group push notifications?", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm">
						<span class="dashicons dashicons-no-alt"></span>
						<?php esc_html_e( "Unsubscribe Confirm Button", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input"
						   id="pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
						   name="pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm"
						   type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_group_unsubscribe_dialog_text_confirm" ) );
							} else { echo esc_attr( __( "Unsubscribe", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

			</div>
		</section>

	</div><!-- #pnfpb-btn-pane-bpgroup -->

	<!-- ===== Tab 3: Shortcode Subscription Option Labels ===== -->
	<div id="pnfpb-btn-pane-scopts" class="pnfpb-tab-pane" style="display:none;">

		<section class="pnfpb-settings-section">
			<h3 class="pnfpb-settings-section__title">
				<span class="dashicons dashicons-list-view pnfpb-settings-section__icon"></span>
				<?php esc_html_e( "Shortcode Subscription Option Labels", "push-notification-for-post-and-buddypress" ); ?>
			</h3>
			<p class="pnfpb-settings-section__desc"><?php esc_html_e( "Customize the text for each notification category shown in the shortcode subscription dropdown.", "push-notification-for-post-and-buddypress" ); ?></p>
			<div class="pnfpb-settings-grid pnfpb-settings-grid--3col">

				<?php
				$pnfpb_args = [ "public" => true, "_builtin" => false ];
				$pnfpb_custposttypes = get_post_types( $pnfpb_args, "names", "and" );
				foreach ( $pnfpb_custposttypes as $pnfpb_post_type ) {
					if ( $pnfpb_post_type !== "buddypress" ) { ?>
				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="<?php echo esc_attr( "pnfpb_ic_fcm_subscription_option_" . $pnfpb_post_type . "_text_button" ); ?>">
						<span class="dashicons dashicons-admin-post"></span>
						<?php echo esc_html( ucwords( $pnfpb_post_type ) ); ?>
					</label>
					<input class="pnfpb-field-row__input"
						   id="<?php echo esc_html( "pnfpb_ic_fcm_subscription_option_" . $pnfpb_post_type . "_text_button" ); ?>"
						   name="<?php echo esc_html( "pnfpb_ic_fcm_subscription_option_" . $pnfpb_post_type . "_text_button" ); ?>"
						   type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_subscription_option_" . $pnfpb_post_type . "_text_button" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_subscription_option_" . $pnfpb_post_type . "_text_button" ) );
							} else { echo esc_attr( ucwords( $pnfpb_post_type ) ); } ?>" />
				</div>
					<?php }
				} ?>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_subscription_option_all_text_button">
						<span class="dashicons dashicons-yes-alt"></span>
						<?php esc_html_e( "Subscribe All", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_ic_fcm_subscription_option_all_text_button" name="pnfpb_ic_fcm_subscription_option_all_text_button" type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_subscription_option_all_text_button" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_subscription_option_all_text_button" ) );
							} else { echo esc_attr( __( "Subscribe all", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_subscription_option_post_text_button">
						<span class="dashicons dashicons-admin-post"></span>
						<?php esc_html_e( "New Post", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_ic_fcm_subscription_option_post_text_button" name="pnfpb_ic_fcm_subscription_option_post_text_button" type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_subscription_option_post_text_button" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_subscription_option_post_text_button" ) );
							} else { echo esc_attr( __( "New post", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_subscription_option_activity_text_button">
						<span class="dashicons dashicons-buddicons-activity"></span>
						<?php esc_html_e( "New Activity", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_ic_fcm_subscription_option_activity_text_button" name="pnfpb_ic_fcm_subscription_option_activity_text_button" type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_subscription_option_activity_text_button" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_subscription_option_activity_text_button" ) );
							} else { echo esc_attr( __( "New post/activity", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_subscription_option_all_comments_text_button">
						<span class="dashicons dashicons-admin-comments"></span>
						<?php esc_html_e( "All Comments", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_ic_fcm_subscription_option_all_comments_text_button" name="pnfpb_ic_fcm_subscription_option_all_comments_text_button" type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_subscription_option_all_comments_text_button" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_subscription_option_all_comments_text_button" ) );
							} else { echo esc_attr( __( "Comments", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_subscription_option_my_comments_text_button">
						<span class="dashicons dashicons-admin-comments"></span>
						<?php esc_html_e( "Comments on My Posts", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_ic_fcm_subscription_option_my_comments_text_button" name="pnfpb_ic_fcm_subscription_option_my_comments_text_button" type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_subscription_option_my_comments_text_button" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_subscription_option_my_comments_text_button" ) );
							} else { echo esc_attr( __( "Comments on my posts/my activities ", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_subscription_option_private_message_text_button">
						<span class="dashicons dashicons-email-alt"></span>
						<?php esc_html_e( "Private Message", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_ic_fcm_subscription_option_private_message_text_button" name="pnfpb_ic_fcm_subscription_option_private_message_text_button" type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_subscription_option_private_message_text_button" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_subscription_option_private_message_text_button" ) );
							} else { echo esc_attr( __( "Private message", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_subscription_option_new_member_text_button">
						<span class="dashicons dashicons-groups"></span>
						<?php esc_html_e( "New Member Joined", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_ic_fcm_subscription_option_new_member_text_button" name="pnfpb_ic_fcm_subscription_option_new_member_text_button" type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_subscription_option_new_member_text_button" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_subscription_option_new_member_text_button" ) );
							} else { echo esc_attr( __( "New member joined", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_subscription_option_friend_request_text_button">
						<span class="dashicons dashicons-buddicons-friends"></span>
						<?php esc_html_e( "Friend Request", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_ic_fcm_subscription_option_friend_request_text_button" name="pnfpb_ic_fcm_subscription_option_friend_request_text_button" type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_subscription_option_friend_request_text_button" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_subscription_option_friend_request_text_button" ) );
							} else { echo esc_attr( __( "Friend request", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_subscription_option_friendship_accepted_text_button">
						<span class="dashicons dashicons-yes-alt"></span>
						<?php esc_html_e( "Friendship Accepted", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_ic_fcm_subscription_option_friendship_accepted_text_button" name="pnfpb_ic_fcm_subscription_option_friendship_accepted_text_button" type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_subscription_option_friendship_accepted_text_button" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_subscription_option_friendship_accepted_text_button" ) );
							} else { echo esc_attr( __( "Friendship accepted ", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_subscription_option_user_avatar_text_button">
						<span class="dashicons dashicons-admin-users"></span>
						<?php esc_html_e( "Avatar Change", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_ic_fcm_subscription_option_user_avatar_text_button" name="pnfpb_ic_fcm_subscription_option_user_avatar_text_button" type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_subscription_option_user_avatar_text_button" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_subscription_option_user_avatar_text_button" ) );
							} else { echo esc_attr( __( "User avatar change", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_subscription_option_cover_image_text_button">
						<span class="dashicons dashicons-format-image"></span>
						<?php esc_html_e( "Cover Image Change", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_ic_fcm_subscription_option_cover_image_text_button" name="pnfpb_ic_fcm_subscription_option_cover_image_text_button" type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_subscription_option_cover_image_text_button" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_subscription_option_cover_image_text_button" ) );
							} else { echo esc_attr( __( "Cover image change", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_subscription_option_group_details_update_text_button">
						<span class="dashicons dashicons-buddicons-groups"></span>
						<?php esc_html_e( "Group Details Update", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_ic_fcm_subscription_option_group_details_update_text_button" name="pnfpb_ic_fcm_subscription_option_group_details_update_text_button" type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_subscription_option_group_details_update_text_button" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_subscription_option_group_details_update_text_button" ) );
							} else { echo esc_attr( __( "Group details update", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_subscription_option_group_invite_text_button">
						<span class="dashicons dashicons-buddicons-groups"></span>
						<?php esc_html_e( "Group Invite", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_ic_fcm_subscription_option_group_invite_text_button" name="pnfpb_ic_fcm_subscription_option_group_invite_text_button" type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_subscription_option_group_invite_text_button" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_subscription_option_group_invite_text_button" ) );
							} else { echo esc_attr( __( "Group invite", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_subscription_option_favourite_text_button">
						<span class="dashicons dashicons-heart"></span>
						<?php esc_html_e( "Likes / Favourites", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_ic_fcm_subscription_option_favourite_text_button" name="pnfpb_ic_fcm_subscription_option_favourite_text_button" type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_subscription_option_favourite_text_button" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_subscription_option_favourite_text_button" ) );
							} else { echo esc_attr( __( "Likes/Favourites", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_subscription_option_followers_text_button">
						<span class="dashicons dashicons-groups"></span>
						<?php esc_html_e( "BP Followers", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_ic_fcm_subscription_option_followers_text_button" name="pnfpb_ic_fcm_subscription_option_followers_text_button" type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_subscription_option_followers_text_button" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_subscription_option_followers_text_button" ) );
							} else { echo esc_attr( __( "BP Followers", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_subscription_option_text_button_confirm">
						<span class="dashicons dashicons-yes"></span>
						<?php esc_html_e( "Subscription Confirmed Message", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_ic_fcm_subscription_option_text_button_confirm" name="pnfpb_ic_fcm_subscription_option_text_button_confirm" type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_subscription_option_text_button_confirm" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_subscription_option_text_button_confirm" ) );
							} else { echo esc_attr( __( "Subscription option updated", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_subscription_text_button_text_confirm">
						<span class="dashicons dashicons-no-alt"></span>
						<?php esc_html_e( "Unsubscription Confirmed Message", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input" id="pnfpb_ic_fcm_subscription_text_button_text_confirm" name="pnfpb_ic_fcm_subscription_text_button_text_confirm" type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_subscription_text_button_text_confirm" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_subscription_text_button_text_confirm" ) );
							} else { echo esc_attr( __( "Subscription option updated", "push-notification-for-post-and-buddypress" ) ); } ?>" />
				</div>

			</div>
		</section>

	</div><!-- #pnfpb-btn-pane-scopts -->

	<!-- ===== Tab 4: PWA Install Shortcode Button ===== -->
	<div id="pnfpb-btn-pane-pwainstall" class="pnfpb-tab-pane" style="display:none;">

		<section class="pnfpb-settings-section">
			<h3 class="pnfpb-settings-section__title">
				<span class="dashicons dashicons-smartphone pnfpb-settings-section__icon"></span>
				<?php esc_html_e( "PWA Install Button", "push-notification-for-post-and-buddypress" ); ?>
				<code style="font-size:12px;margin-left:8px;background:#F3F4F6;padding:2px 6px;border-radius:4px;">[PNFPB_PWA_PROMPT]</code>
			</h3>
			<div class="pnfpb-settings-grid pnfpb-settings-grid--3col">

				<div class="pnfpb-field-row">
					<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_install_pwa_button_text">
						<span class="dashicons dashicons-editor-textcolor"></span>
						<?php esc_html_e( "Button Text", "push-notification-for-post-and-buddypress" ); ?>
					</label>
					<input class="pnfpb-field-row__input"
						   id="pnfpb_ic_fcm_install_pwa_button_text"
						   name="pnfpb_ic_fcm_install_pwa_button_text"
						   type="text"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_install_pwa_button_text" ) ) {
								echo esc_attr( get_option( "pnfpb_ic_fcm_install_pwa_button_text" ) );
							} else { echo esc_attr( "Install PWA" ); } ?>" />
				</div>

				<div class="pnfpb-field-card">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-art"></span>
						<?php esc_html_e( "Button Background Color", "push-notification-for-post-and-buddypress" ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_pwa_prompt_install_button_color pnfpb_ic_push_pwa_color"
							   id="pnfpb_ic_fcm_install_pwa_button_color"
							   name="pnfpb_ic_fcm_install_pwa_button_color"
							   type="color"
							   value="<?php if ( get_option( "pnfpb_ic_fcm_install_pwa_button_color" ) ) {
									echo esc_attr( get_option( "pnfpb_ic_fcm_install_pwa_button_color" ) );
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
							   id="pnfpb_ic_fcm_install_pwa_button_text_color"
							   name="pnfpb_ic_fcm_install_pwa_button_text_color"
							   type="color"
							   value="<?php if ( get_option( "pnfpb_ic_fcm_install_pwa_button_text_color" ) ) {
									echo esc_attr( get_option( "pnfpb_ic_fcm_install_pwa_button_text_color" ) );
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
							<input id="pnfpb-pwa-button-install-icon" name="pnfpb-pwa-button-install-icon"
								   type="checkbox" value="1" <?php checked( "1", esc_attr( get_option( "pnfpb-pwa-button-install-icon" ) ) ); ?> />
							<span class="pnfpb_slider round"></span>
						</label>
					</div>
					<p class="pnfpb-field-card__desc"><?php esc_html_e( "Show PWA app icon (132px) instead of text label in the install button.", "push-notification-for-post-and-buddypress" ); ?></p>
				</div>

			</div>
		</section>

	</div><!-- #pnfpb-btn-pane-pwainstall -->

	<div class="pnfpb_column_full pnfpb-save-wrap">
		<?php submit_button( __( "Save Changes", "push-notification-for-post-and-buddypress" ), "pnfpb_ic_push_save_configuration_button" ); ?>
	</div>
</form>
</div>

<script>
jQuery(document).ready(function($) {
	$('#pnfpb-btn-tabs > a.pnfpb-btn-tab').on('click', function(e) {
		e.preventDefault();
		var pane = $(this).data('pane');
		$('#pnfpb-btn-tabs > a.pnfpb-btn-tab').removeClass('nav-tab-active');
		$(this).addClass('nav-tab-active');
		$('.pnfpb-tab-pane').hide();
		$('#' + pane).show();
	});
});
</script>
