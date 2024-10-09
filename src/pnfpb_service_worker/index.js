

"use strict";

Object.defineProperty(exports, "__esModule", { value: true });

import { getApp, initializeApp } from 'firebase/app';
import { getMessaging, onBackgroundMessage } from "firebase/messaging/sw";


    var firebaseConfigsw = {};

    var firebaseAppsw;
			
    var messagingsw;

    var hasFirebaseMessagingSupportsw;

    function createFirebaseAppsw(config) {

        try {

            return getApp()

        } catch {

            return initializeApp(config)

        }

    }


	firebaseConfigsw = {
		apiKey: "<?php echo get_option( 'pnfpb_ic_fcm_api' ); ?>",
		projectId: "<?php echo get_option( 'pnfpb_ic_fcm_projectid' ); ?>",
		appId: "<?php echo get_option( 'pnfpb_ic_fcm_publickey' ); ?>",
        messagingSenderId: "<?php echo get_option( 'pnfpb_ic_fcm_messagingsenderid' ); ?>"
	};

	firebaseAppsw = createFirebaseAppsw(firebaseConfigsw)
			
	messagingsw = getMessaging(firebaseAppsw);
			
	//hasFirebaseMessagingSupportsw = await isSupported();

        // Initialize Firebase

       /* onMessage(messagingsw,(payload) => {

            //console.log('Foreground push Message received. ', payload);
            // [START_EXCLUDE]
            // Update the UI to include the received message.
            //appendMessage(payload);
            //alert(payload.notification.click_action);
        
             var notification = {};

            if (payload.data) {

                notification = JSON.parse(payload.data.json().notification);

            }

            // Customize notification here
             const notificationTitle = notification.title;
            const notificationOptions = {
                body: notification.body,
                image: notification.image,
                icon: notification.icon,
                data: {
                    url: notification.click_action
                }

            };
        
            self.registration.showNotification(notificationTitle,notificationOptions);


        }) */                  

        onBackgroundMessage(messagingsw, (payload) => {

            console.log('[firebase-messaging-sw.js] Received background message ', payload);

            //payload.stopImmediatePropagation();
            // Customize notification here

            var notification = {};

            if (payload.data) {

                notification = JSON.parse(payload.data.json().notification);

            }
            
            // Customize notification here            
            
            const notificationTitle = notification.title;

            const notificationOptions = {

                body: notification.body,
                image: notification.image,
                icon: notification.icon,
                data: {
                     url: notification.click_action
                 }

            };
        
            self.registration.showNotification(notificationTitle,notificationOptions);
        });

		self.addEventListener("notificationclick",(event) => {
			event.preventDefault();
			if (event.action === "read_more") {
				event.notification.close();
 				// This looks to see if the current is already open and
 				// focuses if it is
 				event.waitUntil(clients.matchAll({
 					type: "window"
 				}).then((clientList) => {
 					for (client of clientList) {
 						if (client.url === event.notification.data.url && 'focus' in client) {
        					return client.focus();
						}

    				}
    				if (clients.openWindow) {
      					return clients.openWindow(event.notification.data.url)
					}
  				}))
    		} else {
				if (event.action === "custom_url") {

					var pnfpb_custom_click_action_url = "<?php echo get_option('pnfpb_ic_custom_click_action_url') ?>";

					event.notification.close();
  					// This looks to see if the current is already open and
  					// focuses if it is
  					event.waitUntil(clients.matchAll({
    					type: "window"
  					}).then((clientList) => {
    					for (const client of clientList) {
      						if (client.url === pnfpb_custom_click_action_url && 'focus' in client)
        						return client.focus();
    					}
    					if (clients.openWindow)
      						return clients.openWindow(pnfpb_custom_click_action_url);
  					}))					
				} else {
					if (event.action === "close_notification") {
						event.notification.close();
					} else {

						event.notification.close();
  						// This looks to see if the current is already open and
  						// focuses if it is
  						event.waitUntil(clients.matchAll({
    						type: "window"
  						}).then((clientList) => {
    						for (const client of clientList) {
      							if (client.url === event.notification.data.url && 'focus' in client)
        							return client.focus();
    						}
    						if (clients.openWindow)
      							return clients.openWindow(event.notification.data.url);
  						}))
					}
				}
			}
		},
		false,
		);       
        // [END background_handler]
