/**
* Upload custom icon for push notification from plugin settings area.
*
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
	
});