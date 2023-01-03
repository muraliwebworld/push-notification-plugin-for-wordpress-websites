=== Push Notification for Post and BuddyPress ===
Contributors: murali-indiacitys
Author URI: https://www.muraliwebworld.com
Tags:  Push notification,Progressive Web App,PWA,desktop notification,mobile notification,push notifications,BuddyPress push notification,Push notification for posts,Firebase push notification for WordPress,Free Push Notification,Push notification using Firebase,PWA offline mode
Donate link: https://www.muraliwebworld.com/support-to-push-notification-plugin-for-buddypress-and-for-post/
Requires at least: 5.0
Tested up to: 6.1
Requires PHP: 7.0
Stable tag: 1.48
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin is to generate Push notifications for Post, custom post types, for BuddyPress activities using Firebase and to generate Progressive Web App (PWA).

== Description ==

This Plugin is designed to send push notification using Firebase Cloud Messaging whenever new WordPress post published, WordPress custom post types published and for new BuddyPress activities and also for comments posted in BuddyPress activities. It also generates PWA - Progressive Web App.

**Plugin features:-** 
To send/schedule Push notifications when new item is published for following,

1. New post/custom post type published (including bbpress)
2. New BuddyPress activities published
3. New BuddyPress group activity published
4. New Buddypress comments published
5. New BuddyPress message or private messages
6. New BuddyPress member joined
7. Friend request in BuddyPress
8. Friendship accepted in BuddyPress
9. User avatar change in BuddyPress
10. Cover image change in BuddyPress

Refer video tutorial under "How to use this plugin" section to configure Firebase options in plugin admin area.
	
This plugin has facility to generate Progressive Web App (PWA).
Progressive Web Apps are supported by Chrome(Desktop,Mobile) browser, Edge browser, Firefox for android, Opera for android. Firefox for desktop will not support PWA. 
Go to plugin settings page to enable/disable PWA app and to customize PWA app with app name, app icon, app theme color, background color for PWA and list of pages to be included in offline cache for web app offline mode.
	
For front end users Shortcode [subscribe_PNFPB_push_notification] is available to Subscribe/Unsubscribe push notifications for following

	1.Subscribe all notifications
	2.Subscribe to all new post/new BuddyPress activity notifications
	3.Subscribe to all new comments for post,BuddyPress activities notifications
	4.Subscribe to new comments notifications only from My BuddyPress activities or My post based on Post Author id/BuddyPress activity Author id
	5.New BuddyPress member joined
	6.Friend request in BuddyPress
	7.Friendship accepted in BuddyPress
	8.User avatar change in BuddyPress
	9.Cover image change in BuddyPress
	10.Unsubscribe all notifications

Front end users/customers can opt/remove for various push notifications listed above according to their own choice.

It allows Scheduled Push notifications to send push notifications hourly(every hour), twice daily(2 times per day), daily, weekly as per WordPress CRON.

= REST API to Integrate with Mobile app =
It also provides REST API to integrate with mobile native app to get subscription token and to send push notifications to WordPress site users as well as to Native mobile app users
REST API url is https://<domain>/wp-json/PNFPBpush/v1/subscriptiontoken

= Extra settings for NGINX server =
If server is NGINX and not able to create dynamic service worker file https://<domain>/pnfpb_icpush_pwa_sw.js & PWA manifest json file https://<domain>/pnfpbmanifest.json then go to plugin settings->nginx tab, enable static file creation option, it will create required static service worker file, PWA manifest json files in root folder. This option is applicable only if hosting/server is based on NGINX and not creating dynamic service worker file, manifest json files. By default, this plugin creates dynamic service worker file and PWA manifest json file. 

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

= Progressive Web App (PWA) settings =

15. Go to PWA settings in plugin admin area and fill all required fields to customize and generate PWA app with offline facility.If pages are included for offline cache then users will be able to view those pages in offline mode without internet if page is not stored in cache then default offline page will be displayed.if all urls needs to be excluded from offline PWA cache then enable exclude all urls option in PWA settings.

16. Once all required plugin settings are complete, it will ask to allow notification for this website in browser default popup, click on allow notification to get notifications

17. Push notifications will better work in normal browser not in cognito private browser as it requires service worker registrations to display push notification.

After completing above steps, push notification will be displayed based on option selected for posts/buddypress while publishing posts or custom post types or during new BuddyPress activities or comments.

18. For front end users Shortcode [subscribe_PNFPB_push_notification] is available to Subscribe/Unsubscribe push notifications for following

	1.Subscribe all notifications
	2.Subscribe to all new post/new BuddyPress activity notifications
	3.Subscribe to all new comments for post,BuddyPress activities notifications
	4.Subscribe to new comments notifications only from My BuddyPress activities or My post based on Post Author id/BuddyPress activity Author id
	5.New BuddyPress member joined
	6.Friend request in BuddyPress
	7.Friendship accepted in BuddyPress
	8.User avatar change in BuddyPress
	9.Cover image change in BuddyPress
	10.Unsubscribe all notifications

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
	4.g.New BuddyPress member joined
	4.h.Friend request in BuddyPress
	4.i.Friendship accepted in BuddyPress
	4.j.User avatar change in BuddyPress
	4.k.Cover image change in BuddyPress

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

	1.Subscribe all notifications
	2.Subscribe to all new post/new BuddyPress activity notifications
	3.Subscribe to all new comments for post,BuddyPress activities notifications
	4.Subscribe to new comments notifications only from My BuddyPress activities or My post based on Post Author id/BuddyPress activity Author id
	5.New BuddyPress member joined
	6.Friend request in BuddyPress
	7.Friendship accepted in BuddyPress
	8.User avatar change in BuddyPress
	9.Cover image change in BuddyPress
	10.Unsubscribe all notifications

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
Added new admin option in plugin settings area for NGINX server/hosting to enable/disable static push notification service worker file and for PWA manifest json files.If server is NGINX and not able to create dynamic service worker file https://<domain>/pnfpb_icpush_pwa_sw.js & PWA manifest json file https://<domain>/pnfpbmanifest.json then go to plugin settings->nginx tab, enable static file creation option, it will create required static service worker file, PWA manifest json files in root folder. This option is applicable only if hosting/server is based on NGINX and not creating dynamic service worker file, manifest json files. By default, this plugin creates dynamic service worker file and PWA manifest json file.
= 1.40 =
Compatible with wordpress 6.1.1 version.
Added default push notification message content options in plugin setting field when new BuddyPress activity/BuddyPress group activity/post/BuddyPress activity comments/custom post/custom post comments/BuddyPress private messages
Modified click action logic in push notifications, click action option removed when site invoked using WebView mobile app. Click action will present if site is invoked using Desktop/Mobilebrowsers and in PWA.
Allow/Block prompt for push notification will appear only if site is invoked using using Desktop/Mobilebrowsers and in PWA.
Added new admin option in plugin settings area for NGINX server/hosting to enable/disable static push notification service worker file and for PWA manifest json files.If server is NGINX and not able to create dynamic service worker file https://<domain>/pnfpb_icpush_pwa_sw.js & PWA manifest json file https://<domain>/pnfpbmanifest.json then go to plugin settings->nginx tab, enable static file creation option, it will create required static service worker file, PWA manifest json files in root folder. This option is applicable only if hosting/server is based on NGINX and not creating dynamic service worker file, manifest json files. By default, this plugin creates dynamic service worker file and PWA manifest json file.
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