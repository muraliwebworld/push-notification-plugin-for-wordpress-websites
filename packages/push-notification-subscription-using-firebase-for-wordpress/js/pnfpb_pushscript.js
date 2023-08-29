/**
* Script to send push notification using Firebase
*
* @since 1.0.0
*/
var $j = jQuery.noConflict();
$j(document).ready(function() {

// Your web app's Firebase configuration

var notificationclickurl = '';

var deviceid = '';


var firebaseConfig = {
    apiKey: pnfpb_ajax_object_push.apiKey,
    authDomain: pnfpb_ajax_object_push.authDomain,
    databaseURL: pnfpb_ajax_object_push.databaseURL,
    projectId: pnfpb_ajax_object_push.projectId,
    storageBucket: pnfpb_ajax_object_push.storageBucket,
    messagingSenderId: pnfpb_ajax_object_push.messagingSenderId,
    appId: pnfpb_ajax_object_push.appId
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
//firebase.analytics();

//console.log('subscription');
if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('/pnfpb_icpush_sw.js')
  .then(function(registration) {
    registration.addEventListener('updatefound', function() {
      // If updatefound is fired, it means that there's
      // a new service worker being installed.
      var installingWorker = registration.installing;
    });
  })
  .catch(function(error) {
    console.log('FCM Push notification Service worker registration failed: '+error);
  });
} else {
  console.log('Service workers are not supported.');
}
	
if( $j(".pnfpb_unsubscribe_button").length )
{
    $j(".pnfpb_unsubscribe_button").hide();
}   

if( $j(".pnfpb_subscribe_button").length )
{
	$j(".pnfpb_subscribe_button").show();
}
		
if ('serviceWorker' in navigator && 'PushManager' in window && firebase.messaging.isSupported()) {
    

    navigator.serviceWorker.ready.then(function (registration) {
        //console.log(registration);
        registration.pushManager.getSubscription().then(async function (subscription) {
				//console.log(subscription);
				
        	if (!subscription) 
			{

					await requestPermission();
			}
			else
			{
		
                   await checkdeviceid();   
				    
			}
        });
	
    });
    

}
else
{
	console.log('This browser does not support PUSHAPI Firebase messaging!!!')
}

var messaging = '';
if (firebase.messaging.isSupported()) {

    // [START get_messaging_object]
    // Retrieve Firebase Messaging object.
    messaging = firebase.messaging();
    // [END get_messaging_object]
    // [START set_public_vapid_key]
    // Add the public key generated from the console here.
    messaging.usePublicVapidKey(pnfpb_ajax_object_push.publicKey);
    // [END set_public_vapid_key]

    // IDs of divs that display Instance ID token UI or request permission UI.
    const tokenDivId = 'token_div';
    const permissionDivId = 'permission_div';

    // [START refresh_token]
    // Callback fired if Instance ID token is updated.
    messaging.onTokenRefresh(() => {
    messaging.getToken().then((refreshedToken) => {
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
    else {
      if (Notification.permission === "granted") {
        // If it's okay let's create a notification
        try {
           //console.log(notification_foreground.click_action);
          var notification = new Notification(notificationTitle, {
                                body: notification_foreground.body,
                                icon: notification_foreground.icon,
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
					navigator.serviceWorker.register('/pnfpb_icpush_sw.js').then(function(registration) {
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
  });
}
 else
{
	console.log('This browser does not support PUSHAPI Firebase messaging!!!')
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


function requestPermission() {
    Notification.requestPermission().then((permission) => {
      if (permission === 'granted') {
           messaging.getToken().then((currentToken) => {
      if (currentToken) {
        sendTokenToServer(currentToken);
      	deviceid = currentToken;
      	//console.log(deviceid);
		var data = {
			action: 'icpushcallback',
			device_id:deviceid,
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
			       			            
			       			            if( $j(".pnfpb_unsubscribe_button").length )
                                        {
                                            $j(".pnfpb_unsubscribe_button").show();
                                        }
                                        if( $j(".pnfpb_subscribe_button").length )
                                        {
                                            $j(".pnfpb_subscribe_button").hide();
                                        }			           
                                        
            			            }).catch(function () {
                			            //changePushStatus(false);
			       			            if( $j(".pnfpb_unsubscribe_button").length )
                                        {
                                            $j(".pnfpb_unsubscribe_button").hide();
                                        }
                                        if( $j(".pnfpb_subscribe_button").length )
                                        {
                                            $j(".pnfpb_subscribe_button").show();
                                        }			           

                			            console.log("cloud messaging push notification - device update failed");
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
			           
			                console.log("Already subscribed...device id already exists...not updated");
			            }

			   }
			   else
			   {

		            if( $j(".pnfpb_unsubscribe_button").length )
                    {
                        $j(".pnfpb_unsubscribe_button").hide();
                    }
                    
                    if( $j(".pnfpb_subscribe_button").length )
                    {
                        $j(".pnfpb_subscribe_button").show();
                    }			           

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
  
 
  
    if( $j(".pnfpb_subscribe_button").length )
    {		            
	        // [START get_messaging_object]
            // Retrieve Firebase Messaging object.
            //const messaging = firebase.messaging();
            // [END get_messaging_object]
            // [START set_public_vapid_key]
            // Add the public key generated from the console here.
            //messaging.usePublicVapidKey(pnfpb_ajax_object_unsubscribe_push.publicKey);
            // [END set_public_vapid_key]
		    $j(".pnfpb_subscribe_button").on( "click", function() {
		        
    			//Notification.requestPermission().then((permission) => {
				            
                if (Notification.permission === 'granted') {
                            
                        messaging.getToken().then((currentToken) => {
                            
                            //console.log(currentToken);
                                
 					            $j(".pnfpb-subscribe-notifications").show();

						        $j( "#pnfpb_subscribe_dialog_confirm" ).dialog({  
							        resizable: false,
							        modal: true,
							        buttons: {
								        "Subscribe": function() {
									        if (currentToken) {
							   
										        deviceid = currentToken;
										        //console.log(deviceid);
							
										        var data = {
											        action: 'icpushcallback',
											        device_id:deviceid,
											        pushtype: 'subscribe-button'
										        };
								
										        $j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
										            
										                console.log(response);
										        
			                                            if (response != 'fail')
			                                            {
    	                                                    if (response != 'duplicate'){
    	                                                        
				                                                    navigator.serviceWorker.ready.then(function (registration) {
                                                                        registration.pushManager.getSubscription().then(function (subscription) {
                                                                            if (!subscription) 
				                                                            {				                                                        
				                                                        
				   		                                                        registration.pushManager.subscribe({
                			                                                        userVisibleOnly: true,
                			                                                        applicationServerKey: urlBase64ToUint8Array(pnfpb_ajax_object_push.publicKey)
            	   		                                                        }).then(function (subscription) {

			       			                                                        if( $j(".pnfpb_unsubscribe_button").length )
                                                                                    {
                                                                                        $j(".pnfpb_unsubscribe_button").show();
                                                                                    }
                                                                            
                                                                                    if( $j(".pnfpb_subscribe_button").length )
                                                                                    {
                                                                                        $j(".pnfpb_subscribe_button").hide();
                                                                                    }			       			                                                
			       			                                                
			       			                                                        $j(".pnfpb-unsubscribe-alert-msg").html("<p>Your device is subscribed for push notifications.</p>");
			       			                                                
			       			                                                        $j( "#pnfpb-unsubscribe-dialog" ).dialog();
			       			                                                
            			                                                        }).catch(function () {
                			                                                    //changePushStatus(false);

			       			                                                        if( $j(".pnfpb_unsubscribe_button").length )
                                                                                    {
                                                                                        $j(".pnfpb_unsubscribe_button").hide();
                                                                                    }
                                                                            
                                                                                    if( $j(".pnfpb_subscribe_button").length )
                                                                                    {
                                                                                        $j(".pnfpb_subscribe_button").show();
                                                                                    }			       			                                                

						
													                                $j(".pnfpb-unsubscribe-alert-msg").html("<p>cloud messaging push notification - device update failed</p>");
													                        
													                                $j( "#pnfpb-unsubscribe-dialog" ).dialog();

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
			       			                                                
			       			                                                        $j(".pnfpb-unsubscribe-alert-msg").html("<p>Your device is subscribed for push notifications.</p>");
			       			                                                
			       			                                                        $j( "#pnfpb-unsubscribe-dialog" ).dialog();
				                                                            }
				                                                            
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


			                                                        console.log("Already subscribed...device id already exists...not updated");
			                                                    }

			                                            }
			                                            else
			                                            {

			       			                               if( $j(".pnfpb_unsubscribe_button").length )
                                                            {
                                                                $j(".pnfpb_unsubscribe_button").hide();
                                                            }
                                                                            
                                                            if( $j(".pnfpb_subscribe_button").length )
                                                            {
                                                                $j(".pnfpb_subscribe_button").show();
                                                            }
                                                            
                                                            $j(".pnfpb-unsubscribe-alert-msg").html("<p>Push notification subscription failed..try again!!</p>");
                                                            
                                                            $j( "#pnfpb-unsubscribe-dialog" ).dialog();

			                                                console.log("device update failed");
			                                            }
							
										        });
							
									        }									
										    $j( this ).dialog( "close" );
								        },
								        Cancel: function() {
									        $j( this ).dialog( "close" );
								        }
							        }
    						    });
    						    
    						    $j('#pnfpb_subscribe_dialog_confirm').on('dialogclose', function(event) {
                                    $j(".pnfpb-unsubscribe-alert-msg").html("");
                                    $j(".pnfpb-subscribe-alert-msg").html("");
                                });
						
                        });
                        
                   }
                   else
                   {
						//console.log(e);
							
						$j(".pnfpb-unsubscribe-alert-msg").html("<p>UnSubscribe failed..try again or Subscribe again..Please!! </p>");
							
						$j( "#pnfpb-unsubscribe-dialog" ).dialog();                        
                 }
                    
				//})
				    
		    });
        }
        
    function checkdeviceid() {
        
    	//Notification.requestPermission().then((permission) => {
				            
        if (Notification.permission === 'granted') {
                            
                messaging.getToken().then((currentToken) => {

					if (currentToken) {
							   
						deviceid = currentToken;
						//console.log(deviceid);
							
						var data = {
							action: 'icpushcallback',
							device_id:deviceid,
							pushtype: 'checkdeviceid'
					    };
								
						$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
										            
							//console.log(response);
										        
			                if (response == 'subscribed')
			                {
                                if( $j(".pnfpb_unsubscribe_button").length )
                                {
	                                $j(".pnfpb_unsubscribe_button").show();
                                }
					
                                if( $j(".pnfpb_subscribe_button").length )
                                {
	                                $j(".pnfpb_subscribe_button").hide();
                                }			                             
			                }
			                else
			                {
                                if( $j(".pnfpb_unsubscribe_button").length )
                                {
	                                $j(".pnfpb_unsubscribe_button").hide();
                                }
					
                                if( $j(".pnfpb_subscribe_button").length )
                                {
	                                $j(".pnfpb_subscribe_button").show();
                                }			                    
			                }

							
						});
							
					}
    			});
          }			    
        //});

    }
  
  // END jQuery ready function
});