//
// Script to Unsubscribe push notification using Firebase
//
// @since 1.0.0
//

import { initializeApp, getApp } from 'firebase/app';
import { getToken, isSupported, getMessaging } from "firebase/messaging";

var vapidKey = pnfpb_ajax_object_push.publicKey;

var firebaseConfig = {
    apiKey: pnfpb_ajax_object_push.apiKey,
    authDomain: pnfpb_ajax_object_push.authDomain,
    databaseURL: pnfpb_ajax_object_push.databaseURL,
    projectId: pnfpb_ajax_object_push.projectId,
    storageBucket: pnfpb_ajax_object_push.storageBucket,
    messagingSenderId: pnfpb_ajax_object_push.messagingSenderId,
    appId: pnfpb_ajax_object_push.appId
};

function createFirebaseApp(config) {
    try {
        return getApp()
    } catch {
        return initializeApp(config)
    }
}

var firebaseApp = createFirebaseApp(firebaseConfig)

var messaging = getMessaging(firebaseApp);

var hasFirebaseMessagingSupport = await isSupported();

var $j = jQuery.noConflict();

const hasFirebaseMessagingSupport_unsubscribe = await isSupported();

$j(function() {
	
	const { __ } = wp.i18n;
	
navigator.serviceWorker.register(pnfpb_ajax_object_push.homeurl+'/pnfpb_icpush_pwa_sw.js',{scope:pnfpb_ajax_object_push.homeurl+'/'}).then(function(registration) {
   
     if( $j(".pnfpb_unsubscribe_button").length )
     {
		if (hasFirebaseMessagingSupport_unsubscribe){
			navigator.serviceWorker.ready.then(function (registration) {	
	        // [START get_messaging_object]
            // Retrieve Firebase Messaging object.
            //var messaging = firebase.messaging();
            // [END get_messaging_object]
            // [START set_public_vapid_key]
            // Add the public key generated from the console here.
            //messaging.usePublicVapidKey(pnfpb_ajax_object_unsubscribe_push.publicKey);
            // [END set_public_vapid_key]
		    $j(".pnfpb_unsubscribe_button").on( "click", function() {
		                
				            
                if (Notification.permission === 'granted') {
					
						//messaging = firebase.messaging();
                            
                        getToken(messaging,{serviceWorkerRegistration:registration,vapidKey:pnfpb_ajax_object_push.publicKey }).then((currentToken) => {
                                
						
								var unsubscribebuttontext = pnfpb_ajax_object_unsubscribe_push.unsubscribe_button_text;

						        $j( "#pnfpb_unsubscribe_dialog_confirm" ).dialog({
									resizable: false,
									height: "auto",
									width: 300,									
							        modal: true,
							        buttons: [{
      									text: unsubscribebuttontext,
										open: function() {
											$j(this).attr('style','font-weight:bold;color:'+pnfpb_ajax_object_push.subscribe_button_text_color+';background-color:'+pnfpb_ajax_object_push.subscribe_button_color+';border:0px');											
            							},
            							click: function() {												
									        if (currentToken) {
							   
										        deviceid = currentToken;
							
										        var data = {
											        action: 'unsubscribepush',
											        device_id:deviceid
										        };
								
										        $j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
										        

											        if (response == 'unsubscribed')
											        {
											            
		       			                                    if( $j(".pnfpb_unsubscribe_button").length )
                                                            {
                                                                $j(".pnfpb_unsubscribe_button").hide();
                                                            }
                                                                            
                                                            if( $j(".pnfpb_subscribe_button").length )
                                                            {
                                                                $j(".pnfpb_subscribe_button").show();
															}
															$j( "#pnfpb-unsubscribe-dialog" ).dialog();
														
							                                $j(".pnfpb-unsubscribe-alert-msg").html(pnfpb_ajax_object_push.unsubscribe_dialog_text_confirm);														
														
											            } else {
											            
		       			                                    if( $j(".pnfpb_unsubscribe_button").length )
                                                            {
                                                                $j(".pnfpb_unsubscribe_button").hide();
                                                            }
                                                                            
                                                            if( $j(".pnfpb_subscribe_button").length )
                                                            {
                                                                $j(".pnfpb_subscribe_button").show();
                                                            }			       			                                                
											            

												            $j(".pnfpb-unsubscribe-alert-msg").html(__("UnSubscribe failed..try again..Please!!",'PNFPB_TD'));
							
												            $j( "#pnfpb-unsubscribe-dialog" ).dialog();
							
											            }
								
										        });
							
									        }
											$j( "#pnfpb_unsubscribe_dialog_confirm" ).dialog( "close" );
								        },
								        Cancel: function() {
									        $j( "#pnfpb_unsubscribe_dialog_confirm" ).dialog( "close" );
								        }
							        }]
    						    });
    						    
    						    $j('#pnfpb_unsubscribe_dialog_confirm').on('dialogclose', function(event) {
                                    $j(".pnfpb-unsubscribe-alert-msg").html("");
                                    $j(".pnfpb-subscribe-alert-msg").html("");
                                });
						
                        });
                        
                   }
                   else
                   {
                        
			       	    if( $j(".pnfpb_unsubscribe_button").length )
                        {
                            $j(".pnfpb_unsubscribe_button").show();
                        }
                                                                            
                        if( $j(".pnfpb_subscribe_button").length )
                        {
                            $j(".pnfpb_subscribe_button").hide();
                        }			       			                                                
                        
						
						$j(".pnfpb-unsubscribe-alert-msg").html(__("UnSubscribe failed..try again or Subscribe again..Please!!",'PNFPB_TD'));
							
						$j( "#pnfpb-unsubscribe-dialog" ).dialog();                        
                  }
                    
				})
				    
		    })
			}
			else
			{
				console.log(__('This browser does not support PUSHAPI Firebase messaging!!!','PNFPB_TD'))
			}			
        }
	})
	
});