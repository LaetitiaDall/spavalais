=== LH Zero Spam ===
Contributors: shawfactor
Donate link: https://lhero.org/portfolio/lh-zero-spam/
Tags: comments, spam, antispam, anti-spam, comment spam, spambot, spammer, spam free, spam blocker, registration spam
Requires at least: 3.0
Tested up to: 5.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Zero Spam makes blocking spam comments and registrations easy.

== Description ==

**Why should your users prove that they're humans by filling out captchas? Let bots prove they're not bots with the <a href="http://lhero.org/plugins/lh-zero-spam/">LH Zero Spam plugin</a>.**

LH Zero Spam blocks registration spam and spam in comments automatically without any config or setup. Zero Spam was initially built based on the work by <a href="http://davidwalsh.name/wordpress-comment-spam">David Walsh</a>, but enhanced with simpler code base and unobtrusive JavaScript.

Major features in LH Zero Spam include:

* **No captcha**, because spam is not users' problem
* **No moderation queues**, because spam is not administrators' problem
* **Blocks spam registrations & comments** with the use of JavaScript

== Installation ==

1. Upload the `lh-zero-spam` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Is JavaScript required for this plugin to work? =

Yes, that's what does the magic and keeps spam bots out.

= I keep getting 'There was a problem processing your comment.' =

Be sure JavaScript is enabled and there are no JS errors.

= Does this work with multisite?' =

Yes it protectas from spam wp-register registrations.

= Does this work with Buddypress?' =

Yes as of version 1.08 this will protect from Buddypress registrations. Note is requires the bp_before_account_details_fields hook, must reputable themse include this hook.

== Screenshots ==

== Changelog ==

= 1.0 =
* Initial release

= 1.01 =
* Code Improvement

= 1.02 =
* Better documentation

**1.03 January 28, 2017*  
Rest api support.

**1.04 January 30, 2017*  
xmlrpc support.

**1.05 July 25, 2017*  
class check.

**1.06 September 20, 2017*  
Comment_form backup

**1.07 September 20, 2017*  
Added minimum version of php

**1.08 September 24, 2017*  
Added buddypress support

**1.09 December 17, 2017*  
filemtime for load_file

**1.10 May 17, 2019*  
anonymous function for javascript nonce handling