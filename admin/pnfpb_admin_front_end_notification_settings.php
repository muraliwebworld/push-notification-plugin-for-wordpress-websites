<?php
/**
 * Plugin settings area to customize text for push notification subscription for frontend users
 *
 * @since 1.52.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

<h1 class="pnfpb_ic_push_settings_header"><?php echo esc_html( __( "PNFPB - Frontend Subscription Settings", "push-notification-for-post-and-buddypress" ) ); ?></h1>
<?php
	$pnfpb_tab_frontend_active = "nav-tab-active";
	require_once( plugin_dir_path( __FILE__ ) . 'push_admin_menu_list.php' );
?>

<div class="pnfpb_column_1200">
<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
	<?php settings_fields( "pnfpb_icfcm_frontend_buttons" ); ?>
	<?php do_settings_sections( "pnfpb_icfcm_frontend_buttons" ); ?>
	<?php if ( !class_exists( "OneSignal" ) && get_option( "pnfpb_onesignal_push" ) === "1" ) { ?>
	<div class="notice notice-success is-dismissible">
		<p><?php esc_html_e( "Onesignal plugin is required to use Onesignal as push notification provider. Please install and configure Onesignal plugin", "push-notification-for-post-and-buddypress" ); ?></p>
	</div>
	<?php } ?>

	<!-- BuddyPress info notice -->
	<div class="pnfpb-info-box pnfpb-info-box--blue">
		<span class="dashicons dashicons-buddicons-members pnfpb-info-box__icon"></span>
		<div>
			<strong><?php esc_html_e( "BuddyPress Profile Subscription", "push-notification-for-post-and-buddypress" ); ?></strong>
			<p><?php esc_html_e( "Frontend subscription is available only for BuddyPress users under their profile settings.", "push-notification-for-post-and-buddypress" ); ?></p>
			<p><code>members/&lt;em&gt;username&lt;/em&gt;/settings/push-subscription/</code></p>
			<p class="pnfpb-info-box__example"><?php esc_html_e( "Example:", "push-notification-for-post-and-buddypress" ); ?> <code>https://domain.com/members/username/settings/push-subscription/</code></p>
		</div>
	</div>

	<!-- ===== General Settings ===== -->
	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-admin-settings pnfpb-settings-section__icon"></span>
			<?php esc_html_e( "General Settings", "push-notification-for-post-and-buddypress" ); ?>
		</h3>
		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<!-- Enable toggle card -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-visibility"></span>
					<?php esc_html_e( "Enable Frontend Subscription", "push-notification-for-post-and-buddypress" ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<label class="pnfpb_switch">
						<input id="pnfpb_ic_fcm_frontend_enable_subsription"
							   name="pnfpb_ic_fcm_frontend_enable_subscription"
							   type="checkbox"
							   value="1" <?php checked( "1", get_option( "pnfpb_ic_fcm_frontend_enable_subscription" ) ); ?> />
						<span class="pnfpb_slider round"></span>
					</label>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( "Show or hide the push notification subscription option in the BuddyPress user profile menu.", "push-notification-for-post-and-buddypress" ); ?></p>
			</div>

			<!-- Background color card -->
			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-art"></span>
					<?php esc_html_e( "Menu Background Color", "push-notification-for-post-and-buddypress" ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb_ic_pwa_prompt_install_button_color pnfpb_ic_push_pwa_color"
						   id="pnfpb_ic_fcm_frontend_subscribe_button_color"
						   name="pnfpb_ic_fcm_frontend_subscribe_button_color"
						   type="color"
						   value="<?php if ( get_option( "pnfpb_ic_fcm_frontend_subscribe_button_color" ) ) {
								   echo esc_attr( get_option( "pnfpb_ic_fcm_frontend_subscribe_button_color" ) );
							   } else { echo esc_attr( "#aaaaaa" ); } ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( "Background color for the frontend subscription menu area.", "push-notification-for-post-and-buddypress" ); ?></p>
			</div>

		</div><!-- .pnfpb-settings-grid -->
	</section>

	<!-- ===== Subscription Labels ===== -->
	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-tag pnfpb-settings-section__icon"></span>
			<?php esc_html_e( "Subscription Labels", "push-notification-for-post-and-buddypress" ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( "Customize the text labels shown for each notification type on the user subscription settings page.", "push-notification-for-post-and-buddypress" ); ?></p>
		<div class="pnfpb-settings-grid pnfpb-settings-grid--3col">

			<!-- Post -->
			<div class="pnfpb-field-row">
				<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_frontend_settings_post_text">
					<span class="dashicons dashicons-admin-post"></span>
					<?php esc_html_e( "Post", "push-notification-for-post-and-buddypress" ); ?>
				</label>
				<input class="pnfpb-field-row__input"
					   id="pnfpb_ic_fcm_frontend_settings_post_text"
					   name="pnfpb_ic_fcm_frontend_settings_post_text"
					   type="text"
					   value="<?php if ( get_option( "pnfpb_ic_fcm_frontend_settings_post_text" ) ) {
							   echo esc_attr( get_option( "pnfpb_ic_fcm_frontend_settings_post_text" ) );
						   } else { echo esc_attr( __( "Post", "push-notification-for-post-and-buddypress" ) ); } ?>" />
			</div>

			<?php
			$pnfpb_args = [ "public" => true, "_builtin" => false ];
			$pnfpb_custposttypes = get_post_types( $pnfpb_args, "names", "and" );
			foreach ( $pnfpb_custposttypes as $pnfpb_post_type ) {
				if ( $pnfpb_post_type !== "buddypress" && $pnfpb_post_type !== "post" ) { ?>
			<div class="pnfpb-field-row">
				<label class="pnfpb-field-row__label" for="<?php echo esc_attr( "pnfpb_ic_fcm_frontend_settings_" . $pnfpb_post_type . "_text" ); ?>">
					<span class="dashicons dashicons-admin-post"></span>
					<?php echo esc_html( ucwords( $pnfpb_post_type ) ); ?>
				</label>
				<input class="pnfpb-field-row__input"
					   id="<?php echo esc_attr( "pnfpb_ic_fcm_frontend_settings_" . $pnfpb_post_type . "_text" ); ?>"
					   name="<?php echo esc_attr( "pnfpb_ic_fcm_frontend_settings_" . $pnfpb_post_type . "_text" ); ?>"
					   type="text"
					   value="<?php if ( get_option( "pnfpb_ic_fcm_frontend_settings_" . $pnfpb_post_type . "_text" ) ) {
							   echo esc_attr( get_option( "pnfpb_ic_fcm_frontend_settings_" . $pnfpb_post_type . "_text" ) );
						   } else { echo esc_attr( ucwords( $pnfpb_post_type ) ); } ?>" />
			</div>
				<?php }
			} ?>

			<!-- Activities -->
			<div class="pnfpb-field-row">
				<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_frontend_settings_activities_text">
					<span class="dashicons dashicons-buddicons-activity"></span>
					<?php esc_html_e( "Activities", "push-notification-for-post-and-buddypress" ); ?>
				</label>
				<input class="pnfpb-field-row__input"
					   id="pnfpb_ic_fcm_frontend_settings_activities_text"
					   name="pnfpb_ic_fcm_frontend_settings_activities_text"
					   type="text"
					   value="<?php if ( get_option( "pnfpb_ic_fcm_frontend_settings_activities_text" ) ) {
							   echo esc_attr( get_option( "pnfpb_ic_fcm_frontend_settings_activities_text" ) );
						   } else { echo esc_attr( __( "Activities", "push-notification-for-post-and-buddypress" ) ); } ?>" />
			</div>

			<!-- Comments -->
			<div class="pnfpb-field-row">
				<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_frontend_settings_comments_text">
					<span class="dashicons dashicons-admin-comments"></span>
					<?php esc_html_e( "Comments", "push-notification-for-post-and-buddypress" ); ?>
				</label>
				<input class="pnfpb-field-row__input"
					   id="pnfpb_ic_fcm_frontend_settings_comments_text"
					   name="pnfpb_ic_fcm_frontend_settings_comments_text"
					   type="text"
					   value="<?php if ( get_option( "pnfpb_ic_fcm_frontend_settings_comments_text" ) ) {
							   echo esc_attr( get_option( "pnfpb_ic_fcm_frontend_settings_comments_text" ) );
						   } else { echo esc_attr( __( "Comments", "push-notification-for-post-and-buddypress" ) ); } ?>" />
			</div>

			<!-- Comments on My Posts -->
			<div class="pnfpb-field-row">
				<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_frontend_settings_mycomments_text">
					<span class="dashicons dashicons-admin-comments"></span>
					<?php esc_html_e( "Comments on My Posts", "push-notification-for-post-and-buddypress" ); ?>
				</label>
				<input class="pnfpb-field-row__input"
					   id="pnfpb_ic_fcm_frontend_settings_mycomments_text"
					   name="pnfpb_ic_fcm_frontend_settings_mycomments_text"
					   type="text"
					   value="<?php if ( get_option( "pnfpb_ic_fcm_frontend_settings_mycomments_text" ) ) {
							   echo esc_attr( get_option( "pnfpb_ic_fcm_frontend_settings_mycomments_text" ) );
						   } else { echo esc_attr( __( "Comments on My activity/My Post", "push-notification-for-post-and-buddypress" ) ); } ?>" />
			</div>

			<!-- Private Message -->
			<div class="pnfpb-field-row">
				<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_frontend_settings_privatemessage_text">
					<span class="dashicons dashicons-email-alt"></span>
					<?php esc_html_e( "Private Message", "push-notification-for-post-and-buddypress" ); ?>
				</label>
				<input class="pnfpb-field-row__input"
					   id="pnfpb_ic_fcm_frontend_settings_privatemessage_text"
					   name="pnfpb_ic_fcm_frontend_settings_privatemessage_text"
					   type="text"
					   value="<?php if ( get_option( "pnfpb_ic_fcm_frontend_settings_privatemessage_text" ) ) {
							   echo esc_attr( get_option( "pnfpb_ic_fcm_frontend_settings_privatemessage_text" ) );
						   } else { echo esc_attr( __( "Private message", "push-notification-for-post-and-buddypress" ) ); } ?>" />
			</div>

			<!-- New Member Joined -->
			<div class="pnfpb-field-row">
				<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_frontend_settings_newmember_text">
					<span class="dashicons dashicons-groups"></span>
					<?php esc_html_e( "New Member Joined", "push-notification-for-post-and-buddypress" ); ?>
				</label>
				<input class="pnfpb-field-row__input"
					   id="pnfpb_ic_fcm_frontend_settings_newmember_text"
					   name="pnfpb_ic_fcm_frontend_settings_newmember_text"
					   type="text"
					   value="<?php if ( get_option( "pnfpb_ic_fcm_frontend_settings_newmember_text" ) ) {
							   echo esc_attr( get_option( "pnfpb_ic_fcm_frontend_settings_newmember_text" ) );
						   } else { echo esc_attr( "New member joined" ); } ?>" />
			</div>

			<!-- Friendship Request -->
			<div class="pnfpb-field-row">
				<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_frontend_settings_friend_request_text">
					<span class="dashicons dashicons-buddicons-friends"></span>
					<?php esc_html_e( "Friendship Request", "push-notification-for-post-and-buddypress" ); ?>
				</label>
				<input class="pnfpb-field-row__input"
					   id="pnfpb_ic_fcm_frontend_settings_friend_request_text"
					   name="pnfpb_ic_fcm_frontend_settings_friend_request_text"
					   type="text"
					   value="<?php if ( get_option( "pnfpb_ic_fcm_frontend_settings_friend_request_text" ) ) {
							   echo esc_attr( get_option( "pnfpb_ic_fcm_frontend_settings_friend_request_text" ) );
						   } else { echo esc_attr( __( "Friendship request", "push-notification-for-post-and-buddypress" ) ); } ?>" />
			</div>

			<!-- Friendship Accepted -->
			<div class="pnfpb-field-row">
				<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_frontend_settings_friend_accept_text">
					<span class="dashicons dashicons-yes-alt"></span>
					<?php esc_html_e( "Friendship Accepted", "push-notification-for-post-and-buddypress" ); ?>
				</label>
				<input class="pnfpb-field-row__input"
					   id="pnfpb_ic_fcm_frontend_settings_friend_accept_text"
					   name="pnfpb_ic_fcm_frontend_settings_friend_accept_text"
					   type="text"
					   value="<?php if ( get_option( "pnfpb_ic_fcm_frontend_settings_friend_accept_text" ) ) {
							   echo esc_attr( get_option( "pnfpb_ic_fcm_frontend_settings_friend_accept_text" ) );
						   } else { echo esc_attr( __( "Friendship accepted", "push-notification-for-post-and-buddypress" ) ); } ?>" />
			</div>

			<!-- Avatar Change -->
			<div class="pnfpb-field-row">
				<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_frontend_settings_avatar_change_text">
					<span class="dashicons dashicons-admin-users"></span>
					<?php esc_html_e( "Avatar Change", "push-notification-for-post-and-buddypress" ); ?>
				</label>
				<input class="pnfpb-field-row__input"
					   id="pnfpb_ic_fcm_frontend_settings_avatar_change_text"
					   name="pnfpb_ic_fcm_frontend_settings_avatar_change_text"
					   type="text"
					   value="<?php if ( get_option( "pnfpb_ic_fcm_frontend_settings_avatar_change_text" ) ) {
							   echo esc_attr( get_option( "pnfpb_ic_fcm_frontend_settings_avatar_change_text" ) );
						   } else { echo esc_attr( __( "Avatar change", "push-notification-for-post-and-buddypress" ) ); } ?>" />
			</div>

			<!-- Cover Image Change -->
			<div class="pnfpb-field-row">
				<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_frontend_settings_coverimage_change_text">
					<span class="dashicons dashicons-format-image"></span>
					<?php esc_html_e( "Cover Image Change", "push-notification-for-post-and-buddypress" ); ?>
				</label>
				<input class="pnfpb-field-row__input"
					   id="pnfpb_ic_fcm_frontend_settings_coverimage_change_text"
					   name="pnfpb_ic_fcm_frontend_settings_coverimage_change_text"
					   type="text"
					   value="<?php if ( get_option( "pnfpb_ic_fcm_frontend_settings_coverimage_change_text" ) ) {
							   echo esc_attr( get_option( "pnfpb_ic_fcm_frontend_settings_coverimage_change_text" ) );
						   } else { echo esc_attr( __( "Cover image change", "push-notification-for-post-and-buddypress" ) ); } ?>" />
			</div>

			<!-- Group Details Update -->
			<div class="pnfpb-field-row">
				<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_frontend_settings_groupdetails_text">
					<span class="dashicons dashicons-buddicons-groups"></span>
					<?php esc_html_e( "Group Details Update", "push-notification-for-post-and-buddypress" ); ?>
				</label>
				<input class="pnfpb-field-row__input"
					   id="pnfpb_ic_fcm_frontend_settings_groupdetails_text"
					   name="pnfpb_ic_fcm_frontend_settings_groupdetails_text"
					   type="text"
					   value="<?php if ( get_option( "pnfpb_ic_fcm_frontend_settings_groupdetails_text" ) ) {
							   echo esc_attr( get_option( "pnfpb_ic_fcm_frontend_settings_groupdetails_text" ) );
						   } else { echo esc_attr( __( "Group details update", "push-notification-for-post-and-buddypress" ) ); } ?>" />
			</div>

			<!-- Group Invite -->
			<div class="pnfpb-field-row">
				<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_frontend_settings_groupinvite_text">
					<span class="dashicons dashicons-buddicons-groups"></span>
					<?php esc_html_e( "Group Invite", "push-notification-for-post-and-buddypress" ); ?>
				</label>
				<input class="pnfpb-field-row__input"
					   id="pnfpb_ic_fcm_frontend_settings_groupinvite_text"
					   name="pnfpb_ic_fcm_frontend_settings_groupinvite_text"
					   type="text"
					   value="<?php if ( get_option( "pnfpb_ic_fcm_frontend_settings_groupinvite_text" ) ) {
							   echo esc_attr( get_option( "pnfpb_ic_fcm_frontend_settings_groupinvite_text" ) );
						   } else { echo esc_attr( __( "Group invite", "push-notification-for-post-and-buddypress" ) ); } ?>" />
			</div>

			<!-- Likes / Favourites -->
			<div class="pnfpb-field-row">
				<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_frontend_settings_favourite_text">
					<span class="dashicons dashicons-heart"></span>
					<?php esc_html_e( "Likes / Favourites", "push-notification-for-post-and-buddypress" ); ?>
				</label>
				<input class="pnfpb-field-row__input"
					   id="pnfpb_ic_fcm_frontend_settings_favourite_text"
					   name="pnfpb_ic_fcm_frontend_settings_favourite_text"
					   type="text"
					   value="<?php if ( get_option( "pnfpb_ic_fcm_frontend_settings_favourite_text" ) ) {
							   echo esc_attr( get_option( "pnfpb_ic_fcm_frontend_settings_favourite_text" ) );
						   } else { echo esc_attr( __( "Likes/Favourites", "push-notification-for-post-and-buddypress" ) ); } ?>" />
			</div>

			<!-- BP Followers -->
			<div class="pnfpb-field-row">
				<label class="pnfpb-field-row__label" for="pnfpb_ic_fcm_frontend_settings_followers_text">
					<span class="dashicons dashicons-groups"></span>
					<?php esc_html_e( "BP Followers", "push-notification-for-post-and-buddypress" ); ?>
				</label>
				<input class="pnfpb-field-row__input"
					   id="pnfpb_ic_fcm_frontend_settings_followers_text"
					   name="pnfpb_ic_fcm_frontend_settings_followers_text"
					   type="text"
					   value="<?php if ( get_option( "pnfpb_ic_fcm_frontend_settings_followers_text" ) ) {
							   echo esc_attr( get_option( "pnfpb_ic_fcm_frontend_settings_followers_text" ) );
						   } else { echo esc_attr( __( "BP Followers", "push-notification-for-post-and-buddypress" ) ); } ?>" />
			</div>

		</div><!-- .pnfpb-settings-grid -->
	</section>

	<div class="pnfpb_column_full pnfpb-save-wrap">
		<?php submit_button( __( "Save Changes", "push-notification-for-post-and-buddypress" ), "pnfpb_ic_push_frontend_save_configuration_button" ); ?>
	</div>
</form>
</div>
