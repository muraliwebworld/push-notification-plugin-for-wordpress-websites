<?php
/*
 * BuddyPress options settings for push notification
 * @since 2.08
 */
?>

<?php /* ─── Section 1: BuddyPress Social Notifications ──────────────────── */ ?>
<?php if ( get_option( 'pnfpb_progressier_push' ) !== '1' && get_option( 'pnfpb_webtoapp_push' ) !== '1' ) : ?>
<section class="pnfpb-settings-section">
	<h3 class="pnfpb-settings-section__title">
		<span class="dashicons dashicons-buddicons-friends pnfpb-settings-section__icon"></span>
		<?php esc_html_e( 'BuddyPress Social Notifications', 'push-notification-for-post-and-buddypress' ); ?>
	</h3>
	<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'User avatar image replaces the notification icon for all BuddyPress social notifications below.', 'push-notification-for-post-and-buddypress' ); ?></p>

	<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-update"></span>
				<?php esc_html_e( 'Background Mode', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<?php $pnfpb_ic_fcm_buddypressoptions_schedule_now_enable = ( get_option( 'pnfpb_ic_fcm_buddypressoptions_schedule_now_enable' ) === '1' ) ? '1' : '0'; ?>
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_buddypressoptions_schedule_now_enable"
						   name="pnfpb_ic_fcm_buddypressoptions_schedule_now_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', $pnfpb_ic_fcm_buddypressoptions_schedule_now_enable ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Send via Action Scheduler async mode to avoid server overload during batch processing.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

	</div>

	<div class="pnfpb-settings-grid pnfpb-settings-grid--2col" style="margin-top:16px;">

		<!-- Private Message -->
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-email"></span>
				<?php esc_html_e( 'New Private Message', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_bprivatemessage_enable" name="pnfpb_ic_fcm_bprivatemessage_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', get_option( 'pnfpb_ic_fcm_bprivatemessage_enable' ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
				<button type="button" class="pnfpb_private_message_button button button-secondary"
						onclick="toggle_private_message_form()">
					<?php esc_html_e( 'Customize', 'push-notification-for-post-and-buddypress' ); ?>
				</button>
			</div>
		</div>
		<div class="pnfpb_ic_private_message_form pnfpb-field-card" style="grid-column:1/-1;">
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col" style="margin:0;width:100%;">
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-edit"></span>
					<?php esc_html_e( 'Private Message Notification Title', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_bprivatemessage_text" name="pnfpb_ic_fcm_bprivatemessage_text"
						   type="text" value="<?php $v = get_option( 'pnfpb_ic_fcm_bprivatemessage_text' ); echo esc_attr( $v ? $v : __( '[sender name] sent you a private message', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( "[sender name] is replaced with the sender's name. Modify remaining text as desired.", 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-comments"></span>
					<?php esc_html_e( 'Private Message Notification Content', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_bprivatemessage_content" name="pnfpb_ic_fcm_bprivatemessage_content"
						   type="text" value="<?php echo esc_attr( $privatemessagecontent ); ?>" />
				</div>
				</div>
			</div>
		</div>

		<!-- New Member Joined -->
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-admin-users"></span>
				<?php esc_html_e( 'New Member Joined', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_new_member_enable" name="pnfpb_ic_fcm_new_member_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', get_option( 'pnfpb_ic_fcm_new_member_enable' ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
				<button type="button" class="pnfpb_new_member_button button button-secondary"
						onclick="toggle_new_member_form()">
					<?php esc_html_e( 'Customize', 'push-notification-for-post-and-buddypress' ); ?>
				</button>
			</div>
		</div>
		<div class="pnfpb_ic_new_member_form pnfpb-field-card" style="grid-column:1/-1;">
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col" style="margin:0;width:100%;">
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-edit"></span>
					<?php esc_html_e( 'New Member Notification Title', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_new_member_text" name="pnfpb_ic_fcm_new_member_text"
						   type="text" value="<?php $v = get_option( 'pnfpb_ic_fcm_new_member_text' ); echo esc_attr( $v ? $v : '[member name] registered as new member' ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( "[member name] is replaced with the new member's name.", 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-comments"></span>
					<?php esc_html_e( 'New Member Notification Content', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_new_member_content" name="pnfpb_ic_fcm_new_member_content"
						   type="text" value="<?php echo esc_attr( $newmembercontent ); ?>" />
				</div>
				</div>
			</div>
		</div>

		<!-- Friendship Request -->
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-buddicons-friends"></span>
				<?php esc_html_e( 'Friendship Request', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_friendship_request_enable" name="pnfpb_ic_fcm_friendship_request_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', get_option( 'pnfpb_ic_fcm_friendship_request_enable' ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
				<button type="button" class="pnfpb_friendship_request_button button button-secondary"
						onclick="toggle_friendship_request_form()">
					<?php esc_html_e( 'Customize', 'push-notification-for-post-and-buddypress' ); ?>
				</button>
			</div>
		</div>
		<div class="pnfpb_ic_friendship_request_form pnfpb-field-card" style="grid-column:1/-1;">
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col" style="margin:0;width:100%;">
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-edit"></span>
					<?php esc_html_e( 'Friendship Request Notification Title', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_friendship_request_text" name="pnfpb_ic_fcm_friendship_request_text"
						   type="text" value="<?php $v = get_option( 'pnfpb_ic_fcm_friendship_request_text' ); echo esc_attr( $v ? $v : __( '[friendship initiator name] sent friendship request', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( "[friendship initiator name] is replaced with the sender's name.", 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-comments"></span>
					<?php esc_html_e( 'Friendship Request Notification Content', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_friendship_request_content" name="pnfpb_ic_fcm_friendship_request_content"
						   type="text" value="<?php echo esc_attr( $friendshiprequestcontent ); ?>" />
				</div>
				</div>
			</div>
		</div>

		<!-- Friendship Accepted -->
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-yes-alt"></span>
				<?php esc_html_e( 'Friendship Accepted', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_friendship_accept_enable" name="pnfpb_ic_fcm_friendship_accept_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', get_option( 'pnfpb_ic_fcm_friendship_accept_enable' ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
				<button type="button" class="pnfpb_friendship_accept_button button button-secondary"
						onclick="toggle_friendship_accept_form()">
					<?php esc_html_e( 'Customize', 'push-notification-for-post-and-buddypress' ); ?>
				</button>
			</div>
		</div>
		<div class="pnfpb_ic_friendship_accept_form pnfpb-field-card" style="grid-column:1/-1;">
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col" style="margin:0;width:100%;">
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-edit"></span>
					<?php esc_html_e( 'Friendship Accepted Notification Title', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_friendship_accept_text" name="pnfpb_ic_fcm_friendship_accept_text"
						   type="text" value="<?php $v = get_option( 'pnfpb_ic_fcm_friendship_accept_text' ); echo esc_attr( $v ? $v : __( '[friendship acceptor name] accepted your friendship request', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( "[friendship acceptor name] is replaced with the acceptor's name.", 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-comments"></span>
					<?php esc_html_e( 'Friendship Accepted Notification Content', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_friendship_accept_content" name="pnfpb_ic_fcm_friendship_accept_content"
						   type="text" value="<?php echo esc_attr( $friendshipacceptcontent ); ?>" />
				</div>
				</div>
			</div>
		</div>

		<!-- Avatar Change -->
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-format-image"></span>
				<?php esc_html_e( 'User Avatar Change', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_avatar_change_enable" name="pnfpb_ic_fcm_avatar_change_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_fcm_avatar_change_enable' ) ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
				<button type="button" class="pnfpb_avatar_change_button button button-secondary"
						onclick="toggle_avatar_change_form()">
					<?php esc_html_e( 'Customize', 'push-notification-for-post-and-buddypress' ); ?>
				</button>
			</div>
		</div>
		<div class="pnfpb_ic_avatar_change_form pnfpb-field-card" style="grid-column:1/-1;">
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col" style="margin:0;width:100%;">
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-edit"></span>
					<?php esc_html_e( 'Avatar Change Notification Title', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_avatar_change_text" name="pnfpb_ic_fcm_avatar_change_text"
						   type="text" value="<?php $v = get_option( 'pnfpb_ic_fcm_avatar_change_text' ); echo esc_attr( $v ? $v : __( '[member name] updated avatar', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( "[member name] is replaced with the member's name.", 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-comments"></span>
					<?php esc_html_e( 'Avatar Change Notification Content', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_avatar_change_content" name="pnfpb_ic_fcm_avatar_change_content"
						   type="text" value="<?php echo esc_attr( $avatarchangecontent ); ?>" />
				</div>
				</div>
			</div>
		</div>

		<!-- Cover Image Change -->
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-admin-appearance"></span>
				<?php esc_html_e( 'User Cover Image Change', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_cover_image_change_enable" name="pnfpb_ic_fcm_cover_image_change_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', get_option( 'pnfpb_ic_fcm_cover_image_change_enable' ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
				<button type="button" class="pnfpb_cover_image_change_button button button-secondary"
						onclick="toggle_cover_image_change_form()">
					<?php esc_html_e( 'Customize', 'push-notification-for-post-and-buddypress' ); ?>
				</button>
			</div>
		</div>
		<div class="pnfpb_ic_cover_image_change_form pnfpb-field-card" style="grid-column:1/-1;">
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col" style="margin:0;width:100%;">
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-edit"></span>
					<?php esc_html_e( 'Cover Image Notification Title', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_cover_image_change_text" name="pnfpb_ic_fcm_cover_image_change_text"
						   type="text" value="<?php $v = get_option( 'pnfpb_ic_fcm_cover_image_change_text' ); echo esc_attr( $v ? $v : __( '[member name] updated cover photo', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( "[member name] is replaced with the member's name.", 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-comments"></span>
					<?php esc_html_e( 'Cover Image Notification Content', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_cover_image_change_content" name="pnfpb_ic_fcm_cover_image_change_content"
						   type="text" value="<?php echo esc_attr( $coverimagechangecontent ); ?>" />
				</div>
				</div>
			</div>
		</div>

		<!-- Group Invitation -->
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-groups"></span>
				<?php esc_html_e( 'Group Invitation', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_group_invitation_enable" name="pnfpb_ic_fcm_group_invitation_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_fcm_group_invitation_enable' ) ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
				<button type="button" class="pnfpb_group_invitation_button button button-secondary"
						onclick="toggle_group_invitation_form()">
					<?php esc_html_e( 'Customize', 'push-notification-for-post-and-buddypress' ); ?>
				</button>
			</div>
		</div>
		<div class="pnfpb_ic_group_invitation_form pnfpb-field-card" style="grid-column:1/-1;">
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col" style="margin:0;width:100%;">
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-edit"></span>
					<?php esc_html_e( 'Group Invitation Notification Title', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_buddypress_group_invitation_text_enable"
						   name="pnfpb_ic_fcm_buddypress_group_invitation_text_enable"
						   type="text" value="<?php $v = get_option( 'pnfpb_ic_fcm_buddypress_group_invitation_text_enable' ); echo esc_attr( $v ? $v : __( '[sender name] invited to [group name]', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( '[sender name] and [group name] are replaced with the sender name and group name respectively.', 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-comments"></span>
					<?php esc_html_e( 'Group Invitation Notification Content', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_buddypress_group_invitation_content_enable"
						   name="pnfpb_ic_fcm_buddypress_group_invitation_content_enable"
						   type="text" value="<?php echo esc_attr( $groupinvitationcontent ); ?>" />
				</div>
				</div>
			</div>
		</div>

		<!-- Group Details Updated -->
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-admin-generic"></span>
				<?php esc_html_e( 'Group Details Update', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_group_details_updated_enable" name="pnfpb_ic_fcm_group_details_updated_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_fcm_group_details_updated_enable' ) ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
				<button type="button" class="pnfpb_group_details_updated_button button button-secondary"
						onclick="toggle_group_details_updated_form()">
					<?php esc_html_e( 'Customize', 'push-notification-for-post-and-buddypress' ); ?>
				</button>
			</div>
		</div>
		<div class="pnfpb_ic_group_details_updated_form pnfpb-field-card" style="grid-column:1/-1;">
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col" style="margin:0;width:100%;">
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-edit"></span>
					<?php esc_html_e( 'Group Updated Notification Title', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_buddypress_group_details_updated_text_enable"
						   name="pnfpb_ic_fcm_buddypress_group_details_updated_text_enable"
						   type="text" value="<?php $v = get_option( 'pnfpb_ic_fcm_buddypress_group_details_updated_text_enable' ); echo esc_attr( $v ? $v : __( '[group name] group updated', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( '[group name] is replaced with the group name.', 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-comments"></span>
					<?php esc_html_e( 'Group Updated Notification Content', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_buddypress_group_details_updated_content_enable"
						   name="pnfpb_ic_fcm_buddypress_group_details_updated_content_enable"
						   type="text" value="<?php echo esc_attr( $groupdetailsupdatedcontent ); ?>" />
				</div>
				</div>
			</div>
		</div>

		<!-- Likes / Mark as Favourite -->
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-heart"></span>
				<?php esc_html_e( 'Likes / Mark as Favourite', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_mark_favourite_enable" name="pnfpb_ic_fcm_mark_favourite_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_fcm_mark_favourite_enable' ) ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
				<button type="button" class="pnfpb_mark_favourite_button button button-secondary"
						onclick="toggle_mark_favourite_form()">
					<?php esc_html_e( 'Customize', 'push-notification-for-post-and-buddypress' ); ?>
				</button>
			</div>
		</div>
		<div class="pnfpb_ic_mark_favourite_form pnfpb-field-card" style="grid-column:1/-1;">
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col" style="margin:0;width:100%;">
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-edit"></span>
					<?php esc_html_e( 'Likes / Favourite Notification Title', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_buddypress_mark_favourite_text_enable"
						   name="pnfpb_ic_fcm_buddypress_mark_favourite_text_enable"
						   type="text" value="<?php $v = get_option( 'pnfpb_ic_fcm_buddypress_mark_favourite_text_enable' ); echo esc_attr( $v ? $v : __( '[username] liked your activity', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( '[username] is replaced with the username of the person who liked the activity.', 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-comments"></span>
					<?php esc_html_e( 'Likes / Favourite Notification Content', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_buddypress_mark_favourite_content_enable"
						   name="pnfpb_ic_fcm_buddypress_mark_favourite_content_enable"
						   type="text" value="<?php echo esc_attr( $markfavouritecontent ); ?>" />
				</div>
				</div>
			</div>
		</div>

		<!-- BuddyPress Follow -->
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-networking"></span>
				<?php esc_html_e( 'BuddyPress Follow', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_buddypress_follow_enable" name="pnfpb_ic_fcm_buddypress_follow_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_fcm_buddypress_follow_enable' ) ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
				<button type="button" class="pnfpb_buddypress_follow_button button button-secondary"
						onclick="toggle_buddypress_follow_form()">
					<?php esc_html_e( 'Customize', 'push-notification-for-post-and-buddypress' ); ?>
				</button>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Requires BuddyPress Follow plugin.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>
		<div class="pnfpb_ic_buddypress_follow_form pnfpb-field-card" style="grid-column:1/-1;">
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col" style="margin:0;width:100%;">
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-edit"></span>
					<?php esc_html_e( 'BuddyPress Follow Notification Title', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_buddypress_buddypress_follow_text_enable"
						   name="pnfpb_ic_fcm_buddypress_buddypress_follow_text_enable"
						   type="text" value="<?php $v = get_option( 'pnfpb_ic_fcm_buddypress_buddypress_follow_text_enable' ); echo esc_attr( $v ? $v : __( '[follower_name] followed you', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( '[follower_name] is replaced with the name of the person who followed you.', 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-comments"></span>
					<?php esc_html_e( 'BuddyPress Follow Notification Content', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_buddypress_buddypress_follow_content_enable"
						   name="pnfpb_ic_fcm_buddypress_buddypress_follow_content_enable"
						   type="text" value="<?php echo esc_attr( $buddypressfollowcontent ); ?>" />
				</div>
				</div>
			</div>
		</div>

	</div>

</section>
<?php endif; ?>

<?php /* ─── Section 2: Admin Only Push Notifications ───────────────────── */ ?>
<?php if ( get_option( 'pnfpb_progressier_push' ) !== '1' ) : ?>
<section class="pnfpb-settings-section">
	<h3 class="pnfpb-settings-section__title">
		<span class="dashicons dashicons-shield pnfpb-settings-section__icon"></span>
		<?php esc_html_e( 'Admin Only Push Notifications', 'push-notification-for-post-and-buddypress' ); ?>
	</h3>
	<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'The following push notifications are sent only to site administrators.', 'push-notification-for-post-and-buddypress' ); ?></p>

	<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-update"></span>
				<?php esc_html_e( 'Background Mode', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<?php $pnfpb_ic_fcm_admin_schedule_now_enable = ( get_option( 'pnfpb_ic_fcm_admin_schedule_now_enable' ) === '1' ) ? '1' : '0'; ?>
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_admin_schedule_now_enable" name="pnfpb_ic_fcm_admin_schedule_now_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( $pnfpb_ic_fcm_admin_schedule_now_enable ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Send via Action Scheduler async batch mode to avoid server overload.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<!-- New User Registration -->
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-admin-users"></span>
				<?php esc_html_e( 'New User Registration', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_new_user_registration_enable" name="pnfpb_ic_fcm_new_user_registration_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_fcm_new_user_registration_enable' ) ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
				<button type="button" class="pnfpb_new_user_registration_button button button-secondary"
						onclick="toggle_new_user_registration_form()">
					<?php esc_html_e( 'Customize', 'push-notification-for-post-and-buddypress' ); ?>
				</button>
			</div>
		</div>
		<div class="pnfpb_ic_new_user_registration_form pnfpb-field-card" style="grid-column:1/-1;">
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col" style="margin:0;width:100%;">
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-edit"></span>
					<?php esc_html_e( 'New User Registration Notification Title', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_buddypress_new_user_registration_text_enable"
						   name="pnfpb_ic_fcm_buddypress_new_user_registration_text_enable"
						   type="text" value="<?php $v = get_option( 'pnfpb_ic_fcm_buddypress_new_user_registration_text_enable' ); echo esc_attr( $v ? $v : __( '[user name] registered as new member', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( "[user name] is replaced with the new registrant's name.", 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-comments"></span>
					<?php esc_html_e( 'New User Registration Notification Content', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_buddypress_new_user_registration_content_enable"
						   name="pnfpb_ic_fcm_buddypress_new_user_registration_content_enable"
						   type="text" value="<?php echo esc_attr( $newuserregistrationcontent ); ?>" />
				</div>
				</div>
			</div>
		</div>

		<!-- Contact Form 7 -->
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-email-alt"></span>
				<?php esc_html_e( 'Contact Form 7 Submitted', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_contact_form7_enable" name="pnfpb_ic_fcm_contact_form7_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_fcm_contact_form7_enable' ) ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
				<button type="button" class="pnfpb_contact_form7_button button button-secondary"
						onclick="toggle_contact_form7_form()">
					<?php esc_html_e( 'Customize', 'push-notification-for-post-and-buddypress' ); ?>
				</button>
			</div>
		</div>
		<div class="pnfpb_ic_contact_form7_form pnfpb-field-card" style="grid-column:1/-1;">
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col" style="margin:0;width:100%;">
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-edit"></span>
					<?php esc_html_e( 'Contact Form 7 Notification Title', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_buddypress_contact_form7_text_enable"
						   name="pnfpb_ic_fcm_buddypress_contact_form7_text_enable"
						   type="text" value="<?php $v = get_option( 'pnfpb_ic_fcm_buddypress_contact_form7_text_enable' ); echo esc_attr( $v ? $v : __( 'You have received message from contact us page', 'push-notification-for-post-and-buddypress' ) ); ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Customize this text to match your contact form context.', 'push-notification-for-post-and-buddypress' ); ?></p>
				</div>
				<div>
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-comments"></span>
					<?php esc_html_e( 'Contact Form 7 Default Notification Content', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_fcm_buddypress_contact_form7_content_enable"
						   name="pnfpb_ic_fcm_buddypress_contact_form7_content_enable"
						   type="text" value="<?php echo esc_attr( $contactform7content ); ?>" />
				</div>
				</div>
			</div>
		</div>

	</div>

</section>
<?php endif; ?>
