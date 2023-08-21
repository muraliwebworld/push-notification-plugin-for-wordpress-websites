import { initializeApp, getApp } from 'firebase/app';
import { getMessaging as getMessagingsw, onBackgroundMessage} from "firebase/messaging/sw";

// Your web app Firebase configuration
var firebaseConfigsw = {
    apiKey: "<?php echo get_option( 'pnfpb_ic_fcm_api' ); ?>",
    authDomain: "<?php echo get_option( 'pnfpb_ic_fcm_authdomain' ); ?>",
    databaseURL: "<?php echo get_option( 'pnfpb_ic_fcm_databaseurl' ); ?>",
    projectId: "<?php echo get_option( 'pnfpb_ic_fcm_projectid' ); ?>",
    storageBucket: "<?php echo get_option( 'pnfpb_ic_fcm_storagebucket' ); ?>",
    messagingSenderId: "<?php echo get_option( 'pnfpb_ic_fcm_messagingsenderid' ); ?>",
    appId: "<?php echo get_option( 'pnfpb_ic_fcm_appid' ); ?>",
};
var projectidicpush = "<?php echo get_option( 'pnfpb_ic_fcm_projectid' ); ?>";

function createFirebaseAppsw(config) {
    try {
        return getApp()
    } catch {
        return initializeApp(config)
    }
}

var firebaseAppsw = createFirebaseAppsw(firebaseConfigsw)

var messagingsw = getMessagingsw(firebaseAppsw);

//var hasFirebaseMessagingSupport = await isSupported();

if (projectidicpush != false && projectidicpush != '') {
    // Initialize Firebase
    //var firebaseApp = createFirebaseApp(firebaseConfig)

    //const messagingsw = getMessaging();
    // [END initialize_firebase_in_sw]

    // If you would like to customize notifications that are received in the
    // background (Web app is closed or not in browser focus) then you should
    // implement this optional method.
    // [START background_handler]
    /*messaging.setBackgroundMessageHandler(function(payload) {
        console.log('[icpush-sw.js] Received background message ', payload);
        const notification = JSON.parse(payload.data.notification);
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
        return self.registration.showNotification(notificationTitle,
        notificationOptions);
    });*/
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
        
        self.registration.showNotification(notificationTitle,
          notificationOptions);
      });
    // [END background_handler]


}