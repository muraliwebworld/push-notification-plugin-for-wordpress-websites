=== Push Notification for Post and BuddyPress ===
Contributors: murali-indiacitys
Author URI: https://www.muraliwebworld.com
Tags:  push notification,mobile app,progressive web app,buddypress,firebase
Donate link: https://www.muraliwebworld.com/support-to-push-notification-plugin-for-buddypress-and-for-post/
Requires at least: 6.2
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 2.11
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Send free push notifications for post/custom post, BuddyPress from WordPress sites or using mobile app webview and to generate PWA.

== Description ==

It sends push notifications to desktop, android/ios mobile apps using Firebase Cloud Messaging (FCM) Firebase API http v1 or Onesignal or Progressier as notification provider. It has REST API facility to integrate with native/hybrid Android/iOS mobile apps for push notifications. It sends notification whenever new WordPress post, custom post types, new BuddyPress activities, comments published. It has facility to generate PWA - Progressive Web App.

= Plugin features: =

** Plugin allows to choose different push notification providers **
1. Firebase - FCM (Free push notifications for desktop, PWA and mobile apps)
2. Onesignal (Free push notification for desktop, PWA and mobile apps)
3. Progressier (Push notifications for PWA)
4. webtoapp.design (Push notifications for Mobile apps)
(Plugin allows to send push notifications to both Firebase/Onesignal and webtoapp.design users simultaneously)

** Plugin sends Push notifications for following **

1. New post/custom post type published (including bbpress).
2. New BuddyPress activities published.
3. New BuddyPress group activity published (only to members of group).
4. Notifications for BuddyPress mentions in activities.(only to recipient).
5. BuddyPress group invite sent (only to recipient).
6. BuddyPress group details updated.
7. New Buddypress comments published.
8. New BuddyPress message or private messages (only to recipient).
(It is also compatible with Bettermessages plugin).
9. New BuddyPress member joined.
10. For Friend request in BuddyPress (only to recipient).
11. Friendship accepted in BuddyPress (only to requestor).
12. User avatar change in BuddyPress.
13. Cover image change in BuddyPress.
14. Supports Push notifications for BuddyBoss and Better Messages plugins
15. Woocommerce custom post type push notifications.
16. Ability to process more than 200,000 subscribers unlimited push notifications using background action scheduler.

** Admin only push notifications (only to administrators) **
1. When contact form(contactform7 plugin) submitted.
2. When new user registered in site.

= Notifications only for loggedin users =
Enable/Disable option in admin settings to send push notifications using Firebase httpv1 or Onesignal only for loggedin users.

= Custom popup and Bell prompt to subscribe push notifications with subscription options =
Enable/Disable custom prompt with icon to subscribe/unsubscribe push notifications in front end in admin settings.
Choose Horizontal or Vertical custom prompt style and customize the text, color and button.
Enable/Disable Bell prompt icon to subscribe/unsubscribe notifications. Front end users will be able to subscribe to particular category like post, activity, comments, friendship request/accept, other options while subscribing for first time or if user wants to update subscribe options from bell prompt at any time it is needed.

= Shortcodes =
Use shortcode [member name] and [group name] in push notification title and custom content to display user name in title/content in push notifications, similarly for BuddyPress group activities [group name] place holder is available to display group name in title/content in push notifications.
For front end users Shortcode [subscribe_PNFPB_push_notification] is available to Subscribe/Unsubscribe push notifications

= Subscribe/Unsubscribe various push notifications in front end = 
Front end push notification menu is available for BuddyPress Front end users to subscribe/unsubscribe various push notifications according to their choices. This menu is available in user profile - settings area. For other users, shortcode is available to display subscription menu for Front end users to subscribe/unsubscribe various push notifications according to their choices.

= Scheduling Push notification =
It allows Scheduled Push notifications to send push notifications hourly(every hour), twice daily(2 times per day), daily, weekly as per WordPress CRON. It also provides option to schedule push notification in background using action scheduler, this will be useful to send notification more than 100000 subscribers simultaneously in background mode.
Push notification scheduling is available for On demand/One time, WordPress Post, BuddyPress activities, BuddyPress group activities and for BuddyPress comments.

= REST API =
REST API to connect mobile native/hybrid apps to send push notification from WordPress site to both mobile apps and WordPress sites.
Using this REST API WordPress site gets Firebase Push Notification subscription token from Mobile app(Android/Ios). 
This allows to send push notifications to WordPress site users as well as to Native mobile app Android/ios users.
REST API url is https:/<domain>/wp-json/PNFPBpush/v1/subscriptiontoken

= HOW TO USE PLUGIN API TO INTEGRATE MOBILE APP PUSH NOTIFICATION =
[Android app code to integrate with this plugin](https://github.com/muraliwebworld/android-app-to-integrate-push-notification-wordpress-plugin/)
[IOS app code to integrate with this plugin](https://github.com/muraliwebworld/ios-swift-app-to-integrate-push-notification-wordpress-plugin/)

Refer video tutorial under "How to use this plugin" section to configure Firebase options in plugin admin area.
	
= PWA =
This plugin has facility to generate Progressive Web App (PWA). It also supports Progressier PWA.
Go to plugin settings page to enable/disable PWA app and to customize PWA app with app name, app icon, app theme color, background color for PWA and list of pages to be included in offline cache for web app offline mode.
	
= Extra settings for NGINX server =
If server is NGINX and not able to create dynamic service worker file https:/<domain>/pnfpb_icpush_pwa_sw.js & PWA manifest json file https:/<domain>/pnfpbmanifest.json then go to plugin settings->nginx tab, enable static file creation option, it will create required static service worker file, PWA manifest json files in root folder. This option is applicable only if hosting/server is based on NGINX and not creating dynamic service worker file, manifest json files. By default, this plugin creates dynamic service worker file and PWA manifest json file. 

This plugin uses Firebase Cloud Messaging to send push notification using Firebase registration credentials which is free of cost.

= Plugin Demo site =

[Test PNFPB plugin here](https://www.muraliwebworld.com/)

= Video tutorial showing how to configure Firebase for this plugin =
	
[youtube https://www.youtube.com/watch?v=02oymYLt3qo]

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

5.Optionally it allows to Schedule push notifications for post types,BuddyPress new activities, BuddyPress new Group activities and for BuddyPress new comments. Push notifications can be scheduled in following schedules. Go to admin settings and schedule it accordingly.Schedule push notifications in Hourly, twice daily,daily,weekly schedules. 
6.When BuddyPress Group Members option is enabled, it will send push notification only to users who joined in Group/to Particular group members.
7.When Buddypress private message notification is enabled, Private message notification will be sent only to the recipient id sent by sender. 

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

12. Shortcode [PNFPB_PWA_PROMPT] to create button to install PWA. If user clicks this button, it will show default prompt to install PWA. This shortcode can be placed anywhere or in sidebar according to convenience. 

== Frequently Asked Questions (FAQ) ==

= Do you have any questions? =

[Submit or contact us with your question here](https://www.muraliwebworld.com/groups/wordpress-plugins-by-muralidharan-indiacitys-com-technologies/forum/topic/push-notification-for-post-and-buddypress/) (or) [Please contact us here with your query.](https://indiacitys.com/#contact) (or) Submit your question in plugin forum

How can I report security bugs?

You can report security bugs through the Patchstack Vulnerability Disclosure Program. The Patchstack team help validate, triage and handle any security vulnerabilities. [Report a security vulnerability.](https://patchstack.com/database/wordpress/plugin/push-notification-for-post-and-buddypress/vdp)

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
= 2.11 version 8 February 2025 =
* Update (for web push): Show or hide group subscription buttons depending on push notification subscription.
* bug fix.
* Updated readme.txt file related to security.
= 2.10 version 4 February 2025 =
* Security fix for PNFPB shortcode active or not active update in options.
* Bug fix : Group activity subscribe and unsubscribe button
* Bug fix : Push notifications only for subscribed forum topic users
* Update  : Addition line field added for Push notification Subscribe - custom prompt text
* Update  : Users will now be able to subscribe for notification using Frontend subscription settings page (in web browser push notifications).
= 2.09 version 26 January 2025 =
* PHP Code aligned and re-formatted
= 2.08 version 24 January 2025 =
* PHP Code aligned and re-formatted
* Security fix
* Changed language translation text domain matching with plugin slug push-notification-for-post-and-buddypress as per coding standards.
= 2.07 version 10 January 2025 =
* Security fix
= 2.06 version 4 January 2025 =
* Update & Bug fixes for Onesignal push notifications - Updated and fixed problems as per latest version of Onesignal SDK v16.
= 2.05 version 28 November 2024 =
* Bug fix: Bell icon push notification options problem resolved.
* Bug fix: New topic click link in push notification is resolved to open topic link instead of list of topics.
= 2.04 version November 26 2024 =
* Bug fix: Frontend notification subscriptions for mobile app using PNFPB REST API problem is resolved. Mobile app users using REST API will now be able to subscribe or unsubscribe frontend notifications from android/ios apps.
* Update: Updated logic to have async routines for subscriptions and to send notifications using Firebase httpv1.
* Update: Optimized various push notification subscriptions for frontend/bell icon.
* Update: New admin option to send notifications only for new post/frontend custom post types/frontend forum topic/reply. This option will not send notifications for modified post/custom post types.
* Update: New admin option to send notifications only to subscribers of bbpress/BuddyBoss forum topic.
* Bug fix: Forum topic reply url click link in push notification is fixed.
* Resolved problem related load text domain for WordPress 6.7 version.
* Compatible with WordPress version 6.7
= 2.03 version November 11 2024 =
* Compatible with WordPress version 6.7
* PNFPB REST API Android app changes - Added default click action "OPEN_MAIN_ACTIVITY" in push notification parameter for android app. Android app manifest xml needs to contain separate intent filter with name "OPEN_MAIN_ACTIVITY" for default intent under Mainactivity class along with intent filter for launcher.
* PNFPB REST API Android/ios app changes - PNFPB mobile app REST API supports AES/GCM/NoPadding  aes-256-gcm decryption. From mobile app, if subscrition tokens are encrypted using AES/GCM/NoPadding using secretkey then PNFPB plugin mobile app REST API routine will able to decrypt data sent from mobile app using aes-256-gcm OPEN SSL decryption php routine.
* PNFPB Private message push notification is now compatible with Better-messages chat link for background push notifications. If push notification link for better messages is clicked in mobile app, it will be redirected to Better-messages plugin chat link page in webview app.
[Old release version details are available here](https://www.pnfpb.com/release-notes-pnfpb-plugin-push-notification-for-post-and-buddypress/)


== Upgrade Notice ==
* Update (for web push): Show or hide group subscription buttons depending on push notification subscription.
* bug fix.
* Updated readme.txt file related to security.