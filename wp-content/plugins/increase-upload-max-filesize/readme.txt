=== Increase Upload Max Filesize ===
Contributors: isabel104
Tags: php.ini, php5.ini, ini rules, upload max filesize, upload limit, increase filesize, upload_max_filesize, post max size, post_max_size
Requires at least: 3.6
Tested up to: 4.6
Stable tag: 1.2
License: GNU Version 2 or Any Later Version
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Increases your upload max filesize limit on your server by adding rules to php.ini or php5.ini

== Description ==

Increase your website's upload max filesize limit on your server by adding rules to `php.ini`. If a `php.ini` file does not exist on your server in the root of your website, one will be created. If your server uses `php5.ini` instead, go to **Tools --> Upload Max Filesize** to run it with `php5.ini`. You can also use this plugin to see your current php.ini settings status (go to **Tools -> Upload Max Filesize**).

**Super Easy To Use**

**This is what the plugin does automatically when you install it (it works immediately upon activation):**

1.  If your upload max filesize ( `upload_max_filesize` ) is less than 32 MB, it will be set to 32M.

2.  If your post max size ( `post_max_size` ) is less than 33 MB, then it will be set to 33M.

That is all. No other will rules will be changed.

**If you want to set custom limits:**

For custom options, go to **Tools --> Upload Max Filesize**. From that page, you can choose custom settings and run the plugin again.


**Note:**

It will only run once, upon plugin activation, or upon clicking the blue button in `Tools -> Upload Max Filesize`.
Thus, if you later make any manual changes to decrease your `upload_max_filesize`, the plugin will not automatically increase it again. You must either run the plugin again from **Tools -> Upload Max Filesize**, or de-activate and reactivate the plugin, to make it run again.

**Will This Work For You?**

This plugin works. This means that it writes the rules to your php.ini and/or to your php5.ini. If the `.ini` file does not exist, it will create the file and then write the rules on it. This is all the plugin does. However, some web hosts IGNORE the settins on your php.ini or php5.ini. That is out of our control. 

PLEASE NOTE: If you have a web host that ignores PHP ini rules set in these `.ini` files, that is no reason to give this plugin a bad rating. **You have the option of posting your problem (and the name of your web host) in the forum, and 9 times out of 10, I will help you solve your web-host-related problem.**

This plugin will work with most web hosts that recognize either a `php.ini` or `php5.ini` file. It's not going to work with all hosting companies, but it will work with most of them (including BlueHost and GoDaddy).

See the [Installation Instructions](https://wordpress.org/plugins/increase-upload-max-filesize/installation/) and the FAQ.

Contribute or fork it [on Github](https://github.com/isabelc/increase-upload-max-filesize).

== Installation ==

1. In your dashboard, go to **Plugins -> Add New** and search for "Increase Upload Max Filesize".

2. Install and click "Activate" to activate the plugin.

3. Go to **Tools -> Upload Max Filesize** to see your current status. If the current status shows that your `'upload_max_filesize'` is 32M or greater, the plugin has worked.

4.  If the current status shows that your `'upload_max_filesize'` is **less than 32M**, first wait at least 30 minutes. Some servers are slower than others. If it still does not change after 30 minutes, it may be because your server does not recognize `php.ini`, and only recognizes `php5.ini`. So, please check the box labeled "USE php5.ini INSTEAD OF php.ini" and click the blue button once. Then, check your current status again after a few minutes.

5. If you want to set custom limits, go to **Tools -> Upload Max Filesize**. From that page, you can choose custom settings and run the plugin again.

== Frequently Asked Questions ==

= Will this plugin work for me? =

This plugin works. This means that it writes the rules to your php.ini and/or to your php5.ini. If the `.ini` file does not exist, it will create the file and then write the rules on it. This is all the plugin does. However, some web hosts IGNORE the settins on your php.ini or php5.ini. That is out of our control. 

PLEASE NOTE: If you have a web host that ignores PHP ini rules set in these `.ini` files, that is no reason to give this plugin a bad rating. **You have the option of posting your problem (and the name of your web host) in the forum, and 9 times out of 10, I will help you solve your web-host-related problem.**

This plugin will work with most web hosts that recognize either a `php.ini` or `php5.ini` file. It's not going to work with all hosting companies, but it will work with most of them (including BlueHost and GoDaddy).


= Why don't my custom limits take effect? = 

If after 30 minutes your custom settings do not take effect, it may be that you web hosting company has set a maximum limit. Please check with your host to see what the maximum allowable limits are. For example, some of them don’t allow the `'upload_max_filesize'` to go above 32M. In that case, if you try to set it to 64, it will not take effect. It will not even get set to 32, either. It will simply stay at whatever lower setting you currently had in effect. So, choose custom limits that are a little bit lower and run the plugin again.


== Changelog ==

= 1.2 =
* New - Use php.ini by default rather than php5.ini.
* Fix - Fixed poor alignment of status boxes on the Tools --> Upload Max Filesize page.
* Fix - Update existing rules, if they exist, rather than adding a new line. If a rule does not exist, then add the new line.

= 1.1 =
* New - Changed the textdomain to match the plugin slug for compatibility with WordPress core language packs.
* New - Added a .pot translation file.
* Fix - Fixed a bug which caused it to look for non-existent translation files.
* Tweak - Updated the plugin URI.
* Tweak - Now uses a singleton class.
* Maintenance - Tested and passed for WordPress 4.0 compatibility.

= 1.0.2 =
* New: options to set custom limits.
* New: can run again from backend even without setting custom options and without having to deactivate and reactivate.
* Removed feature: memory_limit is no longer affected.
* Tested for WP 3.8 compatibility.

= 1.0.1 =
* New: option to use php.ini for servers that do not recognize php5.ini.
* Tweak: Added "Current Status" screen to avoid guesswork as to whether the plugin worked or not.
* WP 3.7 compatible.

= 1.0 =
* Initial release.
== Upgrade Notice ==

= 1.0.2 =
New: set custom limits, and option to run plugin again without deactivating and reactivating.
