<?php
/* PWA Sub-tab: Cache
 * Included by pnfpb_admin_pwa_app_settings.php
 */

/**
 * Helper: render a page-selector <select> with a "Select page" placeholder.
 *
 * @param string $id     Element id/name attribute.
 * @param bool   $req    Whether to add required="required".
 */
function pnfpb_render_cache_page_select( $id, $req = false ) {
	$pnfpb_cache_allowed_html = [
		'option' => [
			'value'    => [],
			'selected' => [],
		],
	];
	$current = get_option( $id );
	$attrs   = $req ? ' required="required"' : '';
	echo '<select id="' . esc_attr( $id ) . '" name="' . esc_attr( $id ) . '"' . $attrs . '>';
	if ( ! $req ) {
		echo '<option value="">' . esc_html__( 'Select page', 'push-notification-for-post-and-buddypress' ) . '</option>';
	}
	$pnfpb_cache_pages = get_pages();
	if ( $pnfpb_cache_pages ) {
		if ( $req ) {
			$home_selected = ( $current === get_home_url() ) ? 'selected' : '';
			echo wp_kses( '<option value="' . esc_attr( get_home_url() ) . '" ' . $home_selected . '>' . esc_html__( 'Home page', 'push-notification-for-post-and-buddypress' ) . '</option>', $pnfpb_cache_allowed_html );
		}
		foreach ( $pnfpb_cache_pages as $pnfpb_cache_page ) {
			$page_url = esc_attr( get_page_link( $pnfpb_cache_page->ID ) );
			echo wp_kses( '<option value="' . $page_url . '"' . selected( $page_url, $current, false ) . '>' . esc_html( $pnfpb_cache_page->post_title ) . '</option>', $pnfpb_cache_allowed_html );
		}
	}
	echo '</select>';
}
?>
<div id="pnfpb-pwa-cache" class="pnfpb-pwa-settings-tab">

	<!-- Section: Required Offline Pages -->
	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-database pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'Offline Cache', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Select pages to cache for offline use. The first two are shown to users when the network is unavailable.', 'push-notification-for-post-and-buddypress' ); ?></p>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-home"></span>
					<?php esc_html_e( 'Primary Offline Page', 'push-notification-for-post-and-buddypress' ); ?>
					<span style="color:#EF4444;margin-left:2px;">*</span>
				</div>
				<div class="pnfpb-field-card__control">
					<?php pnfpb_render_cache_page_select( 'pnfpb_ic_pwa_app_offline_url1', true ); ?>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Home page cached for offline access. Required.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-admin-page"></span>
					<?php esc_html_e( 'Default Offline Fallback', 'push-notification-for-post-and-buddypress' ); ?>
					<span style="color:#EF4444;margin-left:2px;">*</span>
				</div>
				<div class="pnfpb-field-card__control">
					<?php pnfpb_render_cache_page_select( 'pnfpb_ic_pwa_app_offline_url2', true ); ?>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Shown when the requested page is not in cache. Required.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

		</div>
	</section>

	<!-- Section: Extra Cached Pages -->
	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-plus-alt pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'Additional Cached Pages', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Up to 3 extra pages to pre-cache for offline use.', 'push-notification-for-post-and-buddypress' ); ?></p>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--3col">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-list-view"></span>
					<?php esc_html_e( 'Extra Page 1', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<?php pnfpb_render_cache_page_select( 'pnfpb_ic_pwa_app_offline_url3' ); ?>
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-list-view"></span>
					<?php esc_html_e( 'Extra Page 2', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<?php pnfpb_render_cache_page_select( 'pnfpb_ic_pwa_app_offline_url4' ); ?>
				</div>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-list-view"></span>
					<?php esc_html_e( 'Extra Page 3', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<?php pnfpb_render_cache_page_select( 'pnfpb_ic_pwa_app_offline_url5' ); ?>
				</div>
			</div>

		</div>
	</section>

	<!-- Section: Exclusions -->
	<section class="pnfpb-settings-section">
		<h3 class="pnfpb-settings-section__title">
			<span class="dashicons dashicons-dismiss pnfpb-settings-section__icon"></span>
			<?php esc_html_e( 'Cache Exclusions', 'push-notification-for-post-and-buddypress' ); ?>
		</h3>
		<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Prevent specific URLs from being stored in the offline cache.', 'push-notification-for-post-and-buddypress' ); ?></p>

		<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-no-alt"></span>
					<?php esc_html_e( 'Exclude All URLs from Cache', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<label class="pnfpb_switch">
						<input id="pnfpb_ic_pwa_app_excludeallurls"
							   name="pnfpb_ic_pwa_app_excludeallurls"
							   type="checkbox" value="1"
							   <?php checked( '1', esc_attr( get_option( 'pnfpb_ic_pwa_app_excludeallurls' ) ) ); ?> />
						<span class="pnfpb_slider round"></span>
					</label>
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'When enabled, no URLs are cached for offline use.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

			<div class="pnfpb-field-card">
				<div class="pnfpb-field-card__label">
					<span class="dashicons dashicons-editor-unlink"></span>
					<?php esc_html_e( 'Exclude URL List', 'push-notification-for-post-and-buddypress' ); ?>
				</div>
				<div class="pnfpb-field-card__control">
					<input class="pnfpb_ic_push_settings_table_value_column_input_field"
						   id="pnfpb_ic_pwa_app_excludeurls"
						   name="pnfpb_ic_pwa_app_excludeurls"
						   type="text"
						   placeholder="https://example.com/page1,https://example.com/page2"
						   value="<?php echo get_option( 'pnfpb_ic_pwa_app_excludeurls' ) ? esc_url( get_option( 'pnfpb_ic_pwa_app_excludeurls' ) ) : ''; ?>" />
				</div>
				<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Comma-separated list of URLs to exclude from offline caching.', 'push-notification-for-post-and-buddypress' ); ?></p>
			</div>

		</div>
	</section>

</div>
