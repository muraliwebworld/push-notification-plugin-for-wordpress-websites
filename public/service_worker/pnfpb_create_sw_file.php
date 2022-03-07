<?php

/**
* Create service worker, Firebase service worker  dynamically (on the fly) for push notifications
*
* @since 1.0.0
*/

//check for  function called "PNFPB_icfm_icpush_add_rewrite_rules" or "PNFPB_icfm_icpush_generate_sw"  if it doesn't already exist
//

if ( !function_exists( 'PNFPB_icfm_icpush_add_rewrite_rules' ) && !function_exists( 'PNFPB_icfm_icpush_generate_sw' ) ) {
	
	add_action( 'init', 'PNFPB_icfm_icpush_add_rewrite_rules' );

	add_action( 'parse_request', 'PNFPB_icfm_icpush_generate_sw_pwajson' );
	
}

// Rewrite rules to create service worker, fire base service worker and manifest dynamically
if ( !function_exists( 'PNFPB_icfm_icpush_add_rewrite_rules' )) {
	
	function PNFPB_icfm_icpush_add_rewrite_rules() {
		$sw_filename = home_url( '/' ).'pnfpb_icpush_pwa_sw.js';
		add_rewrite_rule( "^/{$sw_filename}$","index.php?{$sw_filename}=1");
		
		$sw_filename_firebasesw = home_url( '/' ).'firebase-messaging-sw.js';
		add_rewrite_rule( "^/{$sw_filename_firebasesw}$","index.php?{$sw_filename_firebasesw}=1");
		
		if (get_option('pnfpb_ic_pwa_app_enable') && get_option('pnfpb_ic_pwa_app_enable') === '1') {
			$manifest_filename_json = home_url( '/' ).'pnfpbmanifest.json';
			add_rewrite_rule( "^/{$manifest_filename_json}$","index.php?{$manifest_filename_json}=1");		
		}
		
	}
}


// Create service worker, firebase service worker and manifest dynamically
if ( !function_exists( 'PNFPB_icfm_icpush_generate_sw_pwajson' )) {
	function PNFPB_icfm_icpush_generate_sw_pwajson( $query ) {
		if ( ! property_exists( $query, 'query_vars' ) || ! is_array( $query->query_vars ) ) {
		return;
		}
		$query_vars_as_string = implode( ' ', $query->query_vars );
		$sw_filename = 'pnfpb_icpush_pwa_sw.js';
		$sw_filename_firebasesw = 'firebase-messaging-sw.js';
		if ($query_vars_as_string != '') {
			if ($sw_filename != trim($query_vars_as_string)) {
				if ($sw_filename_firebasesw != trim($query_vars_as_string)) {
					if (trim($query_vars_as_string) === 'pnfpbmanifest.json' && get_option('pnfpb_ic_pwa_app_enable') === '1') {
						header( 'Content-Type: application/json' );
						echo PNFPB_ic_generate_pwa_manifest_json();
						exit();
					}
			    	else 
					{
						return;
					}
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

		var isPWAenabled = '<?php echo get_option('pnfpb_ic_pwa_app_enable'); ?>';
		var isExcludeallurlsincache = '<?php echo get_option('pnfpb_ic_pwa_app_excludeallurls'); ?>';



		// Config
		var OFFLINE_ARTICLE_PREFIX = 'pnfpb-offline--';
		var SW = {
  			cache_version: 'pnfpb_v1.31.0',
  			offline_assets: []
		};

		if (isExcludeallurlsincache === '1') {
			caches.delete(SW.cache_version);
		}

		if (isPWAenabled === '1') {

			//This is the "Offline copy of pages" wervice worker

			//Install stage sets up the index page (home page) in the cahche and opens a new cache

			var cacheurl3 = '<?php echo get_option('pnfpb_ic_pwa_app_offline_url3') ?>';
			var cacheurl4 = '<?php echo get_option('pnfpb_ic_pwa_app_offline_url4') ?>';
			var cacheurl5 = '<?php echo get_option('pnfpb_ic_pwa_app_offline_url5') ?>';

			SW.offline_assets.push("<?php if (get_option('pnfpb_ic_pwa_app_offline_url1') && get_option('pnfpb_ic_pwa_app_offline_url1') !== '') {echo get_option( 'pnfpb_ic_pwa_app_offline_url1');} else {echo get_home_url();}?>");

			if (cacheurl3 !== '' && cacheurl3 !== '<?php echo get_option('pnfpb_ic_pwa_app_offline_url1') ?>' && cacheurl3 !== cacheurl4  && cacheurl3 !== cacheurl5){
				SW.offline_assets.push(cacheurl3);
			}
			if (cacheurl4 !== '' && cacheurl4 !== '<?php echo get_option('pnfpb_ic_pwa_app_offline_url1') ?>' && cacheurl3 !== cacheurl4  && cacheurl4 !== cacheurl5){
				SW.offline_assets.push(cacheurl4);
			}
			if (cacheurl5 !== '' && cacheurl5 !== '<?php echo get_option('pnfpb_ic_pwa_app_offline_url1') ?>' && cacheurl5 !== cacheurl3  && cacheurl4 !== cacheurl5){
				SW.offline_assets.push(cacheurl5);
			}

			const offlinePage = "<?php if (get_option('pnfpb_ic_pwa_app_offline_url2') && get_option('pnfpb_ic_pwa_app_offline_url2') !== '') {echo get_option( 'pnfpb_ic_pwa_app_offline_url2');} else {echo get_home_url();} ?>";

			var pnfpbwpSysurls = ['gstatic.com','/wp-admin/','/wp-json/','/s.w.org/','/wp-content/','/wp-login.php','/wp-includes/','/preview=true/','ps.w.org'];

			var pnfpbexcludeurls = "<?php echo get_option('pnfpb_ic_pwa_app_excludeurls'); ?>";

			var pnfpbexcludeurlsarray = pnfpbexcludeurls.split(",");

			var neverCacheUrls = pnfpbwpSysurls;

			if (pnfpbexcludeurlsarray.length > 0 && pnfpbexcludeurls !== ''){
				neverCacheUrls = pnfpbwpSysurls.concat(pnfpbexcludeurlsarray);
			}

			//
			// Installation
			//
			self.addEventListener('install', function installer(event) {
  				// Don't wait to take control.
  				self.skipWaiting();

  				// Set up our cache.
  				event.waitUntil(
    				caches.open(SW.cache_version).then(function(cache) {
        			// Attempt to cache assets
					//console.log(SW.offline_assets);
        			var cacheResult = cache.addAll(SW.offline_assets);

        			// Success
        			cacheResult.then(function () {
          				console.log('Service Worker: Installation successful!');
        			});

        			// Failure
        			cacheResult.catch(function () {
          				console.log('Service Worker: Installation failed.');
        			});

        			return cacheResult;
      				})
  				);
			});

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

				if (isExcludeallurlsincache === '1' && event.request.url !== offlinePage) {
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
          						//if (
            					//	expectedCacheNames.indexOf(cacheName) === -1 &&
            					//	cacheName.indexOf(OFFLINE_ARTICLE_PREFIX) === -1
          						//) {
            						// If this cache name isn't present in the array of "expected"
            						// cache names, then delete it.
            						console.info('Service Worker: deleting old cache ' + cacheName);
            						return caches.delete(cacheName);
          						//}
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

		function receivePushNotification(event) {
			var notification = {};
  			if (event.data) {
    			notification = event.data.json().notification;
			}

			// Customize notification here
			const notificationTitle = notification.title;
			const notificationOptions = {
				body: notification.body,
				icon: notification.icon,
				image: notification.image,
				data: {
					url: notification.click_action
				}
			};
  			event.waitUntil(self.registration.showNotification(notificationTitle, notificationOptions));
		}

		self.addEventListener("push", receivePushNotification);

		self.addEventListener('notificationclick', function(event) {
			event.waitUntil(self.clients.openWindow(event.notification.data.url));
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
					image: notification.image,
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


if (!function_exists('PNFPB_ic_genenrate_pwa_mainfest_json')) {
	function PNFPB_ic_generate_pwa_manifest_json() {
						ob_start();  ?>
						{
						"id": "<?php echo get_home_url(); ?>/",
  						"name": "<?php if (get_option( 'pnfpb_ic_pwa_app_name' )) {echo get_option( 'pnfpb_ic_pwa_app_name' );} else { echo substr(get_bloginfo( 'name' ),0,50);} ?>",
  						"short_name": "<?php if (get_option( 'pnfpb_ic_pwa_app_shortname' )) {echo get_option( 'pnfpb_ic_pwa_app_shortname' );} else { echo substr(get_bloginfo( 'name' ),0,25);} ?>",
  						"start_url": "<?php echo get_home_url(); ?>/",
  						"icons": [
							{
								"src": "<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_icon_132' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_icon_132' );} else { echo plugin_dir_url( __DIR__ ).'public/img/icon_132.png';} ?>",
								"sizes": "132x132",
								"type": "image/png"
							},
							{
								"src": "<?php if (get_option( 'pnfpb_ic_fcm_pwa_upload_icon_512' )) {echo get_option( 'pnfpb_ic_fcm_pwa_upload_icon_512' );} else { echo plugin_dir_url( __DIR__ ).'public/img/icon.png';} ?>",
								"sizes": "512x512",
								"type": "image/png"
							}
						],
  						"theme_color": "<?php if (get_option( 'pnfpb_ic_pwa_theme_color' )){echo get_option( 'pnfpb_ic_pwa_theme_color' );} else { echo '#000000';} ?>",
  						"background_color": "<?php if (get_option( 'pnfpb_ic_pwa_app_backgroundcolor' )){echo get_option( 'pnfpb_ic_pwa_app_backgroundcolor' );} else { echo '#ffffff';} ?>",
  						"display": "<?php if (get_option( 'pnfpb_ic_pwa_app_display' )) {echo get_option( 'pnfpb_ic_pwa_app_display' );} else { echo 'standalone';} ?>"
						}
					<?php return apply_filters( 'PNFPB_ic_generate_pwa_manifest_json', ob_get_clean() );		
	}
}


?>