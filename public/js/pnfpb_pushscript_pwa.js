/**
* Script to send push notification using Firebase
*
* @since 1.0.0
*/
var $j = jQuery.noConflict();

function PNFPB_from_Flutter_mobileapp(pushtoken) {
	
 pnfpb_pushtoken_fromflutter = pushtoken;
	
 return pnfpb_pushtoken_fromflutter;
	
}

$j(document).ready(function() {

// Your web app's Firebase configuration

var notificationclickurl = '';

var deviceid = '';

var homeurl = pnfpb_ajax_object_push.homeurl;
	
var messaging = '';

var firebaseConfig = {
    apiKey: pnfpb_ajax_object_push.apiKey,
    authDomain: pnfpb_ajax_object_push.authDomain,
    databaseURL: pnfpb_ajax_object_push.databaseURL,
    projectId: pnfpb_ajax_object_push.projectId,
    storageBucket: pnfpb_ajax_object_push.storageBucket,
    messagingSenderId: pnfpb_ajax_object_push.messagingSenderId,
    appId: pnfpb_ajax_object_push.appId
};
	

if (pnfpb_ajax_object_push.pwainstallbuttontext === '') {
	pnfpb_ajax_object_push.pwainstallbuttontext = 'Install PWA app';
}

if (pnfpb_ajax_object_push.pwainstallheadertext === '') {
	pnfpb_ajax_object_push.pwainstallheadertext = 'Install our PWA app with offline functionality';
}

if (pnfpb_ajax_object_push.pwainstalltext === '') {
	pnfpb_ajax_object_push.pwainstalltext = 'Install PWA';
}

if (pnfpb_ajax_object_push.pwainstallbuttoncolor === '') {
	pnfpb_ajax_object_push.pwainstallbuttoncolor = '#ff0000';
}

if (pnfpb_ajax_object_push.pwainstallbuttontextcolor === '') {
	pnfpb_ajax_object_push.pwainstallbuttontextcolor = '#ffffff';
}

	
if (pnfpb_ajax_object_push.pwaapponlyenable === '1' ) {
	navigator.serviceWorker.register(homeurl+'/pnfpb_icpush_pwa_sw.js',{scope:homeurl+'/'}).then(function(registration) {
    	registration.update();	
     	// If updatefound is fired, it means that there's
      	// a new service worker being installed.
      	//var installingWorker = registration.installing;
      registration.onupdatefound = () => {
        var installingWorker = registration.installing;
        installingWorker.onstatechange = () => {
          if (installingWorker.state === 'installed') {
            if (navigator.serviceWorker.controller) {
              // At this point, the old content will have been purged and
              // the fresh content will have been added to the cache.
              // It's the perfect time to display a "New content is
              // available; please refresh." message in your web app.
              console.log('New content is available; please refresh.');
             
            } else {
              // At this point, everything has been precached.
              // It's the perfect time to display a
              // "Content is cached for offline use." message.
              console.log('Content is cached for offline use1');
            }
          }
        };
      };
	})
	}
	else
	{

	// Initialize Firebase
	if (!firebase.apps.length) {
   		firebase.initializeApp(firebaseConfig);
	} else {
   		firebase.app(); // if already initialized, use that one
	}

	if ('serviceWorker' in navigator) {

	
		navigator.serviceWorker.register(homeurl+'/pnfpb_icpush_pwa_sw.js',{scope:homeurl+'/'}).then(function(registration) {
    	registration.update();	
     	// If updatefound is fired, it means that there's
      	// a new service worker being installed.
      	//var installingWorker = registration.installing;
      registration.onupdatefound = () => {
        var installingWorker = registration.installing;
        installingWorker.onstatechange = () => {
          if (installingWorker.state === 'installed') {
            if (navigator.serviceWorker.controller) {
              // At this point, the old content will have been purged and
              // the fresh content will have been added to the cache.
              // It's the perfect time to display a "New content is
              // available; please refresh." message in your web app.
              console.log('New content is available; please refresh.');
             
            } else {
              // At this point, everything has been precached.
              // It's the perfect time to display a
              // "Content is cached for offline use." message.
              console.log('Content is cached for offline use1');
            }
     
          }
        };
      };			
	
		if( $j(".pnfpb_subscribe_button").length )
		{
			$j(".pnfpb_subscribe_button").show();
		}
		
		if ('serviceWorker' in navigator && 'PushManager' in window && firebase.messaging.isSupported()) {

        		registration.pushManager.getSubscription().then(async function (subscription) {
			
        			if (!subscription) 
					{
						await requestPermission(registration);
					}
					else
					{
                   		await checkdeviceid(registration);   
					}
        	});
		}
		else
		{
			console.log('This browser does not support PUSHAPI Firebase messaging!!!');
			mobileapp_subscribe_shortcode();
		}


		if (firebase.messaging.isSupported()) {
    		// [START get_messaging_object]
    		// Retrieve Firebase Messaging object.
    		messaging = firebase.messaging();
    		// [END get_messaging_object]
    		// [START set_public_vapid_key]
    		// Add the public key generated from the console here.
    		//messaging.usePublicVapidKey(pnfpb_ajax_object_push.publicKey);
    		// [END set_public_vapid_key]

    		// IDs of divs that display Instance ID token UI or request permission UI.
    		const tokenDivId = 'token_div';
    		const permissionDivId = 'permission_div';

    		// [START refresh_token]
    		// Callback fired if Instance ID token is updated.
    		messaging.onTokenRefresh(() => {
    			messaging.getToken({serviceWorkerRegistration: registration, vapidKey:pnfpb_ajax_object_push.publicKey }).then((refreshedToken) => {
    				//console.log('Token refreshed.');
    				// Indicate that the new Instance ID token has not yet been sent to the
    				// app server.
    				setTokenSentToServer(false);
    				// Send Instance ID token to app server.
    				sendTokenToServer(refreshedToken);
    				// [START_EXCLUDE]
    				// Display new Instance ID token and clear UI of all previous messages.
    				//resetUI();
    				// [END_EXCLUDE]
    			}).catch((err) => {
      				console.log('Unable to retrieve refreshed token ', err);
      				showToken('Unable to retrieve refreshed token ', err);
	  				// alert('Unable to retrieve refreshed token from cloud messaging service '+err);
    			});
  		});
  		// [END refresh_token]

  		// [START receive_message]
  		// Handle incoming messages. Called when:
  		// - a message is received while the app has focus
  		// - the user clicks on an app notification created by a service worker
  		//   `messaging.setBackgroundMessageHandler` handler.
		messaging.onMessage((payload) => {
    		//console.log('Foreground push Message received. ', payload);
    		// [START_EXCLUDE]
    		// Update the UI to include the received message.
    		//appendMessage(payload);
    		//alert(payload.notification.click_action);

 			const notification_foreground = payload.notification;
 			// Customize notification here
 			const notificationTitle = notification_foreground.title;

 			const notificationOptions = {
    			body: notification_foreground.body,
    			icon: notification_foreground.icon,
				image: notification_foreground.image,
    			data: {
            		url: notification_foreground.click_action
    			},
  				tag: 'renotify',
  				renotify: true	 
  			};
  			var notificationclickurl = payload.notification.click_action;

    		if (!("Notification" in window)) {
        		console.log("This browser does not support system notifications");
    		}
    		// Let's check whether notification permissions have already been granted
    		else
			{
      			if (Notification.permission === "granted") {
        			// If it's okay let's create a notification
        			try {
           				//console.log(notification_foreground.click_action);
          				var notification = new Notification(notificationTitle, {
                                body: notification_foreground.body,
                                icon: notification_foreground.icon,
								image: notification_foreground.image,
                                data: {
                                    url: notification_foreground.click_action
                                }
                            });
          				notification.onclick = function(event) {
              				event.preventDefault(); //prevent the browser from focusing the Notification's tab
              				window.open(notificationclickurl, '_blank');
              				notification.close();
          				}
        			} catch (err) {
          				try { //Need this part as on Android we can only display notifications thru the serviceworker
							if ('serviceWorker' in navigator) {
								navigator.serviceWorker.register(homeurl+'/pnfpb_icpush_pwa_sw.js',{scope:homeurl+'/'}).then(function(registration) {
     							 registration.showNotification(notificationTitle, notificationOptions);
    							}).catch(function(err) {
        							console.log("Service Worker Failed to Register foreground notification", err);
    							})
				
  							}
							else
							{
								console.log('service workers not supported in this browser !!!');
							}
            
          			} catch (err1) {
            			console.log(err1.message);
          			}
        		}
      		}
    	}
    	// [END_EXCLUDE]
		})
	}
 	else
	{
		console.log('This browser does not support PUSHAPI Firebase messaging!!!')
	}
    if( $j(".pnfpb_subscribe_button").length )
    {
		navigator.serviceWorker.ready.then(function (registration) {		
	        // [START get_messaging_object]
            // Retrieve Firebase Messaging object.
            // [END get_messaging_object]
            // [START set_public_vapid_key]
            // Add the public key generated from the console here.
            // [END set_public_vapid_key]

			var subscriptionoptions = '00001';
			var subscribeallshortcode = '0';
			var subscribepostactivitiesshortcode = '0';
			var subscribeallcommentsshortcode = '0';
			var subscribemypostshortcode = '0';
			var unsubscribeallshortcode = '0';
			
		    $j(".pnfpb_subscribe_button").on( "click", function(event) {
				
				event.preventDefault();
		        
                if (Notification.permission === 'granted') {
                            
                        messaging.getToken({serviceWorkerRegistration: registration, vapidKey:pnfpb_ajax_object_push.publicKey }).then((currentToken) => 
						{
							
 					        $j(".pnfpb-subscribe-notifications").show();
							
							if ($j('#pnfpb_ic_subscribe_all_shortcode_enable').is(":checked"))
							{
  								subscribeallshortcode = '1';
							}
							else 
							{
								subscribeallshortcode = '0';
							}
							
							if ($j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').is(":checked"))
							{
  								subscribepostactivitiesshortcode = '1';
							}
							else 
							{
								subscribepostactivitiesshortcode = '0';
							}
							
							if ($j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').is(":checked"))
							{
  								subscribeallcommentsshortcode = '1';
							}
							else 
							{
								subscribeallcommentsshortcode = '0';
							}							
							
							if ($j('#pnfpb_ic_subscribe_my_post_shortcode_enable').is(":checked") && pnfpb_ajax_object_push.isloggedin === 1)
							{
								$j('.pnfpb_ic_subscribe_my_post_shortcode_label_checkbox').html("Subscribe notifications on comments from my Posts/my BuddyPress activities");
								$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('disabled',false);								
  								subscribemypostshortcode = '1';
							}
							else 
							{
								subscribemypostshortcode = '0';
								if (pnfpb_ajax_object_push.isloggedin != 1) {
									$j('.pnfpb_ic_subscribe_my_post_shortcode_label_checkbox').html("Login required to subscribe notifications on comments from my Posts/my BuddyPress activities");
									$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('disabled',true);
								}
								else 
								{
									$j('.pnfpb_ic_subscribe_my_post_shortcode_label_checkbox').html("Subscribe notifications on comments from my Posts/my BuddyPress activities");
									$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('disabled',false);										
								}
							}
							
							if ($j('#pnfpb_ic_unsubscribe_all_shortcode_enable').is(":checked"))
							{
  								unsubscribeallshortcode = '1';
							}
							else 
							{
								unsubscribeallshortcode = '0';
							}
							
							if ($j('#pnfpb_ic_subscribe_all_shortcode_enable').on('click',function() {
								
								if ($j('#pnfpb_ic_subscribe_all_shortcode_enable').is(":checked"))
								{
  									subscribeallshortcode = '1';
									subscribemypostshortcode = '0';
									subscribeallcommentsshortcode = '0';
									subscribepostactivitiesshortcode = '0'; 
									unsubscribeallshortcode = '0';	
									
									$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
									
								}
								else 
								{
									subscribeallshortcode = '0';
								}								
							}));
								
							if ($j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').on('click',function() {
								
								if ($j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').is(":checked"))
								{
  									subscribepostactivitiesshortcode = '1';
									subscribeallshortcode = '0'; 
									unsubscribeallshortcode = '0';	
									
									$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
									$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);									
								}
								else 
								{
									subscribepostactivitiesshortcode = '0';
								}								
							}))	;
							
							if ($j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').on('click',function() {
								
								if ($j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').is(":checked"))
								{
  									subscribeallcommentsshortcode = '1';
									subscribemypostshortcode = '0';
									subscribeallshortcode = '0'; 
									unsubscribeallshortcode = '0';
									
									$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);									
									$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
									$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
								}
								else 
								{
									subscribeallcommentsshortcode = '0';
								}								
							}));
							
							if ($j('#pnfpb_ic_subscribe_my_post_shortcode_enable').on('click',function() {
								
								if ($j('#pnfpb_ic_subscribe_my_post_shortcode_enable').is(":checked"))
								{
  									subscribemypostshortcode = '1';
									subscribeallcommentsshortcode = '0';
									subscribeallshortcode = '0'; 
									unsubscribeallshortcode = '0';
									
									$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
									$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
								}
								else 
								{
									subscribemypostshortcode = '0';
								}								
							}));
							
							if ($j('#pnfpb_ic_unsubscribe_all_shortcode_enable').on('click',function() {
								
								if ($j('#pnfpb_ic_unsubscribe_all_shortcode_enable').is(":checked"))
								{
  									unsubscribeallshortcode = '1';
									subscribemypostshortcode = '0';
									subscribeallcommentsshortcode = '0';
									subscribepostactivitiesshortcode = '0'; 
									subscribeallshortcode = '0';
									
									$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);									
								}
								else 
								{
									unsubscribeallshortcode = '0';
								}								
							}));							
							
							
								var pnfpb_subscribe_button_text = pnfpb_ajax_object_push.save_button_text;
								var pnfpb_cancel_button_text = pnfpb_ajax_object_push.cancel_button_text;
								var pnfpb_subscribe_text_confirm = pnfpb_ajax_object_push.subscribe_dialog_text_confirm;
							    var pnfpb_unsubscribe_text_confirm = pnfpb_ajax_object_push.unsubscribe_dialog_text_confirm;

						        $j( "#pnfpb_subscribe_dialog_confirm" ).dialog({  
									resizable: false,
									height: "auto",
    								open: function(event, ui) {
        								$j(".ui-dialog-titlebar-close").hide();
    								},									
									width: 300,									
							        modal: true,
							        buttons: [
									{ 	
										text: pnfpb_cancel_button_text,
	           							open: function() {
											$j(this).attr('style','font-weight:normal;color:#000000;background-color:#dddddd;border:0px');
            							},
            							click: function() {
											 $j( "#pnfpb_subscribe_dialog_confirm" ).dialog( "close" );
									}},
							        {
            							text: pnfpb_subscribe_button_text,
	           							open: function() {
											$j(this).attr('style','font-weight:bold;color:'+pnfpb_ajax_object_push.subscribe_button_text_color+';background-color:'+pnfpb_ajax_object_push.subscribe_button_color+';border:0px');
            							},
            							click: function() {
											subscriptionoptions = subscribeallshortcode + subscribepostactivitiesshortcode + subscribeallcommentsshortcode + subscribemypostshortcode + unsubscribeallshortcode;
									        if (currentToken) {
							   
										        deviceid = currentToken;
							
										        var data = {
											        action: 'icpushcallback',
											        device_id:deviceid,
													subscriptionoptions:subscriptionoptions,
											        pushtype: 'subscribe-button'
										        };
								
										        $j.post(pnfpb_ajax_object_push.ajax_url, data, function(responseajax) {

														var response = JSON.parse(responseajax);
													
														subscriptionoptions = response.subscriptionoptions;
													
														var subscriptionoptionsarray = subscriptionoptions.split('');
														
														if (subscriptionoptionsarray.length >= 5)
														{

															if (subscriptionoptionsarray[0] === '1')
															{
  																$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked', true);
																$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked',false);
																$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
																$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);
	
															}
															else 
															{
																$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked', false);
															}
							
															if (subscriptionoptionsarray[1] === '1')
															{
  																$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked', true);
																$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
																$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
															}
															else 
															{
																$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked', false);
															}
							
															if (subscriptionoptionsarray[2] === '1')
															{
  																$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked', true);
																$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
																$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
															}
															else 
															{
																$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked', false);
															}
							
															if (subscriptionoptionsarray[3] === '1')
															{
  																$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked', true);
																$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
																$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
															}
															else 
															{
																$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked', false);
															}							

															if (subscriptionoptionsarray[4] === '1')
															{
  																$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked', true);
																$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);
																$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked',false);
																$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
																$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);
															}
															else 
															{
																$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked', false);
															}
														}
									        
			                                            if (response.subscriptionstatus != 'fail')
			                                            {
    	                                                    if (response.subscriptionstatus != 'duplicate'){
    	                                                        
				                                                    navigator.serviceWorker.ready.then(function (registration) {
                                                                        registration.pushManager.getSubscription().then(function (subscription) {
                                                                            if (!subscription) 
				                                                            {				                                                        
				                                                        
				   		                                                        registration.pushManager.subscribe({
                			                                                        userVisibleOnly: true,
                			                                                        applicationServerKey: urlBase64ToUint8Array(pnfpb_ajax_object_push.publicKey)
            	   		                                                        }).then(function (subscription) {

                                                                            
                                                                                    if( $j(".pnfpb_subscribe_button").length )
                                                                                    {
                                                                                    $j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.unsubscribe_button_text);
                                                                                    }			       			                                                
			       			                                                
			       			                                                        $j(".pnfpb-unsubscribe-alert-msg").html("<p>"+pnfpb_unsubscribe_text_confirm+"</p>");
			       			                                                
			       			                                                        $j( "#pnfpb-unsubscribe-dialog" ).dialog();
			       			                                                
            			                                                        }).catch(function () {

                                                                            
                                                                                    if( $j(".pnfpb_subscribe_button").length )
                                                                                    {
                                                                                        $j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text);
                                                                                    }			       			                                                

						
													                                $j(".pnfpb-unsubscribe-alert-msg").html("<p>cloud messaging push notification - device update failed</p>");
													                        
													                                $j( "#pnfpb-unsubscribe-dialog" ).dialog();

            			                                                        });
            			                                                        
				                                                            }
				                                                            else
				                                                            {
				                                                                
                                                                            
                                                                                if( $j(".pnfpb_subscribe_button").length )
                                                                                {
                                                                                        $j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.unsubscribe_button_text);
                                                                                }			       			                                                
			       			                                                	if (subscriptionoptionsarray[4] === '1' || subscriptionoptions === '00000' || subscriptionoptions === '' || subscriptionoptions === null) 
																				{
																					$j(".pnfpb-unsubscribe-alert-msg").html("<p>"+pnfpb_unsubscribe_text_confirm+"</p>");
																					if( $j(".pnfpb_subscribe_button").length )
                                                                                	{
                                                                                   $j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text);
                                                                                 	}
																				}
																				else 
																				{
			       			                                                     	$j(".pnfpb-unsubscribe-alert-msg").html("<p>"+pnfpb_subscribe_text_confirm+"</p>");
																				}
			       			                                                
			       			                                                    $j( "#pnfpb-unsubscribe-dialog" ).dialog();
				                                                            }
				                                                            
                                                                        });
                                                                        
				                                                    });
				    
			                                                    }
			                                                    else
			                                                    {
			           
                                                                            
                                                                    if( $j(".pnfpb_subscribe_button").length )
                                                                    {
                                                                       $j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.unsubscribe_button_text);
                                                                    }			       			                                                


			                                                        console.log("Already subscribed...device id already exists...not updated");
			                                                    }

			                                            }
			                                            else
			                                            {

                                                                            
                                                            if( $j(".pnfpb_subscribe_button").length )
                                                            {
                                                                $j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.unsubscribe_button_text);
                                                            }
                                                            
                                                            $j(".pnfpb-unsubscribe-alert-msg").html("<p>Push notification subscription failed..try again!!</p>");
                                                            
                                                            $j( "#pnfpb-unsubscribe-dialog" ).dialog();

			                                                console.log("device update failed");
			                                            }
							
										        });
							
									        }									
										    $j( "#pnfpb_subscribe_dialog_confirm" ).dialog( "close" );
								        },
							        }]
    						    });
    						    
    						    $j('#pnfpb_subscribe_dialog_confirm').on('dialogclose', function(event) {
                                    $j(".pnfpb-unsubscribe-alert-msg").html("");
                                    $j(".pnfpb-subscribe-alert-msg").html("");
                                });
						
                        });
                        
                   }
                   else
                   {
							
						$j(".pnfpb-unsubscribe-alert-msg").html("<p>UnSubscribe failed..try again or Subscribe again..Please!! </p>");
							
						$j( "#pnfpb-unsubscribe-dialog" ).dialog();                        
                 }
                    
				//})
				    
		    })
		})
        }
	}).catch(function(error) {
    	console.log('FCM Push notification Service worker registration failed: '+error);
		
	})
} else {
  console.log('Service workers are not supported.');
}

  // [END receive_message]
  
  // Send the Instance ID token your application server, so that it can:
  // - send messages back to this app
  // - subscribe/unsubscribe the token from topics
function sendTokenToServer(currentToken) {
    if (!isTokenSentToServer()) {
      console.log('Sending token to server...');
      // TODO(developer): Send the current token to your server.
      setTokenSentToServer(true);
    } else {
      console.log('Token already sent to server so won\'t send it again ' +
          'unless it changes');
    }

  }

function isTokenSentToServer() {
    return window.localStorage.getItem('sentToServer') === '1';
  }

function setTokenSentToServer(sent) {
    window.localStorage.setItem('sentToServer', sent ? '1' : '0');
  }
  
function urlBase64ToUint8Array(base64String) {
  const padding = '='.repeat((4 - base64String.length % 4) % 4);
  const base64 = (base64String + padding)
    .replace(/\-/g, '+')
    .replace(/_/g, '/')
  ;
  const rawData = window.atob(base64);
  return Uint8Array.from([...rawData].map((char) => char.charCodeAt(0)));
}


async function requestPermission(registration) {

    Notification.requestPermission().then((permission) => {
      if (permission === 'granted') {
           messaging.getToken({serviceWorkerRegistration: registration, vapidKey:pnfpb_ajax_object_push.publicKey }).then((currentToken) => {
      if (currentToken) {
        sendTokenToServer(currentToken);
      	deviceid = currentToken;
		var pnfpbshortcodeactive = 'no';
		var isadminpage = 'no';
		if (window.location.href.match('wp-admin') !== null) {
			isadminpage = 'yes';
		}		  
        if( $j(".pnfpb_subscribe_button").length )
        {
			pnfpbshortcodeactive = 'yes';
		}
		var data = {
			action: 'icpushcallback',
			device_id:deviceid,
			isadminpage:isadminpage,
			pnfpbshortcodeactive:pnfpbshortcodeactive,
			pushtype:'normal'
		};
		$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
			   if (response != 'fail')
			   {
			            if (response != 'duplicate'){
			                
				            navigator.serviceWorker.ready.then(function (registration) {
				   		            registration.pushManager.subscribe({
                			            userVisibleOnly: true,
                			            applicationServerKey: urlBase64ToUint8Array(pnfpb_ajax_object_push.publicKey)
            	   		            }).then(function (subscription) {
			       			            $j("#ic-notification-button").hide();
			       			            
                                        if( $j(".pnfpb_subscribe_button").length )
                                        {
                                            $j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.unsubscribe_button_text);
                                        }			           
                                        
            			            }).catch(function () {
                			            console.log("cloud messaging push notification - device update failed");
            			            });
				            });
				    
			            }
			            else
			            {

                            if( $j(".pnfpb_subscribe_button").length )
                            {
                                $j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.unsubscribe_button_text);
                            }			           
			           
			                console.log("Already subscribed...device id already exists...not updated");
			            }

			   }
			   else
			   {

			       console.log("device update failed");
			   }			
		});

      } else {
        // Show permission request.
        console.log('No Instance ID token available. Request permission to generate one.');
        // Show permission UI.
        setTokenSentToServer(false);
      }
    }).catch((err) => {
      console.log('An error occurred while retrieving token. ', err);
      setTokenSentToServer(false);
    });
       
        // TODO(developer): Retrieve an Instance ID token for use with FCM.
        // [START_EXCLUDE]
        // In many cases once an app has been granted notification permission,
        // it should update its UI reflecting this.
        // [END_EXCLUDE]
      } else {
        console.log('Unable to get permission to notify.');
      }
    });
    // [END request_permission]
  }
  
 
  

        
    async function checkdeviceid(registration) {
        if (Notification.permission === 'granted') {
                messaging.getToken({serviceWorkerRegistration: registration, vapidKey:pnfpb_ajax_object_push.publicKey }).then((currentToken) => {
					var subscriptionoptions = '00000';
					var subscriptionoptionsarray = subscriptionoptions.split('');
					
					var pnfpbshortcodeactive = 'no';
					var isadminpage = 'no';
					if (window.location.href.match('wp-admin') !== null) {
						isadminpage = 'yes';
					}
        			if( $j(".pnfpb_subscribe_button").length )
        			{
						pnfpbshortcodeactive = 'yes';
					}					
					if (currentToken) {
							   
						deviceid = currentToken;
							
						var data = {
							action: 'icpushcallback',
							device_id:deviceid,
							isadminpage:isadminpage,
							pnfpbshortcodeactive:pnfpbshortcodeactive,
							pushtype: 'checkdeviceid'
					    };
								
						$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
							
							var responseobject = JSON.parse(response);	

							subscriptionoptions = responseobject.subscriptionoptions;
							
							subscriptionoptionsarray = subscriptionoptions.split('');

							if (subscriptionoptionsarray[0] === '1')
							{
  								$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked', true);
							}
							else 
							{
								$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked', false);
							}
							
							if (subscriptionoptionsarray[1] === '1')
							{
  								$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked', true);
							}
							else 
							{
								$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked', false);
							}
							
							if (subscriptionoptionsarray[2] === '1')
							{
  								$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked', true);
							}
							else 
							{
								$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked', false);
							}
							
							if (subscriptionoptionsarray[3] === '1')
							{
  								$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked', true);
							}
							else 
							{
								$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked', false);
							}							

							if (subscriptionoptionsarray[4] === '1')
							{
  								$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked', true);
							}
							else 
							{
								$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked', false);
							}							
							
										        
			                if (responseobject.subscriptionstatus == 'subscribed')
			                {
 					
                                if( $j(".pnfpb_subscribe_button").length )
                                {
	                                $j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.unsubscribe_button_text);
                                }			                             
			                }
			                else
			                {
 					
                                if( $j(".pnfpb_subscribe_button").length )
                                {
	                                $j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text);
                                }			                    
			                }

							
						});
							
					}
    			});
          }			    
        
    }
	
}
	
 async function mobileapp_subscribe_shortcode() {
    if( $j(".pnfpb_subscribe_button").length  && pnfpb_pushtoken_fromflutter !== '')
    {
	        // [START get_messaging_object]
            // Retrieve Firebase Messaging object.
            // [END get_messaging_object]
            // [START set_public_vapid_key]
            // Add the public key generated from the console here.
            // [END set_public_vapid_key]


			var subscriptionoptions = '00000';
			var subscriptionoptionsarray = subscriptionoptions.split('');
					
			var pnfpbshortcodeactive = 'no';
			var isadminpage = 'no';
			if (window.location.href.match('wp-admin') !== null) {
				isadminpage = 'yes';
			}
        	if( $j(".pnfpb_subscribe_button").length )
        	{
				pnfpbshortcodeactive = 'yes';
			}					
			if (pnfpb_pushtoken_fromflutter) {
							   
				deviceid = pnfpb_pushtoken_fromflutter;
							
				var data = {
					action: 'icpushcallback',
					device_id:deviceid,
					isadminpage:isadminpage,
					pnfpbshortcodeactive:pnfpbshortcodeactive,
					pushtype: 'checkdeviceid'
				};
								
				$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
							
				var responseobject = JSON.parse(response);	

				subscriptionoptions = responseobject.subscriptionoptions;
							
				subscriptionoptionsarray = subscriptionoptions.split('');

				if (subscriptionoptionsarray[0] === '1')
				{
  								$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked', true);
				}
				else 
				{
								$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked', false);
				}
							
				if (subscriptionoptionsarray[1] === '1')
				{
  								$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked', true);
				}
				else 
				{
								$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked', false);
				}
							
				if (subscriptionoptionsarray[2] === '1')
				{
  								$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked', true);
				}
				else 
				{
								$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked', false);
				}
							
				if (subscriptionoptionsarray[3] === '1')
				{
  								$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked', true);
				}
				else 
				{
								$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked', false);
				}							

				if (subscriptionoptionsarray[4] === '1')
				{
  								$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked', true);
				}
				else 
				{
								$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked', false);
				}							
							
										        
			    if (responseobject.subscriptionstatus == 'subscribed')
			    {
 					
                     if( $j(".pnfpb_subscribe_button").length )
                     {
	                                $j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.unsubscribe_button_text);
                     }			                             
			    }
			    else
			    {
 					
                    if( $j(".pnfpb_subscribe_button").length )
                    {
	                                $j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text);
                     }			                    
			    }

							
			});
							
		}
		
	
		var subscriptionoptions = '00000';
		var subscribeallshortcode = '0';
		var subscribepostactivitiesshortcode = '0';
		var subscribeallcommentsshortcode = '0';
		var subscribemypostshortcode = '0';
		var unsubscribeallshortcode = '0';
		
		$j(".pnfpb_subscribe_button").on( "click", function(event) {
				
			event.preventDefault();
		        
							
 			$j(".pnfpb-subscribe-notifications").show();
							
			if ($j('#pnfpb_ic_subscribe_all_shortcode_enable').is(":checked"))
			{
  				subscribeallshortcode = '1';
			}
			else 
			{
				subscribeallshortcode = '0';
			}
							
			if ($j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').is(":checked"))
			{
  				subscribepostactivitiesshortcode = '1';
			}
			else 
			{
				subscribepostactivitiesshortcode = '0';
			}
							
			if ($j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').is(":checked"))
			{
  				subscribeallcommentsshortcode = '1';
			}
			else 
			{
				subscribeallcommentsshortcode = '0';
			}							
							
			if ($j('#pnfpb_ic_subscribe_my_post_shortcode_enable').is(":checked") && pnfpb_ajax_object_push.isloggedin === 1)
			{
					$j('.pnfpb_ic_subscribe_my_post_shortcode_label_checkbox').html("Subscribe notifications on comments from my Posts/my BuddyPress activities");
					$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('disabled',false);								
  				subscribemypostshortcode = '1';
			}
			else 
			{
				subscribemypostshortcode = '0';
				if (pnfpb_ajax_object_push.isloggedin != 1) {
						$j('.pnfpb_ic_subscribe_my_post_shortcode_label_checkbox').html("Login required to subscribe notifications on comments from my Posts/my BuddyPress activities");
						$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('disabled',true);
				}
				else 
				{
						$j('.pnfpb_ic_subscribe_my_post_shortcode_label_checkbox').html("Subscribe notifications on comments from my Posts/my BuddyPress activities");
						$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('disabled',false);										
				}
			}
							
			if ($j('#pnfpb_ic_unsubscribe_all_shortcode_enable').is(":checked"))
			{
  				unsubscribeallshortcode = '1';
			}
			else 
			{
				unsubscribeallshortcode = '0';
			}
							
			if ($j('#pnfpb_ic_subscribe_all_shortcode_enable').on('click',function() {
								
				if ($j('#pnfpb_ic_subscribe_all_shortcode_enable').is(":checked"))
				{
  						subscribeallshortcode = '1';
						subscribemypostshortcode = '0';
						subscribeallcommentsshortcode = '0';
						subscribepostactivitiesshortcode = '0'; 
						unsubscribeallshortcode = '0';	
									
						$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked',false);
						$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
						$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);
						$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
									
				}
				else 
				{
					subscribeallshortcode = '0';
				}								
			}));
								
			if ($j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').on('click',function() {
								
				if ($j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').is(":checked"))
				{
  					subscribepostactivitiesshortcode = '1';
					subscribeallshortcode = '0'; 
					unsubscribeallshortcode = '0';	
						
						$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
						$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);									
				}
				else 
				{
					subscribepostactivitiesshortcode = '0';
				}								
			}))	;
							
			if ($j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').on('click',function() {
								
				if ($j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').is(":checked"))
				{
  					subscribeallcommentsshortcode = '1';
					subscribemypostshortcode = '0';
					subscribeallshortcode = '0'; 
					unsubscribeallshortcode = '0';
								
						$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);									
						$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
						$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
							
				}
				else 
				{
					subscribeallcommentsshortcode = '0';
				}								
			}));
							
			if ($j('#pnfpb_ic_subscribe_my_post_shortcode_enable').on('click',function() {
								
					if ($j('#pnfpb_ic_subscribe_my_post_shortcode_enable').is(":checked"))
					{
  							subscribemypostshortcode = '1';
							subscribeallcommentsshortcode = '0';
							subscribeallshortcode = '0'; 
							unsubscribeallshortcode = '0';
									
							$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
							$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
							$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
					}
					else 
					{
						subscribemypostshortcode = '0';
					}								
			}));
							
			if ($j('#pnfpb_ic_unsubscribe_all_shortcode_enable').on('click',function() {
								
				if ($j('#pnfpb_ic_unsubscribe_all_shortcode_enable').is(":checked"))
				{
  						unsubscribeallshortcode = '1';
						subscribemypostshortcode = '0';
						subscribeallcommentsshortcode = '0';
						subscribepostactivitiesshortcode = '0'; 
						subscribeallshortcode = '0';
									
						$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);
						$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked',false);
						$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
						$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);									
				}
				else 
				{
					unsubscribeallshortcode = '0';
				}								
			}));							
							
							
				var pnfpb_subscribe_button_text = pnfpb_ajax_object_push.save_button_text;
				var pnfpb_cancel_button_text = pnfpb_ajax_object_push.cancel_button_text;
				var pnfpb_subscribe_text_confirm = pnfpb_ajax_object_push.subscribe_dialog_text_confirm;
				var pnfpb_unsubscribe_text_confirm = pnfpb_ajax_object_push.unsubscribe_dialog_text_confirm;

				$j( "#pnfpb_subscribe_dialog_confirm" ).dialog({  
					resizable: false,
					height: "auto",
    				open: function(event, ui) {
        				$j(".ui-dialog-titlebar-close").hide();
    				},									
					width: 300,									
					modal: true,
					buttons: [
						{ 	
							text: pnfpb_cancel_button_text,
	           				open: function() {
								$j(this).attr('style','font-weight:normal;color:#000000;background-color:#dddddd;border:0px');
            				},
            				click: function() {
								 $j( "#pnfpb_subscribe_dialog_confirm" ).dialog( "close" );
							}},
							{
            					text: pnfpb_subscribe_button_text,
	           					open: function() {
									$j(this).attr('style','font-weight:bold;color:'+pnfpb_ajax_object_push.subscribe_button_text_color+';background-color:'+pnfpb_ajax_object_push.subscribe_button_color+';border:0px');
            					},
            					click: function() {
									
									subscriptionoptions = subscribeallshortcode + subscribepostactivitiesshortcode + subscribeallcommentsshortcode + subscribemypostshortcode + unsubscribeallshortcode;
									
								    if (pnfpb_pushtoken_fromflutter) {
										
							   	        deviceid = pnfpb_pushtoken_fromflutter;
							
								        var data = {
									        action: 'icpushcallback',
									        device_id:deviceid,
											subscriptionoptions:subscriptionoptions,
									        pushtype: 'subscribe-button'
								        };
								
								        $j.post(pnfpb_ajax_object_push.ajax_url, data, function(responseajax) {

										var response = JSON.parse(responseajax);
													
										subscriptionoptions = response.subscriptionoptions;
													
										var subscriptionoptionsarray = subscriptionoptions.split('');
														
										if (subscriptionoptionsarray.length >= 5)
										{

											if (subscriptionoptionsarray[0] === '1')
											{
  												$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked', true);
												$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked',false);
												$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
												$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);
	
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked', false);
											}
							
											if (subscriptionoptionsarray[1] === '1')
											{
  												$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked', true);
												$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
												$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked', false);
											}
							
											if (subscriptionoptionsarray[2] === '1')
											{
  												$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked', true);
												$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
												$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked', false);
											}
							
											if (subscriptionoptionsarray[3] === '1')
											{
  												$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked', true);
												$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
												$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked', false);
											}							

											if (subscriptionoptionsarray[4] === '1')
											{
  												$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked', true);
												$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);
												$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked',false);
												$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
												$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);
											}
											else 
											{
												$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked', false);
											}
										}
									        

							
										 });
							
									     }									
										 $j( "#pnfpb_subscribe_dialog_confirm" ).dialog( "close" );
								        },
							        }]
    						    });
    						    
    						    $j('#pnfpb_subscribe_dialog_confirm').on('dialogclose', function(event) {
                                    $j(".pnfpb-unsubscribe-alert-msg").html("");
                                    $j(".pnfpb-subscribe-alert-msg").html("");
                                });
				    
		    })

        }	 
	 
 }
	
  if (pnfpb_ajax_object_push.pwainstallpromptenabled === 
   '1') {
	var deferredPrompt;
	let PNFPBcustominstallprompt = getCookie("PNFPB_pwa_prompt");		 
	if (!PNFPBcustominstallprompt) {  
		window.addEventListener('beforeinstallprompt', (e) => {
			e.preventDefault();
			deferredPrompt = e;
			if (pnfpb_ajax_object_push.pwacustominstalltype === '2') {
				// Get the snackbar DIV
				$j('#pnfpbsnackbar').attr('style','color:'+pnfpb_ajax_object_push.pwainstallbuttontextcolor+';background-color:'+pnfpb_ajax_object_push.pwainstallbuttoncolor+';');
				$j('#pnfpbsnackbarlink').attr('style','color:'+pnfpb_ajax_object_push.pwainstallbuttontextcolor+';background-color:'+pnfpb_ajax_object_push.pwainstallbuttoncolor+';');
				$j('.pnfpbclose').toggleClass('.pnfpbclosebefore');
				$j('.pnfpbclosebefore').attr('style','background-color:'+pnfpb_ajax_object_push.pwainstallbuttontextcolor+';');
				$j('.pnfpbclose').toggleClass('.pnfpbcloseafter');
				$j('.pnfpbcloseafter').attr('style','background-color:'+pnfpb_ajax_object_push.pwainstallbuttontextcolor+';');
  				var pnfpbsnackbar = document.getElementById("pnfpbsnackbar");
  				// Add the "show" class to DIV
  				pnfpbsnackbar.className = "show";
				// After 13 seconds, remove the show class from DIV
  				setTimeout(function(){ pnfpbsnackbar.className = pnfpbsnackbar.className.replace("show", ""); }, 12000);				
				$j( "#pnfpbsnackbarlink" ).on("click", function() 
				{
					pnfpbsnackbar.className = pnfpbsnackbar.className.replace("show", "");
					if (deferredPrompt) {
						deferredPrompt.prompt();
						deferredPrompt.userChoice.then((response) => {
							if (response.outcome === 'accepted') {
								deferredPrompt = null;
								document.cookie = "PNFPB_pwa_prompt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";								
							}
    						else {
    							console.log('No thanks, I am good!');
								const d = new Date();
  								d.setTime(d.getTime() + (5*24*60*60*1000));
  								let expires = "expires="+ d.toUTCString();
  								document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
								deferredPrompt = null;
								location.reload();
    						}
						})
					}
				})
				$j( ".pnfpbclose" ).on("click", function() 
				{
					const d = new Date();
  					d.setTime(d.getTime() + (5*24*60*60*1000));
  					let expires = "expires="+ d.toUTCString();
					document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
					pnfpbsnackbar.className = pnfpbsnackbar.className.replace("show", "");					
					
				})
			}
			else 
			{
				var pwaappinstallbutton = pnfpb_ajax_object_push.pwainstallbuttontext;
				$j( "#pnfpb-pwa-dialog-confirm" ).dialog({
					resizable: false,
					open: function(event, ui) {
        				$j(".ui-dialog-titlebar-close").hide();
    				},				
					height: "auto",
					width: 300,
					modal: true,
					buttons: [
					{
            			text: 'Cancel',
	           			open: function() {
							$j(this).attr('style','font-weight:normal;color:#000000;background-color:#ffffff;border:0px');			
            			},
            			click: function() {
							const d = new Date();
  							d.setTime(d.getTime() + (5*24*60*60*1000));
  							let expires = "expires="+ d.toUTCString();
							document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";					
							$j( this ).dialog( "close" );
						}
					},				
					{
            			text: pwaappinstallbutton,
	           			open: function() {
                			$j(this).attr('style','font-weight:bold;color:'+pnfpb_ajax_object_push.pwainstallbuttontextcolor+';background-color:'+pnfpb_ajax_object_push.pwainstallbuttoncolor+';border:0px');
            			},
            			click: function() {
							if (deferredPrompt) {
								deferredPrompt.prompt();
								deferredPrompt.userChoice.then((response) => {
								if (response.outcome === 'accepted') {
									deferredPrompt = null;
									$j( this ).dialog( "close" );
									document.cookie = "PNFPB_pwa_prompt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";								
								}
    							else {
    								console.log('No thanks, I am good!');
									deferredPrompt = null;
									const d = new Date();
  									d.setTime(d.getTime() + (5*24*60*60*1000));
  									let expires = "expires="+ d.toUTCString();
  									document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
									location.reload();
    							}						
								})
							}					
							$j( this ).dialog( "close" );
						}
					}
					]
				})
			}
		});
	}
	
	window.addEventListener('appinstalled', function(evt){
		document.cookie = "PNFPB_pwa_prompt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
		$j( "#pnfpb-pwa-dialog-app-installed" ).dialog({
			resizable: false,
			open: function(event, ui) {
				$j(".ui-dialog-titlebar-close").hide();
    		},			
			height: "auto",
			width: 300,
			modal: true,
			buttons: [
			{
            	text: 'Ok',
	           	open: function() {
                	$j(this).attr('style','font-weight:bold;color:white;background-color:blue;border:0px');
            	},
            	click: function() {			
					$j( this ).dialog( "close" );
				}
			}
			]
		})
	});	
 }
	
function getCookie(cname) {
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
  // END jQuery ready function
});