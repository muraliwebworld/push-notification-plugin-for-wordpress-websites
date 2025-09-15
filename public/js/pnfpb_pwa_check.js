var $jpnfpb_pwa_check = jQuery.noConflict();

var PNFPBcustominstallprompt = '';

$jpnfpb_pwa_check(document).ready(function() {

	const pnfpb_localStorageKey = "pnfpb_ios_pwa_install_check";
	
	const pnfpb_userAgent = window.navigator.userAgent.toLowerCase()

	const pnfpb_isIos = /iphone|ipad|ipod/.test(pnfpb_userAgent);
	
	const safari_pnfpb =/^(?!.*chrome).*safari/i.test(pnfpb_userAgent)

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

	if (shouldShowModalResponse && !$jpnfpb_pwa_check(".pnfpb_pwa_shortcode_box").length && pnfpb_ajax_object_push_pwa_check.pnfpb_ic_ios_pwa_prompt_disable !== '1') {

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

			$jpnfpb_pwa_check('.pnfpb-pwa-dialog-ios-container').show();

			$jpnfpb_pwa_check('#pnfpb-pwa-dialog-ios-cancel').on( "click", function() {

				$jpnfpb_pwa_check('.pnfpb-pwa-dialog-ios-container').hide();

				const pnfpb_d = new Date();

				let expires = "expires="

				if (pnfpb_d.getTime) {

					const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push_pwa_check.pnfpb_ic_ios_pwa_prompt_reappear);

					pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));

					expires = "expires="+ pnfpb_d.toUTCString();

				}

				document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";					

			});
		} else {
			$jpnfpb_pwa_check('.pnfpb-pwa-dialog-ios-container').hide();
		}
	}

	if ((pnfpb_isIos || safari_pnfpb) && pnfpb_ajax_object_push_pwa_check.pnfpb_ic_ios_pwa_prompt_disable !== '1') {

		if ($jpnfpb_pwa_check(".pnfpb_pwa_shortcode_box").length) {

			$jpnfpb_pwa_check( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").show();

			$jpnfpb_pwa_check( ".pnfpb_pwa_shortcode_box" ).parent(".widget_block").show();

			$jpnfpb_pwa_check(".pnfpb_pwa_shortcode_box").show();

			$jpnfpb_pwa_check( ".pnfpb_pwa_button" ).on("click", () => {

				$jpnfpb_pwa_check('.pnfpb-pwa-dialog-ios-container').show();

			});	
			
			$jpnfpb_pwa_check('#pnfpb-pwa-dialog-ios-cancel').on( "click", function() {

				$jpnfpb_pwa_check('.pnfpb-pwa-dialog-ios-container').hide();
			});				

		} else  {

			$jpnfpb_pwa_check(".pnfpb_pwa_shortcode_box").hide();

			$jpnfpb_pwa_check( ".pnfpb_pwa_shortcode_box" ).parent(".panel-default").hide();

			$jpnfpb_pwa_check( ".pnfpb_pwa_shortcode_box" ).parent(".widget_block").hide();
		}
		
	} else {

		$jpnfpb_pwa_check('.pnfpb-pwa-dialog-ios-container').hide();

	}
	
	if ($jpnfpb_pwa_check(".pnfpb_pwa_shortcode_box").length && pnfpb_ajax_object_push_pwa_check.pnfpb_ic_ios_pwa_prompt_disable !== '1') {

		$jpnfpb_pwa_check(".pnfpb-pwa-ios-message-layout").show();

		$jpnfpb_pwa_check(".pnfpb-pwa-ios-message-container").show();

	} else {

		if (pnfpb_ajax_object_push_pwa_check.pnfpb_ic_ios_pwa_prompt_disable === '1') {

			$jpnfpb_pwa_check(".pnfpb-pwa-ios-message-layout").hide();

			$jpnfpb_pwa_check(".pnfpb-pwa-ios-message-container").hide();
		}

		$jpnfpb_pwa_check('#pnfpb-pwa-dialog-ios-cancel').on( "click", function() {

			$jpnfpb_pwa_check('.pnfpb-pwa-dialog-ios-container').hide();

			const pnfpb_d = new Date();

			let expires = "expires="

			if (pnfpb_d.getTime) {

				const pnfpb_show_again_days = parseInt(pnfpb_ajax_object_push_pwa_check.pnfpb_ic_ios_pwa_prompt_reappear);

				pnfpb_d.setTime(pnfpb_d.getTime() + (pnfpb_show_again_days*24*60*60*1000));

				expires = "expires="+ pnfpb_d.toUTCString();

			}

			document.cookie = "PNFPB_pwa_prompt" + "=" + "expiretime" + ";" + expires + ";path=/";					

		});
	}
	
});