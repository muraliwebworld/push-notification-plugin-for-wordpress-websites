<?php
/* PWA Sub-tab: Protocol Handlers
 * Included by pnfpb_admin_pwa_app_settings.php
 * Expects: $pnfpb_ic_pwa_protocol_name_array, $pnfpb_ic_pwa_protocol_url_array
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<div id="pnfpb-pwa-protocol-handler" class="pnfpb-pwa-settings-tab">

	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-admin-links pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'Protocol Handlers', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc">
			<?php
			printf(
				/* translators: %s: MDN link */
				esc_html__( 'Register custom URL protocol handlers for your PWA. %s', 'push-notification-for-post-and-buddypress' ),
				'<a href="https://developer.mozilla.org/en-US/docs/Web/Manifest/protocol_handlers" target="_blank" rel="noopener noreferrer">'
				. esc_html__( 'MDN Documentation', 'push-notification-for-post-and-buddypress' )
				. '</a>'
			);
			?>
		</p>

		<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-bottom:20px;">
			<span class="dashicons dashicons-info pnfpb-info-box__icon"></span>
			<div>
				<strong><?php esc_html_e( 'Browser Support', 'push-notification-for-post-and-buddypress' ); ?></strong>
				<p><?php esc_html_e( 'Protocol Handlers are currently supported in Chrome and Edge (desktop). The PWA must be installed before the handler is registered.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>
		</div>

		<div id="pnfpb_ic_pwa_protocol-handler-list">
			<?php
			foreach ( $pnfpb_ic_pwa_protocol_name_array as $pnfpb_protocol_index => $pnfpb_protocol_name_value ) :
				$pnfpb_protocol_url_value = isset( $pnfpb_ic_pwa_protocol_url_array[ $pnfpb_protocol_index ] )
					? $pnfpb_ic_pwa_protocol_url_array[ $pnfpb_protocol_index ]
					: '';
			?>
			<div class="pnfpb_ic_pwa_protocol pnfpb-field-card" style="margin-bottom:12px;">

				<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;">
					<strong class="pnfpb-field-card__label" style="margin:0;">
						<span class="dashicons dashicons-admin-links"></span>
						<?php
						printf(
							/* translators: %d: protocol number */
							esc_html__( 'Protocol #%d', 'push-notification-for-post-and-buddypress' ),
							absint( $pnfpb_protocol_index + 1 )
						);
						?>
					</strong>
					<button type="button"
							id="pnfpb_ic_push_remove_protocol_button_<?php echo esc_attr( $pnfpb_protocol_index ); ?>"
							class="pnfpb_ic_push_remove_protocol_button button button-link-delete"
							style="color:#cc1818;">
						<span class="dashicons dashicons-trash" style="vertical-align:middle;"></span>
						<?php esc_html_e( 'Remove', 'push-notification-for-post-and-buddypress' ); ?>
					</button>
				</div>

				<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

					<div>
						<label class="pnfpb-field-row__label" for="pnfpb_ic_pwa_protocol_name_<?php echo esc_attr( $pnfpb_protocol_index ); ?>">
							<?php esc_html_e( 'Protocol Name', 'push-notification-for-post-and-buddypress' ); ?>
							<span style="color:#cc1818;">*</span>
						</label>
						<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb-field-row__input"
							   id="pnfpb_ic_pwa_protocol_name_<?php echo esc_attr( $pnfpb_protocol_index ); ?>"
							   name="pnfpb_ic_pwa_protocol_name[]"
							   type="text"
							   placeholder="<?php esc_attr_e( 'e.g. web+foo', 'push-notification-for-post-and-buddypress' ); ?>"
							   value="<?php echo esc_attr( $pnfpb_protocol_name_value ); ?>" />
					</div>

					<div>
						<label class="pnfpb-field-row__label" for="pnfpb_ic_pwa_protocol_url_<?php echo esc_attr( $pnfpb_protocol_index ); ?>">
							<?php esc_html_e( 'Handler URL', 'push-notification-for-post-and-buddypress' ); ?>
							<span style="color:#cc1818;">*</span>
						</label>
						<input class="pnfpb_ic_push_settings_table_value_column_input_field pnfpb-field-row__input"
							   id="pnfpb_ic_pwa_protocol_url_<?php echo esc_attr( $pnfpb_protocol_index ); ?>"
							   name="pnfpb_ic_pwa_protocol_url[]"
							   type="text"
							   placeholder="<?php esc_attr_e( 'e.g. /handle/', 'push-notification-for-post-and-buddypress' ); ?>"
							   value="<?php echo esc_attr( $pnfpb_protocol_url_value ); ?>" />
					</div>

				</div>

			</div>
			<?php endforeach; ?>
		</div>

		<div style="margin-top:16px;">
			<button type="button"
					id="pnfpb_ic_push_add_protocol_button"
					class="button pnfpb_ic_push_add_protocol_button">
				<span class="dashicons dashicons-plus-alt2" style="vertical-align:middle;"></span>
				<?php esc_html_e( 'Add Protocol Handler', 'push-notification-for-post-and-buddypress' ); ?>
			</button>
		</div>

	</section>

</div>
