<?php
/*
 * BuddyPress activities and comments settings for push notification
 * @since 2.08
 */
?>

<?php /* ─── Section 1: BuddyPress Activities ──────────────────────────────── */ ?>
<section class="pnfpb-settings-section">
	<h3 class="pnfpb-settings-section__title">
		<span class="dashicons dashicons-rss pnfpb-settings-section__icon"></span>
		<?php esc_html_e( 'BuddyPress Activities', 'push-notification-for-post-and-buddypress' ); ?>
	</h3>

	<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-rss"></span>
				<?php esc_html_e( 'BuddyPress Activities', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_bactivity_enable" name="pnfpb_ic_fcm_bactivity_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', get_option( 'pnfpb_ic_fcm_bactivity_enable' ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Send push notifications for BuddyPress activity stream updates.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-admin-settings"></span>
				<?php esc_html_e( 'Activity Scope', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control" style="flex-direction:column; align-items:flex-start; gap:10px;">
				<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;">
					<input id="pnfpb_ic_fcm_buddypress_enable" name="pnfpb_ic_fcm_buddypress_enable"
						   type="radio" value="1" style="width:16px;height:16px;cursor:pointer;"
						   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_fcm_buddypress_enable' ) ) ); ?> />
					<?php esc_html_e( 'All activities', 'push-notification-for-post-and-buddypress' ); ?>
				</label>
				<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;">
					<input id="pnfpb_ic_fcm_buddypress_group_enable" name="pnfpb_ic_fcm_buddypress_enable"
						   type="radio" value="2" style="width:16px;height:16px;cursor:pointer;"
						   <?php checked( '2', esc_attr( get_option( 'pnfpb_ic_fcm_buddypress_enable' ) ) ); ?> />
					<?php esc_html_e( 'Group activity (only for group members)', 'push-notification-for-post-and-buddypress' ); ?>
				</label>
			</div>
			<div class="pnfpb-field-card__desc" style="margin-top:8px;">
				<button type="button" class="pnfpb_activity_form_button button button-secondary"
						onclick="toggle_activity_content_form()">
					<?php esc_html_e( 'Customize', 'push-notification-for-post-and-buddypress' ); ?>
				</button>
			</div>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-update"></span>
				<?php esc_html_e( 'Background Mode', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<?php $pnfpb_ic_fcm_activity_schedule_now_enable = ( get_option( 'pnfpb_ic_fcm_activity_schedule_now_enable' ) === '1' ) ? '1' : '0'; ?>
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_activity_schedule_now_enable" name="pnfpb_ic_fcm_activity_schedule_now_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( $pnfpb_ic_fcm_activity_schedule_now_enable ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Send via Action Scheduler async mode to avoid server overload. Adds 30–60 second delay.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-calendar-alt"></span>
				<?php esc_html_e( 'Scheduled Digest', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<?php
				$pnfpb_ic_fcm_buddypressactivities_schedule_enable = (
					( get_option( 'pnfpb_ic_fcm_buddypressactivities_schedule_enable' ) === '1' ) ||
					( get_option( 'pnfpb_ic_fcm_buddypressactivities_schedule_background_enable' ) === '1' )
				) ? '1' : '0';
				?>
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_buddypressactivities_schedule_enable" name="pnfpb_ic_fcm_buddypressactivities_schedule_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( $pnfpb_ic_fcm_buddypressactivities_schedule_enable ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Batch activities and send one digest notification per schedule interval.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

	</div>

	<div class="pnfpb-settings-grid" style="grid-template-columns:1fr; margin-top:12px;">
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-backup"></span>
				<?php esc_html_e( 'Schedule Frequency', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control" style="flex-wrap:wrap; gap:16px; align-items:center;">
				<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;" class="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_radio_block">
					<input class="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_radio_block pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds"
						   name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable" type="radio" value="seconds"
						   style="width:16px;height:16px;cursor:pointer;"
						   <?php checked( 'seconds', get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_enable' ) ); ?> />
					<?php esc_html_e( 'In seconds (min 300)', 'push-notification-for-post-and-buddypress' ); ?>
				</label>
				<label class="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_block">
					<input class="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds"
						   id="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds"
						   name="pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds"
						   type="number" min="300" style="width:90px;min-width:90px;"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds' ); echo esc_attr( ( ! $v || $v < 300 ) ? 300 : $v ); ?>" required />
				</label>
				<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;">
					<input id="pnfpb_ic_fcm_buddypressactivities_hourly_enable" name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"
						   type="radio" value="hourly" style="width:16px;height:16px;cursor:pointer;"
						   <?php checked( 'hourly', esc_attr( get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_enable' ) ) ); ?> />
					<?php esc_html_e( 'Hourly', 'push-notification-for-post-and-buddypress' ); ?>
				</label>
				<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;">
					<input id="pnfpb_ic_fcm_buddypressactivities_twicedaily_enable" name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"
						   type="radio" value="twicedaily" style="width:16px;height:16px;cursor:pointer;"
						   <?php checked( 'twicedaily', esc_attr( get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_enable' ) ) ); ?> />
					<?php esc_html_e( 'Twicedaily', 'push-notification-for-post-and-buddypress' ); ?>
				</label>
				<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;">
					<input id="pnfpb_ic_fcm_buddypressactivities_daily_enable" name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"
						   type="radio" value="daily" style="width:16px;height:16px;cursor:pointer;"
						   <?php checked( 'daily', esc_attr( get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_enable' ) ) ); ?> />
					<?php esc_html_e( 'Daily', 'push-notification-for-post-and-buddypress' ); ?>
				</label>
				<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;">
					<input id="pnfpb_ic_fcm_buddypressactivities_weekly_enable" name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"
						   type="radio" value="weekly" style="width:16px;height:16px;cursor:pointer;"
						   <?php checked( 'weekly', esc_attr( get_option( 'pnfpb_ic_fcm_buddypressactivities_timeschedule_enable' ) ) ); ?> />
					<?php esc_html_e( 'Weekly', 'push-notification-for-post-and-buddypress' ); ?>
				</label>
			</div>
		</div>
	</div>

	<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-top:12px;">
		<span class="dashicons dashicons-calendar"></span>
		<?php if ( get_option( 'pnfpb_ic_fcm_buddypress_enable' ) === '1' ) { ?>
		<a href="<?php echo esc_url( get_home_url() . '/wp-admin/admin.php?page=pnfpb_icfm_action_scheduler&s=PNFPB_cron_buddypressactivities_hook&action=-1&paged=1&action2=-1' ); ?>" target="_blank">
			<?php esc_html_e( 'Manage scheduled tasks for BuddyPress activities notifications in action scheduler tab', 'push-notification-for-post-and-buddypress' ); ?>
		</a>
		<?php } else { ?>
		<a href="<?php echo esc_url( get_home_url() . '/wp-admin/admin.php?page=pnfpb_icfm_action_scheduler&s=PNFPB_cron_buddypressgroupactivities_hook&action=-1&paged=1&action2=-1' ); ?>" target="_blank">
			<?php esc_html_e( 'Manage scheduled tasks for BuddyPress group activities notifications in action scheduler tab', 'push-notification-for-post-and-buddypress' ); ?>
		</a>
		<?php } ?>
	</div>

</section>

<?php /* ─── Activities Customize (hidden, toggled by button above) ────────── */ ?>
<div class="pnfpb_ic_activity_content_form">
<section class="pnfpb-settings-section">
	<h3 class="pnfpb-settings-section__title">
		<span class="dashicons dashicons-edit pnfpb-settings-section__icon"></span>
		<?php esc_html_e( 'Customize Activity Notifications', 'push-notification-for-post-and-buddypress' ); ?>
	</h3>

	<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-networking"></span>
				<?php esc_html_e( 'Notify Followers Only', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_bactivity_followers_enable" name="pnfpb_ic_fcm_bactivity_followers_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', get_option( 'pnfpb_ic_fcm_bactivity_followers_enable' ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Send activity notifications only to followers. Requires BuddyPress Follow plugin.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-text-page"></span>
				<?php esc_html_e( 'Activity Notification Title', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<input class="pnfpb_ic_push_settings_table_value_column_input_field"
					   id="pnfpb_ic_fcm_activity_title" name="pnfpb_ic_fcm_activity_title"
					   type="text" value="<?php echo esc_attr( $activitytitle ); ?>" />
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Use [member name] to display member name. Use [group name] for group activities.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-admin-comments"></span>
				<?php esc_html_e( 'Activity Notification Content', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<input class="pnfpb_ic_push_settings_table_value_column_input_field"
					   id="pnfpb_ic_fcm_activity_message" name="pnfpb_ic_fcm_activity_message"
					   type="text" value="<?php echo esc_attr( $activitymessage ); ?>" />
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Default notification content for new BuddyPress activities.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-text-page"></span>
				<?php esc_html_e( 'Group Activity Title', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<input class="pnfpb_ic_push_settings_table_value_column_input_field"
					   id="pnfpb_ic_fcm_group_activity_title" name="pnfpb_ic_fcm_group_activity_title"
					   type="text" value="<?php echo esc_attr( $activitygroup ); ?>" />
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Notification title for new group activity. Use [member name] and [group name] shortcodes.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-admin-comments"></span>
				<?php esc_html_e( 'Group Activity Content', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<input class="pnfpb_ic_push_settings_table_value_column_input_field"
					   id="pnfpb_ic_fcm_group_activity_message" name="pnfpb_ic_fcm_group_activity_message"
					   type="text" value="<?php echo esc_attr( $groupactivitymessage ); ?>" />
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Default notification content for new BuddyPress group activities.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

	</div>
</section>
</div>

<?php /* ─── Section 2: BuddyPress / BuddyBoss Comments ─────────────────────── */ ?>
<section class="pnfpb-settings-section">
	<h3 class="pnfpb-settings-section__title">
		<span class="dashicons dashicons-admin-comments pnfpb-settings-section__icon"></span>
		<?php esc_html_e( 'BuddyPress / BuddyBoss Comments', 'push-notification-for-post-and-buddypress' ); ?>
	</h3>

	<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-admin-comments"></span>
				<?php esc_html_e( 'BuddyPress / Post Comments', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_bcomment_enable" name="pnfpb_ic_fcm_bcomment_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_fcm_bcomment_enable' ) ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Send push notifications for BuddyPress activity comments and WordPress post comments.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-admin-settings"></span>
				<?php esc_html_e( 'Comment Recipients', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control" style="flex-direction:column; align-items:flex-start; gap:10px;">
				<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;">
					<input id="pnfpb_ic_fcm_buddypress_comments_radio_enable" name="pnfpb_ic_fcm_buddypress_comments_radio_enable"
						   type="radio" value="1" style="width:16px;height:16px;cursor:pointer;"
						   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_fcm_buddypress_comments_radio_enable' ) ) ); ?> />
					<?php esc_html_e( 'All', 'push-notification-for-post-and-buddypress' ); ?>
				</label>
				<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;">
					<input id="pnfpb_ic_fcm_buddypress_comments_radio_enable_2" name="pnfpb_ic_fcm_buddypress_comments_radio_enable"
						   type="radio" value="2" style="width:16px;height:16px;cursor:pointer;"
						   <?php checked( '2', esc_attr( get_option( 'pnfpb_ic_fcm_buddypress_comments_radio_enable' ) ) ); ?> />
					<?php esc_html_e( "Only for User's activities / Posts / My activities", 'push-notification-for-post-and-buddypress' ); ?>
				</label>
			</div>
			<div class="pnfpb-field-card__desc" style="margin-top:8px;">
				<button type="button" class="pnfpb_comments_content_button button button-secondary"
						onclick="toggle_comments_content_form()">
					<?php esc_html_e( 'Customize', 'push-notification-for-post-and-buddypress' ); ?>
				</button>
			</div>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-update"></span>
				<?php esc_html_e( 'Background Mode', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<?php $pnfpb_ic_fcm_comments_schedule_now_enable = ( get_option( 'pnfpb_ic_fcm_comments_schedule_now_enable' ) === '1' ) ? '1' : '0'; ?>
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_comments_schedule_now_enable" name="pnfpb_ic_fcm_comments_schedule_now_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', $pnfpb_ic_fcm_comments_schedule_now_enable ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Send via Action Scheduler async mode to avoid server overload. Adds 30–60 second delay.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-calendar-alt"></span>
				<?php esc_html_e( 'Scheduled Digest', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<?php
				$pnfpb_ic_fcm_buddypresscomments_schedule_enable = (
					( get_option( 'pnfpb_ic_fcm_buddypresscomments_schedule_enable' ) === '1' ) ||
					( get_option( 'pnfpb_ic_fcm_buddypresscomments_schedule_background_enable' ) === '1' )
				) ? '1' : '0';
				?>
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_buddypresscomments_schedule_enable" name="pnfpb_ic_fcm_buddypresscomments_schedule_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_fcm_buddypresscomments_schedule_enable' ) ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Batch comments and send one digest notification per schedule interval.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

	</div>

	<div class="pnfpb-settings-grid" style="grid-template-columns:1fr; margin-top:12px;">
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-backup"></span>
				<?php esc_html_e( 'Schedule Frequency', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control" style="flex-wrap:wrap; gap:16px; align-items:center;">
				<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;" class="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_radio_block">
					<input class="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_radio_block pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds"
						   name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable" type="radio" value="seconds"
						   style="width:16px;height:16px;cursor:pointer;"
						   <?php checked( 'seconds', esc_attr( get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_enable' ) ) ); ?> />
					<?php esc_html_e( 'In seconds (min 300)', 'push-notification-for-post-and-buddypress' ); ?>
				</label>
				<label class="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_block">
					<input class="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds"
						   id="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds"
						   name="pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds"
						   type="number" min="300" style="width:90px;min-width:90px;"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds' ); echo esc_attr( ( ! $v || $v < 300 ) ? 300 : $v ); ?>" required />
				</label>
				<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;">
					<input id="pnfpb_ic_fcm_buddypresscomments_hourly_enable" name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
						   type="radio" value="hourly" style="width:16px;height:16px;cursor:pointer;"
						   <?php checked( 'hourly', esc_attr( get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_enable' ) ) ); ?> />
					<?php esc_html_e( 'Hourly', 'push-notification-for-post-and-buddypress' ); ?>
				</label>
				<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;">
					<input id="pnfpb_ic_fcm_buddypresscomments_twicedaily_enable" name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
						   type="radio" value="twicedaily" style="width:16px;height:16px;cursor:pointer;"
						   <?php checked( 'twicedaily', esc_attr( get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_enable' ) ) ); ?> />
					<?php esc_html_e( 'Twicedaily', 'push-notification-for-post-and-buddypress' ); ?>
				</label>
				<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;">
					<input id="pnfpb_ic_fcm_buddypresscomments_daily_enable" name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
						   type="radio" value="daily" style="width:16px;height:16px;cursor:pointer;"
						   <?php checked( 'daily', esc_attr( get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_enable' ) ) ); ?> />
					<?php esc_html_e( 'Daily', 'push-notification-for-post-and-buddypress' ); ?>
				</label>
				<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;">
					<input id="pnfpb_ic_fcm_buddypresscomments_weekly_enable" name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"
						   type="radio" value="weekly" style="width:16px;height:16px;cursor:pointer;"
						   <?php checked( 'weekly', esc_attr( get_option( 'pnfpb_ic_fcm_buddypresscomments_timeschedule_enable' ) ) ); ?> />
					<?php esc_html_e( 'Weekly', 'push-notification-for-post-and-buddypress' ); ?>
				</label>
			</div>
		</div>
	</div>

	<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-top:12px;">
		<span class="dashicons dashicons-calendar"></span>
		<a href="<?php echo esc_url( get_home_url() . '/wp-admin/admin.php?page=pnfpb_icfm_action_scheduler&s=PNFPB_cron_buddypresscomments_hook&action=-1&paged=1&action2=-1' ); ?>" target="_blank">
			<?php esc_html_e( 'Manage scheduled tasks for BuddyPress/Post comments notifications in action scheduler tab', 'push-notification-for-post-and-buddypress' ); ?>
		</a>
	</div>

</section>

<?php /* ─── Comments Customize (hidden, toggled by button above) ─────────── */ ?>
<div class="pnfpb_ic_comments_content_form">
<section class="pnfpb-settings-section">
	<h3 class="pnfpb-settings-section__title">
		<span class="dashicons dashicons-edit pnfpb-settings-section__icon"></span>
		<?php esc_html_e( 'Customize Comment Notifications', 'push-notification-for-post-and-buddypress' ); ?>
	</h3>

	<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-networking"></span>
				<?php esc_html_e( 'Notify Followers Only', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_bcomment_followers_enable" name="pnfpb_ic_fcm_bcomment_followers_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', get_option( 'pnfpb_ic_fcm_bcomment_followers_enable' ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Send comment notifications only to followers. Requires BuddyPress Follow plugin.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-text-page"></span>
				<?php esc_html_e( 'Comment Notification Title', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<input class="pnfpb_ic_push_settings_table_value_column_input_field"
					   id="pnfpb_ic_fcm_comment_activity_title" name="pnfpb_ic_fcm_comment_activity_title"
					   type="text" value="<?php echo esc_attr( $activitycomment ); ?>" />
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Use [member name] shortcode. Example: "[member name] posted a comment" → "Tom posted a comment".', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-admin-comments"></span>
				<?php esc_html_e( 'Comment Notification Content', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<input class="pnfpb_ic_push_settings_table_value_column_input_field"
					   id="pnfpb_ic_fcm_comment_activity_message" name="pnfpb_ic_fcm_comment_activity_message"
					   type="text" value="<?php echo esc_attr( $commentactivitymessage ); ?>" />
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Default notification content. Leave blank to display the comment text as notification body.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

	</div>
</section>
</div>
