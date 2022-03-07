/**
* Upload custom icon for push notification from plugin settings area.
*
*
* @since 1.0.0
*/
var $j = jQuery.noConflict();
$j(document).ready(function() {
    
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
	
});