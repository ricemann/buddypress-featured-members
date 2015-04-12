=== BuddyPress Featured Member ===
Contributors: Rimon_Habib
Donate link: http://rimonhabib.com/
Tags: BuddyPress, Featured member
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


== Description ==

BuddyPress Featured members plugin allows you to make fetured members in you BuddyPress community and show them using shortcodes

Site admin can make any users as featured from that users profile page. And featured members can be shown using shortcodes.
There's a shortcode generator in admin page
Shortcdes parameters:
= [bfm] ( without parameters )
<br>
1.  view: options: normal, slider (default: normal) 
<br>
2.  max:  Number of members you want to show ( default 5 ) 
<br>
3.  filter:  member filter by buddypress filters ( default: active ) 
<br>
4.  astyle:  avatar style code ( default: round_0 ) 
<br>
5.  asize:  avatar size ( default: 150px ) 
<br>
6.  user_type:  <a href="http://wpbpshop.com/buddypress-user-account-type-pro">BuddyPress User Account Type PRO</a> integration.( default: none )

=  Shortcode Example: = 
[bfm view="slider" max="15" filter="alphabetical"  astyle="round_0" asize="100" ]

For more info, <a href="http://rimonhabib.com/buddypress-featured-member-plugin-released/">See here</a>

== Installation ==

1. Download bp-featured-members.zip
2. upload it to your wp-content/plugins folder
3. unzip it
4. activate it from wp-admin/plugins
5. You can generate shortcode using featured members shortcode generator

== Frequently Asked Questions ==

= Not working slider view =

There should be at least 3 users to show to work slider view correctly

= How to place shortcodes in template file =

<?php do_shortcode('[bfm view="slider" max="15" 
filter="alphabetical"  astyle="round_0" asize="100" ]') ?>

= I have another question: =
Knock me <a href="http://rimonhabib.com/contact">here</a>

== Screenshots ==

1. Go to user profile to make featured.
2. Featured members slider view.
3. Featured member shortcode generator

== Changelog ==

= 1.0 =
* First version published.

== Upgrade Notice ==
= 1.0 =
* Get and enjoy!