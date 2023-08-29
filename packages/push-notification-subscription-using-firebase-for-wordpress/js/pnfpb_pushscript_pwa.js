//
//Script to send push notification using Firebase
//
//@since 1.0.0
//
import { initializeApp, getApp } from 'firebase/app';
import { getMessaging, getToken, onMessage, isSupported, deleteToken } from "firebase/messaging";

import $ from "jquery";

import 'jquery-ui-dist/jquery-ui';


var $j = $.noConflict();


var frontendsubscriptionOptions;

if (window.webkit && window.webkit.messageHandlers && window.webkit.messageHandlers.pnfpbuserid) {
       window.webkit.messageHandlers.pnfpbuserid.postMessage({
                     "message": pnfpb_ajax_object_push.userid
       });
}

var pnfpbuserid;

var deviceid = '100000000000';

var vapidKey = '';



/*var firebaseConfig = {
    apiKey: pnfpb_ajax_object_push.apiKey,
    authDomain: pnfpb_ajax_object_push.authDomain,
    databaseURL: pnfpb_ajax_object_push.databaseURL,
    projectId: pnfpb_ajax_object_push.projectId,
    storageBucket: pnfpb_ajax_object_push.storageBucket,
    messagingSenderId: pnfpb_ajax_object_push.messagingSenderId,
    appId: pnfpb_ajax_object_push.appId
};*/

var firebaseConfig = {};

var firebaseApp;
			
var messaging;

var hasFirebaseMessagingSupport;	

function createFirebaseApp(config) {
    try {
        return getApp()
    } catch {
        return initializeApp(config)
    }
}

async function get_firebase_details() {

	var data = {
		action: 'icpushcallback',
		device_id:'',
		subscriptionoptions:'',
		pushtype: 'icfirebasecred'
	};

	$j.post(pnfpb_ajax_object_push.ajax_url, data, async function(responseajax) {

		console.log(responseajax);

		var firebasecredentialsobject = JSON.parse(responseajax);

		if (firebasecredentialsobject.apiKey && firebasecredentialsobject.apiKey != '') {
		
			firebaseConfig = {
				apiKey: firebasecredentialsobject.apiKey,
				authDomain: firebasecredentialsobject.authDomain,
				databaseURL: firebasecredentialsobject.databaseURL,
				projectId: firebasecredentialsobject.projectId,
				storageBucket: firebasecredentialsobject.storageBucket,
				messagingSenderId: firebasecredentialsobject.messagingSenderId,
				appId: firebasecredentialsobject.appId
			};

			vapidKey = firebasecredentialsobject.publicKey;

			console.log(firebaseConfig);

			firebaseApp = createFirebaseApp(firebaseConfig)
			
			messaging = getMessaging(firebaseApp);
			
			hasFirebaseMessagingSupport = await isSupported();			
		
		}		

	});

}



var pnfpb_pushtoken_fromflutter;
var pnfpb_pushtoken_fromAndroid;
var Android;

function PNFPB_from_Flutter_mobileapp(pushtoken) {
	
	pnfpb_pushtoken_fromflutter = pushtoken;
 
	if (pnfpbuserid) {
 
		pnfpbuserid.postMessage(pnfpb_ajax_object_push.userid);
	
	}
	
 return pnfpb_pushtoken_fromflutter;
	
}

function PNFPB_from_Java_androidapp(pushtoken) {
	
	if (pnfpbuserid) {
 
		pnfpbuserid.postMessage(pnfpb_ajax_object_push.userid);
	
	}
	
	if (Android) {
	 
		pnfpb_pushtoken_fromAndroid = Android.getFromAndroid();
	
	}
	
}

$j(function() {
	
const { __ } = wp.i18n;

//await get_firebase_details();

var data = {
	action: 'icpushcallback',
	device_id:'',
	subscriptionoptions:'',
	pushtype: 'icfirebasecred'
};

$j.post(pnfpb_ajax_object_push.ajax_url, data, async function(responseajax) {

	//console.log(responseajax);

	var firebasecredentialsobject = JSON.parse(responseajax);

	if (firebasecredentialsobject.apiKey && firebasecredentialsobject.apiKey != '') {
		
			firebaseConfig = {
				apiKey: firebasecredentialsobject.apiKey,
				authDomain: firebasecredentialsobject.authDomain,
				databaseURL: firebasecredentialsobject.databaseURL,
				projectId: firebasecredentialsobject.projectId,
				storageBucket: firebasecredentialsobject.storageBucket,
				messagingSenderId: firebasecredentialsobject.messagingSenderId,
				appId: firebasecredentialsobject.appId
			};

			vapidKey = firebasecredentialsobject.publicKey

			firebaseApp = createFirebaseApp(firebaseConfig)
			
			messaging = getMessaging(firebaseApp);
			
			hasFirebaseMessagingSupport = await isSupported();	


	if ((window.location.hash).length > 1 && window.location.href.includes("acomment")) {
	    let interval = setInterval(() => 
    	{
        	let el = document.querySelector(window.location.hash);
        	if (el)
        	{
      			$j("html,body").animate({
        			scrollTop: $j('*[id="'+(window.location.hash).replace("#", "")+'"]').offset().top-70
      			}, 1000);
            	clearInterval(interval);
        	}
    	}, 100);
	}

var notificationclickurl = '';

var deviceid = '';

var homeurl = pnfpb_ajax_object_push.homeurl;
	
//var messaging = '';

if (pnfpb_ajax_object_push.pwainstallbuttontext === '') {
	pnfpb_ajax_object_push.pwainstallbuttontext = __('Install PWA app','PNFPB_TD');
}

if (pnfpb_ajax_object_push.pwainstallheadertext === '') {
	pnfpb_ajax_object_push.pwainstallheadertext = __('Install our PWA app with offline functionality','PNFPB_TD');
}

if (pnfpb_ajax_object_push.pwainstalltext === '') {
	pnfpb_ajax_object_push.pwainstalltext = __('Install PWA','PNFPB_TD');
}

if (pnfpb_ajax_object_push.pwainstallbuttoncolor === '') {
	pnfpb_ajax_object_push.pwainstallbuttoncolor = '#ff0000';
}

if (pnfpb_ajax_object_push.pwainstallbuttontextcolor === '') {
	pnfpb_ajax_object_push.pwainstallbuttontextcolor = '#ffffff';
}

	
var standalone = window.navigator.standalone,
  userAgent = window.navigator.userAgent.toLowerCase(),
  safari = /safari/.test(userAgent),
  ios = /iphone|ipod|ipad/.test(userAgent);
	
var pnfpb_webview = false;

if (ios) {
  if (!standalone && safari) {
    // Safari
    pnfpb_webview = false;
  } else if (!standalone && !safari) {
    // iOS webview
    pnfpb_webview = true;
	PNFPB_from_Java_androidapp();
	PNFPB_from_Flutter_mobileapp();	  	
  };
} else {
  if (userAgent.includes('wv')) {
    // Android webview
    pnfpb_webview = true;
	PNFPB_from_Java_androidapp();
	PNFPB_from_Flutter_mobileapp();	  
  } else {
    // Chrome
    pnfpb_webview = false;
  }
};
	
if (pnfpb_ajax_object_push.pwaapponlyenable === '1') {
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
              console.log(__('New content is available; please refresh.','PNFPB_TD'));
             
            } else {
              // At this point, everything has been precached.
              // It's the perfect time to display a
              // "Content is cached for offline use." message.
              console.log(__('Content is cached for offline use','PNFPB_TD'));
            }
          }
        }
      }
	})
	}
	else
	{

		
		if ('serviceWorker' in navigator && hasFirebaseMessagingSupport) {
			
			navigator.serviceWorker.register(homeurl+'/pnfpb_icpush_pwa_sw.js',{scope:homeurl+'/'}).then(function(registration) {
				//console.log(registration);
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
              					console.log(__('New content is available; please refresh.','PNFPB_TD'));
             
            				} else {
              					// At this point, everything has been precached.
              					// It's the perfect time to display a
              					// "Content is cached for offline use." message.
              					console.log(__('Content is cached for offline use','PNFPB_TD'));
            				}
     
          				}
        			}
     			}			
	
				if( $j(".pnfpb_subscribe_button").length )
				{
					$j(".pnfpb_subscribe_button").show();
				}
		
				if ('serviceWorker' in navigator && 'PushManager' in window && hasFirebaseMessagingSupport) {

					navigator.serviceWorker.ready.then((serviceWorkerRegistration) => {
						serviceWorkerRegistration.pushManager.getSubscription().then(async function (subscription) {
						if (pnfpb_ajax_object_push.pnfpb_push_prompt === '1') {

							await pnfpb_show_permission_dialog(serviceWorkerRegistration,subscription);

						}					
						else
						{
        					if (!subscription) 
							{
								await requestPermission(serviceWorkerRegistration);
							}
							else
							{
                   				await checkdeviceid(serviceWorkerRegistration,subscription); 
							}
						}

						if (hasFirebaseMessagingSupport && subscription) 
						{
							// [START get_messaging_object]
							// Retrieve Firebase Messaging object.
							//messaging = firebase.messaging();
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
							//messaging.onTokenRefresh(() => {
							getToken(messaging,{serviceWorkerRegistration:serviceWorkerRegistration,vapidKey:vapidKey }).then(async function (refreshedToken) {
				
								if (refreshedToken) {
									sendTokenToServer(refreshedToken);
									shortcode_subscription_menu(refreshedToken);
									frontend_subscription_menu(refreshedToken);
								}	
								else
								{
									sendTokenToServer(false);
									/*if (pnfpb_ajax_object_push.pnfpb_push_prompt === '1') {
										console.log('nosubscription');
										pnfpb_show_permission_dialog(registration);
									}
									else 
									{
										console.log('nosubscription1');
										//await requestPermission(registration);
									}*/						
								}
				
								// Subscribe the devices corresponding to the registration tokens to the
								// topic.
								/*messaging.subscribeToTopic(refreshedToken, 'general')
									.then((response) => {
									// See the MessagingTopicManagementResponse reference documentation
									// for the contents of response.
									console.log('Successfully subscribed to topic:', response);
									})
									.catch((error) => {
										console.log('Error subscribing to topic:', error);
								});	*/			
								// Indicate that the new Instance ID token has not yet been sent to the
								// app server.
									
								// Send Instance ID token to app server.
									
								// [START_EXCLUDE]
								// Display new Instance ID token and clear UI of all previous messages.
								//resetUI();
								// [END_EXCLUDE]
							}).catch((err) => {
								console.log(__('Unable to retrieve refreshed token ','PNFPB_TD'), err);
								//showToken(__('Unable to retrieve refreshed token ','PNFPB_TD'), err);
								// alert('Unable to retrieve refreshed token from cloud messaging service '+err);
							});
								//});
							  	// [END refresh_token]
				
							  	// [START receive_message]
							  	// Handle incoming messages. Called when:
							  	// - a message is received while the app has focus
							 	// - the user clicks on an app notification created by a service worker
							  	//   `messaging.setBackgroundMessageHandler` handler.
						}
						else
						{
							console.log(__('This browser does not support PUSHAPI Firebase messaging!!!','PNFPB_TD'))
						}

						if (hasFirebaseMessagingSupport) 
						{														
							onMessage(messaging,(payload) => {
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
									console.log(__("This browser does not support system notifications",'PNFPB_TD'));
								}
								// Let's check whether notification permissions have already been granted
								else
								{
									if (Notification.permission === "granted") {
										// If it's okay let's create a notification
										try {
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
														console.log(__("Service Worker Failed to Register foreground notification",'PNFPB_TD'), err);
													})
								
												}
												else
												{
													console.log(__('service workers not supported in this browser !!!','PNFPB_TD'));
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
							console.log(__('This browser does not support PUSHAPI Firebase messaging!!!','PNFPB_TD'))
						}						
						
        			});
				})
				}
				else
				{
					console.log(__('This browser does not support PUSHAPI Firebase messaging!!!','PNFPB_TD'));
					checkdeviceid('');
					mobileapp_subscribe_shortcode();
				}
			})
		
		}
		else {
			console.log('checkwebviewdeviceid');
			checkdeviceid(''); 
		}
	
	}

	async function pnfpb_show_permission_dialog(registration,subscription) {

		$j('.pnfpb-push-subscribe-icon').show();

		registration.pushManager.getSubscription().then(async function (subscription) {	

			if (subscription) {

				await checkdeviceid(registration,subscription);

			}
		});		

		$j('.pnfpb-push-status-text').removeClass("pnfpb-push-status-text-opened");

		$j('.pnfpb-push-subscribe-icon').on( "mouseenter", function(event) {

			$j('.pnfpb-push-status-text').text("Verifying subscription status...");

			navigator.serviceWorker.ready.then((serviceWorkerRegistration) => {

				serviceWorkerRegistration.pushManager.getSubscription().then(async function (subscription) {

					if (subscription) {

						$j('.pnfpb-push-status-text').text("You are subscribed to push notification");

					}
					else {

						$j('.pnfpb-push-status-text').text("Push notification not subscribed");

					}
					$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");
				})

			});

		}).on( "mouseleave", function() {

			$j('.pnfpb-push-status-text').removeClass("pnfpb-push-status-text-opened");

		});

		$j('.pnfpb-push-subscribe-icon').on( "click", function(event) {
	
			event.stopPropagation(); 
	
			event.preventDefault();
	
			$j('.pnfpb-push-subscribe-button-layout').toggle();

			$j('.pnfpb-push-status-text').removeClass("pnfpb-push-status-text-opened");

			if ($('.pnfpb-push-subscribe-button-layout').is(':visible')) {

				$j('.pnfpb-push-subscribe-button-layout').addClass("pnfpb-push-subscribe-button-layout-opened");	

			}
			else {

				$j('.pnfpb-push-subscribe-button-layout').removeClass("pnfpb-push-subscribe-button-layout-opened");

			}

			$j('.pnfpb-push-subscribe-button').text("Please wait...verifying status");
	
			registration.pushManager.getSubscription().then(async function (subscription) {

				if (subscription) {
	
					$j('.pnfpb-push-subscribe-button').text("Unsubscribe");

					$j('.pnfpb-push-subscribe-button').removeClass("pnfpb-popup-subscribe-class");

					$j('.pnfpb-push-subscribe-button').addClass("pnfpb-popup-unsubscribe-class");					

				} else  {

					$j('.pnfpb-push-subscribe-button').text("Subscribe");

					$j('.pnfpb-push-subscribe-button').removeClass("pnfpb-popup-unsubscribe-class");

					$j('.pnfpb-push-subscribe-button').addClass("pnfpb-popup-subscribe-class");					

				}

	
				$j('.pnfpb-popup-unsubscribe-class').off().on( "click", async (event) => {

					var subscribetext = $j('.pnfpb-push-subscribe-button').text();

					console.log(subscribetext);

					event.stopPropagation(); 
	
					event.preventDefault();
					
					$j('.pnfpb-push-subscribe-button-layout').hide();

					registration.pushManager.getSubscription().then(async (subscription) => {

						if (subscription && subscribetext === 'Unsubscribe') {

							$j('.pnfpb-push-status-text').text("Please wait...processing");

							$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");	

							getToken(messaging,{serviceWorkerRegistration:registration,vapidKey:vapidKey }).then(async (refreshedToken) => {

								subscription.unsubscribe().then((successful) => {

								  	deleteToken(messaging).then(function (deleteTokenstatus) {

										if (deleteTokenstatus) {

											var pnfpbshortcodeactive = 'no';

											var isadminpage = 'no';
											
											if (window.location.href.match('wp-admin') !== null) {
												isadminpage = 'yes';
											}
											
											if( $j(".pnfpb_subscribe_button").length || $j(".pnfpb_push_notification_frontend_settings_submit").length )
											{
												pnfpbshortcodeactive = 'yes';
											}	
											
											var data = {
												action: 'icpushcallback',
												device_id:refreshedToken,
												isadminpage:isadminpage,
												pnfpbshortcodeactive:pnfpbshortcodeactive,
												pushtype: 'deletepushtoken'
											};
												
											$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
							
												var responseobject = JSON.parse(response);
											
												if (responseobject.subscriptionstatus === 'deleted') {
											
													console.log('Push subscription token deleted successfully');
											
												}
												else {
													console.log('Push subscription token deletion failed in database');
												}

												$j('.pnfpb-push-subscribe-button').text("Subscribe");

												$j('.pnfpb-push-subscribe-button').removeClass("pnfpb-popup-unsubscribe-class");

												$j('.pnfpb-push-subscribe-button').addClass("pnfpb-popup-subscribe-class");

												$j('.pnfpb-push-status-text').removeClass("pnfpb-push-status-text-opened");	

												$j('.pnfpb-push-status-text').text("Push notification not subscribed");
	
												$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");													
											
											});												
	

										}
	
									}).catch((e) => {

										console.log("Unsubscribe token failed");

									});
								}).catch((e) => {

									console.log("Unsubscribe token failed");

								});
							})
						}
					}).catch((e) => {

						console.log("Unsubscribe subscription failed");

					});
				});							
								
				$j('.pnfpb-popup-subscribe-class').off().on( "click", async (event) => {

					var subscribetext = $j('.pnfpb-push-subscribe-button').text();

					if (!subscription && subscribetext === 'Subscribe') {

						$j('.pnfpb-push-subscribe-button-layout').hide();

						$j('.pnfpb-push-status-text').text("Please wait...processing");

						$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");	
				
						await requestPermission(registration);
				
						$j('.pnfpb-push-subscribe-button').text("Unsubscribe");

						$j('.pnfpb-push-subscribe-button').removeClass("pnfpb-popup-subscribe-class");

						$j('.pnfpb-push-subscribe-button').addClass("pnfpb-popup-unsubscribe-class");
			
						$j('.pnfpb-push-status-text').text("You are subscribed to push notification");
			
						$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");
					}
			
				})							
	
			})
	
		});
	
		$j(document).on( "click", function(){
			$j('.pnfpb-push-subscribe-button-layout').hide();
			$j('.pnfpb-push-status-text').removeClass("pnfpb-push-status-text-opened");
		});
	
	
	}
			
	function pnfpb_hide_permission_dialog() {
		$j('.pnfpb-push-dialog-container').hide();
		const d = new Date();
		  d.setTime(d.getTime() + (5*24*60*60*3000));
		  let expires = "expires="+ d.toUTCString();
		  document.cookie = "PNFPB_push_notification_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";	
	}
	

async function shortcode_subscription_menu(refreshedToken) {
    if( $j(".pnfpb_subscribe_button").length )
    {
		navigator.serviceWorker.ready.then(function (registration) {		
	        // [START get_messaging_object]
            // Retrieve Firebase Messaging object.
            // [END get_messaging_object]
            // [START set_public_vapid_key]
            // Add the public key generated from the console here.
            // [END set_public_vapid_key]

			var subscriptionoptions = '00000000001';
			var subscribeallshortcode = '0';
			var subscribepostactivitiesshortcode = '0';
			var subscribeallcommentsshortcode = '0';
			var subscribemypostshortcode = '0';
			var subscribeprivatemessagesshortcode = '0';
			var subscribenewmembershortcode = '0';
			var subscribefriendshiprequestshortcode = '0';
			var subscribefriendshipacceptshortcode = '0';
			var subscribeuseravatarshortcode = '0';
			var subscribecoverimageshortcode = '0';
			var unsubscribeallshortcode = '0';
			
		    $j(".pnfpb_subscribe_button").on( "click", function(event) {
				
				event.preventDefault();
		        
                if (Notification.permission === 'granted') {
			
							
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
							
								if ($j('#pnfpb_ic_subscribe_private_message_shortcode_enable').is(":checked"))
								{
  									subscribeprivatemessagesshortcode = '1';
									subscribeallshortcode = '0'; 
									unsubscribeallshortcode = '0';
									
									$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
									$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
								}
								else 
								{
									subscribeprivatemessagesshortcode = '0';
								}
							
								if ($j('#pnfpb_ic_subscribe_new_member_shortcode_enable').is(":checked"))
								{
  									subscribenewmembershortcode = '1';
									subscribeallshortcode = '0'; 
									unsubscribeallshortcode = '0';
									
									$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
									$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
								}
								else 
								{

									subscribenewmembershortcode = '0';
								}
							
								if ($j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').is(":checked"))
								{
  									subscribefriendshiprequestshortcode = '1';
									subscribeallshortcode = '0'; 
									unsubscribeallshortcode = '0';
									
									$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
									$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
								}
								else 
								{
									subscribefriendshiprequestshortcode = '0';
								}
							
								if ($j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').is(":checked"))
								{
  									subscribefriendshipacceptshortcode = '1';
									subscribeallshortcode = '0'; 
									unsubscribeallshortcode = '0';
									
									$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
									$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
								}
								else 
								{
									subscribefriendshipacceptshortcode = '0';
								}
							
								if ($j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').is(":checked"))
								{
  									subscribeuseravatarshortcode = '1';
									subscribeallshortcode = '0'; 
									unsubscribeallshortcode = '0';
									
									$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
									$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
								}
								else 
								{
									subscribeuseravatarshortcode = '0';
								}
							
								if ($j('#pnfpb_ic_subscribe_cover_image_shortcode_enable').is(":checked"))
								{
  									subscribecoverimageshortcode = '1';
									subscribeallshortcode = '0'; 
									unsubscribeallshortcode = '0';
									
									$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
									$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
								}
								else 
								{
									subscribecoverimageshortcode = '0';
								}							
							
							
							
							if ($j('#pnfpb_ic_subscribe_my_post_shortcode_enable').is(":checked") && pnfpb_ajax_object_push.isloggedin === 1)
							{
								$j('.pnfpb_ic_subscribe_my_post_shortcode_label_checkbox').html(__("Subscribe notifications on comments from my Posts/my BuddyPress activities",'PNFPB_TD'));
								$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('disabled',false);								
  								subscribemypostshortcode = '1';
							}
							else 
							{
								subscribemypostshortcode = '0';
								if (pnfpb_ajax_object_push.isloggedin != 1) {
									$j('.pnfpb_ic_subscribe_my_post_shortcode_label_checkbox').html(__("Login required to subscribe notifications on comments from my Posts/my BuddyPress activities",'PNFPB_TD'));
									$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('disabled',true);
								}
								else 
								{
									$j('.pnfpb_ic_subscribe_my_post_shortcode_label_checkbox').html(__("Subscribe notifications on comments from my Posts/my BuddyPress activities",'PNFPB_TD'));
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
							
							if ($j("#pnfpb_ic_subscribe_private_message_shortcode_enable").on('click',function() {
								
								if ($j('#pnfpb_ic_subscribe_private_message_shortcode_enable').is(":checked"))
								{
  									subscribeprivatemessagesshortcode = '1';
									subscribeallshortcode = '0'; 
									unsubscribeallshortcode = '0';
									
									$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
									$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
								}
								else 
								{
									subscribeprivatemessagesshortcode = '0';
								}								
							}));
							

							
							if ($j('#pnfpb_ic_subscribe_all_shortcode_enable').on('click',function() {
								
								if ($j('#pnfpb_ic_subscribe_all_shortcode_enable').is(":checked"))
								{
  									subscribeallshortcode = '1';
									subscribemypostshortcode = '0';
									subscribeallcommentsshortcode = '0';
									subscribepostactivitiesshortcode = '0';
									subscribeprivatemessagesshortcode = '0';
									subscribenewmembershortcode = '0';
									subscribefriendshiprequestshortcode = '0';
									subscribefriendshipacceptshortcode = '0';
									subscribeuseravatarshortcode = '0';
									subscribecoverimageshortcode = '0';
									
									unsubscribeallshortcode = '0';	
									
									$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').prop('checked',false);
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
							}));
							
							
							if ($j('#pnfpb_ic_subscribe_new_member_shortcode_enable').on('click',function() {

								if ($j('#pnfpb_ic_subscribe_new_member_shortcode_enable').is(":checked"))
								{
  									subscribenewmembershortcode = '1';
									subscribeallshortcode = '0'; 
									unsubscribeallshortcode = '0';
									
									$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
									$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
								}
								else 
								{

									subscribenewmembershortcode = '0';
								}								
							}));	
							
							if ($j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').on('click',function() {
								
								if ($j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').is(":checked"))
								{
  									subscribefriendshiprequestshortcode = '1';
									subscribeallshortcode = '0'; 
									unsubscribeallshortcode = '0';
									
									$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
									$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
								}
								else 
								{
									subscribefriendshiprequestshortcode = '0';
								}								
							}));
							
							if ($j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').on('click',function() {
								
								if ($j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').is(":checked"))
								{
  									subscribefriendshipacceptshortcode = '1';
									subscribeallshortcode = '0'; 
									unsubscribeallshortcode = '0';
									
									$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
									$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
								}
								else 
								{
									subscribefriendshipacceptshortcode = '0';
								}								
							}));
							
							if ($j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').on('click',function() {
								
								if ($j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').is(":checked"))
								{
  									subscribeuseravatarshortcode = '1';
									subscribeallshortcode = '0'; 
									unsubscribeallshortcode = '0';
									
									$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
									$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
								}
								else 
								{
									subscribeuseravatarshortcode = '0';
								}								
							}));
							
							if ($j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').on('click',function() {
								
								if ($j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').is(":checked"))
								{
  									subscribecoverimageshortcode = '1';
									subscribeallshortcode = '0'; 
									unsubscribeallshortcode = '0';
									
									$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
									$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
								}
								else 
								{
									subscribecoverimageshortcode = '0';
								}								
							}));							
							
							
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
									subscribeprivatemessagesshortcode = '0';
									subscribenewmembershortcode = '0';
									subscribefriendshiprequestshortcode = '0';
									subscribefriendshipacceptshortcode = '0';
									subscribeuseravatarshortcode = '0';
									subscribecoverimageshortcode = '0';
									subscribepostactivitiesshortcode = '0'; 
									subscribeallshortcode = '0';
									
									$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked',false);
									$j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').prop('checked',false);									
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
									autoOpen: true, 
									resizable: true,
        							width: 300,
									position: { my: 'top', at: 'top+40' },
									closeText : '',
    								open: function(event, ui) {
        								$j(this).css("height", "400px");
    								},									
							        modal: true,
 									create: function(event, ui) {
  										$j("body").css({ overflow: 'hidden' })
 									},
 									beforeClose: function(event, ui) {
  										$j("body").css({ overflow: 'inherit' })
 									},									
							        buttons: [
									{ 	
										text: pnfpb_cancel_button_text,
	           							open: function() {
											$j(this).attr('style','font-weight:normal;color:#000000;background-color:#dddddd;border:0px');
            							},
            							click: function() {
											 $j(this).dialog( "close" );
									}},
							        {
            							text: pnfpb_subscribe_button_text,
	           							open: function() {
											$j(this).attr('style','font-weight:bold;color:'+pnfpb_ajax_object_push.subscribe_button_text_color+';background-color:'+pnfpb_ajax_object_push.subscribe_button_color+';border:0px');
            							},
            							click: function() {
											subscriptionoptions = subscribeallshortcode + subscribepostactivitiesshortcode + subscribeallcommentsshortcode + subscribemypostshortcode + subscribeprivatemessagesshortcode + subscribenewmembershortcode + subscribefriendshiprequestshortcode + subscribefriendshipacceptshortcode + subscribeuseravatarshortcode + subscribecoverimageshortcode + unsubscribeallshortcode;
									        if (refreshedToken) {
							   
										        deviceid = refreshedToken;
							
										        var data = {
											        action: 'icpushcallback',
											        device_id:deviceid,
													subscriptionoptions:subscriptionoptions,
											        pushtype: 'subscribe-button'
										        };
								
										        $j.post(pnfpb_ajax_object_push.ajax_url, data, function(responseajax) {
													
														console.log(responseajax);

														var response = JSON.parse(responseajax);
													
														subscriptionoptions = response.subscriptionoptions;
														
														var subscriptionoptionsarray = [];
													
														if (subscriptionoptions) {
															subscriptionoptionsarray = subscriptionoptions.split('');
														}
														
														if (subscriptionoptionsarray.length >= 11)
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
  																$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', true);
																$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
																$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
															}
															else 
															{
																$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', false);
															}
															
															if (subscriptionoptionsarray[5] === '1')
															{
  																$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', true);
																$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
																$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
															}
															else 
															{
																$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', false);
															}
															
															if (subscriptionoptionsarray[6] === '1')
															{
  																$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', true);
																$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
																$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
															}
															else 
															{
																$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', false);
															}
															
															if (subscriptionoptionsarray[7] === '1')
															{
  																$j('#pnfpb_ic_subscribe_friendship_accept_shortcode_enable').prop('checked', true);
																$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
																$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
															}
															else 
															{
																$j('#pnfpb_ic_subscribe_friendship_accept_shortcode_enable').prop('checked', false);
															}
															
															if (subscriptionoptionsarray[8] === '1')
															{
  																$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', true);
																$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
																$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
															}
															else 
															{
																$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', false);
															}
															
															if (subscriptionoptionsarray[9] === '1')
															{
  																$j('#pnfpb_ic_subscribe_cover_image_shortcode_enable').prop('checked', true);
																$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
																$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
															}
															else 
															{
																$j('#pnfpb_ic_subscribe_cover_image_shortcode_enable').prop('checked', false);
															}															

															if (subscriptionoptionsarray[10] === '1')
															{
  																$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked', true);
																$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);
																$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked',false);
																$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
																$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);
																$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', false);
																$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', false);
																$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', false);
																$j('#pnfpb_ic_subscribe_friendship_accept_shortcode_enable').prop('checked', false);
																$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', false);
																$j('#pnfpb_ic_subscribe_cover_image_shortcode_enable').prop('checked', false);
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
                			                                                        applicationServerKey: urlBase64ToUint8Array(vapidKey)
            	   		                                                        }).then(function (subscription) {

                                                                            
                                                                                    if( $j(".pnfpb_subscribe_button").length )
                                                                                    {
                                                                                    $j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text);
                                                                                    }			       			                                                
			       			                                                
			       			                                                        $j(".pnfpb-unsubscribe-alert-msg").html("<p>"+pnfpb_unsubscribe_text_confirm+"</p>");
			       			                                                
			       			                                                        $j( "#pnfpb-unsubscribe-dialog" ).dialog({ closeText:''});
			       			                                                
            			                                                        }).catch(function () {

                                                                            
                                                                                    if( $j(".pnfpb_subscribe_button").length )
                                                                                    {
                                                                                        $j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text);
                                                                                    }			       			                                                

						
													                                $j(".pnfpb-unsubscribe-alert-msg").html(__("cloud messaging push notification - device update failed",'PNFPB_TD'));
													                        
													                                $j( "#pnfpb-unsubscribe-dialog" ).dialog({ closeText:''});

            			                                                        });
            			                                                        
				                                                            }
				                                                            else
				                                                            {
				                                                                
                                                                            
                                                                                if( $j(".pnfpb_subscribe_button").length )
                                                                                {
                                                                                        $j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text);
                                                                                }			       			                                                
			       			                                                	if (subscriptionoptionsarray[10] === '1' || subscriptionoptions === '00000' || subscriptionoptions === '' || subscriptionoptions === null) 
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
			       			                                                
			       			                                                    $j( "#pnfpb-unsubscribe-dialog" ).dialog({ closeText:''});
				                                                            }
				                                                            
                                                                        });
                                                                        
				                                                    });
				    
			                                                    }
			                                                    else
			                                                    {
			           
                                                                            
                                                                    if( $j(".pnfpb_subscribe_button").length )
                                                                    {
                                                                       $j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text);
                                                                    }			       			                                                


			                                                        console.log(__("Already subscribed...device id already exists...not updated",'PNFPB_TD'));
			                                                    }

			                                            }
			                                            else
			                                            {

                                                                            
                                                            if( $j(".pnfpb_subscribe_button").length )
                                                            {
                                                                $j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text);
                                                            }
                                                            
                                                            $j(".pnfpb-unsubscribe-alert-msg").html("<p>Push notification subscription failed..try again!!</p>");
                                                            
                                                            $j( "#pnfpb-unsubscribe-dialog" ).dialog({ closeText:''});

			                                                console.log(__("device update failed",'PNFPB_TD'));
			                                            }
							
										        });
							
									        }									
										    //$j( "#pnfpb_subscribe_dialog_confirm" ).dialog( "close" );
								        },
							        }]
    						    });
    						    
    						    $j('#pnfpb_subscribe_dialog_confirm').on('dialogclose', function(event) {
                                    $j(".pnfpb-unsubscribe-alert-msg").html("");
                                    $j(".pnfpb-subscribe-alert-msg").html("");
                                });
						
                        //});
                        
                   }
                   else
                   {
							
						$j(".pnfpb-unsubscribe-alert-msg").html(__("UnSubscribe failed..try again or Subscribe again..Please!!",'PNFPB_TD'));
							
						$j( "#pnfpb-unsubscribe-dialog" ).dialog({ closeText:''});                        
                 }
				    
		    	})
			})
			} 
}

async function frontend_subscription_menu(refreshedToken) {

    if( $j(".pnfpb_push_notification_frontend_settings_submit").length )
    {
				
	        // [START get_messaging_object]
            // Retrieve Firebase Messaging object.
            // [END get_messaging_object]
            // [START set_public_vapid_key]
            // Add the public key generated from the console here.
            // [END set_public_vapid_key]

			var subscriptionoptions = '00000000001';
			var subscribeallshortcode = '0';
			var subscribepostactivitiesshortcode = '0';
			var subscribeallcommentsshortcode = '0';
			var subscribemypostshortcode = '0';
			var subscribeprivatemessagesshortcode = '0';
			var subscribenewmembershortcode = '0';
			var subscribefriendshiprequestshortcode = '0';
			var subscribefriendshipacceptshortcode = '0';
			var subscribeuseravatarshortcode = '0';
			var subscribecoverimageshortcode = '0';
			var subscribegroupinviteshortcode = '0';
			var subscribegroupdetailsshortcode = '0';
			var unsubscribeallshortcode = '0';
			var subscribeactivitiesshortcode = '0';
			
			
			
		    $j(".pnfpb_push_notification_frontend_settings_submit").on( "click", function(event) {
				
				
				
				event.preventDefault();
				
				$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
				$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('error');
				$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('info');
				$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Processing...','PNFPB_TD'));
				$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');										
		        

				if ($j('#pnfpb_ic_fcm_front_post_enable').is(":checked"))
				{
  					subscribepostactivitiesshortcode = '1';
				}
				else 
				{
					subscribepostactivitiesshortcode = '0';
				}
							
				if ($j('#pnfpb_ic_fcm_front_bactivity_enable').is(":checked"))
				{
  					subscribeactivitiesshortcode = '1';
				}
				else 
				{
					subscribeactivitiesshortcode = '0';
				}							
							
				if ($j('#pnfpb_ic_fcm_front_bcomment_enable').is(":checked"))
				{
  					subscribeallcommentsshortcode = '1';
					subscribemypostshortcode = '0';
				}
				else 
				{
					subscribeallcommentsshortcode = '0';
				}
				
				if ($j('#pnfpb_ic_fcm_front_mybcomment_enable').is(":checked"))
				{
  					subscribemypostshortcode = '1';
					subscribeallcommentsshortcode = '0';
				}
				else 
				{
					subscribemypostshortcode = '0';
				}				
							
				if ($j('#pnfpb_ic_fcm_front_bprivatemessage_enable').is(":checked"))
				{
  					subscribeprivatemessagesshortcode = '1';
					subscribeallshortcode = '0'; 
					unsubscribeallshortcode = '0';
									
									
				}
				else 
				{
					subscribeprivatemessagesshortcode = '0';
				}
							
				if ($j('#pnfpb_ic_fcm_front_new_member_enable').is(":checked"))
				{
  					subscribenewmembershortcode = '1';
					subscribeallshortcode = '0'; 
					unsubscribeallshortcode = '0';
				}
				else 
				{

					subscribenewmembershortcode = '0';
				}
							
				if ($j('#pnfpb_ic_fcm_front_friendship_request_enable').is(":checked"))
				{
  					subscribefriendshiprequestshortcode = '1';
					subscribeallshortcode = '0'; 
					unsubscribeallshortcode = '0';
				}
				else 
				{
					subscribefriendshiprequestshortcode = '0';
				}
							
				if ($j('#pnfpb_ic_fcm_front_friendship_accept_enable').is(":checked"))
				{
  					subscribefriendshipacceptshortcode = '1';
					subscribeallshortcode = '0'; 
					unsubscribeallshortcode = '0';
				}
				else 
				{
					subscribefriendshipacceptshortcode = '0';
				}
							
				if ($j('#pnfpb_ic_fcm_front_avatar_change_enable').is(":checked"))
				{
  					subscribeuseravatarshortcode = '1';
					subscribeallshortcode = '0'; 
					unsubscribeallshortcode = '0';
				}
				else 
				{
					subscribeuseravatarshortcode = '0';
				}
							
				if ($j('#pnfpb_ic_fcm_front_cover_image_change_enable').is(":checked"))
				{
  					subscribecoverimageshortcode = '1';
					subscribeallshortcode = '0'; 
					unsubscribeallshortcode = '0';
				}
				else 
				{
					subscribecoverimageshortcode = '0';
				}
				
				if ($j('#pnfpb_ic_fcm_front_group_invite_enable').is(":checked"))
				{
  					subscribegroupinviteshortcode = '1';
					subscribeallshortcode = '0'; 
					unsubscribeallshortcode = '0';
				}
				else 
				{
					subscribegroupinviteshortcode = '0';
				}
				
				if ($j('#pnfpb_ic_fcm_front_group_details_update_enable').is(":checked"))
				{
  					subscribegroupdetailsshortcode = '1';
					subscribeallshortcode = '0'; 
					unsubscribeallshortcode = '0';
				}
				else 
				{
					subscribegroupdetailsshortcode = '0';
				}				
				
				subscriptionoptions = subscribeallshortcode + subscribepostactivitiesshortcode + subscribeallcommentsshortcode + subscribemypostshortcode + subscribeprivatemessagesshortcode + subscribenewmembershortcode + subscribefriendshiprequestshortcode + subscribefriendshipacceptshortcode + subscribeuseravatarshortcode + subscribecoverimageshortcode + unsubscribeallshortcode + subscribeactivitiesshortcode + subscribegroupdetailsshortcode + subscribegroupinviteshortcode;					
				
                if (hasFirebaseMessagingSupport && 'serviceWorker' in navigator && Notification.permission === 'granted') {
					
				  navigator.serviceWorker.ready.then(function (registration) {
					  
		
							
						if (refreshedToken) {
							 
							deviceid = refreshedToken;
							
							
							var data = {
								action: 'icpushcallback',
								   	device_id:deviceid,
									subscriptionoptions:subscriptionoptions,
									pushtype: 'subscribe-button'
							};
								
							$j.post(pnfpb_ajax_object_push.ajax_url, data, function(responseajax) {

								var response = JSON.parse(responseajax);
													
								subscriptionoptions = response.subscriptionoptions;

								var subscriptionoptionsarray = [];
													
								if (subscriptionoptions) {
									subscriptionoptionsarray = subscriptionoptions.split('');
								}								

								if (subscriptionoptionsarray.length >= 11)
								{
									$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('error');
									$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('info');
									$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('success');
									$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');
									$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Your notification settings have been saved','PNFPB_TD'));
						
									if (subscriptionoptionsarray[1] === '1')
									{
  										$j('#pnfpb_ic_fcm_front_post_enable').prop('checked', true);
									}
									else 
									{
										$j('#pnfpb_ic_fcm_front_post_enable').prop('checked', false);
									}
									
									if (subscriptionoptionsarray[11] === '1')
									{
  										$j('#pnfpb_ic_fcm_front_bactivity_enable').prop('checked', true);

									}
									else 
									{
										$j('#pnfpb_ic_fcm_front_bactivity_enable').prop('checked', false);
									}									
							
									if (subscriptionoptionsarray[2] === '1')
									{
  										$j('#pnfpb_ic_fcm_front_bcomment_enable').prop('checked', true);
									}
									else 
									{
										$j('#pnfpb_ic_fcm_front_bcomment_enable').prop('checked', false);
									}
									
									if (subscriptionoptionsarray[3] === '1')
									{
  										$j('#pnfpb_ic_fcm_front_mybcomment_enable').prop('checked', true);
									}
									else 
									{
										$j('#pnfpb_ic_fcm_front_mybcomment_enable').prop('checked', false);
									}									
							
									if (subscriptionoptionsarray[4] === '1')
									{
  										$j('#pnfpb_ic_fcm_front_bprivatemessage_enable').prop('checked', true);

									}
									else 
									{
										$j('#pnfpb_ic_fcm_front_bprivatemessage_enable').prop('checked', false);
									}
															
															
									if (subscriptionoptionsarray[5] === '1')
									{
  										$j('#pnfpb_ic_fcm_front_new_member_enable').prop('checked', true);

									}
									else 
									{
										$j('#pnfpb_ic_fcm_front_new_member_enable').prop('checked', false);
									}
															
									if (subscriptionoptionsarray[6] === '1')
									{
  										$j('#pnfpb_ic_fcm_front_friendship_request_enable').prop('checked', true);

									}
									else 
									{
										$j('#pnfpb_ic_fcm_front_friendship_request_enable').prop('checked', false);
									}
															
									if (subscriptionoptionsarray[7] === '1')
									{
  										$j('#pnfpb_ic_fcm_front_friendship_accept_enable').prop('checked', true);

									}
									else 
									{
										$j('#pnfpb_ic_fcm_front_friendship_accept_enable').prop('checked', false);
									}
															
									if (subscriptionoptionsarray[8] === '1')
									{
  										$j('#pnfpb_ic_fcm_front_avatar_change_enable').prop('checked', true);

									}
									else 
									{
										$j('#pnfpb_ic_fcm_front_avatar_change_enable').prop('checked', false);
									}
															
									if (subscriptionoptionsarray[9] === '1')
									{
  										$j('#pnfpb_ic_fcm_front_cover_image_change_enable').prop('checked', true);

									}
									else 
									{
										$j('#pnfpb_ic_fcm_front_cover_image_change_enable').prop('checked', false);
									}
									
									if (subscriptionoptionsarray[13] === '1')
									{
  										$j('#pnfpb_ic_fcm_front_group_invite_enable').prop('checked', true);

									}
									else 
									{
										$j('#pnfpb_ic_fcm_front_group_invite_enable').prop('checked', false);
									}
									
									if (subscriptionoptionsarray[12] === '1')
									{
  										$j('#pnfpb_ic_fcm_front_group_details_update_enable').prop('checked', true);

									}
									else 
									{
										$j('#pnfpb_ic_fcm_front_group_details_update_enable').prop('checked', false);
									}									


								}
								else 
									{
										$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
										$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('error');
										$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Error in saving notification settings','PNFPB_TD'));
										$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');
									}
								

							})
						}
						else 
							{
								$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
								$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('info');
								$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('error');
								$j('.pnfpb_ic_front_push_notification_settings_text').html(__('No token. Error in saving notification settings','PNFPB_TD'));
								$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');														
							}
					//});
				  })
				}
				else 
					{
						
						
						
						if (hasFirebaseMessagingSupport) {
							//For webview mobile apps send subscriptionoptions from webview to app
							//	
							
							if (window.webkit && window.webkit.messageHandlers && window.webkit.messageHandlers.frontendsubscriptionOptions) {
       							window.webkit.messageHandlers.frontendsubscriptionOptions.postMessage({
                     				"message": subscriptionoptions
       							});
							}							
							
							if (frontendsubscriptionOptions) {
								
								frontendsubscriptionOptions.postMessage(subscriptionoptions);
								
								$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('error');
								$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('info');
								$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('success');
								$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');
								$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Your notification settings have been saved','PNFPB_TD'));								
							}
							else 
							{
								$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
								$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('error');
								$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Error in saving notification settings','PNFPB_TD'));
								$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');
							}							
							
						}
						else 
						{
							$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
							$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('info');
							$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('error');
							$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Notification permission not granted by user. Error in saving notification settings','PNFPB_TD'));
							$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');	
						}
					}
			})
	}
	else
	{
		console.log(__('Frontend subscription settings not available','PNFPB_TD'));
	}		


}

async function checkwebviewdeviceid() {
	
	checkdeviceid('');
}
  
  // Send the Instance ID token your application server, so that it can:
  // - send messages back to this app
  // - subscribe/unsubscribe the token from topics
function sendTokenToServer(currentToken) {
    if (!isTokenSentToServer()) {
      console.log(__('Sending token to server...','PNFPB_TD'));
      // TODO(developer): Send the current token to your server.
      setTokenSentToServer(true);
	  return '';
    } else {
      console.log(__('Token already sent to server so won\'t send it again ' +
          'unless it changes','PNFPB_TD'));
	  return '';
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

		if( $j(".pnfpb-push-subscribe-button").length ) {

			$j('.pnfpb-push-status-text').text("Please wait...processing");

			$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");
			
		}	
		  
		navigator.serviceWorker.ready.then((serviceWorkerRegistration) => {

			serviceWorkerRegistration.pushManager.subscribe({
										
        			userVisibleOnly: true,
										
            		applicationServerKey: urlBase64ToUint8Array(vapidKey)
										
        	}).then(function (subscription) {

				if (subscription) {
		  
        			getToken(messaging,{serviceWorkerRegistration:registration,vapidKey:vapidKey }).then((currentToken) => {
		   
      					if (currentToken) {

         				sendTokenToServer(currentToken);
		  
      					deviceid = currentToken;
		  
						var pnfpbshortcodeactive = 'no';
		  
						var isadminpage = 'no';
		  
						if (window.location.href.match('wp-admin') !== null) {
							isadminpage = 'yes';
						}
		
						var subscriptionoptions = '10000000000';
	
						var data = {
							action: 'icpushcallback',
							device_id:deviceid,
							isadminpage:isadminpage,
							subscriptionoptions:subscriptionoptions,
							pnfpbshortcodeactive:pnfpbshortcodeactive,
							pnfpb_endpoint:subscription.endpoint,
							pnfpb_options:subscription.options.applicationServerKey,
							pushtype:'normal'
						};
						$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
			
							var responseobject = JSON.parse(response);
			
			   				if (responseobject.subscriptionstatus != 'fail')
			   				{
			            		if (responseobject.subscriptionstatus != 'duplicate') {
							
									var subscriptionoptions = responseobject.subscriptionoptions;							
			                
				            		//navigator.serviceWorker.ready.then(function (registration) {
								
				   		            	//registration.pushManager.subscribe({
										
                			            //	userVisibleOnly: true,
										
                			            //	applicationServerKey: urlBase64ToUint8Array(vapidKey)
										
            	   		            	//}).then(function (subscription) {

										if( $j(".pnfpb-push-subscribe-button").length ) {

										   $j('.pnfpb-push-subscribe-button').text("Unsubscribe");

										   $j('.pnfpb-push-subscribe-button').removeClass("pnfpb-popup-subscribe-class");
				   
										   $j('.pnfpb-push-subscribe-button').addClass("pnfpb-popup-unsubscribe-class");

										   $j('.pnfpb-push-status-text').removeClass("pnfpb-push-status-text-opened");	
							   
										   $j('.pnfpb-push-status-text').text("You are subscribed to push notification");
							   
										   $j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");								
										
			       			            	$j("#ic-notification-button").hide();
										}
										
											var subscriptionoptionsarray = subscriptionoptions.split('');
										
											if (subscriptionoptionsarray.length >= 4)
											{
						
												if (subscriptionoptionsarray[1] === '1' || subscriptionoptionsarray[0] === '1')
												{
  													$j('#pnfpb_ic_fcm_front_post_enable').prop('checked', true);
												}
												else 
												{
													$j('#pnfpb_ic_fcm_front_post_enable').prop('checked', false);
												}
									
												if ((subscriptionoptionsarray[11] && subscriptionoptionsarray[11] === '1')  || subscriptionoptionsarray[0] === '1')
												{
  													$j('#pnfpb_ic_fcm_front_bactivity_enable').prop('checked', true);

												}
												else 
												{
													$j('#pnfpb_ic_fcm_front_bactivity_enable').prop('checked', false);
												}									
							
												if (subscriptionoptionsarray[2] === '1'  || subscriptionoptionsarray[0] === '1') 
												{
  													$j('#pnfpb_ic_fcm_front_bcomment_enable').prop('checked', true);
												}
												else 
												{
													$j('#pnfpb_ic_fcm_front_bcomment_enable').prop('checked', false);
												}
							
												if ((subscriptionoptionsarray[4] && subscriptionoptionsarray[4] === '1') || subscriptionoptionsarray[0] === '1')
												{
  													$j('#pnfpb_ic_fcm_front_bprivatemessage_enable').prop('checked', true);

												}
												else 
												{
													$j('#pnfpb_ic_fcm_front_bprivatemessage_enable').prop('checked', false);
												}
															
															
												if ((subscriptionoptionsarray[5] && subscriptionoptionsarray[5] === '1')  || subscriptionoptionsarray[0] === '1')
												{
  													$j('#pnfpb_ic_fcm_front_new_member_enable').prop('checked', true);

												}
												else 
												{
													$j('#pnfpb_ic_fcm_front_new_member_enable').prop('checked', false);
												}
															
												if ((subscriptionoptionsarray[6] && subscriptionoptionsarray[6] === '1') || subscriptionoptionsarray[0] === '1')
												{
  													$j('#pnfpb_ic_fcm_front_friendship_request_enable').prop('checked', true);

												}
												else 
												{
													$j('#pnfpb_ic_fcm_front_friendship_request_enable').prop('checked', false);
												}
															
												if ((subscriptionoptionsarray[7] && subscriptionoptionsarray[7] === '1') || subscriptionoptionsarray[0] === '1')
												{
  													$j('#pnfpb_ic_fcm_front_friendship_accept_enable').prop('checked', true);

												}
												else 
												{
													$j('#pnfpb_ic_fcm_front_friendship_accept_enable').prop('checked', false);
												}
															
												if ((subscriptionoptionsarray[8] && subscriptionoptionsarray[8] === '1') || subscriptionoptionsarray[0] === '1')
												{
  													$j('#pnfpb_ic_fcm_front_avatar_change_enable').prop('checked', true);

												}
												else 
												{
													$j('#pnfpb_ic_fcm_front_avatar_change_enable').prop('checked', false);
												}
															
												if ((subscriptionoptionsarray[9] && subscriptionoptionsarray[9] === '1') || subscriptionoptionsarray[0] === '1')
												{
  													$j('#pnfpb_ic_fcm_front_cover_image_change_enable').prop('checked', true);

												}
												else 
												{
													$j('#pnfpb_ic_fcm_front_cover_image_change_enable').prop('checked', false);
												}
											
												if ((subscriptionoptionsarray[12] && subscriptionoptionsarray[12] === '1') || subscriptionoptionsarray[0] === '1')
												{
  													$j('#pnfpb_ic_fcm_front_group_details_update_enable').prop('checked', true);

												}
												else 
												{
													$j('#pnfpb_ic_fcm_front_group_details_update_enable').prop('checked', false);
												}
											
												if ((subscriptionoptionsarray[13] && subscriptionoptionsarray[13] === '1') || subscriptionoptionsarray[0] === '1')
												{
  													$j('#pnfpb_ic_fcm_front_group_invite_enable').prop('checked', true);

												}
												else 
												{
													$j('#pnfpb_ic_fcm_front_group_invite_enable').prop('checked', false);
												}											

											}	
							
											if( $j(".pnfpb_subscribe_button").length) { 

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
  													$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', true);
												}
												else 
												{
													$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', false);
												}
							
												if (subscriptionoptionsarray[5] === '1')
												{
  													$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', true);
												}
												else 
												{
													$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', false);
												}
							
												if (subscriptionoptionsarray[6] === '1')
												{
  													$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', true);
												}
												else 
												{
													$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', false);
												}
							
												if (subscriptionoptionsarray[7] === '1')
												{
  													$j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').prop('checked', true);
												}
												else 
												{
													$j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').prop('checked', false);
												}
							
												if (subscriptionoptionsarray[8] === '1')
												{
  													$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', true);
												}
												else 
												{
													$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', false);
												}
							
												if (subscriptionoptionsarray[9] === '1')
												{
  													$j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').prop('checked', true);
												}
												else 
												{
													$j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').prop('checked', false);
												}							

												if (subscriptionoptionsarray[10] === '1')
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
	                                					$j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text);
                               	 					}			                             
			                					}
			                					else
			                					{
 					
                                					if( $j(".pnfpb_subscribe_button").length )
                                					{
	                                					$j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text);
                                					}			                    
			               	 				}
										}
			       			            
			                       		//}).catch(function (err) {
                			            //	console.log(__("cloud messaging push notification - device update failed",'PNFPB_TD'));
										//	console.log(err);
            			            	//});
				            	//});
				    
			           	 	}
			            	else
			            	{

                            	if( $j(".pnfpb_subscribe_button").length )
                            	{
                                	$j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text);
                            	}				           
			           
			                	console.log(__("Already subscribed...device id already exists...not updated",'PNFPB_TD'));
			            	}

			   		}	
			   		else
			   		{

			       		console.log(__("device update failed",'PNFPB_TD'));
			   		}			
			});


      	} else {
        	// Show permission request.
        	console.log(__('No Instance ID token available. Request permission to generate one.','PNFPB_TD'));
        	// Show permission UI.
        	setTokenSentToServer(false);
      	}
	
	
    	}).catch((err) => {
     	 console.log(__('An error occurred while retrieving token. ','PNFPB_TD'), err);
      		setTokenSentToServer(false);
    	});

        // TODO(developer): Retrieve an Instance ID token for use with FCM.
        // [START_EXCLUDE]
        // In many cases once an app has been granted notification permission,
        // it should update its UI reflecting this.
        // [END_EXCLUDE]
		}
		})
		})
      } else {
        console.log(__('Unable to get permission to notify.','PNFPB_TD'));
		$j('.pnfpb-push-dialog-container').hide();
		const d = new Date();
  		d.setTime(d.getTime() + (5*24*60*60*58000));
  		let expires = "expires="+ d.toUTCString();
  		document.cookie = "PNFPB_push_notification_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";			  
      }
    });
    // [END request_permission]
  }

 async function pnfpb_deletetoken(deviceid) {

	var pnfpbshortcodeactive = 'no';

	var isadminpage = 'no';

	if (window.location.href.match('wp-admin') !== null) {
		isadminpage = 'yes';
	}

	if( $j(".pnfpb_subscribe_button").length || $j(".pnfpb_push_notification_frontend_settings_submit").length )
	{
		pnfpbshortcodeactive = 'yes';
	}	

	var data = {
		action: 'icpushcallback',
		device_id:deviceid,
		isadminpage:isadminpage,
		pnfpbshortcodeactive:pnfpbshortcodeactive,
		pushtype: 'deletepushtoken'
	};
	
	$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {

		var responseobject = JSON.parse(response);

		if (responseobject.subscriptionstatus === 'deleted') {

			console.log('Push subscription token deleted successfully');

		}
		else {
			console.log('Push subscription token deletion failed in database');
		}

	});
 }
  
 async function checkdeviceid(registration,subscription) {

	registration.pushManager.getSubscription().then((subscription) => {

					var subscriptionoptions = '100000000000';
					var subscriptionoptionsarray = subscriptionoptions.split('');
					
					var pnfpbshortcodeactive = 'no';
					var isadminpage = 'no';
					if (window.location.href.match('wp-admin') !== null) {
						isadminpage = 'yes';
					}
        			if( $j(".pnfpb_subscribe_button").length || $j(".pnfpb_push_notification_frontend_settings_submit").length )
        			{
						pnfpbshortcodeactive = 'yes';
					}					
					
					deviceid = '';

					if (hasFirebaseMessagingSupport && Notification.permission === 'granted') {
						
						getToken(messaging,{serviceWorkerRegistration:registration,vapidKey:vapidKey }).then((currentToken) => {

							// Subscribe the devices corresponding to the registration tokens to the
							// topic.
							
							if (currentToken) {
							   
								deviceid = currentToken;
  
								
								var data = {
									action: 'icpushcallback',
									device_id:deviceid,
									isadminpage:isadminpage,
									pnfpbshortcodeactive:pnfpbshortcodeactive,
									pnfpb_endpoint:subscription.endpoint,
									pnfpb_options:vapidKey,									
									pushtype: 'checkdeviceid'
					    		};
								
								$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
							
										console.log(response);

										var responseobject = JSON.parse(response);	

										subscriptionoptions = responseobject.subscriptionoptions;
							
										subscriptionoptionsarray = subscriptionoptions.split('');
														
										if (subscriptionoptionsarray.length >= 4)
										{
						
											if (subscriptionoptionsarray[1] === '1'  || subscriptionoptionsarray[0] === '1')
											{
  												$j('#pnfpb_ic_fcm_front_post_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_fcm_front_post_enable').prop('checked', false);
											}
									
											if ((subscriptionoptionsarray[11] && subscriptionoptionsarray[11] === '1') || subscriptionoptionsarray[0] === '1')
											{
  												$j('#pnfpb_ic_fcm_front_bactivity_enable').prop('checked', true);

											}
											else 
											{
												$j('#pnfpb_ic_fcm_front_bactivity_enable').prop('checked', false);
											}									
							
											if (subscriptionoptionsarray[2] === '1' || subscriptionoptionsarray[0] === '1')
											{
  												$j('#pnfpb_ic_fcm_front_bcomment_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_fcm_front_bcomment_enable').prop('checked', false);
											}
								
											if (subscriptionoptionsarray[3] === '1' || subscriptionoptionsarray[0] === '1')
											{
  												$j('#pnfpb_ic_fcm_front_mybcomment_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_fcm_front_mybcomment_enable').prop('checked', false);
											}								
							
											if ((subscriptionoptionsarray[4] && subscriptionoptionsarray[4] === '1') || subscriptionoptionsarray[0] === '1')
											{
  												$j('#pnfpb_ic_fcm_front_bprivatemessage_enable').prop('checked', true);

											}
											else 
											{
												$j('#pnfpb_ic_fcm_front_bprivatemessage_enable').prop('checked', false);
											}
															
															
											if ((subscriptionoptionsarray[5] && subscriptionoptionsarray[5] === '1') || subscriptionoptionsarray[0] === '1')
											{
  												$j('#pnfpb_ic_fcm_front_new_member_enable').prop('checked', true);

											}
											else 
											{
												$j('#pnfpb_ic_fcm_front_new_member_enable').prop('checked', false);
											}
															
											if ((subscriptionoptionsarray[6] && subscriptionoptionsarray[6] === '1') || subscriptionoptionsarray[0] === '1')
											{
  												$j('#pnfpb_ic_fcm_front_friendship_request_enable').prop('checked', true);

											}
											else 
											{
												$j('#pnfpb_ic_fcm_front_friendship_request_enable').prop('checked', false);
											}
															
											if ((subscriptionoptionsarray[7] && subscriptionoptionsarray[7] === '1') || subscriptionoptionsarray[0] === '1')
											{
  												$j('#pnfpb_ic_fcm_front_friendship_accept_enable').prop('checked', true);

											}
											else 
											{
												$j('#pnfpb_ic_fcm_front_friendship_accept_enable').prop('checked', false);
											}
															
											if ((subscriptionoptionsarray[8] && subscriptionoptionsarray[8] === '1') || subscriptionoptionsarray[0] === '1')
											{
  												$j('#pnfpb_ic_fcm_front_avatar_change_enable').prop('checked', true);

											}
											else 
											{
												$j('#pnfpb_ic_fcm_front_avatar_change_enable').prop('checked', false);
											}
															
											if ((subscriptionoptionsarray[9] && subscriptionoptionsarray[9] === '1') || subscriptionoptionsarray[0] === '1')
											{
  												$j('#pnfpb_ic_fcm_front_cover_image_change_enable').prop('checked', true);

											}
											else 
											{
												$j('#pnfpb_ic_fcm_front_cover_image_change_enable').prop('checked', false);
											}
											
											if ((subscriptionoptionsarray[12] && subscriptionoptionsarray[12] === '1') || subscriptionoptionsarray[0] === '1')
											{
  												$j('#pnfpb_ic_fcm_front_group_details_update_enable').prop('checked', true);

											}
											else 
											{
												$j('#pnfpb_ic_fcm_front_group_details_update_enable').prop('checked', false);
											}
											
											if ((subscriptionoptionsarray[13] && subscriptionoptionsarray[13] === '1') || subscriptionoptionsarray[0] === '1')
											{
  												$j('#pnfpb_ic_fcm_front_group_invite_enable').prop('checked', true);

											}
											else 
											{
												$j('#pnfpb_ic_fcm_front_group_invite_enable').prop('checked', false);
											}											

										}
							
										if( $j(".pnfpb_subscribe_button").length) { 

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
  												$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', false);
											}
							
											if (subscriptionoptionsarray[5] === '1')
											{
  												$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', false);
											}
							
											if (subscriptionoptionsarray[6] === '1')
											{
  												$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', false);
											}
							
											if (subscriptionoptionsarray[7] === '1')
											{
  												$j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').prop('checked', false);
											}
							
											if (subscriptionoptionsarray[8] === '1')
											{
  												$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', false);
											}
							
											if (subscriptionoptionsarray[9] === '1')
											{
  												$j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').prop('checked', false);
											}							

											if (subscriptionoptionsarray[10] === '1')
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
	                                				$j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text);
                               	 				}			                             
			                				}
			                				else
			                				{
 					
                                				if( $j(".pnfpb_subscribe_button").length )
                                				{
	                                				$j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text);
                                				}			                    
			               	 				}
										}
							
									});
								
								}
							
						})
						
					}
					else 
					{
						
						var isadminpage = 'no';
						
						if (window.location.href.match('wp-admin') !== null) {
							isadminpage = 'yes';
						}			
						deviceid = '';
						
						if( $j(".pnfpb_subscribe_button").length || $j(".pnfpb_push_notification_frontend_settings_submit").length )
						{
							pnfpbshortcodeactive = 'yes';
						}						
						
						if (pnfpb_pushtoken_fromflutter && pnfpb_pushtoken_fromflutter != '') {
							   
							deviceid = pnfpb_pushtoken_fromflutter;
				
						}
		
						if (pnfpb_pushtoken_fromAndroid  && pnfpb_pushtoken_fromAndroid != '') {
							   
							deviceid = pnfpb_pushtoken_fromAndroid;
				
						}						
						//console.log(deviceid);
								
						var data = {
							action: 'icpushcallback',
							device_id:deviceid,
							isadminpage:isadminpage,
							pnfpbshortcodeactive:pnfpbshortcodeactive,
							pnfpb_endpoint:subscription.endpoint,
							pnfpb_options:vapidKey,								
							pushtype: 'checkdeviceid'
					    };
								
						$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {

	
							var responseobject = JSON.parse(response);	

							subscriptionoptions = responseobject.subscriptionoptions;
							
							subscriptionoptionsarray = subscriptionoptions.split('');
														
							if (subscriptionoptionsarray.length >= 4)
							{
						
								if (subscriptionoptionsarray[1] === '1'  || subscriptionoptionsarray[0] === '1')
								{
  									$j('#pnfpb_ic_fcm_front_post_enable').prop('checked', true);
								}
								else 
								{
									$j('#pnfpb_ic_fcm_front_post_enable').prop('checked', false);
								}
									
								if ((subscriptionoptionsarray[11] && subscriptionoptionsarray[11] === '1') || subscriptionoptionsarray[0] === '1')
								{
  									$j('#pnfpb_ic_fcm_front_bactivity_enable').prop('checked', true);

								}
								else 
								{
									$j('#pnfpb_ic_fcm_front_bactivity_enable').prop('checked', false);
								}									
							
								if (subscriptionoptionsarray[2] === '1' || subscriptionoptionsarray[0] === '1')
								{
  									$j('#pnfpb_ic_fcm_front_bcomment_enable').prop('checked', true);
								}
								else 
								{
									$j('#pnfpb_ic_fcm_front_bcomment_enable').prop('checked', false);
								}
								
								if (subscriptionoptionsarray[3] === '1' || subscriptionoptionsarray[0] === '1')
								{
  									$j('#pnfpb_ic_fcm_front_mybcomment_enable').prop('checked', true);
								}
								else 
								{
									$j('#pnfpb_ic_fcm_front_mybcomment_enable').prop('checked', false);
								}								
							
								if ((subscriptionoptionsarray[4] && subscriptionoptionsarray[4] === '1') || subscriptionoptionsarray[0] === '1')
								{
  									$j('#pnfpb_ic_fcm_front_bprivatemessage_enable').prop('checked', true);

								}
								else 
								{
									$j('#pnfpb_ic_fcm_front_bprivatemessage_enable').prop('checked', false);
								}
															
															
								if ((subscriptionoptionsarray[5] && subscriptionoptionsarray[5] === '1') || subscriptionoptionsarray[0] === '1')
								{
  									$j('#pnfpb_ic_fcm_front_new_member_enable').prop('checked', true);

								}
								else 
								{
									$j('#pnfpb_ic_fcm_front_new_member_enable').prop('checked', false);
								}
															
								if ((subscriptionoptionsarray[6] && subscriptionoptionsarray[6] === '1') || subscriptionoptionsarray[0] === '1')
								{
  									$j('#pnfpb_ic_fcm_front_friendship_request_enable').prop('checked', true);

								}
								else 
								{
									$j('#pnfpb_ic_fcm_front_friendship_request_enable').prop('checked', false);
								}
															
								if ((subscriptionoptionsarray[7] && subscriptionoptionsarray[7] === '1') || subscriptionoptionsarray[0] === '1')
								{
  									$j('#pnfpb_ic_fcm_front_friendship_accept_enable').prop('checked', true);

								}
								else 
								{
									$j('#pnfpb_ic_fcm_front_friendship_accept_enable').prop('checked', false);
								}
															
								if ((subscriptionoptionsarray[8] && subscriptionoptionsarray[8] === '1') || subscriptionoptionsarray[0] === '1')
								{
  									$j('#pnfpb_ic_fcm_front_avatar_change_enable').prop('checked', true);

								}
								else 
								{
									$j('#pnfpb_ic_fcm_front_avatar_change_enable').prop('checked', false);
								}
																
								if ((subscriptionoptionsarray[9] && subscriptionoptionsarray[9] === '1') || subscriptionoptionsarray[0] === '1')
								{
  									$j('#pnfpb_ic_fcm_front_cover_image_change_enable').prop('checked', true);

								}
								else 
								{
									$j('#pnfpb_ic_fcm_front_cover_image_change_enable').prop('checked', false);
								}
								
								if ((subscriptionoptionsarray[12] && subscriptionoptionsarray[12] === '1') || subscriptionoptionsarray[0] === '1')
								{
  									$j('#pnfpb_ic_fcm_front_group_details_update_enable').prop('checked', true);

								}
								else 
								{
									$j('#pnfpb_ic_fcm_front_group_details_update_enable').prop('checked', false);
								}
											
								if ((subscriptionoptionsarray[13] && subscriptionoptionsarray[13] === '1') || subscriptionoptionsarray[0] === '1')
								{
  									$j('#pnfpb_ic_fcm_front_group_invite_enable').prop('checked', true);

								}
								else 
								{
									$j('#pnfpb_ic_fcm_front_group_invite_enable').prop('checked', false);
								}								

							}
							
							if( $j(".pnfpb_subscribe_button").length) { 

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
  									$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', true);
								}
								else 
								{
									$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', false);
								}
							
								if (subscriptionoptionsarray[5] === '1')
								{
  									$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', true);
								}
								else 
								{
									$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', false);
								}
							
								if (subscriptionoptionsarray[6] === '1')
								{
  									$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', true);
								}
								else 
								{
									$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', false);
								}
							
								if (subscriptionoptionsarray[7] === '1')
								{
  									$j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').prop('checked', true);
								}
								else 
								{
									$j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').prop('checked', false);
								}
							
								if (subscriptionoptionsarray[8] === '1')
								{
  									$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', true);
								}
								else 
								{
									$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', false);
								}
							
								if (subscriptionoptionsarray[9] === '1')
								{
  									$j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').prop('checked', true);
								}
								else 
								{
									$j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').prop('checked', false);
								}							

								if (subscriptionoptionsarray[10] === '1')
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
	                                	$j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text);
									 }			                             
			                	}
			                	else
			                	{
 					
                                	if( $j(".pnfpb_subscribe_button").length )
                               	 	{
	                                	$j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text);
                                	}			                    
			               	 	}
							}
						})
	
						
						
					}
		})	    
        
    }



	

	
 async function mobileapp_subscribe_shortcode() {
    if( $j(".pnfpb_subscribe_button").length  && (pnfpb_pushtoken_fromflutter && pnfpb_pushtoken_fromflutter !== '') || (pnfpb_pushtoken_fromAndroid && pnfpb_pushtoken_fromAndroid != ''))
    {
	        // [START get_messaging_object]
            // Retrieve Firebase Messaging object.
            // [END get_messaging_object]
            // [START set_public_vapid_key]
            // Add the public key generated from the console here.
            // [END set_public_vapid_key]


			var subscriptionoptions = '00000000000';
		
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
		
			deviceid = false;
			
			if (pnfpb_pushtoken_fromflutter) {
							   
				deviceid = pnfpb_pushtoken_fromflutter;
				
			}
		
		
			if (deviceid) {
							   
							
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
					$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', true);
					$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
					$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
				}
				else 
				{
					$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', false);
				}
															
				if (subscriptionoptionsarray[5] === '1')
				{
					$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', true);
					$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
					$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
				}
				else 
				{
					$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', false);
				}
															
				if (subscriptionoptionsarray[6] === '1')
				{
  					$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', true);
					$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
					$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
				}
				else 
				{
					$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', false);
				}
															
				if (subscriptionoptionsarray[7] === '1')
				{
  					$j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').prop('checked', true);
					$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
					$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
				}
				else 
				{
					$j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').prop('checked', false);
				}
															
				if (subscriptionoptionsarray[8] === '1')
				{
  					$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', true);
					$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
					$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
				}
				else 
				{
					$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', false);
				}
															
				if (subscriptionoptionsarray[9] === '1')
				{
  					$j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').prop('checked', true);
					$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
					$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
				}
				else 
				{
					$j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').prop('checked', false);
				}															

				if (subscriptionoptionsarray[10] === '1')
				{
  					$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked', true);
					$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);
					$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked',false);
					$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
					$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);
					$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', false);
					$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', false);
					$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', false);
					$j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').prop('checked', false);
					$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', false);
					$j('#pnfpb_ic_subscribe_cover_image_shortcode_enable').prop('checked', false);
				}
				else 
				{
					$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked', false);
				}
							
										        
			    if (responseobject.subscriptionstatus == 'subscribed')
			    {
 					
                     if( $j(".pnfpb_subscribe_button").length )
                     {
	                                $j(".pnfpb_subscribe_button").html(pnfpb_ajax_object_push.subscribe_button_text);
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
		
	
		var subscriptionoptions = '00000000000';
  		var unsubscribeallshortcode = '1';
		var subscribemypostshortcode = '0';
		var subscribeallcommentsshortcode = '0';
		var subscribeprivatemessagesshortcode = '0';
		var subscribenewmembershortcode = '0';
		var subscribefriendshiprequestshortcode = '0';
		var subscribefriendshipacceptshortcode = '0';
		var subscribeuseravatarshortcode = '0';
		var subscribecoverimageshortcode = '0';
		var subscribepostactivitiesshortcode = '0'; 
		var subscribeallshortcode = '0';
		
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
					
				$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('disabled',false);								
  				subscribemypostshortcode = '1';
			}
			else 
			{
				subscribemypostshortcode = '0';
				if (pnfpb_ajax_object_push.isloggedin != 1) {
						$j('.pnfpb_ic_subscribe_my_post_shortcode_label_checkbox').html(__("Login required to subscribe notifications on comments from my Posts/my BuddyPress activities",'PNFPB_TD'));
						$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('disabled',true);
				}
				else 
				{
						$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('disabled',false);										
				}
			}
			
			if ($j('#pnfpb_ic_subscribe_private_message_shortcode_enable').is(":checked"))
			{
  				subscribeprivatemessagesshortcode = '1';
				subscribeallshortcode = '0'; 
				unsubscribeallshortcode = '0';
									
				$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
				$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
			}
			else 
			{
				subscribeprivatemessagesshortcode = '0';
			}
							
			if ($j('#pnfpb_ic_subscribe_new_member_shortcode_enable').is(":checked"))
			{
  				subscribenewmembershortcode = '1';
				subscribeallshortcode = '0'; 
				unsubscribeallshortcode = '0';
									
				$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
				$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
			}
			else 
			{

				subscribenewmembershortcode = '0';
			}
							
			if ($j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').is(":checked"))
			{
  				subscribefriendshiprequestshortcode = '1';
				subscribeallshortcode = '0'; 
				unsubscribeallshortcode = '0';
									
				$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
				$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
			}
			else 
			{
				subscribefriendshiprequestshortcode = '0';
			}
							
			if ($j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').is(":checked"))
			{
  				subscribefriendshipacceptshortcode = '1';
				subscribeallshortcode = '0'; 
				unsubscribeallshortcode = '0';
									
				$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
				$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
			}
			else 
			{
				subscribefriendshipacceptshortcode = '0';
			}
							
			if ($j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').is(":checked"))
			{
  				subscribeuseravatarshortcode = '1';
				subscribeallshortcode = '0'; 
				unsubscribeallshortcode = '0';
									
				$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
				$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
			}
			else 
			{
				subscribeuseravatarshortcode = '0';
			}
							
			if ($j('#pnfpb_ic_subscribe_cover_image_shortcode_enable').is(":checked"))
			{
  				subscribecoverimageshortcode = '1';
				subscribeallshortcode = '0'; 
				unsubscribeallshortcode = '0';
									
				$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
				$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
			}
			else 
			{
				subscribecoverimageshortcode = '0';
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
					subscribeprivatemessagesshortcode = '0';
					subscribenewmembershortcode = '0';
					subscribefriendshiprequestshortcode = '0';
					subscribefriendshipacceptshortcode = '0';
					subscribeuseravatarshortcode = '0';
					subscribecoverimageshortcode = '0';
									
					unsubscribeallshortcode = '0';	
									
					$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked',false);
					$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
					$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);
					$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked',false);
					$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked',false);
					$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked',false);
					$j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').prop('checked',false);
					$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked',false);
					$j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').prop('checked',false);
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
			
			if ($j("#pnfpb_ic_subscribe_private_message_shortcode_enable").on('click',function() {
								
				if ($j('#pnfpb_ic_subscribe_private_message_shortcode_enable').is(":checked"))
				{
  						subscribeprivatemessagesshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
									
							$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
							$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
					}
					else 
					{
							subscribeprivatemessagesshortcode = '0';
					}								
			}));

				if ($j('#pnfpb_ic_subscribe_new_member_shortcode_enable').on('click',function() {

					if ($j('#pnfpb_ic_subscribe_new_member_shortcode_enable').is(":checked"))
					{
  						subscribenewmembershortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
									
						$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
						$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
					}
					else 
					{

						subscribenewmembershortcode = '0';
					}								
				}));	
							
				if ($j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').on('click',function() {
								
					if ($j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').is(":checked"))
					{
  						subscribefriendshiprequestshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
									
						$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
						$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
					}
					else 
					{
						subscribefriendshiprequestshortcode = '0';
					}								
				}));
							
				if ($j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').on('click',function() {
								
					if ($j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').is(":checked"))
					{
  						subscribefriendshipacceptshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
									
						$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
						$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
					}
					else 
					{
						subscribefriendshipacceptshortcode = '0';
					}								
				}));
							
				if ($j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').on('click',function() {
								
					if ($j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').is(":checked"))
					{
  						subscribeuseravatarshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
									
						$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
						$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
					}
					else 
					{
						subscribeuseravatarshortcode = '0';
					}								
				}));
							
				if ($j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').on('click',function() {
								
					if ($j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').is(":checked"))
					{
  						subscribecoverimageshortcode = '1';
						subscribeallshortcode = '0'; 
						unsubscribeallshortcode = '0';
									
						$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
						$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);	
									
					}
					else 
					{
						subscribecoverimageshortcode = '0';
					}								
				}));							
			
							
			if ($j('#pnfpb_ic_unsubscribe_all_shortcode_enable').on('click',function() {
								
				if ($j('#pnfpb_ic_unsubscribe_all_shortcode_enable').is(":checked"))
				{
  						unsubscribeallshortcode = '1';
						subscribemypostshortcode = '0';
						subscribeallcommentsshortcode = '0';
						subscribeprivatemessagesshortcode = '0';
						subscribenewmembershortcode = '0';
						subscribefriendshiprequestshortcode = '0';
						subscribefriendshipacceptshortcode = '0';
						subscribeuseravatarshortcode = '0';
						subscribecoverimageshortcode = '0';
						subscribepostactivitiesshortcode = '0'; 
						subscribeallshortcode = '0';
									
						$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);
						$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked',false);
						$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
						$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);
						$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked',false);
						$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked',false);
						$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked',false);
						$j('#pnfpb_ic_subscribe_friendship_accepted_shortcode_enable').prop('checked',false);
						$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked',false);
						$j('#pnfpb_ic_subscribe_cover_image_change_shortcode_enable').prop('checked',false);								
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
					autoOpen: true,  
					resizable: false,
					height: "auto",
					closeText : '',
    				open: function(event, ui) {
        				//$j(".ui-dialog-titlebar-close").hide();
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
								 $j(this).dialog( "close" );
							}},
							{
            					text: pnfpb_subscribe_button_text,
	           					open: function() {
									$j(this).attr('style','font-weight:bold;color:'+pnfpb_ajax_object_push.subscribe_button_text_color+';background-color:'+pnfpb_ajax_object_push.subscribe_button_color+';border:0px');
            					},
            					click: function() {
									
									subscriptionoptions = subscribeallshortcode + subscribepostactivitiesshortcode + subscribeallcommentsshortcode + subscribemypostshortcode + subscribeprivatemessagesshortcode + subscribenewmembershortcode + subscribefriendshiprequestshortcode + subscribefriendshipacceptshortcode + subscribeuseravatarshortcode + subscribecoverimageshortcode + unsubscribeallshortcode;
							
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
														
										if (subscriptionoptionsarray.length >= 11)
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
												$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', true);
												$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
												$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', false);
											}
															
											if (subscriptionoptionsarray[5] === '1')
											{
												$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', true);
												$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
												$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', false);
											}
															
											if (subscriptionoptionsarray[6] === '1')
											{
  												$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', true);
												$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
												$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', false);
											}
															
											if (subscriptionoptionsarray[7] === '1')
											{
  												$j('#pnfpb_ic_subscribe_friendship_accept_shortcode_enable').prop('checked', true);
												$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
												$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_friendship_accept_shortcode_enable').prop('checked', false);
											}
															
											if (subscriptionoptionsarray[8] === '1')
											{
  												$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', true);
												$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
												$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', false);
											}
															
											if (subscriptionoptionsarray[9] === '1')
											{
  												$j('#pnfpb_ic_subscribe_cover_image_shortcode_enable').prop('checked', true);
												$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);	
												$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked',false);
											}
											else 
											{
												$j('#pnfpb_ic_subscribe_cover_image_shortcode_enable').prop('checked', false);
											}															

											if (subscriptionoptionsarray[10] === '1')
											{
  												$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked', true);
												$j('#pnfpb_ic_subscribe_all_shortcode_enable').prop('checked',false);
												$j('#pnfpb_ic_subscribe_post_activities_shortcode_enable').prop('checked',false);
												$j('#pnfpb_ic_subscribe_all_comments_shortcode_enable').prop('checked',false);
												$j('#pnfpb_ic_subscribe_my_post_shortcode_enable').prop('checked',false);
												$j('#pnfpb_ic_subscribe_private_message_shortcode_enable').prop('checked', false);
												$j('#pnfpb_ic_subscribe_new_member_shortcode_enable').prop('checked', false);
												$j('#pnfpb_ic_subscribe_friendship_request_shortcode_enable').prop('checked', false);
												$j('#pnfpb_ic_subscribe_friendship_accept_shortcode_enable').prop('checked', false);
												$j('#pnfpb_ic_subscribe_user_avatar_shortcode_enable').prop('checked', false);
												$j('#pnfpb_ic_subscribe_cover_image_shortcode_enable').prop('checked', false);
											}
											else 
											{
												$j('#pnfpb_ic_unsubscribe_all_shortcode_enable').prop('checked', false);
											}

										}
									        

							
										 });
							
								
										 //$j( "#pnfpb_subscribe_dialog_confirm" ).dialog( "close" );
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
 
  	if ($j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").length) {
  		$j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").hide();
  	}

  	$j(".pnfpb_pwa_shortcode_box").hide();

  	if ($j(".pnfpb_pwa_shortcode_box").length) {

		if ($j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").length) {
			$j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").show();
		}
	}

	var deferredPrompt;

	$j(".pnfpb_pwa_shortcode_box").show();
	var PNFPBcustominstallprompt = '';
	var allcookies  =  document.cookie;

	// Get all the cookies pairs in an array  
	var cookiearray = allcookies.split(';');  			

	// Now take key value pair out of this array  
	for(var i = 0; i<cookiearray.length; i++) {
		var cookiename  =  cookiearray[i].split('=')[0];
		var cookievalue  =  cookiearray[i].split('=')[1];
		if (cookievalue.trim() != 'Thu, 01 Jan 2029 00:00:00 UTC' && cookievalue.trim()) {
			PNFPBcustominstallprompt = cookievalue.trim();
			$j(".pnfpb_pwa_shortcode_box").hide();
		}
	}

	if ($j(".pnfpb_pwa_shortcode_box").length) 
	{
		$j(".pnfpb_pwa_shortcode_box").hide();
 		window.addEventListener('beforeinstallprompt', (e) => {
			e.preventDefault();
			deferredPrompt = e;
			$j(".pnfpb_pwa_shortcode_box").show();
			if (pnfpb_ajax_object_push.pwainstallpromptenabled === '1') {
				$j('.pnfpb-pwa-dialog-container').show();
				$j('#pnfpb-pwa-dialog-subscribe').on( "click", async function() {
					$j('.pnfpb-pwa-dialog-container').hide();
						if (deferredPrompt) {
							deferredPrompt.prompt();
							deferredPrompt.userChoice.then((response) => {
								if (response.outcome === 'accepted') {
									console.log(__('User accepted PWA installation','PNFPB_TD'));
									document.cookie = "PNFPB_pwa_prompt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
									$j(".pnfpb_pwa_shortcode_box").hide();
									deferredPrompt = null;								
								}
								else {
									console.log(__('User did not accept PWA installation.No thanks, I am good!','PNFPB_TD'));
									const d = new Date();
								  	d.setTime(d.getTime() + (5*24*60*60*1000));
								  	let expires = "expires="+ d.toUTCString();
								  	document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
									deferredPrompt = null;
									location.reload();
								}
							})
						}
				});

				$j('#pnfpb-pwa-dialog-cancel').on( "click", function() {
					$j('.pnfpb-pwa-dialog-container').hide();
					const d = new Date();
					  d.setTime(d.getTime() + (5*24*60*60*1000));
					  let expires = "expires="+ d.toUTCString();
					document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
						
				});
			} else {			
				$j( ".pnfpb_pwa_button" ).on("click", () => {
					if (deferredPrompt) {
						deferredPrompt.prompt();
						deferredPrompt.userChoice.then((response) => {
							if (response.outcome === 'accepted') {
								console.log(__('User accepted PWA installation','PNFPB_TD'));
								document.cookie = "PNFPB_pwa_prompt=; expires=Thu, 01 Jan 2029 00:00:00 UTC; path=/;";	
								if ($j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").length) {
									$j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").hide();
								}
								$j(".pnfpb_pwa_shortcode_box").hide();
								deferredPrompt = null;
							}
   							else {
   								console.log(__('User did not accept PWA installation. No thanks, I am good!','PNFPB_TD'));
								const d = new Date();
								d.setTime(d.getTime() + (5*24*60*60*1000));
								let expires = "expires="+ d.toUTCString();
								document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";						
								deferredPrompt = null;
								location.reload();
								if ($j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").length) {						
									$( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").show();
								}
								$j(".pnfpb_pwa_shortcode_box").show();
    						}
						})
					
					}
					else 
					{
						$j( "#pnfpb-pwa-dialog-ios" ).dialog({
							autoOpen: true,
							resizable: false,
							closeText : '',
							open: function(event, ui) {
							},			
							height: "auto",
							width: 350,
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
					}
				})
			}
		
		})
  	}
  	else 
	{
		$j(".pnfpb_pwa_shortcode_box").hide();
		$j('.pnfpb-pwa-dialog-container').hide();
		if (pnfpb_ajax_object_push.pwainstallpromptenabled === '1') {
			window.addEventListener('beforeinstallprompt', (e) => {
				e.preventDefault();
				deferredPrompt = e;
				if ($j(".pnfpb_pwa_shortcode_box").length && (!PNFPBcustominstallprompt || PNFPBcustominstallprompt == '')) {
					$j(".pnfpb_pwa_shortcode_box").show();
				}
				else {
					$j(".pnfpb_pwa_shortcode_box").hide();
				}
				$j('.pnfpb-pwa-dialog-container').show();
				$j('#pnfpb-pwa-dialog-subscribe').on( "click", async function() {
					$j('.pnfpb-pwa-dialog-container').hide();
						if (deferredPrompt) {
							deferredPrompt.prompt();
							deferredPrompt.userChoice.then((response) => {
								if (response.outcome === 'accepted') {
									console.log(__('User accepted PWA installation','PNFPB_TD'));
									document.cookie = "PNFPB_pwa_prompt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
									$j(".pnfpb_pwa_shortcode_box").hide();
									deferredPrompt = null;								
								}
    							else {
    								console.log(__('User did not accept PWA installation.No thanks, I am good!','PNFPB_TD'));
									const d = new Date();
  									d.setTime(d.getTime() + (5*24*60*60*1000));
  									let expires = "expires="+ d.toUTCString();
  									document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
									deferredPrompt = null;
									location.reload();
    							}
							})
						}
					});
	
					$j('#pnfpb-pwa-dialog-cancel').on( "click", function() {
						$j('.pnfpb-pwa-dialog-container').hide();
						const d = new Date();
  						d.setTime(d.getTime() + (5*24*60*60*1000));
  						let expires = "expires="+ d.toUTCString();
						document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
							
					});	
			})
		}
		else 
		{	
			window.addEventListener('beforeinstallprompt', (e) => {
				e.preventDefault();
				deferredPrompt = e;
				if (deferredPrompt) {
					deferredPrompt.prompt();
					deferredPrompt.userChoice.then((response) => {
						if (response.outcome === 'accepted') {
							console.log(__('User accepted PWA installation','PNFPB_TD'));
							document.cookie = "PNFPB_pwa_prompt=; expires=Thu, 01 Jan 2029 00:00:00 UTC; path=/;";	
							if ($j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").length) {
								$j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").hide();
							}
							$j(".pnfpb_pwa_shortcode_box").hide();
							deferredPrompt = null;
						
						}
					   	else {
						   console.log(__('User did not accept PWA installation. No thanks, I am good!','PNFPB_TD'));
							const d = new Date();
							d.setTime(d.getTime() + (5*24*60*60*1000));
							let expires = "expires="+ d.toUTCString();
							document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";						
							deferredPrompt = null;
							location.reload();
							if ($j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").length) {						
								$( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").show();
							}
							$j(".pnfpb_pwa_shortcode_box").show();
						}
					})
				
				}
				else 
				{
					$j( "#pnfpb-pwa-dialog-ios" ).dialog({
						autoOpen: true,
						resizable: false,
						closeText : '',
						open: function(event, ui) {
						},			
						height: "auto",
						width: 350,
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
				}
			})	
  		}
	}
 

	window.addEventListener('appinstalled', function(evt){
		document.cookie = "PNFPB_pwa_prompt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
		$j( "#pnfpb-pwa-dialog-app-installed" ).dialog({
			autoOpen: true,
			resizable: false,
			closeText : '',
			open: function(event, ui) {
				//$j(".ui-dialog-titlebar-close").hide();
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

function getCookie(cname) {
  console.log(cname);
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
		console.log(name);
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

}

});
  // END jQuery ready function
});