<?php
/**
 * Plugin settings page - AI assistant.
 *
 * @since 3.14
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<h1 class="pnfpb_ic_push_settings_header">
	<span class="dashicons dashicons-art" style="font-size:26px;width:26px;height:26px;color:#2271b1;vertical-align:middle;margin-right:6px;"></span>
	<?php echo esc_html(
		__(
			"PNFPB - AI assistant settings",
			"push-notification-for-post-and-buddypress"
		)
	); ?>
</h1>
<?php
	$pnfpb_tab_ai_active = "nav-tab-active";
	require_once( plugin_dir_path( __FILE__ ) . 'push_admin_menu_list.php' );
?>

<div class="pnfpb_column_1200">

	<div class="pnfpb-info-box pnfpb-info-box--blue" style="margin-bottom:20px;">
		<span class="dashicons dashicons-info pnfpb-info-box__icon"></span>
		<div>
			<strong><?php esc_html_e( 'Configure AI before using draft generation', 'push-notification-for-post-and-buddypress' ); ?></strong>
			<p><?php esc_html_e( 'Add the endpoint, API key, and model details here first. The Send Push and post editor AI buttons will warn you if this tab is not configured.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>
	</div>

	<form action="options.php" method="post" enctype="multipart/form-data" class="form-field">
		<?php settings_fields( 'pnfpb_icfcm_group_ai_assistant' ); ?>
		<?php do_settings_sections( 'pnfpb_icfcm_group_ai_assistant' ); ?>

		<?php require_once( plugin_dir_path( __FILE__ ) . 'pnfpb_admin_ai_assistant_configuration_content.php' ); ?>

		<div class="pnfpb-save-wrap">
			<?php submit_button( __( 'Save changes', 'push-notification-for-post-and-buddypress' ), 'pnfpb_ic_push_save_configuration_button' ); ?>
		</div>
	</form>
</div>