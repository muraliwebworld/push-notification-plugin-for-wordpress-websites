/**
* Upload custom icon for pwa app from plugin settings area.
*
*
* @since 1.21
*/
var $j = jQuery.noConflict();

$j(document).ready(function() {
	
	const { __ } = wp.i18n;
    
	var mediaUploader_push_ondemand;
	
	$j('#pnfpb_ic_fcm_on_demand_push_image_button').on('click',function(e) {
		e.preventDefault();
		if( mediaUploader_push_ondemand ){
			mediaUploader_push_ondemand.open();
			return;
		}
		
		mediaUploader_push_ondemand = wp.media.frames.file_frame = wp.media({
			title: 'Select a Picture',
			button: {
				text: 'Select Picture'
			},
			multiple: false
		});
		
		mediaUploader_push_ondemand.on('select', function(){
			attachment = mediaUploader_push_ondemand.state().get('selection').first().toJSON();
			$j('#pnfpb_ic_on_demand_push_image_url').val(attachment.url);
			$j('#pnfpb_ic_fcm_on_demand_push_image').val(attachment.url);
			$j('#pnfpb_ic_fcm_on_demand_push_image_preview').css('background-image','url(' + attachment.url + ')');
		});
		
		mediaUploader_push_ondemand.open();
		
	});
	
	$j('#pnfpb_ic_on_demand_push_url').on('change',function(e) {
		$j('#pnfpb_ic_on_demand_push_url_link').val($j('#pnfpb_ic_on_demand_push_url').find(":selected").val());
	});
	
});
