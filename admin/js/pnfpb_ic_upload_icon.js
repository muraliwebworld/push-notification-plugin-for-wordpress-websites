/**
* Upload custom icon for push notification from plugin settings area.
*
* @since 1.0.0
*/
var $j = jQuery.noConflict();
$j(document).ready(function() {
    const { __ } = wp.i18n;
	var mediaUploadericon;
	
	$j('#pnfpb_ic_fcm_upload_button').on('click',function(e) {
		e.preventDefault();
		if( mediaUploadericon ){
			mediaUploadericon.open();
			return;
		}
		
		mediaUploadericon = wp.media.frames.file_frame = wp.media({
			title: 'Select a Picture',
			button: {
				text: 'Select Picture'
			},
			multiple: false
		});
		
		mediaUploadericon.on('select', function(){
			attachment = mediaUploadericon.state().get('selection').first().toJSON();
			$j('#pnfpb_ic_fcm_upload_icon').val(attachment.url);
			$j('#pnfpb_ic_fcm_upload_preview').css('background-image','url(' + attachment.url + ')');
		});
		
		mediaUploadericon.open();
		
	});
	
	var mediaUploadericon_for_group_subscribe;
	
	$j('#pnfpb_select_subscribe_group_push_notification_icon').on('click',function(e) {
		e.preventDefault();
		if( mediaUploadericon_for_group_subscribe ){
			mediaUploadericon_for_group_subscribe.open();
			return;
		}
		
		mediaUploadericon_for_group_subscribe = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture','PNFPB_TD'),
			button: {
				text: __('Select a Picture','PNFPB_TD')
			},
			multiple: false
		});
		
		mediaUploadericon_for_group_subscribe.on('select', function(){
			attachment = mediaUploadericon_for_group_subscribe.state().get('selection').first().toJSON();
			$j('#pnfpb_subscribe_group_push_notification_icon').val(attachment.url);
			$j('#pnfpb_subscribe_group_push_notification_icon_preview').css('background-image','url(' + attachment.url + ')');

		});
		
		mediaUploadericon_for_group_subscribe.open();
		
	});
	
	var mediaUploadericon_for_group_unsubscribe;
	
	$j('#pnfpb_select_unsubscribe_group_push_notification_icon').on('click',function(e) {
		e.preventDefault();
		if( mediaUploadericon_for_group_unsubscribe ){
			mediaUploadericon_for_group_unsubscribe.open();
			return;
		}
		
		mediaUploadericon_for_group_unsubscribe = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture','PNFPB_TD'),
			button: {
				text: __('Select a Picture','PNFPB_TD')
			},
			multiple: false
		});
		
		mediaUploadericon_for_group_unsubscribe.on('select', function(){
			attachment = mediaUploadericon_for_group_unsubscribe.state().get('selection').first().toJSON();
			$j('#pnfpb_unsubscribe_group_push_notification_icon').val(attachment.url);
			$j('#pnfpb_unsubscribe_group_push_notification_icon_preview').css('background-image','url(' + attachment.url + ')');

		});
		
		mediaUploadericon_for_group_unsubscribe.open();
		
	});	
	
	var pushprompt_subscribe_icon_mediaUploader_512;
	
	$j('#pnfpb_ic_fcm_popup_subscribe_button_icon').on('click',function(e) {
		e.preventDefault();
		if( pushprompt_subscribe_icon_mediaUploader_512 ) {
			pushprompt_subscribe_icon_mediaUploader_512.open();
			return;
		}
		
		pushprompt_subscribe_icon_mediaUploader_512 = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture','PNFPB_TD'),
			button: {
				text: __('Select a Picture','PNFPB_TD')
			},
			multiple: false
		});
		
		pushprompt_subscribe_icon_mediaUploader_512.on('select', function() {
			attachment = pushprompt_subscribe_icon_mediaUploader_512.state().get('selection').first().toJSON();
			var imagewidth = attachment.width;
			var imageheight = attachment.height;
			if (imagewidth === 32 && imageheight === 32){
				$j('#pnfpb_ic_fcm_popup_subscribe_button_icon_preview').text('');
				$j('#pnfpb_ic_fcm_popup_subscribe_button_icon').val(attachment.url);
				$j('#pnfpb_ic_fcm_popup_subscribe_button_icon_preview').css('background-image','url(' + attachment.url + ')');
			}
			else
			{
				$j('#pnfpb_ic_fcm_popup_subscribe_button_icon_preview').css('background-image','none');
				$j('#pnfpb_ic_fcm_popup_subscribe_button_icon_preview').text('Image size must be 32x32 pixels');
			}
		});
		
		pushprompt_subscribe_icon_mediaUploader_512.open();
		
	});
	
	var pnfpb_custom_prompt_subscribe_icon_mediaUploader_512;
	
	$j('#pnfpb_ic_fcm_popup_custom_prompt_icon').on('click',function(e) {
		e.preventDefault();
		if( pnfpb_custom_prompt_subscribe_icon_mediaUploader_512 ) {
			pnfpb_custom_prompt_subscribe_icon_mediaUploader_512.open();
			return;
		}
		
		pnfpb_custom_prompt_subscribe_icon_mediaUploader_512 = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture','PNFPB_TD'),
			button: {
				text: __('Select a Picture','PNFPB_TD')
			},
			multiple: false
		});
		
		pnfpb_custom_prompt_subscribe_icon_mediaUploader_512.on('select', function() {
			attachment = pnfpb_custom_prompt_subscribe_icon_mediaUploader_512.state().get('selection').first().toJSON();
			var imagewidth = attachment.width;
			var imageheight = attachment.height;
			if (imagewidth < 85 && imageheight < 85){
				$j('#pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon_preview').text('');
				$j('#pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon').val(attachment.url);
				$j('#pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon_preview').css('background-image','url(' + attachment.url + ')');
			}
			else
			{
				$j('#pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon_preview').css('background-image','none');
				$j('#pnfpb_ic_fcm_popup_custom_prompt_subscribe_button_icon_preview').text('Image size must be less than 85x85 pixels');
			}
		});
		
		pnfpb_custom_prompt_subscribe_icon_mediaUploader_512.open();
		
	});	
	
});