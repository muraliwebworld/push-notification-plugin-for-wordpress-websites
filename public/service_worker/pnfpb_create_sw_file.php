<?php

/**
* Create service worker, Firebase service worker  dynamically (on the fly) for push notifications
*
* @since 1.0.0
*/

//check for  function called "PNFPB_icfm_icpush_add_rewrite_rules" or "PNFPB_icfm_icpush_generate_sw"  if it doesn't already exist

if ( !function_exists( 'PNFPB_icfm_icpush_add_rewrite_rules' ) && !function_exists( 'PNFPB_icfm_icpush_generate_sw' ) ) {
	
	add_action( 'init', 'PNFPB_icfm_icpush_add_rewrite_rules' );

	add_action( 'parse_request', 'PNFPB_icfm_icpush_generate_sw' );
	
}

// Rewrite rules to create service worker, fire base service worker and manifest dynamically
if ( !function_exists( 'PNFPB_icfm_icpush_add_rewrite_rules' )) {
	
	function PNFPB_icfm_icpush_add_rewrite_rules() {
		$sw_filename = home_url( '/' ).'pnfpb_icpush_sw.js';
		add_rewrite_rule( "^/{$sw_filename}$","index.php?{$sw_filename}=1");
		
		$sw_filename_firebasesw = home_url( '/' ).'firebase-messaging-sw.js';
		add_rewrite_rule( "^/{$sw_filename_firebasesw}$","index.php?{$sw_filename_firebasesw}=1");
		
	}
}

// Create service worker, firebase service worker and manifest dynamically
if ( !function_exists( 'PNFPB_icfm_icpush_generate_sw' )) {
	function PNFPB_icfm_icpush_generate_sw( $query ) {
		if ( ! property_exists( $query, 'query_vars' ) || ! is_array( $query->query_vars ) ) {
		return;
		}
		$query_vars_as_string = implode( ' ', $query->query_vars );
		$sw_filename = 'pnfpb_icpush_sw.js';
		$sw_filename_firebasesw = 'firebase-messaging-sw.js';
		if ($query_vars_as_string != '') {
			if ($sw_filename != trim($query_vars_as_string)) {
				if ($sw_filename_firebasesw != trim($query_vars_as_string)) {
					return;
				}
				else
				{
					header( 'Content-Type: text/javascript' );
					echo PNFPB_icfm_icpush_firebasesw_template();
					exit();
				}
			}
			else
			{
				header( 'Content-Type: text/javascript' );
				echo PNFPB_icfm_icpush_sw_template();
				exit();
			}
		}

	}

}

// Service worker template
if ( !function_exists( 'PNFPB_icfm_icpush_sw_template' )) {
	
	function PNFPB_icfm_icpush_sw_template() {
	
		ob_start();  ?>
		'use strict';


		self.addEventListener('notificationclick', function(event) {
			event.notification.close();
			event.waitUntil(self.clients.openWindow(event.notification.data.url + "?notification_id=" + event.notification.data.id));
		});


		<?php return apply_filters( 'PNFPB_icfm_icpush_sw_template', ob_get_clean() );
	}

}

// Firebase cloud messaging service worker template
if ( !function_exists( 'PNFPB_icfm_icpush_firebasesw_template' )) {
	
	function PNFPB_icfm_icpush_firebasesw_template() {

		ob_start();  ?>
'use strict';


var firebaseappurl = '<?php echo plugin_dir_url( __DIR__ )."js/firebase-core/pnfpb_firebase_app.js"; ?>';
var firebasemsg = '<?php echo plugin_dir_url( __DIR__ )."js/firebase-core/pnfpb_firebase_messaging.js"; ?>';

importScripts(firebaseappurl);
importScripts(firebasemsg);

// Your web app Firebase configuration
var firebaseConfig = {
			apiKey: "<?php echo get_option( 'pnfpb_ic_fcm_api' ); ?>",
			authDomain: "<?php echo get_option( 'pnfpb_ic_fcm_authdomain' ); ?>",
			databaseURL: "<?php echo get_option( 'pnfpb_ic_fcm_databaseurl' ); ?>",
			projectId: "<?php echo get_option( 'pnfpb_ic_fcm_projectid' ); ?>",
			storageBucket: "<?php echo get_option( 'pnfpb_ic_fcm_storagebucket' ); ?>",
			messagingSenderId: "<?php echo get_option( 'pnfpb_ic_fcm_messagingsenderid' ); ?>",
			appId: "<?php echo get_option( 'pnfpb_ic_fcm_appid' ); ?>",
		};
		var projectidicpush = "<?php echo get_option( 'pnfpb_ic_fcm_projectid' ); ?>";
		if (projectidicpush != false && projectidicpush != '') {
			// Initialize Firebase
			firebase.initializeApp(firebaseConfig);
			//firebase.analytics();


			// Retrieve an instance of Firebase Messaging so that it can handle background
			// messages.
			const messaging = firebase.messaging();
			// [END initialize_firebase_in_sw]

			// If you would like to customize notifications that are received in the
			// background (Web app is closed or not in browser focus) then you should
			// implement this optional method.
			// [START background_handler]
			messaging.setBackgroundMessageHandler(function(payload) {
				console.log('[icpush-sw.js] Received background message ', payload);
				const notification = JSON.parse(payload.data.notification);
				// Customize notification here
				const notificationTitle = notification.title;
				const notificationOptions = {
					body: notification.body,
					icon: notification.icon,
					data: {
					url: notification.click_action
					}

				};
				return self.registration.showNotification(notificationTitle,
				notificationOptions);
			});
			// [END background_handler]


		}
		

		<?php return apply_filters( 'PNFPB_icfm_icpush_firebasesw_template', ob_get_clean() );
	}
}


?>