//
//Script to send push notification using Firebase
//
//@since 1.0.0
//
"use strict";

Object.defineProperty(exports, "__esModule", { value: true });

import { getAnalytics, logEvent } from "firebase/analytics";
import { getApp, initializeApp } from 'firebase/app';
import { deleteToken, getMessaging, getToken, isSupported } from "firebase/messaging";

import { __ } from '@wordpress/i18n';

import $ from "jquery";

import 'jquery-ui-dist/jquery-ui';

var $j = $.noConflict();

var frontendsubscriptionOptions;

var pnfpbuserid;

if (window.webkit && window.webkit.messageHandlers && window.webkit.messageHandlers.pnfpbuserid) {
	window.webkit.messageHandlers.pnfpbuserid.postMessage({
				  "message": pnfpb_ajax_object_push.userid
	});
}

var deviceid = '100000000000';

var vapidKey = '';

var pnfpb_ic_custom_click_action_url = '';

var firebaseConfig = {};

var firebaseApp;
			
var messaging;

var hasFirebaseMessagingSupport;

var pnfpb_bell_prompt_processing = '';

var pnfpb_subscription_options = '0';

function createFirebaseApp(config) {
    try {
        return getApp()
    } catch {
        return initializeApp(config)
    }
}

var pnfpb_pushtoken_fromflutter ;
var pnfpb_pushtoken_fromAndroid;
var Android;


var pnfpb_bell_icon_subscribe_push_type_checkbox = [];
var pnfpb_bell_icon_subscribe_custom_post_checkbox = [];


var pnfpb_bell_icon_subscription_options_custom_prompt = '10000000000000';


var pnfpb_bell_icon_prompt_subscribe_push_type_checkbox = [];
var pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox = [];

var pnfpb_bell_icon_shortcode_subscribe_favourite_checkbox = '0';

var pnfpb_bell_icon_front_subscribe_favourite_checkbox = '0';

var pnfpb_bell_icon_subscribe_favourite_checkbox = '0';

var pnfpb_bell_icon_prompt_subscribe_favourite_checkbox = '0';

var pnfpb_bell_icon_shortcode_subscribe_followers_checkbox = '0';

var pnfpb_bell_icon_front_subscribe_followers_checkbox = '0';

var pnfpb_bell_icon_subscribe_followers_checkbox = '0';

var pnfpb_bell_icon_prompt_subscribe_followers_checkbox = '0';

var pnfpb_front_end_settings = [];

var pnfpb_front_end_settings_custom_post_types = ['0','0','0','0','0','0','0','0','0','0','0','1'];

var pnfpb_shortcode_settings_custom_post_types = [];

var pnfpb_bell_icon_prompt_subscription_options_custom_prompt = '10000000000000';

var pnfpb_custom_post_types = JSON.parse(pnfpb_ajax_object_push.pnfpb_show_custom_post_types);


for (var pnfpb_custom_type_element = 0; pnfpb_custom_type_element < pnfpb_custom_post_types.length; pnfpb_custom_type_element++) {

	if (pnfpb_custom_post_types[pnfpb_custom_type_element] !== 'buddypress') {

		pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox.push('0');

		pnfpb_bell_icon_subscribe_custom_post_checkbox.push('0');

	}

}

var pnfpb_show_push_notify_types = JSON.parse(pnfpb_ajax_object_push.pnfpb_show_push_notify_types);

var pnfpb_front_end_settings_push_notify_types = JSON.parse(pnfpb_ajax_object_push.pnfpb_front_end_settings_push_notify_types);

var pnfpb_show_push_notify_admin_types = ['activities','comments','mycomments','privatemessage','newmember','friend_request','friend_accept','avatar_change','coverimage_change'];

var pnfpb_shortcode_installed = false;

if (pnfpb_ajax_object_push.pnfpb_shortcode_installed && pnfpb_ajax_object_push.pnfpb_shortcode_installed === "1") {
	pnfpb_shortcode_installed = true;
}

$j(function() {

var data = {
	action: 'icpushcallback',
	device_id:'',
	nonce: pnfpb_ajax_object_push.nonce,
	subscriptionoptions:'',
	pushtype: 'icfirebasecred'
};

let deferredPrompt;

var PNFPBcustominstallprompt = '';

var standalone = window.navigator.standalone,
  userAgent_pnfpb = window.navigator.userAgent.toLowerCase(),
  safari_pnfpb =/^(?!.*chrome).*safari/i.test(userAgent_pnfpb),
  ios_pnfpb = /iphone|ipod|ipad/.test(userAgent_pnfpb);
	
var pnfpb_webview = false;
var pnfpb_ios_browser = false;

if (!standalone && safari_pnfpb) {
    // safari_pnfpb
    pnfpb_webview = false;
	pnfpb_ios_browser = true;
  } else if (!standalone && !safari_pnfpb) {
    // ios_pnfpb webview
    pnfpb_webview = true;
	//PNFPB_from_Java_androidapp();
	//PNFPB_from_Flutter_mobileapp();	  	
  };

  if (userAgent_pnfpb.includes('wv') && ios_pnfpb) {
    // Android webview
    pnfpb_webview = true;
	//PNFPB_from_Java_androidapp();
	//PNFPB_from_Flutter_mobileapp();	  
  } else {
    // Chrome
    pnfpb_webview = false;
  }
 

const pnfpb_localStorageKey = "pnfpb_ios_pwa_install_check";

const pnfpb_isIos = /iphone|ipad|ipod/.test(userAgent_pnfpb);

// check if the device is in standalone mode
const pnfpb_isInStandaloneMode = "standalone" in window.navigator && window.navigator.standalone
if (pnfpb_isInStandaloneMode) {
	localStorage.setItem(pnfpb_localStorageKey, "true");
}

// show the modal only once
const pnfpb_localStorageKeyValue = localStorage.getItem(pnfpb_localStorageKey);
const pnfpb_iosInstallModalShown = pnfpb_localStorageKeyValue
	? JSON.parse(pnfpb_localStorageKeyValue)
	: false;

const shouldShowModalResponse =
	(pnfpb_isIos || safari_pnfpb) && !pnfpb_isInStandaloneMode && !pnfpb_iosInstallModalShown;

if (shouldShowModalResponse && !$j(".pnfpb_pwa_shortcode_box").length && pnfpb_ajax_object_push.pnfpb_ic_ios_pwa_prompt_disable !== '1') {

	let name = 'PNFPB_pwa_prompt' + "=";

	let decodedCookie = decodeURIComponent(document.cookie);

	let ca = decodedCookie.split(';');

	for(let i = 0; i <ca.length; i++) {

		let c = ca[i];

		while (c.charAt(0) == ' ') {

			  c = c.substring(1);

		}

		if (c.indexOf(name) == 0) {

			if (c.substring(name.length, c.length) !== 'Thu, 01 Jan 2029 00:00:00 UTC') {

				PNFPBcustominstallprompt = c.substring(name.length, c.length);

			}			
		}
	}
	
	if (PNFPBcustominstallprompt === '') {

		$j('.pnfpb-pwa-dialog-ios-container').show();

		$j('#pnfpb-pwa-dialog-ios-cancel').on( "click", function() {

			$j('.pnfpb-pwa-dialog-ios-container').hide();

			const pnfpb_d = new Date();

			let expires = "expires="

			if (pnfpb_d.getTime) {

				const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_ic_ios_pwa_prompt_reappear);

				pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));

				expires = "expires="+ pnfpb_d.toUTCString();

			}

			document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";					

		});
	} else {
		$j('.pnfpb-pwa-dialog-ios-container').hide();
	}
} 

if ((pnfpb_isIos || safari_pnfpb) && pnfpb_ajax_object_push.pnfpb_ic_ios_pwa_prompt_disable !== '1') {

	if ($j(".pnfpb_pwa_shortcode_box").length) {

		$j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").show();

		$j( ".pnfpb_pwa_shortcode_box" ).parent(".widget_block").show();

		$j(".pnfpb_pwa_shortcode_box").show();

		$j( ".pnfpb_pwa_button" ).on("click", () => {

			$j('.pnfpb-pwa-dialog-ios-container').show();

		});
		
		$j('#pnfpb-pwa-dialog-ios-cancel').on( "click", function() {

			$j('.pnfpb-pwa-dialog-ios-container').hide();
		});		

	} else  {

		$j(".pnfpb_pwa_shortcode_box").hide();

		$j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").hide();

		$j( ".pnfpb_pwa_shortcode_box" ).parent(".widget_block").hide();
	}
	
} else {

	$j('.pnfpb-pwa-dialog-ios-container').hide();

}

window.addEventListener('beforeinstallprompt', (e) => {

	e.preventDefault();

	deferredPrompt = e;

	if (deferredPrompt && $j(".pnfpb_pwa_shortcode_box").length) {

		$j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").show();

		$j( ".pnfpb_pwa_shortcode_box" ).parent(".widget_block").show();

		$j(".pnfpb_pwa_shortcode_box").show();

	} else  {

		$j(".pnfpb_pwa_shortcode_box").hide();

		$j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").hide();

		$j( ".pnfpb_pwa_shortcode_box" ).parent(".widget_block").hide();

	}
	
	if (pnfpb_ajax_object_push.pwainstallpromptenabled === '1' || $j('.pnfpb-pwa-dialog-container').length) {

		$j('.pnfpb-pwa-dialog-container').hide();
	}

	let name = 'PNFPB_pwa_prompt' + "=";

	let decodedCookie = decodeURIComponent(document.cookie);

	let ca = decodedCookie.split(';');

	for(let i = 0; i <ca.length; i++) {

		let c = ca[i];

		while (c.charAt(0) == ' ') {

			  c = c.substring(1);

		}

		if (c.indexOf(name) == 0) {

			if (c.substring(name.length, c.length) !== 'Thu, 01 Jan 2029 00:00:00 UTC') {

				PNFPBcustominstallprompt = c.substring(name.length, c.length);


				if (pnfpb_ajax_object_push.pwainstallpromptenabled === '1' || $j('.pnfpb-pwa-dialog-container').length) {

					$j('.pnfpb-pwa-dialog-container').hide();

				}				

			}			
		}
	}	

	$j( ".pnfpb_pwa_button" ).on("click", () => {

		$j(".pnfpb-pwa-ios-message-layout").hide();
		$j(".pnfpb-pwa-ios-message-container").hide();	

		if (deferredPrompt) {

			deferredPrompt.prompt();
			deferredPrompt.userChoice.then((response) => {
				if (response.outcome === 'accepted') {
					console.log(__('User accepted PWA installation','push-notification-for-post-and-buddypress'));
					//document.cookie = "PNFPB_pwa_prompt=; expires=Thu, 01 Jan 2029 00:00:00 UTC; path=/;";	
					if ($j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").length) {
						$j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").hide();
					}
					$j(".pnfpb_pwa_shortcode_box").hide();
					deferredPrompt = null;
				}
				   else {
					   console.log(__('User did not accept PWA installation. No thanks, I am good!','push-notification-for-post-and-buddypress'));
					const pnfpb_d = new Date();
					let expires = "expires="
					if (pnfpb_d.getTime) {
						const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_show_again_days);
						pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));
						expires = "expires="+ pnfpb_d.toUTCString();
					}
					document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";						
					deferredPrompt = null;
					location.reload();
					if ($j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").length) {						
						$j( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").show();
					}
					$j(".pnfpb_pwa_shortcode_box").show();
				}
			})
		
		}
		else 
		{
			if (pnfpb_ios_browser && pnfpb_ajax_object_push.pnfpb_ic_ios_pwa_prompt_disable !== '1') {

				$j(".pnfpb-pwa-ios-message-layout").show();

				$j(".pnfpb-pwa-ios-message-container").show();

			} else {

				if (pnfpb_ajax_object_push.pnfpb_ic_ios_pwa_prompt_disable === '1') {

					$j(".pnfpb-pwa-ios-message-layout").hide();

					$j(".pnfpb-pwa-ios-message-container").hide();
				}

				$j('#pnfpb-pwa-dialog-ios-cancel').on( "click", function() {

					$j('.pnfpb-pwa-dialog-ios-container').hide();
		
					const pnfpb_d = new Date();
		
					let expires = "expires="
		
					if (pnfpb_d.getTime) {
		
						const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_ic_ios_pwa_prompt_reappear);
		
						pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));
		
						expires = "expires="+ pnfpb_d.toUTCString();
		
					}
		
					document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";					
		
				});
			}			
		}
	})

	if (deferredPrompt && pnfpb_ajax_object_push.pwainstallpromptenabled === '1' && PNFPBcustominstallprompt == '') {
		$j('.pnfpb-pwa-dialog-container').show();
		$j('#pnfpb-pwa-dialog-subscribe').on( "click", async function() {
			$j('.pnfpb-pwa-dialog-container').hide();
				if (deferredPrompt) {
					deferredPrompt.prompt();
					deferredPrompt.userChoice.then((response) => {
						if (response.outcome === 'accepted') {
							console.log(__('User accepted PWA installation','push-notification-for-post-and-buddypress'));
							//document.cookie = "PNFPB_pwa_prompt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
							$j(".pnfpb_pwa_shortcode_box").hide();
							deferredPrompt = null;								
						}
						else {
							if (response.outcome === 'dismissed') {
								console.log(__('User did not accept PWA installation.No thanks, I am good!','push-notification-for-post-and-buddypress'));
								const pnfpb_d = new Date();
								let expires = "expires=";
								if (pnfpb_d.getTime) {
									const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_show_again_days);
								  	pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));
								  	expires = "expires="+ pnfpb_d.toUTCString();
								}
								document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
								deferredPrompt = null;
								location.reload();
							}
						}
					})
				}
		});

		$j('#pnfpb-pwa-dialog-cancel').on( "click", function() {
			$j('.pnfpb-pwa-dialog-container').hide();
			const pnfpb_d = new Date();
			let expires = "expires=";
			if (pnfpb_d.getTime) {			
				const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_show_again_days);
			  	pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));
			  	expires = "expires="+ pnfpb_d.toUTCString();
			}
			document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
				
		});
	} else {
		if (deferredPrompt && pnfpb_ajax_object_push.pwadesktopinstallpromptenabled === '1' && PNFPBcustominstallprompt == '' && !pnfpb_webview) {
			$j('.pnfpb-pwa-dialog-container').show();
			$j('#pnfpb-pwa-dialog-subscribe').on( "click", async function() {
				$j('.pnfpb-pwa-dialog-container').hide();
					if (deferredPrompt) {
						deferredPrompt.prompt();
						deferredPrompt.userChoice.then((response) => {
							if (response.outcome === 'accepted') {
								console.log(__('User accepted PWA installation','push-notification-for-post-and-buddypress'));
								//document.cookie = "PNFPB_pwa_prompt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
								$j(".pnfpb_pwa_shortcode_box").hide();
								deferredPrompt = null;								
							}
							else {
								if (response.outcome === 'dismissed') {
									console.log(__('User did not accept PWA installation.No thanks, I am good!','push-notification-for-post-and-buddypress'));
									const pnfpb_d = new Date();
									let expires = "expires=";
									if (pnfpb_d.getTime) {
										const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_show_again_days);
									  	pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));
									  	expires = "expires="+ pnfpb_d.toUTCString();
									}
									document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
									deferredPrompt = null;
									location.reload();
								}
							}
						})
					}
			});
	
			$j('#pnfpb-pwa-dialog-cancel').on( "click", function() {
				$j('.pnfpb-pwa-dialog-container').hide();
				const pnfpb_d = new Date();
				let expires = "expires=";
				if (pnfpb_d.getTime) {
					const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_show_again_days);
				 	pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));
				  	expires = "expires="+ pnfpb_d.toUTCString();
				}
				document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
					
			});			
		} else {
			if (deferredPrompt && pnfpb_ajax_object_push.pwamobileinstallpromptenabled === '1' && PNFPBcustominstallprompt == '' && pnfpb_webview) {
				$j('.pnfpb-pwa-dialog-container').show();
				$j('#pnfpb-pwa-dialog-subscribe').on( "click", async function() {
					$j('.pnfpb-pwa-dialog-container').hide();
					if (deferredPrompt) {
						deferredPrompt.prompt();
						deferredPrompt.userChoice.then((response) => {
							if (response.outcome === 'accepted') {
								console.log(__('User accepted PWA installation','push-notification-for-post-and-buddypress'));
								//document.cookie = "PNFPB_pwa_prompt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
								$j(".pnfpb_pwa_shortcode_box").hide();
								deferredPrompt = null;								
							}
							else {
								if (response.outcome === 'dismissed') {
									console.log(__('User did not accept PWA installation.No thanks, I am good!','push-notification-for-post-and-buddypress'));
									const pnfpb_d = new Date();
									let expires = "expires=";
									if (pnfpb_d.getTime) {									
										const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_show_again_days);
									  	pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));
									  	expires = "expires="+ pnfpb_d.toUTCString();
									}
									  document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
									deferredPrompt = null;
									location.reload();
								}
							}
						})
					}
				});
	
				$j('#pnfpb-pwa-dialog-cancel').on( "click", function() {
					$j('.pnfpb-pwa-dialog-container').hide();
					const pnfpb_d = new Date();
					let expires = "expires=";
					if (pnfpb_d.getTime) {						
						const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_show_again_days);
						pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));
				 	 	expires = "expires="+ pnfpb_d.toUTCString();
					}
					document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
					
				});
			} else {
				if (deferredPrompt && pnfpb_ajax_object_push.pwapixelsinstallpromptenabled === '1' && PNFPBcustominstallprompt == '' && window.innerWidth > pnfpb_ajax_object_push.pwapixelsinputinstallpromptenabled) {
					$j('.pnfpb-pwa-dialog-container').show();
					$j('#pnfpb-pwa-dialog-subscribe').on( "click", async function() {
						$j('.pnfpb-pwa-dialog-container').hide();
						if (deferredPrompt) {
							deferredPrompt.prompt();
							deferredPrompt.userChoice.then((response) => {
								if (response.outcome === 'accepted') {
									console.log(__('User accepted PWA installation','push-notification-for-post-and-buddypress'));
									//document.cookie = "PNFPB_pwa_prompt=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
									$j(".pnfpb_pwa_shortcode_box").hide();
									deferredPrompt = null;								
								}
								else {
									if (response.outcome === 'dismissed') {
										console.log(__('User did not accept PWA installation.No thanks, I am good!','push-notification-for-post-and-buddypress'));
										const pnfpb_d = new Date();
										let expires = "expires=";
										if (pnfpb_d.getTime) {												
											const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_show_again_days);
											pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));
										  	expires = "expires="+ pnfpb_d.toUTCString();
										}
										document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
										deferredPrompt = null;
										location.reload();
									}
								}
							})
						}
					});
		
					$j('#pnfpb-pwa-dialog-cancel').on( "click", function() {
						$j('.pnfpb-pwa-dialog-container').hide();
						const pnfpb_d = new Date();
						let expires = "expires=";
						if (pnfpb_d.getTime) {							
							const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_show_again_days);
							pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));
						  	expires = "expires="+ pnfpb_d.toUTCString();
						}
						document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
						
					});

				} else {
						if (pnfpb_ios_browser) {
							
							$j('#pnfpb-pwa-dialog-ios-cancel').on( "click", function() {

								$j('.pnfpb-pwa-dialog-ios-container').hide();
					
								const pnfpb_d = new Date();
					
								let expires = "expires="
					
								if (pnfpb_d.getTime) {
					
									const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_ic_ios_pwa_prompt_reappear);
					
									pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));
					
									expires = "expires="+ pnfpb_d.toUTCString();
					
								}
					
								document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";					
					
							});				
						}
					}

				}

			}
		}	
	});

window.addEventListener('appinstalled', function(evt) {

	var pnfpb_screenWidth, pnfpb_screenHeight, pnfpb_dialogWidth, pnfpb_dialogHeight, pnfpb_isDesktop;    
	pnfpb_screenWidth = window.screen.width;
	pnfpb_screenHeight = window.screen.height;    

	if (pnfpb_screenWidth < 500) {
		pnfpb_dialogWidth = pnfpb_screenWidth * .95;
		pnfpb_dialogHeight = pnfpb_screenHeight * .95;
	} else {
		pnfpb_dialogWidth = 500;
		pnfpb_dialogHeight = 500;
		pnfpb_isDesktop = true;
	}		

	$j("#pnfpb-pwa-dialog-app-installed" ).dialog({
		autoOpen: true,
		resizable: false,
		closeText : '',
		open: function(event, ui) {
		},			
		width: pnfpb_dialogWidth,
		maxWidth:600,
		closeOnEscape: false,
		draggable: false,
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

$j.post(pnfpb_ajax_object_push.ajax_url, data, async function(responseajax) {

	var firebasecredentialsobject = JSON.parse(responseajax);

	if (firebasecredentialsobject.apiKey && firebasecredentialsobject.apiKey != '') {

			if (pnfpb_ajax_object_push.pnfpb_ic_fcm_measurementId && pnfpb_ajax_object_push.pnfpb_ic_fcm_measurementId !== '') {
				firebaseConfig = {
					apiKey: firebasecredentialsobject.apiKey,
					authDomain: firebasecredentialsobject.authDomain,
					databaseURL: firebasecredentialsobject.databaseURL,
					projectId: firebasecredentialsobject.projectId,
					storageBucket: firebasecredentialsobject.storageBucket,
					messagingSenderId: firebasecredentialsobject.messagingSenderId,
					appId: firebasecredentialsobject.appId,
					measurementId:pnfpb_ajax_object_push.pnfpb_ic_fcm_measurementId
				};
				console.log('Firebase Analytics enabled');
			} else {
				firebaseConfig = {
					apiKey: firebasecredentialsobject.apiKey,
					authDomain: firebasecredentialsobject.authDomain,
					databaseURL: firebasecredentialsobject.databaseURL,
					projectId: firebasecredentialsobject.projectId,
					storageBucket: firebasecredentialsobject.storageBucket,
					messagingSenderId: firebasecredentialsobject.messagingSenderId,
					appId: firebasecredentialsobject.appId
				};
			}

			vapidKey = firebasecredentialsobject.publicKey

			pnfpb_ic_custom_click_action_url = firebasecredentialsobject.click_action_url;
			
			hasFirebaseMessagingSupport = await isSupported();

			if (hasFirebaseMessagingSupport) {
				firebaseApp = createFirebaseApp(firebaseConfig);
				messaging = getMessaging(firebaseApp);
			}


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
	
if (pnfpb_ajax_object_push.pwainstallbuttontext === '') {
	pnfpb_ajax_object_push.pwainstallbuttontext = __('Install PWA app','push-notification-for-post-and-buddypress');
}

if (pnfpb_ajax_object_push.pwainstallheadertext === '') {
	pnfpb_ajax_object_push.pwainstallheadertext = __('Install our PWA app with offline functionality','push-notification-for-post-and-buddypress');
}

if (pnfpb_ajax_object_push.pwainstalltext === '') {
	pnfpb_ajax_object_push.pwainstalltext = __('Install PWA','push-notification-for-post-and-buddypress');
}

if (pnfpb_ajax_object_push.pwainstallbuttoncolor === '') {
	pnfpb_ajax_object_push.pwainstallbuttoncolor = '#ff0000';
}

if (pnfpb_ajax_object_push.pwainstallbuttontextcolor === '') {
	pnfpb_ajax_object_push.pwainstallbuttontextcolor = '#ffffff';
}

	
var standalone = window.navigator.standalone,
  userAgent_pnfpb = window.navigator.userAgent.toLowerCase(),
  safari_pnfpb = /^(?!.*chrome).*safari/i.test(userAgent_pnfpb),
  ios_pnfpb = /iphone|ipod|ipad/.test(userAgent_pnfpb);
	
var pnfpb_webview = false;

if (ios_pnfpb) {
  if (!standalone && safari_pnfpb) {
    // safari_pnfpb
    pnfpb_webview = false;
  } else if (!standalone && !safari_pnfpb) {
    // ios_pnfpb webview
    pnfpb_webview = true;
	//PNFPB_from_Java_androidapp();
	//PNFPB_from_Flutter_mobileapp();	  	
  };
} else {
  if (userAgent_pnfpb.includes('wv')) {
    // Android webview
    pnfpb_webview = true;
	//PNFPB_from_Java_androidapp();
	//PNFPB_from_Flutter_mobileapp();	  
  } else {
    // Chrome
    pnfpb_webview = false;
  }
};

//$( '#buddypress' ).on( 'bp_heartbeat_tick', function( event, pnfpb_bpactivity_data ) { console.log(pnfpb_bpactivity_data); } );

/*if ( didAction( 'bp_activity_posted_update' ) ) {
	console.log( 'The "bp_activity_posted_update" action has already run.' );
} else {
	console.log( 'The "bp_activity_posted_update" action has not yet run.' );
}*/
	
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
              console.log(__('New content is available; please refresh.','push-notification-for-post-and-buddypress'));
             
            } else {
              // At this point, everything has been precached.
              // It's the perfect time to display a
              // "Content is cached for offline use." message.
              console.log(__('Content is cached for offline use','push-notification-for-post-and-buddypress'));
            }
          }
        }
      }
	})
	}
	else
	{
	
		if ('serviceWorker' in navigator && hasFirebaseMessagingSupport) {
			
			if (pnfpb_ajax_object_push.pnfpb_other_sw_file_active) {

				navigator.serviceWorker.ready.then(async registration => {
					// This code runs only when an active service worker is available.
					if (registration.active) {
						await pnfpb_init_sw_registration(registration)
					// You can also check if the current page is controlled by a service worker
					// at the current moment by examining navigator.serviceWorker.controller
					//if (navigator.serviceWorker.controller) {
					//	console.log('Current page is controlled by the active service worker.');
					//}
					} else {
					console.log('Service worker found, but not yet active or controlling the page.');
					}
				}).catch(error => {
					console.error('Service worker registration failed or an error occurred:', error);
				});				

			} else {

				navigator.serviceWorker.register(homeurl+'/pnfpb_icpush_pwa_sw.js',{scope:homeurl+'/'}).then(async function(registration) {
					registration.update();	
					// If updatefound is fired, it means that there's
					// a new service worker being installed.
					await pnfpb_init_sw_registration(registration);
				})

			}

		
		}
		else {
			
			console.log('check-webview-deviceid');
	
		}
	
	}

	async function pnfpb_init_sw_registration(registration) {
				if (pnfpb_ajax_object_push.rest_nonce && pnfpb_ajax_object_push.rest_nonce !== '') {

					const PNFPB_SW_rest_token_request = indexedDB.open("PNFPB_SW_Database", 3);
					const PNFPB_SW_rest_token_Object = {key: 1, pnfpb_rest_token: pnfpb_ajax_object_push.rest_nonce};

					PNFPB_SW_rest_token_request.onupgradeneeded = (event) => {
						const PNFPB_SW_rest_token_db = event.target.result;
						if (!PNFPB_SW_rest_token_db.objectStoreNames.contains("PNFPB_SW_rest_token_Store")) {
							PNFPB_SW_rest_token_db.createObjectStore("PNFPB_SW_rest_token_Store", { keyPath: "key" }); // Define keyPath for unique identification
						}
						if (!PNFPB_SW_rest_token_db.objectStoreNames.contains("PNFPB_SW_Store")) {
							PNFPB_SW_rest_token_db.createObjectStore("PNFPB_SW_Store", { keyPath: "key" }); // Define keyPath for unique identification
						}						
					};

					PNFPB_SW_rest_token_request.onsuccess = (event) => {
						const PNFPB_SW_rest_token_db = event.target.result;
						const PNFPB_SW_rest_token_transaction = PNFPB_SW_rest_token_db.transaction(["PNFPB_SW_rest_token_Store"], "readwrite");
						const PNFPB_SW_rest_token_objectStore = PNFPB_SW_rest_token_transaction.objectStore("PNFPB_SW_rest_token_Store");
						const PNFPB_SW_rest_token_objectStore_get = PNFPB_SW_rest_token_transaction.objectStore("PNFPB_SW_rest_token_Store").get(1);
						PNFPB_SW_rest_token_objectStore_get.onsuccess = (event) => {
							let data = event.target.result;
							if (event.target.result !== undefined  ) {
								if (data.pnfpb_rest_token !== pnfpb_ajax_object_push.rest_nonce) {
									const PNFPB_SW_rest_token_addRequest = PNFPB_SW_rest_token_objectStore.put(PNFPB_SW_rest_token_Object);
									PNFPB_SW_rest_token_addRequest.onsuccess = () => {
										console.log("Object added successfully");
										PNFPB_SW_rest_token_db.close();
									};
									PNFPB_SW_rest_token_addRequest.onerror = (error) => {
										console.error("Error adding object:", error);
										PNFPB_SW_rest_token_db.close();
									};
								}
							} else {
								const PNFPB_SW_rest_token_addRequest = PNFPB_SW_rest_token_objectStore.put(PNFPB_SW_rest_token_Object);
								PNFPB_SW_rest_token_addRequest.onsuccess = () => {
									console.log("Object added successfully");
									PNFPB_SW_rest_token_db.close();
								};
								PNFPB_SW_rest_token_addRequest.onerror = (error) => {
									console.error("Error adding object:", error);
									PNFPB_SW_rest_token_db.close();
								};

							}
						};
						PNFPB_SW_rest_token_objectStore_get.onerror = (event) => {
									console.error("Error adding object:", error);
									PNFPB_SW_rest_token_db.close();												
						}; 
					};

					PNFPB_SW_rest_token_request.onerror = (event) => {
						console.error("Database error:", event.target.errorCode);
					};
				}				
				
      			registration.onupdatefound = () => {
        			var installingWorker = registration.installing;
        			installingWorker.onstatechange = () => {
          				if (installingWorker.state === 'installed') {
            				if (navigator.serviceWorker.controller) {
              					// At this point, the old content will have been purged and
              					// the fresh content will have been added to the cache.
              					// It's the perfect time to display a "New content is
              					// available; please refresh." message in your web app.
              					console.log(__('New content is available; please refresh.','push-notification-for-post-and-buddypress'));
             
            				} else {
              					// At this point, everything has been precached.
              					// It's the perfect time to display a
              					// "Content is cached for offline use." message.
              					console.log(__('Content is cached for offline use','push-notification-for-post-and-buddypress'));
            				}
     
          				}
        			}
     			}

				
				if( $j(".pnfpb_subscribe_button").length )
				{
					 $j(".pnfpb_subscribe_button").show();
				}
				
				var isuserloggedin = false;

				if (pnfpb_ajax_object_push.notify_loggedin === '1' && pnfpb_ajax_object_push.isloggedin === '1' && parseInt(pnfpb_ajax_object_push.userid) > 0) {

					isuserloggedin = true;
				}
	
				if ('serviceWorker' in navigator && 'PushManager' in window && hasFirebaseMessagingSupport && ((pnfpb_ajax_object_push.notify_loggedin === '1' && isuserloggedin) || (pnfpb_ajax_object_push.notify_loggedin !== '1') )) {
		
					// Listen to service worker messages sent via postMessage()

						messaging = getMessaging(firebaseApp);

						if (pnfpb_ajax_object_push.pnfpb_ic_fcm_measurementId && pnfpb_ajax_object_push.pnfpb_ic_fcm_measurementId !== '') {				
							const analytics = getAnalytics(firebaseApp);
							logEvent(analytics, 'notification_open');
							logEvent(analytics, 'notification_received');
							logEvent(analytics, 'page_view');
						}						

						//await pnfpb_syncMessagesLater();

						/*onMessage(messaging, (payload) => {
							//console.log('Message received. ', payload);

							// Customize notification display here
							const notificationTitle = payload.notification.title;
							const notificationOptions = {
								body: payload.notification.body,
								icon: payload.notification.icon,
							}
				
							registration.showNotification(notificationTitle, notificationOptions);							
						});	*/					
						
						//navigator.serviceWorker.addEventListener('message', async (event) => {

							//console.log(event.data);

							/*if (event.data.notification_action && (event.data.notification_action === 'delivery_confirmation' || event.data.notification_action === 'opened_confirmation')) {

								// Initialize Firebase Analytics
								const analytics = getAnalytics(firebaseApp);

								var notification_title = '';
								var notification_content = '';
								var notification_id = '';
								var notification_action = '';

								if (event.data.title) {
									notification_title = event.data.title;
								}

								if (event.data.content) {
									notification_content = event.data.content;
								}
								
								if (event.data.notification_id) {
									notification_id = event.data.notification_id;
								}
								
								if (event.data.notification_action) {
									notification_action = 'pnfpb_'+event.data.notification_action;
								}							

								// Log a custom event
								logEvent(analytics, notification_action, {
									notification_title:notification_title,
									notification_content:notification_content,
									notification_id:notification_id,
									notification_action: event.data.notification_action,								
								});
							
							}*/

							//if (event.data.notification_action && (event.data.notification_action === 'delivery_confirmation' || event.data.notification_action === 'opened_confirmation')) {

								//await pnfpb_receivePushNotification(registration,event.data,messaging);

								/*switch (event.data.action) {
									case 'pnfpb-readmore-notificationclick':
										window.location.href = event.data.url
										break
										// no default
									}*/
							//}

							/*if (event.data.messageType && event.data.data 
								&& event.data.fcmOptions && event.data.fcmOptions.analyticsLabel 
								&& event.data.messageType === 'push-received'
								&& event.data.fcmOptions.analyticsLabel === 'pnfpb-analytics-label') {
									await pnfpb_receivePushNotification(registration,event.data,messaging);
								}*/

						//});						


					navigator.serviceWorker.ready.then(async (serviceWorkerRegistration) => {

						//serviceWorkerRegistration.active.postMessage("Hi service worker");

						/*serviceWorkerRegistration.sync.getTags().then((tags) => {
							if (tags.includes("pnfpb-sync-messages")) {
								console.log("Messages sync already requested");
							}
						});	*/					

						shortcode_subscription_menu('');

						if (pnfpb_ajax_object_push.pnfpb_push_prompt === '1' && (!$j(".pnfpb-push-subscribe-icon-shortcode").length && !pnfpb_shortcode_installed)) {

							await pnfpb_show_permission_dialog(serviceWorkerRegistration,'');
	
						}
						
						serviceWorkerRegistration.pushManager.getSubscription().then(async function (subscription) {

						if (pnfpb_ajax_object_push.pnfpb_push_prompt !== '1' && (!$j(".pnfpb-push-subscribe-icon-shortcode").length && !pnfpb_shortcode_installed)) {
							if (!subscription) 
							{
								await requestPermission(serviceWorkerRegistration);
							}
							else
							{
                   				await checkdeviceid(serviceWorkerRegistration,subscription); 
							}
						}

						if (hasFirebaseMessagingSupport && subscription ) 
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

							$j(".subscribegroupbutton").removeClass( "subscribe-init-display-off" );
							$j(".unsubscribegroupbutton").removeClass( "subscribe-init-display-off" );
							$j(".subscribe-notification-group").removeClass( "subscribe-init-display-off" );
							$j(".unsubscribe-notification-group").removeClass( "subscribe-init-display-off" );
							
							var leave_group_id = '0';

							var groupId = '0';							
							
							// [START refresh_token]
							// Callback fired if Instance ID token is updated.
							//messaging.onTokenRefresh(() => {
							getToken(messaging,{serviceWorkerRegistration:serviceWorkerRegistration,vapidKey:vapidKey }).then(async function (refreshedToken) {
				
								if (refreshedToken) {

									// Split document.cookie into individual name=value pairs
									const pnfpb_cookieArr = document.cookie.split(';');

									var pnfpb_oldtoken = '';

									// Loop through the array elements
									for (let pnfpb_i = 0; pnfpb_i < pnfpb_cookieArr.length; pnfpb_i++) {
										let pnfpb_cookiePair = pnfpb_cookieArr[pnfpb_i].split('=');

										// Remove whitespace at the beginning of the cookie name and compare
										if ("PNFPB_device_id" === pnfpb_cookiePair[0].trim()) {
										// Decode the cookie value and return it
											pnfpb_oldtoken = pnfpb_cookiePair[1];
										}
									}									

									if (pnfpb_oldtoken !== refreshedToken) {
										const pnfpb_date = new Date();
  										pnfpb_date.setTime(pnfpb_date.getTime() + (3650 * 24 * 60 * 60 * 1000));
  										const pnfpb_expires = "expires=" + pnfpb_date.toUTCString();
  										document.cookie = "PNFPB_device_id" + "=" + refreshedToken + ";" + pnfpb_expires + ";path=/";
									}

									sendTokenToServer(refreshedToken);

									frontend_subscription_menu(serviceWorkerRegistration,refreshedToken);

									deviceid = refreshedToken;

									$j(".group-button").on("click",".join-group", function() {
										var join_group_string_array = $j(this).parent().attr('id').split("-");
										if (join_group_string_array.length > 0) {
											var join_group_id = join_group_string_array[1];
											var join_group_unsubscribebuttonname = '.unsubscribegroupbutton-'+join_group_id;
											var join_group_subscribebuttonname = '.subscribegroupbutton-'+join_group_id;
											var join_group_unsubscribebuttonid = '#unsubscribegroupbutton-'+join_group_id;
											var join_group_subscribebuttonid = '#subscribegroupbutton-'+join_group_id;																											$j(join_group_subscribebuttonname).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
											$j(join_group_unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
											$j(join_group_subscribebuttonid).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
											$j(join_group_unsubscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );										
										}
									});
								
									$j(".group-button").on("click",".leave-group", function() {
										var leave_group_string_array = $j(this).parent().attr('id').split("-");
										if (leave_group_string_array.length > 0) {
											leave_group_id = leave_group_string_array[1];
											var leave_group_unsubscribebuttonname = '.unsubscribegroupbutton-'+leave_group_id;
											var leave_group_subscribebuttonname = '.subscribegroupbutton-'+leave_group_id;
											var leave_group_unsubscribebuttonid = '#unsubscribegroupbutton-'+leave_group_id;
											var leave_group_subscribebuttonid = '#subscribegroupbutton-'+leave_group_id;
											$j(leave_group_subscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
											$j(leave_group_unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
											$j(leave_group_subscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
											$j(leave_group_unsubscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
											
										}
										if (refreshedToken) {
											deviceid = refreshedToken;
											var data = {
												action: 'icpushcallback',
												device_id:deviceid,
												bpgroup_id:leave_group_id,
												nonce: pnfpb_ajax_object_push.nonce,
												pushtype: 'unsubscribe-group-button'
											};
						
											$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
											
							
												if (response != 'fail')
												{
													if (response != 'duplicate'){

															document.cookie = "pnfpb_group_push_notification_"+leave_group_id + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";	
														
															$j(leave_group_subscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
															$j(leave_group_unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
														}
														else
														{
			
															console.log(__("Push notification unsubscription failed..try again!!",'push-notification-for-post-and-buddypress'));
														}

												}

					
											});	
										}
									});	

									$j(document).on("click",".join-group", function() {
										var join_group_string_array = $j(this).parent().attr('id').split("-");
										if (join_group_string_array.length > 0) {
											var join_group_id = join_group_string_array[1];
											var join_group_unsubscribebuttonname = '.unsubscribegroupbutton-'+join_group_id;
											var join_group_subscribebuttonname = '.subscribegroupbutton-'+join_group_id;
											var join_group_unsubscribebuttonid = '#unsubscribegroupbutton-'+join_group_id;
											var join_group_subscribebuttonid = '#subscribegroupbutton-'+join_group_id;
											$j(join_group_subscribebuttonname).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
											$j(join_group_unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );																		$j(join_group_subscribebuttonid).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
											$j(join_group_unsubscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );	
										}
									});
								
									$j(document).on("click",".leave-group", function() {
										var leave_group_string_array = $j(this).parent().attr('id').split("-");
										if (leave_group_string_array.length > 0) {
											leave_group_id = leave_group_string_array[1];
											var leave_group_unsubscribebuttonname = '.unsubscribegroupbutton-'+leave_group_id;
											var leave_group_subscribebuttonname = '.subscribegroupbutton-'+leave_group_id;
											var leave_group_unsubscribebuttonid = '#unsubscribegroupbutton-'+leave_group_id;
											var leave_group_subscribebuttonid = '#subscribegroupbutton-'+leave_group_id;
											$j(leave_group_subscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
											$j(leave_group_unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
											$j(leave_group_subscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
											$j(leave_group_unsubscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
											
										}
										if (refreshedToken) {
											var deviceid = refreshedToken;
											var data = {
												action: 'icpushcallback',
												device_id:deviceid,
												bpgroup_id:leave_group_id,
												nonce: pnfpb_ajax_object_push.nonce,
												pushtype: 'unsubscribe-group-button'
											};
						
											$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
									
												if (response != 'fail')
												{
													if (response != 'duplicate'){
														document.cookie = "pnfpb_group_push_notification_"+leave_group_id + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";	
														$j(leave_group_subscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
														$j(leave_group_unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
													}
													else
													{
														console.log(__("Push notification unsubscription failed..try again!!",'push-notification-for-post-and-buddypress'));
													}
												}
					
											});	
										}
									});	
								
									$j(document).on( "click",".subscribe-notification-group", function(e) {
										e.preventDefault();
										groupId = $j(this).attr("data-group-id");
										var unsubscribebuttonname = '.unsubscribegroupbutton-'+groupId;
										var subscribebuttonname = '.subscribegroupbutton-'+groupId;
										var unsubscribebuttonid = '#unsubscribegroupbutton-'+groupId;
										var subscribebuttonid = '#subscribegroupbutton-'+groupId;										
										if( $j("#pnfpb_group_users_subscribe_dialog_confirm").length ) {
										}
										else
										{
											$j(this).append( '<div id="pnfpb_group_users_subscribe_dialog_confirm" class="pnfpb_group_users_subscribe_dialog_confirm" title="Subscribe" style="display:none;"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>'+pnfpb_ajax_object_push.group_subscribe_dialog_text+'</div><div id="pnfpb-group-unsubscribe-dialog" title="Confirmation"><div id="pnfpb-group-unsubscribe-alert-msg" class="pnfpb-group-unsubscribe-alert-msg"></div></div>' );
										}
										var subscribe_button_text = pnfpb_ajax_object_push.subscribe_button_text;
										$j( "#pnfpb_group_users_subscribe_dialog_confirm" ).dialog({  
											resizable: false,
											height: "auto",
											closeText : '',
											modal: true,
											buttons: [{
												text: subscribe_button_text,
												open: function() {
													$j(this).attr('style','font-weight:bold;color:'+pnfpb_ajax_object_push.subscribe_button_text_color+';background-color:'+pnfpb_ajax_object_push.subscribe_button_color+';border:0px');
												},
												click: function() {												
													if (refreshedToken) {
								
														deviceid = refreshedToken;

														var subscription_endpoint = '';
														var subscription_p256dh = '';
														var subscription_auth = '';

														if (subscription.endpoint) {
															subscription_endpoint = subscription.endpoint;
														}

														if (subscription.getKey("auth")) {
															const authBuffer = subscription.getKey('auth');
															const authUint8 = new Uint8Array(authBuffer);
															subscription_auth = btoa(String.fromCharCode.apply(null, authUint8));									
														}
																						
														if (subscription.getKey("p256dh")) {
															const p256dhBuffer = subscription.getKey('p256dh');
															const p256dhUint8 = new Uint8Array(p256dhBuffer);
															subscription_p256dh = btoa(String.fromCharCode.apply(null, p256dhUint8));									
														}										
								
														var data = {
															action: 'icpushcallback',
															device_id:deviceid,
															bpgroup_id:groupId,
															pnfpb_endpoint:subscription_endpoint,
															pnfpb_options:subscription_p256dh,
															pnfpb_subscription_token:subscription_auth,												
															nonce: pnfpb_ajax_object_push.nonce,
															pushtype: 'subscribe-group-button'
														};													
								
				
														$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
														
													
															if (response != 'fail')
															{
																if (response != 'duplicate'){

																	$j(".pnfpb-group-unsubscribe-alert-msg").html("<p>"+pnfpb_ajax_object_push.group_subscribe_dialog_text_confirm+"</p>");
																	$j( "#pnfpb-group-unsubscribe-dialog" ).dialog();
																	$j(subscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
																	$j(unsubscribebuttonname).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
																	$j(subscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
																	$j(unsubscribebuttonid).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
																	
																}
																else
																{
																	console.log(__("Already subscribed...device id already exists...not updated",'push-notification-for-post-and-buddypress'));
																}

															}
															else
															{

															
																$j(".pnfpb-group-unsubscribe-alert-msg").html(__("Push notification subscription failed..try again!!",'push-notification-for-post-and-buddypress'));
																
																$j( "#pnfpb-group-unsubscribe-dialog" ).dialog();

																console.log(__("device update failed",'push-notification-for-post-and-buddypress'));
															}
								
														});
								
													}									
													$j( "#pnfpb_group_users_subscribe_dialog_confirm" ).dialog("close");
												},
												Cancel: function() {
													$j( "#pnfpb_group_users_subscribe_dialog_confirm" ).dialog("close");
												}
											}]
										})
									})
									$j(document).on( "click",".unsubscribe-notification-group", function(e) {
										e.preventDefault();
										groupId = $j(this).attr("data-group-id");
										var unsubscribebuttonname = '.unsubscribegroupbutton-'+groupId;
										var subscribebuttonname = '.subscribegroupbutton-'+groupId;
										var unsubscribebuttonid = '#unsubscribegroupbutton-'+groupId;
										var subscribebuttonid = '#subscribegroupbutton-'+groupId;
										if( $j("#pnfpb_group_users_unsubscribe_dialog_confirm").length ) {
										}
										else
										{
											$j(this).append( '<div id="pnfpb_group_users_unsubscribe_dialog_confirm" class="pnfpb_group_users_unsubscribe_dialog_confirm" title="Unsubscribe" style="display:none;"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>'+pnfpb_ajax_object_push.group_unsubscribe_dialog_text+'</div><div id="pnfpb-group-unsubscribe-dialog" title="Confirmation"><div id="pnfpb-group-unsubscribe-alert-msg" class="pnfpb-group-unsubscribe-alert-msg"></div></div>' );
										}
										var unsubscribe_button_text = pnfpb_ajax_object_push.unsubscribe_button_text;									
										$j( "#pnfpb_group_users_unsubscribe_dialog_confirm" ).dialog({  
											resizable: false,
											height: "auto",
											closeText : '',
											modal: true,
											buttons: [{
												text: unsubscribe_button_text,
												open: function() {
													$j(this).attr('style','font-weight:bold;color:'+pnfpb_ajax_object_push.subscribe_button_text_color+';background-color:'+pnfpb_ajax_object_push.subscribe_button_color+';border:0px');
												},
												click: function() {	
													if (refreshedToken) {
								
														deviceid = refreshedToken;
								
														var data = {
															action: 'icpushcallback',
															device_id:deviceid,
															bpgroup_id:groupId,
															nonce: pnfpb_ajax_object_push.nonce,
															pushtype: 'unsubscribe-group-button'
														};
									
														$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
															const pnfpb_cookiename = "pnfpb_group_push_notification_"+groupId+"=;"; 
															document.cookie = pnfpb_cookiename+" expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
														
															$j(unsubscribebuttonname).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
															$j(subscribebuttonname).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
															$j(unsubscribebuttonid).removeClass( "subscribe-display-on" ).addClass( "subscribe-display-off" );
															$j(subscribebuttonid).removeClass( "subscribe-display-off" ).addClass( "subscribe-display-on" );
															
															$j(".pnfpb-group-unsubscribe-alert-msg").html("<p>"+pnfpb_ajax_object_push.group_unsubscribe_dialog_text_confirm+"</p>");
															
															$j( "#pnfpb-group-unsubscribe-dialog" ).dialog();
																	
								
														});
								
													}
													$j("#pnfpb_group_users_unsubscribe_dialog_confirm").dialog("close");
												},
												Cancel: function() {
													$j( "#pnfpb_group_users_unsubscribe_dialog_confirm" ).dialog( "close" );
												}
											}]
										})
									})
								
							
									$j('#pnfpb_group_users_unsubscribe_dialog_confirm').on('dialogclose', function(event) {
										$j(".pnfpb-group-unsubscribe-alert-msg").html("");
										$j(".pnfpb-group-subscribe-alert-msg").html("");
									});							
									$j('#pnfpb_group_users_subscribe_dialog_confirm').on('dialogclose', function(event) {
										$j(".pnfpb-group-unsubscribe-alert-msg").html("");
										$j(".pnfpb-group-subscribe-alert-msg").html("");
									});	
								}							
				
								// Subscribe the devices corresponding to the registration tokens to the
								// topic.
		
								// Indicate that the new Instance ID token has not yet been sent to the
								// app server.
									
								// Send Instance ID token to app server.
									
								// [START_EXCLUDE]
								// Display new Instance ID token and clear UI of all previous messages.
								//resetUI();
								// [END_EXCLUDE]
							}).catch((err) => {

								console.log(__('Unable to retrieve refreshed token ','push-notification-for-post-and-buddypress'), err);

								//showToken(__('Unable to retrieve refreshed token ','push-notification-for-post-and-buddypress'), err);
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
							if( ($j(".pnfpb_subscribe_button").length || $j(".pnfpb_push_notification_frontend_settings_submit").length) && !pnfpb_webview)
							{
								console.log(__("Browser notification permission not granted or blocked!!!",'push-notification-for-post-and-buddypress'));
		
							} 
						}
						
        			})
					.catch((err) => {
						console.error(err);
						console.error('Error during getSubscription()');
						shortcode_subscription_menu('');
		
				  	});		
				})
				.catch((err) => {
					console.error('Error during getSubscription()');
					console.error(err);
			  	});			
				}
				else
				{

					if( $j(".pnfpb_push_notification_frontend_settings_submit").length && !pnfpb_webview)
					{
						console.log(__("Browser notification permission not granted or blocked!!!",'push-notification-for-post-and-buddypress'));
		
					}					

				}		
	}

	async function pnfpb_show_permission_dialog(registration,subscription) {

		pnfpb_bell_icon_subscribe_push_type_checkbox = ['1','0','0','0','0','0','0','0','0','0','0','0','0','0'];

		pnfpb_bell_icon_subscription_options_custom_prompt = '10000000000000';

		pnfpb_bell_icon_prompt_subscription_options_custom_prompt = '10000000000000';

		pnfpb_bell_icon_prompt_subscribe_push_type_checkbox = ['1','0','0','0','0','0','0','0','0','0','0','0','0','0'];

		if ((pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_on_off === '1' && 
			(pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1' || 
				pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2' )) && 
				pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style3 !== '1' ) {


			$j('.pnfpb-push-subscribe-icon').hide();

			if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
			
				$j('.pnfpb-popup-customprompt-transistion-confirmation').hide();

				if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideDown') {

					$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("animation-name", "slideDown");

					$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("-webkit-animation-name", "slideDown");

				}

				if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideUp') {

					$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("animation-name", "slideUp");

					$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("-webkit-animation-name", "slideUp");
					
				}

			} else {

				if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {

					if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideDown') {

						$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("animation-name", "slideDown");

						$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("-webkit-animation-name", "slideDown");

					}


					if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideUp') {

						$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("animation-name", "slideUp");

						$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("-webkit-animation-name", "slideUp");
						
					}
						

					$j('.pnfpb-popup-customprompt-vertical-transistion-confirmation').hide();

				}

			}

			let name = 'PNFPB_custom_prompt' + "=";

			let PNFPB_custom_prompt_display = 'ON';

			let decodedCookie = decodeURIComponent(document.cookie);
		
			let ca = decodedCookie.split(';');
		
			for(let i = 0; i <ca.length; i++) {
		
				let c = ca[i];
		
				while (c.charAt(0) == ' ') {
		
					  c = c.substring(1);
		
				}
		
				if (c.indexOf(name) == 0) {

					const pnfpb_custom_prompt_currentDate = new Date();

					if (pnfpb_custom_prompt_currentDate.getTime) {

						pnfpb_custom_prompt_currentDate.setTime(pnfpb_custom_prompt_currentDate.getTime());

						let pnfpb_custom_prompt_cookieDate = c.substring(name.length, c.length).getTime();
		
						if (pnfpb_custom_prompt_cookieDate > pnfpb_custom_prompt_currentDate.getTime()) {
		
							PNFPB_custom_prompt_display = 'OFF';
		
		
							if (pnfpb_ajax_object_push.pwainstallpromptenabled === '1' || $j('.pnfpb-pwa-dialog-container').length) {
		
								$j('.pnfpb-pwa-dialog-container').hide();
		
							}				
		
						}
					}			
				}
			}

			registration.pushManager.getSubscription().then(async function (subscription) {

				if (!subscription && Notification.permission !== "denied" && Notification.permission !== "granted") {

					if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1' && PNFPB_custom_prompt_display === 'ON') {

						$j('.pnfpb-popup-customprompt-container').show();

						pnfpb_bell_icon_subscription_options_custom_prompt = '';

						$j('.pnfpb_bell_icon_subscription_all_enable').off().on('click',function(event) {

							if ($j('.pnfpb_bell_icon_subscription_all_enable').is(":checked"))
							{
	
								pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';
	
								if (pnfpb_show_push_notify_types.length > 0) {
	
									for (var pnfpb_notify_type_element = 1; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {
	
										pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element] = '0';
	
									}
	
								}
							
								$j('.pnfpb_bell_icon_subscription_post_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_activity_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_all_comments_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_my_comments_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_private_message_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_new_member_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_friendship_request_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_friendship_accepted_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_avatar_change_enable').prop('checked',false);
								
								$j('.pnfpb_bell_icon_subscription_cover_image_change_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_group_details_update_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_group_invite_enable').prop('checked',false);

								$j('.pnfpb_bell_icon_subscription_favourite_enable').prop('checked',false);

								$j('.pnfpb_bell_icon_subscription_followers_enable').prop('checked',false);
	
								if (pnfpb_custom_post_types.length > 0) {
	
									for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
	
										$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
	
										var pnfpb_index = $j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').attr("pnfpb_index");
	
										pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
										
									}
								}
		
							}
							else 
							{
	
								pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
							}								
						});

						$j('.pnfpb_bell_icon_subscription_favourite_enable').off().on('click',function(event) {
		
				
							if ($j('.pnfpb_bell_icon_subscription_favourite_enable').is(":checked"))
							{
	
							
								$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);

								pnfpb_bell_icon_subscribe_favourite_checkbox = '1';
		
																
							}
							else 
							{
								pnfpb_bell_icon_subscribe_favourite_checkbox = '0';
							}								
						});
						
						$j('.pnfpb_bell_icon_subscription_followers_enable').off().on('click',function(event) {
		
				
							if ($j('.pnfpb_bell_icon_subscription_followers_enable').is(":checked"))
							{
	
							
								$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);

								pnfpb_bell_icon_subscribe_followers_checkbox = '1';
		
																
							}
							else 
							{
								pnfpb_bell_icon_subscribe_followers_checkbox = '0';
							}								
						});							
						
						
						$j('.pnfpb_bell_icon_subscription_group_details_update_enable').off().on('click',function(event) {
		
				
							if ($j('.pnfpb_bell_icon_subscription_group_details_update_enable').is(":checked"))
							{
	
							
								$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);

								pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '1';
		
																
							}
							else 
							{
								pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '0';
							}								
						});
						
						$j('.pnfpb_bell_icon_subscription_group_invite_enable').off().on('click',function(event) {
		
				
							if ($j('.pnfpb_bell_icon_subscription_group_invite_enable').is(":checked"))
							{
	
							
								$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);

								pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '1';
		
																	
							}
							else 
							{
	
								pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '0';
							}								
						});									


						if (pnfpb_show_push_notify_types.length > 0) {

							for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 12; pnfpb_notify_type_element++) {

								if (pnfpb_show_push_notify_types[pnfpb_notify_type_element] !== 'all') {
	
									$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[pnfpb_notify_type_element]+'_enable').off().on('click',function(event) {
	
										var pnfpb_selector = '.'+$(this).attr("class");
	
										var pnfpb_index = $(this).attr("pnfpb_index");
	
										if ($j(pnfpb_selector).is(":checked"))
										{
	
											pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '1';
	
										
											if (pnfpb_notify_type_element > 0) {
				
												pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
									
												$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
	
											}
																	
										}
										else 
										{
	
											pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '0';
	
										}
									
	
									});
								}								
	
							}

						}						

						if (pnfpb_custom_post_types.length > 0) {

							for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {

								$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);

								$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').off().on('click',function(event) {
		
				
									if ($j(this).is(":checked"))
									{

										pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
				
										pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
									
										$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
				
																		
									}
									else 
									{
										pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
									}								
								});								

							}

						}

						
						if (pnfpb_show_push_notify_types.length > 0) {

							for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < pnfpb_show_push_notify_types.length; pnfpb_notify_type_element++) {

								pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element];
								
							}

						}
						
						if (pnfpb_custom_post_types.length > 0) {

							for (var pnfpb_post_type_element = 0; pnfpb_post_type_element <= 10; pnfpb_post_type_element++) {

								if (pnfpb_post_type_element < pnfpb_custom_post_types.length && pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element]) {

									pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element];

								} else {

									pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+'0';
								}
								
							}

						} else {
							pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+'0000000000';
						}

						pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+ pnfpb_bell_icon_subscribe_favourite_checkbox + pnfpb_bell_icon_subscribe_followers_checkbox

						$j('.pnfpb-popup-customprompt-transistion-allow-button').off().on( "click", async (event) => {

							$j('.pnfpb-popup-customprompt-container').hide();

							await requestPermission(registration,'',pnfpb_bell_icon_subscription_options_custom_prompt);						

						});						

						$j('.pnfpb-popup-customprompt-transistion-cancel-button').off().on( "click", async (event) => {

							const pnfpb_d = new Date();
							let expires = "expires=";
							if (pnfpb_d.getTime) {
								const pnfpb_custom_prompt_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_custom_prompt_show_again_days);
								pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_custom_prompt_show_again_days*24*60*60*1000));
								expires = "expires="+ pnfpb_d.toUTCString();
							}
							
							document.cookie = "PNFPB_custom_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";

							if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideDown') {

								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
							
									$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("animation-name", "slideDownOut");
				
									$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");

								}

								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
				
									$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("animation-name", "slideDownOut");
				
									$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
									
								}
				
							}
				
							if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideUp') {

								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
				
									$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("animation-name", "slideUpOut");
				
									$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");

								}

								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
				
									$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("animation-name", "slideUpOut");
				
									$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");
									
								}
				
							}

							$j('.pnfpb-popup-customprompt-container').hide();

						});

					} else {

						if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2' && PNFPB_custom_prompt_display === 'ON') {

							$j('.pnfpb-popup-customprompt-vertical-container').show();

							pnfpb_bell_icon_subscription_options_custom_prompt = '';


							$j('.pnfpb_bell_icon_subscription_all_enable').off().on('click',function(event) {

			
								if ($j('.pnfpb_bell_icon_subscription_all_enable').is(":checked"))
								{
		
		
									pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';
		
									if (pnfpb_show_push_notify_types.length > 0) {
		
										for (var pnfpb_notify_type_element = 1; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {
		
											pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element] = '0';
		
										}
		
									}
								
									$j('.pnfpb_bell_icon_subscription_post_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_activity_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_all_comments_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_my_comments_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_private_message_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_new_member_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_friendship_request_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_friendship_accepted_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_avatar_change_enable').prop('checked',false);
									
									$j('.pnfpb_bell_icon_subscription_cover_image_change_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_group_details_update_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_group_invite_enable').prop('checked',false);

									$j('.pnfpb_bell_icon_subscription_favourite_enable').prop('checked',false);

									$j('.pnfpb_bell_icon_subscription_followers_enable').prop('checked',false);									
		
									if (pnfpb_custom_post_types.length > 0) {
		
										for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
		
											$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
		
											var pnfpb_index = $j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').attr("pnfpb_index");
		
											pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
											
										}
									}
			
			
								}
								else 
								{
		
		
									pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
								}								
							});

							$j('.pnfpb_bell_icon_subscription_favourite_enable').off().on('click',function(event) {
		
				
								if ($j('.pnfpb_bell_icon_subscription_favourite_enable').is(":checked"))
								{
		
								
									$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
	
									pnfpb_bell_icon_subscribe_favourite_checkbox = '1';
			
																	
								}
								else 
								{
									pnfpb_bell_icon_subscribe_favourite_checkbox = '0';
								}								
							});

							$j('.pnfpb_bell_icon_subscription_followers_enable').off().on('click',function(event) {
		
				
								if ($j('.pnfpb_bell_icon_subscription_followers_enable').is(":checked"))
								{
		
								
									$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
	
									pnfpb_bell_icon_subscribe_followers_checkbox = '1';
			
																	
								}
								else 
								{
									pnfpb_bell_icon_subscribe_followers_checkbox = '0';
								}								
							});							
							
							
							$j('.pnfpb_bell_icon_subscription_group_details_update_enable').off().on('click',function(event) {
			
					
								if ($j('.pnfpb_bell_icon_subscription_group_details_update_enable').is(":checked"))
								{
		
								
									$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);

									pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '1';
			
																	
								}
								else 
								{
									pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '0';
								}								
							});
							
							$j('.pnfpb_bell_icon_subscription_group_invite_enable').off().on('click',function(event) {
			
					
								if ($j('.pnfpb_bell_icon_subscription_group_invite_enable').is(":checked"))
								{
		
								
									$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);

									pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '1';
			
																		
								}
								else 
								{
		
									pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '0';
								}								
							});										


								if (pnfpb_show_push_notify_types.length > 0) {

									for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 12; pnfpb_notify_type_element++) {

										if (pnfpb_show_push_notify_types[pnfpb_notify_type_element] !== 'all') {
			
											$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[pnfpb_notify_type_element]+'_enable').off().on('click',function(event) {
			
												var pnfpb_selector = '.'+$(this).attr("class");
			
												var pnfpb_index = $(this).attr("pnfpb_index");
			
												if ($j(pnfpb_selector).is(":checked"))
												{
			
													pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '1';
			
												
													if (pnfpb_notify_type_element > 0) {
						
														pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
											
														$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
			
													}
																			
												}
												else 
												{
			
													pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '0';
			
												}
											
			
											});
										}								
			
									}
		
								}										

								if (pnfpb_custom_post_types.length > 0) {

									for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
		
										$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
		
										$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').off().on('click',function(event) {
						
											if ($j(this).is(":checked"))
											{
		
												pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
						
												pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
											
												$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
						
																				
											}
											else 
											{

												pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';

											}

										});								
		
									}
		
								}								

								if (pnfpb_show_push_notify_types.length > 0) {

									for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < pnfpb_show_push_notify_types.length; pnfpb_notify_type_element++) {
		
										pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element];
										
									}
		
								}
								
								if (pnfpb_custom_post_types.length > 0) {

									for (var pnfpb_post_type_element = 0; pnfpb_post_type_element <= 10; pnfpb_post_type_element++) {
		
										if (pnfpb_post_type_element < pnfpb_custom_post_types.length && pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element]) {
		
											pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element];
		
										} else {
		
											pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+'0';
										}
										
									}
		
								} else {
									pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+'0000000000';
								}
		
								pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+ pnfpb_bell_icon_subscribe_favourite_checkbox+ pnfpb_bell_icon_subscribe_followers_checkbox		
	

							$j('.pnfpb-popup-customprompt-vertical-transistion-allow-button').off().on( "click", async (event) => {

								$j('.pnfpb-popup-customprompt-vertical-container').hide();

								await requestPermission(registration,'',pnfpb_bell_icon_subscription_options_custom_prompt);	

							});						
	
							$j('.pnfpb-popup-customprompt-vertical-transistion-cancel-button').off().on( "click", async (event) => {

								const pnfpb_d = new Date();

								let expires = "expires=";

								if (pnfpb_d.getTime) {

									const pnfpb_custom_prompt_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_custom_prompt_show_again_days);

									pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_custom_prompt_show_again_days*24*60*60*1000));

									expires = "expires="+ pnfpb_d.toUTCString();

								}

								document.cookie = "PNFPB_custom_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
								
								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideDown') {

									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
								
										$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("animation-name", "slideDownOut");
					
										$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
	
									}
	
									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
					
										$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("animation-name", "slideDownOut");
					
										$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
										
									}
					
								}
					
								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideUp') {
	
									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
					
										$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("animation-name", "slideUpOut");
					
										$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");
	
									}
	
									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
					
										$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("animation-name", "slideUpOut");
					
										$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");
										
									}
					
								}								
	
								$j('.pnfpb-popup-customprompt-vertical-container').hide();
		
							});						

						}

					}

				} else {

					if (!subscription && Notification.permission !== "denied" && Notification.permission === "granted") {

						await requestPermission(registration);

					}/* else {

						if (subscription) {

							if (pnfpb_ajax_object_push.is_admin_page === 'no') {

								await checkdeviceid(registration,subscription);
							}

						}

					}*/
				}
				
			});

		} else {

		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_on_off === '1' &&  (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1' || pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2' ) ) {

			$j('.pnfpb-push-subscribe-icon').hide();

			if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
			
				$j('.pnfpb-popup-customprompt-transistion-confirmation').hide();

				if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideDown') {

					$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("animation-name", "slideDown");

					$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("-webkit-animation-name", "slideDown");

				}

				if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideUp') {

					$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("animation-name", "slideUp");

					$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("-webkit-animation-name", "slideUp");
					
				}

			} else {

				if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {

					if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideDown') {

						$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("animation-name", "slideDown");

						$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("-webkit-animation-name", "slideDown");

					}


					if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideUp') {

						$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("animation-name", "slideUp");

						$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("-webkit-animation-name", "slideUp");
						
					}
						

					$j('.pnfpb-popup-customprompt-vertical-transistion-confirmation').hide();

				}

			}

			let name = 'PNFPB_custom_prompt' + "=";

			let PNFPB_custom_prompt_display = 'ON';

			let decodedCookie = decodeURIComponent(document.cookie);
		
			let ca = decodedCookie.split(';');
		
			for(let i = 0; i <ca.length; i++) {
		
				let c = ca[i];
		
				while (c.charAt(0) == ' ') {
		
					  c = c.substring(1);
		
				}
		
				if (c.indexOf(name) == 0) {

					const pnfpb_custom_prompt_currentDate = new Date();

					if (pnfpb_custom_prompt_currentDate.getTime) {

						pnfpb_custom_prompt_currentDate.setTime(pnfpb_custom_prompt_currentDate.getTime());

						let pnfpb_custom_prompt_cookieDate = c.substring(name.length, c.length).getTime();
		
						if (pnfpb_custom_prompt_cookieDate > pnfpb_custom_prompt_currentDate.getTime()) {
		
							PNFPB_custom_prompt_display = 'OFF';
		
		
							if (pnfpb_ajax_object_push.pwainstallpromptenabled === '1' || $j('.pnfpb-pwa-dialog-container').length) {
		
								$j('.pnfpb-pwa-dialog-container').hide();
		
							}				
		
						}
					}			
				}
			}
					

			registration.pushManager.getSubscription().then(async function (subscription) {

				if (!subscription && Notification.permission !== "denied" && Notification.permission !== "granted") {

					if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1' && PNFPB_custom_prompt_display === 'ON') {

						$j('.pnfpb-popup-customprompt-container').show();

						pnfpb_bell_icon_subscription_options_custom_prompt = '';

						$j('.pnfpb_bell_icon_subscription_all_enable').off().on('click',function(event) {

			
							if ($j('.pnfpb_bell_icon_subscription_all_enable').is(":checked"))
							{
	
	
								pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';
	
								if (pnfpb_show_push_notify_types.length > 0) {
	
									for (var pnfpb_notify_type_element = 1; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {
	
										pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element] = '0';
	
									}
	
								}
							
								$j('.pnfpb_bell_icon_subscription_post_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_activity_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_all_comments_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_my_comments_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_private_message_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_new_member_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_friendship_request_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_friendship_accepted_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_avatar_change_enable').prop('checked',false);
								
								$j('.pnfpb_bell_icon_subscription_cover_image_change_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_group_details_update_enable').prop('checked',false);
		
								$j('.pnfpb_bell_icon_subscription_group_invite_enable').prop('checked',false);

								$j('.pnfpb_bell_icon_subscription_favourite_enable').prop('checked',false);

								$j('.pnfpb_bell_icon_subscription_followers_enable').prop('checked',false);								
	
								if (pnfpb_custom_post_types.length > 0) {
	
									for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
	
										$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
	
										var pnfpb_index = $j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').attr("pnfpb_index");
	
										pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
										
									}
								}
		
		
							}
							else 
							{
	
	
								pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
							}								
						});

						$j('.pnfpb_bell_icon_subscription_favourite_enable').off().on('click',function(event) {
		
				
							if ($j('.pnfpb_bell_icon_subscription_favourite_enable').is(":checked"))
							{
	
							
								$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);

								pnfpb_bell_icon_subscribe_favourite_checkbox = '1';
		
																
							}
							else 
							{
								pnfpb_bell_icon_subscribe_favourite_checkbox = '0';
							}								
						});

						$j('.pnfpb_bell_icon_subscription_followers_enable').off().on('click',function(event) {
		
				
							if ($j('.pnfpb_bell_icon_subscription_followers_enable').is(":checked"))
							{
	
							
								$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);

								pnfpb_bell_icon_subscribe_followers_checkbox = '1';
		
																
							}
							else 
							{
								pnfpb_bell_icon_subscribe_followers_checkbox = '0';
							}								
						});						
						
						
						$j('.pnfpb_bell_icon_subscription_group_details_update_enable').off().on('click',function(event) {
		
				
							if ($j('.pnfpb_bell_icon_subscription_group_details_update_enable').is(":checked"))
							{
	
							
								$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);

								pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '1';
		
																
							}
							else 
							{
								pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '0';
							}								
						});
						
						$j('.pnfpb_bell_icon_subscription_group_invite_enable').off().on('click',function(event) {
		
				
							if ($j('.pnfpb_bell_icon_subscription_group_invite_enable').is(":checked"))
							{
	
							
								$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);

								pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '1';
		
																	
							}
							else 
							{
	
								pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '0';
							}								
						});									


						if (pnfpb_show_push_notify_types.length > 0) {

							for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 12; pnfpb_notify_type_element++) {

								if (pnfpb_show_push_notify_types[pnfpb_notify_type_element] !== 'all') {
	
									$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[pnfpb_notify_type_element]+'_enable').off().on('click',function(event) {
	
										var pnfpb_selector = '.'+$(this).attr("class");
	
										var pnfpb_index = $(this).attr("pnfpb_index");
	
										if ($j(pnfpb_selector).is(":checked"))
										{
	
											pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '1';
	
										
											if (pnfpb_notify_type_element > 0) {
				
												pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
									
												$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
	
											}
																	
										}
										else 
										{
	
											pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '0';
	
										}
									
	
									});
								}								
	
							}
	
						}									

						if (pnfpb_custom_post_types.length > 0) {

								for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
	
									$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
	
									$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').off().on('click',function(event) {
			
					
										if ($j(this).is(":checked"))
										{
	
											pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
					
											pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
										
											$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
					
																			
										}
										else 
										{
											pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
										}                               
									});                             
	
								}
	
						}                               

							

						$j('.pnfpb-popup-customprompt-transistion-allow-button').off().on( "click", async (event) => {

							pnfpb_bell_icon_subscription_options_custom_prompt = '';

							if (pnfpb_show_push_notify_types.length > 0) {

								for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < pnfpb_show_push_notify_types.length; pnfpb_notify_type_element++) {
	
									pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element];
									
								}
	
							}
							
							if (pnfpb_custom_post_types.length > 0) {

								for (var pnfpb_post_type_element = 0; pnfpb_post_type_element <= 10; pnfpb_post_type_element++) {
	
									if (pnfpb_post_type_element < pnfpb_custom_post_types.length && pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element]) {
	
										pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element];
	
									} else {
	
										pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+'0';
									}
									
								}
	
							} else {
								pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+'0000000000';
							}
	
							pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+ pnfpb_bell_icon_subscribe_favourite_checkbox+ pnfpb_bell_icon_subscribe_followers_checkbox							
							
							$j('.pnfpb-popup-customprompt-container').hide();

							await requestPermission(registration,'',pnfpb_bell_icon_subscription_options_custom_prompt);						

						});						

						$j('.pnfpb-popup-customprompt-transistion-cancel-button').off().on( "click", async (event) => {

							const pnfpb_d = new Date();

							let expires = "expires=";

							if (pnfpb_d.getTime) {

								const pnfpb_custom_prompt_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_custom_prompt_show_again_days);

								pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_custom_prompt_show_again_days*24*60*60*1000));

								expires = "expires="+ pnfpb_d.toUTCString();

							}

							document.cookie = "PNFPB_custom_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
							
							if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideDown') {

								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
							
									$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("animation-name", "slideDownOut");
				
									$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");

								}

								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
				
									$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("animation-name", "slideDownOut");
				
									$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
									
								}
				
							}
				
							if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideUp') {

								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
				
									$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("animation-name", "slideUpOut");
				
									$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");

								}

								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
				
									$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("animation-name", "slideUpOut");
				
									$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");
									
								}
				
							}							

							$j('.pnfpb-popup-customprompt-container').hide();
	
						});

					} else {

						if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2' && PNFPB_custom_prompt_display === 'ON') {

	
							$j('.pnfpb-popup-customprompt-vertical-container').show();

							pnfpb_bell_icon_subscription_options_custom_prompt = '';

							$j('.pnfpb_bell_icon_subscription_all_enable').off().on('click',function(event) {

			
								if ($j('.pnfpb_bell_icon_subscription_all_enable').is(":checked"))
								{
		
		
									pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';
		
									if (pnfpb_show_push_notify_types.length > 0) {
		
										for (var pnfpb_notify_type_element = 1; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {
		
											pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element] = '0';
		
										}
		
									}
								
									$j('.pnfpb_bell_icon_subscription_post_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_activity_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_all_comments_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_my_comments_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_private_message_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_new_member_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_friendship_request_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_friendship_accepted_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_avatar_change_enable').prop('checked',false);
									
									$j('.pnfpb_bell_icon_subscription_cover_image_change_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_group_details_update_enable').prop('checked',false);
			
									$j('.pnfpb_bell_icon_subscription_group_invite_enable').prop('checked',false);

									$j('.pnfpb_bell_icon_subscription_favourite_enable').prop('checked',false);

									$j('.pnfpb_bell_icon_subscription_followers_enable').prop('checked',false);									
		
									if (pnfpb_custom_post_types.length > 0) {
		
										for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
		
											$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
		
											var pnfpb_index = $j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').attr("pnfpb_index");
		
											pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
											
										}
									}
			
			
								}
								else 
								{
		
		
									pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
								}								
							});

							$j('.pnfpb_bell_icon_subscription_favourite_enable').off().on('click',function(event) {
		
				
								if ($j('.pnfpb_bell_icon_subscription_favourite_enable').is(":checked"))
								{
		
								
									$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
	
									pnfpb_bell_icon_subscribe_favourite_checkbox = '1';
			
																	
								}
								else 
								{
									pnfpb_bell_icon_subscribe_favourite_checkbox = '0';
								}								
							});

						$j('.pnfpb_bell_icon_subscription_followers_enable').off().on('click',function(event) {
		
				
								if ($j('.pnfpb_bell_icon_subscription_followers_enable').is(":checked"))
								{
		
								
									$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
	
									pnfpb_bell_icon_subscribe_followers_checkbox = '1';
			
																	
								}
								else 
								{
									pnfpb_bell_icon_subscribe_followers_checkbox = '0';
								}								
							});							
							
							
							$j('.pnfpb_bell_icon_subscription_group_details_update_enable').off().on('click',function(event) {
			
					
								if ($j('.pnfpb_bell_icon_subscription_group_details_update_enable').is(":checked"))
								{
		
								
									$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);

									pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '1';
			
																	
								}
								else 
								{
									pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '0';
								}								
							});
							
							$j('.pnfpb_bell_icon_subscription_group_invite_enable').off().on('click',function(event) {
			
					
								if ($j('.pnfpb_bell_icon_subscription_group_invite_enable').is(":checked"))
								{
		
								
									$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);

									pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '1';
			
																		
								}
								else 
								{
		
									pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '0';
								}								
							});			
								

								if (pnfpb_show_push_notify_types.length > 0) {

									for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 12; pnfpb_notify_type_element++) {

										if (pnfpb_show_push_notify_types[pnfpb_notify_type_element] !== 'all') {
			
											$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[pnfpb_notify_type_element]+'_enable').off().on('click',function(event) {
			
												var pnfpb_selector = '.'+$(this).attr("class");
			
												var pnfpb_index = $(this).attr("pnfpb_index");
			
												if ($j(pnfpb_selector).is(":checked"))
												{
			
													pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '1';
			
												
													if (pnfpb_notify_type_element > 0) {
						
														pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
											
														$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
			
													}
																			
												}
												else 
												{
			
													pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '0';
			
												}
											
			
											});
										}								
			
									}
		
								}										

                                if (pnfpb_custom_post_types.length > 0) {

                                    for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
        
                                        $j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
        
                                        $j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').off().on('click',function(event) {
                        
                                            if ($j(this).is(":checked"))
                                            {
        
                                                pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
                        
                                                pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
                                            
                                                $j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
                        
                                                                                
                                            }
                                            else 
                                            {

                                                pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';

                                            }

                                        });                             
        
                                    }
        
                                }     								
						
							

							$j('.pnfpb-popup-customprompt-vertical-transistion-allow-button').off().on( "click", async (event) => {

								//pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscribe_all_checkbox + pnfpb_bell_icon_subscribe_post_checkbox + pnfpb_bell_icon_subscribe_all_comments_checkbox + pnfpb_bell_icon_subscribe_my_comments_checkbox + pnfpb_bell_icon_subscribe_private_message_checkbox + pnfpb_bell_icon_subscribe_new_member_checkbox + pnfpb_bell_icon_subscribe_friendship_request_checkbox  + pnfpb_bell_icon_subscribe_friendship_accepted_checkbox  + pnfpb_bell_icon_subscribe_avatar_change_checkbox + pnfpb_bell_icon_subscribe_cover_image_checkbox + '0' + pnfpb_bell_icon_subscribe_activity_checkbox + pnfpb_bell_icon_subscribe_group_details_checkbox + pnfpb_bell_icon_subscribe_group_invite_checkbox;

								pnfpb_bell_icon_subscription_options_custom_prompt = '';

								if (pnfpb_show_push_notify_types.length > 0) {

									for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < pnfpb_show_push_notify_types.length; pnfpb_notify_type_element++) {
		
										pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element];
										
									}
		
								}
								
								if (pnfpb_custom_post_types.length > 0) {

									for (var pnfpb_post_type_element = 0; pnfpb_post_type_element <= 10; pnfpb_post_type_element++) {
		
										if (pnfpb_post_type_element < pnfpb_custom_post_types.length && pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element]) {
		
											pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element];
		
										} else {
		
											pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+'0';
										}
										
									}
		
								} else {
									pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+'0000000000';
								}
		
								pnfpb_bell_icon_subscription_options_custom_prompt = pnfpb_bell_icon_subscription_options_custom_prompt+ pnfpb_bell_icon_subscribe_favourite_checkbox+ pnfpb_bell_icon_subscribe_followers_checkbox

								$j('.pnfpb-popup-customprompt-vertical-container').hide();

								await requestPermission(registration,'',pnfpb_bell_icon_subscription_options_custom_prompt);	

							});						
	
							$j('.pnfpb-popup-customprompt-vertical-transistion-cancel-button').off().on( "click", async (event) => {

								const pnfpb_d = new Date();

								let expires = "expires=";

								if (pnfpb_d.getTime) {

									const pnfpb_custom_prompt_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_custom_prompt_show_again_days);

									pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_custom_prompt_show_again_days*24*60*60*1000));

									expires = "expires="+ pnfpb_d.toUTCString();

								}

								document.cookie = "PNFPB_custom_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
								
								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideDown') {

									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
								
										$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("animation-name", "slideDownOut");
					
										$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
	
									}
	
									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
					
										$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("animation-name", "slideDownOut");
					
										$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
										
									}
					
								}
					
								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideUp') {
	
									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
					
										$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("animation-name", "slideUpOut");
					
										$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");
	
									}
	
									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
					
										$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("animation-name", "slideUpOut");
					
										$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");
										
									}
					
								}								
	
								$j('.pnfpb-popup-customprompt-vertical-container').hide();

							});						

						}

					}

				}
			});		
		} 

		$j('.pnfpb-push-subscribe-icon').show();

		var pnfpb_popup_subscribe_text = __("You are subscribed to push notification",'push-notification-for-post-and-buddypress');

		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_message && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_message != '') {

			pnfpb_popup_subscribe_text = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_message;

		}

		var pnfpb_popup_unsubscribe_text = __("Push notification not subscribed",'push-notification-for-post-and-buddypress');

		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_message && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_message != '') {

			pnfpb_popup_unsubscribe_text = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_message;
			
		}

		var pnfpb_popup_wait_message = __("Please wait...processing",'push-notification-for-post-and-buddypress');

		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_wait_message && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_wait_message != '') {

			pnfpb_popup_wait_message = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_wait_message;
			
		}
		
		var pnfpb_popup_subscribe_button = __("Subscribe",'push-notification-for-post-and-buddypress');

		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_button && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_button != '') {

			pnfpb_popup_subscribe_button = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_button;
			
		}

		var pnfpb_popup_unsubscribe_button = __("Unsubscribe",'push-notification-for-post-and-buddypress');

		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_button && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_button != '') {

			pnfpb_popup_unsubscribe_button = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_button;
			
		}
		
		var pnfpb_push_subscribe_options_button = __("Update",'push-notification-for-post-and-buddypress');

		if (pnfpb_ajax_object_push.pnfpb_push_subscribe_options_button && pnfpb_ajax_object_push.pnfpb_push_subscribe_options_button != '') {

			pnfpb_push_subscribe_options_button = pnfpb_ajax_object_push.pnfpb_push_subscribe_options_button;
			
		}


		registration.pushManager.getSubscription().then(async function (subscription) {	

			if (subscription) {
				await checkdeviceid(registration,subscription);

			} 

		});	

		$j('.pnfpb-push-status-text').removeClass("pnfpb-push-status-text-opened");

		$j('.pnfpb-push-subscribe-icon').on( "mouseenter", function(event) {

			$j('.pnfpb-push-status-text').text(__('Verifying subscription status...','push-notification-for-post-and-buddypress'));

			navigator.serviceWorker.ready.then((serviceWorkerRegistration) => {

				serviceWorkerRegistration.pushManager.getSubscription().then(async function (subscription) {

					if (subscription && pnfpb_bell_prompt_processing !== '1') {

						$j('.pnfpb-push-status-text').text(pnfpb_popup_subscribe_text);
						$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");

					}
					else {

						if (pnfpb_bell_prompt_processing === '1') {

							$j('.pnfpb-push-status-text').removeClass("pnfpb-push-status-text-opened");

						} else {

							$j('.pnfpb-push-status-text').text(pnfpb_popup_unsubscribe_text);
							$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");

						}

					}
					
				})

			});

		}).on( "mouseleave", function() {

			$j('.pnfpb-push-status-text').removeClass("pnfpb-push-status-text-opened");

		});

		$j('.pnfpb-push-subscribe-icon').on( "click", function(event) {
	
			event.stopPropagation(); 
	
			event.preventDefault();


			pnfpb_bell_icon_prompt_subscription_options_custom_prompt = '10000000000000';
			
			pnfpb_subscription_options = '';

	
			$j('.pnfpb-push-subscribe-button-layout').toggle();

			$j('.pnfpb-push-status-text').removeClass("pnfpb-push-status-text-opened");

			if ($('.pnfpb-push-subscribe-button-layout').is(':visible')) {

				$j('.pnfpb-push-subscribe-button-layout').addClass("pnfpb-push-subscribe-button-layout-opened");	

			}
			else {

				$j('.pnfpb-push-subscribe-button-layout').removeClass("pnfpb-push-subscribe-button-layout-opened");

			}

			$j('.pnfpb-push-subscribe-button').text(__('Please wait...verifying status','push-notification-for-post-and-buddypress'));
	
			registration.pushManager.getSubscription().then(async function (subscription) {

				if (subscription) {

					$j('.pnfpb-push-subscribe-options-button').text(pnfpb_push_subscribe_options_button);

					$j('.pnfpb-push-subscribe-options-button').show();

					if ($j('.pnfpb-push-subscribe-options-button-container').length) {

						$j('.pnfpb-push-subscribe-options-button-container').show();
					}

					$j('.pnfpb-push-subscribe-button').text(pnfpb_popup_unsubscribe_button);

					$j('.pnfpb-push-subscribe-button').show();

					$j('.pnfpb-push-subscribe-button').removeClass("pnfpb-popup-subscribe-class");

					$j('.pnfpb-push-subscribe-button').addClass("pnfpb-popup-unsubscribe-class");

					pnfpb_subscription_options = '';
					
					await checkdeviceid(registration,subscription);

					if ($j('.pnfpb-push-subscribe-options-button-container').length) {

						$j('.pnfpb-push-subscribe-options-button').show();

					}
					
					$j('.pnfpb_bell_icon_prompt_subscription_all_enable').off().on('click',function(event) {

			
						if ($j('.pnfpb_bell_icon_prompt_subscription_all_enable').is(":checked"))
						{


							pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '1';

							if (pnfpb_show_push_notify_types.length > 0) {

								for (var pnfpb_notify_type_element = 1; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {

									pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_notify_type_element] = '0';

								}

							}
						
							$j('.pnfpb_bell_icon_prompt_subscription_post_enable').prop('checked',false);
	
							$j('.pnfpb_bell_icon_prompt_subscription_activity_enable').prop('checked',false);
	
							$j('.pnfpb_bell_icon_prompt_subscription_all_comments_enable').prop('checked',false);
	
							$j('.pnfpb_bell_icon_prompt_subscription_my_comments_enable').prop('checked',false);
	
							$j('.pnfpb_bell_icon_prompt_subscription_private_message_enable').prop('checked',false);
	
							$j('.pnfpb_bell_icon_prompt_subscription_new_member_enable').prop('checked',false);
	
							$j('.pnfpb_bell_icon_prompt_subscription_friendship_request_enable').prop('checked',false);
	
							$j('.pnfpb_bell_icon_prompt_subscription_friendship_accepted_enable').prop('checked',false);
	
							$j('.pnfpb_bell_icon_prompt_subscription_avatar_change_enable').prop('checked',false);
							
							$j('.pnfpb_bell_icon_prompt_subscription_cover_image_change_enable').prop('checked',false);
	
							$j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable').prop('checked',false);
	
							$j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable').prop('checked',false);

							$j('.pnfpb_bell_icon_prompt_subscription_favourite_enable').prop('checked',false);

							$j('.pnfpb_bell_icon_prompt_subscription_followers_enable').prop('checked',false);							

							if (pnfpb_custom_post_types.length > 0) {

								for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {

									$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);

									var pnfpb_index = $j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').attr("pnfpb_index");

									pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
									
								}
							}
	
	
						}
						else 
						{


							pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
						}								
					});

					$j('.pnfpb_bell_icon_prompt_subscription_favourite_enable').off().on('click',function(event) {
		
				
						if ($j('.pnfpb_bell_icon_prompt_subscription_favourite_enable').is(":checked"))
						{

						
							$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked',false);

							pnfpb_bell_icon_prompt_subscribe_favourite_checkbox = '1';
	
															
						}
						else 
						{
							pnfpb_bell_icon_prompt_subscribe_favourite_checkbox = '0';
						}								
					});

					$j('.pnfpb_bell_icon_prompt_subscription_followers_enable').off().on('click',function(event) {
		
				
						if ($j('.pnfpb_bell_icon_prompt_subscription_followers_enable').is(":checked"))
						{

						
							$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked',false);

							pnfpb_bell_icon_prompt_subscribe_followers_checkbox = '1';
	
															
						}
						else 
						{
							pnfpb_bell_icon_prompt_subscribe_followers_checkbox = '0';
						}								
					});					
					
					$j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable').off().on('click',function(event) {
	
			
						if ($j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable').is(":checked"))
						{

						
							$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked',false);
							pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '1';
	
															
						}
						else 
						{
							pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '0';
						}								
					});
					
					$j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable').off().on('click',function(event) {
	
			
						if ($j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable').is(":checked"))
						{

						
							$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked',false);
							pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '1';
	
																
						}
						else 
						{

							pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '0';
						}								
					});				
					
					
					
					if (pnfpb_show_push_notify_types.length > 0) {

						for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 12; pnfpb_notify_type_element++) {

							if (pnfpb_show_push_notify_types[pnfpb_notify_type_element] !== 'all') {

								$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_notify_type_element]+'_enable').off().on('click',function(event) {

									var pnfpb_selector = '.'+$(this).attr("class");

									var pnfpb_index = $(this).attr("pnfpb_index");

									if ($j(pnfpb_selector).is(":checked"))
									{

										pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_index] = '1';

									
										if (pnfpb_notify_type_element > 0) {
			
											pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
								
											$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked',false);

										}
																
									}
									else 
									{

										pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_index] = '0';

									}
								

								});
							}								

						}

					}

					if (pnfpb_custom_post_types.length > 0) {

						for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {

							$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').off().on('click',function(event) {
	
								var pnfpb_selector = '.'+$(this).attr("class");

								var pnfpb_index = $(this).attr("pnfpb_index");

								if ($j(pnfpb_selector).is(":checked"))
								{

									pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';

									pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
								
									$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked',false);
			
					
								}
								else 
								{
									
									pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '0';


								}


							});								

						}

					}					
	
					$j('.pnfpb-push-subscribe-options-button').off().on( "click", async (event) => {
	
						event.stopPropagation(); 
						
						event.preventDefault();	
						
						$j('.pnfpb_bell_icon_custom_prompt_loader').show();
	
						$j('.pnfpb_bell_icon_subscription_options_container').show();					
	
						$j('.pnfpb-push-subscribe-options-button').prop('disabled', true);
	
						var pnfpb_bell_icon_prompt_subscription_options = '';
	
						if (pnfpb_show_push_notify_types.length > 0) {

							for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {

								pnfpb_bell_icon_prompt_subscription_options = pnfpb_bell_icon_prompt_subscription_options+pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_notify_type_element];
								
							}

						}
						
						if (pnfpb_custom_post_types.length > 0) {

							for (var pnfpb_post_type_element = 0; pnfpb_post_type_element <= 10; pnfpb_post_type_element++) {

								if (pnfpb_post_type_element < pnfpb_custom_post_types.length && pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element]) {

									pnfpb_bell_icon_prompt_subscription_options = pnfpb_bell_icon_prompt_subscription_options+pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element];

								} else {

									pnfpb_bell_icon_prompt_subscription_options = pnfpb_bell_icon_prompt_subscription_options+'0';
								}
								
							}

						} else {
							pnfpb_bell_icon_prompt_subscription_options = pnfpb_bell_icon_prompt_subscription_options+'0000000000';
						}

						pnfpb_bell_icon_prompt_subscription_options = pnfpb_bell_icon_prompt_subscription_options+pnfpb_bell_icon_prompt_subscribe_favourite_checkbox+pnfpb_bell_icon_prompt_subscribe_followers_checkbox;

						getToken(messaging,{serviceWorkerRegistration:registration,vapidKey:vapidKey }).then(async function (refreshedToken) {		
			
							if (refreshedToken) {
		   
								deviceid = refreshedToken;
		
								var data = {
									action: 'icpushcallback',
									device_id:deviceid,
									subscriptionoptions:pnfpb_bell_icon_prompt_subscription_options,
									nonce: pnfpb_ajax_object_push.nonce,
									pushtype: 'subscribe-button'
								};
			
								$j.post(pnfpb_ajax_object_push.ajax_url, data, function(responseajax) {
								
									var response = JSON.parse(responseajax);
								
									pnfpb_subscription_options = response.subscriptionoptions;
	
									$j('.pnfpb_bell_icon_custom_prompt_loader').hide();
	
									$j('.pnfpb-push-subscribe-options-button').prop('disabled', false);
	
									$j('.pnfpb_bell_icon_subscription_options_container').show();		
	
									$j('.pnfpb-push-status-text').text(__('Subscription options updated','push-notification-for-post-and-buddypress'));
	
									$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");
	
		
								});
							}
						});
	
					});					
					

				} else  {

					if ($j('.pnfpb-push-subscribe-options-button-container').length) {

						$j('.pnfpb-push-subscribe-options-button-container').show();

						$j('.pnfpb-push-subscribe-options-button').show();

					}

					$j('.pnfpb-push-subscribe-button').text(pnfpb_popup_subscribe_button);

					$j('.pnfpb-push-subscribe-button').show();

					$j('.pnfpb-push-subscribe-button').removeClass("pnfpb-popup-unsubscribe-class");

					$j('.pnfpb-push-subscribe-button').addClass("pnfpb-popup-subscribe-class");					

				}

								
				$j('.pnfpb-push-subscribe-button').off().on( "click", async (event) => {

					event.stopPropagation(); 
			
					event.preventDefault();

					if ($j('.pnfpb-push-subscribe-button').hasClass("pnfpb-popup-subscribe-class")) {

						var subscribetext = $j('.pnfpb-push-subscribe-button').text();

						pnfpb_bell_prompt_processing = '1';

						registration.pushManager.getSubscription().then(async function (subscription) {

							if (!subscription) {

								$j('.pnfpb-push-subscribe-button-layout').show();

								$j('.pnfpb-push-subscribe-button').prop('disabled', true);
								
								$j('.pnfpb-push-subscribe-options-button').prop('disabled', true);						

								$j('.pnfpb-push-status-text').text(pnfpb_popup_wait_message);

								$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");

								$j('.pnfpb_bell_icon_custom_prompt_loader').show();

								var pnfpb_ic_fcm_custom_prompt_subscribe_text_1 = __("We would like to show you notifications for the latest news and updates",'push-notification-for-post-and-buddypress');

								var pnfpb_ic_fcm_custom_prompt_subscribe_text_2 = "";
			
								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribe_text && pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribe_text != '') {
							
									pnfpb_ic_fcm_custom_prompt_subscribe_text_1 = pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribe_text;
									
									pnfpb_ic_fcm_custom_prompt_subscribe_text_2 = pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribe_text_line_2;
									
								}						
								
								if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_on_off === '1' && (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style	 === '1' || pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2' )) {

									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {

										$j('.pnfpb-popup-customprompt-transistion-body-line-1').text(pnfpb_ic_fcm_custom_prompt_subscribe_text_1);

										$j('.pnfpb-popup-customprompt-transistion-body-line-2').text(pnfpb_ic_fcm_custom_prompt_subscribe_text_2);

										$j('.pnfpb-popup-customprompt-transistion-confirmation').hide();
								
										$j('.pnfpb-popup-customprompt-container').show();

										$j('.pnfpb-popup-customprompt-transistion').show();

										pnfpb_bell_icon_subscription_options_custom_prompt = '';

										$j('.pnfpb_bell_icon_subscription_all_enable').off().on('click',function(event) {
							
											if ($j('.pnfpb_bell_icon_subscription_all_enable').is(":checked"))
											{
					
												pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';
					
												if (pnfpb_show_push_notify_types.length > 0) {
					
													for (var pnfpb_notify_type_element = 1; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {
					
														pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element] = '0';
					
													}
					
												}
											
												$j('.pnfpb_bell_icon_subscription_post_enable').prop('checked',false);
						
												$j('.pnfpb_bell_icon_subscription_activity_enable').prop('checked',false);
						
												$j('.pnfpb_bell_icon_subscription_all_comments_enable').prop('checked',false);
						
												$j('.pnfpb_bell_icon_subscription_my_comments_enable').prop('checked',false);
						
												$j('.pnfpb_bell_icon_subscription_private_message_enable').prop('checked',false);
						
												$j('.pnfpb_bell_icon_subscription_new_member_enable').prop('checked',false);
						
												$j('.pnfpb_bell_icon_subscription_friendship_request_enable').prop('checked',false);
						
												$j('.pnfpb_bell_icon_subscription_friendship_accepted_enable').prop('checked',false);
						
												$j('.pnfpb_bell_icon_subscription_avatar_change_enable').prop('checked',false);
												
												$j('.pnfpb_bell_icon_subscription_cover_image_change_enable').prop('checked',false);
						
												$j('.pnfpb_bell_icon_subscription_group_details_update_enable').prop('checked',false);
						
												$j('.pnfpb_bell_icon_subscription_group_invite_enable').prop('checked',false);

												$j('.pnfpb_bell_icon_subscription_favourite_enable').prop('checked',false);

												$j('.pnfpb_bell_icon_subscription_followers_enable').prop('checked',false);												
					
												if (pnfpb_custom_post_types.length > 0) {
					
													for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
					
														$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
					
														var pnfpb_index = $j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').attr("pnfpb_index");
					
														pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
														
													}
												}
						
						
											}
											else 
											{
					
					
												pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
											}								
										});

										$j('.pnfpb_bell_icon_subscription_favourite_enable').off().on('click',function(event) {
		
				
											if ($j('.pnfpb_bell_icon_subscription_favourite_enable').is(":checked"))
											{
					
											
												$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
					
												pnfpb_bell_icon_subscribe_favourite_checkbox = '1';
						
																				
											}
											else 
											{
												pnfpb_bell_icon_subscribe_favourite_checkbox = '0';
											}								
										});	
										
										$j('.pnfpb_bell_icon_subscription_followers_enable').off().on('click',function(event) {
		
				
											if ($j('.pnfpb_bell_icon_subscription_followers_enable').is(":checked"))
											{
					
											
												$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
					
												pnfpb_bell_icon_subscribe_followers_checkbox = '1';
						
																				
											}
											else 
											{
												pnfpb_bell_icon_subscribe_followers_checkbox = '0';
											}								
										});										
										
										
										$j('.pnfpb_bell_icon_subscription_group_details_update_enable').off().on('click',function(event) {
						
								
											if ($j('.pnfpb_bell_icon_subscription_group_details_update_enable').is(":checked"))
											{
					
											
												$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
			
												pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '1';
						
																				
											}
											else 
											{
												pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '0';
											}								
										});
										
										$j('.pnfpb_bell_icon_subscription_group_invite_enable').off().on('click',function(event) {
						
								
											if ($j('.pnfpb_bell_icon_subscription_group_invite_enable').is(":checked"))
											{
					
											
												$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
			
												pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '1';
						
																					
											}
											else 
											{
					
												pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '0';
											}								
										});			
											
			
											if (pnfpb_show_push_notify_types.length > 0) {
			
												for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 12; pnfpb_notify_type_element++) {
			
													if (pnfpb_show_push_notify_types[pnfpb_notify_type_element] !== 'all') {
						
														$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[pnfpb_notify_type_element]+'_enable').off().on('click',function(event) {
						
															var pnfpb_selector = '.'+$(this).attr("class");
						
															var pnfpb_index = $(this).attr("pnfpb_index");
						
															if ($j(pnfpb_selector).is(":checked"))
															{
						
																pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '1';
						
															
																if (pnfpb_notify_type_element > 0) {
									
																	pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
														
																	$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
						
																}
																						
															}
															else 
															{
						
																pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '0';
						
															}
														
						
														});
													}								
						
												}
					
											}										
			
											if (pnfpb_custom_post_types.length > 0) {
			
												for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
					
													$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
					
													$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').off().on('click',function(event) {
									
														if ($j(this).is(":checked"))
														{
					
															pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
									
															pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
														
															$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
									
																							
														}
														else 
														{
			
															pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
			
														}
			
													});                             
					
												}
					
											}     														
				
										$j('.pnfpb-popup-customprompt-transistion-allow-button').off().on( "click", async (event) => {
								
											//var pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscribe_all_checkbox + pnfpb_bell_icon_subscribe_post_checkbox + pnfpb_bell_icon_subscribe_all_comments_checkbox + pnfpb_bell_icon_subscribe_my_comments_checkbox + pnfpb_bell_icon_subscribe_private_message_checkbox + pnfpb_bell_icon_subscribe_new_member_checkbox + pnfpb_bell_icon_subscribe_friendship_request_checkbox  + pnfpb_bell_icon_subscribe_friendship_accepted_checkbox  + pnfpb_bell_icon_subscribe_avatar_change_checkbox + pnfpb_bell_icon_subscribe_cover_image_checkbox + '0' + pnfpb_bell_icon_subscribe_activity_checkbox + pnfpb_bell_icon_subscribe_group_details_checkbox + pnfpb_bell_icon_subscribe_group_invite_checkbox;

											var pnfpb_bell_icon_subscription_options = '';

											if (pnfpb_show_push_notify_types.length > 0) {

												for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < pnfpb_show_push_notify_types.length; pnfpb_notify_type_element++) {
					
													pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element];
													
												}
					
											}
											
											if (pnfpb_custom_post_types.length > 0) {
					
												for (var pnfpb_post_type_element = 0; pnfpb_post_type_element <= 10; pnfpb_post_type_element++) {

													if (pnfpb_post_type_element < pnfpb_custom_post_types.length && pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element]) {
					
														pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element];

													} else {

														pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+'0';
													}
													
												}
					
											} else {
												pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+'0000000000';
											}
											
											pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+pnfpb_bell_icon_subscribe_favourite_checkbox+pnfpb_bell_icon_subscribe_followers_checkbox;

											$j('.pnfpb-popup-customprompt-container').hide();

											pnfpb_bell_prompt_processing = '1';

											await requestPermission(registration,'',pnfpb_bell_icon_subscription_options);						
				
										});						
				
										$j('.pnfpb-popup-customprompt-transistion-cancel-button').off().on( "click", async (event) => {

											$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("animation-name", "slideDownOut");
								
											$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
				
											$j('.pnfpb-popup-customprompt-container').hide();
				
										});
				
									} else {
				
										if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {

											$j('.pnfpb-popup-customprompt-vertical-transistion-body-line-1').text(pnfpb_ic_fcm_custom_prompt_subscribe_text_1);

											$j('.pnfpb-popup-customprompt-vertical-transistion-body-line-2').text(pnfpb_ic_fcm_custom_prompt_subscribe_text_2);

											$j('.pnfpb-popup-customprompt-vertical-transistion-confirmation').hide();
				
											$j('.pnfpb-popup-customprompt-vertical-container').show();

											$j('.pnfpb-popup-customprompt-vertical-transistion').show();

											pnfpb_bell_icon_subscription_options_custom_prompt = '';

											$j('.pnfpb_bell_icon_subscription_all_enable').off().on('click',function(event) {
				
							
												if ($j('.pnfpb_bell_icon_subscription_all_enable').is(":checked"))
												{
						
						
													pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';
						
													if (pnfpb_show_push_notify_types.length > 0) {
						
														for (var pnfpb_notify_type_element = 1; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {
						
															pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element] = '0';
						
														}
						
													}
												
													$j('.pnfpb_bell_icon_subscription_post_enable').prop('checked',false);
							
													$j('.pnfpb_bell_icon_subscription_activity_enable').prop('checked',false);
							
													$j('.pnfpb_bell_icon_subscription_all_comments_enable').prop('checked',false);
							
													$j('.pnfpb_bell_icon_subscription_my_comments_enable').prop('checked',false);
							
													$j('.pnfpb_bell_icon_subscription_private_message_enable').prop('checked',false);
							
													$j('.pnfpb_bell_icon_subscription_new_member_enable').prop('checked',false);
							
													$j('.pnfpb_bell_icon_subscription_friendship_request_enable').prop('checked',false);
							
													$j('.pnfpb_bell_icon_subscription_friendship_accepted_enable').prop('checked',false);
							
													$j('.pnfpb_bell_icon_subscription_avatar_change_enable').prop('checked',false);
													
													$j('.pnfpb_bell_icon_subscription_cover_image_change_enable').prop('checked',false);
							
													$j('.pnfpb_bell_icon_subscription_group_details_update_enable').prop('checked',false);
							
													$j('.pnfpb_bell_icon_subscription_group_invite_enable').prop('checked',false);

													$j('.pnfpb_bell_icon_subscription_favourite_enable').prop('checked',false);

													$j('.pnfpb_bell_icon_subscription_followers_enable').prop('checked',false);													
						
													if (pnfpb_custom_post_types.length > 0) {
						
														for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
						
															$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
						
															var pnfpb_index = $j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').attr("pnfpb_index");
						
															pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
															
														}
													}
							
							
												}
												else 
												{
						
						
													pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
												}								
											});

											$j('.pnfpb_bell_icon_subscription_favourite_enable').off().on('click',function(event) {
		
				
												if ($j('.pnfpb_bell_icon_subscription_favourite_enable').is(":checked"))
												{
						
												
													$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
						
													pnfpb_bell_icon_subscribe_favourite_checkbox = '1';
							
																					
												}
												else 
												{
													pnfpb_bell_icon_subscribe_favourite_checkbox = '0';
												}								
											});
											
											$j('.pnfpb_bell_icon_subscription_followers_enable').off().on('click',function(event) {
		
				
												if ($j('.pnfpb_bell_icon_subscription_followers_enable').is(":checked"))
												{
						
												
													$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
						
													pnfpb_bell_icon_subscribe_followers_checkbox = '1';
							
																					
												}
												else 
												{
													pnfpb_bell_icon_subscribe_followers_checkbox = '0';
												}								
											});												
											
											
											$j('.pnfpb_bell_icon_subscription_group_details_update_enable').off().on('click',function(event) {
							
									
												if ($j('.pnfpb_bell_icon_subscription_group_details_update_enable').is(":checked"))
												{
						
												
													$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
				
													pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '1';
							
																					
												}
												else 
												{
													pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '0';
												}								
											});
											
											$j('.pnfpb_bell_icon_subscription_group_invite_enable').off().on('click',function(event) {
							
									
												if ($j('.pnfpb_bell_icon_subscription_group_invite_enable').is(":checked"))
												{
						
												
													$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
				
													pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '1';
							
																						
												}
												else 
												{
						
													pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '0';
												}								
											});			
												
				
												if (pnfpb_show_push_notify_types.length > 0) {
				
													for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 12; pnfpb_notify_type_element++) {
				
														if (pnfpb_show_push_notify_types[pnfpb_notify_type_element] !== 'all') {
							
															$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[pnfpb_notify_type_element]+'_enable').off().on('click',function(event) {
							
																var pnfpb_selector = '.'+$(this).attr("class");
							
																var pnfpb_index = $(this).attr("pnfpb_index");
							
																if ($j(pnfpb_selector).is(":checked"))
																{
							
																	pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '1';
							
																
																	if (pnfpb_notify_type_element > 0) {
										
																		pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
															
																		$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
							
																	}
																							
																}
																else 
																{
							
																	pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_index] = '0';
							
																}
															
							
															});
														}								
							
													}
						
												}										
				
												if (pnfpb_custom_post_types.length > 0) {
				
													for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
						
														$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
						
														$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').off().on('click',function(event) {
										
															if ($j(this).is(":checked"))
															{
						
																pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
										
																pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '0';
															
																$j('.pnfpb_bell_icon_subscription_all_enable').prop('checked',false);
										
																								
															}
															else 
															{
				
																pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
				
															}
				
														});                             
						
													}
						
												}     															
				
											$j('.pnfpb-popup-customprompt-vertical-transistion-allow-button').off().on( "click", async (event) => {

				
												var pnfpb_bell_icon_subscription_options = '';

												if (pnfpb_show_push_notify_types.length > 0) {
			
													for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < pnfpb_show_push_notify_types.length; pnfpb_notify_type_element++) {
						
														pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_notify_type_element];
														
													}
						
												}
												
												if (pnfpb_custom_post_types.length > 0) {
						
													for (var pnfpb_post_type_element = 0; pnfpb_post_type_element <= 10; pnfpb_post_type_element++) {

														if (pnfpb_post_type_element < pnfpb_custom_post_types.length && pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element]) {
						
															pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element];

														}  else  {

															pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+'0';

														}
														
													}
						
												} else {
													pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+'0000000000';
												}

												pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+pnfpb_bell_icon_subscribe_favourite_checkbox+pnfpb_bell_icon_subscribe_followers_checkbox;
												
												$j('.pnfpb-popup-customprompt-vertical-container').hide();

												pnfpb_bell_prompt_processing = '1';

												await requestPermission(registration,'',pnfpb_bell_icon_subscription_options);	
				
											});						
					
											$j('.pnfpb-popup-customprompt-vertical-transistion-cancel-button').off().on( "click", async (event) => {

												$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("animation-name", "slideDownOut");
									
												$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");

												$j('.pnfpb-popup-customprompt-vertical-container').hide();
					
											})
				
										}
				
									}							

								} else {

									var pnfpb_bell_icon_subscription_options = '';

									$j('.pnfpb_bell_icon_prompt_subscription_all_enable').off().on('click',function(event) {

					
										if ($j('.pnfpb_bell_icon_prompt_subscription_all_enable').is(":checked"))
										{
				
				
											pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '1';
				
											if (pnfpb_show_push_notify_types.length > 0) {
				
												for (var pnfpb_notify_type_element = 1; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {
				
													pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_notify_type_element] = '0';
				
												}
				
											}
										
											$j('.pnfpb_bell_icon_prompt_subscription_post_enable').prop('checked',false);
					
											$j('.pnfpb_bell_icon_prompt_subscription_activity_enable').prop('checked',false);
					
											$j('.pnfpb_bell_icon_prompt_subscription_all_comments_enable').prop('checked',false);
					
											$j('.pnfpb_bell_icon_prompt_subscription_my_comments_enable').prop('checked',false);
					
											$j('.pnfpb_bell_icon_prompt_subscription_private_message_enable').prop('checked',false);
					
											$j('.pnfpb_bell_icon_prompt_subscription_new_member_enable').prop('checked',false);
					
											$j('.pnfpb_bell_icon_prompt_subscription_friendship_request_enable').prop('checked',false);
					
											$j('.pnfpb_bell_icon_prompt_subscription_friendship_accepted_enable').prop('checked',false);
					
											$j('.pnfpb_bell_icon_prompt_subscription_avatar_change_enable').prop('checked',false);
											
											$j('.pnfpb_bell_icon_prompt_subscription_cover_image_change_enable').prop('checked',false);
					
											$j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable').prop('checked',false);
					
											$j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable').prop('checked',false);

											$j('.pnfpb_bell_icon_prompt_subscription_favourite_enable').prop('checked',false);

											$j('.pnfpb_bell_icon_prompt_subscription_followers_enable').prop('checked',false);											
				
											if (pnfpb_custom_post_types.length > 0) {
				
												for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
				
													$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked',false);
				
													var pnfpb_index = $j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').attr("pnfpb_index");
				
													pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
													
												}
											}
					
					
										}
										else 
										{

											pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
										}								
									});

									$j('.pnfpb_bell_icon_prompt_subscription_favourite_enable').off().on('click',function(event) {
		
				
										if ($j('.pnfpb_bell_icon_prompt_subscription_favourite_enable').is(":checked"))
										{
				
										
											$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked',false);
				
											pnfpb_bell_icon_prompt_subscribe_favourite_checkbox = '1';
					
																			
										}
										else 
										{
											pnfpb_bell_icon_prompt_subscribe_favourite_checkbox = '0';
										}								
									});

									$j('.pnfpb_bell_icon_prompt_subscription_followers_enable').off().on('click',function(event) {
		
				
										if ($j('.pnfpb_bell_icon_prompt_subscription_followers_enable').is(":checked"))
										{
				
										
											$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked',false);
				
											pnfpb_bell_icon_prompt_subscribe_followers_checkbox = '1';
					
																			
										}
										else 
										{
											pnfpb_bell_icon_prompt_subscribe_followers_checkbox = '0';
										}								
									});									
									
									
									$j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable').off().on('click',function(event) {
					
							
										if ($j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable').is(":checked"))
										{
										
											$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked',false);

											pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '1';
					
										}
										else 
										{
											pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '0';
										}								
									});
									
									$j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable').off().on('click',function(event) {
					
							
										if ($j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable').is(":checked"))
										{
										
											$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked',false);

											pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '1';
																				
										}
										else 
										{
				
											pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '0';
										}								
									});				
									
									
									
									if (pnfpb_show_push_notify_types.length > 0) {
				
										for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 12; pnfpb_notify_type_element++) {
				
											if (pnfpb_show_push_notify_types[pnfpb_notify_type_element] !== 'all') {
				
												$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_notify_type_element]+'_enable').off().on('click',function(event) {
				
													var pnfpb_selector = '.'+$(this).attr("class");
				
													var pnfpb_index = $(this).attr("pnfpb_index");
				
													if ($j(pnfpb_selector).is(":checked"))
													{
				
														pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_index] = '1';
				
													
														if (pnfpb_notify_type_element > 0) {
							
															pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
												
															$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked',false);
				
														}
																				
													}
													else 
													{
				
														pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_index] = '0';
				
													}
												
				
												});
											}								
				
										}
				
									}
				
									if (pnfpb_custom_post_types.length > 0) {
				
										for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
				
											$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').off().on('click',function(event) {
					
												var pnfpb_selector = '.'+$(this).attr("class");
				
												var pnfpb_index = $(this).attr("pnfpb_index");
				
												if ($j(pnfpb_selector).is(":checked"))
												{
				
													pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
				
													pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
												
													$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked',false);
							
									
												}
												else 
												{
													
													pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '0';
				
				
												}
				
				
											});								
				
										}
				
									}					
				

									if (pnfpb_show_push_notify_types.length > 0) {

										for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < pnfpb_show_push_notify_types.length; pnfpb_notify_type_element++) {
			
											pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_notify_type_element];
											
										}
			
									}
									
									
									if (pnfpb_custom_post_types.length > 0) {
			
										for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {

											if (pnfpb_post_type_element < pnfpb_custom_post_types.length && pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element]) {
			
												pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element];

											} else {

												pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+'0';

											}
											
										}
			
									} else {
										pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+'0000000000';
									}
									
									pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+pnfpb_bell_icon_subscribe_favourite_checkbox+pnfpb_bell_icon_subscribe_followers_checkbox;	
									
									pnfpb_bell_prompt_processing = '1';

									await requestPermission(registration,'',pnfpb_bell_icon_subscription_options);

								}

							} else {

								console.log('Push notification already subscribed');

								$j('.pnfpb_bell_icon_custom_prompt_loader').hide();

								$j('.pnfpb-push-subscribe-button').text(pnfpb_popup_unsubscribe_button);
			
								$j('.pnfpb-push-subscribe-button').removeClass("pnfpb-popup-subscribe-class");

								$j('.pnfpb-push-subscribe-button').addClass("pnfpb-popup-unsubscribe-class");

								$j('.pnfpb-push-status-text').removeClass("pnfpb-push-status-text-opened");	

								$j('.pnfpb-push-status-text').text(pnfpb_popup_subscribe_text);

								$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");

								$j('.pnfpb-push-subscribe-button').prop('disabled', false);
		
								$j('.pnfpb-push-subscribe-options-button').prop('disabled', false);	

							}

						});

					} else {

						if ($j('.pnfpb-push-subscribe-button').hasClass("pnfpb-popup-unsubscribe-class")) {

							var subscribetext = $j('.pnfpb-push-subscribe-button').text();

							$j('.pnfpb-push-subscribe-button-layout').show();

							$j('.pnfpb_bell_icon_custom_prompt_loader').show();
		
							pnfpb_bell_prompt_processing = '1';
		
							registration.pushManager.getSubscription().then(async (subscription) => {
		
								if (subscription) {
		
									$j('.pnfpb-push-subscribe-button').prop('disabled', true);
								
									$j('.pnfpb-push-subscribe-options-button').prop('disabled', true);								
		
									$j('.pnfpb-push-status-text').text(pnfpb_popup_wait_message);
		
									$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");	
		
									getToken(messaging,{serviceWorkerRegistration:registration,vapidKey:vapidKey }).then(async (refreshedToken) => {
		
										subscription.unsubscribe().then((successful) => {
		
											deleteToken(messaging).then(function (deleteTokenstatus) {
		
												if (deleteTokenstatus) {
		
		
													var data = {
														action: 'icpushcallback',
														device_id:refreshedToken,
														nonce: pnfpb_ajax_object_push.nonce,
														pushtype: 'deletepushtoken'
													};
														
													$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {

														$j('.pnfpb_bell_icon_custom_prompt_loader').hide();
									
														var responseobject = JSON.parse(response);
		
														pnfpb_bell_prompt_processing = '';
													
														if (responseobject.subscriptionstatus === 'deleted') {
													
															console.log(__('Push subscription token deleted successfully','push-notification-for-post-and-buddypress'));
													
														}
														else {
															console.log(__('Push subscription token deletion failed in database','push-notification-for-post-and-buddypress'));
														}
		
														if ($j(".subscribegroupbutton").length || $j(".unsubscribegroupbutton").length) {
		
															$j(".subscribegroupbutton").addClass( "subscribe-init-display-off" );
															$j(".unsubscribegroupbutton").addClass( "subscribe-init-display-off" );
															$j(".subscribe-notification-group").addClass( "subscribe-init-display-off" );
															$j(".unsubscribe-notification-group").addClass( "subscribe-init-display-off" );
		
															// Get an array of all cookie names (the regex matches what we don't want)
															var cookieNames = document.cookie.split(/=[^;]*(?:;\s*|$)/);
		
															// Remove any that match the pattern
															for (var i = 0; i < cookieNames.length; i++) {
																if (/^pnfpb_group_push_notification_/.test(cookieNames[i])) {
																	document.cookie = cookieNames[i] + '=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=' + path;
																}
															}													
		
														}
		
														$j('.pnfpb-push-subscribe-button').text(pnfpb_popup_subscribe_button);
		
														$j('.pnfpb-push-subscribe-button').removeClass("pnfpb-popup-unsubscribe-class");
		
														$j('.pnfpb-push-subscribe-button').addClass("pnfpb-popup-subscribe-class");
		
														$j('.pnfpb-push-status-text').removeClass("pnfpb-push-status-text-opened");	
		
														$j('.pnfpb-push-status-text').text(pnfpb_popup_unsubscribe_text);
			
														$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");
		
														$j('.pnfpb-push-subscribe-button').prop('disabled', false);
								
														$j('.pnfpb-push-subscribe-options-button').prop('disabled', false);													
														
		
														pnfpb_bell_icon_subscribe_push_type_checkbox = ['1','0','0','0','0','0','0','0','0','0','0','0','0','0'];
												
														pnfpb_bell_icon_subscription_options_custom_prompt = '10000000000000';
														
												
														pnfpb_bell_icon_prompt_subscription_options_custom_prompt = '10000000000000';
														
														pnfpb_bell_icon_prompt_subscribe_push_type_checkbox = ['1','0','0','0','0','0','0','0','0','0','0','0','0','0'];
													
													});												
			
		
												}
			
											}).catch((e) => {
		
												pnfpb_bell_prompt_processing = '';
		
												console.log(__("Unsubscribe token failed",'push-notification-for-post-and-buddypress'));
		
											});
										}).catch((e) => {
		
											pnfpb_bell_prompt_processing = '';
		
											console.log(__("Unsubscribe token failed",'push-notification-for-post-and-buddypress'));
		
										});
									})
								} else {

									$j('.pnfpb-push-subscribe-button').text(pnfpb_popup_subscribe_button);
		
									$j('.pnfpb-push-subscribe-button').removeClass("pnfpb-popup-unsubscribe-class");

									$j('.pnfpb-push-subscribe-button').addClass("pnfpb-popup-subscribe-class");

									$j('.pnfpb-push-status-text').removeClass("pnfpb-push-status-text-opened");	

									$j('.pnfpb-push-status-text').text(pnfpb_popup_unsubscribe_text);

									$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");

									$j('.pnfpb-push-subscribe-button').prop('disabled', false);
			
									$j('.pnfpb-push-subscribe-options-button').prop('disabled', false);	

								}
							}).catch((e) => {
		
								pnfpb_bell_prompt_processing = '';
		
								console.log(__("Unsubscribe subscription failed",'push-notification-for-post-and-buddypress'));
		
							});
						
						}

					}
			
				})							
	
			})
	
		});
	
		} 
	
	}
			

async function shortcode_subscription_menu(refreshedToken) {
    if( $j(".pnfpb-push-subscribe-icon-shortcode").length || pnfpb_shortcode_installed )
    {

	  if ("serviceWorker" in navigator ) {
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
			
			shortcode_subscription_options(registration,'')

		}) 
	  } else {
		console.log('Service worker not available in browser')
	  }
	} 
}

function shortcode_subscription_options(registration,refreshedToken) {

	pnfpb_bell_icon_subscribe_push_type_checkbox = ['1','0','0','0','0','0','0','0','0','0','0','0','0','0'];

	pnfpb_bell_icon_subscription_options_custom_prompt = '10000000000000';

	pnfpb_bell_icon_prompt_subscription_options_custom_prompt = '10000000000000';

	pnfpb_bell_icon_prompt_subscribe_push_type_checkbox = ['1','0','0','0','0','0','0','0','0','0','0','0','0','0'];

	$j('.pnfpb-push-subscribe-icon-shortcode').show();

	var pnfpb_popup_subscribe_text = __("You are subscribed to push notification",'push-notification-for-post-and-buddypress');

	if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_message && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_message != '') {

		pnfpb_popup_subscribe_text = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_message;

	}

	var pnfpb_popup_unsubscribe_text = __("Push notification not subscribed",'push-notification-for-post-and-buddypress');

	if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_message && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_message != '') {

		pnfpb_popup_unsubscribe_text = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_message;
		
	}

	var pnfpb_popup_wait_message = __("Please wait...processing",'push-notification-for-post-and-buddypress');

	if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_wait_message && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_wait_message != '') {

		pnfpb_popup_wait_message = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_wait_message;
		
	}
	
	var pnfpb_popup_subscribe_button = __("Subscribe",'push-notification-for-post-and-buddypress');

	if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_button && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_button != '') {

		pnfpb_popup_subscribe_button = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_button;
		
	}

	var pnfpb_popup_unsubscribe_button = __("Unsubscribe",'push-notification-for-post-and-buddypress');

	if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_button && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_button != '') {

		pnfpb_popup_unsubscribe_button = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_button;
		
	}
	
	var pnfpb_push_subscribe_options_button = __("Update",'push-notification-for-post-and-buddypress');

	if (pnfpb_ajax_object_push.pnfpb_push_subscribe_options_button && pnfpb_ajax_object_push.pnfpb_push_subscribe_options_button != '') {

		pnfpb_push_subscribe_options_button = pnfpb_ajax_object_push.pnfpb_push_subscribe_options_button;
		
	}

	$j('.pnfpb_shortcode_popup_close').on( "click", function(event) {

		event.stopPropagation(); 

		event.preventDefault();

		$j('.pnfpb-push-subscribe-button-layout-shortcode').hide();

	});

	registration.pushManager.getSubscription().then(async function (subscription) {	

		if (subscription) {

			await checkdeviceid(registration,subscription);

		} 

	});		


	$j('.pnfpb-push-status-text-shortcode').removeClass("pnfpb-push-status-text-opened-shortcode");

	$j('.pnfpb-push-subscribe-icon-shortcode').on( "mouseenter", function(event) {

		$j('.pnfpb-push-status-text-shortcode').text(__('Verifying subscription status...','push-notification-for-post-and-buddypress'));

		navigator.serviceWorker.ready.then((serviceWorkerRegistration) => {

			serviceWorkerRegistration.pushManager.getSubscription().then(async function (subscription) {

				if (subscription && pnfpb_bell_prompt_processing !== '1') {

					$j('.pnfpb-push-status-text-shortcode').text(pnfpb_popup_subscribe_text);

					$j('.pnfpb-push-status-text-shortcode').addClass("pnfpb-push-status-text-opened-shortcode");

				}
				else {

					if (pnfpb_bell_prompt_processing === '1') {

						$j('.pnfpb-push-status-text-shortcode').removeClass("pnfpb-push-status-text-opened-shortcode");

					} else {

						$j('.pnfpb-push-status-text-shortcode').text(pnfpb_popup_unsubscribe_text);

						$j('.pnfpb-push-status-text-shortcode').addClass("pnfpb-push-status-text-opened-shortcode");

					}

				}
				
			})

		});

	}).on( "mouseleave", function() {

		$j('.pnfpb-push-status-text-shortcode').removeClass("pnfpb-push-status-text-opened-shortcode");

	});	

	$j('.pnfpb-push-subscribe-icon-shortcode').on( "click", function(event) {

		event.stopPropagation(); 

		event.preventDefault();

		pnfpb_bell_icon_prompt_subscription_options_custom_prompt = '10000000000000';
		
		pnfpb_subscription_options = '';


		$j('.pnfpb-push-subscribe-button-layout-shortcode').toggle();

		$j('.pnfpb-push-status-text-shortcode').removeClass("pnfpb-push-status-text-opened-shortcode");

		if ($('.pnfpb-push-subscribe-button-layout-shortcode').is(':visible')) {

			$j('.pnfpb-push-subscribe-button-layout-shortcode').addClass("pnfpb-push-subscribe-button-layout-opened-shortcode");	

		}
		else {

			$j('.pnfpb-push-subscribe-button-layout-shortcode').removeClass("pnfpb-push-subscribe-button-layout-opened-shortcode");

		}

		$j('.pnfpb-push-subscribe-button-shortcode').text(__('Please wait...verifying status','push-notification-for-post-and-buddypress'));

		registration.pushManager.getSubscription().then(async function (subscription) {

			if (subscription) {

				$j('.pnfpb-push-subscribe-options-button-shortcode').text(pnfpb_push_subscribe_options_button);

				$j('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', true);

				if ($j('.pnfpb-push-subscribe-options-button-container-shortcode').length) {

					$j('.pnfpb-push-subscribe-options-button-container-shortcode').show();
				}

				$j('.pnfpb-push-subscribe-button-shortcode').text(pnfpb_popup_unsubscribe_button);

				$j('.pnfpb-push-subscribe-button-shortcode').show();

				$j('.pnfpb-push-subscribe-button-shortcode').removeClass("pnfpb-popup-subscribe-class-shortcode");

				$j('.pnfpb-push-subscribe-button-shortcode').addClass("pnfpb-popup-unsubscribe-class-shortcode");

				pnfpb_subscription_options = '';

				$j('.pnfpb_bell_icon_custom_prompt_loader_shortcode').show();

				$j('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', true);				
				
				await checkdeviceid(registration,subscription);

				$j('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').off().on('click',function(event) {

		
					if ($j('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').is(":checked"))
					{

						pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '1';

						if (pnfpb_show_push_notify_types.length > 0) {

							for (var pnfpb_notify_type_element = 1; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {

								pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_notify_type_element] = '0';

							}

						}
					
						$j('.pnfpb_bell_icon_prompt_subscription_post_enable_shortcode').prop('checked',false);

						$j('.pnfpb_bell_icon_prompt_subscription_activity_enable_shortcode').prop('checked',false);

						$j('.pnfpb_bell_icon_prompt_subscription_all_comments_enable_shortcode').prop('checked',false);

						$j('.pnfpb_bell_icon_prompt_subscription_my_comments_enable_shortcode').prop('checked',false);

						$j('.pnfpb_bell_icon_prompt_subscription_private_message_enable_shortcode').prop('checked',false);

						$j('.pnfpb_bell_icon_prompt_subscription_new_member_enable_shortcode').prop('checked',false);

						$j('.pnfpb_bell_icon_prompt_subscription_friendship_request_enable_shortcode').prop('checked',false);

						$j('.pnfpb_bell_icon_prompt_subscription_friendship_accepted_enable_shortcode').prop('checked',false);

						$j('.pnfpb_bell_icon_prompt_subscription_avatar_change_enable_shortcode').prop('checked',false);
						
						$j('.pnfpb_bell_icon_prompt_subscription_cover_image_change_enable_shortcode').prop('checked',false);

						$j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable_shortcode').prop('checked',false);

						$j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable_shortcode').prop('checked',false);

						if (pnfpb_custom_post_types.length > 0) {

							for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {

								$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable_shortcode').prop('checked',false);

								var pnfpb_index = $j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable_shortcode').attr("pnfpb_index");

								pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
								
							}
						}


					}
					else 
					{


						pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
					}								
				});
				
				$j('.pnfpb_bell_icon_prompt_subscription_favourite_enable_shortcode').off().on('click',function(event) {
		
				
					if ($j('.pnfpb_bell_icon_prompt_subscription_favourite_enable_shortcode').is(":checked"))
					{

					
						$j('.pnfpb_bell_icon_shortcode_subscription_all_enable').prop('checked',false);

						pnfpb_bell_icon_shortcode_subscribe_favourite_checkbox = '1';

														
					}
					else 
					{
						pnfpb_bell_icon_shortcode_subscribe_favourite_checkbox = '0';
					}								
				});
				
				$j('.pnfpb_bell_icon_prompt_subscription_followers_enable_shortcode').off().on('click',function(event) {
		
				
					if ($j('.pnfpb_bell_icon_prompt_subscription_followers_enable_shortcode').is(":checked"))
					{

					
						$j('.pnfpb_bell_icon_shortcode_subscription_all_enable').prop('checked',false);

						pnfpb_bell_icon_shortcode_subscribe_followers_checkbox = '1';

														
					}
					else 
					{
						pnfpb_bell_icon_shortcode_subscribe_followers_checkbox = '0';
					}								
				});				
				
				$j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable_shortcode').off().on('click',function(event) {

		
					if ($j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable_shortcode').is(":checked"))
					{

					
						$j('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').prop('checked',false);
						pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '1';

														
					}
					else 
					{
						pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '0';
					}								
				});
				
				$j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable_shortcode').off().on('click',function(event) {

		
					if ($j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable_shortcode').is(":checked"))
					{

					
						$j('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').prop('checked',false);
						pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '1';

															
					}
					else 
					{

						pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '0';
					}								
				});				
				
				if (pnfpb_show_push_notify_types.length > 0) {

					for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 12; pnfpb_notify_type_element++) {

						if (pnfpb_show_push_notify_types[pnfpb_notify_type_element] !== 'all') {

							$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_notify_type_element]+'_enable_shortcode').off().on('click',function(event) {

								var pnfpb_selector = '.'+$(this).attr("class");

								var pnfpb_index = $(this).attr("pnfpb_index");

								if ($j(pnfpb_selector).is(":checked"))
								{

									pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_index] = '1';

								
									if (pnfpb_notify_type_element > 0) {
		
										pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
							
										$j('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').prop('checked',false);

									}
															
								}
								else 
								{

									pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_index] = '0';

								}
							

							});
						}								

					}

				}

				if (pnfpb_custom_post_types.length > 0) {

					for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {

						$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable_shortcode').off().on('click',function(event) {

							var pnfpb_selector = '.'+$(this).attr("class");

							var pnfpb_index = $(this).attr("pnfpb_index");

							if ($j(pnfpb_selector).is(":checked"))
							{

								pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';

								pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
							
								$j('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').prop('checked',false);
		
				
							}
							else 
							{
								
								pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '0';


							}


						});								

					}

				}
				
				$j('.pnfpb-push-subscribe-options-button-shortcode').off().on( "click", async (event) => {

					event.stopPropagation(); 
					
					event.preventDefault();	
					
					$j('.pnfpb_bell_icon_custom_prompt_loader_shortcode').show();

					$j('.pnfpb-push-subscribe-button-shortcode').prop('disabled', true);
					
					$j('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', true);

					var pnfpb_bell_icon_prompt_subscription_options = '';

					if (pnfpb_show_push_notify_types.length > 0) {

						for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {

							pnfpb_bell_icon_prompt_subscription_options = pnfpb_bell_icon_prompt_subscription_options+pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_notify_type_element];
							
						}

					}
					
					if (pnfpb_custom_post_types.length > 0) {

						for (var pnfpb_post_type_element = 0; pnfpb_post_type_element <= 10; pnfpb_post_type_element++) {

							if (pnfpb_post_type_element < pnfpb_custom_post_types.length && pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element]) {

								pnfpb_bell_icon_prompt_subscription_options = pnfpb_bell_icon_prompt_subscription_options+pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element];

							} else {

								pnfpb_bell_icon_prompt_subscription_options = pnfpb_bell_icon_prompt_subscription_options+'0';
							}
							
						}

					} else {
						pnfpb_bell_icon_prompt_subscription_options = pnfpb_bell_icon_prompt_subscription_options+'0000000000';
					}

					pnfpb_bell_icon_prompt_subscription_options = pnfpb_bell_icon_prompt_subscription_options+pnfpb_bell_icon_shortcode_subscribe_favourite_checkbox+pnfpb_bell_icon_shortcode_subscribe_followers_checkbox;

					getToken(messaging,{serviceWorkerRegistration:registration,vapidKey:vapidKey }).then(async function (refreshedToken) {		
		
						if (refreshedToken) {
	   
							deviceid = refreshedToken;
	
							var data = {
								action: 'icpushcallback',
								device_id:deviceid,
								subscriptionoptions:pnfpb_bell_icon_prompt_subscription_options,
								nonce: pnfpb_ajax_object_push.nonce,
								pushtype: 'subscribe-button'
							};
		
							$j.post(pnfpb_ajax_object_push.ajax_url, data, function(responseajax) {
							
								var response = JSON.parse(responseajax);
							
								pnfpb_subscription_options = response.subscriptionoptions;

								$j('.pnfpb_bell_icon_custom_prompt_loader_shortcode').hide();

								$j('.pnfpb-push-subscribe-options-button-shortcode').show();

								$j('.pnfpb-push-subscribe-options-button-container-shortcode').show();

								$j('.pnfpb-push-subscribe-button-shortcode').prop('disabled', false);
					
								$j('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', false);								

								$j('.pnfpb-push-status-text-shortcode').text(__('Subscription options updated','push-notification-for-post-and-buddypress'));

								$j('.pnfpb-push-status-text-shortcode').addClass("pnfpb-push-status-text-opened-shortcode");

	
							});
						}
					});

				});					
				

			} else  {

				if ($j('.pnfpb-push-subscribe-options-button-container-shortcode').length) {

					$j('.pnfpb-push-subscribe-options-button-container-shortcode').show();

					$j('.pnfpb-push-subscribe-options-button-shortcode').show();

				}

				$j('.pnfpb-push-subscribe-button-shortcode').text(pnfpb_popup_subscribe_button);

				$j('.pnfpb-push-subscribe-button-shortcode').show();

				$j('.pnfpb-push-subscribe-button-shortcode').removeClass("pnfpb-popup-unsubscribe-class-shortcode");

				$j('.pnfpb-push-subscribe-button-shortcode').addClass("pnfpb-popup-subscribe-class-shortcode");					

			}

			//$j('.pnfpb-popup-unsubscribe-class-shortcode').off().on( "click", async (event) => {


			//});
			
	
			$j('.pnfpb-push-subscribe-button-shortcode').off().on( "click", async (event) => {

				event.stopPropagation(); 

				event.preventDefault();

				if ($j('.pnfpb-push-subscribe-button-shortcode').hasClass("pnfpb-popup-subscribe-class-shortcode")) {

					var subscribetext = $j('.pnfpb-push-subscribe-button-shortcode').text();

					pnfpb_bell_prompt_processing = '1';

					registration.pushManager.getSubscription().then(async function (subscription) {

						if (!subscription) {

							$j('.pnfpb-push-subscribe-button-shortcode').prop('disabled', false);
							
							$j('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', false);						

							$j('.pnfpb-push-status-text-shortcode').text(pnfpb_popup_wait_message);

							$j('.pnfpb_bell_icon_custom_prompt_loader_shortcode').show();

							$j('.pnfpb-push-status-text-shortcode').addClass("pnfpb-push-status-text-opened-shortcode");

							var pnfpb_ic_fcm_custom_prompt_subscribe_text_1 = __("We would like to show you notifications for the latest news and updates",'push-notification-for-post-and-buddypress');

							var pnfpb_ic_fcm_custom_prompt_subscribe_text_2 = "";

							if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribe_text && pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribe_text != '') {
						
								pnfpb_ic_fcm_custom_prompt_subscribe_text_1 = pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribe_text;
								
								pnfpb_ic_fcm_custom_prompt_subscribe_text_2 = pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribe_text_line_2;
								
							}						

								var pnfpb_bell_icon_subscription_options = '';

								$j('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').off().on('click',function(event) {

				
									if ($j('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').is(":checked"))
									{
			
			
										pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '1';
			
										if (pnfpb_show_push_notify_types.length > 0) {
			
											for (var pnfpb_notify_type_element = 1; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {
			
												pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_notify_type_element] = '0';
			
											}
			
										}
									
										$j('.pnfpb_bell_icon_prompt_subscription_post_enable_shortcode').prop('checked',false);
				
										$j('.pnfpb_bell_icon_prompt_subscription_activity_enable_shortcode').prop('checked',false);
				
										$j('.pnfpb_bell_icon_prompt_subscription_all_comments_enable_shortcode').prop('checked',false);
				
										$j('.pnfpb_bell_icon_prompt_subscription_my_comments_enable_shortcode').prop('checked',false);
				
										$j('.pnfpb_bell_icon_prompt_subscription_private_message_enable_shortcode').prop('checked',false);
				
										$j('.pnfpb_bell_icon_prompt_subscription_new_member_enable_shortcode').prop('checked',false);
				
										$j('.pnfpb_bell_icon_prompt_subscription_friendship_request_enable_shortcode').prop('checked',false);
				
										$j('.pnfpb_bell_icon_prompt_subscription_friendship_accepted_enable_shortcode').prop('checked',false);
				
										$j('.pnfpb_bell_icon_prompt_subscription_avatar_change_enable_shortcode').prop('checked',false);
										
										$j('.pnfpb_bell_icon_prompt_subscription_cover_image_change_enable_shortcode').prop('checked',false);
				
										$j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable_shortcode').prop('checked',false);
				
										$j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable_shortcode').prop('checked',false);
			
										if (pnfpb_custom_post_types.length > 0) {
			
											for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
			
												$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable_shortcode').prop('checked',false);
			
												var pnfpb_index = $j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable_shortcode').attr("pnfpb_index");
			
												pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
												
											}
										}
				
				
									}
									else 
									{

										pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
									}								
								});

								$j('.pnfpb_bell_icon_prompt_subscription_favourite_enable_shortcode').off().on('click',function(event) {
		
				
									if ($j('.pnfpb_bell_icon_prompt_subscription_favourite_enable_shortcode').is(":checked"))
									{
				
									
										$j('.pnfpb_bell_icon_shortcode_subscription_all_enable').prop('checked',false);
				
										pnfpb_bell_icon_shortcode_subscribe_favourite_checkbox = '1';
				
																		
									}
									else 
									{
										pnfpb_bell_icon_shortcode_subscribe_favourite_checkbox = '0';
									}								
								});
								
								$j('.pnfpb_bell_icon_prompt_subscription_followers_enable_shortcode').off().on('click',function(event) {
		
				
									if ($j('.pnfpb_bell_icon_prompt_subscription_followers_enable_shortcode').is(":checked"))
									{
				
									
										$j('.pnfpb_bell_icon_shortcode_subscription_all_enable').prop('checked',false);
				
										pnfpb_bell_icon_shortcode_subscribe_followers_checkbox = '1';
				
																		
									}
									else 
									{
										pnfpb_bell_icon_shortcode_subscribe_followers_checkbox = '0';
									}								
								});									
								
								
								$j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable_shortcode').off().on('click',function(event) {
				
						
									if ($j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable_shortcode').is(":checked"))
									{
			
										$j('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').prop('checked',false);
										pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '1';
																		
									}
									else 
									{
										pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '0';
									}								
								});
								
								$j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable_shortcode').off().on('click',function(event) {
				
						
									if ($j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable_shortcode').is(":checked"))
									{
									
										$j('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').prop('checked',false);
										pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '1';
																			
									}
									else 
									{
										pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '0';
									}								
								});				
								
								
								
								if (pnfpb_show_push_notify_types.length > 0) {
			
									for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 12; pnfpb_notify_type_element++) {
			
										if (pnfpb_show_push_notify_types[pnfpb_notify_type_element] !== 'all') {
			
											$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_notify_type_element]+'_enable_shortcode').off().on('click',function(event) {
			
												var pnfpb_selector = '.'+$(this).attr("class");
			
												var pnfpb_index = $(this).attr("pnfpb_index");
			
												if ($j(pnfpb_selector).is(":checked"))
												{
			
													pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_index] = '1';
			
												
													if (pnfpb_notify_type_element > 0) {
						
														pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
											
														$j('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').prop('checked',false);
			
													}
																			
												}
												else 
												{
			
													pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_index] = '0';
			
												}
											
			
											});
										}								
			
									}
			
								}
			
								if (pnfpb_custom_post_types.length > 0) {
			
									for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
			
										$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable_shortcode').off().on('click',function(event) {
				
											var pnfpb_selector = '.'+$(this).attr("class");
			
											var pnfpb_index = $(this).attr("pnfpb_index");
			
											if ($j(pnfpb_selector).is(":checked"))
											{
			
												pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '1';
			
												pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
											
												$j('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').prop('checked',false);
						
								
											}
											else 
											{
												
												pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_index-14] = '0';
			
			
											}
			
			
										});								
			
									}
			
								}					
			

								if (pnfpb_show_push_notify_types.length > 0) {

									for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < pnfpb_show_push_notify_types.length; pnfpb_notify_type_element++) {

										pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_notify_type_element];
										
									}

								}
								
								if (pnfpb_custom_post_types.length > 0) {

									for (var pnfpb_post_type_element = 0; pnfpb_post_type_element <=10; pnfpb_post_type_element++) {

										if (pnfpb_post_type_element < pnfpb_custom_post_types.length && pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element]) {

											pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element];

										} else {

											pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+'0';
										}
										
									}

								} else {
									pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+'0000000000';
								}
								
								pnfpb_bell_icon_subscription_options = pnfpb_bell_icon_subscription_options+pnfpb_bell_icon_shortcode_subscribe_favourite_checkbox+pnfpb_bell_icon_shortcode_subscribe_followers_checkbox;
								
								pnfpb_bell_prompt_processing = '1';

								await requestPermission(registration,'',pnfpb_bell_icon_subscription_options);

							} else {

								console.log('Push notification already subscribed');

								$j('.pnfpb-push-subscribe-button-shortcode').addClass("pnfpb-popup-unsubscribe-class-shortcode");
			
								$j('.pnfpb-push-status-text-shortcode').removeClass("pnfpb-push-status-text-opened-shortcode");	

								$j('.pnfpb-push-status-text-shortcode').text(pnfpb_popup_subscribe_text);

								$j('.pnfpb-push-status-text-shortcode').addClass("pnfpb-push-status-text-opened-shortcode");

							}
						});

					} else {

						if ($j('.pnfpb-push-subscribe-button-shortcode').hasClass("pnfpb-popup-unsubscribe-class-shortcode")) {

							var subscribetext = $j('.pnfpb-push-subscribe-button-shortcode').text();

							$j('.pnfpb-push-subscribe-button-shortcode').prop('disabled', true);
								
							$j('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', true);
							
							$j('.pnfpb_bell_icon_custom_prompt_loader_shortcode').show();
			
							pnfpb_bell_prompt_processing = '1';
			
							registration.pushManager.getSubscription().then(async (subscription) => {
			
								if (subscription) {
			
									$j('.pnfpb-push-status-text-shortcode').text(pnfpb_popup_wait_message);
			
									$j('.pnfpb-push-status-text-shortcode').addClass("pnfpb-push-status-text-opened-shortcode");	
			
									getToken(messaging,{serviceWorkerRegistration:registration,vapidKey:vapidKey }).then(async (refreshedToken) => {
			
										subscription.unsubscribe().then((successful) => {
			
											  deleteToken(messaging).then(function (deleteTokenstatus) {
			
												if (deleteTokenstatus) {
			
													var data = {
														action: 'icpushcallback',
														device_id:refreshedToken,
														nonce: pnfpb_ajax_object_push.nonce,
														pushtype: 'deletepushtoken'
													};
														
													$j.post(pnfpb_ajax_object_push.ajax_url, data, function(response) {
									
														var responseobject = JSON.parse(response);
			
														pnfpb_bell_prompt_processing = '';
													
														if (responseobject.subscriptionstatus === 'deleted') {
													
															console.log(__('Push subscription token deleted successfully','push-notification-for-post-and-buddypress'));
													
														}
														else {
															console.log(__('Push subscription token deletion failed in database','push-notification-for-post-and-buddypress'));
														}
			
														if ($j(".subscribegroupbutton").length || $j(".unsubscribegroupbutton").length) {
			
															$j(".subscribegroupbutton").addClass( "subscribe-init-display-off" );
															$j(".unsubscribegroupbutton").addClass( "subscribe-init-display-off" );
															$j(".subscribe-notification-group").addClass( "subscribe-init-display-off" );
															$j(".unsubscribe-notification-group").addClass( "subscribe-init-display-off" );
			
															// Get an array of all cookie names (the regex matches what we don't want)
															var cookieNames = document.cookie.split(/=[^;]*(?:;\s*|$)/);
			
															// Remove any that match the pattern
															for (var i = 0; i < cookieNames.length; i++) {
																if (/^pnfpb_group_push_notification_/.test(cookieNames[i])) {
																	document.cookie = cookieNames[i] + '=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=' + path;
																}
															}													
			
														}
			
														$j('.pnfpb-push-subscribe-button-shortcode').text(pnfpb_popup_subscribe_button);

														$j('.pnfpb_bell_icon_custom_prompt_loader_shortcode').hide();
			
														$j('.pnfpb-push-subscribe-button-shortcode').removeClass("pnfpb-popup-unsubscribe-class-shortcode");
			
														$j('.pnfpb-push-subscribe-button-shortcode').addClass("pnfpb-popup-subscribe-class-shortcode");
			
														$j('.pnfpb-push-status-text-shortcode').removeClass("pnfpb-push-status-text-opened-shortcode");	
			
														$j('.pnfpb-push-status-text-shortcode').text(pnfpb_popup_unsubscribe_text);
			
														$j('.pnfpb-push-status-text-shortcode').addClass("pnfpb-push-status-text-opened-shortcode");
			
														$j('.pnfpb-push-subscribe-button-shortcode').prop('disabled', false);
								
														$j('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', false);						
			
														pnfpb_bell_icon_subscribe_push_type_checkbox = ['1','0','0','0','0','0','0','0','0','0','0','0','0','0'];
												
														pnfpb_bell_icon_subscription_options_custom_prompt = '10000000000000';
												
														pnfpb_bell_icon_prompt_subscription_options_custom_prompt = '10000000000000';
														
														pnfpb_bell_icon_prompt_subscribe_push_type_checkbox = ['1','0','0','0','0','0','0','0','0','0','0','0','0','0'];
													
													});												
			
			
												}
			
											}).catch((e) => {
			
												pnfpb_bell_prompt_processing = '';
			
												console.log(__("Unsubscribe token failed",'push-notification-for-post-and-buddypress'));
			
											});
										}).catch((e) => {
			
											pnfpb_bell_prompt_processing = '';
			
											console.log(__("Unsubscribe token failed",'push-notification-for-post-and-buddypress'));
			
										});
									})
								} else {

									console.log('Push notification not subscribed');

									$j('.pnfpb-push-subscribe-button-shortcode').addClass("pnfpb-popup-subscribe-class-shortcode");
			
									$j('.pnfpb-push-status-text-shortcode').removeClass("pnfpb-push-status-text-opened-shortcode");	

									$j('.pnfpb-push-status-text-shortcode').text(pnfpb_popup_unsubscribe_text);

									$j('.pnfpb-push-status-text-shortcode').addClass("pnfpb-push-status-text-opened-shortcode");

								}
							}).catch((e) => {
			
								pnfpb_bell_prompt_processing = '';
			
								console.log(__("Unsubscribe subscription failed",'push-notification-for-post-and-buddypress'));
			
							});							

						}
					}
				})
			})
		})


}

async function frontend_subscription_menu(registration,refreshedToken) {

    if( $j(".pnfpb_push_notification_frontend_settings_submit").length )
    {

		var frontend_subscriptionoptions = '';

		registration.pushManager.getSubscription().then(async function (subscription) {
			if (subscription) {
				await checkdeviceid(registration,subscription);
			}
		});

			
		pnfpb_front_end_settings = ['0','0','0','0','0','0','0','0','0','0','0','0','0','0'];


		$j(".pnfpb_push_notification_frontend_settings_submit").on( "click", async function(event) {

			event.preventDefault();
	
			frontend_subscriptionoptions = '';

			$j('.pnfpb_bell_icon_custom_prompt_loader_frontend').show();

			$j('.pnfpb_frontend_subscriptions_options_menu_all').hide();						

			pnfpb_front_end_settings = ['0','0','0','0','0','0','0','0','0','0','0','0','0','0'];
	
			$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
			$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('error');
			$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('info');
			$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Processing...','push-notification-for-post-and-buddypress'));
			$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');										

			if ($j('#pnfpb_ic_fcm_front_group_invite_enable').is(":checked"))
			{

				pnfpb_front_end_settings[13] = '1';
			}
			else 
			{

				pnfpb_front_end_settings[13] = '0';
			}
	
			if ($j('#pnfpb_ic_fcm_front_group_details_update_enable').is(":checked"))
			{

				pnfpb_front_end_settings[12] = '1';
			}
			else 
			{

				pnfpb_front_end_settings[12] = '0';
			}

	
			if ($j('.pnfpb_ic_fcm_front_favourite_enable').is(":checked"))
			{

			
				$j('.pnfpb_ic_fcm_front_subscription_all_enable').prop('checked',false);

				pnfpb_bell_icon_front_subscribe_favourite_checkbox = '1';

												
			}
			else 
			{
				pnfpb_bell_icon_front_subscribe_favourite_checkbox = '0';
			}								
		
			if ($j('.pnfpb_ic_fcm_front_followers_enable').is(":checked"))
			{

			
				$j('.pnfpb_ic_fcm_front_subscription_all_enable').prop('checked',false);

				pnfpb_bell_icon_front_subscribe_followers_checkbox = '1';

												
			}
			else 
			{
				pnfpb_bell_icon_front_subscribe_followers_checkbox = '0';
			}			
			
			if (pnfpb_front_end_settings_push_notify_types.length > 0) {

				for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 12; pnfpb_notify_type_element++) {

					if (pnfpb_front_end_settings_push_notify_types[pnfpb_notify_type_element] !== 'unsubscribe-all' && pnfpb_front_end_settings_push_notify_types[pnfpb_notify_type_element] !== 'all') {

						if ($j('.pnfpb_ic_fcm_front_'+pnfpb_front_end_settings_push_notify_types[pnfpb_notify_type_element]+'_enable').is(":checked"))
						{

							pnfpb_front_end_settings[pnfpb_notify_type_element] = '1';

							if (pnfpb_notify_type_element > 0) {
	
								pnfpb_front_end_settings[0] = '0';

								pnfpb_front_end_settings[8] = '0';

							}
							else 
							{
								if ((pnfpb_front_end_settings_push_notify_types[pnfpb_notify_type_element] === 'bcomment' || pnfpb_front_end_settings_push_notify_types[pnfpb_notify_type_element] === 'mybcomment') && (subscriptionoptionsarray[2] === '1' || subscriptionoptionsarray[3] === '1')) {

									pnfpb_front_end_settings[pnfpb_notify_type_element] = '1';

								} else {

									pnfpb_front_end_settings[pnfpb_notify_type_element] = '0';

								}											

								

							}

						}
					}
				}

			}

			var pnfpb_custom_post_types_subscriptions = [];
			
			if (pnfpb_custom_post_types.length > 0) {

				for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {

					if ($j('.pnfpb_ic_fcm_front_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').is(":checked"))
					{

						pnfpb_custom_post_types_subscriptions[pnfpb_post_type_element] = '1';
	
						pnfpb_front_end_settings[0] = '0';

						pnfpb_front_end_settings[8] = '0';
															
					}
					else 
					{
						pnfpb_custom_post_types_subscriptions[pnfpb_post_type_element] = '0';
					}								

				}

			}



			if (pnfpb_front_end_settings_push_notify_types.length > 0) {

				for (var pnfpb_notify_type_element = 0; pnfpb_notify_type_element < 14; pnfpb_notify_type_element++) {

					frontend_subscriptionoptions = frontend_subscriptionoptions+pnfpb_front_end_settings[pnfpb_notify_type_element];
					
				}

			}
			
			if (pnfpb_custom_post_types_subscriptions.length > 0) {

				for (var pnfpb_post_type_element = 0; pnfpb_post_type_element <= 10; pnfpb_post_type_element++) {

					if (pnfpb_post_type_element < pnfpb_custom_post_types.length && pnfpb_custom_post_types_subscriptions[pnfpb_post_type_element]) {

						frontend_subscriptionoptions  = frontend_subscriptionoptions + pnfpb_custom_post_types_subscriptions[pnfpb_post_type_element];

					} else  {

						frontend_subscriptionoptions  = frontend_subscriptionoptions + '0';
					}
					
				}

			} else {
				frontend_subscriptionoptions = frontend_subscriptionoptions+'0000000000';
			}

			frontend_subscriptionoptions  = frontend_subscriptionoptions + pnfpb_bell_icon_front_subscribe_favourite_checkbox+ pnfpb_bell_icon_front_subscribe_followers_checkbox;

			if (hasFirebaseMessagingSupport && 'serviceWorker' in navigator && Notification.permission === 'granted') {
		
				navigator.serviceWorker.ready.then(function (registration) {

					registration.pushManager.getSubscription().then(async function (subscription) {
				
						if (subscription) {

							getToken(messaging,{serviceWorkerRegistration:registration,vapidKey:vapidKey }).then(async function (refreshedToken) {
					
								deviceid = refreshedToken;
					
								var data = {
									action: 'icpushcallback',
									device_id:deviceid,
									subscriptionoptions:frontend_subscriptionoptions,
									nonce: pnfpb_ajax_object_push.nonce,
									pushtype: 'subscribe-button'
								};
						
								$j.post(pnfpb_ajax_object_push.ajax_url, data, function(responseajax) {

									var response = JSON.parse(responseajax);
											
									frontend_subscriptionoptions = response.subscriptionoptions;

									var subscriptionoptionsarray = [];
											
									if (frontend_subscriptionoptions && frontend_subscriptionoptions !== '') {
										subscriptionoptionsarray = frontend_subscriptionoptions.split('');
									} else {
										frontend_subscriptionoptions = '1000000000000';
										subscriptionoptionsarray = frontend_subscriptionoptions.split('');
									}								

									if (subscriptionoptionsarray.length >= 10)
									{
										$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('error');
										$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('info');
										$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('success');
										$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');
										$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Your notification settings have been saved','push-notification-for-post-and-buddypress'));
				
						
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

											if ((subscriptionoptionsarray[24] && subscriptionoptionsarray[24] === '1') || subscriptionoptionsarray[0] === '1')
											{
												$j('#pnfpb_ic_fcm_front_favourite_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_fcm_front_favourite_enable').prop('checked', false);
											}
											
											if ((subscriptionoptionsarray[25] && subscriptionoptionsarray[25] === '1') || subscriptionoptionsarray[0] === '1')
											{
												$j('#pnfpb_ic_fcm_front_followers_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_fcm_front_followers_enable').prop('checked', false);
											}											

											if (subscriptionoptionsarray.length > 0) {


												for (var pnfpb_frontend_settings_element = 0; pnfpb_frontend_settings_element < 12; pnfpb_frontend_settings_element++) {

													if (pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element] !== 'unsubscribe-all' && pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element] !== 'all')  {


														if (subscriptionoptionsarray[pnfpb_frontend_settings_element] === '1'  || subscriptionoptionsarray[0] === '1')
														{
														
															$j('.pnfpb_ic_fcm_front_'+pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element]+'_enable').prop('checked', true);

														}
														else 
														{
															if ((pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element] === 'bcomment' || pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element] === 'mybcomment') && (subscriptionoptionsarray[2] === '1' || subscriptionoptionsarray[3] === '1')) {

																$j('.pnfpb_ic_fcm_front_'+pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element]+'_enable').prop('checked', true);

															} else {

																$j('.pnfpb_ic_fcm_front_'+pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element]+'_enable').prop('checked', false);

															}
														}
												
													} 

												}

											}													
											
											if (subscriptionoptionsarray.length > 14) {

												var subscription_options_element = 14;

												for (var pnfpb_frontend_post_type_element = 0; pnfpb_frontend_post_type_element < pnfpb_custom_post_types.length; pnfpb_frontend_post_type_element++) {

													if (subscriptionoptionsarray[subscription_options_element] === '1'  || subscriptionoptionsarray[0] === '1')
													{
														$j('.pnfpb_ic_fcm_front_subscription_'+pnfpb_custom_post_types[pnfpb_frontend_post_type_element]+'_enable').prop('checked', true);

													}
													else 
													{
														$j('.pnfpb_ic_fcm_front_subscription_'+pnfpb_custom_post_types[pnfpb_frontend_post_type_element]+'_enable').prop('checked', false);

													}
													
													subscription_options_element++;

												}

											}											

											$j('.pnfpb_bell_icon_custom_prompt_loader_frontend').hide();

											$j('.pnfpb_frontend_subscriptions_options_menu_all').show();

									}
									else 
									{

										$j('.pnfpb_bell_icon_custom_prompt_loader_frontend').hide();

										$j('.pnfpb_frontend_subscriptions_options_menu_all').show();

										$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
										$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('error');
										$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Error in saving notification settings','push-notification-for-post-and-buddypress'));
										$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');
									}

								})

							}).catch((err) => {

								console.log(__('Unable to retrieve refreshed token ','push-notification-for-post-and-buddypress'), err);

								$j('.pnfpb_bell_icon_custom_prompt_loader_frontend').hide();

								$j('.pnfpb_frontend_subscriptions_options_menu_all').show();

								$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
								$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('error');
								$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Retrieving Firebase token error on saving notification settings','push-notification-for-post-and-buddypress'));
								$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');
							});
						}
						else 
						{
							if (!pnfpb_webview) {
								await requestPermission(registration,'',frontend_subscriptionoptions);
							}
									
						}

					})

				})
			}
			else 
			{
				if (!pnfpb_webview) {
					await requestPermission(registration,'',frontend_subscriptionoptions);
				}
			}
		})

	}

}

  
  // Send the Instance ID token your application server, so that it can:
  // - send messages back to this app
  // - subscribe/unsubscribe the token from topics
function sendTokenToServer(currentToken) {
    if (!isTokenSentToServer()) {
      console.log(__('Sending token to server...','push-notification-for-post-and-buddypress'));
      // TODO(developer): Send the current token to your server.
      setTokenSentToServer(true);
	  return '';
    } else {
      console.log(__('Token already sent to server so won\'t send it again ' +
          'unless it changes','push-notification-for-post-and-buddypress'));
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
		


async function requestPermission(registration,shortcode_field='',subscription_options='10000000000000') {

	pnfpb_bell_prompt_processing = '1';

	if (!("Notification" in window)) {
		// Check if the browser supports notifications
		console.log("This browser does not support desktop notification");
	  } else if (Notification.permission === "granted") {
		// Check whether notification permissions have already been granted;
		// if so, create a notification
		console.log("Notification permission already granted");
		granted_permission_process(registration,"granted", shortcode_field,subscription_options,'already_granted')
	  } else if (Notification.permission !== "denied") {
		// We need to ask the user for permission
		console.log("Request for notification permission ");
		Notification.requestPermission().then((permission) => {
		  // If the user accepts, let's create a notification
		  if (permission === "granted") {
			granted_permission_process(registration,permission, shortcode_field,subscription_options,'newly_granted');
			// …
		  }
		});
	  } else if (Notification.permission === "denied" && (pnfpb_ajax_object_push.pnfpb_push_prompt === '1' || ($j(".pnfpb-push-subscribe-icon-shortcode").length || pnfpb_shortcode_installed))) {

		var pnfpb_screenWidth, pnfpb_screenHeight, pnfpb_dialogWidth, pnfpb_dialogHeight, pnfpb_isDesktop;    
		pnfpb_screenWidth = window.screen.width;
		pnfpb_screenHeight = window.screen.height;    
	
		if (pnfpb_screenWidth < 500) {
			pnfpb_dialogWidth = pnfpb_screenWidth * .95;
			pnfpb_dialogHeight = pnfpb_screenHeight * .95;
		} else {
			pnfpb_dialogWidth = 500;
			pnfpb_dialogHeight = 500;
			pnfpb_isDesktop = true;
		}		
	
		$j("#pnfpb-push-notification-blocked" ).dialog({
			autoOpen: true,
			resizable: false,
			closeText : '',
			open: function(event, ui) {
			},			
			width: pnfpb_dialogWidth,
			maxWidth:600,
			closeOnEscape: false,
			draggable: false,
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

    // [END request_permission]
  }

 
  	async function granted_permission_process(registration,pnfpb_permission,shortcode_field,subscription_options,permission_granted_check) {


		var pnfpb_popup_subscribe_text = __("You are subscribed to push notification",'push-notification-for-post-and-buddypress');

		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_message && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_message != '') {
	
			pnfpb_popup_subscribe_text = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_message;
	
		}
	
		var pnfpb_popup_unsubscribe_text = __("Push notification not subscribed",'push-notification-for-post-and-buddypress');
	
		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_message && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_message != '') {
	
			pnfpb_popup_unsubscribe_text = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_message;
			
		}
	
		var pnfpb_popup_wait_message = __("Please wait...processing",'push-notification-for-post-and-buddypress');
	
		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_wait_message && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_wait_message != '') {
	
			pnfpb_popup_wait_message = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_wait_message;
			
		}
	
		var pnfpb_ic_fcm_custom_prompt_subscribe_text = __("We would like to show you notifications for the latest news and updates",'push-notification-for-post-and-buddypress');
	
		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribe_text && pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribe_text != '') {
	
			pnfpb_ic_fcm_custom_prompt_subscribe_text = pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribe_text;
			
		}
	
		var pnfpb_ic_fcm_custom_prompt_subscribed_text = __("You are subscribed to push notifications",'push-notification-for-post-and-buddypress');
	
		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribed_text && pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribed_text != '') {
	
			pnfpb_ic_fcm_custom_prompt_subscribed_text = pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_subscribed_text;
			
		}	
		
		var pnfpb_popup_subscribe_button = __("Subscribe",'push-notification-for-post-and-buddypress');
	
		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_button && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_button != '') {
	
			pnfpb_popup_subscribe_button = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_subscribe_button;
			
		}
	
		var pnfpb_popup_unsubscribe_button = __("Unsubscribe",'push-notification-for-post-and-buddypress');
	
		if (pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_button && pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_button != '') {
	
			pnfpb_popup_unsubscribe_button = pnfpb_ajax_object_push.pnfpb_ic_fcm_popup_unsubscribe_button;
			
		}			

		if (pnfpb_permission === 'granted') {


			if( $j(".pnfpb-push-subscribe-button").length && pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_on_off !== '1') {
	
				$j('.pnfpb_bell_icon_custom_prompt_loader').show();

				$j('.pnfpb-push-subscribe-button').prop('disabled', true);;
			
				$j('.pnfpb-push-subscribe-options-button').prop('disabled', true);						
	
				$j('.pnfpb-push-status-text').text(pnfpb_popup_wait_message);
	
				$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");
				
			}
	
			if ( $j(".pnfpb-popup-customprompt-container").length && pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_on_off === '1' && pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1' ) {
	
				$j('.pnfpb-popup-customprompt-transistion-cancel-button').hide();
	
				$j('.pnfpb-popup-customprompt-transistion-allow-button').hide();

				if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_confirmation_message_on_off !== '1' && permission_granted_check === 'newly_granted') {

					$j('.pnfpb-popup-customprompt-container').show();

					$j('.pnfpb_custom_prompt_loader').show();

				}
	
			}
	
			if ( $j(".pnfpb-popup-customprompt-vertical-container").length && pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_on_off === '1' && pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2' ) {
	
				$j('.pnfpb-popup-customprompt-vertical-transistion-cancel-button').hide();
	
				$j('.pnfpb-popup-customprompt-vertical-transistion-allow-button').hide();

				if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_confirmation_message_on_off !== '1' && permission_granted_check === 'newly_granted') {

					$j('.pnfpb-popup-customprompt-vertical-container').show();

					$j('.pnfpb_custom_prompt_loader').show();

				}
	
			}
			  
			navigator.serviceWorker.ready.then((serviceWorkerRegistration) => {
	
				serviceWorkerRegistration.pushManager.subscribe({
											
						userVisibleOnly: true,
											
						applicationServerKey: urlBase64ToUint8Array(vapidKey)
											
				}).then(function (subscription) {
	
					if (subscription) {

						getToken(messaging,{serviceWorkerRegistration:serviceWorkerRegistration,vapidKey:vapidKey }).then((currentToken) => {
			   
							if (currentToken) {

								pnfpb_bell_prompt_processing = '';

								if ( $j(".pnfpb-popup-customprompt-container").length && pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_on_off === '1' && pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1' ) {
	
									$j('.pnfpb_custom_prompt_loader').hide();
									
									$j('.pnfpb-popup-customprompt-transistion').hide();
	
									$j('.pnfpb-popup-customprompt-transistion-cancel-button').show();	
	
									$j('.pnfpb-popup-customprompt-transistion-allow-button').show();										
	
									$j('.pnfpb-popup-customprompt-transistion-confirmation > .pnfpb-popup-customprompt-transistion-body > .pnfpb-popup-customprompt-transistion-body-message').text(pnfpb_ic_fcm_custom_prompt_subscribed_text);
	
									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_confirmation_message_on_off === '1' && permission_granted_check === 'already_granted') {
									
										$j('.pnfpb-popup-customprompt-container').hide();

									} else {

										$j('.pnfpb-popup-customprompt-transistion-confirmation').show();

										$j('.pnfpb-popup-customprompt-container').show();

									}
	
									$j('.pnfpb-popup-customprompt-transistion-close-button').off().on( "click", async (event) => {
	
										if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideDown') {
	
											if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
										
												$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("animation-name", "slideDownOut");
							
												$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
			
											}
			
											if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
							
												$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("animation-name", "slideDownOut");
							
												$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
												
											}
							
										}
							
										if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideUp') {
			
											if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
							
												$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("animation-name", "slideUpOut");
							
												$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");
			
											}
			
											if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
							
												$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("animation-name", "slideUpOut");
							
												$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");
												
											}
							
										}											
	
										$j('.pnfpb-popup-customprompt-container').hide();
				
									});

									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_confirmation_message_on_off === '1') {

										$j('.pnfpb-popup-customprompt-container').hide();
									}
									else {

										$j('.pnfpb-popup-customprompt-container').hide().show('slow').delay(4000).hide('slow');

										$j('.pnfpb-popup-customprompt-container').show();

									}	
									
								}
	
								if ( $j(".pnfpb-popup-customprompt-vertical-container").length && pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_on_off === '1' && pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2' ) {
	
									$j('.pnfpb_custom_prompt_loader').hide();
									
									$j('.pnfpb-popup-customprompt-vertical-transistion').hide();
	
									$j('.pnfpb-popup-customprompt-vertical-transistion-cancel-button').show();	
	
									$j('.pnfpb-popup-customprompt-vertical-transistion-allow-button').show();										
	
									$j('.pnfpb-popup-customprompt-vertical-transistion-confirmation > .pnfpb-popup-customprompt-transistion-body > .pnfpb-popup-customprompt-vertical-transistion-body-message').text(pnfpb_ic_fcm_custom_prompt_subscribed_text);

									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_confirmation_message_on_off === '1') {
	
										$j('.pnfpb-popup-customprompt-vertical-container').hide();

									} else {
										
										$j('.pnfpb-popup-customprompt-vertical-transistion-confirmation').show();

										$j('.pnfpb-popup-customprompt-vertical-container').show();

									}
	
									$j('.pnfpb-popup-customprompt-vertical-transistion-close-button').off().on( "click", async (event) => {
	
										if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideDown') {
	
											if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
										
												$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("animation-name", "slideDownOut");
							
												$j('pnfpb-popup-customprompt-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
			
											}
			
											if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
							
												$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("animation-name", "slideDownOut");
							
												$j('pnfpb-popup-customprompt-vertical-container-dialog-slideDown').css("-webkit-animation-name", "slideDownOut");
												
											}
							
										}
							
										if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_animation === 'slideUp') {
			
											if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '1') {
							
												$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("animation-name", "slideUpOut");
							
												$j('pnfpb-popup-customprompt-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");
			
											}
			
											if (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style === '2') {
							
												$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("animation-name", "slideUpOut");
							
												$j('pnfpb-popup-customprompt-vertical-container-dialog-slideUp').css("-webkit-animation-name", "slideUpOut");
												
											}
							
										}											
	
										$j('.pnfpb-popup-customprompt-vertical-container').hide();
				
									});

									if (pnfpb_ajax_object_push.pnfpb_ic_fcm_custom_prompt_confirmation_message_on_off === '1') {

										$j('.pnfpb-popup-customprompt-vertical-container').hide();

									}
									else {

										$j('.pnfpb-popup-customprompt-vertical-container').hide().show('slow').delay(4000).hide('slow');

										$j('.pnfpb-popup-customprompt-vertical-container').show();

									}
	
									
								}						
	
	
								if( $j(".pnfpb-push-subscribe-button").length && (pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_style3 === '1' || pnfpb_ajax_object_push.pnfpb_ic_fcm_prompt_on_off !== '1')) {
	
									$j('.pnfpb_bell_icon_custom_prompt_loader').hide();

									$j('.pnfpb-push-subscribe-button').prop('disabled', false);
			
									$j('.pnfpb-push-subscribe-options-button').prop('disabled', false);													
	
									$j('.pnfpb_bell_icon_prompt_subscription_options_container').show();

									$j('.pnfpb-push-subscribe-button').text(pnfpb_popup_unsubscribe_button);
	
									$j('.pnfpb-push-subscribe-button').removeClass("pnfpb-popup-subscribe-class");
			   
									$j('.pnfpb-push-subscribe-button').addClass("pnfpb-popup-unsubscribe-class");
	
									$j('.pnfpb-push-status-text').removeClass("pnfpb-push-status-text-opened");	
						   
									$j('.pnfpb-push-status-text').text(pnfpb_popup_subscribe_text);
						   
									$j('.pnfpb-push-status-text').addClass("pnfpb-push-status-text-opened");								
									
									$j("#ic-notification-button").hide();
								}								

	
							  	deviceid = currentToken;

								var subscription_endpoint = '';
								var subscription_p256dh = '';
								var subscription_auth = '';
								if (subscription.endpoint) {
									subscription_endpoint = subscription.endpoint;
								}
								if (subscription.getKey("auth")) {
									const authBuffer = subscription.getKey('auth');
									const authUint8 = new Uint8Array(authBuffer);
									subscription_auth = btoa(String.fromCharCode.apply(null, authUint8));									
								}								
								if (subscription.getKey("p256dh")) {
									const p256dhBuffer = subscription.getKey('p256dh');
									const p256dhUint8 = new Uint8Array(p256dhBuffer);
									subscription_p256dh = btoa(String.fromCharCode.apply(null, p256dhUint8));									
								}										
			  
								var data = {
								action: 'icpushcallback',
								nonce: pnfpb_ajax_object_push.nonce,
								device_id:deviceid,
								subscriptionoptions:subscription_options,
								pnfpb_endpoint:subscription_endpoint,
								pnfpb_options:subscription_p256dh,
								pnfpb_subscription_token:subscription_auth,
								pushtype:'normal'
								};

								$j.post(pnfpb_ajax_object_push.ajax_url, data, async function(response) {

									pnfpb_bell_prompt_processing = '';
				
									var responseobject = JSON.parse(response);

									if( $j(".pnfpb_push_notification_frontend_settings_submit").length ) {

										$j('.pnfpb_bell_icon_custom_prompt_loader_frontend').hide();
	
										$j('.pnfpb_frontend_subscriptions_options_menu_all').show();
	
									}
									
									if ($j(".subscribegroupbutton").length || $j(".unsubscribegroupbutton").length) {

										$j(".subscribegroupbutton").removeClass( "subscribe-init-display-off" );
										$j(".unsubscribegroupbutton").removeClass( "subscribe-init-display-off" );
										$j(".subscribe-notification-group").removeClass( "subscribe-init-display-off" );
										$j(".unsubscribe-notification-group").removeClass( "subscribe-init-display-off" );
									}									
					
								   	if (responseobject.subscriptionstatus != 'fail')
								   	{
										if (responseobject.subscriptionstatus != 'duplicate') {
											
											var subscriptionoptions = responseobject.subscriptionoptions;
							
											var subscriptionoptionsarray = subscriptionoptions.split('');
											
											if (subscriptionoptionsarray.length >= 4)
											{

														if ((subscriptionoptionsarray[24] && subscriptionoptionsarray[24] === '1') || subscriptionoptionsarray[0] === '1')
														{
														  	$j('#pnfpb_ic_fcm_front_favourite_enable').prop('checked', true);
		
														}
														else 
														{
															$j('#pnfpb_ic_fcm_front_favourite_enable').prop('checked', false);
														}
														
														if ((subscriptionoptionsarray[25] && subscriptionoptionsarray[25] === '1') || subscriptionoptionsarray[0] === '1')
														{
														  	$j('#pnfpb_ic_fcm_front_followers_enable').prop('checked', true);
		
														}
														else 
														{
															$j('#pnfpb_ic_fcm_front_followers_enable').prop('checked', false);
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
			
														if (subscriptionoptionsarray.length > 0) {
			
															for (var pnfpb_frontend_settings_element = 0; pnfpb_frontend_settings_element < 12; pnfpb_frontend_settings_element++) {
				
																if (pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element] !== 'unsubscribe-all' && pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element] !== 'all')  {
			
																	if (subscriptionoptionsarray[pnfpb_frontend_settings_element] === '1'  || subscriptionoptionsarray[0] === '1')
																	{
																		
																		$j('.pnfpb_ic_fcm_front_'+pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element]+'_enable').prop('checked', true);

																	}
																	else 
																	{

																		if ((pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element] === 'bcomment' || pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element] === 'mybcomment') && (subscriptionoptionsarray[2] === '1' || subscriptionoptionsarray[3] === '1')) {

																			$j('.pnfpb_ic_fcm_front_'+pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element]+'_enable').prop('checked', true);
				
																		} else {
				
																			$j('.pnfpb_ic_fcm_front_'+pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element]+'_enable').prop('checked', false);
				
																		}

																	}
																
																} 
			
															}
			
														}													
															
														if (subscriptionoptionsarray.length > 14) {
			
															var subscription_options_element = 14;
			
															for (var pnfpb_frontend_post_type_element = 0; pnfpb_frontend_post_type_element < pnfpb_custom_post_types.length; pnfpb_frontend_post_type_element++) {
				
																if (subscriptionoptionsarray[subscription_options_element] === '1'  || subscriptionoptionsarray[0] === '1')
																{
																	$j('.pnfpb_ic_fcm_front_subscription_'+pnfpb_custom_post_types[pnfpb_frontend_post_type_element]+'_enable').prop('checked', true);
			
																	//pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
																}
																else 
																{
																	$j('.pnfpb_ic_fcm_front_subscription_'+pnfpb_custom_post_types[pnfpb_frontend_post_type_element]+'_enable').prop('checked', false);
			
																	//pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
																}
																	
																subscription_options_element++;
			
															}
			
													
			
														}				

											}

											if( $j(".pnfpb_bell_icon_subscription_options_container").length) 
											{

												if (subscriptionoptionsarray[24] && subscriptionoptionsarray[24] === '1')
													{
														  $j('#pnfpb_bell_icon_subscription_favourite_enable_shortcode').prop('checked', true);
	
													}
													else 
													{
														$j('#pnfpb_bell_icon_subscription_favourite_enable_shortcode').prop('checked', false);
													}
													
												if (subscriptionoptionsarray[25] && subscriptionoptionsarray[25] === '1')
													{
														  $j('#pnfpb_bell_icon_subscription_followers_enable_shortcode').prop('checked', true);
	
													}
													else 
													{
														$j('#pnfpb_bell_icon_subscription_followers_enable_shortcode').prop('checked', false);
													}													
	
												if (subscriptionoptionsarray[12] === '1')
													{
		
														$j('.pnfpb_bell_icon_subscription_group_details_update_enable').prop('checked', true);
		
		
														pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '1';
		
													}
													else 
													{
														$j('.pnfpb_bell_icon_subscription_group_details_update_enable').prop('checked', false);
		
		
														pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '0';
		
													}
													
													if (subscriptionoptionsarray[13] === '1')
													{
														$j('.pnfpb_bell_icon_subscription_group_invite_enable').prop('checked', true);
		
		
														pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '1';
		
													}
													else 
													{
														$j('.pnfpb_bell_icon_subscription_group_invite_enable').prop('checked', false);
		
		
														pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '0';
		
													}
													
													if (subscriptionoptionsarray.length > 0) {
		
														for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < 12; pnfpb_post_type_element++) {
		
															if (pnfpb_show_push_notify_types[pnfpb_post_type_element] !== 'unsubscribe-all' && pnfpb_show_push_notify_types[pnfpb_post_type_element] !== 'all') {		
																
	
																if (subscriptionoptionsarray[pnfpb_post_type_element] === '1' && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
																{
																	$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable').prop('checked', true);
		
																	pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_post_type_element] = '1';
		
														
																}
																else 
																{
																	
																	$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable').prop('checked', false);
		
																	pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_post_type_element] = '0';
		
															
																}
															
															} else {
		
																if (pnfpb_show_push_notify_types[pnfpb_post_type_element] === 'all' && subscriptionoptionsarray[0] === '1' )
																{
		
																	$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[0]+'_enable').prop('checked', true);
		
																	pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';
		
																} else {
		
																	if (subscriptionoptionsarray[8] === '1') {
																	
																		pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';
		
																	}
																}
		
															}
		
			
														}
		
													}													
													
													if (subscriptionoptionsarray.length > 14) {
		
														var subscription_options_element = 14;
		
														for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
		
		
															if (subscriptionoptionsarray[subscription_options_element] === '1'  && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
															{
																$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked', true);
		
																pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
															}
															else 
															{
																$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked', false);
		
																pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
															}
															
															subscription_options_element++;
		
														}
		
	
													}
												
											}
												
											if( $j(".pnfpb_bell_icon_prompt_subscription_options_container").length) {
	

													if (subscriptionoptionsarray.length > 0) {

														for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_show_push_notify_types.length; pnfpb_post_type_element++) {
		
															if (subscriptionoptionsarray[pnfpb_post_type_element] === '1')
															{
																$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable').prop('checked', true);

																pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_post_type_element] = '1';
															}
															else 
															{
																$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable').prop('checked', false);

																pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_post_type_element] = '0';
															}
															

														}

													}													
													
													if (subscriptionoptionsarray.length > 14) {

														var subscription_options_element = 14;

														for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
		
															if (subscriptionoptionsarray[subscription_options_element] === '1' && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
															{
																$j('.pnfpb_bell_icon_promt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked', true);

																pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
															}
															else 
															{
																$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked', false);

																pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
															}
															
															subscription_options_element++;

														}

													}

													if (subscriptionoptionsarray[24] && subscriptionoptionsarray[24] === '1')
														{
															  $j('#pnfpb_bell_icon_prompt_subscription_favourite_enable').prop('checked', true);
		
														}
														else 
														{
															$j('#pnfpb_bell_icon_prompt_subscription_favourite_enable').prop('checked', false);
														}

													if (subscriptionoptionsarray[25] && subscriptionoptionsarray[25] === '1')
														{
															  $j('#pnfpb_bell_icon_prompt_subscription_followers_enable').prop('checked', true);
		
														}
														else 
														{
															$j('#pnfpb_bell_icon_prompt_subscription_followers_enable').prop('checked', false);
														}																																

											}
											
											if( $j(".pnfpb-push-subscribe-icon-shortcode").length || pnfpb_shortcode_installed) {

												if (subscriptionoptionsarray[0] === '1')
													{
		
														$j('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').prop('checked', true);
		
		
														pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '1';
		
													}
													else 
													{
		
														$j('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').prop('checked', false);
		
			
														pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
		
													}

													if (subscriptionoptionsarray[24] && subscriptionoptionsarray[24] === '1')
														{
															  $j('#pnfpb_bell_icon_prompt_subscription_favourite_enable_shortcode').prop('checked', true);
		
														}
														else 
														{
															$j('#pnfpb_bell_icon_prompt_subscription_favourite_enable_shortcode').prop('checked', false);
														}
													if (subscriptionoptionsarray[25] && subscriptionoptionsarray[25] === '1')
														{
															  $j('#pnfpb_bell_icon_prompt_subscription_followers_enable_shortcode').prop('checked', true);
		
														}
														else 
														{
															$j('#pnfpb_bell_icon_prompt_subscription_followers_enable_shortcode').prop('checked', false);
														}																										
	
												if (subscriptionoptionsarray[12] === '1' && subscriptionoptionsarray[0] !== '1')
												{
	
													$j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable_shortcode').prop('checked', true);
	
	
													pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '1';
	
												}
												else 
												{
	
													$j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable_shortcode').prop('checked', false);
	
	
													pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '0';
	
												}
												
												if (subscriptionoptionsarray[13] === '1' && subscriptionoptionsarray[0] !== '1')
												{
	
													$j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable_shortcode').prop('checked', true);
	
	
													pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '1';
	
												}
												else 
												{
	
													$j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable_shortcode').prop('checked', false);
	
	
													pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '0';
	
												}
	
												if (subscriptionoptionsarray.length > 0) {
	
													for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < 12; pnfpb_post_type_element++) {
	
														if (pnfpb_show_push_notify_types[pnfpb_post_type_element] !== 'unsubscribe-all' && pnfpb_show_push_notify_types[pnfpb_post_type_element] !== 'all') {	
															
															if (subscriptionoptionsarray[pnfpb_post_type_element] === '1' && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
															{
																$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable_shortcode').prop('checked', true);
	
																pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_post_type_element] = '1';
													
															}
															else 
															{
																if (subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1') {
	
																	$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable_shortcode').prop('checked', false);
	
																	pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_post_type_element] = '0';
	
																}															
															}
														
														} else {
	
															if (pnfpb_show_push_notify_types[pnfpb_post_type_element] === 'all' && subscriptionoptionsarray[0] === '1' )
															{
	
																$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[0]+'_enable_shortcode').prop('checked', true);
	
																pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';
	
															} else {
	
																if (subscriptionoptionsarray[8] === '1' ) {
																
																	pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';
	
																}
															}
	
														}
	
	
													}
	
												}													
												
												if (subscriptionoptionsarray.length > 14) {
	
													var subscription_options_element = 14;
	
													for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {
	
	
														if (subscriptionoptionsarray[subscription_options_element] === '1' && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
														{
															$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable_shortcode').prop('checked', true);
	
	
															pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
														}
														else 
														{
															$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable_shortcode').prop('checked', false);
	
	
															pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
														}
														
														subscription_options_element++;
	
													}
	
	
												}
													
												$j('.pnfpb_bell_icon_custom_prompt_loader_shortcode').hide();
	
												$j('.pnfpb-push-subscribe-options-button-container-shortcode').show();
												
												$j('.pnfpb-push-subscribe-button-shortcode').prop('disabled', false);
									
												$j('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', false);
												
												$j('.pnfpb-push-subscribe-button-shortcode').text(pnfpb_popup_unsubscribe_button);
	
												$j('.pnfpb-push-subscribe-button-shortcode').removeClass("pnfpb-popup-subscribe-class-shortcode");
						   
												$j('.pnfpb-push-subscribe-button-shortcode').addClass("pnfpb-popup-unsubscribe-class-shortcode");
				
												$j('.pnfpb-push-status-text-shortcode').removeClass("pnfpb-push-status-text-opened-shortcode");	
									   
												$j('.pnfpb-push-status-text-shortcode').text(pnfpb_popup_subscribe_text);
									   
												$j('.pnfpb-push-status-text-shortcode').addClass("pnfpb-push-status-text-opened-shortcode");													
											}											
																   
									}
								else
								{
									pnfpb_bell_prompt_processing = '';
	
						   
									console.log(__("Already subscribed...device id already exists...not updated",'push-notification-for-post-and-buddypress'));
								}
	
						   }	
						   else
						   {

								pnfpb_bell_prompt_processing = '';

	
							   console.log(__("device update failed",'push-notification-for-post-and-buddypress'));
						   }

							const PNFPB_message = vapidKey;
							const PNFPB_encoder = new TextEncoder();
							const PNFPB_data = PNFPB_encoder.encode(PNFPB_message);
							const PNFPB_algorithm = "SHA-256";
							const PNFPB_readableHash = await getReadableHash(PNFPB_data, PNFPB_algorithm);

  							if (PNFPB_readableHash) {
								const PNFPB_SW_request = indexedDB.open("PNFPB_SW_Database", 3);
								const PNFPB_SW_auth_token = PNFPB_readableHash;
								const PNFPB_SW_Object = {key: 1, pnfpb_auth_token: PNFPB_SW_auth_token, subscription_token: subscription_auth};

								PNFPB_SW_request.onupgradeneeded = (event) => {
									const PNFPB_SW_db = event.target.result;
									if (!PNFPB_SW_db.objectStoreNames.contains("PNFPB_SW_rest_token_Store")) {
										PNFPB_SW_db.createObjectStore("PNFPB_SW_rest_token_Store", { keyPath: "key" }); // Define keyPath for unique identification
									}									
									if (!PNFPB_SW_db.objectStoreNames.contains("PNFPB_SW_Store")) {
										PNFPB_SW_db.createObjectStore("PNFPB_SW_Store", { keyPath: "key" }); // Define keyPath for unique identification
									}
								};

								PNFPB_SW_request.onsuccess = (event) => {
									const PNFPB_SW_db = event.target.result;
									const PNFPB_SW_transaction = PNFPB_SW_db.transaction(["PNFPB_SW_Store"], "readwrite");
									const PNFPB_SW_objectStore = PNFPB_SW_transaction.objectStore("PNFPB_SW_Store");
									const PNFPB_SW_objectStore_get = PNFPB_SW_transaction.objectStore("PNFPB_SW_Store").get(1);
									PNFPB_SW_objectStore_get.onsuccess = (event) => {
										let data = event.target.result;
										if (event.target.result !== undefined  ) {
											if (data.pnfpb_auth_token !== PNFPB_readableHash) {
												const PNFPB_SW_addRequest = PNFPB_SW_objectStore.put(PNFPB_SW_Object);
												PNFPB_SW_addRequest.onsuccess = () => {
													console.log("Object added successfully");
													PNFPB_SW_db.close();
												};
												PNFPB_SW_addRequest.onerror = (error) => {
													console.error("Error adding object:", error);
													PNFPB_SW_db.close();
												};
											}
										} else {
											const PNFPB_SW_addRequest = PNFPB_SW_objectStore.put(PNFPB_SW_Object);
											PNFPB_SW_addRequest.onsuccess = () => {
												console.log("Object added successfully");
												PNFPB_SW_db.close();
											};
											PNFPB_SW_addRequest.onerror = (error) => {
												console.error("Error adding object:", error);
												PNFPB_SW_db.close();
											};

										}
									};
									PNFPB_SW_objectStore_get.onerror = (event) => {
										console.error("Error adding object:", error);
										PNFPB_SW_db.close();
									};
								};

								PNFPB_SW_request.onerror = (event) => {
									console.error("Database error:", event.target.errorCode);
								};								
							}
				}).fail(function(response) {
					
					console.log('Error: ' + response.responseText);

					if( $j(".pnfpb_push_notification_frontend_settings_submit").length ) {

						$j('.pnfpb_bell_icon_custom_prompt_loader_frontend').hide();

						$j('.pnfpb_frontend_subscriptions_options_menu_all').show();

						$j('.pnfpb_ic_front_push_notification_settings_messages').removeClass('success');
						$j('.pnfpb_ic_front_push_notification_settings_messages').addClass('error');
						$j('.pnfpb_ic_front_push_notification_settings_text').html(__('Error in saving notification settings','push-notification-for-post-and-buddypress'));
						$j('.pnfpb_ic_front_push_notification_settings_messages').attr('style','display: flex !important');						

					}	
				});
	
	
			  } else {
					// Show permission request.
					console.log(__('No Instance ID token available. Request permission to generate one.','push-notification-for-post-and-buddypress'));
					// Show permission UI.
					setTokenSentToServer(false);

					pnfpb_bell_prompt_processing = '';

					$j('.pnfpb-popup-customprompt-container').hide();

					$j('.pnfpb-popup-customprompt-vertical-container').hide();

					if( $j(".pnfpb-push-subscribe-button").length )
					{									
						$j('.pnfpb-push-subscribe-button').prop('disabled', false);
		
						$j('.pnfpb-push-subscribe-options-button').prop('disabled', false);

					}
					
					if( $j(".pnfpb-push-subscribe-icon-shortcode").length || pnfpb_shortcode_installed) {

						$j('.pnfpb_bell_icon_custom_prompt_loader_shortcode').hide();
	
						$j('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', false);					
	
						$j('.pnfpb-push-subscribe-button-shortcode').prop('disabled', false);
					}					
			  }
		
		
			}).catch((err) => {
			  		console.log(__('An error occurred while retrieving token. ','push-notification-for-post-and-buddypress'), err);

				  	setTokenSentToServer(false);

					  pnfpb_bell_prompt_processing = '';

					  $j('.pnfpb-popup-customprompt-container').hide();

					  $j('.pnfpb-popup-customprompt-vertical-container').hide();

				 	if( $j(".pnfpb-push-subscribe-button").length )
					{									
						$j('.pnfpb-push-subscribe-button').prop('disabled', false);
		
						$j('.pnfpb-push-subscribe-options-button').prop('disabled', false);

					}
					
					if( $j(".pnfpb-push-subscribe-icon-shortcode").length || pnfpb_shortcode_installed) {

						$j('.pnfpb_bell_icon_custom_prompt_loader_shortcode').hide();
	
						$j('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', false);					
	
						$j('.pnfpb-push-subscribe-button-shortcode').prop('disabled', false);
					}					
			});
	
			// TODO(developer): Retrieve an Instance ID token for use with FCM.
			// [START_EXCLUDE]
			// In many cases once an app has been granted notification permission,
			// it should update its UI reflecting this.
			// [END_EXCLUDE]
			} else {

				$j('.pnfpb-popup-customprompt-container').hide();

				$j('.pnfpb-popup-customprompt-vertical-container').hide();

				console.log(__('An error occurred while subscribing push notification in browser ','push-notification-for-post-and-buddypress'));

				if( $j(".pnfpb-push-subscribe-button").length )
				{									
					$j('.pnfpb-push-subscribe-button').prop('disabled', false);
		
					$j('.pnfpb-push-subscribe-options-button').prop('disabled', false);

				}
				if( $j(".pnfpb-push-subscribe-icon-shortcode").length || pnfpb_shortcode_installed) {

					$j('.pnfpb_bell_icon_custom_prompt_loader_shortcode').hide();
	
					$j('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', false);					
	
					$j('.pnfpb-push-subscribe-button-shortcode').prop('disabled', false);
				}	
			}
	
			}).catch((err) => {

				console.log(__('An error occurred in getting subscription ','push-notification-for-post-and-buddypress'), err);

				setTokenSentToServer(false);

				pnfpb_bell_prompt_processing = '';

				$j('.pnfpb-popup-customprompt-container').hide();

				$j('.pnfpb-popup-customprompt-vertical-container').hide();

			   if( $j(".pnfpb-push-subscribe-button").length )
			  {									
				  $j('.pnfpb-push-subscribe-button').prop('disabled', false);
  
				  $j('.pnfpb-push-subscribe-options-button').prop('disabled', false);

			  }
			  if( $j(".pnfpb-push-subscribe-icon-shortcode").length || pnfpb_shortcode_installed) {

				$j('.pnfpb_bell_icon_custom_prompt_loader_shortcode').hide();

				$j('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', false);					

				$j('.pnfpb-push-subscribe-button-shortcode').prop('disabled', false);
			}			  			

			})

			}).catch((err) => {

				console.log(__('An error occurred in getting registration','push-notification-for-post-and-buddypress'), err);

				setTokenSentToServer(false);

				pnfpb_bell_prompt_processing = '';

				$j('.pnfpb-popup-customprompt-container').hide();

				$j('.pnfpb-popup-customprompt-vertical-container').hide();

			   if( $j(".pnfpb-push-subscribe-button").length )
			  {									
				  $j('.pnfpb-push-subscribe-button').prop('disabled', false);
  
				  $j('.pnfpb-push-subscribe-options-button').prop('disabled', false);

			  }
			  if( $j(".pnfpb-push-subscribe-icon-shortcode").length || pnfpb_shortcode_installed) {

				$j('.pnfpb_bell_icon_custom_prompt_loader_shortcode').hide();

				$j('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', false);					

				$j('.pnfpb-push-subscribe-button-shortcode').prop('disabled', false);
			}			  			

			})
		  } else {
				console.log(__('Unable to get permission to notify.','push-notification-for-post-and-buddypress'));

				$j('.pnfpb-push-dialog-container').hide();

				const pnfpb_d = new Date();

				let expires = "expires="

				if (pnfpb_d.getTime) {

					const pnfpb_custom_prompt_show_again_days = parseInt(pnfpb_ajax_object_push.pnfpb_custom_prompt_show_again_days);

			  		pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_custom_prompt_show_again_days*24*60*60*58000));

			  		expires = "expires="+ pnfpb_d.toUTCString();

				}

			  	document.cookie = "PNFPB_push_notification_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";
			  
			  	pnfpb_bell_prompt_processing = '';

				  $j('.pnfpb-popup-customprompt-container').hide();

				  $j('.pnfpb-popup-customprompt-vertical-container').hide();

				if( $j(".pnfpb-push-subscribe-button").length )
				{									
					$j('.pnfpb-push-subscribe-button').prop('disabled', false);
	
					$j('.pnfpb-push-subscribe-options-button').prop('disabled', false);

				}
				
				if( $j(".pnfpb-push-subscribe-icon-shortcode").length || pnfpb_shortcode_installed) {

					$j('.pnfpb_bell_icon_custom_prompt_loader_shortcode').hide();

					$j('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', false);					

					$j('.pnfpb-push-subscribe-button-shortcode').prop('disabled', false);
				}				
		  }		
	
	}

 async function checkdeviceid(registration,subscription) {

		if (!pnfpb_webview && hasFirebaseMessagingSupport && 'serviceWorker' in navigator ) {

			registration.pushManager.getSubscription().then((subscription) => {

					var subscriptionoptions = '100000000000';
					var subscriptionoptionsarray = subscriptionoptions.split('');
					
					
					if( $j(".pnfpb-push-subscribe-button").length  ) {

						$j('.pnfpb_bell_icon_custom_prompt_loader').show();

						$j('.pnfpb-push-subscribe-options-button').prop('disabled', true);

						$j('.pnfpb-push-subscribe-button').prop('disabled', true);

					}

					if( $j(".pnfpb-push-subscribe-icon-shortcode").length || pnfpb_shortcode_installed) {

						$j('.pnfpb_bell_icon_custom_prompt_loader_shortcode').show();

						$j('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', true);					
	
						$j('.pnfpb-push-subscribe-button-shortcode').prop('disabled', true);
					}
					
					deviceid = '';

					if (hasFirebaseMessagingSupport && Notification.permission === 'granted') {

						getToken(messaging,{serviceWorkerRegistration:registration,vapidKey:vapidKey }).then((currentToken) => {

							// Subscribe the devices corresponding to the registration tokens to the
							// topic.
							
							if (currentToken) {

								$j('.pnfpb_bell_icon_custom_prompt_loader_frontend').show();

								$j('.pnfpb_frontend_subscriptions_options_menu_all').hide();

							   
								deviceid = currentToken;

								var subscription_endpoint = '';
								var subscription_p256dh = '';
								var subscription_auth = '';
								if (subscription.endpoint) {
									subscription_endpoint = subscription.endpoint;
									}
								if (subscription.getKey("auth")) {
									const authBuffer = subscription.getKey('auth');
									const authUint8 = new Uint8Array(authBuffer);
									subscription_auth = btoa(String.fromCharCode.apply(null, authUint8));									
								}								
								if (subscription.getKey("p256dh")) {
									const p256dhBuffer = subscription.getKey('p256dh');
									const p256dhUint8 = new Uint8Array(p256dhBuffer);
									subscription_p256dh = btoa(String.fromCharCode.apply(null, p256dhUint8));									
								}								
									
								var data = {
									action: 'icpushcallback',
									device_id:deviceid,
									nonce: pnfpb_ajax_object_push.nonce,
									pnfpb_endpoint:subscription_endpoint,
									pnfpb_options:subscription_p256dh,
									pnfpb_subscription_token:subscription_auth,
									pushtype: 'checkdeviceid'
					    		};
								
								$j.post(pnfpb_ajax_object_push.ajax_url, data, async function(response) {

										var responseobject = JSON.parse(response);	

										subscriptionoptions = responseobject.subscriptionoptions;

										pnfpb_subscription_options = subscriptionoptions;
							
										subscriptionoptionsarray = subscriptionoptions.split('');

										if ($j(".subscribegroupbutton").length || $j(".unsubscribegroupbutton").length) {

											$j(".subscribegroupbutton").removeClass( "subscribe-init-display-off" );
											$j(".unsubscribegroupbutton").removeClass( "subscribe-init-display-off" );
											$j(".subscribe-notification-group").removeClass( "subscribe-init-display-off" );
											$j(".unsubscribe-notification-group").removeClass( "subscribe-init-display-off" );
										}										

										if( $j(".pnfpb-push-subscribe-button").length  ) {

											$j('.pnfpb_bell_icon_custom_prompt_loader').hide();

											$j(".pnfpb-push-subscribe-button").show();

											$j('.pnfpb_bell_icon_prompt_subscription_options_container').show();

											$j('.pnfpb-push-subscribe-button').prop('disabled', false);

											$j('.pnfpb-push-subscribe-options-button').prop('disabled', false);
					
										}
		
										if (subscriptionoptionsarray.length >= 4)
										{
										
											if ((subscriptionoptionsarray[24] && subscriptionoptionsarray[24] === '1') || subscriptionoptionsarray[0] === '1')
											{
												$j('#pnfpb_ic_fcm_front_favourite_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_fcm_front_favourite_enable').prop('checked', false);
											}

											if ((subscriptionoptionsarray[25] && subscriptionoptionsarray[25] === '1') || subscriptionoptionsarray[0] === '1')
											{
												$j('#pnfpb_ic_fcm_front_followers_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_ic_fcm_front_followers_enable').prop('checked', false);
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

											if (subscriptionoptionsarray.length > 0) {

												for (var pnfpb_frontend_settings_element = 0; pnfpb_frontend_settings_element < 12; pnfpb_frontend_settings_element++) {
	
													if (pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element] !== 'unsubscribe-all' && pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element] !== 'all')  {

														if (subscriptionoptionsarray[pnfpb_frontend_settings_element] === '1'  || subscriptionoptionsarray[0] === '1')
														{
															
															$j('.pnfpb_ic_fcm_front_'+pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element]+'_enable').prop('checked', true);

														}
														else 
														{


															if ((pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element] === 'bcomment') && (subscriptionoptionsarray[2] === '1' || subscriptionoptionsarray[3] === '1')) {

																$j('.pnfpb_ic_fcm_front_'+pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element]+'_enable').prop('checked', true);
	
															} else {
	
																$j('.pnfpb_ic_fcm_front_'+pnfpb_front_end_settings_push_notify_types[pnfpb_frontend_settings_element]+'_enable').prop('checked', false);
	
															}

														}
													
													} 

												}

											}													
												
											if (subscriptionoptionsarray.length > 14) {

												var subscription_options_element = 14;

												for (var pnfpb_frontend_post_type_element = 0; pnfpb_frontend_post_type_element < pnfpb_custom_post_types.length; pnfpb_frontend_post_type_element++) {
	
													if (subscriptionoptionsarray[subscription_options_element] === '1'  || subscriptionoptionsarray[0] === '1')
													{
														$j('.pnfpb_ic_fcm_front_subscription_'+pnfpb_custom_post_types[pnfpb_frontend_post_type_element]+'_enable').prop('checked', true);

													}
													else 
													{
														$j('.pnfpb_ic_fcm_front_subscription_'+pnfpb_custom_post_types[pnfpb_frontend_post_type_element]+'_enable').prop('checked', false);

													}
														
													subscription_options_element++;

												}

											}											

										}

										$j('.pnfpb_bell_icon_custom_prompt_loader_frontend').hide();

										$j('.pnfpb_frontend_subscriptions_options_menu_all').show();

										if( $j(".pnfpb-push-subscribe-icon-shortcode").length || pnfpb_shortcode_installed) {

											if (subscriptionoptionsarray[0] === '1')
											{

												$j('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').prop('checked', true);


												pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '1';

											}
											else 
											{

												$j('.pnfpb_bell_icon_prompt_subscription_all_enable_shortcode').prop('checked', false);

	
												pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';

											}

											if (subscriptionoptionsarray[24] && subscriptionoptionsarray[24] === '1')
											{
													$j('#pnfpb_bell_icon_prompt_subscription_favourite_enable_shortcode').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_bell_icon_prompt_subscription_favourite_enable_shortcode').prop('checked', false);
											}
											
											if (subscriptionoptionsarray[25] && subscriptionoptionsarray[25] === '1')
											{
												$j('#pnfpb_bell_icon_prompt_subscription_followers_enable_shortcode').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_bell_icon_prompt_subscription_followers_enable_shortcode').prop('checked', false);
											}											

											if (subscriptionoptionsarray[12] === '1' && subscriptionoptionsarray[0] !== '1')
											{

												$j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable_shortcode').prop('checked', true);


												pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '1';

											}
											else 
											{

												$j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable_shortcode').prop('checked', false);


												pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '0';

											}
											
											if (subscriptionoptionsarray[13] === '1' && subscriptionoptionsarray[0] !== '1')
											{

												$j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable_shortcode').prop('checked', true);


												pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '1';

											}
											else 
											{

												$j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable_shortcode').prop('checked', false);


												pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '0';

											}

											if (subscriptionoptionsarray.length > 0) {

												for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < 12; pnfpb_post_type_element++) {

													if (pnfpb_show_push_notify_types[pnfpb_post_type_element] !== 'unsubscribe-all' && pnfpb_show_push_notify_types[pnfpb_post_type_element] !== 'all') {	
														
														if (subscriptionoptionsarray[pnfpb_post_type_element] === '1' && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
														{
															$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable_shortcode').prop('checked', true);

															pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_post_type_element] = '1';
												
														}
														else 
														{
															if (subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1') {

																$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable_shortcode').prop('checked', false);

																pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_post_type_element] = '0';

															}															
														}
													
													} else {

														if (pnfpb_show_push_notify_types[pnfpb_post_type_element] === 'all' && subscriptionoptionsarray[0] === '1' )
														{

															$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[0]+'_enable_shortcode').prop('checked', true);

															pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';

														} else {

															if (subscriptionoptionsarray[8] === '1' ) {
															
																pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';

															}
														}

													}


												}

											}													
											
											if (subscriptionoptionsarray.length > 14) {

												var subscription_options_element = 14;

												for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {


													if (subscriptionoptionsarray[subscription_options_element] === '1' && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
													{
														$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable_shortcode').prop('checked', true);


														pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
													}
													else 
													{
														$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable_shortcode').prop('checked', false);


														pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
													}
													
													subscription_options_element++;

												}


											}
												
											$j('.pnfpb_bell_icon_custom_prompt_loader_shortcode').hide();

											$j('.pnfpb-push-subscribe-options-button-container-shortcode').show();
											
											$j('.pnfpb-push-subscribe-button-shortcode').prop('disabled', false);
								
											$j('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', false);													
										}

										if( $j(".pnfpb_bell_icon_subscription_options_container").length) {
				
											if (subscriptionoptionsarray[24] && subscriptionoptionsarray[24] === '1')
											{
												$j('#pnfpb_bell_icon_subscription_favourite_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_bell_icon_subscription_favourite_enable').prop('checked', false);
											}
											
											if (subscriptionoptionsarray[25] && subscriptionoptionsarray[25] === '1')
											{
												$j('#pnfpb_bell_icon_subscription_followers_enable').prop('checked', true);
											}
											else 
											{
												$j('#pnfpb_bell_icon_subscription_followers_enable').prop('checked', false);
											}											

											if (subscriptionoptionsarray[12] === '1')
											{

												$j('.pnfpb_bell_icon_subscription_group_details_update_enable').prop('checked', true);


												pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '1';

											}
											else 
											{
												$j('.pnfpb_bell_icon_subscription_group_details_update_enable').prop('checked', false);


												pnfpb_bell_icon_subscribe_push_type_checkbox[12] = '0';

											}
											
											if (subscriptionoptionsarray[13] === '1')
											{
												$j('.pnfpb_bell_icon_subscription_group_invite_enable').prop('checked', true);


												pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '1';

											}
											else 
											{
												$j('.pnfpb_bell_icon_subscription_group_invite_enable').prop('checked', false);


												pnfpb_bell_icon_subscribe_push_type_checkbox[13] = '0';

											}
											
											if (subscriptionoptionsarray.length > 0) {

												for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < 12; pnfpb_post_type_element++) {

													if (pnfpb_show_push_notify_types[pnfpb_post_type_element] !== 'unsubscribe-all' && pnfpb_show_push_notify_types[pnfpb_post_type_element] !== 'all') {		
														
														if (subscriptionoptionsarray[pnfpb_post_type_element] === '1' && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
														{
															$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable').prop('checked', true);

															pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_post_type_element] = '1';
										
														}
														else 
														{
															$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable').prop('checked', false);

															pnfpb_bell_icon_subscribe_push_type_checkbox[pnfpb_post_type_element] = '0';
										
														}
													
													} else {

														if (pnfpb_show_push_notify_types[pnfpb_post_type_element] === 'all' && subscriptionoptionsarray[0] === '1' )
														{

															$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[0]+'_enable').prop('checked', true);

															pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';

														} else {

															if (subscriptionoptionsarray[8] === '1') {
															
																pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';

															}
														}

													}

												}

											}													
											
											if (subscriptionoptionsarray.length > 14) {

												var subscription_options_element = 14;

												for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {

													if (subscriptionoptionsarray[subscription_options_element] === '1'  && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
													{
														$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked', true);


														pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
													}
													else 
													{
														$j('.pnfpb_bell_icon_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked', false);


														pnfpb_bell_icon_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
													}
													
													subscription_options_element++;

												}


											}									
										
										}
										
										if( $j(".pnfpb_bell_icon_prompt_subscription_options_container").length) {

											if (subscriptionoptionsarray[0] === '1')
												{
	
													$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked', true);
	
	
													pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '1';
	
												}
												else 
												{
	
													$j('.pnfpb_bell_icon_prompt_subscription_all_enable').prop('checked', false);
	
		
													pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[0] = '0';
	
												}

												if (subscriptionoptionsarray[24] && subscriptionoptionsarray[24] === '1')
												{
													$j('#pnfpb_bell_icon_prompt_subscription_favourite_enable').prop('checked', true);
												}
												else 
												{
													$j('#pnfpb_bell_icon_prompt_subscription_favourite_enable').prop('checked', false);
												}
												
												if (subscriptionoptionsarray[25] && subscriptionoptionsarray[25] === '1')
												{
													$j('#pnfpb_bell_icon_prompt_subscription_followers_enable').prop('checked', true);
												}
												else 
												{
													$j('#pnfpb_bell_icon_prompt_subscription_followers_enable').prop('checked', false);
												}													

											if (subscriptionoptionsarray[12] === '1' && subscriptionoptionsarray[0] !== '1')
											{

												$j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable').prop('checked', true);


												pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '1';

											}
											else 
											{

												$j('.pnfpb_bell_icon_prompt_subscription_group_details_update_enable').prop('checked', false);


												pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[12] = '0';

											}
											
											if (subscriptionoptionsarray[13] === '1' && subscriptionoptionsarray[0] !== '1')
											{

												$j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable').prop('checked', true);


												pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '1';

											}
											else 
											{

												$j('.pnfpb_bell_icon_prompt_subscription_group_invite_enable').prop('checked', false);


												pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[13] = '0';

											}

											if (subscriptionoptionsarray.length > 0) {

												for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < 12; pnfpb_post_type_element++) {

													if (pnfpb_show_push_notify_types[pnfpb_post_type_element] !== 'unsubscribe-all' && pnfpb_show_push_notify_types[pnfpb_post_type_element] !== 'all') {	
														
														if (subscriptionoptionsarray[pnfpb_post_type_element] === '1' && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
														{
															$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable').prop('checked', true);

															pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_post_type_element] = '1';
												
														}
														else 
														{
															if (subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1') {

																$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_show_push_notify_types[pnfpb_post_type_element]+'_enable').prop('checked', false);

																pnfpb_bell_icon_prompt_subscribe_push_type_checkbox[pnfpb_post_type_element] = '0';

															}															
														}
													
													} else {

														if (pnfpb_show_push_notify_types[pnfpb_post_type_element] === 'all' && subscriptionoptionsarray[0] === '1' )
														{

															$j('.pnfpb_bell_icon_subscription_'+pnfpb_show_push_notify_types[0]+'_enable').prop('checked', true);

															pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';

														} else {

															if (subscriptionoptionsarray[8] === '1' ) {
															
																pnfpb_bell_icon_subscribe_push_type_checkbox[0] = '1';

															}
														}

													}


												}

											}													
											
											if (subscriptionoptionsarray.length > 14) {

												var subscription_options_element = 14;

												for (var pnfpb_post_type_element = 0; pnfpb_post_type_element < pnfpb_custom_post_types.length; pnfpb_post_type_element++) {


													if (subscriptionoptionsarray[subscription_options_element] === '1' && subscriptionoptionsarray[8] !== '1' && subscriptionoptionsarray[0] !== '1')
													{
														$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked', true);


														pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '1';
													}
													else 
													{
														$j('.pnfpb_bell_icon_prompt_subscription_'+pnfpb_custom_post_types[pnfpb_post_type_element]+'_enable').prop('checked', false);


														pnfpb_bell_icon_prompt_subscribe_custom_post_checkbox[pnfpb_post_type_element] = '0';
													}
													
													subscription_options_element++;

												}


											}
										
										}

										const PNFPB_message = vapidKey;
										const PNFPB_encoder = new TextEncoder();
										const PNFPB_data = PNFPB_encoder.encode(PNFPB_message);
										const PNFPB_algorithm = "SHA-256";
										const PNFPB_readableHash = await getReadableHash(PNFPB_data, PNFPB_algorithm);

										if (PNFPB_readableHash) {										
													
											const PNFPB_SW_request = indexedDB.open("PNFPB_SW_Database", 3);
											const PNFPB_SW_Object = {key: 1, pnfpb_auth_token: PNFPB_readableHash, subscription_token: subscription_auth};

											PNFPB_SW_request.onupgradeneeded = (event) => {
												const PNFPB_SW_db = event.target.result;
												if (!PNFPB_SW_db.objectStoreNames.contains("PNFPB_SW_rest_token_Store")) {
													PNFPB_SW_db.createObjectStore("PNFPB_SW_rest_token_Store", { keyPath: "key" }); // Define keyPath for unique identification
												}												
												if (!PNFPB_SW_db.objectStoreNames.contains("PNFPB_SW_Store")) {
													PNFPB_SW_db.createObjectStore("PNFPB_SW_Store", { keyPath: "key" }); // Define keyPath for unique identification
												}
											};

											PNFPB_SW_request.onsuccess = (event) => {
												const PNFPB_SW_db = event.target.result;
												const PNFPB_SW_transaction = PNFPB_SW_db.transaction(["PNFPB_SW_Store"], "readwrite");
												const PNFPB_SW_objectStore = PNFPB_SW_transaction.objectStore("PNFPB_SW_Store");
												const PNFPB_SW_objectStore_get = PNFPB_SW_transaction.objectStore("PNFPB_SW_Store").get(1);
												PNFPB_SW_objectStore_get.onsuccess = (event) => {
													let data = event.target.result;
													if (event.target.result !== undefined  ) {
														if (data.pnfpb_auth_token !== PNFPB_readableHash) {
															const PNFPB_SW_addRequest = PNFPB_SW_objectStore.put(PNFPB_SW_Object);
															PNFPB_SW_addRequest.onsuccess = () => {
																console.log("Object added successfully");
																PNFPB_SW_db.close();
															};
															PNFPB_SW_addRequest.onerror = (error) => {
																console.error("Error adding object:", error);
																PNFPB_SW_db.close();
															};
														}
													} else {
														const PNFPB_SW_addRequest = PNFPB_SW_objectStore.put(PNFPB_SW_Object);
														PNFPB_SW_addRequest.onsuccess = () => {
															console.log("Object added successfully");
															PNFPB_SW_db.close();
														};
														PNFPB_SW_addRequest.onerror = (error) => {
															console.error("Error adding object:", error);
															PNFPB_SW_db.close();
														};

													}
												};
												PNFPB_SW_objectStore_get.onerror = (event) => {
															console.error("Error adding object:", error);
															PNFPB_SW_db.close();												
												}; 
											};

											PNFPB_SW_request.onerror = (event) => {
												console.error("Database error:", event.target.errorCode);
											};
										}									
							
									}).catch((err) => {
										console.log(__('An error occurred while retrieving token. ','push-notification-for-post-and-buddypress'), err);
										if( $j(".pnfpb-push-subscribe-button").length  ) {

											$j('.pnfpb_bell_icon_custom_prompt_loader').hide();
					
											$j('.pnfpb-push-subscribe-options-button').prop('disabled', false);
					
											$j('.pnfpb-push-subscribe-button').prop('disabled', false);
					
										}
					
										if( $j(".pnfpb-push-subscribe-icon-shortcode").length || pnfpb_shortcode_installed) {
					
											$j('.pnfpb_bell_icon_custom_prompt_loader_shortcode').show();
					
											$j('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', false);					
						
											$j('.pnfpb-push-subscribe-button-shortcode').prop('disabled', false);
										}
									})
								
								} else {
									console.log(__('An error occurred while retrieving token. ','push-notification-for-post-and-buddypress'));
									if( $j(".pnfpb-push-subscribe-button").length  ) {

										$j('.pnfpb_bell_icon_custom_prompt_loader').hide();
				
										$j('.pnfpb-push-subscribe-options-button').prop('disabled', false);
				
										$j('.pnfpb-push-subscribe-button').prop('disabled', false);
				
									}
				
									if( $j(".pnfpb-push-subscribe-icon-shortcode").length || pnfpb_shortcode_installed) {
				
										$j('.pnfpb_bell_icon_custom_prompt_loader_shortcode').show();
				
										$j('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', false);					
					
										$j('.pnfpb-push-subscribe-button-shortcode').prop('disabled', false);
									}
								}
							
						}).catch((err) => {
							console.log(__('An error occurred while retrieving token. ','push-notification-for-post-and-buddypress'), err);
							if( $j(".pnfpb-push-subscribe-button").length  ) {

								$j('.pnfpb_bell_icon_custom_prompt_loader').hide();
		
								$j('.pnfpb-push-subscribe-options-button').prop('disabled', false);
		
								$j('.pnfpb-push-subscribe-button').prop('disabled', false);
		
							}
		
							if( $j(".pnfpb-push-subscribe-icon-shortcode").length || pnfpb_shortcode_installed) {
		
								$j('.pnfpb_bell_icon_custom_prompt_loader_shortcode').show();
		
								$j('.pnfpb-push-subscribe-options-button-shortcode').prop('disabled', false);					
			
								$j('.pnfpb-push-subscribe-button-shortcode').prop('disabled', false);
							}
						})
						
					}
			}).catch((err) => {
				console.log(__('An error occurred serviceworker. ','push-notification-for-post-and-buddypress'), err);
			})
		} else {

		}

        
    }

	async function getReadableHash(data, algorithm) {
	try {
		const buffer = await crypto.subtle.digest(algorithm, data);
		const hexString = arrayBufferToHex(buffer);
		return hexString;
	} catch (error) {
		console.error("Error during hashing:", error);
		return null; // Or handle the error appropriately
	}
	}	

	function arrayBufferToHex(buffer) {
	const byteArray = new Uint8Array(buffer);
	const hexCodes = [...byteArray].map(value => {
		const hex = value.toString(16);
		return hex.padStart(2, '0');
	});
	return hexCodes.join('');
	}	

}

});
  // END jQuery ready function
});