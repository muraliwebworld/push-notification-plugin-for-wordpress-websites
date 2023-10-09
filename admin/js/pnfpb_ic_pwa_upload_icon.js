 
/**
* Upload custom icon for pwa app from plugin settings area.
* Customize push notification settings in plugin settings area.
*
* @since 1.20
*/
var $j = jQuery.noConflict();

$j(document).ready(function() {
	
	const { __ } = wp.i18n;
    
	var mediaUploader_132;
	var mediaUploader_512;
	
	$j('#pnfpb_ic_fcm_pwa_upload_button_132').on('click',function(e) {
		e.preventDefault();
		if( mediaUploader_132 ){
			mediaUploader_132.open();
			return;
		}
		
		mediaUploader_132 = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture','PNFPB_TD'),
			button: {
				text: __('Select a Picture','PNFPB_TD')
			},
			multiple: false
		});
		
		mediaUploader_132.on('select', function(){
			attachment = mediaUploader_132.state().get('selection').first().toJSON();
			var imagewidth = attachment.width;
			var imageheight = attachment.height;
			if (imagewidth === 132 && imageheight === 132){
				$j('#pnfpb_ic_fcm_pwa_upload_preview_132').text('');
				$j('#pnfpb_ic_fcm_pwa_upload_icon_132').val(attachment.url);
				$j('#pnfpb_ic_fcm_pwa_upload_preview_132').css('background-image','url(' + attachment.url + ')');
			}
			else
			{
				$j('#pnfpb_ic_fcm_pwa_upload_preview_132').css('background-image','none');
				$j('#pnfpb_ic_fcm_pwa_upload_preview_132').text('Image size must be 132x132 pixels');
			}
		});
		
		mediaUploader_132.open();
		
	});
	
	$j('#pnfpb_ic_fcm_pwa_upload_button_512').on('click',function(e) {
		e.preventDefault();
		if( mediaUploader_512 ){
			mediaUploader_512.open();
			return;
		}
		
		mediaUploader_512 = wp.media.frames.file_frame = wp.media({
			title: __('Select a Picture','PNFPB_TD'),
			button: {
				text: __('Select a Picture','PNFPB_TD')
			},
			multiple: false
		});
		
		mediaUploader_512.on('select', function(){
			attachment = mediaUploader_512.state().get('selection').first().toJSON();
			var imagewidth = attachment.width;
			var imageheight = attachment.height;
			if (imagewidth === 512 && imageheight === 512){
				$j('#pnfpb_ic_fcm_pwa_upload_preview_512').text('');
				$j('#pnfpb_ic_fcm_pwa_upload_icon_512').val(attachment.url);
				$j('#pnfpb_ic_fcm_pwa_upload_preview_512').css('background-image','url(' + attachment.url + ')');
			}
			else
			{
				$j('#pnfpb_ic_fcm_pwa_upload_preview_512').css('background-image','none');
				$j('#pnfpb_ic_fcm_pwa_upload_preview_512').text('Image size must be 512x512 pixels');	
			}
		});
		
		mediaUploader_512.open();
		
	});
	
/*	if ($j('input[name="pnfpb_ic_fcm_post_timeschedule_enable"]').length) {

		if ($j('input[name="pnfpb_ic_fcm_post_schedule_enable"]').is(':checked')) 
		{
			$j('.pnfpb_ic_fcm_post_timeschedule_seconds_block').show();
			$j('.pnfpb_ic_fcm_post_timeschedule_seconds_radio_block').show();
			$j('#pnfpb_ic_fcm_post_timeschedule_seconds').prop('required',true);
		}
		else 
		{
			$j('.pnfpb_ic_fcm_post_timeschedule_seconds_block').hide();
			$j('.pnfpb_ic_fcm_post_timeschedule_seconds_radio_block').hide();
			$j('#pnfpb_ic_fcm_post_timeschedule_seconds').prop('required',false);
		}
	}
	
	if ($j('input[name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"]').length) {

		if ($j('input[name="pnfpb_ic_fcm_buddypressactivities_schedule_enable"]').is(':checked')) 
		{
			$j('.pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_block').show();
			$j('.pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_radio_block').show();
			$j('#pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds').prop('required',true);
		}
		else 
		{
			$j('.pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_block').hide();
			$j('.pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_radio_block').hide();
			$j('#pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds').prop('required',false);
		}
	}
	
	if ($j('input[name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"]').length) {

		if ($j('input[name="pnfpb_ic_fcm_buddypresscomments_schedule_enable"]').is(':checked')) 
		{
			$j('.pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_block').show();
			$j('.pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_radio_block').show();
			$j('#pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds').prop('required',true);
		}
		else 
		{
			$j('.pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_block').hide();
			$j('.pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_radio_block').hide();
			$j('#pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds').prop('required',false);
		}
	}	
	
	


	if ($j('input[name="pnfpb_ic_fcm_post_timeschedule_enable"]').length) {


		$j('input[name="pnfpb_ic_fcm_post_schedule_enable"]').on('click',function() {
			
			if ($j('input[name="pnfpb_ic_fcm_post_schedule_enable"]').is(':checked'))
			{
				$j('.pnfpb_ic_fcm_post_timeschedule_seconds_block').show();
				$j('.pnfpb_ic_fcm_post_timeschedule_seconds_radio_block').show();
				$j('#pnfpb_ic_fcm_post_timeschedule_seconds').prop('required',true);
		
			}
			else 
			{
				$j('.pnfpb_ic_fcm_post_timeschedule_seconds_block').hide();
				$j('.pnfpb_ic_fcm_post_timeschedule_seconds_radio_block').hide();
				$j('#pnfpb_ic_fcm_post_timeschedule_seconds').prop('required',false);
			}			
		});		
	}

	if ($j('input[name="pnfpb_ic_fcm_buddypressactivities_timeschedule_enable"]').length) {
		
		$j('input[name="pnfpb_ic_fcm_buddypressactivities_schedule_background_enable"]').on('click',function() {
			
			if ($j('input[name="pnfpb_ic_fcm_buddypressactivities_schedule_background_enable"]').is(':checked') && $j('input[name="pnfpb_ic_fcm_buddypressactivities_schedule_enable"]').is(':checked'))
			{
				$j('.pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_block').show();
				$j('.pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_radio_block').show();
				$j('#pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds').prop('required',true);
		
			}
			else 
			{
				$j('.pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_block').hide();
				$j('.pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_radio_block').hide();
				$j('#pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds').prop('required',false);
			}			
		});		

		$j('input[name="pnfpb_ic_fcm_buddypressactivities_schedule_enable"]').on('click',function() {
			
			if ($j('input[name="pnfpb_ic_fcm_buddypressactivities_schedule_background_enable"]').is(':checked') && $j('input[name="pnfpb_ic_fcm_buddypressactivities_schedule_enable"]').is(':checked'))
			{
				$j('.pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_block').show();
				$j('.pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_radio_block').show();
				$j('#pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds').prop('required',true);
		
			}
			else 
			{
				$j('.pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_block').hide();
				$j('.pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds_radio_block').hide();
				$j('#pnfpb_ic_fcm_buddypressactivities_timeschedule_seconds').prop('required',false);
			}			
		});
	}

	if ($j('input[name="pnfpb_ic_fcm_buddypresscomments_timeschedule_enable"]').length) {

		$j('input[name="pnfpb_ic_fcm_buddypresscomments_schedule_background_enable"]').on('click',function() {
			
			if ($j('input[name="pnfpb_ic_fcm_buddypresscomments_schedule_background_enable"]').is(':checked') && $j('input[name="pnfpb_ic_fcm_buddypresscomments_schedule_enable"]').is(':checked'))
			{
				$j('.pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_block').show();
				$j('.pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_radio_block').show();
				$j('#pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds').prop('required',true);
		
			}
			else 
			{
				$j('.pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_block').hide();
				$j('.pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_radio_block').hide();
				$j('#pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds').prop('required',false);
			}			
		});
		
		$j('input[name="pnfpb_ic_fcm_buddypresscomments_schedule_enable"]').on('click',function() {
			
			if ($j('input[name="pnfpb_ic_fcm_buddypresscomments_schedule_background_enable"]').is(':checked') && $j('input[name="pnfpb_ic_fcm_buddypresscomments_schedule_enable"]').is(':checked'))
			{
				$j('.pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_block').show();
				$j('.pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_radio_block').show();
				$j('#pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds').prop('required',true);
		
			}
			else 
			{
				$j('.pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_block').hide();
				$j('.pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds_radio_block').hide();
				$j('#pnfpb_ic_fcm_buddypresscomments_timeschedule_seconds').prop('required',false);
			}			
		});
	}*/
	
	$j('.pnfpb_admin_notice > .notice-dismiss').on('click',function() {
		
		
		var data = {
			action: 'icpushadmincallback'
		};
								
		$j.post(pnfpb_ajax_object_pwa_upload_icon.ajax_url, data, function(response) {
			
			$j('.pnfpb_admin_notice .is-dismissable').hide();
			
		});
		
		
		
	});
		
	
});
	function toggle_post_type_content_form() {
		
		const { __ } = wp.i18n;
		
  		$j('.pnfpb_ic_post_type_content_form').toggle();
		
		if ($j('.pnfpb_ic_post_type_content_form').is(':visible')) {
			
			$j('.pnfpb_post_type_content_button').text(__('Hide form','PNFPB_TD'));
			
		}
		else
		{
			$j('.pnfpb_post_type_content_button').text(__('Customize','PNFPB_TD'));
		}		
	}


	function toggle_activity_content_form() {
		
		const { __ } = wp.i18n;
		
  		$j('.pnfpb_ic_activity_content_form').toggle();
		
		if ($j('.pnfpb_ic_activity_content_form').is(':visible')) {
			
			$j('.pnfpb_activity_form_button').text(__('Hide form','PNFPB_TD'));
			
		}
		else
		{
			$j('.pnfpb_activity_form_button').text(__('Customize','PNFPB_TD'));
		}		
	}

	function toggle_comments_content_form() {
		
		const { __ } = wp.i18n;

		$j('.pnfpb_ic_comments_content_form').toggle();
		
		if ($j('.pnfpb_ic_comments_content_form').is(':visible')) {
			
			$j('.pnfpb_comments_content_button').text(__('Hide form','PNFPB_TD'));
			
		}
		else
		{
			$j('.pnfpb_comments_content_button').text(__('Customize','PNFPB_TD'));
		}		
	}

	function toggle_private_message_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_private_message_form').toggle();
		
		if ($j('.pnfpb_ic_private_message_form').is(':visible')) {
			
			$j('.pnfpb_private_message_button').text(__('Hide form','PNFPB_TD'));
			
		}
		else
		{
			$j('.pnfpb_private_message_button').text(__('Customize','PNFPB_TD'));
		}
		
	}

	function toggle_new_member_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_new_member_form').toggle();
		
		if ($j('.pnfpb_ic_new_member_form').is(':visible')) {
			
			$j('.pnfpb_new_member_button').text(__('Hide form','PNFPB_TD'));
			
		}
		else
		{
			$j('.pnfpb_new_member_button').text(__('Customize','PNFPB_TD'));
		}
		
	}

	function toggle_friendship_request_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_friendship_request_form').toggle();
		
		if ($j('.pnfpb_ic_friendship_request_form').is(':visible')) {
			
			$j('.pnfpb_friendship_request_button').text(__('Hide form','PNFPB_TD'));
			
		}
		else
		{
			$j('.pnfpb_friendship_request_button').text(__('Customize','PNFPB_TD'));
		}
		
	}


	function toggle_friendship_accept_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_friendship_accept_form').toggle();
		
		if ($j('.pnfpb_ic_friendship_accept_form').is(':visible')) {
			
			$j('.pnfpb_friendship_accept_button').text(__('Hide form','PNFPB_TD'));
			
		}
		else
		{
			$j('.pnfpb_friendship_accept_button').text(__('Customize','PNFPB_TD'));
		}
		
	}


	function toggle_avatar_change_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_avatar_change_form').toggle();
		
		if ($j('.pnfpb_ic_avatar_change_form').is(':visible')) {
			
			$j('.pnfpb_avatar_change_button').text(__('Hide form','PNFPB_TD'));
			
		}
		else
		{
			$j('.pnfpb_avatar_change_button').text(__('Customize','PNFPB_TD'));
		}
		
	}

	function toggle_cover_image_change_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_cover_image_change_form').toggle();
		
		if ($j('.pnfpb_ic_cover_image_change_form').is(':visible')) {
			
			$j('.pnfpb_cover_image_change_button').text(__('Hide form','PNFPB_TD'));
			
		}
		else
		{
			$j('.pnfpb_cover_image_change_button').text(__('Customize','PNFPB_TD'));
		}
		
	}


	function toggle_group_invitation_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_group_invitation_form').toggle();
		
		if ($j('.pnfpb_ic_group_invitation_form').is(':visible')) {
			
			$j('.pnfpb_group_invitation_button').text(__('Hide form','PNFPB_TD'));
			
		}
		else
		{
			$j('.pnfpb_group_invitation_button').text(__('Customize','PNFPB_TD'));
		}
		
	}


	function toggle_group_details_updated_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_group_details_updated_form').toggle();
		
		if ($j('.pnfpb_ic_group_details_updated_form').is(':visible')) {
			
			$j('.pnfpb_group_details_updated_button').text(__('Hide form','PNFPB_TD'));
			
		}
		else
		{
			$j('.pnfpb_group_details_updated_button').text(__('Customize','PNFPB_TD'));
		}
		
	}

	function toggle_new_user_registration_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_new_user_registration_form').toggle();
		
		if ($j('.pnfpb_ic_new_user_registration_form').is(':visible')) {
			
			$j('.pnfpb_new_user_registration_button').text(__('Hide form','PNFPB_TD'));
			
		}
		else
		{
			$j('.pnfpb_new_user_registration_button').text(__('Customize','PNFPB_TD'));
		}
		
	}

	function toggle_contact_form7_form() {
		
		const { __ } = wp.i18n;
	
  		$j('.pnfpb_ic_contact_form7_form').toggle();
		
		if ($j('.pnfpb_ic_contact_form7_form').is(':visible')) {
			
			$j('.pnfpb_contact_form7_button').text(__('Hide form','PNFPB_TD'));
			
		}
		else
		{
			$j('.pnfpb_contact_form7_button').text(__('Customize','PNFPB_TD'));
		}
		
	}

	function toggle_onesignal_configuration() {
		
		const { __ } = wp.i18n;
		
  		$j('.pnfpb_ic_onesignal_configuration').toggle();
		
		if ($j('.pnfpb_ic_onesignal_configuration').is(':visible')) {
			
			$j('.pnfpb_ic_firebase_configuration').hide();
			
			$j('.pnfpb_ic_firebase_configuration_button').text(__('Show Firebase configuration','PNFPB_TD'));
			
			$j('.pnfpb_ic_onesignal_configuration_button').text(__('Onesignal configuration','PNFPB_TD'));
			
		}
		else
		{
			$j('.pnfpb_ic_firebase_configuration').show();
			
			$j('.pnfpb_ic_firebase_configuration_button').text(__('Firebase configuration','PNFPB_TD'));
			
			$j('.pnfpb_ic_onesignal_configuration_button').text(__('Show Onesignal configuration','PNFPB_TD'));
			
		}	
		
	}

	function toggle_firebase_configuration() {
		
		const { __ } = wp.i18n;
		
  		$j('.pnfpb_ic_firebase_configuration').toggle();
		
		
		if ($j('.pnfpb_ic_firebase_configuration').is(':visible')) {
			
			$j('.pnfpb_ic_onesignal_configuration').hide();
			
			$j('.pnfpb_ic_onesignal_configuration_button').text(__('Show onesignal configuration','PNFPB_TD'));
			
			$j('.pnfpb_ic_firebase_configuration_button').text(__('Firebase configuration','PNFPB_TD'));
			
		}
		else
		{
			$j('.pnfpb_ic_onesignal_configuration').show();
			
			$j('.pnfpb_ic_onesignal_configuration_button').text(__('onesignal configuration','PNFPB_TD'));
			
			$j('.pnfpb_ic_firebase_configuration_button').text(__('Show Firebase configuration','PNFPB_TD'));
		}	
		
	}

	function toggle_firebase_configuration_help() {
		
		const { __ } = wp.i18n;
		
  		$j('.pnfpb_ic_firebase_configuration_help').toggle();
		
		if ($j('.pnfpb_ic_firebase_configuration_help').is(':hidden')) {
			
			$j('.pnfpb_ic_firebase_configuration_help_button').html(__('Tutorial on Firebase','PNFPB_TD'));
			
		}
		else
		{
			$j('.pnfpb_ic_firebase_configuration_help_button').html(__('Hide Firebase Tutorial','PNFPB_TD'));
		}	
		
	}

	function toggle_custom_push_prompt_form() {
		
		const { __ } = wp.i18n;
		
  		$j('.pnfpb_ic_push_prompt_form').toggle();
		
		if ($j('.pnfpb_ic_push_prompt_form').is(':visible')) {
			
			$j('.pnfpb_custom_push_prompt_button').text(__('Hide form','PNFPB_TD'));
			
		}
		else
		{
			$j('.pnfpb_custom_push_prompt_button').text(__('Customize','PNFPB_TD'));
		}		
	}
