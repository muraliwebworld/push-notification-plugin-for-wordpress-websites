<?php
/**
 * AI assistant configuration content.
 *
 * @since 3.14
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<section class="pnfpb-settings-section">
	<h3 class="pnfpb-settings-section__title">
		<span class="dashicons dashicons-admin-network pnfpb-settings-section__icon" style="color:#2271b1;"></span>
		<?php esc_html_e( 'Connection & access', 'push-notification-for-post-and-buddypress' ); ?>
	</h3>
	<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Configure the provider endpoint, API key, and model before enabling the AI draft assistant in other workflows.', 'push-notification-for-post-and-buddypress' ); ?></p>

	<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-yes-alt"></span>
				<?php esc_html_e( 'Enable AI assistant', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ai_assistant_enable" name="pnfpb_ai_assistant_enable" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ai_assistant_enable' ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'The AI layer is optional. If the provider is unavailable, the plugin falls back to the existing notification text.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-admin-generic"></span>
				<?php esc_html_e( 'AI provider mode', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control" style="align-items:flex-start;">
				<select id="pnfpb_ai_assistant_provider" name="pnfpb_ai_assistant_provider" class="pnfpb_ic_push_settings_table_value_column_input_field">
					<option value="pluggable" <?php selected( 'pluggable', get_option( 'pnfpb_ai_assistant_provider', 'pluggable' ) ); ?>><?php esc_html_e( 'Pluggable', 'push-notification-for-post-and-buddypress' ); ?></option>
					<option value="external" <?php selected( 'external', get_option( 'pnfpb_ai_assistant_provider' ) ); ?>><?php esc_html_e( 'External API', 'push-notification-for-post-and-buddypress' ); ?></option>
					<option value="self_hosted" <?php selected( 'self_hosted', get_option( 'pnfpb_ai_assistant_provider' ) ); ?>><?php esc_html_e( 'Self-hosted endpoint', 'push-notification-for-post-and-buddypress' ); ?></option>
				</select>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Choose how the assistant should connect to your AI backend.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-admin-links"></span>
				<?php esc_html_e( 'AI endpoint URL', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control" style="align-items:flex-start;">
				<input class="pnfpb_ic_push_settings_table_value_column_input_field"
					   id="pnfpb_ai_assistant_endpoint"
					   name="pnfpb_ai_assistant_endpoint"
					   type="url"
					   value="<?php echo esc_attr( get_option( 'pnfpb_ai_assistant_endpoint' ) ); ?>"
					   placeholder="https://api.example.com/v1/chat/completions" />
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Provide the full HTTP endpoint used to generate AI drafts.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-shield"></span>
				<?php esc_html_e( 'AI API key or bearer token', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control" style="align-items:flex-start;">
				<input class="pnfpb_ic_push_settings_table_value_column_input_field"
					   id="pnfpb_ai_assistant_api_key"
					   name="pnfpb_ai_assistant_api_key"
					   type="password"
					   value="<?php echo esc_attr( get_option( 'pnfpb_ai_assistant_api_key' ) ); ?>"
					   autocomplete="off" />
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Store the key here so draft generation can authenticate with your provider.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>
	</div>
</section>

<section class="pnfpb-settings-section">
	<h3 class="pnfpb-settings-section__title">
		<span class="dashicons dashicons-edit-page pnfpb-settings-section__icon" style="color:#2271b1;"></span>
		<?php esc_html_e( 'Draft behaviour', 'push-notification-for-post-and-buddypress' ); ?>
	</h3>
	<p class="pnfpb-settings-section__desc"><?php esc_html_e( 'Tune how the assistant drafts content for on-demand sends and post notifications.', 'push-notification-for-post-and-buddypress' ); ?></p>

	<div class="pnfpb-settings-grid pnfpb-settings-grid--2col">
		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-analytics"></span>
				<?php esc_html_e( 'Model name', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control" style="align-items:flex-start;">
				<input class="pnfpb_ic_push_settings_table_value_column_input_field"
					   id="pnfpb_ai_assistant_model"
					   name="pnfpb_ai_assistant_model"
					   type="text"
					   value="<?php echo esc_attr( get_option( 'pnfpb_ai_assistant_model' ) ); ?>"
					   placeholder="gpt-4.1-mini" />
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Use the model name expected by your provider.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-editor-kitchensink"></span>
				<?php esc_html_e( 'Maximum input characters', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control" style="align-items:flex-start;">
				<input class="pnfpb_ic_push_settings_table_value_column_input_field"
					   id="pnfpb_ai_assistant_max_input_chars"
					   name="pnfpb_ai_assistant_max_input_chars"
					   type="number"
					   min="200"
					   step="50"
					   value="<?php echo esc_attr( get_option( 'pnfpb_ai_assistant_max_input_chars', '2400' ) ); ?>" />
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Lower values reduce what is shared with the provider. The plugin trims content when privacy mode is enabled.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-backup"></span>
				<?php esc_html_e( 'Share full content with AI provider', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control">
				<label class="pnfpb_switch">
					<input id="pnfpb_ai_assistant_share_full_content" name="pnfpb_ai_assistant_share_full_content" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ai_assistant_share_full_content' ) ); ?> />
					<span class="pnfpb_slider round"></span>
				</label>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Disable this to send only trimmed text for draft generation.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-megaphone"></span>
				<?php esc_html_e( 'Workflow toggles', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-field-card__control" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:16px;align-items:stretch;">
				<div class="pnfpb-field-card" style="margin:0;min-height:100%;">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-upload"></span>
						<?php esc_html_e( 'On-demand sends', 'push-notification-for-post-and-buddypress' ); ?>
					</div>
					<div class="pnfpb-field-card__control" style="justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">
						<div style="min-width:0;flex:1 1 170px;">
							<strong><?php esc_html_e( 'Enable AI for on-demand sends', 'push-notification-for-post-and-buddypress' ); ?></strong>
							<p class="pnfpb-field-card__desc" style="margin:6px 0 0;">
								<?php esc_html_e( 'Lets the Send Push draft button generate a title, body, and optional send time.', 'push-notification-for-post-and-buddypress' ); ?>
							</p>
						</div>
						<label class="pnfpb_switch" style="flex:0 0 auto;">
							<input id="pnfpb_ai_assistant_enable_on_demand" name="pnfpb_ai_assistant_enable_on_demand" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ai_assistant_enable_on_demand', '1' ) ); ?> />
							<span class="pnfpb_slider round"></span>
						</label>
					</div>
				</div>

				<div class="pnfpb-field-card" style="margin:0;min-height:100%;">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-edit"></span>
						<?php esc_html_e( 'Post editor notifications', 'push-notification-for-post-and-buddypress' ); ?>
					</div>
					<div class="pnfpb-field-card__control" style="justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">
						<div style="min-width:0;flex:1 1 170px;">
							<strong><?php esc_html_e( 'Enable AI for post editor notifications', 'push-notification-for-post-and-buddypress' ); ?></strong>
							<p class="pnfpb-field-card__desc" style="margin:6px 0 0;">
								<?php esc_html_e( 'Lets the post editor draft button fill notification fields before the post is published.', 'push-notification-for-post-and-buddypress' ); ?>
							</p>
						</div>
						<label class="pnfpb_switch" style="flex:0 0 auto;">
							<input id="pnfpb_ai_assistant_enable_post_editor" name="pnfpb_ai_assistant_enable_post_editor" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ai_assistant_enable_post_editor', '1' ) ); ?> />
							<span class="pnfpb_slider round"></span>
						</label>
					</div>
				</div>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'These must be enabled to use the draft buttons from Send Push and the post editor.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>

		<div class="pnfpb-field-card" style="grid-column:1/-1;">
			<div class="pnfpb-field-card__label">
				<span class="dashicons dashicons-visibility"></span>
				<?php esc_html_e( 'Audience and schedule hints', 'push-notification-for-post-and-buddypress' ); ?>
			</div>
			<div class="pnfpb-settings-grid pnfpb-settings-grid--2col" style="width:100%;">
				<div class="pnfpb-field-card" style="margin:0;">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-clock"></span>
						<?php esc_html_e( 'Suggest best send time', 'push-notification-for-post-and-buddypress' ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<label class="pnfpb_switch">
							<input id="pnfpb_ai_assistant_enable_send_time" name="pnfpb_ai_assistant_enable_send_time" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ai_assistant_enable_send_time', '1' ) ); ?> />
							<span class="pnfpb_slider round"></span>
						</label>
					</div>
				</div>

				<div class="pnfpb-field-card" style="margin:0;">
					<div class="pnfpb-field-card__label">
						<span class="dashicons dashicons-groups"></span>
						<?php esc_html_e( 'Suggest audience relevance', 'push-notification-for-post-and-buddypress' ); ?>
					</div>
					<div class="pnfpb-field-card__control">
						<label class="pnfpb_switch">
							<input id="pnfpb_ai_assistant_enable_audience" name="pnfpb_ai_assistant_enable_audience" type="checkbox" value="1" <?php checked( '1', get_option( 'pnfpb_ai_assistant_enable_audience', '1' ) ); ?> />
							<span class="pnfpb_slider round"></span>
						</label>
					</div>
				</div>
			</div>
			<p class="pnfpb-field-card__desc"><?php esc_html_e( 'Turn these on if you want the assistant to suggest when to send and who to focus on.', 'push-notification-for-post-and-buddypress' ); ?></p>
		</div>
	</div>
</section>