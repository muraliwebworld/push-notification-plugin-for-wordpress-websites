=== Push Notification for Post and BuddyPress ===
Contributors: murali-indiacitys
Author URI: https://www.muraliwebworld.com
Tags:  Push notification,Progressive Web App,PWA,Woocommerce notification,mobile notification,WordPress push notification,desktop notification,push notifications,BuddyPress push notification,Push notification for posts,Firebase push notification for WordPress,Free Push Notification,Push notification using Firebase,PWA offline mode
Donate link: https://www.muraliwebworld.com/support-to-push-notification-plugin-for-buddypress-and-for-post/
Requires at least: 5.0
Tested up to: 6.3
Requires PHP: 7.4
Stable tag: 1.64
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

To send Push notifications for WordPress Post/custom post,BuddyPress,Woocommerce and to mobile apps. It also creates Progressive Web App (PWA). It sends push notifications to Native/Hybrid Android/IOS mobile app users along with website users from WordPress sites.

== Description ==

It sends push notifications using Firebase Cloud Messaging (FCM) directly using (legacy or latest version of httpv1 Firebase api) or users can select Onesignal as push notification provider to websites, Android/iOS mobile apps. It has REST API facility to integrate with native/hybrid Android/iOS mobile apps for push notifications. It sends notification whenever new WordPress post, custom post types,new BuddyPress activities,comments published. It has facility to generate PWA - Progressive Web App. This plugin is able to send push notification to more than 200,000 subscribers unlimited push notifications using background action scheduler. It includes option to use latest version of Firebase api HTTP v1.

**Plugin features:-** 
To send Push notifications for following,

1. New post/custom post type published (including bbpress).
2. New BuddyPress activities published.
3. New BuddyPress group activity published (Notification sent only to members of group).
4. BuddyPress group invite sent.(Notification sent only to recipient).
5. BuddyPress group details updated.
6. New Buddypress comments published..
7. New BuddyPress message or private messages.(Notification sent only to recipient).(It is also compatible with Bettermessages plugin).
8. New BuddyPress member joined.
9. For Friend request in BuddyPress. (Notification sent only to recipient).
10. Friendship accepted in BuddyPress. (Notification sent only to requestor).
11. User avatar change in BuddyPress.
12. Cover image change in BuddyPress.
13. Woocommerce custom post type push notifications.

Following are Admin notifications, only sent to admins.
14. When contact form(contactform7 plugin) submitted.
15. When new user registered in site.
16. BuddyPress Public Group push notification subscription can be displayed using buttons/icons, customize this option in admin settings button customization area. 
17. Options to use Firebase as push notification provider or to use onesignal as push notification provider.

Front end push notification menu is available for BuddyPress Front end users to subscribe/unsubscribe various push notifications according to their choices. This menu is available in user profile - settings area. For other users, shortcode is available to display subscription menu for Front end users to subscribe/unsubscribe various push notifications according to their choices.

= REST API =
REST API to connect mobile native/hybrid apps to send push notification from WordPress site to both mobile apps and WordPress sites.
Using this REST API WordPress site gets Firebase Push Notification subscription token from Mobile app(Android/Ios). 
This allows to send push notifications to WordPress site users as well as to Native mobile app Android/ios users.
REST API url is https:/<domain>/wp-json/PNFPBpush/v1/subscriptiontoken

= HOW TO USE PLUGIN API TO INTEGRATE MOBILE APP PUSH NOTIFICATION =
Sample code libraries containing how to use this plugin REST API to integrate with Android and IOS mobile apps
[Android app code to integrate with this plugin](https://github.com/muraliwebworld/android-app-to-integrate-push-notification-wordpress-plugin/)
[IOS app code to integrate with this plugin](https://github.com/muraliwebworld/ios-swift-app-to-integrate-push-notification-wordpress-plugin/)

= Frontend push notification menu =
Front-end push notification subscription menu for Frontend BuddyPress users under user profile to optout for various push notifications.

Refer video tutorial under "How to use this plugin" section to configure Firebase options in plugin admin area.
	
= PWA =
This plugin has facility to generate Progressive Web App (PWA).
Progressive Web Apps are supported by Chrome(Desktop,Mobile) browser, Edge browser, Firefox for android, Opera for android. Firefox for desktop will not support PWA. 
Go to plugin settings page to enable/disable PWA app and to customize PWA app with app name, app icon, app theme color, background color for PWA and list of pages to be included in offline cache for web app offline mode.
	
= Shortcode =
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

- Scheduling Push notification =
It allows Scheduled Push notifications to send push notifications hourly(every hour), twice daily(2 times per day), daily, weekly as per WordPress CRON. It also provides option to schedule push notification in background using action scheduler, this will be useful to send notification more than 100000 subscribers simultaneously in background mode.

= Extra settings for NGINX server =
If server is NGINX and not able to create dynamic service worker file https:/<domain>/pnfpb_icpush_pwa_sw.js & PWA manifest json file https:/<domain>/pnfpbmanifest.json then go to plugin settings->nginx tab, enable static file creation option, it will create required static service worker file, PWA manifest json files in root folder. This option is applicable only if hosting/server is based on NGINX and not creating dynamic service worker file, manifest json files. By default, this plugin creates dynamic service worker file and PWA manifest json file. 

This plugin uses Firebase Cloud Messaging to send push notification using Firebase registration credentials which is free of cost.Firebase PUSH API is not compatible with Safari browsers and push notification using firebase push api will not work in Safari browsers. For Safari browsers,this plugin will display console log messages to indicate the browser is not supported for push api.This plugin automatically clears out device tokens which are not subscribed or if user unsubscribed from the browser then that token will be automatically deleted.Service workers are created on the fly for Firebase Cloud Messaging while activating the plugin

** Video tutorial showing how to configure Firebase for this plugin **
	
[youtube https://www.youtube.com/watch?v=02oymYLt3qo]

**How to use Plugin:-**

Following are steps to configure the plugin,
1. Download the plugin
2. Activate the plugin
3. Go to settings of the plugin (in admin menu -> Settings -> Push Notification PNFPB)
4. Enable/Disable push notification for following,
	4.a. new post types,
	4.b. new custom post types (including bbpress),
	4.c. BuddyPress activities,
	4.d. BuddyPress Group members,
	4.e. BuddyPress messages,
	4.f. BuddyPress comments
	4.g. New BuddyPress member joined
	4.h. Friend request in BuddyPress
	4.i. Friendship accepted in BuddyPress
	4.j. User avatar change in BuddyPress
	4.k. Cover image change in BuddyPress
	4.l. Group invite
	4.m. Group details update
	4.n. Contactform7 submitted (Admin notification)
	4.o. New user registration (Admin notification)
	
10. If schedule option is enabled then push notification will be sent automatically(using CRON) according to selected schedule hourly/daily/twice daily/weekly.

= Firebase configuration setup in plugin admin settings =
	
11. Sign in to Firebase, then open your project, click settings icon & select Project settings

= To get Firebase server key (for field 1 in admin firebase settings) =

12. project settings > cloud messaging tab > get server key or add server key button to get server key

= To get Firebase config fields (for fields 2 to 8 in admin firebase settings) =

13.If you do not have web app, Create a new web app. After creating a new app, it will show firebase config fields
Project settings > General under your apps section > click on config button to view configuration fields 

= To get Firebase public key (for field 9 in admin firebase settings) =

14. Open the Cloud Messaging tab of the Firebase console Settings pane and scroll to the Web configuration section.
In the Web Push certificates tab, click Generate Key Pair. The console displays a notice that the key pair was generated, and displays the public key string and date added.
(If you already Generated key pair then no need to generate it again)

= Latest version of Firebase API httpv1 =

If latest version of Firebase API httpv1 is enabled in admin plugin settings area then it will use all new features of Firebase api. Since Legacy version of Firebase API is depreceted(work until June 2024), it is recommend to enable this option to use all latest features of Firebase api.

= Progressive Web App (PWA) settings =

15. Go to PWA settings in plugin admin area and fill all required fields to customize and generate PWA app with offline facility.If pages are included for offline cache then users will be able to view those pages in offline mode without internet if page is not stored in cache then default offline page will be displayed.if all urls needs to be excluded from offline PWA cache then enable exclude all urls option in PWA settings.

16. Once all required plugin settings are complete, it will ask to allow notification for this website in browser default popup, click on allow notification to get notifications

17. Push notifications will better work in normal browser not in cognito private browser as it requires service worker registrations to display push notification.

After completing above steps, push notification will be displayed based on option selected for posts/buddypress while publishing posts or custom post types or during new BuddyPress activities or comments.

18. For front end users Shortcode [subscribe_PNFPB_push_notification] is available to Subscribe/Unsubscribe push notifications for following

	18.1. Subscribe all notifications
	18.2. Subscribe to all new post/new BuddyPress activity notifications
	18.3. Subscribe to all new comments for post,BuddyPress activities notifications
	18.4. Subscribe to new comments notifications only from My BuddyPress activities or My post based on Post Author id/BuddyPress activity Author id
	18.5. New BuddyPress member joined
	18.6. Friend request in BuddyPress
	18.7. Friendship accepted in BuddyPress
	18.8. User avatar change in BuddyPress
	18.9. Cover image change in BuddyPress
	18.10. Unsubscribe all notifications

Front end users/customers can opt/remove for various push notifications listed above according to their own choice.
	
19. Shortcode [PNFPB_PWA_PROMPT] to create button to install PWA. If user clicks this button, it will show default prompt to install PWA. This shortcode can be placed anywhere or in sidebar according to convenience.

20. Go to on-demand push notification admin panel to send push notification from admin panel to all subscribers whenever it required.

== Installation ==

Following are steps to configure the plugin,

1. Download the plugin

2. Activate the plugin

3. Go to settings of the plugin (in admin menu -> Settings -> Push Notification using FCM)

4. Enable/Disable push notification when new item published in following,

	4.a. new post types published,
	4.b. new custom post types published,
	4.c. BuddyPress activities,
	4.d. BuddyPress Group members,
	4.e. BuddyPress messages,
	4.f. BuddyPress comments
	4.g. New BuddyPress member joined
	4.h. Friend request in BuddyPress
	4.i. Friendship accepted in BuddyPress
	4.j. User avatar change in BuddyPress
	4.k. Cover image change in BuddyPress
	4.l. Group invite
	4.m. Group details update
	4.n. Contactform7 submitted (Admin notification)
	4.o. New user registration (Admin notification)	

= Scheduling push notifications =

5.Optionally it allows to Schedule push notifications for post types,BuddyPress new activities, BuddyPress new Group activities and for BuddyPress new comments. Push notifications can be scheduled in following schedules. Go to admin settings and schedule it accordingly.Schedule push notifications in Hourly, twice daily,daily,weekly schedules. If schedule is off then push notification will be sent whenever new item is published in corresponding post types/BuddyPress activities/messages/comments.
6.When BuddyPress Group Members option is enabled, it will send push notification only to users who joined in Group/to Particular group members.
7.When Buddypress private message notification is enabled, Private message notification will be sent only to the recipient id sent by sender. Admin can customize the text for push notification title from admin options.

= Firebase configuration =

** Video tutorial showing how to configure Firebase for this plugin **
	
[youtube https://www.youtube.com/watch?v=02oymYLt3qo]

8. Configure Firebase settings as per below steps,

= Firebase configuration setup in plugin admin settings =
Sign in to Firebase, then open your project, click settings icon & select Project settings

= To get Firebase server key (for field 1 in admin firebase settings) =
project settings > cloud messaging tab > get server key or add server key button to get server key

= To get Firebase config fields (for fields 2 to 8 in admin firebase settings) =
If you do not have web app, Create a new web app. After creating a new app, it will show firebase config fields
Project settings > General under your apps section > click on config button to view configuration fields 

= To get Firebase public key (for field 9 in admin firebase settings) =
Open the Cloud Messaging tab of the Firebase console Settings pane and scroll to the Web configuration section.
In the Web Push certificates tab, click Generate Key Pair. The console displays a notice that the key pair was generated, and displays the public key string and date added.
(If you already Generated key pair then no need to generate it again)

= Progressive Web App (PWA) settings =
9. Go to PWA settings in plugin admin area and fill all required fields to customize and generate PWA app with offline facility.If pages are included for offline cache then users will be able to view those pages in offline mode without internet if page is not stored in cache then default offline page will be displayed.if all urls needs to be excluded from offline PWA cache then enable exclude all urls option in PWA settings.

10. Go to on-demand push notification admin panel to send push notification from admin panel to all subscribers whenever it required.

After saving below fields, it will ask to allow notification for this website in browser default popup, click on allow notification to get notifications

Push notifications will better work in normal browser not in cognito private browser as it requires service worker registrations to display push notification.

After completing above steps, push notification will be displayed based on option selected for posts/buddypress while publishing posts or custom post types or during new BuddyPress activities or comments.

11.For front end users Shortcode [subscribe_PNFPB_push_notification] is available to Subscribe/Unsubscribe push notifications for following

	11.1. Subscribe all notifications
	11.2. Subscribe to all new post/new BuddyPress activity notifications
	11.3. Subscribe to all new comments for post,BuddyPress activities notifications
	11.4. Subscribe to new comments notifications only from My BuddyPress activities or My post based on Post Author id/BuddyPress activity Author id
	11.5. New BuddyPress member joined
	11.6. Friend request in BuddyPress
	11.7. Friendship accepted in BuddyPress
	11.8. User avatar change in BuddyPress
	11.9. Cover image change in BuddyPress
	11.10. Unsubscribe all notifications

Front end users/customers can opt/remove for various push notifications listed above according to their own choice.
	
12. Shortcode [PNFPB_PWA_PROMPT] to create button to install PWA. If user clicks this button, it will show default prompt to install PWA. This shortcode can be placed anywhere or in sidebar according to convenience. 

== Frequently Asked Questions ==

= Do you have any questions? =

[Submit or contact us with your question here](https://www.muraliwebworld.com/groups/wordpress-plugins-by-muralidharan-indiacitys-com-technologies/forum/topic/push-notification-for-post-and-buddypress/) (or) [Please contact us here with your query.](https://indiacitys.com/#contact) (or) Submit your question in plugin forum

== Screenshots ==

1. Push notification in Mobile
2. Desktop push notification
3. Plugin settings for push notification in admin area
4. Plugin settings for push notification with BuddyPress options in admin area
5. Shortcode push notification options for front-end users to opt for various notifications
6. BuddyPress Group members can subscribe/remove push notification for every group
7. Admin page showing list of tokens subscribed
8. Progressive Web App admin settings page
9. On demand push notification page in plugin settings area
10.Customize plugin buttons
11.API for mobile app which are using webview
12.Special settings for NGINX based server

== Changelog ==
= 1.64 version 20 August 2023 changes =
New feature: Option to use latest version of Firebase API httpv1 for push notification. It requires service account json file to be uploaded. Instructions on how to get service account json from Firebase account is given in plugin admin area.
New feature: If latest version of Firebase api httpv1 is enabled then push notification will be sent more securely using oauth token everytime generated using googleapi client using service account credential file uploaded in plugin admin area.
New feature: Option to use onesignal as push notification provider instead of Firebase.
New feature: Schedule One time push notification/On demand push notification with single/recurring schedule
New feature: New tab to display all one time push notification which are previously sent with re-send option or to duplicate the notification to save as draft for future use.
New feature: User avatar instead of push icon in activity push notifications.
New feature: Custom prompt to subscribe/unsubscribe notification using a push notification icon. Admin user can update/change this icon and text according to their wish in plugin admin area.
Bug fixes and security improvements.
= 1.63 version Jun 11 2023 changes =
Bug fix: Enqueue media problem resolved in plugin settings to attach images in Push notification admin settings area.

= 1.62 version Jun 10 2023 changes =
New feature: ICON facility for group push notification subscription/unsubscription. Custom icons for group push notification subscription/unsubscription can be uploaded in button customization tab.
Update: Included documentation on sample code to integrate IOS and Android mobile app push notifications with this plugin. Sample code is in github repository, refer admin settings area for more details.
Bug fix: Resolved problems related to intialization of messaging.gettoken to get tokens from firebase.
Bug fix: Enqueue media problem resolved in plugin settings to attach images in PWA, Push notification settings area.
Bug fix: Group notification subscribe/unsubscribe button problem resolved.
Bug fix: Corrected text domain in Frontend push notification subscription text to Translate correctly by translation plugin.
Update: Included documentation on PWA or PWA shortcode may not be compatible for IOS/IPAD browsers.
Update: Resolved problems on uploading icons due to enqueue media problem in admin settings area.
= 1.59 version Apr 10 2023 changes =
Bug fix (for webview mobile apps): Resolved push notification problem for webview mobile apps when frontend subscription option is null/empty.
Bug fix (for PWA): Resolved service worker cache problem in PWA app when exclude all url option is ON - To exclude all urls including offline urls.
Bug fix (for webview mobile apps API): Resolved problem in mobile app subscription token API to update default frontend subscription option when it receives empty value in frontend subscription option field in API.
= 1.58 version Mar-24-2023 changes =
New features: Push notification for BuddyPress group invite and Push notification when BuddyPress group details updated.
New features: Admin Push notifications when new user registered and when user submitted contact form (Contact form7 plugin).
New features: PNFPB settings admin bar menu and PNFPB plugin settings are moved to separate top level menu in WordPress Admin left sidebar.
Update: Following shortcodes will work in both push notification title and in push notification content according to respective push notification types.
[member name], [user name], [sender name], [friendship acceptor name], [friendship initiator name]
New feature - Added new javascript code to communicate with IOS app in SWIFT language code with WKWEBVIEW to get push subscription token and to send push notifications to IOS app (in SWIFT language).
Updated language related to map all strings to text level domain to support language translation.
Plugin settings menus are moved to top level admin menu below settings menu(in admin left sidebar menu)
Fixed PWA admin settings problems.
Compatiable upto WordPress 6.2 version.
= 1.57 version Feb-28-2023 changes =
New Feature: Schedule one time/on demand push notification to start at different date and time. It allows to schedule multiple notifications to start at different date and time
Bug fix: Fixed problems related to REST API POST parameter 'subscriptionoptions' and REST API POST parameter "userid" updation to notification database table.
Update: Front end subscription menu update confirmation will appear in bottom below submit button.
New feature: Added and updated New language translation PNFPB_TD POT file with required strings for translation.
Update: Added text domain to all text strings in PNFPB plugin
Update: Updated action scheduler tab to filter results based on PNFPB action scheduler tasks with screen option.
Update: New postMessage for webview to send current logged in userid to webview using postMessage. It can be received using "pnfpbuserid" webview JSinterface/Javascriptchannels in mobile app(Flutter/Java/Swift/Kotlin)
= 1.56 version Feb-12-2023 changes =
New feature: Added new frontend subscription menu to subscribe/unsubscribe notifications only for Comments on My Post / My BuddyPress activities. If this option is turned on then Comments on all activities will automatically turned off. Both are toggle options.
New feature: Added new REST API POST parameter "userid" to receive push notification subscription token along with userid from mobile apps in AES-CBC-256 encryption mode.
Bug fix: Resolved problems related to Frontend subscription menu to subscribe/unsubscribe various push notifications.
Bug fix: Resolved problem related to REST API receiving data from webview mobile apps for push notifications.
Bug fix: Resolved search pagination in device token list table in plugin admin settings under device token list tab.
Update: Added firebase support check in frontend subscription option logic to separate processing for website and for mobile apps using webview.
Update: Added webview browser check logic to detect for mobile app webview or website in group push notification subscription buttons in BuddyPress groups.
= 1.55 =
New feature: New REST API parameter 'subscriptionoptions' added to receive front end subscription options opted by webview Mobile app Front end users
Bug fix: Resolved paging issue in device token list
Update: Button to switch on/off Front end subscription menu under user profile settings in BuddyPress.
From 1.55 release onwards, switch on 'Enable Frontend subscription menu' option under Frontend settings tab to display Frontend subscription menu.
Bug fix: Show front end subscription options under user profile in BuddyPress according to admin settings
Update: Comment author name option in push notification title when comments for Post/custom post type are published.
New feature: Added below parameter to send Front end subscribed options to webview app using javascript interface/channel. 
'frontendsubscriptionOptions.postMessage(subscriptionoptions);'
In mobile app it can be received using frontendsubscriptionOptions javascriptchannel/javascriptinterface. After receiving this parameter, it can be sent as separate http POST parameter subscriptionoptions along with other parameters like subscription token to send it back to wordpress site using REST API in http POST to store in PNFPB plugin wp database table. In this way, webview mobile app users can control/opt-in/opt-out their push notifications using Front end push notificaiton menu under BuddyPress user profile - settings.
= 1.54 =
Bug fix: Resolved problem related to Comment author name incorrect in push notification title.
Update: Changes to plugin to make it compatible with other Firebase plugins like integrate-firebase. Changes to enqueue scripts from this plugin as last if more than one Firebase plugins are used.
Bug fix: Resolved problem related to Image url in group activities.
Bug fix: Resolved problem related to Cookie value check in group subscription update ajax routine.
Update: Added click url under data node in push notification payload for WebView on demand or one time push notification.
= 1.53 =
New Addition: Custom push notification subscribe prompt to allow or block push notification for WordPress website users.
New Addition: Push notification support for FireFox Android Browser using custom prompt
New Addition: Customize push notification subscription prompt in plugin settings area. Dialog text, button text, text color, background color of dialog box and position of dialog box shall be customized in admin settings of plugin. Refer Push notification settings tab.
Update: New design of custom install prompt for PWA install 
Update: click action url link will be sent in payload under data for push notifications to mobile apps/mobile apps using webview. App shall parse payload under data to get url to load webview to appropriate clicked link in webview.
Removal: Popup type custom install PWA prompt removed instead use new design of custom install prompt for PWA install available under admin PWA settings.
New Addition: New Front end menu in user profile to opt for various push notification for frontend users. This menu will be available for BuddyPress users under user profile - settings - Push Notification Subscription.
Bug fix: Strip slashes while sending push notifications
Bug fix: Fixed problem related to total records display in device tokens list under plugin admin settings.
Bug fix: Removed action scheduler warning for delayed tasks
Bug fix: Fixed problem in webview push notification related to Enabling/disabling push notification subscription button for BuddyPress groups
New addition: Private messages push notification for the users who uses Better messages plugin
Update: Layout update for shortcode [subscribe_PNFPB_push_notification] to subscribe notifications for Frontend users.
New addition: Automatic scroll to appropriate comment after clicking from push notification for comments.
Update: New fields to DB table.
Bug fixes: Resolved errors while updating device ids under checkdeviceid routine and Resolved problem undefined variable userdomain in frontend subscription menu.
= 1.52 =
New Addition: Custom push notification subscribe prompt to allow or block push notification for WordPress website users.
New Addition: Push notification support for FireFox Android Browser using custom prompt
New Addition: Customize push notification subscription prompt in plugin settings area. Dialog text, button text, text color, background color of dialog box and position of dialog box shall be customized in admin settings of plugin. Refer Push notification settings tab.
Update: New design of custom install prompt for PWA install 
Update: click action url link will be sent in payload under data for push notifications to mobile apps/mobile apps using webview. App shall parse payload under data to get url to load webview to appropriate clicked link in webview.
Removal: Popup type custom install PWA prompt removed instead use new design of custom install prompt for PWA install available under admin PWA settings.
New Addition: New Front end menu in user profile to opt for various push notification for frontend users. This menu will be available for BuddyPress users under user profile - settings - Push Notification Subscription.
Bug fix: Strip slashes while sending push notifications
Bug fix: Fixed problem related to total records display in device tokens list under plugin admin settings.
Bug fix: Removed action scheduler warning for delayed tasks
Bug fix: Fixed problem in webview push notification related to Enabling/disabling push notification subscription button for BuddyPress groups
New addition: Private messages push notification for the users who uses Better messages plugin
Update: Layout update for shortcode [subscribe_PNFPB_push_notification] to subscribe notifications for Frontend users.
New addition: Automatic scroll to appropriate comment after clicking from push notification for comments.
Update: New fields to DB table.
= 1.51 =
Update: Activity comment link in notification
= 1.50 =
New Addition: Action scheduler to process more than 1000 subscribers in more than one queue with 1000 subscribers each in background mode. Since Firebase accepts 1000 deviceids per send, action scheduler will be included in upcoming release to schedule in queue (1000 device ids each queue). It will process in asynchronous way to reduce server load.
Update: Private message Thread id for mobile app in notification under data to open private message thread directly in mobile app using deep link
Update: Activity comment link in notification
New Feature: Search button in Device tokens list admin panel to search user id and tokens
Update: Clearing of stale/invalid tokens for webview mobile apps. For websites, this logic is already present.
Update: On demand push notification panel changes to include image link and click action link
Update: Removed character limit in on demand push notification
Update: DB table changes to include web_auth and web_256 fields in database for future use incase if users wants to migrate tokens from other push service providers
Bug fix: Fixed problems related to post title while scheduling notifications for POST
Update: Added new checkbox to enable/disable push notification for BuddyPress activity
Update: Javascript routine to receive tokens from android java app using webview javascript interface
Update: Customize push notification title for all post types,comments and for activity. Use [member name] shortcode to display post/activity/comment author name in title. For example, If title contains [member name] published a post then push notification title will be Tom published a post where Tom is member name who posted the post.
Bug fix: Close push notification after clicking on notification in mobile.
= 1.49 =
Bug fix: Close push notification after clicking on notification in mobile.
= 1.48 =
Bug fix: Automatic Deletion of tokens using CRON schedule with userid does not exist/deleted users and with userid = 0.
= 1.47 =
New features: Added new push notifications for New member joined, Friend request, Friendship accepted, User avatar change, User cover image change in BuddyPress.
New feature: New option added in device token list page to enable/disable automatic deletion of tokens whose userid no longer exists and tokens without userid. It can be enabled/disabled according website admin choice in plugin settings area.
Update: shortcode [subscribe_PNFPB_push_notification] is updated to have new push notification options for New member joined, Friend request, Friendship accepted, User avatar change, User cover image change. Front end user can opt/not to opt for push notifications according to their choice.
Update: Plugin settings area screen updated with custom radio buttons and custom check box.
= 1.46 =
New Addition: New Shortcode PNFPB_PWA_PROMPT added to create button to install PWA. Button text and color, background color can be customized in plugin settings area under customize button tab in last 3 fields.If user clicks this button, it will show default prompt to install PWA. This shortcode can be placed anywhere or in sidebar according to convenience.
= 1.45 =
New Addition: New Shortcode PNFPB_PWA_PROMPT added to create button to install PWA. If user clicks this button, it will show default prompt to install PWA. This shortcode can be placed anywhere or in sidebar according to convenience.
= 1.44 =
New Addition: Added new option to enable/disable service worker file to switch on/off push notification under plugin settings in "API to integrate mobile app" admin tab. By default push notification option will be ON.This option will disable service worker file, it will switch off push notification service as well as it will switch off PWA. Use this option only, if you want to use this plugin for push notification services via REST API (example: for mobile app using WebView)
= 1.43 =
To remove duplicate push notifications for mobile apps using webview REST API interface and to fix problems related to deletion of unsubscribed tokens for webview.
= 1.42 =
Compatible with wordpress 6.1.1 version.
Added default push notification message content options in plugin setting field when new BuddyPress activity/BuddyPress group activity/post/BuddyPress activity comments/custom post/custom post comments/BuddyPress private messages
Modified click action logic in push notifications, click action option removed when site invoked using WebView mobile app. Click action will present if site is invoked using Desktop/Mobilebrowsers and in PWA.
Allow/Block prompt for push notification will appear only if site is invoked using using Desktop/Mobilebrowsers and in PWA.
Added new admin option in plugin settings area for NGINX server/hosting to enable/disable static push notification service worker file and for PWA manifest json files.If server is NGINX and not able to create dynamic service worker file https:/<domain>/pnfpb_icpush_pwa_sw.js & PWA manifest json file https:/<domain>/pnfpbmanifest.json then go to plugin settings->nginx tab, enable static file creation option, it will create required static service worker file, PWA manifest json files in root folder. This option is applicable only if hosting/server is based on NGINX and not creating dynamic service worker file, manifest json files. By default, this plugin creates dynamic service worker file and PWA manifest json file.
= 1.40 =
Compatible with wordpress 6.1.1 version.
Added default push notification message content options in plugin setting field when new BuddyPress activity/BuddyPress group activity/post/BuddyPress activity comments/custom post/custom post comments/BuddyPress private messages
Modified click action logic in push notifications, click action option removed when site invoked using WebView mobile app. Click action will present if site is invoked using Desktop/Mobilebrowsers and in PWA.
Allow/Block prompt for push notification will appear only if site is invoked using using Desktop/Mobilebrowsers and in PWA.
Added new admin option in plugin settings area for NGINX server/hosting to enable/disable static push notification service worker file and for PWA manifest json files.If server is NGINX and not able to create dynamic service worker file https:/<domain>/pnfpb_icpush_pwa_sw.js & PWA manifest json file https:/<domain>/pnfpbmanifest.json then go to plugin settings->nginx tab, enable static file creation option, it will create required static service worker file, PWA manifest json files in root folder. This option is applicable only if hosting/server is based on NGINX and not creating dynamic service worker file, manifest json files. By default, this plugin creates dynamic service worker file and PWA manifest json file.
= 1.39 =
Group subscription logic updated to check whether cookie related to group subscription for particular user is present or not.
= 1.38 =
To fix problem related to setting cookie values while subscribing to Group notifications for BuddyPress Groups.
= 1.37 =
To fix warning related to permission callback in REST API related code while using in WordPress debug mode.
= 1.36 =
Compatible and tested upto WordPress6.0 version. Added REST API facility to get subscription token from native/hybrid mobile app users to send push notifications from this plugin to Native/Hybrid mobile app users along with website users.
= 1.35 =
Added new custom install prompt as New snack bar type for custom install PWA prompt. Admin can set custom install prompt appearence as pop up or snack bar/toast. Updated logic to appear custom install pwa prompt once in 7 days if user dismisses the pwa installation.
= 1.34 =
Fixed problem related to Alter push notification database table to add New column subscription_option for shortcode subscription after plugin loaded.
= 1.33 =
* Resolved problem related to alter table new column subscription_option in push notification table
= 1.32 =
Tested upto 5.9. Compatible upto latest version of WordPress 5.9.
Updated readme text plugin file.
Following new options are introduced in push notification shortcode [subscribe_PNFPB_push_notification]
	a.Subscribe all notifications
	b.Subscribe to all new post/new BuddyPress activity notifications
	c.Subscribe to all new comments for post,BuddyPress activities notifications
	d.Subscribe to new comments notifications only from My BuddyPress activities or My post based on Post Author id/BuddyPress activity Author id
	e.Unsubscribe all notifications
Shortcode push notification option text can be customized using plugin admin area under tab customize buttons.
Changes tp push notifications based on different options from shortcode when shortcode [subscribe_PNFPB_push_notification] is active otherwise default push notification subscription will be sent to subscribed users based on plugin admin area settings.
= 1.31 =
Following new options are introduced in push notification shortcode [subscribe_PNFPB_push_notification]
	a.Subscribe all notifications
	b.Subscribe to all new post/new BuddyPress activity notifications
	c.Subscribe to all new comments for post,BuddyPress activities notifications
	d.Subscribe to new comments notifications only from My BuddyPress activities or My post based on Post Author id/BuddyPress activity Author id
	e.Unsubscribe all notifications
Shortcode push notification option text can be customized using plugin admin area under tab customize buttons.
Changes tp push notifications based on different options from shortcode when shortcode [subscribe_PNFPB_push_notification] is active otherwise default push notification subscription will be sent to subscribed users based on plugin admin area settings.
= 1.30 =
To fix problem related to featured image in push notification for post.
To send push notification with featured image for post, if featured image assigned to post otherwise it will take image url from post content for push notification.
Update to filter backslashes in push notification messages.
= 1.29 =
New tab in admin settings to customize buttons and dialog text for subscription/unsubscription of push notifications.
Resolved problems related to unsubscribing push notification using shortcode.
Group notification will work independently with subscription using shortcode. For users who are subscribed to BuddyPress group notifications needs to be unsubscribe separately independent of shortcode subscribe/unsubscribe.
= 1.28 =
when PWA is disabled then offline cache will not be available.
Added new PWA admin setting field to exclude urls(disable cache for all urls except offline page) when PWA is enabled.
= 1.27 =
Resolved remove footer messages related to custom install PWA popup messages.
  Updated Firebase database url field in push notification admin settings as optional.
  Changes to launch PWA independent of Push notification settings. PWA will work with or without push notification.
  Added new code to delete settings in database while uninstalling the app.
  Added new code for Custom PWA install popup to install PWA app.
  Added new code to customize PWA install popup in PWA admin settings.
  Strip tags Removal of HTML tags in push notification content.
  Added video tutorial showing how to configure Firebase for this plugin.
= 1.26 =
Updated Firebase database url field in push notification admin settings as optional.
  Changes to launch PWA independent of Push notification settings. PWA will work with or without push notification.
  Added new code to delete settings in database while uninstalling the app.
  Added new code for Custom PWA install popup to install PWA app.
  Added new code to customize PWA install popup in PWA admin settings.
  Strip tags Removal of HTML tags in push notification content.
  Added video tutorial showing how to configure Firebase for this plugin.
= 1.25 =
Send push notification with images for Post,Custom post types,BuddyPress activities,groups,private messages and comments.
While Push notification, plugin will auto detect img html tag in the content use that image in push notification message.
= 1.24 =
To fix array problem related in removing unsubscribed users based on firebase push notification result.
= 1.23 =
Changes to avoid conflict with other Firebase based plugins
= 1.22 =
Updated with detailed procedure to set up firebase configuration in plugin admin area and in plugin page
= 1.21 =
* New feature added in admin plugin settings panel to send custom or on-demand or one time push notification from plugin admin panel to all subscribers.
Added exclude urls option in PWA admin settings page. List of urls entered in this options are excluded from offline cache from service worker. New feature to generate Progressive Web App (PWA) with offline facility.
= 1.20 =
New feature to generate Progressive Web App (PWA) with offline facility.
Go to plugin admin area PWA settings to activate PWA Progressive Web App facility
Fix to use push notifications for wordpress sites installed in sub folders.
Modified version of plugin admin settings pages.
= 1.19 =
To fix problem related to delete device token in admin settings.New features to schedule push notifications and new admin option to manage subscribed device tokens list for push notifications.
= 1.18 =
New features to schedule push notifications and new admin option to manage subscribed device tokens list for push notifications
if schedule check box is ON then admin can schedule push notification in hourly/twicedaily/daily/weekly schedules
Schedule push notification is applicable to post types, BuddyPress new activities/new group activities/new comments posted for BuddyPress activities.
= 1.17 =
New features to schedule push notifications and new admin option to manage subscribed device tokens list for push notifications
if schedule check box is ON then admin can schedule push notification in hourly/twicedaily/daily/weekly schedules
Schedule push notification is applicable to post types, BuddyPress new activities/new group activities/new comments posted for BuddyPress activities.
Go to admin settings and schedule push notification accordingly. If schedule is off then push notifications will be sent whenever new item is posted according to option settings
= 1.16 =
New feature to clear outdated device tokens which are un-subscribed or if user un-subscribed from the browser then that token will be automatically deleted to avoid duplicates.
Private message notifications from sender only to user who subscribed. User id will automatically updated with device token when user logged in and already subscribed to push notifications.
= 1.15 =
Bug fixes related to update userid when user logged in for device already subscribed.
New feature to clear outdated device tokens which are not subscribed or if user un-subscribed from the browser then that token will be automatically deleted to avoid duplicates.
New features added to send push notifications for private messages in BuddyPress only to receiver's id.
= 1.14 =
New feature to clear outdated device tokens which are not subscribed or if user un-subscribed from the browser then that token will be automatically deleted to avoid duplicates.
New features added to send push notifications for private messages in BuddyPress only to receiver's id.
Bug fix to update userid when user logged in for device already subscribed.
= 1.13 =
New features added to send push notifications for private messages in BuddyPress only to receiver's id.
When Buddypress private message notification is enabled, Private message notification will be sent only to the recipient id sent by sender. Admin can customize the text for push notification title from admin options.
Foreground push notification in android browser when browser is in focus along with background push notification(which is already in old release).
Compatible upto WordPress 5.8.1 and blocks.
= 1.12 =
Removed alert dialogs for service worker registration failed, replaced with console logs.
Firebase PUSH api will work in Chrome,Edge,Firefox and other major browsers except Safari.
Firebase PUSH API is not compatible with Safari browsers and push notification using firebase push api will not work in Safari browsers. 
For Safari browsers,this plugin will display console log messages to indicate the browser is not supported for push api.
= 1.11 =
Changes to BuddyPress Group member push notification subscription/unsubscription.
Changes to Compatiable with buddyx theme, buddypress template packs - legacy and BuddyPress Nouveau.
Fixed - Push Notification permission to ask only with user gesture and removed request permission without user gesture 
= 1.10 =
New feature added - BuddyPress Group members can subscribe/remove push notification for every group.
When BuddyPress Group Members option is enabled, it will send push notification only to users who joined in Group/to Particular group members.
= 1.9 =
Compatible upto WordPress Version 5.6

= 1.8 =
New feature added - BuddyPress Group members can subscribe/remove push notification for every group.
When BuddyPress Group Members option is enabled, it will send push notification only to users who joined in Group/to Particular group members.
Compatible upto WordPress Version 5.6
= 1.7 =
Fixed warnings related to sourcemapping firebase core javascript
Updated firebase core modules
Push notifications will better work in normal browser not in cognito private browser as it requires service worker registrations to display push notification.
This plugin requires firebase credentials to be filled in plugin admin area to get push notifications from FireBase. Please refer plugin documentation
Updated subscribe and unsubscribe javascript files compatible with latest jquery

= 1.6 =
Updated firebase core modules
Compatible upto WordPress Version 5.5.1. Updated author URL.

= 1.5 =
Compatible upto WordPress Version 5.5.1. Updated author URL.

= 1.4 =
Compatible upto WordPress Version 5.4.2. Updated author URL.

= 1.3 =
Compatible and tested upto WordPress Version 5.4.2

= 1.2 = 
* Added new shortcode [subscribe_PNFPB_push_notification] to unsubscribe push notifications.
* Removed manifest.json file generation as it is required by old generation.

= 1.1.1 = 
* Added new shortcode [subscribe_PNFPB_push_notification] to unsubscribe push notifications.
* Removed manifest.json file generation as it is required by old generation.

= 1.1 =
* Updated with link to the settings on the Plugins screen.

= 1.0 =
* Initial version.


== Upgrade Notice ==
* New feature: Option to use latest version of Firebase API httpv1 for push notification. It requires service account json file to be uploaded. Instructions on how to get service account json from Firebase account is given in plugin admin area.
* New feature: If latest version of Firebase api httpv1 is enabled then push notification will be sent more securely using oauth token everytime generated using googleapi client using service account credential file uploaded in plugin admin area.
* New feature: Option to use onesignal as push notification provider instead of Firebase.
* New feature: Schedule One time push notification/On demand push notification with single/recurring schedule
* New feature: New tab to display all one time push notification which are previously sent with re-send option or to duplicate the notification to save as draft for future use.
* New feature: User avatar instead of push icon in activity push notifications.
* New feature: Custom prompt to subscribe/unsubscribe notification using a push notification icon. Admin user can update/change this icon and text according to their wish in plugin admin area.
* Bug fixes and security improvements.
* Bug fix: Enqueue media problem resolved in plugin settings to attach images in Push notification admin settings area.
* Bug fix: Enqueue media problem resolved in plugin settings to attach images in PWA, Push notification settings area.
* Bug fix: Group notification subscribe/unsubscribe button problem resolved.
* Bug fix: Corrected text domain in Frontend push notification subscription text to Translate correctly by translation plugin.
* New feature: ICON facility for group push notification subscription/unsubscription. Custom icons for group push notification subscription/unsubscription can be uploaded in button customization tab.
* Bug fix (for webview mobile apps): Resolved push notification problem for webview mobile apps when frontend subscription option is null/empty.
* Bug fix (for PWA): Resolved service worker cache problem in PWA app when exclude all url option is ON - To exclude all urls including offline urls.
* Bug fix (for webview mobile apps API): Resolved problem in mobile app subscription token API to update default frontend subscription option when it receives empty value in frontend subscription option field in API.
* New features: Push notification for BuddyPress group invite and Push notification when BuddyPress group details updated.
* New features: Admin Push notifications when new user registered and when user submitted contact form (Contact form7 plugin).
* New features: PNFPB settings admin bar menu and PNFPB plugin settings are moved to separate top level menu in WordPress Admin left sidebar.
* Update: Following shortcodes will work in both push notification title and in push notification content according to respective push notification types.
[member name], [user name], [sender name], [friendship acceptor name], [friendship initiator name]
* New feature - Added new javascript code to communicate with IOS app in SWIFT language code with WKWEBVIEW to get push subscription token and to send push notifications to IOS app (in SWIFT language).
* Updated language related to map all strings to text level domain to support language translation.
* Plugin settings menus are moved to top level admin menu below settings menu(in admin left sidebar menu)
* Fixed PWA admin settings problems.
* Compatiable upto WordPress 6.2 version.
* New Feature: Schedule one time/on demand push notification to start at different date and time. It allows to schedule multiple notifications to start at different date and time
* Bug fix: Fixed problems related to REST API POST parameter 'subscriptionoptions' and REST API POST parameter "userid" updation to notification database table.
* Update: Front end subscription menu update confirmation will appear in bottom below submit button.
* New feature: New language translation POT file
* Update: Added text domain to all text strings in PNFPB plugin
* Update: Updated action scheduler tab to filter results based on PNFPB action scheduler tasks with screen option.
* Update: New postMessage for webview to send current logged in userid to webview using postMessage. It can be received using "pnfpbuserid" webview JSinterface/Javascriptchannels in mobile app
* New feature: Added new frontend subscription menu to subscribe/unsubscribe notifications only for Comments on My Post / My BuddyPress activities. If this option is turned on then Comments on all activities will automatically turned off. Both are toggle options.
* New feature: Added new REST API POST parameter "userid" to receive push notification subscription token along with userid from mobile apps in AES-CBC-256 encryption mode.
* Bug fix: Resolved problems related to Frontend subscription menu to subscribe/unsubscribe various push notifications.
* Bug fix: Resolved problem related to REST API receiving data from webview mobile apps for push notifications.
* Bug fix: Resolved search pagination in device token list table in plugin admin settings under device token list tab.
* Update: Added firebase support check in frontend subscription option logic to separate processing for website and for mobile apps using webview.
* Update: Added webview browser check logic to detect for mobile app webview or website in group push notification subscription buttons in BuddyPress groups.
* New feature: New REST API parameter 'subscriptionoptions' added to receive front end subscription options opted by webview Mobile app Front end users
* Bug fix: Resolved paging issue in device token list
* Update: Show front end subscription options under user profile in BuddyPress according to admin settings
* Update: Comment author name option in push notification title when comments for Post/custom post type are published.
* Update: Button to switch on/off Front end subscription menu under user profile settings in BuddyPress
* New feature: Added below parameter to send Front end subscribed options to webview app using javascript interface/channel. 
'frontendsubscriptionOptions.postMessage(subscriptionoptions);'
In mobile app it can be received using frontendsubscriptionOptions javascriptchannel/javascriptinterface. After receiving this parameter, it can be sent as parameter subscriptionoptions along with subscription token  to send it back to wordpress site using REST API in http POST to store in PNFPB plugin wp database table. In this way, webview mobile app users can control/opt-in/opt-out their push notifications using Front end push notificaiton menu under BuddyPress user profile - settings.
* Bug fix: Resolved problem related to Comment author name incorrect in post/custom post type push notification title.
* Bug fix: Resolved problem related to Comment author name incorrect in push notification title.
* Update: Changes to plugin to make it compatible with other Firebase plugins like integrate-firebase.
* Bug fix: Resolved problem related to Image url in group activities.
* Bug fix: Resolved problem related to Cookie value check in group subscription update ajax routine.
* Bug fixes: Resolved problems while updating device ids under checkdeviceid routine and Resolved problem undefined variable userdomain in frontend subscription menu.
* New Addition: Custom push notification subscribe prompt to allow or block push notification for WordPress website users.
* New Addition: Push notification support for FireFox Android Browser using custom prompt
* New Addition: Customize push notification subscription prompt in plugin settings area. Dialog text, button text, text color, background color of dialog box and position of dialog box shall be customized in admin settings of plugin. Refer Push notification settings tab.
* Update: New design of custom install prompt for PWA install 
* Update: click action url link will be sent in payload under data for push notifications to mobile apps/mobile apps using webview. App shall parse payload under data to get url to load webview to appropriate clicked link in webview.
* Removal: Popup type custom install PWA prompt removed instead use new design of custom install prompt for PWA install available under admin PWA settings.
* New Addition: New Front end menu in user profile to opt for various push notification for frontend users. This menu will be available for BuddyPress users under user profile - settings - Push Notification Subscription.
* Bug fix: Strip slashes while sending push notifications
* Bug fix: Fixed problem related to total records display in device tokens list under plugin admin settings.
* Bug fix: Removed action scheduler warning for delayed tasks
* Bug fix: Fixed problem in webview push notification related to Enabling/disabling push notification subscription button for BuddyPress groups
* New addition: Private messages push notification for the users who uses Better messages plugin
* Update: Layout update for shortcode [subscribe_PNFPB_push_notification] to subscribe notifications for Frontend users.
* New addition: Automatic scroll to appropriate comment after clicking from push notification for comments.
* Update: New fields to DB table.
* Update: Activity comment link in notification
* New Addition: Action scheduler to process more than 1000 subscribers in more than one queue with 1000 subscribers each in background mode. Since Firebase accepts 1000 deviceids per send, action scheduler will be included in upcoming release to schedule in queue (1000 device ids each queue). It will process in asynchronous way to reduce server load.
* Update: Private message Thread id for mobile app in notification under data to open private message thread directly in mobile app using deep link
* Update: Activity comment link in notification
* New Feature: Search button in Device tokens list admin panel to search user id and tokens
* Update: Clearing of stale/invalid tokens for webview mobile apps. For websites, this logic is already present.
* Update: On demand push notification panel changes to include image link and click action link
* Update: Removed character limit in on demand push notification
* Update: DB table changes to include web_auth and web_256 fields in database for future use incase if users wants to migrate tokens from other push service providers
* Bug fix: Fixed problems related to post title while scheduling notifications for POST
* Update: Added new checkbox to enable/disable push notification for BuddyPress activity
* Update: Javascript routine to receive tokens from android java app using webview javascript interface
* Update: Customize push notification title for all post types,comments and for activity. Use [member name] shortcode to display post/activity/comment author name in title. For example, If title contains [member name] published a post then push notification title will be Tom published a post where Tom is member name who posted the post.
* Bug fix: Close push notification after clicking on notification in mobile.
* Bug fix: Automatic Deletion of tokens using CRON schedule with userid does not exist/deleted and with userid = 0.
* New features: Push notifications for New member joined, Friend request, Friendship accepted, User avatar change, User cover image change in BuddyPress.
* New feature: New option added in device token list page to enable/disable automatic deletion of tokens whose userid no longer exists and tokens without userid. It can be enabled/disabled according website admin choice in plugin settings area.
* Update: shortcode [subscribe_PNFPB_push_notification] is updated to have new push notification options for New member joined, Friend request, Friendship accepted, User avatar change, User cover image change. Front end user can opt/not to opt for push notifications according to their choice.
* Update: Plugin settings area screen updated with custom radio buttons and custom check box.
* New Addition: New Shortcode PNFPB_PWA_PROMPT added to create button to install PWA. Button text and color, background color can be customized in plugin settings area under customize button tab in last 3 fields.If user clicks this button, it will show default prompt to install PWA. This shortcode can be placed anywhere or in sidebar according to convenience. 
* New Addition: New Shortcode PNFPB_PWA_PROMPT added to create button to install PWA. If user clicks this button, it will show default prompt to install PWA. This shortcode can be placed anywhere or in sidebar according to convenience.
* New Addition: Added new option to enable/disable service worker file to switch on/off push notification under plugin settings in "API to integrate mobile app" admin tab. By default push notification option will be ON.This option will disable service worker file, it will switch off push notification service as well as it will switch off PWA. Use this option only, if you want to use this plugin for push notification services via REST API (example: for mobile app using WebView)
* To remove duplicate push notifications for mobile apps using webview REST API interface and to fix problems related to deletion of unsubscribed tokens for webview.
* Modified click action logic in push notifications, click action option removed when site invoked using WebView mobile app. Click action will present if site is invoked using Desktop/Mobilebrowsers and in PWA.
* Compatible with wordpress 6.1.1 version.
* Added default push notification message content options in plugin setting field when new BuddyPress activity/BuddyPress group activity/post/BuddyPress activity comments/custom post/custom post comments/BuddyPress private messages
* Modified click action logic in push notifications, click action option removed when site invoked using WebView mobile app. Click action will present if site is invoked using Desktop/Mobilebrowsers and in PWA.
* Allow/Block prompt for push notification will appear only if site is invoked using using Desktop/Mobile browsers and in PWA.
* Added new admin option in plugin settings area for NGINX server/hosting to enable/disable static push notification service worker file and for PWA manifest json files.If server is NGINX and not able to create dynamic service worker file https://<domain>/pnfpb_icpush_pwa_sw.js & PWA manifest json file https://<domain>/pnfpbmanifest.json then go to plugin settings->nginx tab, enable static file creation option, it will create required static service worker file, PWA manifest json files in root folder. This option is applicable only if hosting/server is based on NGINX and not creating dynamic service worker file, manifest json files. By default, this plugin creates dynamic service worker file and PWA manifest json file.
* Group subscription logic updated to check whether cookie related to group subscription for particular user is present or not.
* To fix problem related to setting cookie values while subscribing to Group notifications for BuddyPress Groups.
* To fix warning related to permission callback in REST API related code while using in WordPress debug mode.
* Compatible and tested upto WordPress6.0 version. Added REST API facility to get subscription token from native/hybrid mobile app users to send push notifications from this plugin to Native/Hybrid mobile app users along with website users.
* Added new custom install prompt as New snack bar type for custom install PWA prompt. Admin can set custom install prompt appearence as pop up or snack bar. Updated logic to appear custom install pwa prompt once in 7 days if user dismisses the pwa installation. 
* Fixed problem related to Alter push notification database table to add New column subscription_option for shortcode subscription after plugin loaded.
* Resolved problem related to alter table new column subscription_option in push notification table
* Tested upto 5.9. Compatible upto latest version of WordPress 5.9
Following new options are introduced in push notification shortcode [subscribe_PNFPB_push_notification]
	a.Subscribe all notifications
	b.Subscribe to all new post/new BuddyPress activity notifications
	c.Subscribe to all new comments for post,BuddyPress activities notifications
	d.Subscribe to new comments notifications only from My BuddyPress activities or My post based on Post Author id/BuddyPress activity Author id
	e.Unsubscribe all notifications
Shortcode push notification option text can be customized using plugin admin area under tab customize buttons.
Changes tp push notifications based on different options from shortcode when shortcode [subscribe_PNFPB_push_notification] is active otherwise default push notification subscription will be sent to subscribed users based on plugin admin area settings.
* Following new options are introduced in push notification shortcode [subscribe_PNFPB_push_notification]
	a.Subscribe all notifications
	b.Subscribe to all new post/new BuddyPress activity notifications
	c.Subscribe to all new comments for post,BuddyPress activities notifications
	d.Subscribe to new comments notifications only from My BuddyPress activities or My post based on Post Author id/BuddyPress activity Author id
	e.Unsubscribe all notifications
Shortcode push notification option text can be customized using plugin admin area under tab customize buttons.
Changes tp push notifications based on different options from shortcode when shortcode [subscribe_PNFPB_push_notification] is active otherwise default push notification subscription will be sent to subscribed users based on plugin admin area settings.
* To fix problem related to featured image in push notification for post.
  To send push notification with featured image for post, if featured image assigned to post otherwise it will take image url from post content for push notification.
  Update to filter backslashes in push notification messages.
* New tab in admin settings to customize buttons and dialog text for subscription/unsubscription of push notifications.
  Resolved problems related to unsubscribing push notification using shortcode.
  Group notification will work independently with subscription using shortcode. For users who are subscribed to   BuddyPress group notifications needs to be unsubscribe separately independent of shortcode subscribe/unsubscribe.
* When PWA is disabled then offline cache will not be available. 
  Added new PWA admin setting field to exclude urls(disable cache for all urls except offline page) when PWA is enabled.
* Resolved remove footer messages related to custom install PWA popup messages.
  Updated Firebase database url field in push notification admin settings as optional.
  Changes to launch PWA independent of Push notification settings. PWA will work with or without push notification.
  Added new code to delete settings in database while uninstalling the app.
  Added new code for Custom PWA install popup to install PWA app.
  Added new code to customize PWA install popup in PWA admin settings.
  Strip tags Removal of HTML tags in push notification content.
  Added video tutorial showing how to configure Firebase for this plugin.
* Updated Firebase database url field in push notification admin settings as optional.
  Changes to launch PWA independent of Push notification settings. PWA will work with or without push notification.
  Added new code to delete settings in database while uninstalling the app.
  Added new code for Custom PWA install popup to install PWA app.
  Added new code to customize PWA install popup in PWA admin settings.
  Strip tags Removal of HTML tags in push notification content.
  Added video tutorial showing how to configure Firebase for this plugin.
* Send push notification with images for Post,Custom post types,BuddyPress activities,groups,private messages and comments.
* To fix array problem related in removing unsubscribed users based on firebase push notification result.
* Changes to avoid conflict with other Firebase based plugins
* Updated with detailed procedure to set up firebase configuration in plugin admin area and in plugin page. Firebase allows free push notification across multiple devices.
* New feature added in admin plugin settings panel to send custom or on-demand or one time push notification from plugin admin panel to all subscribers.
Added exclude urls option in PWA admin settings page. List of urls entered in this options are excluded from offline cache from service worker.New feature to generate Progressive Web App (PWA) with offline facility.
* New feature to generate Progressive Web App (PWA) with offline facility.
Go to plugin admin area PWA settings to activate PWA Progressive Web App facility
Fix to use push notifications for wordpress sites installed in sub folders.
Modified version of plugin admin settings pages.
* To fix problem related to delete device token in admin settings.New features to schedule push notifications and new admin option to manage subscribed device tokens list for push notifications
* New features to schedule push notifications and new admin option to manage subscribed device tokens list for push notifications
if schedule check box is ON then admin can schedule push notification in hourly/twicedaily/daily/weekly schedules
Schedule push notification is applicable to post types, BuddyPress new activities/new group activities/new comments posted for BuddyPress activities.
* New features to schedule push notifications and new admin option to manage subscribed device tokens list for push notifications
if schedule check box is ON then admin can schedule push notification in hourly/twicedaily/daily/weekly schedules
Schedule push notification is applicable to post types, BuddyPress new activities/new group activities/new comments posted for BuddyPress activities.
Go to admin settings and schedule push notification accordingly. If schedule is off then push notifications will be sent whenever new item is posted according to option settings
* New feature to clear outdated device tokens which are un-subscribed or if user un-subscribed from the browser then that token will be automatically deleted to avoid duplicates.Private message notifications from sender only to user who subscribed. Userid will automatically updated with device token when user logged in and already subscribed to push notifications
* Bug fixes to update userid when user logged in for device already subscribed.New feature to clear outdated device tokens which are not subscribed or if user un-subscribed from the browser then that token will be automatically deleted to avoid duplicates.New features added to send push notifications for private messages in BuddyPress only to receiver's id.
* New feature to clear outdated device tokens which are not subscribed or if user un-subscribed from the browser then that token will be automatically deleted to avoid duplicates.New features added to send push notifications for private messages in BuddyPress only to receiver's id. Bug fix to update userid when user logged in for device already subscribed. 
* New features added to send push notifications for private messages in BuddyPress only to receiver's id.Compatible upto WordPress 5.8.1 and blocks.
When Buddypress private message notification is enabled, Private message notification will be sent only to the recipient id sent by sender. Admin can customize the text for push notification title from admin options.
Foreground push notification in android browser when browser is in focus along with background push notification(which is already in old release).
* Removed alert dialogs for service worker registration failed, replaced with console logs.
* Firebase PUSH API is not compatible with Safari browsers and push notification using firebase push api will not work in Safari browsers. 
* For Safari browsers,this plugin will display console log messages to indicate the browser is not supported for push api.
* Changes to BuddyPress Group member push notification subscription/unsubscription.
* Changes to Compatiable with buddyx theme, buddypress template packs - legacy and BuddyPress Nouveau.
* Fixed - Push Notification permission to ask only with user gesture and removed request permission without user gesture 
* New feature added - BuddyPress Group members can subscribe/remove push notification for every group.
When BuddyPress Group Members option is enabled, it will send push notification only to users who joined in Group/to Particular group members.Compatible and tested upto WordPress Version 5.6
* Compatible and tested upto WordPress Version 5.5.1
* Compatible and tested upto WordPress Version 5.4.2
* Added new shortcode [subscribe_PNFPB_push_notification] to unsubscribe push notifications.
* Removed manifest.json file generation as it is required by old generation.
* Updated with link to the settings on the Plugins screen.
Initial version