<?php
/*
 * Post and custom post type settings for push notification
 * @since 2.08
 */
?>

<?php /* ─── Section 1: Posts & Custom Post Types ─────────────────────────── */ ?>
<section class="pnfpb-settings-section">
	<h3 class="pnfpb-settings-section__title">
		<span class="dashicons dashicons-admin-post pnfpb-settings-section__icon"></span>
		<?php esc_html_e( 'Posts & Custom Post Types', 'push-notification-for-post-and-buddypress' ); ?>
	</h3>

	<div class="pnfpb-info-box pnfpb-info-box--blue">
		<span class="dashicons dashicons-info"></span>
		<?php esc_html_e( 'For backend posts sent from the admin post editor, make sure the PNFPB Push Notification metabox is switched ON.', 'push-notification-for-post-and-buddypress' ); ?>
	</div>

	<?php
	$posttypecount = 0;
	$cutomize_post_field_notification_title =
		esc_html( __( '(use [member name] shortcode to display member name)', 'push-notification-for-post-and-buddypress' ) ) .
		'<br/>' .
		esc_html( __( 'Example "[member name] published a post" will display as "Tom published a post" where Tom is member name', 'push-notification-for-post-and-buddypress' ) ) .
		'<br/>
		<div class="pnfpb_ic_post_content_form">
			<b>' . esc_html( __( 'Notification title for Post', 'push-notification-for-post-and-buddypress' ) ) . '</b>
			<br/>
			<input class="pnfpb_ic_push_settings_table_value_column_input_field"
				   id="pnfpb_ic_fcm_post_title" name="pnfpb_ic_fcm_post_title"
				   type="text" value="' . esc_attr( get_option( 'pnfpb_ic_fcm_post_title' ) ) . '" />
		</div>
		<br/>';

	foreach ( $custposttypes as $post_type ) {
		$cutomize_post_field_notification_title .=
			'<div class="' . esc_attr( 'pnfpb_ic_' . $post_type . '_content_form' ) . '">
				<b>' . esc_html( __( 'Notification title for ', 'push-notification-for-post-and-buddypress' ) ) . esc_html( $post_type ) . '</b>
				<br/>
				<input class="pnfpb_ic_push_settings_table_value_column_input_field"
					   id="' . esc_attr( 'pnfpb_ic_fcm_' . $post_type . '_title' ) . '"
					   name="' . esc_attr( 'pnfpb_ic_fcm_' . $post_type . '_title' ) . '"
					   type="text" value="' . esc_attr( get_option( 'pnfpb_ic_fcm_' . $post_type . '_title' ) ) . '" />
			</div>
			<br/>';
	}
	?>

	<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-admin-post"></span>
				<?php esc_html_e( 'Frontend Post', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_post_enable" name="pnfpb_ic_fcm_post_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', get_option( 'pnfpb_ic_fcm_post_enable' ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Enable for all frontend posts. Use the CPT toggles to fine-tune per post type.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<?php
		$posttypecount = 0;
		foreach ( $custposttypes as $post_type ) {
			if ( $post_type !== 'buddypress' ) {
		?>
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-category"></span>
				<?php echo esc_html( $post_type ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="<?php echo esc_attr( 'pnfpb_ic_fcm_' . $post_type . '_enable' ); ?>"
						   name="<?php echo esc_attr( 'pnfpb_ic_fcm_' . $post_type . '_enable' ); ?>"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_fcm_' . $post_type . '_enable' ) ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
		</div>
		<?php
			}
			$posttypecount++;
			if ( $posttypecount >= 10 ) { break; }
		}
		?>

	</div>

	<div style="margin-top:12px;">
		<button type="button" class="pnfpb_post_type_content_button button button-secondary"
				onclick="toggle_post_type_content_form()">
			<?php esc_html_e( 'Customize Titles & Advanced', 'push-notification-for-post-and-buddypress' ); ?>
		</button>
	</div>

</section>

<?php /* ─── Section 2: Scheduling ──────────────────────────────────────── */ ?>
<section class="pnfpb-settings-section">
	<h3 class="pnfpb-settings-section__title">
		<span class="dashicons dashicons-clock pnfpb-settings-section__icon"></span>
		<?php esc_html_e( 'Scheduling', 'push-notification-for-post-and-buddypress' ); ?>
	</h3>

	<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-update"></span>
				<?php esc_html_e( 'Background Mode', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<?php $pnfpb_ic_fcm_post_schedule_now_enable = ( get_option( 'pnfpb_ic_fcm_post_schedule_now_enable' ) === '1' ) ? '1' : '0'; ?>
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_post_schedule_now_enable" name="pnfpb_ic_fcm_post_schedule_now_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( $pnfpb_ic_fcm_post_schedule_now_enable ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Send via Action Scheduler async mode to avoid server overload. Adds 30–60 second delay for batch processing.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-calendar-alt"></span>
				<?php esc_html_e( 'Scheduled Digest', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<?php
				$pnfpb_ic_fcm_post_schedule_enable = (
					( get_option( 'pnfpb_ic_fcm_post_schedule_enable' ) === '1' ) ||
					( get_option( 'pnfpb_ic_fcm_post_schedule_background_enable' ) === '1' )
				) ? '1' : '0';
				?>
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_post_schedule_enable" name="pnfpb_ic_fcm_post_schedule_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( $pnfpb_ic_fcm_post_schedule_enable ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Batch new posts and send one digest notification per schedule interval.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

	</div>

	<div class="pnfpb-settings-grid" style="grid-template-columns:1fr; margin-top:12px;">
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-backup"></span>
				<?php esc_html_e( 'Schedule Frequency', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control" style="flex-wrap:wrap; gap:16px; align-items:center;">
				<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;" class="pnfpb_ic_fcm_post_timeschedule_seconds_radio_block">
					<input class="pnfpb_ic_fcm_post_timeschedule_seconds_radio_block pnfpb_ic_fcm_post_timeschedule_seconds"
						   name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" value="seconds"
						   style="width:16px;height:16px;cursor:pointer;"
						   <?php checked( 'seconds', esc_attr( get_option( 'pnfpb_ic_fcm_post_timeschedule_enable' ) ) ); ?> />
					<?php esc_html_e( 'In seconds (min 300)', 'push-notification-for-post-and-buddypress' ); ?>
				</label>
				<label class="pnfpb_ic_fcm_post_timeschedule_seconds_block">
					<input class="pnfpb_ic_fcm_post_timeschedule_seconds"
						   id="pnfpb_ic_fcm_post_timeschedule_seconds"
						   name="pnfpb_ic_fcm_post_timeschedule_seconds"
						   type="number" min="300" style="width:90px;min-width:90px;"
						   value="<?php $v = get_option( 'pnfpb_ic_fcm_post_timeschedule_seconds' ); echo esc_attr( ( ! $v || $v < 300 ) ? 300 : $v ); ?>" required />
				</label>
				<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;">
					<input name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" value="hourly"
						   style="width:16px;height:16px;cursor:pointer;"
						   <?php checked( 'hourly', esc_attr( get_option( 'pnfpb_ic_fcm_post_timeschedule_enable' ) ) ); ?> />
					<?php esc_html_e( 'Hourly', 'push-notification-for-post-and-buddypress' ); ?>
				</label>
				<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;">
					<input name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" value="twicedaily"
						   style="width:16px;height:16px;cursor:pointer;"
						   <?php checked( 'twicedaily', esc_attr( get_option( 'pnfpb_ic_fcm_post_timeschedule_enable' ) ) ); ?> />
					<?php esc_html_e( 'Twicedaily', 'push-notification-for-post-and-buddypress' ); ?>
				</label>
				<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;">
					<input name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" value="daily"
						   style="width:16px;height:16px;cursor:pointer;"
						   <?php checked( 'daily', esc_attr( get_option( 'pnfpb_ic_fcm_post_timeschedule_enable' ) ) ); ?> />
					<?php esc_html_e( 'Daily', 'push-notification-for-post-and-buddypress' ); ?>
				</label>
				<label style="display:inline-flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:400;color:#1d2327;">
					<input name="pnfpb_ic_fcm_post_timeschedule_enable" type="radio" value="weekly"
						   style="width:16px;height:16px;cursor:pointer;"
						   <?php checked( 'weekly', esc_attr( get_option( 'pnfpb_ic_fcm_post_timeschedule_enable' ) ) ); ?> />
					<?php esc_html_e( 'Weekly', 'push-notification-for-post-and-buddypress' ); ?>
				</label>
			</div>
		</div>
	</div>

	<div class="pnfpb-settings-grid pnfpb-settings-grid--2col" style="margin-top:12px;">

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-admin-post"></span>
				<?php esc_html_e( 'Post (include in digest)', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_default_post_schedule_enable"
						   name="pnfpb_ic_fcm_default_post_schedule_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_fcm_default_post_schedule_enable' ) ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
		</div>

		<?php
		$posttypecount = 0;
		foreach ( $custposttypes as $post_type ) {
			if ( $post_type !== 'buddypress' ) {
		?>
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-category"></span>
				<?php echo esc_html( $post_type ); ?> (<?php esc_html_e( 'digest', 'push-notification-for-post-and-buddypress' ); ?>)
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="<?php echo esc_attr( 'pnfpb_ic_fcm_' . $post_type . '_post_schedule_enable' ); ?>"
						   name="<?php echo esc_attr( 'pnfpb_ic_fcm_' . $post_type . '_post_schedule_enable' ); ?>"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_fcm_' . $post_type . '_post_schedule_enable' ) ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
		</div>
		<?php
			}
			$posttypecount++;
			if ( $posttypecount >= 10 ) { break; }
		}
		?>

	</div>

	<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-top:12px;">
		<span class="dashicons dashicons-calendar"></span>
		<a href="<?php echo esc_url( get_home_url() . '/wp-admin/admin.php?page=pnfpb_icfm_action_scheduler&s=PNFPB_cron_post_hook&action=-1&paged=1&action2=-1' ); ?>" target="_blank">
			<?php esc_html_e( 'Manage scheduled tasks for post notifications in action scheduler', 'push-notification-for-post-and-buddypress' ); ?>
		</a>
	</div>

</section>

<?php /* ─── Advanced / Customize (hidden, toggled by button above) ─────── */ ?>
<div class="pnfpb_ic_post_type_content_form">
<section class="pnfpb-settings-section">
	<h3 class="pnfpb-settings-section__title">
		<span class="dashicons dashicons-admin-tools pnfpb-settings-section__icon"></span>
		<?php esc_html_e( 'Advanced Options', 'push-notification-for-post-and-buddypress' ); ?>
	</h3>

	<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-dismiss"></span>
				<?php esc_html_e( 'New Posts Only', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<?php $pnfpb_ic_fcm_disable_post_update_enable = ( get_option( 'pnfpb_ic_fcm_disable_post_update_enable' ) === '1' ) ? '1' : '0'; ?>
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_disable_post_update_enable" name="pnfpb_ic_fcm_disable_post_update_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( $pnfpb_ic_fcm_disable_post_update_enable ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Send notifications only for new posts, not for updated posts.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-groups"></span>
				<?php esc_html_e( 'bbPress Subscribers Only', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<?php $pnfpb_ic_fcm_only_post_subscribers_enable = ( get_option( 'pnfpb_ic_fcm_only_post_subscribers_enable' ) === '1' ) ? '1' : '0'; ?>
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_only_post_subscribers_enable" name="pnfpb_ic_fcm_only_post_subscribers_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( $pnfpb_ic_fcm_only_post_subscribers_enable ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Send notifications only to bbPress forum topic subscribers.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-networking"></span>
				<?php esc_html_e( 'Notify Followers Only', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control" style="flex-wrap:wrap; gap:8px;">
				<select id="pnfpb_ic_fcm_post_type_followers" name="pnfpb_ic_fcm_post_type_followers">
					<option value="select"><?php esc_html_e( 'Select type', 'push-notification-for-post-and-buddypress' ); ?></option>
					<option value="post" <?php selected( get_option( 'pnfpb_ic_fcm_post_type_followers' ), 'post' ); ?>><?php echo esc_html( 'post' ); ?></option>
					<?php foreach ( $custposttypes as $post_type ) : ?>
					<option value="<?php echo esc_attr( $post_type ); ?>" <?php selected( get_option( 'pnfpb_ic_fcm_post_type_followers' ), $post_type ); ?>><?php echo esc_html( $post_type ); ?></option>
					<?php endforeach; ?>
				</select>
				<?php $pnfpb_ic_fcm_only_post_followers_enable = ( get_option( 'pnfpb_ic_fcm_only_post_followers_enable' ) === '1' ) ? '1' : '0'; ?>
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_only_post_followers_enable" name="pnfpb_ic_fcm_only_post_followers_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( $pnfpb_ic_fcm_only_post_followers_enable ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Notify only followers of the post author. Requires BuddyPress Follow plugin.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-admin-users"></span>
				<?php esc_html_e( 'Role-Based Notifications', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control" style="flex-wrap:wrap; gap:8px;">
				<select id="pnfpb_ic_fcm_post_type_role_based" name="pnfpb_ic_fcm_post_type_role_based">
					<option value="select"><?php esc_html_e( 'Select type', 'push-notification-for-post-and-buddypress' ); ?></option>
					<option value="post" <?php selected( get_option( 'pnfpb_ic_fcm_post_type_role_based' ), 'post' ); ?>><?php echo esc_html( 'post' ); ?></option>
					<?php foreach ( $custposttypes as $post_type ) : ?>
					<option value="<?php echo esc_attr( $post_type ); ?>" <?php selected( get_option( 'pnfpb_ic_fcm_post_type_role_based' ), $post_type ); ?>><?php echo esc_html( $post_type ); ?></option>
					<?php endforeach; ?>
				</select>
				<select id="pnfpb_ic_fcm_select_role_based" name="pnfpb_ic_fcm_select_role_based">
					<option value="select"><?php esc_html_e( 'Select Role', 'push-notification-for-post-and-buddypress' ); ?></option>
					<?php foreach ( $pnfpb_roles as $pnfpb_role ) : ?>
					<option value="<?php echo esc_attr( $pnfpb_role ); ?>" <?php selected( get_option( 'pnfpb_ic_fcm_select_role_based' ), $pnfpb_role ); ?>><?php echo esc_html( $pnfpb_role ); ?></option>
					<?php endforeach; ?>
				</select>
				<?php $pnfpb_ic_fcm_only_role_based_post_enable = ( get_option( 'pnfpb_ic_fcm_only_role_based_post_enable' ) === '1' ) ? '1' : '0'; ?>
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_only_role_based_post_enable" name="pnfpb_ic_fcm_only_role_based_post_enable"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( $pnfpb_ic_fcm_only_role_based_post_enable ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Send notifications based on the role of the user who published the post/CPT.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-megaphone"></span>
				<?php esc_html_e( 'Custom Prompt Subscriptions', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ic_fcm_show_allposttype_subscriptions_custom_prompt"
						   name="pnfpb_ic_fcm_show_allposttype_subscriptions_custom_prompt"
						   type="checkbox" value="1"
						   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_fcm_show_allposttype_subscriptions_custom_prompt' ) ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Show CPT subscription options in custom prompt, bell prompt, and shortcode.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

	</div>

	<div class="pnfpb-settings-grid" style="grid-template-columns:1fr; margin-top:12px;">
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-text-page"></span>
				<?php esc_html_e( 'Notification Titles', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__desc">
				<?php echo wp_kses( $cutomize_post_field_notification_title, $allowed_html ); ?>
			</div>
		</div>
	</div>

</section>
</div>
