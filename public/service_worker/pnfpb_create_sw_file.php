<?php

/**
 * Create service worker, Firebase service worker  dynamically (on the fly) for push notifications
 *
 * @since 1.0.0
 */

//check for  function called "PNFPB_icfm_icpush_add_rewrite_rules" or "PNFPB_icfm_icpush_generate_sw"  if it doesn't already exist
//

if (
    !function_exists("PNFPB_icfm_icpush_add_rewrite_rules") &&
    !function_exists("PNFPB_icfm_icpush_generate_sw")
) {
    add_action("init", "PNFPB_icfm_icpush_add_rewrite_rules");

    add_action("parse_request", "PNFPB_icfm_icpush_generate_sw_pwajson");
}

// phpcs:ignoreFile WordPress.DB.DirectDatabaseQuery

// Rewrite rules to create service worker, fire base service worker and manifest dynamically
if (!function_exists("PNFPB_icfm_icpush_add_rewrite_rules")) {
    function PNFPB_icfm_icpush_add_rewrite_rules()
    {
        $sw_filename = home_url("/") . "pnfpb_icpush_pwa_sw.js";
        add_rewrite_rule("^/{$sw_filename}$", "index.php?{$sw_filename}=1");

        $sw_filename_firebasesw = home_url("/") . "firebase-messaging-sw.js";
        add_rewrite_rule(
            "^/{$sw_filename_firebasesw}$",
            "index.php?{$sw_filename_firebasesw}=1"
        );

        if (
            get_option("pnfpb_ic_pwa_app_enable") &&
            get_option("pnfpb_ic_pwa_app_enable") === "1"
        ) {
            $manifest_filename_json = home_url("/") . "pnfpbmanifest.json";
            add_rewrite_rule(
                "^/{$manifest_filename_json}$",
                "index.php?{$manifest_filename_json}=1"
            );
        }
    }
}

// Create service worker, firebase service worker and manifest dynamically
if (!function_exists("PNFPB_icfm_icpush_generate_sw_pwajson")) {
    function PNFPB_icfm_icpush_generate_sw_pwajson($query)
    {
        if (
            !property_exists($query, "query_vars") ||
            !is_array($query->query_vars)
        ) {
            return;
        }

        // skip if it's multi dimensional array.
        if (
            count($query->query_vars) !==
            count($query->query_vars, COUNT_RECURSIVE)
        ) {
            return;
        }

        $query_vars_as_string = implode(" ", $query->query_vars);
        $sw_filename = "pnfpb_icpush_pwa_sw.js";
        $sw_filename_firebasesw = "firebase-messaging-sw.js";
        if ($query_vars_as_string != "") {
            if ($sw_filename != trim($query_vars_as_string)) {
                if ($sw_filename_firebasesw != trim($query_vars_as_string)) {
                    if (
                        trim($query_vars_as_string) === "pnfpbmanifest.json" &&
                        get_option("pnfpb_ic_pwa_app_enable") === "1"
                    ) {
                        header("Content-Type: application/json");
                        $pwa_manifest_contents = PNFPB_ic_generate_pwa_manifest_json();
                        echo wp_strip_all_tags($pwa_manifest_contents);
                        exit();
                    } else {
                        return;
                    }
                } else {
                    if (get_option("pnfpb_onesignal_push") !== "1") {
                        header("Content-Type: text/javascript");
                        $firebase_sw_contents = PNFPB_icfm_icpush_firebasesw_template();
                        echo wp_strip_all_tags($firebase_sw_contents);
                        exit();
                    }
                }
            } else {
                if (get_option("pnfpb_onesignal_push") !== "1") {
                    header("Content-Type: text/javascript");
                    PNFPB_icfm_icpush_sw_template();
                    $sw_contents = PNFPB_icfm_icpush_sw_template();
                    echo wp_strip_all_tags($sw_contents);
                    exit();
                }
            }
        }
    }
}

// Service worker template
if (!function_exists("PNFPB_icfm_icpush_sw_template")) {
    function PNFPB_icfm_icpush_sw_template()
    {
        ob_start(); ?>

		'use strict';

		//console.log(pnfpb_ajax_object_sw.nonce);

		var pnfpb_progressier_app_enabled = '<?php echo esc_js(
      get_option("pnfpb_ic_thirdparty_pwa_app_enable")
  ); ?>';

		var pnfpb_hide_foreground_notification = '<?php echo esc_js(
      get_option("pnfpb_ic_fcm_turnoff_foreground_messages")
  ); ?>';

		var pnfpb_sw_token = {};

		var pnfpb_progressier_app_id = '<?php if (
      get_option("pnfpb_ic_thirdparty_pwa_app_enable") === "1" &&
      get_option("pnfpb_ic_disable_serviceworker_pwa_pushnotification") !=
          "1" &&
      get_option("pnfpb_ic_pwa_thirdparty_app_id") &&
      get_option("pnfpb_ic_pwa_thirdparty_app_id") != ""
  ) {
      echo esc_js(get_option("pnfpb_ic_pwa_thirdparty_app_id"));
  } else {
      echo "";
  } ?>';

		if (pnfpb_progressier_app_enabled === '1' && pnfpb_progressier_app_id != '' ) {

			var pnfpb_progressier_sw_filename = "https://progressier.app/"+pnfpb_progressier_app_id+"/sw.js";

			importScripts(pnfpb_progressier_sw_filename);

		}

		var isPWAenabled = '<?php echo esc_js(
      get_option("pnfpb_ic_pwa_app_enable")
  ); ?>';
		var isExcludeallurlsincache = '<?php echo esc_js(
      get_option("pnfpb_ic_pwa_app_excludeallurls", "no")
  ); ?>';


		// Config
		var OFFLINE_ARTICLE_PREFIX = 'pnfpb-offline--';
		var SW = {
  			cache_version: 'pnfpb_v2.18.2',
  			offline_assets: []
		};

		if (isExcludeallurlsincache === '1'  || isExcludeallurlsincache === 'no') {
			caches.delete(SW.cache_version);
		}

		if (isPWAenabled === '1') {

			//This is the "Offline copy of pages" wervice worker

			//Install stage sets up the index page (home page) in the cahche and opens a new cache

			var cacheurl3 = '<?php echo esc_js(
       get_option("pnfpb_ic_pwa_app_offline_url3")
   ); ?>';
			var cacheurl4 = '<?php echo esc_js(
       get_option("pnfpb_ic_pwa_app_offline_url4")
   ); ?>';
			var cacheurl5 = '<?php echo esc_js(
       get_option("pnfpb_ic_pwa_app_offline_url5")
   ); ?>';

			if (isExcludeallurlsincache !== '1' && isExcludeallurlsincache !== 'no') {

				SW.offline_assets.push("<?php if (
        get_option("pnfpb_ic_pwa_app_offline_url1") &&
        get_option("pnfpb_ic_pwa_app_offline_url1") !== ""
    ) {
        echo esc_js(get_option("pnfpb_ic_pwa_app_offline_url1"));
    } else {
        echo esc_js(get_home_url());
    } ?>");

				if (cacheurl3 !== '' && cacheurl3 !== '<?php echo esc_js(
        get_option("pnfpb_ic_pwa_app_offline_url1")
    ); ?>' && cacheurl3 !== cacheurl4  && cacheurl3 !== cacheurl5){
					SW.offline_assets.push(cacheurl3);
				}
				if (cacheurl4 !== '' && cacheurl4 !== '<?php echo esc_js(
        get_option("pnfpb_ic_pwa_app_offline_url1")
    ); ?>' && cacheurl3 !== cacheurl4  && cacheurl4 !== cacheurl5){
					SW.offline_assets.push(cacheurl4);
				}
				if (cacheurl5 !== '' && cacheurl5 !== '<?php echo esc_js(
        get_option("pnfpb_ic_pwa_app_offline_url1")
    ); ?>' && cacheurl5 !== cacheurl3  && cacheurl4 !== cacheurl5){
					SW.offline_assets.push(cacheurl5);
				}
			}

			const offlinePage = "<?php if (
       get_option("pnfpb_ic_pwa_app_offline_url2") &&
       get_option("pnfpb_ic_pwa_app_offline_url2") !== ""
   ) {
       echo esc_js(get_option("pnfpb_ic_pwa_app_offline_url2"));
   } else {
       echo esc_url(get_home_url());
   } ?>";

			var pnfpbwpSysurls = ['gstatic.com','/wp-admin/','/wp-json/','/s.w.org/','/wp-content/','/wp-login.php','/wp-includes/','/preview=true/','ps.w.org'];

		
			var pnfpbexcludeurls = "<?php echo esc_js(
       get_option("pnfpb_ic_pwa_app_excludeurls")
   ); ?>";

			var pnfpbexcludeurlsarray = pnfpbexcludeurls.split(",");

			var neverCacheUrls = pnfpbwpSysurls;

			if (pnfpbexcludeurlsarray.length > 0 && pnfpbexcludeurls !== ''){
				neverCacheUrls = pnfpbwpSysurls.concat(pnfpbexcludeurlsarray);
			}


			//
			// Installation
			//
			self.addEventListener('install', (event) => {
  				// Don't wait to take control.
				//console.log('skip waiting...service worker install');
  				event.waitUntil(self.skipWaiting());

  				// Set up our cache.
				if (isExcludeallurlsincache !== '1'  && isExcludeallurlsincache !== 'no') {
  					event.waitUntil(
    					caches.open(SW.cache_version).then(function(cache) {
        					// Attempt to cache assets

							var urlsToCache = SW.offline_assets || [];

							return Promise.all(
								urlsToCache.map(url =>
									cache.add(url).catch(err => {
										console.warn('Service Worker: Failed to cache', url, err);
									})
								)
							).then(() => {
								console.log('Service Worker: Installation completed with some files possibly skipped.');
							});

      					}).then(function(e){
        					return self.skipWaiting();
      					})
  					);
				}
			});

			//
			// Activation. First-load and also when a new version of SW is detected.
			//
			self.addEventListener('activate', function(event) {
  				// Delete all caches that aren't named in SW.cache_version.
  				//
				event.waitUntil(clients.claim());
  				var expectedCacheNames = [SW.cache_version];
  				event.waitUntil(
    				caches.keys().then(function(cacheNames) {
      					return Promise.all(
        					cacheNames.map(function(cacheName) {
          					// Two conditions must be met in order to delete the cache:
          					//
          					// 1. It must NOT be found in the main SW cache list.
          					// 2. It must NOT be prefixed with our offline article prefix.
          						if (
            						expectedCacheNames.indexOf(cacheName) === -1 &&
            						cacheName.indexOf(OFFLINE_ARTICLE_PREFIX) === -1
          						) {
            						// If this cache name isn't present in the array of "expected"
            						// cache names, then delete it.
            						console.info('Service Worker: deleting old cache ' + cacheName);
            						return caches.delete(cacheName);
          						}
        					})
      					);
    				})
  				);
			});

			//
			// Intercept requests
			//
			self.addEventListener('fetch', function(event) {
				// Return if the current request url is in the never cache list
				if ( ! neverCacheUrls.every(checkNeverCacheList, event.request.url) ) {
	  				//console.log( 'Service worker - request is excluded from cache.' );
	  				return;
				}

				if (isExcludeallurlsincache === '1'  || isExcludeallurlsincache === 'no') {
					//console.log( 'Service worker - request is excluded from cache.' );
					return;
				}

  				// Build a hostname-free version of request path.
  				//console.log(event.request.url);
  				var reqLocation = getLocation(event.request.url);
  				var reqPath = '';
			
  				var updateCache = function(request){
    				return caches.open(SW.cache_version).then(function (cache) {
      					return fetch(request).then(function (response) {
        					//console.log('[pnfpbpwa] add page to offline '+response.url)
        					return cache.put(request, response.clone());
      					})
						.catch(function () {
                  			return caches.match(offlinePage);
              			})
    				});
  				};

  				event.waitUntil(updateCache(event.request));

  				var request = event.request;
  				// Always fetch non-GET requests from the network
  				if (request.method !== 'GET') {
      				event.respondWith(
          				fetch(request)
              			.catch(function () {
                  			return caches.match(offlinePage);
              			})
      				);
      				return;
  				}  

  				// Consolidate some conditions for re-use.
  				var requestisAccept = false;
  				if (event.request.headers.get('Accept')) {
    				if (event.request.headers.get('Accept').indexOf('text/html') !== -1){
      					requestisAccept = true;
   	 				}
  				}
  				var requestIsHTML = event.request.method === 'GET';


  				// Saved articles, MVW pages, Offline
  				//
  				// First, we check to see if the user has explicitly cached this HTML content
  				// or if the page is in the "minimum viable website" list defined in the main
  				// SW.cache_version. If no cached page is found, we fallback to the network,
  				// and finally if both of those fail, serve the "Offline" page.
  				if (
    				requestisAccept && requestIsHTML
  				) {
    				event.respondWith(
     		 			caches.match(event.request).then(function (response) {
        					// Show old content while revalidating URL in background if necessary.
        					return staleWhileRevalidate(event.request);
      					}).catch(function(error) {
        					// When the cache is empty and the network also fails, we fall back to a
        					// generic "Offline" page.
        					return caches.match(offlinePage);
      					})
    				);
  				}
  				else {
    				event.respondWith(
      					fetch(request)
          				.catch(function () {
              				return caches.match(offlinePage);
          				})
    				);
    				return;    
  				}
		});
	}
	else
	{

			//
			// Activation. First-load and also when a new version of SW is detected.
			//
			self.addEventListener('activate', function(event) {
  				// Delete all caches that aren't named in SW.cache_version.
  				//
  				var expectedCacheNames = [SW.cache_version];
  				event.waitUntil(
    				caches.keys().then(function(cacheNames) {
      					return Promise.all(
        					cacheNames.map(function(cacheName) {
            					// If this cache name isn't present in the array of "expected"
            					// cache names, then delete it.
            					console.info('Service Worker: deleting old cache ' + cacheName);
            					return caches.delete(cacheName);
        					})
      					);
    				})
  				);
			});

	}

	// Stale While Revalidate
	//
	// Helper function to manage cache updates in the background.
	function staleWhileRevalidate(request) {
  		// Build a hostname-free version of request path.
  		var reqLocation = getLocation(request.url);
  		var reqPath = reqLocation.pathname;

  		// Open the default cache and look for this request. We have to restrict this
  		// lookup to one cache because we want to make sure we don't add new entries
  		// unless really necessary (third-party assets, unsaved content, etc).
  		var defaultCachePromise = caches.open(SW.cache_version);
  		var defaultMatchPromise = defaultCachePromise.then(function(cache) {
    		return cache.match(request);
  		});

  		// Find any user-saved articles so we can update outdated content.
  		var userCachePromise = caches.has(OFFLINE_ARTICLE_PREFIX + reqPath).then(function maybeOpenCache(cacheExists) {
    	// This conditional exists because, per spec, caches.has() resolves whether
    	// the cache is found or not. The Promise value returns true or false based
    	// on whether the cache was found. Rejections only occur when something
    	// exceptional has occurred, not just because a cache is missing.
    	//
    	// @see https://www.w3.org/TR/service-workers/#cache-storage-has
    	//
    	// In cases where the cache was NOT found, I had extreme difficulty getting
    	// pages to load, since manually rejecting caused the Promise.all() below
    	// to fail, resulting in the Offline page even when something more useful
    	// should have displayed.
    	//
   	 	// My band-aid is to load the main cache when no user cache was found,
    	// sending along a similar object that won't ever be touched again since
    	// the userMatchPromise will never match content URLs in the main cache.
    	if (cacheExists) {
      		return caches.open(OFFLINE_ARTICLE_PREFIX + reqPath);
   		 } else {
      		return caches.open(SW.cache_version);
    	}
  		}).catch(function () {
    		console.error('Error while trying to load user cache for ' + reqPath);
  		});

  		var userMatchPromise = userCachePromise.then(function matchUserCache(cache) {
    		return cache.match(request);
  		});

  		return Promise.all([defaultCachePromise, defaultMatchPromise, userCachePromise, userMatchPromise]).then(function(promiseResults) {
    	// When ES2015 isn't behind a flag anymore, move these vars to an array
    	// in the function signature to destructure the results of the Promise.
    	var defaultCache = promiseResults[0];
    	var defaultResponse = promiseResults[1];
   	 	var userCache = promiseResults[2];
    	var userResponse = promiseResults[3];
	

    	// Determine whether any cache holds data for this request.
    	var requestIsInDefaultCache = typeof defaultResponse !== 'undefined';
    	var requestIsInUserCache = typeof userResponse !== 'undefined';

    	// Kick off the update request in the background.
    	var fetchResponse = fetch(request).then(function(response) {
      	// Determine whether this is first or third-party request.
     	 var requestIsFirstParty = response.type === 'basic';

      	// IF the DEFAULT cache already has an entry for this asset,
      	// AND the resource is in our control,
      	// AND there was a valid response,
      	// THEN update the cache with the new response.
      	if (requestIsInDefaultCache && requestIsFirstParty && response.status === 200) {
        	// Cache the updated file and then return the response
        	defaultCache.put(request, response.clone());
        	console.info('Service worker - Fetch listener updated ' + reqPath);
      	}

      	// IF the USER cache already has an entry for this asset,
      	// AND the resource is in our control,
      	// AND there was a valid response,
      	// THEN update the cache with the new response.
      	else if (requestIsInUserCache && requestIsFirstParty && response.status === 200) {
        	// Cache the updated file and then return the response
        	userCache.put(request, response.clone());
        	console.info('Service worker - Fetch listener updated ' + reqPath);
      	}

      		// None of the conditions were met. Just skip the caching phase.
      	else {
        	//console.info('Service worker - Fetch listener skipped ' + reqPath);
      	}

      	// Return response regardless of caching outcome.
      	return response;
    	});

    	// Return any cached responses if we have one, otherwise wait for the
    	// network response to come back.
    	return defaultResponse || userResponse || fetchResponse;
  	});
	}

	// Check if current url is in the neverCacheUrls list
	function checkNeverCacheList(url) {
		if ( this.match(url) ) {
			return false;
		}
		return true;
	}

	// Polyfill for window.location
	//
	function getLocation(href) {
		var match = href.match(/^(https?\:)\/\/(([^:\/?#]*)(?:\:([0-9]+))?)(\/[^?#]*)(\?[^#]*|)(#.*|)$/);
		return match && {
	  		protocol: match[1],
	 		host: match[2],
	  		hostname: match[3],
	  		//port: match[4],
	  		pathname: match[5],
	  		search: match[6],
	  		hash: match[7]
		};
	}

	async function pnfpb_send_delivery_confirmation(notification_id,notification_token,notify_type) {

		/* Get required details for fetch api from Indexeddb */
		/* Encrypt using AES-256-GCM method to send it in API */
		/* After data sent using API, Server then decrypts using AES-256-GCM method */
		/* to update Notification delivery and read counts in PNFPB Plugin's WordPress database tables */

		const PNFPB_SW_request = indexedDB.open("PNFPB_SW_Database", 2);

		PNFPB_SW_request.onsuccess = (event) => {
			const PNFPB_SW_db = event.target.result;
			const PNFPB_SW_transaction = PNFPB_SW_db.transaction(["PNFPB_SW_Store"], "readonly");
			const PNFPB_SW_objectStore = PNFPB_SW_transaction.objectStore("PNFPB_SW_Store");
			const PNFPB_SW_getRequest = PNFPB_SW_objectStore.get(1);
			PNFPB_SW_getRequest.onsuccess = async () => {
				const data = PNFPB_SW_getRequest.result;
				if (data && data.pnfpb_auth_token) {
					if (data.pnfpb_auth_token !== '') {

						// concatenate data to be encrypted delimited with "@!!@" which will be decrypted in server side 
						// and split to appropriate fields using same delimiter "@!!@"

						var pnfpb_subscription_token = '';
						if (data.subscription_token) {
							pnfpb_subscription_token = data.subscription_token;
						}
						const pnfpb_data_to_be_encrypted = notification_id+'@!!@'+pnfpb_subscription_token+'@!!@'+navigator.userAgent+'@!!@'+notify_type;
						const notification_delivery_encrypted_data = await pnfpb_encryptData(pnfpb_data_to_be_encrypted,data.pnfpb_auth_token);
						const notification_delivery_encrypted_authtoken = await pnfpb_encryptData(notification_token,data.pnfpb_auth_token);
						const PNFPB_SW_rest_token_transaction = PNFPB_SW_db.transaction(["PNFPB_SW_rest_token_Store"], "readonly");
						const PNFPB_SW_rest_token_objectStore = PNFPB_SW_rest_token_transaction.objectStore("PNFPB_SW_rest_token_Store");
						const PNFPB_SW_rest_token_getRequest = PNFPB_SW_rest_token_objectStore.get(1);
						PNFPB_SW_rest_token_getRequest.onsuccess = async () => {
							const data = PNFPB_SW_rest_token_getRequest.result;
							if (data && data.pnfpb_rest_token && data.pnfpb_rest_token !== '') {
								const notification_delivery_details = { encrypted_data: notification_delivery_encrypted_data, pnfpb_encrypted_authtoken: notification_delivery_encrypted_authtoken };

								/* Send notification delivery counts and read counts with encrypted signature using AES-256-GCM using secured PNFPB REST API */

								fetch('<?php echo esc_url_raw(get_home_url())."/wp-json/PNFPBpush/v1/notification-delivery-counts/"; ?>', { method: 'POST', headers: {'Content-Type': 'application/json',
							  },body: JSON.stringify(notification_delivery_details) })
								.then(async response => {
									// Check if the request was successful (e.g., status code 200-299)
									if (!response.ok) {
										throw new Error(`HTTP error! status: ${response.status}`);
									}
									// Parse the response body as JSON
									//const responsejson = await response.json();
									return '';
								})
								.catch(error => {
									// Handle any errors that occurred during the fetch operation
									console.error('There was a problem with the fetch operation:', error);
									return '';
								});
							} else {
								console.log('Notification delivery and read count not sent - PNFPB_SW_rest_token_Store tokens not found');
								return '';
							} 
						}
					} else {
						console.log('Notification delivery and read count not sent - PNFPB_SW_Store tokens not found');
						return '';
					}
				} else {
					return '';
				}
			};
			PNFPB_SW_getRequest.onerror = (event) => {
				reject('Error getting data: ' + event.target.error);
				PNFPB_SW_db.close();
				return '';
			};

		};

		PNFPB_SW_request.onerror = (event) => {
			console.error("Database error:", event.target.errorCode);
			return '';
		};

	}

	async function pnfpb_encryptData(plaintext, passphrase) {
		const ptUtf8 = new TextEncoder().encode(plaintext);
		const pwUtf8 = new TextEncoder().encode(passphrase);
		const pwHash = await crypto.subtle.digest('SHA-256', pwUtf8);

		const iv = crypto.getRandomValues(new Uint8Array(16));
		const alg = { name: 'AES-GCM', iv: iv };
		const key = await crypto.subtle.importKey('raw', pwHash, alg, false, ['encrypt']);

		const ctBuffer = await crypto.subtle.encrypt(alg, key, ptUtf8);
	  	const tag = new Uint8Array(ctBuffer, ctBuffer.byteLength - 16, 16);
	  	const ciphertext = new Uint8Array(ctBuffer, 0, ctBuffer.byteLength - 16);

		const ivHex = Array.from(iv).map(b => ('00' + b.toString(16)).slice(-2)).join('');

		return {
			ciphertext: btoa(String.fromCharCode(...new Uint8Array(ciphertext))),
			iv: btoa(String.fromCharCode(...new Uint8Array(iv))),
			tag: btoa(String.fromCharCode(...new Uint8Array(tag)))
		}
	}

	async function pnfpb_receivePushNotification(event) {

			event.stopImmediatePropagation();

			var notification = {};

			var pnfpb_push_data = {};

			var notification_id = '';
			var notification_token = '';

  			if (event.data) {
    			notification = event.data.json().notification;
				pnfpb_push_data = event.data.json().data;
				if (pnfpb_push_data.notification_id) {
					notification_id = pnfpb_push_data.notification_id;
				}
				if (pnfpb_push_data.notification_auth_token) {
					notification_token = pnfpb_push_data.notification_auth_token;
				}
				// Customize notification here
				const notificationTitle = notification.title;
				const notificationOptions = {
					body: notification.body,
					icon: notification.icon,
					image: notification.image,
					data: {
						url: notification.click_action,
						notification_id:notification_id,
						notification_token:notification_token,
					},
					tag: notification.tag,
					renotify: notification.renotify
				}; 

				event.waitUntil(self.registration.showNotification(notificationTitle, notificationOptions));

				if (notification_id !== '' && notification_token !== '') {
					await pnfpb_send_delivery_confirmation(notification_id,notification_token,'delivery');
				}

			}

	}

	/* Push event process when push message received by browser */

	self.addEventListener("push", pnfpb_receivePushNotification);
	
	/* Event to be processed after notification is clicked to open client page/url */

	self.addEventListener("notificationclick", (event) => {
			event.preventDefault();
			if (event.action === "read_more") {
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
    		} else {
				if (event.action === "custom_url") {

					var pnfpb_custom_click_action_url = '<?php echo esc_url(
         get_option("pnfpb_ic_custom_click_action_url")
     ); ?>';

					event.notification.close();
  					// This looks to see if the current is already open and
  					// focuses if it is
  					event.waitUntil(clients.matchAll({
    					type: "window",
						includeUncontrolled: true,
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
    						type: "window",
							includeUncontrolled: true,
  						}).then( async (clientList) => {
    						if (clients.openWindow) {
								// Send a message to the client.
								clients.openWindow(event.notification.data.url).then(async function(windowClient) {
									if (event.notification.data.notification_id !== '' && event.notification.data.notification_token !== '') {
										await pnfpb_send_delivery_confirmation(event.notification.data.notification_id,event.notification.data.notification_token,'read');
										return;
									} else {
										return;
									}
								})
							}
  						}))
					}
				}
			}
	},
	false,
	);

<?php $sw_contents = ob_get_contents();

  ob_get_clean();

  return $sw_contents;
    }
}

// Firebase cloud messaging service worker template
if (!function_exists("PNFPB_icfm_icpush_firebasesw_template")) {
    function PNFPB_icfm_icpush_firebasesw_template()
    {
        ob_start(); ?>
'use strict';



var firebase_sw = '<?php echo esc_js(
    PNFPB_PLUGIN_DIR_PATH . "build/pnfpb_service_worker/index.js"
); ?>';


importScripts(firebase_sw);

		<?php
  $firebase_sw_contents = ob_get_contents();

  ob_get_clean();

  return $firebase_sw_contents;
    }
}

if (!function_exists("PNFPB_ic_genenrate_pwa_mainfest_json")) {
    function PNFPB_ic_generate_pwa_manifest_json()
    {
        $pnfpb_pwa_desktop_screenshot_getimagesize = [];

        $pnfpb_pwa_mobile_screenshot_getimagesize = [];

        if (get_option("pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value")) {
            $mobile_screenshot_url = esc_url(
                get_option("pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value")
            );

            $pnfpb_pwa_mobile_screenshot_getimagesize = getimagesize(
                $mobile_screenshot_url
            );
        }

        if (get_option("pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value")) {
            $desktop_screenshot_url = esc_url(
                get_option("pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value")
            );

            $pnfpb_pwa_desktop_screenshot_getimagesize = getimagesize(
                $desktop_screenshot_url
            );
        }

        $pnfpb_pwa_desktop_screenshot_width = 0;

        $pnfpb_pwa_desktop_screenshot_height = 0;

        $pnfpb_pwa_mobile_screenshot_width = 0;

        $pnfpb_pwa_mobile_screenshot_height = 0;

        if (count($pnfpb_pwa_desktop_screenshot_getimagesize) > 1) {
            $pnfpb_pwa_desktop_screenshot_width =
                $pnfpb_pwa_desktop_screenshot_getimagesize[0];

            $pnfpb_pwa_desktop_screenshot_height =
                $pnfpb_pwa_desktop_screenshot_getimagesize[1];
        }

        if (count($pnfpb_pwa_mobile_screenshot_getimagesize) > 1) {
            $pnfpb_pwa_mobile_screenshot_width =
                $pnfpb_pwa_mobile_screenshot_getimagesize[0];

            $pnfpb_pwa_mobile_screenshot_height =
                $pnfpb_pwa_mobile_screenshot_getimagesize[1];
        }

        if (get_option("pnfpb_ic_pwa_protocol_name")) {
            $pnfpb_ic_pwa_protocol_name_array = get_option(
                "pnfpb_ic_pwa_protocol_name"
            );

            if (!is_array($pnfpb_ic_pwa_protocol_name_array)) {
                $pnfpb_ic_pwa_protocol_name_array = [];
            }
        } else {
            $pnfpb_ic_pwa_protocol_name_array = [];
        }

        if (get_option("pnfpb_ic_pwa_protocol_url")) {
            $pnfpb_ic_pwa_protocol_url_array = get_option(
                "pnfpb_ic_pwa_protocol_url"
            );

            if (!is_array($pnfpb_ic_pwa_protocol_url_array)) {
                $pnfpb_ic_pwa_protocol_url_array = [];
            }
        } else {
            $pnfpb_ic_pwa_protocol_url_array = [];
        }

        $pnfpb_pwa_protocol_count = 0;

        $pnfpb_ic_pwa_protocol_array = [];

        foreach (
            $pnfpb_ic_pwa_protocol_name_array
            as $pnfpb_ic_pwa_protocol_name_element
        ) {
            if (
                trim($pnfpb_ic_pwa_protocol_name_element) !== "" &&
                $pnfpb_ic_pwa_protocol_name_element !== null
            ) {
                $pnfpb_ic_pwa_protocol_array[$pnfpb_pwa_protocol_count][
                    "protocol"
                ] = $pnfpb_ic_pwa_protocol_name_element;

                if (
                    isset(
                        $pnfpb_ic_pwa_protocol_url_array[
                            $pnfpb_pwa_protocol_count
                        ]
                    )
                ) {
                    $pnfpb_ic_pwa_protocol_array[$pnfpb_pwa_protocol_count][
                        "url"
                    ] =
                        $pnfpb_ic_pwa_protocol_url_array[
                            $pnfpb_pwa_protocol_count
                        ];
                } else {
                    $pnfpb_ic_pwa_protocol_array[$pnfpb_pwa_protocol_count][
                        "url"
                    ] = "";
                }
            }

            $pnfpb_pwa_protocol_count++;
        }
		
		$pnfpb_ic_pwa_shortcut_name_array = [];
		$pnfpb_ic_pwa_shortcut_shortname_array = [];
		$pnfpb_ic_pwa_shortcut_starturl_array = [];
		$pnfpb_ic_pwa_shortcut_description_array = [];
		$pnfpb_ic_pwa_shortcut_upload_icon_132_array = [];
		$pnfpb_ic_pwa_shortcut_upload_icon_512_array = [];

		if (get_option("pnfpb_ic_pwa_app_shortcut_name")) {
			$pnfpb_ic_pwa_shortcut_name_array = get_option(
				"pnfpb_ic_pwa_app_shortcut_name"
			);

			if (!is_array($pnfpb_ic_pwa_shortcut_name_array)) {
				$pnfpb_ic_pwa_shortcut_name_array = [" "];
			}
		} else {
			$pnfpb_ic_pwa_shortcut_name_array = [" "];
		}

		if (get_option("pnfpb_ic_pwa_app_shortcut_shortname")) {
			$pnfpb_ic_pwa_shortcut_shortname_array = get_option(
				"pnfpb_ic_pwa_app_shortcut_shortname"
			);

			if (!is_array($pnfpb_ic_pwa_shortcut_shortname_array)) {
				$pnfpb_ic_pwa_shortcut_shortname_array = [" "];
			}
		} else {
			$pnfpb_ic_pwa_shortcut_shortname_array = [" "];
		}

		if (get_option("pnfpb_ic_pwa_app_shortcut_starturl")) {
			$pnfpb_ic_pwa_shortcut_starturl_array = get_option(
				"pnfpb_ic_pwa_app_shortcut_starturl"
			);

			if (!is_array($pnfpb_ic_pwa_shortcut_starturl_array)) {
				$pnfpb_ic_pwa_shortcut_starturl_array = [" "];
			}
		} else {
			$pnfpb_ic_pwa_shortcut_starturl_array = [" "];
		}

		if (get_option("pnfpb_ic_pwa_app_shortcut_description")) {
			$pnfpb_ic_pwa_shortcut_description_array = get_option(
				"pnfpb_ic_pwa_app_shortcut_description"
			);

			if (!is_array($pnfpb_ic_pwa_shortcut_description_array)) {
				$pnfpb_ic_pwa_shortcut_description_array = [" "];
			}
		} else {
			$pnfpb_ic_pwa_shortcut_description_array = [" "];
		}

		if (get_option("pnfpb_ic_fcm_pwa_shortcut_upload_icon_132")) {
			$pnfpb_ic_pwa_shortcut_upload_icon_132_array = get_option(
				"pnfpb_ic_fcm_pwa_shortcut_upload_icon_132"
			);

			if (!is_array($pnfpb_ic_pwa_shortcut_upload_icon_132_array)) {
				$pnfpb_ic_pwa_shortcut_upload_icon_132_array = [" "];
			}
		} else {
			$pnfpb_ic_pwa_shortcut_upload_icon_132_array = [" "];
		}

		if (get_option("pnfpb_ic_fcm_pwa_shortcut_upload_icon_512")) {
			$pnfpb_ic_pwa_shortcut_upload_icon_512_array = get_option(
				"pnfpb_ic_fcm_pwa_shortcut_upload_icon_512"
			);

			if (!is_array($pnfpb_ic_pwa_shortcut_upload_icon_512_array)) {
				$pnfpb_ic_pwa_shortcut_upload_icon_512_array = [" "];
			}
		} else {
			$pnfpb_ic_pwa_shortcut_upload_icon_512_array = [" "];
		}
	
	 	$pnfpb_ic_pwa_shortcuts_manifest_array = [];
		$pnfpb_ic_pwa_shortcuts_manifest_array_count = 0;
		
       foreach (
            $pnfpb_ic_pwa_shortcut_name_array
            as $pnfpb_ic_pwa_shortcut_name_array_element
        ) {
		    if ($pnfpb_ic_pwa_shortcut_name_array_element !== '' && isset($pnfpb_ic_pwa_shortcut_starturl_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count]) && $pnfpb_ic_pwa_shortcut_starturl_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count] !== '' ) {
				
				$pnfpb_ic_pwa_shortcuts_manifest_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count]["name"] = $pnfpb_ic_pwa_shortcut_name_array_element;

				if (isset($pnfpb_ic_pwa_shortcut_shortname_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count]) && $pnfpb_ic_pwa_shortcut_shortname_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count] !== '') {
					$pnfpb_ic_pwa_shortcuts_manifest_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count]["short_name"] = $pnfpb_ic_pwa_shortcut_shortname_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count];
				}

				if (isset($pnfpb_ic_pwa_shortcut_starturl_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count])) {
					$pnfpb_ic_pwa_shortcuts_manifest_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count]["url"] = $pnfpb_ic_pwa_shortcut_starturl_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count];
				}

				if (isset($pnfpb_ic_pwa_shortcut_description_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count]) && $pnfpb_ic_pwa_shortcut_description_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count] !== '') {
					$pnfpb_ic_pwa_shortcuts_manifest_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count]["description"] = $pnfpb_ic_pwa_shortcut_description_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count];
				}

				if (is_array($pnfpb_ic_pwa_shortcut_upload_icon_132_array) || is_array($pnfpb_ic_pwa_shortcut_upload_icon_512_array)) {
					$pnfpb_ic_pwa_shortcuts_icons_array_count = 0;
					if (isset($pnfpb_ic_pwa_shortcut_upload_icon_132_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count]) && $pnfpb_ic_pwa_shortcut_upload_icon_132_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count] !== '') {
						$pnfpb_ic_pwa_shortcuts_manifest_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count]["icons"][$pnfpb_ic_pwa_shortcuts_icons_array_count]["src"] = $pnfpb_ic_pwa_shortcut_upload_icon_132_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count];
						$pnfpb_ic_pwa_shortcuts_manifest_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count]["icons"][$pnfpb_ic_pwa_shortcuts_icons_array_count]["sizes"] = "132x132";
						$pnfpb_ic_pwa_shortcuts_icons_array_count++;													
					}
					if (isset($pnfpb_ic_pwa_shortcut_upload_icon_512_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count]) && $pnfpb_ic_pwa_shortcut_upload_icon_512_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count] !== '') {
						$pnfpb_ic_pwa_shortcuts_manifest_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count]["icons"][$pnfpb_ic_pwa_shortcuts_icons_array_count]["src"] = $pnfpb_ic_pwa_shortcut_upload_icon_512_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count];
						$pnfpb_ic_pwa_shortcuts_manifest_array[$pnfpb_ic_pwa_shortcuts_manifest_array_count]["icons"][$pnfpb_ic_pwa_shortcuts_icons_array_count]["sizes"] = "512x512";
					}					
				}
	   		}
			   
			$pnfpb_ic_pwa_shortcuts_manifest_array_count++; 
	   }

		ob_start();
        ?>
						{
						"id": "<?php if (get_option("pnfpb_ic_pwa_app_starturl")) {
            echo esc_url_raw(get_option("pnfpb_ic_pwa_app_starturl"));
        } else {
            echo esc_url_raw(get_home_url())."/";
        } ?>",
  						"name": "<?php if (get_option("pnfpb_ic_pwa_app_name")) {
            echo esc_html(get_option("pnfpb_ic_pwa_app_name"));
        } else {
            echo esc_html(substr(get_bloginfo("name"), 0, 50));
        } ?>",
  						"short_name": "<?php if (get_option("pnfpb_ic_pwa_app_shortname")) {
            echo esc_html(get_option("pnfpb_ic_pwa_app_shortname"));
        } else {
            echo esc_html(substr(get_bloginfo("name"), 0, 25));
        } ?>",
 						"description": "<?php if (get_option("pnfpb_ic_pwa_app_description")) {
            echo esc_html(get_option("pnfpb_ic_pwa_app_description"));
        } else {
            echo esc_html("");
        } ?>",
  						"start_url": "<?php if (get_option("pnfpb_ic_pwa_app_starturl")) {
            echo esc_url_raw(get_option("pnfpb_ic_pwa_app_starturl"));
        } else {
            echo esc_url_raw(get_home_url())."/";
        } ?>",
		<?php 
		if (get_option("pnfpb_ic_pwa_app_scope") && esc_url_raw(get_option("pnfpb_ic_pwa_app_scope") !== ''))
 		{ 
		?>
  						"scope": "<?php if (get_option("pnfpb_ic_pwa_app_scope")) {
            echo esc_url_raw(get_option("pnfpb_ic_pwa_app_scope"));
        }  ?>",
		<?php
		}
		?>
  						"orientation": "<?php if (get_option("pnfpb_ic_pwa_app_orientation")) {
            echo esc_html(get_option("pnfpb_ic_pwa_app_orientation"));
        } else {
            echo esc_html("any");
        } ?>",
  						"icons": [
							{
								"src": "<?php if (get_option("pnfpb_ic_fcm_pwa_upload_icon_132")) {
            echo esc_url_raw(get_option("pnfpb_ic_fcm_pwa_upload_icon_132"));
        } else {
            echo esc_url_raw(plugin_dir_url(__DIR__) . "img/icon_132.png");
        } ?>",
								"sizes": "132x132",
								"type": "image/png"
							},
							{
								"src": "<?php if (get_option("pnfpb_ic_fcm_pwa_upload_icon_512")) {
            echo esc_url_raw(get_option("pnfpb_ic_fcm_pwa_upload_icon_512"));
        } else {
            echo esc_url_raw(plugin_dir_url(__DIR__) . "img/icon.png");
        } ?>",
								"sizes": "512x512",
								"type": "image/png"
							}
						],
						<?php
      if (
          count($pnfpb_pwa_desktop_screenshot_getimagesize) > 1 &&
          count($pnfpb_pwa_mobile_screenshot_getimagesize) > 1
      ) { ?>
						"screenshots" : [
  							{
   							 	"src": "<?php if (
                get_option("pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value")
            ) {
                echo esc_html(
                    get_option(
                        "pnfpb_ic_fcm_pwa_upload_screenshot_desktop_value"
                    )
                );
            } else {
                echo esc_url_raw(
                    plugin_dir_url(__DIR__) . "img/pnfpb-pwa-screenshot.png"
                );
            } ?>",
   		 					 	"sizes": "<?php echo esc_js($pnfpb_pwa_desktop_screenshot_width) .
                 "x" .
                 esc_js($pnfpb_pwa_desktop_screenshot_height); ?>",
    							 "type": "image/webp",
    							 "form_factor": "wide",
    						 	"label": "<?php if (
                get_option("pnfpb_ic_fcm_pwa_upload_screenshot_desktop_label")
            ) {
                echo esc_html(
                    get_option(
                        "pnfpb_ic_fcm_pwa_upload_screenshot_desktop_label"
                    )
                );
            } else {
                echo "Homescreen of Awesome App";
            } ?>"
  							},
  							{
    							"src": "<?php if (
               get_option("pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value")
           ) {
               echo esc_url_raw(
                   get_option("pnfpb_ic_fcm_pwa_upload_screenshot_mobile_value")
               );
           } else {
               echo esc_url_raw(
                   plugin_dir_url(__DIR__) . "img/pnfpb-pwa-screenshot.png"
               );
           } ?>",
    							"sizes": "<?php echo esc_html($pnfpb_pwa_mobile_screenshot_width) .
               "x" .
               esc_html($pnfpb_pwa_mobile_screenshot_height); ?>",
    							"type": "image/webp",
    							"form_factor": "narrow",
    							"label": "<?php if (
               get_option("pnfpb_ic_fcm_pwa_upload_screenshot_mobile_label")
           ) {
               echo esc_html(
                   get_option("pnfpb_ic_fcm_pwa_upload_screenshot_mobile_label")
               );
           } else {
               echo "List of Awesome Resources available in Awesome App";
           } ?>"
  							}
						],
						<?php }
      if (count($pnfpb_ic_pwa_protocol_array) > 0) { ?>
						"protocol_handlers": <?php echo wp_json_encode($pnfpb_ic_pwa_protocol_array); ?>,
						<?php }
      if (count($pnfpb_ic_pwa_shortcuts_manifest_array) > 0) { ?>
						"shortcuts": <?php echo wp_json_encode($pnfpb_ic_pwa_shortcuts_manifest_array); ?>,
						<?php }
      ?>
  						"theme_color": "<?php if (get_option("pnfpb_ic_pwa_theme_color")) {
            echo esc_html(get_option("pnfpb_ic_pwa_theme_color"));
        } else {
            echo "#000000";
        } ?>",
  						"background_color": "<?php if (
            get_option("pnfpb_ic_pwa_app_backgroundcolor")
        ) {
            echo esc_html(get_option("pnfpb_ic_pwa_app_backgroundcolor"));
        } else {
            echo "#ffffff";
        } ?>",
  						"display": "<?php if (get_option("pnfpb_ic_pwa_app_display")) {
            echo esc_html(get_option("pnfpb_ic_pwa_app_display"));
        } else {
            echo "standalone";
        } ?>",
						"related_applications": [{"platform": "webapp",
   								"url": "<?php echo esc_url(home_url("/")."pnfpbmanifest.json"); ?>"}]
					}
					<?php
     $pwa_manifest_contents = ob_get_contents();

     ob_get_clean();

     return $pwa_manifest_contents;
    }
}

?>
