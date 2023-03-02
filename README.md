# Push Notification WordPress plugin for websites, Android/IOS mobile apps with Progressive Web App (PWA)<br/>
WordPress plugin to send push notifications using Firebase Cloud Messaging (FCM) to websites, Android/iOS mobile apps. This plugin has REST API facility to integrate with native/hybrid Android/iOS mobile apps for push notifications. It sends notification whenever new WordPress post, custom post types,new BuddyPress activities,comments published. It has facility to generate PWA - Progressive Web App. This plugin is able to send push notification to more than 200,000 subscribers unlimited push notifications using background action scheduler.<br/><br/>
# Features<br/>
To send/schedule Push notifications when new item is published for following,

1. New post/custom post type published (including bbpress, Woocommerce)
2. New BuddyPress activities published
3. New BuddyPress group activity published
4. New Buddypress comments published
5. New BuddyPress message or private messages
6. New BuddyPress member joined
7. Friend request in BuddyPress
8. Friendship accepted in BuddyPress
9. User avatar change in BuddyPress
10. Cover image change in BuddyPress
11. Woocommerce custom post type push notifications

Front end push notification menu is available for BuddyPress Front end users to subscribe/unsubscribe various push notifications according to their choices. This menu is available in user profile - settings area. For other users, shortcode is available to display subscription menu for Front end users to subscribe/unsubscribe various push notifications according to their choices.

# REST API<br/>
REST API to connect mobile native/hybrid apps to send push notification from WordPress site to both mobile apps and WordPress sites.
Using this REST API WordPress site gets Firebase Push Notification subscription token from Mobile app(Android/Ios). 
This allows to send push notifications to WordPress site users as well as to Native mobile app Android/ios users.
REST API url is https:/<domain>/wp-json/PNFPBpush/v1/subscriptiontoken

# Frontend push notification menu<br />
Front-end push notification subscription menu for Frontend BuddyPress users under user profile to optout for various push notifications.<br />

# Video tutorial showing how to configure Firebase for this plugin<br />
	
https://www.youtube.com/watch?v=02oymYLt3qo <br />
	
# PWA<br />
This plugin has facility to generate Progressive Web App (PWA).
Progressive Web Apps are supported by Chrome(Desktop,Mobile) browser, Edge browser, Firefox for android, Opera for android. Firefox for desktop will not support PWA. 
Go to plugin settings page to enable/disable PWA app and to customize PWA app with app name, app icon, app theme color, background color for PWA and list of pages to be included in offline cache for web app offline mode.

# Shortcode<br />
For front end users Shortcode [subscribe_PNFPB_push_notification] is available to Subscribe/Unsubscribe push notifications for following,
1. Subscribe all notifications
2. Subscribe to all new post/new BuddyPress activity notifications
3. Subscribe to all new comments for post,BuddyPress activities notifications
4. Subscribe to new comments notifications only from My BuddyPress activities or My post based on Post Author id/BuddyPress activity Author id
5. New BuddyPress member joined
6. Friend request in BuddyPress
7. Friendship accepted in BuddyPress
8. User avatar change in BuddyPress
9. Cover image change in BuddyPress
10. Unsubscribe all notifications
Front end users/customers can opt/remove for various push notifications using above shortcode according to their own choice.

# Extra settings for NGINX server<br />
If server is NGINX and not able to create dynamic service worker file https:/<domain>/pnfpb_icpush_pwa_sw.js & PWA manifest json file https:/<domain>/pnfpbmanifest.json then go to plugin settings->nginx tab, enable static file creation option, it will create required static service worker file, PWA manifest json files in root folder. This option is applicable only if hosting/server is based on NGINX and not creating dynamic service worker file, manifest json files. By default, this plugin creates dynamic service worker file and PWA manifest json file. 

This plugin uses Firebase Cloud Messaging to send push notification using Firebase registration credentials which is free of cost.Firebase PUSH API is not compatible with Safari browsers and push notification using firebase push api will not work in Safari browsers. For Safari browsers,this plugin will display console log messages to indicate the browser is not supported for push api.This plugin automatically clears out device tokens which are not subscribed or if user unsubscribed from the browser then that token will be automatically deleted.Service workers are created on the fly for Firebase Cloud Messaging while activating the plugin

# Integrate Native mobile apps like Flutter mobile app with this WordPress plugin<br />
New API to send push notification subscription from Native mobile apps like Flutter mobile app to WordPress backend and to send push notifications from WordPress to Native mobile app using Firebase.
1. Generate secret key in mobile app tab to communicate between mobile app(in Integrate app api tab plugin settings)
2. REST api to send subscription token from Mobile Flutter app using WebView to this WordPress plugin to store it in WordPress db to send push notification whenever new activities/post are published.

Note:- All REST api code is already included in the code, below is only for reference as guide,

REST API using POST method, to send push notification in secured way using AES 256 cryptography encryption method to avoid spams

REST API url post method to send push notification
https://domainname.com/wp-json/PNFPBpush/v1/subscriptiontoken

Input parameters in body in http post method in Flutter APP,
token – it should be encrypted according to AES 256 cryptography standards,

Following is sample code in dart Flutter AES 256 encryption and hash generation using AES 256 cryptography to send push notification subscription token in encrypted manner to this plugin - WordPress backend

```dart
String strPwd = "16234hgJKLmllpdcd09b2bc37293"; //secret key generated in step 1 above

      GlobalData.pushtoken = token.toString();

      final iv = EncryptPack.IV.fromLength(16);

      final key = EncryptPack.Key.fromUtf8(strPwd); //hardcode

      final encrypter = EncryptPack.Encrypter(EncryptPack.AES(key, mode: EncryptPack.AESMode.cbc));

      final encrypted = encrypter.encrypt(token.toString(), iv: iv);

      var hmacSha256 = CryptoPack.Hmac(CryptoPack.sha256,ConvertPack.utf8.encode(strPwd)); // HMAC-SHA256

      var hmacstring = hmacSha256.convert(ConvertPack.utf8.encode(token.toString()));

      var encryptedsubscription = encrypted.base64+":"+iv.base64+":"+hmacstring.toString()+":"+hmacstring.toString();
```

Using secret key generated from step 1, enter secret key in flutter app code as below in push_notification_manager.dart file (attached link for lib folder),

store token in global variable for other user
Generate envrypted token as mentioned below using below coding (AES 256 cryptography encryption)
Once plugin receives this token, it will unencrypt using the secret key generate and compare hash code to confirm it is sent from Flutter app

# Scheduling push notifications<br/>
It allows to Schedule Push notifications to send as per below schedule using WordPress CRON scheduler 
hourly(every hour)<br/>,twice daily(2 times per day)<br />, daily<br />, weekly<br />
Firebase PUSH API is not compatible with Safari browsers and push notification using firebase push api will not work in Safari browsers. For Safari browsers,this plugin will display console log messages to indicate the browser is not supported for push api.<br/>
Service workers are created on the fly for Firebase Cloud Messaging while activating the plugin<br/>
In addition to default subscription from browser, following shortcode can also be used to display toggle subscription button.<br/>
New Shortcode [subscribe_PNFPB_push_notification] to display Subscribe/Unsubscribe push notification toggle button.<br/>
Using above shortcode, toggle button to subscribe/unsubscribe can be added to sidebar or any other locations according to your need.<br/>
The shortcode [subscribe_PNFPB_push_notification] is optional, it is a additional facility to subscribe to push notification inaddition to default option from browser.<br/><br/>
# Progressive Web App (PWA)<br/>
This plugin generates PWA app based on settings in plugin admin area. Admin users will be able to enable/disable PWA app and will be customize PWA app with app name, app icon, app theme color, background color and list of pages to be included in offline cache for web app offline mode. If pages are included for offline cache then users will be able to view those pages in offline mode without internet if page is not stored in cache then default offline page will be displayed. Progressive Web Apps are supported by Chrome(Desktop,Mobile) browser, Edge browser, Firefox for android, Opera for android. Firefox for desktop will not support PWA.<br/><br/>
# On demand or One time push notification to all subscribers <br/>
Go to plugin admin area on demand push notification to send one time notification or to schedule multiple one time notifications to start at different date and time or schedule multiple campaigns to start at different date and time with image to all subscribers<br/><br/>
# Download this plugin<br/>
https://wordpress.org/plugins/push-notification-for-post-and-buddypress/<br/><br/>
# How to configure plugin<br/>
Following are steps to configure the plugin,<br/>
1. Download the plugin<br/>
2. Activate the plugin<br/>
3. Go to settings of the plugin (in admin menu -> Settings -> Push Notification using FCM)<br/>
4. Enable/Disable push notification for following,<br/>
      4.a. new post types,<br/>
	4.b. new custom post types (including bbpress),<br/>
	4.c. BuddyPress activities,<br/>
	4.d. BuddyPress Group members,<br/>
	4.e. BuddyPress messages,<br/>
	4.f. BuddyPress comments<br/>
	4.g. New BuddyPress member joined<br/>
	4.h. Friend request in BuddyPress<br/>
	4.i. Friendship accepted in BuddyPress<br/>
	4.j. User avatar change in BuddyPress<br/>
	4.k. Cover image change in BuddyPress<br/>
      When BuddyPress Group Members option is enabled, it will send push notification only to users who joined in Group/to Particular group members.<br/>
      When Buddypress private message notification is enabled, Private message notification will be sent only to the recipient id sent by sender. Admin can customize the text for push notification title from admin options.<br/>
6. Configure Firebase settings as per below steps,<br/>
7. Sign in to Firebase, then open your project click settings icon & select Project settings<br/>
8. To get Firebase server key, select project settings from Firebase account, go to cloud messaging tab, get server key fill below first field under firebase configuration<br/>
9. For remaining fields, you need to get it from your Firebase web app. All fields are required to configure FireBase push notification.<br/>
10. In the Your apps card, select the nickname of the Firebase web app for which you need a config object.<br/>
11.Select Config from the Firebase SDK snippet pane and fill below fields<br/>
After saving below fields, it will ask to allow notification for this website in browser default popup, click on allow notification to get notifications<br/>
After completing above steps, push notification will be displayed based on option selected for posts/buddypress while publishing posts or custom post types or during new BuddyPress activities or comments.<br/>
New Shortcode [subscribe_PNFPB_push_notification] can also be used to display Subscribe/Unsubscribe push notification toggle button. It is a additional facility in addition to default option from browser to subscribe/unsubscribe push notifications.<br/><br/>
# Progressive Web App (PWA) settings<br/>
14. Go to PWA settings in plugin admin area and fill all required fields to customize and generate PWA app with offline facility.If pages are included for offline cache then users will be able to view those pages in offline mode without internet if page is not stored in cache then default offline page will be displayed.<br/>
# Screenshots
![screenshot-1push](https://user-images.githubusercontent.com/32461311/132991104-5a7cfbf4-19dd-4129-8d8a-279fb00876a0.png)
![screenshot-2](https://user-images.githubusercontent.com/32461311/133961443-aeb7765e-7ac5-4f08-943f-ab281cf3f25f.png)
![screenshot-7](https://user-images.githubusercontent.com/32461311/133961446-a4d6d0fd-3d34-4380-ac8f-44cbbc4d1f88.png)
![screenshot-6push](https://user-images.githubusercontent.com/32461311/132991099-e0ccd6df-0830-4af6-914e-2560ee1e07f3.png)
![push-private-message2](https://user-images.githubusercontent.com/32461311/132991198-93bd9c69-8b89-46ee-8c7f-c8e41af0e83c.png)
