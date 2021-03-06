=== Wordbooker ===

Contributors: SteveAtty
Tags: facebook, minifeed, newsfeed, crosspost, WPMU, Facebook Share, Facebook Like, social media
Requires at least: 2.9
Tested up to: 3.2.1
Stable tag: 2.0.7

This plugin allows you to cross-post your blog posts to your Facebook Wall and to any Facebook Fan Page / Group that you are an administrator for. The base release of Version 2 DOES NOT support comment handling - this is because V2 had to be pushed out to meet deadlines imposed by Facebook concerning application authorisation. Comment handling will be added in the first major 2.x release.

== Description ==

This plugin allows you to cross-post your blog posts to your Facebook Wall / Fan Page Wall / Group Wall. You can Post as an Extract, A Status Update or even as a Note. 

NOTE : You MUST have the PHP Curl module enabled and configured in such a way that it can connect to the Facebook Servers. If you do not have curl OR if your hosting company block curl access to externals sites you cannot use this plugin.


== IMPORTANT ==  

Wordbooker 2.0 is a completely new implementation of most of the original Wordbooker functionality. You will need to revisit the Options screen to reset your configuration


== Upgrading Wordbooker from Version 1.x ==

If you are upgrading from version 1.x then DO NOT deactivate the plugin before you upgrade as this will remove all the settings and remove the tables which means you will loose all your posting/comment history. To upgrade Wordbooker to Version 2 you should download the latest version of the plugin, delete the wordbooker folder on the server and then then upload the wordbooker folder into your wp-plugins folder. Once you've done that you need to go into the Plugins menu and DE-ACTIVATE and the RE-ACTIVATE Wordbooker. People running Networked Blogs can do a Network Activation at this point. PLEASE NOTE:  Version 2 does not, at the moment import information about posts made in Version 1.x but I am planning to add it as an option in a future release.


== Installation ==

1. [Download] (http://wordpress.org/extend/plugins/wordbooker/) the latest version of Wordbooker.
1. Unzip the ZIP file.
1. Upload the `wordbooker` directory to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress. Admins of Networked Blogs can active the plugin network wide.
1. Navigate to `Options` &rarr; `Wordbooker` for configuration and follow the on-screen prompts.


== Features ==

For more details on the various features please read the additional Features.txt file or check the [wordbooker](http://blogs.canalplan.org.uk/steve/category/wordbooker/) category on my blog which will contain information on the current and planned features list.

- Works with a complementary [Facebook application](http://www.facebook.com/apps/application.php?id=254577506873) to update your Facebook Wall and friends' News Feeds about your blog and page postings.
- Supports multi-author blogs: each blog author notifies only their own friends of their blog/page posts.
- Features a sidebar widget to display your current Facebook Status and picture. Multiple widgets can be supported in one single blog.
- Features a sidebar widget to display a "Fan"/Like box for any of your pages. Multiple widgets can be supported in one single blog.
- Features a Facebook Like Button which can be customised as to where it appears in your blog.
- Supports the posting of blog posts to Fan Pages and Groups (if you are an administrator of that page or group).


== Frequently Asked Questions ==

= Isn't Wordbooker the same as importing my blog posts into Facebook Notes? =

It is certainly similar, but not the same:

- Facebook Notes imports and caches your blog posts (e.g., it subscribes to your blog's RSS feed).

Wordbooker uses the Facebook API to actively update your Facebook Wall just as if you had posted an update yourself on facebook.com. It also means that you can make changes to your blog postings *after* initially publishing them.

- With Wordbooker, your blog postings will have their own space in your Facebook Wall - just as if you'd written directly on to the wall yourself.

- Your updates will show up with a nifty WordPress logo next to them instead of the normal "Notes" icon, plus a link back to the full entry on your blog.


= Why doesn't the Facebook Like / Facebook Share show up properly even though I've enabled it?

You may need to add the following to the HMTL tag in your theme : xmlns:fb="http://www.facebook.com/2008/fbml".
So it looks something like :  <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:fb="http://www.facebook.com/2008/fbml">


= Why aren't my blog posts showing up in Facebook? =

- Wordbooker will not publish password-protected posts.

- Any errors Wordbooker encounters while communicating with Facebook will be recorded in error logs; the error logs (if any) are viewable in the "Wordbooker" panel of the "Options" WordPress admin page.



= My WordPress database doesn't use the default 'wp_' table prefix. Will this plugin still work? =

Yes, and its also WPMU compliant.



= How do I reset my Wordbooker/WordPress configuration so I can start over from scratch? =

1. Click the "Reset configuration" button in the "Wordbooker" panel of the "Options" WordPress admin page.
1. Deactivate the Wordbook plugin from your WordPress installation.
1. [Uninstall Wordbooker](http://www.facebook.com/apps/application.php?id=254577506873) from your Facebook account.
1. Download the [latest version](http://wordpress.org/extend/plugins/wordbooker/)
1. Re-install and re-activate the plugin.


= What is the Enable Extended description for Share Link option do? =

If you're using the Share action link on your posts to Facebook it uses the META DESCRIPTION tag to extract something from your post. If you dont have an SEO system which populates this, or if you dont usally use post excerpts then selecting this option populates the tag with the first couple hundred characters of your post which gives a nice block of text in the post that will appear when people share your post on their wall.



= How do I report problems or submit feature requests? =

- Use the [Wordbooker Support Forums](http://wordbooker.tty.org.uk/forums/). Either start a new topic, or add to an existing topic.

- Alternatively, Go to the Wordbooker Page on [GoogleCode](http://code.google.com/p/wordbooker/).


== KNOWN CONFLICTS ==

There will be conflicts with other plugins providing Facebook Like/Send Share functionality


== Screenshots ==

1. Wordbooker Options/Configuration : Blog Level options
1. Wordbooker Options/Configuration : User Level options
2. Wordbooker Options : Overrides when posting

== Changelog ==


= Version 2.0.8 19/11/2011 =
- Commented out a debug statement that got left behind.
- Added table prefix line to the support information - trying to debug problems with differing versions of WPMU.
- Tweaked duplicate post fire detection code.


= Version 2.0.7 18/11/2011 =
- Fixed a problem related to Scheduled Posts not getting pushed to Facebook
- Fixed a problem relating to Quick Edit over riding existing post options on posts
- Fixed a problem when Wordbooker is used with the Transcript theme
- Rolled back a couple of the JSON-STRING parameters where they weren't needed
- Recoded part of the Cache Refresh process to try to make it more resilient to Facebook Server timeouts/failures.


= Version 2.0.5 / 2.0.6 15/11/2011 =
- QTranslate processing was missing round one of the post content extracts
- Added code to pull the "viewing" language from qtranslate and use that to change the language of the various FB Social widgets.
- Fixed a bug where parameters were not being passed properly to the notes publishing call
- Fix a bug where the Fan page drop down was always populated with the fan pages and groups of the first user in the wordbooker tables even if there was more than one row.
- Pushed language identification into a function to make it easier to add support for other multi-language plugins later.
- More language strings snagged and tagged
- Language files for French and German added. Thanks to Sebastian Pertsch and Christian Denat
- Changed the size of the wordbooker_blank image to resolve some issues with FB ignoring it.
- Fixed a bug in the Like/Share button logic which meanr that under certain circumstances the code for buttons wasn't included when it should have been.
- Put some checking in the cron code to handle Facebook API timing out during the refresh process and leaving things in a mess
- Fixed a typo in the "Disable Short Urls" option.
- Changed graph calls to use JSON_STRING parameter rather than just JSON (Undocumented Facebook API parameter).



= Version 2.0.4 06/11/2011 =
- Added a Memory usage line to the support information.
- Removed a duplicated constant definition
- Fixed a typo in the fb_widget include.
- Fixed a bug where Save Draft didn't save the Wordbooker options
- Completely changed the Diagnostic/Error log handling.
- Clarified some of the diagnostic messages in the cache refresh code
- Fixed a glitch in the FB Status widget when FB style time formats were used.
- Added L10n handling to the FB Status Widget
- Completed L10n handling in the FB Like Widget
- Added languages folder and first revision of the wordbooker pot file
- Added function call to handle localisation
- Recoded the image handling process to make it more reliable
- Added a trim diagnostic log call to the batch cron job
- Added a check for expired sessions in the cron code.
- Added a ID line in the support information
- Fixed a bug with the "TEST MODE" option
- Fixed a problem relating to base table prefixes in some Networked blog installs.
- Added an extra detail to the target drop down list to differentiate between pages and applications with the same name.


= Version 2.0.3 23/10/2011 =
- Fixed a bug in the code that populates the og:content tag
- Fixed a bug related to mbr string handling
- Changed calls from get_user_meta to get_usermeta which means plugin now works with 2.9 again
- When posting to your personal wall the diagnostic messages showed no target name.
- Logic for Remote publishing clients revised
- Added option to disable short urls on FB posts
- Added a post revision check to hopefully fix double posting issues
- Recoded the "get logged in user" logic in the Cache Refresh to fix an obscure bug related to lost FB IDs
- Changed the level of a couple of diagnostic messages to make sure they always show.
- Changed the logic for the primary and secondary targets so that secondary doesn't appear if you only have a personal wall and the drop down is removed from the primary.
- Added option to use the default og:image tag as the default image for posts with no image.


= Version 2.0.2 15/10/2011 =
- Fixed a bug with app-id/fb:admins which made comment moderation go wrong.
- Fixed a bug in the target handling code where a variable was not being set correctly leading to confusing error message
- Changed Curl calls to supress errors (for sites where curl is blocked/broken and craps the code out)
- Changed FB comment code to supress comment boxes on anything but single post pages (as it seems to upset Facebook).
- Fixed a bug concerning "Publish As" which meant it wasn't working properly.
- Restored an option to allow Non Wordbooker users to chose if a post should be published or not.
- Restored the option to supress like/share/send on Sticky Posts
- Fixed a bug with the og: description tag not being populated.
- Changed logic so og:tags are put out all the time unless you've checked the option to disable them all.
- Fixed a bug where an array was parsed for data even if it didn't exist.
- Fixed a bug where "post attribute" was missing.
- Fixed a bug where when extract length was set to more than 400 it got reset to either 10 or 256
- Added a check so that if a post has no images a blank is loaded to stop Facebook from scraping the page.
- Changed logic so that Posting Options checks if a post is to a page and if not defaults to a post. This should provide a short term work round for custom post types.
- Fixed a bug where the diagnostics reporting which target was active or not didn't show the right target.
- Fixed a bug where the new publish options were being lost when you scheduled a post or saved a draft and then exited and edited the post later.
- Fixed a bug where if you set the "Deactivate Wordbooker functionality" then it crashed out with a fatal error
- 24 hour time formats on the FB Status Widget weren't set correctly
- Added the X509 cert bundle for Curl installs without it properly installed.


= Version 2.0.1 11/10/2011 =
- Fixed a logic mistake concerning Share on Pages/Front pages
- A field  was missing from the post storage routine
- Fixed a bug where Like counts didn't work because the url was missing.
- Put an extra option into the Curl Call which might fix issues with certificate bundles.
- Fixed a bug with app-id/fb:admins which made comment moderation go wrong.


= Verson 2.0.0 30/09/2011 =
- Major new release - too many changes to document here


= Version 1.9.5 17/07/2011 =
- Minor changes to OG Tags to handle changes in the Facebook Share/Like button functionality
- Fixed problem with quotes being turned in to html entities.


= Version 1.9.4 20/06/2011 =
- Recoded the new page permissions dialogue due to problem requesting page permissions using OAUTH2 which makes it incompatible with the REST API
- Completely recoded the post handling code to fix issues with scheduled posts not working and external clients not publishing properly	


= Version 1.9.3  02/06/2011 =
- Changed FB PHP SDK to supress session cache limiter error message
- Changed FB PHP SDK to fix class redeclaration error.
- Changed Post age time calculations to try to resolve issues with misbehaving Wordpress functions
- Revised post status transition checking code to identify new posts properly
- Fixed issue with user user settings being lost at publication time
- Added Verbose option to Curl checking to place diagnostic info into the server error log.
- Added some extra checks to imaging handling logic to discard null image strings.
- Removed exta OG tag code that slipped in sometime when I wasn't looking
- Fixed some bugs in the Like Widget which meant settings weren't stored properly and were ignored.
- Added ability to supress like/share on sticky posts.
- Removed some junk code that wasn't being used.
- Added strip_tags to remove html from comments pushed up to FB.


= Version 1.9.2  31/05/2011 =
- Remove Redundant code from base_facebook.php


= Version 1.9.1  31/05/2011 =
- Lost in SVN


= Version 1.9.0  31/05/2011 =
- Changed Authentication method again to OAUTH2 client side authentication.
- Added support for Authentication using SSL 
- Made Auth returns use POST rather than query string to tighten up security
- Added hook so that like/share buttons appear when excerpts are used on category pages rather than only when the full post was used.
- Removed SEND from iframe code as it doesn't actually work
- Changed Options page to indicate SEND only works with FBXML
- Revisted the post age calculations to handle TZ offsets
- Added an option to allow Non Wordbooker users to chose if a post should be published or not.
- Changed priority of publish_post hook to try to fix refire logic issues introduced by sluggish server response.
- Changed Image handling logic to discard arrays caused by a problematic adverts plugin.
- Added additional OG Tags					


= Version 1.8.27  01/05/2011 =
- Added support for the Facebook SEND option
- Added a couple of extra custom meta field handlers
- Minor changes to the comment pulling code to fix a couple of glitches
- Changed timestamp handling so that comment_time and comment_time_gmt aren't the same and the Blog GMT offset is applied to comment_time when pulled from FB.
- Changed all the logic to do with handling previous published posts to remove dependency on the wordbooker postlogs table
- Added a couple of more exclusions to the strip_image routine
- Fixed a bug in the Curl checking code which meant that you got no message if curl wasn't even installed.
- Fixed a < /div> tag which broke Firefox 4!
- Added a fb-root div for the fan box in the widget - again FB changed things without telling people.
- Added DB change script to set UTF8 Collations on tables to fix non Western Characterset problems.

= Version 1.8.26  02/03/2011 =
- Changed the check in the comment handling routine as FB changed a url

= Version 1.8.25   02/03/2011 =
- Rehashed the og:tags to streamline their production
- Rolled back the comments round the og:tags put in to try to help W3C compliance as it causes too many problems and often the tags fail to be recognised
- Fixed a bug in the code that handles pulling the image back for the og:image tag


= Version 1.8.24   26/02/2011 =
- Change to comment handling code to trap both "approve" and "approved" as good comment status
- Changed Youtube URL parsing to handle the embed option
- Wrapped some of the Facebook tags in comments to keep W3C validators "happy"
- Added locale to the iframe tag for like/recommend button. Uses the Wordpress WP_LANG constant


= Version 1.8.23   21/02/2011 =
- Fixed Cat introduced error in comment handling check code.


= Version 1.8.22   19/02/2011 =
- Added code developed by Shi Chuan Guan which means comments are only pushed ot FB when they've been approved
- Added code to allow tighter intergration with Justin_K's WP-FB-AutoConnect with respect to comment avatars.
- Image[0] is now stored in the post meta and used for the og:image tag
- Post Excerpt is now stored in the post meta and used for the og:description. This only affects new posts so the old code has to stay in place for now.
- Minor tweaks to code base.


= Version 1.8.21   01/02/2011 =
- Minor changes to the comment handling process to stop things tripping up again
- Added thumb to the custom meta tag handling for images
- Changed the logic so that like/share buttons show when your front page for your blog is a page.
- Added some more diagnostic messages
- Fixed some minor bugs in the image handling which meant sometimes images that had been found were lost.


= Version 1.8.20   06/01/2011 =
- "Real Comment" check stopped comments from non-logged in users from being processed. Changed this to look for Facebook links
- "Auto approve comments" option now does a direct insert to the comments table : which should bypass some of the problems with Spam checkers eating comments.
- Duplicate post checking re-coded, now if a post has been handled within the last 60 seconds its deemed a re-fire and ignored
- Redundant code for handling posts made by XMLRPC clients commented out.
- Tweaked some of the debug code
- Minor changes to the Cache handling code to make it slightly more resilient.
- Changed the code for handling og:image tags
- Changed Curl/Fopen check code as it could mis-report
- Changed SimpleXML check code as it was mis-reporting.
- Checked compatability with Wordpress 3.1

= Version 1.8.19   06/01/2011 =
- Lost in SVN 


= Version 1.8.18  24/11/2010 =
- Fixed the huge fatal bug in comment handling which affected some users
- Revised the Like / Share options to make them more flexible
- Added option to hide the FB Recent Activity on the Wordbooker Options Page
- Added option to change email address used when importing comments from FB
- Added an index to the error log table
- Changed the code that checks for bouncing comments
- Added a check for duplicate comment content coming from FB to stop Wordpress blowing up
- Hid / Deactivated the "Poll for comments when visiting this page" option
- Added more debugging to the comment handling code
- Added some .2 second pauses in the cron processes to stop the plugin exceeding the FB transaction per second limit


= Version 1.8.17  22/11/2010 =
- Fixed a bug with Like and Share logic and added missing options to pre 2.9 Options page
- Fixed a bug where the publish window check fired and stopped a post being made.
- Fixed a bug where urls were lost doing scheduled posts with URL shorteners enabled
- Fixed a bug where setting were sometimes getting lost for Scheduled posts.
- Fixed a bug which may have caused comments not to be processed
- Changed the email for imported comments so it now will use a Wordbooker Gravtar
- Settings were getting trashed when Autosave ran. Changed Wordbooker to basically do nothing when Autosave fires so changes to Wordbooker options are not lost.
- Null values for Update time from Facebook now handled.
- Changed some JSON calls to handle older versions of JSON which expect a different number of parameters.
- Changed extract trim length to handle multibyte characters (Thanks to Kensuke Akai for the fix)
- Changed the Page fetch code in the cron job to hopefully handle FB FQL failures.
- Added support for Like/Share on Category pages
- Added support for YAPB plugin
- Added a error/diagnostic log clear down call to the cron to keep the log file "tidy".
- Added a check for broken JSON installs where the function is there but PHP returns no version information.
- Added a check to the header function so that it only works on published posts (This fixes a problem with the "Share Drafts" plugin)
- Finally put some diagnostics in the comment handling code.


= Version 1.8.16   07/11/2010 =
- SVN mess up caused incorrect file versions to get released


= Version 1.8.15   07/11/2010 =
- Fixed a bug where the image links were broken
- Fixed a bug where the post links were broken
- Changed the debug process so that key process stages are always written to the diagnostic log
- Changed some more function/class names to try to avoid clashes with other FB related plugins.
- Changed some internal calls which were depreciated.



= Version 1.8.14   04/11/2010 =
- Added support for quicktranslate tags
- Fixed a bug where wpg2 tags were left in the excerpt.
- Fixed a bug where post level options were being ignored
- Fixed a bug where post level options were being lost on Draft save.
- Moved Graph API calls back to Curl - but have left fopen based library in archive
- Made Fopen calls silent to stop it barfing messages on screen on incorrectly configured webservers.
- Added wp-includes to the list of excluded image directories
- Changed name of a couple of internal functions to stop clashes with other plugins.
- Changed names of a couple of classes to avoid clashes with badly coded Facebook plugins
- Added support for URL shortener plugins : currently works with "YOURLS: WordPress to Twitter" and "url_shortener" plugins


= Version 1.8.13   30/09/2010 =
- Fixed a bug where images were not being published - was resetting an array by accident.


= Version 1.8.12 : 28/09/2010 =
- Fixed cron code which sometimes invalidated sessions 
- Added facebook.com to the list of image sources to be stripped as FB dont support posting images from their own CDN in wall posts 
- fb root div tag handling code fixed  
- html stripping code for title text tightended up 
- Minor tweaks to diagnostic code to add more details
- Changes to cron code to make it more robust when fetching information


= Version 1.8.11 : 25/07/2010 =
- Added option to allow users to change width of Facebook Like Box.
- User level setting of Yes for Default publish didn't work
- Fixed a bug where posts by email didn't get processed as they were missing a user id
- Changed Share button on multi post pages so it doesn't show the count.
- Added option to supress Meta description tag to keep SEO plugins happy.
- Support information moved so it shows during the authorisation process to help with completely failing installs.
- Removed a lot of old code as part of the pre V2.0 code rebuild.


= Version 1.8.10 : 30/06/2010 =
- Fixed a bug in the Oauth request URLs
- Fixed a warning about arrays to do with thumbnail handling
- Fixed a HTML bug which broke Fluency Admin
- Added an extra diagnostic message for posts within the "Dont republish window"


= Version 1.8.9 : 29/06/2010 =
- Trying to fix a serious SVN screwup which has broken lots of things.


= Version 1.8.8 : 29/06/2010 =
- Fix ANOTHER mistake caused by SVN problems - 

= Version 1.8.7 : 29/06/2010 =
- Fix a mistake caused by SVN problems -

= Version 1.8.6 : 29/06/2010 =
- Added support for Iframe Like/Share buttons.
- Added Faceboox "Fan"/ Like Multi-widget.
- Fixed problem with Graph API classes clashing with other Facebook related plugins.
- Fixed a bug in the image handling functions.
- Fixed a bug where selecting "show FB like / Share" buttons but not selecting where to show them hid the post.
- Changed a couple of class definitions to fix clashes with other Facebook related plugins.



= Version 1.8.5 : 20/06/2010 =
- Changed the json_decode handling in the Facebook GRAPH API to remove dependencies on Json 1.2.1
- Added Language support for FB Like button (uses the WPLANG constant).
- Added support for sharing main blog url on multiple post pages.
- Changed Support information list.
- Added "fallback" code for PHP versions missing json_decode.
- Put in checks for multibyte support.
- Changed format of "Next Scheduled Poll" text to work round timezone casting issues.
- Supress og:/fb: tags and FB javascript when share/like options are turned off.
- Wrapped og: and fb: header tags in htmlspecialchars to fix text "escaping" into page.
- Changed tag stripping code for extracts.
- Fixed 404 page throwing a Database error.
- Changed callback URLs from blog_info('url') to blog_info('wpurl') to fix issues with non "home directory" WP installs.
- Added more error trapping round user cache handling.
- Wrapped all array_keys calls in is_array checks.
- Added options to allow Share and Like buttons to be located either above or below post.


= Version 1.8.4 : 10/06/2010 =
- Fixed problems with the auth process.
- Added more diagnostic checks.
- Changed Facebook core call from CURL to old method.
- Added support for Facebook Like Button.
- Added support for Facebook Share Button
- Added a "Recent Facebook Activity" section to the Wordbooker Options page.
- Added checks for CURL and json_decode and tidied up error reporting.
- Fixed bug with json_decode for PHP < 5.2
- Fixed bug in error logging.
- Fixed missing tag (sometimes broke login URL in IE)
- Added code to fix "signature" issues during authentication.


= Version 1.8.3 : 01/06/2010 (Limited release via Wordbooker Page) =
- Changes rolled up into 1.8.4

= Version 1.8.2  : 30/05/2010 (Limited release via Wordbooker Page) =
- Changes rolled up into 1.8.3


= Version 1.8.1 : 30/05/2010 = 
- Fix issue with new API file directory.

= Version 1.8 : 30/05/2010 =
- Facebook authorisation migrated to OAUTH2
- Minor bug fixes
- Userguide updated to include new features and authorisation process.
- Recoded cron code to try to work round Facebook Database issues.



= Version 1.7.9 : 18/05/2010 =
- Several minor bug fixes and tweaks.
- Ability to use the User generated Post Excerpt to post to the wall.
 

= Version 1.7.8 :14/04/2010 =
- Fixed Scheduled post handling which was broken again.
- Recoded Advanced Diagnostics so they no longer slow down the posting process.
- Fixed bug concerning incorrect facebook IDs when posting comments.
- Recoded "non wordbook user" handing code
- Added more diagnostics



= Version 1.7.7 :05/04/2010 =
- Added support for WP thumbnails (needs WP/WPMU 2.9 or above).
- Added support for 'Quick Press' (i.e. post from Dashboard)
- Added support for use by non wordbooker users - posts from non wordbooker user inherit the blog level settings (and if the default user is set to a specific user they inherit those settings too)
- Added support for posts made by wp-o-matic.
- Added NextGen tags to the misbalanced tags list so they get stripped from the text of the excerpt.
- Added a lot more diagnostic messages.
- Fixed 'Press This' functionalilty
- Fixed loss of user settings on remote posts.
- Added more diagnostics
- Separated Errors and Diagnostics into two display blocks
- Advanced Diagnostics now a blog level option on the Options page rather than editing the PHP file



= Version 1.7.6 :  Limited release on Wordbooker Facebook page. =
- Changes for this release have been rolled up into 1.7.7.


= Version 1.7.5 : 13/03/2010 =
- Fixed a bug which stopped Scheduled Posts being pushed up to Facebook
- Added support for the "Excerpt" Box in the Add Post. If this is populated and the "Share" link option is enabled then the Excerpt text will be used to populate the Share Link.
- Added some addtional advanced debug coding.


= Version 1.7.4 : 12/03/2010 =
- Fix bug with option checking on new install which sometimes caused odd errors.


= Version 1.7.3	: 10/03/2010 =
-  Fix bitwise logic bug in permissions check code
-  Recode Status Cache update code to handle completely empty Facebook Statuses
-  Recode Missing Auths check to isolate it from Facebook Multi-query handling
-  Added more diagnostic messages to the advanced debugging process.

= Version 1.7.2 :  08/03/2010 =
 - Added user data caching
 - Multiple Facebook Status Widgets (Needs Wordpress 2.8 or above)
 - Recoding of Blog Level settings form
 - User level options added
 - Fixed bug in layout of Fan Page selector
 - Fan Page permission check/authorise added
 - General Facebook permission checks/authorise tidied up
 - Tidied up options page layout for various browsers.
 - Videos and images inserted using Viper-Video Quicktags and Shashin now handled properly and tags stripped from output.
 - Enhanced checks for conflicting (older) Facebook Platform files.
 - Added active plugins list to Support Diagnostics list.
 - Changed names of all wordbooker functions to avoid plugin conflicts.
 - Options set for each post are stored and recalled when posts are edited
 - Removed support for Facebook Profile Box posting (depreciated by Facebook)
 - Added ability for user to hide their FB status on the Wordbooker Admin page.
 - Widgets can display your profile or the pic/status from any of your Fan pages.
 - Apostrophes in page names no longer break things.
 - Added stripping of "extra" images inserted by plugins 
 - Publishing using the Press It book marklet picks up user preferences.
 - Revised Security hash coding for option forms.
 - Added User Guide and linked it from the Support section of the Plugin page.
 - Modified security check which locked contributors/subscribers out of blog
 - Blog Administrators are only people permitted to set blog level options
 - Where "post as specific user" is selected at blog level the user level options for that user are loaded at post creation time.
 - Added extended debug code to help troubleshoot problems.


= Version 1.6.1 :  29/01/2010 =
 - Fixed a bug in the Attribute "tag" handling.
 - Fixed the And/OR logic for publishing to Fan Page Walls
 - Publish to Fan Page Walls now working correctly.


= Version 1.6 :  22/01/2010 =
 - Added custom "tags" to Post Attribute and Status lines.
 - Added "Current logged in user" as an option for the target FB account
 - Added ability to choose to post to FB Wall, Fan Page Wall or both.
 - Fixed bug relating to extract length.
 - Added status_update permission check as this sometimes seems to fail.
 - Tidied up the handling of the options page for users with no wordbooker configuration


= Version 1.5  :  10/01/2010 =
 - Added check for "old" versions of the Facebook Client files which other plugins might be using. 
 - Further refinement of extract routine. 
 - User selectable "action link" for posts made to Facebook. 
 - Optional extended "description" meta tag creation for use with the "Share" action link. 
 - Fixes for issues with pluggable.php. 
 - Future posting now fully supported.
 - Fixes to multiple account configuration

= Version 1.4 :  05/01/2010 =
 - Modification of post extract routine to prevent incorrect truncation and character conversion.

= Version 1.3 :  03/01/2010 =
 - Removal of stray debugging code.
 - Tidy up and recoding of cron job.

= Version 1.2 :  02/01/2010 =
 - URL fixes, code tweaks.

= Version 1.1 :  02/01/201 =
 - Minor bug fix.
 
= version 1.0 :  02/01/2010 =
 - Base Release.


