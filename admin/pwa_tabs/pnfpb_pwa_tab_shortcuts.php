<?php
/* PWA Sub-tab: Shortcuts
 * Included by pnfpb_admin_pwa_app_settings.php
 *
 * Supports two shortcuts. All input names use array notation [] to match
 * the original option storage format. JS IDs and classes are preserved exactly.
 */

/* ------ Load saved shortcut data ----------------------------------------- */
$pnfpb_sc_name_arr    = get_option( 'pnfpb_ic_pwa_app_shortcut_name' );
$pnfpb_sc_short_arr   = get_option( 'pnfpb_ic_pwa_app_shortcut_shortname' );
$pnfpb_sc_url_arr     = get_option( 'pnfpb_ic_pwa_app_shortcut_starturl' );
$pnfpb_sc_desc_arr    = get_option( 'pnfpb_ic_pwa_app_shortcut_description' );
$pnfpb_sc_icon132_arr = get_option( 'pnfpb_ic_fcm_pwa_shortcut_upload_icon_132' );
$pnfpb_sc_icon512_arr = get_option( 'pnfpb_ic_fcm_pwa_shortcut_upload_icon_512' );

$pnfpb_sc_name_arr    = is_array( $pnfpb_sc_name_arr )    ? $pnfpb_sc_name_arr    : [ '', '' ];
$pnfpb_sc_short_arr   = is_array( $pnfpb_sc_short_arr )   ? $pnfpb_sc_short_arr   : [ '', '' ];
$pnfpb_sc_url_arr     = is_array( $pnfpb_sc_url_arr )     ? $pnfpb_sc_url_arr     : [ '', '' ];
$pnfpb_sc_desc_arr    = is_array( $pnfpb_sc_desc_arr )    ? $pnfpb_sc_desc_arr    : [ '', '' ];
$pnfpb_sc_icon132_arr = is_array( $pnfpb_sc_icon132_arr ) ? $pnfpb_sc_icon132_arr : [ '', '' ];
$pnfpb_sc_icon512_arr = is_array( $pnfpb_sc_icon512_arr ) ? $pnfpb_sc_icon512_arr : [ '', '' ];

$pnfpb_sc1_name    = isset( $pnfpb_sc_name_arr[0] )    ? $pnfpb_sc_name_arr[0]    : '';
$pnfpb_sc2_name    = isset( $pnfpb_sc_name_arr[1] )    ? $pnfpb_sc_name_arr[1]    : '';
$pnfpb_sc1_short   = isset( $pnfpb_sc_short_arr[0] )   ? $pnfpb_sc_short_arr[0]   : '';
$pnfpb_sc2_short   = isset( $pnfpb_sc_short_arr[1] )   ? $pnfpb_sc_short_arr[1]   : '';
$pnfpb_sc1_url     = isset( $pnfpb_sc_url_arr[0] )     ? $pnfpb_sc_url_arr[0]     : '';
$pnfpb_sc2_url     = isset( $pnfpb_sc_url_arr[1] )     ? $pnfpb_sc_url_arr[1]     : '';
$pnfpb_sc1_desc    = isset( $pnfpb_sc_desc_arr[0] )    ? $pnfpb_sc_desc_arr[0]    : '';
$pnfpb_sc2_desc    = isset( $pnfpb_sc_desc_arr[1] )    ? $pnfpb_sc_desc_arr[1]    : '';
$pnfpb_sc1_i132    = isset( $pnfpb_sc_icon132_arr[0] ) ? $pnfpb_sc_icon132_arr[0] : '';
$pnfpb_sc2_i132    = isset( $pnfpb_sc_icon132_arr[1] ) ? $pnfpb_sc_icon132_arr[1] : '';
$pnfpb_sc1_i512    = isset( $pnfpb_sc_icon512_arr[0] ) ? $pnfpb_sc_icon512_arr[0] : '';
$pnfpb_sc2_i512    = isset( $pnfpb_sc_icon512_arr[1] ) ? $pnfpb_sc_icon512_arr[1] : '';
?>
<div id="pnfpb-pwa-shortcuts" class="pnfpb-pwa-settings-tab">

	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-menu pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'App Shortcuts', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Define up to 2 shortcuts that appear in the context menu when a user long-presses the PWA icon. Each shortcut links to a key page inside your app.', 'push-notification-for-post-and-buddypress' ); ?></p>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<!-- ===== Shortcut 1 ===== -->
			<div class="pnfpb-field-card" style="border-left:4px solid #2563EB;">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-menu-alt"></span>
					<?php esc_html_e( 'Shortcut 1', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control" style="display:flex;flex-direction:column;gap:12px;">

					<div class="pnfpb-field-row">
						<label class="pnfpb-field-row__label" for="pnfpb_ic_pwa_app_shortcut_name_1">
							<?php esc_html_e( 'Name', 'push-notification-for-post-and-buddypress' ); ?>
							<span style="color:#EF4444;">*</span>
						</label>
						<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb-field-row__input"
							   id="pnfpb_ic_pwa_app_shortcut_name_1"
							   name="pnfpb_ic_pwa_app_shortcut_name[]"
							   type="text" maxlength="50"
							   value="<?php echo esc_attr( $pnfpb_sc1_name ); ?>" />
					</div>

					<div class="pnfpb-field-row">
						<label class="pnfpb-field-row__label" for="pnfpb_ic_pwa_app_shortcut_shortname_1">
							<?php esc_html_e( 'Short Name', 'push-notification-for-post-and-buddypress' ); ?>
							<span style="color:#EF4444;">*</span>
						</label>
						<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb-field-row__input"
							   id="pnfpb_ic_pwa_app_shortcut_shortname_1"
							   name="pnfpb_ic_pwa_app_shortcut_shortname[]"
							   type="text" maxlength="25"
							   value="<?php echo esc_attr( $pnfpb_sc1_short ); ?>" />
					</div>

					<div class="pnfpb-field-row">
						<label class="pnfpb-field-row__label" for="pnfpb_ic_pwa_app_shortcut_starturl_1">
							<?php esc_html_e( 'Start URL', 'push-notification-for-post-and-buddypress' ); ?>
							<span style="color:#EF4444;">*</span>
						</label>
						<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb-field-row__input"
							   id="pnfpb_ic_pwa_app_shortcut_starturl_1"
							   name="pnfpb_ic_pwa_app_shortcut_starturl[]"
							   type="text"
							   value="<?php echo esc_url( $pnfpb_sc1_url ); ?>" />
					</div>

					<div class="pnfpb-field-row">
						<label class="pnfpb-field-row__label" for="pnfpb_ic_pwa_app_shortcut_description_1">
							<?php esc_html_e( 'Description', 'push-notification-for-post-and-buddypress' ); ?>
						</label>
						<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb-field-row__input"
							   id="pnfpb_ic_pwa_app_shortcut_description_1"
							   name="pnfpb_ic_pwa_app_shortcut_description[]"
							   type="text" maxlength="25"
							   value="<?php echo esc_attr( $pnfpb_sc1_desc ); ?>" />
					</div>

					<!-- Icon 132 -->
					<div>
						<p style="font-size:12px;font-weight:600;color:#6B7280;margin:0 0 6px;"><?php esc_html_e( 'Icon 1 (132×132 px)', 'push-notification-for-post-and-buddypress' ); ?></p>
						<input type="button"
							   value="<?php esc_attr_e( 'Select Icon', 'push-notification-for-post-and-buddypress' ); ?>"
							   id="pnfpb_ic_fcm_pwa_shortcut1_upload_button_132"
							   class="pnfpb_ic_push_pwa_settings_shortcut1_upload_icon button" />
						<input type="hidden"
							   id="pnfpb_ic_fcm_pwa_shortcut1_upload_icon_132"
							   name="pnfpb_ic_fcm_pwa_shortcut_upload_icon_132[]"
							   value="<?php echo esc_attr( $pnfpb_sc1_i132 ); ?>" />
						<div id="pnfpb_ic_fcm_pwa_shortcut1_upload_preview_132"
							 style="margin-top:8px;background-image:url(<?php echo $pnfpb_sc1_i132 ? esc_url( $pnfpb_sc1_i132 ) : ''; ?>);width:60px;height:60px;border-radius:8px;background-position:center;background-repeat:no-repeat;background-size:cover;border:1px solid #E5E7EB;">
						</div>
					</div>

					<!-- Icon 512 -->
					<div>
						<p style="font-size:12px;font-weight:600;color:#6B7280;margin:0 0 6px;"><?php esc_html_e( 'Icon 2 (512×512 px)', 'push-notification-for-post-and-buddypress' ); ?></p>
						<input type="button"
							   value="<?php esc_attr_e( 'Select Icon', 'push-notification-for-post-and-buddypress' ); ?>"
							   id="pnfpb_ic_fcm_pwa_shortcut1_upload_button_512"
							   class="pnfpb_ic_push_pwa_settings_shortcut1_upload_icon button" />
						<input type="hidden"
							   id="pnfpb_ic_fcm_pwa_shortcut1_upload_icon_512"
							   name="pnfpb_ic_fcm_pwa_shortcut_upload_icon_512[]"
							   value="<?php echo esc_attr( $pnfpb_sc1_i512 ); ?>" />
						<div id="pnfpb_ic_fcm_pwa_shortcut1_upload_preview_512"
							 style="margin-top:8px;background-image:url(<?php echo $pnfpb_sc1_i512 ? esc_url( $pnfpb_sc1_i512 ) : ''; ?>);width:60px;height:60px;border-radius:8px;background-position:center;background-repeat:no-repeat;background-size:cover;border:1px solid #E5E7EB;">
						</div>
					</div>

				</div>
			</div>

			<!-- ===== Shortcut 2 ===== -->
			<div class="pnfpb-field-card" style="border-left:4px solid #16A34A;">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-menu-alt"></span>
					<?php esc_html_e( 'Shortcut 2', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control" style="display:flex;flex-direction:column;gap:12px;">

					<div class="pnfpb-field-row">
						<label class="pnfpb-field-row__label" for="pnfpb_ic_pwa_app_shortcut_name_2">
							<?php esc_html_e( 'Name', 'push-notification-for-post-and-buddypress' ); ?>
							<span style="color:#EF4444;">*</span>
						</label>
						<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb-field-row__input"
							   id="pnfpb_ic_pwa_app_shortcut_name_2"
							   name="pnfpb_ic_pwa_app_shortcut_name[]"
							   type="text" maxlength="50"
							   value="<?php echo esc_attr( $pnfpb_sc2_name ); ?>" />
					</div>

					<div class="pnfpb-field-row">
						<label class="pnfpb-field-row__label" for="pnfpb_ic_pwa_app_shortcut_shortname_2">
							<?php esc_html_e( 'Short Name', 'push-notification-for-post-and-buddypress' ); ?>
							<span style="color:#EF4444;">*</span>
						</label>
						<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb-field-row__input"
							   id="pnfpb_ic_pwa_app_shortcut_shortname_2"
							   name="pnfpb_ic_pwa_app_shortcut_shortname[]"
							   type="text" maxlength="25"
							   value="<?php echo esc_attr( $pnfpb_sc2_short ); ?>" />
					</div>

					<div class="pnfpb-field-row">
						<label class="pnfpb-field-row__label" for="pnfpb_ic_pwa_app_shortcut_starturl_2">
							<?php esc_html_e( 'Start URL', 'push-notification-for-post-and-buddypress' ); ?>
							<span style="color:#EF4444;">*</span>
						</label>
						<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb-field-row__input"
							   id="pnfpb_ic_pwa_app_shortcut_starturl_2"
							   name="pnfpb_ic_pwa_app_shortcut_starturl[]"
							   type="text"
							   value="<?php echo esc_url( $pnfpb_sc2_url ); ?>" />
					</div>

					<div class="pnfpb-field-row">
						<label class="pnfpb-field-row__label" for="pnfpb_ic_pwa_app_shortcut_description_2">
							<?php esc_html_e( 'Description', 'push-notification-for-post-and-buddypress' ); ?>
						</label>
						<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb-field-row__input"
							   id="pnfpb_ic_pwa_app_shortcut_description_2"
							   name="pnfpb_ic_pwa_app_shortcut_description[]"
							   type="text" maxlength="25"
							   value="<?php echo esc_attr( $pnfpb_sc2_desc ); ?>" />
					</div>

					<!-- Icon 132 -->
					<div>
						<p style="font-size:12px;font-weight:600;color:#6B7280;margin:0 0 6px;"><?php esc_html_e( 'Icon 1 (132×132 px)', 'push-notification-for-post-and-buddypress' ); ?></p>
						<input type="button"
							   value="<?php esc_attr_e( 'Select Icon', 'push-notification-for-post-and-buddypress' ); ?>"
							   id="pnfpb_ic_fcm_pwa_shortcut2_upload_button_132"
							   class="pnfpb_ic_push_pwa_settings_shortcut2_upload_icon button" />
						<input type="hidden"
							   id="pnfpb_ic_fcm_pwa_shortcut2_upload_icon_132"
							   name="pnfpb_ic_fcm_pwa_shortcut_upload_icon_132[]"
							   value="<?php echo esc_attr( $pnfpb_sc2_i132 ); ?>" />
						<div id="pnfpb_ic_fcm_pwa_shortcut2_upload_preview_132"
							 style="margin-top:8px;background-image:url(<?php echo $pnfpb_sc2_i132 ? esc_url( $pnfpb_sc2_i132 ) : ''; ?>);width:60px;height:60px;border-radius:8px;background-position:center;background-repeat:no-repeat;background-size:cover;border:1px solid #E5E7EB;">
						</div>
					</div>

					<!-- Icon 512 -->
					<div>
						<p style="font-size:12px;font-weight:600;color:#6B7280;margin:0 0 6px;"><?php esc_html_e( 'Icon 2 (512×512 px)', 'push-notification-for-post-and-buddypress' ); ?></p>
						<input type="button"
							   value="<?php esc_attr_e( 'Select Icon', 'push-notification-for-post-and-buddypress' ); ?>"
							   id="pnfpb_ic_fcm_pwa_shortcut2_upload_button_512"
							   class="pnfpb_ic_push_pwa_settings_shortcut2_upload_icon button" />
						<input type="hidden"
							   id="pnfpb_ic_fcm_pwa_shortcut2_upload_icon_512"
							   name="pnfpb_ic_fcm_pwa_shortcut_upload_icon_512[]"
							   value="<?php echo esc_attr( $pnfpb_sc2_i512 ); ?>" />
						<div id="pnfpb_ic_fcm_pwa_shortcut2_upload_preview_512"
							 style="margin-top:8px;background-image:url(<?php echo $pnfpb_sc2_i512 ? esc_url( $pnfpb_sc2_i512 ) : ''; ?>);width:60px;height:60px;border-radius:8px;background-position:center;background-repeat:no-repeat;background-size:cover;border:1px solid #E5E7EB;">
						</div>
					</div>

				</div>
			</div>

		</div>
	</section>

</div>
