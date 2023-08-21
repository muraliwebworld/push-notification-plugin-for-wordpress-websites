/**
* Upload custom icon for pwa app from plugin settings area.
*
*
* @since 1.64
*/
var $j = jQuery.noConflict();

$j(function() {
	
	const { __ } = wp.i18n;
    
	$j('.pnfpb_icfcm_service_account_upload').on('change',function(e) {
        file_data = $j(this).prop('files')[0];
        form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('action', 'icpushadmincallback');
		form_data.append('calltype', 'pnfpb_service_account_upload');
        form_data.append('nonce', pnfpb_ajax_admin_service_account_push_object.pnfpb_nonce);
        $j.ajax({
            url: pnfpb_ajax_admin_service_account_push_object.ajax_url,
            type: 'post',
            action: 'icpushadmincallback',
            calltype: 'pnfpb_service_account_upload',
            contentType: false,
            processData: false,
            data: form_data,
            success: function (response) {
              	console.log(response);
				$j('.pnfpb_icfcm_service_account_upload_message').css('color','red');
				$j('.pnfpb_icfcm_service_account_upload_message').html('<b>Service account file uploaded successfully.</b>');
            }
        });
		
	});
	
	
});