var $j = jQuery.noConflict();

$j(function () {
	if (typeof pnfpb_ai_notification_object === 'undefined') {
		return;
	}

	var ajaxUrl = pnfpb_ai_notification_object.ajax_url;
	var nonce = pnfpb_ai_notification_object.nonce;
	var loadingText = pnfpb_ai_notification_object.strings.loading;
	var errorText = pnfpb_ai_notification_object.strings.error;
	var notConfiguredText = pnfpb_ai_notification_object.strings.not_configured;
	var workflowDisabledOnDemandText = pnfpb_ai_notification_object.strings.workflow_disabled_on_demand;
	var workflowDisabledPostText = pnfpb_ai_notification_object.strings.workflow_disabled_post;
	var isConfigured = !!pnfpb_ai_notification_object.configured;
	var onDemandEnabled = !!pnfpb_ai_notification_object.workflow_on_demand_enabled;
	var postEnabled = !!pnfpb_ai_notification_object.workflow_post_enabled;

	function formatDateParts(dateValue) {
		var year = dateValue.getFullYear();
		var month = String(dateValue.getMonth() + 1).padStart(2, '0');
		var day = String(dateValue.getDate()).padStart(2, '0');
		var hours = String(dateValue.getHours()).padStart(2, '0');
		var minutes = String(dateValue.getMinutes()).padStart(2, '0');

		return {
			date: year + '-' + month + '-' + day,
			time: hours + ':' + minutes
		};
	}

	function setPreview($container, data) {
		if (!$container || !$container.length) {
			return;
		}

		var html = '';
		html += '<strong>' + (data.title || '') + '</strong>';
		html += '<div style="margin-top:8px;">' + (data.content || '') + '</div>';

		if (data.send_time) {
			html += '<div style="margin-top:8px;"><strong>Suggested send time:</strong> ' + data.send_time + '</div>';
		}

		if (data.audience_hint) {
			html += '<div style="margin-top:8px;"><strong>Audience hint:</strong> ' + data.audience_hint + '</div>';
		}

		html += '<div style="margin-top:8px; color:#646970;"><strong>Source:</strong> ' + (data.source || 'fallback') + ' · <strong>Confidence:</strong> ' + (data.confidence || 0) + '</div>';

		if (data.provider_error) {
			html += '<div style="margin-top:8px; color:#b32d2e;">' + data.provider_error + '</div>';
		}

		$container.html(html).show();
	}

	function sendPreviewRequest(payload, onSuccess, onError) {
		$j.ajax({
			url: ajaxUrl,
			type: 'POST',
			dataType: 'json',
			data: $j.extend({
				action: 'pnfpb_ai_notification_preview',
				nonce: nonce
			}, payload)
		}).done(function (response) {
			if (response && response.success) {
				onSuccess(response.data || {});
				return;
			}

			onError((response && response.data && response.data.message) ? response.data.message : errorText);
		}).fail(function () {
			onError(errorText);
		});
	}

	function getWorkflowWarning(feature) {
		if (!isConfigured) {
			return notConfiguredText;
		}

		if (feature === 'on_demand' && !onDemandEnabled) {
			return workflowDisabledOnDemandText;
		}

		if (feature === 'post' && !postEnabled) {
			return workflowDisabledPostText;
		}

		return '';
	}

	function showStatus($status, message) {
		if (!$status || !$status.length) {
			return;
		}

		$status.text(message || '');
	}

	function applySuggestedTime(sendTime, dateSelector, timeSelector) {
		if (!sendTime) {
			return;
		}

		var normalized = sendTime.replace(' ', 'T') + 'Z';
		var dateValue = new Date(normalized);
		if (isNaN(dateValue.getTime())) {
			return;
		}

		var parts = formatDateParts(dateValue);
		$j(dateSelector).val(parts.date);
		$j(timeSelector).val(parts.time);
	}

	$j('#pnfpb_ai_generate_on_demand_button').on('click', function (event) {
		event.preventDefault();

		var $button = $j(this);
		var $status = $j('#pnfpb_ai_on_demand_status');
		var $preview = $j('#pnfpb_ai_on_demand_preview');
		var warning = getWorkflowWarning('on_demand');

		if (warning) {
			showStatus($status, warning);
			return;
		}

		var title = $j('#pnfpb_ic_on_demand_push_title').val() || '';
		var content = $j('#pnfpb_ic_on_demand_push_content').val() || '';
		var clickUrl = $j('#pnfpb_ic_on_demand_push_url_link').val() || '';

		$button.prop('disabled', true);
		showStatus($status, loadingText);

		sendPreviewRequest({
			feature: 'on_demand',
			title: title,
			content: content,
			post_type: 'on_demand',
			audience: $j('#pnfpb_ic_on_demand_push_select_user_ids').val() ? 'selected_users' : 'broad',
			click_url: clickUrl
		}, function (data) {
			if (data.title) {
				$j('#pnfpb_ic_on_demand_push_title').val(data.title);
			}
			if (data.content) {
				$j('#pnfpb_ic_on_demand_push_content').val(data.content);
			}
			if (data.send_time) {
				applySuggestedTime(data.send_time, '#pnfpb_ic_fcm_token_ondemand_datepicker', '#pnfpb_ic_fcm_token_ondemand_timepicker');
			}
			setPreview($preview, data);
			showStatus($status, 'AI draft generated.');
			$button.prop('disabled', false);
		}, function (message) {
			showStatus($status, message || errorText);
			$button.prop('disabled', false);
		});
	});

	function getEditorTitle() {
		var title = $j('#title').val() || '';
		if (title) {
			return title;
		}

		if (window.wp && wp.data && wp.data.select) {
			try {
				var editorStore = wp.data.select('core/editor');
				if (editorStore && editorStore.getEditedPostAttribute) {
					return editorStore.getEditedPostAttribute('title') || '';
				}
			} catch (error) {
				return '';
			}
		}

		return '';
	}

	function getEditorContent() {
		var content = $j('#content').val() || '';
		if (content) {
			return content;
		}

		if (window.wp && wp.data && wp.data.select) {
			try {
				var editorStore = wp.data.select('core/editor');
				if (editorStore && editorStore.getEditedPostAttribute) {
					return editorStore.getEditedPostAttribute('content') || '';
				}
			} catch (error) {
				return '';
			}
		}

		return '';
	}

	$j('#pnfpb_ai_generate_post_button').on('click', function (event) {
		event.preventDefault();

		var $button = $j(this);
		var $status = $j('#pnfpb_ai_post_status');
		var $preview = $j('#pnfpb_ai_post_preview');
		var warning = getWorkflowWarning('post');

		if (warning) {
			showStatus($status, warning);
			return;
		}

		var title = getEditorTitle();
		var content = getEditorContent();
		var postType = $j('#post_type').val() || '';
		var clickUrl = window.location.href;

		$button.prop('disabled', true);
		showStatus($status, loadingText);

		sendPreviewRequest({
			feature: 'post',
			title: title,
			content: content,
			post_type: postType,
			audience: 'broad',
			click_url: clickUrl
		}, function (data) {
			if (data.title) {
				$j('#pnfpb_ai_notification_title').val(data.title);
			}
			if (data.content) {
				$j('#pnfpb_ai_notification_content').val(data.content);
			}
			if (data.send_time) {
				$j('#pnfpb_ai_notification_send_time').val(data.send_time);
				applySuggestedTime(data.send_time, '#pnfpb_ic_fcm_token_ondemand_datepicker_post', '#pnfpb_ic_fcm_token_ondemand_timepicker_post');
			}
			setPreview($preview, data);
			showStatus($status, 'AI draft generated. Save the post to keep the suggestion with this notification.');
			$button.prop('disabled', false);
		}, function (message) {
			showStatus($status, message || errorText);
			$button.prop('disabled', false);
		});
	});
});
